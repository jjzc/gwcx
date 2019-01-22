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
    function __construct()
    {
        parent::__construct();//这里不写会报错。
        //因为这个构造方法覆盖掉了父类的构造方法，所以要引入
        //echo "这里检验登陆状态";//可以写你的验证代码

        $userId  = session("user_id");
        $groupId = session("group_id");

        if (!$userId) {
            $this->redirect("/Admin/User/login");
        }
//        else {
        $last_access = session("last_access");
        //超时退出
        if (time() - $last_access > 30 * 60) {
            $this->redirect("/Admin/User/login");
        }
//            else {
        session("last_access", time());

        //获取用户所有的权限
        $adminGroup = M("AdminGroup")->find($groupId);
        $ruleids    = explode(",", $adminGroup["group_rule"]);


        //dump($roles);
        $allUrls = session('allUrls');
        if(empty($allUrls)){
            $allUrls = array();

            $rulemap["id"] = array("in", $ruleids);
            $roles         = M("Url")->where($rulemap)->select();
            for ($i = 0, $count = count($roles); $i < $count && $count; $i++) {
                array_push($allUrls, $roles[$i]["url"]);
            }

            session("allUrls", $allUrls);
        }


        //1、直接判断是否具有路由访问权限，没有则直接返回到index
        //echo (ACTION_NAME);
        //进行匹配
        $acitve = false;

        if (strpos(ACTION_NAME, "get") !== false) {
            $acitve = true;
        } else {
            for ($i = 0; $i < count($roles) && count($roles); $i++) {
                if (strpos($roles[$i]["url"], ACTION_NAME) !== false) {
                    $acitve = true;
                    break;
                }
            }
        }
        if (!$acitve) {
            //没有访问权限，跳转到没有权限页面
            //$this->redirect("/Admin/User/denied");
        }
        //获取权限范围内的菜单列表
        $menuList = session('menuList');
        if (empty($menuList)) {
            $map            = array();
            $map["id"]      = array("IN", $ruleids);
            $map["is_menu"] = 1;
            $map["pid"]     = 0;

            $menuList = M("Url")->where($map)->order(" sort desc , id")->select();
            foreach ($menuList as $key => $item) {
                $map["pid"] = $item["id"];
                $submenu    = M("Url")->where($map)->order(" sort desc , id")->select();
                foreach ($submenu as $k => $v) {
                    $map["pid"]             = $v["id"];
                    $submenu[$k]["submenu"] = M("Url")->where($map)->order(" sort desc , id")->select();
                }
                $menuList[$item["id"]]["submenu"] = $submenu;
            }

            session("menuList", $menuList);
        }
//        $mid = intval($_REQUEST["mid"]);
        $this->assign("mid", intval($_REQUEST["mid"]));
        $this->assign("menuList", $menuList);
//
//                if ($tag) {
////                    $pid      = $this->getPid($tag)['id'];
//                    $mid =
//                    $menuList = M("Url")->where(array("id" => array("IN", $ruleids), "pid" => $tag, "is_menu" => 1))->order(" sort desc , id")->select();
//                    foreach ($menuList as $key => $item) {
//                        $submenu                   = M("Url")->where(array("pid" => $item["id"], "is_menu" => 1))->order(" sort desc , id")->select();
//                        $menuList[$key]["submenu"] = $submenu;
//                    }
//                    print_r($menuList);exit;
//                    $this->assign("tag", $tag);
//                    $this->assign("menuList", $menuList);
//                }

//            }
//        }
    }

    /**
     * array_column()不支持低于5.5以下的版本;
     * 以下方法兼容PHP低版本
     */
    function _array_column(array $array, $column_key, $index_key = null)
    {
        $result = [];
        foreach ($array as $arr) {
            if (!is_array($arr)) continue;

            if (is_null($column_key)) {
                $value = $arr;
            } else {
                $value = $arr[$column_key];
            }

            if (!is_null($index_key)) {
                $key          = $arr[$index_key];
                $result[$key] = $value;
            } else {
                $result[] = $value;
            }
        }
        return $result;
    }

}