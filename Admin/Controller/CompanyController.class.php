<?php
/**
 * Created by PhpStorm.
 * User: MrQ
 * Date: 2018/5/28
 * Time: 14:14
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


class CompanyController  extends CommonController
{
    public function allCompanys(){
        $this->display();
    }

    public function getAllCompanys(){
        $map["is_del"]=0;

        $key= trim($_POST["search"]["value"]);
        if(!empty($key)){
            $map['company_name | company_superior | company_address | company_phone '] = array('like', "%$key%");
        }

        $resCount=M("Company")->where($map)->select();

        $order=array();
        switch ($_POST["order"][0]["column"])
        {
            case 0:
                $order["company_name"]=$_POST["order"][0]["dir"];
                break;

            default:
                $order["id"]=$_POST["order"][0]["dir"];
                break;
        }

        $res=M("Company")->where($map)->order($order)->limit($_POST["start"],$_POST["length"])->select();


        for ($i = 0; $i < count($res)&&count($res)!=0; $i++) {
            //获取单位人数

            $res[$i]["user_uum"]=M("User")->where(array("user_company"=>$res[$i]["id"]))->count();

            if($res[$i]["company_manager_id"]){
                $user=M("User")->find($res[$i]["company_manager_id"]);
                $res[$i]["manager_user_name"]=$user["user_name"];
                $res[$i]["manager_user_phone"]=$user["user_phone"];

            }else{
                $res[$i]["manager_user_name"]=null;
            }

            if($res[$i]["dx_driver"]!=0){
                //获取定向司机姓名
                $driver=M("Driver")->find($res[$i]["dx_driver"]);
                $res[$i]["driver_name"]=$driver["driver_name"];
                //获取定向车辆车牌号码
                $car=M("Car")->find($res[$i]["dx_car"]);
                $res[$i]["car_num"]=$car["car_num"];
            }else{
                $res[$i]["driver_name"]=null;
                $res[$i]["car_num"]=null;
            }

        }

        //返回数据
        $companys=array();
        $companys["draw"]=$_POST["draw"];
        $companys["recordsTotal"]=count($resCount);//总记录条数
        $companys["recordsFiltered"]=count($resCount);//过滤后的记录数，也就是搜索结果数据
        $companys["data"]=$res;

        $this->ajaxReturn($companys);
    }

    public function delCompany(){
        $id=$_POST["id"];
        //删除单位
        $com["id"]=$id;
        $com["is_del"]=1;
        $res=M("Company")->save($com);

        $cominfo=M("Company")->find($id);
        A("UserCenter")->logCreatWeb("删除单位 ".$cominfo["company_name"]);
        if($res){
            //删除所有人
            $users=M("User")->where(array("user_company"=>$id,"is_del"=>0))->select();
            for ($i = 0; $i < count($users)&&count($users)!=0; $i++) {
                $users[$i]["is_del"]=1;
                M("User")->save($users[$i]);
            }
            $this->ajaxReturn(array("code"=>1));
        }else{
            $this->ajaxReturn(array("code"=>$res,"error"=>"操作失败，请重试！"));
        }
    }

    public function addCompany(){
        //获取所有司机
        $drivers=M("Driver")->where("is_del=0 and is_dx=0")->select();
        $this->assign("drivers",$drivers);

        //获取所有车辆
        $cars=M("Car")->where("is_del=0 and is_dx=0")->select();
        $this->assign("cars",$cars);

        $this->display();
    }

    public function addCompanyDo(){
        $company_model=new CompanyModel();
        $company_id=$company_model->add($_POST);
        if($company_id){
            if($_POST["dx_driver"]!=0){
                //将司机改为定向司机
                $driver["id"]=$_POST["dx_driver"];
                $driver["is_dx"]=1;
                $driver["company_id"]=$company_id;
                M("Driver")->save($driver);
                //将车辆改为定向车辆
                $car["id"]=$_POST["dx_car"];
                $car["is_dx"]=1;
                $car["company_id"]=$company_id;
                M("Car")->save($car);
            }

            //添加单位成功
            if(isset($_POST["user_phone"]) and !empty($_POST["user_name"])){
                //填写了单位管理员手机号码
                //添加用户
                $data=array();
                $data["user_name"]=$_POST["user_name"];
                $data["user_phone"]=$_POST["user_phone"];
                $data["user_pwd"]=md5(md5($_POST["user_phone"]).md5($_POST["user_phone"]));
                $data["user_company"]=$company_id;
                $data["user_state"]=1;
                $data["is_del"]=0;
                $userM=new UserModel();
                $user_id=$userM->add($data);
                if($user_id){
                    //用户新增成功
                    //修改单位，将userID填写入单位管理员
                    $com_data=array();
                    $com_data["id"]=$company_id;
                    $com_data["company_manager_id"]=$user_id;
                    if($company_model->save($com_data)){
                        A("UserCenter")->logCreatWeb("添加单位 ".$_POST["company_name"]);
                        $this->ajaxReturn(array("code"=>1));
                    }
                }
            }else{
                $this->ajaxReturn(array("code"=>0,"error"=>"操作失败，请重试！"));
            }

        }else{
            $this->ajaxReturn(array("code"=>0,"error"=>"操作失败，请重试！"));
        }
    }


    public function editCompany($id){
        //找出单位所有用户
        $users=M("User")->where(array("is_del"=>0,"user_company"=>$id))->select();
        $this->assign("users",$users);

        $company=M("Company")->find($id);
        $this->assign("company",$company);

        $drivers=M("Driver")->where("is_del=0")->select();
        $this->assign("drivers",$drivers);

        //获取所有车辆
        $cars=M("Car")->where("is_del=0")->select();
        $this->assign("cars",$cars);

        $this->display();
    }

    public function editCompanyDo(){
        $oldCompany=M("Company")->find($_POST["id"]);
        $res=M("Company")->save($_POST);
        if($res){
            //如果一开始没有绑定定向车，现在需要绑定定向车,这种情况，就直接改司机属性就好了
            if($oldCompany["dx_car"]==0&&$_POST["dx_car"]!="0"){
                $car["id"]=$_POST["dx_car"];
                $car["is_dx"]=1;
                $car["company_id"]=$_POST["id"];
                M("Car")->save($car);
            }else{
                //一开是绑定了定向车，现在需要更改，反正都要将原先的车辆性质该回去
                $car["id"]=$oldCompany["dx_car"];
                $car["is_dx"]=0;
                $car["company_id"]=0;
                M("Car")->save($car);

                //如果新绑定了车辆的话，又得将新绑定的司机
                if($_POST["dx_car"]!=0){
                    $car["id"]=$_POST["dx_car"];
                    $car["is_dx"]=1;
                    $car["company_id"]=$_POST["id"];
                    M("Car")->save($car);
                }
            }



            if($oldCompany["dx_driver"]==0&&$_POST["dx_driver"]!="0"){
                $driver["id"]=$_POST["dx_driver"];
                $driver["is_dx"]=1;
                $driver["company_id"]=$_POST["id"];
                M("Driver")->save($driver);
            }else{
                //一开是绑定了定向车，现在需要更改，反正都要将原先的车辆性质该回去
                $driver["id"]=$oldCompany["dx_driver"];
                $driver["is_dx"]=0;
                $driver["company_id"]=0;
                M("Driver")->save($driver);

                //如果新绑定了车辆的话，又得将新绑定的司机
                if($_POST["dx_driver"]!=0){
                    $driver["id"]=$_POST["dx_driver"];
                    $driver["is_dx"]=1;
                    $driver["company_id"]=$_POST["id"];
                    M("Driver")->save($driver);
                }
            }
            A("UserCenter")->logCreatWeb("修改单位 ".$_POST["company_name"]);

            $this->ajaxReturn(array("code"=>$res));
        }else{
            $this->ajaxReturn(array("code"=>$res,"error"=>"操作失败，请重试！"));
        }
    }

    public function viewCompany($id){
        $company=M("Company")->find($id);
        $this->assign("company",$company);
        $this->display();
    }

    public function recycleCompanys(){
        $this->display();
    }

    public function getRecycleCompanys(){
        $resCount=M("Company")->where("is_del=1")->select();
        $map["is_del"]=1;

        $order=array();
        switch ($_POST["order"][0]["column"])
        {
            case 0:
                $order["company_name"]=$_POST["order"][0]["dir"];
                break;
            case 1:
                $order["company_address"]=$_POST["order"][0]["dir"];
                break;
            case 2:
                $order["company_phone"]=$_POST["order"][0]["dir"];
                break;

            case 5:
                $order["company_superior"]=$_POST["order"][0]["dir"];
                break;
            default:
                $order["id"]=$_POST["order"][0]["dir"];
                break;
        }

        $res=M("Company")->where($map)->order($order)->limit($_POST["start"],$_POST["length"])->select();


        for ($i = 0; $i < count($res)&&count($res)!=0; $i++) {
            //获取单位人数

            $res[$i]["user_uum"]=M("User")->where(array("user_company"=>$res[$i]["id"]))->count();

            if($res[$i]["company_manager_id"]){
                $user=M("User")->find($res[$i]["company_manager_id"]);
                $res[$i]["manager_user_name"]=$user["user_name"];
                $res[$i]["manager_user_phone"]=$user["user_phone"];

            }else{
                $res[$i]["manager_user_name"]=null;
            }
        }

        //返回数据
        $companys=array();
        $companys["draw"]=$_POST["draw"];
        $companys["recordsTotal"]=count($resCount);//总记录条数
        $companys["recordsFiltered"]=count($resCount);//过滤后的记录数，也就是搜索结果数据
        $companys["data"]=$res;

        $this->ajaxReturn($companys);
    }


    public function allUsers(){
//        $companys=M("Company")->where("is_del=0")->select();
//        $this->assign("companys",$companys);

        $this->display();
    }

    public function getAllUsers(){

        $map["is_del"]=0;
        $key= trim($_POST["search"]["value"]);
        if(!empty($key)){
            $company_ids = M("company")->where(array("company_name"=>array("like","%$key%")))->field("id")->select();
            if($company_ids){
                $map["user_company"] = array("IN",$this->_array_column($company_ids,"id"));
            }else{
                $map['user_phone | user_sex | user_email | user_name | user_idcard'] = array('like', "%$key%");
            }
        }

        $resCount=M("User")->where($map)->select();

        $order=array();
        switch ($_POST["order"][0]["column"])
        {
            case 0:
                $order["user_phone"]=$_POST["order"][0]["dir"];
                break;
            case 1:
                $order["user_name"]=$_POST["order"][0]["dir"];
                break;
            case 2:
                $order["user_idcard"]=$_POST["order"][0]["dir"];
                break;

            case 3:
                $order["user_sex"]=$_POST["order"][0]["dir"];
                break;
            default:
                $order["id"]=$_POST["order"][0]["dir"];
                break;
        }

        $res=M("User")->where($map)->order($order)->limit($_POST["start"],$_POST["length"])->select();

        for($i=0;$i<count($res)&&count($res)!=0;$i++){
            $com=M("company")->find($res[$i]["user_company"]);
            $res[$i]["company_name"]=$com["company_name"];
        }

        $users=array();
        $users["draw"]=$_POST["draw"];
        $users["recordsTotal"]=count($resCount);//总记录条数
        $users["recordsFiltered"]=count($resCount);//过滤后的记录数，也就是搜索结果数据
        $users["data"]=$res;

        $this->ajaxReturn($users);
    }

    public function delUser(){
        $u["id"]=$_POST["id"];
        $u["is_del"]=1;
        $res=M("User")->save($u);

        if($res){
            $this->ajaxReturn(array("code"=>$res));
        }else{
            $this->ajaxReturn(array("code"=>$res,"error"=>"操作失败，请重试！"));
        }
    }

    public function addUser(){
        $companys=M("Company")->where("is_del=0")->select();
        $this->assign("companys",$companys);
        $this->display();
    }

    public function addUserDo(){
        //$_POST["user_birthday"]=strtotime($_POST["user_birthday"]);
        $_POST["user_pwd"]=md5(md5($_POST["user_pwd"]).md5($_POST["user_pwd"]));
        $_POST["user_state"]=1;

        $res=M("User")->add($_POST);

        if($res){
            $this->ajaxReturn(array("code"=>1));
        }else{
            $this->ajaxReturn(array("code"=>$res,"error"=>"操作失败，请重试！"));
        }

    }

    public function editUser($id){
        $companys=M("Company")->where("is_del=0")->select();
        $this->assign("companys",$companys);
        $user=M("User")->find($id);
        $this->assign("user",$user);
        $this->display();
    }

    public function viewUser($id){
        $companys=M("Company")->where("is_del=0")->select();
        $this->assign("companys",$companys);
        $user=M("User")->find($id);
        $this->assign("user",$user);
        $this->display();
    }

    public function editUserDo(){
        $userM=new UserModel();
        //$_POST["user_birthday"]=strtotime($_POST["user_birthday"]);

        if(!empty($_POST["user_pwd"])){
            $_POST["user_pwd"]=md5(md5($_POST["user_pwd"]).md5($_POST["user_pwd"]));
        }else{
            unset($_POST["user_pwd"]);
        }
        $res=$userM->save($_POST);

        if($res){
            $this->ajaxReturn(array("code"=>1));
        }else{
            $this->ajaxReturn(array("code"=>$res,"error"=>"操作失败，请重试！"));
        }
    }

    public function getRecycleUsers(){
        $resCount=M("User")->where("is_del=1")->select();

        $order=array();
        switch ($_POST["order"][0]["column"])
        {
            case 0:
                $order["user_phone"]=$_POST["order"][0]["dir"];
                break;
            case 1:
                $order["user_name"]=$_POST["order"][0]["dir"];
                break;
            case 2:
                $order["user_idcard"]=$_POST["order"][0]["dir"];
                break;

            case 3:
                $order["user_sex"]=$_POST["order"][0]["dir"];
                break;
            default:
                $order["id"]=$_POST["order"][0]["dir"];
                break;
        }

        $res=M("User")->where("is_del=1")->order($order)->limit($_POST["start"],$_POST["length"])->select();

        $users=array();
        $users["draw"]=$_POST["draw"];
        $users["recordsTotal"]=count($resCount);//总记录条数
        $users["recordsFiltered"]=count($resCount);//过滤后的记录数，也就是搜索结果数据
        $users["data"]=$res;

        $this->ajaxReturn($users);
    }
}