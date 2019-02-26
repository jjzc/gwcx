<?php
/**
 * Created by PhpStorm.
 * User: MrQ
 * Date: 2018/5/2
 * Time: 21:00
 */

namespace Admin\Controller;

use Model\PayTypeModel;
use Model\SetModel;
use Model\TravelNatureModel;
use Model\TravelTempModel;
use PHPExcel;
use Think\Controller;
use Model\TravelModel;
use Model\TravelTypeModel;
use Model\CarModel;
use Model\DriverModel;
use Model\ArrangeTypeModel;
use Model\UserModel;
use Model\CompanyModel;
use Think\Upload;

class TravelController extends CommonController
{

    public function getNum()
    {
        $travelM         = new TravelModel();
        $waitTravelCount = $travelM->where("state=1 and is_del=0")->count();
        $data["num1"]    = $waitTravelCount;

        //获取待派车出行总数
        $waitSendCar  = $travelM->where("state=3 and is_del=0")->count();
        $data["num2"] = $waitSendCar;

        $waitStart    = $travelM->where("state=6 and is_del=0")->count();
        $data["num3"] = $waitStart;

        $waitEnd      = $travelM->where("state=8  and is_del=0")->count();
        $data["num4"] = $waitEnd;

        $waitCancel   = $travelM->where("is_need_settlement=1 and is_settlemented=0 and is_del=0 and state=9")->count();
        $data["num5"] = $waitCancel;

        $waitEnd      = $travelM->where("state=10  and is_del=0")->count();
        $data["num6"] = $waitEnd;

        $this->ajaxReturn($data);
    }


    //代办事项，也就是工作台
    public function backlogTravel()
    {
        $this->display();
    }


    private function getAllInfo($res)
    {
        for ($i = 0; $i < count($res) && count($res) != 0; $i++) {
            //获取出行类型信息
            $traverType                  = M("TravelType")->find($res[$i]["travel_type_id"]);
            $res[$i]["travel_type_name"] = $traverType["travel_name"];

            //获取出行人信息
            $userM                = new UserModel();
            $user                 = $userM->find($res[$i]["use_user_id"]);
            $res[$i]["user_name"] = $user["user_name"];

            //获取出行人单位信息
            $companyM                = new CompanyModel();
            $company                 = $companyM->find($user["user_company"]);
            $res[$i]["user_company"] = $company["company_name"];


            if ($res[$i]["driver_id"] != "" && $res[$i]["driver_id"] != null) {
                $driver                 = M("Driver")->find($res[$i]["driver_id"]);
                $res[$i]["driver_name"] = $driver["driver_name"];

            }
            if ($res[$i]["car_id"] != "" && $res[$i]["car_id"] != null) {
                $car                = M("Car")->find($res[$i]["car_id"]);
                $res[$i]["car_num"] = $car["car_num"];
            }


        }


        return $res;
    }

    //后台获取待审核出行
    public function getCenterReviewTravels()
    {
        //dump($_POST);
        $sql = "state=1 and is_need_center_review=1 and is_del=0";
        if (!empty($_POST["search"]["value"])) {
            $key = trim($_POST["search"]["value"]);

            $company_ids = M("company")->where(array("company_name" => array("like", "%$key%")))->field("id")->select();

            $company_ids = $company_ids ? $this->_array_column($company_ids, "id") : [0];

            $sql .= " and ( serial_number like '%$key%' or user_name like '%$key%' or company_id in (" . implode(",", $company_ids) . ") )";
        }
        //获取记录集总数
        $resCount = M("Travel")->where($sql)->select();

        $res = M("Travel")->where($sql)->limit($_POST["start"], $_POST["length"])->select();

        //返回数据
        $travels                    = array();
        $travels["draw"]            = $_POST["draw"];
        $travels["recordsTotal"]    = count($resCount);//总记录条数
        $travels["recordsFiltered"] = count($resCount);//过滤后的记录数，也就是搜索结果数据
        $travels["data"]            = $this->getAllInfo($res);

        $this->ajaxReturn($travels);
    }


    //审核出行操作
    public function reviewTravel()
    {
        if (empty($_POST)) {
            $this->ajaxReturn(array("code" => 0, "error" => "非法操作"));
        } else {
            //同意审核操作
            if ($_POST["type"] == 1) {

                //状态判断
                $travel = M("Travel")->find($_POST["id"]);

                //若果是申请的定向出行
                if ($travel["is_dx"] == 1) {
                    //检查是否需要派车审核
                    if ($travel["sendcar_review_res"] == 1) {
                        $travel["state"] = 5;
                    } else {
                        $travel["state"] = 6;

                        //将司机设置为有任务，将车辆设置为有任务
                        //锁定车辆
                        $carM = new CarModel();
                        $data = array(
                            "id"    => $travel["car_id"],
                            "state" => 3
                        );
                        $carM->save($data);


                        //锁定司机
                        $driverM = new DriverModel();
                        $data    = array(
                            "id"    => $travel["driver_id"],
                            "state" => 3
                        );
                        $driverM->save($data);

                    }

                    $travel["center_res"]  = 1;
                    $travel["center_time"] = time();

                    $res = M("Travel")->save($travel);
                    if ($res) {
                        A("UserCenter")->logCreatWeb("审核通过，出行流水号： " . $travel["serial_number"]);
                        $this->ajaxReturn(array("code" => 1));
                    } else {
                        $this->ajaxReturn(array("code" => 0, "error" => "操作失败"));
                    }

                } else {
                    //若果不是定向出行
                    if ($travel["is_arrange_car"] == 0) {
                        if ($_POST["is_need_receipt"] == 1) {
                            $travel["state"] = 10;
                        } else {
                            $travel["state"] = 11;
                        }
                    } else {
                        $travel["state"] = 3;
                    }
                    //其他参数设置
                    $travel["center_res"]  = 1;
                    $travel["center_time"] = time();

                    $res = M("Travel")->save($travel);
                    if ($res) {
                        A("UserCenter")->logCreatWeb("审核通过，出行流水号： " . $travel["serial_number"]);
                        $this->ajaxReturn(array("code" => 1));
                    } else {
                        $this->ajaxReturn(array("code" => 0, "error" => "操作失败"));
                    }
                }

            } else {
                //驳回申请操作
                $travel          = M("Travel")->find($_POST["id"]);
                $travel["state"] = 4;
                //其他参数设置
                $travel["center_res"]       = 0;
                $travel["center_time"]      = time();
                $travel["center_error_msg"] = $_POST["center_error_msg"];

                $res = M("Travel")->save($travel);
                if ($res) {
                    A("UserCenter")->logCreatWeb("审核驳回，出行流水号： " . $travel["serial_number"]);
                    $this->ajaxReturn(array("code" => 1));
                } else {
                    $this->ajaxReturn(array("code" => 0, "error" => "操作失败"));
                }
            }
        }
    }

    //获取待派车出行
    public function getWaitSendCarTravels()
    {
        //dump($_POST);
        $sql = "state=3 and is_need_center_review=1 and is_del=0";
        if (!empty($_POST["search"]["value"])) {

            $key = trim($_POST["search"]["value"]);

            $company_ids = M("company")->where(array("company_name" => array("like", "%$key%")))->field("id")->select();

            $company_ids = $company_ids ? $this->_array_column($company_ids, "id") : [0];

            $sql .= " and ( serial_number like '%$key%' or user_name like '%$key%' or company_id in (" . implode(",", $company_ids) . ") )";
        }
        //获取记录集总数
        $resCount = M("Travel")->where($sql)->select();

        $res = M("Travel")->where($sql)->limit($_POST["start"], $_POST["length"])->select();

        //返回数据
        $travels                    = array();
        $travels["draw"]            = $_POST["draw"];
        $travels["recordsTotal"]    = count($resCount);//总记录条数
        $travels["recordsFiltered"] = count($resCount);//过滤后的记录数，也就是搜索结果数据
        $travels["data"]            = $this->getAllInfo($res);

        $this->ajaxReturn($travels);

    }





    //派车完之后，有可能有审核的流程
    //如果状态为5，则需要派车完之后还要审核
    public function getWaitReviewSendCar()
    {
        $sql = "state=5 and is_need_center_review=1 and is_del=0";
        if (!empty($_POST["search"]["value"])) {
            $key = trim($_POST["search"]["value"]);

            $company_ids = M("company")->where(array("company_name" => array("like", "%$key%")))->field("id")->select();

            $company_ids = $company_ids ? $this->_array_column($company_ids, "id") : [0];

            $sql .= " and ( serial_number like '%$key%' or user_name like '%$key%' or jj_driver_name like '%$key%' or company_id in (" . implode(",", $company_ids) . ") )";
        }
        $resCount = M("Travel")->where($sql)->select();

        $res = M("Travel")->where($sql)->limit($_POST["start"], $_POST["length"])->select();


        //返回数据
        $travels                    = array();
        $travels["draw"]            = $_POST["draw"];
        $travels["recordsTotal"]    = count($resCount);//总记录条数
        $travels["recordsFiltered"] = count($resCount);//过滤后的记录数，也就是搜索结果数据
        $travels["data"]            = $this->getAllInfo($res);

        $this->ajaxReturn($travels);

    }

    //获取待出车出行
    public function getWaitStartCarTravels()
    {
        //dump($_POST);
        $sql = "state = 6 and is_del=0";
        if (!empty($_POST["search"]["value"])) {
            $key = trim($_POST["search"]["value"]);

            $company_ids = M("company")->where(array("company_name" => array("like", "%$key%")))->field("id")->select();

            $company_ids = $company_ids ? $this->_array_column($company_ids, "id") : [0];

            $sql .= " and ( serial_number like '%$key%' or user_name like '%$key%' or jj_driver_name like '%$key%' or company_id in (" . implode(",", $company_ids) . ") )";

        }
        //获取记录集总数
        $resCount = M("Travel")->where($sql)->select();

        $res = M("Travel")->where($sql)->limit($_POST["start"], $_POST["length"])->select();


        //返回数据
        $travels                    = array();
        $travels["draw"]            = $_POST["draw"];
        $travels["recordsTotal"]    = count($resCount);//总记录条数
        $travels["recordsFiltered"] = count($resCount);//过滤后的记录数，也就是搜索结果数据
        $travels["data"]            = $this->getAllInfo($res);

        $this->ajaxReturn($travels);
    }

    //获取待完成出车出行
    public function getWaitFinishTravels()
    {
        $sql = "state = 8 and is_del=0";
        if (!empty($_POST["search"])) {
            $key         = trim($_POST["search"]["value"]);
            $company_ids = M("company")->where(array("company_name" => array("like", "%$key%")))->field("id")->select();

            $company_ids = $company_ids ? $this->_array_column($company_ids, "id") : [0];

            $sql .= " and ( serial_number like '%$key%' or user_name like '%$key%' or jj_driver_name like '%$key%' or company_id in (" . implode(",", $company_ids) . ") ) ";
        }
        $resCount = M("Travel")->where($sql)->select();

        $res = M("Travel")->where($sql)->order("id desc")->limit($_POST["start"], $_POST["length"])->select();

        //返回数据
        $travels                    = array();
        $travels["draw"]            = $_POST["draw"];
        $travels["recordsTotal"]    = count($resCount);//总记录条数
        $travels["recordsFiltered"] = count($resCount);//过滤后的记录数，也就是搜索结果数据
        $travels["data"]            = $this->getAllInfo($res);

        $this->ajaxReturn($travels);
    }


    public function getFinishNow()
    {
        $map['is_del']           = array('eq', 0);
        $map['state']            = array('eq', 9);
        $startTime               = strtotime(date("y-m-d", time()));
        $map["end_use_car_time"] = array('between', array($startTime, $startTime + 24 * 3600));


        $resCount = M("Travel")->where($map)->select();

        $res = M("Travel")->where($map)->limit($_POST["start"], $_POST["length"])->select();


        //返回数据
        $travels                    = array();
        $travels["draw"]            = $_POST["draw"];
        $travels["recordsTotal"]    = count($resCount);//总记录条数
        $travels["recordsFiltered"] = count($resCount);//过滤后的记录数，也就是搜索结果数据
        $travels["data"]            = $this->getAllInfo($res);

        $this->ajaxReturn($travels);
    }


    //获取待取消操作的出行
    public function getWaitCancelTravels()
    {
        $resCount = M("Travel")->where("state=10 and is_del=0")->select();

        $res = M("Travel")->where("state=10 and is_del=0")->limit($_POST["start"], $_POST["length"])->select();

        //返回数据
        $travels                    = array();
        $travels["draw"]            = $_POST["draw"];
        $travels["recordsTotal"]    = count($resCount);//总记录条数
        $travels["recordsFiltered"] = count($resCount);//过滤后的记录数，也就是搜索结果数据
        $travels["data"]            = $this->getAllInfo($res);

        $this->ajaxReturn($travels);
    }

    public function cancelTravelDo()
    {
        $travel["id"] = I("post.id");
        if ($_POST["type"] == 1) {
            $travel["state"] = 11;
        } else {
            $travel["state"]      = $travel["old_state"];
            $travel["cancel_res"] = $_POST["cancel_res"];
        }

        $res = M("Travel")->save($travel);
        if ($res) {
            A("UserCenter")->logCreatWeb("取消出行，出行流水号： " . $travel["serial_number"]);
            $this->ajaxReturn(array("code" => 1));
        } else {
            $this->ajaxReturn(array("code" => 0));
        }
    }

    public function sendCarReviewDo()
    {
        $travel["id"] = $_POST["id"];
        if ($_POST["type"] == 1) {
            $travel["state"]              = 6;
            $travel["sendcar_review_res"] = 1;
        } else {
            $travel["state"]              = 7;
            $travel["sendcar_review_res"] = 0;
            $travel["sendcar_review_msg"] = $_POST["cancel_res"];
        }
        $travel["sendcar_review_time"] = time();

        $res = M("Travel")->save($travel);
        if ($res) {
            A("UserCenter")->logCreatWeb("派车审核" . $_POST["type"] == 1 ? "通过" : "驳回" . "，出行流水号： " . $travel["serial_number"]);
            $this->ajaxReturn(array("code" => 1));
        } else {
            $this->ajaxReturn(array("code" => 0));
        }
    }


    public function allTravels()
    {
        //获取所有单位
        $companys = M("company")->where("is_del=0")->select();
        $this->assign("companys", $companys);
        //获取所有司机
        $drivers = M("driver")->where("is_del=0")->select();
        $this->assign("drivers", $drivers);
        //获取所有车辆
        $cars = M("car")->where("is_del=0")->select();
        $this->assign("cars", $cars);


        $this->display();
    }

    public function getAllTravels()
    {

        //获取筛选条件
        $map["is_del"] = array('eq', 0);

        if (!empty($_POST["searchKey"])) {
//            $key        = trim($_POST["searchKey"]);
//            $search_sql = "serial_number like '%$key%' or from_place like '%$key%' or to_place like '%$key%'";
//            $company    = M("company")->where(array("is_del" => 0, "company_name" => array("like", "%" . $key . "%")))->field("id")->select();
//            if ($company) {
//                $search_sql .= " or company_id in (" . implode(",", $this->_array_column($company, "id")) . ")";
//            }
//            $map["_string"] = $search_sql;
            $map['serial_number|from_place|to_place'] = array("like","%".trim($_POST["searchKey"])."%");
        }
        if (!empty($_POST["startTime"])) {
            $map['departure_time'] = array('gt', strtotime($_POST["startTime"]));
        }
        if (!empty($_POST["endTime"])) {
            $map['departure_time'] = array('elt', strtotime($_POST["endTime"]) + 24 * 3600);
        }

        if ((!empty($_POST["startTime"])) && !empty($_POST["endTime"])) {
            $map['departure_time'] = array('between', array(strtotime($_POST["startTime"]), strtotime($_POST["endTime"]) + 24 * 3600));
        }

        if ($_POST["company"] != 0) {
            $map['company_id'] = array('eq', $_POST["company"]);
        }
        if ($_POST["car"] != 0) {
            $map['car_id'] = array('eq', $_POST["car"]);
        }
        if ($_POST["driver"] != 0) {
            $map['driver_id'] = array('eq', $_POST["driver"]);
        }
        if ($_POST["state"] != "all") {
            $map['state'] = array('eq', $_POST["state"]);
        }

        $resCount = M("Travel")->where($map)->select();

        $res = M("Travel")->where($map)->order("id desc")->limit($_POST["start"], $_POST["length"])->select();

        //返回数据
        $travels                    = array();
        $travels["draw"]            = $_POST["draw"];
        $travels["recordsTotal"]    = count($resCount);//总记录条数
        $travels["recordsFiltered"] = count($resCount);//过滤后的记录数，也就是搜索结果数据
        $travels["data"]            = $this->getAllInfo($res);

        $this->ajaxReturn($travels);
    }

    public function getWaitChargingTravels()
    {
        $sql = "is_need_settlement=1 and is_settlemented=0 and is_del=0 and state=9 ";
        if (!empty($_POST["search"])) {
            $key = trim($_POST["search"]["value"]);
            $sql .= " and ( serial_number like '%$key%' or user_name like '%$key%' )";
        }

        $resCount = M("Travel")->where($sql)->select();

        $res = M("Travel")->where($sql)->limit($_POST["start"], $_POST["length"])->select();

        //返回数据
        $travels                    = array();
        $travels["draw"]            = $_POST["draw"];
        $travels["recordsTotal"]    = count($resCount);//总记录条数
        $travels["recordsFiltered"] = count($resCount);//过滤后的记录数，也就是搜索结果数据
        $travels["data"]            = $this->getAllInfo($res);

        $this->ajaxReturn($travels);
    }

    public function delTravel()
    {
        $data["id"]     = $_POST["id"];
        $data["is_del"] = 1;
        $res            = M("Travel")->save($data);
        if ($res) {
            $travel = M("Travel")->find($data["id"]);
            A("UserCenter")->logCreatWeb("删除出行，出行流水号： " . $travel["serial_number"]);
            $this->ajaxReturn(array("code" => 1));
        } else {
            $this->ajaxReturn(array("code" => 0));
        }
    }

    public function toExcel_bak()
    {
        //dump($_POST);
        //获取筛选条件
        $map["is_del"] = array('eq', 0);
        if (!empty($_POST["startTime"])) {
            $map['departure_time'] = array('gt', strtotime($_POST["startTime"]));
        }
        if (!empty($_POST["endTime"])) {
            $map['departure_time'] = array('elt', strtotime($_POST["endTime"]) + 24 * 3600);
        }
        if ((!empty($_POST["startTime"])) && !empty($_POST["endTime"])) {
            $map['departure_time'] = array('between', array(strtotime($_POST["startTime"]), strtotime($_POST["endTime"]) + 24 * 3600));
        }
        if ($_POST["company"] != 0) {
            $map['company_id'] = array('eq', $_POST["company"]);
        }
        if ($_POST["car"] != 0) {
            $map['car_id'] = array('eq', $_POST["car"]);
        }
        if ($_POST["driver"] != 0) {
            $map['driver_id'] = array('eq', $_POST["driver"]);
        }
        if ($_POST["state"] != "all") {
            $map['state'] = array('eq', $_POST["state"]);
        }


        $res = M("Travel")->where($map)->order("id asc")->select();

        R('Admin/Statistics/travelToExcel', array($res));

    }

    public function toExcel($page = 1)
    {

        //获取筛选条件
        $map["is_del"] = array('eq', 0);

        if (!empty($_POST["searchKey"])) {
//            $key        = trim($_POST["searchKey"]);
//            $search_sql = "serial_number like '%$key%' or from_place like '%$key%' or to_place like '%$key%'";
//            $map["_string"] = $search_sql;
            $map['serial_number|from_place|to_place'] = array("like","%".trim($_POST["searchKey"])."%");
        }

        if (!empty($_POST["startTime"])) {
            $map['departure_time'] = array('gt', strtotime($_POST["startTime"]));
        }
        if (!empty($_POST["endTime"])) {
            $map['departure_time'] = array('elt', strtotime($_POST["endTime"]) + 24 * 3600);
        }
        if ((!empty($_POST["startTime"])) && !empty($_POST["endTime"])) {
            $map['departure_time'] = array('between', array(strtotime($_POST["startTime"]), strtotime($_POST["endTime"]) + 24 * 3600));
        }
        if ($_POST["company"] != 0) {
            $map['company_id'] = array('eq', $_POST["company"]);
        }
        if ($_POST["car"] != 0) {
            $map['car_id'] = array('eq', $_POST["car"]);
        }
        if ($_POST["driver"] != 0) {
            $map['driver_id'] = array('eq', $_POST["driver"]);
        }
        if ($_POST["state"] != "all") {
            $map['state'] = array('eq', $_POST["state"]);
        }

        $list = M("travel")->where($map)->limit((($page - 1) * 1000) . ",1000 ")->order("id desc")->select();
        if ($list) {
            register_shutdown_function(array(&$this, 'toExcel'), $page + 1);

            //导出数据
            header("Content-Type: text/html; charset=gbk");
            header("Content-type:application/vnd.ms-excel");
            $excel_name = "全部出行";
            header("Content-Disposition:filename=" . iconv("UTF-8", "GBK", $excel_name) . ".csv");
            $fp = fopen('php://output', 'a');

            if ($page == 1) {
                $column_name = array("流水号", "出车单号", "是否销单", "申请人", "用车人", "出发地", "目的地", "预约时间", "乘车人数", "乘车人", "出行事由", "出行性质", "出行类型", "第三方用车单位", "车牌号", "驾驶员", "单位审核结果",
                    "单位驳回原因", "单位审核时间", "中心审核结果", "中心驳回原因", "中心审核时间", "派车时间", "出车时间", "完成出行时间", "提交时间", "取消出行原因", "申请取消时间", "开始用车时间", "结束用车时间", "开始公里数", "结束公里数",
                    "行驶里程", "路桥费单据张数", "路桥费总金额", "停车费单据张数", "停车费单据总金额", "出行服务费", "司机住宿等花费", "超时费", "超公里费", "其他费用", "总金额", "服务评分", "评价", "支付方式", "申请单位");
                foreach ($column_name as $i => $v) {
                    $column_name[$i] = iconv('utf-8', 'GB18030', $v);
                }
                fputcsv($fp, $column_name);
            }

            $travelTypeM   = new TravelTypeModel();
            $driverM       = new DriverModel();
            $companyM      = new CompanyModel();
            $carM          = new CarModel();
            $userM         = new UserModel();
            $arrange_typeM = new ArrangeTypeModel();

            foreach ($list as $k => $v) {
                //获取出行人信息
                $user = $userM->find($v["user_id"]);
                //用车人信息
                $use_user = $userM->find($v["use_user_id"]);
                //出行类型
                $traverType = $travelTypeM->find($v["travel_type_id"]);
                //第三方用车单位
                if (isset($v["arrange_type_id"]) && $v["arrange_type_id"]) {
                    $arrange_type = $arrange_typeM->find($v["arrange_type_id"]);
                    $arrange_name = $arrange_type["arrange_name"];
                } else {
                    $arrange_name = "";
                }
                //车牌号
                $car = $carM->find($v["car_id"]);
                //司机
                $driver = $driverM->find($v["driver_id"]);
                //单位
                $company = $companyM->find($user["user_company"]);

                $data   = array();
                $data[] = iconv('utf-8', 'GB18030', '"' . $v['serial_number'] . '"');
                $data[] = iconv('utf-8', 'GB18030', '"' . $v["dispatch_number"] . '"');
                $data[] = iconv('utf-8', 'GB18030', $v['is_del'] == 0 ? '正常' : '已销单');
                $data[] = iconv('utf-8', 'GB18030', $user["user_name"]);
                $data[] = iconv('utf-8', 'GB18030', $use_user["user_name"]);
                $data[] = iconv('utf-8', 'GB18030', $v['from_place']);
                $data[] = iconv('utf-8', 'GB18030', $v['to_place']);
                $data[] = iconv('utf-8', 'GB18030', $v['departure_time'] ? date('Y-m-d', $v['departure_time']) : '');
                $data[] = iconv('utf-8', 'GB18030', $v['people_num']);
                $data[] = iconv('utf-8', 'GB18030', $v['travel_people']);
                $data[] = iconv('utf-8', 'GB18030', $v['travel_reason']);
                $data[] = iconv('utf-8', 'GB18030', $v['travel_nature']);
                $data[] = iconv('utf-8', 'GB18030', $traverType["travel_name"]);
                $data[] = iconv('utf-8', 'GB18030', $arrange_name);
                $data[] = iconv('utf-8', 'GB18030', $car["car_num"]);
                $data[] = iconv('utf-8', 'GB18030', $driver["driver_name"]);
                $data[] = iconv('utf-8', 'GB18030', isset($v["manage_res"]) ? ($v["manage_res"] == 0 ? '驳回' : '通过') : '未填写');
                $data[] = iconv('utf-8', 'GB18030', $v['manage_error_msg']);
                $data[] = iconv('utf-8', 'GB18030', $v['manage_time'] ? date('Y-m-d', $v['manage_time']) : '');
                $data[] = iconv('utf-8', 'GB18030', isset($v["center_res"]) ? ($v["center_res"] == 0 ? '驳回' : '通过') : '未填写');
                $data[] = iconv('utf-8', 'GB18030', $v['center_error_msg']);
                $data[] = iconv('utf-8', 'GB18030', $v['center_time'] ? date('Y-m-d', $v['center_time']) : '');
                $data[] = iconv('utf-8', 'GB18030', $v['send_car_time'] ? date('Y-m-d', $v['send_car_time']) : '');
                $data[] = iconv('utf-8', 'GB18030', $v['start_car_time'] ? date('Y-m-d', $v['start_car_time']) : '');
                $data[] = iconv('utf-8', 'GB18030', $v['finish_time'] ? date('Y-m-d', $v['finish_time']) : '');
                $data[] = iconv('utf-8', 'GB18030', $v['sign_time'] ? date('Y-m-d', $v['sign_time']) : '');
                $data[] = iconv('utf-8', 'GB18030', $v['cancel_reason']);
                $data[] = iconv('utf-8', 'GB18030', $v['cancel_time'] ? date('Y-m-d', $v['cancel_time']) : '');
                $data[] = iconv('utf-8', 'GB18030', $v['start_use_car_time'] ? date('Y-m-d', $v['start_use_car_time']) : '');
                $data[] = iconv('utf-8', 'GB18030', $v['end_use_car_time'] ? date('Y-m-d', $v['end_use_car_time']) : '');
                $data[] = iconv('utf-8', 'GB18030', $v['start_kilometers']);
                $data[] = iconv('utf-8', 'GB18030', $v['end_kilometers']);
                $data[] = iconv('utf-8', 'GB18030', $v['mileage']);
                $data[] = iconv('utf-8', 'GB18030', $v['fees_num']);
                $data[] = iconv('utf-8', 'GB18030', $v['fees_sum']);
                $data[] = iconv('utf-8', 'GB18030', $v['parking_rate_num']);
                $data[] = iconv('utf-8', 'GB18030', $v['parking_rate_sum']);
                $data[] = iconv('utf-8', 'GB18030', $v['service_charge']);
                $data[] = iconv('utf-8', 'GB18030', $v['driver_cost']);
                $data[] = iconv('utf-8', 'GB18030', $v['over_time_cost']);
                $data[] = iconv('utf-8', 'GB18030', $v['over_mileage_cost']);
                $data[] = iconv('utf-8', 'GB18030', $v['else_cost']);
                $data[] = iconv('utf-8', 'GB18030', $v['totle_rate']);
                $data[] = iconv('utf-8', 'GB18030', $v['attitude']);
                $data[] = iconv('utf-8', 'GB18030', $v['evaluate']);
                $data[] = iconv('utf-8', 'GB18030', $v['pay_type']);
                $data[] = iconv('utf-8', 'GB18030', $company["company_name"]);
                fputcsv($fp, $data);
            }
            unset($list);
            ob_flush();
            flush();
        } else {
            if ($page == 1)
                $this->ajaxReturn(array("error" => "NullData"));
            exit();
        }


    }

    public function recycleTravels()
    {
        $this->display();
    }

    public function getRecycleTravels()
    {
        $resCount = M("Travel")->where("is_del=1")->select();

        $res = M("Travel")->where("is_del=1")->order("id desc")->limit($_POST["start"], $_POST["length"])->select();

        //返回数据
        $travels                    = array();
        $travels["draw"]            = $_POST["draw"];
        $travels["recordsTotal"]    = count($resCount);//总记录条数
        $travels["recordsFiltered"] = count($resCount);//过滤后的记录数，也就是搜索结果数据
        $travels["data"]            = $res;

        $this->ajaxReturn($travels);
    }

    /*
     * 派车
     */
    public function sendCar($id)
    {
        //先获取出行详情
        $travel = M("Travel")->find($id);
        $this->assign("travel", $travel);

        //先获取所有的车辆类型
        $carTypes = M("CarType")->select();
        $this->assign("carTypes", $carTypes);

        //获取所有司机
        $drivers = M("Driver")->where("is_del=0")->select();
        $this->assign("drivers", $drivers);

        $this->display();

    }

    /*
     * 改派车辆或者司机
     */
    public function reassignment($id)
    {
        $travel = M("Travel")->find($id);
        $this->assign("travel", $travel);


        //获取所有的非定向司机
        //获取所有状态为1车辆，跟当前车辆
        $carM = new CarModel();

        $cars = $carM->where("(is_del=0 and state = 1 and is_dx=0) or id=" . $travel["car_id"])->select();
        $this->assign("cars", $cars);

        //获取所有的非定向车辆
        //获取所有状态为0的司机，跟当前司机
        $driverM = new DriverModel();
        $drivers = $driverM->where("(is_del=0 and state = 0 and is_dx=0) or id=" . $travel["driver_id"])->select();
        $this->assign("drivers", $drivers);

        $this->display();

    }

    /*
     * 改派车辆与司机具体数据操作
     */
    public function reassignmentDo()
    {
        $id        = $_POST["id"];
        $travel_id = $id;
        //先查询数据
        $travelM = new TravelModel();
        $travel  = $travelM->find($travel_id);

        //如果没有发生改变，则直接重定向
        if ($_POST["car_id"] == $travel["car_id"] && $_POST["driver_id"] == $travel["driver_id"]) {
            //$this->redirect("waitStart");
            $this->ajaxReturn(array("code" => 0));
        }

        //如果只更换了车辆，则只需发送短信给司机换车了，发送短信给用户，换了车
        //如果只更换了司机，或者司机车辆全部都换了，则只需发送短信给之前的司机订单取消了，发送短信给新司机有新任务了，发送短信给用户换了司机
        if ($_POST["car_id"] != $travel["car_id"] && $_POST["driver_id"] == $travel["driver_id"]) {
            //将原有的车辆状态改为1
            $carM            = new CarModel();
            $oldCar          = $carM->find($travel["car_id"]);
            $oldCar["state"] = 1;
            $carM->save($oldCar);
            //将新车辆状态改为3
            $newCar          = $carM->find($_POST["car_id"]);
            $newCar["state"] = 3;
            $carM->save($newCar);

            //保存到出行中
            $travel["car_id"] = $_POST["car_id"];
            $travelM->save($travel);

            //
            $driverM = new DriverModel();
            $driver  = $driverM->find($travel["driver_id"]);

            $userM = new UserModel();
            $user  = $userM->find($travel["user_id"]);

            //短信通知用户
            $systemC = new SystemController();
            $systemC->reassignmentCarUser($user["user_phone"], $travel);
            if ($travel["user_id"] != $travel["use_user_id"]) {
                $use_user = $userM->find($travel["use_user_id"]);
                $systemC->reassignmentCarUser($use_user["user_phone"], $travel);
            }

            //短信通知司机
            $systemC->reassignmentCarDriver($driver["driver_phone"], $travel);

            A("UserCenter")->logCreatWeb("改派出行，出行流水号： " . $travel["serial_number"]);

            $this->ajaxReturn(array("code" => 1));
        } else {
            //将原有的车辆状态改为1
            $carM            = new CarModel();
            $oldCar          = $carM->find($travel["car_id"]);
            $oldCar["state"] = 1;
            $carM->save($oldCar);
            //将新车辆状态改为3
            $newCar          = $carM->find($_POST["car_id"]);
            $newCar["state"] = 3;
            $carM->save($newCar);

            //将原有的司机状态改为0
            $driverM            = new DriverModel();
            $oldDriver          = $driverM->find($travel["driver_id"]);
            $oldDriver["state"] = 0;
            $driverM->save($oldDriver);

            //将新司机状态改为3
            $newDriver          = $driverM->find($_POST["driver_id"]);
            $newDriver["state"] = 3;
            $driverM->save($newDriver);

            //保存到出行中
            $travel["car_id"]    = $_POST["car_id"];
            $travel["driver_id"] = $_POST["driver_id"];
            $travelM->save($travel);


            $userM = new UserModel();
            $user  = $userM->find($travel["user_id"]);

            //短信通知用户
            $systemC = new SystemController();
            $systemC->reassignmentDriverUser($user["user_phone"], $travel);
            if ($travel["user_id"] != $travel["use_user_id"]) {
                $use_user = $userM->find($travel["use_user_id"]);
                $systemC->reassignmentDriverUser($use_user["user_phone"], $travel);
            }

            //短信通知老司机说明订单取消了
            $systemC->reassignmentDriverOld($oldDriver["driver_phone"], $travel);
            //短信通知新司机说有新订单
            $systemC->sendSendCarOkDriver($newDriver["driver_phone"], $travel);

            A("UserCenter")->logCreatWeb("改派出行，出行流水号： " . $travel["serial_number"]);

            $this->ajaxReturn(array("code" => 1));
        }
    }

    public function getFreeCar()
    {
        $carTypeId = $_POST["type_id"];
        $travel    = M("Travel")->find($_POST["travelId"]);

        //此处需要修改，只调出该单位的定向车辆
        $dxcars = M("Car")->where(array("type_id" => $carTypeId, "state" => 1, "is_del" => 0, "is_dx" => 1, "company_id" => $travel["company_id"]))->order("is_dx desc")->select();

        $cars = M("Car")->where(array("type_id" => $carTypeId, "state" => 1, "is_del" => 0, "is_dx" => 0))->order("is_dx desc")->select();

        $res = array_merge($dxcars, $cars);

//        if(!empty($dxcars)){
//            array_push($cars,$dxcars);
//        }

        $this->ajaxReturn($res);

    }

    public function getFreeDriver()
    {
        $dx = $_POST["dx"];
        if ($dx == 1) {
            $drivers = M("Driver")->where(array("id" => $_POST["driverId"]))->select();
        } else {
            $drivers = M("Driver")->where("is_del=0 and is_dx=0 and state=0")->select();
        }

        $this->ajaxReturn($drivers);
    }

    public function sendCarDo()
    {
        $travel_id = $_POST["id"];

        $travel = M("Travel")->find($_POST["id"]);

        $travelType = M("TravelType")->find($travel["travel_type_id"]);
        if ($travelType["is_need_sendcar_review"] == 1) {
            $state = 5;
        } else {
            $state = 6;
        }


        $data = array(
            "id"            => $_POST["id"],
            "car_type_id"   => $_POST["car_type"],
            "car_id"        => $_POST["car_id"],
            "driver_id"     => $_POST["driver_id"],
            "state"         => $state,
            "send_car_time" => time()
        );

        $travelM = new TravelModel();
        if ($travelM->save($data)) {

            A("UserCenter")->logCreatWeb("派车，出行流水号： " . $travel["serial_number"]);

            $travel = $travelM->find($travel_id);
            //锁定车辆
            $carM = new CarModel();
            $data = array(
                "id"    => $_POST["car_id"],
                "state" => 3
            );
            $carM->save($data);


            $car      = $carM->find($_POST["car_id"]);
            $carsName = $car["car_num"];

            //锁定司机
            $driverM = new DriverModel();
            $data    = array(
                "id"    => $_POST["driver_id"],
                "state" => 3
            );
            $driverM->save($data);

            $driver      = $driverM->find($_POST["driver_id"]);
            $driversName = $driver["driver_name"];


            //获取用户手机号
            $userM = new UserModel();
            $user  = $userM->find($travel["user_id"]);


            //获取派遣的所有司机
            $travel["drivers"]      = $driversName;
            $travel["cars"]         = $carsName;
            $travel["driver_phone"] = $driver["driver_phone"];


            //获取设置信息
            $setM = new SetModel();
            $set  = $setM->find(1);

            //发送短信给用户
            $systemC = new SystemController();

            $systemC->sendSendCarOkUser($user["user_phone"], $travel);

            //发送短信给用车人
            //如果用车人跟申请人不一致时候，则发送短信给用车人一份
            if ($travel["user_id"] != $travel["use_user_id"]) {
                $use_user = $userM->find($travel["use_user_id"]);
                $systemC->sendSendCarOkUser($use_user["user_phone"], $travel);
            }

            //发送短信给司机
            $driver = $driverM->find($_POST["driver_id"]);
            $systemC->sendSendCarOkDriver($driver["driver_phone"], $travel);


            $this->ajaxReturn(array("code" => 1));
        } else {
            $this->ajaxReturn(array("code" => 0));
        }


    }


    public function viewTravel($id)
    {
        $travelM = new TravelModel();
        $travel  = $travelM->find($id);
        $this->assign("travel", $travel);

        //申请人个人信息
        $userM = new UserModel();
        $user  = $userM->find($travel["user_id"]);
        $this->assign("user", $user);

        //申请人列表
        $userM = new UserModel();
        $users = $userM->where("is_del=0")->select();
        $this->assign("users", $users);


        //出行性质
        $travelNatureM = new TravelNatureModel();
        $travel_nature = $travelNatureM->where("is_del=0")->select();
        $this->assign("travel_nature", $travel_nature);

        //出行类型列表
        $travelTypeM  = new TravelTypeModel();
        $travel_types = $travelTypeM->where("is_del=0")->select();
        $this->assign("travel_types", $travel_types);

        //出行类型信息
        $travelTypeM = new TravelTypeModel();
        $travel_type = $travelTypeM->find($travel["travel_type_id"]);
        $this->assign("travel_type", $travel_type);


        //用车人个人信息
        $use_user = $userM->find($travel["use_user_id"]);
        $this->assign("use_user", $use_user);

        //申请人公司信息
        $companyM = new CompanyModel();
        $company  = $companyM->find($travel["company_id"]);
        $this->assign("company", $company);

        //司机信息
//        $driverM=new DriverModel();
//        $driver_name=$driverM->find($travel["driver_id"]);
//        $this->assign("driver",$driver_name);

        //车辆信息
//        $carMM=new CarModel();
//        $car_name=$driverM->find($travel["car_id"]);
//        $this->assign("car",$car_name);

        //需要派车情况下，查询是否已经派车
        $had_send_car = false;
        $is_owner     = false;
        if ($travel["is_arrange_car"] == "1") {
            if (isset($travel["arrange_type_id"]) || isset($travel["car_id"])) {
                $had_send_car = true;

                if (isset($travel["arrange_type_id"])) {
                    //获取第三方公司信息
                    $arrange_typeM = new ArrangeTypeModel();
                    $arrange_type  = $arrange_typeM->find($travel["arrange_type_id"]);
                    $this->assign("arrange_type", $arrange_type);
                } else {
                    $is_owner = true;
                    $carM     = new CarModel();
                    $driverM  = new DriverModel();

                    $car    = $carM->find($travel["car_id"]);
                    $driver = $driverM->find($travel["driver_id"]);

                    $this->assign("car", $car);
                    $this->assign("driver", $driver);
                }
            }
        }
        $this->assign("is_owner", $is_owner);
        $this->assign("had_send_car", $had_send_car);

        //获取出行凭据
        if ($travel["credential"] == "") {
            $this->assign("havadata", 0);
        } else {
            $this->assign("havadata", 1);
        }
        $credentials = explode("|", $travel["credential"]);
        $this->assign("credentials", $credentials);

        //获取所有状态为1车辆
        $carM = new CarModel();
        $cars = $carM->where("is_del=0")->select();
        $this->assign("cars", $cars);

        //获取所有状态为0的司机
        $driverM = new DriverModel();
        $drivers = $driverM->where("is_del=0")->select();
        $this->assign("drivers", $drivers);

        //获取所有第三方出行公司
        $arrange_type  = new ArrangeTypeModel();
        $arrange_types = $arrange_type->select();
        $this->assign("arrange_types", $arrange_types);


        $this->display();
    }

    public function editTravelDo()
    {
        //dump($_POST);
        //计算费用总和
        if ((!is_numeric($_POST["fees_sum"])) || $_POST["fees_sum"] == "") {
            $_POST["fees_sum"] = 0;
        }
        if ((!is_numeric($_POST["parking_rate_sum"])) || $_POST["parking_rate_sum"] == "") {
            $_POST["parking_rate_sum"] = 0;
        }
        if ((!is_numeric($_POST["service_charge"])) || $_POST["service_charge"] == "") {
            $_POST["service_charge"] = 0;
        }
        if ((!is_numeric($_POST["driver_cost"])) || $_POST["driver_cost"] == "") {
            $_POST["driver_cost"] = 0;
        }
        if ((!is_numeric($_POST["over_time_cost"])) || $_POST["over_time_cost"] == "") {
            $_POST["over_time_cost"] = 0;
        }
        if ((!is_numeric($_POST["over_mileage_cost"])) || $_POST["over_mileage_cost"] == "") {
            $_POST["over_mileage_cost"] = 0;
        }
        if ((!is_numeric($_POST["else_cost"])) || $_POST["else_cost"] == "") {
            $_POST["else_cost"] = 0;
        }

        if ((!is_numeric($_POST["driver_bt_cost"])) || $_POST["driver_bt_cost"] == "") {
            $_POST["driver_bt_cost"] = 0;
        }

        $_POST["totle_rate"] = $_POST["fees_sum"] + $_POST["parking_rate_sum"] + $_POST["service_charge"] + $_POST["driver_cost"] + $_POST["over_time_cost"] + $_POST["over_mileage_cost"] + $_POST["else_cost"] + $_POST["driver_bt_cost"];


        $_POST["departure_time"]   = strtotime($_POST["departure_time"]);    //转换成时间戳格式
        $_POST["collecting_time"]  = strtotime($_POST["collecting_time"]);
        $_POST["start_car_time"]   = strtotime($_POST["start_car_time"]);    //转换成时间戳格式
        $_POST["end_use_car_time"] = strtotime($_POST["end_use_car_time"]);
        $_POST["sign_time"]        = strtotime($_POST["sign_time"]);


        $res = M("Travel")->save($_POST);

        if ($res) {
            $travel = M("Travel")->find($_POST["id"]);
            A("UserCenter")->logCreatWeb("修改出行订单，出行流水号： " . $travel["serial_number"]);
            $this->ajaxReturn(array("code" => 1));
        } else {
            $this->ajaxReturn(array("code" => 0));
        }
    }


    public function startCar()
    {
        $travel["id"]             = $_POST["id"];
        $travel["state"]          = 8;
        $travel["start_car_time"] = time();

        $res = M("Travel")->save($travel);

        if ($res) {
            $this->ajaxReturn(array("code" => 1));
        } else {
            $this->ajaxReturn(array("code" => 0));
        }
    }

    public function finishTravel($id)
    {
        //先获取出行详情
        $travel = M("Travel")->find($id);
        $this->assign("travel", $travel);

        $pay_typeM = new PayTypeModel();
        $pay_types = $pay_typeM->select();
        $this->assign("pay_types", $pay_types);

        $this->display();
    }

    public function finishTravelDo()
    {

        $_POST["state"] = 9;
        //dump($_POST);exit();

        //处理POST过来的数据

        //$_POST["start_use_car_time"]=strtotime($_POST["start_use_car_time"]);
        $_POST["end_use_car_time"] = time();

        //$_POST["finish_time"]=time();
        //$_POST["mileage"]=$_POST["end_kilometers"]-$_POST["start_kilometers"];

        if ((!is_numeric($_POST["fees_sum"])) || $_POST["fees_sum"] == "") {
            $_POST["fees_sum"] = 0;
        }
        if ((!is_numeric($_POST["parking_rate_sum"])) || $_POST["parking_rate_sum"] == "") {
            $_POST["parking_rate_sum"] = 0;
        }
        if ((!is_numeric($_POST["service_charge"])) || $_POST["service_charge"] == "") {
            $_POST["service_charge"] = 0;
        }
        if ((!is_numeric($_POST["driver_cost"])) || $_POST["driver_cost"] == "") {
            $_POST["driver_cost"] = 0;
        }
        if ((!is_numeric($_POST["over_time_cost"])) || $_POST["over_time_cost"] == "") {
            $_POST["over_time_cost"] = 0;
        }
        if ((!is_numeric($_POST["over_mileage_cost"])) || $_POST["over_mileage_cost"] == "") {
            $_POST["over_mileage_cost"] = 0;
        }
        if ((!is_numeric($_POST["else_cost"])) || $_POST["else_cost"] == "") {
            $_POST["else_cost"] = 0;
        }

        $_POST["totle_rate"] = $_POST["fees_sum"] + $_POST["parking_rate_sum"] + $_POST["service_charge"] + $_POST["driver_cost"] + $_POST["over_time_cost"] + $_POST["over_mileage_cost"] + $_POST["else_cost"];

        $travelM = new TravelModel();
        if ($travelM->save($_POST)) {

            $travel = $travelM->find($_POST["id"]);

            A("UserCenter")->logCreatWeb("完成出行订单，出行流水号： " . $travel["serial_number"]);

            //只有需要派车的情况下才释放车辆司机
            if ($travel["is_arrange_car"] == 1) {

                if ($travel["car_id"] && $travel["driver_id"]) {
                    //释放车辆
                    $carM = new CarModel();
                    $data = array(
                        "id"    => $travel["car_id"],
                        "state" => 1
                    );
                    $carM->save($data);

                    //释放司机
                    $driverM = new DriverModel();
                    $data    = array(
                        "id"    => $travel["driver_id"],
                        "state" => 0
                    );
                    $driverM->save($data);
                }
            }
            $this->ajaxReturn(array("code" => 1));
        }
    }


    /*
     * 核算费用页面展示
     */
    public function chargingTravel($id)
    {
        //先获取出行详情
        $travel = M("Travel")->find($id);
        $this->assign("travel", $travel);

        $pay_typeM = new PayTypeModel();
        $pay_types = $pay_typeM->select();
        $this->assign("pay_types", $pay_types);

        //获取这个车辆类型的所有计价方式
        $chargings = M("Charging")->order("car_type_id asc, type asc,start_time asc")->select();
        for ($i = 0; $i < count($chargings) && count($chargings) != 0; $i++) {
            $carType                    = M("CarType")->find($chargings[$i]["car_type_id"]);
            $chargings[$i]["type_name"] = $carType["type_name"];
        }
        $this->assign("chargings", $chargings);

        $bt_types = M("SubsidyType")->select();
        $this->assign("bt_types", $bt_types);


        $this->display();
    }


    public function chargingTravelDo()
    {
        if ((!is_numeric($_POST["fees_sum"])) || $_POST["fees_sum"] == "") {
            $_POST["fees_sum"] = 0;
        }
        if ((!is_numeric($_POST["parking_rate_sum"])) || $_POST["parking_rate_sum"] == "") {
            $_POST["parking_rate_sum"] = 0;
        }
        if ((!is_numeric($_POST["service_charge"])) || $_POST["service_charge"] == "") {
            $_POST["service_charge"] = 0;
        }
        if ((!is_numeric($_POST["driver_cost"])) || $_POST["driver_cost"] == "") {
            $_POST["driver_cost"] = 0;
        }
        if ((!is_numeric($_POST["over_time_cost"])) || $_POST["over_time_cost"] == "") {
            $_POST["over_time_cost"] = 0;
        }
        if ((!is_numeric($_POST["over_mileage_cost"])) || $_POST["over_mileage_cost"] == "") {
            $_POST["over_mileage_cost"] = 0;
        }

        if ((!is_numeric($_POST["else_cost"])) || $_POST["else_cost"] == "") {
            $_POST["else_cost"] = 0;
        }

        $_POST["totle_rate"] = $_POST["fees_sum"] + $_POST["parking_rate_sum"] + $_POST["service_charge"] + $_POST["driver_cost"] + $_POST["over_time_cost"] + $_POST["over_mileage_cost"] + $_POST["else_cost"] + $_POST["driver_bt_cost"];

        $_POST["is_settlemented"] = 1;

        $travelM = new TravelModel();
        if ($travelM->save($_POST)) {
            $travel = M("Travel")->find($_POST["id"]);
            A("UserCenter")->logCreatWeb("核算费用，出行流水号： " . $travel["serial_number"]);

            $this->ajaxReturn(array("code" => 1));
        } else {
            $this->ajaxReturn(array("code" => 0));
        }
    }


    /*
     * 手工补单页面展示
     */
    public function manualTravels()
    {
        //获取平台名称
        $setM = new SetModel();
        $set  = $setM->find(1);
        $this->assign("set", $set);
        //获取出行方式
        $travel_typeM = new TravelTypeModel();
        $travel_types = $travel_typeM->where("is_del=0")->select();
        $this->assign("travel_types", $travel_types);

        //获取支付方式
        $pay_typeM = new PayTypeModel();
        $pay_types = $pay_typeM->where("is_del=0")->select();
        $this->assign("pay_types", $pay_types);

        //获取出行性质
        $travelNatureM = new TravelNatureModel();
        $this->assign("travel_nature", $travelNatureM->where("is_del=0")->select());

        //找出所有用户
        $userM = new UserModel();
        $users = $userM->where("is_del=0")->select();
        $this->assign("users", $users);

        //找出所有单位
        $companyM = new CompanyModel();
        $companys = $companyM->where("is_del=0")->select();
        $userM    = new UserModel();
        for ($i = 0; $i < count($companys) && count($companys) != 0; $i++) {
            $users                 = $userM->where(array("user_company" => $companys[$i]["id"], "is_del" => 0))->select();
            $companys[$i]["users"] = $users;
        }
        $this->assign("companys", $companys);

        //获取所有车辆
        $carM = new CarModel();
        $cars = $carM->where("is_law_car=0 and is_del=0")->select();
        $this->assign("cars", $cars);

        //获取所有司机
        $driverM = new DriverModel();
        $drivers = $driverM->where("is_del=0")->select();
        $this->assign("drivers", $drivers);


        $this->display();
    }

    /*
     * 手工补单数据新增
     */
    public function manualTravelDo()
    {
        //费用数据处理
        if ((!is_numeric($_POST["fees_sum"])) || $_POST["fees_sum"] == "") {
            $_POST["fees_sum"] = 0;
        }
        if ((!is_numeric($_POST["parking_rate_sum"])) || $_POST["parking_rate_sum"] == "") {
            $_POST["parking_rate_sum"] = 0;
        }
        if ((!is_numeric($_POST["service_charge"])) || $_POST["service_charge"] == "") {
            $_POST["service_charge"] = 0;
        }
        if ((!is_numeric($_POST["driver_cost"])) || $_POST["driver_cost"] == "") {
            $_POST["driver_cost"] = 0;
        }
        if ((!is_numeric($_POST["over_time_cost"])) || $_POST["over_time_cost"] == "") {
            $_POST["over_time_cost"] = 0;
        }
        if ((!is_numeric($_POST["over_mileage_cost"])) || $_POST["over_mileage_cost"] == "") {
            $_POST["over_mileage_cost"] = 0;
        }
        if ((!is_numeric($_POST["else_cost"])) || $_POST["else_cost"] == "") {
            $_POST["else_cost"] = 0;
        }
        $_POST["totle_rate"] = $_POST["fees_sum"] + $_POST["parking_rate_sum"] + $_POST["service_charge"] + $_POST["driver_cost"] + $_POST["over_time_cost"] + $_POST["over_mileage_cost"] + $_POST["else_cost"] + $_POST["driver_bt_cost"];


        $tempTime = null;

        //时间处理
        if (isset($_POST["sign_time"])) {
            $tempTime           = $_POST["sign_time"];
            $_POST["sign_time"] = strtotime($_POST["sign_time"]);
        }
        if (isset($_POST["departure_time"])) {
            $_POST["departure_time"] = strtotime($_POST["departure_time"]);
        }
        if (isset($_POST["start_car_time"])) {
            $_POST["start_car_time"] = strtotime($_POST["start_car_time"]);
        }
        if (isset($_POST["end_use_car_time"])) {
            $_POST["end_use_car_time"] = strtotime($_POST["end_use_car_time"]);
        }

        $travelM = new TravelModel();

        //其余数据处理
        $_POST["is_manual"]   = 1;
        $_POST["state"]       = 9;
        $_POST["use_user_id"] = $_POST["user_id"];

        //获取出行类型具体数据

        $travelTypeM = M("TravelType");
        $travel_type = $travelTypeM->find($_POST["travel_type_id"]);
        //dump($travelType);
        $_POST["is_arrange_car"]        = $travel_type["is_arrange_car"];
        $_POST["is_need_manage_review"] = $travel_type["is_need_manage_review"];
        $_POST["is_need_center_review"] = $travel_type["is_need_center_review"];
        $_POST["is_need_receipt"]       = $travel_type["is_need_receipt"];
        $_POST["is_need_evaluate"]      = $travel_type["is_need_evaluate"];


        if ($travelM->add($_POST)) {
            A("UserCenter")->logCreatWeb("手工补单，出行流水号： " . $_POST["serial_number"]);
            $this->ajaxReturn(array("code" => 1));
        } else {
            $this->ajaxReturn(array("code" => 0));
        }
    }


    /*
     * 补单审核页面
     */
    public function reviewSupplement()
    {
        $this->display();
    }

    public function getAllSupplement()
    {
        $map["supplement_res"] = 0;
        $resCount              = M("Supplement")->where($map)->select();

        $res = M("Supplement")->where($map)->order("id desc")->limit($_POST["start"], $_POST["length"])->select();

        //返回数据
        $travels                    = array();
        $travels["draw"]            = $_POST["draw"];
        $travels["recordsTotal"]    = count($resCount);//总记录条数
        $travels["recordsFiltered"] = count($resCount);//过滤后的记录数，也就是搜索结果数据
        $travels["data"]            = $this->getAllInfo($res);

        $this->ajaxReturn($travels);
    }

    public function viewSupplement($id)
    {
        $travelM = M("Supplement");
        $travel  = $travelM->find($id);
        $this->assign("travel", $travel);

        //申请人个人信息
        $userM = new UserModel();
        $user  = $userM->find($travel["user_id"]);
        $this->assign("user", $user);

        //申请人列表
        $userM = new UserModel();
        $users = $userM->where("is_del=0")->select();
        $this->assign("users", $users);


        //出行性质
        $travelNatureM = new TravelNatureModel();
        $travel_nature = $travelNatureM->where("is_del=0")->select();
        $this->assign("travel_nature", $travel_nature);

        //出行类型列表
        $travelTypeM  = new TravelTypeModel();
        $travel_types = $travelTypeM->where("is_del=0")->select();
        $this->assign("travel_types", $travel_types);

        //出行类型信息
        $travelTypeM = new TravelTypeModel();
        $travel_type = $travelTypeM->find($travel["travel_type_id"]);
        $this->assign("travel_type", $travel_type);


        //用车人个人信息
        $use_user = $userM->find($travel["use_user_id"]);
        $this->assign("use_user", $use_user);

        //申请人公司信息
        $companyM = new CompanyModel();
        $company  = $companyM->find($travel["company_id"]);
        $this->assign("company", $company);

        //司机信息
//        $driverM=new DriverModel();
//        $driver_name=$driverM->find($travel["driver_id"]);
//        $this->assign("driver",$driver_name);

        //车辆信息
//        $carMM=new CarModel();
//        $car_name=$driverM->find($travel["car_id"]);
//        $this->assign("car",$car_name);

        //需要派车情况下，查询是否已经派车
        $had_send_car = false;
        $is_owner     = false;
        if ($travel["is_arrange_car"] == "1") {
            if (isset($travel["arrange_type_id"]) || isset($travel["car_id"])) {
                $had_send_car = true;

                if (isset($travel["arrange_type_id"])) {
                    //获取第三方公司信息
                    $arrange_typeM = new ArrangeTypeModel();
                    $arrange_type  = $arrange_typeM->find($travel["arrange_type_id"]);
                    $this->assign("arrange_type", $arrange_type);
                } else {
                    $is_owner = true;
                    $carM     = new CarModel();
                    $driverM  = new DriverModel();

                    $car    = $carM->find($travel["car_id"]);
                    $driver = $driverM->find($travel["driver_id"]);

                    $this->assign("car", $car);
                    $this->assign("driver", $driver);
                }
            }
        }
        $this->assign("is_owner", $is_owner);
        $this->assign("had_send_car", $had_send_car);

        //获取出行凭据
        if ($travel["credential"] == "") {
            $this->assign("havadata", 0);
        } else {
            $this->assign("havadata", 1);
        }
        $credentials = explode("|", $travel["credential"]);
        $this->assign("credentials", $credentials);

        //获取所有状态为1车辆
        $carM = new CarModel();
        $cars = $carM->where("is_del=0")->select();
        $this->assign("cars", $cars);

        //获取所有状态为0的司机
        $driverM = new DriverModel();
        $drivers = $driverM->where("is_del=0")->select();
        $this->assign("drivers", $drivers);

        //获取所有第三方出行公司
        $arrange_type  = new ArrangeTypeModel();
        $arrange_types = $arrange_type->select();
        $this->assign("arrange_types", $arrange_types);


        $this->display();
    }

    public function reviewSupplementDo()
    {
        $type   = $_POST["type"];
        $id     = $_POST["id"];
        $travel = M("Supplement")->find($id);
        if ($type == 1) {
            //同意，只需要删除现有自己的ID
            $travel["supplement_res"] = 1;
            M("Supplement")->save($travel);

            unset($travel["id"]);

            $res = M("Travel")->add($travel);
            if ($res) {
                A("UserCenter")->logCreatWeb("补单申请审核通过，出行流水号： " . $travel["serial_number"]);
                $this->ajaxReturn(array("code" => 1));
            } else {
                $this->ajaxReturn(array("code" => 0));
            }
        } else {
            $info = $_POST["center_error_msg"];

            $travel["supplement_res"]  = 3;
            $travel["supplement_info"] = $info;
            $res                       = M("Supplement")->save($travel);
            if ($res) {
                A("UserCenter")->logCreatWeb("补单申请审核驳回");
                $this->ajaxReturn(array("code" => 1));
            } else {
                $this->ajaxReturn(array("code" => 0));
            }
        }
    }

    public function editSupplementDo()
    {
        //dump($_POST);
        //计算费用总和
        if (!empty($_POST["fees_sum"])) {
            if ((!is_numeric($_POST["fees_sum"])) || $_POST["fees_sum"] == "") {
                $_POST["fees_sum"] = 0;
            }
            if ((!is_numeric($_POST["parking_rate_sum"])) || $_POST["parking_rate_sum"] == "") {
                $_POST["parking_rate_sum"] = 0;
            }
            if ((!is_numeric($_POST["service_charge"])) || $_POST["service_charge"] == "") {
                $_POST["service_charge"] = 0;
            }
            if ((!is_numeric($_POST["driver_cost"])) || $_POST["driver_cost"] == "") {
                $_POST["driver_cost"] = 0;
            }
            if ((!is_numeric($_POST["over_time_cost"])) || $_POST["over_time_cost"] == "") {
                $_POST["over_time_cost"] = 0;
            }
            if ((!is_numeric($_POST["over_mileage_cost"])) || $_POST["over_mileage_cost"] == "") {
                $_POST["over_mileage_cost"] = 0;
            }
            if ((!is_numeric($_POST["else_cost"])) || $_POST["else_cost"] == "") {
                $_POST["else_cost"] = 0;
            }

            $_POST["totle_rate"] = $_POST["fees_sum"] + $_POST["parking_rate_sum"] + $_POST["service_charge"] + $_POST["driver_cost"] + $_POST["over_time_cost"] + $_POST["over_mileage_cost"] + $_POST["else_cost"];
        }


        $_POST["departure_time"]   = strtotime($_POST["departure_time"]);    //转换成时间戳格式
        $_POST["collecting_time"]  = strtotime($_POST["collecting_time"]);
        $_POST["start_car_time"]   = strtotime($_POST["start_car_time"]);    //转换成时间戳格式
        $_POST["end_use_car_time"] = strtotime($_POST["end_use_car_time"]);
        $_POST["sign_time"]        = strtotime($_POST["sign_time"]);


        $res = M("Supplement")->save($_POST);

        if ($res) {
            $this->ajaxReturn(array("code" => 1));
        } else {
            $this->ajaxReturn(array("code" => 0));
        }
    }


    public function rk()
    {
        $set     = M("set")->find(1);
        $account = "account=" . $set["jjaccount"] . "&pwd=" . $set["jjpwd"];
        $res     = httpFF("http://api.99huaan.com/passenger/login", "", $account, "POST");
        $res     = json_decode($res, true);


        $token = $res["token"];
        //通过token获取车辆类型
        $data = "token=" . $token . "&franchisee_id=" . $set["franchisee_id"];
        $res  = httpFF("http://api.99huaan.com/passenger/franchisee/vehicletype", "", $data, "POST");
        $res  = json_decode($res, true);


        M("JjCarType")->where("id>0")->delete();
        for ($i = 0; $i < count($res["data"]) && count($res["data"]) != 0; $i++) {
            $datad["id"]        = $res["data"][$i]["vehicle_type_id"];
            $datad["type_name"] = $res["data"][$i]["name"];
            M("JjCarType")->add($datad);
        }
    }


    //派遣第三方车辆
    public function sendCarToOther($id)
    {
        $res = M("JjCarType")->select();
        $this->assign("res", $res);

        $arrangeTypes = M("ArrangeType")->where("is_del=0")->select();
        $this->assign("arrangeTypes", $arrangeTypes);
        $this->assign("id", $id);
        $this->display();
    }


    //派遣第三方车辆具体操作
    public function sendCarToOtherDo_bak()
    {

//        $set=M("set")->find(1);
//        $account="account=".$set["jjaccount"]."&pwd=".$set["jjpwd"];
//        $res=httpFF("http://api.99huaan.com/passenger/login","",$account,"POST");
//        $res=json_decode($res,true);
//
//        if(empty($res)){
//            $this->ajaxReturn(array("code"=>0));
//        }

        $travel     = M("Travel")->find($_POST["id"]);
        $travelType = M("TravelType")->find($travel["travel_type_id"]);

        $state = 5;
        //如果不需要派车之后的审核，则直接将状态设置为待出车
        //如果派车之后需要审核，则直接将状态设置为待出车审核
        if ($travelType["is_need_sendcar_review"] == 0) {
            $state = 8;
        } else {
            $state = 5;
        }

        $useUser = M("User")->find($travel["use_user_id"]);


        $data["id_member"]        = "e8b5db7e939311e8b2627cd30ab8ab74";
        $data["user_name"]        = "道县机关事务局";
        $data["user_mobile"]      = $useUser["user_phone"];
        $data["passenger_name"]   = $useUser["user_name"];
        $data["passenger_mobile"] = $useUser["user_phone"];
        $data["id_franchisee"]    = "2a0d0c5c3ed911e8a86d70106fb1fc52";
        $data["companyName"]      = "道县玖玖";
        $data["id_service_type"]  = "5";
        $data["carTypeId"]        = $_POST["car_type"];
        $data["start_address"]    = $travel["from_place"];
        $data["end_address"]      = $travel["to_place"];
        $data["appointment_time"] = date('Y-m-d H:i', $travel["departure_time"]);
        $data["order_memo"]       = "无";


        //发送数据给创建订单服务器
        $res = httpF("http://admin.99zcx.com/order/specialCar/createByTransport", "", json_encode($data), "POST");

        $res = json_decode($res, true);

        //dump $res;

        if ($res["code"] = "200" && $res["data"]["success"]) {
            //echo $res["data"]["orderId"];

            $travel["jj_id"]           = $res["data"]["orderId"];
            $travel["send_other_res"]  = $_POST["send_other_res"];
            $travel["arrange_type_id"] = $_POST["arrange_id"];
            $travel["state"]           = $state;
            $travel["send_car_time"]   = time();

            $travel["is_need_settlement"] = 0;//使用玖玖专车就不需要费用核算了，只有自有车辆出行才费用核算

            $re = M("Travel")->save($travel);
            if ($re) {
                $this->ajaxReturn(array("code" => 1));
            } else {
                $this->ajaxReturn(array("code" => 0));
            }

        } else {
            $this->ajaxReturn(array("code" => 0));
        }
    }

    //派遣第三方车辆具体操作
    public function sendCarToOtherDo()
    {
        $travel                        = M("Travel")->find($_POST["id"]);
        $travelType                    = M("TravelType")->find($travel["travel_type_id"]);
        $travel["from_place_location"] = '';
        $state                         = 5;
        //如果不需要派车之后的审核，则直接将状态设置为待出车
        //如果派车之后需要审核，则直接将状态设置为待出车审核
        if ($travelType["is_need_sendcar_review"] == 0) {
            $state = 8;
        }

        $useUser = M("User")->find($travel["use_user_id"]);
        $company = M("Company")->find($useUser["user_company"]);


        $set     = M("set")->find(1);
        $account = "account=" . $set["jjaccount"] . "&pwd=" . $set["jjpwd"];
        $res     = httpFF("http://api.99huaan.com/passenger/login", "", $account, "POST");
        $res     = json_decode($res, true);
//        @file_put_contents($_SERVER["DOCUMENT_ROOT"]."/jzw.txt","\n\n res:".json_encode($res),FILE_APPEND);

        $token         = $res["token"];
        $member_id     = $res["data"]["member_id"];
        $franchisee_id = $res["data"]["franchisee_id"];

        $sendData = "";
        $sendData .= "token=" . $token . "&";
        $sendData .= "member_id=" . $member_id . "&";
        $sendData .= "user_name=" . $set["jj_push_name"] . "&";
        $sendData .= "user_mobile=" . $useUser["user_phone"] . "&";
        $sendData .= "passenger_name=" . $useUser["user_name"] . "&";
        $sendData .= "passenger_mobile=" . $useUser["user_phone"] . "&";
        $sendData .= "franchisee_id=" . $franchisee_id . "&";
        $sendData .= "service_type_id=5&";
        $sendData .= "vehicle_type_id=" . $_POST["car_type"] . "&";
        $sendData .= "start_address=" . $travel["from_place"] . "&";
        $sendData .= "start_address_latitude=" . explode(",", $travel["from_place_location"])[0] . "&";
        $sendData .= "start_address_longitude=" . explode(",", $travel["from_place_location"])[1] . "&";
        $sendData .= "end_address=" . $travel["to_place"] . "&";
        $sendData .= "end_address_latitude=" . explode(",", $travel["to_place_location"])[0] . "&";
        $sendData .= "end_address_longitude=" . explode(",", $travel["to_place_location"])[1] . "&";
        $sendData .= "appointment_time=" . date('Y-m-d H:i', $travel["departure_time"]) . "&";
        $sendData .= "order_memo=" . $company["company_name"] . $travel["travel_reason"] . "&";
        $sendData .= "estimated_time=0&";
        $sendData .= "mileage=0";


        $res = httpFF("http://api.99huaan.com/passenger/order/common/createByPassenger", "", $sendData, "POST");
        $res = json_decode($res, true);

        if ($res["result"] == "1") {
            $travel["jj_id"]              = $res["data"]["order_id"];
            $travel["send_other_res"]     = $_POST["send_other_res"];
            $travel["arrange_type_id"]    = $_POST["arrange_id"];
            $travel["state"]              = $state;
            $travel["send_car_time"]      = time();
            $travel["is_need_settlement"] = 0;//使用玖玖专车就不需要费用核算了，只有自有车辆出行才费用核算

            $re = M("Travel")->save($travel);

            if ($re) {
                A("UserCenter")->logCreatWeb("派车给第三方，出行流水号： " . $travel["serial_number"]);
                $this->ajaxReturn(array("code" => 1));
            } else {
                $this->ajaxReturn(array("code" => 0));
            }
        } else {
            $this->ajaxReturn(array("code" => 0, "msg" => $res["err_message"]["content"]));
        }
    }


    /*
    * 派车后，管理员取消出行
    */
    public function adminCancelTravel()
    {
        if (empty($_POST)) {
            $this->ajaxReturn(array("code" => 0));
        } else {
            $id               = I("post.id");
            $center_error_msg = I("post.center_error_msg");


            $travel = M("Travel")->find($id);

            //先不管怎么样，都是要将状态设置为取消的，将取消原因录进去的
            $travel["old_state"]     = $travel["state"];
            $travel["cancel_reason"] = $center_error_msg;
            $travel["cancel_time"]   = time();
            $travel["state"]         = 11;
            M("travel")->save($travel);
            A("UserCenter")->logCreatWeb("管理员取消出行，出行流水号： " . $travel["serial_number"]);

            switch ($travel["state"]) {
                case 5:
                    //派车信息待审核，此时虽然不用发短信给司机，但是需要将司机、车辆状态重置
                    if ($travel["is_arrange_car"] == 1) {
                        if ($travel["car_id"] && $travel["driver_id"]) {
                            //释放车辆
                            $carM = new CarModel();
                            $data = array(
                                "id"    => $travel["car_id"],
                                "state" => 1
                            );
                            $carM->save($data);
                            //释放司机
                            $driverM = new DriverModel();
                            $data    = array(
                                "id"    => $travel["driver_id"],
                                "state" => 0
                            );
                            $driverM->save($data);
                        }
                    }
                    break;

                case 6:
                    //状态为6，司机已经派了，此时应该通知司机了
                    $systemC = new SystemController();
                    $systemC->sendCancelUser($travel);
                    $systemC->sendCancelDriver($travel);//短信告知司机

                    if ($travel["is_arrange_car"] == 1) {
                        if ($travel["car_id"] && $travel["driver_id"]) {
                            //释放车辆
                            $carM = new CarModel();
                            $data = array(
                                "id"    => $travel["car_id"],
                                "state" => 1
                            );
                            $carM->save($data);
                            //释放司机
                            $driverM = new DriverModel();
                            $data    = array(
                                "id"    => $travel["driver_id"],
                                "state" => 0
                            );
                            $driverM->save($data);
                        }
                    }
                    break;

                case 8:
                    //状态为6，司机已经派了，此时应该通知司机了
                    $systemC = new SystemController();
                    $systemC->sendCancelUser($travel);
                    $systemC->sendCancelDriver($travel);//短信告知司机

                    if ($travel["is_arrange_car"] == 1) {
                        if ($travel["car_id"] && $travel["driver_id"]) {
                            //释放车辆
                            $carM = new CarModel();
                            $data = array(
                                "id"    => $travel["car_id"],
                                "state" => 1
                            );
                            $carM->save($data);
                            //释放司机
                            $driverM = new DriverModel();
                            $data    = array(
                                "id"    => $travel["driver_id"],
                                "state" => 0
                            );
                            $driverM->save($data);
                        }
                    }
                    break;

                default:
                    break;
            }

        }
    }

    //预估出行轨迹
    public function ViewTravelTrackEstimate()
    {
        $id = intval($_REQUEST["id"]);

        $travelM = new TravelModel();
        $travel  = $travelM->find($id);

        $this->assign("travel", $travel);

        $this->display();

    }


}


