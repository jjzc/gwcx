<?php /* Smarty version Smarty-3.1.6, created on 2018-10-10 10:26:34
         compiled from "/var/www/yxcarnew/Admin/View/Travel/manualTravels.html" */ ?>
<?php /*%%SmartyHeaderCode:2081890445bbd635a5e1b69-55174054%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '53919235ba1a7a2c9043393548dbffbfb67dd76f' => 
    array (
      0 => '/var/www/yxcarnew/Admin/View/Travel/manualTravels.html',
      1 => 1537234308,
      2 => 'file',
    ),
    '042d6b6cd183d349833e95cf0e4398062461b5bf' => 
    array (
      0 => '/var/www/yxcarnew/Admin/View/Travel/template.html',
      1 => 1531141894,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2081890445bbd635a5e1b69-55174054',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'travelLeft' => 0,
    'v' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.6',
  'unifunc' => 'content_5bbd635a75460',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5bbd635a75460')) {function content_5bbd635a75460($_smarty_tpl) {?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>公务用车</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <meta content="Preview page of Metronic Admin Theme #1 for statistics, charts, recent events and reports" name="description" />
    <meta content="" name="author" />
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />

    <link href="<?php echo @PUBLIC_URL;?>
/assets/global/plugins/bootstrap-sweetalert/sweetalert.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo @PUBLIC_URL;?>
/assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo @PUBLIC_URL;?>
/assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo @PUBLIC_URL;?>
/assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo @PUBLIC_URL;?>
/assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <link href="<?php echo @PUBLIC_URL;?>
/assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo @PUBLIC_URL;?>
/assets/global/plugins/morris/morris.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo @PUBLIC_URL;?>
/assets/global/plugins/fullcalendar/fullcalendar.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo @PUBLIC_URL;?>
/assets/global/plugins/jqvmap/jqvmap/jqvmap.css" rel="stylesheet" type="text/css" />

    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <link href="<?php echo @PUBLIC_URL;?>
/assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo @PUBLIC_URL;?>
/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />
    <!-- END PAGE LEVEL PLUGINS -->

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



    <!-- END PAGE LEVEL PLUGINS -->
    <!-- BEGIN THEME GLOBAL STYLES -->
    <link href="<?php echo @PUBLIC_URL;?>
/assets/global/css/components.min.css" rel="stylesheet" id="style_components" type="text/css" />
    <link href="<?php echo @PUBLIC_URL;?>
/assets/global/css/plugins.min.css" rel="stylesheet" type="text/css" />
    <!-- END THEME GLOBAL STYLES -->
    <!-- BEGIN THEME LAYOUT STYLES -->
    <link href="<?php echo @PUBLIC_URL;?>
/assets/layouts/layout/css/layout.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo @PUBLIC_URL;?>
/assets/layouts/layout/css/themes/darkblue.min.css" rel="stylesheet" type="text/css" id="style_color" />
    <link href="<?php echo @PUBLIC_URL;?>
/assets/layouts/layout/css/custom.min.css" rel="stylesheet" type="text/css" />
    <!-- END THEME LAYOUT STYLES -->
    <link rel="shortcut icon" href="favicon.ico" />
</head>
<body>
<body class="page-sidebar-closed-hide-logo page-content-white">
    <div class="page-wrapper">

        <div class="page-container">
            <!-- BEGIN SIDEBAR -->
            <div class="page-sidebar-wrapper">
                <div class="page-sidebar navbar-collapse collapse">

                    <ul class="page-sidebar-menu  page-header-fixed " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200" style="padding-top: 20px">

                        <li class="sidebar-toggler-wrapper hide">
                            <div class="sidebar-toggler">
                                <span></span>
                            </div>
                        </li>


                        <li class="nav-item start active open">
                            <a href="javascript:;" class="nav-link nav-toggle">
                                <i class="icon-home"></i>
                                <span class="title">出行管理</span>
                                <span class="selected"></span>
                                <span class="arrow open"></span>
                            </a>
                            <ul class="sub-menu">
                                <?php  $_smarty_tpl->tpl_vars['v'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['v']->_loop = false;
 $_smarty_tpl->tpl_vars['k'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['travelLeft']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['v']->key => $_smarty_tpl->tpl_vars['v']->value){
$_smarty_tpl->tpl_vars['v']->_loop = true;
 $_smarty_tpl->tpl_vars['k']->value = $_smarty_tpl->tpl_vars['v']->key;
?>
                                <li class="nav-item start <?php if (strpos($_smarty_tpl->tpl_vars['v']->value['url'],@ACTION_NAME)!==false){?> active open<?php }?>">
                                    <a href="<?php echo $_smarty_tpl->tpl_vars['v']->value['url'];?>
" class="nav-link ">
                                        <i class="icon-bulb"></i>
                                        <span class="title"><?php echo $_smarty_tpl->tpl_vars['v']->value['name'];?>
</span>
                                        <span class="selected"></span>
                                    </a>
                                </li>
                                <?php } ?>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="page-content-wrapper">
                
            <div class="page-content">




                <!--表格开始-->
                <!--全部出行表格-->
                <div class="row" id="waitReviewRow">
                    <div class="col-md-12">
                        <div class="portlet light bordered">
                            <div class="portlet-title">
                                <div class="caption font-dark">
                                    <i class="icon-settings font-dark"></i>
                                    <span class="caption-subject bold uppercase">手工补单</span>
                                </div>
                                <div class="tools"></div>
                            </div>

                            <div class="portlet-body" style="height: 680px;">

                                <div class="col-md-12">
                                    <div class="row col-md-6">
                                        流水号:
                                        <input type="text" name="serial_number" id="serial_number" class="form-control input-inline input-medium">
                                    </div>
                                    <table width="950" border="1" cellspacing="0" cellpadding="0" class="travelDetailTable">
                                        <tr>
                                            <td width="30" rowspan="9">出行申请数据</td>
                                            <td width="150">用车单位</td>
                                            <td width="155">
                                                <!--此处需要用到插件-->
                                                <!--<input id="companyTags" autocomplete="off">-->
                                                <select class="form-control" name="company_id"  id="company_id">
                                                    <?php  $_smarty_tpl->tpl_vars['v'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['v']->_loop = false;
 $_smarty_tpl->tpl_vars['k'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['companys']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['v']->key => $_smarty_tpl->tpl_vars['v']->value){
$_smarty_tpl->tpl_vars['v']->_loop = true;
 $_smarty_tpl->tpl_vars['k']->value = $_smarty_tpl->tpl_vars['v']->key;
?>
                                                    <option value="<?php echo $_smarty_tpl->tpl_vars['v']->value['id'];?>
" ><?php echo $_smarty_tpl->tpl_vars['v']->value['company_name'];?>
</option>
                                                    <?php } ?>
                                                </select>
                                            </td>
                                            <td width="140">用车人</td>
                                            <td width="155">
                                                <!--<input id="userTags" autocomplete="off">-->
                                                <select class="form-control" name="use_user_id"  id="use_user_id">
                                                    <?php  $_smarty_tpl->tpl_vars['v'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['v']->_loop = false;
 $_smarty_tpl->tpl_vars['k'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['users']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['v']->key => $_smarty_tpl->tpl_vars['v']->value){
$_smarty_tpl->tpl_vars['v']->_loop = true;
 $_smarty_tpl->tpl_vars['k']->value = $_smarty_tpl->tpl_vars['v']->key;
?>
                                                    <option value="<?php echo $_smarty_tpl->tpl_vars['v']->value['id'];?>
" ><?php echo $_smarty_tpl->tpl_vars['v']->value['user_name'];?>
</option>
                                                    <?php } ?>
                                                </select>
                                            </td>
                                            <td width="140">提交时间</td>
                                            <td width="250">
                                                <div class="input-group date form_datetime col-md-5" data-date="" data-date-format="yyyy-mm-dd hh:ii" data-link-field="dtp_input1">
                                                    <input name="sign_time" id="sign_time" class="form-control" size="16" type="text" value="" readonly style="width: 150px">
                                                    <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                                                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>出行方式</td>
                                            <td>
                                                <select class="form-control" name="travel_type_id" id="travel_type_id">
                                                    <option value="0" >选择出行方式</option>
                                                    <?php  $_smarty_tpl->tpl_vars['v'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['v']->_loop = false;
 $_smarty_tpl->tpl_vars['k'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['travel_types']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['v']->key => $_smarty_tpl->tpl_vars['v']->value){
$_smarty_tpl->tpl_vars['v']->_loop = true;
 $_smarty_tpl->tpl_vars['k']->value = $_smarty_tpl->tpl_vars['v']->key;
?>
                                                    <?php if ($_smarty_tpl->tpl_vars['v']->value['is_del']==0){?> <option value="<?php echo $_smarty_tpl->tpl_vars['v']->value['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['v']->value['travel_name'];?>
</option><?php }?>
                                                    <?php } ?>

                                                </select>
                                            </td>
                                            <td>联系方式</td>
                                            <td>
                                                <!--<input type="text" class="form-control" name="user_phone" id="user_phone"  autocomplete="off"/>-->
                                            </td>
                                            <td>预约时间</td>
                                            <td>
                                                <div class="input-group date form_datetime col-md-5" data-date="" data-date-format="yyyy-mm-dd hh:ii" data-link-field="dtp_input1">
                                                    <input name="departure_time" id="departure_time" class="form-control" size="16" type="text" value="" readonly style="width: 150px">
                                                    <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                                                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>出车时间</td>
                                            <td colspan="2">
                                                <div class="input-group date form_datetime col-md-5" data-date="" data-date-format="yyyy-mm-dd hh:ii" data-link-field="dtp_input1">
                                                    <input name="start_car_time" id="start_car_time" class="form-control" size="16" type="text"  value="" readonly style="width: 150px">
                                                    <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                                                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                                                </div>
                                            </td>
                                            <td>结束用车时间</td>
                                            <td colspan="2">
                                                <div class="input-group date form_datetime col-md-5" data-date="" data-date-format="yyyy-mm-dd hh:ii" data-link-field="dtp_input1">
                                                    <input name="end_use_car_time" id="end_use_car_time" class="form-control" size="16" type="text"  value="" readonly style="width: 150px">
                                                    <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                                                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>行车路线</td>
                                            <td colspan="3">
                                                <input type="text" name="from_place" class="form-control input-inline" id="from_place"  autocomplete="off" style="width: 180px;" />
                                                --
                                                <input type="text" name="to_place" id="to_place" class="form-control input-inline"  autocomplete="off" style="width: 180px;"/>
                                            </td>
                                            <td>支付方式</td>
                                            <td>
                                                <select class="form-control" name="pay_type" id="pay_type" >
                                                    <option value="0" >选择支付方式</option>
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
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>乘车人名单</td>
                                            <td colspan="3">
                                                <input type="text" class="form-control input-inline input-medium" id="travel_people" placeholder="乘车人">
                                                <!--<select class="form-control" name="travel_people_id[]" multiple="multiple" id="select_user">-->
                                                <!--<?php  $_smarty_tpl->tpl_vars['v'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['v']->_loop = false;
 $_smarty_tpl->tpl_vars['k'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['companys']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['v']->key => $_smarty_tpl->tpl_vars['v']->value){
$_smarty_tpl->tpl_vars['v']->_loop = true;
 $_smarty_tpl->tpl_vars['k']->value = $_smarty_tpl->tpl_vars['v']->key;
?>-->
                                                <!--<?php  $_smarty_tpl->tpl_vars['r'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['r']->_loop = false;
 $_smarty_tpl->tpl_vars['w'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['v']->value['users']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['r']->key => $_smarty_tpl->tpl_vars['r']->value){
$_smarty_tpl->tpl_vars['r']->_loop = true;
 $_smarty_tpl->tpl_vars['w']->value = $_smarty_tpl->tpl_vars['r']->key;
?>-->
                                                <!--<?php if ($_smarty_tpl->tpl_vars['r']->value['user_name']!=''){?><option value="<?php echo $_smarty_tpl->tpl_vars['r']->value['id'];?>
" ><?php echo $_smarty_tpl->tpl_vars['r']->value['user_name'];?>
</option><?php }?>-->
                                                <!--<?php } ?>-->
                                                <!--<?php } ?>-->
                                                <!--</select>-->
                                            </td>
                                            <td>乘车人数</td>
                                            <td>
                                                <input type="text" class="form-control input-inline input-medium"  id="people_num"  name="people_num" />
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>出行性质</td>
                                            <td>
                                                <select class="form-control" name="travel_nature" id="travel_nature" style="width: 150px;">
                                                    <option value="0" >选择出行性质</option>
                                                    <?php  $_smarty_tpl->tpl_vars['v'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['v']->_loop = false;
 $_smarty_tpl->tpl_vars['k'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['travel_nature']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['v']->key => $_smarty_tpl->tpl_vars['v']->value){
$_smarty_tpl->tpl_vars['v']->_loop = true;
 $_smarty_tpl->tpl_vars['k']->value = $_smarty_tpl->tpl_vars['v']->key;
?>
                                                    <option value="<?php echo $_smarty_tpl->tpl_vars['v']->value['nature_name'];?>
"><?php echo $_smarty_tpl->tpl_vars['v']->value['nature_name'];?>
</option>
                                                    <?php } ?>
                                                </select>
                                            </td>
                                            <td>出行事由</td>
                                            <td colspan="3"><input type="text" name="travel_reason" id="travel_reason" class="form-control input-inline input-medium"  autocomplete="off"/></td>
                                        </tr>
                                        <tr>
                                            <td>驾驶员姓名</td>
                                            <td>
                                                <select class="form-control" name="driver_id"  id="driver_id">
                                                    <?php  $_smarty_tpl->tpl_vars['v'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['v']->_loop = false;
 $_smarty_tpl->tpl_vars['k'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['drivers']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['v']->key => $_smarty_tpl->tpl_vars['v']->value){
$_smarty_tpl->tpl_vars['v']->_loop = true;
 $_smarty_tpl->tpl_vars['k']->value = $_smarty_tpl->tpl_vars['v']->key;
?>
                                                    <option value="<?php echo $_smarty_tpl->tpl_vars['v']->value['id'];?>
" ><?php echo $_smarty_tpl->tpl_vars['v']->value['driver_name'];?>
</option>
                                                    <?php } ?>
                                                </select>
                                            </td>
                                            <td>联系方式</td>
                                            <td></td>
                                            <td>上车地点</td>
                                            <td></td>
                                        </tr>
                                        <tr nowrap="nowrap">
                                            <td>车牌号</td>
                                            <td>
                                                <select class="form-control" name="car_id"  id="car_id">
                                                    <?php  $_smarty_tpl->tpl_vars['v'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['v']->_loop = false;
 $_smarty_tpl->tpl_vars['k'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['cars']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['v']->key => $_smarty_tpl->tpl_vars['v']->value){
$_smarty_tpl->tpl_vars['v']->_loop = true;
 $_smarty_tpl->tpl_vars['k']->value = $_smarty_tpl->tpl_vars['v']->key;
?>
                                                    <option value="<?php echo $_smarty_tpl->tpl_vars['v']->value['id'];?>
" ><?php echo $_smarty_tpl->tpl_vars['v']->value['car_num'];?>
</option>
                                                    <?php } ?>
                                                </select>
                                            </td>
                                            <td>车辆名称</td>
                                            <td></td>
                                            <td>座位数</td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>行驶里程</td>
                                            <td><input type="text" name="mileage"  id="mileage" class="form-control" placeholder="行驶里程"></td>
                                            <td>开始公里数</td>
                                            <td>
                                                <input type="text" class="form-control"  id="start_kilometers"  name="start_kilometers" />
                                            </td>
                                            <td>结束公里数</td>
                                            <td>
                                                <input type="text" class="form-control"  id="end_kilometers"  name="end_kilometers" />
                                            </td>
                                        </tr>
                                        <tr>
                                            <td height="70">收费详情</td>
                                            <style>
                                                #fy input{ display: inline-block; padding: 0 4px; width: 40px; }
                                            </style>
                                            <td colspan="6" style="text-align: left" id="fy">
                                                路桥费<input type="text" name="fees_sum" id="fees_sum"  class="form-control" placeholder="" style="width: 35px" >元，停车费<input type="text" name="parking_rate_sum" id="parking_rate_sum"  class="form-control" placeholder="" style="width: 35px">元，出行服务费<input type="text" name="service_charge" id="service_charge"  class="form-control" style="width: 35px">元，司机住宿补贴<input type="text" name="driver_cost" id="driver_cost"  class="form-control" style="width: 35px">元，超时费<input type="text" name="over_time_cost" id="over_time_cost" class="form-control" placeholder="" style="width: 35px">元，超公里费<input type="text" name="over_mileage_cost" id="over_mileage_cost" class="form-control" placeholder="" style="width: 35px">元，其他费用<input type="text" name="else_cost"  id="else_cost" class="form-control" placeholder="" style="width: 35px">元，司机补贴<input type="text" name="driver_bt_cost"  id="driver_bt_cost" class="form-control" placeholder="" style="width: 35px">元。

                                            </td>
                                        </tr>
                                        <tr>
                                            <td rowspan="2">其他</td>
                                            <td rowspan="2">对驾驶员服务评价</td>
                                            <td colspan="5" style="text-align: left">
                                                <label><input name="attitude" type="radio" value="1" />非常不满意 </label>
                                                <label><input name="attitude" type="radio" value="2" />不满意 </label>
                                                <label><input name="attitude" type="radio" value="3" />一般</label>
                                                <label><input name="attitude" type="radio" value="4" />满意</label>
                                                <label><input name="attitude" type="radio" value="5" />非常满意</label>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="5" style="text-align: left">意见：<input type="text" name="evaluate" id="evaluate"  class="form-control input-inline input-medium" placeholder="评价"></td>
                                        </tr>
                                    </table>


                                    <div class="form-group" style="margin-top: 15px;">
                                        <button type="button" class="btn btn-primary" onclick="addTravelPost()" id="btn">提交</button>
                                        <!--<a class="btn btn-primary" onclick="addTravelPost()">提交</a>-->
                                    </div>


                                </div>



                            </div>
                        </div>
                    </div>
                </div>
            </div>



            </div>
        </div>
    </div>
</body>
</html>

<!--[if lt IE 9]>
<script src="<?php echo @PUBLIC_URL;?>
/assets/global/plugins/respond.min.js"></script>
<script src="<?php echo @PUBLIC_URL;?>
/assets/global/plugins/excanvas.min.js"></script>
<script src="<?php echo @PUBLIC_URL;?>
/assets/global/plugins/ie8.fix.min.js"></script>
<![endif]-->
<!-- BEGIN CORE PLUGINS -->
<script src="<?php echo @PUBLIC_URL;?>
/assets/global/plugins/jquery.min.js" type="text/javascript"></script>
<script src="<?php echo @PUBLIC_URL;?>
/assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="<?php echo @PUBLIC_URL;?>
/assets/global/plugins/js.cookie.min.js" type="text/javascript"></script>
<script src="<?php echo @PUBLIC_URL;?>
/assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<script src="<?php echo @PUBLIC_URL;?>
/assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
<script src="<?php echo @PUBLIC_URL;?>
/assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="<?php echo @PUBLIC_URL;?>
/assets/global/plugins/moment.min.js" type="text/javascript"></script>
<script src="<?php echo @PUBLIC_URL;?>
/assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.js" type="text/javascript"></script>
<script src="<?php echo @PUBLIC_URL;?>
/assets/global/plugins/morris/morris.min.js" type="text/javascript"></script>
<script src="<?php echo @PUBLIC_URL;?>
/assets/global/plugins/morris/raphael-min.js" type="text/javascript"></script>
<script src="<?php echo @PUBLIC_URL;?>
/assets/global/plugins/counterup/jquery.waypoints.min.js" type="text/javascript"></script>
<script src="<?php echo @PUBLIC_URL;?>
/assets/global/plugins/counterup/jquery.counterup.min.js" type="text/javascript"></script>
<script src="<?php echo @PUBLIC_URL;?>
/assets/global/plugins/amcharts/amcharts/amcharts.js" type="text/javascript"></script>
<script src="<?php echo @PUBLIC_URL;?>
/assets/global/plugins/amcharts/amcharts/serial.js" type="text/javascript"></script>
<script src="<?php echo @PUBLIC_URL;?>
/assets/global/plugins/amcharts/amcharts/pie.js" type="text/javascript"></script>
<script src="<?php echo @PUBLIC_URL;?>
/assets/global/plugins/amcharts/amcharts/radar.js" type="text/javascript"></script>
<script src="<?php echo @PUBLIC_URL;?>
/assets/global/plugins/amcharts/amcharts/themes/light.js" type="text/javascript"></script>
<script src="<?php echo @PUBLIC_URL;?>
/assets/global/plugins/amcharts/amcharts/themes/patterns.js" type="text/javascript"></script>
<script src="<?php echo @PUBLIC_URL;?>
/assets/global/plugins/amcharts/amcharts/themes/chalk.js" type="text/javascript"></script>
<script src="<?php echo @PUBLIC_URL;?>
/assets/global/plugins/amcharts/ammap/ammap.js" type="text/javascript"></script>
<script src="<?php echo @PUBLIC_URL;?>
/assets/global/plugins/amcharts/ammap/maps/js/worldLow.js" type="text/javascript"></script>
<script src="<?php echo @PUBLIC_URL;?>
/assets/global/plugins/amcharts/amstockcharts/amstock.js" type="text/javascript"></script>
<script src="<?php echo @PUBLIC_URL;?>
/assets/global/plugins/fullcalendar/fullcalendar.min.js" type="text/javascript"></script>
<script src="<?php echo @PUBLIC_URL;?>
/assets/global/plugins/horizontal-timeline/horizontal-timeline.js" type="text/javascript"></script>
<script src="<?php echo @PUBLIC_URL;?>
/assets/global/plugins/flot/jquery.flot.min.js" type="text/javascript"></script>
<script src="<?php echo @PUBLIC_URL;?>
/assets/global/plugins/flot/jquery.flot.resize.min.js" type="text/javascript"></script>
<script src="<?php echo @PUBLIC_URL;?>
/assets/global/plugins/flot/jquery.flot.categories.min.js" type="text/javascript"></script>
<script src="<?php echo @PUBLIC_URL;?>
/assets/global/plugins/jquery-easypiechart/jquery.easypiechart.min.js" type="text/javascript"></script>
<script src="<?php echo @PUBLIC_URL;?>
/assets/global/plugins/jquery.sparkline.min.js" type="text/javascript"></script>
<script src="<?php echo @PUBLIC_URL;?>
/assets/global/plugins/jqvmap/jqvmap/jquery.vmap.js" type="text/javascript"></script>
<script src="<?php echo @PUBLIC_URL;?>
/assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.russia.js" type="text/javascript"></script>
<script src="<?php echo @PUBLIC_URL;?>
/assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.world.js" type="text/javascript"></script>
<script src="<?php echo @PUBLIC_URL;?>
/assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.europe.js" type="text/javascript"></script>
<script src="<?php echo @PUBLIC_URL;?>
/assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.germany.js" type="text/javascript"></script>
<script src="<?php echo @PUBLIC_URL;?>
/assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.usa.js" type="text/javascript"></script>
<script src="<?php echo @PUBLIC_URL;?>
/assets/global/plugins/jqvmap/jqvmap/data/jquery.vmap.sampledata.js" type="text/javascript"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN THEME GLOBAL SCRIPTS -->
<script src="<?php echo @PUBLIC_URL;?>
/assets/global/scripts/app.min.js" type="text/javascript"></script>
<!-- END THEME GLOBAL SCRIPTS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="<?php echo @PUBLIC_URL;?>
/assets/pages/scripts/dashboard.min.js" type="text/javascript"></script>
<!-- END PAGE LEVEL SCRIPTS -->
<!-- BEGIN THEME LAYOUT SCRIPTS -->
<script src="<?php echo @PUBLIC_URL;?>
/assets/layouts/layout/scripts/layout.min.js" type="text/javascript"></script>
<script src="<?php echo @PUBLIC_URL;?>
/assets/layouts/layout/scripts/demo.min.js" type="text/javascript"></script>
<script src="<?php echo @PUBLIC_URL;?>
/assets/layouts/global/scripts/quick-sidebar.min.js" type="text/javascript"></script>
<script src="<?php echo @PUBLIC_URL;?>
/assets/layouts/global/scripts/quick-nav.min.js" type="text/javascript"></script>
<!-- END THEME LAYOUT SCRIPTS -->

<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="<?php echo @PUBLIC_URL;?>
/assets/global/scripts/datatable.js" type="text/javascript"></script>
<script src="<?php echo @PUBLIC_URL;?>
/assets/global/plugins/datatables/language.js" type="text/javascript"></script>
<script src="<?php echo @PUBLIC_URL;?>
/assets/global/plugins/datatables/datatables.min.js" type="text/javascript"></script>
<script src="<?php echo @PUBLIC_URL;?>
/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>
<script src="<?php echo @PUBLIC_URL;?>
/assets/global/plugins/template.js" type="text/javascript"></script>
<script src="<?php echo @PUBLIC_URL;?>
/assets/global/plugins/bootstrap-sweetalert/sweetalert.min.js" type="text/javascript"></script>
<script src="<?php echo @PUBLIC_URL;?>
/assets/global/plugins/bootbox/bootbox.min.js" type="text/javascript"></script>

<script src="<?php echo @PUBLIC_URL;?>
/plugin/layer/layer.js" type="text/javascript"></script>


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


<link rel="stylesheet" href="<?php echo @PUBLIC_URL;?>
css/bootstrap-multiselect.css" type="text/css"/>
<script type="text/javascript" src="<?php echo @PUBLIC_URL;?>
js/bootstrap-multiselect.js"></script>
<!-- END PAGE LEVEL SCRIPTS -->


<script>



    jQuery(document).ready(function() {
        $('#company_id').multiselect({
            includeSelectAllOption: true,
            enableFiltering: true,
            maxHeight: 200
        });

        //用车人选择
        $('#use_user_id').multiselect({
            includeSelectAllOption: true,
            enableFiltering: true,
            maxHeight: 200
        });

        //用车人选择
        $('#car_id').multiselect({
            includeSelectAllOption: true,
            enableFiltering: true,
            maxHeight: 200
        });

        //用车人选择
        $('#driver_id').multiselect({
            includeSelectAllOption: true,
            enableFiltering: true,
            maxHeight: 200
        });



    });


    //时间选择器
    $('.form_datetime').datetimepicker({
        language: 'zh-CN',
        weekStart: 1,
        todayBtn: 1,
        autoclose: 1,
        todayHighlight: 1,
        startView: 2,
        forceParse: 0,
        showMeridian: 1
    });



    function addTravelPost() {
        //获取流水号
        var serial_number=$("#serial_number").val();
        if(!serial_number){ toastr.warning('流水号不得为空'); $("#serial_number").focus().select(); return false; }

        //获取用车单位ID
        var company_id=$("#company_id").val();

        //获取用车人ID
        var use_user_id=$("#use_user_id").val();

        //获取提交时间
        var sign_time=$("#sign_time").val();
        if(!sign_time){ toastr.warning('提交时间不能为空'); $("#sign_time").focus().select(); return false; }

        //获取预约时间
        var departure_time=$("#departure_time").val();
        if(!departure_time){ toastr.warning('预约时间不能为空'); $("#departure_time").focus().select(); return false; }

        //获取出车时间
        var start_car_time=$("#start_car_time").val();
        if(!start_car_time){ toastr.warning('出车时间不能为空'); $("#start_car_time").focus().select(); return false; }

        //获取结束时间
        var end_use_car_time=$("#end_use_car_time").val();
        if(!end_use_car_time){ toastr.warning('结束用车时间不能为空'); $("#end_use_car_time").focus().select(); return false; }

        //申请时间<出车时间<预约时间<结束时间
        var sign_timeS = Date.parse(new Date(sign_time));
        var departure_timeS = Date.parse(new Date(departure_time));
        var start_car_timeS = Date.parse(new Date(start_car_time));
        var end_use_car_timeS = Date.parse(new Date(end_use_car_time));
        if(sign_timeS>start_car_timeS){
            toastr.warning('申请时间不得大于出车时间'); $("#sign_time").focus().select(); return false;
        }
        // if(start_car_timeS>departure_timeS){
        //     toastr.warning('出车时间不得大于预约时间'); $("#start_car_time").focus().select(); return false;
        // }
        if(departure_timeS>end_use_car_timeS){
            toastr.warning('预约时间不得大于结束时间'); $("#departure_time").focus().select(); return false;
        }





        //获取出行方式
        var travel_type_id=$("#travel_type_id").val();
        if(travel_type_id==0){ toastr.warning('请选择出行方式'); $("#travel_type_id").focus().select(); return false; }






        //获取行车路线
        var from_place=$("#from_place").val();
        if(!from_place){ toastr.warning('行车路线不能为空'); $("#from_place").focus().select(); return false; }
        var to_place=$("#to_place").val();
        if(!to_place){ toastr.warning('行车路线不能为空'); $("#to_place").focus().select(); return false; }

        //获取乘车人名单
        //var select_user=$("#select_user").val();
        //if(!select_user){ toastr.warning('请选择乘车人'); $("#select_user").focus().select(); return false; }
        var travel_people=$("#travel_people").val();
        if(travel_people==""){ toastr.warning('请填写乘车人'); $("#travel_people").focus().select(); return false; }

        //获取支付方式
        var pay_type=$("#pay_type").val();
        if(pay_type==0){ toastr.warning('请选择支付方式'); $("#pay_type").focus().select(); return false; }

        //获取出行性质
        var travel_nature=$("#travel_nature").val();
        if(travel_nature==0){ toastr.warning('请选择出行性质'); $("#travel_nature").focus().select(); return false; }

        //获取出行事由
        var travel_reason=$("#travel_reason").val();
        if(!travel_reason){ toastr.warning('出行事由不能为空'); $("#travel_reason").focus().select(); return false; }

        //获取驾驶员姓名
        var driver_id=$("#driver_id").val();

        //获取车牌号
        var car_id=$("#car_id").val();

        //获取行驶里程
        var mileage=$("#mileage").val();
        if(!mileage){ toastr.warning('行驶里程不能为空'); $("#mileage").focus().select(); return false; }

        var start_kilometers=$("#start_kilometers").val();
        var end_kilometers=$("#end_kilometers").val();

        if(isNaN(mileage)){
            toastr.warning('行驶里程只能为数字'); $("#mileage").focus().select(); return false;
        }
        if(isNaN(start_kilometers)){
            toastr.warning('开始公里数只能为数字'); $("#start_kilometers").focus().select(); return false;
        }
        if(isNaN(end_kilometers)){
            toastr.warning('结束公里数只能为数字'); $("#end_kilometers").focus().select(); return false;
        }

        if(end_kilometers<start_kilometers){
            toastr.warning('开始公里数不得小于结束公里数'); $("#end_kilometers").focus().select(); return false;
        }

        if((end_kilometers-start_kilometers)!=mileage){
            toastr.warning('结束公里数减去开始公里数与行驶里程不一致'); $("#mileage").focus().select(); return false;
        }

        //费用
        var fees_sum=$("#fees_sum").val();
        var parking_rate_sum=$("#parking_rate_sum").val();
        var service_charge=$("#service_charge").val();
        var driver_cost=$("#driver_cost").val();
        var over_time_cost=$("#over_time_cost").val();
        var over_mileage_cost=$("#over_mileage_cost").val();
        var else_cost=$("#else_cost").val();

        //评价
        var attitude = $('input[name="attitude"]:checked ').val();
        if(typeof(attitude)=="undefined"){
            attitude=0;
        }
        var evaluate=$("#evaluate").val();


        //发送ajax请求
        $.ajax({
            type: 'POST',
            url: "/index.php/Admin/Travel/manualTravelDo",
            data: {
                serial_number:serial_number,
                company_id:company_id,
                user_id:use_user_id,
                sign_time:sign_time,
                departure_time:departure_time,
                start_car_time:start_car_time,
                end_use_car_time:end_use_car_time,
                travel_type_id:travel_type_id,
                from_place:from_place,
                to_place:to_place,
                travel_people:travel_people,
                end_kilometers:end_kilometers,
                pay_type:pay_type,
                travel_nature:travel_nature,
                travel_reason:travel_reason,
                driver_id:driver_id,
                car_id:car_id,
                mileage:mileage,
                start_kilometers:start_kilometers,

                fees_sum:fees_sum,
                parking_rate_sum:parking_rate_sum,
                service_charge:service_charge,
                driver_cost:driver_cost,
                over_time_cost:over_time_cost,
                over_mileage_cost:over_mileage_cost,
                else_cost:else_cost,
                attitude:attitude,
                evaluate:evaluate
            },
            beforeSend:function () {
                $("#btn").text("提交中...");
                $('#btn').attr('onclick','javascript:void();');
            },
            success: function (msg) {
                if(msg.code==1){
                    toastr.success('操作成功');


                }else{
                    toastr.warning('操作失败');
                    $('#btn').attr('onclick','addTravelPost();');

                }
            },
            //dataType: "json"
        });

    }





</script>


<?php }} ?>