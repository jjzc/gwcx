<?php
namespace APP\Controller;
use Model\CompanyModel;
use Model\MessageModel;
use Model\TravelModel;
use Model\UserModel;
use Think\Controller;
class MessageController extends Controller {
    public function getUserMessage(){
        $user_id=$_POST["userId"];
        $page=$_POST["pageIndex"];
        $pageSize=$_POST["pageSize"];

        $messageM=new MessageModel();
        $count_res=$messageM->where("to_user_id=".$user_id)->select();

        $count_record=count($count_res);
        $count_page=ceil($count_record/$pageSize);

        $resault=$messageM->order("id desc")->where("to_user_id=".$user_id)->limit($page*$pageSize,$pageSize)->select();

        $res=array(
            "last"=>false,
            "content"=>$resault,
            "aaa"=>$count_record
        );

        if(($page+1)==$count_page){
            $res["last"]=true;
        }


        $this->ajaxReturn($res);
    }

    public function getUserNoReadMessageCount(){
        $user_id=$_POST["userId"];
        $messageM=new MessageModel();
        $count_res=$messageM->where(array("to_user_id"=>$user_id,"is_read"=>0))->select();

        //检查改用户是否为单位管理员
        $userM=new UserModel();
        $user=$userM->find($user_id);

        $companyM=new CompanyModel();
        $company=$companyM->find($user["user_company"]);

        if($company["company_manager_id"]==$user_id){
            //获取待审核出行
            $travelM=new TravelModel();
            $TravelNum=$travelM->where(array("company_id"=>$company["id"],"state"=>0))->count();
            //获取待审核用户
            $userNum=$userM->where("user_state=0 and is_del=0 and user_company=".$company["id"])->count();


            //是单位管理员
            $res["MessageNum"]=count($count_res);
            $res["TravelNum"]=$TravelNum;
            $res["userNum"]=$userNum;
            $this->ajaxReturn($res);
        }else{
            $this->ajaxReturn(array("MessageNum"=>count($count_res)));
        }
    }

    public function getUserMessageDetail(){
        $messageM=new MessageModel();
        $message=$messageM->find($_POST["messageId"]);

        if($message["is_read"]==0){
            $message["is_read"]=1;
        }

        $messageM->save($message);

        $this->ajaxReturn($message);
    }
}