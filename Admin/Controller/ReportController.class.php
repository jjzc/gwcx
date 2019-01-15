<?php

namespace Admin\Controller;

use Model\TravelModel;
use Model\CompanyModel;
use Think\Page;

class ReportController extends CommonController
{
    //单位数据报表
    public function byCompany()
    {
        if (empty($_POST)) {
            $this->assign("aa", "0");
        } else {

            $startTime    = trim($_REQUEST['startTime']);
            $endTime      = trim($_REQUEST['endTime']);
            $type         = intval($_REQUEST["type"]);
            $searchKey    = trim($_REQUEST["searchKey"]);
            $travelNature = trim($_REQUEST["travelNature"]);

            $map             = array();
            $map['t.is_del'] = 0;
            $map['t.state']  = 9;

            //获取开始时间
            if (!empty($startTime) && empty($endTime)) {
                $map['t.departure_time'] = array('gt', strtotime($startTime));
            } elseif (!empty($endTime) && empty($startTime)) {
                $map['t.departure_time'] = array('elt', strtotime($endTime) + 24 * 3600);
            } elseif ((!empty($startTime)) && !empty($endTime)) {
                $map['t.departure_time'] = array('between', array(strtotime($startTime), strtotime($endTime) + 24 * 3600));
            }

            $this->assign("nature_name", $travelNature);
            $this->assign("companyname", $searchKey);
            $this->assign("type", $type);
            $this->assign("aa", "1");

            if ($type == 1) {
                $map['c.is_del'] = 0;

                if (!empty($searchKey)) {
                    $map["c.company_name"] = array("like", "%" . $searchKey . "%");
                }

                $count = M("Company as c")->join("left join " . C("DB_PREFIX") . "travel as t on c.id =  t.company_id")->where($map)->group("t.company_id")->having('count(t.company_id)>=1')->field('company_id')->select();

                $pageSize = 10;

                $Page = new Page(count($count), $pageSize);

                $Page->setConfig('header', '<li class="rows">共<b>%TOTAL_ROW%</b>条记录 第<b>%NOW_PAGE%</b>页/共<b>%TOTAL_PAGE%</b>页</li>');
                $Page->setConfig('prev', '上一页');
                $Page->setConfig('next', '下一页');
                $Page->setConfig('last', '末页');
                $Page->setConfig('first', '首页');
                $Page->setConfig('theme', '%FIRST%%UP_PAGE%%LINK_PAGE%%DOWN_PAGE%%END%%HEADER%');
                $Page->lastSuffix = false;

                $field = 't.company_id,c.company_name,count(t.company_id) AS finishCount,sum(t.mileage) as companyMileageCount,sum(t.fees_sum) as luqiaoCount ,sum(t.service_charge) as fuwufeiCount,sum(t.driver_bt_cost) as buzhuCount,sum(t.parking_rate_sum) as t1,sum(t.driver_cost) as t2,sum(t.over_time_cost) as t3,sum(t.over_mileage_cost) as t4,sum(t.else_cost) as t5 ';

                $companys = M("Company as c")->join("left join " . C("DB_PREFIX") . "travel as t on c.id =  t.company_id")->where($map)->group("t.company_id")->field($field)->limit($Page->firstRow . ',' . $Page->listRows)->having('finishCount>=1')->select();

                foreach ($companys as &$val) {
                    $val["finishCount"]         = $val['finishcount'];
                    $val["companyMileageCount"] = $val["companymileagecount"] ? $val["companymileagecount"] : 0;
                    $val["luqiaoCount"]         = $val["luqiaocount"] ? $val["luqiaocount"] : 0;
                    $val["fuwufeiCount"]        = $val["fuwufeicount"] ? $val["fuwufeicount"] : 0;
                    $val["buzhuCount"]          = $val["buzhucount"] ? $val["buzhucount"] : 0;
                    $val["qitaCount"]           = $val["t1"] + $val["t2"] + $val["t3"] + $val["t4"] + $val["t5"];
                    $val["heji"]                = $val["luqiaoCount"] + $val["fuwufeiCount"] + $val["buzhuCount"] + $val["qitaCount"];
                }
                unset($val);
                $this->assign("page", $Page->show());
                $this->assign("companys", $companys);
            } else {

                if (!empty($searchKey)) {
                    $company_ids = M("company")->where(array("company_name" => array("like", "%" . $searchKey . "%")))->field("id")->select();  //查询是否匹配单位名称
                    $user_ids    = M("user")->where(array("user_name" => array("like", "%" . $searchKey . "%")))->field("id")->select();  //查询是否匹配用车人
                    if ($company_ids) {
                        $map["t.company_id"] = array("IN", $company_ids ? $this->_array_column($company_ids, "id") : array(0));
                    } elseif ($user_ids) {
                        $map["t.use_user_id"] = array("IN", $user_ids ? $this->_array_column($user_ids, "id") : array(0));
                    }

                }

                if ($travelNature) {
                    $map["t.travel_nature"] = $travelNature;
                }

                $count = M("Travel as t")->join("left join " . C("DB_PREFIX") . "company as c on c.id =  t.company_id left join " . C("DB_PREFIX") . "user u on u.id = t.use_user_id")->where($map)->count();

                $pageSize = 10;

                $Page = new Page($count, $pageSize);
                $Page->setConfig('header', '<li class="rows">共<b>%TOTAL_ROW%</b>条记录 第<b>%NOW_PAGE%</b>页/共<b>%TOTAL_PAGE%</b>页</li>');
                $Page->setConfig('prev', '上一页');
                $Page->setConfig('next', '下一页');
                $Page->setConfig('last', '末页');
                $Page->setConfig('first', '首页');
                $Page->setConfig('theme', '%FIRST%%UP_PAGE%%LINK_PAGE%%DOWN_PAGE%%END%%HEADER%');
                $Page->lastSuffix = false;

                $travels = M("Travel as t")
                    ->join("left join " . C("DB_PREFIX") . "company as c on c.id =  t.company_id left join " . C("DB_PREFIX") . "user u on u.id = t.use_user_id")
                    ->where($map)
                    ->limit($Page->firstRow . ',' . $Page->listRows)
                    ->field("u.user_name,c.company_name as company_namee,t.use_user_id,t.company_id,t.travel_nature,t.serial_number,t.start_car_time,t.to_place,t.mileage,t.fees_sum,t.service_charge,t.else_cost,t.totle_rate")
                    ->select();

                $this->assign("page", $Page->show());
                $this->assign("travels", $travels);
            }
        }

        //出行性质
        $travelNature = M("travelNature")->where(" is_del = 0")->select();

        $this->assign("travelNature", $travelNature);
        $this->assign("startTime", $startTime ? $startTime : date('Y-m-01', strtotime(date("Y-m-d"))));
        $this->assign("endTime", $endTime ? $endTime : date('Y-m-d', strtotime(date("Y-m-d"))));
        $this->display();
    }

    //车辆数据报表
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

    //司机数据报表
    public function byDriver()
    {
        $startTime = date('Y-m-01', strtotime(date("Y-m-d")));
        $endTime   = date('Y-m-d', strtotime(date("Y-m-d")));

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

//                for ($i = 0; $i < count($drivers) && count($drivers) != 0; $i++) {
//                    $map['driver_id'] = array('eq', $drivers[$i]["id"]);
//                    $map["is_del"]    = 0;
//
//                    $travelM                            = new TravelModel();
//                    $drivers[$i]["finishCount"]         = $travelM->where($map)->where(array("state" => "9"))->count();
//                    $drivers[$i]["companyMileageCount"] = $travelM->where($map)->where(array("state" => "9"))->sum("mileage");//该单位所有出行费用之和
//                    if (empty($drivers[$i]["companyMileageCount"])) {
//                        $drivers[$i]["companyMileageCount"] = 0;
//                    }
//
//
//                    $drivers[$i]["luqiaoCount"] = $travelM->where($map)->where(array("state" => "9"))->sum("fees_sum");//该单位所有出行费用之和
//                    if (empty($drivers[$i]["luqiaoCount"])) {
//                        $drivers[$i]["luqiaoCount"] = 0;
//                    }
//
//                    $drivers[$i]["fuwufeiCount"] = $travelM->where($map)->where(array("state" => "9"))->sum("service_charge");//该单位所有出行费用之和
//                    if (empty($drivers[$i]["fuwufeiCount"])) {
//                        $drivers[$i]["fuwufeiCount"] = 0;
//                    }
//
//                    $drivers[$i]["buzhuCount"] = $travelM->where($map)->where(array("state" => "9"))->sum("driver_bt_cost");
//
//
//                    $drivers[$i]["qitaCount"] = $travelM->where($map)->where(array("state" => "9"))->sum("parking_rate_sum") + $travelM->where($map)->where(array("state" => "9"))->sum("driver_cost") + $travelM->where($map)->where(array("state" => "9"))->sum("over_time_cost") + $travelM->where($map)->where(array("state" => "9"))->sum("over_mileage_cost") + $travelM->where($map)->where(array("state" => "9"))->sum("else_cost");//该单位所有出行费用之和
//
//                    $drivers[$i]["heji"] = $drivers[$i]["luqiaoCount"] + $drivers[$i]["fuwufeiCount"] + $drivers[$i]["buzhuCount"] + $drivers[$i]["qitaCount"];
//
//
//                    $hj["finishCount"]         += $drivers[$i]["finishCount"];
//                    $hj["companyMileageCount"] += $drivers[$i]["companyMileageCount"];
//                    $hj["luqiaoCount"]         += $drivers[$i]["luqiaoCount"];
//                    $hj["fuwufeiCount"]        += $drivers[$i]["fuwufeiCount"];
//                    $hj["buzhuCount"]          += $drivers[$i]["buzhuCount"];
//                    $hj["qitaCount"]           += $drivers[$i]["qitaCount"];
//                    $hj["heji"]                += $drivers[$i]["heji"];
//                }

                foreach ($drivers as &$val) {
                    $map['driver_id'] = array('eq', $val["id"]);
                    $map["is_del"]    = 0;

                    $travelM = new TravelModel();
                    $field   = 'count(1) as finishCount ,sum(mileage) as companyMileageCount,sum(fees_sum) as luqiaoCount ,sum(service_charge) as fuwufeiCount ,sum(driver_bt_cost) as buzhuCount ,sum(parking_rate_sum) as t1 ,sum(driver_cost) as t2 ,sum(over_time_cost) as t3 ,sum(over_mileage_cost) as t4 ,sum(else_cost) as t5';
                    $info    = $travelM->where($map)->where(array("state" => "9"))->field($field)->find();

                    $val["finishCount"]         = $info['finishcount'];
                    $val["companyMileageCount"] = $info["companymileagecount"] ? $info["companymileagecount"] : 0;
                    $val["luqiaoCount"]         = $info["luqiaocount"] ? $info["luqiaocount"] : 0;
                    $val["fuwufeiCount"]        = $info["fuwufeicount"] ? $info["fuwufeicount"] : 0;
                    $val["buzhuCount"]          = $info["buzhucount"] ? $info["buzhucount"] : 0;
                    $val["qitaCount"]           = $info["t1"] + $info["t2"] + $info["t3"] + $info["t4"] + $info["t5"];
                    $val["heji"]                = $val["luqiaoCount"] + $val["fuwufeiCount"] + $val["buzhuCount"] + $val["qitaCount"];

                    //汇总合计
                    $hj["finishCount"]         += $val["finishCount"];
                    $hj["companyMileageCount"] += $val["companyMileageCount"];
                    $hj["luqiaoCount"]         += $val["luqiaoCount"];
                    $hj["fuwufeiCount"]        += $val["fuwufeiCount"];
                    $hj["buzhuCount"]          += $val["buzhuCount"];
                    $hj["qitaCount"]           += $val["qitaCount"];
                    $hj["heji"]                += $val["heji"];
                }
                unset($val);
                $this->assign("hj", $hj);
                $this->assign("drivers", $drivers);
            }


            if ($_POST["type"] == 2) {
                $map["state"]  = 9;
                $map["is_del"] = 0;
                if (!empty($_POST["searchKey"])) {
                    $driver_ids       = M("driver")->where(array("driver_name|driver_phone" => array("like", "%" . trim($_POST["searchKey"]) . "%")))->field("id")->select();
                    $map["driver_id"] = array("IN", $driver_ids ? array_column($driver_ids, "id") : array(0));
                    $map["state"]     = 9;
                }
                $travels = M("Travel")->where($map)->field("use_user_id,company_id,driver_id,serial_number,start_car_time,to_place,mileage,fees_sum,service_charge,else_cost,totle_rate")->select();

                foreach ($travels as &$val) {
                    //获取用车人信息
                    $user             = M("User")->find($val["use_user_id"]);
                    $val["user_name"] = $user["user_name"];
                    //单位信息
                    $companyyy            = M("Company")->find($val["company_id"]);
                    $val["company_namee"] = $companyyy["company_name"];
                    //司机信息
                    $driver             = M("Driver")->where(array("id" => $val["driver_id"]))->find();
                    $val["driver_name"] = $driver["driver_name"];
                }
                unset($val);
                $this->assign("travels", $travels);
            }
        }

        $this->assign("startTime", $startTime);
        $this->assign("endTime", $endTime);
        $this->display();
    }

    //用户数据报表
    public function byUser()
    {
//        set_time_limit(0);
        $startTime = date('Y-m-01', strtotime(date("Y-m-d")));
        $endTime   = date('Y-m-d', strtotime(date("Y-m-d")));

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
            if (!empty($_REQUEST["searchKey"])) {
                $key                          = trim($_REQUEST["searchKey"]);
                $mapc["user_phone|user_name"] = array("like", "%" . $key . "%");
                $this->assign("username", $key);
            }

            $mapc["is_del"] = 0;
            $this->assign("aa", "1");

            if ($_POST["type"] == 1) {
                $users = M("User")->where($mapc)->field('id,user_name,user_phone')->select();

                $hj = array(
                    "finishCount"         => 0,
                    "companyMileageCount" => 0,
                    "luqiaoCount"         => 0,
                    "fuwufeiCount"        => 0,
                    "buzhuCount"          => 0,
                    "qitaCount"           => 0,
                    "heji"                => 0
                );

//                for ($i = 0; $i < count($users) && count($users) != 0; $i++) {
//                    $map['use_user_id'] = array('eq', $users[$i]["id"]);
//                    $map["is_del"]      = 0;
//
//                    $travelM                          = new TravelModel();
//                    $users[$i]["finishCount"]         = $travelM->where($map)->where(array("state" => "9"))->count();
//                    $users[$i]["companyMileageCount"] = $travelM->where($map)->where(array("state" => "9"))->sum("mileage");//该单位所有出行费用之和
//                    if (empty($users[$i]["companyMileageCount"])) {
//                        $users[$i]["companyMileageCount"] = 0;
//                    }
//
//
//                    $users[$i]["luqiaoCount"] = $travelM->where($map)->where(array("state" => "9"))->sum("fees_sum");//该单位所有出行费用之和
//                    if (empty($users[$i]["luqiaoCount"])) {
//                        $users[$i]["luqiaoCount"] = 0;
//                    }
//
//                    $users[$i]["fuwufeiCount"] = $travelM->where($map)->where(array("state" => "9"))->sum("service_charge");//该单位所有出行费用之和
//                    if (empty($users[$i]["fuwufeiCount"])) {
//                        $users[$i]["fuwufeiCount"] = 0;
//                    }
//
//                    $users[$i]["buzhuCount"] = $travelM->where($map)->where(array("state" => "9"))->sum("driver_bt_cost");
//
//
//                    $users[$i]["qitaCount"] = $travelM->where($map)->where(array("state" => "9"))->sum("parking_rate_sum") + $travelM->where($map)->where(array("state" => "9"))->sum("driver_cost") + $travelM->where($map)->where(array("state" => "9"))->sum("over_time_cost") + $travelM->where($map)->where(array("state" => "9"))->sum("over_mileage_cost") + $travelM->where($map)->where(array("state" => "9"))->sum("else_cost");//该单位所有出行费用之和
//
//                    $users[$i]["heji"] = $users[$i]["luqiaoCount"] + $users[$i]["fuwufeiCount"] + $users[$i]["buzhuCount"] + $users[$i]["qitaCount"];
//
//
//                    $hj["finishCount"]         += $users[$i]["finishCount"];
//                    $hj["companyMileageCount"] += $users[$i]["companyMileageCount"];
//                    $hj["luqiaoCount"]         += $users[$i]["luqiaoCount"];
//                    $hj["fuwufeiCount"]        += $users[$i]["fuwufeiCount"];
//                    $hj["buzhuCount"]          += $users[$i]["buzhuCount"];
//                    $hj["qitaCount"]           += $users[$i]["qitaCount"];
//                    $hj["heji"]                += $users[$i]["heji"];
//
//                }

                foreach ($users as &$val) {
                    $map['use_user_id'] = array('eq', $val["id"]);
                    $map["is_del"]      = 0;

                    $travelM                    = new TravelModel();
                    $field                      = 'count(1) as finishCount ,sum(mileage) as companyMileageCount,sum(fees_sum) as luqiaoCount ,sum(service_charge) as fuwufeiCount ,sum(driver_bt_cost) as buzhuCount ,sum(parking_rate_sum) as t1 ,sum(driver_cost) as t2 ,sum(over_time_cost) as t3 ,sum(over_mileage_cost) as t4 ,sum(else_cost) as t5';
                    $info                       = $travelM->where($map)->where(array("state" => "9"))->field($field)->find();
                    $val["finishCount"]         = $info['finishcount'];
                    $val["companyMileageCount"] = $info["companymileagecount"] ? $info["companymileagecount"] : 0;
                    $val["luqiaoCount"]         = $info["luqiaocount"] ? $info["luqiaocount"] : 0;
                    $val["fuwufeiCount"]        = $info["fuwufeicount"] ? $info["fuwufeicount"] : 0;
                    $val["buzhuCount"]          = $info["buzhucount"] ? $info["buzhucount"] : 0;
                    $val["qitaCount"]           = $info["t1"] + $info["t2"] + $info["t3"] + $info["t4"] + $info["t5"];
                    $val["heji"]                = $val["luqiaoCount"] + $val["fuwufeiCount"] + $val["buzhuCount"] + $val["qitaCount"];

                    //汇总合计
                    $hj["finishCount"]         += $val["finishCount"];
                    $hj["companyMileageCount"] += $val["companyMileageCount"];
                    $hj["luqiaoCount"]         += $val["luqiaoCount"];
                    $hj["fuwufeiCount"]        += $val["fuwufeiCount"];
                    $hj["buzhuCount"]          += $val["buzhuCount"];
                    $hj["qitaCount"]           += $val["qitaCount"];
                    $hj["heji"]                += $val["heji"];

                }
                unset($val);

                $this->assign("hj", $hj);
                $this->assign("users", $users);
            }

            if ($_POST["type"] == 2) {
                $map["state"]  = 9;
                $map["is_del"] = 0;

                if (!empty($_POST["searchKey"])) {
                    $ids                = M("user")->where(array("user_name|user_phone" => array("like", "%" . trim($_REQUEST["searchKey"]) . "%")))->field("id")->select();
                    $map["use_user_id"] = array("IN", $ids ? array_column($ids, "id") : array(0));
                }

                $travels = M("Travel")->where($map)->field('use_user_id,company_id,driver_id,serial_number,start_car_time,to_place,mileage,fees_sum,service_charge,else_cost,totle_rate,driver_bt_cost')->select();

                foreach ($travels as &$val) {
                    //获取用车人信息
                    $user              = M("User")->field('user_name,user_phone')->find($val["use_user_id"]);
                    $val["user_name"]  = $user["user_name"];
                    $val["user_phone"] = $user["user_phone"];
                    //单位信息
                    $companyyy            = M("Company")->field('company_name')->find($val["company_id"]);
                    $val["company_namee"] = $companyyy["company_name"];
                    //司机信息
                    $driver             = M("Driver")->field('driver_name')->find($val["driver_id"]);
                    $val["driver_name"] = $driver["driver_name"];
                }
                unset($val);
                $this->assign("travels", $travels);
            }
        }

        $this->assign("startTime", $startTime);
        $this->assign("endTime", $endTime);
        $this->display();
    }

    //用户报表导出
    public function user_export_to_csv()
    {
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

            foreach ($users as &$val) {
                $map['use_user_id'] = array('eq', $val["id"]);
                $map["is_del"]      = 0;

                $travelM = new TravelModel();
                $field   = 'count(1) as finishCount ,sum(mileage) as companyMileageCount,sum(fees_sum) as luqiaoCount ,sum(service_charge) as fuwufeiCount ,sum(driver_bt_cost) as buzhuCount ,sum(parking_rate_sum) as t1 ,sum(driver_cost) as t2 ,sum(over_time_cost) as t3 ,sum(over_mileage_cost) as t4 ,sum(else_cost) as t5';
                $info    = $travelM->where($map)->where(array("state" => "9"))->field($field)->find();
                if ($info['finishcount']) {
                    $data   = array();
                    $data[] = iconv("UTF-8", "GBK", $val["user_name"]);
                    $data[] = iconv("UTF-8", "GBK", $val["user_phone"]);
                    $data[] = iconv("UTF-8", "GBK", $info['finishcount']);
                    $data[] = iconv("UTF-8", "GBK", $info["companymileagecount"] ? $info["companymileagecount"] : 0);
                    $data[] = iconv("UTF-8", "GBK", $info["luqiaocount"] ? $info["luqiaocount"] : 0);
                    $data[] = iconv("UTF-8", "GBK", $info["fuwufeicount"] ? $info["fuwufeicount"] : 0);
                    $data[] = iconv("UTF-8", "GBK", $info["buzhucount"] ? $info["buzhucount"] : 0);
                    $data[] = iconv("UTF-8", "GBK", $info["t1"] + $info["t2"] + $info["t3"] + $info["t4"] + $info["t5"]);
                    $data[] = iconv("UTF-8", "GBK", $info["luqiaocount"] + $info["fuwufeicount"] + $info["buzhucount"] + $info["qitacount"]);
                    fputcsv($fp, $data);
                }

                //汇总合计
                $hj["finishCount"]         += $info["finishcount"];
                $hj["companyMileageCount"] += $info["companymileagecount"];
                $hj["luqiaoCount"]         += $info["luqiaocount"];
                $hj["fuwufeiCount"]        += $info["fuwufeicount"];
                $hj["buzhuCount"]          += $info["buzhucount"];
                $hj["qitaCount"]           += $info["t1"] + $info["t2"] + $info["t3"] + $info["t4"] + $info["t5"];
                $hj["heji"]                += $info["luqiaocount"] + $info["fuwufeicount"] + $info["buzhucount"] + $info["t1"] + $info["t2"] + $info["t3"] + $info["t4"] + $info["t5"];

            }
            unset($val);
            unset($users);

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
            $map["is_del"] = 0;
            $travels       = M("Travel")->where($map)->field('use_user_id,company_id,driver_id,serial_number,start_car_time,to_place,mileage,fees_sum,service_charge,else_cost,totle_rate,driver_bt_cost')->select();

            $mileagenum        = 0;
            $fees_sumnum       = 0;
            $service_chargenum = 0;
            $costnum           = 0;
            $totle_ratenum     = 0;
            foreach ($travels as &$val) {
                //汇总
                $mileagenum        += $val['mileage'];
                $fees_sumnum       += $val['fees_sum'];
                $service_chargenum += $val['service_charge'];
                $costnum           += $val['else_cost'];
                $totle_ratenum     += $val['totle_rate'];
                //获取用车人信息
                $user = M("User")->find($val["use_user_id"]);
                //单位信息
                $company = M("Company")->find($val["company_id"]);

                $data   = array();
                $data[] = iconv("UTF-8", "GBK", $user["user_name"]);
                $data[] = iconv("UTF-8", "GBK", $val["serial_number"]);
                $data[] = iconv("UTF-8", "GBK", $company["company_name"]);
                $data[] = iconv("UTF-8", "GBK", date("Y-m-d H:i:s", $val["start_car_time"]));
                $data[] = iconv("UTF-8", "GBK", $val["to_place"]);
                $data[] = iconv("UTF-8", "GBK", $val['mileage'] ? $val['mileage'] : 0);
                $data[] = iconv("UTF-8", "GBK", $val['fees_sum']);
                $data[] = iconv("UTF-8", "GBK", $val['service_charge']);
                $data[] = iconv("UTF-8", "GBK", 0);
                $data[] = iconv("UTF-8", "GBK", $val['else_cost']);
                $data[] = iconv("UTF-8", "GBK", $val['totle_rate']);
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
    public function driver_export_to_csv()
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

            foreach ($drivers as &$val) {
                $map['driver_id'] = array('eq', $val["id"]);
                $map["is_del"]    = 0;

                $travelM = new TravelModel();
                $field   = 'count(1) as finishCount ,sum(mileage) as companyMileageCount,sum(fees_sum) as luqiaoCount ,sum(service_charge) as fuwufeiCount ,sum(driver_bt_cost) as buzhuCount ,sum(parking_rate_sum) as t1 ,sum(driver_cost) as t2 ,sum(over_time_cost) as t3 ,sum(over_mileage_cost) as t4 ,sum(else_cost) as t5';
                $info    = $travelM->where($map)->where(array("state" => "9"))->field($field)->find();

                $val["finishCount"]         = $info['finishcount'];
                $val["companyMileageCount"] = $info["companymileagecount"] ? $info["companymileagecount"] : 0;
                $val["luqiaoCount"]         = $info["luqiaocount"] ? $info["luqiaocount"] : 0;
                $val["fuwufeiCount"]        = $info["fuwufeicount"] ? $info["fuwufeicount"] : 0;
                $val["buzhuCount"]          = $info["buzhucount"] ? $info["buzhucount"] : 0;
                $val["qitaCount"]           = $info["t1"] + $info["t2"] + $info["t3"] + $info["t4"] + $info["t5"];
                $val["heji"]                = $val["luqiaoCount"] + $val["fuwufeiCount"] + $val["buzhuCount"] + $val["qitaCount"];

                if ($info['finishcount']) {
                    $data   = array();
                    $data[] = iconv("UTF-8", "GBK", $val["driver_name"]);
                    $data[] = iconv("UTF-8", "GBK", $val["driver_phone"]);
                    $data[] = iconv("UTF-8", "GBK", $info['finishcount']);
                    $data[] = iconv("UTF-8", "GBK", $info["companymileagecount"] ? $info["companymileagecount"] : 0);
                    $data[] = iconv("UTF-8", "GBK", $info["luqiaocount"] ? $info["luqiaocount"] : 0);
                    $data[] = iconv("UTF-8", "GBK", $info["fuwufeicount"] ? $info["fuwufeicount"] : 0);

                    $data[] = iconv("UTF-8", "GBK", $info["buzhucount"] ? $info["buzhucount"] : 0);
                    $data[] = iconv("UTF-8", "GBK", $info["t1"] + $info["t2"] + $info["t3"] + $info["t4"] + $info["t5"]);
                    $data[] = iconv("UTF-8", "GBK", $info["luqiaocount"] + $info["fuwufeicount"] + $info["buzhucount"] + $info["qitacount"]);
                    fputcsv($fp, $data);
                }

                //汇总合计
                $hj["finishCount"]         += $info["finishcount"];
                $hj["companyMileageCount"] += $info["companymileagecount"];
                $hj["luqiaoCount"]         += $info["luqiaocount"];
                $hj["fuwufeiCount"]        += $info["fuwufeicount"];
                $hj["buzhuCount"]          += $info["buzhucount"];
                $hj["qitaCount"]           += $info["t1"] + $info["t2"] + $info["t3"] + $info["t4"] + $info["t5"];
                $hj["heji"]                += $info["luqiaocount"] + $info["fuwufeicount"] + $info["buzhucount"] + $info["t1"] + $info["t2"] + $info["t3"] + $info["t4"] + $info["t5"];

            }
            unset($val);
            $sum = array("合计", "", $hj["finishCount"], $hj["companyMileageCount"], $hj["luqiaoCount"], $hj["fuwufeiCount"], $hj["buzhuCount"], $hj["qitaCount"], $hj["heji"]);
            foreach ($sum as $i => $v) {
                $sum[$i] = iconv('utf-8', 'GB18030', $v);
            }
            fputcsv($fp, $sum);
        }

        if ($_REQUEST["type"] == 2) {
            $map["is_del"] = 0;
            $map["state"]  = 9;
            if (!empty($_REQUEST["searchKey"])) {
                $driver_ids       = M("driver")->where(array("driver_name|driver_phone" => array("like", "%" . trim($_REQUEST["searchKey"]) . "%")))->field("id")->select();
                $map["driver_id"] = array("IN", $driver_ids ? array_column($driver_ids, "id") : array(0));
            }

            $travels = M("Travel")->where($map)->field("use_user_id,company_id,driver_id,serial_number,start_car_time,to_place,mileage,fees_sum,service_charge,else_cost,totle_rate")->select();

            $excel_name = $_REQUEST["startTime"] . "至" . $_REQUEST["endTime"] . "司机数据明细";
            header("Content-Disposition:filename=" . iconv("UTF-8", "GBK", $excel_name) . ".csv");
            $fp          = fopen('php://output', 'a');
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

            foreach ($travels as &$val) {
                //汇总
                $mileagenum        += $val['mileage'];
                $fees_sumnum       += $val['fees_sum'];
                $service_chargenum += $val['service_charge'];
                $costnum           += $val['else_cost'];
                $totle_ratenum     += $val['totle_rate'];

                //获取用车人信息
                $user = M("User")->find($val["use_user_id"]);
                //单位信息
                $companyyy = M("Company")->find($val["company_id"]);
                //司机信息
                $driver = M("Driver")->where(array("id" => $val["driver_id"]))->find();

                $data   = array();
                $data[] = iconv('utf-8', 'GB18030', $driver['driver_name']);
                $data[] = iconv('utf-8', 'GB18030', $val["serial_number"]);
                $data[] = iconv('utf-8', 'GB18030', $companyyy['company_name']);
                $data[] = iconv('utf-8', 'GB18030', $user['user_name']);
                $data[] = iconv('utf-8', 'GB18030', date("Y-m-d H:i:s", $val["start_car_time"]));
                $data[] = iconv('utf-8', 'GB18030', $val["to_place"]);
                $data[] = iconv('utf-8', 'GB18030', $val["mileage"]);
                $data[] = iconv('utf-8', 'GB18030', $val["fees_sum"]);
                $data[] = iconv('utf-8', 'GB18030', $val["service_charge"]);
                $data[] = iconv('utf-8', 'GB18030', 0);
                $data[] = iconv('utf-8', 'GB18030', $val["else_cost"]);
                $data[] = iconv('utf-8', 'GB18030', $val["totle_rate"]);
                fputcsv($fp, $data);
            }
            unset($val);
            unset($travels);
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
    public function car_export_to_csv()
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
    public function company_export_to_csv()
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

            foreach ($companys as &$val) {
                $map['company_id'] = array('eq', $val["id"]);
                $map["is_del"]     = 0;

                $travelM = new TravelModel();
                $field   = 'count(1) as finishCount ,sum(mileage) as companyMileageCount,sum(fees_sum) as luqiaoCount ,sum(service_charge) as fuwufeiCount ,sum(driver_bt_cost) as buzhuCount ,sum(parking_rate_sum) as t1 ,sum(driver_cost) as t2 ,sum(over_time_cost) as t3 ,sum(over_mileage_cost) as t4 ,sum(else_cost) as t5';
                $info    = $travelM->where($map)->where(array("state" => "9"))->field($field)->find();
                if ($info['finishcount']) {
                    $data   = array();
                    $data[] = iconv("UTF-8", "GBK", $val["company_name"]);
                    $data[] = iconv("UTF-8", "GBK", $info['finishcount']);
                    $data[] = iconv("UTF-8", "GBK", $info["companymileagecount"] ? $info["companymileagecount"] : 0);
                    $data[] = iconv("UTF-8", "GBK", $info["luqiaocount"] ? $info["luqiaocount"] : 0);
                    $data[] = iconv("UTF-8", "GBK", $info["fuwufeicount"] ? $info["fuwufeicount"] : 0);
                    $data[] = iconv("UTF-8", "GBK", $info["buzhucount"] ? $info["buzhucount"] : 0);
                    $data[] = iconv("UTF-8", "GBK", $info["t1"] + $info["t2"] + $info["t3"] + $info["t4"] + $info["t5"]);
                    $data[] = iconv("UTF-8", "GBK", $info["luqiaocount"] + $info["fuwufeicount"] + $info["buzhucount"] + $info["qitacount"]);
                    fputcsv($fp, $data);
                }

                //汇总合计
                $hj["finishCount"]         += $info["finishcount"];
                $hj["companyMileageCount"] += $info["companymileagecount"];
                $hj["luqiaoCount"]         += $info["luqiaocount"];
                $hj["fuwufeiCount"]        += $info["fuwufeicount"];
                $hj["buzhuCount"]          += $info["buzhucount"];
                $hj["qitaCount"]           += $info["t1"] + $info["t2"] + $info["t3"] + $info["t4"] + $info["t5"];
                $hj["heji"]                += $info["luqiaocount"] + $info["fuwufeicount"] + $info["buzhucount"] + $info["t1"] + $info["t2"] + $info["t3"] + $info["t4"] + $info["t5"];
            }
            unset($val);

            $sum = array("合计", $hj["finishCount"], $hj["companyMileageCount"], $hj["luqiaoCount"], $hj["fuwufeiCount"], $hj["buzhuCount"], $hj["qitaCount"], $hj["heji"],);
            foreach ($sum as $i => $v) {
                $sum[$i] = iconv('utf-8', 'GB18030', $v);
            }
            fputcsv($fp, $sum);
        } elseif ($_REQUEST["type"] == 2) {  //明细报表
            $map["state"] = 9;

            $searchKey = trim($_REQUEST["searchKey"]);
            if (!empty($searchKey)) {
                $company_ids       = M("company")->where(array("company_name" => array("like", "%" . $searchKey . "%")))->field("id")->select();  //查询是否匹配单位名称
                $user_ids          = M("user")->where(array("user_name" => array("like", "%" . $searchKey . "%")))->field("id")->select();  //查询是否匹配用车人
                if ($company_ids) {
                    $map["company_id"] = array("IN", $company_ids ? $this->_array_column($company_ids, "id") : array(0));
                } elseif ($user_ids) {
                    $map["use_user_id"] = array("IN", $user_ids ? $this->_array_column($user_ids, "id") : array(0));
                }
            }

            $travelNature = trim($_REQUEST['travelNature']);
            if ($travelNature) {
                $map["travel_nature"] = $travelNature;
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

            $column_name = array("单位名称", "流水号", "用车人", "用车时间", "出行性质", "目的地", "出行里程", "路桥费", "出行服务费", "出差补助", "其他", "小计");
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
                $data[] = iconv('utf-8', 'GB18030', $v["travel_nature"]);
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

