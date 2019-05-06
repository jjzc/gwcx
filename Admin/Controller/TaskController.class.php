<?php

namespace Admin\Controller;

use Think\Controller;

class TaskController extends Controller
{
    private function getToken()
    {
        $set     = M("set")->find(1);
        $account = "account=" . $set["jjaccount"] . "&pwd=" . $set["jjpwd"];
        $res     = httpFF("http://api.99huaan.com/passenger/login", "", $account, "POST");
        $res     = json_decode($res, true);
        if ($res["result"] == 0) {
            return '';
        } else {
            return $res["token"];
        }
    }

    public function travelFinish($page = 1)
    {
//        @file_put_contents($_SERVER["DOCUMENT_ROOT"]."/jzw.txt"," time1:".date("Y-m-d H:i:s").PHP_EOL,FILE_APPEND);
        set_time_limit(0);
//        header("Content-type:text/html;charset=utf-8");
        //获取token
        $token = S("AccToken");
        if (empty($token)) {
            $token = $this->getToken();
            if ($token) {
                S("AccToken", $token, 60 * 12);
            }
        }

        if (empty($token)) {
            return;
        }

//        $sql = "state = 8 and is_del=0 and jj_id is not null";
        $sql = "state BETWEEN '1' AND '8' AND jj_id IS NOT NULL AND is_del = 0";

        $limit = (($page - 1) * 100) . ",100";
        $list  = M("travel")->where($sql)->limit($limit)->select();

        if (empty($list)) {
            exit;
        }

        register_shutdown_function(array(&$this, 'travelFinish'), $page + 1);

        foreach ($list as $k => $v) {
            if (empty($v["jj_id"])) {
                continue;
            }
            //获取订单信息
            $data = "token=" . $token . "&order_id=" . $v["jj_id"];
            $res  = httpFF("http://api.99huaan.com/passenger/order/result", "", $data, "POST");
//            $res = httpFF("192.168.1.123:8080/order/result", "", $data, "POST");
            $res = json_decode($res, true);

//            dump($res);exit;

            if ($res["result"] != 1) {
                continue;
            }

            $res = $res["data"];

            //玖玖订单状态 0：新建订单  1：派单状态 2：已接单未开始服务 3：前往预约地 4：已到达（开始服务） 5：服务中（开始出发） 6：服务结束 7：订单等待付款 8：订单支付完成
            // 11：已被用户取消的订单 12：司机拒绝的订单 13：系统已销单 14：司机取消的订单

            $save                    = array();
            $save["jj_driver_name"]  = $res["real_name"];
            $save["jj_driver_phone"] = $res["driver_mobile"];
            $save["jj_car_num"]      = $res["plate_number"];
            $save["gps_code"]        = $res["gps_pn"];

            if ($res["status"] >= 2 && $res["status"] < 8) {

                M("travel")->where(array("id" => $v["id"]))->save($save);

            } elseif ($res["status"] == 8) { //同步费用信息

                $save["state"]              = 9;
                $save["start_use_car_time"] = $res["start_service_time"] ? intval($res["start_service_time"] * 0.001) : '';     //开始用车时间  返回13位时间戳
                $save["end_use_car_time"]   = $res["end_service_time"] ? intval($res["end_service_time"] * 0.001) : '';         //结束用车时间  返回13位时间戳
                $save["pay_type"]           = $res["payment_type"] == 1 ? "签单" : "垫付";
                $save["mileage"]            = $res["distance"];
                $save["fees_sum"]           = $res["road_money"];   //路桥费
                $save["parking_rate_sum"]   = 0;
                $save["service_charge"]     = $res["order_money"];    //服务费
                $save["driver_cost"]        = 0;
                $save["over_time_cost"]     = 0;
                $save["over_mileage_cost"]  = 0;
                $save["else_cost"]          = $res["order_other"];    //其他费用
//                $save["totle_rate"]         = $save["fees_sum"] + $save["parking_rate_sum"] + $save["service_charge"] + $save["driver_cost"] + $save["over_time_cost"] + $save["over_mileage_cost"] + $save["else_cost"];
                $save["totle_rate"] = $res["order_total"];   //总费用

                $rs = M("Travel")->where(array("id" => $v["id"]))->save($save);

                if (false !== $rs) {
                    //记录日志
                    $content = "(定时任务)完成出行订单，出行流水号： " . $v["serial_number"];
                    M("Log")->add(array("user_id" => 0, "do_time" => time(), "content" => $content, "type" => 1));

                    //只有需要派车的情况下才释放车辆司机
                    if ($v["is_arrange_car"] == 1) {
                        if ($v["car_id"]) {
                            //释放车辆
                            M("car")->save(array("id" => $v["car_id"], "state" => 1));
                        }
                        if ($v["driver_id"]) {
                            //释放司机
                            M("driver")->save(array("id" => $v["driver_id"], "state" => 0));
                        }
                    }
                }
            } elseif ($res["status"] > 8) { //订单取消了

                M("travel")->where(array("id" => $v["id"]))->save(array(
                    "state" => 11
                ));
            }
        }

    }

    public function test(){

    }

}