<?php /* Smarty version Smarty-3.1.6, created on 2018-12-19 16:30:40
         compiled from "D:/xampp/htdocs/Admin/View\Car\addOilRecord.html" */ ?>
<?php /*%%SmartyHeaderCode:6745c05e1e6281763-05722852%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'abc7a8d6f036fcc1349ce3532afdaf6385372d47' => 
    array (
      0 => 'D:/xampp/htdocs/Admin/View\\Car\\addOilRecord.html',
      1 => 1545190528,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '6745c05e1e6281763-05722852',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.6',
  'unifunc' => 'content_5c05e1e64563d',
  'variables' => 
  array (
    'oilRecord' => 0,
    'cars' => 0,
    'v' => 0,
    'shops' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5c05e1e64563d')) {function content_5c05e1e64563d($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_date_format')) include 'D:\\xampp\\htdocs\\ThinkPHP\\Library\\Vendor\\Smarty\\plugins\\modifier.date_format.php';
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>新增加油记录</title>


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
<body class="page-header-fixed page-sidebar-closed-hide-logo page-content-white"  style="background: #FFFFFF;">
<div class="page-wrapper">
    <div class="page-content">
        <div>
            <div class="portlet light">
                <div class="portlet-body form">
                <form class="form-horizontal" role="form" action="/index.php/Admin/Car/addOilRecordDo" method="post" id="addCarForm">
                    <input type="hidden" name="id" value="<?php echo $_smarty_tpl->tpl_vars['oilRecord']->value['id'];?>
">

                    <div class="form-body">

                        <div class="form-group col-md-6">
                            <label class="col-md-4 control-label">车牌号码</label>
                            <div class="col-md-8">
                                <select class="form-control input-inline input-medium" name="car_id">
                                    <?php  $_smarty_tpl->tpl_vars['v'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['v']->_loop = false;
 $_smarty_tpl->tpl_vars['k'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['cars']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['v']->key => $_smarty_tpl->tpl_vars['v']->value){
$_smarty_tpl->tpl_vars['v']->_loop = true;
 $_smarty_tpl->tpl_vars['k']->value = $_smarty_tpl->tpl_vars['v']->key;
?>
                                    <option value="<?php echo $_smarty_tpl->tpl_vars['v']->value['id'];?>
" <?php if ($_smarty_tpl->tpl_vars['oilRecord']->value['car_id']==$_smarty_tpl->tpl_vars['v']->value['id']){?>selected = "selected"<?php }?> ><?php echo $_smarty_tpl->tpl_vars['v']->value['car_num'];?>
</option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>


                        <div class="form-group col-md-6">
                            <label class="col-md-4 control-label">加油站</label>
                            <div class="col-md-8">
                                <select class="form-control input-inline input-medium" name="oil_shop_id">
                                    <?php  $_smarty_tpl->tpl_vars['v'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['v']->_loop = false;
 $_smarty_tpl->tpl_vars['k'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['shops']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['v']->key => $_smarty_tpl->tpl_vars['v']->value){
$_smarty_tpl->tpl_vars['v']->_loop = true;
 $_smarty_tpl->tpl_vars['k']->value = $_smarty_tpl->tpl_vars['v']->key;
?>
                                    <option value="<?php echo $_smarty_tpl->tpl_vars['v']->value['id'];?>
" <?php if ($_smarty_tpl->tpl_vars['oilRecord']->value['oil_shop_id']==$_smarty_tpl->tpl_vars['v']->value['id']){?>selected = "selected"<?php }?> ><?php echo $_smarty_tpl->tpl_vars['v']->value['oil_name'];?>
</option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group col-md-6">
                            <label class="col-md-4 control-label">加油量</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control input-inline input-medium" placeholder="加油量（单位升）" name="fuel_charge" id="fuel_charge" value="<?php echo $_smarty_tpl->tpl_vars['oilRecord']->value['fuel_charge'];?>
">
                            </div>
                        </div>

                        <div class="form-group col-md-6">
                            <label class="col-md-4 control-label">油耗</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control input-inline input-medium" placeholder="百公里油耗（升）" name="oil_wear" id="oil_wear" value="<?php echo $_smarty_tpl->tpl_vars['oilRecord']->value['oil_wear'];?>
">
                            </div>
                        </div>

                        <div class="form-group col-md-6">
                            <label class="col-md-4 control-label">加油花费</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control input-inline input-medium" placeholder="加油花费" name="cost" id="cost" value="<?php echo $_smarty_tpl->tpl_vars['oilRecord']->value['cost'];?>
">
                            </div>
                        </div>



                        <div class="form-group col-md-6">
                            <label class="col-md-4 control-label">卡号</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control input-inline input-medium" placeholder="卡号" name="card_num" id="card_num" value="<?php echo $_smarty_tpl->tpl_vars['oilRecord']->value['card_num'];?>
">
                            </div>
                        </div>

                        <div class="form-group col-md-6">
                            <label class="col-md-4 control-label">POS号</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control input-inline input-medium" placeholder="POS号" name="pos_num" id="pos_num" value="<?php echo $_smarty_tpl->tpl_vars['oilRecord']->value['pos_num'];?>
">
                            </div>
                        </div>

                        <div class="form-group col-md-6">
                            <label class="col-md-4 control-label">流水号</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control input-inline input-medium" placeholder="流水号" name="serial_number" id="serial_number" value="<?php echo $_smarty_tpl->tpl_vars['oilRecord']->value['serial_number'];?>
">
                            </div>
                        </div>



                        <div class="form-group col-md-6">
                            <label class="col-md-4 control-label">加油时间</label>
                            <div class="col-md-8">
                            <div class="input-group date form_datetime input-medium" data-date="" data-date-format="yyyy-mm-dd" data-link-field="wash_time">
                                <input name="trading_time" id="trading_time" class="form-control" size="16" type="text" value="<?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['oilRecord']->value['trading_time'],'%Y-%m-%d');?>
" readonly>
                                <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                                <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                            </div>
                            </div>
                        </div>


                    </div>
                    <div class="form-actions col-md-12">
                        <div class="row">
                            <div class="col-md-offset-5 col-md-7">
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
    });


    $("#addCarForm").submit(function () {

        //校验数据
        //toastr.error('Are you the 6 fingered man?');
        if(isE($("#cost").val())){ toastr.error('洗车花费不得为空！');  $("#cost").focus();return false; }

        if(isNaN($("#cost").val())){ toastr.error('洗车花费只能为数字！');  $("#cost").focus();return false; }

        //if(isE($("wash_time").val())){ toastr.error('洗车时间不得为空！');  $("#wash_time").focus();return false; }


        $(this).ajaxSubmit(function (data) {
            if(data.code==1){
                layer.msg(data.msg, { icon: 1 });
                setTimeout("window.parent.location.reload()",2000);
            }else{
                layer.msg('提交失败，请重试!', { icon: 0 });
            }
        });
        return false;
    })




</script>
</html>


<?php }} ?>