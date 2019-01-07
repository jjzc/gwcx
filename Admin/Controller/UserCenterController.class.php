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
    public function logCreatWeb($content){
        $userId = session("user_id");

        $data["user_id"]=$userId;
        $data["do_time"]=time();
        $data["content"]=$content;
        $data["type"]=1;


        $res=M("Log")->add($data);
    }

    //菜单管理
    public function menu(){

        $menu=M("Url")->select();

        $array = array();
        // 构建生成树中所需的数据
        foreach($menu as $k => $r) {
            $r['submenu'] = $r['is_menu']==0 ? '<font color="#cccccc">添加子菜单</font>' : "<a href='javascript:void(0)' class='add-menu' data-id='".$r['id']."'>添加子菜单</a>";
            $r['edit']    =  "<a href='javascript:void(0)' class='edit-menu' data-id='".$r['id']."'>修改</a>";
            $r['del']     =  "<a href='javascript:void(0)' class='del-menu' data-id='".$r['id']."'>删除</a>";
            switch ($r['is_menu']) {
                case 0:
                    $r['is_menu'] = '否';
                    break;
                case 1:
                    $r['is_menu'] = '是';
                    break;
            }
            $array[]      = $r;
        }

        $str  = "<tr class='tr'>
				    <td style='text-align:left'>\$spacer \$title (\$name) \$uid</td> 
				    <td align='center'>\$url</td> 
				    <td align='center'>\$is_menu</td> 
					<td align='center'>
						\$submenu | \$edit | \$del
					</td>
				  </tr>";

        $Tree = A("Tree");
        $Tree->icon = array('&nbsp;&nbsp;&nbsp;│ ','&nbsp;&nbsp;&nbsp;├─ ','&nbsp;&nbsp;&nbsp;└─ ');
        $Tree->nbsp = '&nbsp;&nbsp;&nbsp;';
        $Tree->init($array);
        $html_tree = $Tree->get_tree(0, $str);
        $this->assign('html_tree',$html_tree);
        $this->display();


    }

    public function menuForm(){
        $id = I("id");

        $menu = M("url")->where(array("id"=>$id))->find();
        if(empty($menu)){
            $pid = I("pid");
            $this->assign('pid',$pid);
        }

        $this->assign('menu',$menu);
        $this->display();
    }

    public function addMenuDo(){
        $pid = I("pid");
        $data['id'] = I("id");
        $data['name'] = I("name");
        $data['url'] = I("url");
        $data['is_menu'] = I("is_menu");

        $model = M("url");

        if($data['id']){  //修改
            $res = $model->save($data);
            if($res !== false){
                $this->ajaxReturn(array("code"=>1,"msg"=>"修改成功"));
            }else{
                $this->ajaxReturn(array("code"=>0,"msg"=>"修改失败"));
            }
        }
        if($pid){  //添加子菜单
            $pMenu = $model->where(array("id"=>$pid,"is_menu"=>1))->find();
            if(empty($pMenu)){
                $this->ajaxReturn(array("code"=>0,"msg"=>"添加子菜单失败"));
            }
            unset($data["id"]);
            $data["pid"] = $pid;
            $res = $model->add($data);
            if($res){
                $this->ajaxReturn(array("code"=>1,"msg"=>"添加子菜单成功"));

            }else{
                $this->ajaxReturn(array("code"=>0,"msg"=>"添加子菜单失败"));
            }
        }
        $this->ajaxReturn(array("code"=>0,"msg"=>"参数有误!"));
    }

    public function delMenu(){
        $id = I("id");

        //TODO 有子菜单是否不允许删除？
        if($check = M("url")->where(array("pid"=>$id))->find()){
            $this->ajaxReturn(array("code"=>0,"msg"=>"有子菜单不允许删除，请先删除子菜单"));
        }

        $res = M("url")->where(array("id"=>$id))->delete();

        if($res){
            $this->ajaxReturn(array("code"=>1,"msg"=>"删除成功"));
        }else{
            $this->ajaxReturn(array("code"=>0,"msg"=>"删除失败"));
        }

    }
}