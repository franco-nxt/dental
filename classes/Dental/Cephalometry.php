<?php 

/**
 * summary
 */
class Cephalometry
{
	private static $RGX_BD = '#^(id_tratamiento|fecha_hora|datos_json|etapa|tipo|eliminado|\*)$#';

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

	public function __get($name) {
		if ($name == 'db') {
			return MySQL::getInstance();
		} 
		elseif (isset($this->{$name})) {
			return $this->{$name};
		}

		return null;
	}

	public function __construct($id = null) 
	{
		// SI id ES UN ARRAY ES PARA INSERTAR UNO NUEVO
		if ( is_array($id) ) {
			$this->create($id);
		}
		elseif ( is_numeric($id) ) {
			$this->id = $id;
		}

		return $this->select(array('fecha_hora', 'etapa', 'tipo', 'cantidad', 'url'));
	}

	/**
	 * Crea la session en la BD
	 *
	 * @return Photo|Bool segun como haya resultado
	 */
	private function create($data)
	{
		// DATOS SON NECESARIOS PARA CREAR UN REGISTRO, datos_json TIENE QUE SER UN JSON
		if (empty($data['session']) || empty($data['session']) || empty($data['id_tratamiento'])  || !is_numeric($data['id_tratamiento'])) { 
			return false;
		}

		$eliminado = 0;  // ELIMINADO POR DEFECTO ES FALSE

		$id_tratamiento = $data['id_tratamiento'];

		$datos_json = json_encode(array('name' => $data['name'], 'session' => $data['session']));

		$date = !empty($data['fecha_hora']) ? format_date($data['fecha_hora']) : date('Y-m-d H:i:s');

		$etapa = !empty($data['etapa']) && defined( "BD_ETAPA_{$data['etapa']}" ) ? constant("BD_ETAPA_{$data['etapa']}") : BD_ETAPA_INICIALES; 

		$tipo = !empty($data['tipo']) && defined( "BD_TIPO_{$data['tipo']}" ) ? constant("BD_TIPO_{$data['tipo']}") : BD_TIPO_OTRO; 

		$q = stripslashes("INSERT INTO cefalometrias (id_tratamiento, fecha_hora, datos_json, etapa, tipo, eliminado) VALUES ({$id_tratamiento}, '{$date}', '{$datos_json}', {$etapa}, {$tipo}, {$eliminado})");

		$this->db->query($q);

		$this->id = $this->db->lastID();

		$this->db->free();

		return $this->id ? $this : false;
	}

	/**
	 * Methodo para traer 
	 *
	 * @return void
	 * @author 
	 */
	public function select($fields = '*') {
		if (!$this->id) {
			return false;
		}

		// SI EL PARAMETRO ES UN STRING LO PASO A UN ARRAY
		!is_array($fields) && $fields = array($fields);

		$keys = array();

		// FILTRO LOS CAMPOS Y AJUSTO LOS NOMBRES DE LOS CAMPOS SOLICITADOS A LOS REALES DE LA BBDD
		foreach ($fields as $field) {
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

			if (preg_match(self::$RGX_BD, $field)) {
				$keys[] = $field;
			}
		}

		if (count($keys)) {
			$q = "SELECT " . implode(', ', array_unique($keys)) . " FROM cefalometrias WHERE id_cefalometria = {$this->id}";
			$_ = $this->db->oneRowQuery($q);

			if (!$_) {
				return false;
			}

			if (isset($_['datos_json'])) {
				$json_decode = (array) json_decode($_['datos_json']);
				$this->session = isset($json_decode['session']) ? (array) $json_decode['session'] : array();
				$this->name = isset($json_decode['name']) ? $json_decode['name'] : null;;
				$this->cantidad = count($this->session);
			}

			if (isset($_['fecha_hora'])) {
				$this->fecha_hora  = date('d/m/y', strtotime($_['fecha_hora']));
			}

			if (isset($_['tipo'])) {
				$this->tipo = defined( "CEFALOMETRIA_TIPO_{$_['tipo']}" ) ? constant("CEFALOMETRIA_TIPO_{$_['tipo']}") : CEFALOMETRIA_OTRO; 
			}

			if (isset($_['etapa'])) {
				$this->etapa = defined( "ETAPA_{$_['etapa']}" ) ? constant("ETAPA_{$_['etapa']}") : ETAPA_INICIALES; 
			}

			if (isset($_['id_tratamiento'])) {
				$this->Treatment = new Treatment($_['id_tratamiento']);
				$this->url = crypt_params(array(CEFALOMETRIA => $this->id, TRATAMIENTO => $this->Treatment->id, PACIENTE => $this->Treatment->paciente->id));
			}

			if (isset($_['eliminado'])) {
				$this->eliminado = $_['eliminado'];
			}
		}

		return $this;
	}
	public function update($data = null) 
	{
		// ES NECESARIO EL id Y LA INFO
		if (!$this->id) {
			return false;
		}

		$fields = array();

		if (!is_array($data)) {
			$data = array('session' => $this->session, 'etapa' => $this->etapa, 'tipo' => $this->tipo, 'fecha_hora' => $this->fecha_hora);
		}

		if (!empty($data['session'])) {
			$session = array_merge($this->session , $data['session']);
			$datos_json = json_encode(array('name' => $this->name, 'session' => $session));
			$fields[] = "datos_json = '{$datos_json}'";
		}

		if (!empty($data['fecha_hora'])) {
			$format_date = format_date($data['fecha_hora']);
			$fields[] = "fecha_hora = '{$format_date}'";
		}

		if (!empty($data['etapa']) && defined( "BD_ETAPA_{$data['etapa']}" )) {
			$etapa = constant("BD_ETAPA_{$data['etapa']}");; 
			$fields[] = "etapa = {$etapa}";
		}

		if (!empty($data['tipo']) && defined( "BD_TIPO_{$data['tipo']}" )) {
			$tipo = constant("BD_TIPO_{$data['tipo']}");; 
			$fields[] = "tipo = {$tipo}";
		}
		
		if (!empty($fields)) {
			$q = "UPDATE cefalometrias SET " . implode(",", $fields) . " WHERE id_cefalometria = '{$this->id}'";
			$this->db->query($q);
		}

		return $this->select();
	}

	public function delete() 
	{
		// ES NECESARIO EL id Y LA INFO
		if (!$this->id) {
			return false;
		}

		$q = "UPDATE cefalometrias SET eliminado = 1 WHERE id_cefalometria = '{$this->id}'";
		
		return $this->db->query($q);
	}

	/**
	 * Elimina los campos de la session.
	 * Esta funcion es usada en actions/cefalometrias.php
	 *
	 * @return Bool Resultados de la query
	 * @param Array Las columnas que se quieren eliminar
	 */
	public function trash($fields)
	{
		$this->select('session');
		
		foreach ($this->session as $key => $src) {
			if (is_array($fields) && in_array($key, $fields)) {
				unset($this->session[$key]);
			}
		}

		$datos_json = addslashes(json_encode(array('name' => $this->name, 'session' => $this->session)));

		$q = "UPDATE cefalometrias SET datos_json = \"{$datos_json}\" WHERE id_cefalometria = {$this->id}";

		return $this->db->query($q);
	}

	public function get_picture($key) 
	{
		return isset($this->session[$key]) ? URL_ROOT . '/' . CEFALOMETRIAS_PATH . $this->session[$key] : null;
	}

	public function get_thumb($key) 
	{
		return isset($this->session[$key]) ? URL_ROOT . '/' . CEFALOMETRIAS_PATH . 'thumb/' . $this->session[$key] : null;
	}
	
	public static function get_session_model($model)
	{
		$varname = 'M' . $model;

		if (is_numeric($model) && isset(self::$$varname)) {
			return self::$$varname;
		}
	}
	/**
	 * concatena los datos para obtener la url necesaria para ver
	 *
	 * @return sting url para ver/editar la radiografia
	 * @param String $action ver|editar
	 * */
	public function url($action)
	{
		return trim(URL_ROOT, '/') . '/cefalometrias/' . trim($action, '/') . '/' . $this->url;
	}
}