<?php /* Smarty version Smarty-3.1.6, created on 2018-08-02 08:40:40
         compiled from "H:/dxcar/Home/View\User\login.html" */ ?>
<?php /*%%SmartyHeaderCode:300815b61364edbf9d8-34360007%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '674de53058167fb4b5caa7806e943c2d7ed53372' => 
    array (
      0 => 'H:/dxcar/Home/View\\User\\login.html',
      1 => 1533170290,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '300815b61364edbf9d8-34360007',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.6',
  'unifunc' => 'content_5b61364edfe1d',
  'variables' => 
  array (
    'error' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5b61364edfe1d')) {function content_5b61364edfe1d($_smarty_tpl) {?><!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <title><?php echo @WEB_NAME;?>
--登陆</title>
  <link rel="stylesheet" type="text/css" href="<?php echo @PUBLIC_URL;?>
/css/login.css"/>
</head>
<body>
<!--cbe1ff-->
<div class="login_box">
  <div class="top_row">
    <div class="top_con">
      <img src="<?php echo @PUBLIC_URL;?>
/img/login_logo.png"/>
      <dd>
        <h1 text="永州市道县公务用车管理平台">永州市道县公务用车管理平台</h1>
        <h2 text="YONG ZHOU CITY DAO XIAN DISTRICT OFFICIAL VENICLE MANAGEMENT PLATFORM">YONG ZHOU CITY DAO XIAN DISTRICT OFFICIAL VENICLE MANAGEMENT PLATFORM</h2>
      </dd>
    </div>
    <div class="input_box">
      <div class="boxtitle">
        用户端－登陆
      </div>
      <div class="input_row">
        <form method="post" action="<?php echo @__SELF__;?>
">
        <input type="text" name="user_phone" id="user_phone" value="" class="input_account" placeholder="用户名" />
        <input type="password" name="user_pwd" type="password" value="" class="input_account" placeholder="密码" />
        <button type="submit">立即登陆</button>
        </form>
      </div>
      <h4 style="color: #FF0000;"><?php echo $_smarty_tpl->tpl_vars['error']->value;?>
</h4>
    </div>
    <div class="buttom_info">
      <p>公务用车管理平台联系人  XXX  联系电话：XXXXXX</p>
      <p>技术支持：湖南玖玖华安网络科技有限公司</p>
    </div>
  </div>
</div>
</body>
</html>


<script type="text/javascript" src="<?php echo @PUBLIC_URL;?>
/js/jquery-1.11.1.min.js" ></script>
<script type="text/javascript">
    $(document).ready(function(){
        //设置窗口高度
        $(document.body).height($(window).height());
    });

    $(window).resize(function() {
        $(document.body).height($(window).height());
    });
</script><?php }} ?>