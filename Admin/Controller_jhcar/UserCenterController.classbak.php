<?php
/**
 * Created by PhpStorm.
 * User: MrQ
 * Date: 2018/5/28
 * Time: 14:07
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
use Model\UrlModel;
use Model\CostInsuranceModel;

class UserCenterController extends CommonController
{
    /*
     * 用户列表
     */
    public function userList(){
        $this->display();
    }

    public function getUserList(){
        $resCount=M("AdminUser")->select();

        $map=array();
        $map["is_del"]=0;
        $key= $_POST["search"]["value"];
        if(!empty($key)){
            $map['user_name'] = array('like', "%$key%");
        }
        $order=array();
        switch ($_POST["order"][0]["column"])
        {
            case 0:
                $order["user_name"]=$_POST["order"][0]["dir"];
                break;
        }

        $res=M("AdminUser")->where($map)->order($order)->limit($_POST["start"],$_POST["length"])->select();

        for($i=0;$i<count($res)&& count($res);$i++){
            $userGroup=M("AdminGroup")->find($res[$i]["user_group"]);
            $res[$i]["group_name"]=$userGroup["group_name"];
        }

        //返回数据
        $data=array();
        $data["draw"]=$_POST["draw"];
        $data["recordsTotal"]=count($resCount);//总记录条数
        $data["recordsFiltered"]=count($resCount);//过滤后的记录数，也就是搜索结果数据
        $data["data"]=$res;

        $this->ajaxReturn($data);
    }

    public function delUser(){
        $user["id"]=$_POST["id"];
        $user["is_del"]=1;

        if(M("AdminUser")->save($user)){
            $this->ajaxReturn(array("code"=>1));
        }else{
            $this->ajaxReturn(array("code"=>0));
        }
    }

    public function addUser(){
        $groups=M("AdminGroup")->select();
        $this->assign("groups",$groups);

        $this->display();
    }

    public function addUserDo(){
        //先检测账号是否存在
        $map["user_name"]=$_POST["user_name"];
        $user=M("AdminUser")->where($map)->select();
        if($user){
            $this->ajaxReturn(array("code"=>0));
        }else{
            $_POST["user_pwd"]=md5(md5($_POST["user_pwd"]).md5($_POST["user_pwd"]));
            if(M("AdminUser")->add($_POST)){
                $this->ajaxReturn(array("code"=>1));
            }else{
                $this->ajaxReturn(array("code"=>0));
            }

        }
    }

    public function editUser($id){
        $groups=M("AdminGroup")->select();
        $this->assign("groups",$groups);

        $user=M("AdminUser")->find($id);
        $this->assign("user",$user);

        $this->display();
    }

    public function editUserDo(){
        if(empty($_POST["user_pwd"])){
            unset($_POST["user_pwd"]);
        }else{
            $_POST["user_pwd"]=md5(md5($_POST["user_pwd"]).md5($_POST["user_pwd"]));
						$_POST["error_num"]=0;
        }

        if(M("AdminUser")->save($_POST)){
            $this->ajaxReturn(array("code"=>1));
        }else{
            $this->ajaxReturn(array("code"=>0));
        }
    }


    public function getGroupList(){
        $resCount=M("AdminGroup")->select();

        $map=array();
        $key= $_POST["search"]["value"];
        if(!empty($key)){
            $map['group_name'] = array('like', "%$key%");
        }
        $order=array();
        switch ($_POST["order"][0]["column"])
        {
            case 0:
                $order["group_name"]=$_POST["order"][0]["dir"];
                break;
        }

        $res=M("AdminGroup")->where($map)->order($order)->limit($_POST["start"],$_POST["length"])->select();


        //返回数据
        $data=array();
        $data["draw"]=$_POST["draw"];
        $data["recordsTotal"]=count($resCount);//总记录条数
        $data["recordsFiltered"]=count($resCount);//过滤后的记录数，也就是搜索结果数据
        $data["data"]=$res;

        $this->ajaxReturn($data);
    }

    public function addGroup(){

        $urls=M("Url")->select();

        $res=array();
        for($index=0;$index<count($urls)&&count($urls)!=0;$index++){
            $res[$index]["id"]=$urls[$index]["id"];
            $res[$index]["pId"]=$urls[$index]["pid"];
            $res[$index]["name"]=$urls[$index]["name"];
        }
        $this->assign("roles",json_encode($res));

        $this->display();
    }

    public function addGroupDo(){
        $res=M("AdminGroup")->add($_POST);
        if($res){
            $this->ajaxReturn(array("code"=>1));
        }else{
            $this->ajaxReturn(array("code"=>0));
        }
    }

    public function editGroup($id){
        $group=M("AdminGroup")->find($id);

        $ids=explode(",",$group["group_rule"]);

        $urls=M("Url")->select();

        $res=array();
        for($index=0;$index<count($urls)&&count($urls)!=0;$index++){
            $res[$index]["id"]=$urls[$index]["id"];
            $res[$index]["pId"]=$urls[$index]["pid"];
            $res[$index]["name"]=$urls[$index]["name"];
            if(in_array($urls[$index]["id"],$ids)){
                $res[$index]["checked"]=true;
            }
        }
        $this->assign("roles",json_encode($res));
        $this->assign("group",$group);

        $this->display();
    }

    public function editGroupDo(){
        $res=M("AdminGroup")->save($_POST);
        if($res){
            $this->ajaxReturn(array("code"=>1));
        }else{
            $this->ajaxReturn(array("code"=>0));
        }
    }

    public function getGroupTree(){
        $urlM=M("Url");
        //获取树形菜单
        $res=$this->getGroupTreeArray(0,$urlM);

        $this->ajaxReturn($res);
    }
    protected function getGroupTreeArray($pid,$urlM){
        $tree=array();
        //查询子栏目
        $urls=$urlM->where(array("pid"=>$pid))->select();

        for($index=0;$index<count($urls)&&count($urls)!=0;$index++){

            //查询是否有子类
            $urlschilds=$urlM->where(array("pid"=>$urls[$index]["id"]))->count();
            if($urlschilds>0){
                $temp=array(
                    "id" => $urls[$index]["id"],
                    "text" => $urls[$index]["name"],
                    "icon" => "fa fa-folder icon-lg icon-state-success",
                    "children" => $this->getGroupTreeArray($urls[$index]["id"],$urlM),
                    "type" => "root"
                );
                array_push($tree,$temp);

                //$tree=array_merge($tree,$this->allCategoryGetData($categorys[$index]["id"],$CategoryM));
            }else{
                $temp=array(
                    "id" => $urls[$index]["id"],
                    "text" => $urls[$index]["name"],
                    "icon" => "fa fa-folder icon-lg icon-state-success",
                    "children" => false,
                    "type" => "root"
                );
                array_push($tree,$temp);
            }
        }
        return $tree;
    }



    /*
     * 写入Log日志
     */
    public function log(){

    }
}