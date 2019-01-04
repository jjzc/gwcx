<?php /* Smarty version Smarty-3.1.6, created on 2018-08-09 10:35:00
         compiled from "E:/PhpStorm/yxcar/Admin/View\TravelSet\travelSet.html" */ ?>
<?php /*%%SmartyHeaderCode:85185b6ba854974399-48902272%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd01e099ca713b8c2800ac322393cabc1ef1c9ce4' => 
    array (
      0 => 'E:/PhpStorm/yxcar/Admin/View\\TravelSet\\travelSet.html',
      1 => 1528908852,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '85185b6ba854974399-48902272',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'set' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.6',
  'unifunc' => 'content_5b6ba854dcf12',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5b6ba854dcf12')) {function content_5b6ba854dcf12($_smarty_tpl) {?><!DOCTYPE html>

<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<!-- BEGIN HEAD -->

<head>
    <meta charset="utf-8" />
    <title>系统配置</title>
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
    <link rel="shortcut icon" href="favicon.ico" /> </head>
<!-- END HEAD -->

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
                            <span class="title">系统配置</span>
                            <span class="selected"></span>
                            <span class="arrow open"></span>
                        </a>
                        <ul class="sub-menu">

                            <li class="nav-item start  active open">
                                <a href="/index.php/Admin/TravelSet/travelSet" class="nav-link ">
                                    <i class="icon-bulb"></i>
                                    <span class="title">系统设置</span>
                                    <!--<span class="badge badge-success">1</span>-->
                                </a>
                            </li>
                            <li class="nav-item start ">
                                <a href="/index.php/Admin/TravelSet/travelTypes" class="nav-link ">
                                    <i class="icon-graph"></i>
                                    <span class="title">出行类型</span>
                                    <!--<span class="badge badge-danger">5</span>-->
                                </a>
                            </li>
                            <li class="nav-item start ">
                                <a href="/index.php/Admin/TravelSet/travelNatures" class="nav-link ">
                                    <i class="icon-graph"></i>
                                    <span class="title">出行性质</span>
                                    <!--<span class="badge badge-danger">5</span>-->
                                </a>
                            </li>
                            <li class="nav-item start ">
                                <a href="/index.php/Admin/TravelSet/payTypes" class="nav-link ">
                                    <i class="icon-graph"></i>
                                    <span class="title">支付方式</span>
                                    <!--<span class="badge badge-danger">5</span>-->
                                </a>
                            </li>
                            <li class="nav-item start ">
                                <a href="/index.php/Admin/TravelSet/carRepair" class="nav-link ">
                                    <i class="icon-graph"></i>
                                    <span class="title">车辆维修类型</span>
                                    <!--<span class="badge badge-danger">5</span>-->
                                </a>
                            </li>
                            <li class="nav-item start ">
                                <a href="/index.php/Admin/TravelSet/smsTemplates" class="nav-link ">
                                    <i class="icon-graph"></i>
                                    <span class="title">短信模板</span>
                                    <!--<span class="badge badge-danger">5</span>-->
                                </a>
                            </li>
                            <li class="nav-item start ">
                                <a href="/index.php/Admin/TravelSet/charging" class="nav-link ">
                                    <i class="icon-graph"></i>
                                    <span class="title">计费价格</span>
                                    <!--<span class="badge badge-danger">5</span>-->
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item start">
                        <a href="javascript:;" class="nav-link nav-toggle">
                            <i class="icon-home"></i>
                            <span class="title">服务单位</span>
                            <span class="selected"></span>
                            <span class="arrow open"></span>
                        </a>
                        <ul class="sub-menu">
                            <li class="nav-item start">
                                <a href="/index.php/Admin/TravelSet/repairShop" class="nav-link ">
                                    <i class="icon-bulb"></i>
                                    <span class="title">车辆维修服务单位</span>
                                    <!--<span class="badge badge-success">1</span>-->
                                </a>
                            </li>
                            <li class="nav-item start">
                                <a href="/index.php/Admin/TravelSet/washShop" class="nav-link ">
                                    <i class="icon-bulb"></i>
                                    <span class="title">洗车服务单位</span>
                                    <!--<span class="badge badge-success">1</span>-->
                                </a>
                            </li>
                            <li class="nav-item start">
                                <a href="/index.php/Admin/TravelSet/oilShop" class="nav-link ">
                                    <i class="icon-bulb"></i>
                                    <span class="title">加油服务单位</span>
                                    <!--<span class="badge badge-success">1</span>-->
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item start">
                        <a href="javascript:;" class="nav-link nav-toggle">
                            <i class="icon-home"></i>
                            <span class="title">APP版本</span>
                            <span class="selected"></span>
                            <span class="arrow open"></span>
                        </a>
                        <ul class="sub-menu">
                            <li class="nav-item start">
                                <a href="/index.php/Admin/TravelSet/userApp" class="nav-link ">
                                    <i class="icon-bulb"></i>
                                    <span class="title">用户端</span>
                                    <!--<span class="badge badge-success">1</span>-->
                                </a>
                            </li>
                            <li class="nav-item start">
                                <a href="/index.php/Admin/TravelSet/driverApp" class="nav-link ">
                                    <i class="icon-bulb"></i>
                                    <span class="title">司机端</span>
                                    <!--<span class="badge badge-success">1</span>-->
                                </a>
                            </li>
                            <li class="nav-item start">
                                <a href="/index.php/Admin/TravelSet/centerApp" class="nav-link ">
                                    <i class="icon-bulb"></i>
                                    <span class="title">中心端</span>
                                    <!--<span class="badge badge-success">1</span>-->
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
        <div class="page-content-wrapper">
            <!-- BEGIN CONTENT BODY -->
            <div class="page-content">
                <div class="page-bar">
                    <ul class="page-breadcrumb">
                        <li>
                            <a href="">首页</a>
                            <i class="fa fa-circle"></i>
                        </li>
                        <li>
                            <span>系统配置</span>
                        </li>
                    </ul>

                </div>
                <!--<h1 class="page-title"> 系统配置</h1>-->



                <!--表格开始-->
                <!--全部出行表格-->
                <div>

                    <div class="col-md-12">
                        <div class="portlet light ">
                            <div class="portlet-body form">
                                <form class="form-horizontal" role="form" action="/index.php/Admin/TravelSet/saveSet" method="post" id="addCarForm">
                                    <input type="hidden" name="id" id="id" value="<?php echo $_smarty_tpl->tpl_vars['set']->value['id'];?>
">
                                    <div class="form-body">
                                        <div class="form-group col-md-12">
                                            <label class="col-md-2 control-label">系统名称</label>
                                            <div class="col-md-10">
                                                <input type="text" class="form-control input-inline input-medium" placeholder="系统名称" name="web_name" id="web_name" value="<?php echo $_smarty_tpl->tpl_vars['set']->value['web_name'];?>
">
                                                <span style="color: #FF0000;">*</span>
                                            </div>
                                        </div>



                                        <div class="form-group col-md-12">
                                            <label class="col-md-2 control-label">短信帐号</label>
                                            <div class="col-md-10">
                                                <input type="text" class="form-control input-inline input-medium" placeholder="短信帐号" name="sms_account" id="sms_account"  value="<?php echo $_smarty_tpl->tpl_vars['set']->value['sms_account'];?>
">
                                                <span style="color: #FF0000;">*</span>
                                            </div>
                                        </div>

                                        <div class="form-group col-md-12">
                                            <label class="col-md-2 control-label">短信密码</label>
                                            <div class="col-md-10">
                                                <input type="text" class="form-control input-inline input-medium" placeholder="短信密码" name="sms_pwd" id="sms_pwd"  value="<?php echo $_smarty_tpl->tpl_vars['set']->value['sms_pwd'];?>
">
                                                <span style="color: #FF0000;">*</span>
                                            </div>
                                        </div>

                                        <div class="form-group col-md-12">
                                            <label class="col-md-2 control-label">开启短信推送</label>
                                            <div class="col-md-10">
                                                <!--<input type="text" class="form-control input-inline input-medium" placeholder="短信密码" name="sms_pwd" id="sms_pwd"  value="<?php echo $_smarty_tpl->tpl_vars['set']->value['sms_pwd'];?>
">-->
                                                <input type="checkbox" <?php if ($_smarty_tpl->tpl_vars['set']->value['is_open_sms']=="1"){?>checked<?php }?>   class="make-switch" id="is_open_sms" data-size="small" name="is_open_sms" value="1" />
                                                <span style="color: #FF0000;">*</span>
                                            </div>
                                        </div>


                                        <div class="form-group col-md-12">
                                            <label class="col-md-2 control-label">是否锁定车辆档案</label>
                                            <div class="col-md-10">
                                                <!--<input type="text" class="form-control input-inline input-medium" placeholder="短信密码" name="sms_pwd" id="sms_pwd"  value="<?php echo $_smarty_tpl->tpl_vars['set']->value['sms_pwd'];?>
">-->
                                                <input type="checkbox" <?php if ($_smarty_tpl->tpl_vars['set']->value['is_lock_car']=="1"){?>checked<?php }?>   class="make-switch" id="is_lock_car" data-size="small" name="is_lock_car" value="1" />
                                                <span style="color: #FF0000;">*</span>
                                            </div>
                                        </div>


                                        <div class="form-group col-md-12">
                                            <label class="col-md-2 control-label">Excel导入出行</label>
                                            <div class="col-md-10">
                                                <!--<input type="text" class="form-control input-inline input-medium" placeholder="短信密码" name="sms_pwd" id="sms_pwd"  value="<?php echo $_smarty_tpl->tpl_vars['set']->value['sms_pwd'];?>
">-->
                                                <input type="checkbox" <?php if ($_smarty_tpl->tpl_vars['set']->value['is_open_manual']=="1"){?>checked<?php }?>   class="make-switch" id="is_open_manual" data-size="small" name="is_open_manual" value="1" />
                                                <span style="color: #FF0000;">*</span>
                                            </div>
                                        </div>

                                        <div class="form-group col-md-12">
                                            <label class="col-md-2 control-label">是否使用车载GPS</label>
                                                <div class="col-md-10">
                                                    <!--<input type="text" class="form-control input-inline input-medium" placeholder="短信密码" name="sms_pwd" id="sms_pwd"  value="<?php echo $_smarty_tpl->tpl_vars['set']->value['sms_pwd'];?>
">-->
                                                    <input type="checkbox" <?php if ($_smarty_tpl->tpl_vars['set']->value['is_use_gps']=="1"){?>checked<?php }?>   class="make-switch" id="is_use_gps" data-size="small" name="is_use_gps" value="1" />
                                                    <span style="color: #FF0000;">*</span>
                                                </div>
                                        </div>



                                        <div class="form-group col-md-12">
                                            <label class="col-md-2 control-label">审计开始时间</label>
                                            <div class="col-md-10">
                                                <div class="input-group date form_datetime input-medium" data-date="" data-date-format="yyyy-mm-dd" data-link-field="dtp_input1">
                                                    <input name="commercial_insurance_time" class="form-control" size="16" type="text" value="<?php echo $_smarty_tpl->tpl_vars['set']->value['audit_start_time'];?>
" readonly>
                                                    <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                                                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group col-md-12">
                                            <label class="col-md-2 control-label">审计结束时间</label>
                                            <div class="col-md-10">
                                                <div class="input-group date form_datetime input-medium" data-date="" data-date-format="yyyy-mm-dd" data-link-field="dtp_input1">
                                                    <input name="commercial_insurance_time" class="form-control" size="16" type="text" value="<?php echo $_smarty_tpl->tpl_vars['set']->value['audit_end_time'];?>
" readonly>
                                                    <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                                                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group col-md-12">
                                            <label class="col-md-2 control-label">默认地区设置</label>
                                            <div class="col-md-10">
                                                <div data-toggle="distpicker" id="distpicker">
                                                    <select name="province" class="form-control" style="width: auto; display: inline-block;"></select>
                                                    <select name="city" class="form-control" style="width: auto; display: inline-block;"></select>
                                                </div>
                                            </div>
                                        </div>



                                        <div class="form-group col-md-12">
                                            <label class="col-md-2 control-label">平台中心地址</label>
                                            <div class="col-md-10">
                                                <input type="text" class="form-control input-inline input-medium" placeholder="平台中心地址" name="center_address" id="center_address"  value="<?php echo $_smarty_tpl->tpl_vars['set']->value['center_address'];?>
">
                                                <span style="color: #FF0000;">*</span>
                                            </div>
                                        </div>

                                        <div class="form-group col-md-12">
                                            <label class="col-md-2 control-label">平台中心坐标设置</label>
                                            <div class="col-md-10">
                                                <input type="text" class="form-control input-inline input-medium" placeholder="平台中心坐标设置" name="center_location" id="center_location"  value="<?php echo $_smarty_tpl->tpl_vars['set']->value['center_location'];?>
">
                                                <span>
                                                    <p>注：平台中心坐标为方便司机完成服务后快速导航至平台中心。点击下方坐标拾取地址，将坐标获取结果填入下方输入框内！</p>
                                                    <p>坐标拾取地址：<a href="http://api.map.baidu.com/lbsapi/getpoint/index.html" target="_blank"> http://api.map.baidu.com/lbsapi/getpoint/index.html</a></p>
                                                </span>
                                            </div>
                                        </div>




                                    </div>

                                    <div class="form-actions col-md-12">
                                        <div class="row">
                                            <div class="col-md-offset-5 col-md-7">
                                                <button type="submit" class="btn green" >修改</button>
                                                <button type="button" class="btn default" onClick="getSmsCount();">查看短信剩余</button>
                                            </div>
                                        </div>
                                    </div>

                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>





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
/js/jquery.form.js" type="text/javascript"></script>
<script src="<?php echo @PUBLIC_URL;?>
/assets/global/plugins/bootstrap-toastr/toastr.min.js" type="text/javascript"></script>
<script src="<?php echo @PUBLIC_URL;?>
/js/js.js" type="text/javascript"></script>
<script src="<?php echo @PUBLIC_URL;?>
/plugin/layer/layer.js" type="text/javascript"></script>

<script src="<?php echo @PUBLIC_URL;?>
js/distpicker.data.js" charset="UTF-8"></script>
<script src="<?php echo @PUBLIC_URL;?>
js/distpicker.js" charset="UTF-8"></script>



<!-- END PAGE LEVEL SCRIPTS -->


<script>
    //获取系统内置的数据
    var province="<?php echo $_smarty_tpl->tpl_vars['set']->value['province'];?>
";
    var city="<?php echo $_smarty_tpl->tpl_vars['set']->value['city'];?>
"

    if(isE(province)||isE(city)){
        $('#distpicker').distpicker('reset');
    }else{
        $('#distpicker').distpicker({
            province: province,
            city: city
        });
    }


    function getSmsCount() {
        $.post("<?php echo U('Admin/TravelSet/getSmsBalance');?>
",
            {

            },
            function(data){
                alert("剩余"+data.Balance+"条");
            },
            'json'
        );

    }


    $("#addCarForm").submit(function () {

        //校验数据
        //toastr.error('Are you the 6 fingered man?');
        if(isE($("#web_name").val())){ toastr.error('系统名称不得为空！');  $("#web_name").focus();return false; }


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




</body>

</html><?php }} ?>