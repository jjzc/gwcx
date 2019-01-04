<?php /* Smarty version Smarty-3.1.6, created on 2018-10-18 09:33:53
         compiled from "/var/www/yxcarnew/Home/View/UserCenter/changeInfo.html" */ ?>
<?php /*%%SmartyHeaderCode:8644582755bc7e301909640-70852548%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '2be843ebf9beb055ce02e2ba62a9fc3f67fa9c48' => 
    array (
      0 => '/var/www/yxcarnew/Home/View/UserCenter/changeInfo.html',
      1 => 1528340300,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '8644582755bc7e301909640-70852548',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'user' => 0,
    'company' => 0,
    'car' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.6',
  'unifunc' => 'content_5bc7e3019834f',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5bc7e3019834f')) {function content_5bc7e3019834f($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_date_format')) include '/var/www/yxcarnew/ThinkPHP/Library/Vendor/Smarty/plugins/modifier.date_format.php';
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>修改个人信息</title>


    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
    <link href="<?php echo @PUBLIC_URL;?>
/assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo @PUBLIC_URL;?>
/assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo @PUBLIC_URL;?>
//assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo @PUBLIC_URL;?>
/assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->
    <!-- BEGIN THEME GLOBAL STYLES -->
    <link href="<?php echo @PUBLIC_URL;?>
/assets/global/css/components.min.css" rel="stylesheet" id="style_components" type="text/css" />
    <link href="<?php echo @PUBLIC_URL;?>
/assets/global/css/plugins.min.css" rel="stylesheet" type="text/css" />

    <link href="<?php echo @PUBLIC_URL;?>
/assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo @PUBLIC_URL;?>
/assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo @PUBLIC_URL;?>
/assets/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo @PUBLIC_URL;?>
/assets/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo @PUBLIC_URL;?>
/assets/global/plugins/bootstrap-toastr/toastr.min.css" rel="stylesheet" type="text/css" />

    <!-- END THEME GLOBAL STYLES -->
    <!-- BEGIN THEME LAYOUT STYLES -->
    <link href="<?php echo @PUBLIC_URL;?>
/assets/layouts/layout/css/layout.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo @PUBLIC_URL;?>
/assets/layouts/layout/css/themes/darkblue.min.css" rel="stylesheet" type="text/css" id="style_color" />
    <link href="<?php echo @PUBLIC_URL;?>
/assets/layouts/layout/css/custom.min.css" rel="stylesheet" type="text/css" />

</head>
<body class="page-header-fixed page-sidebar-closed-hide-logo page-content-white"  style="background: #FFFFFF;">
<div class="page-wrapper">
    <div class="page-content">
        <div>
            <div class="portlet light">
                <div class="portlet-body form">
                <form class="form-horizontal" role="form" action="/index.php/Home/UserCenter/changeInfoDo" method="post" id="editCarForm">
                    <input type="hidden" name="id" value="<?php echo $_smarty_tpl->tpl_vars['user']->value['id'];?>
">

                    <div class="form-body">
                        <div class="form-group col-md-6">
                            <label class="col-md-4 control-label">手机号码</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control input-inline input-medium" placeholder="手机号码" name="user_phone" id="user_phone" value="<?php echo $_smarty_tpl->tpl_vars['user']->value['user_phone'];?>
" readonly>
                                <span style="color: #FF0000;">*</span>
                            </div>
                        </div>

                        <div class="form-group col-md-6">
                            <label class="col-md-4 control-label">所在单位</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control input-inline input-medium" placeholder="所在单位" value="<?php echo $_smarty_tpl->tpl_vars['company']->value['company_name'];?>
" readonly>
                                <span style="color: #FF0000;">*</span>
                            </div>
                        </div>

                        <div class="form-group col-md-6">
                            <label class="col-md-4 control-label">姓名</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control input-inline input-medium" placeholder="车牌号码"  name="user_name" id="user_name" value="<?php echo $_smarty_tpl->tpl_vars['user']->value['user_name'];?>
">
                                <span style="color: #FF0000;">*</span>
                            </div>
                        </div>



                        <div class="form-group col-md-6">
                            <label class="col-md-4 control-label">身份证号码</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control input-inline input-medium" placeholder="身份证号码" name="user_idcard" id="user_idcard" value="<?php echo $_smarty_tpl->tpl_vars['user']->value['user_idcard'];?>
">
                                <span style="color: #FF0000;">*</span>
                            </div>
                        </div>

                        <div class="form-group col-md-6">
                            <label class="col-md-4 control-label">性别</label>
                            <div class="col-md-8">
                                <select class="form-control input-inline input-medium"  name="user_sex">
                                    <option value="男" <?php if ($_smarty_tpl->tpl_vars['user']->value['user_sex']=="男"){?>selected = "selected" <?php }?> >男</option>
                                    <option value="女" <?php if ($_smarty_tpl->tpl_vars['user']->value['user_sex']=="女"){?>selected = "selected" <?php }?>>女</option>
                                </select>
                            </div>
                        </div>



                        <div class="form-group col-md-6">
                            <label class="col-md-4 control-label">邮箱</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control input-inline input-medium" placeholder="邮箱" name="user_email" value="<?php echo $_smarty_tpl->tpl_vars['user']->value['user_email'];?>
">
                            </div>
                        </div>


                        <!--<div class="form-group col-md-6">-->
                            <!--<label class="col-md-4 control-label">购买日期</label>-->
                            <!--<div class="col-md-8">-->
                                <!--<div class="input-group date form_datetime  input-medium" data-date="" data-date-format="yyyy-mm-dd" data-link-field="dtp_input1">-->
                                    <!--<input name="buy_time" class="form-control" size="16" type="text" value="<?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['car']->value['buy_time'],'%Y-%m-%d');?>
" readonly>-->
                                    <!--<span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>-->
                                    <!--<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>-->
                                <!--</div>-->
                            <!--</div>-->
                        <!--</div>-->




                    </div>
                    <div class="form-actions col-md-12">
                        <div class="row">
                            <div class="col-md-offset-5 col-md-7">
                                <button type="submit" class="btn green" >提交</button>
                                <button type="button" class="btn default" onClick="layer_close();">取消</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            </div>
        </div>
    </div>
</div>
</body>
<script src="<?php echo @PUBLIC_URL;?>
/assets/global/plugins/jquery.min.js" type="text/javascript"></script>
<script src="<?php echo @PUBLIC_URL;?>
/assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>

<script src="<?php echo @PUBLIC_URL;?>
/assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.js" type="text/javascript"></script>
<script src="<?php echo @PUBLIC_URL;?>
/assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
<script src="<?php echo @PUBLIC_URL;?>
/assets/global/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js" type="text/javascript"></script>

<script src="<?php echo @PUBLIC_URL;?>
/assets/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js" type="text/javascript"></script>
<script src="<?php echo @PUBLIC_URL;?>
/assets/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.zh-CN.js" type="text/javascript"></script>
<script src="<?php echo @PUBLIC_URL;?>
/assets/global/plugins/clockface/js/clockface.js" type="text/javascript"></script>
<script src="<?php echo @PUBLIC_URL;?>
/js/jquery.form.js" type="text/javascript"></script>
<script src="<?php echo @PUBLIC_URL;?>
/assets/global/plugins/bootstrap-toastr/toastr.min.js" type="text/javascript"></script>
<script src="<?php echo @PUBLIC_URL;?>
/js/js.js" type="text/javascript"></script>
<script src="<?php echo @PUBLIC_URL;?>
/plugin/layer/layer.js" type="text/javascript"></script>

<script>
    toastr.options = {
        "closeButton": false,
        "debug": false,
        "positionClass": "toast-top-center",
        "onclick": null,
        "showDuration": "1000",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    };

    $('.form_datetime').datetimepicker({
        language:  'zh-CN',
        weekStart: 1,
        todayBtn:  1,
        autoclose: 1,
        todayHighlight: 1,
        startView: 2,
        forceParse: 0,
        minView: 2,
        showMeridian: 1
    });


    $("#editCarForm").submit(function () {

        //校验数据
        //toastr.error('Are you the 6 fingered man?');
        //if(isE($("#car_name").val())){ toastr.error('车辆名称不得为空！');  $("#car_name").focus();return false; }
        //if(isE($("#brand").val())){ toastr.error('车辆品牌不得为空！');  $("#brand").focus();return false; }
        //if(isE($("#car_num").val())){ toastr.error('车牌号码不得为空！');  $("#car_num").focus();return false; }
        //if(isE($("#seat_num").val())){ toastr.error('座位数不得为空！');  $("#seat_num").focus();return false; }

        //if(isNaN($("#seat_num").val())){ toastr.error('座位数只能为数字！');  $("#seat_num").focus();return false; }

        $(this).ajaxSubmit(function (data) {
            if(data.code==1){
                layer.msg('修改成功!', { icon: 1 });
                setTimeout("window.parent.location.reload()",2000);
            }else{
                layer.msg('提交失败，请重试!', { icon: 0 });
            }
        });
        return false;
    })




</script>
</html>


<?php }} ?>