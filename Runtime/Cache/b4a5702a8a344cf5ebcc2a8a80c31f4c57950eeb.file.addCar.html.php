<?php /* Smarty version Smarty-3.1.6, created on 2018-10-12 17:12:08
         compiled from "/var/www/yxcarnew/Admin/View/Car/addCar.html" */ ?>
<?php /*%%SmartyHeaderCode:14561426555bc06568a83073-17783486%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b4a5702a8a344cf5ebcc2a8a80c31f4c57950eeb' => 
    array (
      0 => '/var/www/yxcarnew/Admin/View/Car/addCar.html',
      1 => 1530648660,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '14561426555bc06568a83073-17783486',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'carTypes' => 0,
    'v' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.6',
  'unifunc' => 'content_5bc06568b0eea',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5bc06568b0eea')) {function content_5bc06568b0eea($_smarty_tpl) {?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>新增车辆</title>


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
                <form class="form-horizontal" role="form" action="/index.php/Admin/Car/addCarDo" method="post" id="addCarForm">
                    <div class="form-body">

                        <div class="form-group col-md-6">
                            <label class="col-md-4 control-label">车辆名称</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control input-inline input-medium" placeholder="车辆名称" name="car_name" id="car_name">
                                <span style="color: #FF0000;">*</span>
                            </div>
                        </div>

                        <div class="form-group col-md-6">
                            <label class="col-md-4 control-label">车辆品牌</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control input-inline input-medium" placeholder="车辆品牌" name="brand" id="brand">
                                <span style="color: #FF0000;">*</span>
                            </div>
                        </div>

                        <div class="form-group col-md-6">
                            <label class="col-md-4 control-label">车牌号码</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control input-inline input-medium" placeholder="车牌号码"  name="car_num" id="car_num">
                                <span style="color: #FF0000;">*</span>
                            </div>
                        </div>



                        <div class="form-group col-md-6">
                            <label class="col-md-4 control-label">座位数</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control input-inline input-medium" placeholder="座位数，只能为纯数字" name="seat_num" id="seat_num">
                                <span style="color: #FF0000;">*</span>
                            </div>
                        </div>

                        <div class="form-group col-md-6">
                            <label class="col-md-4 control-label">车辆性质</label>
                            <div class="col-md-8">
                                <select class="form-control input-inline input-medium"  name="is_law_car">
                                    <option value="0">自有车辆</option>
                                    <option value="1">执法车辆</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group col-md-6">
                            <label class="col-md-4 control-label">车辆类型</label>
                            <div class="col-md-8">
                                <select class="form-control input-inline input-medium" name="type_id">
                                    <?php  $_smarty_tpl->tpl_vars['v'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['v']->_loop = false;
 $_smarty_tpl->tpl_vars['k'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['carTypes']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['v']->key => $_smarty_tpl->tpl_vars['v']->value){
$_smarty_tpl->tpl_vars['v']->_loop = true;
 $_smarty_tpl->tpl_vars['k']->value = $_smarty_tpl->tpl_vars['v']->key;
?>
                                    <option value="<?php echo $_smarty_tpl->tpl_vars['v']->value['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['v']->value['type_name'];?>
</option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>



                        <div class="form-group col-md-6">
                            <label class="col-md-4 control-label">编号</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control input-inline input-medium" placeholder="车辆编号" name="number">
                            </div>
                        </div>

                        <div class="form-group col-md-6">
                            <label class="col-md-4 control-label">车机IMEI编码</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control input-inline input-medium" placeholder="车机IMEI编码，启用车载GPS生效" name="imei">
                            </div>
                        </div>


                        <div class="form-group col-md-6">
                            <label class="col-md-4 control-label">原属单位</label>
                            <div class="col-md-8">
                            <input type="text" name="old_company"  class="form-control input-inline input-medium" placeholder="原属单位">
                            </div>
                        </div>

                        <div class="form-group col-md-6">
                            <label class="col-md-4 control-label">现属单位</label>
                            <div class="col-md-8">
                            <input type="text" name="new_company"  class="form-control input-inline input-medium" placeholder="现属单位">
                            </div>
                        </div>


                        <div class="form-group col-md-6">
                            <label class="col-md-4 control-label">是否有行驶证</label>
                            <div class="col-md-8">
                            <select class="form-control input-inline input-medium" name="hava_driver_lince">
                                <option value="有">有</option>
                                <option value="无">无</option>
                            </select>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="col-md-4 control-label">是否有登记证</label>
                            <div class="col-md-8">
                            <select class="form-control input-inline input-medium" name="have_registration">
                                <option value="有">有</option>
                                <option value="无">无</option>
                            </select>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="col-md-4 control-label">车辆购置税</label>
                            <div class="col-md-8">
                            <select class="form-control input-inline input-medium" name="have_tax">
                                <option value="有">有</option>
                                <option value="无">无</option>
                            </select>
                            </div>
                        </div>








                        <div class="form-group col-md-6">
                            <label class="col-md-4 control-label">商业险到期时间</label>
                            <div class="col-md-8">
                            <div class="input-group date form_datetime input-medium" data-date="" data-date-format="yyyy-mm-dd" data-link-field="dtp_input1">
                                <input name="commercial_insurance_time" class="form-control" size="16" type="text" value="" readonly>
                                <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                                <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                            </div>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="col-md-4 control-label">下次年检时间</label>
                            <div class="col-md-8">
                            <div class="input-group date form_datetime  input-medium" data-date="" data-date-format="yyyy-mm-dd" data-link-field="dtp_input1">
                                <input name="next_inspect_time" class="form-control" size="16" type="text" value="" readonly>
                                <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                                <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                            </div>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="col-md-4 control-label">购买日期</label>
                            <div class="col-md-8">
                                <div class="input-group date form_datetime  input-medium" data-date="" data-date-format="yyyy-mm-dd" data-link-field="dtp_input1">
                                    <input name="buy_time" class="form-control" size="16" type="text" value="" readonly>
                                    <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                                </div>
                            </div>
                        </div>


                        <div class="form-group col-md-6">
                            <label class="col-md-4 control-label">发动机号码</label>
                            <div class="col-md-8">
                                <input type="text" name="engine_num" class="form-control input-inline input-medium" placeholder="发动机号码">
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="col-md-4 control-label">车架号</label>
                            <div class="col-md-8">
                                <input type="text" name="frame_num"  class="form-control input-inline input-medium" placeholder="车架号">
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="col-md-4 control-label">下次保养公里数</label>
                            <div class="col-md-8">
                                <input type="text" name="next_maintain_num"  class="form-control input-inline input-medium" placeholder="下次保养公里数">
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="col-md-4 control-label">当前公里数</label>
                            <div class="col-md-8">
                                <input type="text" name="maintain_interval"  class="form-control input-inline input-medium" placeholder="当前公里数">
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="col-md-4 control-label">交强险到期时间</label>
                            <div class="col-md-8">
                                <div class="input-group date form_datetime  input-medium" data-date="" data-date-format="yyyy-mm-dd" data-link-field="dtp_input1">
                                    <input name="compulsory_insurance_time" class="form-control" size="16" type="text" value="" readonly>
                                    <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                                </div>
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
        if(isE($("#car_name").val())){ toastr.error('车辆名称不得为空！');  $("#car_name").focus();return false; }
        if(isE($("#brand").val())){ toastr.error('车辆品牌不得为空！');  $("#brand").focus();return false; }
        if(isE($("#car_num").val())){ toastr.error('车牌号码不得为空！');  $("#car_num").focus();return false; }
        if(isE($("#seat_num").val())){ toastr.error('座位数不得为空！');  $("#seat_num").focus();return false; }

        if(isNaN($("#seat_num").val())){ toastr.error('座位数只能为数字！');  $("#seat_num").focus();return false; }




        $(this).ajaxSubmit(function (data) {
            if(data.code==1){
                layer.msg('新增成功!', { icon: 1 });
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