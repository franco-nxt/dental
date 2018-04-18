window.seton = function(){
	for (var i = 0; i < arguments.length; i++){
		var matches = document.querySelectorAll(arguments[i]);

		for (var c = 0; c < matches.length; c++){
			if (matches[c]){
				matches[c].disabled = false;
				matches[c].focus();
				removeClass(matches[c], 'disabled');
				if(matches[c].labels && matches[c].labels[0]){
					removeClass(matches[c].labels[0], 'disabled');
					addClass(matches[c].labels[0], 'active');
				}
			}
		}
	}
}

window.setoff = function(){
	for (var i = 0; i < arguments.length; i++){
		var matches = document.querySelectorAll(arguments[i]);

		for (var c = 0; c < matches.length; c++){
			if(matches[c]){
				matches[c].checked = false;
				matches[c].disabled = true;
				isTextBox(matches[c]) && (matches[c].value = '');
				addClass(matches[c], 'disabled');
				if(matches[c].labels && matches[c].labels[0]){
					addClass(matches[c].labels[0], 'disabled');
					removeClass(matches[c].labels[0], 'active');
				}
			}
		}
	}
}

function addClass(el, className)
{
	if (el.classList)
		el.classList.add(className)
	else if (!hasClass(el, className))
		el.className += " " + className;
}

function removeClass(el, className)
{
	if (el.classList)
		el.classList.remove(className)
	else if (hasClass(el, className))
	{
		var reg = new RegExp('(\\s|^)' + className + '(\\s|$)');
		el.className = el.className.replace(reg, ' ');
	}
}
function hasClass(el, className)
{
	if (el.classList)
		return el.classList.contains(className);
	return !!el.className.match(new RegExp('(\\s|^)' + className + '(\\s|$)'));
}

function isTextBox(element) {
    var tagName = element.tagName.toLowerCase();
    if (tagName === 'textarea') return true;
    if (tagName !== 'input') return false;
    var type = element.getAttribute('type').toLowerCase(),
        // if any of these input types is not supported by a browser, it will behave as input type text.
        inputTypes = ['text', 'password', 'number', 'email', 'tel', 'url', 'search', 'date', 'datetime', 'datetime-local', 'time', 'month', 'week']
    return inputTypes.indexOf(type) >= 0;
}

$("[data-discheck]").on('change', function(){
	$(this.getAttribute('data-discheck')).each(function (i, elm) {
		elm.setAttribute('checked', false);
		elm.checked = false;
	});
});