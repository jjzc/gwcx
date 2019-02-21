<?php
/**
 * Created by PhpStorm.
 * User: MrQ
 * Date: 2018/5/2
 * Time: 18:57
 */

namespace Admin\Controller;

use Model\TravelModel;

class IndexController extends CommonController
{
    public function index()
    {
        $userId = session("user_id");
        $user   = M("AdminUser")->find($userId);
        $this->assign("user", $user);

        $group_id = session("group_id");
        $group    = M("AdminGroup")->find($group_id);
        $this->assign("group", $group);
        $this->display();
    }

    public function speech()
    {
        require_once 'speech/AipSpeech.php';

        $appId     = "1558992317";
        $appKey    = "N8mAGAd5hmsciyrzQoHVaRmG";
        $secretKey = "3e2mmzWGCR3lWcoAHforcmuGwzGMX2b0 ";

        $client = new \AipSpeech($appId, $appKey, $secretKey);

        $result = $client->synthesis('您有新的事务需要处理', 'zh', 1, array('vol' => 5,'per'=>1));

        if (!is_array($result)) {
            file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/audio.mp3', $result);
        }

    }


    public function notice()
    {

        $field = " count(if(state=1,1,null)) as num1 , count(if(state=3,1,null)) as num2 , count(if(state=6,1,null)) as num3 , count(if(state=8,1,null)) as num4 , count(if(is_need_settlement=1 and is_settlemented=0 and state=9,1,null)) as num5 , count(if(state=10,1,null)) as num6 ";

        $count = M("travel")->where("is_del=0")->field($field)->find();

        $total = array_sum($count);

        if ($total > 0) {
            if(!file_exists($_SERVER['DOCUMENT_ROOT'] . '/audio.mp3')){
                $this->speech();
            }
            $this->ajaxReturn(array("code" => 1, "count" => $count));
        } else
            $this->ajaxReturn(array("code" => 0));

    }

}