$(document).on('click', '[data-dropdown]', function(){
	var _ = $(this);
	var dropMenu = document.getElementById(_.data('dropdown'));
	
	_.toggleClass('active');

	if(!_.hasClass('active')){
		_.addClass('close');
	}
	
	$(dropMenu).slideToggle('fast');
});