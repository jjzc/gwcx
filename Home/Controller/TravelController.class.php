<?php
/**
 * Created by PhpStorm.
 * User: MrQ
 * Date: 2018/5/31
 * Time: 13:59
 */

namespace Home\Controller;
use Model\ArrangeTypeModel;
use Model\CarModel;
use Model\DriverModel;
use Model\SetModel;
use Model\TravelModel;
use Org\Sms\SmsBao;
use Think\Controller;
use Model\TravelTypeModel;
use Model\TravelNatureModel;
use Model\UserModel;
use Model\CompanyModel;

class TravelController extends CommonController
{
    /*
     * 提交出行申请页面
     */
    public function signTravel(){
        $user_id=session("user_id");
        $user_company=session("user_company");

        $company=M("Company")->find($user_company);
        $this->assign("company",$company);

        //检测这个单位有没有定向车辆
        $have_dx=0;
        if($company["dx_car"]!=0){
            //然后查询这个车辆状态是不是0
            $car=M("Car")->find($company["dx_car"]);
            if($car["state"]==1){
                $have_dx=1;
            }
        }
        $this->assign("have_dx",$have_dx);

        $set=D("set")->find(1);
        $this->assign("set",$set);

        $travel_typeM=new TravelTypeModel();
        $this->assign("travel_type",$travel_typeM->where("is_del=0")->select());

        $travelNatureM=new TravelNatureModel();
        $this->assign("travel_nature",$travelNatureM->select());

        //获取该单位所有人员信息
        $userM=new UserModel();
        $users=$userM->where(array("user_company"=>$company["id"],"is_del"=>0))->select();
        $this->assign("users",$users);


        //$this->assign("newSerialNumber",$newSerialNumber);


        $this->display();
    }


    public function signTravelDo(){
        //dump($_POST);

        $set=D("set")->find(1);

        $user=M("User")->find(session("user_id"));

        $_POST["from_place"]=$_POST["search-text"];
        $_POST["from_place_location"]=$_POST["from_place_lng"].",".$_POST["from_place_lat"];
        $_POST["to_place"]=$_POST["search-text2"];
        $_POST["to_place_location"]=$_POST["from_place_lng2"].",".$_POST["from_place_lat2"];


        $travel_typeM=new TravelTypeModel();
        $travel_type=$travel_typeM->find($_POST["travel_type_id"]);

        //验证是否需要走审计流程
        $_POST["is_need_audit"]=0;
        if(isset($set["audit_start_time"])&&isset($set["audit_end_time"])){
            $nowTime=date("y-m-d");
            if(strtotime($set["audit_start_time"])<=strtotime($nowTime)&&strtotime($nowTime)<=strtotime($set["audit_end_time"])){
                $_POST["is_need_audit"]=1;
                $_POST["audit_res"]=0;
            }
        }


        //验证是否使用了定向车辆
        if($_POST["is_dx"]==1){
            $company=M("Company")->find($user["user_company"]);
            $_POST["car_id"]=$company["dx_car"];
            $_POST["driver_id"]=$company["dx_driver"];
        }

        //需要管理员审核，则状态直接设置为0，等待管理员审核
        if($travel_type["is_need_manage_review"]){
            $_POST["state"]=0;
        }else{
            //是否需要中心审核,如需要中心审核，则将状态设置为1，表示直接审核通过
            if($travel_type["is_need_center_review"]){
                $_POST["state"]=1;
            }else{
                //不要中心审核，是否需要派车
                if($travel_type["is_arrange_car"]){
                    //需要派车，则讲状态设置为3，表示不需要任何审核，直接进入派车程序
                    $_POST["state"]=3;
                }else{
                    //不需要派车，不需要任何审核，改出行直接审核完成！
                    $_POST["state"]=9;
                }
            }
        }

        $mycontent = $set["serial_number"];
        //如果是当天的流水号，则直接使用
        $nowdata=date("Ymd",time());
        $savedata=substr($mycontent , 0 , 8);

        if($nowdata==$savedata){
            $newSerialNumber=$mycontent;
        }else{
            $newSerialNumber=$nowdata."0001";
        }
        //流水号
        $_POST["serial_number"]=$newSerialNumber;

        $_POST["is_arrange_car"]=$travel_type["is_arrange_car"];
        $_POST["is_need_manage_review"]=$travel_type["is_need_manage_review"];
        $_POST["is_need_center_review"]=$travel_type["is_need_center_review"];
        $_POST["is_need_receipt"]=$travel_type["is_need_receipt"];
        $_POST["is_need_evaluate"]=$travel_type["is_need_evaluate"];
        $_POST["is_need_sendcar_review"]=$travel_type["is_need_sendcar_review"];

        $_POST["is_need_settlement"]=$travel_type["is_need_settlement"];
        if($_POST["is_need_settlement"]==1){
            $_POST["is_settlemented"]=0;
        }


        $_POST["departure_time"]= strtotime($_POST["departure_time"]);	//转换成时间戳格式
        $_POST["collecting_time"]= strtotime($_POST["collecting_time"]);


        $_POST["user_id"]=session("user_id");



        $_POST["sign_time"]=time();


        $_POST["user_name"]=$user["user_name"];

        $_POST["company_id"]=$user["user_company"];

        $travelM=new TravelModel();

        if($travelM->add($_POST)){
            //保存成功
            //流水号加1
            // $myfile = fopen("lsh.txt", "w") or die("Unable to open file!");
            // $txt = $newSerialNumber+1;
            // fwrite($myfile, $txt);
            // fclose($myfile);
            //
            $set["serial_number"]=$newSerialNumber+1;
            D("set")->save($set);


            $this->ajaxReturn(array("code"=>1));
        }else{
            $this->ajaxReturn(array("code"=>0));
        }

    }


    public function myTravels(){
        $this->display();
    }



    public function getMyTravels(){

        $map["is_del"]=0;
        $user=M("User")->find(session("user_id"));
        $map["user_id"]=$user["id"];
        $this->assign("user",$user);

        $key= $_POST["search"]["value"];
        if(!empty($key)){
            $map['serial_number | from_place | to_place | people_num | travel_people | travel_reason | route '] = array('like', "%$key%");
        }

        $order=array();
        switch ($_POST["order"][0]["column"])
        {
            case 1:
                $order["serial_number"]=$_POST["order"][0]["dir"];
                break;
            case 2:
                $order["from_place"]=$_POST["order"][0]["dir"];
                break;
            case 3:
                $order["to_place"]=$_POST["order"][0]["dir"];
                break;
            case 4:
                $order["departure_time"]=$_POST["order"][0]["dir"];
                break;
            case 5:
                $order["travel_type_id"]=$_POST["order"][0]["dir"];
                break;
            case 10:
                $order["state"]=$_POST["order"][0]["dir"];
                break;

        }

        $travelM=new TravelModel();
        $resCount=$travelM->where($map)->order($order)->select();
        $travels=$travelM->where($map)->order($order)->limit($_POST["start"],$_POST["length"])->select();

        $travelTypeM=new TravelTypeModel();
        for ($i = 0; $i < count($travels)&&count($travels)!=0; $i++) {
            $traverType=$travelTypeM->find($travels[$i]["travel_type_id"]);
            $travels[$i]["travel_type_name"]=$traverType["travel_name"];
        }

        //返回数据
        $res=array();
        $res["draw"]=$_POST["draw"];
        $res["recordsTotal"]=count($resCount);//总记录条数
        $res["recordsFiltered"]=count($resCount);//过滤后的记录数，也就是搜索结果数据
        $res["data"]=$travels;

        $this->ajaxReturn($res);
    }

    public function viewTravel($id){
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


        $travelM=new TravelModel();
        $travel=$travelM->find($id);
        $this->assign("travel",$travel);

        //申请人个人信息
        $userM=new UserModel();
        $user=$userM->find($travel["user_id"]);
        $this->assign("user",$user);

        //申请人列表
        $userM=new UserModel();
        $users=$userM->where("is_del=0")->select();
        $this->assign("users",$users);


        //出行性质
        $travelNatureM=new TravelNatureModel();
        $travel_nature=$travelNatureM->where("is_del=0")->select();
        $this->assign("travel_nature",$travel_nature);

        //出行类型列表
        $travelTypeM=new TravelTypeModel();
        $travel_types=$travelTypeM->where("is_del=0")->select();
        $this->assign("travel_types",$travel_types);

        //出行类型信息
        $travelTypeM=new TravelTypeModel();
        $travel_type=$travelTypeM->find($travel["travel_type_id"]);
        $this->assign("travel_type",$travel_type);


        //用车人个人信息
        $use_user=$userM->find($travel["use_user_id"]);
        $this->assign("use_user",$use_user);

        //申请人公司信息
        $companyM=new CompanyModel();
        $company=$companyM->find($travel["company_id"]);
        $this->assign("company",$company);

        //司机信息
//        $driverM=new DriverModel();
//        $driver_name=$driverM->find($travel["driver_id"]);
//        $this->assign("driver",$driver_name);

        //车辆信息
//        $carMM=new CarModel();
//        $car_name=$carMM->find($travel["car_id"]);
//        $this->assign("car",$car_name);

        //需要派车情况下，查询是否已经派车
        $had_send_car=false;
        $is_owner=false;
        if($travel["is_arrange_car"]=="1"){
            if(isset($travel["arrange_type_id"])||isset($travel["car_id"])){
                $had_send_car=true;

                if(isset($travel["arrange_type_id"])){
                    //获取第三方公司信息
                    $arrange_typeM=new ArrangeTypeModel();
                    $arrange_type=$arrange_typeM->find($travel["arrange_type_id"]);
                    $this->assign("arrange_type",$arrange_type);
                }else{
                    $is_owner=true;
                    $carM=new CarModel();
                    $driverM=new DriverModel();

                    $car=$carM->find($travel["car_id"]);
                    $driver=$driverM->find($travel["driver_id"]);

                    $this->assign("car",$car);
                    $this->assign("driver",$driver);
                }
            }
        }
        $this->assign("is_owner",$is_owner);
        $this->assign("had_send_car",$had_send_car);

        //获取出行凭据
        if($travel["credential"]==""){
            $this->assign("havadata",0);
        }else{
            $this->assign("havadata",1);
        }
        $credentials=explode("|", $travel["credential"]);
        $this->assign("credentials",$credentials);

        //获取所有状态为1车辆
        $carM=new CarModel();
        $cars=$carM->where("is_del=0")->select();
        $this->assign("cars",$cars);

        //获取所有状态为0的司机
        $driverM=new DriverModel();
        $drivers=$driverM->where("is_del=0")->select();
        $this->assign("drivers",$drivers);

        //获取所有第三方出行公司
        $arrange_type=new ArrangeTypeModel();
        $arrange_types=$arrange_type->select();
        $this->assign("arrange_types",$arrange_types);


        $this->display();
    }

    public function mySupplement(){
        $this->display();
    }

    public function getMySupplement(){
        $map["is_del"]=0;
        $user=M("User")->find(session("user_id"));
        $map["user_id"]=$user["id"];
        $this->assign("user",$user);

        $key= $_POST["search"]["value"];
        if(!empty($key)){
            $map['serial_number | from_place | to_place | people_num | travel_people | travel_reason | route '] = array('like', "%$key%");
        }

        $order=array();

        $travelM=M("Supplement");
        $resCount=$travelM->where($map)->order($order)->select();
        $travels=$travelM->where($map)->order($order)->limit($_POST["start"],$_POST["length"])->select();

        $travelTypeM=new TravelTypeModel();
        for ($i = 0; $i < count($travels)&&count($travels)!=0; $i++) {
            $traverType=$travelTypeM->find($travels[$i]["travel_type_id"]);
            $travels[$i]["travel_type_name"]=$traverType["travel_name"];
        }

        //返回数据
        $res=array();
        $res["draw"]=$_POST["draw"];
        $res["recordsTotal"]=count($resCount);//总记录条数
        $res["recordsFiltered"]=count($resCount);//过滤后的记录数，也就是搜索结果数据
        $res["data"]=$travels;

        $this->ajaxReturn($res);
    }

    public function viewSupplement($id){
        $travelM=M("Supplement");
        $travel=$travelM->find($id);
        $this->assign("travel",$travel);

        //申请人个人信息
        $userM=new UserModel();
        $user=$userM->find($travel["user_id"]);
        $this->assign("user",$user);

        //申请人列表
        $userM=new UserModel();
        $users=$userM->where("is_del=0")->select();
        $this->assign("users",$users);


        //出行性质
        $travelNatureM=new TravelNatureModel();
        $travel_nature=$travelNatureM->where("is_del=0")->select();
        $this->assign("travel_nature",$travel_nature);

        //出行类型列表
        $travelTypeM=new TravelTypeModel();
        $travel_types=$travelTypeM->where("is_del=0")->select();
        $this->assign("travel_types",$travel_types);

        //出行类型信息
        $travelTypeM=new TravelTypeModel();
        $travel_type=$travelTypeM->find($travel["travel_type_id"]);
        $this->assign("travel_type",$travel_type);


        //用车人个人信息
        $use_user=$userM->find($travel["use_user_id"]);
        $this->assign("use_user",$use_user);

        //申请人公司信息
        $companyM=new CompanyModel();
        $company=$companyM->find($travel["company_id"]);
        $this->assign("company",$company);

        //司机信息
//        $driverM=new DriverModel();
//        $driver_name=$driverM->find($travel["driver_id"]);
//        $this->assign("driver",$driver_name);

        //车辆信息
//        $carMM=new CarModel();
//        $car_name=$carMM->find($travel["car_id"]);
//        $this->assign("car",$car_name);

        //需要派车情况下，查询是否已经派车
        $had_send_car=false;
        $is_owner=false;
        if($travel["is_arrange_car"]=="1"){
            if(isset($travel["arrange_type_id"])||isset($travel["car_id"])){
                $had_send_car=true;

                if(isset($travel["arrange_type_id"])){
                    //获取第三方公司信息
                    $arrange_typeM=new ArrangeTypeModel();
                    $arrange_type=$arrange_typeM->find($travel["arrange_type_id"]);
                    $this->assign("arrange_type",$arrange_type);
                }else{
                    $is_owner=true;
                    $carM=new CarModel();
                    $driverM=new DriverModel();

                    $car=$carM->find($travel["car_id"]);
                    $driver=$driverM->find($travel["driver_id"]);

                    $this->assign("car",$car);
                    $this->assign("driver",$driver);
                }
            }
        }
        $this->assign("is_owner",$is_owner);
        $this->assign("had_send_car",$had_send_car);

        //获取出行凭据
        if($travel["credential"]==""){
            $this->assign("havadata",0);
        }else{
            $this->assign("havadata",1);
        }
        $credentials=explode("|", $travel["credential"]);
        $this->assign("credentials",$credentials);

        //获取所有状态为1车辆
        $carM=new CarModel();
        $cars=$carM->where("is_del=0")->select();
        $this->assign("cars",$cars);

        //获取所有状态为0的司机
        $driverM=new DriverModel();
        $drivers=$driverM->where("is_del=0")->select();
        $this->assign("drivers",$drivers);

        //获取所有第三方出行公司
        $arrange_type=new ArrangeTypeModel();
        $arrange_types=$arrange_type->select();
        $this->assign("arrange_types",$arrange_types);


        $this->display();
    }


    /*
     * 取消出行
     */
    public function cancelTravel(){
        $id=$_POST["id"];
        $travel=M("Travel")->find($id);

        $travel["old_state"]=$travel["state"];//将原来的状态值存起来
        $travel["state"]=10;
        $travel["cancel_reason"]=$_POST["cancel_reason"];
        $travel["cancel_time"]=time();

        if(D("travel")->save($travel)){
            $this->ajaxReturn(array("code"=>1));
        }else{
            $this->ajaxReturn(array("code"=>0));
        }
    }

    public function evaluateTravel($id){
        $travel=M("Travel")->find($id);
        $this->assign("travel",$travel);

        $this->display();

    }

    public function evaluateTravelDo(){
        $res=M("Travel")->save($_POST);

        if($res){
            $this->ajaxReturn(array("code"=>1));
        }else{
            $this->ajaxReturn(array("code"=>0));
        }

    }







    //根据关键字调取百度API接口,返回JSON数据
    public function getBaiduApi($key,$city){

        $param['query'] = $key;
        $param['page_size'] = 10;
        $param['scope'] = 1;
        $param['region'] = $city;
        $param['output'] = "json";
        $param['ak'] = "1Vlad7qAVNX3FpE7n5vGMH7AKzwBIwWV";
        //$param['mcode'] = 'BA:AD:09:3A:82:82:9F:B4:32:A7:B2:8C:B4:CC:F0:E9:F3:7D:AE:58;io.dcloud.H5D19A6FA';

        $data=SmsBao::http("http://api.map.baidu.com/place/v2/search",$param,"","GET");

        $this->ajaxReturn(array("res"=>$data));
    }


    /*
     * 补单申请
     */
    public function signSupplement(){
        $user_id=session("user_id");
        $user_company=session("user_company");

        $company=M("Company")->find($user_company);
        $this->assign("company",$company);

        //检测这个单位有没有定向车辆
        $have_dx=0;
        if($company["dx_car"]!=0){
            //然后查询这个车辆状态是不是0
            $car=M("Car")->find($company["dx_car"]);
            if($car["state"]==1){
                $have_dx=1;
            }
        }
        $this->assign("have_dx",$have_dx);

        $set=D("set")->find(1);
        $this->assign("set",$set);

        $travel_typeM=new TravelTypeModel();
        $this->assign("travel_type",$travel_typeM->where("is_del=0")->select());

        $travelNatureM=new TravelNatureModel();
        $this->assign("travel_nature",$travelNatureM->select());

        //获取该单位所有人员信息
        $userM=new UserModel();
        $users=$userM->where(array("user_company"=>$company["id"],"is_del"=>0))->select();
        $this->assign("users",$users);


        //获取所有支付方式
        $pay_types=M("PayType")->where("is_del=0")->select();
        $this->assign("pay_types",$pay_types);

        //获取所有的司机
        $drivers=M("Driver")->where("is_del=0")->select();
        $this->assign("drivers",$drivers);

        //获取所有的车辆
        $cars=M("Car")->where("is_del=0")->select();
        $this->assign("cars",$cars);




        $this->display();
    }


    public function signSupplementDo(){
        $user=M("User")->find(session("user_id"));
        
        $_POST["from_place"]=$_POST["search-text"];
        $_POST["from_place_location"]=$_POST["from_place_lng"].",".$_POST["from_place_lat"];
        $_POST["to_place"]=$_POST["search-text2"];
        $_POST["to_place_location"]=$_POST["from_place_lng2"].",".$_POST["from_place_lat2"];


        $travel_typeM=new TravelTypeModel();
        $travel_type=$travel_typeM->find($_POST["travel_type_id"]);




        //验证是否使用了定向车辆
        if($_POST["is_dx"]==1){
            $company=M("Company")->find($user["user_company"]);
            $_POST["car_id"]=$company["dx_car"];
            $_POST["driver_id"]=$company["dx_driver"];
        }



        $_POST["is_arrange_car"]=$travel_type["is_arrange_car"];
        $_POST["is_need_manage_review"]=$travel_type["is_need_manage_review"];
        $_POST["is_need_center_review"]=$travel_type["is_need_center_review"];
        $_POST["is_need_receipt"]=$travel_type["is_need_receipt"];
        $_POST["is_need_evaluate"]=$travel_type["is_need_evaluate"];
        $_POST["is_need_sendcar_review"]=$travel_type["is_need_sendcar_review"];

        $_POST["is_need_settlement"]=$travel_type["is_need_settlement"];
        if($_POST["is_need_settlement"]==1){
            $_POST["is_settlemented"]=0;
        }


        $_POST["departure_time"]= strtotime($_POST["departure_time"]);	//转换成时间戳格式
        $_POST["start_car_time"]= strtotime($_POST["start_car_time"]);	//转换成时间戳格式
        $_POST["end_use_car_time"]= strtotime($_POST["end_use_car_time"]);



        $_POST["user_id"]=session("user_id");



        $_POST["sign_time"]=time();
        $_POST["state"]=9;


        $_POST["user_name"]=$user["user_name"];

        $_POST["company_id"]=$user["user_company"];
        $_POST["totle_rate"]=$_POST["fees_sum"]+$_POST["parking_rate_sum"]+$_POST["service_charge"]+$_POST["driver_cost"]+$_POST["over_time_cost"]+$_POST["over_mileage_cost"]+$_POST["else_cost"];
        $res=M("Supplement")->add($_POST);
        if($res){
            $this->ajaxReturn(array("code"=>1));
        }else{
            $this->ajaxReturn(array("code"=>0));
        }
    }

}