export function addClass(el, className)
{
	if (el.classList){
		el.classList.add(className)
	}
	else if (!hasClass(el, className)){
		el.className += " " + className;
	}
}

export function removeClass(el, className)
{
	if (el.classList){
		el.classList.remove(className)
	}
	else if (hasClass(el, className))
	{
		var reg = new RegExp('(\\s|^)' + className + '(\\s|$)');
		el.className = el.className.replace(reg, ' ');
	}
}

export function hasClass(el, className)
{
	if (el.classList){
		return el.classList.contains(className);
	}
	
	return !!el.className.match(new RegExp('(\\s|^)' + className + '(\\s|$)'));
}

export function isTextBox(element) {
    var tagName = element.tagName.toLowerCase();
    if (tagName === 'textarea') return true;
    if (tagName !== 'input') return false;
    var type = element.getAttribute('type').toLowerCase(),
        // if any of these input types is not supported by a browser, it will behave as input type text.
        inputTypes = ['text', 'password', 'number', 'email', 'tel', 'url', 'search', 'date', 'datetime', 'datetime-local', 'time', 'month', 'week']
    return inputTypes.indexOf(type) >= 0;
}