$(document).on('click','.dismiss-alert', function(){
	$(this.offsetParent).slideUp('fast', function(){this.parentNode.removeChild(this)});
});