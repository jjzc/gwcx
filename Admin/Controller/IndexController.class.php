<?php
/**
 * Created by PhpStorm.
 * User: MrQ
 * Date: 2018/5/2
 * Time: 18:57
 */

namespace Admin\Controller;

class IndexController extends CommonController {
    public function index(){
        $userId=session("user_id");
        $user=M("AdminUser")->find($userId);
        $this->assign("user",$user);

        $group_id=session("group_id");
        $group=M("AdminGroup")->find($group_id);
        $this->assign("group",$group);

        //查询自己是否有出行管理权限
        //有的话，找到拥有那个链接地址的权限
        $groupArray=explode(",",$group["group_rule"]);
        $rulemap["id"]=array("in",$groupArray);

        if(in_array("1",$groupArray)){
            $isHavaCxManage="1";
            $url=M("Url")->where("pid=1")->where($rulemap)->order("id asc")->find();
            $cxUrl=$url["url"];

            $this->assign("isHavaCxManage",$isHavaCxManage);
            $this->assign("cxUrl",$cxUrl);
        }else{
            $isHavaCxManage="0";
            $this->assign("isHavaCxManage",$isHavaCxManage);
        }



        if(in_array("2",$groupArray)){
            $isHavaDwManage="1";
            $url=M("Url")->where("pid=2")->where($rulemap)->order("id asc")->find();
            $dwUrl=$url["url"];

            $this->assign("isHavaDwManage",$isHavaDwManage);
            $this->assign("dwUrl",$dwUrl);
        }else{
            $isHavaDwManage="0";
            $this->assign("isHavaDwManage",$isHavaDwManage);
        }


        if(in_array("3",$groupArray)){
            $isHavaClManage="1";
            $url=M("Url")->where("pid=3")->where($rulemap)->order("id asc")->find();
            $clUrl=$url["url"];

            $this->assign("isHavaClManage",$isHavaClManage);
            $this->assign("clUrl",$clUrl);


        }else{
            $isHavaClManage="0";
            $this->assign("isHavaClManage",$isHavaClManage);
        }


        if(in_array("4",$groupArray)){
            $isHavaSjManage="1";
            $url=M("Url")->where("pid=4")->where($rulemap)->order("id asc")->find();
            $sjUrl=$url["url"];

            $this->assign("isHavaSjManage",$isHavaSjManage);
            $this->assign("sjUrl",$sjUrl);
        }else{
            $isHavaSjManage="0";
            $this->assign("isHavaSjManage",$isHavaSjManage);
        }








        $this->display();
    }
}