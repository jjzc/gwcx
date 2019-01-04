<?php
namespace Admin\Controller;
use Model\ArrangeTypeModel;
use Model\CarModel;
use Model\CostInsuranceModel;
use Model\CostOilModel;
use Model\CostRepairModel;
use Model\CostWashModel;
use Model\DriverModel;
use Model\TravelModel;
use Model\TravelTypeModel;
use Model\UserModel;
use Model\CompanyModel;

/**
 *User控制器，主要负责对车辆的操作
 */
class ReportController extends CommonController {
    /*
     * 单位数据统计
     */
    public function byCompany(){
        //获取所有单位
        $companysall=M("Company")->where("is_del=0")->select();
        $this->assign("companysall",$companysall);


        //获取当月1号时间
        $startTime=date('Y-m-01', strtotime(date("Y-m-d")));
        $endTime=date('Y-m-d', strtotime(date("Y-m-d")));



        $map=array();
        $mapc=array();


        if(empty($_POST)){
            $this->assign("aa","0");
        }else{
            //如果发送数据过来了
            $this->assign("type",$_POST["type"]);

            //获取开始时间
            if(!empty($_POST["startTime"])){
                $startTime=$_POST["startTime"];
                $map['departure_time']  = array('gt',strtotime($_POST["startTime"]));
            }

            if(!empty($_POST["endTime"])){
                $endTime=$_POST["endTime"];
                $map['departure_time']  = array('elt',strtotime($_POST["endTime"])+24*3600);
            }
            if((!empty($_POST["startTime"]))&&!empty($_POST["endTime"])){

                $startTime=$_POST["startTime"];
                $endTime=$_POST["endTime"];

                $map['departure_time']  = array('between',array(strtotime($_POST["startTime"]),strtotime($_POST["endTime"])+24*3600));
            }
            if($_POST["company"]!=0){
                $mapc["id"]=$_POST["company"];
                $this->assign("companyname",$_POST["company"]);
            }


            $mapc["is_del"]=0;




            $this->assign("aa","1");



            if($_POST["type"]==1){
                $companys=M("Company")->where($mapc)->select();
                $hj=array(
                    "finishCount"=>0,
                    "companyMileageCount"=>0,
                    "luqiaoCount"=>0,
                    "fuwufeiCount"=>0,
                    "buzhuCount"=>0,
                    "qitaCount"=>0,
                    "heji"=>0
                );

                for($i=0;$i<count($companys)&&count($companys)!=0;$i++){
                    $map['company_id']  = array('eq',$companys[$i]["id"]);

                    $travelM=new TravelModel();
                    $companys[$i]["finishCount"]=$travelM->where($map)->where(array("state"=>"9"))->count();
                    $companys[$i]["companyMileageCount"]=$travelM->where($map)->where(array("state"=>"9"))->sum("mileage");//该单位所有出行费用之和
                    if(empty($companys[$i]["companyMileageCount"])){$companys[$i]["companyMileageCount"]=0;}


                    $companys[$i]["luqiaoCount"]=$travelM->where($map)->where(array("state"=>"9"))->sum("fees_sum");//该单位所有出行费用之和
                    if(empty($companys[$i]["luqiaoCount"])){$companys[$i]["luqiaoCount"]=0;}

                    $companys[$i]["fuwufeiCount"]=$travelM->where($map)->where(array("state"=>"9"))->sum("service_charge");//该单位所有出行费用之和
                    if(empty($companys[$i]["fuwufeiCount"])){$companys[$i]["fuwufeiCount"]=0;}

                    $companys[$i]["buzhuCount"]=$travelM->where($map)->where(array("state"=>"9"))->sum("driver_bt_cost");




                    $companys[$i]["qitaCount"]=$travelM->where($map)->where(array("state"=>"9"))->sum("parking_rate_sum")+$travelM->where($map)->where(array("state"=>"9"))->sum("driver_cost")+$travelM->where($map)->where(array("state"=>"9"))->sum("over_time_cost")+$travelM->where($map)->where(array("state"=>"9"))->sum("over_mileage_cost")+$travelM->where($map)->where(array("state"=>"9"))->sum("else_cost");//该单位所有出行费用之和

                    $companys[$i]["heji"]=$companys[$i]["luqiaoCount"]+$companys[$i]["fuwufeiCount"]+$companys[$i]["buzhuCount"]+$companys[$i]["qitaCount"];


                    $hj["finishCount"]+=$companys[$i]["finishCount"];
                    $hj["companyMileageCount"]+=$companys[$i]["companyMileageCount"];
                    $hj["luqiaoCount"]+=$companys[$i]["luqiaoCount"];
                    $hj["fuwufeiCount"]+=$companys[$i]["fuwufeiCount"];
                    $hj["buzhuCount"]+=$companys[$i]["buzhuCount"];
                    $hj["qitaCount"]+=$companys[$i]["qitaCount"];
                    $hj["heji"]+=$companys[$i]["heji"];
                }
                $this->assign("hj",$hj);
                $this->assign("companys",$companys);
            }else{

                if($_POST["company"]==0){
                    $map["state"]=9;
                }else{
                    $map["company_id"]=$_POST["company"];
                    $map["state"]=9;
                }
                $travels=M("Travel")->where($map)->select();


                for($i=0;$i<count($travels)&&count($travels)!=0;$i++){
                    //获取用车人信息
                    $user=M("User")->find($travels[$i]["use_user_id"]);
                    $travels[$i]["user_name"]=$user["user_name"];


                    $companyyy=M("Company")->find($travels[$i]["company_id"]);
                    $travels[$i]["company_namee"]=$companyyy["company_name"];


                }

                $this->assign("travels",$travels);

            }


        }


        $this->assign("startTime",$startTime);
        $this->assign("endTime",$endTime);












        $this->display();
    }





    public function byCar(){
        //获取当月1号时间
        $startTime=date('Y-m-01', strtotime(date("Y-m-d")));
        $endTime=date('Y-m-d', strtotime(date("Y-m-d")));


        //获取所有单位
        $carsall=M("Car")->where("is_del=0")->select();
        $this->assign("carsall",$carsall);



        if(empty($_POST)){
            $this->assign("aa","0");
        }else{
            //如果发送数据过来了
            $this->assign("type",$_POST["type"]);

            //获取开始时间
            if(!empty($_POST["startTime"])){
                $startTime=$_POST["startTime"];
                $map['departure_time']  = array('gt',strtotime($_POST["startTime"]));
            }

            if(!empty($_POST["endTime"])){
                $endTime=$_POST["endTime"];
                $map['departure_time']  = array('elt',strtotime($_POST["endTime"])+24*3600);
            }
            if((!empty($_POST["startTime"]))&&!empty($_POST["endTime"])){

                $startTime=$_POST["startTime"];
                $endTime=$_POST["endTime"];

                $map['departure_time']  = array('between',array(strtotime($_POST["startTime"]),strtotime($_POST["endTime"])+24*3600));
            }
            if($_POST["car"]!=0){
                $mapc["id"]=$_POST["car"];
                $this->assign("carname",$_POST["car"]);
            }


            $mapc["is_del"]=0;




            $this->assign("aa","1");



            if($_POST["type"]==1){
                $cars=M("Car")->where($mapc)->select();
                $hj=array(
                    "finishCount"=>0,
                    "companyMileageCount"=>0,
                    "luqiaoCount"=>0,
                    "fuwufeiCount"=>0,
                    "buzhuCount"=>0,
                    "qitaCount"=>0,
                    "heji"=>0
                );

                for($i=0;$i<count($cars)&&count($cars)!=0;$i++){
                    $map['car_id']  = array('eq',$cars[$i]["id"]);

                    $travelM=new TravelModel();
                    $cars[$i]["finishCount"]=$travelM->where($map)->where(array("state"=>"9"))->count();
                    $cars[$i]["companyMileageCount"]=$travelM->where($map)->where(array("state"=>"9"))->sum("mileage");//该单位所有出行费用之和
                    if(empty($cars[$i]["companyMileageCount"])){$cars[$i]["companyMileageCount"]=0;}


                    $cars[$i]["luqiaoCount"]=$travelM->where($map)->where(array("state"=>"9"))->sum("fees_sum");//该单位所有出行费用之和
                    if(empty($cars[$i]["luqiaoCount"])){$cars[$i]["luqiaoCount"]=0;}

                    $cars[$i]["fuwufeiCount"]=$travelM->where($map)->where(array("state"=>"9"))->sum("service_charge");//该单位所有出行费用之和
                    if(empty($cars[$i]["fuwufeiCount"])){$cars[$i]["fuwufeiCount"]=0;}

                    $cars[$i]["buzhuCount"]=$travelM->where($map)->where(array("state"=>"9"))->sum("driver_bt_cost");


                    $cars[$i]["qitaCount"]=$travelM->where($map)->where(array("state"=>"9"))->sum("parking_rate_sum")+$travelM->where($map)->where(array("state"=>"9"))->sum("driver_cost")+$travelM->where($map)->where(array("state"=>"9"))->sum("over_time_cost")+$travelM->where($map)->where(array("state"=>"9"))->sum("over_mileage_cost")+$travelM->where($map)->where(array("state"=>"9"))->sum("else_cost");//该单位所有出行费用之和

                    $cars[$i]["heji"]=$cars[$i]["luqiaoCount"]+$cars[$i]["fuwufeiCount"]+$cars[$i]["buzhuCount"]+$cars[$i]["qitaCount"];


                    $hj["finishCount"]+=$cars[$i]["finishCount"];
                    $hj["companyMileageCount"]+=$cars[$i]["companyMileageCount"];
                    $hj["luqiaoCount"]+=$cars[$i]["luqiaoCount"];
                    $hj["fuwufeiCount"]+=$cars[$i]["fuwufeiCount"];
                    $hj["buzhuCount"]+=$cars[$i]["buzhuCount"];
                    $hj["qitaCount"]+=$cars[$i]["qitaCount"];
                    $hj["heji"]+=$cars[$i]["heji"];
                }
                $this->assign("hj",$hj);
                $this->assign("cars",$cars);
            }



            if($_POST["type"]==2){
                if($_POST["car"]==0){
                    $map["state"]=9;
                }else{
                    $map["car_id"]=$_POST["car"];
                    $map["state"]=9;
                }
                $travels=M("Travel")->where($map)->select();


                for($i=0;$i<count($travels)&&count($travels)!=0;$i++){
                    //获取用车人信息
                    $user=M("User")->find($travels[$i]["use_user_id"]);
                    $travels[$i]["user_name"]=$user["user_name"];

                    //单位信息
                    $companyyy=M("Company")->find($travels[$i]["company_id"]);
                    $travels[$i]["company_namee"]=$companyyy["company_name"];

                    //车辆信息
                    $car=M("Car")->find($travels[$i]["car_id"]);
                    $travels[$i]["car_num"]=$car["car_num"];

                    //司机信息
                    $driver=M("Driver")->find($travels[$i]["driver_id"]);
                    $travels[$i]["driver_name"]=$driver["driver_name"];

                }

                $this->assign("travels",$travels);
            }




        }


        $this->assign("startTime",$startTime);
        $this->assign("endTime",$endTime);








        $this->display();
    }


    public function byDriver(){

        $startTime=date('Y-m-01', strtotime(date("Y-m-d")));
        $endTime=date('Y-m-d', strtotime(date("Y-m-d")));

        //获取所有单位
        $driversall=M("Driver")->where("is_del=0")->select();
        $this->assign("driversall",$driversall);


        if(empty($_POST)){
            $this->assign("aa","0");
        }else{
            //如果发送数据过来了
            $this->assign("type",$_POST["type"]);

            //获取开始时间
            if(!empty($_POST["startTime"])){
                $startTime=$_POST["startTime"];
                $map['departure_time']  = array('gt',strtotime($_POST["startTime"]));
            }

            if(!empty($_POST["endTime"])){
                $endTime=$_POST["endTime"];
                $map['departure_time']  = array('elt',strtotime($_POST["endTime"])+24*3600);
            }
            if((!empty($_POST["startTime"]))&&!empty($_POST["endTime"])){

                $startTime=$_POST["startTime"];
                $endTime=$_POST["endTime"];

                $map['departure_time']  = array('between',array(strtotime($_POST["startTime"]),strtotime($_POST["endTime"])+24*3600));
            }
            if($_POST["driver"]!=0){
                $mapc["id"]=$_POST["driver"];
                $this->assign("drivername",$_POST["driver"]);
            }


            $mapc["is_del"]=0;



            $this->assign("aa","1");



            if($_POST["type"]==1){
                $drivers=M("Driver")->where($mapc)->select();


                $hj=array(
                    "finishCount"=>0,
                    "companyMileageCount"=>0,
                    "luqiaoCount"=>0,
                    "fuwufeiCount"=>0,
                    "buzhuCount"=>0,
                    "qitaCount"=>0,
                    "heji"=>0
                );

                for($i=0;$i<count($drivers)&&count($drivers)!=0;$i++){
                    $map['driver_id']  = array('eq',$drivers[$i]["id"]);

                    $travelM=new TravelModel();
                    $drivers[$i]["finishCount"]=$travelM->where($map)->where(array("state"=>"9"))->count();
                    $drivers[$i]["companyMileageCount"]=$travelM->where($map)->where(array("state"=>"9"))->sum("mileage");//该单位所有出行费用之和
                    if(empty($drivers[$i]["companyMileageCount"])){$drivers[$i]["companyMileageCount"]=0;}


                    $drivers[$i]["luqiaoCount"]=$travelM->where($map)->where(array("state"=>"9"))->sum("fees_sum");//该单位所有出行费用之和
                    if(empty($drivers[$i]["luqiaoCount"])){$drivers[$i]["luqiaoCount"]=0;}

                    $drivers[$i]["fuwufeiCount"]=$travelM->where($map)->where(array("state"=>"9"))->sum("service_charge");//该单位所有出行费用之和
                    if(empty($drivers[$i]["fuwufeiCount"])){$drivers[$i]["fuwufeiCount"]=0;}

                    $drivers[$i]["buzhuCount"]=$travelM->where($map)->where(array("state"=>"9"))->sum("driver_bt_cost");


                    $drivers[$i]["qitaCount"]=$travelM->where($map)->where(array("state"=>"9"))->sum("parking_rate_sum")+$travelM->where($map)->where(array("state"=>"9"))->sum("driver_cost")+$travelM->where($map)->where(array("state"=>"9"))->sum("over_time_cost")+$travelM->where($map)->where(array("state"=>"9"))->sum("over_mileage_cost")+$travelM->where($map)->where(array("state"=>"9"))->sum("else_cost");//该单位所有出行费用之和

                    $drivers[$i]["heji"]=$drivers[$i]["luqiaoCount"]+$drivers[$i]["fuwufeiCount"]+$drivers[$i]["buzhuCount"]+$drivers[$i]["qitaCount"];


                    $hj["finishCount"]+=$drivers[$i]["finishCount"];
                    $hj["companyMileageCount"]+=$drivers[$i]["companyMileageCount"];
                    $hj["luqiaoCount"]+=$drivers[$i]["luqiaoCount"];
                    $hj["fuwufeiCount"]+=$drivers[$i]["fuwufeiCount"];
                    $hj["buzhuCount"]+=$drivers[$i]["buzhuCount"];
                    $hj["qitaCount"]+=$drivers[$i]["qitaCount"];
                    $hj["heji"]+=$drivers[$i]["heji"];
                }
                $this->assign("hj",$hj);
                $this->assign("drivers",$drivers);
            }



            if($_POST["type"]==2){
                if($_POST["driver"]==0){
                    $map["state"]=9;
                }else{
                    $map["driver_id"]=$_POST["driver"];
                    $map["state"]=9;
                }
                $travels=M("Travel")->where($map)->select();


                for($i=0;$i<count($travels)&&count($travels)!=0;$i++){
                    //获取用车人信息
                    $user=M("User")->find($travels[$i]["use_user_id"]);
                    $travels[$i]["user_name"]=$user["user_name"];

                    //单位信息
                    $companyyy=M("Company")->find($travels[$i]["company_id"]);
                    $travels[$i]["company_namee"]=$companyyy["company_name"];

                    //车辆信息
                    $car=M("Car")->find($travels[$i]["car_id"]);
                    $travels[$i]["car_num"]=$car["car_num"];

                    //司机信息
                    $driver=M("Driver")->find($travels[$i]["driver_id"]);
                    $travels[$i]["driver_name"]=$driver["driver_name"];

                }

                $this->assign("travels",$travels);
            }




        }


        $this->assign("startTime",$startTime);
        $this->assign("endTime",$endTime);


        $this->display();
    }


    public function byUser(){
        $startTime=date('Y-m-01', strtotime(date("Y-m-d")));
        $endTime=date('Y-m-d', strtotime(date("Y-m-d")));

        //获取所有单位
        $usersall=M("User")->where("is_del=0")->select();
        $this->assign("usersall",$usersall);

        if(empty($_POST)){
            $this->assign("aa","0");
        }else{
            //如果发送数据过来了
            $this->assign("type",$_POST["type"]);

            //获取开始时间
            if(!empty($_POST["startTime"])){
                $startTime=$_POST["startTime"];
                $map['departure_time']  = array('gt',strtotime($_POST["startTime"]));
            }

            if(!empty($_POST["endTime"])){
                $endTime=$_POST["endTime"];
                $map['departure_time']  = array('elt',strtotime($_POST["endTime"])+24*3600);
            }
            if((!empty($_POST["startTime"]))&&!empty($_POST["endTime"])){

                $startTime=$_POST["startTime"];
                $endTime=$_POST["endTime"];

                $map['departure_time']  = array('between',array(strtotime($_POST["startTime"]),strtotime($_POST["endTime"])+24*3600));
            }
            if($_POST["user"]!=0){
                $mapc["id"]=$_POST["user"];
                $this->assign("username",$_POST["user"]);
            }


            $mapc["is_del"]=0;



            $this->assign("aa","1");



            if($_POST["type"]==1){
                $users=M("User")->where($mapc)->select();


                $hj=array(
                    "finishCount"=>0,
                    "companyMileageCount"=>0,
                    "luqiaoCount"=>0,
                    "fuwufeiCount"=>0,
                    "buzhuCount"=>0,
                    "qitaCount"=>0,
                    "heji"=>0
                );

                for($i=0;$i<count($users)&&count($users)!=0;$i++){
                    $map['use_user_id']  = array('eq',$users[$i]["id"]);

                    $travelM=new TravelModel();
                    $users[$i]["finishCount"]=$travelM->where($map)->where(array("state"=>"9"))->count();
                    $users[$i]["companyMileageCount"]=$travelM->where($map)->where(array("state"=>"9"))->sum("mileage");//该单位所有出行费用之和
                    if(empty($users[$i]["companyMileageCount"])){$users[$i]["companyMileageCount"]=0;}


                    $users[$i]["luqiaoCount"]=$travelM->where($map)->where(array("state"=>"9"))->sum("fees_sum");//该单位所有出行费用之和
                    if(empty($users[$i]["luqiaoCount"])){$users[$i]["luqiaoCount"]=0;}

                    $users[$i]["fuwufeiCount"]=$travelM->where($map)->where(array("state"=>"9"))->sum("service_charge");//该单位所有出行费用之和
                    if(empty($users[$i]["fuwufeiCount"])){$users[$i]["fuwufeiCount"]=0;}

                    $users[$i]["buzhuCount"]=$travelM->where($map)->where(array("state"=>"9"))->sum("driver_bt_cost");


                    $users[$i]["qitaCount"]=$travelM->where($map)->where(array("state"=>"9"))->sum("parking_rate_sum")+$travelM->where($map)->where(array("state"=>"9"))->sum("driver_cost")+$travelM->where($map)->where(array("state"=>"9"))->sum("over_time_cost")+$travelM->where($map)->where(array("state"=>"9"))->sum("over_mileage_cost")+$travelM->where($map)->where(array("state"=>"9"))->sum("else_cost");//该单位所有出行费用之和

                    $users[$i]["heji"]=$users[$i]["luqiaoCount"]+$users[$i]["fuwufeiCount"]+$users[$i]["buzhuCount"]+$users[$i]["qitaCount"];


                    $hj["finishCount"]+=$users[$i]["finishCount"];
                    $hj["companyMileageCount"]+=$users[$i]["companyMileageCount"];
                    $hj["luqiaoCount"]+=$users[$i]["luqiaoCount"];
                    $hj["fuwufeiCount"]+=$users[$i]["fuwufeiCount"];
                    $hj["buzhuCount"]+=$users[$i]["buzhuCount"];
                    $hj["qitaCount"]+=$users[$i]["qitaCount"];
                    $hj["heji"]+=$users[$i]["heji"];
                }
                $this->assign("hj",$hj);
                $this->assign("users",$users);
            }



            if($_POST["type"]==2){
                if($_POST["user"]==0){
                    $map["state"]=9;
                }else{
                    $map["use_user_id"]=$_POST["user"];
                    $map["state"]=9;
                }
                $travels=M("Travel")->where($map)->select();


                for($i=0;$i<count($travels)&&count($travels)!=0;$i++){
                    //获取用车人信息
                    $user=M("User")->find($travels[$i]["use_user_id"]);
                    $travels[$i]["user_name"]=$user["user_name"];
                    $travels[$i]["user_phone"]=$user["user_phone"];

                    //单位信息
                    $companyyy=M("Company")->find($travels[$i]["company_id"]);
                    $travels[$i]["company_namee"]=$companyyy["company_name"];

                    //车辆信息
                    $car=M("Car")->find($travels[$i]["car_id"]);
                    $travels[$i]["car_num"]=$car["car_num"];

                    //司机信息
                    $driver=M("Driver")->find($travels[$i]["driver_id"]);
                    $travels[$i]["driver_name"]=$driver["driver_name"];

                }

                $this->assign("travels",$travels);
            }




        }


        $this->assign("startTime",$startTime);
        $this->assign("endTime",$endTime);


        $this->display();
    }







}
