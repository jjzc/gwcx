<?php /* Smarty version Smarty-3.1.6, created on 2018-10-11 15:39:25
         compiled from "D:/xampp/htdocs/Admin/View\TravelSet\travelTypes.html" */ ?>
<?php /*%%SmartyHeaderCode:319725bbefe2d484ed3-26017347%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '55a84cb9d42be250e66a5a9e6d82015303a316e0' => 
    array (
      0 => 'D:/xampp/htdocs/Admin/View\\TravelSet\\travelTypes.html',
      1 => 1537240799,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '319725bbefe2d484ed3-26017347',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.6',
  'unifunc' => 'content_5bbefe2d6fdc6',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5bbefe2d6fdc6')) {function content_5bbefe2d6fdc6($_smarty_tpl) {?><!DOCTYPE html>

<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<!-- BEGIN HEAD -->

<head>
    <meta charset="utf-8" />
    <title>全部车辆</title>
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

                            <li class="nav-item start ">
                                <a href="/index.php/Admin/TravelSet/travelSet" class="nav-link ">
                                    <i class="icon-bulb"></i>
                                    <span class="title">系统设置</span>
                                    <!--<span class="badge badge-success">1</span>-->
                                </a>
                            </li>
                            <li class="nav-item start  active open">
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
                            <li class="nav-item start ">
                                <a href="/index.php/Admin/TravelSet/subsidyType" class="nav-link ">
                                    <i class="icon-graph"></i>
                                    <span class="title">补贴类型</span>
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
                                    <span class="caption-subject bold uppercase">全部出行类型</span>
                                </div>
                                <div class="tools">
                                    <div class="table-toolbar">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="btn-group">
                                                    <button id="sample_editable_1_new" class="btn sbold green" onclick="openAddCar()"> 新增类型
                                                        <i class="fa fa-plus"></i>
                                                    </button>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="portlet-body">

                                <table class="table table-striped table-bordered table-hover dt-responsive" width="100%" id="allCars">
                                    <thead>
                                    <tr>
                                        <th class="all">类型名称</th>
                                        <th class="all">是否需要派车</th>
                                        <th class="all">是否需要单位审核</th>
                                        <th class="all">是否需要中心审核</th>
                                        <th class="all">是否需要提交回执单</th>
                                        <th class="all">是否需要评价</th>
                                        <th class="all">派车后是否需要审核</th>
                                        <th class="all">是否需要计算费用</th>
                                        <th class="all" width="40">操作</th>
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

<!-- END PAGE LEVEL SCRIPTS -->


<script>
    var TableDatatablesResponsive = function () {
        //待审核出行表格
        var initTableAllCars = function () {
            var table = $('#allCars');
            var oTable = table.dataTable({
                "searching": false,//禁用分页
                "lengthChange": false,//禁止改变分页大小
                "info": true,//左下角信息禁用
                "paging": true,//禁用分页
                "processing": true,//显示加载进度条
                "serverSide": true,//开启服务器端处理数据，分页，获取数据等等
                "ajax":function (data, callback, settings) {
                    $.ajax({
                        "url":"getTravelTypes",
                        "type": "POST",
                        "data":data,
                        "success": function (resp) {
                            callback(resp);
                        }
                    })
                },
                "columns": [
                    { "data": "travel_name","defaultContent": "<i>暂无</i>" },
                    { "data": "is_arrange_car","defaultContent": "<i>暂无</i>" ,"render":function(data,type,full,meta){
                            if(data==1){
                                return "需要";
                            }else{
                                return "-";
                            }

                        }},
                    { "data": "is_need_manage_review","defaultContent": "<i>暂无</i>" ,"render":function(data,type,full,meta){
                            if(data==1){
                                return "需要";
                            }else{
                                return "-";
                            }

                        }},
                    { "data": "is_need_center_review" ,"defaultContent": "<i>暂无</i>","render":function(data,type,full,meta){
                            if(data==1){
                                return "需要";
                            }else{
                                return "-";
                            }

                        }},
                    { "data": "is_need_receipt" ,"defaultContent": "<i>暂无</i>","render":function(data,type,full,meta){
                            if(data==1){
                                return "需要";
                            }else{
                                return "-";
                            }

                        }},
                    { "data": "is_need_evaluate" ,"defaultContent": "<i>暂无</i>","render":function(data,type,full,meta){
                            if(data==1){
                                return "需要";
                            }else{
                                return "-";
                            }

                        }},
                    { "data": "is_need_sendcar_review" ,"defaultContent": "<i>暂无</i>","render":function(data,type,full,meta){
                            if(data==1){
                                return "需要";
                            }else{
                                return "-";
                            }

                        }},
                    { "data": "is_need_settlement" ,"defaultContent": "<i>暂无</i>","render":function(data,type,full,meta){
                            if(data==1){
                                return "需要";
                            }else{
                                return "-";
                            }

                        }},
                    { "data": "id","defaultContent": "<i>暂无</i>","orderable":false ,"render":function (data,type,full,meta) {
                            var html = template(document.getElementById('carTools').innerHTML, full);
                            return html;
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
                initTableAllCars();
            }
        };
    }();


    function openAddCar(){
        layer.open({
            type: 2,
            title:"新增类型",
            area: ['1000px', '400px'],
            fixed: false, //不固定
            maxmin: true,
            content: '/index.php/Admin/TravelSet/addTravelType'
        });
    }



    jQuery(document).ready(function() {
        TableDatatablesResponsive.init();//待审核出行表格初始化
        //SweetAlert.init();




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
                title:"查看类型",
                area: ['1000px', '400px'],
                fixed: false, //不固定
                maxmin: true,
                content: '/index.php/Admin/TravelSet/editTravelType/id/'+id
            });
        })


        //注册删除车辆事件
        $('#allCars tbody').on( 'click', 'td .delCar', function () {
            //alert($(this).attr("data-id"));
            var carId=$(this).attr("data-id");

            swal({
                    title: "确定删除此类型吗？",
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
                        $.post("/index.php/Admin/TravelSet/delTravelType.html",
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
            <li>
                <a href="javascript:;" class="viewCar" data-id="<<?php ?>%=id%<?php ?>>"><i class="fa fa-print"></i> 查看 / 修改 </a>
            </li>
            <li>
                <a href="javascript:;" class="delCar" data-id="<<?php ?>%=id%<?php ?>>"><i class="fa fa-file-pdf-o"></i> 删除类型 </a>
            </li>
        </ul>
    </div>
</script>



</body>

</html><?php }} ?>