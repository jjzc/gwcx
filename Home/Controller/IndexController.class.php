<?php
/**
 * Created by PhpStorm.
 * User: MrQ
 * Date: 2018/5/31
 * Time: 13:12
 */

namespace Home\Controller;


class IndexController extends CommonController
{
    public function index(){
        $user_id=session("user_id");
        $user_company=session("user_company");
        $user_phone=session("user_phone");
        $company_name=session("company_name");

        //查询自己是不是单位管理员
        $isManager=0;
        $company=M("Company")->find($user_company);
        if($user_id==$company["company_manager_id"]){
            $isManager=1;
        }
        $this->assign("isManager",$isManager);
        $this->assign("user_phone",$user_phone);
        $this->assign("company_name",$company_name);

        //获取我的未读消息数量
        $wdNum=M("Message")->where(array("to_user_id"=>$user_id,"is_read"=>0))->order("creat_time desc")->count();
        $this->assign("wdNum",$wdNum);
        $this->display();
    }
}
