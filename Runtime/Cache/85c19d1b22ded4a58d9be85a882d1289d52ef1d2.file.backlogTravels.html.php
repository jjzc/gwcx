<?php /* Smarty version Smarty-3.1.6, created on 2018-08-02 14:51:31
         compiled from "H:/dxcar/Admin/View\Travel\backlogTravels.html" */ ?>
<?php /*%%SmartyHeaderCode:15745b615796f2ece4-62629824%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '85c19d1b22ded4a58d9be85a882d1289d52ef1d2' => 
    array (
      0 => 'H:/dxcar/Admin/View\\Travel\\backlogTravels.html',
      1 => 1533192689,
      2 => 'file',
    ),
    '8a159be6396f1f86d2bd936f127d3e7bf597b18a' => 
    array (
      0 => 'H:\\dxcar\\Admin\\View\\Travel\\template.html',
      1 => 1533170284,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '15745b615796f2ece4-62629824',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.6',
  'unifunc' => 'content_5b61579743636',
  'variables' => 
  array (
    'travelLeft' => 0,
    'v' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5b61579743636')) {function content_5b61579743636($_smarty_tpl) {?><!DOCTYPE html>
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
                
<style>
    .nu{
        height: 82px;
        line-height: 80px;
        font-size: 25px;
    }
    .nu p{
        padding: 0;
        border: 0;
        width: 80%;
        border:  solid 1px #0a6aa1;
        text-align: center;

    }
    .nu p span{
        color: #FF3F3F;
        display: inline-block;
        margin-left: 5px;
    }
</style>

            <div class="page-content">

                <div class="col-md-12" style="height: 82px;margin-bottom: 20px;">
                    <div class="col-md-2 nu"><p style="padding: 0; margin: 0 auto;">待审核<span id="num1">0</span></p></div>
                    <div class="col-md-2 nu"><p style="padding: 0; margin: 0 auto;">待派车<span id="num2">0</span></p></div>
                    <div class="col-md-2 nu"><p style="padding: 0; margin: 0 auto;">待出车<span id="num3">0</span></p></div>
                    <div class="col-md-2 nu"><p style="padding: 0; margin: 0 auto;">待完成<span id="num4">0</span></p></div>
                    <div class="col-md-2 nu"><p style="padding: 0; margin: 0 auto;">待核算<span id="num5">0</span></p></div>
                    <div class="col-md-2 nu"><p style="padding: 0; margin: 0 auto;">待取消<span id="num6">0</span></p></div>
                    <!--待审核-->
                    <!--待派车-->
                    <!--待出车-->
                    <!--待完成-->
                    <!--待核算-->
                    <!--待取消-->
                </div>


                <!--表格开始-->
                <!--待审核出行表格-->
                <div class="col-md-6 leftBox">
                    <div class="row col-md-12" id="waitReviewRow" <?php if (in_array("/index.php/Admin/Travel/reviewTravels",$_SESSION['allUrls'])){?> <?php }else{ ?>style="display: none;"<?php }?>>
                        <div class="">
                            <div class="portlet light bordered">
                                <div class="portlet-title">
                                    <div class="caption font-dark">
                                        <i class="icon-settings font-dark"></i>
                                        <span class="caption-subject bold uppercase">待审核出行</span>
                                    </div>
                                    <div class="tools"></div>
                                </div>

                                <div class="portlet-body">
                                    <table class="table table-striped table-bordered table-hover dt-responsive" width="100%" id="waitReview">
                                        <thead>
                                        <tr>
                                            <th style="padding-left: 0;padding-right: 0;text-align: center; width: 20px;"></th>
                                            <th class="all">用车单位</th>
                                            <th class="all">用车人</th>
                                            <th class="all">出发地点</th>
                                            <th class="all">预约时间</th>
                                            <th class="all" width="40">操作</th>

                                            <!--隐藏内容-->
                                            <th class="none">流水号</th>
                                            <th class="none">目的地</th>
                                            <th class="none">出行人数</th>
                                            <th class="none">出行人员</th>
                                            <th class="none">出行备注</th>
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

                    <!--待派车出行表格-->
                    <div class="row col-md-12" id="waitSendCarRow" <?php if (in_array("/index.php/Admin/Travel/sendCar",$_SESSION['allUrls'])){?> <?php }else{ ?>style="display: none;"<?php }?>>
                        <div class="">
                            <div class="portlet light bordered">
                                <div class="portlet-title">
                                    <div class="caption font-dark">
                                        <i class="icon-settings font-dark"></i>
                                        <span class="caption-subject bold uppercase">待派车出行</span>
                                    </div>
                                    <div class="tools"></div>
                                </div>

                                <div class="portlet-body">
                                    <table class="table table-striped table-bordered table-hover dt-responsive" width="100%" id="waitSendCar">
                                        <thead>
                                        <tr>
                                            <th style="padding-left: 0;padding-right: 0;text-align: center; width: 20px;"></th>
                                            <th class="all">用车单位</th>
                                            <th class="all">用车人</th>
                                            <th class="all">出发地点</th>
                                            <th class="all">目的地</th>
                                            <th class="all">预约时间</th>
                                            <th class="all" width="40">操作</th>

                                            <!--隐藏内容-->
                                            <th class="none">流水号</th>
                                            <th class="none">出行人数</th>
                                            <th class="none">出行人员</th>
                                            <th class="none">出行备注</th>
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

                    <!--待审核派车信息表格-->
                    <div class="row col-md-12" id="waitSendCarReviewRow" <?php if (in_array("/index.php/Admin/Travel/sendCarReview",$_SESSION['allUrls'])){?> <?php }else{ ?>style="display: none;"<?php }?>>
                        <div class="">
                            <div class="portlet light bordered">
                                <div class="portlet-title">
                                    <div class="caption font-dark">
                                        <i class="icon-settings font-dark"></i>
                                        <span class="caption-subject bold uppercase">派车信息审核</span>
                                    </div>
                                    <div class="tools"></div>
                                </div>
                                <div class="portlet-body">
                                    <table class="table table-striped table-bordered table-hover dt-responsive" width="100%" id="waitSendCarReview">
                                        <thead>
                                        <tr>
                                            <th style="padding-left: 0;padding-right: 0;text-align: center; width: 20px;"></th>
                                            <th class="all">用车单位</th>
                                            <th class="all">司机</th>
                                            <th class="all">车辆</th>
                                            <th class="all">预约时间</th>
                                            <th class="all" width="40">操作</th>
                                            <!--隐藏内容-->
                                            <th class="none">流水号</th>
                                            <th class="none">出发地点</th>
                                            <th class="none">目的地</th>
                                            <th class="none">出行人数</th>
                                            <th class="none">出行人员</th>
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

                    <!--待出车出行表格-->
                    <div class="row col-md-12" id="waitStartCarRow" <?php if (in_array("/index.php/Admin/Travel/startCar",$_SESSION['allUrls'])){?> <?php }else{ ?>style="display: none;"<?php }?>>
                        <div class="">
                            <div class="portlet light bordered">
                                <div class="portlet-title">
                                    <div class="caption font-dark">
                                        <i class="icon-settings font-dark"></i>
                                        <span class="caption-subject bold uppercase">待出车出行</span>
                                    </div>
                                    <div class="tools"></div>
                                </div>
                                <div class="portlet-body">
                                    <table class="table table-striped table-bordered table-hover dt-responsive" width="100%" id="waitStartCar">
                                        <thead>
                                        <tr>
                                            <th style="padding-left: 0;padding-right: 0;text-align: center; width: 20px;"></th>
                                            <th class="all">用车单位</th>
                                            <th class="all">司机</th>
                                            <th class="all">车辆</th>
                                            <th class="all">预约时间</th>
                                            <th class="all" width="40">操作</th>
                                            <!--隐藏内容-->
                                            <th class="none">流水号</th>
                                            <th class="none">出发地点</th>
                                            <th class="none">目的地</th>
                                            <th class="none">出行人数</th>
                                            <th class="none">出行人员</th>
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

                    <div style="clear: both;"></div>

                </div>

                <div class="col-md-6 rightBox">


                    <!--待完成出行表格-->
                    <div class="row col-md-12" id="waitFinishRow" <?php if (in_array("/index.php/Admin/Travel/finishTravel",$_SESSION['allUrls'])){?> <?php }else{ ?>style="display: none;"<?php }?>>
                        <div class="">
                            <div class="portlet light bordered">
                                <div class="portlet-title">
                                    <div class="caption font-dark">
                                        <i class="icon-settings font-dark"></i>
                                        <span class="caption-subject bold uppercase">待完成出行</span>
                                    </div>
                                    <div class="tools"></div>
                                </div>
                                <div class="portlet-body">
                                    <table class="table table-striped table-bordered table-hover dt-responsive" width="100%" id="waitFinish">
                                        <thead>
                                        <tr>
                                            <th style="padding-left: 0;padding-right: 0;text-align: center; width: 20px;"></th>

                                            <th class="all">用车单位</th>
                                            <th class="all">用车人</th>
                                            <th class="all">司机</th>
                                            <th class="all">车辆</th>

                                            <th class="all">派车类型</th>

                                            <th class="all" width="40">操作</th>
                                            <!--隐藏内容-->
                                            <th class="none">流水号</th>
                                            <th class="none">预约时间</th>
                                            <th class="none">出发地点</th>
                                            <th class="none">目的地</th>

                                            <th class="none">出行人数</th>
                                            <th class="none">出行人员</th>
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

                    <!--待费用审核表格-->
                    <div class="row col-md-12" id="waitChargingRow" <?php if (in_array("/index.php/Admin/Travel/charging",$_SESSION['allUrls'])){?> <?php }else{ ?>style="display: none;"<?php }?>>
                        <div class="">
                            <div class="portlet light bordered">
                                <div class="portlet-title">
                                    <div class="caption font-dark">
                                        <i class="icon-settings font-dark"></i>
                                        <span class="caption-subject bold uppercase">待费用计算出行</span>
                                    </div>
                                    <div class="tools"></div>
                                </div>
                                <div class="portlet-body">
                                    <table class="table table-striped table-bordered table-hover dt-responsive" width="100%" id="waitCharging">
                                        <thead>
                                        <tr>
                                            <th style="padding-left: 0;padding-right: 0;text-align: center; width: 20px;"></th>
                                            <th class="all">用车单位</th>
                                            <th class="all">用车人</th>


                                            <th class="all">出发地点</th>
                                            <th class="all">目的地</th>


                                            <th class="all" width="40">操作</th>
                                            <!--隐藏内容-->
                                            <th class="none">流水号</th>
                                            <th class="none">司机</th>
                                            <th class="none">车辆</th>
                                            <th class="none">预约时间</th>
                                            <th class="none">出行人数</th>
                                            <th class="none">出行人员</th>
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

                    <!--待取消审核表格-->
                    <div class="row col-md-12" id="waitCancelRow" <?php if (in_array("/index.php/Admin/Travel/reviewCancel",$_SESSION['allUrls'])){?> <?php }else{ ?>style="display: none;"<?php }?>>
                        <div class="">
                            <div class="portlet light bordered">
                                <div class="portlet-title">
                                    <div class="caption font-dark">
                                        <i class="icon-settings font-dark"></i>
                                        <span class="caption-subject bold uppercase">待取消审核出行</span>
                                    </div>
                                    <div class="tools"></div>
                                </div>
                                <div class="portlet-body">
                                    <table class="table table-striped table-bordered table-hover dt-responsive" width="100%" id="waitCancel">
                                        <thead>
                                        <tr>
                                            <th style="padding-left: 0;padding-right: 0;text-align: center; width: 20px;"></th>
                                            <th class="all">用车单位</th>
                                            <th class="all">用车人</th>

                                            <th class="all">出发地点</th>
                                            <th class="all">目的地</th>

                                            <th class="all">预约时间</th>
                                            <th class="all" width="40">操作</th>
                                            <!--隐藏内容-->
                                            <th class="none">流水号</th>
                                            <th class="none">司机</th>
                                            <th class="none">车辆</th>
                                            <th class="none">出行人数</th>
                                            <th class="none">出行人员</th>
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

                    <!--今日已经完成出行-->
                    <div class="row col-md-12" id="finishNowRow">
                        <div class="">
                            <div class="portlet light bordered">
                                <div class="portlet-title">
                                    <div class="caption font-dark">
                                        <i class="icon-settings font-dark"></i>
                                        <span class="caption-subject bold uppercase">当日已完成出行</span>
                                    </div>
                                    <div class="tools"></div>
                                </div>
                                <div class="portlet-body">
                                    <table class="table table-striped table-bordered table-hover dt-responsive" width="100%" id="finishNow">
                                        <thead>
                                        <tr>
                                            <th style="padding-left: 0;padding-right: 0;text-align: center; width: 20px;"></th>
                                            <th class="all">流水号</th>
                                            <th class="all">用车单位</th>

                                            <th class="all">司机</th>
                                            <th class="all">车辆</th>

                                            <th class="all">派车类型</th>

                                            <th class="all" width="40">操作</th>
                                            <!--隐藏内容-->
                                            <th class="none">出发地点</th>
                                            <th class="none">目的地</th>
                                            <th class="none">预约时间</th>
                                            <th class="none">出行人数</th>
                                            <th class="none">出行人员</th>
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

                    <div style="clear: both;"></div>
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

<!-- END PAGE LEVEL SCRIPTS -->


<script>
    var TableDatatablesResponsive = function () {
        //待审核出行表格
        var initTableWaitReview = function () {
            var table = $('#waitReview');
            var oTable = table.dataTable({
                "searching": false,//禁用分页
                "lengthChange": false,//禁止改变分页大小
                "info": true,//左下角信息禁用
                "paging": true,//禁用分页
                "processing": true,//显示加载进度条
                "serverSide": true,//开启服务器端处理数据，分页，获取数据等等
                "ajax":function (data, callback, settings) {
                    $.ajax({
                        "url":"getCenterReviewTravels",
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
                    { "data": "user_company","defaultContent": "<i>暂无</i>" },
                    { "data": "user_name","defaultContent": "<i>暂无</i>" },
                    { "data": "from_place","defaultContent": "<i>暂无</i>" },
                    { "data": "departure_time" ,"defaultContent": "<i>暂无</i>","render":function(data,type,full,meta){
                            if(data!=""&&data!=null){
                                return new Date(data*1000).format("yyyy-MM-dd hh:mm");
                            }

                        }},
                    { "data": "id","defaultContent": "<i>暂无</i>" ,"render":function (data,type,full,meta) {
                            var html = template(document.getElementById('reviewTravel').innerHTML, full);
                            return html;
                        }},
                    { "data": "serial_number","defaultContent": "<i>暂无</i>" },
                    { "data": "to_place","defaultContent": "<i>暂无</i>" },
                    { "data": "people_num","defaultContent": "<i>暂无</i>" },
                    { "data": "travel_people","defaultContent": "<i>暂无</i>" },
                    { "data": "travel_reason","defaultContent": "<i>暂无</i>" },
                    { "data": "collecting_time","defaultContent": "<i>暂无</i>" ,"render":function(data,type,full,meta){
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
                "pageLength": 20,
                "dom": "<'row' <'col-md-12'B>><'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r><'table-scrollable't><'row'<'col-md-5 col-sm-12'><'col-md-7 col-sm-12'>>", // horizobtal scrollable datatable
                "initComplete":function (settings, json) {
                    //alert(JSON.stringify(json));
                    if(json.recordsTotal==0){
                        //隐藏自己这个表格
                        //$("#waitReviewRow").hide();
                    }

                    if(json.recordsTotal<10){

                        //alert(settings);
                        // $('#waitReview').dataTable({
                        //     "paging":false,
                        //     "info":false
                        // })
                    }

                    heightInit();
                }
            });
        }

        //待派车出行表格
        var initTableWaitSendCar = function () {
            var table = $('#waitSendCar');
            var oTable = table.dataTable({
                "searching": false,//禁用分页
                "lengthChange": false,//禁止改变分页大小
                "info": true,//左下角信息禁用
                "paging": true,//禁用分页
                "processing": true,//显示加载进度条
                "serverSide": true,//开启服务器端处理数据，分页，获取数据等等
                "ajax":function (data, callback, settings) {
                    $.ajax({
                        "url":"getWaitSendCarTravels",
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
                    { "data": "user_company","defaultContent": "<i>暂无</i>" },
                    { "data": "user_name","defaultContent": "<i>暂无</i>" },
                    { "data": "from_place","defaultContent": "<i>暂无</i>" },
                    { "data": "to_place","defaultContent": "<i>暂无</i>" },
                    { "data": "departure_time" ,"defaultContent": "<i>暂无</i>","render":function(data,type,full,meta){
                            if(data!=""&&data!=null){
                                return new Date(data*1000).format("yyyy-MM-dd hh:mm");
                            }

                        }},

                    { "data": "id","defaultContent": "<i>暂无</i>" ,"render":function (data,type,full,meta) {
                            var html = template(document.getElementById('sendCar').innerHTML, full);
                            return html;
                        }},

                    { "data": "serial_number","defaultContent": "<i>暂无</i>" },
                    { "data": "people_num","defaultContent": "<i>暂无</i>" },
                    { "data": "travel_people","defaultContent": "<i>暂无</i>" },
                    { "data": "travel_reason","defaultContent": "<i>暂无</i>" },
                    { "data": "collecting_time","defaultContent": "<i>暂无</i>" ,"render":function(data,type,full,meta){
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
                "pageLength": 20,
                "dom": "<'row' <'col-md-12'B>><'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r><'table-scrollable't><'row'<'col-md-5 col-sm-12'><'col-md-7 col-sm-12'>>", // horizobtal scrollable datatable
                "initComplete":function (settings, json) {
                    //alert(JSON.stringify(json));
                    if(json.recordsTotal==0){
                        //隐藏自己这个表格
                        //$("#waitSendCarRow").hide();
                    }

                    heightInit();
                }
            });
        }

        //派车信息审核表格
        var initTableSendCarReview=function () {
            var table = $('#waitSendCarReview');
            var oTable = table.dataTable({
                "searching": false,//禁用分页
                "lengthChange": false,//禁止改变分页大小
                "info": true,//左下角信息禁用
                "paging": true,//禁用分页
                "processing": true,//显示加载进度条
                "serverSide": true,//开启服务器端处理数据，分页，获取数据等等
                "ajax":function (data, callback, settings) {
                    $.ajax({
                        "url":"getWaitReviewSendCar",
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
                    { "data": "user_company","defaultContent": "<i>暂无</i>" },

                    { "data": "driver_name","defaultContent": "<i>暂无</i>" },
                    { "data": "car_num","defaultContent": "<i>暂无</i>" },
                    { "data": "departure_time" ,"defaultContent": "<i>暂无</i>","render":function(data,type,full,meta){
                            if(data!=""&&data!=null){
                                return new Date(data*1000).format("yyyy-MM-dd hh:mm");
                            }

                        }},
                    { "data": "id","defaultContent": "<i>暂无</i>" ,"render":function (data,type,full,meta) {
                            var html = template(document.getElementById('reviewSendCar').innerHTML, full);
                            return html;
                        }},

                    { "data": "serial_number","defaultContent": "<i>暂无</i>" },

                    { "data": "from_place","defaultContent": "<i>暂无</i>" },
                    { "data": "to_place","defaultContent": "<i>暂无</i>" },

                    { "data": "people_num","defaultContent": "<i>暂无</i>" },
                    { "data": "travel_people","defaultContent": "<i>暂无</i>" },
                    { "data": "collecting_time","defaultContent": "<i>暂无</i>" ,"render":function(data,type,full,meta){
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
                "pageLength": 20,
                "dom": "<'row' <'col-md-12'B>><'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r><'table-scrollable't><'row'<'col-md-5 col-sm-12'><'col-md-7 col-sm-12'>>", // horizobtal scrollable datatable
                "initComplete":function (settings, json) {
                    //alert(JSON.stringify(json));
                    if(json.recordsTotal==0){
                        //隐藏自己这个表格
                        //$("#waitSendCarReviewRow").hide();
                    }

                    heightInit();
                }
            });
        }

        //待出车出行表格
        var initTableWaitStartCar = function () {
            var table = $('#waitStartCar');
            var oTable = table.dataTable({
                "searching": false,//禁用分页
                "lengthChange": false,//禁止改变分页大小
                "info": true,//左下角信息禁用
                "paging": true,//禁用分页
                "processing": true,//显示加载进度条
                "serverSide": true,//开启服务器端处理数据，分页，获取数据等等
                "ajax":function (data, callback, settings) {
                    $.ajax({
                        "url":"getWaitStartCarTravels",
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
                    { "data": "user_company","defaultContent": "<i>暂无</i>" },

                    { "data": "driver_name","defaultContent": "<i>暂无</i>" },
                    { "data": "car_num","defaultContent": "<i>暂无</i>" },

                    { "data": "departure_time" ,"defaultContent": "<i>暂无</i>","render":function(data,type,full,meta){
                            if(data!=""&&data!=null){
                                return new Date(data*1000).format("yyyy-MM-dd hh:mm");
                            }

                        }},
                    { "data": "id","defaultContent": "<i>暂无</i>" ,"render":function (data,type,full,meta) {
                            var html = template(document.getElementById('startCar').innerHTML, full);
                            return html;
                        }},
                    { "data": "serial_number","defaultContent": "<i>暂无</i>" },
                    { "data": "from_place","defaultContent": "<i>暂无</i>" },
                    { "data": "to_place","defaultContent": "<i>暂无</i>" },
                    { "data": "people_num","defaultContent": "<i>暂无</i>" },
                    { "data": "travel_people","defaultContent": "<i>暂无</i>" },
                    { "data": "collecting_time","defaultContent": "<i>暂无</i>" ,"render":function(data,type,full,meta){
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
                "pageLength": 20,
                "dom": "<'row' <'col-md-12'B>><'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r><'table-scrollable't><'row'<'col-md-5 col-sm-12'><'col-md-7 col-sm-12'>>", // horizobtal scrollable datatable
                "initComplete":function (settings, json) {
                    //alert(JSON.stringify(json));
                    if(json.recordsTotal==0){
                        //隐藏自己这个表格
                        //$("#waitStartCarRow").hide();
                    }
                    heightInit();
                }
            });
        }


        //待完成出行表格
        var initTableWaitFinish=function () {
            var table = $('#waitFinish');
            var oTable = table.dataTable({
                "searching": false,//禁用分页
                "lengthChange": false,//禁止改变分页大小
                "info": true,//左下角信息禁用
                "paging": true,//禁用分页
                "processing": true,//显示加载进度条
                "serverSide": true,//开启服务器端处理数据，分页，获取数据等等
                "ajax":function (data, callback, settings) {
                    $.ajax({
                        "url":"getWaitFinishTravels",
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
                    { "data": "user_company","defaultContent": "<i>暂无</i>" },
                    { "data": "user_name","defaultContent": "<i>暂无</i>" },

                    { "data": "driver_name","defaultContent": "<i>暂无</i>" ,"render":function (data,type,full,meta) {
                        if(full.arrange_type_id==1){
                            return full.jj_driver_name;
                        }else{
                            return data;
                        }

                        }},
                    { "data": "car_num","defaultContent": "<i>暂无</i>" ,"render":function (data,type,full,meta) {
                            if(full.arrange_type_id==1){
                                return full.jj_car_num;
                            }else{
                                return data;
                            }

                        }},

                    { "data": "arrange_type_id","defaultContent": "<i>暂无</i>" ,"render":function (data,type,full,meta) {
                            if(full.arrange_type_id==1){
                                return "玖玖专车";
                            }else{
                                return "自有车辆";
                            }

                        }},

                    { "data": "id","defaultContent": "<i>暂无</i>" ,"render":function (data,type,full,meta) {
                            var html = template(document.getElementById('finishTravel').innerHTML, full);
                            return html;
                        }},
                    { "data": "serial_number","defaultContent": "<i>暂无</i>" },
                    { "data": "departure_time" ,"defaultContent": "<i>暂无</i>","render":function(data,type,full,meta){
                            if(data!=""&&data!=null){
                                return new Date(data*1000).format("yyyy-MM-dd hh:mm");
                            }

                        }},
                    { "data": "from_place","defaultContent": "<i>暂无</i>" },
                    { "data": "to_place","defaultContent": "<i>暂无</i>" },
                    { "data": "people_num","defaultContent": "<i>暂无</i>" },

                    { "data": "travel_people","defaultContent": "<i>暂无</i>" },
                    { "data": "collecting_time","defaultContent": "<i>暂无</i>" ,"render":function(data,type,full,meta){
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
                "pageLength": 20,
                "dom": "<'row' <'col-md-12'B>><'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r><'table-scrollable't><'row'<'col-md-5 col-sm-12'><'col-md-7 col-sm-12'>>", // horizobtal scrollable datatable
                "initComplete":function (settings, json) {
                    //alert(JSON.stringify(json));
                    if(json.recordsTotal==0){
                        //隐藏自己这个表格
                        //$("#waitFinishRow").hide();
                    }

                    heightInit();
                }
            });
        }

        //待费用计算出行
        var initTableWaitCharging=function () {
            var table = $('#waitCharging');
            var oTable = table.dataTable({
                "searching": false,//禁用分页
                "lengthChange": false,//禁止改变分页大小
                "info": true,//左下角信息禁用
                "paging": true,//禁用分页
                "processing": true,//显示加载进度条
                "serverSide": true,//开启服务器端处理数据，分页，获取数据等等
                "ajax":function (data, callback, settings) {
                    $.ajax({
                        "url":"getWaitChargingTravels",
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
                    { "data": "user_company","defaultContent": "<i>暂无</i>" },
                    { "data": "user_name","defaultContent": "<i>暂无</i>" },




                    { "data": "from_place","defaultContent": "<i>暂无</i>" },
                    { "data": "to_place","defaultContent": "<i>暂无</i>" },


                    { "data": "id","defaultContent": "<i>暂无</i>" ,"render":function (data,type,full,meta) {
                            var html = template(document.getElementById('charging').innerHTML, full);
                            return html;
                        }},
                    { "data": "serial_number","defaultContent": "<i>暂无</i>" },
                    { "data": "driver_name","defaultContent": "<i>暂无</i>" },
                    { "data": "car_num","defaultContent": "<i>暂无</i>" },
                    { "data": "departure_time" ,"defaultContent": "<i>暂无</i>","render":function(data,type,full,meta){
                            if(data!=""&&data!=null){
                                return new Date(data*1000).format("yyyy-MM-dd hh:mm");
                            }

                        }},
                    { "data": "people_num","defaultContent": "<i>暂无</i>" },
                    { "data": "travel_people","defaultContent": "<i>暂无</i>" },
                    { "data": "collecting_time","defaultContent": "<i>暂无</i>" ,"render":function(data,type,full,meta){
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
                "pageLength": 20,
                "dom": "<'row' <'col-md-12'B>><'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r><'table-scrollable't><'row'<'col-md-5 col-sm-12'><'col-md-7 col-sm-12'>>", // horizobtal scrollable datatable
                "initComplete":function (settings, json) {
                    //alert(JSON.stringify(json));
                    if(json.recordsTotal==0){
                        //隐藏自己这个表格
                        //$("#waitFinishRow").hide();
                    }

                    heightInit();
                }
            });
        }

        //待取消审核出行
        var initTableWaitCancel=function () {
            var table = $('#waitCancel');
            var oTable = table.dataTable({
                "searching": false,//禁用分页
                "lengthChange": false,//禁止改变分页大小
                "info": true,//左下角信息禁用
                "paging": true,//禁用分页
                "processing": true,//显示加载进度条
                "serverSide": true,//开启服务器端处理数据，分页，获取数据等等
                "ajax":function (data, callback, settings) {
                    $.ajax({
                        "url":"getWaitCancelTravels",
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
                    { "data": "user_company","defaultContent": "<i>暂无</i>" },
                    { "data": "user_name","defaultContent": "<i>暂无</i>" },

                    { "data": "from_place","defaultContent": "<i>暂无</i>" },
                    { "data": "to_place","defaultContent": "<i>暂无</i>" },

                    { "data": "departure_time" ,"defaultContent": "<i>暂无</i>","render":function(data,type,full,meta){
                            if(data!=""&&data!=null){
                                return new Date(data*1000).format("yyyy-MM-dd hh:mm");
                            }

                        }},
                    { "data": "id","defaultContent": "<i>暂无</i>" ,"render":function (data,type,full,meta) {
                            var html = template(document.getElementById('cancelTools').innerHTML, full);
                            return html;
                        }},
                    { "data": "serial_number","defaultContent": "<i>暂无</i>" },

                    { "data": "driver_name","defaultContent": "<i>暂无</i>" },
                    { "data": "car_num","defaultContent": "<i>暂无</i>" },


                    { "data": "people_num","defaultContent": "<i>暂无</i>" },
                    { "data": "travel_people","defaultContent": "<i>暂无</i>" },
                    { "data": "collecting_time","defaultContent": "<i>暂无</i>" ,"render":function(data,type,full,meta){
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
                "pageLength": 20,
                "dom": "<'row' <'col-md-12'B>><'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r><'table-scrollable't><'row'<'col-md-5 col-sm-12'><'col-md-7 col-sm-12'>>", // horizobtal scrollable datatable
                "initComplete":function (settings, json) {
                    //alert(JSON.stringify(json));
                    if(json.recordsTotal==0){
                        //隐藏自己这个表格
                        //$("#waitFinishRow").hide();
                    }

                    heightInit();
                }
            });
        }

        //当日已完成出行表格
        var initTableFinishNow=function () {
            var table = $('#finishNow');
            var oTable = table.dataTable({
                "searching": false,//禁用分页
                "lengthChange": false,//禁止改变分页大小
                "info": true,//左下角信息禁用
                "paging": true,//禁用分页
                "processing": true,//显示加载进度条
                "serverSide": true,//开启服务器端处理数据，分页，获取数据等等
                "ajax":function (data, callback, settings) {
                    $.ajax({
                        "url":"getFinishNow",
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
                    { "data": "driver_name","defaultContent": "<i>暂无</i>" ,"render":function (data,type,full,meta) {
                            if(full.arrange_type_id==1){
                                return full.jj_driver_name;
                            }else{
                                return data;
                            }

                        }},
                    { "data": "car_num","defaultContent": "<i>暂无</i>" ,"render":function (data,type,full,meta) {
                            if(full.arrange_type_id==1){
                                return full.jj_car_num;
                            }else{
                                return data;
                            }

                        }},

                    { "data": "arrange_type_id","defaultContent": "<i>暂无</i>" ,"render":function (data,type,full,meta) {
                            if(full.arrange_type_id==1){
                                return "玖玖专车";
                            }else{
                                return "自有车辆";
                            }

                        }},

                    { "data": "id","finishied": "<i>暂无</i>" ,"render":function (data,type,full,meta) {
                            var html = template(document.getElementById('finishied').innerHTML, full);
                            return html;
                        }},
                    { "data": "from_place","defaultContent": "<i>暂无</i>" },
                    { "data": "to_place","defaultContent": "<i>暂无</i>" },


                    { "data": "departure_time" ,"defaultContent": "<i>暂无</i>","render":function(data,type,full,meta){
                            if(data!=""&&data!=null){
                                return new Date(data*1000).format("yyyy-MM-dd hh:mm");
                            }

                        }},
                    { "data": "people_num","defaultContent": "<i>暂无</i>" },
                    { "data": "travel_people","defaultContent": "<i>暂无</i>" },
                    { "data": "collecting_time","defaultContent": "<i>暂无</i>" ,"render":function(data,type,full,meta){
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
                "pageLength": 20,
                "dom": "<'row' <'col-md-12'B>><'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r><'table-scrollable't><'row'<'col-md-5 col-sm-12'><'col-md-7 col-sm-12'>>", // horizobtal scrollable datatable
                "initComplete":function (settings, json) {
                    //alert(JSON.stringify(json));
                    if(json.recordsTotal==0){
                        //隐藏自己这个表格
                        //$("#waitFinishRow").hide();
                    }

                    heightInit();
                }
            });


        }


        //高度设置
        var heightInit=function () {
            var height=$(".leftBox").height()>$(".rightBox").height()?$(".leftBox").height():$(".rightBox").height();
            $(".page-content").css("height",height+30+120);
        }
        return {
            init: function () {
                if (!jQuery().dataTable) {
                    return;
                }
                initTableWaitReview();
                initTableWaitSendCar();
                initTableSendCarReview();
                initTableWaitStartCar();
                initTableWaitFinish();
                initTableWaitCharging();
                initTableWaitCancel();
                initTableFinishNow();
            }
        };
    }();



    //从服务器获取数据,并且处理数据
    function getData() {
        $.post("<?php echo U('Admin/Travel/getNum');?>
",
            {},
            function(data){
                $("#num1").html(data.num1);
                $("#num2").html(data.num2);
                $("#num3").html(data.num3);
                $("#num4").html(data.num4);
                $("#num5").html(data.num5);
                $("#num6").html(data.num6);
            },
            'json'
        );
    }


    jQuery(document).ready(function() {
        TableDatatablesResponsive.init();//待审核出行表格初始化
        //SweetAlert.init();


        getData();//获取数据
        timer=setInterval(getData,30*1000);//每隔30秒，获取一次数据



        //查看出行
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


        //核算费用
        $('tbody').on( 'click', 'td .chargingTravel', function () {
            var TravelId=$(this).attr("data-id");
            //加载模态框，直接模态框操作
            layer.open({
                type: 2,
                title:"核算费用",
                area: ['1090px', '750px'],
                fixed: false, //不固定
                maxmin: true,
                content: '/index.php/Admin/Travel/chargingTravel/id/'+TravelId
            });
        })

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

        //注册派遣自有车辆点击事件
        $('#waitSendCar tbody').on( 'click', 'td .sendCar', function (){
            var TravelId=$(this).attr("data-id");

            layer.open({
                type: 2,
                title:"派遣自有车辆",
                area: ['600px', '450px'],
                fixed: false, //不固定
                maxmin: true,
                content: '/index.php/Admin/Travel/sendCar/id/'+TravelId
            });
        });


        //注册派遣第三方车辆点击事件
        $('#waitSendCar tbody').on( 'click', 'td .sendCarToOther', function (){
            var TravelId=$(this).attr("data-id");
            layer.open({
                type: 2,
                title:"派遣第三方车辆",
                area: ['600px', '450px'],
                fixed: false, //不固定
                maxmin: true,
                content: '/index.php/Admin/Travel/sendCarToOther/id/'+TravelId
            });

        });


        //注册改派点击事件reassignment
        $('tbody').on( 'click', 'td .reassignment', function (){
            var TravelId=$(this).attr("data-id");
            //alert(TravelId);
            //return;
            layer.open({
                type: 2,
                title:"改派自有车辆",
                area: ['600px', '450px'],
                fixed: false, //不固定
                maxmin: true,
                content: '/index.php/Admin/Travel/reassignment/id/'+TravelId
            });
        });




        //注册出车点击事件
        $('#waitStartCar tbody').on( 'click', 'td .startCar', function () {
            //alert($(this).attr("data-id"));
            var TravelId=$(this).attr("data-id");
            swal({
                    title: "确定出车吗？",
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
                        $.post("/index.php/Admin/Travel/startCar.html",
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
                    }else {
                        swal("取消操作", "", "error");
                    }
                });
        })

        $('#waitFinish tbody').on( 'click', 'td .finishTravel', function (){
            var TravelId=$(this).attr("data-id");

            layer.open({
                type: 2,
                title:"完成服务",
                area: ['1050px', '450px'],
                fixed: false, //不固定
                maxmin: true,
                content: '/index.php/Admin/Travel/finishTravel/id/'+TravelId
            });

        })


        //注册派车审核通过事件
        $('#waitSendCarReview tbody').on( 'click', 'td .agreeSendCar', function () {
            //alert($(this).attr("data-id"));
            var TravelId=$(this).attr("data-id");
            swal({
                    title: "确定通过此派车信息吗？",
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
                        $.post("/index.php/Admin/Travel/sendCarReviewDo.html",
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

        //注册驳回取消点击事件
        $('#waitSendCarReview tbody').on( 'click', 'td .disagreeSendCar', function () {
            //alert($(this).attr("data-id"));
            var TravelId=$(this).attr("data-id");
            swal({
                    title: "确定驳回此派车出行吗？",
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
                                    $.post("/index.php/Admin/Travel/sendCarReviewDo.html",
                                        {
                                            id:TravelId,
                                            type:2,
                                            cancel_res:result
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


        //注册取消出行审核通过点击事件
        $('#waitCancel tbody').on( 'click', 'td .agreeCancel', function () {
            //alert($(this).attr("data-id"));
            var TravelId=$(this).attr("data-id");
            swal({
                    title: "确定通过此取消申请吗？",
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
                        $.post("/index.php/Admin/Travel/cancelTravelDo.html",
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


        //派车后取消出行
        $('tbody').on( 'click', 'td .adminCancelTravel', function () {
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
                        //此处进行审核操作AJAX
                        $.post("/index.php/Admin/Travel/adminCancelTravel.html",
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
                    }else {
                        swal("取消操作", "", "error");
                    }
                });
        })

        //注册驳回取消点击事件
        $('#waitCancel tbody').on( 'click', 'td .disagreeCancel', function () {
            //alert($(this).attr("data-id"));
            var TravelId=$(this).attr("data-id");
            swal({
                    title: "确定驳回此取消申请吗？",
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
                                    $.post("/index.php/Admin/Travel/cancelTravelDo.html",
                                        {
                                            id:TravelId,
                                            type:2,
                                            cancel_res:result
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
            <li>
                <a href="javascript:;" class="agreeTravel" data-id="<<?php ?>%=id%<?php ?>>"><i class="fa fa-file-pdf-o"></i> 审核通过 </a>
            </li>
            <li>
                <a href="javascript:;" class="disagreeTravel" data-id="<<?php ?>%=id%<?php ?>>"><i class="fa fa-file-excel-o"></i> 驳回申请 </a>
            </li>
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
                <a href="javascript:;" class="sendCar" data-id="<<?php ?>%=id%<?php ?>>"><i class="fa fa-file-pdf-o"></i> 派遣自有车辆 </a>
            </li>
            <li>
                <a href="javascript:;" class="sendCarToOther" data-id="<<?php ?>%=id%<?php ?>>"><i class="fa fa-file-pdf-o"></i> 派遣第三方车辆 </a>
            </li>
            <li>
                <a href="javascript:;" class="adminCancelTravel" data-id="<<?php ?>%=id%<?php ?>>"><i class="fa fa-file-pdf-o"></i> 取消 </a>
            </li>
        </ul>
    </div>
</script>

<!--审核派车操作tools-->
<script id="reviewSendCar" type="text/html">
    <div class="btn-group pull-right">
        <button class="btn green btn-xs btn-outline dropdown-toggle" data-toggle="dropdown">操作
            <i class="fa fa-angle-down"></i>
        </button>
        <ul class="dropdown-menu pull-right">
            <li>
                <a href="javascript:;" class="viewTravel" data-id="<<?php ?>%=id%<?php ?>>"><i class="fa fa-print"></i> 查看 </a>
            </li>
            <li>
                <a href="javascript:;" class="agreeSendCar" data-id="<<?php ?>%=id%<?php ?>>"><i class="fa fa-file-pdf-o"></i> 审核通过 </a>
            </li>
            <li>
                <a href="javascript:;" class="disagreeSendCar" data-id="<<?php ?>%=id%<?php ?>>"><i class="fa fa-file-excel-o"></i> 驳回 </a>
            </li>
        </ul>
    </div>
</script>


<!--出车操作Tools-->
<script id="startCar" type="text/html">
    <div class="btn-group pull-right">
        <button class="btn green btn-xs btn-outline dropdown-toggle" data-toggle="dropdown">操作
            <i class="fa fa-angle-down"></i>
        </button>
        <ul class="dropdown-menu pull-right">
            <li>
                <a href="javascript:;" class="viewTravel" data-id="<<?php ?>%=id%<?php ?>>"><i class="fa fa-print"></i> 查看 </a>
            </li>
            <li>
                <a href="javascript:;" class="startCar" data-id="<<?php ?>%=id%<?php ?>>"><i class="fa fa-file-pdf-o"></i> 出车 </a>
            </li>
            <<?php ?>%if (arrange_type_id!=1) { %<?php ?>>
            <li>
                <a href="javascript:;" class="reassignment" data-id="<<?php ?>%=id%<?php ?>>"><i class="fa fa-file-pdf-o"></i> 改派 </a>
            </li>
            <<?php ?>% } %<?php ?>>
            <li>
                <a href="javascript:;" class="adminCancelTravel" data-id="<<?php ?>%=id%<?php ?>>"><i class="fa fa-file-pdf-o"></i> 取消 </a>
            </li>
        </ul>
    </div>
</script>


<!--完成服务Tools-->
<script id="finishTravel" type="text/html">
    <div class="btn-group pull-right">
        <button class="btn green btn-xs btn-outline dropdown-toggle" data-toggle="dropdown">操作
            <i class="fa fa-angle-down"></i>
        </button>
        <ul class="dropdown-menu pull-right">
            <li>
                <a href="javascript:;" class="viewTravel" data-id="<<?php ?>%=id%<?php ?>>"><i class="fa fa-print"></i> 查看 </a>
            </li>


            <<?php ?>%if (arrange_type_id!=1) { %<?php ?>>
            <li>
                <a href="javascript:;" class="reassignment" data-id="<<?php ?>%=id%<?php ?>>"><i class="fa fa-file-pdf-o"></i> 改派 </a>
            </li>
            <<?php ?>% } %<?php ?>>


            <li>
                <a href="javascript:;" class="finishTravel" data-id="<<?php ?>%=id%<?php ?>>"><i class="fa fa-file-pdf-o"></i> 完成服务 </a>
            </li>
            <li>
                <a href="javascript:;" class="adminCancelTravel" data-id="<<?php ?>%=id%<?php ?>>"><i class="fa fa-file-pdf-o"></i> 取消 </a>
            </li>

        </ul>
    </div>
</script>


<!--费用核算-->
<script id="charging" type="text/html">
    <div class="btn-group pull-right">
        <button class="btn green btn-xs btn-outline dropdown-toggle" data-toggle="dropdown">操作
            <i class="fa fa-angle-down"></i>
        </button>
        <ul class="dropdown-menu pull-right">
            <li>
                <a href="javascript:;" class="viewTravel" data-id="<<?php ?>%=id%<?php ?>>"><i class="fa fa-print"></i> 查看 </a>
            </li>
            <li>
                <a href="javascript:;" class="chargingTravel" data-id="<<?php ?>%=id%<?php ?>>"><i class="fa fa-file-pdf-o"></i> 核算费用 </a>
            </li>
        </ul>
    </div>
</script>

<!--待取消出行Tools-->
<script id="cancelTools" type="text/html">
    <div class="btn-group pull-right">
        <button class="btn green btn-xs btn-outline dropdown-toggle" data-toggle="dropdown">操作
            <i class="fa fa-angle-down"></i>
        </button>
        <ul class="dropdown-menu pull-right">
            <li>
                <a href="javascript:;" class="viewTravel" data-id="<<?php ?>%=id%<?php ?>>"><i class="fa fa-print"></i> 查看 </a>
            </li>
            <li>
                <a href="javascript:;" class="agreeCancel" data-id="<<?php ?>%=id%<?php ?>>"><i class="fa fa-file-pdf-o"></i> 审核通过 </a>
            </li>
            <li>
                <a href="javascript:;" class="disagreeCancel" data-id="<<?php ?>%=id%<?php ?>>"><i class="fa fa-file-excel-o"></i> 驳回申请 </a>
            </li>
        </ul>
    </div>
</script>



<!--当日已经完成-->
<script id="finishied" type="text/html">
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
<?php }} ?>