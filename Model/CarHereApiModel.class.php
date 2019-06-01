<?php

namespace Model;

/**
 * 车在这儿app接口
 * Class CarHereApiModel
 * @package Model
 */
class CarHereApiModel
{

    const GET_TRACK_URL = 'http://api.carhere.net/Ch_manage_controller/track/findOld'; //轨迹查询接口
    const LAST_LOCATION = 'http://api.carhere.net/Ch_manage_controller/location/find'; //实时位置查询

    //搜索当前所在位置
    public function search($query)
    {
        $res = httpF(self::LAST_LOCATION, "", json_encode(array($query)), "POST");
        $res = json_decode($res, true);
        return $res;
    }


    //获取时间段的轨迹
    public function getTrack($entity_name, $start_time, $end_time)
    {
        $result = array();
        if ($start_time && $end_time && $end_time > $start_time) {
            $page_size = 500;               //每页的轨迹点 （1-5000）
            $res       = $this->trackCurl($entity_name, $start_time, $end_time, 1, $page_size);
            $result    = array_merge($result, $res['content']);
            $totalPage = $res['totalPages'];     //轨迹点总页数
            if ($totalPage > 1) {  //如果不止一页
                for ($i = 2; $i <= $totalPage; $i++) { //合并第一页后面的数据
                    $res = $this->trackCurl($entity_name, $start_time, $end_time, $i, $page_size);
                    if (!empty($res['content'])) {
                        $result = array_merge($result, $res['content']); //合并第二页以及后面页面的轨迹点
                    }
                }
            }
        }
        return $result;
    }

    protected function trackCurl($entity_name, $start_time, $end_time, $page_index = 1, $page_size = 200)
    {
        $data['terminalID']   = $entity_name;
        $data['beginTime']    = $start_time * 1000;
        $data['endTime']      = $end_time * 1000;
        $data['pageNum']      = $page_size;
        $data['pageSize']     = $page_index;
        $data['locationType'] = "Bds";        //开启纠偏
        $res = httpF(self::GET_TRACK_URL, '', json_encode($data), "POST");
        $res = json_decode($res, true);
        return $res;
    }

}