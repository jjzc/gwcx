<?php /* Smarty version Smarty-3.1.6, created on 2018-08-02 17:02:09
         compiled from "H:/dxcar/Admin/View\Statistics\viewTravelList.html" */ ?>
<?php /*%%SmartyHeaderCode:216135b62c891793469-66039987%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a609bbf708889876e4a2362b6f72df7881526c89' => 
    array (
      0 => 'H:/dxcar/Admin/View\\Statistics\\viewTravelList.html',
      1 => 1533170282,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '216135b62c891793469-66039987',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'company' => 0,
    'car' => 0,
    'driver' => 0,
    'user' => 0,
    'startTime' => 0,
    'endTime' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.6',
  'unifunc' => 'content_5b62c89190e2e',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5b62c89190e2e')) {function content_5b62c89190e2e($_smarty_tpl) {?><!DOCTYPE html>

<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<!-- BEGIN HEAD -->

<head>
    <meta charset="utf-8" />
    <title>出行详情</title>
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
<div class="page-content">




    <!--表格开始-->
    <!--全部出行表格-->
    <div class="row" id="waitReviewRow">
        <div class="col-md-12">
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption font-dark">
                        <i class="icon-settings font-dark"></i>
                        <span class="caption-subject bold uppercase">出行详情</span>
                    </div>
                    <div class="tools"></div>
                </div>

                <div class="portlet-body">
                    <table class="table table-striped table-bordered table-hover dt-responsive" width="100%" id="recycleTravels">
                        <thead>
                        <tr>
                            <th style="padding-left: 0;padding-right: 0;text-align: center; width: 20px;"></th>
                            <th class="all">流水号</th>
                            <th class="all">出发地点</th>
                            <th class="all">目的地</th>
                            <th class="all">预约时间</th>
                            <th class="all">出行人员</th>
                            <th class="all">出行里程</th>
                            <th class="all" width="40">操作</th>

                            <!--隐藏内容-->
                            <th class="none">出行人数</th>

                            <th class="none">司机</th>
                            <th class="none">车辆</th>

                            <th class="none">出车时间</th>
                            <th class="none">结束用车时间</th>

                            <th class="none">费用信息</th>
                            <th class="none">费用合计</th>
                        </tr>
                        </thead>
                        <tbody>


                        </tbody>
                    </table>

                    <div class="form-group" style="margin-top: 15px;">

                        <button type="button" class="btn btn-primary" onclick="closeThis();">关闭</button>
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
    var company="<?php echo $_smarty_tpl->tpl_vars['company']->value;?>
";
    var car="<?php echo $_smarty_tpl->tpl_vars['car']->value;?>
";
    var driver="<?php echo $_smarty_tpl->tpl_vars['driver']->value;?>
";
    var user="<?php echo $_smarty_tpl->tpl_vars['user']->value;?>
";

    var startTime="<?php echo $_smarty_tpl->tpl_vars['startTime']->value;?>
";
    var endTime="<?php echo $_smarty_tpl->tpl_vars['endTime']->value;?>
";
</script>

<script>
    function closeThis(){
        var index = parent.layer.getFrameIndex(window.name);
        parent.layer.close(index);
    }

    var TableDatatablesResponsive = function () {
        //待审核出行表格
        var initTableAllReview = function () {
            var table = $('#recycleTravels');
            var oTable = table.dataTable({
                "searching": false,//禁用分页
                "lengthChange": false,//禁止改变分页大小
                "info": true,//左下角信息禁用
                "paging": true,//禁用分页
                "processing": true,//显示加载进度条
                "serverSide": true,//开启服务器端处理数据，分页，获取数据等等
                "ajax":function (data, callback, settings) {
                    data.company=company;
                    data.car=car;
                    data.driver=driver;
                    data.user=user;


                    data.startTime=startTime;
                    data.endTime=endTime;

                    $.ajax({
                        "url":"/index.php/Admin/Statistics/getViewTravelList",
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
                    { "data": "from_place","defaultContent": "<i>暂无</i>" },
                    { "data": "to_place","defaultContent": "<i>暂无</i>" },
                    { "data": "departure_time" ,"defaultContent": "<i>暂无</i>","render":function(data,type,full,meta){
                            if(data!=""&&data!=null){
                                return new Date(data*1000).format("yyyy-MM-dd hh:mm");
                            }

                        }},

                    { "data": "travel_people","defaultContent": "<i>暂无</i>" },



                    { "data": "mileage","defaultContent": "<i>暂无</i>" },

                    { "data": "id","defaultContent": "<i>暂无</i>" ,"render":function (data,type,full,meta) {
                            var html = template(document.getElementById('reviewTravel').innerHTML, full);
                            return html;
                        }},
                    { "data": "people_num","defaultContent": "<i>暂无</i>" },

                    { "data": "driver_name","defaultContent": "<i>暂无</i>" },
                    { "data": "car_num","defaultContent": "<i>暂无</i>" },

                    { "data": "start_car_time" ,"defaultContent": "<i>暂无</i>","render":function(data,type,full,meta){
                            if(data!=""&&data!=null){
                                return new Date(data*1000).format("yyyy-MM-dd hh:mm");
                            }

                        }},
                    { "data": "end_use_car_time" ,"defaultContent": "<i>暂无</i>","render":function(data,type,full,meta){
                            if(data!=""&&data!=null){
                                return new Date(data*1000).format("yyyy-MM-dd hh:mm");
                            }

                        }},

                    { "data": "fees_sum" ,"defaultContent": "<i>暂无</i>","render":function(data,type,full,meta){
                        if(data!=""&&data!=null){
                            return "路桥费"+full.fees_sum+"元;停车费"+full.parking_rate_sum+"元;出行服务费"+full.service_charge+"元;司机住宿补贴"+full.driver_cost+"元;超时费"+full.over_time_cost+"元;超公里费"+full.over_mileage_cost+"元;其他费用"+full.else_cost+"元;";
                        }

                        }},
                    { "data": "totle_rate","defaultContent": "<i>暂无</i>" },
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
            //alert(TravelId);

            //加载模态框，直接模态框操作
            layer.open({
                type: 2,
                title:"查看出行",
                area: ['1080px', '750px'],
                fixed: false, //不固定
                maxmin: true,
                content: '/index.php/Admin/Travel/viewTravel/id/'+TravelId
            });
        })


        //注册审核通过点击事件
        $('#waitReview tbody').on( 'click', 'td .agreeTravel', function () {
            //alert($(this).attr("data-id"));
            var TravelId=$(this).attr("data-id");
            swal({
                    title: "确定通过此出行审核吗？",
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
                        $.post("/index.php/Admin/Travel/reviewTravel.html",
                            {
                                id:TravelId,
                                type:1
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

        //注册驳回点击事件
        $('#waitReview tbody').on( 'click', 'td .disagreeTravel', function () {
            //alert($(this).attr("data-id"));
            var TravelId=$(this).attr("data-id");
            swal({
                    title: "确定驳回此出行申请吗？",
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
                        //应该在此处加上询问驳回原

                        bootbox.prompt({
                            title:"请输入驳回原因?",
                            buttons: {
                                confirm: {
                                    label: '确定驳回',
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
                                    $.post("/index.php/Admin/Travel/reviewTravel.html",
                                        {
                                            id:TravelId,
                                            type:2,
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

                        //此处进行审核操作AJAX

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

<!--审核出行操作tools-->
<script id="reviewTravel" type="text/html">
    <div class="btn-group pull-right">
        <button class="btn green btn-xs btn-outline dropdown-toggle" data-toggle="dropdown">操作
            <i class="fa fa-angle-down"></i>
        </button>
        <ul class="dropdown-menu pull-right">
            <li>
                <a href="javascript:;" class="viewTravel" data-id="<<?php ?>%=id%<?php ?>>"><i class="fa fa-print"></i> 查看 </a>
            </li>
        </ul>
    </div>
</script>



</body>

</html>
<?php }} ?>