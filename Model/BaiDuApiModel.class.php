<?php

namespace Model;

class BaiDuApiModel
{

    const GET_DISTANCE_URL = 'http://yingyan.baidu.com/api/v3/track/getdistance';
    const GET_TRACK_URL = 'http://yingyan.baidu.com/api/v3/track/gettrack';
    const GEOCODER_URL = 'http://api.map.baidu.com/geocoder/v2/';
    const SEARCH_URL = 'http://yingyan.baidu.com/api/v3/entity/search';
    protected $ak;
    protected $service_id;

    public function __construct()
    {
        $this->ak         = 'QYkSVUculppscE1QlM8T7GKpyCwZ0cF8';
        $this->service_id = '139490';
    }

    //地理编码 type = 1 地址转经纬度 else 经纬度转地址
    public function geocoder($param, $type = 0)
    {
        $data['ak'] = $this->ak;
        if ($type == 1) {
            $data['address'] = $param;
        } else {
            $data['location'] = $param;
        }
        $data['output']       = 'json';
        $data['latest_admin'] = 1;
        $res                  = httpF(self::GEOCODER_URL, $data);
        $res                  = json_decode($res, true);
        return $res;
    }

    //搜索当前所在位置
    public function search($query)
    {
        $data               = array();
        $data['ak']         = $this->ak;
        $data['service_id'] = $this->service_id;
        $data['query']      = $query;
        $res                = httpF(self::SEARCH_URL, $data);
        $res                = json_decode($res, true);
        return $res;
    }

    //获取时间段的里程
    public function getDistance($entity_name, $start_time, $end_time)
    {
        $data['ak']             = $this->ak;
        $data['service_id']     = $this->service_id;
        $data['entity_name']    = $entity_name;
        $data['start_time']     = $start_time;
        $data['end_time']       = $end_time;
        $data['is_processed']   = 1;        //开启纠偏
        $data['process_option'] = 'need_mapmatch=1,transport_mode=driving'; //绑路
        $res                    = httpF(self::GET_DISTANCE_URL, $data);
        $res                    = json_decode($res, true);
        return $res;
    }

    //获取时间段的轨迹
    public function getTrack($entity_name, $start_time, $end_time)
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
        }
        return $result;
    }

    protected function trackCurl($entity_name, $start_time, $end_time, $page_index = 1, $page_size = 5000)
    {
        $data['ak']             = $this->ak;
        $data['service_id']     = $this->service_id;
        $data['entity_name']    = $entity_name;
        $data['start_time']     = $start_time;
        $data['end_time']       = $end_time;
        $data['page_index']     = $page_index;
        $data['page_size']      = $page_size;
        $data['is_processed']   = 1;        //开启纠偏
        $data['process_option'] = 'need_mapmatch=1'; //绑路
        $res                    = httpF(self::GET_TRACK_URL, $data);
        $res                    = json_decode($res, true);
        return $res;
    }

    public function uploadTrack($entity_name,$startTime,$endTime)
    {
        $http = '192.168.1.110:8081/order/uploadTrack';

        $data['token']     = $this->service_id;
        $data['gps_pn']    = $entity_name;
        $data['startTime'] = $startTime;
        $data['endTime']   = $endTime;
        $res               = httpF($http,'' ,$data,"post");
        $res               = json_decode($res, true);
        return $res;
    }

}