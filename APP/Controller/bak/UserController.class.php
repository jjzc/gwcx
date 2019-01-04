<?php
namespace APP\Controller;
use Model\CompanyModel;
use Model\UserModel;
use Think\Controller;
class UserController extends Controller {
    //登录接口
    public function login(){
        if(empty($_POST)||empty($_POST["user_phone"])||empty($_POST["user_pwd"])){
            //参数错误
            $this->ajaxReturn(array("code"=>-1));
        }else{
            //检查是否存在该用户
            $user_model=new UserModel();
            $user_model->where(array("user_phone"=>$_POST["user_phone"],"is_del"=>0));
            $user_find=$user_model->select();
            if(count($user_find)){
                $user=$user_model->find($user_find[0]["id"]);
                //判断密码是否一致
                if($user["user_pwd"]==md5(md5($_POST["user_pwd"]).md5($_POST["user_pwd"]))){
                    //判断是否审核通过
                    if($user["user_state"]==0){
                        $this->ajaxReturn(array("code"=>2));//单位审核中
                    }elseif ($user["user_state"]==-1){
                        $this->ajaxReturn(array("code"=>3));//单位审核未通过
                    }else{
                        //登陆成功，查询单位信息
                        $companyM=new CompanyModel();
                        $company=$companyM->find($user["user_company"]);

                        $this->ajaxReturn(array("code"=>1,"user"=>$user,"company"=>$company));//登录成功

                    }
                }else{
                    $this->ajaxReturn(array("code"=>4));//密码错误
                }

            }else{
                $this->ajaxReturn(array("code"=>5));//用户名不存在
            }
        }
    }

    //获取某个单位下所有用户
    public function getUserList(){
        $userM=new UserModel();
        $users=$userM->where(array("is_del"=>0,"user_company"=>$_POST["companyId"]))->order("first_letter asc")->select();

        $res=array();

        for($i=0;$i<count($users)&&count($users)!=0;$i++){
            //获取首字母
            $tem["firstLetter"]=$users[$i]["first_letter"];
            //获取全拼
            $tem["fullSpell"]=$users[$i]["full_spell"];
            //获取首字母全拼
            $tem["firstLetterFullSpell"]=$users[$i]["first_letter_full_spell"];

            $tem["id"]=$users[$i]["id"];
            $tem["user_name"]=$users[$i]["user_name"];
            array_push($res,$tem);
        }

        $this->ajaxReturn($res);
    }

    //同意用户审核
    public function agreeCompanyUserReview(){
        $user_id=$_POST["id"];
        $userM=new UserModel();
        $user=$userM->find($user_id);

        $user["user_state"]=1;
        $userM->save($user);
        $this->ajaxReturn(array("code"=>1));

    }

    public function disagreeCompanyUserReview(){
        $user_id=$_POST["id"];
        $userM=new UserModel();

        $user=$userM->find($user_id);

        $user["user_state"]=-1;
        $user["error_msg"]=$_POST["errorMsg"];
        $userM->save($user);
        $this->ajaxReturn(array("code"=>1));

    }


    //获取某个单位下待审核用户
    public function getCompanyUserReview(){
        $companyId=$_POST["companyId"];
        $userM=new UserModel();

        $resault=$userM->order("id desc")->where(array("user_company"=>$companyId,"user_state"=>0))->select();

        $this->ajaxReturn($resault);
    }


    public function getCompanyList(){
        $companyM=new CompanyModel();
        $companys=$companyM->where("is_del=0")->order("first_letter asc")->select();

        $res=array();

        for($i=0;$i<count($companys)&&count($companys)!=0;$i++){
            //获取首字母
            $tem["firstLetter"]=$companys[$i]["first_letter"];
            //获取全拼
            $tem["fullSpell"]=$companys[$i]["full_spell"];
            //获取首字母全拼
            $tem["firstLetterFullSpell"]=$companys[$i]["first_letter_full_spell"];

            $tem["id"]=$companys[$i]["id"];
            $tem["company_name"]=$companys[$i]["company_name"];
            array_push($res,$tem);
        }



        $this->ajaxReturn($res);
    }

    public function getUserInfo(){
        $userId=$_POST["userId"];
        $userM=new UserModel();
        $user=$userM->find($userId);

        $companyM=new CompanyModel();
        $company=$companyM->find($user["user_company"]);


        $this->ajaxReturn(array("user"=>$user,"company"=>$company));
    }






}