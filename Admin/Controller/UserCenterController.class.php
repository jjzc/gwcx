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
    public function userList()
    {
        $this->display();
    }

    public function getUserList()
    {
        $resCount = M("AdminUser")->select();

        $map           = array();
        $map["is_del"] = 0;
        $key           = $_POST["search"]["value"];
        if (!empty($key)) {
            $map['user_name'] = array('like', "%$key%");
        }
        $order = array();
        switch ($_POST["order"][0]["column"]) {
            case 0:
                $order["user_name"] = $_POST["order"][0]["dir"];
                break;
        }

        $res = M("AdminUser")->where($map)->order($order)->limit($_POST["start"], $_POST["length"])->select();

        for ($i = 0; $i < count($res) && count($res); $i++) {
            $userGroup             = M("AdminGroup")->find($res[$i]["user_group"]);
            $res[$i]["group_name"] = $userGroup["group_name"];
        }

        //返回数据
        $data                    = array();
        $data["draw"]            = $_POST["draw"];
        $data["recordsTotal"]    = count($resCount);//总记录条数
        $data["recordsFiltered"] = count($resCount);//过滤后的记录数，也就是搜索结果数据
        $data["data"]            = $res;

        $this->ajaxReturn($data);
    }

    public function delUser()
    {
        $user["id"]     = $_POST["id"];
        $user["is_del"] = 1;

        if (M("AdminUser")->save($user)) {
            $this->ajaxReturn(array("code" => 1));
        } else {
            $this->ajaxReturn(array("code" => 0));
        }
    }

    public function addUser()
    {
        $groups = M("AdminGroup")->select();
        $this->assign("groups", $groups);

        $this->display();
    }

    public function addUserDo()
    {
        //先检测账号是否存在
        $map["user_name"] = $_POST["user_name"];
        $user             = M("AdminUser")->where($map)->select();
        if ($user) {
            $this->ajaxReturn(array("code" => 0));
        } else {
            $_POST["user_pwd"] = md5(md5($_POST["user_pwd"]) . md5($_POST["user_pwd"]));
            if (M("AdminUser")->add($_POST)) {
                $this->ajaxReturn(array("code" => 1));
            } else {
                $this->ajaxReturn(array("code" => 0));
            }

        }
    }

    public function editUser($id)
    {
        $groups = M("AdminGroup")->select();
        $this->assign("groups", $groups);

        $user = M("AdminUser")->find($id);
        $this->assign("user", $user);

        $this->display();
    }

    public function editUserDo()
    {
        if (empty($_POST["user_pwd"])) {
            unset($_POST["user_pwd"]);
        } else {
            $_POST["user_pwd"]  = md5(md5($_POST["user_pwd"]) . md5($_POST["user_pwd"]));
            $_POST["error_num"] = 0;
        }

        if (M("AdminUser")->save($_POST)) {
            $this->ajaxReturn(array("code" => 1));
        } else {
            $this->ajaxReturn(array("code" => 0));
        }
    }


    public function getGroupList()
    {
        $resCount = M("AdminGroup")->select();

        $map = array();
        $key = $_POST["search"]["value"];
        if (!empty($key)) {
            $map['group_name'] = array('like', "%$key%");
        }
        $order = array();
        switch ($_POST["order"][0]["column"]) {
            case 0:
                $order["group_name"] = $_POST["order"][0]["dir"];
                break;
        }

        $res = M("AdminGroup")->where($map)->order($order)->limit($_POST["start"], $_POST["length"])->select();


        //返回数据
        $data                    = array();
        $data["draw"]            = $_POST["draw"];
        $data["recordsTotal"]    = count($resCount);//总记录条数
        $data["recordsFiltered"] = count($resCount);//过滤后的记录数，也就是搜索结果数据
        $data["data"]            = $res;

        $this->ajaxReturn($data);
    }

    public function addGroup()
    {

        $urls = M("Url")->select();

        $res = array();
        for ($index = 0; $index < count($urls) && count($urls) != 0; $index++) {
            $res[$index]["id"]   = $urls[$index]["id"];
            $res[$index]["pId"]  = $urls[$index]["pid"];
            $res[$index]["name"] = $urls[$index]["name"];
        }
        $this->assign("roles", json_encode($res));

        $this->display();
    }

    public function addGroupDo()
    {
        $res = M("AdminGroup")->add($_POST);
        if ($res) {
            $this->ajaxReturn(array("code" => 1));
        } else {
            $this->ajaxReturn(array("code" => 0));
        }
    }

    public function editGroup($id)
    {
        $group = M("AdminGroup")->find($id);

        $ids = explode(",", $group["group_rule"]);

        $urls = M("Url")->select();

        $res = array();
        for ($index = 0; $index < count($urls) && count($urls) != 0; $index++) {
            $res[$index]["id"]   = $urls[$index]["id"];
            $res[$index]["pId"]  = $urls[$index]["pid"];
            $res[$index]["name"] = $urls[$index]["name"];
            if (in_array($urls[$index]["id"], $ids)) {
                $res[$index]["checked"] = true;
            }
        }
        $this->assign("roles", json_encode($res));
        $this->assign("group", $group);

        $this->display();
    }

    public function editGroupDo()
    {
        $res = M("AdminGroup")->save($_POST);
        if ($res) {
            $this->ajaxReturn(array("code" => 1));
        } else {
            $this->ajaxReturn(array("code" => 0));
        }
    }

    public function getGroupTree()
    {
        $urlM = M("Url");
        //获取树形菜单
        $res = $this->getGroupTreeArray(0, $urlM);

        $this->ajaxReturn($res);
    }

    protected function getGroupTreeArray($pid, $urlM)
    {
        $tree = array();
        //查询子栏目
        $urls = $urlM->where(array("pid" => $pid))->select();

        for ($index = 0; $index < count($urls) && count($urls) != 0; $index++) {

            //查询是否有子类
            $urlschilds = $urlM->where(array("pid" => $urls[$index]["id"]))->count();
            if ($urlschilds > 0) {
                $temp = array(
                    "id"       => $urls[$index]["id"],
                    "text"     => $urls[$index]["name"],
                    "icon"     => "fa fa-folder icon-lg icon-state-success",
                    "children" => $this->getGroupTreeArray($urls[$index]["id"], $urlM),
                    "type"     => "root"
                );
                array_push($tree, $temp);

                //$tree=array_merge($tree,$this->allCategoryGetData($categorys[$index]["id"],$CategoryM));
            } else {
                $temp = array(
                    "id"       => $urls[$index]["id"],
                    "text"     => $urls[$index]["name"],
                    "icon"     => "fa fa-folder icon-lg icon-state-success",
                    "children" => false,
                    "type"     => "root"
                );
                array_push($tree, $temp);
            }
        }
        return $tree;
    }


    /*
     * 写入Log日志
     */
    public function logCreatWeb($content)
    {
        $userId = session("user_id");

        $data["user_id"] = $userId;
        $data["do_time"] = time();
        $data["content"] = $content;
        $data["type"]    = 1;


        $res = M("Log")->add($data);
    }

    //菜单管理
    public function menu()
    {

        $menu = M("Url")->select();

        $array = array();
        // 构建生成树中所需的数据
        foreach ($menu as $k => $r) {
            $r['submenu'] = $r['is_menu'] == 0 ? '<font color="#cccccc">添加子菜单</font>' : "<a href='javascript:void(0)' class='add-menu' data-id='" . $r['id'] . "'>添加子菜单</a>";
            $r['edit']    = "<a href='javascript:void(0)' class='edit-menu' data-id='" . $r['id'] . "'>修改</a>";
            $r['del']     = "<a href='javascript:void(0)' class='del-menu' data-id='" . $r['id'] . "'>删除</a>";
            switch ($r['is_menu']) {
                case 0:
                    $r['is_menu'] = '否';
                    break;
                case 1:
                    $r['is_menu'] = '是';
                    break;
            }
            $r["icon"] = $r['icon'] ? "<img style='width:25px;height:25px' src=".substr($r['icon'],1)." >" : "";
            $array[] = $r;
        }


        $str = "<tr class='tr'>
				    <td style='text-align:left'>\$spacer \$title (\$name) \$uid</td> 
				    <td align='center'>\$url</td> 
				    <td align='center'>\$is_menu</td> 
				    <td align='center'>\$sort</td> 
				    <td align='center'>\$icon</td> 
					<td align='center'>
						\$submenu | \$edit | \$del
					</td>
				  </tr>";

        $Tree       = A("Tree");
        $Tree->icon = array('&nbsp;&nbsp;&nbsp;│ ', '&nbsp;&nbsp;&nbsp;├─ ', '&nbsp;&nbsp;&nbsp;└─ ');
        $Tree->nbsp = '&nbsp;&nbsp;&nbsp;';
        $Tree->init($array);
        $html_tree = $Tree->get_tree(0, $str);
        $this->assign('html_tree', $html_tree);
        $this->display();


    }

    public function menuForm()
    {
        $id  = I("id");         //修改子菜单
        $pid = I("pid");      //添加子菜单

        $menu = M("url")->find($id);

        if($pid || $menu["pid"] > 0){   //选择上级菜单是否显示
            $this->assign("is_show_sup_menu",1);
        }

        $array   = array();
        $allMenu = M("url")->where("")->select();
        foreach ($allMenu as $k => $r) {
            $r['disabled']   = $r['is_menu'] == 0 ? 'disabled' : '';
            $array[$r['id']] = $r;
        }
        $str  = "<option value='\$id' \$selected \$disabled >\$spacer \$name \$uid</option>";
        $Tree = A("Tree");
        $Tree->init($array);
        $select_categorys = $Tree->get_tree(0, $str, $pid ? $pid : $menu["pid"]);
        $this->assign('select_categorys', $select_categorys);
        $this->assign('menu', $menu);
        $this->display();
    }

    public function addMenuDo()
    {

        $data['id']      = I("id");
        $data['pid']     = I("pid");
        $data['name']    = I("name");
        $data['url']     = I("url");
        $data['is_menu'] = I("is_menu");
        $data['sort']    = I("sort");
        $data['icon']    = I("icon");

        if($_FILES){  //上传了图片

            $upload = new \Think\Upload();
            // 实例化上传类
            $upload -> maxSize = 50000000000;
            // 设置附件上传大小
            $upload->exts      =     array('png','jpg','jpeg');
            // 设置附件上传类型
            $upload -> rootPath = './Public/images/icon/';
            // 设置附件上传根目录
            $upload -> savePath = '';
            // 设置附件上传（子）目录

            $info = $upload -> uploadOne($_FILES["icon"]);

            if(!$info){
                $this->ajaxReturn(array("code" => 0, "msg" => "图标上传失败"));
            }

            $data['icon'] = './Public/images/icon/'.$info['savepath'].$info['savename'];
        }

        $model = M("url");

        if($data["pid"]){ //一级菜单 pid = 0  ，不需要判断上级菜单
            $pMenu = $model->where(array("id" => $data["pid"], "is_menu" => 1))->find();
            if (empty($pMenu)) {
                $this->ajaxReturn(array("code" => 0, "msg" => "操作失败"));
            }
        }

        if ($data['id']) {  //修改子菜单
            $menu = $model->find($data["id"]);
            if (empty($menu)) {
                $this->ajaxReturn(array("code" => 0, "msg" => "修改菜单不存在"));
            }
            if ($data["id"] == $data["pid"]) {
                $this->ajaxReturn(array("code" => 0, "msg" => "不能选择自己为上级菜单".$data["pid"]));
            }

            $res = $model->save($data);
            if ($res !== false) {
                $this->ajaxReturn(array("code" => 1, "msg" => "修改成功"));
            } else {
                $this->ajaxReturn(array("code" => 0, "msg" => "修改失败"));
            }
        } else {  //添加子菜单
            unset($data["id"]);
            $res = $model->add($data);
            if ($res) {
                $this->ajaxReturn(array("code" => 1, "msg" => "添加子菜单成功"));
            } else {
                $this->ajaxReturn(array("code" => 0, "msg" => "添加子菜单失败"));
            }
        }
    }

    public function delMenu()
    {
        $id = I("id");

        //TODO 有子菜单是否不允许删除？
        if ($check = M("url")->where(array("pid" => $id))->find()) {
            $this->ajaxReturn(array("code" => 0, "msg" => "有子菜单不允许删除，请先删除子菜单"));
        }

        $res = M("url")->where(array("id" => $id))->delete();

        if ($res) {
            $this->ajaxReturn(array("code" => 1, "msg" => "删除成功"));
        } else {
            $this->ajaxReturn(array("code" => 0, "msg" => "删除失败"));
        }

    }


    //编译生成css文件
//    public function parse_css($urls='')
//    {
//
//        define('APP_ROOT_PATH',  'E:/gwcx/');
//        define("SITE_DOMAIN",$this->get_domain());   //站点域名
//
//        $urls = [APP_ROOT_PATH.'Public/css/jdk.css'];
//        $color_cfg = array(
//            "@main_color"   =>  "#E45152", //整体风格颜色
//            "@border_main" =>   "#f4f4f4",  //主要边框颜色
//            "@border_style"=>   "#E45152",  //整体风格边框颜色
//            "@font_white"  =>   "#fff",    //白色字体
//            "@font_style"  =>   "#E45152", //整体风格字体
//            "@font_red"    =>   "#ed3130", //类似一些字体突出显示的
//            "@body_color"  =>   "#f8f8f8", //整体背景色
//            "@box_color"   =>   "#fff",    //块颜色
//            "@box_red"     =>   "#ed3130", //类似一些按钮需显示显眼，
//        );
//        $showurl = $url = md5(implode(',',$urls).SITE_DOMAIN);
//        $css_url = 'Runtime/statics/'.$url.'.css';
//        $pathwithoupublic = 'Runtime/statics/';
//        $url_path = APP_ROOT_PATH.$css_url;
//
//        if(!file_exists($url_path)||IS_DEBUG)
//        {
//            if(!file_exists(APP_ROOT_PATH.'Runtime/statics/'))
//                mkdir(APP_ROOT_PATH.'Runtime/statics/',0777);
//
//            if(!file_exists(APP_ROOT_PATH.'Runtime/statics/'.CACHE_SUBDIR.'/'))
//                mkdir(APP_ROOT_PATH.'Runtime/statics/'.CACHE_SUBDIR.'/',0777);
//            $tmpl_path = $GLOBALS['tmpl']->_var['TMPL'];
//
//            $css_content = '';
//            foreach($urls as $url)
//            {
//                $css_content .= @file_get_contents($url);
//                echo $url;
//            }
//            $css_content = preg_replace("/[\r\n]/",'',$css_content);
//            $css_content = str_replace("../images/",$tmpl_path."/images/",$css_content);
//
////            if($GLOBALS['distribution_cfg']['CSS_JS_OSS']&&$GLOBALS['distribution_cfg']['OSS_TYPE']&&$GLOBALS['distribution_cfg']['OSS_TYPE']!="NONE")
////            {
////                $this->curl_download($GLOBALS['distribution_cfg']['OSS_FILE_DOMAIN']."/public/iconfont/iconfont.css", APP_ROOT_PATH."public/iconfont/iconfont.css");
////                $this->curl_download($GLOBALS['distribution_cfg']['OSS_FILE_DOMAIN']."/public/iconfont/iconfont.eot", APP_ROOT_PATH."public/iconfont/iconfont.eot");
////                $this->curl_download($GLOBALS['distribution_cfg']['OSS_FILE_DOMAIN']."/public/iconfont/iconfont.svg", APP_ROOT_PATH."public/iconfont/iconfont.svg");
////                $this->curl_download($GLOBALS['distribution_cfg']['OSS_FILE_DOMAIN']."/public/iconfont/iconfont.ttf", APP_ROOT_PATH."public/iconfont/iconfont.ttf");
////                $this->curl_download($GLOBALS['distribution_cfg']['OSS_FILE_DOMAIN']."/public/iconfont/iconfont.woff", APP_ROOT_PATH."public/iconfont/iconfont.woff");
////                //	$css_content = str_replace("./public/iconfont/",$GLOBALS['distribution_cfg']['OSS_FILE_DOMAIN']."/public/iconfont/",$css_content);
////            }
//
//            $css_content = str_replace("./public/",SITE_DOMAIN.APP_ROOT."/public/",$css_content);
//            $css_content = str_replace("@rand",time(),$css_content);
//            foreach($color_cfg as $k=>$v)
//            {
//                $css_content = str_replace($k,$v,$css_content);
//            }
//            //		@file_put_contents($url_path, unicode_encode($css_content));
//            @file_put_contents($url_path, $css_content);
//            if($GLOBALS['distribution_cfg']['CSS_JS_OSS']&&$GLOBALS['distribution_cfg']['OSS_TYPE']&&$GLOBALS['distribution_cfg']['OSS_TYPE']!="NONE")
//            {
////                $this->syn_to_remote_file_server($css_url);
//                $GLOBALS['refresh_page'] = true;
//            }
//        }
////        if($GLOBALS['distribution_cfg']['CSS_JS_OSS']&&$GLOBALS['distribution_cfg']['OSS_TYPE']&&$GLOBALS['distribution_cfg']['OSS_TYPE']!="NONE")
////        {
////            $domain = $GLOBALS['distribution_cfg']['OSS_FILE_DOMAIN'];
////        }
////        else
////        {
//            $domain = SITE_DOMAIN.APP_ROOT;
////        }
//        return $domain."/".$css_url."?v=4.0.1";
//    }
//
//    function get_domain()
//    {
//        /* 协议 */
//        $protocol = $this->get_http();
//
//        /* 域名或IP地址 */
//        if (isset($_SERVER['HTTP_X_FORWARDED_HOST']))
//        {
//            $host = $_SERVER['HTTP_X_FORWARDED_HOST'];
//        }
//        elseif (isset($_SERVER['HTTP_HOST']))
//        {
//            $host = $_SERVER['HTTP_HOST'];
//        }
//        else
//        {
//            /* 端口 */
//            if (isset($_SERVER['SERVER_PORT']))
//            {
//                $port = ':' . $_SERVER['SERVER_PORT'];
//
//                if ((':80' == $port && 'http://' == $protocol) || (':443' == $port && 'https://' == $protocol))
//                {
//                    $port = '';
//                }
//            }
//            else
//            {
//                $port = '';
//            }
//
//            if (isset($_SERVER['SERVER_NAME']))
//            {
//                $host = $_SERVER['SERVER_NAME'] . $port;
//            }
//            elseif (isset($_SERVER['SERVER_ADDR']))
//            {
//                $host = $_SERVER['SERVER_ADDR'] . $port;
//            }
//        }
//
//        return $protocol . $host;
//    }
//
//    function get_http()
//    {
//        return (isset($_SERVER['HTTPS']) && (strtolower($_SERVER['HTTPS']) != 'off')) ? 'https://' : 'http://';
//    }

}