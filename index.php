<?php
define('BASE_PATH', dirname(__FILE__));
define('CLASS_PATH', BASE_PATH . DIRECTORY_SEPARATOR . 'classes');

require 'libs/common.lib.php';

$__url_paths__ = url_paths();

_global('__HTML__', true);

// COMPRUEBO EL TIEMPO DE SESSION
if (check_user()) {
    $__module__ = array_shift($__url_paths__);
}
else {
    $__module__ = 'login';
}

isset($__module__) || $__module__ = 'index';

if (!file_exists("modules/{$__module__}.php")) {
	add_error_flash("NO SE PUDO PROCESAR LA ORDEN.");
	redirect_exit();
}

ob_start();

include "modules/{$__module__}.php";

class_exists('Page') && new Page;

if (_global('__JSON__')) {
	echo ob_get_clean();
}
else{
	_global('__content__', ob_get_clean());
	include "html/index.php";
}