<?php 

/**
 * summary
 */
class Photo
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
		'eofrentesinsonrisa',
		'eofrenteconsonrisa',
		'eoperfilderechosinsonrisa',
		'eo34perfilderechoconsonrisa',
		'iofrontal',
		'iooverjet',
		'iolateralderecho',
		'iolateralizquierdo',
		'iooclusalsuperior',
		'iooclusalinferior'
	);

	private static $M2 = array(
		'eofrentesinsonrisa',
		'eofrenteconsonrisa',
		'eoperfilderechosinsonrisa',
		'iofrontal',
		'iolateralderecho',
		'iolateralizquierdo',
		'iooclusalsuperior',
		'iooclusalinferior'
	);

	private static $M3 = array(
		'eo01',
		'eo02',
		'iofrontal',
		'iolateralderecho',
		'iolateralizquierdo',
		'iooclusalsuperior',
		'iooclusalinferior'
	);

	private static $M4 = array(
		'eofrentesinsonrisa',
		'iofrontal',
		'iolateralderecho',
		'iolateralizquierdo',
		'iooclusalsuperior',
		'iooclusalinferior'
	);

	private static $M5 = array(
		'iofrontal',
		'iooverjet',
		'iolateralderecho',
		'iolateralizquierdo',
		'iooclusalsuperior',
		'iooclusalinferior'
	);

	private static $M6 = array(
		'iofrontal',
		'iolateralderecho',
		'iolateralizquierdo',
		'iooclusalsuperior',
		'iooclusalinferior'
	);

	private static $M7 = array(
		'iofrontal',
		'iolateralderecho',
		'iolateralizquierdo'
	);

	private static $M8 = array(
		'iouno',
		'iodos'
	);

	private static $M9 = array(
		'eofrentesinsonrisa',
		'eofrenteconsonrisa',
		'eoperfilderechosinsonrisa',
		'eo34perfilderechoconsonrisa'
	);

	private static $M10 = array(
		'eoperfilderechosinsonrisa',
		'eofrentesinsonrisa',
		'eofrenteconsonrisa'
	);

	private static $M11 = array(
		'eo01',
		'eo02'
	);

	private static $M12 = array(
		'eofrenteconsonrisa'
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

			$this->select(array('fecha_hora', 'etapa', 'cantidad', 'url'));
		}
		else{
			// EL PARAMETRO NO ES VALIDO
			throw new PhotoException('OCURRIO UN ERROR CON LA SESION FOTOGRAFICA, VUELVA A INTENTARLO OTRA VEZ.');
		}
	}

	/**
	 * Hace las validaciones y crea la session en BD.
	 *
	 * Para crear un registro en la base es necesario que SIEMPRE
	 * dentro de la informacion enviada esten el Array de session 
	 * que contiene los nombres de las imagenes y el id del tratamiento
	 * al que pertence la session de fotografias.
	 *
	 * @throws PhotoException Si falta alguno de los valores elementales (session, id_tratamiento).
	 * @param Array $data Array asociativo con la info de la session.
	 */
	private function create($data)
	{
		// DATOS SON NECESARIOS PARA CREAR UN REGISTRO, datos_json TIENE QUE SER UN JSON
		if (empty($data['session']) || empty($data['id_tratamiento'])  || !is_numeric($data['id_tratamiento'])) { 
			throw new PhotoException('ERROR AL CARGAR LA SESION FOTOGRAFICA, LOS DATOS SON INCORRECTOS');
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
		$q = stripslashes("INSERT INTO fotografias (id_tratamiento, fecha_hora, datos_json, etapa, eliminado) VALUES ({$id_tratamiento}, '{$date}', '{$datos_json}', {$etapa}, {$eliminado})");
		// EJECUTO
		$this->db->query($q);
		// ASIGNO EL ID A LA INSTANCIA
		$this->id = $this->db->lastID();
	}

	/**
	 * Methodo para traer info desde la BD
	 *
	 * @param Strign|Array $fields campos de la BBDD para seleccionar
	 * @return Photo Retorna la misma instancia
	 */
	public function select($fields = '*') 
	{
		// ES NECESARIO EL ID DE LA SESSION
		if (!$this->id) {
			throw new PhotoException('ERROR AL CARGAR LA SESION FOTOGRAFICA.');
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

			if (self::valid_field($field)) {
				$keys[] = $field;
			}
		}
		// SI HAY CAMPOS VALIDOS
		if (count($keys)) {
			// FILTRO LOS CAMPOS DUPLICADOS
			$unique_implode = implode(', ', array_unique($keys)); 
			// ARMO LA QUERY
			$q = "SELECT {$unique_implode} FROM fotografias WHERE id_fotografia = {$this->id}";
			// EJECUTO
			$_ = $this->db->oneRowQuery($q);

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
				$this->fecha_hora  = date('d/m/y', strtotime($_['fecha_hora']));
			}

			if (isset($_['etapa'])) {
				// SETEO LA ETAPA PARA EL FRONT
				$this->etapa = defined( "ETAPA_{$_['etapa']}" ) ? constant("ETAPA_{$_['etapa']}") : ETAPA_INICIALES; 
			}

			if (isset($_['id_tratamiento'])) {
				// EXTRAIGO EL TRATAMIENTO
				$this->Treatment = new Treatment($_['id_tratamiento']);
				// CON ESTOS DATOS YA PUEDO CREAR LA URL PARA LA SESSION
				$this->url = crypt_params(array(FOTOGRAFIA => $this->id, TRATAMIENTO => $this->Treatment->id, PACIENTE => $this->Treatment->paciente->id));
			}

			if (isset($_['eliminado'])) {
				// SI EL PACIENTE ESTA ELIMINADO
				$this->eliminado = (Bool) $_['eliminado'];
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
			throw new PhotoException('NO SE PUEDE ACTUALIZAR LA SESION FOTOGRAFICA.');
		}
		// LA DATA ENVIADA ESTA MAL
		if (empty($data) || !is_array($data)) {
			throw new PhotoException('ERROR AL ACTUALIZAR LA SESION FOTOGRAFICA. LOS DATOS SON INCORRECTOS.');
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
        // SI HAY CAMPOS PARA UPDATEAR
		if (!empty($fields)) {
			// IMPLODE SOBRE LOS SET DE CADA CAMPO
			$implode = implode(",", $fields);
			// ARMO LA QUERY 
			$q = stripslashes("UPDATE fotografias SET {$implode} WHERE id_fotografia = '{$this->id}'");
			// Y EJECUTO
			$this->db->query($q);
		}
		// ATUALIZO LA INSTANCIA
		return $this->select();
    }

    /**
     * Cambia el estado de la session a eliminado.
	 *
	 * Usada en actions/fotografias.php
     *
     * @return NULL
     */
    public function delete() {
        // ES NECESARIO EL id
        if (!$this->id) {
			throw new PhotoException('NO SE PUEDE ELIMINAR LA SESION FOTOGRAFICA.');
        }
        // QUERY PARA ELIMINAR
        $q = "UPDATE fotografias SET eliminado = 1 WHERE id_fotografia = '{$this->id}'";
        // EJECUTO LA QUERY
        $this->db->query($q);
    }

	/**
	 * Obtengo la imagen desde el tipo de fotografia 
	 * que es pasado por parametro. Si no lo encuentro
	 * devuelvo NULL.
	 *
	 * Usada en html/fotografias/*.php
	 *
	 * @param String $key Tiente que ser un tipo de fotografia apropiado para la session
	 * @return String Url de la imagen
	 */
	public function get_picture($key) 
	{
		// SOLO SI DENTRO DE LA COLLECCION LA ENVIO COMO UNA RUTA ABSOLUTA
		return !empty($this->session[$key]) ? URL_ROOT . '/' . FOTOGRAFIAS_PATH . $this->session[$key] : null;
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
		// SOLO SI DENTRO DE LA COLLECCION LA ENVIO COMO UNA RUTA ABSOLUTA
		return !empty($this->session[$key]) ? URL_ROOT . '/' . FOTOGRAFIAS_PATH . 'thumb/' . $this->session[$key] : null;
	}

	/**
	 * concatena los datos para obtener la url necesaria para ver
	 *
	 * Usada en html/fotografias/*.php y actions/fotografias.php
	 * 
	 * @return sting url para ver/editar la fotografia
	 * @param String $action ver|editar
	 * */
	public function url($action)
	{
		return trim(URL_ROOT, '/') . '/fotografias/' . trim($action, '/') . '/' . $this->url;
	}

	/**
	 * Elimina de la session los campos que son pasados 
	 * por parametro.
	 * 
	 * Esta funcion es usada en actions/fotografias.php
	 *
	 * @param Array Las columnas que se quieren eliminar
	 * @return Bool Resultados de la query
	 */
	public function trash($fields)
	{
		// LOS CAMPOS TIENEN QUE VENIR EN UN ARRAY
		if (!is_array($fields) || empty($fields)) {
			throw new PhotoException('LAS IMAGENES NO PUDIERON SER BORRADAS');
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
		$q = stripslashes("UPDATE fotografias SET datos_json = '{$datos_json}' WHERE id_fotografia = {$this->id}");
		// EJECUTO
		return $this->db->query($q);
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
	
	/**
	 * Se le pasa un numerico y retorna un modelo de session
	 * desde las props estaticas.
	 * Usada en los html/fotografias/[ver|editar|nueva].php
	 *
	 * @param Integer $model Un numerico que corresponda a un modelo de session.
	 * @return Array Si es que existe el modelo, retorna un array de strings.
	 */
	public static function get_session_model($model)
	{	
		// EL NUMERO DE MODELO TIENE QUE ESTAR SETEADO
		if (empty($model) || !is_numeric($model)) {
			throw new PhotoException('NO ENCONTRAMOS EL MODELO SOLICITADO.');
		}
		// INTENTO ARMAR EL NOMBRE DE MODELO
		$varname = 'M' . $model;
		// SI EXISTE EL MODELO
		if (isset(self::$$varname)) {
			return self::$$varname;
		}
		else{
			throw new PhotoException('NO ENCONTRAMOS EL MODELO SOLICITADO.');
		}
	}
}