<?php /* Smarty version Smarty-3.1.6, created on 2018-10-10 11:36:34
         compiled from "/var/www/yxcarnew/Admin/View/Travel/finishTravel.html" */ ?>
<?php /*%%SmartyHeaderCode:14613705635bbd73c2acb1d6-54040789%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '978a68218ee27da5b0808a9e5a4e2b0675e9fb02' => 
    array (
      0 => '/var/www/yxcarnew/Admin/View/Travel/finishTravel.html',
      1 => 1528435684,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '14613705635bbd73c2acb1d6-54040789',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'travel' => 0,
    'pay_types' => 0,
    'v' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.6',
  'unifunc' => 'content_5bbd73c2b451d',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5bbd73c2b451d')) {function content_5bbd73c2b451d($_smarty_tpl) {?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>完成服务</title>


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
                <form class="form-horizontal" role="form" action="/index.php/Admin/Travel/finishTravelDo" method="post" id="addCarForm">
                    <input type="hidden" name="id" value="<?php echo $_smarty_tpl->tpl_vars['travel']->value['id'];?>
">
                    <div class="form-body">

                        <div class="form-group col-md-6">
                            <label class="col-md-4 control-label">支付方式</label>
                            <div class="col-md-8">
                                <select class="form-control input-inline input-medium"  name="pay_type" id="pay_type">
                                    <?php  $_smarty_tpl->tpl_vars['v'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['v']->_loop = false;
 $_smarty_tpl->tpl_vars['k'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['pay_types']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['v']->key => $_smarty_tpl->tpl_vars['v']->value){
$_smarty_tpl->tpl_vars['v']->_loop = true;
 $_smarty_tpl->tpl_vars['k']->value = $_smarty_tpl->tpl_vars['v']->key;
?>
                                    <?php if ($_smarty_tpl->tpl_vars['v']->value['is_del']==0){?><option value="<?php echo $_smarty_tpl->tpl_vars['v']->value['pay_name'];?>
"><?php echo $_smarty_tpl->tpl_vars['v']->value['pay_name'];?>
</option><?php }?>
                                    <?php } ?>
                                </select>
                                <span style="color: #FF0000;">*</span>
                            </div>
                        </div>

                        <div class="form-group col-md-6">
                            <label class="col-md-4 control-label">行驶里程</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control input-inline input-medium" placeholder="行驶里程，只能为纯数字" name="mileage" id="mileage">
                                <span style="color: #FF0000;">*</span>
                            </div>
                        </div>

                        <div class="form-group col-md-6">
                            <label class="col-md-4 control-label">开始公里数</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control input-inline input-medium" placeholder="开始公里数" name="start_kilometers" id="start_kilometers">
                                <span style="color: #FF0000;">*</span>
                            </div>
                        </div>

                        <div class="form-group col-md-6">
                            <label class="col-md-4 control-label">结束公里数</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control input-inline input-medium" placeholder="结束公里数"  name="end_kilometers" id="end_kilometers">
                                <span style="color: #FF0000;">*</span>
                            </div>
                        </div>


                        <div class="form-group col-md-6">
                            <label class="col-md-4 control-label">路桥费</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control input-inline input-medium" placeholder="路桥费"  name="fees_sum" id="fees_sum">
                                <span style="color: #FF0000;">*</span>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="col-md-4 control-label">停车费</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control input-inline input-medium" placeholder="停车费"  name="parking_rate_sum" id="parking_rate_sum">
                                <span style="color: #FF0000;">*</span>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="col-md-4 control-label">出行服务费</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control input-inline input-medium" placeholder="出行服务费"  name="service_charge" id="service_charge">
                                <span style="color: #FF0000;">*</span>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="col-md-4 control-label">司机住宿补贴</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control input-inline input-medium" placeholder="司机住宿补贴"  name="driver_cost" id="driver_cost">
                                <span style="color: #FF0000;">*</span>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="col-md-4 control-label">超时费</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control input-inline input-medium" placeholder="超时费"  name="over_time_cost" id="over_time_cost">
                                <span style="color: #FF0000;">*</span>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="col-md-4 control-label">超公里费</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control input-inline input-medium" placeholder="超公里费"  name="over_mileage_cost" id="over_mileage_cost">
                                <span style="color: #FF0000;">*</span>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="col-md-4 control-label">其他费用</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control input-inline input-medium" placeholder="其他费用"  name="else_cost" id="else_cost">
                                <span style="color: #FF0000;">*</span>
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


    $("#addCarForm").submit(function () {

        //校验数据
        //toastr.error('Are you the 6 fingered man?');
        // if(isE($("#car_name").val())){ toastr.error('车辆名称不得为空！');  $("#car_name").focus();return false; }
        // if(isE($("#brand").val())){ toastr.error('车辆品牌不得为空！');  $("#brand").focus();return false; }
        // if(isE($("#car_num").val())){ toastr.error('车牌号码不得为空！');  $("#car_num").focus();return false; }
        // if(isE($("#seat_num").val())){ toastr.error('座位数不得为空！');  $("#seat_num").focus();return false; }
        //
        // if(isNaN($("#seat_num").val())){ toastr.error('座位数只能为数字！');  $("#seat_num").focus();return false; }
        //
        //
        // if($("#is_dx").val()==1){
        //     if($("#company_id").val()==0){ toastr.error('请选择定向单位！');  $("#company_id").focus();return false; }
        //     if($("#driver_id").val()==0){ toastr.error('请选择定向司机！');  $("#driver_id").focus();return false; }
        // }

        $(this).ajaxSubmit(function (data) {
            if(data.code==1){
                layer.msg('提交成功!', { icon: 1 });
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