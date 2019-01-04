<?php
/**
 * Created by PhpStorm.
 * User: MrQ
 * Date: 2018/1/17
 * Time: 17:59
 */

namespace Admin\Controller;
use Think\Controller;

class CommonController extends Controller
{
    function __construct(){
        parent::__construct();//这里不写会报错。
        //因为这个构造方法覆盖掉了父类的构造方法，所以要引入
        //echo "这里检验登陆状态";//可以写你的验证代码

        $userId = session("user_id");
        $groupId=session("group_id");

        if(!$userId){
            $this->redirect("/Admin/User/login");
        }else{
            $last_access=session("last_access");
            //超时退出
            if(time()-$last_access>30*60){
                $this->redirect("/Admin/User/login");
            }else{
                session("last_access",time());

                //获取用户所有的权限
                $adminGroup=M("AdminGroup")->find($groupId);
                $ruleids=explode(",",$adminGroup["group_rule"]);



                $rulemap["id"]=array("in",$ruleids);
                $roles=M("Url")->where($rulemap)->select();

                //dump($roles);
                $allUrls=array();
                for($i=0;$i<count($roles)&& count($roles);$i++){
                    array_push($allUrls,$roles[$i]["url"]);
                }

                session("allUrls",$allUrls);

                //1、直接判断是否具有路由访问权限，没有则直接返回到index
                //echo (ACTION_NAME);
                //进行匹配
                $acitve=false;

                if(strpos(ACTION_NAME,"get")!==false){
                    $acitve=true;
                }else{
                    for($i=0;$i<count($roles)&& count($roles);$i++){
                        if(strpos($roles[$i]["url"],ACTION_NAME)!==false){
                            $acitve=true;
                            break;
                        }
                    }
                }
                if(!$acitve){
                    //没有访问权限，跳转到没有权限页面
                    //$this->redirect("/Admin/User/denied");
                }

                //获取出行管理左侧菜单
                $rulemap["pid"]=1;
                $travelLeft=M("Url")->where($rulemap)->select();
                $this->assign("travelLeft",$travelLeft);

                //获取单位管理左侧菜单
                $rulemap["pid"]=22;
                $companyLeft1=M("Url")->where($rulemap)->select();
                $this->assign("companyLeft1",$companyLeft1);

                $rulemap["pid"]=23;
                $companyLeft2=M("Url")->where($rulemap)->select();
                $this->assign("companyLeft2",$companyLeft2);

                //车辆管理左侧菜单
                $rulemap["pid"]=34;
                $carLeft1=M("Url")->where($rulemap)->select();
                $this->assign("carLeft1",$carLeft1);

                $rulemap["pid"]=35;
                $carLeft2=M("Url")->where($rulemap)->select();
                $this->assign("carLeft2",$carLeft2);

                $rulemap["pid"]=36;
                $carLeft3=M("Url")->where($rulemap)->select();
                $this->assign("carLeft3",$carLeft3);

                //司机管理左侧菜单
                $rulemap["pid"]=4;
                $driverLeft=M("Url")->where($rulemap)->select();
                $this->assign("driverLeft",$driverLeft);

                //dump($carLeft1);

            }
        }




        /**
         * array_column()不支持低于5.5以下的版本;
         * 以下方法兼容PHP低版本
         */
        function array_column(array $array, $column_key, $index_key=null){
            $result = [];
            foreach($array as $arr) {
                if(!is_array($arr)) continue;

                if(is_null($column_key)){
                    $value = $arr;
                }else{
                    $value = $arr[$column_key];
                }

                if(!is_null($index_key)){
                    $key = $arr[$index_key];
                    $result[$key] = $value;
                }else{
                    $result[] = $value;
                }
            }
            return $result;
        }

        //$userUrl=session("userUrl");
        //$this->assign("userUrl",$userUrl);
        //$this->assign("userName",$userName);


        //$this->assign("allCategory","Category/allCategory");//栏目管理菜单
        //$this->assign("addCategory","Category/addCategory");//栏目管理菜单

    }
}