<?php
define('BASE_PATH', dirname(__FILE__));
define('CLASS_PATH', BASE_PATH . DIRECTORY_SEPARATOR . 'classes');

require 'libs/common.lib.php';

$__url_paths__ = url_paths();

// COMPRUEBO EL TIEMPO DE SESSION
if (check_user()) {
    $__module__ = array_shift($__url_paths__);
}
else {
    $__module__ = 'login';
}

isset($__module__) || $__module__ = 'login';

if (!file_exists("actions/{$__module__}.php")) {
    add_error_flash("NO SE PUDO PROCESAR LA ORDEN.");
    redirect_exit();
}

ob_start();

include "actions/{$__module__}.php";

class_exists('Page') && new Page;

echo ob_get_clean();

// include "html/{$__html__}.php";

// redirect_exit();
