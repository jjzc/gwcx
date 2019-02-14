<?php
/**
 * Created by PhpStorm.
 * User: MrQ
 * Date: 2018/5/2
 * Time: 18:51
 */

namespace Admin\Controller;
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
            $adminUserM=new AdminUserModel();
            $adminUser=$adminUserM->getByUserName($_POST["user_phone"]);

            if($adminUser){
                //验证错误次数是否为5次
                if($adminUser["error_num"]>=5){
                    $this->redirect("login",array('error' => "错误：密码错误次数超过5次，账号已冻结！"));
                }else{
                    //验证密码是否正确
                    if($adminUser["user_pwd"]==md5(md5($_POST["user_pwd"]).md5($_POST["user_pwd"]))){
                        $adminUser["error_num"]=0;
                        $adminUserM->save($adminUser);


                        //获取用户所在组别
                        $adminGroupM=new AdminGroupModel();
                        $adminGroup=$adminGroupM->find($adminUser["user_group"]);

                        //用户组别名称
                        session('user_group_name',$adminGroup["group_name"]);
                        session('group_rule',$adminGroup["group_rule"]);

                        $arr=explode(",",$adminGroup["group_rule"]);
                        session('group_rule_array',$arr);

                        session('group_id',$adminGroup["id"]);


                        //跳转至首页，写Session
                        session('user_id',$adminUser["id"]);  //设置session
                        session("last_access",time());

                        $this->redirect("Admin/Index/index");
                    }else{


                        $adminUser["error_num"]=$adminUser["error_num"]+1;
                        $adminUserM->save($adminUser);
                        $this->redirect("login",array('error' => "错误：密码错误！错误次数".$adminUser["error_num"]));
                    }
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
//        session_destroy();
        session(null);
        $this->redirect("login");
    }

    public function changePwd(){
        $this->display();
    }

    public function changePwdDo(){
        //先验证原密码是否正确
        $user_id=session("user_id");
        $user=M("AdminUser")->find($user_id);

        if($user["user_pwd"]==md5(md5($_POST["old_pwd"]).md5($_POST["old_pwd"]))){
            //验证通过了
            $user["user_pwd"]=md5(md5($_POST["new_pwd"]).md5($_POST["new_pwd"]));
            if(M("AdminUser")->save($user)){
                session('user_id',null);
                $this->ajaxReturn(array("code"=>1));
            }else{
                $this->ajaxReturn(array("code"=>0));
            }
        }else{
            $this->ajaxReturn(array("code"=>0));
        }
    }
}