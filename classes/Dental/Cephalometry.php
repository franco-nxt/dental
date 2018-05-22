<?php 

/**
 * summary
 */
class Cephalometry
{
	private static $M1 = array(
		'p1'
	);

	private static $M2 = array(
		'p1',
		'p2'
	);

	private static $M3 = array(
		'p1',
		'p2',
		'p3'
	);

	private static $M4 = array(
		'p1',
		'p2',
		'p3',
		'p4'
	);

	private static $M5 = array(
		'pag1',
		'pag2'
	);

	private static $M6 = array(
		'pag1',
		'pag2',
		'pag3'
	);

	private static $M7 = array(
		'pag1',
		'pag2',
		'pag3',
		'pag4'
	);

	private static $M8 = array(
		'pag1',
		'pag2',
		'pag3',
		'pag4',
		'pag5',
		'pag6'
	);

	public function __construct($id) 
	{
		// SI id ES UN ARRAY ES PARA INSERTAR UNO NUEVO
		if ( is_array($id) ) {
			$this->create($id);
		}
		elseif ( is_numeric($id) ) {
			$this->id = $id;
		}
		// RELLENO LOS DATOS DE LA SESSION
		$this->select(array('fecha_hora', 'etapa', 'tipo', 'cantidad', 'url'));
	}

	/**
	 * Crea la session en la BD.
	 *
	 * @throws CephalometryException Cuando los datos enviados no son correctos.
	 * @return Photo|Bool segun como haya resultado
	 */
	private function create($data)
	{
		// DATOS SON NECESARIOS PARA CREAR UN REGISTRO, datos_json TIENE QUE SER UN JSON
		if (empty($data['session']) || !is_array($data['session']) || empty($data['id_tratamiento'])  || !is_numeric($data['id_tratamiento'])) { 
			throw new CephalometryException('ERROR AL CREAR LA SESSION DE CEFALOMETRIAS, FALTAN DATOS.');
		}
		// ELIMINADO POR DEFECTO ES FALSE
		$eliminado = 0;  
		// ID DEL TRATAMIENTDO ASIGNADO A LA SESSION
		$id_tratamiento = $data['id_tratamiento'];
		// FORMATEO EL JSON DE LA SESSION (NOMBRE : SESSION) Y LO ENCODEO
		$datos_json = json_encode(array('name' => $data['name'], 'session' => $data['session']));
		// GUARDO LA FECHA DE FORMA CORRECTA
		$date = !empty($data['fecha_hora']) ? format_date($data['fecha_hora']) : date('Y-m-d H:i:s');
		// ETAPA DE FORMA CORRECTA
		$etapa = !empty($data['etapa']) && defined( "BD_ETAPA_{$data['etapa']}" ) ? constant("BD_ETAPA_{$data['etapa']}") : BD_ETAPA_INICIALES; 
		// EL TIPO DE FORMA CORRECTA
		$tipo = !empty($data['tipo']) && defined( "BD_TIPO_{$data['tipo']}" ) ? constant("BD_TIPO_{$data['tipo']}") : BD_TIPO_OTRO; 
		// ARMO LA QUERY
		$q = stripslashes("INSERT INTO cefalometrias (id_tratamiento, fecha_hora, datos_json, etapa, tipo, eliminado) VALUES ({$id_tratamiento}, '{$date}', '{$datos_json}', {$etapa}, {$tipo}, {$eliminado})");
		// EJECUTO
		self::DB()->query($q);
		// SETEO EL ID DE LA INSTANCIA
		$this->id = self::DB()->lastID();
	}

	/**
	 * Methodo para traer datos.
	 *
	 * @return Cephalometry La misma instancia
	 * @author 
	 */
	public function select($fields = '*') 
	{
		// ES NECESARIO EL ID DE LA SESSION
		if (!$this->id) {
			throw new CephalometryException('ERROR AL CARGAR LA SESION DE CEFALOMETRIAS.');
		}
		// SI EL PARAMETRO ES UN STRING LO PASO A UN ARRAY
		!is_array($fields) && $fields = array($fields);
		// VAR DONDE GUARDAR LOS NOMBRES DE LAS COLUMNAS
		$keys = array();
		// FILTRO LOS CAMPOS Y AJUSTO LOS NOMBRES DE LOS CAMPOS SOLICITADOS A LOS REALES DE LA BBDD
		foreach ($fields as $field) {
			// ARREGLO LOS SINONIMOS
			switch ($field) {
				case 'fecha':
				$field = 'fecha_hora';
				break;
				case 'cantidad':
				case 'session':
				case 'name':
				$field = 'datos_json';
				break;
				case 'url':
				case 'Treatment':
				case 'tratamiento':
				$field = 'id_tratamiento';
				break;
			}
			// AGREGO SOLO LOS CAMPOS VALIDOS
			if ($field == '*' || self::valid_field($field)) {
				$keys[] = $field;
			}
		}

		if (count($keys)) {
			// FILTRO LOS CAMPOS DUPLICADOS
			$unique_implode = implode(', ', array_unique($keys)); 
			// ARMO LA QUERY
			$q = "SELECT {$unique_implode} FROM cefalometrias WHERE id_cefalometria = {$this->id}";
			// EJECUTO
			$_ = self::DB()->oneRowQuery($q);

			if (isset($_['datos_json'])) {
				// DECODE DEL OBJETO
				$json_decode = (array) json_decode($_['datos_json']);
				// SI HAY ALGO(TENDRIA QUE SERT UN Obj) EN LA SESSION, HAGO CAST O SETEO UN Array VACIO
				$this->session = isset($json_decode['session']) ? (array) $json_decode['session'] : array();
				// SI HAY UN NAME(MODELO) LO SETEO
				$this->name = isset($json_decode['name']) ? $json_decode['name'] : null;;
				// SACO LA CANTIDAD
				$this->cantidad = count($this->session);
			}

			if (isset($_['fecha_hora'])) {
				// FORMATEO LA FECHA PARA EL FRONT
				$this->fecha_hora  = date('d/m/Y', strtotime($_['fecha_hora']));
			}

			if (isset($_['tipo'])) {
				// SETEO EL TIPO PARA EL FRONT
				$this->tipo = defined( "CEFALOMETRIA_TIPO_{$_['tipo']}" ) ? constant("CEFALOMETRIA_TIPO_{$_['tipo']}") : CEFALOMETRIA_OTRO; 
			}

			if (isset($_['etapa'])) {
				// SETEO LA ETAPA PARA EL FRONT
				$this->etapa = defined( "ETAPA_{$_['etapa']}" ) ? constant("ETAPA_{$_['etapa']}") : ETAPA_INICIALES; 
			}

			if (isset($_['id_tratamiento'])) {
				// EXTRAIGO EL TRATAMIENTO
				$this->Treatment = new Treatment($_['id_tratamiento']);
				// CON ESTOS DATOS YA PUEDO CREAR LA URL PARA LA SESSION
				$this->url = crypt_params(array(CEFALOMETRIA => $this->id, TRATAMIENTO => $this->Treatment->id, PACIENTE => $this->Treatment->id_paciente, MODELO => $this->name));
			}

			if (isset($_['eliminado'])) {
				// SI EL PACIENTE ESTA ELIMINADO
				$this->eliminado = $_['eliminado'];
			}
		}

		return $this;
	}

	/**
	 * Actualiza los datos en BD.
	 *
	 * Para actualizar la colleccion de imagenes es necesario mandarlas
	 * en un Array asociativo dentro de $data en el campo 'session'.
	 * Cada clave de la session corresponde con el tipo de imagen.
	 *
	 * Usada en actions/fografias.php
	 *
	 * @param Array $data Arreglo con los datos a actualizar en BD.
	 * @return Photo La misma instancia
	 */
	public function update($data) 
	{
		// ES NECESARIO EL ID DE LA SESSION
		if (empty($this->id) || !is_numeric($this->id)) {
			throw new CephalometryException('ERROR AL CARGAR LA SESION DE CEFALOMETRIAS.');
		}
		// LA DATA ENVIADA ESTA MAL
		if (empty($data) || !is_array($data)) {
			throw new CephalometryException('ERROR AL ACTUALIZAR LA SESION DE CEFALOMETRIAS. LOS DATOS SON INCORRECTOS.');
		}
		// VAR PARA GUARDAR LOS "SETS" DE LA QUERY
		$fields = array();
        // SI VIENE EL CAMPO DE SESSION DONDE SE GUARDAN LAS IMAGENES
		if (!empty($data['session'])) {
			// COMBINO LA SESSION ACTUAL Y LOS DATOS QUE VIENEN
			$session = array_merge($this->session , $data['session']);
			// FORMATEO EL JSON DE LA SESSION (NOMBRE : SESSION) Y LO ENCODEO
			$datos_json = json_encode(array('name' => $this->name, 'session' => $session));
			// AGREGO EL SET DEL CAMPO
			$fields[] = "datos_json = '{$datos_json}'";
		}
		// SI VIENE EL CAMPO FECHA
		if (!empty($data['fecha_hora'])) {
			// FORMATEO EL VALOR
			$format_date = format_date($data['fecha_hora']);
			// Y AGREGO EL CAMPO
			$fields[] = "fecha_hora = '{$format_date}'";
		}
		// SI VIENE EL CAMPO ETAPA
		if (!empty($data['etapa']) && defined( "BD_ETAPA_{$data['etapa']}" )) {
			// SETEO EL VALOR CORRECTO APRA LA BBDD
			$etapa = constant("BD_ETAPA_{$data['etapa']}");; 
			// AGREGO EL CAMPO
			$fields[] = "etapa = {$etapa}";
		}
		// SI VIENE EL CAMPO TIPO
		if (!empty($data['tipo']) && defined( "BD_TIPO_{$data['tipo']}" )) {
			// SETEO EL VALOR CORRECTO APRA LA BBDD
			$tipo = constant("BD_TIPO_{$data['tipo']}");; 
			// AGREGO EL CAMPO
			$fields[] = "tipo = {$tipo}";
		}
        // SI HAY CAMPOS PARA UPDATEAR
		if (!empty($fields)) {
			// IMPLODE SOBRE LOS SET DE CADA CAMPO
			$implode = implode(",", $fields);
			// ARMO LA QUERY 
			$q = stripslashes("UPDATE cefalometrias SET {$implode} WHERE id_cefalometria = '{$this->id}'");
			// ACTUALIZO EN BD
			self::DB()->query($q);
		}
		// ATUALIZO LA INSTANCIA
		return $this->select();
	}

	/**
	 * Set del estado de la session como eliminado.
	 *
	 * @throws CephalometryException Por alguna razon la instancia no tiene el id.
	 */
	public function delete() 
	{
		// ES NECESARIO EL id Y LA INFO
		if (!$this->id) {
			throw new CephalometryException('OCURRIO UN ERROR AL INTENTAR ACTUALIZAR LA SESION DE CEFALOMETRIAS.');
		}
		// ARMO LA QUERY PARA ELIMINAR
		$q = "UPDATE cefalometrias SET eliminado = 1 WHERE id_cefalometria = '{$this->id}'";
		// EJECUTO LA QUERY PARA ELIMANR
		self::DB()->query($q);
	}

	/**
	 * Elimina los campos de la session.
	 * Esta funcion es usada en actions/cefalometrias.php
	 *
	 * @throws CephalometryException 
	 * @return Bool Resultados de la query
	 * @param Array Las columnas que se quieren eliminar
	 */
	public function trash($fields)
	{
		// SI LOS DATOS ENVIADOS ESTAN MAL
		if (empty($fields) || !is_array($fields)) {
			throw new CephalometryException('ERROR AL BORRAR IMAGENES DE LA SESION DE CEFALOMETRIAS, LOS DATOS ENVIADOS SON INCORRECTOS');
		}
		// ACTUALIZO LOS DATOS DE LA SESSION
		$this->select('session');
		// ELIMINO LOS CAMPOS
		foreach ($this->session as $key => $src) {
			// QUE SON ENVIADOS EN $fields
			if (in_array($key, $fields)) {
				unset($this->session[$key]);
			}
		}
		// ARMO LOS DATOS 
		$datos_json = stripslashes(json_encode(array('name' => $this->name, 'session' => $this->session)));
		// ARMO LA QUERY
		$q = "UPDATE cefalometrias SET datos_json = '{$datos_json}' WHERE id_cefalometria = {$this->id}";
		// ACTUALIZO EN BD
		self::DB()->query($q);
	}

	/**
	 * Obtener una imagen de la session.
	 * 
	 * @param  String $key Nombre de la imagen
	 * @return String      Si la imagen existe retorna una ruta absoluta.
	 */
	public function get_picture($key) 
	{
		// SOLO SI DENTRO DE LA COLLECCION LA ENVIO COMO UNA RUTA ABSOLUTA
		return isset($this->session[$key]) ? URL_ROOT . '/' . CEFALOMETRIAS_PATH . $this->session[$key] : null;
	}

	/**
	 * Obtener miniatura de alguna imagen de la session.
	 * 
	 * @param  String $key Nombre de la imagen.
	 * @return String      Ruta absoluta de la miniatura de la imagen.
	 */
	public function get_thumb($key) 
	{
		// SOLO SI DENTRO DE LA COLLECCION LA ENVIO COMO UNA RUTA ABSOLUTA
		return isset($this->session[$key]) ? URL_ROOT . '/' . CEFALOMETRIAS_PATH . 'thumb/' . $this->session[$key] : null;
	}
	
	/**
	 * Obtener la forma del modelo segun la key enviada.
	 * 
	 * @param  Numeric $model Numero de modelo que se quiere usar.
	 * @return Array          Array con las claves del modelo.
	 */
	public static function get_session_model($model)
	{
		// EL NUMERO DE MODELO TIENE QUE ESTAR SETEADO
		if (empty($model) || !is_numeric($model)) {
			throw new CephalometryException('NO ENCONTRAMOS EL MODELO SOLICITADO.');
		}
		// ARMO EL NOMBRE DEL MODELO
		$varname = 'M' . $model;
		// SI TODO ESTA BIEN LO RETORNO
		if (isset(self::$$varname)) {
			return self::$$varname;
		}
		else{
			throw new CephalometryException('NO ENCONTRAMOS EL MODELO SOLICITADO.');
		}
	}

	/**
	 * concatena los datos para obtener la url necesaria para ver
	 *
	 * @param  String $action ver|editar
	 * @return String 		  url para ver/editar la radiografia
	 * */
	public function url($action = 'ver')
	{
		return trim(URL_ROOT, '/') . '/cefalometrias/' . trim($action, '/') . '/' . $this->url;
	}

	/**
	 * Valido que el campo corresponda con los de la BD.
	 *
	 * Usado en select, create y update.
	 * 
	 * @param String $fieldname
	 * @return Bool
	 */
	public static function valid_field($fieldname)
	{
		// TRUE SI NO ESTA VACIO, ES UN STRING Y MATCHEA CON ALGUNA DE LAS COLUMNAS EN BD
		return !empty($fieldname) && is_string($fieldname) && preg_match('/^(fecha_hora|datos_json|etapa|tipo|eliminado|id_tratamiento)$/', $fieldname);
	}

	private static function DB()
	{
		return MySQL::getInstance();
	}
}