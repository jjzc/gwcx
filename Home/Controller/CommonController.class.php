<?php
/**
 * Created by PhpStorm.
 * User: MrQ
 * Date: 2018/1/17
 * Time: 17:59
 */

namespace Home\Controller;
use Think\Controller;

class CommonController extends Controller
{
    function __construct(){
        parent::__construct();//这里不写会报错。
        //因为这个构造方法覆盖掉了父类的构造方法，所以要引入
        //echo "这里检验登陆状态";//可以写你的验证代码

        $userId = session("user_id");
        if(!$userId){
            $this->redirect("/Home/User/login");
        }else{
            $last_access=session("last_access");
            //超时退出
            if(time()-$last_access>30*60){
                $this->redirect("/Home/User/login");
            }else{
                session("last_access",time());
            }
        }

        //$userUrl=session("userUrl");
        //$this->assign("userUrl",$userUrl);
        //$this->assign("userName",$userName);


        //$this->assign("allCategory","Category/allCategory");//栏目管理菜单
        //$this->assign("addCategory","Category/addCategory");//栏目管理菜单

    }
}