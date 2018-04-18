window.jQuery = $;
var select = require('jquery-nice-select');

$('select').niceSelect().on('focus', function(){
	console.log(this);
});
