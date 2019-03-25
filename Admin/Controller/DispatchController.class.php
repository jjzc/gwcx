<?php
/**
 * Created by PhpStorm.
 * User: MrQ
 * Date: 2018/5/2
 * Time: 18:57
 */

namespace Admin\Controller;

use Model\TravelModel;

class DispatchController extends CommonController
{
    public function index()
    {
        $travels = M("travel")->where(" state BETWEEN '5' AND '8' AND gps_code != '' AND is_del = 0 ")->field('gps_code,serial_number,from_place,to_place,jj_driver_name,jj_driver_phone,jj_car_num')->select();  //服务中（并且能够找到gps_code）的订单
        foreach ($travels as &$val) {
            $url                = 'http://yingyan.baidu.com/api/v3/entity/search';
            $data               = array();
            $data['ak']         = 'QYkSVUculppscE1QlM8T7GKpyCwZ0cF8';
            $data['service_id'] = '139490';
            $data['query']      = $val['gps_code'];
            $res                = httpF($url, $data);
            $res                = json_decode($res, true);

            if ($res['status'] == 0 && $res['total'] >= 1) {
                $val['entities']      = $res['entities'][0];
                $data                 = array();
                $data['location']     = $val['entities']['latest_location']['latitude'] . ',' . $val['entities']['latest_location']['longitude'];
                $data['ak']           = 'QYkSVUculppscE1QlM8T7GKpyCwZ0cF8';
                $data['output']       = 'json';
                $data['latest_admin'] = 1;
                $rs                   = httpF('http://api.map.baidu.com/geocoder/v2/', $data);
                $rs                   = json_decode($rs, true);
//                if ($rs['status'] == 0) {
//                    $val['formatted_address'] = $rs['result']['formatted_address'];
//                }
                $val['formatted_address'] = $rs['status'] == 0 ? $rs['result']['formatted_address'] : '';
            }
        }
        unset($val);
        $this->assign("travels", json_encode($travels));
        $this->assign("trackDate", date("Y-m-d"));
        $this->display();
    }

    //实时监控司机数据
    public function getDrivers_bak1()
    {
        $currentPage = $_REQUEST['currentPage'] > 0 ? intval($_REQUEST['currentPage']) : 1;  //当前页
        $pageSize    = intval($_REQUEST['pageSize']);  //每页显示数量
        $searchKey   = trim($_REQUEST['searchKey']);   //搜索关键字
        $status = intval($_REQUEST['status']);   //司机gps状态   在线 ： 1   离线  ： -1
        $status = 1;

        $where['is_del']   = 0;
        $where['state']    = array('between', '5,8');
        $where['gps_code'] = array('neq', '');

        if ($searchKey) {
            $where['serial_number|jj_car_num|jj_driver_name'] = array('like', '%' . $searchKey . '%');
        }

        $limit = ($currentPage - 1) * $pageSize . ',' . $pageSize;

        $count = M("travel")->where($where)->field('gps_code,serial_number,from_place,to_place,jj_driver_name,jj_driver_phone,jj_car_num')->count();

        $totalPage = ceil($count / $pageSize); //总页数

        $travels = M("travel")->where($where)->limit($limit)->field('gps_code,serial_number,from_place,to_place,jj_driver_name,jj_driver_phone,jj_car_num')->select();  //服务中（并且能够找到gps_code）的订单

        if ($travels) {
            foreach ($travels as &$val) {
                $active_time = strtotime(" -20 minute ");
                $filter = $status == 1 ? 'active_time' : 'inactive_time';
                $url                = 'http://yingyan.baidu.com/api/v3/entity/search';
                $data               = array();
                $data['ak']         = 'QYkSVUculppscE1QlM8T7GKpyCwZ0cF8';
                $data['service_id'] = '139490';
                $data['query']      = $val['gps_code'];
                $data['filter'] = $filter.':'.$active_time;
                $res                = httpF($url, $data);
                $res                = json_decode($res, true);

                dump($res);
                if ($res['status'] == 0 && $res['total'] >= 1) {
                    $val['entities']      = $res['entities'][0];
                    $data                 = array();
                    $data['location']     = $val['entities']['latest_location']['latitude'] . ',' . $val['entities']['latest_location']['longitude'];
                    $data['ak']           = 'QYkSVUculppscE1QlM8T7GKpyCwZ0cF8';
                    $data['output']       = 'json';
                    $data['latest_admin'] = 1;
                    $rs                   = httpF('http://api.map.baidu.com/geocoder/v2/', $data);
                    $rs                   = json_decode($rs, true);
//                    if ($rs['status'] == 0) {
//                        $val['formatted_address'] = $rs['result']['formatted_address'];
//                    }
                    $val['formatted_address'] = $rs['status'] == 0 ? $rs['result']['formatted_address'] : '';
                }
            }
            unset($val);
        }
//        dump($travels);
//        exit;
        $this->ajaxReturn(array('data' => $travels, 'count' => $count, 'totalPage' => $totalPage));
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
            foreach ($travels as &$val) {
                $url                = 'http://yingyan.baidu.com/api/v3/entity/search';
                $data               = array();
                $data['ak']         = 'QYkSVUculppscE1QlM8T7GKpyCwZ0cF8';
                $data['service_id'] = '139490';
                $data['query']      = $val['gps_code'];
                $res                = httpF($url, $data);
                $res                = json_decode($res, true);

                if ($res['status'] == 0 && $res['total'] >= 1) {
                    $val['entities']      = $res['entities'][0];
                    $data                 = array();
                    $data['location']     = $val['entities']['latest_location']['latitude'] . ',' . $val['entities']['latest_location']['longitude'];
                    $data['ak']           = 'QYkSVUculppscE1QlM8T7GKpyCwZ0cF8';
                    $data['output']       = 'json';
                    $data['latest_admin'] = 1;
                    $rs                   = httpF('http://api.map.baidu.com/geocoder/v2/', $data);
                    $rs                   = json_decode($rs, true);
//                    if ($rs['status'] == 0) {
//                        $val['formatted_address'] = $rs['result']['formatted_address'];
//                    }
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
                $res = $this->distanceCurl($val['gps_code'], $start_time, $end_time);
                $val['distance'] = $res['status'] == 0 ? number_format($res['distance']/1000,2).'km' : 0.00.'km';
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
        $data       = $this->getPoint($gps_code, $start_time, $end_time);
        $this->ajaxReturn(array('data'=>$data));
    }

    protected function getPoint($entity_name, $start_time, $end_time)
    {
        $result = array();
        if ($start_time && $end_time && $end_time > $start_time) {
            $interval  = 3600 * 12;          //每一次查询的时间区间  时间区间最多24小时,缩短每次请求的时间区间能够提升响应速度
            $page_size = 1000;               //每页的轨迹点 （1-5000）
            $count     = intval(ceil(($end_time - $start_time) / $interval));   //分割的区间数量
            for ($i = 1; $i <= $count; $i++) {
                $time1 = $start_time + ($i - 1) * $interval;
                $time2 = $i < $count ? ($start_time + $i * $interval) : $end_time;
                $res   = $this->trackCurl($entity_name, $time1, $time2, 1, $page_size);
                if ($res['status'] != 0) {
                    continue;
                }

                $result = array_merge($result, $res['points']);
                $total  = $res['total'];     //轨迹点总数量

                if ($total > $page_size) {  //如果轨迹点总数量大于每一页的数量，需要再次获取其他页面的轨迹点
                    $totalPage = intval(ceil($total / $page_size));     //计算总的页面数
                    for ($i = 2; $i <= $totalPage; $i++) {
                        $res = $this->trackCurl($entity_name, $time1, $time2, $i, $page_size);
                        if ($res['status'] == 0) {
                            $result = array_merge($result, $res['points']); //合并第二页以及后面页面的轨迹点
                        }
                    }
                }
            }
            return $result;
        }


    }

    //获取时间段的轨迹点
    protected function trackCurl($entity_name, $start_time, $end_time, $page_index = 1, $page_size = 5000)
    {
        $url                    = 'http://yingyan.baidu.com/api/v3/track/gettrack';
        $data['ak']             = 'QYkSVUculppscE1QlM8T7GKpyCwZ0cF8';
        $data['service_id']     = '139490';
        $data['entity_name']    = $entity_name;
        $data['start_time']     = $start_time;
        $data['end_time']       = $end_time;
        $data['page_index']     = $page_index;
        $data['page_size']      = $page_size;
        $data['is_processed']   = 1;        //开启纠偏
        $data['process_option'] = 'need_mapmatch=1'; //绑路
        $res                    = httpF($url, $data);
        $res                    = json_decode($res, true);
        return $res;
    }

    //获取时间段的里程
    protected function distanceCurl ($entity_name, $start_time, $end_time){
        $url                    = 'http://yingyan.baidu.com/api/v3/track/getdistance';
        $data['ak']             = 'QYkSVUculppscE1QlM8T7GKpyCwZ0cF8';
        $data['service_id']     = '139490';
        $data['entity_name']    = $entity_name;
        $data['start_time']     = $start_time;
        $data['end_time']       = $end_time;
        $data['is_processed']   = 1;        //开启纠偏
        $data['process_option'] = 'need_mapmatch=1,transport_mode=driving'; //绑路
        $res                    = httpF($url, $data);
        $res                    = json_decode($res, true);
        return $res;
    }

}