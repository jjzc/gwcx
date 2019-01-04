<?php /* Smarty version Smarty-3.1.6, created on 2018-10-11 15:24:32
         compiled from "D:/xampp/htdocs/Home/View\User\login.html" */ ?>
<?php /*%%SmartyHeaderCode:24995b95c81fd3d7b2-67060729%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '3abce998ba238674a96aee3bea334e2d803ff408' => 
    array (
      0 => 'D:/xampp/htdocs/Home/View\\User\\login.html',
      1 => 1537236344,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '24995b95c81fd3d7b2-67060729',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.6',
  'unifunc' => 'content_5b95c81fdbe65',
  'variables' => 
  array (
    'error' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5b95c81fdbe65')) {function content_5b95c81fdbe65($_smarty_tpl) {?><!DOCTYPE html>
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
        <h1 text="<?php echo @NAME_CN;?>
"><?php echo @NAME_CN;?>
</h1>
        <h2 text="<?php echo @NAME_EN;?>
"><?php echo @NAME_EN;?>
</h2>
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