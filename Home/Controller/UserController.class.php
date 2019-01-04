<?php
/**
 * Created by PhpStorm.
 * User: MrQ
 * Date: 2018/5/2
 * Time: 18:51
 */

namespace Home\Controller;
use Think\Controller;
use Model\AdminGroupModel;
use Model\AdminUserModel;
use Model\CarModel;
use Model\CompanyModel;
use Model\DriverModel;
use Model\TravelModel;
use Model\UserModel;
use Model\SetModel;
use Org\Util\PhpZip;

class UserController extends Controller {
    public function login($error=""){

        if(!empty($_POST)){
            if(empty($_POST["user_phone"])){
                $this->redirect("login",array('error' => "错误：请输入账号！"));
            }

            if(empty($_POST["user_pwd"])){
                $this->redirect("login",array('error' => "错误：请输入密码！"));
            }

            //获取用户名
            $userM=new UserModel();
            $adminUser=$userM->where("is_del=0")->getByUserPhone($_POST["user_phone"]);

            if($adminUser){
                //验证密码是否正确
                if($adminUser["user_pwd"]==md5(md5($_POST["user_pwd"]).md5($_POST["user_pwd"]))){
                    //$adminUser["error_num"]=0;
                    //$userM->save($adminUser);

                    //跳转至首页，写Session
                    session('user_id',$adminUser["id"]);  //设置session
                    session('user_phone',$adminUser["user_phone"]);  //设置session
                    session('user_company',$adminUser["user_company"]);  //设置session
                    session("last_access",time());

                    $company=M("Company")->find($adminUser["user_company"]);
                    session('company_name',$company["company_name"]);

                    $this->redirect("Home/Index/index");
                }else{
                    //$adminUser["error_num"]=$adminUser["error_num"]+1;
                    //$userM->save($adminUser);
                    $this->redirect("login",array('error' => "错误：密码错误！错误次数".$adminUser["error_num"]));
                }
            }else{
                $this->redirect("login",array('error' => "错误：账号不存在！"));
            }

        }else {
            //获取网站配置信息
            $setM=new SetModel();
            $set=$setM->find(1);

            //网站设置名称写入session
            session('web_name',$set["web_name"]);
            //是否锁定车辆写入session
            session('is_lock_car',$set["is_lock_car"]);
            //是否开启导入模式
            session('is_open_manual',$set["is_open_manual"]);




            $this->assign("error",$error);

            $this->display();
        }
    }

    public function loginOut(){
        session('user_id',null);
        session('user_company',null);
        session('user_phone',null);
        session('last_access',null);
        session('company_name',null);

        $this->redirect("login");
    }
}