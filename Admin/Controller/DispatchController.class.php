<?php
/**
 * Created by PhpStorm.
 * User: MrQ
 * Date: 2018/5/2
 * Time: 18:57
 */

namespace Admin\Controller;

use Model\BaiDuApiModel;

class DispatchController extends CommonController
{
    public function index()
    {
        $travels = M("travel")->where(" state BETWEEN '5' AND '8' AND gps_code != '' AND is_del = 0 ")->field('gps_code,serial_number,from_place,to_place,jj_driver_name,jj_driver_phone,jj_car_num')->select();  //服务中（并且能够找到gps_code）的订单

        $baiDuApi = new BaiDuApiModel();
        foreach ($travels as &$val) {
            $res = $baiDuApi->search($val['gps_code']);
            if ($res['status'] == 0 && $res['total'] >= 1) {
                $val['entities']          = $res['entities'][0];
                $location                 = $val['entities']['latest_location']['latitude'] . ',' . $val['entities']['latest_location']['longitude'];
                $rs                       = $baiDuApi->geocoder($location);
                $val['formatted_address'] = $rs['status'] == 0 ? $rs['result']['formatted_address'] : '';
            }
        }
        unset($val);

        $this->assign("travels", json_encode($travels));
        $this->assign("trackDate", date("Y-m-d"));
        $this->display();
    }

    //实时监控司机数据
    public function getDrivers()
    {
        $currentPage = $_REQUEST['currentPage'] > 0 ? intval($_REQUEST['currentPage']) : 1;  //当前页
        $pageSize    = intval($_REQUEST['pageSize']);  //每页显示数量
        $searchKey   = trim($_REQUEST['searchKey']);   //搜索关键字

        $where['is_del']   = 0;
        $where['state']    = array('between', '5,8');
        $where['gps_code'] = array('neq', '');

        if ($searchKey) {
            $where['serial_number|jj_car_num|jj_driver_name'] = array('like', '%' . $searchKey . '%');
        }

        $limit = ($currentPage - 1) * $pageSize . ',' . $pageSize;

        $count = M("travel")->where($where)->field('gps_code,serial_number,from_place,to_place,jj_driver_name,jj_driver_phone,jj_car_num')->count();

        $totalPage = ceil($count / $pageSize); //总页数

        $travels = M("travel")->where($where)->limit($limit)->field('gps_code,serial_number,from_place,to_place,jj_driver_name,jj_driver_phone,jj_car_num')->order('serial_number desc')->select();  //服务中（并且能够找到gps_code）的订单

        if ($travels) {
            $baiDuApi = new BaiDuApiModel();
            foreach ($travels as &$val) {
                $res = $baiDuApi->search($val['gps_code']);
                if ($res['status'] == 0 && $res['total'] >= 1) {
                    $val['entities']          = $res['entities'][0];
                    $location                 = $val['entities']['latest_location']['latitude'] . ',' . $val['entities']['latest_location']['longitude'];
                    $rs                       = $baiDuApi->geocoder($location, 0);
                    $val['formatted_address'] = $rs['status'] == 0 ? $rs['result']['formatted_address'] : '';
                }
            }
            unset($val);
        }
        $this->ajaxReturn(array('data' => $travels, 'count' => $count, 'totalPage' => $totalPage));
    }

    //轨迹查询司机数据
    public function getTrackDrivers()
    {
        $currentPage = $_REQUEST['currentPageTrack'] > 0 ? intval($_REQUEST['currentPageTrack']) : 1;  //当前页
        $pageSize    = intval($_REQUEST['pageSize']);  //每页显示数量
        $searchKey   = trim($_REQUEST['searchKey']);   //搜索关键字

        $date       = $_REQUEST['trackDate'] ? strtotime(trim($_REQUEST['trackDate'])) : time();
        $start_time = strtotime(date("Y-m-d 00:00:00", $date));
        $end_time   = strtotime(date("Y-m-d 22:59:59", $date));

        $where['is_del']   = 0;
        $where['state']    = array('between', '5,8');
        $where['gps_code'] = array('neq', '');

        if ($searchKey) {
            $where['jj_car_num|jj_driver_name'] = array('like', '%' . $searchKey . '%');
        }

        $limit = ($currentPage - 1) * $pageSize . ',' . $pageSize;

        $count = M("travel")->where($where)->field('gps_code,serial_number,from_place,to_place,jj_driver_name,jj_driver_phone,jj_car_num')->count();

        $totalPage = ceil($count / $pageSize); //总页数

        $travels = M("travel")->where($where)->limit($limit)->field('gps_code,serial_number,from_place,to_place,jj_driver_name,jj_driver_phone,jj_car_num')->order('serial_number desc')->select();  //服务中（并且能够找到gps_code）的订单

        if ($travels) {
            foreach ($travels as &$val) {
                //获取里程
                $baiDuApi        = new BaiDuApiModel();
                $res             = $baiDuApi->getDistance($val['gps_code'], $start_time, $end_time);
                $val['distance'] = $res['status'] == 0 ? number_format($res['distance'] / 1000, 2) . 'km' : 0.00 . 'km';
            }
            unset($val);
        }
        $this->ajaxReturn(array('data' => $travels, 'count' => $count, 'totalPage' => $totalPage));
    }

    public function getTrack()
    {
        $date       = $_REQUEST['trackDate'] ? strtotime(trim($_REQUEST['trackDate'])) : time();
        $gps_code   = trim($_REQUEST['gps_code']);
        $start_time = strtotime(date("Y-m-d 00:00:00", $date));
        $end_time   = strtotime(date("Y-m-d 23:59:59", $date));
        $baiDuApi   = new BaiDuApiModel();
        $data       = $baiDuApi->getTrack($gps_code, $start_time, $end_time);
        $this->ajaxReturn(array('data' => $data));
    }

    public function deviceBind()
    {
        $this->display();
    }

    public function bind($id)
    {
        $car = M("car")->where(array("id" => $id, "is_del" => 0))->find();
        $this->assign("car", $car);
        $this->display();
    }

    public function bindDo()
    {
        $id       = intval($_REQUEST["id"]);
        $gps_code = trim($_REQUEST["gps_code"]);

        if(M("car")->where(array("gps_code"=>$gps_code))->find()){
            $this->ajaxReturn(array('code' => 0,'msg'=>'该设备已绑定其他车辆'));
        }

        $res      = M("car")->where(array("id" => $id, "is_del" => 0))->save(array("gps_code" => $gps_code));
        if ($res !== false) {
            $this->ajaxReturn(array('code' => 1 , 'msg'=>'绑定成功!'));
        } else
            $this->ajaxReturn(array('code' => 0 , 'msg'=>'绑定失败，请重试!'));
    }

    public function unbind()
    {
        $id  = intval($_REQUEST["id"]);
        $res = M("car")->where(array("id" => $id, "is_del" => 0))->save(array("gps_code" => ''));
        if ($res !== false) {
            $this->ajaxReturn(array('code' => 1));
        } else
            $this->ajaxReturn(array('data' => 0));
    }

    public function own(){

        $travels = M("car")->where(" gps_code != '' and is_del = 0")->field("car_num as jj_car_num,gps_code")->select();

        $baiDuApi = new BaiDuApiModel();

        foreach ($travels as &$val) {
            $res = $baiDuApi->search($val['gps_code']);
            if ($res['status'] == 0 && $res['total'] >= 1) {
                $val['entities']          = $res['entities'][0];
                $location                 = $val['entities']['latest_location']['latitude'] . ',' . $val['entities']['latest_location']['longitude'];
                $rs                       = $baiDuApi->geocoder($location);
                $val['formatted_address'] = $rs['status'] == 0 ? $rs['result']['formatted_address'] : '';
            }
        }
        unset($val);

        $this->assign("travels", json_encode($travels));
        $this->assign("trackDate", date("Y-m-d"));
        $this->display();
    }

    public function getOwnDrivers(){
        $currentPage = $_REQUEST['currentPage'] > 0 ? intval($_REQUEST['currentPage']) : 1;  //当前页
        $pageSize    = intval($_REQUEST['pageSize']);  //每页显示数量
        $searchKey   = trim($_REQUEST['searchKey']);   //搜索关键字

        $where['is_del']   = 0;
//        $where['state']    = array('between', '5,8');
        $where['gps_code'] = array('neq', '');

        if ($searchKey) {
            $where['car_num'] = array('like', '%' . $searchKey . '%');
        }

        $limit = ($currentPage - 1) * $pageSize . ',' . $pageSize;

        $count = M("Car")->where($where)->count();

        $totalPage = ceil($count / $pageSize); //总页数

        $travels = M("Car")->where($where)->limit($limit)->field('gps_code,car_num as jj_car_num')->order('id desc')->select();

        if ($travels) {
            $baiDuApi = new BaiDuApiModel();
            foreach ($travels as &$val) {
                $res = $baiDuApi->search($val['gps_code']);
                if ($res['status'] == 0 && $res['total'] >= 1) {
                    $val['entities']          = $res['entities'][0];
                    $location                 = $val['entities']['latest_location']['latitude'] . ',' . $val['entities']['latest_location']['longitude'];
                    $rs                       = $baiDuApi->geocoder($location, 0);
                    $val['formatted_address'] = $rs['status'] == 0 ? $rs['result']['formatted_address'] : '';

                }
            }
            unset($val);
        }
        $this->ajaxReturn(array('data' => $travels, 'count' => $count, 'totalPage' => $totalPage));
    }

    public function getTrackOwnDrivers()
    {
        $currentPage = $_REQUEST['currentPageTrack'] > 0 ? intval($_REQUEST['currentPageTrack']) : 1;  //当前页
        $pageSize    = intval($_REQUEST['pageSize']);  //每页显示数量
        $searchKey   = trim($_REQUEST['searchKey']);   //搜索关键字

        $date       = $_REQUEST['trackDate'] ? strtotime(trim($_REQUEST['trackDate'])) : time();
        $start_time = strtotime(date("Y-m-d 00:00:00", $date));
        $end_time   = strtotime(date("Y-m-d 22:59:59", $date));

        $where['is_del']   = 0;
//        $where['state']    = array('between', '5,8');
        $where['gps_code'] = array('neq', '');

        if ($searchKey) {
            $where['car_num'] = array('like', '%' . $searchKey . '%');
        }

        $limit = ($currentPage - 1) * $pageSize . ',' . $pageSize;

        $count = M("car")->where($where)->count();

        $totalPage = ceil($count / $pageSize); //总页数

        $travels = M("car")->where($where)->limit($limit)->field('gps_code,car_num')->order('id desc')->select();

        if ($travels) {
            foreach ($travels as &$val) {
                //获取里程
                $baiDuApi        = new BaiDuApiModel();
                $res             = $baiDuApi->getDistance($val['gps_code'], $start_time, $end_time);
                $val['distance'] = $res['status'] == 0 ? number_format($res['distance'] / 1000, 2) . 'km' : 0.00 . 'km';
            }
            unset($val);
        }
        $this->ajaxReturn(array('data' => $travels, 'count' => $count, 'totalPage' => $totalPage));
    }

}