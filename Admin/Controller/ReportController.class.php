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

            $startTime    = trim($_REQUEST['startTime']);       //开始时间
            $endTime      = trim($_REQUEST['endTime']);         //结束时间
            $type         = intval($_REQUEST["type"]);          //报表类型
            $searchKey    = trim($_REQUEST["searchKey"]);       //搜索关键字
            $travelNature = trim($_REQUEST["travelNature"]);    //出行性质

            //查询条件
            $map             = array();
            $map['t.is_del'] = 0;
            $map['t.state']  = 9;

            if (!empty($startTime) && empty($endTime)) {
                $map['t.departure_time'] = array('gt', strtotime($startTime));
            } elseif (!empty($endTime) && empty($startTime)) {
                $map['t.departure_time'] = array('elt', strtotime($endTime) + 24 * 3600 - 1);
            } elseif ((!empty($startTime)) && !empty($endTime)) {
                $map['t.departure_time'] = array('between', array(strtotime($startTime), strtotime($endTime) + 24 * 3600 - 1));
            }

            $this->assign("nature_name", $travelNature);
            $this->assign("companyname", $searchKey);
            $this->assign("type", $type);
            $this->assign("aa", "1");

            if ($type == 1) {
                $map['c.is_del'] = 0;      //统计未删除的单位

                if (!empty($searchKey)) {
                    $map["c.company_name"] = array("like", "%" . $searchKey . "%");
                }

                //分页查询
                $count    = M("Company as c")->join("left join " . C("DB_PREFIX") . "travel as t on c.id =  t.company_id")->where($map)->group("t.company_id")->having('count(t.company_id)>=1')->field('company_id')->select();
                $pageSize = 15;
                $Page     = new Page(count($count), $pageSize);

                //设置分页样式
                $Page->setConfig('header', '<li class="rows">共<b>%TOTAL_ROW%</b>条记录 第<b>%NOW_PAGE%</b>页/共<b>%TOTAL_PAGE%</b>页</li>');
                $Page->setConfig('prev', '上一页');
                $Page->setConfig('next', '下一页');
                $Page->setConfig('last', '末页');
                $Page->setConfig('first', '首页');
                $Page->setConfig('theme', '%FIRST%%UP_PAGE%%LINK_PAGE%%DOWN_PAGE%%END%%HEADER%');
                $Page->lastSuffix = false;

                //数据查询
                //其他 = 停车费单据总金额(parking_rate_sum) + 司机住宿等花费(driver_cost) + 超时费(over_time_cost) + 超公里费(over_mileage_cost) + 其他费用(else_cost)
                //总费用直接用 totle_rate 字段
                $field    = 't.company_id,c.company_name,count(t.company_id) AS finishCount,sum(t.mileage) as companyMileageCount,sum(t.fees_sum) as luqiaoCount ,sum(t.service_charge) as fuwufeiCount,sum(t.driver_bt_cost) as buzhuCount,sum(t.parking_rate_sum + t.driver_cost + t.over_time_cost + t.over_mileage_cost + t.else_cost) as qitaCount ,sum(totle_rate) as heji';
                $companys = M("Company as c")->join("left join " . C("DB_PREFIX") . "travel as t on c.id =  t.company_id")->where($map)->group("t.company_id")->field($field)->limit($Page->firstRow . ',' . $Page->listRows)->having('finishCount>=1')->select();

                //汇总合计
                $field = 'count(t.id) AS finishCount,sum(t.mileage) as companyMileageCount,sum(t.fees_sum) as luqiaoCount ,sum(t.service_charge) as fuwufeiCount,sum(t.driver_bt_cost) as buzhuCount,sum(t.parking_rate_sum + t.driver_cost + t.over_time_cost + t.over_mileage_cost + t.else_cost) as qitaCount ,sum(totle_rate) as heji';
                $total = M("Company as c")->join("left join " . C("DB_PREFIX") . "travel as t on c.id =  t.company_id")->where($map)->field($field)->having('finishCount>=1')->select();

                $this->assign("page", $Page->show());
                $this->assign("companys", $companys);
                $this->assign("total", $total[0]);

            } else {

                $map["c.is_del"] = 0;

                if (!empty($searchKey)) {
                    $company_ids = M("company")->where(array("is_del" => 0, "company_name" => array("like", "%" . $searchKey . "%")))->field("id")->select();  //查询是否匹配单位名称
                    $user_ids    = M("user")->where(array("is_del" => 0, "user_name" => array("like", "%" . $searchKey . "%")))->field("id")->select();  //查询是否匹配用车人
                    if ($company_ids) {
                        $map["t.company_id"] = array("IN", $this->_array_column($company_ids, "id"));
                    } elseif ($user_ids) {
                        $map["t.use_user_id"] = array("IN", $this->_array_column($user_ids, "id"));
                    }
                }

                if ($travelNature) {
                    $map["t.travel_nature"] = $travelNature;
                }

                //分页
                $count    = M("Travel as t")->join("left join " . C("DB_PREFIX") . "company as c on c.id =  t.company_id left join " . C("DB_PREFIX") . "user u on u.id = t.use_user_id")->where($map)->count();
                $pageSize = 15;
                $Page     = new Page($count, $pageSize);
                $Page->setConfig('header', '<li class="rows">共<b>%TOTAL_ROW%</b>条记录 第<b>%NOW_PAGE%</b>页/共<b>%TOTAL_PAGE%</b>页</li>');
                $Page->setConfig('prev', '上一页');
                $Page->setConfig('next', '下一页');
                $Page->setConfig('last', '末页');
                $Page->setConfig('first', '首页');
                $Page->setConfig('theme', '%FIRST%%UP_PAGE%%LINK_PAGE%%DOWN_PAGE%%END%%HEADER%');
                $Page->lastSuffix = false;

                //数据
                $field   = 'u.user_name,c.company_name as company_namee,t.use_user_id,t.company_id,t.travel_nature,t.serial_number,t.start_car_time,t.to_place,t.mileage,t.fees_sum,t.service_charge,t.totle_rate, (t.parking_rate_sum + t.driver_cost + t.over_time_cost + t.over_mileage_cost + t.else_cost) as qita';
                $travels = M("Travel as t")->join("left join " . C("DB_PREFIX") . "company as c on c.id =  t.company_id left join " . C("DB_PREFIX") . "user u on u.id = t.use_user_id")->where($map)->limit($Page->firstRow . ',' . $Page->listRows)->field($field)->select();

                //合计汇总
                $field = 'sum(t.mileage) as companyMileageCount,sum(t.fees_sum) as luqiaoCount ,sum(t.service_charge) as fuwufeiCount,sum(t.driver_bt_cost) as buzhuCount,sum(t.parking_rate_sum + t.driver_cost + t.over_time_cost + t.over_mileage_cost + t.else_cost) as qitaCount ,sum(totle_rate) as xiaoji ';
                $total = M("Travel as t")->join("left join " . C("DB_PREFIX") . "company as c on c.id =  t.company_id left join " . C("DB_PREFIX") . "user u on u.id = t.use_user_id")->where($map)->field($field)->select();

                $this->assign("page", $Page->show());
                $this->assign("travels", $travels);
                $this->assign("total", $total[0]);
            }
        }

        //出行性质
        $travelNature = M("travelNature")->where(" is_del = 0")->select();

        $this->assign("travelNature", $travelNature);
        $this->assign("startTime", $startTime ? $startTime : date('Y-m-01', strtotime(date("Y-m-d"))));
        $this->assign("endTime", $endTime ? $endTime : date('Y-m-d', strtotime(date("Y-m-d"))));
        $this->display();
    }

    //单位报表导出
    public function company_export_to_csv($page = 1)
    {
        set_time_limit(0);
        $startTime = trim($_REQUEST['startTime']);
        $endTime   = trim($_REQUEST['endTime']);
        $searchKey = trim($_REQUEST["searchKey"]);

        //查询条件
        $map             = array();
        $map['t.is_del'] = 0;
        $map['t.state']  = 9;

        if (!empty($startTime) && empty($endTime)) {
            $map['t.departure_time'] = array('gt', strtotime($startTime));
        } elseif (!empty($endTime) && empty($startTime)) {
            $map['t.departure_time'] = array('elt', strtotime($endTime) + 24 * 3600 - 1);
        } elseif ((!empty($startTime)) && !empty($endTime)) {
            $map['t.departure_time'] = array('between', array(strtotime($startTime), strtotime($endTime) + 24 * 3600 - 1));
        }

        if ($_REQUEST["type"] == 1) {  //导出统计报表
            $map['c.is_del'] = 0;

            if (!empty($searchKey)) {
                $map["c.company_name"] = array("like", "%" . $searchKey . "%");
            }

            //数据查询
            $size  = 200;
            $limit = ($page - 1) * $size . ',' . $size;
            //其他 = 停车费单据总金额(parking_rate_sum) + 司机住宿等花费(driver_cost) + 超时费(over_time_cost) + 超公里费(over_mileage_cost) + 其他费用(else_cost)
            $field    = 't.company_id,c.company_name,count(t.company_id) AS finishCount,sum(t.mileage) as companyMileageCount,sum(t.fees_sum) as luqiaoCount ,sum(t.service_charge) as fuwufeiCount,sum(t.driver_bt_cost) as buzhuCount,sum(t.parking_rate_sum + t.driver_cost + t.over_time_cost + t.over_mileage_cost + t.else_cost) as qitaCount ,sum(totle_rate) as heji';
            $companys = M("Company as c")->join("left join " . C("DB_PREFIX") . "travel as t on c.id =  t.company_id")->where($map)->group("t.company_id")->field($field)->limit($limit)->having('finishCount>=1')->select();

            //导出数据
            header("Content-Type: text/html; charset=gbk");
            header("Content-type:application/vnd.ms-excel");
            $excel_name = $_REQUEST["startTime"] . "至" . $_REQUEST["endTime"] . "单位数据统计";
            header("Content-Disposition:filename=" . iconv("UTF-8", "GBK", $excel_name) . ".csv");
            $fp = fopen('php://output', 'a');

            if ($companys) {
                register_shutdown_function(array(&$this, 'company_export_to_csv'), $page + 1);

                if ($page == 1) {
                    $column_name = array("单位名称", "出行次数", "出行里程", "路桥费", "出行服务费", "出差补助", "其他", "小计");
                    foreach ($column_name as $i => $v) {
                        $column_name[$i] = iconv('utf-8', 'GB18030', $v);
                    }
                    fputcsv($fp, $column_name);
                }

                foreach ($companys as &$val) {
                    $data   = array();
                    $data[] = iconv("UTF-8", "GBK", $val["company_name"]);
                    $data[] = iconv("UTF-8", "GBK", $val['finishcount']);
                    $data[] = iconv("UTF-8", "GBK", $val["companymileagecount"] ? $val["companymileagecount"] : 0);
                    $data[] = iconv("UTF-8", "GBK", $val["luqiaocount"] ? $val["luqiaocount"] : 0);
                    $data[] = iconv("UTF-8", "GBK", $val["fuwufeicount"] ? $val["fuwufeicount"] : 0);
                    $data[] = iconv("UTF-8", "GBK", $val["buzhucount"] ? $val["buzhucount"] : 0);
                    $data[] = iconv("UTF-8", "GBK", $val["qitacount"] ? $val["qitacount"] : 0);
                    $data[] = iconv("UTF-8", "GBK", $val["heji"] ? $val["heji"] : 0);
                    fputcsv($fp, $data);
                }
                unset($val);

            } else {
                //输出汇总合计
                $field = 'count(t.id) AS finishCount,sum(t.mileage) as companyMileageCount,sum(t.fees_sum) as luqiaoCount ,sum(t.service_charge) as fuwufeiCount,sum(t.driver_bt_cost) as buzhuCount,sum(t.parking_rate_sum + t.driver_cost + t.over_time_cost + t.over_mileage_cost + t.else_cost) as qitaCount ,sum(totle_rate) as heji';
                $total = M("Company as c")->join("left join " . C("DB_PREFIX") . "travel as t on c.id =  t.company_id")->where($map)->field($field)->having('finishCount>=1')->select();

                $sum = array("合计", $total[0]["finishcount"], $total[0]["companymileagecount"], $total[0]["luqiaocount"], $total[0]["fuwufeicount"], $total[0]["buzhucount"], $total[0]["qitacount"], $total[0]["heji"],);
                foreach ($sum as $i => $v) {
                    $sum[$i] = iconv('utf-8', 'GB18030', $v);
                }
                fputcsv($fp, $sum);
            }

        } elseif ($_REQUEST["type"] == 2) {  //导出明细报表

            $map["c.is_del"] = 0;

            if (!empty($searchKey)) {
                $company_ids = M("company")->where(array("is_del" => 0, "company_name" => array("like", "%" . $searchKey . "%")))->field("id")->select();  //查询是否匹配单位名称
                $user_ids    = M("user")->where(array("is_del" => 0, "user_name" => array("like", "%" . $searchKey . "%")))->field("id")->select();  //查询是否匹配用车人
                if ($company_ids) {
                    $map["t.company_id"] = array("IN", $this->_array_column($company_ids, "id"));
                } elseif ($user_ids) {
                    $map["t.use_user_id"] = array("IN", $this->_array_column($user_ids, "id"));
                }
            }

            $travelNature = trim($_REQUEST['travelNature']);
            if ($travelNature) {
                $map["t.travel_nature"] = $travelNature;
            }

            $size    = 1000;
            $limit   = ($page - 1) * $size . ',' . $size;
            $field   = 'u.user_name,c.company_name,t.use_user_id,t.company_id,t.travel_nature,t.serial_number,t.start_car_time,t.to_place,t.mileage,t.fees_sum,t.service_charge,t.totle_rate,t.driver_bt_cost,(t.parking_rate_sum + t.driver_cost + t.over_time_cost + t.over_mileage_cost + t.else_cost) as qita';
            $travels = M("Travel as t")->join("left join " . C("DB_PREFIX") . "company as c on c.id =  t.company_id left join " . C("DB_PREFIX") . "user u on u.id = t.use_user_id")->where($map)->limit($limit)->field($field)->select();

            //导出数据
            header("Content-Type: text/html; charset=gbk");
            header("Content-type:application/vnd.ms-excel");
            $excel_name = $_REQUEST["startTime"] . "至" . $_REQUEST["endTime"] . "单位数据明细";
            header("Content-Disposition:filename=" . iconv("UTF-8", "GBK", $excel_name) . ".csv");
            $fp = fopen('php://output', 'a');

            if ($travels) {
                register_shutdown_function(array(&$this, 'company_export_to_csv'), $page + 1);

                if ($page == 1) {
                    //输出表头
                    $column_name = array("单位名称", "流水号", "用车人", "用车时间", "出行性质", "目的地", "出行里程", "路桥费", "出行服务费", "出差补助", "其他", "小计");
                    foreach ($column_name as $i => $v) {
                        $column_name[$i] = iconv('utf-8', 'GB18030', $v);
                    }
                    fputcsv($fp, $column_name);
                }

                foreach ($travels as &$v) {
                    //输出数据
                    $data   = array();
                    $data[] = iconv('utf-8', 'GB18030', $v["company_name"]);
                    $data[] = iconv('utf-8', 'GB18030', $v["serial_number"]);
                    $data[] = iconv('utf-8', 'GB18030', $v["user_name"]);
                    $data[] = iconv('utf-8', 'GB18030', date("Y-m-d H:i:s", $v["start_car_time"]));
                    $data[] = iconv('utf-8', 'GB18030', $v["travel_nature"]);
                    $data[] = iconv('utf-8', 'GB18030', $v["to_place"]);
                    $data[] = iconv('utf-8', 'GB18030', $v["mileage"]);
                    $data[] = iconv('utf-8', 'GB18030', $v['fees_sum']);
                    $data[] = iconv('utf-8', 'GB18030', $v['service_charge']);
                    $data[] = iconv('utf-8', 'GB18030', $v['driver_bt_cost']);
                    $data[] = iconv('utf-8', 'GB18030', $v['qita']);
                    $data[] = iconv('utf-8', 'GB18030', $v['totle_rate']);
                    fputcsv($fp, $data);
                }
                unset($v);
            } else {
                //输出汇总合计
                $field = 'count(t.id) AS finishCount,sum(t.mileage) as companyMileageCount,sum(t.fees_sum) as luqiaoCount ,sum(t.service_charge) as fuwufeiCount,sum(t.driver_bt_cost) as buzhuCount,sum(t.parking_rate_sum + t.driver_cost + t.over_time_cost + t.over_mileage_cost + t.else_cost) as qitaCount ,sum(totle_rate) as heji';
                $total = M("Company as c")->join("left join " . C("DB_PREFIX") . "travel as t on c.id =  t.company_id")->where($map)->field($field)->having('finishCount>=1')->select();
                $sum   = array("合计", "", "", "", "", "", $total[0]['companymileagecount'], $total[0]['luqiaocount'], $total[0]['fuwufeicount'], $total[0]['buzhucount'], $total[0]['qitacount'], $total[0]['heji']);
                foreach ($sum as $i => $v) {
                    $sum[$i] = iconv('utf-8', 'GB18030', $v);
                }
                fputcsv($fp, $sum);
            }

        }
        ob_flush();
        flush();
//        exit;
    }

    //车辆数据报表
    public function byCar()
    {

        if (empty($_POST)) {
            $this->assign("aa", "0");
        } else {

            $startTime = trim($_REQUEST['startTime']);
            $endTime   = trim($_REQUEST['endTime']);
            $type      = intval($_REQUEST['type']);
            $searchKey = trim($_REQUEST['searchKey']);

            $map             = array();
            $map["t.is_del"] = 0;
            $map["t.state"]  = 9;

            //获取开始时间
            if (!empty($startTime) && empty($endTime)) {
                $map['t.departure_time'] = array('gt', strtotime($startTime));
            } elseif (!empty($endTime) && empty($startTime)) {
                $map['t.departure_time'] = array('elt', strtotime($endTime) + 24 * 3600);
            } elseif ((!empty($startTime)) && !empty($endTime)) {
                $map['t.departure_time'] = array('between', array(strtotime($startTime), strtotime($endTime) + 24 * 3600 - 1));
            }

            $this->assign("type", $type);
            $this->assign("searchKey", $searchKey);
            $this->assign("aa", "1");

            if ($type == 1) {
                $map['c.is_del'] = 0;
                if ($searchKey) {  //搜索车牌号或者单位名称
                    $search_sql = " c.car_num like '%" . $searchKey . "%' ";
//                    $company    = M("company")->where(array("is_del"=>0,"company_name" => array("like", "%" . $searchKey . "%")))->field("id")->select();
//                    if ($company) {
//                        $search_sql .= "  or c.company_id in (" . implode(",", $this->_array_column($company, "id")) . ")";
//                    }
                    $map["_string"] = $search_sql;
                }

                $count = M("car as c")->join("left join " . C("DB_PREFIX") . "travel as t on c.id =  t.car_id")->where($map)->group("t.car_id")->having('count(t.car_id)>=1')->field('car_id')->select();

                $pageSize = 15;

                $Page = new Page(count($count), $pageSize);

                $Page->setConfig('header', '<li class="rows">共<b>%TOTAL_ROW%</b>条记录 第<b>%NOW_PAGE%</b>页/共<b>%TOTAL_PAGE%</b>页</li>');
                $Page->setConfig('prev', '上一页');
                $Page->setConfig('next', '下一页');
                $Page->setConfig('last', '末页');
                $Page->setConfig('first', '首页');
                $Page->setConfig('theme', '%FIRST%%UP_PAGE%%LINK_PAGE%%DOWN_PAGE%%END%%HEADER%');
                $Page->lastSuffix = false;

                $field = 'c.id,t.car_id,c.car_num,count(t.car_id) AS finishCount,sum(t.mileage) as companyMileageCount,sum(t.fees_sum) as luqiaoCount ,sum(t.service_charge) as fuwufeiCount,sum(t.driver_bt_cost) as buzhuCount,sum(t.parking_rate_sum + t.driver_cost + t.over_time_cost + t.over_mileage_cost + t.else_cost) as qitacount,sum(totle_rate) as heji ';

                $cars = M("car as c")->join("left join " . C("DB_PREFIX") . "travel as t on c.id =  t.car_id")->where($map)->group("t.car_id")->field($field)->limit($Page->firstRow . ',' . $Page->listRows)->having('finishCount>=1')->select();

                foreach ($cars as &$val) {
                    //计算维修保养费用
                    $xiche['car_id']    = array('eq', $val["id"]);
                    $xiche["is_del"]    = array('eq', 0);
                    $xiche["wash_time"] = $map['t.departure_time'];

                    $weixiu['car_id']     = array('eq', $val["id"]);
                    $weixiu["is_del"]     = array('eq', 0);
                    $weixiu["start_time"] = $map['t.departure_time'];

                    $jiayou['car_id']       = array('eq', $val["id"]);
                    $jiayou["is_del"]       = array('eq', 0);
                    $jiayou["trading_time"] = $map['t.departure_time'];

                    $nianjian['car_id']   = array('eq', $val["id"]);
                    $nianjian["is_del"]   = array('eq', 0);
                    $nianjian["pay_time"] = $map['t.departure_time'];

                    $val["xiche"]    = M("CostWash")->where($xiche)->sum("cost");
                    $val["weixiu"]   = M("CostRepair")->where($weixiu)->sum("cost");
                    $val["jiayou"]   = M("CostOil")->where($jiayou)->sum("cost");
                    $val["nianjian"] = M("CostInsurance")->where($nianjian)->sum("cost");
                    $val["xiaoji"]   = $val["xiche"] + $val["weixiu"] + $val["jiayou"] + $val["nianjian"];

                }
                unset($val);

                //汇总合计
                $field = 't.id ,count(t.id) AS finishCount,sum(t.mileage) as companyMileageCount,sum(t.fees_sum) as luqiaoCount ,sum(t.service_charge) as fuwufeiCount,sum(t.driver_bt_cost) as buzhuCount,sum(t.parking_rate_sum + t.driver_cost + t.over_time_cost + t.over_mileage_cost + t.else_cost) as qitacount,sum(totle_rate) as xiaoji ';
                $total = M("car as c")->join("left join " . C("DB_PREFIX") . "travel as t on c.id =  t.car_id")->where($map)->field($field)->having('finishCount>=1')->select();
                foreach ($total as &$val) {
                    //计算维修保养费用
                    $xiche['car_id']    = array('eq', $val["id"]);
                    $xiche["is_del"]    = array('eq', 0);
                    $xiche["wash_time"] = $map['t.departure_time'];

                    $weixiu['car_id']     = array('eq', $val["id"]);
                    $weixiu["is_del"]     = array('eq', 0);
                    $weixiu["start_time"] = $map['t.departure_time'];

                    $jiayou['car_id']       = array('eq', $val["id"]);
                    $jiayou["is_del"]       = array('eq', 0);
                    $jiayou["trading_time"] = $map['t.departure_time'];

                    $nianjian['car_id']   = array('eq', $val["id"]);
                    $nianjian["is_del"]   = array('eq', 0);
                    $nianjian["pay_time"] = $map['t.departure_time'];

                    $val["xiche"]    = M("CostWash")->where($xiche)->sum("cost");
                    $val["weixiu"]   = M("CostRepair")->where($weixiu)->sum("cost");
                    $val["jiayou"]   = M("CostOil")->where($jiayou)->sum("cost");
                    $val["nianjian"] = M("CostInsurance")->where($nianjian)->sum("cost");
                    $val["xiaoji"]   = $val["xiche"] + $val["weixiu"] + $val["jiayou"] + $val["nianjian"];
                }
                unset($val);

                $this->assign("total", $total[0]);
                $this->assign("cars", $cars);
                $this->assign("page", $Page->show());
            }

            if ($type == 2) {
                if ($searchKey) { // 搜索车牌号或者司机或者单位或者用车人
                    $search_sql = " t.jj_driver_name like '%" . $searchKey . "%' or t.jj_car_num like '%" . $searchKey . "%'";
                    $car        = M("car")->where(array("car_num" => array("like", "%" . $searchKey . "%")))->field("id")->select();
                    if ($car) {
                        $search_sql .= " or t.car_id in (" . implode(",", $this->_array_column($car, "id")) . ")";
                    }
                    $driver = M("driver")->where(array("driver_name" => array("like", "%" . $searchKey . "%")))->field("id")->select();
                    if ($driver) {
                        $search_sql .= " or t.driver_id in (" . implode(",", $this->_array_column($driver, "id")) . ")";
                    }
                    $company = M("company")->where(array("company_name" => array("like", "%" . $searchKey . "%")))->field("id")->select();
                    if ($company) {
                        $search_sql .= " or t.company_id in (" . implode(",", $this->_array_column($company, "id")) . ")";
                    }
                    $user = M("user")->where(array("user_name" => array("like", "%" . $searchKey . "%")))->field("id")->select();
                    if ($user) {
                        $search_sql .= " or t.use_user_id in (" . implode(",", $this->_array_column($user, "id")) . ")";
                    }
                    $map["_string"] = $search_sql;
                }

                $count = M("Travel as t")->where($map)->count();

//                echo M("Travel as t")->getLastSql();exit;
                $pageSize = 15;

                $Page = new Page($count, $pageSize);

                $Page->setConfig('header', '<li class="rows">共<b>%TOTAL_ROW%</b>条记录 第<b>%NOW_PAGE%</b>页/共<b>%TOTAL_PAGE%</b>页</li>');
                $Page->setConfig('prev', '上一页');
                $Page->setConfig('next', '下一页');
                $Page->setConfig('last', '末页');
                $Page->setConfig('first', '首页');
                $Page->setConfig('theme', '%FIRST%%UP_PAGE%%LINK_PAGE%%DOWN_PAGE%%END%%HEADER%');
                $Page->lastSuffix = false;

                $travels = M("Travel t")->where($map)->limit($Page->firstRow . ',' . $Page->listRows)->select();

                foreach ($travels as &$val) {
                    //获取用车人信息
                    $user             = M("User")->where(array("id" => $val["use_user_id"]))->find();
                    $val["user_name"] = $user["user_name"];

                    //单位信息
                    $companyyy            = M("Company")->where(array("id" => $val["company_id"]))->find();
                    $val["company_namee"] = $companyyy["company_name"];

                    //车辆信息
                    $car            = M("Car")->where(array("id" => $val["car_id"]))->find();
                    $val["car_num"] = $car["car_num"];

                    //司机信息

                    if ($val["jj_id"]) {  //第三方派车
                        $val["driver_name"] = $val["jj_driver_name"];
                        $val["car_num"]     = $val["jj_car_num"];
                    } else {
                        //司机信息
                        $driver             = M("Driver")->where(array("id" => $val["driver_id"]))->find();
                        $val["driver_name"] = $driver["driver_name"];
                    }
                }

                //合计汇总
                $field = 'sum(t.mileage) as companyMileageCount,sum(t.fees_sum) as luqiaoCount ,sum(t.service_charge) as fuwufeiCount,sum(t.driver_bt_cost) as buzhuCount, sum(t.parking_rate_sum + t.driver_cost + t.over_time_cost + t.over_mileage_cost + t.else_cost) as qitacount,sum(totle_rate) as xiaoji';
                $total = M("Travel t")->where($map)->field($field)->select();
                $this->assign("page", $Page->show());
                $this->assign("travels", $travels);
                $this->assign("total", $total[0]);
            }
        }

        $this->assign("startTime", $startTime ? $startTime : date('Y-m-01', strtotime(date("Y-m-d"))));
        $this->assign("endTime", $endTime ? $endTime : date('Y-m-d', strtotime(date("Y-m-d"))));
        $this->display();
    }

    //车辆报表导出
    public function car_export_to_csv($page = 1)
    {

        //获取开始时间
        $startTime = trim($_REQUEST['startTime']);
        $endTime   = trim($_REQUEST['endTime']);
        $type      = intval($_REQUEST['type']);
        $searchKey = trim($_REQUEST['searchKey']);

        $map             = array();
        $map["t.is_del"] = 0;
        $map["t.state"]  = 9;

        //获取开始时间
        if (!empty($startTime) && empty($endTime)) {
            $map['t.departure_time'] = array('gt', strtotime($startTime));
        } elseif (!empty($endTime) && empty($startTime)) {
            $map['t.departure_time'] = array('elt', strtotime($endTime) + 24 * 3600);
        } elseif ((!empty($startTime)) && !empty($endTime)) {
            $map['t.departure_time'] = array('between', array(strtotime($startTime), strtotime($endTime) + 24 * 3600 - 1));
        }

        if ($type == 1) {

            $map['c.is_del'] = 0;
            if ($searchKey) {  //搜索车牌号或者单位名称
                $search_sql = " c.car_num like '%" . $searchKey . "%' ";
//                $company    = M("company")->where(array("is_del"=>0,"company_name" => array("like", "%" . $searchKey . "%")))->field("id")->select();
//                if ($company) {
//                    $search_sql .= " or c.company_id in (" . implode(",", $this->_array_column($company, "id")) . ")";
//                }
                $map["_string"] = $search_sql;
            }

            $field = 'c.id,t.car_id,c.car_num,count(t.car_id) AS finishCount,sum(t.mileage) as companyMileageCount,sum(t.fees_sum) as luqiaoCount ,sum(t.service_charge) as fuwufeiCount,sum(t.driver_bt_cost) as buzhuCount,sum(t.parking_rate_sum +t.driver_cost + t.over_time_cost + t.over_mileage_cost + t.else_cost) as qitacount,sum(totle_rate) as heji ';

            $cars = M("car as c")->join("left join " . C("DB_PREFIX") . "travel as t on c.id =  t.car_id")->where($map)->group("t.car_id")->field($field)->having('finishCount>=1')->select();

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


            foreach ($cars as &$val) {
                $val["finishCount"]         = $val['finishcount'];
                $val["companyMileageCount"] = $val["companymileagecount"] ? $val["companymileagecount"] : 0;
                $val["luqiaoCount"]         = $val["luqiaocount"] ? $val["luqiaocount"] : 0;
                $val["fuwufeiCount"]        = $val["fuwufeicount"] ? $val["fuwufeicount"] : 0;
                $val["buzhuCount"]          = $val["buzhucount"] ? $val["buzhucount"] : 0;
                $val["qitaCount"]           = $val["qitacount"] ? $val["qitacount"] : 0;
                $val["heji"]                = $val["heji"] ? $val["heji"] : 0;

                //计算维修保养费用
                $xiche['car_id']    = array('eq', $val["id"]);
                $xiche["is_del"]    = array('eq', 0);
                $xiche["wash_time"] = $map['t.departure_time'];

                $weixiu['car_id']     = array('eq', $val["id"]);
                $weixiu["is_del"]     = array('eq', 0);
                $weixiu["start_time"] = $map['t.departure_time'];

                $jiayou['car_id']       = array('eq', $val["id"]);
                $jiayou["is_del"]       = array('eq', 0);
                $jiayou["trading_time"] = $map['t.departure_time'];

                $nianjian['car_id']   = array('eq', $val["id"]);
                $nianjian["is_del"]   = array('eq', 0);
                $nianjian["pay_time"] = $map['t.departure_time'];

                $val["xiche"]    = M("CostWash")->where($xiche)->sum("cost");
                $val["weixiu"]   = M("CostRepair")->where($weixiu)->sum("cost");
                $val["jiayou"]   = M("CostOil")->where($jiayou)->sum("cost");
                $val["nianjian"] = M("CostInsurance")->where($nianjian)->sum("cost");
                $val["xiaoji"]   = $val["xiche"] + $val["weixiu"] + $val["jiayou"] + $val["nianjian"];

                $data   = array();
                $data[] = iconv('utf-8', 'GB18030', $val["car_num"]);
                $data[] = iconv('utf-8', 'GB18030', $val["finishCount"]);
                $data[] = iconv('utf-8', 'GB18030', $val["companyMileageCount"]);
                $data[] = iconv('utf-8', 'GB18030', $val["luqiaoCount"]);
                $data[] = iconv('utf-8', 'GB18030', $val["tingcheCount"]);
                $data[] = iconv('utf-8', 'GB18030', $val['zhushuCount']);
                $data[] = iconv('utf-8', 'GB18030', $val['fuwufeiCount']);
                $data[] = iconv('utf-8', 'GB18030', $val['buzhuCount']);
                $data[] = iconv('utf-8', 'GB18030', $val['qitaCount']);
                $data[] = iconv('utf-8', 'GB18030', $val['heji']);
                $data[] = iconv('utf-8', 'GB18030', $val["xiche"]);
                $data[] = iconv('utf-8', 'GB18030', $val["weixiu"]);
                $data[] = iconv('utf-8', 'GB18030', $val["jiayou"]);
                $data[] = iconv('utf-8', 'GB18030', $val['nianjian']);
                $data[] = iconv('utf-8', 'GB18030', $val['xiaoji']);
                fputcsv($fp, $data);
            }
            unset($val);

            //汇总合计
            $field = 't.id ,count(t.id) AS finishCount,sum(t.mileage) as companyMileageCount,sum(t.fees_sum) as luqiaoCount ,sum(t.service_charge) as fuwufeiCount,sum(t.driver_bt_cost) as buzhuCount,sum(t.parking_rate_sum + t.driver_cost + t.over_time_cost + t.over_mileage_cost + t.else_cost) as qitacount,sum(totle_rate) as heji ';
            $total = M("car as c")->join("left join " . C("DB_PREFIX") . "travel as t on c.id =  t.car_id")->where($map)->field($field)->having('finishCount>=1')->select();
            foreach ($total as &$val) {
                //计算维修保养费用
                $xiche['car_id']    = array('eq', $val["id"]);
                $xiche["is_del"]    = array('eq', 0);
                $xiche["wash_time"] = $map['t.departure_time'];

                $weixiu['car_id']     = array('eq', $val["id"]);
                $weixiu["is_del"]     = array('eq', 0);
                $weixiu["start_time"] = $map['t.departure_time'];

                $jiayou['car_id']       = array('eq', $val["id"]);
                $jiayou["is_del"]       = array('eq', 0);
                $jiayou["trading_time"] = $map['t.departure_time'];

                $nianjian['car_id']   = array('eq', $val["id"]);
                $nianjian["is_del"]   = array('eq', 0);
                $nianjian["pay_time"] = $map['t.departure_time'];

                $val["xiche"]    = M("CostWash")->where($xiche)->sum("cost");
                $val["weixiu"]   = M("CostRepair")->where($weixiu)->sum("cost");
                $val["jiayou"]   = M("CostOil")->where($jiayou)->sum("cost");
                $val["nianjian"] = M("CostInsurance")->where($nianjian)->sum("cost");
                $val["xiaoji"]   = $val["xiche"] + $val["weixiu"] + $val["jiayou"] + $val["nianjian"];
            }
            unset($val);
            $sum = array("合计", $total[0]["finishcount"], $total[0]["companymileagecount"], $total[0]["luqiaocount"], $total[0]["tingchecount"], $total[0]["zhushucount"], $total[0]["fuwufeicount"], $total[0]["buzhucount"], $total[0]["qitacount"], $total[0]["heji"], $total[0]["xiche"], $total[0]["weixiu"], $total[0]["jiayou"], $total[0]["nianjian"], $total[0]["xiaoji"],);
            foreach ($sum as $i => $v) {
                $sum[$i] = iconv('utf-8', 'GB18030', $v);
            }
            fputcsv($fp, $sum);
        }

        if ($type == 2) {

            if ($searchKey) { // 搜索车牌号或者司机或者单位或者用车人
                $search_sql = " t.jj_driver_name like '%" . $searchKey . "%' or t.jj_car_num like '%" . $searchKey . "%'";
                $car        = M("car")->where(array("car_num" => array("like", "%" . $searchKey . "%")))->field("id")->select();
                if ($car) {
                    $search_sql .= " or t.car_id in (" . implode(",", $this->_array_column($car, "id")) . ")";
                }
                $driver = M("driver")->where(array("driver_name" => array("like", "%" . $searchKey . "%")))->field("id")->select();
                if ($driver) {
                    $search_sql .= " or t.driver_id in (" . implode(",", $this->_array_column($driver, "id")) . ")";
                }
                $company = M("company")->where(array("company_name" => array("like", "%" . $searchKey . "%")))->field("id")->select();
                if ($company) {
                    $search_sql .= " or t.company_id in (" . implode(",", $this->_array_column($company, "id")) . ")";
                }
                $user = M("user")->where(array("user_name" => array("like", "%" . $searchKey . "%")))->field("id")->select();
                if ($user) {
                    $search_sql .= " or t.use_user_id in (" . implode(",", $this->_array_column($user, "id")) . ")";
                }
                $map["_string"] = $search_sql;
            }

            //导出数据
            header("Content-Type: text/html; charset=gbk");
            header("Content-type:application/vnd.ms-excel");
            $excel_name = $_REQUEST["startTime"] . "至" . $_REQUEST["endTime"] . "车辆数据明细";
            header("Content-Disposition:filename=" . iconv("UTF-8", "GBK", $excel_name) . ".csv");
            $fp = fopen('php://output', 'a');

            if ($page == 1) {
                $column_name = array("车牌号码", "流水号", "出车司机", "用车单位", "用车人", "出车时间", "目的地", "出行里程", "路桥费", "出行服务费", "出差补助", "其他", "小计");
                foreach ($column_name as $i => $v) {
                    $column_name[$i] = iconv('utf-8', 'GB18030', $v);
                }
                fputcsv($fp, $column_name);
            }

            $size    = 1000;
            $limit   = ($page - 1) * $size . ',' . $size;
            $travels = M("Travel t")->where($map)->limit($limit)->select();

            if ($travels) {
                register_shutdown_function(array(&$this, "car_export_to_csv"), $page + 1);

                foreach ($travels as &$val) {
                    //获取用车人信息
                    $user = M("User")->where(array("id" => $val["use_user_id"]))->find();
                    //单位信息
                    $companyyy = M("Company")->where(array("id" => $val["company_id"]))->find();
                    //车辆信息
                    $car = M("Car")->where(array("id" => $val["car_id"]))->find();

                    //司机信息
                    if ($val["jj_id"]) {  //第三方派车
                        $val["driver_name"] = $val["jj_driver_name"];
                        $val["car_num"]     = $val["jj_car_num"];
                    } else {
                        $driver             = M("Driver")->where(array("id" => $val["driver_id"]))->find();
                        $val["driver_name"] = $driver["driver_name"];
                        $val["car_num"]     = $car["car_num"];
                    }

                    $data   = array();
                    $data[] = iconv('utf-8', 'GB18030', $val["car_num"]);
                    $data[] = iconv('utf-8', 'GB18030', $val["serial_number"]);
                    $data[] = iconv('utf-8', 'GB18030', $val["driver_name"]);
                    $data[] = iconv('utf-8', 'GB18030', $companyyy["company_name"]);
                    $data[] = iconv('utf-8', 'GB18030', $user["user_name"]);
                    $data[] = iconv('utf-8', 'GB18030', date("Y-m-d H:i:s", $val['start_car_time']));
                    $data[] = iconv('utf-8', 'GB18030', $val['to_place']);
                    $data[] = iconv('utf-8', 'GB18030', $val['mileage']);
                    $data[] = iconv('utf-8', 'GB18030', $val['fees_sum']);
                    $data[] = iconv('utf-8', 'GB18030', $val['service_charge']);
                    $data[] = iconv('utf-8', 'GB18030', 0);
                    $data[] = iconv('utf-8', 'GB18030', $val["else_cost"]);
                    $data[] = iconv('utf-8', 'GB18030', $val["totle_rate"]);
                    fputcsv($fp, $data);

                }
                unset($val);
            } else {
                //合计汇总
                $field = 'sum(t.mileage) as companyMileageCount,sum(t.fees_sum) as luqiaoCount ,sum(t.service_charge) as fuwufeiCount,sum(t.driver_bt_cost) as buzhuCount, sum(t.parking_rate_sum + t.driver_cost + t.over_time_cost + t.over_mileage_cost + t.else_cost) as qitacount,sum(totle_rate) as xiaoji';
                $total = M("Travel t")->where($map)->field($field)->select();
                $sum   = array("合计", "", "", "", "", "", "", $total[0]['companymileagecount'], $total[0]['luqiaocount'], $total[0]['fuwufeicount'], $total[0]['buzhucount'], $total[0]['qitacount'], $total[0]['xiaoji']);
                foreach ($sum as $i => $v) {
                    $sum[$i] = iconv('utf-8', 'GB18030', $v);
                }
                fputcsv($fp, $sum);
            }

        }
        ob_flush();
        flush();
//        exit;
    }

    //司机数据报表
    public function byDriver()
    {

        if (empty($_POST)) {
            $this->assign("aa", "0");
        } else {

            $startTime = trim($_REQUEST['startTime']);
            $endTime   = trim($_REQUEST['endTime']);
            $type      = intval($_REQUEST["type"]);
            $searchKey = trim($_REQUEST["searchKey"]);

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

            $this->assign("aa", "1");
            $this->assign("type", $type);
            $this->assign("driver_name", $searchKey);

            if ($type == 1) {

                $map['c.is_del'] = 0;

                if (!empty($searchKey)) {
                    $map["c.driver_phone|c.driver_name"] = array("like", "%" . $searchKey . "%");
                }

                $count = M("Driver as c")->join("left join " . C("DB_PREFIX") . "travel as t on c.id =  t.driver_id")->where($map)->group("t.driver_id")->having('count(t.driver_id)>=1')->field('driver_id')->select();

                $pageSize = 10;

                $Page = new Page(count($count), $pageSize);

                $Page->setConfig('header', '<li class="rows">共<b>%TOTAL_ROW%</b>条记录 第<b>%NOW_PAGE%</b>页/共<b>%TOTAL_PAGE%</b>页</li>');
                $Page->setConfig('prev', '上一页');
                $Page->setConfig('next', '下一页');
                $Page->setConfig('last', '末页');
                $Page->setConfig('first', '首页');
                $Page->setConfig('theme', '%FIRST%%UP_PAGE%%LINK_PAGE%%DOWN_PAGE%%END%%HEADER%');
                $Page->lastSuffix = false;

                $field = 't.driver_id,c.driver_name,c.driver_phone,count(t.driver_id) AS finishCount,sum(t.mileage) as companyMileageCount,sum(t.fees_sum) as luqiaoCount ,sum(t.service_charge) as fuwufeiCount,sum(t.driver_bt_cost) as buzhuCount,sum(t.parking_rate_sum) as t1,sum(t.driver_cost) as t2,sum(t.over_time_cost) as t3,sum(t.over_mileage_cost) as t4,sum(t.else_cost) as t5 ';

                $drivers = M("Driver as c")->join("left join " . C("DB_PREFIX") . "travel as t on c.id =  t.driver_id")->where($map)->group("t.driver_id")->field($field)->limit($Page->firstRow . ',' . $Page->listRows)->having('finishCount>=1')->select();

                foreach ($drivers as &$val) {
                    $val["finishCount"]         = $val['finishcount'];
                    $val["companyMileageCount"] = $val["companymileagecount"] ? $val["companymileagecount"] : 0;
                    $val["luqiaoCount"]         = $val["luqiaocount"] ? $val["luqiaocount"] : 0;
                    $val["fuwufeiCount"]        = $val["fuwufeicount"] ? $val["fuwufeicount"] : 0;
                    $val["buzhuCount"]          = $val["buzhucount"] ? $val["buzhucount"] : 0;
                    $val["qitaCount"]           = $val["t1"] + $val["t2"] + $val["t3"] + $val["t4"] + $val["t5"];
                    $val["heji"]                = $val["luqiaoCount"] + $val["fuwufeiCount"] + $val["buzhuCount"] + $val["qitaCount"];
                }
                unset($val);

                //汇总合计
                $field = 'count(t.id) AS finishCount,sum(t.mileage) as companyMileageCount,sum(t.fees_sum) as luqiaoCount ,sum(t.service_charge) as fuwufeiCount,sum(t.driver_bt_cost) as buzhuCount,sum(t.parking_rate_sum) as t1,sum(t.driver_cost) as t2,sum(t.over_time_cost) as t3,sum(t.over_mileage_cost) as t4,sum(t.else_cost) as t5 ';
                $total = M("Driver as c")->join("left join " . C("DB_PREFIX") . "travel as t on c.id =  t.driver_id")->where($map)->field($field)->having('finishCount>=1')->select();
                foreach ($total as &$val) {
                    $val['qitacount'] = $val['t1'] + $val['t2'] + $val['t3'] + $val['t4'] + $val['t5'];
                    $val['xiaoji']    = $val['luqiaocount'] + $val['fuwufeicount'] + $val['buzhucount'] + $val['qitacount'];
                }
                unset($val);

                $this->assign("total", $total[0]);
                $this->assign("drivers", $drivers);
                $this->assign("page", $Page->show());
            }

            if ($type == 2) {
                if ($searchKey) { // 搜索车牌号或者司机或者单位或者用车人
                    $search_sql = "  ";
                    $driver     = M("driver")->where(array("is_del" => 0, "driver_name" => array("like", "%" . $searchKey . "%")))->field("id")->select();
                    if ($driver) {
                        $search_sql .= " t.driver_id in (" . implode(",", $this->_array_column($driver, "id")) . ")";
                    }
                    $company = M("company")->where(array("is_del" => 0, "company_name" => array("like", "%" . $searchKey . "%")))->field("id")->select();
                    if ($company) {
                        $has_or     = empty($driver) ? " " : " or ";
                        $search_sql .= $has_or . " t.company_id in (" . implode(",", $this->_array_column($company, "id")) . ")";
                    }
                    $user = M("user")->where(array("is_del" => 0, "user_name" => array("like", "%" . $searchKey . "%")))->field("id")->select();
                    if ($user) {
                        $has_or     = empty($driver) && empty($company) ? " " : " or ";
                        $search_sql .= $has_or . " t.use_user_id in (" . implode(",", $this->_array_column($user, "id")) . ")";
                    }
                    $map["_string"] = $search_sql;
                }

                $count = M("Travel as t")->where($map)->field("t.use_user_id,t.company_id,t.driver_id,t.serial_number,t.start_car_time,t.to_place,t.mileage,t.fees_sum,t.service_charge,t.else_cost,t.totle_rate")->count();

                $pageSize = 10;

                $Page = new Page($count, $pageSize);

                $Page->setConfig('header', '<li class="rows">共<b>%TOTAL_ROW%</b>条记录 第<b>%NOW_PAGE%</b>页/共<b>%TOTAL_PAGE%</b>页</li>');
                $Page->setConfig('prev', '上一页');
                $Page->setConfig('next', '下一页');
                $Page->setConfig('last', '末页');
                $Page->setConfig('first', '首页');
                $Page->setConfig('theme', '%FIRST%%UP_PAGE%%LINK_PAGE%%DOWN_PAGE%%END%%HEADER%');
                $Page->lastSuffix = false;

                $travels = M("Travel as t")->where($map)->field("t.use_user_id,t.company_id,t.driver_id,t.serial_number,t.start_car_time,t.to_place,t.mileage,t.fees_sum,t.service_charge,t.else_cost,t.totle_rate")->limit($Page->firstRow . ',' . $Page->listRows)->select();

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

                //合计汇总
                $field = 'sum(t.mileage) as companyMileageCount,sum(t.fees_sum) as luqiaoCount ,sum(t.service_charge) as fuwufeiCount,sum(t.driver_bt_cost) as buzhuCount,sum(t.parking_rate_sum) as t1,sum(t.driver_cost) as t2,sum(t.over_time_cost) as t3,sum(t.over_mileage_cost) as t4,sum(t.else_cost) as t5 ';
                $total = M("Travel as t")->where($map)->field($field)->select();

                foreach ($total as &$val) {
                    $val['qitacount'] = $val['t1'] + $val['t2'] + $val['t3'] + $val['t4'] + $val['t5'];
                    $val['xiaoji']    = $val['luqiaocount'] + $val['fuwufeicount'] + $val['buzhucount'] + $val['qitacount'];
                }
                unset($val);

                $this->assign("page", $Page->show());
                $this->assign("travels", $travels);
                $this->assign("total", $total[0]);
            }
        }

        $this->assign("startTime", $startTime ? $startTime : date('Y-m-01', strtotime(date("Y-m-d"))));
        $this->assign("endTime", $endTime ? $endTime : date('Y-m-d', strtotime(date("Y-m-d"))));
        $this->display();
    }

    //用户数据报表
    public function byUser()
    {
        if (empty($_POST)) {
            $this->assign("aa", "0");
        } else {

            $startTime = trim($_REQUEST['startTime']);
            $endTime   = trim($_REQUEST['endTime']);
            $type      = intval($_REQUEST["type"]);
            $searchKey = trim($_REQUEST["searchKey"]);

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

            $this->assign("username", $searchKey);
            $this->assign("type", $type);
            $this->assign("aa", "1");

            if ($type == 1) {

                if (!empty($searchKey)) {
                    $map["c.user_phone|c.user_name"] = array("like", "%" . $searchKey . "%");

                }

                $count = M("User as c")->join("left join " . C("DB_PREFIX") . "travel as t on c.id =  t.use_user_id")->where($map)->group("t.use_user_id")->having('count(t.use_user_id)>=1')->field('use_user_id')->select();

                $pageSize = 10;

                $Page = new Page(count($count), $pageSize);

                $Page->setConfig('header', '<li class="rows">共<b>%TOTAL_ROW%</b>条记录 第<b>%NOW_PAGE%</b>页/共<b>%TOTAL_PAGE%</b>页</li>');
                $Page->setConfig('prev', '上一页');
                $Page->setConfig('next', '下一页');
                $Page->setConfig('last', '末页');
                $Page->setConfig('first', '首页');
                $Page->setConfig('theme', '%FIRST%%UP_PAGE%%LINK_PAGE%%DOWN_PAGE%%END%%HEADER%');
                $Page->lastSuffix = false;

                $field = 't.company_id,c.user_name,c.user_phone,count(t.use_user_id) AS finishCount,sum(t.mileage) as companyMileageCount,sum(t.fees_sum) as luqiaoCount ,sum(t.service_charge) as fuwufeiCount,sum(t.driver_bt_cost) as buzhuCount,sum(t.parking_rate_sum) as t1,sum(t.driver_cost) as t2,sum(t.over_time_cost) as t3,sum(t.over_mileage_cost) as t4,sum(t.else_cost) as t5 ';

                $users = M("User as c")->join("left join " . C("DB_PREFIX") . "travel as t on c.id =  t.use_user_id")->where($map)->group("t.use_user_id")->field($field)->limit($Page->firstRow . ',' . $Page->listRows)->having('finishCount>=1')->select();

                foreach ($users as &$val) {
                    $val["finishCount"]         = $val['finishcount'];
                    $val["companyMileageCount"] = $val["companymileagecount"] ? $val["companymileagecount"] : 0;
                    $val["luqiaoCount"]         = $val["luqiaocount"] ? $val["luqiaocount"] : 0;
                    $val["fuwufeiCount"]        = $val["fuwufeicount"] ? $val["fuwufeicount"] : 0;
                    $val["buzhuCount"]          = $val["buzhucount"] ? $val["buzhucount"] : 0;
                    $val["qitaCount"]           = $val["t1"] + $val["t2"] + $val["t3"] + $val["t4"] + $val["t5"];
                    $val["heji"]                = $val["luqiaoCount"] + $val["fuwufeiCount"] + $val["buzhuCount"] + $val["qitaCount"];
                }
                unset($val);

                //汇总合计
                $field = 'count(t.id) AS finishCount,sum(t.mileage) as companyMileageCount,sum(t.fees_sum) as luqiaoCount ,sum(t.service_charge) as fuwufeiCount,sum(t.driver_bt_cost) as buzhuCount,sum(t.parking_rate_sum) as t1,sum(t.driver_cost) as t2,sum(t.over_time_cost) as t3,sum(t.over_mileage_cost) as t4,sum(t.else_cost) as t5 ';
                $total = M("User as c")
                    ->join("left join " . C("DB_PREFIX") . "travel as t on c.id =  t.use_user_id")
                    ->where($map)
                    ->field($field)
                    ->having('finishCount>=1')
                    ->select();
//                echo M("Company as c")->getLastSql();
                foreach ($total as &$val) {
                    $val['qitacount'] = $val['t1'] + $val['t2'] + $val['t3'] + $val['t4'] + $val['t5'];
                    $val['xiaoji']    = $val['luqiaocount'] + $val['fuwufeicount'] + $val['buzhucount'] + $val['qitacount'];
                }
                unset($val);

//                var_dump($total[0]);exit;
                $this->assign("page", $Page->show());
                $this->assign("total", $total[0]);
                $this->assign("users", $users);
            }

            if ($type == 2) {

                if (!empty($searchKey)) {
                    $company_ids = M("company")->where(array("company_name" => array("like", "%" . $searchKey . "%")))->field("id")->select();  //查询是否匹配单位名称
                    $user_ids    = M("user")->where(array("user_name|user_phone" => array("like", "%" . $searchKey . "%")))->field("id")->select();  //查询是否匹配用车人
                    if ($company_ids) {
                        $map["t.company_id"] = array("IN", $company_ids ? $this->_array_column($company_ids, "id") : array(0));
                    } elseif ($user_ids) {
                        $map["t.use_user_id"] = array("IN", $user_ids ? $this->_array_column($user_ids, "id") : array(0));
                    }
                }

                $count = M("Travel as t")->join("left join " . C("DB_PREFIX") . "company as u on u.id =  t.company_id left join " . C("DB_PREFIX") . "user c on c.id = t.use_user_id")->where($map)->count();

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
                    ->join("left join " . C("DB_PREFIX") . "company as u on u.id =  t.company_id left join " . C("DB_PREFIX") . "user c on c.id = t.use_user_id")
                    ->where($map)
                    ->limit($Page->firstRow . ',' . $Page->listRows)
                    ->field("c.user_name,c.user_phone,u.company_name as company_namee,t.use_user_id,t.company_id,t.travel_nature,t.serial_number,t.start_car_time,t.to_place,t.mileage,t.fees_sum,t.service_charge,t.else_cost,t.totle_rate")
                    ->select();

                //合计汇总
                $field = 'sum(t.mileage) as companyMileageCount,sum(t.fees_sum) as luqiaoCount ,sum(t.service_charge) as fuwufeiCount,sum(t.driver_bt_cost) as buzhuCount,sum(t.parking_rate_sum) as t1,sum(t.driver_cost) as t2,sum(t.over_time_cost) as t3,sum(t.over_mileage_cost) as t4,sum(t.else_cost) as t5 ';
                $total = M("Travel as t")->join("left join " . C("DB_PREFIX") . "company as c on c.id =  t.company_id left join " . C("DB_PREFIX") . "user u on u.id = t.use_user_id")->where($map)->field($field)->select();

                foreach ($total as &$val) {
                    $val['qitacount'] = $val['t1'] + $val['t2'] + $val['t3'] + $val['t4'] + $val['t5'];
                    $val['xiaoji']    = $val['luqiaocount'] + $val['fuwufeicount'] + $val['buzhucount'] + $val['qitacount'];
                }
                unset($val);

                $this->assign("page", $Page->show());
                $this->assign("travels", $travels);
                $this->assign("total", $total[0]);
            }
        }

        $this->assign("startTime", $startTime ? $startTime : date('Y-m-01', strtotime(date("Y-m-d"))));
        $this->assign("endTime", $endTime ? $endTime : date('Y-m-d', strtotime(date("Y-m-d"))));
        $this->display();
    }

    //用户报表导出
    public function user_export_to_csv()
    {
        set_time_limit(0);
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
                $searchKey   = trim($_REQUEST["searchKey"]);
                $company_ids = M("company")->where(array("company_name" => array("like", "%" . $searchKey . "%")))->field("id")->select();  //查询是否匹配单位名称
                $user_ids    = M("user")->where(array("user_name|user_phone" => array("like", "%" . $searchKey . "%")))->field("id")->select();  //查询是否匹配用车人
                if ($company_ids) {
                    $map["company_id"] = array("IN", $company_ids ? $this->_array_column($company_ids, "id") : array(0));
                } elseif ($user_ids) {
                    $map["use_user_id"] = array("IN", $user_ids ? $this->_array_column($user_ids, "id") : array(0));
                }
            }

            $map["is_del"] = 0;
            $travels       = M("Travel")->where($map)->field('use_user_id,company_id,driver_id,serial_number,start_car_time,to_place,mileage,fees_sum,service_charge,totle_rate,driver_bt_cost,parking_rate_sum,driver_cost ,over_time_cost,over_mileage_cost,else_cost')->select();

            $mileagenum        = 0;
            $fees_sumnum       = 0;
            $service_chargenum = 0;
            $costnum           = 0;
            $totle_ratenum     = 0;
            foreach ($travels as &$val) {
                //汇总
                $qita              = $val["parking_rate_sum"] + $val["driver_cost "] + $val["over_time_cost"] + $val["over_mileage_cost"] + $val["else_cost"];
                $mileagenum        += $val['mileage'];
                $fees_sumnum       += $val['fees_sum'];
                $service_chargenum += $val['service_charge'];
                $costnum           += $qita;
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
                $data[] = iconv("UTF-8", "GBK", $qita);
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
        $startTime = trim($_REQUEST['startTime']);
        $endTime   = trim($_REQUEST['endTime']);
        $type      = intval($_REQUEST["type"]);
        $searchKey = trim($_REQUEST["searchKey"]);

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

        header("Content-Type: text/html; charset=gbk");
        header("Content-type:application/vnd.ms-excel");

        if ($type == 1) {
            if (!empty($searchKey)) {
                $map["c.driver_phone|c.driver_name"] = array("like", "%" . $searchKey . "%");
            }
            $map['c.is_del'] = 0;

            $field = 't.driver_id,c.driver_name,c.driver_phone,count(t.driver_id) AS finishCount,sum(t.mileage) as companyMileageCount,sum(t.fees_sum) as luqiaoCount ,sum(t.service_charge) as fuwufeiCount,sum(t.driver_bt_cost) as buzhuCount,sum(t.parking_rate_sum) as t1,sum(t.driver_cost) as t2,sum(t.over_time_cost) as t3,sum(t.over_mileage_cost) as t4,sum(t.else_cost) as t5 ';

            $drivers = M("Driver as c")->join("left join " . C("DB_PREFIX") . "travel as t on c.id =  t.driver_id")->where($map)->group("t.driver_id")->field($field)->having('finishCount>=1')->select();
//                echo M("Driver as c")->getLastSql();exit;
            $hj = array(
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
                //汇总合计
                $hj["finishCount"]         += $val["finishcount"];
                $hj["companyMileageCount"] += $val["companymileagecount"];
                $hj["luqiaoCount"]         += $val["luqiaocount"];
                $hj["fuwufeiCount"]        += $val["fuwufeicount"];
                $hj["buzhuCount"]          += $val["buzhucount"];
                $hj["qitaCount"]           += $val["t1"] + $val["t2"] + $val["t3"] + $val["t4"] + $val["t5"];
                $hj["heji"]                += $val["luqiaocount"] + $val["fuwufeicount"] + $val["buzhucount"] + $val["t1"] + $val["t2"] + $val["t3"] + $val["t4"] + $val["t5"];

                //输出数据
                $data   = array();
                $data[] = iconv("UTF-8", "GBK", $val["driver_name"]);
                $data[] = iconv("UTF-8", "GBK", $val["driver_phone"]);
                $data[] = iconv("UTF-8", "GBK", $val['finishcount']);
                $data[] = iconv("UTF-8", "GBK", $val["companymileagecount"] ? $val["companymileagecount"] : 0);
                $data[] = iconv("UTF-8", "GBK", $val["luqiaocount"] ? $val["luqiaocount"] : 0);
                $data[] = iconv("UTF-8", "GBK", $val["fuwufeicount"] ? $val["fuwufeicount"] : 0);
                $data[] = iconv("UTF-8", "GBK", $val["buzhucount"] ? $val["buzhucount"] : 0);
                $data[] = iconv("UTF-8", "GBK", $val["t1"] + $val["t2"] + $val["t3"] + $val["t4"] + $val["t5"]);
                $data[] = iconv("UTF-8", "GBK", $val["luqiaocount"] + $val["fuwufeicount"] + $val["buzhucount"] + $val["qitacount"]);
                fputcsv($fp, $data);
            }
            unset($val);
            $sum = array("合计", "", $hj["finishCount"], $hj["companyMileageCount"], $hj["luqiaoCount"], $hj["fuwufeiCount"], $hj["buzhuCount"], $hj["qitaCount"], $hj["heji"]);
            foreach ($sum as $i => $v) {
                $sum[$i] = iconv('utf-8', 'GB18030', $v);
            }
            fputcsv($fp, $sum);
        }

        if ($_REQUEST["type"] == 2) {
//            $map["is_del"] = 0;
//            $map["state"]  = 9;
            if ($searchKey) { // 搜索车牌号或者司机或者单位或者用车人
                $search_sql = "  ";
                $driver     = M("driver")->where(array("is_del" => 0, "driver_name" => array("like", "%" . $searchKey . "%")))->field("id")->select();
                if ($driver) {
                    $search_sql .= " t.driver_id in (" . implode(",", $this->_array_column($driver, "id")) . ")";
                }
                $company = M("company")->where(array("is_del" => 0, "company_name" => array("like", "%" . $searchKey . "%")))->field("id")->select();
                if ($company) {
                    $has_or     = empty($driver) ? " " : " or ";
                    $search_sql .= $has_or . " t.company_id in (" . implode(",", $this->_array_column($company, "id")) . ")";
                }
                $user = M("user")->where(array("is_del" => 0, "user_name" => array("like", "%" . $searchKey . "%")))->field("id")->select();
                if ($user) {
                    $has_or     = empty($driver) && empty($company) ? " " : " or ";
                    $search_sql .= $has_or . " t.use_user_id in (" . implode(",", $this->_array_column($user, "id")) . ")";
                }
                $map["_string"] = $search_sql;
            }

            $travels = M("Travel t")->where($map)->field("t.use_user_id,t.company_id,t.driver_id,t.serial_number,t.start_car_time,t.to_place,mileage,t.fees_sum,t.service_charge,t.else_cost,t.totle_rate")->select();

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


}

