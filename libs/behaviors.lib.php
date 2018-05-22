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
 * summary
 *
 */
function get_from_encode($encode, $item)
{
	static $decrypt_params = array();

	if (empty($decrypt_params[$encode])) {
		$decrypt_params[$encode] = decrypt_params($encode);
		return get_from_encode($encode, $item);
	}

	if (empty($decrypt_params[$encode][$item])) {
		add_error_flash("NO SE ENCUENTRA EL PARAMETRO {$item}.");
		redirect_exit();
	}
	else{
		return $decrypt_params[$encode][$item];
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
 * 
 * ESTA FUNCION ES PARA VERSIONES DE PHP < 5.3
 * 
 * @param  String $dt1 primer fecha
 * @param  String $dt2 segunda fecha
 * @param  String $uni unidad en la que se mustran los resultados 'Y' para años y 'M' para meses.
 * @return String      
 */
function diff_date($dt1, $dt2, $uni = null) {
	$dt1 = new DateTime($dt1);
	$dt2 = new DateTime($dt2);
	$lot = (60 * 60 * 24) * ($uni ? 30.4167 : 1) * ($uni == 'Y' ? 12 : 1);

	return round(abs($dt1->format('U') - $dt2->format('U')) / $lot);
}

/**
 * Calcula el avance en el dia de hoy desde una fecha inicial y hasta un nuemero de meses dados.
 * Si la fecha incial es menor a la de hoy -time()- retorna 100
 * 
 * @param  String $dt1 fecha inicio
 * @param  String $dur total en meses
 * @return Integer     porcentaje de avance
 */
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
 * decodea un archivo json.
 * @param  String $json ruta del json.
 * @return Array        vector obtenido
 */
function json_decode_file($json) 
{
	return json_decode(file_get_contents($json), true);
}

/**
 * Parsea una url y devuelve el elemento pedido.
 * 
 * @return Array
 */
function url_paths() 
{
	$url   = $_SERVER['SERVER_NAME'] . str_replace('?' . $_SERVER['QUERY_STRING'], '', $_SERVER['REQUEST_URI']);
	$base  = str_replace(preg_replace('@http[s:]+//@', '', URL_ROOT), '', $url);
	$paths = explode('/', $base);
	$paths = array_filter($paths);

	return $paths;
}

function isset_get(&$o)
{
	return !empty($o) ? $o : null;
}

function isset_disabled(&$o)
{
	return !isset($o) ? 'disabled' : null;
}

function isset_checked(&$o)
{
	return !empty($o) ? 'checked="true"' : null;
}

function _checked(&$o)
{
	return !empty($o) ? 'checked="true"' : null;
}

function checked($o) 
{
	return $o ? 'checked="true"' : null;
}

function selected($o) 
{
	return $o ? 'selected="selected"' : null;
}

function disabled($o) 
{
	return $o ? null : 'disabled';
}
/**
 * Redirige a la misma url.
 * 
 */
function refresh_page()
{
	$actual_link = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
	
	header('Location: ' . $actual_link);
	exit;
}

function redirect_exit($param = null) 
{
	$param && is_string($param) || $param = URL_ROOT;
	
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

function &get_user($email = null, $pass = null) 
{
	$Session = load_class('Session');

	try {
		if (!$email || !$pass) {
			$user = json_decode($Session->__dental__);

			if (empty($user->email) || empty($user->pass)) {
				throw new DentalException('ES NECESARIO LOGUEARSE OTRA VEZ');	
			}

			!empty($user->email) && $email = $user->email;
			!empty($user->pass) && $pass = $user->pass;
		}

		$User = Dental::login($email, $pass);
		
		if ($User->id) {
			$Session->__dental__ = json_encode($User);
		}

		return $User;
	} 
	catch (DentalException $e) {
		add_error_flash($e->getMessage(), true);
		redirect_exit("/login");
	}
}

function get_Admin(){
	$user = get_user();

	return  Admin::login($user->email, $user->pass);
}

/**
 * Esta funcion dado un id 
 * intenta crear un paciente y retornarlo
 *
 * @return void
 * @author 
 */
function get_patient($id) {
	try {
		return new Patient($id);
	}
	catch (PatientException $e) {
		add_error_flash($e->getMessage(), true);
		redirect_exit();
	} 
	catch (Exception $e) {
		add_error_flash('NO SE ENCUENTRA EL PACIENTE.');
		redirect_exit();
	}
}

/**
 * funcion para obtener un Patient desde el encode.
 *
 * Usada en modules/*.php y actions/*.php
 * @param String $encode String encodeado
 * @return Patient
 */
function decode_patient($encode) {
	$patient_id = get_from_encode($encode, PACIENTE);
	
	return get_patient($patient_id);
}

/**
 * Guarda un mensaje volatil en la clase session
 * Si ya hay mensajes cargados lo agrega
 *
 * @param String $str El mensaje a guardar
 * @return void
 **/
function add_msg_flash($str, $overrite = false) {
	$Session = load_class('Session', CLASS_PATH . '/core');
	$msg = $Session->__msg__;

	if (!$msg || empty($msg) || $overrite){
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
function add_error_flash($str)
{
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
 * 
 * @param String $glue valor que se le pasa al implode
 * @param String $wrap String con las directivas para contener el resultado, siempre debe esperar un string: %s
 * @example ./ get_msg_flash('</span><span>', '<span>%s</span>');
 * @return String
 **/
function get_error_flash($glue = '<br>', $wrap = '%s') 
{
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
 * @uses 
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
 * @uses 
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

/**
 * Util para mostrar en el browser algunas variables.
 * 
 * @param  Mixed $data Info a mostroar por consola.
 */
function clog( $data )
{
	echo '<script>';
	echo 'console.log('. json_encode( $data ) .')';
	echo '</script>';
}


function csv_decode($csv, $columns = [], $delimiter = ',', $enclosure = '"', $escape = '\\') {
    $tmp = fopen('php://temp', 'rb+');
    
    fwrite($tmp, $csv);
    rewind($tmp);
    
    $result = [];
    $assoc = (bool) $columns;
    
    while (true) {
        $record = fgetcsv($tmp, 0, $delimiter, $enclosure, $escape);
        
        if ($record === null || $record === false) break;
        if ($record === [null]) continue; //blank line
        
        if ($assoc) {
            foreach ($columns as $i => $name) {
                $map[$name] = isset($record[$i]) ? $record[$i] : null;
            }
            $result[] = $map;
        } 
        else {
            $result[] = $record;
        }
    }

    return $result;
}

function get_if(&$obj, $str = NULL){
	return empty($obj) ? NULL : (!$str && is_string($obj) ? $obj : $str);
}

function checked_if(&$obj){
	return get_if($obj, 'checked');
}