<?php 
/**
 * summary
 */
class Radiographie
{
	/**
	 * @var Treatment
	 */
	public $Treatment;
	
	/**
	 * @var string
	 */
	public $fecha_hora;
	
	/**
	 * @var string
	 */
	public $datos_json;
	
	/**
	 * @var string
	 */
	public $cantidad;
	
	/**
	 * @var string
	 */
	public $name;
	
	/**
	 * @var string
	 */
	public $etapa;

	/**
	 * @var string
	 */
	public $url;
	
	/**
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
		else{
			// EL PARAMETRO NO ES VALIDO
			throw new RadiographieException('OCURRIO UN ERROR CON LA SESION DE RADIOGRAFIAS, VUELVA A INTENTARLO OTRA VEZ.');
		}
		// ACTUALIZO LOS DATOS DE LA INSTANCIA
		$this->select(array('fecha_hora', 'etapa', 'cantidad', 'url'));
	}

	/**
	 * Hace las validaciones y crea la session en BD.
	 *
	 * Para crear un registro en la base es necesario que SIEMPRE
	 * dentro de la informacion enviada esten el Array de session 
	 * que contiene los nombres de las imagenes y el id del tratamiento
	 * al que pertence la session de imagenes.
	 *
	 * @throws RadiographieException Si falta alguno de los valores elementales (session, id_tratamiento).
	 * @param Array $data Array asociativo con la info de la session.
	 */
	private function create($data)
	{
		// DATOS SON NECESARIOS PARA CREAR UN REGISTRO, datos_json TIENE QUE SER UN JSON
		if (empty($data['session']) || empty($data['session']) || empty($data['id_tratamiento'])  || !is_numeric($data['id_tratamiento'])) { 
			throw new RadiographieException('ERROR AL CARGAR LA SESION FOTOGRAFICA, LOS DATOS SON INCORRECTOS');
		}
		// ELIMINADO POR DEFECTO ES FALSE
		$eliminado = 0;
		// VAR $id_tratamiento
		$id_tratamiento = $data['id_tratamiento'];
		// FORMATEO EL JSON DE LA SESSION (NOMBRE : SESSION) Y LO ENCODEO
		$datos_json = json_encode(array('name' => $data['name'], 'session' => $data['session']));
		// SI NO VIENE UNA FECHA CARGADA LA SETEO YO
		$date = !empty($data['fecha_hora']) ? format_date($data['fecha_hora']) : date('Y-m-d H:i:s');
		// SI NO VIENE UNA ETAPA CARGADA POR DEFECTO ES INICIALES
		$etapa = !empty($data['etapa']) && defined( "BD_ETAPA_{$data['etapa']}" ) ? constant("BD_ETAPA_{$data['etapa']}") : BD_ETAPA_INICIALES; 
		// QUERY FINALE
		$q = stripslashes("INSERT INTO radiografias (id_tratamiento, fecha_hora, datos_json, etapa, eliminado) VALUES ({$id_tratamiento}, '{$date}', '{$datos_json}', {$etapa}, {$eliminado})");
		// EJECUTO
		$this->db->query($q);
		// ASIGNO EL ID A LA INSTANCIA
		$this->id = $this->db->lastID();
	}

	/**
	 * Methodo para traer 
	 *
	 * @return void
	 * @author 
	 */
	public function select($fields = '*') 
	{
		// ES NECESARIO EL ID DE LA SESSION
		if (!$this->id) {
			throw new RadiographieException('ERROR AL CARGAR LA SESION DE RADIOGRAFIAS.');
		}
		// SI EL PARAMETRO ES UN STRING LO PASO A UN ARRAY
		!is_array($fields) && $fields = array($fields);
		// VAR COLUMNAS DE LA BBDD
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

			if ($fields == '*' && self::valid_field($field)) {
				$keys[] = $field;
			}
		}
		// SI HAY CAMPOS VALIDOS
		if (count($keys)) {
			// FILTRO LOS CAMPOS DUPLICADOS
			$implode_nique = implode(', ', array_unique($keys));
			// ARMO LA QUERY
			$q = "SELECT {$implode_nique} FROM radiografias WHERE id_radiografia = {$this->id}";
			// EJECUTO
			$_ = $this->db->oneRowQuery($q);

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

    public function update($data) 
    {
		// ES NECESARIO EL ID DE LA SESSION
		if (!$this->id) {
			throw new RadiographieException('NO SE PUEDE ACTUALIZAR LA SESION DE RADIOGRAFIAS.');
		}
		// LA DATA ENVIADA ESTA MAL
		if (empty($data) || !is_array($data)) {
			throw new RadiographieException('ERROR AL ACTUALIZAR LA SESION DE RADIOGRAFIAS. LOS DATOS SON INCORRECTOS.');
		}
		// VAR PARA GUARDAR LOS "SETS" DE LA QUERY
        $fields = array();

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
        
        // SI HAY CAMPOS PARA UPDATEAR
		if (!empty($fields)) {
			// IMPLODE SOBRE LOS SET DE CADA CAMPO
			$implode = implode(",", $fields);
			// ARMO LA QUERY 
			$q = "UPDATE radiografias SET {$implode} WHERE id_radiografia = '{$this->id}'";
			// Y EJECUTO
			$this->db->query($q);
		}
		// ATUALIZO LA INSTANCIA
		return $this->select();
    }

    public function delete() {
        // ES NECESARIO EL id
        if (!$this->id) {
			throw new RadiographieException('NO SE PUEDE ELIMINAR LA SESION DE RADIOGRAFIAS.');
        }
        // QUERY PARA ELIMINAR
        $q = "UPDATE radiografias SET eliminado = 1 WHERE id_radiografia = '{$this->id}'";
        // EJECUTO LA QUERY
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
		// LOS CAMPOS TIENEN QUE VENIR EN UN ARRAY
		if (!is_array($fields) || empty($fields)) {
			throw new RadiographieException('LAS IMAGENES NO PUDIERON SER BORRADAS');
		}
		// PRIMERO ACTUALIZO LA INSTANCIA
		$this->select('session');
		// RECORRO LA COLECCION DE IMAGENES
		foreach ($this->session as $key => $src) {
			// SI ES UNA DE LA IMAGENES SOLICITADAS
			if (in_array($key, $fields)) {
				// LA ELIMINO
				unset($this->session[$key]);
			}
		}
		// CON LOS DATOS NUEVOS ACTUALIZO EN BD
		$datos_json = json_encode(array('name' => $this->name, 'session' => $this->session));
		// ARMO LA QUERY
		$q = addslashes("UPDATE radiografias SET datos_json = '{$datos_json}' WHERE id_radiografia = {$this->id}");
		// EJECUTO
		return $this->db->query($q);
	}	

	/**
	 * Obtengo la imagen desde el tipo de fotografia 
	 * que es pasado por parametro. Si no lo encuentro
	 * devuelvo NULL.
	 *
	 * Usada en html/radiografias/*.php
	 *
	 * @param String $key Tiente que ser un tipo de fotografia apropiado para la session
	 * @return String Url de la imagen
	 */
	public function get_picture($key) 
	{
		return isset($this->session[$key]) ? URL_ROOT . '/' . RADIOGRAFIAS_PATH . $this->session[$key] : null;
	}

	/**
	 * Se le pasa el titulo de la imagen que se 
	 * quiere el thumb. Si no lo encuentro
	 * devuelvo NULL.
	 *
	 * @param String $key Tiente que ser un tipo de fotografia apropiado para la session
	 * @return String Url de la imagen
	 */
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
		// EL NUMERO DE MODELO TIENE QUE ESTAR SETEADO
		if (empty($model) || !is_numeric($model)) {
			throw new RadiographieException('NO ENCONTRAMOS EL MODELO SOLICITADO.');
		}
		// INTENTO ARMAR EL NOMBRE DE MODELO
		$varname = 'M' . $model;
		// SI EXISTE EL MODELO
		if (isset(self::$$varname)) {
			return self::$$varname;
		}
		else{
			throw new RadiographieException('NO ENCONTRAMOS EL MODELO SOLICITADO.');
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
		return !empty($fieldname) && is_string($fieldname) && preg_match('/^(id_tratamiento|fecha_hora|datos_json|e(tapa|liminado))$/', $fieldname);
	}
}