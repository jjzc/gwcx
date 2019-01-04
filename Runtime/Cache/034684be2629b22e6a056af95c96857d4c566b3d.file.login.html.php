<?php /* Smarty version Smarty-3.1.6, created on 2018-08-09 09:15:39
         compiled from "E:/PhpStorm/yxcar/Home/View\User\login.html" */ ?>
<?php /*%%SmartyHeaderCode:317405b6b95bb755a61-96293107%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '034684be2629b22e6a056af95c96857d4c566b3d' => 
    array (
      0 => 'E:/PhpStorm/yxcar/Home/View\\User\\login.html',
      1 => 1533196062,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '317405b6b95bb755a61-96293107',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'error' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.6',
  'unifunc' => 'content_5b6b95bba2cc2',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5b6b95bba2cc2')) {function content_5b6b95bba2cc2($_smarty_tpl) {?><!DOCTYPE html>
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
        <h1 text="岳阳市云溪区公务用车管理平台">岳阳市云溪区公务用车管理平台</h1>
        <h2 text="YUE YANG CITY YUN XI DISTRICT OFFICIAL VENICLE MANAGEMENT PLATFORM">YUE YANG CITY YUN XI DISTRICT OFFICIAL VENICLE MANAGEMENT PLATFORM</h2>
      </dd>
    </div>
    <div class="input_box">
      <div class="boxtitle">
        用户端－登陆
      </div>
      <div class="input_row">
        <form method="post" action="<?php echo @__SELF__;?>
">
        <input type="text" name="user_phone" id="user_phone" value="" class="input_account" placeholder="手机号码" />
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
</script>
<?php }} ?>