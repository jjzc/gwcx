<?php
namespace APP\Controller;
use Model\UserModel;
use Think\Controller;
class IndexController extends Controller {
    public function __construct(){  
          header('Access-Control-Allow-Origin:http://wx-gwcx.99huaan.com');
    } 
	
    public function test(){
        $userM=new UserModel();
        $user=$userM->find(955);
        $this->ajaxReturn($user);
    }
}