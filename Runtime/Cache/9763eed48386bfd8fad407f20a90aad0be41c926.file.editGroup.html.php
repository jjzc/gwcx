<?php /* Smarty version Smarty-3.1.6, created on 2018-12-13 14:51:27
         compiled from "D:/xampp/htdocs/Admin/View\UserCenter\editGroup.html" */ ?>
<?php /*%%SmartyHeaderCode:86175c12016fc1fb96-61760761%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '9763eed48386bfd8fad407f20a90aad0be41c926' => 
    array (
      0 => 'D:/xampp/htdocs/Admin/View\\UserCenter\\editGroup.html',
      1 => 1543804938,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '86175c12016fc1fb96-61760761',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'group' => 0,
    'roles' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.6',
  'unifunc' => 'content_5c12016fd489d',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5c12016fd489d')) {function content_5c12016fd489d($_smarty_tpl) {?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>新增分组</title>


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




    <link href="<?php echo @PUBLIC_URL;?>
/css/bootstrapStyle/bootstrapStyle.css" rel="stylesheet" type="text/css" />




</head>
<body class="page-header-fixed page-sidebar-closed-hide-logo page-content-white"  style="background: #FFFFFF;">
<div class="page-wrapper">
    <div class="page-content">
        <div>
            <div class="portlet light">
                <div class="portlet-body form">
                <form class="form-horizontal" role="form" action="/index.php/Admin/UserCenter/editGroupDo" method="post" id="addCarForm">
                    <input type="hidden" id="id" value="<?php echo $_smarty_tpl->tpl_vars['group']->value['id'];?>
" name="id" />
                    <div class="form-body">

                        <div class="form-group col-md-6">
                            <label class="col-md-4 control-label">组别名称</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control input-inline input-medium" placeholder="组别名称" name="group_name" id="group_name" value="<?php echo $_smarty_tpl->tpl_vars['group']->value['group_name'];?>
">
                                <input type="hidden" id="group_rule" name="group_rule" />
                                <span style="color: #FF0000;">*</span>
                            </div>
                        </div>




                        <div class="form-group col-md-6">
                            <label class="col-md-4 control-label">权限列表</label>
                            <div class="col-md-8">
                                <ul id="treeDemo" class="ztree"></ul>
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

<script src="<?php echo @PUBLIC_URL;?>
/js/zTree/jquery.ztree.core.js" type="text/javascript"></script>
<script src="<?php echo @PUBLIC_URL;?>
/js/zTree/jquery.ztree.excheck.js" type="text/javascript"></script>
<script src="<?php echo @PUBLIC_URL;?>
/js/zTree/jquery.ztree.exedit.js" type="text/javascript"></script>




<script>
    var treeObj=null;

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
        if(isE($("#group_name").val())){ toastr.error('组别不得为空！');  $("#group_name").focus();return false; }


        var nodes = treeObj.getCheckedNodes(true);
        var idsArray=new Array();

        if(nodes.length==0){
            layer.msg('权限不能全为空!', { icon: 0 });return false;
        }


        for(var i=0;i<nodes.length;i++){
            //document.writeln(JSON.stringify(nodes[i]));
            idsArray[i]=nodes[i].id;
        }

        var role_ids = idsArray.join(",");//将数组变成字符串

        $("#group_rule").val(role_ids);

        //alert(role_ids);

        //return false;


        $(this).ajaxSubmit(function (data) {
            if(data.code==1){
                layer.msg('修改成功!', { icon: 1 });
                setTimeout("window.parent.location.reload()",2000);
            }else{
                layer.msg('提交失败，请重试!', { icon: 0 });
            }
        });
        return false;
    })



    //return '/index.php/Admin/UserCenter/getGroupTree';




</script>


<SCRIPT type="text/javascript">
    <!--
    var setting = {
        view: {
            selectedMulti: false
        },
        check: {
            enable: true
        },
        data: {
            simpleData: {
                enable: true
            }
        }
    };


    var zNodes=<?php echo $_smarty_tpl->tpl_vars['roles']->value;?>
;


    // var zNodes =[
    //     { id:1, pId:0, name:"[core] 基本功能 演示", open:true },
    //     { id:101, pId:1, name:"最简单的树 --  标准 JSON 数据" },
    //     { id:102, pId:1, name:"最简单的树 --  简单 JSON 数据" },
    //     { id:103, pId:1, name:"不显示 连接线" },
    //     { id:104, pId:1, name:"不显示 节点 图标" },
    //     { id:108, pId:1, name:"异步加载 节点数据" },
    //     { id:109, pId:1, name:"用 zTree 方法 异步加载 节点数据" },
    //     { id:110, pId:1, name:"用 zTree 方法 更新 节点数据" },
    //     { id:111, pId:1, name:"单击 节点 控制" },
    //     { id:112, pId:1, name:"展开 / 折叠 父节点 控制" },
    //     { id:113, pId:1, name:"根据 参数 查找 节点" },
    //     { id:114, pId:1, name:"其他 鼠标 事件监听" },
    //
    //     { id:2, pId:0, name:"[excheck] 复/单选框功能 演示", open:false },
    //     { id:201, pId:2, name:"Checkbox 勾选操作" },
    //     { id:206, pId:2, name:"Checkbox nocheck 演示" },
    //     { id:207, pId:2, name:"Checkbox chkDisabled 演示" },
    //     { id:208, pId:2, name:"Checkbox halfCheck 演示" },
    //
    //
    // ];

    $(document).ready(function(){
        treeObj=$.fn.zTree.init($("#treeDemo"), setting, zNodes);
    });


    //-->
</SCRIPT>


</html>


<?php }} ?>