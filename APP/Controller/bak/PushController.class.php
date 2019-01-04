<?php
namespace APP\Controller;
use Think\Controller;

class PushController extends Controller {

    //绑定个推CID
    public function bandCID(){
        Vendor('Push.IGt#Push');


        //绑定个推
        if($_POST["type"]=="driver"){
            define('APPKEY',DAPPKEY);
            define('APPID',DAPPID);
            define('MASTERSECRET',DMASTERSECRET);
        }else{
            define('APPKEY',UAPPKEY);
            define('APPID',UAPPID);
            define('MASTERSECRET',UMASTERSECRET);
        }

        define('CID',$_POST["cid"]);
        define('ALIAS',$_POST["userId"]);
        define('HOST','http://sdk.open.api.igexin.com/apiex.htm');

        $igt = new \IGeTui(HOST,APPKEY,MASTERSECRET);
        $rep = $igt->bindAlias(APPID,ALIAS,CID);

        $this->ajaxReturn($rep);

    }

    public function test(){
        Vendor('Push.IGt#Push');

        define('APPKEY','akktdMnuKv611pn6MbZ1o9');
        define('APPID','t7JSS9i31s5c5tQzOyHiw2');
        define('MASTERSECRET','VzdhNAErr57jpMab1sKE3A');


        define('HOST','http://sdk.open.api.igexin.com/apiex.htm');
        //define('CID','30d3180c791209070d105e16a69ec7de');
        //别名推送方式
        define('Alias','u1');

        $igt = new \IGeTui(HOST,APPKEY,MASTERSECRET);

        //消息模版：
        $template =  new \IGtTransmissionTemplate();
        $template->set_appId(APPID);
        //应用appkey
        $template->set_appkey(APPKEY);
        //透传消息类型
        $template->set_transmissionType(1);
        //透传内容
        $template->set_transmissionContent('111');


        //定义"SingleMessage"
        $message = new \IGtSingleMessage();

        $message->set_isOffline(true);//是否离线
        $message->set_offlineExpireTime(3600*12*1000);//离线时间
        $message->set_data($template);//设置推送消息类型
        //$message->set_PushNetWorkType(0);//设置是否根据WIFI推送消息，2为4G/3G/2G，1为wifi推送，0为不限制推送
        //接收方
        $target = new \IGtTarget();
        $target->set_appId(APPID);
        //$target->set_clientId(CID);
        $target->set_alias(Alias);

        try {
            $rep = $igt->pushMessageToSingle($message, $target);
            var_dump($rep);
            echo ("<br><br>");

        }catch(RequestException $e){
            $requstId =e.getRequestId();
            //失败时重发
            $rep = $igt->pushMessageToSingle($message, $target,$requstId);
            var_dump($rep);
            echo ("<br><br>");
        }
    }


    public function sendMessage($type,$Id,$content,$title){



        Vendor('Push.IGt#Push');

        if($type=="driver"){
            define('APPKEY',DAPPKEY);
            define('APPID',DAPPID);
            define('MASTERSECRET',DMASTERSECRET);
            define('Alias',$Id);
        }else{
            define('APPKEY',UAPPKEY);
            define('APPID',UAPPID);
            define('MASTERSECRET',UMASTERSECRET);
            define('Alias','u'.$Id);
        }



        define('HOST','http://sdk.open.api.igexin.com/apiex.htm');
        //define('CID','30d3180c791209070d105e16a69ec7de');
        //别名推送方式


        $igt = new \IGeTui(HOST,APPKEY,MASTERSECRET);

        //消息模版：
        $template =  new \IGtNotificationTemplate();
        $template->set_appId(APPID);                      //应用appid
        $template->set_appkey(APPKEY);                    //应用appkey
        $template->set_transmissionType(1);               //透传消息类型
        //$template->set_transmissionContent("测试离线");   //透传内容
        $template->set_title($title);                     //通知栏标题
        $template->set_text($content);        //通知栏内容
        $template->set_logo("logo.png");                  //通知栏logo
        $template->set_logoURL("http://wwww.igetui.com/logo.png"); //通知栏logo链接
        $template->set_isRing(true);                      //是否响铃
        $template->set_isVibrate(true);                   //是否震动
        $template->set_isClearable(true);                 //通知栏是否可清除

        //定义"SingleMessage"
        $message = new \IGtSingleMessage();

        $message->set_isOffline(true);//是否离线
        $message->set_offlineExpireTime(3600*12*1000*1000);//离线时间
        $message->set_data($template);//设置推送消息类型
        $message->set_PushNetWorkType(0);//设置是否根据WIFI推送消息，2为4G/3G/2G，1为wifi推送，0为不限制推送
        //接收方
        $target = new \IGtTarget();
        $target->set_appId(APPID);
        //$target->set_clientId(CID);
        $target->set_alias(Alias);


        //$rep = $igt->pushMessageToSingle($message, $target);
        try {
            $rep = $igt->pushMessageToSingle($message, $target);
            //var_dump($rep);
            //echo ("<br><br>");

        }catch(RequestException $e){
            $requstId =$e.getRequestId();
//            //失败时重发
            $rep = $igt->pushMessageToSingle($message, $target,$requstId);
//            var_dump($rep);
//            echo ("<br><br>");
        }
    }

    public function IGtNotyPopLoadTemplateDemo(){
        Vendor('Push.IGt#Push');

        $template =  new \IGtNotyPopLoadTemplate();
        $template ->set_appId(APPID);                      //应用appid
        $template ->set_appkey(APPKEY);                    //应用appkey
        //通知栏
        $template ->set_notyTitle("个推");                 //通知栏标题
        $template ->set_notyContent("个推最新版点击下载"); //通知栏内容
        $template ->set_notyIcon("");                      //通知栏logo
        $template ->set_isBelled(true);                    //是否响铃
        $template ->set_isVibrationed(true);               //是否震动
        $template ->set_isCleared(true);                   //通知栏是否可清除
        //弹框
        $template ->set_popTitle("弹框标题");              //弹框标题
        $template ->set_popContent("弹框内容");            //弹框内容
        $template ->set_popImage("");                      //弹框图片
        $template ->set_popButton1("下载");                //左键
        $template ->set_popButton2("取消");                //右键
        //下载
        $template ->set_loadIcon("");                      //弹框图片
        $template ->set_loadTitle("地震速报下载");
        $template ->set_loadUrl("http://dizhensubao.igexin.com/dl/com.ceic.apk");
        $template ->set_isAutoInstall(false);
        $template ->set_isActived(true);

        //设置通知定时展示时间，结束时间与开始时间相差需大于6分钟，消息推送后，客户端将在指定时间差内展示消息（误差6分钟）
        $begin = "2017-08-25 00:00:00";
        $end = "2017-08-25 15:31:24";
        $template->set_duration($begin,$end);
        return $template;
    }




}