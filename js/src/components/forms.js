import swal from 'sweetalert';
import {isTextBox} from './utils';
require('jquery-nice-select');

window.seton = function(){
	// for (var i = 0; i < arguments.length; i++){
	// 	var matches = document.querySelectorAll(arguments[i]);

	// 	for (var c = 0; c < matches.length; c++){
	// 		if (matches[c]){
	// 			matches[c].disabled = false;
	// 			matches[c].focus();
	// 			removeClass(matches[c], 'disabled');
	// 			if(matches[c].labels && matches[c].labels[0]){
	// 				removeClass(matches[c].labels[0], 'disabled');
	// 				addClass(matches[c].labels[0], 'active');
	// 			}
	// 		}
	// 	}
	// }
}

window.setoff = function(){
	// for (var i = 0; i < arguments.length; i++){
	// 	var matches = document.querySelectorAll(arguments[i]);

	// 	for (var c = 0; c < matches.length; c++){
	// 		if(matches[c]){
	// 			matches[c].checked = false;
	// 			matches[c].disabled = true;
	// 			isTextBox(matches[c]) && (matches[c].value = '');
	// 			addClass(matches[c], 'disabled');
	// 			if(matches[c].labels && matches[c].labels[0]){
	// 				addClass(matches[c].labels[0], 'disabled');
	// 				removeClass(matches[c].labels[0], 'active');
	// 			}
	// 		}
	// 	}
	// }
}



// $("[data-discheck]").on('change', function(){
// 	$(this.getAttribute('data-discheck')).each(function (i, elm) {
// 		elm.setAttribute('checked', false);
// 		elm.checked = false;
// 	});
// });

window.check_csv = function(sender) {
	var validExts = new Array(".csv");
	var fileExt = sender.value;
	fileExt = fileExt.substring(fileExt.lastIndexOf('.'));

	if (validExts.indexOf(fileExt) < 0) {
		swal("El archivo no es una formato valido.");
		return false;
	}
	else{
		sender.form.submit();
	}
}

window.change_si = function(_){
	var actual = document.querySelector(_.actual);
	var pasado = document.querySelector(_.pasado);

	if(this.checked){
		document.querySelector(_.no).checked = false;
		
		[actual, pasado].forEach(function(a){
			a.disabled = false;
			if (a.labels.length){
				a.labels[0].className = a.labels[0].className.replace(/\bdisabled\b/g, ' ');
			}
		});
	}
	else{
		[actual, pasado].forEach(function(a){
			a.disabled = true;
			a.checked = false;
			if (a.labels.length && a.labels[0].className.split(' ').indexOf('disabled') == -1) {
				a.labels[0].className += ' disabled';
			}
		});
	}
}

window.change_no = function(_){
	var actual = document.querySelector(_.actual);
	var pasado = document.querySelector(_.pasado);

	$(_.hasta).prop('disabled', 'disabled').niceSelect('update');

	if(this.checked){
		document.querySelector(_.si).checked = false;
	
		[actual, pasado].forEach(function(a){
			a.disabled = true;
			a.checked = false;
			if (a.labels.length && a.labels[0].className.split(' ').indexOf('disabled') == -1) {
				a.labels[0].className += ' disabled';
			}
		});
	}
}

window.change_actual = function(_){
	if(this.checked){
		document.querySelector(_.pasado).checked = false;
		$(_.hasta).prop('disabled', 'disabled').niceSelect('update');
	}
}

window.change_pasado = function(_){
	if(this.checked){
		document.querySelector(_.actual).checked = false;
		$(_.hasta).prop('disabled', false).niceSelect('update');
	}
}

$('.field[data-change]').on('change', 'input', function(e){
	console.log(this.getAttribute('data-change'));
});

$('input[data-discheck]').on('change', function(){
	$(this.getAttribute('data-discheck')).each(function(){
		this.checked = false;
	});
});

$('.field[data-check-one]').on('change', 'input', function(e){
	$(e.delegateTarget).find('input').not(this).each(function(a,b){
		b.checked = false;
	})
});

$('input[data-enable-text]').on('change', function(e){
	if(this.checked){
		var input = $(document.querySelector(this.getAttribute('data-enable-text'))).prop('disabled', false).focus();
		$(input[0].labels[0]).removeClass('disabled')
	}
});

$('input[data-disable-text]').on('change', function(e){
	if(this.checked){
		var input = $(document.querySelector(this.getAttribute('data-disable-text'))).prop('disabled', 'disabled').val('');
		$(input[0].labels[0]).addClass('disabled')
	}
});