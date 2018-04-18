$(document)
.on('click','.collapse-toggle', function(){
	$('#' + this.getAttribute('data-target')).slideToggle();
})
.on('click', '.show-old-treatments', function(){
	$(this).remove();
	$('#old-treatments').slideDown(300);
})
 