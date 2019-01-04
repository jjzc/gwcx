<?php /* Smarty version Smarty-3.1.6, created on 2018-12-13 09:21:36
         compiled from "D:/xampp/htdocs/Admin/View\Company\editCompany.html" */ ?>
<?php /*%%SmartyHeaderCode:25535bee656a860d38-20081264%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '120195fc492298e9ce8002a58afba51518e2cea3' => 
    array (
      0 => 'D:/xampp/htdocs/Admin/View\\Company\\editCompany.html',
      1 => 1543804932,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '25535bee656a860d38-20081264',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.6',
  'unifunc' => 'content_5bee656aadd95',
  'variables' => 
  array (
    'company' => 0,
    'users' => 0,
    'v' => 0,
    'cars' => 0,
    'drivers' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5bee656aadd95')) {function content_5bee656aadd95($_smarty_tpl) {?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>编辑单位</title>


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
                <form class="form-horizontal" role="form" action="/index.php/Admin/Company/editCompanyDo" method="post" id="addDriverForm">

                    <input type="hidden" name="id" value="<?php echo $_smarty_tpl->tpl_vars['company']->value['id'];?>
">

                    <div class="form-body">

                        <div class="form-group col-md-6">
                            <label class="col-md-4 control-label">单位名称</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control input-inline input-medium" placeholder="单位名称" name="company_name" id="company_name" value="<?php echo $_smarty_tpl->tpl_vars['company']->value['company_name'];?>
">
                                <span style="color: #FF0000;">*</span>
                            </div>
                        </div>





                        <div class="form-group col-md-6">
                            <label class="col-md-4 control-label">单位地址</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control input-inline input-medium" placeholder="单位地址" name="company_address" id="company_address" value="<?php echo $_smarty_tpl->tpl_vars['company']->value['company_name'];?>
">
                            </div>
                        </div>

                        <div class="form-group col-md-6">
                            <label class="col-md-4 control-label">单位电话</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control input-inline input-medium" placeholder="单位电话" name="company_phone" id="company_phone" value="<?php echo $_smarty_tpl->tpl_vars['company']->value['company_phone'];?>
">
                            </div>
                        </div>

                        <div class="form-group col-md-6">
                            <label class="col-md-4 control-label">单位所属机构</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control input-inline input-medium" placeholder="单位所属机构"  name="company_superior" id="company_superior" value="<?php echo $_smarty_tpl->tpl_vars['company']->value['company_superior'];?>
">
                            </div>
                        </div>

                        <div class="form-group col-md-6">
                            <label class="col-md-4 control-label">委托管理部门</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control input-inline input-medium" placeholder="委托管理部门" name="department"  value="<?php echo $_smarty_tpl->tpl_vars['company']->value['department'];?>
">
                            </div>
                        </div>

                        <div class="form-group col-md-6">
                            <label class="col-md-4 control-label">单位管理员</label>
                            <div class="col-md-8">
                                <select class="form-control input-inline input-medium" name="company_manager_id">
                                    <?php  $_smarty_tpl->tpl_vars['v'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['v']->_loop = false;
 $_smarty_tpl->tpl_vars['k'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['users']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['v']->key => $_smarty_tpl->tpl_vars['v']->value){
$_smarty_tpl->tpl_vars['v']->_loop = true;
 $_smarty_tpl->tpl_vars['k']->value = $_smarty_tpl->tpl_vars['v']->key;
?>
                                    <option value="<?php echo $_smarty_tpl->tpl_vars['v']->value['id'];?>
" <?php if ($_smarty_tpl->tpl_vars['company']->value['company_manager_id']==$_smarty_tpl->tpl_vars['v']->value['id']){?>selected = "selected"<?php }?>><?php echo $_smarty_tpl->tpl_vars['v']->value['user_name'];?>
--<?php echo $_smarty_tpl->tpl_vars['v']->value['user_phone'];?>
</option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>


                        <div class="form-group col-md-6">
                            <label class="col-md-4 control-label">定向车辆</label>
                            <div class="col-md-8">
                                <select name="dx_car" id="dx_car" class="form-control input-inline input-medium">
                                    <option value="0">无</option>
                                    <?php  $_smarty_tpl->tpl_vars['v'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['v']->_loop = false;
 $_smarty_tpl->tpl_vars['k'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['cars']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['v']->key => $_smarty_tpl->tpl_vars['v']->value){
$_smarty_tpl->tpl_vars['v']->_loop = true;
 $_smarty_tpl->tpl_vars['k']->value = $_smarty_tpl->tpl_vars['v']->key;
?>
                                    <option value="<?php echo $_smarty_tpl->tpl_vars['v']->value['id'];?>
"  <?php if ($_smarty_tpl->tpl_vars['company']->value['dx_car']==$_smarty_tpl->tpl_vars['v']->value['id']){?>selected = "selected"<?php }?>  <?php if ($_smarty_tpl->tpl_vars['v']->value['is_dx']==1){?>disabled="disabled"<?php }?>  ><?php echo $_smarty_tpl->tpl_vars['v']->value['car_num'];?>
</option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group col-md-6">
                            <label class="col-md-4 control-label">定向司机</label>
                            <div class="col-md-8">
                                <select name="dx_driver" id="dx_driver" class="form-control input-inline input-medium">
                                    <option value="0">无</option>
                                    <?php  $_smarty_tpl->tpl_vars['v'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['v']->_loop = false;
 $_smarty_tpl->tpl_vars['k'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['drivers']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['v']->key => $_smarty_tpl->tpl_vars['v']->value){
$_smarty_tpl->tpl_vars['v']->_loop = true;
 $_smarty_tpl->tpl_vars['k']->value = $_smarty_tpl->tpl_vars['v']->key;
?>
                                    <option value="<?php echo $_smarty_tpl->tpl_vars['v']->value['id'];?>
" <?php if ($_smarty_tpl->tpl_vars['company']->value['dx_driver']==$_smarty_tpl->tpl_vars['v']->value['id']){?>selected = "selected"<?php }?>  <?php if ($_smarty_tpl->tpl_vars['v']->value['is_dx']==1){?>disabled="disabled"<?php }?>><?php echo $_smarty_tpl->tpl_vars['v']->value['driver_name'];?>
</option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>







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


    $("#addDriverForm").submit(function () {



        //校验数据
        //toastr.error('Are you the 6 fingered man?');
        //if(isE($("#company_name").val())){ toastr.error('单位名称不得为空！');  $("#company_name").focus();return false; }
        //if(isE($("#user_phone").val())){ toastr.error('管理员电话不得为空！');  $("#user_phone").focus();return false; }
        //if(isE($("#user_name").val())){ toastr.error('管理员姓名不得为空！');  $("#user_name").focus();return false; }



        $(this).ajaxSubmit(function (data) {
            if(data.code==1){
                layer.msg('修改成功!', { icon: 1 });
                setTimeout("window.parent.location.reload()",2000);
            }else{
                layer.msg(data.error, { icon: 0 });
            }
        });
        return false;
    })




</script>
</html>


<?php }} ?>