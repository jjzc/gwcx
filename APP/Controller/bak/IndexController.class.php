<?php
namespace APP\Controller;
use Model\UserModel;
use Think\Controller;
class IndexController extends Controller {
    public function test(){
        $userM=new UserModel();
        $user=$userM->find(955);
        $this->ajaxReturn($user);
    }
}