<?php /* Smarty version Smarty-3.1.6, created on 2018-10-11 10:23:24
         compiled from "/var/www/yxcarnew/Home/View/Down/download.html" */ ?>
<?php /*%%SmartyHeaderCode:4986148355bbeb41cc674b5-35127664%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '45b567f822994129d481bd8adfe32cc8b5d7eede' => 
    array (
      0 => '/var/www/yxcarnew/Home/View/Down/download.html',
      1 => 1517446126,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '4986148355bbeb41cc674b5-35127664',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'userApp' => 0,
    'driverApp' => 0,
    'adminApp' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.6',
  'unifunc' => 'content_5bbeb41cc9bbe',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5bbeb41cc9bbe')) {function content_5bbeb41cc9bbe($_smarty_tpl) {?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Android版本下载</title>
    <style>
    html,body{
        font-family:"ff-tisa-web-pro-1","ff-tisa-web-pro-2","Lucida Grande","Helvetica Neue",Helvetica,Arial,"Microsoft YaHei","Hiragino Sans GB","Hiragino Sans GB W3","WenQuanYi Micro Hei",sans-serif;
        -webkit-font-smoothing:antialiased;
        height: 100%;
        padding: 0;
        margin: 0;
    }
    html{
        background: url(/Public/images/bg.jpg) no-repeat center center;
        -webkit-background-size: cover;
        background-size: cover;
        background-attachment: fixed;
    }
    body{
        display:table;
        text-align:center;
        table-layout: fixed;
        border-collapse: collapse;
        width: 100%;
    }
    .wrapper{
        margin: auto;
        width: 100%;
        height: 100%;
        position: relative;
        overflow: hidden;
        display: table-cell;
        vertical-align: middle;
    }
    #btnContainer{
        height: 86px;
        width: 229px;
        display: block;
        margin: 0 auto;
        position: relative;
        background: transparent;
    }
    #btnA{
        height: 86px;
        width: 229px;
        border-radius: 1em;
        display: block;
        background: url(/Public/images/a.png) no-repeat;
        -webkit-background-size: 229px 172px;
        background-size: 229px 172px;
        text-decoration: none;
        position: relative;
        z-index: 2;
    }
    #btnA:active, #btnA.active{
        background-position: 0px -92px;
        -webkit-background-size: 229px 172px;
        background-size: 229px 172px;
    }
    #slogan{
        position: relative; top: -2em;
        width: 230px; height: 68px; margin: 0 auto;
        background: url(/Public/images/api-slogan.png) no-repeat center center;
        -webkit-background-size: contain;
        background-size: contain;
    }
    #btnSpan2,#btnSpan3{
        font-size: .8em;
        color: #A7A7A7;
        position: absolute;
        top: 20px;
        left: 68px;
    }
    #btnSpan3{
        top: 44px;
    }

    .aaa{
        position: absolute;
        width: 100%;
    }
    .aaa img{
        width: 100%;
        height: auto;

    }
    </style>
</head>
<body>
    <div style="width: 100%; height: auto;" class="aaa">
        <img src="/Public/images/download_top.png"/>
    </div>


    <div class="wrapper">        
        <!-- <h1 id="slogan"></h1> -->
        <div id="btnContainer">
            <a id="btnA" href="<?php echo $_smarty_tpl->tpl_vars['userApp']->value['url'];?>
">
                <span id="btnSpan2">v<?php echo $_smarty_tpl->tpl_vars['userApp']->value['version'];?>
</span>
                <span id="btnSpan3">用户端</span>
            </a>
            <a id="btnA" href="<?php echo $_smarty_tpl->tpl_vars['driverApp']->value['url'];?>
">
                <span id="btnSpan2">v<?php echo $_smarty_tpl->tpl_vars['driverApp']->value['version'];?>
</span>
                <span id="btnSpan3">司机端</span>
            </a>
            <a id="btnA" href="<?php echo $_smarty_tpl->tpl_vars['adminApp']->value['url'];?>
">
                <span id="btnSpan2">v<?php echo $_smarty_tpl->tpl_vars['adminApp']->value['version'];?>
</span>
                <span id="btnSpan3">后台端</span>
            </a>
        </div>
    </div>
    <script type="text/javascript">
        window.onload = function(){
            var btn = document.getElementById('btnA');
            btn.addEventListener('touchstart',function(event){
                this.className = 'active';
            },false);
            btn.addEventListener('mousedown',function(event){
                this.className = 'active';
            },false);
            btn.addEventListener('touchend',function(event){
                this.className = '';
            },false);
            btn.addEventListener('mouseup',function(event){
                this.className = '';
            },false);
        };
    </script>
    
</body>
</html><?php }} ?>