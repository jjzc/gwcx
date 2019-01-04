$(function() {
	var Accordion = function(el, multiple) {
		this.el = el || {};
		this.multiple = multiple || false;

		// Variables privadas
		var links = this.el.find('.link');
		// Evento
		links.on('click', {el: this.el, multiple: this.multiple}, this.dropdown)
	}

	Accordion.prototype.dropdown = function(e) {
		var $el = e.data.el;
			$this = $(this),
			$next = $this.next();

		$next.slideToggle();
		$this.parent().toggleClass('open');

		if (!e.data.multiple) {
			$el.find('.submenu').not($next).slideUp().parent().removeClass('open');
		};
	}	

	var accordion = new Accordion($('#accordion'), false);
});


function jumpurl(url){
	window.location.href=url;
}


function iskong(val){
	if(val=="" || val ==null || typeof(val)=="undefined"){
		return true;
	}else{
		return false;
	}

}


//防止表单重复提交
var flag=true;
function sub(){
    if(flag){
        flag=false;
        return true;
    }else{
        return false;
    }
}