<?php 

/**
 * summary
 */
class Payment
{
	/**
	 * @var String
	 */
	public $id;
	
	/**
	 * @var String
	 */
	public $id_tratamiento;
	
	/**
	 * @var String
	 */
	public $fecha_hora;
	
	/**
	 * @var String
	 */
	public $monto;
	
	/**
	 * @var String
	 */
	public $anotaciones;
	
	/**
	 * @var String
	 */
	public $motivo;
	
	/**
	 * @var String
	 */
	public $acumulado;
	
	/**
	 * @var String
	 */
	public $balance;

	public function __get($name) 
	{
		if ($name == 'db') {
			return MySQL::getInstance();
		}
		elseif ($name == 'tratamiento') {
			return new Treatment($this->id_tratamiento);
		}
		elseif ($name == 'fecha') {
			return $this->fecha_hora;
		}
		elseif (isset($this->{$name})) {
			return $this->{$name};
		}

		return null;
	}

	/**
	 * Instancia un registro de pago desde la BD si es que 
	 * $id es un numerico, si es un Array llama a create
	 * pasandole por parametro ese mismo Array.
	 *
	 * @throws PaymentException Si $id no es valido.
	 * @throws PaymentException Desde create.
	 * @param Mixed $id Id numerico o Array asociativo.
	 */
	public function __construct($id) 
	{
		if (is_numeric($id)) {
			// ASIGNO EL ID A LA INSTANCIA
			$this->id = $id;
		}
		elseif (is_array($id)) {
			// CREAMOS UN NUEVO REGISTRO
			$this->create($id);
		}
		else{
			// $id NO ES VALIDO
			throw new PaymentException('OCURRIO UN ERROR CON EL REGISTRO DE PAGO, VUELVA A INTENTARLO OTRA VEZ.',1);
		}
		// ACTUALIZO LOS DATOS DE LA INSTANCIA
		$this->select();
	}

	/**
	 * Crea el registro de pago en la BD.
	 * @param  Array $data Array de datos a guardar.
	 */
	private function create($data)
	{
		// CAMPOS NECESARIOS
		if (empty($data['id_tratamiento']) || empty($data['monto']) || !is_numeric($data['id_tratamiento']) || !is_numeric($data['monto'])) {
			throw new PaymentException('NO SE PUEDE REGISTRAR EL PAGO PORQUE LOS DATOS ENVIADOS SON ERRONEOS.');
		}
		// ACA GUARDO LAS COLS
		$keys = array('fecha_hora');
		// ACA GUARDO LOS VALUES
		$values = array();
		// SI NO HAY FECHA DE PAGO
		if (empty($data['fecha_hora'])) {
			// POR DEFAULT ES HOY
			$data['fecha_hora'] = date('Y-m-d H:i:s');
		}
		else {
			// SI NO FORMATEO LA FECHA ENVIADA
			$data['fecha_hora'] = date('Y-m-d H:i:s', strtotime(self::format_date($data['fecha_hora'])));
		}
		// GUARDO LOS CAMPOS
		foreach ($data as $k => $v) {
			if (self::valid_field($k)) {
				$fields[$k] = $this->db->escape($v);
			}
		}
		// PARA CONTINUAR NECESITO DATOS DEL TRATAMIENTO
		$Treatment = new Treatment($data['id_tratamiento']);
		$Treatment->select('presupuesto');
		// CALCULO EL ACUMULADO PARA EL PAGO
		$acumulado = $Treatment->acumulado() + ($data['monto'] + 0);
		$fields['acumulado']  = $acumulado;
		// Y CALCULO TAMBIEN EL BALANCE PARA EL PAGO
		$fields['balance'] = ($Treatment->presupuesto + 0) - $acumulado;
		// ARMO LA QUERY
		$implode_values = implode("','", $fields);
		$implode_keys = implode(",", array_keys($fields));

		$q = "INSERT INTO pagos ({$implode_keys}) VALUES ('{$implode_values}')";
		// EJECUTO
		$this->db->query($q);
		// ASINGO EL ID A LA INSTANCIA
		$this->id = $this->db->lastID();
	}

	/**
	 * Levanta los campos desde la BD y actualiza la Instancia.
	 * 
	 * @param  Mixed $data Un string con los campo/s o Array de Strin con los campos.
	 * @return Payment     Retorna la misma instancia.
	 */
	public function select($data = '*') 
	{
		// ES NECESARIO EL ID DEL PAGO
		if (empty($this->id) || !is_numeric($this->id)) {
			throw new PaymentException('NO SE PUEDE CARGAR lOS DATOS DEL PAGO');
		}
		// ES NECESARIO EL ID DEL PAGO
		if (empty($data)) {
			throw new PaymentException('NO SE PUEDE CARGAR lOS DATOS DEL PAGO. LOS DATOS ENVIADOS SON ERRONEOS.');
		}
		// SI EL PARAMETRO ES UN STRING LO PASO A UN ARRAY
		!is_array($data) && $data = array($data);
		// VAR PARA GUARDAR LAS COLUMNAS DEL SELECT
		$keys = array();
		// FILTRO LOS CAMPOS Y AJUSTO LOS NOMBRES DE LOS CAMPOS SOLICITADOS A LOS REALES DE LA BBDD
		foreach ($data as $field) {
			// FILTRO LOS CAMPOS VALIDOS
			if ($field == '*' || self::valid_field($field)) {
				$keys[] = $field;
			}
		}

		if (count($keys)) {
			// FILTRO LOS CAMPOS DUPLICADOS
			$implode_unique = implode(', ', array_unique($keys));
			// ARMO LA QUERY
			$q = "SELECT {$implode_unique} FROM pagos WHERE id_pago = {$this->id}";
			// EJECUTO
			$_ = $this->db->oneRowQuery($q);
			// SETEO LAS PROPS
			foreach ($_ as $k => $v) {

				if ($k == 'fecha_hora') {
					$this->{$k} = date('d/m/Y', strtotime($v));
				}
				else{
					$this->{$k} = $v;
				}
			}
			// NECESITO EL TRATAMIENTO
			$Treatment = $this->get_treatment();
			// APRA ARMAR LA URI DEL PAGO			
			$this->url = crypt_params(array(PAGO => $this->id, TRATAMIENTO => $Treatment->id, PACIENTE => $Treatment->id_paciente));

			return $this;
		}
	}

	/**
	 * Eliminar el registro de la BD.
	 * Despues de esto tendria que hacerce un balance del tratamiento.
	 * Y actualizar los registros de pago del tratamiento.
	 */
	public function delete() 
	{
		// ES NECESARIO EL ID DEL PAGO
		if (empty($this->id) || !is_numeric($this->id)) {
			throw new PaymentException('NO SE PUEDE ELIMINAR lOS DATOS DEL PAGO.');
		}
		// ARMO LA QUERY
		$q = "DELETE FROM pagos WHERE id_pago = '{$this->id}';";
		// LO ELIMINO
		$this->db->query($q);
	}

	/**
	 * Esta funcion actualiza el registro en la
	 * BD pero usa los datos de la instancia.
	 */
	public function update() 
	{
		// ES NECESARIO EL ID DEL PAGO
		if (empty($this->id) || !is_numeric($this->id)) {
			throw new PaymentException('NO SE PUEDE ELIMINAR lOS DATOS DEL PAGO.');
		}
		// USANDO LOS DATOS DE LA MISMA INSTANCIA ARMO LA QUERY
		$q = "UPDATE pagos SET acumulado ='{$this->acumulado}', balance ='{$this->balance}' WHERE id_pago = '{$this->id}';";
		// EJECUTO
		$this->db->query($q);
	}

	/**
	 * concatena los datos para obtener la url necesaria.
	 * 
	 * @param string $path subpath para armar la url.
	 * @return sting url absoluta.
	 */
	public function url($path = 'ver') 
	{
		// LA URL NO ES LA CORRECTA
		if (empty($this->url)) {
			throw new PaymentException('OCURRIO UN ERROR, NO SE ENCUENTRA EL PAGO SOLICITADO.');
		}
		// PATH TIENE QUE SER UN STRING
		if (!is_string($path)) {
			throw new PaymentException('OCURRIO UN ERROR, NO SE ENCUENTRA EL PAGO SOLICITADO. LOS DATOS ENVIADOS SON INCORRECTOS.');
		}
		// EL SUBPATH DEL LA URL
		$path = trim($path);
		// URL BASE
		$base = trim(URL_ROOT, '/');
		// URL FINAL
		return  "{$base}/economia/$path/{$this->url}";
	}

	/**
	 * Obtengo el tratamiento del Odontograma.
	 *
	 * @throws PaymentException    No hay un id para obtener los datos
	 * @throws TreatmentException  Al momento de obtener el Tratamiento
	 * @throws PatientException    Al momento de obtener el Tratamiento
	 * @return Treatment Instancia del tratamiento asignado al odontograma
	 */
	public function get_treatment()
	{
		// RETORNO LA INSTANCIA
		return new Treatment($this->id_tratamiento);
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
		return !empty($fieldname) && is_string($fieldname) && preg_match('/^(id_tratamiento|fecha_hora|monto|anotaciones|motivo|acumulado|balance)$/', $fieldname);
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
	}
}

