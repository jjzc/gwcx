<?php
/**
 * Created by PhpStorm.
 * User: MrQ
 * Date: 2018/5/28
 * Time: 14:07
 */

namespace Admin\Controller;
use Model\CarTypeModel;
use Model\PayTypeModel;
use Model\SetModel;
use Model\TravelNatureModel;
use Model\TravelTempModel;
use PHPExcel;
use Think\Controller;
use Model\TravelModel;
use Model\TravelTypeModel;
use Model\CarModel;
use Model\DriverModel;
use Model\ArrangeTypeModel;
use Model\UserModel;
use Model\CompanyModel;
use Think\Upload;
use Model\CostWashModel;
use Model\CostRepairModel;
use Model\CostOilModel;
use Model\CostInsuranceModel;
use Model\LshModel;
use Model\RepairShopModel;
use Model\OilShopModel;
use Model\RepairTypeModel;
use Model\SmsTemplateModel;
use Model\AppVersionModel;
use Org\Sms\SmsBao;

class TravelSetController extends CommonController
{
    public function travelSet(){


        $set=M("Set")->find(1);
        $this->assign("set",$set);

        $this->display();
    }

    public function saveSet(){
        if(!isset($_POST["is_open_sms"])){$_POST["is_open_sms"]=0; }
        if(!isset($_POST["is_lock_car"])){$_POST["is_lock_car"]=0; }
        if(!isset($_POST["is_open_manual"])){$_POST["is_open_manual"]=0; }
        if(!isset($_POST["is_use_gps"])){$_POST["is_use_gps"]=0; }

        $res=M("Set")->save($_POST);
        if($res){
            $this->ajaxReturn(array("code"=>1));
        }else{
            $this->ajaxReturn(array("code"=>0));
        }
    }

    //获取短信宝剩余条数
    public function getSmsBalance(){
        $setM=new SetModel();
        $set=$setM->find(1);

        $sms=new SmsBao($set["sms_account"],$set["sms_pwd"]);
        $res=$sms->getBalance();

        $this->ajaxReturn(array("Balance"=>$res));
    }

    public function travelTypes(){
        $this->display();
    }

    public function getTravelTypes(){

        $resCount=M("TravelType")->where("is_del=0")->select();
        $res=M("TravelType")->where("is_del=0")->limit($_POST["start"],$_POST["length"])->select();

        //返回数据
        $types=array();
        $types["draw"]=$_POST["draw"];
        $types["recordsTotal"]=count($resCount);//总记录条数
        $types["recordsFiltered"]=count($resCount);//过滤后的记录数，也就是搜索结果数据
        $types["data"]=$res;

        $this->ajaxReturn($types);
    }

    public function addTravelType(){
        $this->display();
    }

    public function addTravelTypeDo(){
        $res=M("TravelType")->add($_POST);
        if($res){
            $this->ajaxReturn(array("code"=>1));
        }else{
            $this->ajaxReturn(array("code"=>0));
        }
    }

    public function editTravelType($id){
        $type=M("TravelType")->find($id);
        $this->assign("type",$type);
        $this->display();
    }

    public function editTravelTypeDo(){
        $res=M("TravelType")->save($_POST);
        if($res){
            $this->ajaxReturn(array("code"=>1));
        }else{
            $this->ajaxReturn(array("code"=>0));
        }
    }

    public function delTravelType(){
        $type["id"]=$_POST["id"];
        $type["is_del"]=1;
        $res=M("TravelType")->save($type);
        if($res){
            $this->ajaxReturn(array("code"=>1));
        }else{
            $this->ajaxReturn(array("code"=>0));
        }
    }


    public function travelNatures(){
        $this->display();
    }

    public function getTravelNatures(){
        $resCount=M("TravelNature")->where("is_del=0")->select();
        $res=M("TravelNature")->where("is_del=0")->limit($_POST["start"],$_POST["length"])->select();

        //返回数据
        $types=array();
        $types["draw"]=$_POST["draw"];
        $types["recordsTotal"]=count($resCount);//总记录条数
        $types["recordsFiltered"]=count($resCount);//过滤后的记录数，也就是搜索结果数据
        $types["data"]=$res;

        $this->ajaxReturn($types);
    }

    public function addTravelNature(){
        $this->display();
    }

    public function addTravelNatureDo(){
        $res=M("TravelNature")->add($_POST);
        if($res){
            $this->ajaxReturn(array("code"=>1));
        }else{
            $this->ajaxReturn(array("code"=>0));
        }
    }

    public function editTravelNature($id){
        $nature=M("TravelNature")->find($id);
        $this->assign("nature",$nature);
        $this->display();
    }

    public function editTravelNatureDo(){
        $res=M("TravelNature")->save($_POST);
        if($res){
            $this->ajaxReturn(array("code"=>1));
        }else{
            $this->ajaxReturn(array("code"=>0));
        }
    }

    public function delTravelNature(){
        $type["id"]=$_POST["id"];
        $type["is_del"]=1;
        $res=M("TravelNature")->save($type);
        if($res){
            $this->ajaxReturn(array("code"=>1));
        }else{
            $this->ajaxReturn(array("code"=>0));
        }
    }

    public function getPayTypes(){
        $resCount=M("PayType")->where("is_del=0")->select();
        $res=M("PayType")->where("is_del=0")->limit($_POST["start"],$_POST["length"])->select();

        //返回数据
        $types=array();
        $types["draw"]=$_POST["draw"];
        $types["recordsTotal"]=count($resCount);//总记录条数
        $types["recordsFiltered"]=count($resCount);//过滤后的记录数，也就是搜索结果数据
        $types["data"]=$res;

        $this->ajaxReturn($types);
    }

    public function delPayType()
    {
        $type["id"]=$_POST["id"];
        $type["is_del"]=1;
        $res=M("PayType")->save($type);
        if($res){
            $this->ajaxReturn(array("code"=>1));
        }else{
            $this->ajaxReturn(array("code"=>0));
        }
    }


    public function addPayTypeDo(){
        $res=M("PayType")->add($_POST);
        if($res){
            $this->ajaxReturn(array("code"=>1));
        }else{
            $this->ajaxReturn(array("code"=>0));
        }
    }

    public function editPayType($id){
        $pay=M("PayType")->find($id);
        $this->assign("pay",$pay);
        $this->display();
    }

    public function editPayTypeDo(){
        $res=M("PayType")->save($_POST);
        if($res){
            $this->ajaxReturn(array("code"=>1));
        }else{
            $this->ajaxReturn(array("code"=>0));
        }
    }


    public function getSmsTemplates(){
        $resCount=M("SmsTemplate")->where("is_del=0")->select();
        $res=M("SmsTemplate")->where("is_del=0")->limit($_POST["start"],$_POST["length"])->select();

        //返回数据
        $types=array();
        $types["draw"]=$_POST["draw"];
        $types["recordsTotal"]=count($resCount);//总记录条数
        $types["recordsFiltered"]=count($resCount);//过滤后的记录数，也就是搜索结果数据
        $types["data"]=$res;

        $this->ajaxReturn($types);
    }

    public function editSmsTemplate($id){
        $sms=M("SmsTemplate")->find($id);
        $this->assign("sms",$sms);
        $this->display();
    }

    public function editSmsTemplateDo(){
        $res=M("SmsTemplate")->save($_POST);
        if($res){
            $this->ajaxReturn(array("code"=>1));
        }else{
            $this->ajaxReturn(array("code"=>0));
        }
    }

    public function getAppVersions(){


        $map["type"]=$_POST["type"];

        $resCount=M("AppVersion")->where($map)->select();
        $res=M("AppVersion")->where($map)->order("version desc")->limit($_POST["start"],$_POST["length"])->select();

        //返回数据
        $apps=array();
        $apps["draw"]=$_POST["draw"];
        $apps["recordsTotal"]=count($resCount);//总记录条数
        $apps["recordsFiltered"]=count($resCount);//过滤后的记录数，也就是搜索结果数据
        $apps["data"]=$res;

        $this->ajaxReturn($apps);

    }

    public function addApp($type){
        $this->assign("type",$type);

        $this->display();
    }

    public function addAppDo(){
        $upload = new \Think\Upload();
        // 实例化上传类
        $upload -> maxSize = 50000000000;
        // 设置附件上传大小
        $upload->exts      =     array('apk');// 设置附件上传类
        // 设置附件上传类型
        $upload -> rootPath = './Public/apk/';
        // 设置附件上传根目录
        $upload -> savePath = '';
        // 设置附件上传（子）目录
        // 上传文件
        $info = $upload -> uploadOne($_FILES["apk"]);

        $filename = './Public/apk/'.$info['savepath'].$info['savename'];
        $exts = $info['ext'];


        if(!$info) {// 上传错误提示错误信息
            //$this->error($upload->getError());
            

            $this->ajaxReturn(array("code"=>0));
        }else{// 上传成功
            $url= '/Public/apk/'.$info['savepath'].$info['savename'];

            //存入数据库
            $appVersionM=M("AppVersion");
            $arr=array(
                "url"=>$url,
                "add_data"=>time(),
                "version"=>$_POST["version"],
                "type"=>$_POST["type"]
            );
            $appVersionM->add($arr);

            $this->ajaxReturn(array("code"=>1));

        }
    }

    /*
     * 计价价格页面展示
     */
    public function charging(){
        $this->display();
    }

    public function getCharging(){
        $key= $_POST["search"]["value"];
        $map=array();
        if(!empty($key)){
            //$map['car_num | seat_num | engine_num | frame_num | maintain_interval | compulsory_insurance_time | commercial_insurance_time | car_name | brand |old_company|new_company'] = array('like', "%$key%");
        }
        $resCount=M("Charging")->where($map)->select();

        $order=array();
        switch ($_POST["order"][0]["column"])
        {
            case 1:
                $order["car_type_id"]=$_POST["order"][0]["dir"];
                break;
            case 2:
                $order["type"]=$_POST["order"][0]["dir"];
                break;
            case 3:
                $order["start_time"]=$_POST["order"][0]["dir"];
                break;
            case 4:
                $order["end_time"]=$_POST["order"][0]["dir"];
                break;
            case 5:
                $order["price"]=$_POST["order"][0]["dir"];
                break;
            case 6:
                $order["remark"]=$_POST["order"][0]["dir"];
                break;
        }

        $res=M("Charging")->where($map)->order($order)->limit($_POST["start"],$_POST["length"])->select();


        for($i=0;$i<count($res)&& count($res);$i++){
            //找出车辆类型名称
            $carType=M("CarType")->find($res[$i]["car_type_id"]);
            $res[$i]["type_name"]=$carType["type_name"];
        }
        //返回数据
        $chargings=array();
        $chargings["draw"]=$_POST["draw"];
        $chargings["recordsTotal"]=count($resCount);//总记录条数
        $chargings["recordsFiltered"]=count($resCount);//过滤后的记录数，也就是搜索结果数据
        $chargings["data"]=$res;

        $this->ajaxReturn($chargings);

    }

    public function addCharging(){
        $carTypes=M("CarType")->select();
        $this->assign("carTypes",$carTypes);

        $this->display();
    }

    public function addChargingDo(){
        $res=M("Charging")->add($_POST);

        if($res){
            $this->ajaxReturn(array("code"=>1));
        }else{
            $this->ajaxReturn(array("code"=>0));
        }
    }

    public function editCharging($id){
        $carTypes=M("CarType")->select();
        $this->assign("carTypes",$carTypes);

        $charging=M("Charging")->find($id);
        $this->assign("charging",$charging);

        $this->display();
    }

    public function editChargingDo(){
        $res=M("Charging")->save($_POST);

        if($res){
            $this->ajaxReturn(array("code"=>1));
        }else{
            $this->ajaxReturn(array("code"=>0));
        }
    }


    public function subsidyType(){
        $this->display();
    }

    public function getAllSubsidyType(){
        $resCount=M("SubsidyType")->select();


        $res=M("SubsidyType")->limit($_POST["start"],$_POST["length"])->select();

        //返回数据
        $data=array();
        $data["draw"]=$_POST["draw"];
        $data["recordsTotal"]=count($resCount);//总记录条数
        $data["recordsFiltered"]=count($resCount);//过滤后的记录数，也就是搜索结果数据
        $data["data"]=$res;

        $this->ajaxReturn($data);
    }


    public function addSubsidyType(){
        $this->display();
    }

    public function addSubsidyTypeDo(){
        if(empty($_POST)){


            $this->ajaxReturn(array("code"=>0));
        }else{
            $res=M("SubsidyType")->add($_POST);

            if($res){
                $this->ajaxReturn(array("code"=>1));
            }else{
                $this->ajaxReturn(array("code"=>0));
            }

        }
    }

    public function editSubsidyType($id){
        $subsidyType=M("SubsidyType")->find($id);

        $this->assign("subsidyType",$subsidyType);


        $this->display();
    }

    public function editSubsidyTypeDo(){
        if(empty($_POST)){
            $this->ajaxReturn(array("code"=>0));
        }else{
            $res=M("SubsidyType")->save($_POST);
            if($res){
                $this->ajaxReturn(array("code"=>1));
            }else{
                $this->ajaxReturn(array("code"=>0));
            }
        }
    }
}