<?php

/*
 * ------------------
 * CONGFIGURACIONES
 * ------------------
 */
date_default_timezone_set('America/Buenos_Aires');

define('DEBUG', true);

if (DEBUG) {
    error_reporting(E_ALL);
    ini_set('display_errors', 'On');
    define('URL_ROOT', 'http://ad.local');
    define('MYSQL_USER', 'root');
    define('MYSQL_PASS', '');
    define('MYSQL_ENCPASS', '');
    define('MYSQL_DB', 'dentalphotonet');
    define('MYSQL_HOST', 'localhost');
} 
else {
    error_reporting(0);
    ini_set('display_errors', 'Off');
    define('URL_ROOT', 'http://axis.nextdevelop.com.ar');
    define('MYSQL_USER', 'axis');
    define('MYSQL_PASS', 'O50vdNs4lbPH');
    define('MYSQL_ENCPASS', '');
    define('MYSQL_DB', 'axis_dentalphotonet');
    define('MYSQL_HOST', 'localhost');
}


define("SEG", 1);
define("MIN", 60);
define("HOUR", 60 * MIN);
define("DAY", 24 * HOUR);
define("SESSION_TIMEOUT", 120 * MIN);
define("USER_TIMEOUT", 20 * MIN);
define("COOKIE_TIMEOUT", 30 * DAY);