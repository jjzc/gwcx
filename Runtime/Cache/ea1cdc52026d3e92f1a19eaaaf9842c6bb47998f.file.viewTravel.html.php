<?php /* Smarty version Smarty-3.1.6, created on 2018-12-19 19:49:10
         compiled from "D:/xampp/htdocs/Admin/View\Travel\viewTravel.html" */ ?>
<?php /*%%SmartyHeaderCode:138185bbf13ce08ff80-95619018%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ea1cdc52026d3e92f1a19eaaaf9842c6bb47998f' => 
    array (
      0 => 'D:/xampp/htdocs/Admin/View\\Travel\\viewTravel.html',
      1 => 1544578803,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '138185bbf13ce08ff80-95619018',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.6',
  'unifunc' => 'content_5bbf13ce9989a',
  'variables' => 
  array (
    'travel' => 0,
    'company' => 0,
    'users' => 0,
    'r' => 0,
    'use_user' => 0,
    'travel_types' => 0,
    'v' => 0,
    'travel_type' => 0,
    'travel_nature' => 0,
    'drivers' => 0,
    'driver' => 0,
    'cars' => 0,
    'car' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5bbf13ce9989a')) {function content_5bbf13ce9989a($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_date_format')) include 'D:\\xampp\\htdocs\\ThinkPHP\\Library\\Vendor\\Smarty\\plugins\\modifier.date_format.php';
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
            <form action="/index.php/Admin/Travel/editTravelDo" method="post" id="editTravel">
                <input type="hidden" name="id" value="<?php echo $_smarty_tpl->tpl_vars['travel']->value['id'];?>
">
                <div class="portlet light">
                    <table width="1020" border="1" cellspacing="0" cellpadding="0" class="travelDetailTable">
                        <tr>
                            <td colspan="2" >流水单号：</td>
                            <td colspan="2" style="text-align: left"><?php echo $_smarty_tpl->tpl_vars['travel']->value['serial_number'];?>
</td>
                            <td>服务车辆所属</td>
                            <td colspan="2"　style="text-align: left">
                                <?php if ($_smarty_tpl->tpl_vars['travel']->value['arrange_type_id']==1){?>
                                玖玖专车<?php echo $_smarty_tpl->tpl_vars['travel']->value['jj_id'];?>

                                <?php }else{ ?>
                                自有车辆
                                <?php }?>                            </td>
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
                                <select class="form-control" name="use_user_id" id="use_user_id">
                                    <?php  $_smarty_tpl->tpl_vars['r'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['r']->_loop = false;
 $_smarty_tpl->tpl_vars['w'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['users']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['r']->key => $_smarty_tpl->tpl_vars['r']->value){
$_smarty_tpl->tpl_vars['r']->_loop = true;
 $_smarty_tpl->tpl_vars['w']->value = $_smarty_tpl->tpl_vars['r']->key;
?>
                                    <option value="<?php echo $_smarty_tpl->tpl_vars['r']->value['id'];?>
" <?php if ($_smarty_tpl->tpl_vars['r']->value['id']==$_smarty_tpl->tpl_vars['use_user']->value['id']){?>selected="selected"<?php }?>><?php echo $_smarty_tpl->tpl_vars['r']->value['user_name'];?>
--<?php echo $_smarty_tpl->tpl_vars['r']->value['user_phone'];?>
</option>
                                    <?php } ?>
                                </select>                            </td>
                            <td width="140">申请时间</td>
                            <td width="250">
                                <div class="input-group date form_datetime col-md-5" data-date="" data-date-format="yyyy-mm-dd hh:ii" data-link-field="dtp_input1">
                                    <input name="sign_time" id="sign_time" class="form-control" size="16" type="text"  value="<?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['travel']->value['sign_time'],'%Y-%m-%d %H:%M');?>
" readonly style="width: 150px">
                                    <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>                                </div>                            </td>
                        </tr>
                        <tr>
                            <td>出行方式</td>
                            <td>
                                <select class="form-control" name="travel_type_id" id="travel_type_id">
                                    <?php  $_smarty_tpl->tpl_vars['v'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['v']->_loop = false;
 $_smarty_tpl->tpl_vars['k'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['travel_types']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['v']->key => $_smarty_tpl->tpl_vars['v']->value){
$_smarty_tpl->tpl_vars['v']->_loop = true;
 $_smarty_tpl->tpl_vars['k']->value = $_smarty_tpl->tpl_vars['v']->key;
?>
                                    <option value="<?php echo $_smarty_tpl->tpl_vars['v']->value['id'];?>
" <?php if ($_smarty_tpl->tpl_vars['travel_type']->value['travel_name']==$_smarty_tpl->tpl_vars['v']->value['travel_name']){?>selected="selected"<?php }?>><?php echo $_smarty_tpl->tpl_vars['v']->value['travel_name'];?>
</option>
                                    <?php } ?>
                                </select>                            </td>
                            <td>联系电话</td>
                            <td>
                                <?php echo $_smarty_tpl->tpl_vars['use_user']->value['user_phone'];?>
                            </td>
                            <td>预约用车时间</td>
                            <td>
                                <div class="input-group date form_datetime col-md-5" data-date="" data-date-format="yyyy-mm-dd hh:ii" data-link-field="dtp_input1">
                                    <input name="departure_time" id="departure_time" class="form-control" size="16" type="text"  value="<?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['travel']->value['departure_time'],'%Y-%m-%d %H:%M');?>
" readonly style="width: 150px">
                                    <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>                                </div>                            </td>
                        </tr>

                        <td>出车时间</td>
                        <td >
                            <div class="input-group date form_datetime col-md-5" data-date="" data-date-format="yyyy-mm-dd hh:ii" data-link-field="dtp_input1">
                                <input name="start_car_time" id="start_car_time" class="form-control" size="16" type="text"  value="<?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['travel']->value['start_car_time'],'%Y-%m-%d %H:%M');?>
" readonly style="width: 150px">
                                <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                                <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>                            </div>                        </td>
                        <td>结束用车时间</td>
                        <td  >
                            <div class="input-group date form_datetime col-md-5" data-date="" data-date-format="yyyy-mm-dd hh:ii" data-link-field="dtp_input1">
                                <input name="end_use_car_time" id="end_use_car_time" class="form-control" size="16" type="text"  value="<?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['travel']->value['end_use_car_time'],'%Y-%m-%d %H:%M');?>
" readonly style="width: 150px">
                                <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                                <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>                            </div>                        </td>
                        <td>预计收车时间</td>
                        <td>
                            <div class="input-group date form_datetime col-md-5" data-date="" data-date-format="yyyy-mm-dd hh:ii" data-link-field="dtp_input1">
                                <input name="collecting_time" id="collecting_time" class="form-control" size="16" type="text"  value="<?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['travel']->value['collecting_time'],'%Y-%m-%d %H:%M');?>
" readonly style="width: 150px">
                                <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                                <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>                            </div>                        </td>
                        </tr>
                        <tr>
                            <td>行车路线</td>
                            <td colspan="3">
                                <input type="text" name="from_place"  class="form-control"  id="from_place" value="<?php echo $_smarty_tpl->tpl_vars['travel']->value['from_place'];?>
">
                                <input type="text" name="to_place"  class="form-control"  id="to_place" value="<?php echo $_smarty_tpl->tpl_vars['travel']->value['to_place'];?>
"></td>
                            <td>支付方式</td>
                            <td>
                                <!-- 只有状态为7时才能够修改 -->
                                <?php if ($_smarty_tpl->tpl_vars['travel']->value['state']==9){?>
                                <input type="text" name="pay_type"  class="form-control" placeholder="支付方式" id="pay_type" value="<?php echo $_smarty_tpl->tpl_vars['travel']->value['pay_type'];?>
">
                                <?php }else{ ?>
                                <?php echo $_smarty_tpl->tpl_vars['travel']->value['pay_type'];?>

                                <?php }?>                            </td>
                        </tr>
                        <tr>
                            <td>乘车人名单</td>
                            <td colspan="3"><input  type="text" name="travel_people"  class="form-control" placeholder="乘车人名单" id="travel_people" value="<?php echo $_smarty_tpl->tpl_vars['travel']->value['travel_people'];?>
">                            </td>
                            <td>乘车人数</td>
                            <td><input type="text" name="people_num"  class="form-control" placeholder="乘车人数" id="people_num" value="<?php echo $_smarty_tpl->tpl_vars['travel']->value['people_num'];?>
"></td>
                        </tr>
                        <tr>
                            <td>出行性质</td>
                            <td>
                                <select class="form-control" name="travel_nature" id="travel_nature" style="width: 140px;">
                                    <?php  $_smarty_tpl->tpl_vars['v'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['v']->_loop = false;
 $_smarty_tpl->tpl_vars['k'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['travel_nature']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['v']->key => $_smarty_tpl->tpl_vars['v']->value){
$_smarty_tpl->tpl_vars['v']->_loop = true;
 $_smarty_tpl->tpl_vars['k']->value = $_smarty_tpl->tpl_vars['v']->key;
?>
                                    <option value="<?php echo $_smarty_tpl->tpl_vars['v']->value['nature_name'];?>
" <?php if ($_smarty_tpl->tpl_vars['travel']->value['travel_nature']==$_smarty_tpl->tpl_vars['v']->value['nature_name']){?>selected="selected"<?php }?>><?php echo $_smarty_tpl->tpl_vars['v']->value['nature_name'];?>
</option>
                                    <?php } ?>
                                </select>                            </td>
                            <td>出行事由</td>
                            <td><input type="text" name="travel_reason"  class="form-control" placeholder="出行事由" id="travel_reason" value="<?php echo $_smarty_tpl->tpl_vars['travel']->value['travel_reason'];?>
"></td>
                            <td>途径路线</td>
                            <td><input type="text" name="route"  class="form-control" placeholder="途径路线" id="route" value="<?php echo $_smarty_tpl->tpl_vars['travel']->value['route'];?>
"></td>
                        </tr>
                        <tr>


                            <td>驾驶员姓名</td>
                            <td>
                                <!-- 只有派车之后才有司机信息 -->
                                <?php if ($_smarty_tpl->tpl_vars['travel']->value['state']>=5){?>
                                    <?php if ($_smarty_tpl->tpl_vars['travel']->value['arrange_type_id']==1){?>
                                        <?php echo $_smarty_tpl->tpl_vars['travel']->value['jj_driver_name'];?>

                                    <?php }else{ ?>
                                    <select name="driver_id" class="form-control" id="driver_id">
                                        <?php  $_smarty_tpl->tpl_vars['v'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['v']->_loop = false;
 $_smarty_tpl->tpl_vars['k'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['drivers']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['v']->key => $_smarty_tpl->tpl_vars['v']->value){
$_smarty_tpl->tpl_vars['v']->_loop = true;
 $_smarty_tpl->tpl_vars['k']->value = $_smarty_tpl->tpl_vars['v']->key;
?>
                                        <option value="<?php echo $_smarty_tpl->tpl_vars['v']->value['id'];?>
" <?php if ($_smarty_tpl->tpl_vars['v']->value['id']==$_smarty_tpl->tpl_vars['travel']->value['driver_id']){?>selected="selected"<?php }?>><?php echo $_smarty_tpl->tpl_vars['v']->value['driver_name'];?>
<?php echo $_smarty_tpl->tpl_vars['v']->value['driver_phone'];?>
</option>
                                        <!--<?php if ($_smarty_tpl->tpl_vars['v']->value['id']==$_smarty_tpl->tpl_vars['travel']->value['driver_id']){?><?php echo $_smarty_tpl->tpl_vars['v']->value['driver_name'];?>
<?php }?>-->
                                        <?php } ?>
                                    </select>
                                    <?php }?>
                                <?php }?>                            </td>
                            <td>联系方式</td>
                            <td>
                                <?php if ($_smarty_tpl->tpl_vars['travel']->value['arrange_type_id']==1){?>
                                    <?php echo $_smarty_tpl->tpl_vars['travel']->value['jj_driver_phone'];?>

                                <?php }else{ ?>
                                    <?php echo $_smarty_tpl->tpl_vars['driver']->value['driver_phone'];?>

                                <?php }?>                            </td>
                            <td></td>
                            <td></td>
                        </tr>



                        <tr nowrap="nowrap">
                            <td>车牌号</td>
                            <td>
                                <!-- 只有派车之后才有车辆信息 -->
                                <?php if ($_smarty_tpl->tpl_vars['travel']->value['state']>=5){?>
                                    <?php if ($_smarty_tpl->tpl_vars['travel']->value['arrange_type_id']==1){?>
                                        <?php echo $_smarty_tpl->tpl_vars['travel']->value['jj_car_num'];?>

                                    <?php }else{ ?>
                                    <select name="car_id" class="form-control" id="car_id">
                                        <?php  $_smarty_tpl->tpl_vars['v'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['v']->_loop = false;
 $_smarty_tpl->tpl_vars['k'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['cars']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['v']->key => $_smarty_tpl->tpl_vars['v']->value){
$_smarty_tpl->tpl_vars['v']->_loop = true;
 $_smarty_tpl->tpl_vars['k']->value = $_smarty_tpl->tpl_vars['v']->key;
?>
                                        <option value="<?php echo $_smarty_tpl->tpl_vars['v']->value['id'];?>
" <?php if ($_smarty_tpl->tpl_vars['v']->value['car_num']==$_smarty_tpl->tpl_vars['car']->value['car_num']){?>selected="selected"<?php }?>><?php echo $_smarty_tpl->tpl_vars['v']->value['car_num'];?>
<?php echo $_smarty_tpl->tpl_vars['v']->value['car_name'];?>
</option>
                                        <?php } ?>
                                    </select>
                                    <?php }?>
                                <?php }?>                            </td>
                            <td>车辆名称</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['car']->value['car_name'];?>
</td>
                            <td>座位数</td>
                            <td></td>
                        </tr>



                        <tr>
                            <td>行驶里程</td>
                            <td>
                                <?php if ($_smarty_tpl->tpl_vars['travel']->value['state']==9){?>
                                <input type="text" name="mileage"  class="form-control" placeholder="行驶里程" id="mileage" value="<?php echo $_smarty_tpl->tpl_vars['travel']->value['mileage'];?>
">
                                <?php }?>                            </td>
                            <td>开始公里数</td>
                            <td>
                                <?php if ($_smarty_tpl->tpl_vars['travel']->value['state']==9){?>
                                <input type="text" name="start_kilometers"  class="form-control" placeholder="开始公里数" id="start_kilometers" value="<?php echo $_smarty_tpl->tpl_vars['travel']->value['start_kilometers'];?>
">
                                <?php }?>                            </td>
                            <td>结束公里数</td>
                            <td>
                                <?php if ($_smarty_tpl->tpl_vars['travel']->value['state']==9){?>
                                <input type="text" name="end_kilometers"  class="form-control" placeholder="结束公里数" id="end_kilometers" value="<?php echo $_smarty_tpl->tpl_vars['travel']->value['end_kilometers'];?>
">
                                <?php }?>                            </td>
                        </tr>
                        <tr>
                            <td height="70" rowspan="2" style="line-height: 20px;">收费详情</td>
                            <style>
                                #fy input{ display: inline-block; padding: 0 4px; width: 40px; }
                            </style>
                            <td colspan="6" style="text-align: left" id="fy">
                                <?php if ($_smarty_tpl->tpl_vars['travel']->value['state']==9){?>
                                路桥费<input type="text" name="fees_sum"  class="form-control" placeholder=""  value="<?php echo $_smarty_tpl->tpl_vars['travel']->value['fees_sum'];?>
">元，停车费<input type="text" name="parking_rate_sum"  class="form-control" placeholder=""  value="<?php echo $_smarty_tpl->tpl_vars['travel']->value['parking_rate_sum'];?>
">
                                元，司机住宿补贴
                                <input type="text" name="driver_cost"  class="form-control" value="<?php echo $_smarty_tpl->tpl_vars['travel']->value['driver_cost'];?>
">元，超时费<input type="text" name="over_time_cost"  class="form-control" placeholder=""  value="<?php echo $_smarty_tpl->tpl_vars['travel']->value['over_time_cost'];?>
">元，超公里费<input type="text" name="over_mileage_cost"  class="form-control" placeholder=""  value="<?php echo $_smarty_tpl->tpl_vars['travel']->value['over_mileage_cost'];?>
">元，其他费用<input type="text" name="else_cost"  class="form-control" placeholder=""  value="<?php echo $_smarty_tpl->tpl_vars['travel']->value['else_cost'];?>
">元，司机补贴<input type="text" name="else_cost"  class="form-control" placeholder=""  value="<?php echo $_smarty_tpl->tpl_vars['travel']->value['driver_bt_cost'];?>
">元。
                                <?php }?>                            </td>
                        </tr>
                        <tr>
                          <td colspan="6" style="text-align: left" id="fy">出行服务费
                            <input type="text" name="service_charge"  class="form-control"  value="<?php echo $_smarty_tpl->tpl_vars['travel']->value['service_charge'];?>
">
                          元</td>
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
                <div class="form-group" style="margin-top: 15px;">
                    <button type="submit" class="btn btn-primary">修改</button>
                    <input id="biuuu_button" class="btn btn-primary"  type="button" value="打印"></input>

                    <button type="button" class="btn btn-primary" onClick="closeThis();">关闭</button>
                </div>
            </form>
        </div>
    </div>
</div>





<div style="width: 0px; height: 0px; overflow:hidden;">
    <!--打印区域开始-->
    <!--startprint1-->
    <table width="950" border="1" cellspacing="0" cellpadding="0" class="travelDetailTable">
        <tr> <td colspan="2" >流水单号：</td>
            <td colspan="2" style="text-align: left"><?php echo $_smarty_tpl->tpl_vars['travel']->value['serial_number'];?>
</td>
            <td>服务车辆所属</td>
            <td colspan="2"　style="text-align: left">

                <?php if ($_smarty_tpl->tpl_vars['travel']->value['arrange_type_id']==1){?>
                玖玖专车
                <?php }else{ ?>
                自有车辆
            <?php }?>            </td></tr>
        <?php if ($_smarty_tpl->tpl_vars['travel']->value['center_error_msg']||$_smarty_tpl->tpl_vars['travel']->value['manage_error_msg']){?>
        <tr><td colspan="2" style="color: red">驳回信息</td>
            <td colspan="5" style="color: red;text-align: left" ><?php echo $_smarty_tpl->tpl_vars['travel']->value['center_error_msg'];?>
<?php echo $_smarty_tpl->tpl_vars['travel']->value['manage_error_msg'];?>
</td></tr>
        <tr>
            <?php }?>
        <tr>
        <tr>
            <td width="30" rowspan="9">出行申请数据</td>
            <td width="140">用车单位</td>
            <td width="155"><?php echo $_smarty_tpl->tpl_vars['company']->value['company_name'];?>
            </td>
            <td width="140">用车人</td>
            <td width="155">
                <?php echo $_smarty_tpl->tpl_vars['use_user']->value['user_name'];?>
            </td>
            <td width="140">提交时间</td>
            <td width="250"><?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['travel']->value['sign_time'],'%Y-%m-%d %H:%M');?>
            </td>
        </tr>
        <tr>


            <td>出行方式</td>
            <td>
                <?php echo $_smarty_tpl->tpl_vars['travel_type']->value['travel_name'];?>
            </td>
            <td>联系方式</td>
            <td>
                <?php echo $_smarty_tpl->tpl_vars['use_user']->value['user_phone'];?>
            </td>

            <td>预约时间</td>
            <td>
                <?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['travel']->value['departure_time'],'%Y-%m-%d %H:%M');?>
            </td>
        </tr>
        <tr>
            <td>出车时间</td>
            <td colspan="2">
                <?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['travel']->value['start_car_time'],'%Y-%m-%d %H:%M');?>
            </td>
            <td>结束用车时间</td>
            <td colspan="2">
                <?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['travel']->value['end_use_car_time'],'%Y-%m-%d %H:%M');?>
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
                <?php if ($_smarty_tpl->tpl_vars['travel']->value['arrange_type_id']==1){?>
                <?php echo $_smarty_tpl->tpl_vars['travel']->value['jj_driver_name'];?>

                <?php }else{ ?>
                <?php echo $_smarty_tpl->tpl_vars['driver']->value['driver_name'];?>

                <?php }?>            </td>
            <td>联系方式</td>
            <td>
                <?php if ($_smarty_tpl->tpl_vars['travel']->value['arrange_type_id']==1){?>
                <?php echo $_smarty_tpl->tpl_vars['travel']->value['jj_driver_phone'];?>

                <?php }else{ ?>
                <?php echo $_smarty_tpl->tpl_vars['driver']->value['driver_phone'];?>

                <?php }?>            </td>

            <td></td>
            <td></td>
        </tr>



        <tr nowrap="nowrap">
            <td>车牌号</td>
            <td>
                <?php if ($_smarty_tpl->tpl_vars['travel']->value['arrange_type_id']==1){?>
                <?php echo $_smarty_tpl->tpl_vars['travel']->value['jj_car_num'];?>

                <?php }else{ ?>
                <?php echo $_smarty_tpl->tpl_vars['car']->value['car_num'];?>

                <?php }?>            </td>
            <td>车辆名称</td>
            <td>
                <?php if ($_smarty_tpl->tpl_vars['travel']->value['arrange_type_id']==1){?>
                <?php }else{ ?>
                <?php echo $_smarty_tpl->tpl_vars['car']->value['car_name'];?>

                <?php }?>            </td>
            <td>座位数</td>
            <td>
                <?php if ($_smarty_tpl->tpl_vars['travel']->value['arrange_type_id']==1){?>
                <?php }else{ ?>
                <?php echo $_smarty_tpl->tpl_vars['car']->value['seat_num'];?>

                <?php }?>            </td>
        </tr>



        <tr>
            <td>行驶里程</td>
            <td>
                <?php echo $_smarty_tpl->tpl_vars['travel']->value['mileage'];?>
            </td>
            <td>开始公里数</td>
            <td><?php echo $_smarty_tpl->tpl_vars['travel']->value['start_kilometers'];?>
</td>
            <td>结束公里数</td>
            <td><?php echo $_smarty_tpl->tpl_vars['travel']->value['end_kilometers'];?>
</td>
        </tr>
        <tr>
            <td height="70" rowspan="2">收费详情</td>
            <td colspan="6" style="text-align: left">
                路桥费<?php echo $_smarty_tpl->tpl_vars['travel']->value['fees_sum'];?>
元，停车费<?php echo $_smarty_tpl->tpl_vars['travel']->value['parking_rate_sum'];?>
元,司机住宿补贴<?php echo $_smarty_tpl->tpl_vars['travel']->value['driver_cost'];?>
元，超时费<?php echo $_smarty_tpl->tpl_vars['travel']->value['over_time_cost'];?>
元，超公里费<?php echo $_smarty_tpl->tpl_vars['travel']->value['over_mileage_cost'];?>
元，其他费用<?php echo $_smarty_tpl->tpl_vars['travel']->value['else_cost'];?>
元，司机补贴<?php echo $_smarty_tpl->tpl_vars['travel']->value['driver_bt_cost'];?>
元。            </td>
        </tr>
        <tr>
          <td colspan="6" style="text-align: left">出行服务费<?php echo $_smarty_tpl->tpl_vars['travel']->value['service_charge'];?>
元</td>
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
    <!--endprint1-->
    <!--打印区域结束-->
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
    function closeThis(){
        var index = parent.layer.getFrameIndex(window.name);
        parent.layer.close(index);
    }


    $("#editTravel").submit(function () {
        //核验数据
        var sign_time=$("#sign_time").val();
        if(!sign_time){ toastr.warning('提交时间不能为空'); $("#sign_time").focus().select(); return false; }

        var departure_time=$("#departure_time").val();
        if(!departure_time){ toastr.warning('预约时间不能为空'); $("#departure_time").focus().select(); return false; }

        var start_car_time=$("#start_car_time").val();
        var end_use_car_time=$("#end_use_car_time").val();
        var sign_timeS = Date.parse(new Date(sign_time));
        var departure_timeS = Date.parse(new Date(departure_time));
        var start_car_timeS = Date.parse(new Date(start_car_time));
        var end_use_car_timeS = Date.parse(new Date(end_use_car_time));

        if(sign_timeS>departure_timeS){
            toastr.warning('申请时间需早于预约时间'); $("#sign_time").focus().select(); return false;
        }

        if(start_car_time!=""&&end_use_car_time!=""){
            if(start_car_timeS>end_use_car_timeS){
                toastr.warning('出车时间需早于结束用车时间'); $("#start_car_time").focus().select(); return false;
            }
        }

        if(start_car_time!=""){
            if(sign_timeS>start_car_timeS){
                toastr.warning('申请时间需早于出车时间'); $("#start_car_time").focus().select(); return false;
            }
        }

        if($("#start_kilometers").length > 0) {
            var start_kilometers=$("#start_kilometers").val();
            var end_kilometers=$("#end_kilometers").val();

            if(start_kilometers!=""&&end_kilometers!=""){
                if(isNaN(start_kilometers)){
                    toastr.warning('开始公里数只能为数字'); $("#start_kilometers").focus().select(); return false;
                }
                if(isNaN(end_kilometers)){
                    toastr.warning('结束公里数只能为数字'); $("#end_kilometers").focus().select(); return false;
                }

                if(parseInt(start_kilometers)>parseInt(end_kilometers)){
                    toastr.warning('开始公里数不得大于结束公里数'); $("#end_kilometers").focus().select(); return false;
                }
            }
        }


        $(this).ajaxSubmit(function (data) {
            if(data.code==1){
                layer.msg('提交成功!', { icon: 1 });
                //setTimeout("window.parent.location.reload()",2000);

                //setTimeout("window.location.href='/index.php/Home/Travel/myTravels'",2500);
            }else{
                layer.msg('提交失败，请重试!', { icon: 0 });
            }
        });



        return false;
    });



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
        showMeridian: 1
    });


    $(function() {
        $("input#biuuu_button").click(function () {
            preview(1);
        });



    });

    function preview(oper)
    {
        if (oper < 10)
        {
            bdhtml=window.document.body.innerHTML;//获取当前页的html代码
            sprnstr="<!--startprint"+oper+"-->";//设置打印开始区域
            eprnstr="<!--endprint"+oper+"-->";//设置打印结束区域
            prnhtml=bdhtml.substring(bdhtml.indexOf(sprnstr)+18); //从开始代码向后取html

            prnhtml=prnhtml.substring(0,prnhtml.indexOf(eprnstr));//从结束代码向前取html
            window.document.body.innerHTML=prnhtml;
            window.print();
            window.document.body.innerHTML=bdhtml;
        } else {
            window.print();
        }
    }




</script>
</html>


<?php }} ?>