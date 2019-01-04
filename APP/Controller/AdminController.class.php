<?php
namespace APP\Controller;
use Model\AdminGroupModel;
use Model\AdminUserModel;
use Model\ArrangeTypeModel;
use Model\CarModel;
use Model\CompanyModel;
use Model\UserModel;
use Model\DriverModel;
use Model\MessageModel;
use Model\TravelModel;
use Model\TravelTypeModel;
use Think\Controller;

class AdminController extends Controller {

    public function __construct(){  
          header('Access-Control-Allow-Origin:http://wx-gwcx.99huaan.com');
    } 


    /**
     * 登陆控制器
     */
    public function login(){
        $userM=M("User");


        if(empty($_POST["user_phone"])){
            $this->ajaxReturn(array("code"=>-1));//错误
        }

        if(empty($_POST["user_pwd"])){
            $this->ajaxReturn(array("code"=>-1));//错误
        }

        //获取用户名
        $adminUserM=new AdminUserModel();
        $adminUser=$adminUserM->getByUserName($_POST["user_phone"]);

        if($adminUser){
            //验证错误次数是否为5次
            if($adminUser["error_num"]>=5){
                $this->ajaxReturn(array("code"=>2));//账号冻结
            }else{
                //验证密码是否正确
                if($adminUser["user_pwd"]==md5(md5($_POST["user_pwd"]).md5($_POST["user_pwd"]))){
                    $adminUser["error_num"]=0;
                    $adminUserM->save($adminUser);
                    $this->ajaxReturn(array("code"=>1,"adminUser"=>$adminUser));//登录成功

                }else{
                    $adminUser["error_num"]=$adminUser["error_num"]+1;
                    $adminUserM->save($adminUser);
                    $this->ajaxReturn(array("code"=>3));//密码错误
                    //$this->redirect("login",array('error' => "错误：密码错误！错误次数".$adminUser["error_num"]));
                }
            }
        }else{
            $this->ajaxReturn(array("code"=>4));//账号不存在
            //$this->redirect("login",array('error' => "错误：账号不存在！"));
        }
    }

    /**
     * 获取待中心审核申请
     */
    public function getCenterReview(){
        if(!empty($_POST)){

            $page=$_POST["pageIndex"];
            $pageSize=$_POST["pageSize"];

            $travelM=new TravelModel();
            //$borrow_car_model= new BorrowCarModel();
            $count_res=$travelM->where(array("state"=>1,'is_del'=>0))->select();

            //总记录数
            $count_record=count($count_res);
            $count_page=ceil($count_record/$pageSize);

            $resault=$travelM->order("id desc")->where(array("state"=>1,"is_del"=>0))->limit($page*$pageSize,$pageSize)->select();

            $travelTypeM=new TravelTypeModel();
            $carM=new CarModel();
            $driverM=new DriverModel();
            $companyM=new CompanyModel();
            $userM=new UserModel();
            for($i=0;$i<count($resault)&&count($resault)!=0;$i++){
                //通过出行类型ID查询出行类型名称
                $travelType=$travelTypeM->find($resault[$i]["travel_type_id"]);
                $resault[$i]["travel_type_name"]=$travelType["travel_name"];

                //获取申请人用户对象
                $signUser=$userM->find($resault[$i]["user_id"]);
                $resault[$i]["signUser"]=$signUser;

                //获取用车人用户对象
                $useUser=$userM->find($resault[$i]["use_user_id"]);
                $resault[$i]["useUser"]=$useUser;

                //获取申请人所在单位
                $signCompany=$companyM->find($signUser["user_company"]);
                $resault[$i]["signCompany"]=$signCompany;

                //获取用车人所在单位
                $useCompany=$companyM->find($useUser["user_company"]);
                $resault[$i]["useCompany"]=$useCompany;



            }

            $res=array(
                "last"=>false,
                "content"=>$resault
            );

            if(($page+1)==$count_page||$count_page==0){
                $res["last"]=true;
            }

            $this->ajaxReturn($res);


        }else{
            return null;
        }
    }


    //获取待派车审核
    public function getsendCarReview(){
        if(!empty($_POST)){

            $page=$_POST["pageIndex"];
            $pageSize=$_POST["pageSize"];

            $travelM=new TravelModel();
            //$borrow_car_model= new BorrowCarModel();
            $count_res=$travelM->where(array("state"=>5,'is_del'=>0))->select();

            //总记录数
            $count_record=count($count_res);
            $count_page=ceil($count_record/$pageSize);

            $resault=$travelM->order("id desc")->where(array("state"=>5,"is_del"=>0))->limit($page*$pageSize,$pageSize)->select();

            $travelTypeM=new TravelTypeModel();
            $carM=new CarModel();
            $driverM=new DriverModel();
            $companyM=new CompanyModel();
            $userM=new UserModel();
            for($i=0;$i<count($resault)&&count($resault)!=0;$i++){
                //通过出行类型ID查询出行类型名称
                $travelType=$travelTypeM->find($resault[$i]["travel_type_id"]);
                $resault[$i]["travel_type_name"]=$travelType["travel_name"];

                //获取申请人用户对象
                $signUser=$userM->find($resault[$i]["user_id"]);
                $resault[$i]["signUser"]=$signUser;

                //获取用车人用户对象
                $useUser=$userM->find($resault[$i]["use_user_id"]);
                $resault[$i]["useUser"]=$useUser;

                //获取申请人所在单位
                $signCompany=$companyM->find($signUser["user_company"]);
                $resault[$i]["signCompany"]=$signCompany;

                //获取用车人所在单位
                $useCompany=$companyM->find($useUser["user_company"]);
                $resault[$i]["useCompany"]=$useCompany;

                $car=M("Car")->find($resault[$i]["car_id"]);
                $resault[$i]["Car"]=$car;
                $Driver=M("Driver")->find($resault[$i]["driver_id"]);
                $resault[$i]["Driver"]=$Driver;



            }

            $res=array(
                "last"=>false,
                "content"=>$resault
            );

            if(($page+1)==$count_page||$count_page==0){
                $res["last"]=true;
            }

            $this->ajaxReturn($res);


        }else{
            return null;
        }
    }

    public function agreeSendCarReview(){
        if(!empty($_POST)){
            if(empty($_POST["id"])){
                return null;
            }else{

                $travelM=new TravelModel();
                $travel=$travelM->find($_POST["id"]);


                $travelType=M("TravelType")->find($travel["travel_type_id"]);

                if(isset($travel["arrange_type_id"])){
                    //这里表示采用了第三方单位车辆
                    $travel["state"]=8;
                    $travelM->save($travel);

                    R('Push/sendMessage',array('user',$travel["user_id"],"恭喜您，您的出行申请中心管理员审核通过，通过时间为".date("Y-m-d H:i:s",time()),"出行申请中心审核通过"));

                    $this->ajaxReturn(array("code"=>1));
                }else{
                    $travel["state"]=6;
                    $travelM->save($travel);

                    //将司机设置为有任务，将车辆设置为有任务
                    //锁定车辆
                    $carM=new CarModel();
                    $data=array(
                        "id"=>$travel["car_id"],
                        "state"=>3
                    );
                    $carM->save($data);


                    //锁定司机
                    $driverM=new DriverModel();
                    $data=array(
                        "id"=>$travel["driver_id"],
                        "state"=>3
                    );
                    $driverM->save($data);


                    $data=array(
                        "to_user_id"=>$travel["user_id"],
                        "title"=>"出行申请中心审核通过",
                        "content"=>"恭喜您，您的出行申请中心管理员审核通过，通过时间为".date("Y-m-d H:i:s",time()),
                        "creat_time"=>time(),
                        "is_read"=>0
                    );
                    $messageM=new MessageModel();
                    $messageM->add($data);

                    R('Push/sendMessage',array('user',$travel["user_id"],"恭喜您，您的出行申请中心管理员审核通过，通过时间为".date("Y-m-d H:i:s",time()),"出行申请中心审核通过"));

                    $this->ajaxReturn(array("code"=>1));
                }


            }
        }
    }

    public function disagreeSendCarReview(){
        if(!empty($_POST)){
            if(empty($_POST["id"])){
                return null;
            }else{
                $travelM=new TravelModel();
                $travel=$travelM->find($_POST["id"]);

                $travel["state"]=7;
                $travel["sendcar_review_res"]=0;
                $travel["sendcar_review_time"]=time();
                $travel["sendcar_review_msg"]=$_POST["errorMsg"];
                $travelM->save($travel);


                $data=array(
                    "to_user_id"=>$travel["user_id"],
                    "title"=>"出行申请中心审核驳回",
                    "content"=>"对不起，您的出行申请中心管理员审核驳回，驳回时间为".date("Y-m-d H:i:s",time()),
                    "creat_time"=>time(),
                    "is_read"=>0
                );
                $messageM=new MessageModel();
                $messageM->add($data);

                R('Push/sendMessage',array('user',$travel["user_id"],"对不起，您的出行申请中心管理员审核驳回，驳回时间为".date("Y-m-d H:i:s",time()),"出行申请中心审核驳回"));

                $this->ajaxReturn(array("code"=>1));


            }
        }
    }



    //中心审核通过
    public function agreeCenterReview(){
        if(!empty($_POST)){
            if(empty($_POST["id"])){
                return null;
            }else{

                $travelM=new TravelModel();
                $travel=$travelM->find($_POST["id"]);


                if($travel["is_dx"]==1){
                    //检查是否需要派车审核
                    if($travel["sendcar_review_res"]==1){
                        $travel["state"]=5;
                    }else{
                        $travel["state"]=6;

                        //将司机设置为有任务，将车辆设置为有任务
                        //锁定车辆
                        $carM=new CarModel();
                        $data=array(
                            "id"=>$travel["car_id"],
                            "state"=>3
                        );
                        $carM->save($data);


                        //锁定司机
                        $driverM=new DriverModel();
                        $data=array(
                            "id"=>$travel["driver_id"],
                            "state"=>3
                        );
                        $driverM->save($data);

                    }

                    $travel["center_res"]=1;
                    $travel["center_time"]=time();

                    $res=M("Travel")->save($travel);
                    if($res){
                        $this->ajaxReturn(array("code"=>1));
                    }else{
                        $this->ajaxReturn(array("code"=>0,"error"=>"操作失败"));
                    }

                }else{
                    $travel["state"]=3;
                    $travel["center_res"]=1;
                    $travel["center_time"]=time();
                    $travelM->save($travel);


                    $data=array(
                        "to_user_id"=>$travel["user_id"],
                        "title"=>"出行申请中心审核通过",
                        "content"=>"恭喜您，您的出行申请中心管理员审核通过，通过时间为".date("Y-m-d H:i:s",time()),
                        "creat_time"=>time(),
                        "is_read"=>0
                    );
                    $messageM=new MessageModel();
                    $messageM->add($data);

                    R('Push/sendMessage',array('user',$travel["user_id"],"恭喜您，您的出行申请中心管理员审核通过，通过时间为".date("Y-m-d H:i:s",time()),"出行申请中心审核通过"));

                    $this->ajaxReturn(array("code"=>1));
                }




            }
        }
    }

    //中心驳回
    public function disagreeCenterReview(){
        if(!empty($_POST)){
            if(empty($_POST["id"])){
                return null;
            }else{
                $travelM=new TravelModel();
                $travel=$travelM->find($_POST["id"]);

                $travel["state"]=4;
                $travel["center_res"]=0;
                $travel["center_time"]=time();
                $travel["center_error_msg"]=$_POST["errorMsg"];
                $travelM->save($travel);


                $data=array(
                    "to_user_id"=>$travel["user_id"],
                    "title"=>"出行申请中心审核驳回",
                    "content"=>"对不起，您的出行申请中心管理员审核驳回，驳回时间为".date("Y-m-d H:i:s",time()),
                    "creat_time"=>time(),
                    "is_read"=>0
                );
                $messageM=new MessageModel();
                $messageM->add($data);

                R('Push/sendMessage',array('user',$travel["user_id"],"对不起，您的出行申请中心管理员审核驳回，驳回时间为".date("Y-m-d H:i:s",time()),"出行申请中心审核驳回"));

                $this->ajaxReturn(array("code"=>1));


            }
        }
    }

    //获取待派车申请
    public function getWaitSendCar(){
        if(!empty($_POST)){

            $page=$_POST["page"];
            $pageSize=$_POST["pageSize"];

            $travelM=new TravelModel();
            //$borrow_car_model= new BorrowCarModel();
            $count_res=$travelM->where(array("state"=>3))->select();

            //总记录数
            $count_record=count($count_res);
            $count_page=ceil($count_record/$pageSize);

            $resault=$travelM->order("id desc")->where(array("state"=>3,"is_del"=>0))->limit($page*$pageSize,$pageSize)->select();

            $travelTypeM=new TravelTypeModel();
            $carM=new CarModel();
            $driverM=new DriverModel();
            for($i=0;$i<count($resault)&&count($resault)!=0;$i++){
                //通过出行类型ID查询出行类型名称
                $travelType=$travelTypeM->find($resault[$i]["travel_type_id"]);
                $resault[$i]["travel_type_name"]=$travelType["travel_name"];
				
				
				 //获取申请人用户对象
                $signUser=M("User")->find($resault[$i]["user_id"]);
                $resault[$i]["signUser"]=$signUser;

                //获取用车人用户对象
                $useUser=M("User")->find($resault[$i]["use_user_id"]);
                $resault[$i]["useUser"]=$useUser;

                //获取申请人所在单位
                $signCompany=M("Company")->find($signUser["user_company"]);
                $resault[$i]["signCompany"]=$signCompany;

                //获取用车人所在单位
                $useCompany=M("Company")->find($useUser["user_company"]);
                $resault[$i]["useCompany"]=$useCompany;

            }

            $res=array(
                "last"=>false,
                "content"=>$resault
            );

            if(($page+1)==$count_page||$count_page==0){
                $res["last"]=true;
            }

            $this->ajaxReturn($res);


        }else{
            return null;
        }
    }

    //获取所有第三方出行
    public function getAllArrangeType(){
        $arrangeTypeM=new ArrangeTypeModel();
        $this->ajaxReturn($arrangeTypeM->select());
    }

    //派车，派给第三方出行单位
    public function sendCarToOther(){

        $travel=M("Travel")->find($_POST["id"]);
        $travelType=M("TravelType")->find($travel["travel_type_id"]);

        $state=5;
        //如果不需要派车之后的审核，则直接将状态设置为待出车
        //如果派车之后需要审核，则直接将状态设置为待出车审核
        if($travelType["is_need_sendcar_review"]==0){
            $state=8;
        }else{
            $state=5;
        }


        $useUser=M("User")->find($travel["use_user_id"]);

        $data["id_member"]="e8b5db7e939311e8b2627cd30ab8ab74";
        $data["user_name"]="道县机关事务局";
        $data["user_mobile"]=$useUser["user_phone"];
        $data["passenger_name"]=$useUser["user_name"];
        $data["passenger_mobile"]=$useUser["user_phone"];
        $data["id_franchisee"]="2a0d0c5c3ed911e8a86d70106fb1fc52";
        $data["companyName"]="道县玖玖";
        $data["id_service_type"]="5";
        $data["carTypeId"]=$_POST["car_type"];
        $data["start_address"]=$travel["from_place"];
        $data["end_address"]=$travel["to_place"];
        $data["appointment_time"]=date('Y-m-d H:i', $travel["departure_time"]);
        $data["order_memo"]="无";




        //发送数据给创建订单服务器
        $res=httpF("http://admin.99zcx.com/order/specialCar/createByTransport","",json_encode($data),"POST");

        $res=json_decode($res,true);

        //echo $res;

        if($res["code"]="200"&&$res["data"]["success"]){
            //echo $res["data"]["orderId"];

            $travel["jj_id"]=$res["data"]["orderId"];
            //$travel["send_other_res"]="无";
            $travel["arrange_type_id"]=1;
            $travel["state"]=$state;
            $travel["send_car_time"]=time();

            $travel["is_need_settlement"]=0;//使用玖玖专车就不需要费用核算了，只有自有车辆出行才费用核算

            $re=M("Travel")->save($travel);
            if($re){
                $this->ajaxReturn(array("code"=>1));
            }else{
                $this->ajaxReturn(array("code"=>0));
            }

        }else{
            $this->ajaxReturn(array("code"=>0));
        }



    }

    //获取所有车辆，根据state
    public function getAllCar(){
        $carM=new CarModel();
        if(!empty($_POST["state"])){
            $this->ajaxReturn($carM->where(array("state"=>$_POST["state"],"is_del"=>0,"is_dx"=>0))->select());
        }else{
            $this->ajaxReturn($carM->select());
        }
    }

    //根据state获取所有司机
    public function getAllDriver(){
        $driverM=new DriverModel();
        if(!empty($_POST)){
            $this->ajaxReturn($driverM->where(array("state"=>$_POST["state"],"is_del"=>0,"is_dx"=>0))->select());
        }else{
            $this->ajaxReturn($driverM->select());
        }
    }

    //派车，派遣自有车辆
    public function sendCarOwner(){
        $data=array(
            "id"=>$_POST["id"],
            "car_id"=>$_POST["car_id"],
            "driver_id"=>$_POST["driver_id"],
            "state"=>5,
            "send_car_time"=>time()
        );
        $travelM=new TravelModel();
        if($travelM->save($data)){



            //锁定司机
            $driverM=new DriverModel();
            $driver=$driverM->find($_POST["driver_id"]);
            $driver["state"]=3;
            $driverM->save($driver);

            //锁定车辆
            $carM=new CarModel();
            $car=$carM->find($_POST["car_id"]);
            $car["state"]=3;
            $carM->save($car);

            $travel=$travelM->find($_POST["id"]);

            ///推动消息给用户
            R('Push/sendMessage',array('user',$travel["user_id"],"您的订单已经派车！派车时间".date("Y-m-d H:i:s",time()),"派车成功"));
            //推送消息给司机
            R('Push/sendMessage',array('driver',$_POST["driver_id"],"您有新的出行任务，点击查看！","有新任务"));

            //发送短信给司机与用户
            $systemC=new SystemController();

            $userM=new UserModel();
            $user=$userM->find($travel["user_id"]);


            $systemC->sendSendCarOkUser($user["user_phone"],$travel);

            if($travel["user_id"]!=$travel["use_user_id"]){
                $use_user=$userM->find($travel["use_user_id"]);
                $systemC->sendSendCarOkUser($use_user["user_phone"],$travel);
            }

            $systemC->sendSendCarOkDriver($driver["driver_phone"],$travel);


            $this->ajaxReturn(array("code"=>1));
        }else{
            $this->ajaxReturn(array("code"=>0));
        }

    }


    //获取待审核总数、待派车总数
    public function getCount(){
        $travelM=new TravelModel();

        $waitTravrels=$travelM->where("state=1 and is_del=0")->select();
        $waitNum=count($waitTravrels);

        $sendTravels=$travelM->where("state=3 and is_del=0")->select();
        $sendNum=count($sendTravels);

        $this->ajaxReturn(array("waitNum"=>$waitNum,"sendNum"=>$sendNum));
    }

    /**
     * 获取所有玖玖的车辆类型
     */
    public function getAllJjCarType(){
        $list=M("JjCarType")->select();
        $this->ajaxReturn($list);
    }
}