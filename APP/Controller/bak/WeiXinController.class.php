<?php
namespace APP\Controller;
use Model\CompanyModel;
use Model\UserModel;
use Think\Controller;
class WeiXinController extends Controller {
	public function __construct(){  
        header('Access-Control-Allow-Origin:http://wx-gwcx.99huaan.com');
    }		
 
   //获取区域公司所有关注公众号的管理人员
    public function getAdminUserList(){
		$userM=new userModel();
        $user=$userM->where("length(openid)>0")->join('ot_admin_user ON ot_user.user_phone = ot_admin_user.user_name')->select();
		$this->ajaxReturn($user);
    }
	
	
	//根据id获取人员信息
    public function getUserInfo(){
		$userId=$_POST["userId"];
		$userM=new userModel();
        $user=$userM->where("id=$userId")->select();
		$this->ajaxReturn($user);
    }
 
}