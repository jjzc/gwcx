<?php /* Smarty version Smarty-3.1.6, created on 2018-10-10 15:50:39
         compiled from "/var/www/yxcarnew/Home/View/Index/index.html" */ ?>
<?php /*%%SmartyHeaderCode:7228526525bbdaf4f2895c3-17804768%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '474fd64d0d676106a07ec71bcce0633f577ea827' => 
    array (
      0 => '/var/www/yxcarnew/Home/View/Index/index.html',
      1 => 1528342284,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '7228526525bbdaf4f2895c3-17804768',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'wdNum' => 0,
    'isManager' => 0,
    'company_name' => 0,
    'user_phone' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.6',
  'unifunc' => 'content_5bbdaf4f2d948',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5bbdaf4f2d948')) {function content_5bbdaf4f2d948($_smarty_tpl) {?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
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
    <style>
        .dock-body span{
            position: absolute;
            top:2px;
            right: 2px;
            width: 18px;
            height: 18px;
            background: #ff0000;
            color: #ffffff;
            text-align: center;
            border-radius: 9px;
            font-size: 10px;
            line-height: 18px;
        }
    </style>
</head>
<body onselectstart="return false;" style="-moz-user-select:none;">
<div class="mainbody">
    <div id="cloud1" class="cloud" ></div>
    <div id="cloud2" class="cloud" ></div>
</div>
<div class="dock">
    <div class="dock-body">
        <ul>
            <!--更改密码-->
            <li onclick="openUrl('/index.php/Home/UserCenter/changeInfo','修改个人信息',1000,450)"><img src="<?php echo @PUBLIC_URL;?>
/images/icon/grxx.png" title="个人信息" ></li>
            <!--我的消息-->
            <li onclick="openUrl('/index.php/Home/UserCenter/changePwd','修改密码',1000,450)"><img src="<?php echo @PUBLIC_URL;?>
/images/icon/pwd.png" title="修改密码" ></li>

            <li onclick="openUrl('/index.php/Home/UserCenter/myMessage','站内信',1000,850)" style="position:relative;">
                <img src="<?php echo @PUBLIC_URL;?>
/images/icon/email.png" title="站内信" >
                <span><?php echo $_smarty_tpl->tpl_vars['wdNum']->value;?>
</span>
            </li>

            <li onclick="loginOut()"><img src="<?php echo @PUBLIC_URL;?>
/images/icon/tuichu.png" title="退出" ></li>
        </ul>
    </div>
    <div class="dock-bottom"></div>
</div>
<div class="diskicon" style="display:inline-block; width:auto;">
    <ul>
        <li text="出行管理" icon="<?php echo @PUBLIC_URL;?>
/images/icon/travel.png" path="/index.php/Home/Travel/signTravel" data-property="{ title:'出行管理',minimize:'true',maximize:'false',target:'iframe',multiple:'false' }" data-style="[{ name:'left',value:'0px' },{ name:'top',value:'0px' }]" ><span class="icon"><span class="icon"><img src="<?php echo @PUBLIC_URL;?>
/images/icon/travel.png" title="出行管理" ></span><span class="text">出行管理</span></li>

        <?php if ($_smarty_tpl->tpl_vars['isManager']->value=="1"){?>
        <li text="单位管理" icon="<?php echo @PUBLIC_URL;?>
/images/icon/company.png" path="/index.php/Home/Company/reviewTravel" data-property="{ title:'单位管理',minimize:'true',maximize:'false',target:'iframe',multiple:'false' }" data-style="[{ name:'left',value:'0px' },{ name:'top',value:'0px' }]" ><span class="icon"><span class="icon"><img src="<?php echo @PUBLIC_URL;?>
/images/icon/company.png" title="单位管理" ></span><span class="text">单位管理</span></li>
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
        <li class="datetime" id="datetime3"><p><?php echo $_smarty_tpl->tpl_vars['company_name']->value;?>
</p></li>
        <li class="datetime" id="datetime2"><p><?php echo $_smarty_tpl->tpl_vars['user_phone']->value;?>
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
        window.location.href="/index.php/Home/User/loginOut";
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