<?php /* Smarty version Smarty-3.1.6, created on 2019-01-03 19:45:10
         compiled from "D:/xampp/htdocs/Admin/View\Travel\allTravels.html" */ ?>
<?php /*%%SmartyHeaderCode:84325bbf1397346c16-48027848%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '1fee7138323c74a8997d76ea4a7bd39de01dfcf0' => 
    array (
      0 => 'D:/xampp/htdocs/Admin/View\\Travel\\allTravels.html',
      1 => 1546410676,
      2 => 'file',
    ),
    'ec928fa5972c2602dbaa58051df54e06b7af945e' => 
    array (
      0 => 'D:\\xampp\\htdocs\\Admin\\View\\Travel\\template.html',
      1 => 1545988584,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '84325bbf1397346c16-48027848',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.6',
  'unifunc' => 'content_5bbf1397ed3f4',
  'variables' => 
  array (
    'travelLeft' => 0,
    'v' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5bbf1397ed3f4')) {function content_5bbf1397ed3f4($_smarty_tpl) {?><!DOCTYPE html>
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

    <style>

        .autocomplete {
            border: 1px solid #9ACCFB;
            background-color: white;
            text-align: left;
        }

        .autocomplete li {
            list-style-type: none;
        }

        .autocomplete .highlight {
            background-color: #9ACCFB;
        }

        .autocomplete .clickable {
            cursor: default;
        }
    </style>
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
                        <span class="caption-subject bold uppercase">全部出行</span>
                    </div>
                    <div class="tools"></div>
                </div>
                <div class="portlet-body">
                    <form action="/index.php/Admin/Travel/toExcel" method="post" target="_blank">
                        <div class="form-group" style="width: 190px; float: left;">
                            <div class="input-group date form_datetime col-md-5" id="startTimediv" data-date="" data-date-format="yyyy-mm-dd" data-link-field="dtp_input1">
                                <input id="startTime" name="startTime" class="form-control jt" size="16" type="text" value="" placeholder="开始时间" readonly style="width: 100px">
                                <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                                <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                            </div>
                        </div>
                        <div class="form-group" style="width: 190px; float: left;">
                            <div class="input-group date form_datetime col-md-5" id="endTimediv" data-date="" data-date-format="yyyy-mm-dd" data-link-field="dtp_input1">
                                <input id="endTime" name="endTime" class="form-control jt" size="16" type="text" value="" placeholder="结束时间" readonly style="width: 100px">
                                <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                                <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                            </div>
                        </div>
                        <div class="form-group" style="width: 160px; float: left; margin-right: 8px;">

                            <select name="company" class="form-control"  onchange="fiflt();" id="company" >
                                <option value="0">单位(不限)</option>
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
                        </div>

                        <div class="form-group" style="width: 140px; float: left; margin-right: 8px;">
                            <select name="driver" class="form-control"  onchange="fiflt();" id="driver">
                                <option value="0">司机(不限)</option>
                                <?php  $_smarty_tpl->tpl_vars['v'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['v']->_loop = false;
 $_smarty_tpl->tpl_vars['k'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['drivers']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['v']->key => $_smarty_tpl->tpl_vars['v']->value){
$_smarty_tpl->tpl_vars['v']->_loop = true;
 $_smarty_tpl->tpl_vars['k']->value = $_smarty_tpl->tpl_vars['v']->key;
?>
                                <option value="<?php echo $_smarty_tpl->tpl_vars['v']->value['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['v']->value['driver_name'];?>
</option>
                                <?php } ?>
                            </select>
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
" ><?php echo $_smarty_tpl->tpl_vars['v']->value['car_num'];?>
</option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group" style="width: 140px; float: left;">
                            <select name="state" class="form-control" onchange="fiflt();" id="state">
                                <option value="all" >状态(不限)</option>
                                <option value="0" >待单位审核</option>
                                <option value="1" >待中心审核</option>
                                <option value="2" >单位驳回</option>
                                <option value="3" >待派车</option>
                                <option value="4" >中心驳回</option>
                                <option value="5" >待派车审核</option>
                                <option value="6" >待出车</option>
                                <option value="7" >派车驳回</option>
                                <option value="8" >已出车</option>
                                <option value="9" >出行完成</option>
                                <option value="10" >申请取消</option>
                                <option value="11" >取消成功</option>
                            </select>
                        </div>

                        <div class="form-group" style="width: 160px; float: left;margin: 0 32px 0 8px">
                            <div id="search" style="float:left;height: 34px;text-align: center;position: relative;">
                                <input type="text" class="form-control input-inline jt" id="searchKey" name="searchKey" placeholder="请输入流水号/单位/地点"  onchange="fiflt()" />
                            </div>
                        </div>

                        <button id="btn_add"  type="submit" class="btn btn-default">
                            <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>导出结果
                        </button>
                    </form>
                </div>

                <div class="portlet-body">
                    <table class="table table-striped table-bordered table-hover dt-responsive" width="100%" id="allTravel">
                        <thead>
                        <tr>
                            <th style="padding-left: 0;padding-right: 0;text-align: center; width: 20px;"></th>
                            <th class="all">流水号</th>
                            <th class="all">出行单位</th>
                            <th class="all">出发地点</th>
                            <th class="all">目的地</th>
                            <th class="all">预约时间</th>
                            <th class="all">状态</th>
                            <th class="all" width="40">操作</th>

                            <!--隐藏内容-->
                            <th class="none">出行人数</th>
                            <th class="none">出行人员</th>
                            <th class="none">车牌号</th>
                            <th class="none">司机</th>
                            <th class="none">预计收车时间</th>
                        </tr>
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

<!-- END PAGE LEVEL SCRIPTS -->


<script>



    //删选操作
    function fiflt() {
        var dttable = $('#allTravel').dataTable();
        dttable.fnClearTable(); //清空一下table
    }


    
    var TableDatatablesResponsive = function () {
        //待审核出行表格
        var initTableAllReview = function () {
            var table = $('#allTravel');
            var oTable = table.dataTable({
                "searching": false,//禁用分页
                "lengthChange": false,//禁止改变分页大小
                "info": true,//左下角信息禁用
                "paging": true,//禁用分页
                "processing": true,//显示加载进度条
                "serverSide": true,//开启服务器端处理数据，分页，获取数据等等
                "ajax":function (data, callback, settings) {
                    //获取关键字
                    var searchKey=$("#searchKey").val();
                    data.searchKey=searchKey;
                    //获取开始时间
                    var startTime=$("#startTime").val();
                    data.startTime=startTime;
                    //获取结束时间
                    var endTime=$("#endTime").val();
                    data.endTime=endTime;
                    //获取选择的单位
                    var company=$("#company").val();
                    data.company=company;
                    //获取选择的司机
                    var driver=$("#driver").val();
                    data.driver=driver;
                    //获取选择的车辆
                    var car=$("#car").val();
                    data.car=car;
                    //获取选择的状态
                    var state=$("#state").val();
                    data.state=state;

                    $.ajax({
                        "url":"getAllTravels",
                        "type": "POST",
                        "data":data,
                        "success": function (resp) {
                            callback(resp);
                        }
                    })
                },
                "columns": [
                    {
                        "class":          'details-control',
                        "orderable":      false,
                        "data":           null,
                        "defaultContent": ''
                    },
                    { "data": "serial_number","defaultContent": "<i>暂无</i>" },
                    { "data": "user_company","defaultContent": "<i>暂无</i>" },
                    { "data": "from_place","defaultContent": "<i>暂无</i>" },
                    { "data": "to_place","defaultContent": "<i>暂无</i>" },
                    { "data": "departure_time" ,"defaultContent": "<i>暂无</i>","render":function(data,type,full,meta){
                            if(data!=""&&data!=null){
                                return new Date(data*1000).format("yyyy-MM-dd hh:mm");
                            }

                        }},
                    { "data": "state" ,"defaultContent": "<i>暂无</i>","render":function(data,type,row,meta){
                            if(row.state==0){
                                return "待管理员审核";
                            }
                            if(row.state==1){
                                return "待中心审核";
                            }
                            if(row.state==2){
                                return "管理员驳回";
                            }
                            if(row.state==3){
                                return "待派车";
                            }
                            if(row.state==4){
                                return "中心审核驳回";
                            }
                            if(row.state==5){
                                return "待派车审核";
                            }
                            if(row.state==6){
                                return "待出车";
                            }
                            if(row.state==7){
                                return "派车审核驳回";
                            }
                            if(row.state==8){
                                return "出车中";
                            }
                            if(row.state==9){
                                return "完成服务";
                            }
                            if(row.state==10){
                                return "申请取消中";
                            }
                            if(row.state==11){
                                return "出行已取消";
                            }

                        }},
                    { "data": "id","defaultContent": "<i>暂无</i>" ,"render":function (data,type,full,meta) {
                            var html = template(document.getElementById('reviewTravel').innerHTML, full);
                            return html;
                        }},
                    { "data": "people_num","defaultContent": "<i>暂无</i>" },
                    { "data": "travel_people","defaultContent": "<i>暂无</i>" },

                    { "data": "car_num","defaultContent": "<i>暂无</i>" },
                    { "data": "driver_name","defaultContent": "<i>暂无</i>" },

                    { "data": "collecting_time" ,"defaultContent": "<i>暂无</i>","render":function(data,type,full,meta){
                            if(data!=""&&data!=null){
                                return new Date(data*1000).format("yyyy-MM-dd hh:mm");
                            }

                        }}
                ],
                "columnDefs": [
                    { "orderable": false, "targets": 0 }//禁用第一列排序功能
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
                "dom": "<'row' <'col-md-12'B>><'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r><'table-scrollable't><'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>", // horizobtal scrollable datatable
                "initComplete":function (settings, json) {

                }
            });
        }


        return {
            init: function () {
                if (!jQuery().dataTable) {
                    return;
                }
                initTableAllReview();
            }
        };
    }();



    jQuery(document).ready(function() {
        TableDatatablesResponsive.init();//待审核出行表格初始化


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
        //SweetAlert.init();




        $('#waitReview tbody').on('click', 'td.details-control', function () {
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
        $('tbody').on( 'click', 'td .viewTravel', function () {
            var TravelId=$(this).attr("data-id");
            //加载模态框，直接模态框操作
            layer.open({
                type: 2,
                title:"查看出行",
                area: ['1090px', '750px'],
                fixed: false, //不固定
                maxmin: true,
                content: '/index.php/Admin/Travel/viewTravel/id/'+TravelId
            });
        })

        $('tbody').on( 'click', 'td .viewTravelTrack', function () {
            var TravelId=$(this).attr("data-id");
            //加载模态框，直接模态框操作
            layer.open({
                type: 2,
                title:"查看轨迹",
                area: ['1090px', '750px'],
                fixed: false, //不固定
                maxmin: true,
                content: '/index.php/Admin/Travel/viewTravelTrack/id/'+TravelId
            });
        })

        //查看预估出行轨迹图
        $('tbody').on( 'click', 'td .ViewTravelTrackEstimate', function () {
            var TravelId=$(this).attr("data-id");
            //加载模态框，直接模态框操作
            layer.open({
                type: 2,
                title:"查看预估轨迹",
                area: ['1090px', '750px'],
                fixed: false, //不固定
                maxmin: true,
                content: '/index.php/Admin/Travel/ViewTravelTrackEstimate/id/'+TravelId
            });
        })


        //注册取消点击事件
        $('tbody').on( 'click', 'td .cancelTravel', function () {


            //alert($(this).attr("data-id"));
            var TravelId=$(this).attr("data-id");
            swal({
                    title: "确定取消此出行吗？",
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

                        bootbox.prompt({
                            title:"请输入取消原因?",
                            buttons: {
                                confirm: {
                                    label: '确定取消',
                                    className: 'btn-success'
                                },
                                cancel: {
                                    label: '取消',
                                    className: 'btn-danger'
                                }
                            },
                            callback:function(result) {
                                if (result === null) {
                                    swal("取消操作", "", "error");
                                } else {
                                    $.post("/index.php/Admin/Travel/adminCancelTravel.html",
                                        {
                                            id:TravelId,
                                            center_error_msg:result
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
                                }
                            }
                        });




                    } else {
                        swal("取消操作", "", "error");
                    }
                });
        })




        //注册删除点击事件
        $('tbody').on( 'click', 'td .delTravel', function () {


            //alert($(this).attr("data-id"));
            var TravelId=$(this).attr("data-id");
            swal({
                    title: "确定删除此出行吗？",
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
                        $.post("/index.php/Admin/Travel/delTravel.html",
                            {
                                id:TravelId
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

                    } else {
                        swal("取消操作", "", "error");
                    }
                });
        })

        //注册派车点击事件
        $('#waitSendCar tbody').on( 'click', 'td .sendCar', function (){
            var TravelId=$(this).attr("data-id");
            //显示模态框
            $('#sendCarModal').modal({
                keyboard: true
            })
        })
    });







</script>

<script>
    $(function() {
        //取得div层
        var $search = $('#search');
        //取得输入框JQuery对象
        var $searchInput = $search.find('#searchKey');
        //关闭浏览器提供给输入框的自动完成
        $searchInput.attr('autocomplete', 'off');
        //创建自动完成的下拉列表，用于显示服务器返回的数据,插入在搜索按钮的后面，等显示的时候再调整位置
        var $autocomplete = $('<div class="autocomplete"></div>')
            .hide()
            .insertAfter('#searchKey');
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
            // alert(item);
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
            $.ajax({
                'url': '<?php echo U("Admin/Search /companyList");?>
', //服务器的地址
                'data': {
                    key:$searchInput.val()
                }, //参数
                'dataType': 'json', //返回数据类型
                'type': 'post', //请求类型
                'success': function(res) {

                    var data = res.data;
                    console.log(data);

                    if(data.length) {
                        //遍历data，添加到自动完成区
                        $.each(data,function(index, term) {

                            //创建li标签,添加到下拉列表中

                            $('<li></li>').text(term.name).appendTo($autocomplete)
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

                                    //清空并隐藏下拉列表
                                    $autocomplete.empty().hide();
                                    fiflt();
                                });
                        }); //事件注册完毕
                        //设置下拉列表的位置，然后显示下拉列表
                        // var ypos = $searchInput.position().top;
                        var ypos = 0;
                        // var xpos = $searchInput.position().left;
                        var xpos = 0;
                        // $autocomplete.css('width', $searchInput.css('width'));
                        $autocomplete.css({
                            'width': $searchInput.css('width'),
                            'position': 'relative',
                            'left': xpos + "px",
                            'top': ypos + "px",
                            'z-index': "9999",
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

<!--审核出行操作tools-->
<script id="reviewTravel" type="text/html">
    <div class="btn-group pull-right">
        <button class="btn green btn-xs btn-outline dropdown-toggle" data-toggle="dropdown">操作
            <i class="fa fa-angle-down"></i>
        </button>
        <ul class="dropdown-menu pull-right">

            <?php if (in_array("/index.php/Admin/Travel/viewTravel",$_SESSION['allUrls'])){?>
            <li>
                <a href="javascript:;" class="viewTravel" data-id="<<?php ?>%=id%<?php ?>>"><i class="fa fa-print"></i> 查看 / 修改 </a>
            </li>

            <<?php ?>%if (state==9) { %<?php ?>>
            <li>
                <a href="javascript:;" class="viewTravelTrack" data-id="<<?php ?>%=id%<?php ?>>"><i class="fa fa-print"></i> 查看轨迹 </a>
            </li>
            <<?php ?>% } %<?php ?>>

            <li>
                <a href="javascript:;" class="ViewTravelTrackEstimate" data-id="<<?php ?>%=id%<?php ?>>"><i class="fa fa-print"></i> 查看预估轨迹 </a>
            </li>

            <?php }?>




            <?php if (in_array("/index.php/Admin/Travel/delTravel",$_SESSION['allUrls'])){?>
            <!--<li>-->
                <!--<a href="javascript:;" class="delTravel" data-id="<<?php ?>%=id%<?php ?>>"><i class="fa fa-file-pdf-o"></i> 删除 </a>-->
            <!--</li>-->

            <li>
            <a href="javascript:;" class="cancelTravel" data-id="<<?php ?>%=id%<?php ?>>"><i class="fa fa-file-pdf-o"></i> 取消出行 </a>
            </li>
            <?php }?>
        </ul>
    </div>
</script>

<!--派车操作Tools-->
<script id="sendCar" type="text/html">
    <div class="btn-group pull-right">
        <button class="btn green btn-xs btn-outline dropdown-toggle" data-toggle="dropdown">操作
            <i class="fa fa-angle-down"></i>
        </button>
        <ul class="dropdown-menu pull-right">
            <li>
                <a href="javascript:;" class="viewTravel" data-id="<<?php ?>%=id%<?php ?>>"><i class="fa fa-print"></i> 查看 </a>
            </li>
            <li>
                <a href="javascript:;" class="sendCar" data-id="<<?php ?>%=id%<?php ?>>"><i class="fa fa-file-pdf-o"></i> 派车 </a>
            </li>
        </ul>
    </div>
</script>
<?php }} ?>