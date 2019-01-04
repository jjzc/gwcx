<?php
namespace Admin\Controller;
use Model\CarModel;
use Model\CompanyModel;
use Model\DriverModel;
use Model\SetModel;
use Model\TravelModel;
use Model\UserModel;
use Think\Controller;
use Model\SmsTemplateModel;
use Org\Sms\SmsBao;
/**
 * @author MrQ
 * 系统控制器，负责系统操作方法
 **/

class SystemController extends Controller {

    protected function getSet(){
        $set=M("Set")->find(1);
        if($set["is_open_sms"]==1){
            return true;
        }else{
            return false;
        }
    }
    
    
    //发送短信给用户，提示派车成功(使用自有车辆)
    public function sendSendCarOkUser($phone,$travel){
        $aa=$this->getSet();
        //如果关闭了短信，直接返回true
        if(!$aa){
            return true;
        }

        $sms_template_mdel=new SmsTemplateModel();
        $sms_con=$sms_template_mdel->find(2);

        $driverM=new DriverModel();
        $driver=$driverM->find($travel["driver_id"]);


        //替换内容
        $table_change = array('{creat_time}'=>date('Y-m-d H:i:s', $travel["sign_time"]));
        $table_change += array('{start_time}' => date('Y-m-d H:i:s', $travel["departure_time"]));
        $table_change += array('{from_place}' => $travel["from_place"]);
        $table_change += array('{to_place}' => $travel["to_place"]);
        $table_change += array('{drivers}' => $travel["drivers"]);
        $table_change += array('{driver_phone}' => $travel["driver_phone"]);  //司机手机号driver_phone
        $table_change += array('{cars}' => $travel["cars"]);

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
        $aa=$this->getSet();
        //如果关闭了短信，直接返回true
        if(!$aa){
            return true;
        }


        $sms_template_mdel=new SmsTemplateModel();
        $sms_con=$sms_template_mdel->find(3);

        $userM=new UserModel();
        $user=$userM->find($travel["use_user_id"]);

        $companyM=new CompanyModel();
        $company=$companyM->find($user["user_company"]);

        $carM=new CarModel();
        $car=$carM->find($travel["car_id"]);


        //替换内容
        $table_change = array('{start_time}' => date('Y-m-d H:i:s', $travel["departure_time"]));
        $table_change += array('{from_place}' => $travel["from_place"]);
        $table_change += array('{to_place}' => $travel["to_place"]);
        $table_change += array('{user_name}' => $user["user_name"]);
        $table_change += array('{user_company}' => $company["company_name"]);
        $table_change += array('{phone}' => $user["user_phone"]);
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


    //改派通知用户，只改车辆的情况下
    public function reassignmentCarUser($phone,$travel)
    {
        $aa=$this->getSet();
        //如果关闭了短信，直接返回true
        if(!$aa){
            return true;
        }
        $sms_template_mdel=new SmsTemplateModel();
        $sms_con=$sms_template_mdel->find(4);

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
        $table_change += array('{driver_phone}' => $driver["driver_phone"]);  //司机手机号driver_phone
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

    public function reassignmentCarDriver($phone,$travel)
    {
        $aa=$this->getSet();
        //如果关闭了短信，直接返回true
        if(!$aa){
            return true;
        }
        $sms_template_mdel=new SmsTemplateModel();
        $sms_con=$sms_template_mdel->find(5);

        $userM=new UserModel();
        $user=$userM->find($travel["use_user_id"]);

        $companyM=new CompanyModel();
        $company=$companyM->find($user["user_company"]);

        $carM=new CarModel();
        $car=$carM->find($travel["car_id"]);


        //替换内容
        $table_change = array('{start_time}' => date('Y-m-d H:i:s', $travel["departure_time"]));
        $table_change += array('{from_place}' => $travel["from_place"]);
        $table_change += array('{to_place}' => $travel["to_place"]);
        $table_change += array('{user_name}' => $user["user_name"]);
        $table_change += array('{user_company}' => $company["company_name"]);
        $table_change += array('{phone}' => $user["user_phone"]);
        $table_change += array('{cars}' => $user["car_num"]);

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

    //改派司机与车辆的情况下，发送短信给用户，说订单派车信息发生了改变
    public function reassignmentDriverUser($phone,$travel)
    {
        $aa=$this->getSet();
        //如果关闭了短信，直接返回true
        if(!$aa){
            return true;
        }
        $sms_template_mdel=new SmsTemplateModel();
        $sms_con=$sms_template_mdel->find(6);

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
        $table_change += array('{driver_phone}' => $driver["driver_phone"]);  //司机手机号driver_phone
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


    /*
     * 当出行取消时，提醒司机出行任务已经取消了
     */
    public function sendCancelDriver($travel){


        $aa=$this->getSet();
        //如果关闭了短信，直接返回true
        if(!$aa){
            return true;
        }




        $sms_template_mdel=new SmsTemplateModel();
        $sms_con=$sms_template_mdel->find(8);

        $userM=new UserModel();
        $user=$userM->find($travel["use_user_id"]);

        $companyM=new CompanyModel();
        $company=$companyM->find($user["user_company"]);

        $carM=new CarModel();
        $car=$carM->find($travel["car_id"]);

        $driver=M("Driver")->find($travel["driver_id"]);

        //替换内容
        $table_change = array('{start_time}' => date('Y-m-d H:i:s', $travel["departure_time"]));
        $table_change += array('{from_place}' => $travel["from_place"]);
        $table_change += array('{to_place}' => $travel["to_place"]);
        $table_change += array('{user_name}' => $user["user_name"]);
        $table_change += array('{user_company}' => $company["company_name"]);
        $table_change += array('{phone}' => $user["user_phone"]);
        $table_change += array('{cars}' => $user["car_num"]);

        $content=strtr($sms_con["sms_content"],$table_change);

        $setM=new SetModel();
        $set=$setM->find(1);
        $sms=new SmsBao($set["sms_account"],$set["sms_pwd"]);

        $str=$sms->sendSms($driver["driver_phone"], $content);


        if($str['status'] == 0){//status=0表示发送成功
            return true;
        }else{//发送失败
            return false;
        }

    }


    public function sendCancelUser($travel){


        $aa=$this->getSet();
        //如果关闭了短信，直接返回true
        if(!$aa){
            return true;
        }




        $sms_template_mdel=new SmsTemplateModel();
        $sms_con=$sms_template_mdel->find(8);

        $userM=new UserModel();
        $user=$userM->find($travel["use_user_id"]);

        $companyM=new CompanyModel();
        $company=$companyM->find($user["user_company"]);

        $carM=new CarModel();
        $car=$carM->find($travel["car_id"]);

        $driver=M("Driver")->find($travel["driver_id"]);

        //替换内容
        $table_change = array('{start_time}' => date('Y-m-d H:i:s', $travel["departure_time"]));
        $table_change += array('{from_place}' => $travel["from_place"]);
        $table_change += array('{to_place}' => $travel["to_place"]);
        $table_change += array('{user_name}' => $user["user_name"]);
        $table_change += array('{user_company}' => $company["company_name"]);
        $table_change += array('{phone}' => $user["user_phone"]);
        $table_change += array('{cars}' => $user["car_num"]);

        $content=strtr($sms_con["sms_content"],$table_change);

        $setM=new SetModel();
        $set=$setM->find(1);
        $sms=new SmsBao($set["sms_account"],$set["sms_pwd"]);

        $str=$sms->sendSms($user["user_phone"], $content);


        if($str['status'] == 0){//status=0表示发送成功
            return true;
        }else{//发送失败
            return false;
        }

    }


    //改派司机与车辆的情况下，发送短信给原先的司机，说  订单取消了
    public function reassignmentDriverOld($phone,$travel)
    {
        $aa=$this->getSet();
        //如果关闭了短信，直接返回true
        if(!$aa){
            return true;
        }
        $sms_template_mdel=new SmsTemplateModel();
        $sms_con=$sms_template_mdel->find(7);

        $userM=new UserModel();
        $user=$userM->find($travel["use_user_id"]);

        $companyM=new CompanyModel();
        $company=$companyM->find($user["user_company"]);

        $carM=new CarModel();
        $car=$carM->find($travel["car_id"]);


        //替换内容
        $table_change = array('{start_time}' => date('Y-m-d H:i:s', $travel["departure_time"]));
        $table_change += array('{from_place}' => $travel["from_place"]);
        $table_change += array('{to_place}' => $travel["to_place"]);
        $table_change += array('{user_name}' => $user["user_name"]);
        $table_change += array('{user_company}' => $company["company_name"]);
        $table_change += array('{phone}' => $user["user_phone"]);
        $table_change += array('{cars}' => $user["car_num"]);

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
    
    public function getNum(){
        $travelM=new TravelModel();
        $waitTravelCount=$travelM->where("state=1 and is_need_center_review=1 and is_del=0")->count();
        $data["waitTravelCount"]=$waitTravelCount;

        //获取待派车出行总数
        $waitSendCar=$travelM->where(
            array(array("is_need_audit"=>1,"audit_res"=>1,"state"=>3,"is_arrange_car"=>1,"is_del"=>0),array("is_need_audit"=>0,"state"=>3,"is_arrange_car"=>1,"is_del"=>0),'_logic'=>'or')
        )->count();

        //$waitSendCar=$travelM->where("state=3 and is_arrange_car=1")->count();
        $data["waitSendCar"]=$waitSendCar;

        $waitStart=$travelM->where("state=5 and is_arrange_car=1 and is_del=0")->count();
        $data["waitStart"]=$waitStart;

        $waitEnd=$travelM->where("state=6  and is_del=0")->count();
        $data["waitEnd"]=$waitEnd;

        $waitCancel=$travelM->where("state=8 and is_del=0")->count();
        $data["waitCancel"]=$waitCancel;

        $this->ajaxReturn($data);
    }

    public function getUser(){
        $keyWorlds=$_POST["userName"];



        //$map['name'] = array('like','%张%');
        $where['user_name|user_phone']=array('like','%'.$keyWorlds.'%');
        //$where['user_phone']=array('like','%'.$keyWorlds.'%');

        $userM=new UserModel();
        $users=$userM->where($where)->select();

        $res=array();

        for($i=0;$i<count($users)&&count($users)!=0;$i++){
            $res[$i]=array("userName"=>$users[$i]["user_name"]);
        }

        //dump($res);

        //echo $keyWorlds;
        $this->ajaxReturn($res);

    }


    public function getCompany(){
        $keyWorlds=$_POST["company_name"];



        $where['company_name']=array('like','%'.$keyWorlds.'%');

        $companyM=new CompanyModel();
        $companys=$companyM->where($where)->select();

        $res=array();

        for($i=0;$i<count($companys)&&count($companys)!=0;$i++){
            $res[$i]=array("companyName"=>$companys[$i]["company_name"]);
        }

        $this->ajaxReturn($res);

    }

    public function getDriver(){
        $keyWorlds=$_POST["userName"];

        $where['driver_name|driver_phone']=array('like','%'.$keyWorlds.'%');

        $driverM=new DriverModel();
        //$userM=new UserModel();
        $drivers=$driverM->where($where)->select();

        $res=array();

        for($i=0;$i<count($drivers)&&count($drivers)!=0;$i++){
            $res[$i]=array("driverName"=>$drivers[$i]["driver_name"]."--".$drivers[$i]["driver_phone"]);
        }

        //dump($res);

        //echo $keyWorlds;
        $this->ajaxReturn($res);
    }

    public function getCar(){
        $keyWorlds=$_POST["carName"];

        $where['car_num|car_name']=array('like','%'.$keyWorlds.'%');

        //$driverM=new DriverModel();
        $carM=new CarModel();
        //$userM=new UserModel();
        $cars=$carM->where($where)->select();

        $res=array();

        for($i=0;$i<count($cars)&&count($cars)!=0;$i++){
            $res[$i]=array("carName"=>$cars[$i]["car_num"]."--".$cars[$i]["car_name"]);
        }

        //dump($res);

        //echo $keyWorlds;
        $this->ajaxReturn($res);
    }
}