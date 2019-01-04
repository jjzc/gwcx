<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2014 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用入口文件

// 检测PHP环境
if(version_compare(PHP_VERSION,'5.3.0','<'))  die('require PHP > 5.3.0 !');

// 开启调试模式 建议开发阶段开启 部署阶段注释或者设为false
define('APP_DEBUG',true);



define('UPLOAD_URL', "/Public/upload/");
define('PUBLIC_URL', "/Public/");
define('WEB_NAME', "玖玖公务出行审批管理系统  400-0731163");//网站名称
define("VERIFY_CODE_TIME", 3);//验证码有效期,单位分钟


define("NAME_CN", "玖玖公务出行管理平台");
define("NAME_EN", "YUE YANG CITY YUN XI DISTRICT OFFICIAL VENICLE MANAGEMENT PLATFORM");




//个推配置！！！！
//司机端
define('DAPPKEY','uMZtb1dBvs8TR7ib4gZJs3');
define('DAPPID','Pz7mXXTIos752CSsHaZeQ9');
define('DMASTERSECRET','8kAKfyQreE9sXgd3gkTAk2');
//用户端
define('UAPPKEY','akktdMnuKv611pn6MbZ1o9');
define('UAPPID','t7JSS9i31s5c5tQzOyHiw2');
define('UMASTERSECRET','VzdhNAErr57jpMab1sKE3A');


// 引入ThinkPHP入口文件
require './ThinkPHP/ThinkPHP.php';

// 亲^_^ 后面不需要任何代码了 就是如此简单
