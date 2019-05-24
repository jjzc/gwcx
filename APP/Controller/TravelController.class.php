<?php
namespace APP\Controller;
use Model\ArrangeTypeModel;
use Model\CarModel;
use Model\CompanyModel;
use Model\DriverModel;
use Model\MessageModel;
use Model\TravelModel;
use Model\TravelNatureModel;
use Model\TravelTypeModel;
use Model\UserModel;
use Think\Controller;
use Model\SetModel;
class TravelController extends Controller {
    public function __construct(){  
         header('Access-Control-Allow-Origin:http://wx-gwcx.99huaan.com');
    } 	
	
	
    //获取所有出行性质
    public function getAllNature(){
        $travelNatureM=new TravelNatureModel();
        $this->ajaxReturn($travelNatureM->select());
    }

    //获取所有出行方式
    public function getAllType(){
        $travel_typeM=new TravelTypeModel();
        $this->ajaxReturn($travel_typeM->select());
    }

    //获取是否有定向车辆
    public function getHaveDxCar(){
        $userId=$_POST["userId"];
        $user=M("User")->find($userId);
        $company=M("Company")->find($user["user_company"]);

        if($company["dx_car"]==0){
            $this->ajaxReturn(array("hava_dx"=>0,"company"=>$_POST["userId"]));
        }else{
            $car=M("Car")->find($company["dx_car"]);
            if($car["state"]==1){
                $this->ajaxReturn(array("hava_dx"=>1));
            }else{
                $this->ajaxReturn(array("hava_dx"=>0));
            }

        }
    }

    //获取是否有定向车辆
    public function getHaveCompanyDxCar(){
        $userId=$_POST["userId"];
        $user=M("User")->find($userId);
        $company=M("Company")->find($user["user_company"]);

        if($company["dx_car"]==0){
            $this->ajaxReturn(array("hava_dx"=>0,"company"=>$_POST["userId"]));
        }else{
            $this->ajaxReturn(array("hava_dx"=>1));
        }
    }

    public function addSupplementApi(){
        if(!empty($_POST)) {
            $user_model=new UserModel();
            $user = $user_model->find($_POST["user_id"]);

            $travel_typeM = M("TravelType");
            $travel_type = $travel_typeM->find($_POST["travel_type_id"]);


            //验证是否使用了定向车辆
            if ($_POST["is_dx"] == 1) {
                $company = M("Company")->find($user["user_company"]);
                $_POST["car_id"] = $company["dx_car"];
                $_POST["driver_id"] = $company["dx_driver"];
            }


            $_POST["is_arrange_car"] = $travel_type["is_arrange_car"];
            $_POST["is_need_manage_review"] = $travel_type["is_need_manage_review"];
            $_POST["is_need_center_review"] = $travel_type["is_need_center_review"];
            $_POST["is_need_receipt"] = $travel_type["is_need_receipt"];
            $_POST["is_need_evaluate"] = $travel_type["is_need_evaluate"];
            $_POST["is_need_sendcar_review"] = $travel_type["is_need_sendcar_review"];

            $_POST["is_need_settlement"] = $travel_type["is_need_settlement"];
            if ($_POST["is_need_settlement"] == 1) {
                $_POST["is_settlemented"] = 0;
            }


            $_POST["departure_time"] = strtotime($_POST["departure_time"]);    //转换成时间戳格式
            $_POST["start_car_time"] = strtotime($_POST["start_car_time"]);    //转换成时间戳格式
            $_POST["end_use_car_time"] = strtotime($_POST["end_use_car_time"]); //转换成时间戳格式


            $_POST["sign_time"] = time();
            $_POST["state"] = 9;


            $_POST["user_name"] = $user["user_name"];

            $_POST["company_id"] = $user["user_company"];
            $_POST["totle_rate"] = $_POST["fees_sum"] + $_POST["parking_rate_sum"] + $_POST["service_charge"] + $_POST["driver_cost"] + $_POST["over_time_cost"] + $_POST["over_mileage_cost"] + $_POST["else_cost"];
            $res = M("Supplement")->add($_POST);
            if ($res) {
                $this->ajaxReturn(array("code" => 1));
            } else {
                $this->ajaxReturn(array("code" => 0));
            }
        }else{
            $this->ajaxReturn(array("code" => 0));
        }
    }


    //申请出行
    public function addTravel(){
        if(!empty($_POST)){

            $userM=new UserModel();
            $user=$userM->find($_POST["user_id"]);

            //获取txt文件内的内容
            //$mycontent = file_get_contents("lsh.txt");

            //如果是当天的流水号，则直接使用
            $set=D("set")->find(1);

            $mycontent = $set["serial_number"];
            $nowdata=date("Ymd",time());
            $savedata=substr($mycontent , 0 , 8);

            if($nowdata==$savedata){
                $newSerialNumber=$mycontent;
            }else{
                $newSerialNumber=$nowdata."0001";
            }

            //根据出行类型id查询出行类型信息


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
                        $_POST["state"]=7;
                    }
                }
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


            //$_POST["departure_time"]= $_POST["departure_time"];	//转换成时间戳格式



            //$_POST["user_id"]=$_POST["user_id"];

            //获取乘车人数
            $_POST["travel_people"]=str_replace("，",",",$_POST["travel_people"]);

            //$_POST["people_num"]=count(explode(',',$_POST["travel_people"]));
            $_POST["people_num"]=$_POST["people_num"];

            $_POST["sign_time"]=time();


            //获取用车人姓名

            $_POST["user_name"]=$user["user_name"];

            $_POST["company_id"]=$user["user_company"];

            //写入到数据库中
            $travelM=new TravelModel();
            if($travelM->add($_POST)){
                //保存成功
                //流水号加1
                //
                $set["serial_number"]=$newSerialNumber+1;
                D("set")->save($set);

                $this->ajaxReturn(array("code"=>1));


                //$this->redirect("myTravel");
            }else{
                $this->ajaxReturn(array("code"=>0));
                //保存失败
            }
        }
    }

    public function getAllDriver(){
        $driver=M("Driver")->where("is_del=0")->select();
        $this->ajaxReturn($driver);
    }

    public function getAllCar(){
        $driver=M("Car")->where("is_del=0")->select();
        $this->ajaxReturn($driver);
    }


    public function getMyTravels(){
        if(!empty($_POST)){

            $user_id=$_POST["userId"];
            $page=$_POST["pageIndex"];
            $pageSize=$_POST["pageSize"];

            $travelM=new TravelModel();
            //$borrow_car_model= new BorrowCarModel();
            $count_res=$travelM->where("user_id=".$user_id)->count();

            //总记录数
            $count_record=$count_res;
            $count_page=ceil($count_record/$pageSize);

            $resault=$travelM->order("id desc")->where("user_id=".$user_id)->limit($page*$pageSize,$pageSize)->select();

            $travelTypeM=new TravelTypeModel();
            $carM=new CarModel();
            $driverM=new DriverModel();
            for($i=0;$i<count($resault)&&count($resault)!=0;$i++){
                //通过出行类型ID查询出行类型名称
                $travelType=$travelTypeM->find($resault[$i]["travel_type_id"]);
                $resault[$i]["travel_type_name"]=$travelType["travel_name"];

                //通过车辆id返回车牌号
                if(!empty($resault[$i]["car_id"])){
                    $car=$carM->find($resault[$i]["car_id"]);
                    $resault[$i]["car_num"]=$car["car_num"];
                }

                //通过司机id返回司机姓名与手机号码
                if(!empty($resault[$i]["driver_id"])){
                    $driver=$driverM->find($resault[$i]["driver_id"]);
                    $resault[$i]["driver_name"]=$driver["driver_name"];
                }
            }

            $res=array(
                "last"=>false,
                "content"=>$resault
            );

            if(($page+1)==$count_page){
                $res["last"]=true;
            }

            //echo(json_encode($res));
            $this->ajaxReturn($res);


        }else{
            return null;
        }
    }

    public function getMySupplement(){
        if(!empty($_POST)){

            $user_id=$_POST["userId"];
            $page=$_POST["pageIndex"];
            $pageSize=$_POST["pageSize"];

            $travelM=M("Supplement");
            //$borrow_car_model= new BorrowCarModel();
            $count_res=$travelM->where("user_id=".$user_id)->count();

            //总记录数
            $count_record=$count_res;
            $count_page=ceil($count_record/$pageSize);

            $resault=$travelM->order("id desc")->where("user_id=".$user_id)->limit($page*$pageSize,$pageSize)->select();

            $travelTypeM=new TravelTypeModel();
            $carM=new CarModel();
            $driverM=new DriverModel();
            for($i=0;$i<count($resault)&&count($resault)!=0;$i++){
                //通过出行类型ID查询出行类型名称
                $travelType=$travelTypeM->find($resault[$i]["travel_type_id"]);
                $resault[$i]["travel_type_name"]=$travelType["travel_name"];

                //通过车辆id返回车牌号
                if(!empty($resault[$i]["car_id"])){
                    $car=$carM->find($resault[$i]["car_id"]);
                    $resault[$i]["car_num"]=$car["car_num"];
                }

                //通过司机id返回司机姓名与手机号码
                if(!empty($resault[$i]["driver_id"])){
                    $driver=$driverM->find($resault[$i]["driver_id"]);
                    $resault[$i]["driver_name"]=$driver["driver_name"];
                }
            }

            $res=array(
                "last"=>false,
                "content"=>$resault
            );

            if(($page+1)==$count_page){
                $res["last"]=true;
            }

            //echo(json_encode($res));
            $this->ajaxReturn($res);


        }else{
            return null;
        }
    }

    //获取单位出行数据
    public function getCompanyTravels(){
        if(!empty($_POST)){

            $companyId=$_POST["companyId"];
            $page=$_POST["pageIndex"];
            $pageSize=$_POST["pageSize"];

            $travelM=new TravelModel();
            //$borrow_car_model= new BorrowCarModel();
            $count_res=$travelM->where("company_id=".$companyId)->count();

            //总记录数
            $count_record=$count_res;
            $count_page=ceil($count_record/$pageSize);

            $resault=$travelM->order("id desc")->where("company_id=".$companyId)->limit($page*$pageSize,$pageSize)->select();

            $travelTypeM=new TravelTypeModel();
            $carM=new CarModel();
            $driverM=new DriverModel();
            for($i=0;$i<count($resault)&&count($resault)!=0;$i++){
                //通过出行类型ID查询出行类型名称
                $travelType=$travelTypeM->find($resault[$i]["travel_type_id"]);
                $resault[$i]["travel_type_name"]=$travelType["travel_name"];

                //通过车辆id返回车牌号
                if(!empty($resault[$i]["car_id"])){
                    $car=$carM->find($resault[$i]["car_id"]);
                    $resault[$i]["car_num"]=$car["car_num"];
                }

                //通过司机id返回司机姓名与手机号码
                if(!empty($resault[$i]["driver_id"])){
                    $driver=$driverM->find($resault[$i]["driver_id"]);
                    $resault[$i]["driver_name"]=$driver["driver_name"];
                }
            }

            $res=array(
                "last"=>false,
                "content"=>$resault
            );

            if(($page+1)==$count_page){
                $res["last"]=true;
            }

            //echo(json_encode($res));
            $this->ajaxReturn($res);


        }else{
            return null;
        }
    }

    //通过单位ID查询该单位的待审核申请
    public function getCompanyReview2(){
        if(empty($_POST["companyId"])){
            return null;
        }

        if(!empty($_POST)){



            $companyId=$_POST["companyId"];

            $page=$_POST["page"];
            $pageSize=$_POST["pageSize"];

            $travelM=new TravelModel();
            //$borrow_car_model= new BorrowCarModel();
            $count_res=$travelM->where(array("company_id"=>$companyId,"state"=>0))->count();

            //总记录数
            $count_record=$count_res;
            $count_page=ceil($count_record/$pageSize);

            $resault=$travelM->order("id desc")->where(array("company_id"=>$companyId,"state"=>0))->limit($page*$pageSize,$pageSize)->select();

            $travelTypeM=new TravelTypeModel();
            $carM=new CarModel();
            $driverM=new DriverModel();
            for($i=0;$i<count($resault)&&count($resault)!=0;$i++){
                //通过出行类型ID查询出行类型名称
                $travelType=$travelTypeM->find($resault[$i]["travel_type_id"]);
                $resault[$i]["travel_type_name"]=$travelType["travel_name"];

//                //通过车辆id返回车牌号
//                if(!empty($resault[$i]["car_id"])){
//                    $car=$carM->find($resault[$i]["car_id"]);
//                    $resault[$i]["car_num"]=$car["car_num"];
//                }
//
//                //通过司机id返回司机姓名与手机号码
//                if(!empty($resault[$i]["driver_id"])){
//                    $driver=$driverM->find($resault[$i]["driver_id"]);
//                    $resault[$i]["driver_name"]=$driver["driver_name"];
//                }
            }

            $res=array(
                "last"=>false,
                "content"=>$resault
            );

            if(($page+1)==$count_page){
                $res["last"]=true;
            }

            $this->ajaxReturn($res);


        }else{
            return null;
        }
    }

    //查询单位待审核申请
    public function getCompanyReview(){
        $companyId=$_POST["companyId"];
        $travelM=new TravelModel();

        $resault=$travelM->order("id desc")->where(array("company_id"=>$companyId,"state"=>0))->select();

        $this->ajaxReturn($resault);
    }

    //单位同意出行申请
    public function agreeCompanyReview(){
        if(!empty($_POST)){
            if(empty($_POST["id"])){
                return null;
            }else{
                $travelM=new TravelModel();
                $travel=$travelM->find($_POST["id"]);

                if($travel["is_need_center_review"]==1){
                    $travel["state"]=1;
                }else{
                    if($travel["is_arrange_car"]==1){
                        $travel["state"]=3;
                    }else{
                        $travel["state"]=9;
                    }
                }

//                $travel["state"]=1;
                $travel["manage_res"]=1;
                $travel["manage_time"]=time();
                $travelM->save($travel);


                $data=array(
                    "to_user_id"=>$travel["user_id"],
                    "title"=>"出行申请单位审核通过",
                    "content"=>"恭喜您，您的出行申请单位管理员审核通过，通过时间为".date("Y-m-d H:i:s",time()),
                    "creat_time"=>time(),
                    "is_read"=>0
                );
                $messageM=new MessageModel();
                $messageM->add($data);


                //推送消息给用户
                R('Push/sendMessage',array('user',$travel["user_id"],"恭喜您，您的出行申请单位管理员审核通过，通过时间为".date("Y-m-d H:i:s",time()),"出行申请单位审核通过"));


                $this->ajaxReturn(array("code"=>1));


            }
        }
    }

    //单位驳回
    public function disagreeCompanyReview(){
        if(!empty($_POST)){
            if(empty($_POST["id"])){
                return null;
            }else{
                $travelM=new TravelModel();
                $travel=$travelM->find($_POST["id"]);

                $travel["state"]=2;
                $travel["manage_res"]=0;
                $travel["manage_time"]=time();
                $travel["manage_error_msg"]=$_POST["errorMsg"];
                $travelM->save($travel);


                $data=array(
                    "to_user_id"=>$travel["user_id"],
                    "title"=>"出行申请单位审核驳回",
                    "content"=>"对不起，您的出行申请单位管理员审核驳回，驳回时间为".date("Y-m-d H:i:s",time()),
                    "creat_time"=>time(),
                    "is_read"=>0
                );
                $messageM=new MessageModel();
                $messageM->add($data);

                //推送消息给用户
                R('Push/sendMessage',array('user',$travel["user_id"],"对不起，您的出行申请单位管理员审核驳回，驳回时间为".date("Y-m-d H:i:s",time()),"出行申请单位审核驳回"));

                $this->ajaxReturn(array("code"=>1));


            }
        }
    }

    //获取是否有待审核出行
    public function getConpanyReview(){
        if(empty($_POST["companyId"])){
            return null;
        }

        if(!empty($_POST)){
            $companyId=$_POST["companyId"];

            $travelM=new TravelModel();

            $count_res=$travelM->where(array("company_id"=>$companyId,"state"=>0))->count();

            //总记录数
            $count_record=$count_res;





            $this->ajaxReturn(array("count"=>$count_record));


        }else{
            return null;
        }
    }


    //获取出行详情
    public function getTravelDetail(){
        $travelM=new TravelModel();

        $travel=$travelM->find($_POST["travelId"]);

        $res=array(
            "travel"=>$travel
        );

        //申请人个人信息
        $userM=new UserModel();
        $user=$userM->find($travel["user_id"]);
        $this->assign("user",$user);

        //申请人公司信息
        $companyM=new CompanyModel();
        $company=$companyM->find($user["user_company"]);
        $res["company"]=$company;//返回申请人单位信息


        //出行类型信息
        $travelTypeM=new TravelTypeModel();
        $travel_type=$travelTypeM->find($travel["travel_type_id"]);
        $res["travel_type"]=$travel_type;//返回出行类型信息



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

                    $res["arrange_type"]=$arrange_type;//返回第三方出行单位信息
                }else{
                    $is_owner=true;
                    //返回司机信息
                    $driverM=new DriverModel();
                    $driver=$driverM->find($travel["driver_id"]);
                    $res["driver"]=$driver;//返回司机信息

                    //返回车辆信息
                    $carM=new CarModel();
                    $car=$carM->find($travel["car_id"]);
                    $res["car"]=$car;//返回车辆信息

                }



            }
        }

        $res["had_send_car"]=$had_send_car;//返回是否已经派车
        $res["is_owner"]=$is_owner;//返回是否是使用自有车辆
        $this->ajaxReturn($res);
    }


    //获取所有出行
    public function getAllTravels(){
        if(!empty($_POST)){

            $page=$_POST["pageIndex"];
            $pageSize=$_POST["pageSize"];

            $travelM=new TravelModel();
            //$borrow_car_model= new BorrowCarModel();
            $count_res=$travelM->count();

            //总记录数
            $count_record=$count_res;
            $count_page=ceil($count_record/$pageSize);

            $resault=$travelM->order("id desc")->limit($page*$pageSize,$pageSize)->select();

            $travelTypeM=new TravelTypeModel();
            $carM=new CarModel();
            $driverM=new DriverModel();
            for($i=0;$i<count($resault)&&count($resault)!=0;$i++){
                //通过出行类型ID查询出行类型名称
                $travelType=$travelTypeM->find($resault[$i]["travel_type_id"]);
                $resault[$i]["travel_type_name"]=$travelType["travel_name"];

                //通过车辆id返回车牌号
                if(!empty($resault[$i]["car_id"])){
                    $car=$carM->find($resault[$i]["car_id"]);
                    $resault[$i]["car_num"]=$car["car_num"];
                }

                //通过司机id返回司机姓名与手机号码
                if(!empty($resault[$i]["driver_id"])){
                    $driver=$driverM->find($resault[$i]["driver_id"]);
                    $resault[$i]["driver_name"]=$driver["driver_name"];
                }
            }

            $res=array(
                "last"=>false,
                "content"=>$resault
            );

            if(($page+1)==$count_page){
                $res["last"]=true;
            }

            //echo(json_encode($res));
            $this->ajaxReturn($res);


        }else{
            return null;
        }
    }

    //出行评价
    public function evaluate(){
        if(!empty($_POST)){
            if(empty($_POST["travelId"])){
                return null;
            }else{
                $travelM=new TravelModel();
                $travel=$travelM->find($_POST["travelId"]);

                $travel["evaluate"]=$_POST["txt"];
                $travel["attitude"]=$_POST["starIndex"];

                if($travelM->save($travel)){
                    $this->ajaxReturn(array("code"=>1));
                }else{
                    $this->ajaxReturn(array("code"=>0));
                }




            }
        }
    }

    //根据出行ID获取司机终端名称
    public function getEntityName(){
        if(!empty($_POST["travelId"])){
            $travelM=new TravelModel();
            $travel=$travelM->find($_POST["travelId"]);

            $driverM=new DriverModel();
            $driver=$driverM->find($travel["driver_id"]);

            //查询设置
            $setM=new SetModel();
            $set=$setM->find(1);

            $carM=M("car");
            $car=$carM->find($travel["car_id"]);

            if($set["is_use_gps"]==1&&isset($car["imei"])){
                $this->ajaxReturn(array("entity_name"=>$car["imei"]));
            }else{
                $this->ajaxReturn(array("entity_name"=>$driver["entity_name"]));
            }

            //$this->ajaxReturn($driver);
            
        }else{
            return null;
        }
    }


    /*
     * 玖玖平台派车接口
     */
    public function sendCarJj($orderId="",$driverName="",$driverPhone="",$carNum=""){
        $ip=get_client_ip();
        //判断IP地址是什么

        if($orderId==""||$driverName==""||$driverPhone==""||$carNum==""){
            $this->ajaxReturn(array("code"=>"300","messag"=>"fail"));
        }else{
            $travel=M("Travel")->where(array("jj_id"=>$orderId))->find();
            if($travel) {

                $travel["jj_driver_name"] = $driverName;
                $travel["jj_driver_phone"] = $driverPhone;
                $travel["jj_car_num"] = $carNum;

                $res = M("Travel")->save($travel);
                if ($res) {
                    $this->ajaxReturn(array("code" => "200", "messag" => "success"));
                } else {
                    $this->ajaxReturn(array("code" => "500", "messag" => "fail"));
                }
            }else{
                $this->ajaxReturn(array("code"=>"500","messag"=>"fail"));
            }
        }
    }


    public function finishTravelJj($id_order,$order_distance,$finishTime,$order_total){
        if($id_order==""||$order_distance==""||$finishTime==""||$order_total==""){
            $this->ajaxReturn(array("code"=>"300","messag"=>"fail"));
        }else {

            $travel = M("Travel")->where(array("jj_id" => $id_order))->find();
            if ($travel) {
                $travel["state"] = 9;
                $travel["service_charge"] = $order_total;

                $travel["totle_rate"] = $order_total;

                $travel["fees_sum"] = 0;
                $travel["parking_rate_sum"] = 0;
                $travel["driver_cost"] = 0;
                $travel["over_time_cost"] = 0;
                $travel["over_mileage_cost"] = 0;
                $travel["else_cost"] = 0;

                $travel["finish_time"] = $finishTime;
                $travel["mileage"] = $order_distance;

                $res = M("Travel")->save($travel);
                if ($res) {
                    $this->ajaxReturn(array("code" => "200", "messag" => "success"));
                } else {
                    $this->ajaxReturn(array("code" => "500", "messag" => "fail"));
                }
            } else {
                $this->ajaxReturn(array("code" => "500", "messag" => "fail"));
            }
        }
    }

}