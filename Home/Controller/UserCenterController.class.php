<?php
/**
 * Created by PhpStorm.
 * User: MrQ
 * Date: 2018/5/28
 * Time: 14:07
 */

namespace Home\Controller;


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
use Model\UrlModel;
use Model\CostInsuranceModel;

class UserCenterController extends CommonController
{
    public function changeInfo(){
        $user_id=session("user_id");
        $user=M("User")->find($user_id);
        $this->assign("user",$user);

        $company=M("Company")->find($user["user_company"]);
        $this->assign("company",$company);

        $this->display();
    }

    public function changeInfoDo(){
        if(M("User")->save($_POST)){
            $this->ajaxReturn(array("code"=>1));
        }else{
            $this->ajaxReturn(array("code"=>0));
        }
    }

    public function changePwdDo(){
        //先验证原密码是否正确
        $user_id=session("user_id");
        $user=M("User")->find($user_id);

        if($user["user_pwd"]==md5(md5($_POST["old_pwd"]).md5($_POST["old_pwd"]))){
            //验证通过了
            $user["user_pwd"]=md5(md5($_POST["new_pwd"]).md5($_POST["new_pwd"]));
            if(M("User")->save($user)){
                session('user_id',null);
                session('user_company',null);
                session('user_phone',null);
                session('last_access',null);
                session('company_name',null);

                $this->ajaxReturn(array("code"=>1));
            }else{
                $this->ajaxReturn(array("code"=>0));
            }
        }else{
            $this->ajaxReturn(array("code"=>0));
        }
    }

    public function getNoreadMessage(){
        $user_id=session("user_id");

        $resCount=M("Message")->where(array("to_user_id"=>$user_id,"is_read"=>0))->order("creat_time desc")->count();

        $res=M("Message")->where(array("to_user_id"=>$user_id,"is_read"=>0))->order("creat_time desc")->limit($_POST["start"],$_POST["length"])->select();

        //返回数据
        $carTypes=array();
        $carTypes["draw"]=$_POST["draw"];
        $carTypes["recordsTotal"]=count($resCount);//总记录条数
        $carTypes["recordsFiltered"]=count($resCount);//过滤后的记录数，也就是搜索结果数据
        $carTypes["data"]=$res;

        $this->ajaxReturn($carTypes);
    }

    public function allRead(){
        $user_id=session("user_id");

        $mesages=M("Message")->where(array("to_user_id"=>$user_id,"is_read"=>0))->order("creat_time desc")->select();
        for($i=0;$i<count($mesages)&&count($mesages)!=0;$i++){
            $mesages[$i]["is_read"]=1;
            $res=M("Message")->save($mesages[$i]);
        }
        $this->ajaxReturn(array("code"=>1));
    }
}