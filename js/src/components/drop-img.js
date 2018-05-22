import swal from 'sweetalert';

$('[data-drop-label]').on('change', function(e){

	var reader = new FileReader();
	var file = e.target.files[e.target.files.length - 1];

	if (!/^image\//.test(file.type)) {
		swal({
			text: "El archivo seleccionado no es una imagen",
			icon: "error",
			button: {
				className: "btn btn-primary",
				text: "Oks"
			}
		});

		e.target.value = null;
		return false;
	}

	reader.onload = (function (el) {
		return function (a) {
			el.css('background-image', 'url(' + a.srcElement.result + ')').find('img').remove();
		}		
	})( $(document.getElementById(this.getAttribute('data-drop-label'))) );

	reader.readAsDataURL(file);
});

window.drop_file = function(){
	var _ = $(this);
	var $label = _.parent();
	var $btn_del = $('<button/>', {class: 'sess-trash btn-ico-delete'});

	$btn_del.on('click', (e) => {
		e.preventDefault();
		$btn_del.remove();
		_.val('');
		$label.css('background-image', 'url(' + $label.data('placeholder') + ')');
	}).insertBefore($label);

	var reader = new FileReader();
	var file = this.files[this.files.length - 1];

	if (!/^image\//.test(file.type)) {
		swal({
			text: "El archivo seleccionado no es una imagen",
			icon: "error",
			button: {
				className: "btn btn-primary",
				text: "Oks"
			}
		});

		e.target.value = null;
		return false;
	}

	reader.onload = (function (el) {
		return function (a) {
			el.css('background-image', 'url(' + a.srcElement.result + ')');
		}		
	})( $label );

	reader.readAsDataURL(file);
};

window.del_file = function(){
	var _ = $(this);
	var $input = $( document.getElementById( _.data('input') ) );
	var $label = $( document.getElementById( _.data('label') ) );

	if (_.is(':checked')) {
		_.parent().removeClass('btn-ico-delete').addClass('btn-ico-redo');
		$label.css('background-image', 'url(' + $label.data('placeholder') + ')');
	}
	else{
		_.parent().removeClass('btn-ico-redo').addClass('btn-ico-delete');
		$label.css('background-image', 'url(' + _.data('src') + ')');
	}
}

