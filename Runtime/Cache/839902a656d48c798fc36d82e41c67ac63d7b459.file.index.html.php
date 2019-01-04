<?php /* Smarty version Smarty-3.1.6, created on 2018-08-21 11:57:22
         compiled from "E:/PhpStorm/dxcar/Admin/View\Index\index.html" */ ?>
<?php /*%%SmartyHeaderCode:223005b7b8da2310e19-49200309%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '839902a656d48c798fc36d82e41c67ac63d7b459' => 
    array (
      0 => 'E:/PhpStorm/dxcar/Admin/View\\Index\\index.html',
      1 => 1533468866,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '223005b7b8da2310e19-49200309',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'isHavaCxManage' => 0,
    'cxUrl' => 0,
    'isHavaDwManage' => 0,
    'dwUrl' => 0,
    'isHavaClManage' => 0,
    'clUrl' => 0,
    'isHavaSjManage' => 0,
    'group' => 0,
    'user' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.6',
  'unifunc' => 'content_5b7b8da2466b4',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5b7b8da2466b4')) {function content_5b7b8da2466b4($_smarty_tpl) {?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>公务用车--后台管理</title>
    <link rel="stylesheet" type="text/css" href="<?php echo @PUBLIC_URL;?>
/css/admin/global.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo @PUBLIC_URL;?>
/plugin/easyui/themes/default/easyui.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo @PUBLIC_URL;?>
/plugin/easyui/themes/icon.css" />
</head>
<body onselectstart="return false;" style="-moz-user-select:none;">
<div class="mainbody">
    <div id="cloud1" class="cloud" ></div>
    <div id="cloud2" class="cloud" ></div>
</div>


<div class="dock">
    <div class="dock-body">
        <ul>
            <li onclick="openUrl('/index.php/Admin/User/changePwd','修改密码',1000,450)"><img src="<?php echo @PUBLIC_URL;?>
/images/icon/pwd.png" title="修改密码" ></li>
            <li onclick="loginOut()"><img src="<?php echo @PUBLIC_URL;?>
/images/icon/tuichu.png" title="退出" ></li>
        </ul>
    </div>
    <div class="dock-bottom"></div>
</div>


<div class="diskicon" style="display:inline-block; width:auto;">
    <ul>
        <?php if ($_smarty_tpl->tpl_vars['isHavaCxManage']->value=='1'){?>
            <li text="出行管理" icon="<?php echo @PUBLIC_URL;?>
/images/icon/travel.png" path="<?php echo $_smarty_tpl->tpl_vars['cxUrl']->value;?>
" data-property="{ title:'出行管理',minimize:'true',maximize:'false',target:'iframe',multiple:'false' }" data-style="[{ name:'left',value:'0px' },{ name:'top',value:'0px' }]" ><span class="icon"><span class="icon"><img src="<?php echo @PUBLIC_URL;?>
/images/icon/travel.png" title="出行管理" ></span><span class="text">出行管理</span></li>
        <?php }?>

        <?php if ($_smarty_tpl->tpl_vars['isHavaDwManage']->value=='1'){?>
        <li text="单位管理<?php echo $_smarty_tpl->tpl_vars['isHavaDwManage']->value;?>
" icon="<?php echo @PUBLIC_URL;?>
/images/icon/company.png" path="<?php echo $_smarty_tpl->tpl_vars['dwUrl']->value;?>
" data-property="{ title:'单位管理',minimize:'true',maximize:'false',target:'iframe',multiple:'false' }" data-style="[{ name:'left',value:'0px' },{ name:'top',value:'0px' }]" ><span class="icon"><span class="icon"><img src="<?php echo @PUBLIC_URL;?>
/images/icon/company.png" title="单位管理" ></span><span class="text">单位管理</span></li>
        <?php }?>

        <?php if ($_smarty_tpl->tpl_vars['isHavaClManage']->value=='1'){?>
        <li text="车辆管理" icon="<?php echo @PUBLIC_URL;?>
/images/icon/car.png" path="<?php echo $_smarty_tpl->tpl_vars['clUrl']->value;?>
" data-property="{ title:'车辆管理',minimize:'true',maximize:'false',target:'iframe',multiple:'false' }" data-style="[{ name:'left',value:'0px' },{ name:'top',value:'0px' }]" ><span class="icon"><span class="icon"><img src="<?php echo @PUBLIC_URL;?>
/images/icon/car.png" title="车辆管理" ></span><span class="text">车辆管理</span></li>
        <?php }?>

        <?php if ($_smarty_tpl->tpl_vars['isHavaSjManage']->value=='1'){?>
        <li text="司机管理" icon="<?php echo @PUBLIC_URL;?>
/images/icon/driver.png" path="/index.php/Admin/Driver/allDrivers" data-property="{ title:'司机管理',minimize:'true',maximize:'false',target:'iframe',multiple:'false' }" data-style="[{ name:'left',value:'0px' },{ name:'top',value:'0px' }]" ><span class="icon"><span class="icon"><img src="<?php echo @PUBLIC_URL;?>
/images/icon/driver.png" title="司机管理" ></span><span class="text">司机管理</span></li>
        <?php }?>


        <?php if (in_array("/index.php/Admin/Statistics",$_SESSION['allUrls'])){?>
        <li text="数据统计" icon="<?php echo @PUBLIC_URL;?>
/images/icon/tongji.png" path="/index.php/Admin/Statistics/byCompany" data-property="{ title:'数据统计',minimize:'true',maximize:'false',target:'iframe',multiple:'false' }" data-style="[{ name:'left',value:'0px' },{ name:'top',value:'0px' }]" ><span class="icon"><span class="icon"><img src="<?php echo @PUBLIC_URL;?>
/images/icon/tongji.png" title="数据统计" ></span><span class="text">数据统计</span></li>
        <?php }?>

        <?php if (in_array("/index.php/Admin/TravelSet",$_SESSION['allUrls'])){?>
        <li text="系统配置" icon="<?php echo @PUBLIC_URL;?>
/images/icon/peizhi.png" path="/index.php/Admin/TravelSet/travelSet" data-property="{ title:'系统配置',minimize:'true',maximize:'false',target:'iframe',multiple:'false' }" data-style="[{ name:'left',value:'0px' },{ name:'top',value:'0px' }]" ><span class="icon"><span class="icon"><img src="<?php echo @PUBLIC_URL;?>
/images/icon/peizhi.png" title="系统配置" ></span><span class="text">系统配置</span></li>
        <?php }?>

        <?php if (in_array("/index.php/Admin/UserCenter",$_SESSION['allUrls'])){?>
        <li text="用户管理" icon="<?php echo @PUBLIC_URL;?>
/images/icon/geren.png" path="/index.php/Admin/UserCenter/userList" data-property="{ title:'用户管理',minimize:'true',maximize:'false',target:'iframe',multiple:'false' }" data-style="[{ name:'left',value:'0px' },{ name:'top',value:'0px' }]" ><span class="icon"><span class="icon"><img src="<?php echo @PUBLIC_URL;?>
/images/icon/geren.png" title="用户管理" ></span><span class="text">用户管理</span></li>
        <?php }?>

    </ul>
</div>
<div class="taskbar">
    <div class="taskbar-opacity"></div>
</div>
<div class="taskbar-body">
    <ul>
        <!--<li class="start"><span><img src="images/admin/logo.png" title="开始菜单" ></span></li>-->
        <li class="datetime" id="datetime"><span>21:04:25</span><span>2018/4/25</span></li>
        <li class="datetime" id="datetime3"><p><?php echo $_smarty_tpl->tpl_vars['group']->value['group_name'];?>
</p></li>
        <li class="datetime" id="datetime2"><p><?php echo $_smarty_tpl->tpl_vars['user']->value['user_name'];?>
</p></li>
    </ul>
</div>

<script type="text/javascript" src="<?php echo @PUBLIC_URL;?>
/js/jquery-2.1.4.min.js"></script>
<script type="text/javascript" src="<?php echo @PUBLIC_URL;?>
/js/json.js"></script>
<script type="text/javascript" src="<?php echo @PUBLIC_URL;?>
/js/jquery.cloud.js"></script>
<script type="text/javascript" src="<?php echo @PUBLIC_URL;?>
/js/jquery.ui.win.js"></script>

<script src="<?php echo @PUBLIC_URL;?>
/plugin/layer/layer.js" type="text/javascript"></script>

<script type="text/javascript">
    $(document).ready(function(e) {

        $.Init();	//初始化
        $(window).resize(function(){
            $('.window[status="maximized"]').css({ 'left':'0px','top':'0px','width':$(window).outerWidth()+'px', 'height':$(window).outerHeight()-40+'px' });
            $('.window[status="maximized"] .window-body').css({ 'height':$(window).outerHeight()-25 - 25,'width':$(window).outerWidth() - 2 });
        });


        //注入当前时间
        showTime();
    });


    function loginOut() {
        window.location.href="/index.php/Admin/User/loginOut";
    }

    function openUrl(url,title,w,h) {
        layer.open({
            type: 2,
            title:title,
            area: [w+'px', h+'px'],
            fixed: false, //不固定
            maxmin: true,
            content: url
        });
    }




    function showTime()
    {
        //创建Date对象
        var today = new Date();
        //分别取出年、月、日、时、分、秒
        var year = today.getFullYear();
        var month = today.getMonth()+1;
        var day = today.getDate();
        var hours = today.getHours();
        var minutes = today.getMinutes();
        var seconds = today.getSeconds();
        //如果是单个数，则前面补0
        month  = month<10  ? "0"+month : month;
        day  = day <10  ? "0"+day : day;
        hours  = hours<10  ? "0"+hours : hours;
        minutes = minutes<10 ? "0"+minutes : minutes;
        seconds = seconds<10 ? "0"+seconds : seconds;

        //构建要输出的字符串
        //<span>21:04:25</span><span>2018/4/25</span>
        var str = year+"年"+month+"月"+day+"日 "+hours+":"+minutes+":"+seconds;
        //
        var str="<span>"+hours+":"+minutes+":"+seconds+"</span><span>"+year+"/"+month+"/"+day+"</span>";

        //获取id=result的对象
        var obj = document.getElementById("datetime");
        //将str的内容写入到id=result的<div>中去
        obj.innerHTML = str;
        //延时器
        window.setTimeout("showTime()",1000);
    }
</script>
</body>
</html>
<?php }} ?>