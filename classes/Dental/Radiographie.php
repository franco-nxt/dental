<?php 
/**
 * summary
 */
class Radiographie
{
	/**
	 * @var [type]
	 */
	private static $RGX_BD = '#^(id_tratamiento|fecha_hora|datos_json|etapa|eliminado|\*)$#';
	

	/**
	 * @var Treatment
	 */
	public $Treatment;
	
	/**
	 * 
	 *
	 * @var string
	 */
	public $fecha_hora;
	
	/**
	 * 
	 *
	 * @var string
	 */
	public $datos_json;
	
	/**
	 * 
	 *
	 * @var string
	 */
	public $cantidad;
	
	/**
	 * 
	 *
	 * @var string
	 */
	public $name;
	
	/**
	 * 
	 *
	 * @var string
	 */
	public $etapa;

	/**
	 * 
	 *
	 * @var string
	 */
	public $url;
	
	/**
	 * 
	 *
	 * @var string
	 */
	public $eliminado;

    private static $M1 = array(
        'trx1',
        'panoramica'
    );

    private static $M2 = array(
        'trx1',
        'trx2',
        'panoramica'
    );

    private static $M3 = array(
        'panoramica'
    );

    private static $M4 = array(
        'trx1'
    );

    private static $M5 = array(
        'trx1',
        'trx2',
        'trx3'
    );

    private static $M6 = array(
        'trx1',
        'trx2',
        'trx3'
    );

    private static $M7 = array(
        'panoramica1',
        'panoramica2'
    );

    private static $M8 = array(
        'panoramica1',
        'panoramica2',
        'panoramica3'
    );

    private static $M9 = array(
        'trx1_',
        'trx2_'
    );

    private static $M10 = array(
        'trx1_',
        'trx2_',
        'trx3_'
    );

    private static $M11 = array(
        'trx1_',
        'trx2_',
        'trx3_',
        'trx4_'
    );

    private static $M12 = array(
        'trx1_',
        'trx2_',
        'trx3_',
        'trx4_',
        'trx5_',
        'trx6_'
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

		return $this->select(array('fecha_hora', 'etapa', 'cantidad', 'url'));
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

		$q = stripslashes("INSERT INTO radiografias (id_tratamiento, fecha_hora, datos_json, etapa, eliminado) VALUES ({$id_tratamiento}, '{$date}', '{$datos_json}', {$etapa}, {$eliminado})");

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
			//// $q = "SELECT X.eliminado, X.etapa, X.id_tratamiento AS tratamiento, X.fecha_hora, X.datos_json, T.id_paciente AS paciente FROM radiografias AS X INNER JOIN tratamientos AS T ON T.id_tratamiento = X.id_tratamiento WHERE X.id_radiografia = {$this->id}";
			$q = "SELECT " . implode(', ', array_unique($keys)) . " FROM radiografias WHERE id_radiografia = {$this->id}";
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

			if (isset($_['etapa'])) {
				$this->etapa = defined( "ETAPA_{$_['etapa']}" ) ? constant("ETAPA_{$_['etapa']}") : constant(ETAPA_INICIALES); 
			}

			if (isset($_['id_tratamiento'])) {
				$this->Treatment = new Treatment($_['id_tratamiento']);
				$this->url = crypt_params(array(RADIOGRAFIA => $this->id, TRATAMIENTO => $this->Treatment->id, PACIENTE => $this->Treatment->paciente->id));
			}

			if (isset($_['eliminado'])) {
				$this->eliminado = $_['eliminado'];
			}
		}

		return $this;
	}

    public function update($data = null) {
        // ES NECESARIO EL id Y LA INFO
        if (!$this->id) {
            return false;
        }

        $fields = array();

        if (!is_array($data)) {
            $data = array('session' => $this->session, 'etapa' => $this->etapa, 'fecha_hora' => $this->fecha_hora);
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
        
		if (!empty($fields)) {
			$q = "UPDATE radiografias SET " . implode(",", $fields) . " WHERE id_radiografia = '{$this->id}'";
			$this->db->query($q);
		}

		return $this->select();
    }

    public function delete() {
        // ES NECESARIO EL id Y LA INFO
        if (!$this->id) {
            return false;
        }

        $q = "UPDATE radiografias SET eliminado = 1 WHERE id_radiografia = '{$this->id}'";
		
		return $this->db->query($q);
    }

	/**
	 * Elimina los campos de la session.
	 * Esta funcion es usada en actions/radiografias.php
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

		$q = "UPDATE radiografias SET datos_json = \"{$datos_json}\" WHERE id_radiografia = {$this->id}";

		return $this->db->query($q);
	}

	

	/**
	 * Obtengo la imagen desde el tipo de radiografia 
	 * que es pasado por parametro. Si no lo encuentro
	 * devuelvo el palceholder en la constante.
	 *
	 * @param String $key Tiente que ser un tipo de radiografia apropiado para la session
	 * @return String Url de la imagen
	 */
	public function get_picture($key) 
	{
		return isset($this->session[$key]) ? URL_ROOT . '/' . RADIOGRAFIAS_PATH . $this->session[$key] : null;
	}

	public function get_thumb($key) 
	{
		return isset($this->session[$key]) ? URL_ROOT . '/' . RADIOGRAFIAS_PATH . 'thumb/' . $this->session[$key] : null;
	}

	/**
	 * Se le pasa un numerico y retorna un modelo de session
	 * desde las props estaticas.
	 * Usada en los html/radiografias/[ver|editar|nueva].php
	 *
	 * @return Array Si es que existe el modelo, retorna un array de strings.
	 * @param Integer $model Un numerico que corresponda a un modelo de session.
	 */
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
		return trim(URL_ROOT, '/') . '/radiografias/' . trim($action, '/') . '/' . $this->url;
	}
}