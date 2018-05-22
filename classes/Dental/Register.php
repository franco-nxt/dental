<?php 

class Register {

	
	public $id;
	
	public $fecha_hora;
	
	public $motivo;
	
	public $descripcion;
	
	public $Treatment;

	public function __get($name) {
		if ($name == 'db') {
			return MySQL::getInstance();
		}
		elseif ($name == 'fecha') {
			return date("d/m/y", strtotime($this->fecha_hora));
		}
		elseif ($name == 'hora') {
			return date("H:i", strtotime($this->fecha_hora));
		}
		elseif (isset($this->{$name})) {
			return $this->{$name};
		}

		return null;
	}

	public function __construct($id = null) {
		if (is_array($id)) {
			// CREO EL REGISTRO
			$this->create($id);
		}
		elseif (is_numeric($id)) {
			// ASIGNO EL ID A LA INSTANCIA
			$this->id = $id;
		}
		else {
			// ALGO ESTA MAL
			throw new RegisterException('OCURRIO UN ERROR CON EL REGISTRO, VUELVA A INTENTARLO OTRA VEZ.');
		}
		// PROPS FILL
		$this->select();
	}

	/**
	 * Valida los datos enviados en el parametro, y
	 * crea una fila en la BD.
	 * Cuando el campo fecha_hora no es enviada hago
	 * un timestamp desde php.
	 * 
	 * @param  Array $data Array de datos asociativo.
	 */
	public function create($data)
	{
		// DATOS SON NECESARIOS PARA CREAR UN REGISTRO
		if (empty($data['id_tratamiento']) || !is_numeric($data['id_tratamiento'])) {
			throw new RegisterException('ERROR AL CARGAR EL REGISTRO, LOS DATOS SON INCORRECTOS');
		}
		if (isset($data['fecha'])) {
			// PUEDE VENIR POR SEPARADO, FORMATEO FECHA
			$date = self::format_date($data['fecha']);
			// NO ES OBLIGATORIO LA HORA
			if (!empty($data['hora'])) {
				$date .= " {$data['hora']}";
			}
			// SETEO CON LOS VALORES CORRECTOS
			$data['fecha_hora'] = date('Y-m-d H:i:s', strtotime($date));
		}
		elseif (isset($data['fecha_hora'])) {
			// CUANDO ES UN SOLO CAMPO, FORMATEO
			$date = self::format_date($data['fecha_hora']);
			// Y ASIGNO EL VALOR CORRECTO
			$data['fecha_hora'] = date('Y-m-d H:i:s', strtotime($date));
		}
		else {
			// FECHA POR DEFAULT
			$data['fecha_hora'] = date('Y-m-d H:i:s');
		}
		// CAMPOS
		$fields = array();
		// RECORRO LA INFO Y GUARDO LOS CAMPOS
		foreach ($data as $k => $v) {
			if (self:: valid_field($k) && $v) {
				$fields[$k] = $v;
			}
		}
		// IMPLODE CON LAS COLUMNAS
		$columns = implode(",", array_keys($fields));
		// IMPLODE CON LAS COLUMNAS
		$values = implode("','", array_values($fields));
		// ARMO LA QUERY
		$q = "INSERT INTO registros ({$columns}) VALUES ('{$values}')";
		// EJECUTO
		$this->db->query($q);
		// ASIGNO EL ID A LA INSTANCIA
		$this->id = $this->db->lastID();
	}

	/**
	 * Levanta el registro desde la BD.
	 * Completa las propiedades en la instancia y la retorna.
	 * 
	 * @return Register La misma instancia.
	 */
	public function select() 
	{
		// ES NECESARIO EL ID DE LA SESSION
		if (empty($this->id) || !is_numeric($this->id)) {
			throw new RegisterException('ERROR AL CARGAR EL REGISTRO.');
		}
		// ARMO LA QUERY
		$q = "SELECT id_registro AS id, fecha_hora, motivo, descripcion, id_tratamiento FROM registros WHERE id_registro = {$this->id}";
		// EJECUTO
		$_ = $this->db->oneRowQuery($q);

		foreach ($_ as $k => $v) {
			// FILL
			$this->{$k} = $v;
		}

		return $this;
	}

	/**
	 * Actualiza el el registro en la BD.
	 * 
	 * @throws RegisterException No hay un id para obtener los datos.
	 * @throws RegisterException El parametro data no es un array.
	 * @param Array $data Datos a guardar en BD.
	 */
	public function update($data = null) {
		// ES NECESARIO EL ID DE LA SESSION
		if (empty($this->id) || !is_numeric($this->id)) {
			throw new RegisterException('NO SE PUEDE ACTUALIZAR EL REGISTRO.');
		}
		// LA DATA ENVIADA ESTA MAL
		if (empty($data) || !is_array($data)) {
			throw new RegisterException('ERROR AL ACTUALIZAR EL REGISTRO. LOS DATOS SON INCORRECTOS.');
		}
		// SI LA FECHA NO ES ENVIADA DENTRO DE LOS DATOS LA MARCO YO
		if (isset($data['fecha']) && isset($data['hora'])) {
			$date = self::format_date($data['fecha']);
			$data['fecha_hora'] = date('Y-m-d H:i:s', strtotime($date . ' ' . $data['hora']));
		}
		elseif (isset($data['fecha']) && !isset($data['hora'])) {
			$date = self::format_date($data['fecha']);
			$data['fecha_hora'] = date('Y-m-d H:i:s', strtotime($date));
		}
		elseif (isset($data['fecha_hora'])) {
			$date = self::format_date($data['fecha_hora']);
			$data['fecha_hora'] = date('Y-m-d H:i:s', strtotime($date));
		}
		// VAR SET 
		$set = array();
		// FILL
		foreach ($data as $k => $v) {
			if (self:: valid_field($k)) {
				$set[] = "{$k} = '{$v}'";
			}
		}
		// IMPLODE EN LOS CAMPOS
		$implode = implode(",", $set);
		// ARMO LA QUERY
		$q = "UPDATE registros SET {$implode} WHERE id_registro = {$this->id}";
		// EJECUTO
		$this->db->query($q);
		// ACTUALIZO LA INSTANCIA
		$this->select();
	}

	/**
	 * Obtengo el tratamiento este registro.
	 *
	 * @throws RegisterException No hay un id para obtener los datos
	 * @throws TreatmentException  Al momento de obtener el Tratamiento
	 * @return Treatment Instancia del tratamiento asignado al Resumen
	 */
	public function get_treatment()
	{
		// ES NECESARIO EL ID DEL REGISTRO
		if (empty($this->id) && !is_numeric($this->id)) {
			throw new RegisterException('OCURRIO UN ERROR AL CARGAR EL REGISTRO.');
		}
		// QUERY
		$q = "SELECT id_tratamiento AS id FROM registros WHERE id_registro = {$this->id}";
		// OBTENGO EL ID DEL TRATAMIENTO
		$id_tratamiento = $this->db->oneFieldQuery($q);
		// RETORNO LA INSTANCIA
		return new Treatment($id_tratamiento);
	}

	/**
	 * Obtener la url segun el parametro que se mande.
	 * Si el parametro no es un string devuelve la url principal del odontograma del paciente.
	 *
	 * @throws RegisterException Al momento de obtener el Tratamiento en get_treatment .
	 * @throws TreatmentException  Al momento de obtener el Tratamiento en get_treatment .
	 * @param  String $action SubPath de la url que se solicita
	 * @return String         Url absoluta
	 */
	public function url($path = '') 
	{
		// OBTENGO EL TRATAMIENTO
		$Treatment = $this->get_treatment();
		// ARMO LA URI ENCRIPTADA
		$uri = crypt_params(array(REGISTRO => $this->id, TRATAMIENTO => $Treatment->id, PACIENTE => $Treatment->id_paciente));
		// EL PATH ACTION SOLO PUEDE SER VER/EDITAR
		if(!preg_match('/(ve|edita)r/i', $path)){
			$path = 'ver';
		}
		// ARMO LA URL COMPLETA
		$url = URL_ROOT . '/registros/' . strtolower($path) . '/' . $uri;

		return $url;
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
		return !empty($fieldname) && is_string($fieldname) && preg_match('/^(id_(registro|tratamiento)|fecha_hora|motivo|descripcion)$/', $fieldname);
	}

	/**
	 * Dada una fecha con formato d-m-y 
	 * devuelve otra al formato y-m-d.
	 * 
	 * @param  string $date Date a formatear.
	 * @return String       Date formatedo.
	 */
	private static function format_date($date)
	{
		preg_match('#^(?<D>\d{1,2})[\/|-](?<M>[0-2]?[1-9]|3[0-2])[\/|-](?<Y>\d{1,4})$#', $date, $result); 

		if ($result) {
			return $result['Y'] . '-' . $result['M'] . '-' . $result['D'];
		}

		return false;
	}
}