<?php

namespace Admin\Controller;

use Model\ArrangeTypeModel;
use Model\CarModel;
use Model\CostInsuranceModel;
use Model\CostOilModel;
use Model\CostRepairModel;
use Model\CostWashModel;
use Model\DriverModel;
use Model\TravelModel;
use Model\TravelTypeModel;
use Model\UserModel;
use Model\CompanyModel;

/**
 *User控制器，主要负责对车辆的操作
 */
class ReportController extends CommonController
{
    /*
     * 单位数据统计
     */
    public function byCompany()
    {
        //获取所有单位
//        $companysall=M("Company")->where("is_del=0")->select();
//        $this->assign("companysall",$companysall);

        //获取当月1号时间
        $startTime = date('Y-m-01', strtotime(date("Y-m-d")));
        $endTime   = date('Y-m-d', strtotime(date("Y-m-d")));

        $map  = array();
        $mapc = array();

        if (empty($_POST)) {
            $this->assign("aa", "0");
        } else {
            //如果发送数据过来了
            $this->assign("type", $_POST["type"]);

            //获取开始时间
            if (!empty($_POST["startTime"])) {
                $startTime             = $_POST["startTime"];
                $map['departure_time'] = array('gt', strtotime($_POST["startTime"]));
            }

            if (!empty($_POST["endTime"])) {
                $endTime               = $_POST["endTime"];
                $map['departure_time'] = array('elt', strtotime($_POST["endTime"]) + 24 * 3600);
            }
            if ((!empty($_POST["startTime"])) && !empty($_POST["endTime"])) {

                $startTime = $_POST["startTime"];
                $endTime   = $_POST["endTime"];

                $map['departure_time'] = array('between', array(strtotime($_POST["startTime"]), strtotime($_POST["endTime"]) + 24 * 3600));
            }
            if (!empty($_POST["searchKey"])) {
                $mapc["company_name"] = array("like", "%" . trim($_POST["searchKey"]) . "%");
                $this->assign("companyname", trim($_POST["searchKey"]));
            }

            $mapc["is_del"] = 0;
            $this->assign("aa", "1");

            if ($_POST["type"] == 1) {
                $companys = M("Company")->where($mapc)->select();
//                echo M("Company")->getLastSql();exit;
                $hj = array(
                    "finishCount"         => 0,
                    "companyMileageCount" => 0,
                    "luqiaoCount"         => 0,
                    "fuwufeiCount"        => 0,
                    "buzhuCount"          => 0,
                    "qitaCount"           => 0,
                    "heji"                => 0
                );

                for ($i = 0; $i < count($companys) && count($companys) != 0; $i++) {
                    $map['company_id'] = array('eq', $companys[$i]["id"]);
                    $map["is_del"]     = 0;

                    $travelM                             = new TravelModel();
                    $companys[$i]["finishCount"]         = $travelM->where($map)->where(array("state" => "9"))->count();
                    $companys[$i]["companyMileageCount"] = $travelM->where($map)->where(array("state" => "9"))->sum("mileage");//该单位所有出行费用之和
                    if (empty($companys[$i]["companyMileageCount"])) {
                        $companys[$i]["companyMileageCount"] = 0;
                    }


                    $companys[$i]["luqiaoCount"] = $travelM->where($map)->where(array("state" => "9"))->sum("fees_sum");//该单位所有出行费用之和
                    if (empty($companys[$i]["luqiaoCount"])) {
                        $companys[$i]["luqiaoCount"] = 0;
                    }

                    $companys[$i]["fuwufeiCount"] = $travelM->where($map)->where(array("state" => "9"))->sum("service_charge");//该单位所有出行费用之和
                    if (empty($companys[$i]["fuwufeiCount"])) {
                        $companys[$i]["fuwufeiCount"] = 0;
                    }

                    $companys[$i]["buzhuCount"] = $travelM->where($map)->where(array("state" => "9"))->sum("driver_bt_cost");


                    $companys[$i]["qitaCount"] = $travelM->where($map)->where(array("state" => "9"))->sum("parking_rate_sum") + $travelM->where($map)->where(array("state" => "9"))->sum("driver_cost") + $travelM->where($map)->where(array("state" => "9"))->sum("over_time_cost") + $travelM->where($map)->where(array("state" => "9"))->sum("over_mileage_cost") + $travelM->where($map)->where(array("state" => "9"))->sum("else_cost");//该单位所有出行费用之和

                    $companys[$i]["heji"] = $companys[$i]["luqiaoCount"] + $companys[$i]["fuwufeiCount"] + $companys[$i]["buzhuCount"] + $companys[$i]["qitaCount"];


                    $hj["finishCount"]         += $companys[$i]["finishCount"];
                    $hj["companyMileageCount"] += $companys[$i]["companyMileageCount"];
                    $hj["luqiaoCount"]         += $companys[$i]["luqiaoCount"];
                    $hj["fuwufeiCount"]        += $companys[$i]["fuwufeiCount"];
                    $hj["buzhuCount"]          += $companys[$i]["buzhuCount"];
                    $hj["qitaCount"]           += $companys[$i]["qitaCount"];
                    $hj["heji"]                += $companys[$i]["heji"];
                }
//                echo "<PRE>";
//                print_r($companys);exit;
                $this->assign("hj", $hj);
                $this->assign("companys", $companys);
            } else {

                if (empty($_POST["searchKey"])) {
                    $map["state"] = 9;
                } else {
                    $company_ids       = M("company")->where(array("company_name" => array("like", "%" . trim($_POST["searchKey"]) . "%")))->field("id")->select();
                    $map["company_id"] = array("IN", $company_ids ? array_column($company_ids, "id") : array(0));
                    $map["state"]      = 9;
                }
                $travels = M("Travel")->where($map)->where("is_del=0")->select();
                for ($i = 0; $i < count($travels) && count($travels) != 0; $i++) {
                    //获取用车人信息
                    $user                         = M("User")->find($travels[$i]["use_user_id"]);
                    $travels[$i]["user_name"]     = $user["user_name"];
                    $companyyy                    = M("Company")->find($travels[$i]["company_id"]);
                    $travels[$i]["company_namee"] = $companyyy["company_name"];
                }

                $this->assign("travels", $travels);
            }
        }


        $this->assign("startTime", $startTime);
        $this->assign("endTime", $endTime);
        $this->display();
    }


    public function byCar()
    {
        //获取当月1号时间
        $startTime = date('Y-m-01', strtotime(date("Y-m-d")));
        $endTime   = date('Y-m-d', strtotime(date("Y-m-d")));


        //获取所有单位
        $companysall = M("Company")->where("is_del=0")->select();
        $this->assign("companysall", $companysall);

        $carsall = M("Car")->where("is_del=0")->select();
        $this->assign("carsall", $carsall);


        if (empty($_POST)) {
            $this->assign("aa", "0");
        } else {
            //如果发送数据过来了
            $this->assign("type", $_POST["type"]);

            //获取开始时间
            if (!empty($_POST["startTime"])) {
                $startTime             = $_POST["startTime"];
                $map['departure_time'] = array('gt', strtotime($_POST["startTime"]));
            }

            if (!empty($_POST["endTime"])) {
                $endTime               = $_POST["endTime"];
                $map['departure_time'] = array('elt', strtotime($_POST["endTime"]) + 24 * 3600);
            }
            if ((!empty($_POST["startTime"])) && !empty($_POST["endTime"])) {

                $startTime = $_POST["startTime"];
                $endTime   = $_POST["endTime"];

                $map['departure_time'] = array('between', array(strtotime($_POST["startTime"]), strtotime($_POST["endTime"]) + 24 * 3600 - 1));
            }
            if ($_POST["car"] != 0) {
                $mapc["id"] = $_POST["car"];
                $this->assign("carname", $_POST["car"]);
            }


            $mapc["is_del"] = 0;


            $this->assign("aa", "1");


            if ($_POST["type"] == 1) {
                if ($_POST["company"] != 0) {
                    $map["company_id"] = $_POST["company"];
                    // $this->assign("compnay_id",$_POST["company"]);
                }

                $cars = M("Car")->where($mapc)->select();
                // $companys=M("Company")->where($mapc)->select();

                $hj = array(
                    "finishCount"         => 0,
                    "companyMileageCount" => 0,
                    "luqiaoCount"         => 0,
                    "fuwufeiCount"        => 0,
                    "buzhuCount"          => 0,
                    "qitaCount"           => 0,
                    "heji"                => 0,
                    "xiche"               => 0,
                    "weixiu"              => 0,
                    "jiayou"              => 0,
                    "nianjian"            => 0,
                    "xiaoji"              => 0
                );

                for ($i = 0; $i < count($cars) && count($cars) != 0; $i++) {
                    $map['car_id'] = array('eq', $cars[$i]["id"]);
                    $map["is_del"] = 0;
                    // $map1['company_id']  = array('eq',$companys[$i]["id"]);

                    $travelM                 = new TravelModel();
                    $cars[$i]["finishCount"] = $travelM->where($map)->where(array("state" => "9"))->count();

                    $cars[$i]["companyMileageCount"] = $travelM->where($map)->where(array("state" => "9"))->sum("mileage");//该单位所有出行费用之和
                    if (empty($cars[$i]["companyMileageCount"])) {
                        $cars[$i]["companyMileageCount"] = 0;
                    }


                    $cars[$i]["luqiaoCount"] = $travelM->where($map)->where(array("state" => "9"))->sum("fees_sum");//该单位所有出行费用之和
                    if (empty($cars[$i]["luqiaoCount"])) {
                        $cars[$i]["luqiaoCount"] = 0;
                    }

                    $cars[$i]["fuwufeiCount"] = $travelM->where($map)->where(array("state" => "9"))->sum("service_charge");//该单位所有出行费用之和
                    if (empty($cars[$i]["fuwufeiCount"])) {
                        $cars[$i]["fuwufeiCount"] = 0;
                    }

                    $cars[$i]["buzhuCount"] = $travelM->where($map)->where(array("state" => "9"))->sum("driver_bt_cost");


                    $cars[$i]["qitaCount"] = $travelM->where($map)->where(array("state" => "9"))->sum("parking_rate_sum") + $travelM->where($map)->where(array("state" => "9"))->sum("driver_cost") + $travelM->where($map)->where(array("state" => "9"))->sum("over_time_cost") + $travelM->where($map)->where(array("state" => "9"))->sum("over_mileage_cost") + $travelM->where($map)->where(array("state" => "9"))->sum("else_cost");//该单位所有出行费用之和

                    $cars[$i]["heji"] = $cars[$i]["luqiaoCount"] + $cars[$i]["fuwufeiCount"] + $cars[$i]["buzhuCount"] + $cars[$i]["qitaCount"];


                    //计算维修保养费用
                    $xiche['car_id']    = array('eq', $cars[$i]["id"]);
                    $xiche["is_del"]    = array('eq', 0);
                    $xiche["wash_time"] = $map['departure_time'];

                    $weixiu['car_id']     = array('eq', $cars[$i]["id"]);
                    $weixiu["is_del"]     = array('eq', 0);
                    $weixiu["start_time"] = $map['departure_time'];

                    $jiayou['car_id']       = array('eq', $cars[$i]["id"]);
                    $jiayou["is_del"]       = array('eq', 0);
                    $jiayou["trading_time"] = $map['departure_time'];

                    $nianjian['car_id']   = array('eq', $cars[$i]["id"]);
                    $nianjian["is_del"]   = array('eq', 0);
                    $nianjian["pay_time"] = $map['departure_time'];

                    $cars[$i]["xiche"]    = M("CostWash")->where($xiche)->sum("cost");
                    $cars[$i]["weixiu"]   = M("CostRepair")->where($weixiu)->sum("cost");
                    $cars[$i]["jiayou"]   = M("CostOil")->where($jiayou)->sum("cost");
                    $cars[$i]["nianjian"] = M("CostInsurance")->where($nianjian)->sum("cost");
                    $cars[$i]["xiaoji"]   = $cars[$i]["xiche"] + $cars[$i]["weixiu"] + $cars[$i]["jiayou"] + $cars[$i]["nianjian"];


                    $hj["finishCount"]         += $cars[$i]["finishCount"];
                    $hj["companyMileageCount"] += $cars[$i]["companyMileageCount"];
                    $hj["luqiaoCount"]         += $cars[$i]["luqiaoCount"];
                    $hj["fuwufeiCount"]        += $cars[$i]["fuwufeiCount"];
                    $hj["buzhuCount"]          += $cars[$i]["buzhuCount"];
                    $hj["qitaCount"]           += $cars[$i]["qitaCount"];
                    $hj["heji"]                += $cars[$i]["heji"];


                    $hj["xiche"]    += $cars[$i]["xiche"];
                    $hj["weixiu"]   += $cars[$i]["weixiu"];
                    $hj["jiayou"]   += $cars[$i]["jiayou"];
                    $hj["nianjian"] += $cars[$i]["nianjian"];
                    $hj["xiaoji"]   += $cars[$i]["xiaoji"];
                }

                if ($_POST["company"] != 0) {
                    $this->assign("companyname", $_POST["company"]);
                    $companynameM = new CompanyModel();
                    $companyname  = $companynameM->find($_POST["company"]);
                    $this->assign("companyna", $companyname);
                }
                $this->assign("hj", $hj);
                $this->assign("cars", $cars);
            }


            if ($_POST["type"] == 2) {

                if ($_POST["company"] != 0) {
                    $mapc["company_id"] = $_POST["company"];
                    $this->assign("companyname", $_POST["company"]);
                }

                if ($_POST["car"] == 0) {
                    $map["state"] = 9;
                } else {
                    $map["car_id"] = $_POST["car"];
                    $map["state"]  = 9;
                }

                if ($_POST["company"] != 0) {
                    $map["company_id"] = $_POST["company"];

                }

                $travels = M("Travel")->where($map)->where("is_del=0")->select();


                for ($i = 0; $i < count($travels) && count($travels) != 0; $i++) {
                    //获取用车人信息
                    $user                     = M("User")->find($travels[$i]["use_user_id"]);
                    $travels[$i]["user_name"] = $user["user_name"];

                    //单位信息
                    $companyyy                    = M("Company")->find($travels[$i]["company_id"]);
                    $travels[$i]["company_namee"] = $companyyy["company_name"];

                    //车辆信息
                    $car                    = M("Car")->find($travels[$i]["car_id"]);
                    $travels[$i]["car_num"] = $car["car_num"];

                    //司机信息
                    $driver                     = M("Driver")->find($travels[$i]["driver_id"]);
                    $travels[$i]["driver_name"] = $driver["driver_name"];

                }

                $this->assign("travels", $travels);
            }

        }

        $this->assign("startTime", $startTime);
        $this->assign("endTime", $endTime);


        $this->display();
    }


    public function byDriver()
    {

        $startTime = date('Y-m-01', strtotime(date("Y-m-d")));
        $endTime   = date('Y-m-d', strtotime(date("Y-m-d")));

        //获取所有单位
//        $driversall=M("Driver")->where("is_del=0")->select();
//        $this->assign("driversall",$driversall);


        if (empty($_POST)) {
            $this->assign("aa", "0");
        } else {
            //如果发送数据过来了
            $this->assign("type", $_POST["type"]);

            //获取开始时间
            if (!empty($_POST["startTime"])) {
                $startTime             = $_POST["startTime"];
                $map['departure_time'] = array('gt', strtotime($_POST["startTime"]));
            }

            if (!empty($_POST["endTime"])) {
                $endTime               = $_POST["endTime"];
                $map['departure_time'] = array('elt', strtotime($_POST["endTime"]) + 24 * 3600);
            }
            if ((!empty($_POST["startTime"])) && !empty($_POST["endTime"])) {

                $startTime = $_POST["startTime"];
                $endTime   = $_POST["endTime"];

                $map['departure_time'] = array('between', array(strtotime($_POST["startTime"]), strtotime($_POST["endTime"]) + 24 * 3600));
            }
            if (!empty($_POST["searchKey"])) {
                $mapc["driver_name|driver_phone"] = array("like", "%" . trim($_POST["searchKey"]) . "%");
                $this->assign("driver_name", trim($_POST["searchKey"]));
            }

            $mapc["is_del"] = 0;
            $this->assign("aa", "1");

            if ($_POST["type"] == 1) {
                $drivers = M("Driver")->where($mapc)->select();
                $hj      = array(
                    "finishCount"         => 0,
                    "companyMileageCount" => 0,
                    "luqiaoCount"         => 0,
                    "fuwufeiCount"        => 0,
                    "buzhuCount"          => 0,
                    "qitaCount"           => 0,
                    "heji"                => 0
                );

                for ($i = 0; $i < count($drivers) && count($drivers) != 0; $i++) {
                    $map['driver_id'] = array('eq', $drivers[$i]["id"]);
                    $map["is_del"]    = 0;

                    $travelM                            = new TravelModel();
                    $drivers[$i]["finishCount"]         = $travelM->where($map)->where(array("state" => "9"))->count();
                    $drivers[$i]["companyMileageCount"] = $travelM->where($map)->where(array("state" => "9"))->sum("mileage");//该单位所有出行费用之和
                    if (empty($drivers[$i]["companyMileageCount"])) {
                        $drivers[$i]["companyMileageCount"] = 0;
                    }


                    $drivers[$i]["luqiaoCount"] = $travelM->where($map)->where(array("state" => "9"))->sum("fees_sum");//该单位所有出行费用之和
                    if (empty($drivers[$i]["luqiaoCount"])) {
                        $drivers[$i]["luqiaoCount"] = 0;
                    }

                    $drivers[$i]["fuwufeiCount"] = $travelM->where($map)->where(array("state" => "9"))->sum("service_charge");//该单位所有出行费用之和
                    if (empty($drivers[$i]["fuwufeiCount"])) {
                        $drivers[$i]["fuwufeiCount"] = 0;
                    }

                    $drivers[$i]["buzhuCount"] = $travelM->where($map)->where(array("state" => "9"))->sum("driver_bt_cost");


                    $drivers[$i]["qitaCount"] = $travelM->where($map)->where(array("state" => "9"))->sum("parking_rate_sum") + $travelM->where($map)->where(array("state" => "9"))->sum("driver_cost") + $travelM->where($map)->where(array("state" => "9"))->sum("over_time_cost") + $travelM->where($map)->where(array("state" => "9"))->sum("over_mileage_cost") + $travelM->where($map)->where(array("state" => "9"))->sum("else_cost");//该单位所有出行费用之和

                    $drivers[$i]["heji"] = $drivers[$i]["luqiaoCount"] + $drivers[$i]["fuwufeiCount"] + $drivers[$i]["buzhuCount"] + $drivers[$i]["qitaCount"];


                    $hj["finishCount"]         += $drivers[$i]["finishCount"];
                    $hj["companyMileageCount"] += $drivers[$i]["companyMileageCount"];
                    $hj["luqiaoCount"]         += $drivers[$i]["luqiaoCount"];
                    $hj["fuwufeiCount"]        += $drivers[$i]["fuwufeiCount"];
                    $hj["buzhuCount"]          += $drivers[$i]["buzhuCount"];
                    $hj["qitaCount"]           += $drivers[$i]["qitaCount"];
                    $hj["heji"]                += $drivers[$i]["heji"];
                }
                $this->assign("hj", $hj);
                $this->assign("drivers", $drivers);
            }


            if ($_POST["type"] == 2) {
                if (empty($_POST["searchKey"])) {
                    $map["state"] = 9;
                } else {
                    $driver_ids       = M("driver")->where(array("driver_name|driver_phone" => array("like", "%" . trim($_POST["searchKey"]) . "%")))->field("id")->select();
                    $map["driver_id"] = array("IN", $driver_ids ? array_column($driver_ids, "id") : array(0));
                    $map["state"]     = 9;
                }
                $map["is_del"] = 0;
                $travels       = M("Travel")->where($map)->select();


                for ($i = 0; $i < count($travels) && count($travels) != 0; $i++) {
                    //获取用车人信息
                    $user                     = M("User")->find($travels[$i]["use_user_id"]);
                    $travels[$i]["user_name"] = $user["user_name"];

                    //单位信息
                    $companyyy                    = M("Company")->find($travels[$i]["company_id"]);
                    $travels[$i]["company_namee"] = $companyyy["company_name"];

                    //车辆信息
                    $car                    = M("Car")->find($travels[$i]["car_id"]);
                    $travels[$i]["car_num"] = $car["car_num"];

                    //司机信息
                    $driver                     = M("Driver")->where(array("id" => $travels[$i]["driver_id"]))->find();
                    $travels[$i]["driver_name"] = $driver["driver_name"];

                }

                $this->assign("travels", $travels);
            }


        }


        $this->assign("startTime", $startTime);
        $this->assign("endTime", $endTime);


        $this->display();
    }


    public function byUser()
    {
        set_time_limit(0);
        $startTime = date('Y-m-01', strtotime(date("Y-m-d")));
        $endTime   = date('Y-m-d', strtotime(date("Y-m-d")));

        if (empty($_POST)) {
            $this->assign("aa", "0");
        } else {
            //如果发送数据过来了
            $this->assign("type", $_POST["type"]);

//            set_time_limit(0);
//            G("begin");
            //获取开始时间
            if (!empty($_POST["startTime"])) {
                $startTime             = $_POST["startTime"];
                $map['departure_time'] = array('gt', strtotime($_POST["startTime"]));
            }

            if (!empty($_POST["endTime"])) {
                $endTime               = $_POST["endTime"];
                $map['departure_time'] = array('elt', strtotime($_POST["endTime"]) + 24 * 3600);
            }
            if ((!empty($_POST["startTime"])) && !empty($_POST["endTime"])) {

                $startTime = $_POST["startTime"];
                $endTime   = $_POST["endTime"];

                $map['departure_time'] = array('between', array(strtotime($_POST["startTime"]), strtotime($_POST["endTime"]) + 24 * 3600));
            }
            if (!empty($_REQUEST["searchKey"])) {
                $key                          = trim($_REQUEST["searchKey"]);
                $mapc["user_phone|user_name"] = array("like", "%" . $key . "%");
                $this->assign("username", $key);
            }

            $mapc["is_del"] = 0;
            $this->assign("aa", "1");

            if ($_POST["type"] == 1) {
                $users = M("User")->where($mapc)->select();

                $hj = array(
                    "finishCount"         => 0,
                    "companyMileageCount" => 0,
                    "luqiaoCount"         => 0,
                    "fuwufeiCount"        => 0,
                    "buzhuCount"          => 0,
                    "qitaCount"           => 0,
                    "heji"                => 0
                );

                for ($i = 0, $count = count($users); $i < $count && $count != 0; $i++) {
                    $map['use_user_id'] = array('eq', $users[$i]["id"]);
                    $map["is_del"]      = 0;

                    $travelM                          = new TravelModel();
                    $users[$i]["finishCount"]         = $travelM->where($map)->where(array("state" => "9"))->count();
                    $users[$i]["companyMileageCount"] = $travelM->where($map)->where(array("state" => "9"))->sum("mileage");//该单位所有出行费用之和
                    if (empty($users[$i]["companyMileageCount"])) {
                        $users[$i]["companyMileageCount"] = 0;
                    }


                    $users[$i]["luqiaoCount"] = $travelM->where($map)->where(array("state" => "9"))->sum("fees_sum");//该单位所有出行费用之和
                    if (empty($users[$i]["luqiaoCount"])) {
                        $users[$i]["luqiaoCount"] = 0;
                    }

                    $users[$i]["fuwufeiCount"] = $travelM->where($map)->where(array("state" => "9"))->sum("service_charge");//该单位所有出行费用之和
                    if (empty($users[$i]["fuwufeiCount"])) {
                        $users[$i]["fuwufeiCount"] = 0;
                    }

                    $users[$i]["buzhuCount"] = $travelM->where($map)->where(array("state" => "9"))->sum("driver_bt_cost");


                    $users[$i]["qitaCount"] = $travelM->where($map)->where(array("state" => "9"))->sum("parking_rate_sum") + $travelM->where($map)->where(array("state" => "9"))->sum("driver_cost") + $travelM->where($map)->where(array("state" => "9"))->sum("over_time_cost") + $travelM->where($map)->where(array("state" => "9"))->sum("over_mileage_cost") + $travelM->where($map)->where(array("state" => "9"))->sum("else_cost");//该单位所有出行费用之和

                    $users[$i]["heji"] = $users[$i]["luqiaoCount"] + $users[$i]["fuwufeiCount"] + $users[$i]["buzhuCount"] + $users[$i]["qitaCount"];


                    $hj["finishCount"]         += $users[$i]["finishCount"];
                    $hj["companyMileageCount"] += $users[$i]["companyMileageCount"];
                    $hj["luqiaoCount"]         += $users[$i]["luqiaoCount"];
                    $hj["fuwufeiCount"]        += $users[$i]["fuwufeiCount"];
                    $hj["buzhuCount"]          += $users[$i]["buzhuCount"];
                    $hj["qitaCount"]           += $users[$i]["qitaCount"];
                    $hj["heji"]                += $users[$i]["heji"];
                }
                $this->assign("hj", $hj);
                $this->assign("users", $users);
            }

            if ($_POST["type"] == 2) {
                if (empty($_POST["searchKey"])) {
                    $map["state"] = 9;
                } else {
                    $ids                = M("user")->where(array("user_name|user_phone" => array("like", "%" . trim($_REQUEST["searchKey"]) . "%")))->field("id")->select();
                    $map["use_user_id"] = array("IN", $ids ? array_column($ids, "id") : array(0));
//                    $map["use_user_id"]=$_POST["user"];
                    $map["state"] = 9;
                }
                $map["is_del"] = 0;
                $travels       = M("Travel")->where($map)->select();


                for ($i = 0; $i < count($travels) && count($travels) != 0; $i++) {
                    //获取用车人信息
                    $user                      = M("User")->find($travels[$i]["use_user_id"]);
                    $travels[$i]["user_name"]  = $user["user_name"];
                    $travels[$i]["user_phone"] = $user["user_phone"];

                    //单位信息
                    $companyyy                    = M("Company")->find($travels[$i]["company_id"]);
                    $travels[$i]["company_namee"] = $companyyy["company_name"];

                    //车辆信息
                    $car                    = M("Car")->find($travels[$i]["car_id"]);
                    $travels[$i]["car_num"] = $car["car_num"];

                    //司机信息
                    $driver                     = M("Driver")->find($travels[$i]["driver_id"]);
                    $travels[$i]["driver_name"] = $driver["driver_name"];

                }

                $this->assign("travels", $travels);
            }


//            G("end");
//            echo G('begin','end').'s';exit;
        }


        $this->assign("startTime", $startTime);
        $this->assign("endTime", $endTime);


        $this->display();
    }


    //用户报表导出
    public function user_import_to_csv()
    {

        set_time_limit(0);
//        Field( 'sum(total),sum(balance),sum(recover_capital)')->select()
        //获取开始时间
        if (!empty($_REQUEST["startTime"])) {
            $map['departure_time'] = array('gt', strtotime($_REQUEST["startTime"]));
        }

        if (!empty($_REQUEST["endTime"])) {
            $map['departure_time'] = array('elt', strtotime($_REQUEST["endTime"]) + 24 * 3600);
        }
        if ((!empty($_REQUEST["startTime"])) && !empty($_REQUEST["endTime"])) {
            $map['departure_time'] = array('between', array(strtotime($_REQUEST["startTime"]), strtotime($_REQUEST["endTime"]) + 24 * 3600));
        }
        if (!empty($_REQUEST["searchKey"])) {
            $key                          = trim($_REQUEST["searchKey"]);
            $mapc["user_phone|user_name"] = array("like", "%" . $key . "%");
        }

        header("Content-Type: text/html; charset=gbk");
        header("Content-Type:application/vnd.ms-excel");

        $mapc["is_del"] = 0;

        if ($_REQUEST["type"] == 1) {

            $excel_name = $_REQUEST["startTime"] . "至" . $_REQUEST["endTime"] . "用户数据统计";
            header("Content-Disposition:filename=" . iconv("UTF-8", "GBK", $excel_name) . ".csv");
            $fp          = fopen('php://output', 'a');
            $column_name = array("用车人", "联系电话", "出行次数", "出行里程", "路桥费", "出行服务费", "出差补助", "其他", "小计");
            foreach ($column_name as $i => $v) {
                $column_name[$i] = iconv('utf-8', 'GB18030', $v);
            }
            fputcsv($fp, $column_name);

            $users = M("User")->where($mapc)->select();
            $hj    = array(
                "finishCount"         => 0,
                "companyMileageCount" => 0,
                "luqiaoCount"         => 0,
                "fuwufeiCount"        => 0,
                "buzhuCount"          => 0,
                "qitaCount"           => 0,
                "heji"                => 0
            );

            for ($i = 0, $count = count($users); $i < $count && $count != 0; $i++) {
                $map['use_user_id'] = array('eq', $users[$i]["id"]);
                $map["is_del"]      = 0;

                $travelM             = new TravelModel();
                $finishCount         = $travelM->where($map)->where(array("state" => "9"))->count();
                $companyMileageCount = $travelM->where($map)->where(array("state" => "9"))->sum("mileage");
                $luqiaoCount         = $travelM->where($map)->where(array("state" => "9"))->sum("fees_sum");
                $fuwufeiCount        = $travelM->where($map)->where(array("state" => "9"))->sum("service_charge");
                $buzhuCount          = $travelM->where($map)->where(array("state" => "9"))->sum("driver_bt_cost");
                $qitaCount           = $travelM->where($map)->where(array("state" => "9"))->sum("parking_rate_sum") + $travelM->where($map)->where(array("state" => "9"))->sum("driver_cost") + $travelM->where($map)->where(array("state" => "9"))->sum("over_time_cost") + $travelM->where($map)->where(array("state" => "9"))->sum("over_mileage_cost") + $travelM->where($map)->where(array("state" => "9"))->sum("else_cost");//该单位所有出行费用之和
                $heji                = $luqiaoCount + $fuwufeiCount + $buzhuCount + $qitaCount;

                if ($finishCount) {
                    $data   = array();
                    $data[] = iconv("UTF-8", "GBK", $users[$i]["user_name"]);
                    $data[] = iconv("UTF-8", "GBK", $users[$i]["user_phone"]);
                    $data[] = iconv("UTF-8", "GBK", $finishCount);
                    $data[] = iconv("UTF-8", "GBK", $companyMileageCount);
                    $data[] = iconv("UTF-8", "GBK", $luqiaoCount);
                    $data[] = iconv("UTF-8", "GBK", $fuwufeiCount);
                    $data[] = iconv("UTF-8", "GBK", $buzhuCount);
                    $data[] = iconv("UTF-8", "GBK", $qitaCount);
                    $data[] = iconv("UTF-8", "GBK", $heji);
                    fputcsv($fp, $data);
                }

                $hj["finishCount"]         += $finishCount;
                $hj["companyMileageCount"] += $companyMileageCount;
                $hj["luqiaoCount"]         += $luqiaoCount;
                $hj["fuwufeiCount"]        += $fuwufeiCount;
                $hj["buzhuCount"]          += $buzhuCount;
                $hj["qitaCount"]           += $qitaCount;
                $hj["heji"]                += $heji;
            }

            $sum = array("合计", "", $hj["finishCount"], $hj["companyMileageCount"], $hj["luqiaoCount"], $hj["fuwufeiCount"], $hj["buzhuCount"], $hj["qitaCount"], $hj["heji"]);
            foreach ($sum as $i => $v) {
                $sum[$i] = iconv('utf-8', 'GB18030', $v);
            }
            fputcsv($fp, $sum);
        }

        if ($_REQUEST["type"] == 2) {
            $excel_name = $_REQUEST["startTime"] . "至" . $_REQUEST["endTime"] . "用户数据明细";
            header("Content-Disposition:filename=" . iconv("UTF-8", "GBK", $excel_name) . ".csv");
            $fp          = fopen('php://output', 'a');
            $column_name = array("用车人", "流水号", "用车单位", "出车时间", "目的地", "出行里程", "路桥费", "出行服务费", "出差补助", "其他", "小计");
            foreach ($column_name as $i => $v) {
                $column_name[$i] = iconv('utf-8', 'GB18030', $v);
            }
            fputcsv($fp, $column_name);

            $map["state"] = 9;
            if (!empty($_REQUEST["searchKey"])) {
                $ids                = M("user")->where(array("user_name|user_phone" => array("like", "%" . trim($_REQUEST["searchKey"]) . "%")))->field("id")->select();
                $map["use_user_id"] = array("IN", $ids ? array_column($ids, "id") : array(0));
            }
            $map["is_del"]     = 0;
            $travels           = M("Travel")->where($map)->select();
            $mileagenum        = 0;
            $fees_sumnum       = 0;
            $service_chargenum = 0;
            $costnum           = 0;
            $totle_ratenum     = 0;
            for ($i = 0, $count = count($travels); $i < $count && $count != 0; $i++) {
                //汇总
                $mileagenum        += $travels[$i]['mileage'];
                $fees_sumnum       += $travels[$i]['fees_sum'];
                $service_chargenum += $travels[$i]['service_charge'];
                $costnum           += $travels[$i]['else_cost'];
                $totle_ratenum     += $travels[$i]['totle_rate'];
                //获取用车人信息
                $user = M("User")->find($travels[$i]["use_user_id"]);
                //单位信息
                $company = M("Company")->find($travels[$i]["company_id"]);

                $data   = array();
                $data[] = iconv("UTF-8", "GBK", $user["user_name"]);
                $data[] = iconv("UTF-8", "GBK", $travels[$i]["serial_number"]);
                $data[] = iconv("UTF-8", "GBK", $company["company_name"]);
                $data[] = iconv("UTF-8", "GBK", date("Y-m-d H:i:s", $travels[$i]["start_car_time"]));
                $data[] = iconv("UTF-8", "GBK", $travels[$i]["to_place"]);
                $data[] = iconv("UTF-8", "GBK", $travels[$i]['mileage'] ? $travels[$i]['mileage'] : 0);
                $data[] = iconv("UTF-8", "GBK", $travels[$i]['fees_sum']);
                $data[] = iconv("UTF-8", "GBK", $travels[$i]['service_charge']);
                $data[] = iconv("UTF-8", "GBK", 0);
                $data[] = iconv("UTF-8", "GBK", $travels[$i]['else_cost']);
                $data[] = iconv("UTF-8", "GBK", $travels[$i]['totle_rate']);
                fputcsv($fp, $data);
            }

            $sum = array("合计", "", "", "", "", $mileagenum, $fees_sumnum, $service_chargenum, 0, $costnum, $totle_ratenum);
            foreach ($sum as $i => $v) {
                $sum[$i] = iconv('utf-8', 'GB18030', $v);
            }
            fputcsv($fp, $sum);

        }
        ob_flush();
        flush();
        exit;
    }

    //司机报表导出
    public function driver_import_to_csv()
    {

        //获取开始时间
        if (!empty($_REQUEST["startTime"])) {
            $map['departure_time'] = array('gt', strtotime($_REQUEST["startTime"]));
        }

        if (!empty($_REQUEST["endTime"])) {
            $map['departure_time'] = array('elt', strtotime($_REQUEST["endTime"]) + 24 * 3600);
        }
        if ((!empty($_REQUEST["startTime"])) && !empty($_REQUEST["endTime"])) {
            $map['departure_time'] = array('between', array(strtotime($_REQUEST["startTime"]), strtotime($_REQUEST["endTime"]) + 24 * 3600));
        }
        if (!empty($_REQUEST["searchKey"])) {
            $mapc["driver_name|driver_phone"] = array("like", "%" . trim($_REQUEST["searchKey"]) . "%");
        }

        $mapc["is_del"] = 0;

        header("Content-Type: text/html; charset=gbk");
        header("Content-type:application/vnd.ms-excel");

        if ($_REQUEST["type"] == 1) {
            $drivers = M("Driver")->where($mapc)->select();
            $hj      = array(
                "finishCount"         => 0,
                "companyMileageCount" => 0,
                "luqiaoCount"         => 0,
                "fuwufeiCount"        => 0,
                "buzhuCount"          => 0,
                "qitaCount"           => 0,
                "heji"                => 0
            );

            $excel_name = $_REQUEST["startTime"] . "至" . $_REQUEST["endTime"] . "司机数据统计";
            header("Content-Disposition:filename=" . iconv("UTF-8", "GBK", $excel_name) . ".csv");
            $fp          = fopen('php://output', 'a');
            $column_name = array("司机姓名", "联系电话", "出行次数", "出行里程", "路桥费", "出行服务费", "出差补助", "其他", "小计");
            foreach ($column_name as $i => $v) {
                $column_name[$i] = iconv('utf-8', 'GB18030', $v);
            }
            fputcsv($fp, $column_name);

            for ($i = 0, $count = count($drivers); $i < $count && $count != 0; $i++) {
                $map['driver_id'] = array('eq', $drivers[$i]["id"]);
                $map["is_del"]    = 0;

                $travelM             = new TravelModel();
                $finishCount         = $travelM->where($map)->where(array("state" => "9"))->count();
                $companyMileageCount = $travelM->where($map)->where(array("state" => "9"))->sum("mileage");
                $luqiaoCount         = $travelM->where($map)->where(array("state" => "9"))->sum("fees_sum");
                $fuwufeiCount        = $travelM->where($map)->where(array("state" => "9"))->sum("service_charge");
                $buzhuCount          = $travelM->where($map)->where(array("state" => "9"))->sum("driver_bt_cost");
                $qitaCount           = $travelM->where($map)->where(array("state" => "9"))->sum("parking_rate_sum") + $travelM->where($map)->where(array("state" => "9"))->sum("driver_cost") + $travelM->where($map)->where(array("state" => "9"))->sum("over_time_cost") + $travelM->where($map)->where(array("state" => "9"))->sum("over_mileage_cost") + $travelM->where($map)->where(array("state" => "9"))->sum("else_cost");
                $heji                = $luqiaoCount + $fuwufeiCount + $buzhuCount + $qitaCount;

                $hj["finishCount"]         += $finishCount;
                $hj["companyMileageCount"] += $companyMileageCount;
                $hj["luqiaoCount"]         += $luqiaoCount;
                $hj["fuwufeiCount"]        += $fuwufeiCount;
                $hj["buzhuCount"]          += $buzhuCount;
                $hj["qitaCount"]           += $qitaCount;
                $hj["heji"]                += $heji;

                if ($finishCount) {
                    $data   = array();
                    $data[] = iconv('utf-8', 'GB18030', $drivers[$i]["driver_name"]);
                    $data[] = iconv('utf-8', 'GB18030', $drivers[$i]["driver_phone"]);
                    $data[] = iconv('utf-8', 'GB18030', $finishCount);
                    $data[] = iconv('utf-8', 'GB18030', $companyMileageCount);
                    $data[] = iconv('utf-8', 'GB18030', $luqiaoCount);
                    $data[] = iconv('utf-8', 'GB18030', $fuwufeiCount);
                    $data[] = iconv('utf-8', 'GB18030', $buzhuCount);
                    $data[] = iconv('utf-8', 'GB18030', $qitaCount);
                    $data[] = iconv('utf-8', 'GB18030', $heji);
                    fputcsv($fp, $data);
                }
            }

            $sum = array("合计", "", $hj["finishCount"], $hj["companyMileageCount"], $hj["luqiaoCount"], $hj["fuwufeiCount"], $hj["buzhuCount"], $hj["qitaCount"], $hj["heji"]);
            foreach ($sum as $i => $v) {
                $sum[$i] = iconv('utf-8', 'GB18030', $v);
            }
            fputcsv($fp, $sum);
        }


        if ($_REQUEST["type"] == 2) {
            if (empty($_REQUEST["searchKey"])) {
                $map["state"] = 9;
            } else {
                $driver_ids       = M("driver")->where(array("driver_name|driver_phone" => array("like", "%" . trim($_REQUEST["searchKey"]) . "%")))->field("id")->select();
                $map["driver_id"] = array("IN", $driver_ids ? array_column($driver_ids, "id") : array(0));
                $map["state"]     = 9;
            }
            $map["is_del"] = 0;
            $travels       = M("Travel")->where($map)->select();
            $excel_name    = $_REQUEST["startTime"] . "至" . $_REQUEST["endTime"] . "司机数据明细";
            header("Content-Disposition:filename=" . iconv("UTF-8", "GBK", $excel_name) . ".csv");
            $fp = fopen('php://output', 'a');

            $column_name = array("司机姓名", "流水号", "用车单位", "用车人", "出车时间", "目的地", "出行里程", "路桥费", "出行服务费", "出差补助", "其他", "小计");
            foreach ($column_name as $i => $v) {
                $column_name[$i] = iconv('utf-8', 'GB18030', $v);
            }
            fputcsv($fp, $column_name);
            $mileagenum        = 0;
            $fees_sumnum       = 0;
            $service_chargenum = 0;
            $costnum           = 0;
            $totle_ratenum     = 0;

            for ($i = 0, $count = count($travels); $i < $count && $count != 0; $i++) {
                //获取用车人信息
                $user = M("User")->where(array("id" => $travels[$i]["use_user_id"]))->field("user_name")->find();

                //单位信息
                $company = M("Company")->where(array("id" => $travels[$i]["company_id"]))->field("company_name")->find();

                //司机信息
                $driver = M("Driver")->where(array("id" => $travels[$i]["driver_id"]))->field("driver_name")->find();

                $data   = array();
                $data[] = iconv('utf-8', 'GB18030', $driver['driver_name']);
                $data[] = iconv('utf-8', 'GB18030', $travels[$i]["serial_number"]);
                $data[] = iconv('utf-8', 'GB18030', $company['company_name']);
                $data[] = iconv('utf-8', 'GB18030', $user['user_name']);
                $data[] = iconv('utf-8', 'GB18030', date("Y-m-d H:i:s", $travels[$i]["start_car_time"]));
                $data[] = iconv('utf-8', 'GB18030', $travels[$i]["to_place"]);
                $data[] = iconv('utf-8', 'GB18030', $travels[$i]["mileage"]);
                $data[] = iconv('utf-8', 'GB18030', $travels[$i]["fees_sum"]);
                $data[] = iconv('utf-8', 'GB18030', $travels[$i]["service_charge"]);
                $data[] = iconv('utf-8', 'GB18030', 0);
                $data[] = iconv('utf-8', 'GB18030', $travels[$i]["else_cost"]);
                $data[] = iconv('utf-8', 'GB18030', $travels[$i]["totle_rate"]);

                fputcsv($fp, $data);

                //汇总
                $mileagenum        += $travels[$i]['mileage'];
                $fees_sumnum       += $travels[$i]['fees_sum'];
                $service_chargenum += $travels[$i]['service_charge'];
                $costnum           += $travels[$i]['else_cost'];
                $totle_ratenum     += $travels[$i]['totle_rate'];
            }
            $sum = array("合计", "", "", "", "", "", $mileagenum, $fees_sumnum, $service_chargenum, 0, $costnum, $totle_ratenum);
            foreach ($sum as $i => $v) {
                $sum[$i] = iconv('utf-8', 'GB18030', $v);
            }
            fputcsv($fp, $sum);
        }

        ob_flush();
        flush();
        exit;
    }

    //车辆报表导出
    public function car_import_to_csv()
    {

        //获取开始时间
        if (!empty($_REQUEST["startTime"])) {
            $map['departure_time'] = array('gt', strtotime($_REQUEST["startTime"]));
        }

        if (!empty($_REQUEST["endTime"])) {
            $map['departure_time'] = array('elt', strtotime($_REQUEST["endTime"]) + 24 * 3600);
        }
        if ((!empty($_REQUEST["startTime"])) && !empty($_REQUEST["endTime"])) {
            $map['departure_time'] = array('between', array(strtotime($_REQUEST["startTime"]), strtotime($_REQUEST["endTime"]) + 24 * 3600 - 1));
        }
        if ($_REQUEST["car"] != 0) {
            $mapc["id"] = $_REQUEST["car"];
        }

        $mapc["is_del"] = 0;

        if ($_REQUEST["type"] == 1) {
            if ($_REQUEST["company"] != 0) {
                $map["company_id"] = $_REQUEST["company"];
            }

            $cars = M("Car")->where($mapc)->select();

            $hj = array(
                "finishCount"         => 0,
                "companyMileageCount" => 0,
                "luqiaoCount"         => 0,
                "fuwufeiCount"        => 0,
                "buzhuCount"          => 0,
                "qitaCount"           => 0,
                "heji"                => 0,
                "xiche"               => 0,
                "weixiu"              => 0,
                "jiayou"              => 0,
                "nianjian"            => 0,
                "xiaoji"              => 0
            );

            for ($i = 0, $count = count($cars); $i < $count && $count != 0; $i++) {
                $map['car_id'] = array('eq', $cars[$i]["id"]);
                $map["is_del"] = 0;

                $travelM                 = new TravelModel();
                $cars[$i]["finishCount"] = $travelM->where($map)->where(array("state" => "9"))->count();

                $cars[$i]["companyMileageCount"] = $travelM->where($map)->where(array("state" => "9"))->sum("mileage");//该单位所有出行费用之和
                if (empty($cars[$i]["companyMileageCount"])) {
                    $cars[$i]["companyMileageCount"] = 0;
                }

                $cars[$i]["luqiaoCount"] = $travelM->where($map)->where(array("state" => "9"))->sum("fees_sum");//该单位所有出行费用之和
                if (empty($cars[$i]["luqiaoCount"])) {
                    $cars[$i]["luqiaoCount"] = 0;
                }

                $cars[$i]["fuwufeiCount"] = $travelM->where($map)->where(array("state" => "9"))->sum("service_charge");//该单位所有出行费用之和
                if (empty($cars[$i]["fuwufeiCount"])) {
                    $cars[$i]["fuwufeiCount"] = 0;
                }

                $cars[$i]["buzhuCount"] = $travelM->where($map)->where(array("state" => "9"))->sum("driver_bt_cost");
                $cars[$i]["qitaCount"]  = $travelM->where($map)->where(array("state" => "9"))->sum("parking_rate_sum") + $travelM->where($map)->where(array("state" => "9"))->sum("driver_cost") + $travelM->where($map)->where(array("state" => "9"))->sum("over_time_cost") + $travelM->where($map)->where(array("state" => "9"))->sum("over_mileage_cost") + $travelM->where($map)->where(array("state" => "9"))->sum("else_cost");//该单位所有出行费用之和
                $cars[$i]["heji"]       = $cars[$i]["luqiaoCount"] + $cars[$i]["fuwufeiCount"] + $cars[$i]["buzhuCount"] + $cars[$i]["qitaCount"];

                //计算维修保养费用
                $xiche['car_id']    = array('eq', $cars[$i]["id"]);
                $xiche["is_del"]    = array('eq', 0);
                $xiche["wash_time"] = $map['departure_time'];

                $weixiu['car_id']     = array('eq', $cars[$i]["id"]);
                $weixiu["is_del"]     = array('eq', 0);
                $weixiu["start_time"] = $map['departure_time'];

                $jiayou['car_id']       = array('eq', $cars[$i]["id"]);
                $jiayou["is_del"]       = array('eq', 0);
                $jiayou["trading_time"] = $map['departure_time'];

                $nianjian['car_id']   = array('eq', $cars[$i]["id"]);
                $nianjian["is_del"]   = array('eq', 0);
                $nianjian["pay_time"] = $map['departure_time'];

                $cars[$i]["xiche"]    = M("CostWash")->where($xiche)->sum("cost");
                $cars[$i]["weixiu"]   = M("CostRepair")->where($weixiu)->sum("cost");
                $cars[$i]["jiayou"]   = M("CostOil")->where($jiayou)->sum("cost");
                $cars[$i]["nianjian"] = M("CostInsurance")->where($nianjian)->sum("cost");
                $cars[$i]["xiaoji"]   = $cars[$i]["xiche"] + $cars[$i]["weixiu"] + $cars[$i]["jiayou"] + $cars[$i]["nianjian"];

                $hj["finishCount"]         += $cars[$i]["finishCount"];
                $hj["companyMileageCount"] += $cars[$i]["companyMileageCount"];
                $hj["luqiaoCount"]         += $cars[$i]["luqiaoCount"];
                $hj["fuwufeiCount"]        += $cars[$i]["fuwufeiCount"];
                $hj["buzhuCount"]          += $cars[$i]["buzhuCount"];
                $hj["qitaCount"]           += $cars[$i]["qitaCount"];
                $hj["heji"]                += $cars[$i]["heji"];
                $hj["xiche"]               += $cars[$i]["xiche"];
                $hj["weixiu"]              += $cars[$i]["weixiu"];
                $hj["jiayou"]              += $cars[$i]["jiayou"];
                $hj["nianjian"]            += $cars[$i]["nianjian"];
                $hj["xiaoji"]              += $cars[$i]["xiaoji"];
            }

            //导出数据
            header("Content-Type: text/html; charset=gbk");
            header("Content-type:application/vnd.ms-excel");
            $excel_name = $_REQUEST["startTime"] . "至" . $_REQUEST["endTime"] . "车辆数据统计";
            header("Content-Disposition:filename=" . iconv("UTF-8", "GBK", $excel_name) . ".csv");
            $fp = fopen('php://output', 'a');

            $column_name = array("车牌号码", "出行次数", "出行里程", "路桥费", "停车费", "住宿费", "出行服务费", "出差补助", "其他", "小计", "洗车", "维修", "加油", "年检/保养", "小计");
            foreach ($column_name as $i => $v) {
                $column_name[$i] = iconv('utf-8', 'GB18030', $v);
            }
            fputcsv($fp, $column_name);

            foreach ($cars as $k => $v) {
                if ($v["finishCount"]) {
                    $data   = array();
                    $data[] = iconv('utf-8', 'GB18030', $v["car_num"]);
                    $data[] = iconv('utf-8', 'GB18030', $v["finishCount"]);
                    $data[] = iconv('utf-8', 'GB18030', $v["companyMileageCount"]);
                    $data[] = iconv('utf-8', 'GB18030', $v["luqiaoCount"]);
                    $data[] = iconv('utf-8', 'GB18030', $v["tingcheCount"]);
                    $data[] = iconv('utf-8', 'GB18030', $v['zhushuCount']);
                    $data[] = iconv('utf-8', 'GB18030', $v['fuwufeiCount']);
                    $data[] = iconv('utf-8', 'GB18030', $v['buzhuCount']);
                    $data[] = iconv('utf-8', 'GB18030', $v['qitaCount']);
                    $data[] = iconv('utf-8', 'GB18030', $v['heji']);
                    $data[] = iconv('utf-8', 'GB18030', $v["xiche"]);
                    $data[] = iconv('utf-8', 'GB18030', $v["weixiu"]);
                    $data[] = iconv('utf-8', 'GB18030', $v["jiayou"]);
                    $data[] = iconv('utf-8', 'GB18030', $v['nianjian']);
                    $data[] = iconv('utf-8', 'GB18030', $v['xiaoji']);
                    fputcsv($fp, $data);
                }
            }
            $sum = array("合计", $hj["finishCount"], $hj["companyMileageCount"], $hj["luqiaoCount"], $hj["tingcheCount"], $hj["zhushuCount"], $hj["fuwufeiCount"], $hj["buzhuCount"], $hj["qitaCount"], $hj["heji"], $hj["xiche"], $hj["weixiu"], $hj["jiayou"], $hj["nianjian"], $hj["xiaoji"],);
            foreach ($sum as $i => $v) {
                $sum[$i] = iconv('utf-8', 'GB18030', $v);
            }
            fputcsv($fp, $sum);
        }

        if ($_REQUEST["type"] == 2) {

            if ($_REQUEST["company"] != 0) {
                $mapc["company_id"] = $_REQUEST["company"];
            }

            $map["state"] = 9;
            if ($_REQUEST["car"]) {
                $map["car_id"] = intval($_REQUEST["car"]);
            }

            if ($_REQUEST["company"] != 0) {
                $map["company_id"] = $_REQUEST["company"];
            }

            $travels = M("Travel")->where($map)->where("is_del=0")->select();

            for ($i = 0; $i < count($travels) && count($travels) != 0; $i++) {
                //获取用车人信息
                $user                     = M("User")->find($travels[$i]["use_user_id"]);
                $travels[$i]["user_name"] = $user["user_name"];

                //单位信息
                $companyyy                    = M("Company")->find($travels[$i]["company_id"]);
                $travels[$i]["company_namee"] = $companyyy["company_name"];

                //车辆信息
                $car                    = M("Car")->find($travels[$i]["car_id"]);
                $travels[$i]["car_num"] = $car["car_num"];

                //司机信息
                $driver                     = M("Driver")->find($travels[$i]["driver_id"]);
                $travels[$i]["driver_name"] = $driver["driver_name"];

            }

            //导出数据
            header("Content-Type: text/html; charset=gbk");
            header("Content-type:application/vnd.ms-excel");
            $excel_name = $_REQUEST["startTime"] . "至" . $_REQUEST["endTime"] . "车辆数据明细";
            header("Content-Disposition:filename=" . iconv("UTF-8", "GBK", $excel_name) . ".csv");
            $fp = fopen('php://output', 'a');

            $column_name = array("车牌号码", "流水号", "出车司机", "用车单位", "用车人", "出车时间", "目的地", "出行里程", "路桥费", "出行服务费", "出差补助", "其他", "小计");
            foreach ($column_name as $i => $v) {
                $column_name[$i] = iconv('utf-8', 'GB18030', $v);
            }
            fputcsv($fp, $column_name);

            $mileagenum        = 0;
            $fees_sumnum       = 0;
            $service_chargenum = 0;
            $costnum           = 0;
            $totle_ratenum     = 0;
            foreach ($travels as $k => $v) {
                $mileagenum        += $v['mileage'];
                $fees_sumnum       += $v['fees_sum'];
                $service_chargenum += $v['service_charge'];
                $costnum           += $v['else_cost'];
                $totle_ratenum     += $v['totle_rate'];

                $data   = array();
                $data[] = iconv('utf-8', 'GB18030', $v["car_num"]);
                $data[] = iconv('utf-8', 'GB18030', $v["serial_number"]);
                $data[] = iconv('utf-8', 'GB18030', $v["driver_name"]);
                $data[] = iconv('utf-8', 'GB18030', $v["company_namee"]);
                $data[] = iconv('utf-8', 'GB18030', $v["user_name"]);
                $data[] = iconv('utf-8', 'GB18030', date("Y-m-d H:i:s", $v['start_car_time']));
                $data[] = iconv('utf-8', 'GB18030', $v['to_place']);
                $data[] = iconv('utf-8', 'GB18030', $v['mileage']);
                $data[] = iconv('utf-8', 'GB18030', $v['fees_sum']);
                $data[] = iconv('utf-8', 'GB18030', $v['service_charge']);
                $data[] = iconv('utf-8', 'GB18030', 0);
                $data[] = iconv('utf-8', 'GB18030', $v["else_cost"]);
                $data[] = iconv('utf-8', 'GB18030', $v["totle_rate"]);
                fputcsv($fp, $data);
            }
            $sum = array("合计", "", "", "", "", "", "", $mileagenum, $fees_sumnum, $service_chargenum, 0, $costnum, $totle_ratenum);
            foreach ($sum as $i => $v) {
                $sum[$i] = iconv('utf-8', 'GB18030', $v);
            }
            fputcsv($fp, $sum);
        }
        ob_flush();
        flush();
        exit;
    }

    //单位报表导出
    public function company_import_to_csv()
    {
        $map  = array();
        $mapc = array();

        //获取开始时间
        if (!empty($_REQUEST["startTime"])) {
            $map['departure_time'] = array('gt', strtotime($_REQUEST["startTime"]));
        } elseif (!empty($_REQUEST["endTime"])) {
            $map['departure_time'] = array('elt', strtotime($_REQUEST["endTime"]) + 24 * 3600);
        } elseif ((!empty($_REQUEST["startTime"])) && !empty($_REQUEST["endTime"])) {
            $map['departure_time'] = array('between', array(strtotime($_REQUEST["startTime"]), strtotime($_REQUEST["endTime"]) + 24 * 3600));
        }
        if (!empty($_REQUEST["searchKey"])) {
            $mapc["company_name"] = array("like", "%" . trim($_REQUEST["searchKey"]) . "%");
        }

        $mapc["is_del"] = 0;

        if ($_REQUEST["type"] == 1) {  //统计报表
            $companys = M("Company")->where($mapc)->select();
            $hj       = array(
                "finishCount"         => 0,
                "companyMileageCount" => 0,
                "luqiaoCount"         => 0,
                "fuwufeiCount"        => 0,
                "buzhuCount"          => 0,
                "qitaCount"           => 0,
                "heji"                => 0
            );

            for ($i = 0; $i < count($companys) && count($companys) != 0; $i++) {
                $map['company_id'] = array('eq', $companys[$i]["id"]);
                $map["is_del"]     = 0;

                $travelM                             = new TravelModel();
                $companys[$i]["finishCount"]         = $travelM->where($map)->where(array("state" => "9"))->count();
                $companys[$i]["companyMileageCount"] = $travelM->where($map)->where(array("state" => "9"))->sum("mileage");//该单位所有出行费用之和
                if (empty($companys[$i]["companyMileageCount"])) {
                    $companys[$i]["companyMileageCount"] = 0;
                }

                $companys[$i]["luqiaoCount"] = $travelM->where($map)->where(array("state" => "9"))->sum("fees_sum");//该单位所有出行费用之和
                if (empty($companys[$i]["luqiaoCount"])) {
                    $companys[$i]["luqiaoCount"] = 0;
                }

                $companys[$i]["fuwufeiCount"] = $travelM->where($map)->where(array("state" => "9"))->sum("service_charge");//该单位所有出行费用之和
                if (empty($companys[$i]["fuwufeiCount"])) {
                    $companys[$i]["fuwufeiCount"] = 0;
                }

                $companys[$i]["buzhuCount"] = $travelM->where($map)->where(array("state" => "9"))->sum("driver_bt_cost");


                $companys[$i]["qitaCount"] = $travelM->where($map)->where(array("state" => "9"))->sum("parking_rate_sum") + $travelM->where($map)->where(array("state" => "9"))->sum("driver_cost") + $travelM->where($map)->where(array("state" => "9"))->sum("over_time_cost") + $travelM->where($map)->where(array("state" => "9"))->sum("over_mileage_cost") + $travelM->where($map)->where(array("state" => "9"))->sum("else_cost");//该单位所有出行费用之和

                $companys[$i]["heji"] = $companys[$i]["luqiaoCount"] + $companys[$i]["fuwufeiCount"] + $companys[$i]["buzhuCount"] + $companys[$i]["qitaCount"];


                $hj["finishCount"]         += $companys[$i]["finishCount"];
                $hj["companyMileageCount"] += $companys[$i]["companyMileageCount"];
                $hj["luqiaoCount"]         += $companys[$i]["luqiaoCount"];
                $hj["fuwufeiCount"]        += $companys[$i]["fuwufeiCount"];
                $hj["buzhuCount"]          += $companys[$i]["buzhuCount"];
                $hj["qitaCount"]           += $companys[$i]["qitaCount"];
                $hj["heji"]                += $companys[$i]["heji"];
            }

            //导出数据
            header("Content-Type: text/html; charset=gbk");
            header("Content-type:application/vnd.ms-excel");
            $excel_name = $_REQUEST["startTime"] . "至" . $_REQUEST["endTime"] . "单位数据统计";
            header("Content-Disposition:filename=" . iconv("UTF-8", "GBK", $excel_name) . ".csv");
            $fp = fopen('php://output', 'a');

            $column_name = array("单位名称", "出行次数", "出行里程", "路桥费", "出行服务费", "出差补助", "其他", "小计");
            foreach ($column_name as $i => $v) {
                $column_name[$i] = iconv('utf-8', 'GB18030', $v);
            }
            fputcsv($fp, $column_name);

            foreach ($companys as $k => $v) {
                if ($v["finishCount"]) {
                    $data   = array();
                    $data[] = iconv('utf-8', 'GB18030', $v["company_name"]);
                    $data[] = iconv('utf-8', 'GB18030', $v["finishCount"]);
                    $data[] = iconv('utf-8', 'GB18030', $v["companyMileageCount"]);
                    $data[] = iconv('utf-8', 'GB18030', $v['luqiaoCount']);
                    $data[] = iconv('utf-8', 'GB18030', $v['fuwufeiCount']);
                    $data[] = iconv('utf-8', 'GB18030', $v['buzhuCount']);
                    $data[] = iconv('utf-8', 'GB18030', $v['qitaCount']);
                    $data[] = iconv('utf-8', 'GB18030', $v['heji']);
                    fputcsv($fp, $data);
                }
            }
            $sum = array("合计", $hj["finishCount"], $hj["companyMileageCount"], $hj["luqiaoCount"], $hj["fuwufeiCount"], $hj["buzhuCount"], $hj["qitaCount"], $hj["heji"],);
            foreach ($sum as $i => $v) {
                $sum[$i] = iconv('utf-8', 'GB18030', $v);
            }
            fputcsv($fp, $sum);
        } elseif ($_REQUEST["type"] == 2) {  //明细报表

            if (empty($_REQUEST["searchKey"])) {
                $map["state"] = 9;
            } else {
                $company_ids       = M("company")->where(array("company_name" => array("like", "%" . trim($_REQUEST["searchKey"]) . "%")))->field("id")->select();
                $map["company_id"] = array("IN", $company_ids ? array_column($company_ids, "id") : array(0));
                $map["state"]      = 9;
            }
            $travels = M("Travel")->where($map)->where("is_del=0")->select();
            for ($i = 0, $count = count($travels); $i < $count && $count != 0; $i++) {
                //获取用车人信息
                $user                         = M("User")->find($travels[$i]["use_user_id"]);
                $travels[$i]["user_name"]     = $user["user_name"];
                $companyyy                    = M("Company")->find($travels[$i]["company_id"]);
                $travels[$i]["company_namee"] = $companyyy["company_name"];
            }

            //导出数据
            header("Content-Type: text/html; charset=gbk");
            header("Content-type:application/vnd.ms-excel");
            $excel_name = $_REQUEST["startTime"] . "至" . $_REQUEST["endTime"] . "单位数据明细";
            header("Content-Disposition:filename=" . iconv("UTF-8", "GBK", $excel_name) . ".csv");
            $fp = fopen('php://output', 'a');

            $column_name = array("单位名称", "流水号", "用车人", "用车时间", "用车事由", "目的地", "出行里程", "路桥费", "出行服务费", "出差补助", "其他", "小计");
            foreach ($column_name as $i => $v) {
                $column_name[$i] = iconv('utf-8', 'GB18030', $v);
            }
            fputcsv($fp, $column_name);

            $mileagenum        = 0;
            $fees_sumnum       = 0;
            $service_chargenum = 0;
            $costnum           = 0;
            $totle_ratenum     = 0;
            foreach ($travels as $k => $v) {
                $mileagenum        += $v['mileage'];
                $fees_sumnum       += $v['fees_sum'];
                $service_chargenum += $v['service_charge'];
                $costnum           += $v['else_cost'];
                $totle_ratenum     += $v['totle_rate'];

                $data   = array();
                $data[] = iconv('utf-8', 'GB18030', $v["company_namee"]);
                $data[] = iconv('utf-8', 'GB18030', $v["serial_number"]);
                $data[] = iconv('utf-8', 'GB18030', $v["user_name"]);
                $data[] = iconv('utf-8', 'GB18030', date("Y-m-d H:i:s", $v["start_car_time"]));
                $data[] = iconv('utf-8', 'GB18030', $v["travel_reason"]);
                $data[] = iconv('utf-8', 'GB18030', $v["to_place"]);
                $data[] = iconv('utf-8', 'GB18030', $v["mileage"]);
                $data[] = iconv('utf-8', 'GB18030', $v['fees_sum']);
                $data[] = iconv('utf-8', 'GB18030', $v['service_charge']);
                $data[] = iconv('utf-8', 'GB18030', 0);
                $data[] = iconv('utf-8', 'GB18030', $v['else_cost']);
                $data[] = iconv('utf-8', 'GB18030', $v['totle_rate']);
                fputcsv($fp, $data);
            }
            $sum = array("合计", "", "", "", "", "", $mileagenum, $fees_sumnum, $service_chargenum, 0, $costnum, $totle_ratenum);
            foreach ($sum as $i => $v) {
                $sum[$i] = iconv('utf-8', 'GB18030', $v);
            }
            fputcsv($fp, $sum);
        }
        ob_flush();
        flush();
        exit;
    }


}

