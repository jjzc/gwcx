<?php /* Smarty version Smarty-3.1.6, created on 2018-12-19 16:30:30
         compiled from "D:/xampp/htdocs/Admin/View\Car\repairRecord.html" */ ?>
<?php /*%%SmartyHeaderCode:124725bbf0941cabcd2-01601103%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'fec81ecf4b9b53241f5c2ab118fc36586873a57b' => 
    array (
      0 => 'D:/xampp/htdocs/Admin/View\\Car\\repairRecord.html',
      1 => 1545187172,
      2 => 'file',
    ),
    '3773594bb26004a1f6798cec8a848ab8f5e6548d' => 
    array (
      0 => 'D:\\xampp\\htdocs\\Admin\\View\\Car\\template.html',
      1 => 1543804932,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '124725bbf0941cabcd2-01601103',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.6',
  'unifunc' => 'content_5bbf09425511b',
  'variables' => 
  array (
    'carLeft1' => 0,
    'v' => 0,
    'carLeft2' => 0,
    'carLeft3' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5bbf09425511b')) {function content_5bbf09425511b($_smarty_tpl) {?><!DOCTYPE html>
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


                        <?php if ($_smarty_tpl->tpl_vars['carLeft1']->value!=null){?>
                        <li class="nav-item start active open">
                            <a href="javascript:;" class="nav-link nav-toggle">
                                <i class="icon-home"></i>
                                <span class="title">车辆管理</span>
                                <span class="selected"></span>
                                <span class="arrow open"></span>
                            </a>
                            <ul class="sub-menu">
                                <?php  $_smarty_tpl->tpl_vars['v'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['v']->_loop = false;
 $_smarty_tpl->tpl_vars['k'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['carLeft1']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
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
                        <?php }?>

                        <?php if ($_smarty_tpl->tpl_vars['carLeft2']->value!=null){?>
                        <li class="nav-item start active open">
                            <a href="javascript:;" class="nav-link nav-toggle">
                                <i class="icon-home"></i>
                                <span class="title">车辆类型管理</span>
                                <span class="selected"></span>
                                <span class="arrow open"></span>
                            </a>
                            <ul class="sub-menu">
                                <?php  $_smarty_tpl->tpl_vars['v'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['v']->_loop = false;
 $_smarty_tpl->tpl_vars['k'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['carLeft2']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
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
                        <?php }?>

                        <?php if ($_smarty_tpl->tpl_vars['carLeft3']->value!=null){?>
                        <li class="nav-item start active open">
                            <a href="javascript:;" class="nav-link nav-toggle">
                                <i class="icon-home"></i>
                                <span class="title">费用管理</span>
                                <span class="selected"></span>
                                <span class="arrow open"></span>
                            </a>
                            <ul class="sub-menu">
                                <?php  $_smarty_tpl->tpl_vars['v'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['v']->_loop = false;
 $_smarty_tpl->tpl_vars['k'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['carLeft3']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
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
                        <?php }?>
                    </ul>
                </div>
            </div>
            <div class="page-content-wrapper">
                
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
                        <span class="caption-subject bold uppercase">维修记录</span>
                    </div>
                    <div class="tools">
                        <div class="table-toolbar">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="btn-group">
                                        <?php if (in_array("/index.php/Admin/Car/addRepairRecord",$_SESSION['allUrls'])){?>
                                        <button id="sample_editable_1_new" class="btn sbold green"
                                                onclick="openAddCar()"> 新增维修记录
                                            <i class="fa fa-plus"></i>
                                        </button>
                                        <?php }?>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="portlet-body">
                    <form action="/index.php/Admin/Car/repairRecordToExcel" method="post" target="_blank">

                    <div class="form-group" style="width: 190px; float: left;">
                        <div class="input-group date form_datetime col-md-5" id="startTimediv" data-date=""
                             data-date-format="yyyy-mm-dd" data-link-field="dtp_input1">
                            <input id="startTime" name="startTime" class="form-control jt" size="16" type="text"
                                   value="" placeholder="开始时间" readonly style="width: 100px">
                            <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                            <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                        </div>
                    </div>
                    <div class="form-group" style="width: 190px; float: left;">
                        <div class="input-group date form_datetime col-md-5" id="endTimediv" data-date=""
                             data-date-format="yyyy-mm-dd" data-link-field="dtp_input1">
                            <input id="endTime" name="endTime" class="form-control jt" size="16" type="text" value=""
                                   placeholder="结束时间" readonly style="width: 100px">
                            <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                            <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                        </div>
                    </div>


                    <div class="form-group" style="width: 140px; float: left; margin-right: 8px;">
                        <select name="car" class="form-control" onchange="fiflt()" id="car">
                            <option value="0">车辆(不限)</option>
                            <?php  $_smarty_tpl->tpl_vars['v'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['v']->_loop = false;
 $_smarty_tpl->tpl_vars['k'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['cars']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['v']->key => $_smarty_tpl->tpl_vars['v']->value){
$_smarty_tpl->tpl_vars['v']->_loop = true;
 $_smarty_tpl->tpl_vars['k']->value = $_smarty_tpl->tpl_vars['v']->key;
?>
                            <option value="<?php echo $_smarty_tpl->tpl_vars['v']->value['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['v']->value['car_num'];?>
</option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="form-group" style="width: 140px; float: left; margin-right: 8px;">
                        <select name="repairsite" class="form-control" onchange="fiflt()" id="repairsite">
                            <option value="0">维修地点(不限)</option>
                            <?php  $_smarty_tpl->tpl_vars['v'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['v']->_loop = false;
 $_smarty_tpl->tpl_vars['k'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['shops']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['v']->key => $_smarty_tpl->tpl_vars['v']->value){
$_smarty_tpl->tpl_vars['v']->_loop = true;
 $_smarty_tpl->tpl_vars['k']->value = $_smarty_tpl->tpl_vars['v']->key;
?>
                            <option value="<?php echo $_smarty_tpl->tpl_vars['v']->value['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['v']->value['shop_name'];?>
</option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="form-group" style="width: 140px; float: left; margin-right: 8px;">
                        <select name="repairshop" class="form-control" onchange="fiflt()" id="repairshop">
                            <option value="0">维修类型(不限)</option>
                            <?php  $_smarty_tpl->tpl_vars['v'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['v']->_loop = false;
 $_smarty_tpl->tpl_vars['k'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['type']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['v']->key => $_smarty_tpl->tpl_vars['v']->value){
$_smarty_tpl->tpl_vars['v']->_loop = true;
 $_smarty_tpl->tpl_vars['k']->value = $_smarty_tpl->tpl_vars['v']->key;
?>
                            <option value="<?php echo $_smarty_tpl->tpl_vars['v']->value['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['v']->value['repair_type_name'];?>
</option>
                            <?php } ?>
                        </select>
                    </div>

                    <button id="btn_add"  type="submit" class="btn btn-default">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>导出结果
                    </button>
                    </form>
                </div>
                <div class="portlet-body">

                    <table class="table table-striped table-bordered table-hover dt-responsive" width="100%"
                           id="allCars">
                        <thead>
                        <tr>
                            <th class="all">车牌号</th>
                            <th class="all">维修地点</th>
                            <th class="all">维修类型</th>
                            <th class="all">维修原因</th>
                            <th class="all">花费</th>
                            <th class="all">进厂时间</th>
                            <th class="all">出厂时间</th>
                            <th class="all">更新时间</th>
                            <th class="all">操作</th>
                        </tr>
                        <tr><th class="all" colspan="9" style="text-align: center; color: red">总费用：<span id="total_cost">0.00</span></th></tr>

                        </thead>
                        <tbody>


                        </tbody>
                    </table>
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
/assets/global/plugins/bootstrap/js/bootstrap.min.js"
        type="text/javascript"></script>
<script src="<?php echo @PUBLIC_URL;?>
/assets/global/plugins/js.cookie.min.js" type="text/javascript"></script>
<script src="<?php echo @PUBLIC_URL;?>
/assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js"
        type="text/javascript"></script>
<script src="<?php echo @PUBLIC_URL;?>
/assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
<script src="<?php echo @PUBLIC_URL;?>
/assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js"
        type="text/javascript"></script>
<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="<?php echo @PUBLIC_URL;?>
/assets/global/plugins/moment.min.js" type="text/javascript"></script>
<script src="<?php echo @PUBLIC_URL;?>
/assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.js"
        type="text/javascript"></script>
<script src="<?php echo @PUBLIC_URL;?>
/assets/global/plugins/morris/morris.min.js" type="text/javascript"></script>
<script src="<?php echo @PUBLIC_URL;?>
/assets/global/plugins/morris/raphael-min.js" type="text/javascript"></script>
<script src="<?php echo @PUBLIC_URL;?>
/assets/global/plugins/counterup/jquery.waypoints.min.js"
        type="text/javascript"></script>
<script src="<?php echo @PUBLIC_URL;?>
/assets/global/plugins/counterup/jquery.counterup.min.js"
        type="text/javascript"></script>
<script src="<?php echo @PUBLIC_URL;?>
/assets/global/plugins/amcharts/amcharts/amcharts.js"
        type="text/javascript"></script>
<script src="<?php echo @PUBLIC_URL;?>
/assets/global/plugins/amcharts/amcharts/serial.js"
        type="text/javascript"></script>
<script src="<?php echo @PUBLIC_URL;?>
/assets/global/plugins/amcharts/amcharts/pie.js" type="text/javascript"></script>
<script src="<?php echo @PUBLIC_URL;?>
/assets/global/plugins/amcharts/amcharts/radar.js"
        type="text/javascript"></script>
<script src="<?php echo @PUBLIC_URL;?>
/assets/global/plugins/amcharts/amcharts/themes/light.js"
        type="text/javascript"></script>
<script src="<?php echo @PUBLIC_URL;?>
/assets/global/plugins/amcharts/amcharts/themes/patterns.js"
        type="text/javascript"></script>
<script src="<?php echo @PUBLIC_URL;?>
/assets/global/plugins/amcharts/amcharts/themes/chalk.js"
        type="text/javascript"></script>
<script src="<?php echo @PUBLIC_URL;?>
/assets/global/plugins/amcharts/ammap/ammap.js" type="text/javascript"></script>
<script src="<?php echo @PUBLIC_URL;?>
/assets/global/plugins/amcharts/ammap/maps/js/worldLow.js"
        type="text/javascript"></script>
<script src="<?php echo @PUBLIC_URL;?>
/assets/global/plugins/amcharts/amstockcharts/amstock.js"
        type="text/javascript"></script>
<script src="<?php echo @PUBLIC_URL;?>
/assets/global/plugins/fullcalendar/fullcalendar.min.js"
        type="text/javascript"></script>
<script src="<?php echo @PUBLIC_URL;?>
/assets/global/plugins/horizontal-timeline/horizontal-timeline.js"
        type="text/javascript"></script>
<script src="<?php echo @PUBLIC_URL;?>
/assets/global/plugins/flot/jquery.flot.min.js" type="text/javascript"></script>
<script src="<?php echo @PUBLIC_URL;?>
/assets/global/plugins/flot/jquery.flot.resize.min.js"
        type="text/javascript"></script>
<script src="<?php echo @PUBLIC_URL;?>
/assets/global/plugins/flot/jquery.flot.categories.min.js"
        type="text/javascript"></script>
<script src="<?php echo @PUBLIC_URL;?>
/assets/global/plugins/jquery-easypiechart/jquery.easypiechart.min.js"
        type="text/javascript"></script>
<script src="<?php echo @PUBLIC_URL;?>
/assets/global/plugins/jquery.sparkline.min.js" type="text/javascript"></script>
<script src="<?php echo @PUBLIC_URL;?>
/assets/global/plugins/jqvmap/jqvmap/jquery.vmap.js"
        type="text/javascript"></script>
<script src="<?php echo @PUBLIC_URL;?>
/assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.russia.js"
        type="text/javascript"></script>
<script src="<?php echo @PUBLIC_URL;?>
/assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.world.js"
        type="text/javascript"></script>
<script src="<?php echo @PUBLIC_URL;?>
/assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.europe.js"
        type="text/javascript"></script>
<script src="<?php echo @PUBLIC_URL;?>
/assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.germany.js"
        type="text/javascript"></script>
<script src="<?php echo @PUBLIC_URL;?>
/assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.usa.js"
        type="text/javascript"></script>
<script src="<?php echo @PUBLIC_URL;?>
/assets/global/plugins/jqvmap/jqvmap/data/jquery.vmap.sampledata.js"
        type="text/javascript"></script>
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
/assets/layouts/global/scripts/quick-sidebar.min.js"
        type="text/javascript"></script>
<script src="<?php echo @PUBLIC_URL;?>
/assets/layouts/global/scripts/quick-nav.min.js" type="text/javascript"></script>
<!-- END THEME LAYOUT SCRIPTS -->

<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="<?php echo @PUBLIC_URL;?>
/assets/global/scripts/datatable.js" type="text/javascript"></script>
<script src="<?php echo @PUBLIC_URL;?>
/assets/global/plugins/datatables/language.js" type="text/javascript"></script>
<script src="<?php echo @PUBLIC_URL;?>
/assets/global/plugins/datatables/datatables.min.js"
        type="text/javascript"></script>
<script src="<?php echo @PUBLIC_URL;?>
/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js"
        type="text/javascript"></script>
<script src="<?php echo @PUBLIC_URL;?>
/assets/global/plugins/template.js" type="text/javascript"></script>
<script src="<?php echo @PUBLIC_URL;?>
/assets/global/plugins/bootstrap-sweetalert/sweetalert.min.js"
        type="text/javascript"></script>
<script src="<?php echo @PUBLIC_URL;?>
/assets/global/plugins/bootbox/bootbox.min.js" type="text/javascript"></script>

<script src="<?php echo @PUBLIC_URL;?>
/plugin/layer/layer.js" type="text/javascript"></script>
<script src="<?php echo @PUBLIC_URL;?>
/plugin/layer/layer.js" type="text/javascript"></script>

<script src="<?php echo @PUBLIC_URL;?>
/assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.js"
        type="text/javascript"></script>
<script src="<?php echo @PUBLIC_URL;?>
/assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"
        type="text/javascript"></script>
<script src="<?php echo @PUBLIC_URL;?>
/assets/global/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js"
        type="text/javascript"></script>

<script src="<?php echo @PUBLIC_URL;?>
/assets/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js"
        type="text/javascript"></script>
<script src="<?php echo @PUBLIC_URL;?>
/assets/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.zh-CN.js"
        type="text/javascript"></script>
<!-- END PAGE LEVEL SCRIPTS -->


<script>
    var TableDatatablesResponsive = function () {
        //待审核出行表格
        var initTableAllCars = function () {
            var table = $('#allCars');
            var oTable = table.dataTable({
                "searching": true,//禁用分页
                "lengthChange": false,//禁止改变分页大小
                "info": true,//左下角信息禁用
                "paging": true,//禁用分页
                "processing": true,//显示加载进度条
                "serverSide": true,//开启服务器端处理数据，分页，获取数据等等
                "ajax":function (data, callback, settings) {
                    //获取开始时间
                    var startTime=$("#startTime").val();
                    data.startTime=startTime;
                    //获取结束时间
                    var endTime=$("#endTime").val();
                    data.endTime=endTime;

                    //获取选择的车辆
                    var car=$("#car").val();
                    data.car=car;
                    //获取选择维修地点
                    var repairsite=$("#repairsite").val();
                    data.repairsite=repairsite;

                    //获取选定的维修类型
                    var repairshop=$("#repairshop").val();
                    data.repairshop=repairshop;
                    /*
                    var card_num=$("#card_num").val();
                    data.card_num=card_num;

                    var serial_number=$("#serial_number").val();
                    data.serial_number=serial_number;
                    */
                    $.ajax({
                        "url":"getRepairRecord",
                        "type": "POST",
                        "data":data,
                        "success": function (resp) {
                            var total_cost = resp.total_cost > 0 ? resp.total_cost : '0.00';
                            $("#total_cost").html(total_cost);
                            callback(resp);
                        }
                    })
                },
                "columns": [
                    { "data": "car_num","defaultContent": "<i>暂无</i>" },
                    { "data": "shop_name","defaultContent": "<i>暂无</i>" },
                    { "data": "repairTypeName","defaultContent": "<i>暂无</i>" },
                    { "data": "reason","defaultContent": "<i>暂无</i>" },
                    { "data": "cost","defaultContent": "<i>暂无</i>" },

                    { "data": "start_time","defaultContent": "<i>暂无</i>","render":function (data,type,full,meta) {
                            if(data!=""&&data!=null){
                                return new Date(data*1000).format("yyyy-MM-dd");
                            }
                        } },
                    { "data": "end_time","defaultContent": "<i>暂无</i>","render":function (data,type,full,meta) {
                            if(data!=""&&data!=null){
                                return new Date(data*1000).format("yyyy-MM-dd");
                            }
                        } },
                    { "data": "utime","defaultContent": "<i>暂无</i>","render":function (data,type,full,meta) {
                            if(data!=""&&data!=null){
                                return new Date(data*1000).format("yyyy-MM-dd");
                            }
                        } },
                    { "data": "id","defaultContent": "<i>暂无</i>","orderable":false ,"render":function (data,type,full,meta) {
                            var html = template(document.getElementById('carTools').innerHTML, full);
                            return html;
                        }}
                ],
                "columnDefs": [
                ],
                buttons: [],
                "language": language,
                "order": [
                    [1, 'asc']
                ],
                "lengthMenu": [
                    [5, 10, 15, 20, -1],
                    [5, 10, 15, 20, "All"] // change per page values here
                ],
                "pageLength": 10,
                "dom": "<'row' <'col-md-12'B>><'row'<'table-scrollable't><'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>", // horizobtal scrollable datatable
                "initComplete":function (settings, json) {

                }
            });
        }


        return {
            init: function () {
                if (!jQuery().dataTable) {
                    return;
                }
                initTableAllCars();
            }
        };
    }();


    function openAddCar(){
        layer.open({
            type: 2,
            title:"新增维修记录",
            area: ['1000px', '450px'],
            fixed: false, //不固定
            maxmin: true,
            content: '/index.php/Admin/Car/addRepairRecord'
        });
    }



    jQuery(document).ready(function() {
        TableDatatablesResponsive.init();//待审核出行表格初始化
        //SweetAlert.init();

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
            fiflt();
        });


        $('#allCars tbody').on('click', 'td.details-control', function () {
            var tr = $(this).closest('tr');
            var row = table.row( tr );
            if ( row.child.isShown() ) {
                // This row is already open - close it
                row.child.hide();
                tr.removeClass('shown');
            }
            else {
                // Open this row
                row.child( format(row.data()) ).show();
                tr.addClass('shown');
            }
        });


        //注册查看点击事件
        $('tbody').on( 'click', 'td .viewCar', function () {
            var id=$(this).attr("data-id");
            //加载模态框，直接模态框操作
            layer.open({
                type: 2,
                title:"查看车辆",
                area: ['1000px', '700px'],
                fixed: false, //不固定
                maxmin: true,
                content: '/index.php/Admin/Car/editCar/id/'+id
            });
        })

        //修改维修记录
        $('tbody').on( 'click', 'td .editRepairRecord', function () {
            var id=$(this).attr("data-id");
            //加载模态框，直接模态框操作
            layer.open({
                type: 2,
                title:"修改维修记录",
                area: ['1000px', '450px'],
                fixed: false, //不固定
                maxmin: true,
                content: '/index.php/Admin/Car/addRepairRecord/id/'+id
            });
        });


        //注册删除车辆事件
        $('#allCars tbody').on( 'click', 'td .delCar', function () {
            //alert($(this).attr("data-id"));
            var carId=$(this).attr("data-id");

            swal({
                    title: "确定删除此记录吗？",
                    text: "",
                    type: "info",
                    //allowOutsideClick: sa_allowOutsideClick,
                    showConfirmButton: true,
                    showCancelButton: true,
                    confirmButtonClass: "btn-success",
                    cancelButtonClass: "btn-default",
                    closeOnConfirm: true,
                    closeOnCancel: true,
                    confirmButtonText: "确定",
                    cancelButtonText: "取消",
                },
                function(isConfirm){
                    if (isConfirm){
                        //此处进行审核操作AJAX
                        $.post("/index.php/Admin/Car/delRepairRecord.html",
                            {
                                id:carId
                            },
                            function(data){
                                if(data.code==1){
                                    swal("操作成功", "", "success");
                                    document.location.reload();
                                }else{
                                    swal(data.error, "", "error");
                                }
                            },
                            'json'
                        );
                    }else {
                        swal("取消操作", "", "error");
                    }
                });
        })




    });







</script>

<!--审核出行操作tools-->
<script id="carTools" type="text/html">
    <div class="btn-group pull-right">
        <button class="btn green btn-xs btn-outline dropdown-toggle" data-toggle="dropdown">操作
            <i class="fa fa-angle-down"></i>
        </button>
        <ul class="dropdown-menu pull-right">
            <?php if (in_array("/index.php/Admin/Car/editRepairRecord",$_SESSION['allUrls'])){?>
            <li>
                <a href="javascript:;" class="editRepairRecord" data-id="<<?php ?>%=id%<?php ?>>"><i class="fa fa-print"></i> 查看 / 修改 </a>
            </li>
            <?php }?>
            <?php if (in_array("/index.php/Admin/Car/delRepairRecord",$_SESSION['allUrls'])){?>
            <li>
                <a href="javascript:;" class="delCar" data-id="<<?php ?>%=id%<?php ?>>"><i class="fa fa-file-pdf-o"></i> 删除记录 </a>
            </li>
            <?php }?>
        </ul>
    </div>


</script>

<script>
    function fiflt() {
        var dttable = $('#allCars').dataTable();
        dttable.fnClearTable(); //清空一下table
    }
</script>

<?php }} ?>