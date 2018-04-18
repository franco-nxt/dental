import swal from 'sweetalert';

$('.upload-img-btn').on('change', function(e){

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
	})( $(document.getElementById(this.getAttribute('data-target'))) );

	reader.readAsDataURL(file);
});