<?php /* Smarty version Smarty-3.1.6, created on 2018-08-09 11:24:49
         compiled from "E:/PhpStorm/yxcar/Home/View\Travel\signTravel.html" */ ?>
<?php /*%%SmartyHeaderCode:287345b6bb401093a34-12090240%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b3f7e096017cb0935ea9f1efa03bd032937f57f7' => 
    array (
      0 => 'E:/PhpStorm/yxcar/Home/View\\Travel\\signTravel.html',
      1 => 1531364282,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '287345b6bb401093a34-12090240',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'users' => 0,
    'v' => 0,
    'user' => 0,
    'travel_nature' => 0,
    'travel_type' => 0,
    'have_dx' => 0,
    'set' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.6',
  'unifunc' => 'content_5b6bb401353a8',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5b6bb401353a8')) {function content_5b6bb401353a8($_smarty_tpl) {?><!DOCTYPE html>

<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<!-- BEGIN HEAD -->

<head>
    <meta charset="utf-8" />
    <title>提交申请</title>
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


    <link href="<?php echo @PUBLIC_URL;?>
/assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo @PUBLIC_URL;?>
/assets/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo @PUBLIC_URL;?>
/assets/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo @PUBLIC_URL;?>
/assets/global/plugins/bootstrap-toastr/toastr.min.css" rel="stylesheet" type="text/css" />

    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <link href="<?php echo @PUBLIC_URL;?>
/assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo @PUBLIC_URL;?>
/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />
    <!-- END PAGE LEVEL PLUGINS -->

    <!-- END PAGE LEVEL PLUGINS -->
    <!-- BEGIN THEME GLOBAL STYLES -->
    <link href="<?php echo @PUBLIC_URL;?>
/assets/global/css/components.css" rel="stylesheet" id="style_components" type="text/css" />
    <link href="<?php echo @PUBLIC_URL;?>
/assets/global/css/plugins.min.css" rel="stylesheet" type="text/css" />
    <!-- END THEME GLOBAL STYLES -->
    <!-- BEGIN THEME LAYOUT STYLES -->
    <link href="<?php echo @PUBLIC_URL;?>
/assets/layouts/layout/css/layout.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo @PUBLIC_URL;?>
/assets/layouts/layout/css/themes/darkblue.min.css" rel="stylesheet" type="text/css" id="style_color" />
    <link href="<?php echo @PUBLIC_URL;?>
/assets/layouts/layout/css/custom.min.css" rel="stylesheet" type="text/css" />
    <!-- END THEME LAYOUT STYLES -->
    <link rel="shortcut icon" href="favicon.ico" /> </head>

    <link rel="stylesheet" href="<?php echo @PUBLIC_URL;?>
css/bootstrap-multiselect.css" type="text/css"/>

<style type="text/css">
    #search {
        text-align: center;
        position: relative;
    }

    #search2 {
        text-align: center;
        position: relative;
    }

    .autocomplete {
        border: 1px solid #9ACCFB;
        background-color: white;
        text-align: left;
        z-index: 999;
    }

    .autocomplete li {
        list-style-type: none;
    }

    .clickable {
        cursor: default;
    }

    .highlight {
        background-color: #9ACCFB;
    }
</style>
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
                            <span class="title">出行管理</span>
                            <span class="selected"></span>
                            <span class="arrow open"></span>
                        </a>
                        <ul class="sub-menu">

                            <li class="nav-item start  active open">
                                <a href="/index.php/Home/Travel/signTravel" class="nav-link ">
                                    <i class="icon-bulb"></i>
                                    <span class="title">申请出行</span>
                                    <!--<span class="badge badge-success">1</span>-->
                                </a>
                            </li>



                            <li class="nav-item start ">
                                <a href="/index.php/Home/Travel/myTravels" class="nav-link ">
                                    <i class="icon-graph"></i>
                                    <span class="title">我的出行</span>
                                    <!--<span class="badge badge-danger">5</span>-->
                                </a>
                            </li>

                            <li class="nav-item start">
                                <a href="/index.php/Home/Travel/signSupplement" class="nav-link ">
                                    <i class="icon-bulb"></i>
                                    <span class="title">补单录入</span>
                                    <!--<span class="badge badge-success">1</span>-->
                                </a>
                            </li>

                            <li class="nav-item start ">
                                <a href="/index.php/Home/Travel/mySupplement" class="nav-link ">
                                    <i class="icon-graph"></i>
                                    <span class="title">补单记录</span>
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
                <div class="page-bar">
                    <ul class="page-breadcrumb">
                        <li>
                            <a href="">出行管理</a>
                            <i class="fa fa-circle"></i>
                        </li>
                        <li>
                            <span>申请出行</span>
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
                                <form class="form-horizontal" role="form" action="/index.php/Home/Travel/signTravelDo" method="post" id="addCarForm">

                                    <div class="form-body">
                                        <div class="form-group col-md-6">
                                            <label class="col-md-2 control-label">用车人</label>
                                            <div class="col-md-10">
                                                <select class="form-control input-inline input-medium" name="use_user_id" id="use_user_id">
                                                    <?php  $_smarty_tpl->tpl_vars['v'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['v']->_loop = false;
 $_smarty_tpl->tpl_vars['k'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['users']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['v']->key => $_smarty_tpl->tpl_vars['v']->value){
$_smarty_tpl->tpl_vars['v']->_loop = true;
 $_smarty_tpl->tpl_vars['k']->value = $_smarty_tpl->tpl_vars['v']->key;
?>
                                                    <option value="<?php echo $_smarty_tpl->tpl_vars['v']->value['id'];?>
" <?php if ($_smarty_tpl->tpl_vars['v']->value['id']==$_smarty_tpl->tpl_vars['user']->value['id']){?>selected="selected"<?php }?>><?php echo $_smarty_tpl->tpl_vars['v']->value['user_name'];?>
</option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label class="col-md-2 control-label">出行人数</label>
                                            <div class="col-md-10">
                                                <input type="text" class="form-control input-inline input-medium" placeholder="出行人数" name="people_num" id="people_num" >
                                            </div>
                                        </div>





                                        <div class="form-group col-md-6">
                                            <label class="col-md-2 control-label">出发地</label>
                                            <div class="col-md-10">
                                                <div data-toggle="distpicker" id="distpickerFrom" style="float:left;">
                                                    <select  class="form-control  input-inline " style="width: auto; display: inline-block; width: 85px; padding: 6px 4px;"></select>
                                                    <select id="cityFrom"  class="form-control  input-inline " style="width: auto; display: inline-block;width: 85px;padding: 6px 4px;"></select>
                                                </div>
                                                <div id="search" style="float:left;height: 34px;">
                                                    <input type="hidden" id="from_place_lat" name="from_place_lat"/>
                                                    <input type="hidden" id="from_place_lng" name="from_place_lng"/>
                                                    <input type="text" class="form-control  input-inline " id="search-text" name="search-text" />
                                                </div>
                                            </div>
                                        </div>


                                        <div class="form-group col-md-6">
                                            <label class="col-md-2 control-label">目的地</label>
                                            <div class="col-md-10">
                                                <div data-toggle="distpicker" id="distpickerTo" style="float:left;">
                                                    <select class="form-control input-inline" style="width: auto; display: inline-block; width: 85px;padding: 6px 4px;"></select>
                                                    <select id="cityTo" class="form-control input-inline" style="width: auto; display: inline-block; width: 85px;padding: 6px 4px;"></select>
                                                </div>
                                                <div id="search2" style="float:left;height: 34px;">
                                                    <input type="hidden" id="from_place_lat2" name="from_place_lat2"/>
                                                    <input type="hidden" id="from_place_lng2" name="from_place_lng2"/>
                                                    <input type="text" class="form-control input-inline" id="search-text2" name="search-text2" />
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label class="col-md-2 control-label">途径路线</label>
                                            <div class="col-md-10">
                                                <input type="text" class="form-control input-inline input-medium" placeholder="途径路线" name="route" id="route" >
                                            </div>
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label class="col-md-2 control-label">出行备注</label>
                                            <div class="col-md-10">
                                                <input type="text" class="form-control input-inline input-medium" placeholder="出行备注" name="travel_reason" id="travel_reason" >
                                            </div>
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label class="col-md-2 control-label">出发时间</label>
                                            <div class="col-md-10">
                                                <div class="input-group date form_datetime input-medium" data-date="" data-date-format="yyyy-mm-dd hh:ii" data-link-field="departure_time">
                                                    <input name="departure_time" id="departure_time" class="form-control" size="16" type="text" value="" readonly>
                                                    <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                                                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label class="col-md-2 control-label">预计收车时间</label>
                                            <div class="col-md-10">
                                                <div class="input-group date form_datetime input-medium" data-date="" data-date-format="yyyy-mm-dd hh:ii" data-link-field="collecting_time">
                                                    <input name="collecting_time" id="collecting_time" class="form-control" size="16" type="text" value="" readonly>
                                                    <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                                                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label class="col-md-2 control-label">出行性质</label>
                                            <div class="col-md-10">
                                                <select class="form-control input-inline input-medium" name="travel_nature" id="travel_nature">
                                                    <?php  $_smarty_tpl->tpl_vars['v'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['v']->_loop = false;
 $_smarty_tpl->tpl_vars['k'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['travel_nature']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['v']->key => $_smarty_tpl->tpl_vars['v']->value){
$_smarty_tpl->tpl_vars['v']->_loop = true;
 $_smarty_tpl->tpl_vars['k']->value = $_smarty_tpl->tpl_vars['v']->key;
?>
                                                    <option value="<?php echo $_smarty_tpl->tpl_vars['v']->value['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['v']->value['nature_name'];?>
</option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>


                                        <div class="form-group col-md-6">
                                            <label class="col-md-2 control-label">出行方式</label>
                                            <div class="col-md-10">
                                                <select class="form-control input-inline input-medium" name="travel_type_id" id="travel_type_id">
                                                    <?php  $_smarty_tpl->tpl_vars['v'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['v']->_loop = false;
 $_smarty_tpl->tpl_vars['k'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['travel_type']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['v']->key => $_smarty_tpl->tpl_vars['v']->value){
$_smarty_tpl->tpl_vars['v']->_loop = true;
 $_smarty_tpl->tpl_vars['k']->value = $_smarty_tpl->tpl_vars['v']->key;
?>
                                                    <option value="<?php echo $_smarty_tpl->tpl_vars['v']->value['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['v']->value['travel_name'];?>
</option>
                                                    <?php } ?>

                                                </select>
                                            </div>
                                        </div>


                                        <div class="form-group col-md-6">
                                            <label class="col-md-2 control-label">出行人员</label>
                                            <div class="col-md-10">
                                                <input type="hidden" name="travel_people"  id="travel_people" class="form-control" >
                                                <select class="form-control input-inline input-medium" name="travel_people1[]" multiple="multiple" id="select_user">
                                                    <?php  $_smarty_tpl->tpl_vars['v'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['v']->_loop = false;
 $_smarty_tpl->tpl_vars['k'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['users']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['v']->key => $_smarty_tpl->tpl_vars['v']->value){
$_smarty_tpl->tpl_vars['v']->_loop = true;
 $_smarty_tpl->tpl_vars['k']->value = $_smarty_tpl->tpl_vars['v']->key;
?>
                                                    <option value="<?php echo $_smarty_tpl->tpl_vars['v']->value['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['v']->value['user_name'];?>
</option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <?php if ($_smarty_tpl->tpl_vars['have_dx']->value==1){?>
                                        <div class="form-group col-md-6">
                                            <label class="col-md-2 control-label">定向车辆</label>
                                            <div class="col-md-10">
                                                <select class="form-control input-inline input-medium" name="is_dx" id="is_dx">
                                                    <option value="0">使用非定向车</option>
                                                    <option value="1">使用定向车</option>
                                                </select>
                                            </div>
                                        </div>
                                        <?php }?>

                                    </div>

                                    <div class="form-actions col-md-12">
                                        <div class="row">
                                            <div class="col-md-offset-5 col-md-7">
                                                <button type="submit" class="btn green" >确认出行</button>
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



<script type="text/javascript" src="<?php echo @PUBLIC_URL;?>
js/bootstrap-multiselect.js"></script>


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


<!-- END PAGE LEVEL SCRIPTS -->




<script type="text/javascript">

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



    $(document).ready(function() {
        $('#select_user').multiselect({
            includeSelectAllOption: true,
            enableFiltering: true
        });

    });

    function view(){
        // //判断是否选择了出行人员
        var travelPepole=$(".multiselect").attr("title");
        if(travelPepole=="未选择"){
            toastr.warning('请选择出行人员！');
            return;
        }else{
            //获取出行人数
            //$("#people_num").val(travelPepole.split(",").length);
        }

        //判断是否选择了出发时间
        var departure_time=$("#departure_time").val();
        if(departure_time=="" || departure_time==null || typeof("departure_time")=="undefined"){
            toastr.warning('请选择出发时间！');
            return;
        }

        //判断是否正确选择了出发地点
        if(isE($("#from_place_lat").val())||isE($("#from_place_lng").val())){
            toastr.warning('请选择提示框内的出发地点！');
            return;
        }

        //判断是否正确选择了目的地点
        if(isE($("#from_place_lat2").val())||isE($("#from_place_lng2").val())){
            toastr.warning('请选择提示框内的目的地点！');
            return;
        }

        var people_num=$("#people_num").val();
        if(isE(people_num)){
            toastr.warning('请输入出行人数');
            return;
        }

        var route=$("#route").val();
        $("#routed_span").html(route);

        //填充数据
        $("#use_user_id_span").html($('#use_user_id option:selected').text());//选中的文本
        $("#travel_type_id_span").html($('#travel_type_id option:selected').text());//选中的文本
        $("#travel_nature_span").html($('#travel_nature option:selected').text());//选中的文本
        $("#route_span").html($('#search-text').val()+"--"+$('#search-text2').val());//选中的文本
        $("#travel_reason_span").html($("#travel_reason").val());
        $("#people_num_span").html(people_num+"人");
        $("#travel_people").val($(".multiselect").attr("title"));
        $("#travel_people_span").html($(".multiselect").attr("title"));

        //打开模态框
        $(function() {
            $('#myModal').modal({
                keyboard: true
            })
        });
    }



</script>



<script>



    $("#addCarForm").submit(function () {

        //校验数据
        //toastr.error('Are you the 6 fingered man?');
        if(isE($("#search-text").val())||isE($("#from_place_lat").val())){ toastr.error('出发地点不得为空！');  $("#search-text").focus();return false; }
        if(isE($("#search-text2").val())||isE($("#from_place_lat2").val())){ toastr.error('目的地点不得为空！');  $("#search-text").focus();return false; }

        if(isE($("#travel_reason").val())){ toastr.error('出行备注不得为空！');  $("#travel_reason").focus();return false; }

        if(isE($("#departure_time").val())){ toastr.error('出发时间不得为空！');  $("#departure_time").focus();return false; }
        if(isE($("#collecting_time").val())){ toastr.error('预计收车时间不得为空！');  $("#collecting_time").focus();return false; }




        if(isE($("#people_num").val())){ toastr.error('出行人数不得为空！');  $("#people_num").focus();return false; }
        if(isNaN($("#people_num").val())){ toastr.error('出行人数只能为数字！');  $("#people_num").focus();return false; }

        var travelPepole=$(".multiselect").attr("title");
        if(travelPepole=="未选择"){
            toastr.error('请选择出行人员！');
            return false;
        }else{
            $("#travel_people").val(travelPepole);
        }


        $(this).ajaxSubmit(function (data) {
            if(data.code==1){
                layer.msg('提交成功!', { icon: 1 });
                //setTimeout("window.parent.location.reload()",2000);

                setTimeout("window.location.href='/index.php/Home/Travel/myTravels'",2500);
            }else{
                layer.msg('提交失败，请重试!', { icon: 0 });
            }
        });
        return false;
    })







</script>


<script>
    var province="<?php echo $_smarty_tpl->tpl_vars['set']->value['province'];?>
";
    var city="<?php echo $_smarty_tpl->tpl_vars['set']->value['city'];?>
";



    if(isE(province)||isE(city)){
        $('#distpicker').distpicker('reset');
    }else{
        $('#distpickerFrom').distpicker({
            province: province,
            city: city
        });
        $('#distpickerTo').distpicker({
            province: province,
            city: city
        });
    }


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
</script>


<script type="text/javascript">
    $(function() {

        var $from_place_lng=$("#from_place_lng")
        var $from_place_lat=$("#from_place_lat")

        //取得div层
        var $search = $('#search');
        //取得输入框JQuery对象
        var $searchInput = $search.find('#search-text');
        //关闭浏览器提供给输入框的自动完成
        $searchInput.attr('autocomplete', 'off');
        //创建自动完成的下拉列表，用于显示服务器返回的数据,插入在搜索按钮的后面，等显示的时候再调整位置
        var $autocomplete = $('<div class="autocomplete"></div>')
            .hide()
            .insertAfter('#search-text');
        //清空下拉列表的内容并且隐藏下拉列表区
        var clear = function() {
            $autocomplete.empty().hide();
        };
        //注册事件，当输入框失去焦点的时候清空下拉列表并隐藏
        $searchInput.blur(function() {
            setTimeout(clear, 500);
        });
        //下拉列表中高亮的项目的索引，当显示下拉列表项的时候，移动鼠标或者键盘的上下键就会移动高亮的项目，想百度搜索那样
        var selectedItem = null;
        //timeout的ID
        var timeoutid = null;
        //设置下拉项的高亮背景
        var setSelectedItem = function(item) {
            //更新索引变量
            selectedItem = item;
            //按上下键是循环显示的，小于0就置成最大的值，大于最大值就置成0
            if(selectedItem < 0) {
                selectedItem = $autocomplete.find('li').length - 1;
            } else if(selectedItem > $autocomplete.find('li').length - 1) {
                selectedItem = 0;
            }
            //首先移除其他列表项的高亮背景，然后再高亮当前索引的背景
            $autocomplete.find('li').removeClass('highlight')
                .eq(selectedItem).addClass('highlight');
        };
        var ajax_request = function() {
            //ajax服务端通信
            //alert('http://api.map.baidu.com/place/v2/search?query='+$searchInput.val()+'&page_size=10&page_num=0&scope=1&region=长沙市&output=json&ak=FG7i3yjVZRFHfB9lBk2Q6izW9tGzocts&mcode=BA:AD:09:3A:82:82:9F:B4:32:A7:B2:8C:B4:CC:F0:E9:F3:7D:AE:58;io.dcloud.H5D19A6FA');
            $.ajax({


                'url': '<?php echo U("Home/Travel/getBaiduApi");?>
', //服务器的地址
                'data': {
                    key:$searchInput.val(),
                    city:$("#cityFrom").val()
                }, //参数
                'dataType': 'json', //返回数据类型
                'type': 'post', //请求类型
                'success': function(data) {

                    data=JSON.parse(data.res);

                    data=eval(data.results);


                    if(data.length) {
                        //遍历data，添加到自动完成区
                        $.each(data,function(index, term) {

                            if(isE(term.location.lng)||isE(term.location.lat)){
                                return true;
                            }



                            //创建li标签,添加到下拉列表中
                            $('<li></li>').text(term.name).appendTo($autocomplete)
                                .attr("lng",term.location.lng)
                                .attr("lat",term.location.lat)
                                .addClass('clickable')
                                .hover(function() {
                                    //下拉列表每一项的事件，鼠标移进去的操作
                                    $(this).siblings().removeClass('highlight');
                                    $(this).addClass('highlight');
                                    selectedItem = index;
                                }, function() {
                                    //下拉列表每一项的事件，鼠标离开的操作
                                    $(this).removeClass('highlight');
                                    //当鼠标离开时索引置-1，当作标记
                                    selectedItem = -1;
                                })
                                .click(function() {
                                    //鼠标单击下拉列表的这一项的话，就将这一项的值添加到输入框中
                                    $searchInput.val(term.name);

                                    $from_place_lng.val(term.location.lng);
                                    $from_place_lat.val(term.location.lat);

                                    //清空并隐藏下拉列表
                                    $autocomplete.empty().hide();
                                });
                        }); //事件注册完毕
                        //设置下拉列表的位置，然后显示下拉列表
                        var ypos = $searchInput.position().top;
                        var xpos = $searchInput.position().left;
                        $autocomplete.css('width', $searchInput.css('width'));
                        $autocomplete.css({
                            'position': 'relative',
                            'left': xpos + "px",
                            'top': ypos + "px"
                        });
                        setSelectedItem(0);
                        //显示下拉列表
                        $autocomplete.show();
                    }
                },
                'error':function (XMLHttpRequest ) {
                }
            });
        };
        //对输入框进行事件注册
        $searchInput
            .keyup(function(event) {
                //字母数字，退格，空格
                if(event.keyCode > 40 || event.keyCode == 8 || event.keyCode == 32) {
                    //首先删除下拉列表中的信息
                    $autocomplete.empty().hide();
                    clearTimeout(timeoutid);
                    timeoutid = setTimeout(ajax_request, 100);
                } else if(event.keyCode == 38) {
                    //上
                    //selectedItem = -1 代表鼠标离开
                    if(selectedItem == -1) {
                        setSelectedItem($autocomplete.find('li').length - 1);
                    } else {
                        //索引减1
                        setSelectedItem(selectedItem - 1);
                    }
                    event.preventDefault();
                } else if(event.keyCode == 40) {
                    //下
                    //selectedItem = -1 代表鼠标离开
                    if(selectedItem == -1) {
                        setSelectedItem(0);
                    } else {
                        //索引加1
                        setSelectedItem(selectedItem + 1);
                    }
                    event.preventDefault();
                }
            })
            .keypress(function(event) {
                //enter键
                if(event.keyCode == 13) {
                    //列表为空或者鼠标离开导致当前没有索引值
                    if($autocomplete.find('li').length == 0 || selectedItem == -1) {
                        return;
                    }
                    $searchInput.val($autocomplete.find('li').eq(selectedItem).text());

                    $from_place_lng.val($autocomplete.find('li').eq(selectedItem).attr('lng'));
                    $from_place_lat.val($autocomplete.find('li').eq(selectedItem).attr('lat'));

                    $autocomplete.empty().hide();
                    event.preventDefault();
                }
            })
            .keydown(function(event) {
                //esc键
                if(event.keyCode == 27) {
                    $autocomplete.empty().hide();
                    event.preventDefault();
                }
            });
        //注册窗口大小改变的事件，重新调整下拉列表的位置
        $(window).resize(function() {
            var ypos = $searchInput.position().top;
            var xpos = $searchInput.position().left;
            $autocomplete.css('width', $searchInput.css('width'));
            $autocomplete.css({
                'position': 'relative',
                'left': xpos + "px",
                'top': ypos + "px"
            });
        });
    });

    $(function() {

        var $from_place_lng=$("#from_place_lng2")
        var $from_place_lat=$("#from_place_lat2")

        //取得div层
        var $search = $('#search2');
        //取得输入框JQuery对象
        var $searchInput = $search.find('#search-text2');
        //关闭浏览器提供给输入框的自动完成
        $searchInput.attr('autocomplete', 'off');
        //创建自动完成的下拉列表，用于显示服务器返回的数据,插入在搜索按钮的后面，等显示的时候再调整位置
        var $autocomplete = $('<div class="autocomplete"></div>')
            .hide()
            .insertAfter('#search-text2');
        //清空下拉列表的内容并且隐藏下拉列表区
        var clear = function() {
            $autocomplete.empty().hide();
        };
        //注册事件，当输入框失去焦点的时候清空下拉列表并隐藏
        $searchInput.blur(function() {
            setTimeout(clear, 500);
        });
        //下拉列表中高亮的项目的索引，当显示下拉列表项的时候，移动鼠标或者键盘的上下键就会移动高亮的项目，想百度搜索那样
        var selectedItem = null;
        //timeout的ID
        var timeoutid = null;
        //设置下拉项的高亮背景
        var setSelectedItem = function(item) {
            //更新索引变量
            selectedItem = item;
            //按上下键是循环显示的，小于0就置成最大的值，大于最大值就置成0
            if(selectedItem < 0) {
                selectedItem = $autocomplete.find('li').length - 1;
            } else if(selectedItem > $autocomplete.find('li').length - 1) {
                selectedItem = 0;
            }
            //首先移除其他列表项的高亮背景，然后再高亮当前索引的背景
            $autocomplete.find('li').removeClass('highlight')
                .eq(selectedItem).addClass('highlight');
        };
        var ajax_request = function() {
            //ajax服务端通信
            //alert('http://api.map.baidu.com/place/v2/search?query='+$searchInput.val()+'&page_size=10&page_num=0&scope=1&region=长沙市&output=json&ak=FG7i3yjVZRFHfB9lBk2Q6izW9tGzocts&mcode=BA:AD:09:3A:82:82:9F:B4:32:A7:B2:8C:B4:CC:F0:E9:F3:7D:AE:58;io.dcloud.H5D19A6FA');
            $.ajax({


                'url': '<?php echo U("Home/Travel/getBaiduApi");?>
', //服务器的地址
                'data': {
                    key:$searchInput.val(),
                    city:$("#cityTo").val()
                }, //参数
                'dataType': 'json', //返回数据类型
                'type': 'post', //请求类型
                'success': function(data) {

                    data=JSON.parse(data.res);

                    data=eval(data.results);


                    if(data.length) {
                        //遍历data，添加到自动完成区
                        $.each(data,function(index, term) {

                            if(isE(term.location.lng)||isE(term.location.lat)){
                                return true;
                            }

                            //创建li标签,添加到下拉列表中
                            $('<li></li>').text(term.name).appendTo($autocomplete)
                                .attr("lng",term.location.lng)
                                .attr("lat",term.location.lat)
                                .addClass('clickable')
                                .hover(function() {
                                    //下拉列表每一项的事件，鼠标移进去的操作
                                    $(this).siblings().removeClass('highlight');
                                    $(this).addClass('highlight');
                                    selectedItem = index;
                                }, function() {
                                    //下拉列表每一项的事件，鼠标离开的操作
                                    $(this).removeClass('highlight');
                                    //当鼠标离开时索引置-1，当作标记
                                    selectedItem = -1;
                                })
                                .click(function() {
                                    //鼠标单击下拉列表的这一项的话，就将这一项的值添加到输入框中
                                    $searchInput.val(term.name);

                                    $from_place_lng.val(term.location.lng);
                                    $from_place_lat.val(term.location.lat);

                                    //清空并隐藏下拉列表
                                    $autocomplete.empty().hide();
                                });
                        }); //事件注册完毕
                        //设置下拉列表的位置，然后显示下拉列表
                        var ypos = $searchInput.position().top;
                        var xpos = $searchInput.position().left;
                        $autocomplete.css('width', $searchInput.css('width'));
                        $autocomplete.css({
                            'position': 'relative',
                            'left': xpos + "px",
                            'top': ypos + "px"
                        });
                        setSelectedItem(0);
                        //显示下拉列表
                        $autocomplete.show();
                    }
                },
                'error':function (XMLHttpRequest ) {

                }
            });
        };
        //对输入框进行事件注册
        $searchInput
            .keyup(function(event) {
                //字母数字，退格，空格
                if(event.keyCode > 40 || event.keyCode == 8 || event.keyCode == 32) {
                    //首先删除下拉列表中的信息
                    $autocomplete.empty().hide();
                    clearTimeout(timeoutid);
                    timeoutid = setTimeout(ajax_request, 100);
                } else if(event.keyCode == 38) {
                    //上
                    //selectedItem = -1 代表鼠标离开
                    if(selectedItem == -1) {
                        setSelectedItem($autocomplete.find('li').length - 1);
                    } else {
                        //索引减1
                        setSelectedItem(selectedItem - 1);
                    }
                    event.preventDefault();
                } else if(event.keyCode == 40) {
                    //下
                    //selectedItem = -1 代表鼠标离开
                    if(selectedItem == -1) {
                        setSelectedItem(0);
                    } else {
                        //索引加1
                        setSelectedItem(selectedItem + 1);
                    }
                    event.preventDefault();
                }
            })
            .keypress(function(event) {
                //enter键
                if(event.keyCode == 13) {
                    //列表为空或者鼠标离开导致当前没有索引值
                    if($autocomplete.find('li').length == 0 || selectedItem == -1) {
                        return;
                    }
                    $searchInput.val($autocomplete.find('li').eq(selectedItem).text());

                    $from_place_lng.val($autocomplete.find('li').eq(selectedItem).attr('lng'));
                    $from_place_lat.val($autocomplete.find('li').eq(selectedItem).attr('lat'));

                    $autocomplete.empty().hide();
                    event.preventDefault();
                }
            })
            .keydown(function(event) {
                //esc键
                if(event.keyCode == 27) {
                    $autocomplete.empty().hide();
                    event.preventDefault();
                }
            });
        //注册窗口大小改变的事件，重新调整下拉列表的位置
        $(window).resize(function() {
            var ypos = $searchInput.position().top;
            var xpos = $searchInput.position().left;
            $autocomplete.css('width', $searchInput.css('width'));
            $autocomplete.css({
                'position': 'relative',
                'left': xpos + "px",
                'top': ypos + "px"
            });
        });
    });
</script>

</body>

</html><?php }} ?>