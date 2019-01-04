<?php /* Smarty version Smarty-3.1.6, created on 2018-12-13 18:57:14
         compiled from "D:/xampp/htdocs/Admin/View\Travel\viewTravelTrack.html" */ ?>
<?php /*%%SmartyHeaderCode:50775c123b0a762af5-52227523%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '2448a869bbdde90442554709e22bd9b58307d53a' => 
    array (
      0 => 'D:/xampp/htdocs/Admin/View\\Travel\\viewTravelTrack.html',
      1 => 1543804936,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '50775c123b0a762af5-52227523',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'driverPoint' => 0,
    'UserPoint' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.6',
  'unifunc' => 'content_5c123b0a8ed3d',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5c123b0a8ed3d')) {function content_5c123b0a8ed3d($_smarty_tpl) {?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>查看出行轨迹</title>


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
        <div class="dispatchRight" id="dispatchRight" style="width: 100%; height: 700px;">

        </div>
    </div>
</div>







</body>
<script src="<?php echo @PUBLIC_URL;?>
/assets/global/plugins/jquery.min.js" type="text/javascript"></script>
<script src="<?php echo @PUBLIC_URL;?>
/assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>

<script type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak=tgXj9S1lLWl0ie7vGx3oYNzQkM3rLbO0"></script>

<script>

    var map=null;
    var data=new Array();
    var data2=new Array();

    $(function() {

        map = new BMap.Map("dispatchRight");          // 创建地图实例
        var point = new BMap.Point(112.981797,28.23219);  // 创建点坐标
        map.addControl(new BMap.NavigationControl());
        map.addControl(new BMap.ScaleControl());
        map.addControl(new BMap.OverviewMapControl());
        map.enableScrollWheelZoom(true);

        //处理数据
        var driverData='<?php echo $_smarty_tpl->tpl_vars['driverPoint']->value;?>
';
        driverData=JSON.parse(driverData);

        var json=eval(driverData.points);
        for(var i=0;i<json.length;i++){
            //生成数组
            data.push([json[i].longitude,json[i].latitude])
        }

        showMap();


        //处理数据
        var userData='<?php echo $_smarty_tpl->tpl_vars['UserPoint']->value;?>
';
        userData=JSON.parse(userData);

        var json=eval(userData.points);
        for(var i=0;i<json.length;i++){
            //生成数组
            data2.push([json[i].longitude,json[i].latitude])
        }

        showMap2();



    });


    function showMap() {
        var abc = $(data);
        var chartData = [];
        $.each(abc, function (item, value) {
            chartData.push(new BMap.Point(value[0], value[1]));
        });

        //直接添加折现
        var polyline = new BMap.Polyline(chartData,{ strokeColor:"blue", strokeWeight:7, strokeOpacity:1 });
        map.addOverlay(polyline);


        //添加两个标注点
        map.centerAndZoom(chartData[0], 14);                 // 初始化地图，设置中心点坐标和地图级别


        addMarker(chartData[0],"sjcc");
        addMarker(chartData[chartData.length-1],"sjsc");

    }

    function showMap2() {
        var abc = $(data2);
        var chartData = [];
        $.each(abc, function (item, value) {
            chartData.push(new BMap.Point(value[0], value[1]));
        });

        //直接添加折现
        var polyline = new BMap.Polyline(chartData,{ strokeColor:"red", strokeWeight:3, strokeOpacity:1 });
        map.addOverlay(polyline);

        addMarker(chartData[0],"cksc");
        addMarker(chartData[chartData.length-1],"ckxc");
    }

    // 两个坐标点连线
    function showPath(startPoint, EndPoint,displayStartIcon,displayEndIcon){

        var walking = null;
        if(displayStartIcon && !displayEndIcon){ // 第一个起点只展示起点图标
            walking = new BMap.DrivingRoute(map, { renderOptions: { map: map, autoViewport: true },onMarkersSet:function(routes) { map.removeOverlay(routes[1].marker); } });
        }else if(!displayStartIcon && !displayEndIcon){
            walking = new BMap.DrivingRoute(map, { renderOptions: { map: map, autoViewport: true },onMarkersSet:function(routes) { map.removeOverlay(routes[0].marker);map.removeOverlay(routes[1].marker); } });
        }else{
            walking = new BMap.DrivingRoute(map, { renderOptions: { map: map, autoViewport: true },onMarkersSet:function(routes) { map.removeOverlay(routes[0].marker); } });
        }

        walking.search(startPoint, EndPoint);
    }


    function addMarker(point,imgName){  // 创建图标对象
        var myIcon = new BMap.Icon("/Public/images/"+imgName+".png", new BMap.Size(64, 64), {
            // 指定定位位置。
            // 当标注显示在地图上时，其所指向的地理位置距离图标左上
            // 角各偏移10像素和25像素。您可以看到在本例中该位置即是
            // 图标中央下端的尖角位置。
            anchor: new BMap.Size(32, 64)
            // 设置图片偏移。
            // 当您需要从一幅较大的图片中截取某部分作为标注图标时，您
            // 需要指定大图的偏移位置，此做法与css sprites技术类似。
            //imageOffset: new BMap.Size(0, 0 - index * 25)   // 设置图片偏移
        });
        // 创建标注对象并添加到地图
        var marker = new BMap.Marker(point,{ icon: myIcon });
        map.addOverlay(marker);
    }



</script>
</html>


<?php }} ?>