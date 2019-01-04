<?php /* Smarty version Smarty-3.1.6, created on 2018-12-13 09:35:47
         compiled from "D:/xampp/htdocs/Admin/View\Travel\sendCar.html" */ ?>
<?php /*%%SmartyHeaderCode:43325bee66c4bc7262-17600842%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '3555d054fa76dafa69b113d2bebf77a1507f9865' => 
    array (
      0 => 'D:/xampp/htdocs/Admin/View\\Travel\\sendCar.html',
      1 => 1543804936,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '43325bee66c4bc7262-17600842',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.6',
  'unifunc' => 'content_5bee66c4d51b4',
  'variables' => 
  array (
    'travel' => 0,
    'carTypes' => 0,
    'v' => 0,
    'drivers' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5bee66c4d51b4')) {function content_5bee66c4d51b4($_smarty_tpl) {?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>派遣车辆</title>


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
                    <form class="form-horizontal" role="form" action="/index.php/Admin/Travel/sendCarDo" method="post" id="addCarForm">
                        <input type="hidden" name="id" value="<?php echo $_smarty_tpl->tpl_vars['travel']->value['id'];?>
" id="id">
                        <div class="form-body">



                            <div class="form-group col-md-12">
                                <label class="col-md-4 control-label">车辆类型</label>
                                <div class="col-md-8">
                                    <select class="form-control input-inline input-medium" name="car_type" id="car_type">
                                        <?php  $_smarty_tpl->tpl_vars['v'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['v']->_loop = false;
 $_smarty_tpl->tpl_vars['k'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['carTypes']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['v']->key => $_smarty_tpl->tpl_vars['v']->value){
$_smarty_tpl->tpl_vars['v']->_loop = true;
 $_smarty_tpl->tpl_vars['k']->value = $_smarty_tpl->tpl_vars['v']->key;
?>
                                        <option value="<?php echo $_smarty_tpl->tpl_vars['v']->value['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['v']->value['type_name'];?>
</option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>


                            <div class="form-group col-md-12">
                                <label class="col-md-4 control-label">车辆</label>
                                <div class="col-md-8">
                                    <select class="form-control input-inline input-medium" name="car_id" id="car">

                                    </select>
                                </div>
                            </div>


                            <div class="form-group col-md-12">
                                <label class="col-md-4 control-label">司机</label>
                                <div class="col-md-8">
                                    <select class="form-control input-inline input-medium" name="driver_id" id="driver">
                                        <?php  $_smarty_tpl->tpl_vars['v'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['v']->_loop = false;
 $_smarty_tpl->tpl_vars['k'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['drivers']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['v']->key => $_smarty_tpl->tpl_vars['v']->value){
$_smarty_tpl->tpl_vars['v']->_loop = true;
 $_smarty_tpl->tpl_vars['k']->value = $_smarty_tpl->tpl_vars['v']->key;
?>
                                        <option value="<?php echo $_smarty_tpl->tpl_vars['v']->value['id'];?>
" data-dx="<?php echo $_smarty_tpl->tpl_vars['v']->value['is_dx'];?>
"><?php echo $_smarty_tpl->tpl_vars['v']->value['driver_name'];?>
<?php if ($_smarty_tpl->tpl_vars['v']->value['is_dx']=="1"){?>(定向)<?php }?></option>
                                        <?php } ?>
                                    </select>
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

    $(document).ready(function(){

        var id =$('#car_type').children().eq(0).val();
        var travelId=$("#id").val();
        getCarList(id,travelId);


        //监听select事件
        $('#car_type').change(function(){
            var sid =$(this).children('option:selected').val();

            var id =$('#car_type').children().eq(0).val();
            var travelId=$("#id").val();

            getCarList(sid,travelId);
        });

        //监听select事件
        $('#car').change(function(){
            var sid =$(this).children('option:selected').val();
            if(sid>0){
                var is_dx =$(this).children('option:selected').attr("data-dx");
                if(is_dx==1){
                    var driver =$(this).children('option:selected').attr("data-driver");
                    $.post("/index.php/Admin/Travel/getFreeDriver",{ dx:1,driverId:driver },function(result){
                        appendDriver(result);
                    });
                }else{
                    $.post("/index.php/Admin/Travel/getFreeDriver",{ dx:0 },function(result){
                        appendDriver(result);
                    });
                }
            }

            // if(sid>0){
            //     var is_dx =$(this).children('option:selected').attr("data-dx");
            //     if(is_dx==1){
            //         //选择了定向车辆
            //         var driver =$(this).children('option:selected').attr("data-driver");
            //         $($("#driver").children()).each(function(){
            //             //alert($(this).text())
            //             $(this).removeAttr('selected');
            //             $(this).removeAttr('disabled');
            //
            //             if($(this).val()==driver){
            //                 $(this).attr('selected',true);
            //             }else{
            //                 $(this).attr('disabled','');
            //             }
            //         });
            //     }else{
            //
            //         $($("#driver").children()).each(function(){
            //             $(this).removeAttr('selected');
            //             $(this).removeAttr('disabled');
            //
            //             if($(this).attr("data-dx")==1){
            //                 $(this).attr('disabled','');
            //             }else{
            //
            //             }
            //         });
            //     }
            // }


        });


    });


    function getCarList(id,travelId){
        //alert(id);
        $.post("/index.php/Admin/Travel/getFreeCar",{ type_id:id,travelId:travelId },function(result){
            //$("span").html(result);
            $("#car").empty();
            $("#car").append("<option value='0'>请选择车辆</option>");
            for(var i=0;i<result.length;i++){
                //console.log(result[i].id);
                if(result[i].is_dx==1){
                    $("#car").append("<option value='"+result[i].id+"' data-dx='1' data-driver='"+result[i].driver_id+"'>"+result[i].car_num+"(定向)</option>");
                }else{
                    $("#car").append("<option value='"+result[i].id+"' data-dx='0'>"+result[i].car_num+"</option>");
                }
            }
        });
    }

    function appendDriver(result){
        $("#driver").empty();

        if(result[0].is_dx==0) {
            $("#driver").append("<option value='0'>请选择司机</option>");
        }

        for(var i=0;i<result.length;i++){
            //console.log(result[i].id);
            if(result[i].is_dx==1){
                $("#driver").append("<option value='"+result[i].id+"' data-dx='1'>"+result[i].driver_name+"(定向)</option>");
            }else{
                $("#driver").append("<option value='"+result[i].id+"' data-dx='0'>"+result[i].driver_name+"</option>");
            }
        }
    }


    $("#addCarForm").submit(function () {

        //校验数据
        //toastr.error('Are you the 6 fingered man?');
        if(($("#car").val()==0)){ toastr.error('请选择车辆！');  return false; }
        if(($("#driver").val()==0)){ toastr.error('请选择司机！');  return false; }

        $(this).ajaxSubmit(function (data) {
            if(data.code==1){
                layer.msg('派车成功!', { icon: 1 });
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