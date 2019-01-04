<?php /* Smarty version Smarty-3.1.6, created on 2018-08-09 11:25:00
         compiled from "E:/PhpStorm/yxcar/Home/View\Travel\evaluateTravel.html" */ ?>
<?php /*%%SmartyHeaderCode:276285b6bb40ca0d5c8-62275847%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b27b48d9f120b257453ffa5bb7658504c6761dd1' => 
    array (
      0 => 'E:/PhpStorm/yxcar/Home/View\\Travel\\evaluateTravel.html',
      1 => 1528134786,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '276285b6bb40ca0d5c8-62275847',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'travel' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.6',
  'unifunc' => 'content_5b6bb40caf947',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5b6bb40caf947')) {function content_5b6bb40caf947($_smarty_tpl) {?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>评价出行</title>


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

</head>
<body class="page-header-fixed page-sidebar-closed-hide-logo page-content-white" style="background: #FFFFFF;">
<div class="page-wrapper">
    <div class="page-content">
        <div class="row">
            <div class="portlet light" style="padding: 0px 35px 20px 35px;">
                <div class="portlet-body form">
                    <form class="form-horizontal" role="form" action="/index.php/Home/Travel/evaluateTravelDo" method="post" id="addCarTypeForm">
                        <input type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['travel']->value['id'];?>
" name="id">
                        <div class="form-body">
                            <div class="form-group">
                                <label class="col-md-3 control-label">总体评价</label>
                                <div class="col-md-9">
                                    <div id="attitude"></div><input id="attitude_input" type="hidden" name="attitude">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label">您的意见</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control input-inline input-medium" placeholder="您的意见"  name="evaluate" id="evaluate">
                                </div>
                            </div>
                        </div>

                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-offset-3 col-md-9">
                                    <button type="submit" class="btn green" >提交</button>
                                    <button type="button" class="btn default" onClick="layer_close();">取消</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
<script src="<?php echo @PUBLIC_URL;?>
/assets/global/plugins/jquery.min.js" type="text/javascript"></script>
<script src="<?php echo @PUBLIC_URL;?>
/assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>

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
<script src="<?php echo @PUBLIC_URL;?>
/assets/global/plugins/clockface/js/clockface.js" type="text/javascript"></script>
<script src="<?php echo @PUBLIC_URL;?>
/js/jquery.form.js" type="text/javascript"></script>
<script src="<?php echo @PUBLIC_URL;?>
/assets/global/plugins/bootstrap-toastr/toastr.min.js" type="text/javascript"></script>
<script src="<?php echo @PUBLIC_URL;?>
/js/js.js" type="text/javascript"></script>
<script src="<?php echo @PUBLIC_URL;?>
/plugin/layer/layer.js" type="text/javascript"></script>

<script>
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




    $("#addCarTypeForm").submit(function () {

        //校验数据
        //toastr.error('Are you the 6 fingered man?');
        if(isE($("#attitude_input").val())){ toastr.error('请给出您的评价！');  $("#type_name").focus();return false; }


        $(this).ajaxSubmit(function (data) {
            if(data.code==1){
                layer.msg('新增成功!', { icon: 1 });
                setTimeout("window.parent.location.reload()",2000);
            }else{
                layer.msg('提交失败，请重试!', { icon: 0 });
            }
        });
        return false;
    })




</script>

<script src="<?php echo @PUBLIC_URL;?>
js/jquery.raty.min.js"></script>
<script>
    $('#attitude').raty({
        size     : 24,
        starHalf : '<?php echo @PUBLIC_URL;?>
img/star-half-big.png',
        starOff  : '<?php echo @PUBLIC_URL;?>
img/star-off-big.png',
        starOn   : '<?php echo @PUBLIC_URL;?>
img/star-on-big.png',
        target: '#attitude_input',
        targetType: 'number',
        targetKeep: true
    });
</script>
</html>


<?php }} ?>