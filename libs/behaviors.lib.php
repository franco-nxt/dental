<?php

/*
* ------------------
* FUNCIONES DENTAL
* ------------------
*/

function dump(){
	echo '<pre>';
	foreach (func_get_args() as $obj) {
		var_dump($obj);
	}
	echo '</pre>';
}

 /**
* codifica un string en base64 y elimina los caracteres de relleno
*
* @param strin $data strign a encodear
* @return string
* */

function base64url_encode($data) {
	return is_string($data) ? rtrim(strtr(base64_encode($data), '+/', '-_'), '=') : false;
}

/**
* decodifica un string en base64 y restaura los caracteres de relleno
*
* @param strin $data strign a decodear
* @return string
* */

function base64url_decode($data) {
	return is_string($data) ? base64_decode(str_pad(strtr($data, '-_', '+/'), strlen($data) % 4, '=', STR_PAD_RIGHT)) : false;
}

/**
 * decripta y parsea una url encodeada
 *
 * @param string $url encode de base64
 * @param string $k clave del elemento que se necesita
 * @return string
 * */
function decrypt_params($param, $k = false) {
	if (is_string($param)) {
		$decoded = base64url_decode($param);
		parse_str(html_entity_decode($decoded), $data);

		return $k && isset($data[$k]) ? $data[$k] : $data;
	}
	else{
		throw new Exception("decrypt_params espera un String");
	}
}

/**
 * pasa de un array a una query_url y la paso por base64url_encode para ocultar los parametros
 *
 * @param array $url params
 * @return string
 * */
function crypt_params($param) {
	if(is_array($param)){
		$str = http_build_query($param);
		$output = base64url_encode($str);
		return $output;
	}
	else{
		throw new Exception("crypt_params espera un Array");
	}
}

/**
* Diferencia en meses o años entre fechas.
* ESTA FUNCION ES PARA VERSIONES DE PHP < 5.3
*
* @param string $dt1 primer fecha
* @param string $dt2 segunda fecha
* @param string $uni unidad en la que se mustran los resultados 'Y' para años y 'M' para meses.
* @return string
* */

function diff_date($dt1, $dt2, $uni = null) {
	$dt1 = new DateTime($dt1);
	$dt2 = new DateTime($dt2);
	$lot = (60 * 60 * 24) * ($uni ? 30.4167 : 1) * ($uni == 'Y' ? 12 : 1);

	return round(abs($dt1->format('U') - $dt2->format('U')) / $lot);
}

/**
* Calcula el avance en el dia de hoy desde una fecha inicial y hasta un nuemero de meses dados
* Si la fecha incial es menor a la de hoy -time()- retorna 100
*
* @param string $ini fecha inicio
* @param string $dur total en meses
* @return integer|bool porcentaje de avance|false si la duracion no es valida
* */

function progress($dt1, $dur) {
	if (!is_numeric($dur) || $dur == 0) {
		return false;
	}

	$ini = strtotime($dt1);
	$endU = mktime(0, 0, 0, date('m', $ini) + $dur, date('d', $ini), date('Y', $ini));
	$end = date('Y-m-d H:i:s', $endU);
	if ($endU > time()) {
		$total = 100 / diff_date($dt1, $end);
		return round(diff_date($dt1, date('Y-m-d H:i:s')) * $total);

	}

	else {
		return 100;

	}
}

/**
* decodea un archivo json
*
* @param string $json ruta del json
* @return array vector obtenido
* */

function json_decode_file($json) {

	return json_decode(file_get_contents($json), true);

}

/**
* rellena un template, si un parametro no es enviado se borra la informacion
*
* @param string $json template para rellenar
* @param stdClass|array argumentos clave valor para rellenar
* @return array vector obtenido
* */

function include_tpl($tpl, $args = false, $eval = false, $finaleval = false) {
	if (!$tpl || !is_string($tpl)) {
		return false;

	}
	if (is_string($args) && !is_bool($eval)) {
		$args = array($args => $eval);
		$eval = $finaleval;

	}
	$arg = is_array($args) ? $args : array();

	$tpl = file_get_contents($tpl);
	$k = array_map(create_function('$e', 'return "{{" . $e . "}}";'), array_keys($arg));

	$v = array_map(create_function('$e', 'return preg_match("/^(?:string|integer|float)$/", gettype($e)) != 0 ? $e . "" : null;'), array_values($arg));
	$res = preg_replace('#\{\{[A-Z0-9\_\-\.\:]+\}\}#', '', str_replace($k, $v, $tpl));
	return (is_bool($args) && $args) || $eval ? eval('?>' . $res) : $res;

}

/**
* parsea una url y devuelve el elemento pedido
*
* @return array;
* @author 
* */
function url_paths() {
	$url   = $_SERVER['SERVER_NAME'] . str_replace('?' . $_SERVER['QUERY_STRING'], '', $_SERVER['REQUEST_URI']);
	$base  = str_replace(preg_replace('@http[s:]+//@', '', URL_ROOT), '', $url);
	$paths = explode('/', $base);
	$paths = array_filter($paths);

	return $paths;
}

function isset_get(&$o){
	return !empty($o) ? $o : null;
}

function isset_disabled(&$o){
	return !isset($o) ? 'disabled' : null;
}

function isset_checked(&$o){
	return isset($o) ? 'checked="true"' : null;
}

function checked($o) {
	return $o ? 'checked="true"' : null;
}

function selected($o) {
	return $o ? 'selected="selected"' : null;
}

function disabled($o) {
	return $o ? null : 'disabled';
}


function redirect_exit($param = null) {
	$param && is_string($param) || ($param = URL_ROOT);
	
	header('Location: ' . $param);
	exit;
}


/**
 * Carga las class que se le pida y va manteniendo un singleton
 * de cada una 
 * @param string $class Nombre de
 * @return StdClass
 * 
 **/
function &load_class($class, $directory = NULL, $param = NULL) {
	$class = strtolower($class);
	static $_classes = array();

	if (isset($_classes[$class])) {
		return $_classes[$class];
	}

	$name = FALSE;

	!is_dir($directory) && $directory = CLASS_PATH;

	if (file_exists($directory . DIRECTORY_SEPARATOR . $class . '.php')) {
		$name = ucfirst(str_replace(array('class', '.'), '', $class));

		if (!class_exists($name, FALSE)) {
			require_once($directory . '/' . $class . '.php');
		}

		if (class_exists($name, FALSE)) {
			$_classes[$class] = isset($param) ? new $name($param) : new $name(); 

			return $_classes[$class];
		}
	}

	return $name;
}

function &get_user($email = null, $pass = null) {

	$Session = load_class('Session');

	if (!$email || !$pass) {
		$user = json_decode($Session->__dental__);
		$email = $user->email;
		$pass = $user->pass;
	}

	if (isset($email, $pass) && class_exists('Dental')) {

		$User = Dental::login($email, $pass);
		
		if ($User->id) {
			$Session->__dental__ = json_encode($User);
		}
		return $User;
	}
	else{
		throw new Exception("No se encuentra la clase Dental");
	}
}

function &get_patient($id = null) {
	if(!$id){
		$url_paths = url_paths();
		$id = array_pop($url_paths);
	}
	
	$decrypt_params = array();

	if (is_array($id)) {
		$decrypt_params = $id;
	}
	elseif (!preg_match('#^[0-9]+$#', $id)) {
		$decrypt_params = decrypt_params($id);
	}

	if (array_key_exists(PACIENTE, $decrypt_params) ) {
		$id = $decrypt_params[PACIENTE];
	}
	
	if (!is_numeric($id)) {
		add_error_flash('NO SE ENCUENTRA EL PACIENTE.');
		redirect_exit();
	}

	$paciente = new Patient($id);

	if ($paciente->id){
		return $paciente;
	}
	else{
		add_error_flash('NO SE ENCUENTRA EL PACIENTE.');
		redirect_exit();
	}
}

/**
 * Guarda un mensaje volatil en la clase session
 * Si ya hay mensajes cargados lo agrega
 *
 * @param String $str El mensaje a guardar
 * @return void
 **/
function add_msg_flash($str) {
	$Session = load_class('Session', CLASS_PATH . '/core');
	$msg = $Session->__msg__;

	if (!$msg || empty($msg)){
		$Session->__msg__ = array($str);
	}
	else{
		$msg[] = $str;
		$Session->__msg__ = $msg;
	}
}

/**
 * Devuelve todos los mensajes en la clase Session concatenados
 * @param String $glue valor que se le pasa al implode
 * @param String $wrap String con las directivas para contener el resultado, siempre debe esperar un string: %s
 * @example ./ get_msg_flash('</span><span>', '<span>%s</span>');
 * @return String
 **/
function get_msg_flash($glue = '<br>', $wrap = '%s') {
	$Session = load_class('Session', CLASS_PATH . '/core');
	$msg = $Session->__msg__;

	is_array($msg) && $msg = implode('<br>', $msg);

	if (is_string($msg)) {
		return sprintf($wrap, $msg);
	}
}

/**
 * Guarda un mensaje de error volatil en la clase session
 * Si ya hay mensajes cargados lo agrega
 *
 * @param String $str El mensaje a guardar
 * @return void
 **/
function add_error_flash($str) {
	$Session = load_class('Session', CLASS_PATH . '/core');
	$msg = $Session->__error__;
	
	if (!$msg || empty($msg)){
		$Session->__error__ = array($str);
	}
	else{
		$msg[] = $str;
		$Session->__error__ = $msg;
	}
}

/**
 * Devuelve todos los mensajes en la clase Session concatenados
 * @param String $glue valor que se le pasa al implode
 * @param String $wrap String con las directivas para contener el resultado, siempre debe esperar un string: %s
 * @example ./ get_msg_flash('</span><span>', '<span>%s</span>');
 * @return String
 **/
function get_error_flash($glue = '<br>', $wrap = '%s') {
	$Session = load_class('Session', CLASS_PATH . '/core');
	$msg = $Session->__error__;

	is_array($msg) && $msg = implode('<br>', $msg);

	if (is_string($msg)) {
		return sprintf($wrap, $msg);
	}
}
/**
 * Dada un fecha de formato d/m/y devuelve una 
 * con formato listo para BD
 *
 * @return String Un date con formato Y-m-d H:i:s
 */
function format_date($date)
{
	preg_match('#^(?<D>\d{1,2})[\/|-](?<M>[0-2]?[1-9]|3[0-2])[\/|-](?<Y>\d{1,4})$#', $date, $result); 
	$strtotime = $result ? strtotime($result['Y'] . '-' . $result['M'] . '-' . $result['D']) : strtotime('now');

	return date('Y-m-d H:i:s', $strtotime);
}

/**
 * Asigna y devuelve variables globales.
 * Es util para asignar valores fuera del scope.
 * 
 * @param  String $key   Clave del valor a asignar o que se esta pidiendo.
 * @param  $value Valor que se asigna a $key.
 * @return El valor de la variable almacenada en $key
 */
function _global($key, $value = null){
	if (isset($key, $value) && $key) {
		$GLOBALS[$key] = $value;
	}
	elseif (isset($GLOBALS[$key])) {
		return $GLOBALS[$key];
	}

	return null;
}

/**
 * matchea contra la url de la request.
 * de esta menarea por ejemplo:
 * 
 * match_url('static/$class/$method?/$encode:[a-z0-9]')
 * 
 * array(5) {
 *  [0]=> "/static/clase1/metodo2/g6d4f6h"
 *  ["class"]=> "clase1"
 *  [1]=> "clase1"
 *  ["method"]=> "metodo2"
 *  [2]=> "metodo2"
 *  ["encode"]=> "g6d4f6h"
 *  [3]=> "g6d4f6h"
 * }
 * 
 * -El primer elemento (0) es la url que enalizo.
 * 
 * Para capturar una variable es necesario que en $pattern pasado como parametro,
 * la clave asignada tenga de sufijo el caracter '$', antes del nombre dado 
 * y despues de la barra.
 * En el ejemplo el valor static es ignorado porque no tiene sufijo $.
 *
 * La asignacion puede ser opcional tambien (puede no estar dentro de la url)
 * si la misma tiene como sufijo '?'. Como $method? en el ejemplo anterior.
 * Por eso el ejemplo tambien valida a la url "/static/clase1/g6d4f6h"
 * y retornara:
 * 
 * array(5) {
 *  [0]=> "/static/clase1/g6d4f6h"
 *  ["class"]=> "clase1"
 *  [1]=> "clase1"
 *  ["encode"]=> "g6d4f6h"
 *  [2]=> "g6d4f6h"
 * }
 * 
 * @param  String $pattern El pattern a validar
 * @return Array|Bool Asociativo con las coincidencias o false si no valida
 */
function match_url($pattern){
	function handler($a){
		extract($a);
		return "(?:\\" . $slash . "(?'" . $key . "'" . (isset($rgx) && $rgx ? $rgx : "\w+") . "))" . (isset($optional) && $optional ? '?' : null);
	}

	$url = $_SERVER['SERVER_NAME'] . str_replace('?' . $_SERVER['QUERY_STRING'], '', $_SERVER['REQUEST_URI']);
	$base = str_replace(preg_replace('@http[s:]+//@', '', URL_ROOT), '', $url);
	$base = '/' . trim($base, '/') . '/';
	$pattern = '/' . trim($pattern, '/') . '/';

	$rgx = "#" . preg_replace_callback('#(?<slash>\/)(?:\$)(?<key>[a-zA-Z_\x7f-\xff][a-zA-Z0-9_\x7f-\xff]*)(?<optional>\?|)(?:\:(?<rgx>[^\/]+))?#', 'handler' ,$pattern) . "$#";

	preg_match($rgx, $base, $output_array);

	return empty($output_array) ? false : $output_array;
}


/**
 * Checkea que el usuario este logueado y la session no este vencida.
 * Si esta logueado renueva el tiempo en session.
 *
 * @return Bool Segus el usuario este o no logueado
 */
function check_user()
{
	$session = load_class('Session');
	$destroy_at = $session->__destroy_at__;

	if ($destroy_at > time()) {
		$session->__destroy_at__ = time() + USER_TIMEOUT;

		return true;
	}

	return false;
}