<?php /* Smarty version Smarty-3.1.6, created on 2018-09-12 11:48:55
         compiled from "E:/PhpStorm/yxcar/Admin/View\Report\byCar.html" */ ?>
<?php /*%%SmartyHeaderCode:262595b9864edc259a5-87296055%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e4ec2e95e8110043a1eac18989f6b3b21f0a4f63' => 
    array (
      0 => 'E:/PhpStorm/yxcar/Admin/View\\Report\\byCar.html',
      1 => 1536724131,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '262595b9864edc259a5-87296055',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.6',
  'unifunc' => 'content_5b9864edd8341',
  'variables' => 
  array (
    'startTime' => 0,
    'endTime' => 0,
    'carsall' => 0,
    'v' => 0,
    'aa' => 0,
    'type' => 0,
    'cars' => 0,
    'hj' => 0,
    'travels' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5b9864edd8341')) {function content_5b9864edd8341($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_date_format')) include 'E:\\PhpStorm\\yxcar\\ThinkPHP\\Library\\Vendor\\Smarty\\plugins\\modifier.date_format.php';
?><!DOCTYPE html>

<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<!-- BEGIN HEAD -->

<head>
    <meta charset="utf-8" />
    <title>车辆数据统计</title>
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

    <style>
        .trrrrr td{
            padding:5px 2px;
        }
    </style>
</head>
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
                            <span class="title">数据报表</span>
                            <span class="selected"></span>
                            <span class="arrow open"></span>
                        </a>
                        <ul class="sub-menu">

                            <li class="nav-item start">
                                <a href="/index.php/Admin/Report/byCompany" class="nav-link ">
                                    <i class="icon-graph"></i>
                                    <span class="title">单位数据报表</span>
                                    <!--<span class="badge badge-success">1</span>-->
                                </a>
                            </li>
                            <li class="nav-item start  active open">
                                <a href="/index.php/Admin/Report/byCar" class="nav-link ">
                                    <i class="icon-graph"></i>
                                    <span class="title">车辆数据报表</span>
                                    <!--<span class="badge badge-danger">5</span>-->
                                </a>
                            </li>
                            <li class="nav-item start ">
                                <a href="/index.php/Admin/Report/byDriver" class="nav-link ">
                                    <i class="icon-graph"></i>
                                    <span class="title">司机数据报表</span>
                                    <!--<span class="badge badge-danger">5</span>-->
                                </a>
                            </li>
                            <li class="nav-item start ">
                                <a href="/index.php/Admin/Report/byUser" class="nav-link ">
                                    <i class="icon-graph"></i>
                                    <span class="title">用户数据报表</span>
                                    <!--<span class="badge badge-danger">5</span>-->
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
                <!--<div class="page-bar">-->
                    <!--<ul class="page-breadcrumb">-->
                        <!--<li>-->
                            <!--<a href="">首页</a>-->
                            <!--<i class="fa fa-circle"></i>-->
                        <!--</li>-->
                        <!--<li>-->
                            <!--<span>车辆管理</span>-->
                        <!--</li>-->
                    <!--</ul>-->

                <!--</div>-->
                <!--<h1 class="page-title"> 全部车辆</h1>-->



                <!--表格开始-->
                <!--全部出行表格-->
                <div class="row" id="waitReviewRow">

                    <div class="col-md-12">
                        <div class="portlet light bordered">
                            <div class="portlet-title">
                                <div class="caption font-dark">
                                    <i class="icon-settings font-dark"></i>
                                    <span class="caption-subject bold uppercase">车辆数据统计</span>
                                </div>
                                <div class="tools">

                                </div>
                            </div>

                            <div class="portlet-body">
                                <form action="" method="post">
                                    <div class="form-group" style="width: 190px; float: left;">
                                        <div class="input-group date form_datetime col-md-5" id="startTimediv" data-date="" data-date-format="yyyy-mm-dd" data-link-field="dtp_input1">
                                            <input id="startTime" name="startTime" class="form-control jt" size="16" type="text" value="<?php echo $_smarty_tpl->tpl_vars['startTime']->value;?>
" placeholder="开始时间" readonly style="width: 100px">
                                            <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                                            <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                                        </div>
                                    </div>
                                    <div class="form-group" style="width: 190px; float: left;">
                                        <div class="input-group date form_datetime col-md-5" id="endTimediv" data-date="" data-date-format="yyyy-mm-dd" data-link-field="dtp_input1">
                                            <input id="endTime" name="endTime" class="form-control jt" size="16" type="text" value="<?php echo $_smarty_tpl->tpl_vars['endTime']->value;?>
" placeholder="结束时间" readonly style="width: 100px">
                                            <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                                            <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                                        </div>
                                    </div>
                                    <div class="form-group" style="width: 160px; float: left; margin-right: 8px;">
                                        <select name="car" class="form-control"   id="car">
                                            <option value="0">车辆(不限)</option>
                                            <?php  $_smarty_tpl->tpl_vars['v'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['v']->_loop = false;
 $_smarty_tpl->tpl_vars['k'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['carsall']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['v']->key => $_smarty_tpl->tpl_vars['v']->value){
$_smarty_tpl->tpl_vars['v']->_loop = true;
 $_smarty_tpl->tpl_vars['k']->value = $_smarty_tpl->tpl_vars['v']->key;
?>
                                            <option value="<?php echo $_smarty_tpl->tpl_vars['v']->value['id'];?>
" ><?php echo $_smarty_tpl->tpl_vars['v']->value['car_num'];?>
</option>
                                            <?php } ?>
                                        </select>
                                    </div>

                                    <div class="form-group" style="width: 160px; float: left; margin-right: 8px;">
                                        <select name="type" class="form-control"  id="type">
                                            <option value="1">统计报表</option>
                                            <option value="2">明细报表</option>
                                        </select>
                                    </div>


                                    <button id="btn_add"  type="submit" class="btn btn-default">
                                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>生成报表
                                    </button>


                                    <?php if ($_smarty_tpl->tpl_vars['aa']->value==1){?>
                                    <button id="btn_addd"  type="button" class="btn btn-default" onclick="dy();">
                                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>打印报表
                                    </button>
                                    <?php }?>


                                </form>
                            </div>


                            <!--startprint1-->
                            <?php if ($_smarty_tpl->tpl_vars['aa']->value==1){?>
                            <?php if ($_smarty_tpl->tpl_vars['type']->value==1){?>
                            <div class="portlet-body">
                                <table width="670" border="1" cellpadding="0" cellspacing="0" style="border-collapse:collapse; font-size:14px;">
                                    <tr>
                                        <td height="40" colspan="9" style="font-size:18px; text-align:center; line-height:40px;">公务用车平台车辆用车统计报表</td>
                                    </tr>
                                    <tr>
                                        <td height="30" colspan="9" style="font-size:16px; text-align:center; line-height:30px;">开起始时间：<?php echo $_smarty_tpl->tpl_vars['startTime']->value;?>
&nbsp;&nbsp;&nbsp;&nbsp;截至时间：<?php echo $_smarty_tpl->tpl_vars['endTime']->value;?>
&nbsp;&nbsp;&nbsp;&nbsp;金额单位：元</td>
                                    </tr>
                                    <tr style="text-align:center; height:30px; line-height:30px;">
                                        <td width="105px" rowspan="2">车牌号码</td>
                                        <td width="60px" rowspan="2">出行次数</td>
                                        <td width="70px" rowspan="2">出行里程</td>
                                        <td width="380px" colspan="5">出行费用</td>
                                        <td width="55px" rowspan="2">备注</td>
                                    </tr>
                                    <tr style="text-align:center; height:30px; line-height:30px;">
                                        <td width="76px">路桥费</td>
                                        <td width="76px">出行服务费</td>
                                        <td width="76px">出差补助</td>
                                        <td width="76px">其他</td>
                                        <td width="76px">小计</td>
                                    </tr>


                                    <?php  $_smarty_tpl->tpl_vars['v'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['v']->_loop = false;
 $_smarty_tpl->tpl_vars['k'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['cars']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['v']->key => $_smarty_tpl->tpl_vars['v']->value){
$_smarty_tpl->tpl_vars['v']->_loop = true;
 $_smarty_tpl->tpl_vars['k']->value = $_smarty_tpl->tpl_vars['v']->key;
?>
                                    <?php if ($_smarty_tpl->tpl_vars['v']->value['finishCount']!=0){?>
                                    <tr class="trrrrr">
                                        <td><?php echo $_smarty_tpl->tpl_vars['v']->value['car_num'];?>
</td>
                                        <td><?php echo $_smarty_tpl->tpl_vars['v']->value['finishCount'];?>
</td>
                                        <td><?php echo $_smarty_tpl->tpl_vars['v']->value['companyMileageCount'];?>
</td>
                                        <td><?php echo $_smarty_tpl->tpl_vars['v']->value['luqiaoCount'];?>
</td>
                                        <td><?php echo $_smarty_tpl->tpl_vars['v']->value['fuwufeiCount'];?>
</td>
                                        <td><?php echo $_smarty_tpl->tpl_vars['v']->value['buzhuCount'];?>
</td>
                                        <td><?php echo $_smarty_tpl->tpl_vars['v']->value['qitaCount'];?>
</td>
                                        <td><?php echo $_smarty_tpl->tpl_vars['v']->value['heji'];?>
</td>
                                        <td>&nbsp;</td>
                                    </tr>
                                    <?php }?>
                                    <?php } ?>

                                    <tr class="trrrrr">
                                        <td><div align="center">合计</div></td>
                                        <td><?php echo $_smarty_tpl->tpl_vars['hj']->value['finishCount'];?>
</td>
                                        <td><?php echo $_smarty_tpl->tpl_vars['hj']->value['companyMileageCount'];?>
</td>
                                        <td><?php echo $_smarty_tpl->tpl_vars['hj']->value['luqiaoCount'];?>
</td>
                                        <td><?php echo $_smarty_tpl->tpl_vars['hj']->value['fuwufeiCount'];?>
</td>
                                        <td><?php echo $_smarty_tpl->tpl_vars['hj']->value['buzhuCount'];?>
</td>
                                        <td><?php echo $_smarty_tpl->tpl_vars['hj']->value['qitaCount'];?>
</td>
                                        <td><?php echo $_smarty_tpl->tpl_vars['hj']->value['heji'];?>
</td>
                                        <td><div align="center"></div></td>
                                    </tr>
                                </table>
                            </div>
                            <?php }?>

                            <?php if ($_smarty_tpl->tpl_vars['type']->value==2){?>
                            <div class="portlet-body">
                                <table width="1000" border="1" cellpadding="0" cellspacing="0" style="border-collapse:collapse; font-size:14px;">
                                    <tr>
                                        <td height="40" colspan="13" style="font-size:18px; text-align:center; line-height:40px;">公务用车平台单位用车明细报表</td>
                                    </tr>
                                    <tr>
                                        <td height="30" colspan="13" style="font-size:16px; text-align:center; line-height:30px;">开起始时间：<?php echo $_smarty_tpl->tpl_vars['startTime']->value;?>
&nbsp;&nbsp;&nbsp;&nbsp;截至时间：<?php echo $_smarty_tpl->tpl_vars['endTime']->value;?>
&nbsp;&nbsp;&nbsp;&nbsp;金额单位：元</td>
                                    </tr>
                                    <tr style="text-align:center; height:30px; line-height:30px;">
                                        <td rowspan="2" width="80px">车牌号码</td>
                                        <td rowspan="2" width="60px;">出车司机</td>
                                        <td rowspan="2">用车单位</td>
                                        <td rowspan="2" width="60px">用车人</td>
                                        <td rowspan="2" width="125px">出车时间</td>
                                        <td rowspan="2">目的地</td>
                                        <td rowspan="2">出行里程</td>
                                        <td colspan="5">出行费用</td>
                                        <td rowspan="2">备注</td>
                                    </tr>
                                    <tr style="text-align:center; height:30px; line-height:30px;">
                                        <td width="67px">路桥费</td>
                                        <td width="82px">出行服务费</td>
                                        <td width="67px">出差补助</td>
                                        <td width="67px">其他</td>
                                        <td width="67px">小计</td>
                                    </tr>


                                    <?php  $_smarty_tpl->tpl_vars['v'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['v']->_loop = false;
 $_smarty_tpl->tpl_vars['k'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['travels']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['v']->key => $_smarty_tpl->tpl_vars['v']->value){
$_smarty_tpl->tpl_vars['v']->_loop = true;
 $_smarty_tpl->tpl_vars['k']->value = $_smarty_tpl->tpl_vars['v']->key;
?>
                                    <tr class="trrrrr">
                                        <td><?php echo $_smarty_tpl->tpl_vars['v']->value['car_num'];?>
</td>
                                        <td><?php echo $_smarty_tpl->tpl_vars['v']->value['driver_name'];?>
</td>
                                        <td><?php echo $_smarty_tpl->tpl_vars['v']->value['company_namee'];?>
</td>
                                        <td><?php echo $_smarty_tpl->tpl_vars['v']->value['user_name'];?>
</td>
                                        <td><?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['v']->value['start_car_time'],'%Y-%m-%d %H:%M');?>
</td>
                                        <td><?php echo $_smarty_tpl->tpl_vars['v']->value['to_place'];?>
</td>
                                        <td><?php echo $_smarty_tpl->tpl_vars['v']->value['mileage'];?>
</td>
                                        <td><?php echo $_smarty_tpl->tpl_vars['v']->value['fees_sum'];?>
</td>
                                        <td><?php echo $_smarty_tpl->tpl_vars['v']->value['service_charge'];?>
</td>
                                        <td>0</td>
                                        <td><?php echo $_smarty_tpl->tpl_vars['v']->value['else_cost'];?>
</td>
                                        <td><?php echo $_smarty_tpl->tpl_vars['v']->value['totle_rate'];?>
</td>
                                        <td>&nbsp;</td>
                                    </tr>
                                    <?php } ?>





                                </table>
                            </div>
                            <?php }?>


                            <?php }?>
                            <!--endprint1-->
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
/js/js.js" type="text/javascript"></script>

<!-- END PAGE LEVEL SCRIPTS -->


<script>
    function dy() {
        preview(1);
    }

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
    jQuery(document).ready(function() {
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
        }).on('changeDate', function(ev){
            //fiflt();
        });
    });
</script>

</body>
</html>
<?php }} ?>