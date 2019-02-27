<?php

namespace Admin\Controller;

use Think\Controller;

class TaskController extends Controller
{

    public function travelFinish()
    {
        set_time_limit(0);
//        header("Content-type:text/html;charset=utf-8");
        //获取token
        $set     = M("set")->find(1);
        $account = "account=" . $set["jjaccount"] . "&pwd=" . $set["jjpwd"];
        $res     = httpFF("http://api.99huaan.com/passenger/login", "", $account, "POST");
        $res     = json_decode($res, true);

        if ($res["result"] == 0) {
            return;
        }

        $token = $res["token"];

        $sql = "state = 8 and is_del=0 and jj_id is not null";

        $list = M("travel")->where($sql)->select();

        foreach ($list as $v) {
            if (!empty($v["jj_id"])) {
                //获取订单信息
                $data = "token=" . $token . "&order_id=" . $v["jj_id"];
//                $res  = httpFF("http://api.99huaan.com/passenger/order/result", "", $data, "POST");
                $res = httpFF("192.168.1.247:8080/order/result", "", $data, "POST");
                $res = json_decode($res, true);

                if ($res["result"] == 0) {
                    continue;
                }

                $res = $res["data"];
                if ($res["status"] != 8) {
                    continue;
                }

                //更新状态
                $save["state"]             = 9;
                $save["end_use_car_time"]  = time();
                $save["pay_type"]          = $res["payment_type"] == 1 ? "签单" : "垫付";
                $save["mileage"]           = $res["distance"];
                $save["fees_sum"]          = $res["road_money"];
                $save["parking_rate_sum"]  = 0;
                $save["service_charge"]    = $res["order_money"];
                $save["driver_cost"]       = 0;
                $save["over_time_cost"]    = 0;
                $save["over_mileage_cost"] = 0;
                $save["else_cost"]         = $res["order_other"];
                $save["totle_rate"]        = $save["fees_sum"] + $save["parking_rate_sum"] + $save["service_charge"] + $save["driver_cost"] + $save["over_time_cost"] + $save["over_mileage_cost"] + $save["else_cost"];

                $rs = M("Travel")->where(array("id" => $v["id"]))->save($save);

                if (false !== $rs) {
                    //记录日志
                    $content = "完成出行订单，出行流水号： " . $v["serial_number"];
                    M("Log")->add(array("user_id"=>0,"do_time"=>time(),"content"=>$content,"type"=>1));

                    //只有需要派车的情况下才释放车辆司机
                    if ($v["is_arrange_car"] == 1 ) {
                        if($v["car_id"]){
                            //释放车辆
                            M("car")->save(array("id" => $v["car_id"], "state" => 1));
                        }
                        if($v["driver_id"]){
                            //释放司机
                            M("driver")->save(array("id" => $v["driver_id"], "state" => 0));
                        }
                    }
                }

            }
        }

    }
}