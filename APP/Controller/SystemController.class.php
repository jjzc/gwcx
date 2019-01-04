<?php
namespace APP\Controller;
use Model\AppVersionModel;
use Model\UserModel;
use Think\Controller;

use Model\CarModel;
use Model\CompanyModel;
use Model\DriverModel;
use Model\SetModel;
use Model\TravelModel;
use Model\SmsTemplateModel;
use Org\Sms\SmsBao;

class SystemController extends Controller {
		
	 //发送短信给用户，提示派车成功(使用自有车辆)
    public function sendSendCarOkUser($phone,$travel){

        $sms_template_mdel=new SmsTemplateModel();
        $sms_con=$sms_template_mdel->find(2);

        $driverM=new DriverModel();
        $driver=$driverM->find($travel["driver_id"]);

        $carM=new CarModel();
        $car=$carM->find($travel["car_id"]);


        //替换内容
        $table_change = array('{creat_time}'=>date('Y-m-d H:i:s', $travel["sign_time"]));
        $table_change += array('{start_time}' => date('Y-m-d H:i:s', $travel["departure_time"]));
        $table_change += array('{from_place}' => $travel["from_place"]);
        $table_change += array('{to_place}' => $travel["to_place"]);
        $table_change += array('{drivers}' => $driver["driver_name"]);
        $table_change += array('{driver_phone}' => $driver["driver_phone"]);  //司机手机号
        $table_change += array('{cars}' => $car["car_num"]);

        $content=strtr($sms_con["sms_content"],$table_change);

        $setM=new SetModel();
        $set=$setM->find(1);
        $sms=new SmsBao($set["sms_account"],$set["sms_pwd"]);

        $str=$sms->sendSms($phone, $content);


        if($str['status'] == 0){//status=0表示发送成功
            return true;
        }else{//发送失败
            return false;
        }
    }

    //发送短信给司机，提示派车成功(使用自有车辆)
    public function sendSendCarOkDriver($phone,$travel){


        $sms_template_mdel=new SmsTemplateModel();
        $sms_con=$sms_template_mdel->find(3);

        $userM=new UserModel();
        $user=$userM->find($travel["use_user_id"]);

        $companyM=new CompanyModel();
        $company=$companyM->find($user["user_company"]);


        //替换内容
        $table_change = array('{start_time}' => date('Y-m-d H:i:s', $travel["departure_time"]));
        $table_change += array('{from_place}' => $travel["from_place"]);
        $table_change += array('{to_place}' => $travel["to_place"]);
        $table_change += array('{user_name}' => $user["user_name"]);
        $table_change += array('{user_company}' => $company["company_name"]);
        $table_change += array('{phone}' => $user["user_phone"]);

        $content=strtr($sms_con["sms_content"],$table_change);

        $setM=new SetModel();
        $set=$setM->find(1);
        $sms=new SmsBao($set["sms_account"],$set["sms_pwd"]);

        $str=$sms->sendSms($phone, $content);


        if($str['status'] == 0){//status=0表示发送成功
            return true;
        }else{//发送失败
            return false;
        }
    }


    public function getLastVersion(){
       if(empty($_REQUEST)){
           return;
       }else{
           $appVersionM=new AppVersionModel();
           $appVersion=$appVersionM->where(array("type"=>$_REQUEST["appType"]))->order("id desc")->first();
           $this->ajaxReturn($appVersion);
       }
    }

    public function getSet(){
        $set=M("set")->find(1);
        $this->ajaxReturn($set);
    }

}