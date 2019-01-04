<?php /* Smarty version Smarty-3.1.6, created on 2018-10-10 15:52:40
         compiled from "/var/www/yxcarnew/Home/View/Travel/viewTravel.html" */ ?>
<?php /*%%SmartyHeaderCode:8710537745bbdafc89265b9-87275339%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'fbf140c6afada287bb9b9f4ed4632e55fc6af553' => 
    array (
      0 => '/var/www/yxcarnew/Home/View/Travel/viewTravel.html',
      1 => 1528819602,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '8710537745bbdafc89265b9-87275339',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'travel' => 0,
    'company' => 0,
    'use_user' => 0,
    'travel_type' => 0,
    'driver' => 0,
    'car' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.6',
  'unifunc' => 'content_5bbdafc89d510',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5bbdafc89d510')) {function content_5bbdafc89d510($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_date_format')) include '/var/www/yxcarnew/ThinkPHP/Library/Vendor/Smarty/plugins/modifier.date_format.php';
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>查看出行</title>


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

    <style>
        td{
            height: 30px;
            line-height: 30px;
            padding: 0 5px;
        }
    </style>

</head>
<body class="page-header-fixed page-sidebar-closed-hide-logo page-content-white"  style="background: #FFFFFF;">
<div class="page-wrapper">
    <div class="page-content">
        <div>
            <div class="portlet light">
                <table width="1020" border="1" cellspacing="0" cellpadding="0" class="travelDetailTable">
                    <tr>
                        <td colspan="2" >流水单号：</td>
                        <td colspan="2" style="text-align: left"><?php echo $_smarty_tpl->tpl_vars['travel']->value['serial_number'];?>
</td>
                        <td>服务车辆所属</td>
                        <td colspan="2"　style="text-align: left">中心车辆</td>
                    </tr>
                    <?php if ($_smarty_tpl->tpl_vars['travel']->value['center_error_msg']||$_smarty_tpl->tpl_vars['travel']->value['manage_error_msg']){?>
                    <tr>
                        <td colspan="2" style="color: red">驳回信息</td>
                        <td colspan="5" style="color: red;text-align: left" ><?php echo $_smarty_tpl->tpl_vars['travel']->value['center_error_msg'];?>
<?php echo $_smarty_tpl->tpl_vars['travel']->value['manage_error_msg'];?>
</td></tr>
                    <tr>
                        <?php }?>
                    <tr>
                        <td width="30" rowspan="9" style="line-height: 20px;">出行申请数据</td>
                        <td width="140">用车单位</td>
                        <td width="155"><?php echo $_smarty_tpl->tpl_vars['company']->value['company_name'];?>
</td>
                        <td width="140">用车人</td>
                        <td width="155">
                            <?php echo $_smarty_tpl->tpl_vars['use_user']->value['user_name'];?>

                        </td>
                        <td width="140">申请时间</td>
                        <td width="250">
                            <?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['travel']->value['sign_time'],'%Y-%m-%d %H:%M:%S');?>

                        </td>
                    </tr>
                    <tr>
                        <td>出行方式</td>
                        <td>
                            <?php echo $_smarty_tpl->tpl_vars['travel_type']->value['travel_name'];?>

                        </td>
                        <td>联系电话</td>
                        <td>
                            <?php echo $_smarty_tpl->tpl_vars['use_user']->value['user_phone'];?>

                        </td>
                        <td>预约用车时间</td>
                        <td>
                            <?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['travel']->value['departure_time'],'%Y-%m-%d %H:%M:%S');?>

                        </td>
                    </tr>

                    <td>出车时间</td>
                    <td >
                        <?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['travel']->value['start_car_time'],'%Y-%m-%d %H:%M:%S');?>

                    </td>
                    <td>结束用车时间</td>
                    <td  >
                        <?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['travel']->value['end_use_car_time'],'%Y-%m-%d %H:%M:%S');?>

                    </td>
                    <td>预计收车时间</td>
                    <td>
                        <?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['travel']->value['collecting_time'],'%Y-%m-%d %H:%M:%S');?>

                    </td>
                    </tr>
                    <tr>
                        <td>行车路线</td>
                        <td colspan="3">
                            <?php echo $_smarty_tpl->tpl_vars['travel']->value['from_place'];?>
--<?php echo $_smarty_tpl->tpl_vars['travel']->value['to_place'];?>

                        </td>
                        <td>支付方式</td>
                        <td>
                            <?php echo $_smarty_tpl->tpl_vars['travel']->value['pay_type'];?>

                        </td>
                    </tr>
                    <tr>
                        <td>乘车人名单</td>
                        <td colspan="3">
                            <?php echo $_smarty_tpl->tpl_vars['travel']->value['travel_people'];?>

                        </td>
                        <td>乘车人数</td>
                        <td>
                            <?php echo $_smarty_tpl->tpl_vars['travel']->value['people_num'];?>

                        </td>
                    </tr>
                    <tr>
                        <td>出行性质</td>
                        <td>
                            <?php echo $_smarty_tpl->tpl_vars['travel']->value['travel_nature'];?>

                        </td>
                        <td>出行事由</td>
                        <td>
                            <?php echo $_smarty_tpl->tpl_vars['travel']->value['travel_reason'];?>

                        </td>
                        <td>途径路线</td>
                        <td>
                            <?php echo $_smarty_tpl->tpl_vars['travel']->value['route'];?>

                        </td>
                    </tr>
                    <tr>


                        <td>驾驶员姓名</td>
                        <td>
                            <?php echo $_smarty_tpl->tpl_vars['driver']->value['driver_name'];?>

                        </td>
                        <td>联系方式</td>
                        <td><?php echo $_smarty_tpl->tpl_vars['driver']->value['driver_phone'];?>
</td>
                        <td></td>
                        <td></td>
                    </tr>



                    <tr nowrap="nowrap">
                        <td>车牌号</td>
                        <td>
                            <?php echo $_smarty_tpl->tpl_vars['car']->value['car_num'];?>

                        </td>
                        <td>车辆名称</td>
                        <td><?php echo $_smarty_tpl->tpl_vars['car']->value['car_name'];?>
</td>
                        <td>座位数</td>
                        <td></td>
                    </tr>



                    <tr>
                        <td>行驶里程</td>
                        <td>
                            <?php echo $_smarty_tpl->tpl_vars['travel']->value['mileage'];?>

                        </td>
                        <td>开始公里数</td>
                        <td>
                            <?php echo $_smarty_tpl->tpl_vars['travel']->value['start_kilometers'];?>

                        </td>
                        <td>结束公里数</td>
                        <td>
                            <?php echo $_smarty_tpl->tpl_vars['travel']->value['end_kilometers'];?>

                        </td>
                    </tr>
                    <tr>
                        <td height="70" style="line-height: 20px;">收费详情</td>
                        <td colspan="6" style="text-align: left">
                            <?php if ($_smarty_tpl->tpl_vars['travel']->value['state']==9){?>
                            路桥费<?php echo $_smarty_tpl->tpl_vars['travel']->value['fees_sum'];?>
元，停车费<?php echo $_smarty_tpl->tpl_vars['travel']->value['parking_rate_sum'];?>
，出行服务费，<?php echo $_smarty_tpl->tpl_vars['travel']->value['service_charge'];?>
元，司机住宿补贴<?php echo $_smarty_tpl->tpl_vars['travel']->value['driver_cost'];?>
元，超时费<?php echo $_smarty_tpl->tpl_vars['travel']->value['over_time_cost'];?>
元，超公里费<?php echo $_smarty_tpl->tpl_vars['travel']->value['over_mileage_cost'];?>
元，其他费用<?php echo $_smarty_tpl->tpl_vars['travel']->value['else_cost'];?>
元。
                            <?php }?>
                        </td>
                    </tr>
                    <tr>
                        <td rowspan="3">其他</td>
                        <td rowspan="2">对驾驶员服务评价</td>
                        <td colspan="5" style="text-align: left"><label><input type="checkbox" <?php if ($_smarty_tpl->tpl_vars['travel']->value['attitude']=="1"){?>checked="checked"<?php }?> disabled="disabled" >非常不满意</label>&nbsp;&nbsp;&nbsp;<label><input type="checkbox" disabled="disabled" <?php if ($_smarty_tpl->tpl_vars['travel']->value['attitude']=="2"){?>checked="checked"<?php }?>>不满意</label>&nbsp;&nbsp;&nbsp;<label><input type="checkbox" disabled="disabled" <?php if ($_smarty_tpl->tpl_vars['travel']->value['attitude']=="3"){?>checked="checked"<?php }?>>一般</label>&nbsp;&nbsp;&nbsp;<label><input type="checkbox" disabled="disabled" <?php if ($_smarty_tpl->tpl_vars['travel']->value['attitude']=="4"){?>checked="checked"<?php }?>>满意</label>&nbsp;&nbsp;&nbsp;<label><input type="checkbox" disabled="disabled" <?php if ($_smarty_tpl->tpl_vars['travel']->value['attitude']=="5"){?>checked="checked"<?php }?>>非常满意</label></td>
                    </tr>
                    <tr>
                        <td colspan="5" style="text-align: left">意见：<?php echo $_smarty_tpl->tpl_vars['travel']->value['evaluate'];?>
</td>
                    </tr>
                    <tr>
                        <td colspan="6" style="text-align: left">出行备注：</td>
                    </tr>
                </table>
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







</script>
</html>


<?php }} ?>