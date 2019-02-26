<?php
/**
 * Created by PhpStorm.
 * User: MrQ
 * Date: 2018/5/31
 * Time: 13:12
 */

namespace Home\Controller;


class IndexController extends CommonController
{
    public function index(){
        $user_id=session("user_id");
        $user_company=session("user_company");
        $user_phone=session("user_phone");
        $company_name=session("company_name");

        //查询自己是不是单位管理员
        $isManager=0;
        $company=M("Company")->find($user_company);
        if($user_id==$company["company_manager_id"]){
            $isManager=1;
        }
        $this->assign("isManager",$isManager);
        $this->assign("user_phone",$user_phone);
        $this->assign("company_name",$company_name);

        //获取我的未读消息数量
        $wdNum=M("Message")->where(array("to_user_id"=>$user_id,"is_read"=>0))->order("creat_time desc")->count();
        $this->assign("wdNum",$wdNum);
        $this->display();
    }

    public function notice()
    {

        $map["is_del"]=0;
        $map["company_id"]=session("user_company");
        $map["state"]=0;

        $count=M("travel")->where($map)->count();

        if ($count > 0) {
            if(!file_exists($_SERVER['DOCUMENT_ROOT'] . '/Public/mp3/audio_user.mp3')){
                $this->speech();
            }
            $this->ajaxReturn(array("code" => 1, "count" => $count));
        } else
            $this->ajaxReturn(array("code" => 0));

    }

    public function speech()
    {
        require_once $_SERVER['DOCUMENT_ROOT'] .'/Admin/Controller/speech/AipSpeech.php';

        $appId     = "1558992317";
        $appKey    = "N8mAGAd5hmsciyrzQoHVaRmG";
        $secretKey = "3e2mmzWGCR3lWcoAHforcmuGwzGMX2b0 ";

        $client = new \AipSpeech($appId, $appKey, $secretKey);

        $result = $client->synthesis('您有新的出行需要审核', 'zh', 1, array('vol' => 5));

        $path = $_SERVER['DOCUMENT_ROOT'] . "/Public/mp3";
        if(!is_dir($path)){
            mkdir($path,777);
        }

        if (!is_array($result)) {
            file_put_contents($path . '/audio_user.mp3', $result);
        }

    }
}
