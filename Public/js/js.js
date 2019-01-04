function isE(str) {
    if(typeof(str) == "undefined"){
        return true;
    }else if(str==null||str==""){
        return true;
    }else{
        return false;
    }

}


function layer_close() {
    var index = parent.layer.getFrameIndex(window.name); //先得到当前iframe层的索引
    parent.layer.close(index); //再执行关闭
}