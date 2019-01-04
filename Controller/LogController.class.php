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

class LogController extends CommonController
{
   public function logList(){
       $this->display();
   }

   public function getAllLog(){
       $key= $_POST["search"]["value"];
       $map["is_del"]=0;
      // if(!empty($key)){
        //   $map['user_name | content '] = array('like', "%$key%");
     //  }

       if(!empty($_POST["content"])){
           $content= $_POST["content"];
           $map['content'] = array('like', "%$content%");
       }

       if(!empty($_POST["user_name"])){
           $userName=$_POST["user_name"];
           $mappp['user_name'] = array('like', "%$userName%");

           $user=M("AdminUser")->where($mappp)->find();

           $userID=$user["id"];

           $map['user_id'] = array('eq',$userID);
       }

       $resCount=M("Log")->where($map)->select();

       $res=M("Log")->where($map)->order('id desc')->limit($_POST["start"],$_POST["length"])->select();

       for($i=0;$i<count($res)&& count($res);$i++){
           $user=M("AdminUser")->find($res[$i]["user_id"]);
           $res[$i]["user_name"]=$user["user_name"];
       }

       //返回数据
       $cars=array();
       $cars["draw"]=$_POST["draw"];
       $cars["recordsTotal"]=count($resCount);//总记录条数
       $cars["recordsFiltered"]=count($resCount);//过滤后的记录数，也就是搜索结果数据
       $cars["data"]=$res;

       $this->ajaxReturn($cars);
   }
}