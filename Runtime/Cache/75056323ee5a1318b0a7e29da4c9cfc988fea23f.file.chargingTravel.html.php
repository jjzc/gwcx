<?php /* Smarty version Smarty-3.1.6, created on 2018-08-02 16:58:25
         compiled from "H:/dxcar/Admin/View\Travel\chargingTravel.html" */ ?>
<?php /*%%SmartyHeaderCode:262875b62c0a5e079e2-78078511%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '75056323ee5a1318b0a7e29da4c9cfc988fea23f' => 
    array (
      0 => 'H:/dxcar/Admin/View\\Travel\\chargingTravel.html',
      1 => 1533200302,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '262875b62c0a5e079e2-78078511',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.6',
  'unifunc' => 'content_5b62c0a5ee646',
  'variables' => 
  array (
    'travel' => 0,
    'pay_types' => 0,
    'v' => 0,
    'chargings' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5b62c0a5ee646')) {function content_5b62c0a5ee646($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_date_format')) include 'H:\\dxcar\\ThinkPHP\\Library\\Vendor\\Smarty\\plugins\\modifier.date_format.php';
?><!DOCTYPE html>
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
                <form class="form-horizontal" role="form" action="/index.php/Admin/Travel/chargingTravelDo" method="post" id="addCarForm">
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
" <?php if ($_smarty_tpl->tpl_vars['travel']->value['pay_type']==$_smarty_tpl->tpl_vars['v']->value['pay_name']){?>selected = "selected"<?php }?>><?php echo $_smarty_tpl->tpl_vars['v']->value['pay_name'];?>
</option><?php }?>
                                    <?php } ?>
                                </select>
                                <span style="color: #FF0000;">*</span>
                            </div>
                        </div>

                        <div class="form-group col-md-6">
                            <label class="col-md-4 control-label">行驶里程</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control input-inline input-medium" placeholder="行驶里程，只能为纯数字" name="mileage" id="mileage" value="<?php echo $_smarty_tpl->tpl_vars['travel']->value['mileage'];?>
">
                                <span style="color: #FF0000;">*</span>
                            </div>
                        </div>

                        <div class="form-group col-md-6">
                            <label class="col-md-4 control-label">开始公里数</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control input-inline input-medium" placeholder="开始公里数" name="start_kilometers" id="start_kilometers" value="<?php echo $_smarty_tpl->tpl_vars['travel']->value['start_kilometers'];?>
">
                                <span style="color: #FF0000;">*</span>
                            </div>
                        </div>

                        <div class="form-group col-md-6">
                            <label class="col-md-4 control-label">结束公里数</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control input-inline input-medium" placeholder="结束公里数"  name="end_kilometers" id="end_kilometers" value="<?php echo $_smarty_tpl->tpl_vars['travel']->value['end_kilometers'];?>
">
                                <span style="color: #FF0000;">*</span>
                            </div>
                        </div>


                        <div class="form-group col-md-6">
                            <label class="col-md-4 control-label">路桥费</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control input-inline input-medium" placeholder="路桥费"  name="fees_sum" id="fees_sum" value="<?php echo $_smarty_tpl->tpl_vars['travel']->value['fees_sum'];?>
">
                                <span style="color: #FF0000;">*</span>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="col-md-4 control-label">停车费</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control input-inline input-medium" placeholder="停车费"  name="parking_rate_sum" id="parking_rate_sum" value="<?php echo $_smarty_tpl->tpl_vars['travel']->value['parking_rate_sum'];?>
">
                                <span style="color: #FF0000;">*</span>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="col-md-4 control-label">出行服务费</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control input-inline input-medium" placeholder="出行服务费"  name="service_charge" id="service_charge" value="<?php echo $_smarty_tpl->tpl_vars['travel']->value['service_charge'];?>
">
                                <span style="color: #FF0000;">*</span>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="col-md-4 control-label">司机住宿补贴</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control input-inline input-medium" placeholder="司机住宿补贴"  name="driver_cost" id="driver_cost" value="<?php echo $_smarty_tpl->tpl_vars['travel']->value['driver_cost'];?>
">
                                <span style="color: #FF0000;">*</span>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="col-md-4 control-label">超时费</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control input-inline input-medium" placeholder="超时费"  name="over_time_cost" id="over_time_cost" value="<?php echo $_smarty_tpl->tpl_vars['travel']->value['over_time_cost'];?>
">
                                <span style="color: #FF0000;">*</span>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="col-md-4 control-label">超公里费</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control input-inline input-medium" placeholder="超公里费"  name="over_mileage_cost" id="over_mileage_cost" value="<?php echo $_smarty_tpl->tpl_vars['travel']->value['over_mileage_cost'];?>
">
                                <span style="color: #FF0000;">*</span>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="col-md-4 control-label">其他费用</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control input-inline input-medium" placeholder="其他费用"  name="else_cost" id="else_cost" value="<?php echo $_smarty_tpl->tpl_vars['travel']->value['else_cost'];?>
">
                                <span style="color: #FF0000;">*</span>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="col-md-4 control-label">司机补贴</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control input-inline input-medium" placeholder="其他费用"  name="driver_bt_cost" id="driver_bt_cost" value="<?php echo $_smarty_tpl->tpl_vars['travel']->value['driver_bt_cost'];?>
">
                                <span style="color: #FF0000;">*</span>
                            </div>
                        </div>
                    </div>

                    <div class="form-body col-md-12">
                        <div class="form-group col-md-6">
                            <label class="col-md-4 control-label">出车时间</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control input-inline input-medium" placeholder="出车时间"   value="<?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['travel']->value['start_car_time'],'%Y-%m-%d %H:%M:%S');?>
" readonly>
                                <span style="color: #FF0000;">*</span>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="col-md-4 control-label">结束用车时间</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control input-inline input-medium" placeholder="结束用车时间" value="<?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['travel']->value['end_use_car_time'],'%Y-%m-%d %H:%M:%S');?>
" readonly>
                                <span style="color: #FF0000;">*</span>
                            </div>
                        </div>
                    </div>

                    <div class="form-body col-md-12">

                        <div class="form-group col-md-6">
                            <label class="col-md-4 control-label">计费方式</label>
                            <div class="col-md-8">
                                <select class="form-control input-inline input-medium"  name="chargings" id="chargings">
                                    <option value="0">请选择计价方式</option>
                                    <?php  $_smarty_tpl->tpl_vars['v'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['v']->_loop = false;
 $_smarty_tpl->tpl_vars['k'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['chargings']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['v']->key => $_smarty_tpl->tpl_vars['v']->value){
$_smarty_tpl->tpl_vars['v']->_loop = true;
 $_smarty_tpl->tpl_vars['k']->value = $_smarty_tpl->tpl_vars['v']->key;
?>
                                    <?php if ($_smarty_tpl->tpl_vars['v']->value['type']==1){?>
                                    <option value="<?php echo $_smarty_tpl->tpl_vars['v']->value['price'];?>
" ><?php echo $_smarty_tpl->tpl_vars['v']->value['type_name'];?>
--市内--<?php echo $_smarty_tpl->tpl_vars['v']->value['start_time'];?>
--<?php echo $_smarty_tpl->tpl_vars['v']->value['end_time'];?>
</option>
                                    <?php }else{ ?>
                                    <option value="<?php echo $_smarty_tpl->tpl_vars['v']->value['price'];?>
" ><?php echo $_smarty_tpl->tpl_vars['v']->value['type_name'];?>
--市外--<?php echo $_smarty_tpl->tpl_vars['v']->value['start_time'];?>
--<?php echo $_smarty_tpl->tpl_vars['v']->value['end_time'];?>
</option>
                                    <?php }?>
                                    <?php } ?>
                                </select>
                                <span style="color: #FF0000;">*</span>
                            </div>
                        </div>

                        <div class="form-group col-md-6">
                            <label class="col-md-4 control-label">价格</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control input-inline input-medium" placeholder="价格"  name="price" id="price" readonly>
                                <span style="color: #FF0000;">*</span>
                            </div>
                        </div>
                    </div>

                    <div class="form-body col-md-12">
                        <div class="form-group col-md-6">
                            <label class="col-md-4 control-label">补贴类型</label>
                            <div class="col-md-8">
                                <select class="form-control input-inline input-medium"  name="driver_bt_type" id="driver_bt_type">
                                    <option value="0" price="0">请选择补贴类型</option>
                                    <option value="1" price="20">下乡</option>
                                    <option value="2" price="60">市内</option>
                                    <option value="3" price="100">市外</option>
                                </select>
                                <span style="color: #FF0000;">*</span>
                            </div>
                        </div>

                        <div class="form-group col-md-6">
                            <label class="col-md-4 control-label">补贴天数</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control input-inline input-medium" placeholder="补贴天数"  name="driver_bt_ts" id="driver_bt_ts">
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


    jQuery(document).ready(function() {
        $('#chargings').change(function(){
            var price =$(this).children('option:selected').val();

           //alert(price);
            $("#price").val(price);
            var mileage=$("#mileage").val();
            $("#service_charge").val(price*mileage);

        });

        $('#driver_bt_type').change(function(){
            var price =$(this).children('option:selected').attr("price");

            var ts=$("#driver_bt_ts").val();

            if(isE(ts)){
                ts=0;
                $("#driver_bt_ts").val(0);
            }
            $("#driver_bt_cost").val(ts*price);
        })

        $('#driver_bt_ts').bind('input propertychange', function() {
            //alert("a");
            //alert($(this).val());

            var driver_bt_type=$("#driver_bt_type").val();

            var price=0;
            if(driver_bt_type==1){ price=20; }
            if(driver_bt_type==2){ price=60; }
            if(driver_bt_type==3){ price=100; }

            $("#driver_bt_cost").val($(this).val()*price);

        })





    })


    $("#addCarForm").submit(function () {

        if($("#driver_bt_type").val()==0){
            toastr.error('请选择补贴类型！');
            return false;
        }

        if($("#chargings").val()==0){
            toastr.error('请选择计价类型！');
            return false;
        }


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