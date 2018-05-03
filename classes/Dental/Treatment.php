<?php 

class Treatment
{
	
	/**
	 * @var Numeric
	 */
	public $id;
	
	/**
	 * @var Numeric
	 */
	public $id_paciente;
	
	/**
	 * @var Numeric
	 */	
	public $id_examen;
	
	/**
	 * @var Numeric
	 */	
	public $id_historia;
	
	/**
	 * @var Numeric
	 */	
	public $id_diagnostico;
	
	/**
	 * @var Numeric
	 */	
	public $id_resumen;
	
	/**
	 * @var Numeric
	 */	
	public $id_odontograma;
	
	/**
	 * @var String
	 */	
	public $fecha_hora_inicio;
	
	/**
	 * @var String
	 */	
	public $tecnica;
	
	/**
	 * @var String
	 */	
	public $descripcion;
	
	/**
	 * @var String
	 */	
	public $duracion;
	
	/**
	 * @var String
	 */	
	public $estado;
	
	/**
	 * @var String
	 */	
	public $presupuesto;
	
	/**
	 * @var String
	 */	
	public $eliminado;
	
	/**
	 * @var String
	 */	
	public $fecha_hora_final;
	
	/**
	 * @var Patient
	 */
	public $Patient;
	
	/**
	 * @var Array
	 */
	public $registers = array();
	
	/**
	 * @var Array
	 */
	public $payments = array();
	
	/**
	 * @var Array
	 */
	public $photos = array();
	
	/**
	 * @var Array
	 */
	public $radiographies = array();
	
	/**
	 * @var Array
	 */	
	public $cephalometries = array();
	
	/**
	 * @var Odontogram
	 */
	public $Odontogram;
	
	/**
	 * @var History
	 */
	public $History;
	
	/**
	 * @var Exam
	 */
	public $Exam;
	
	/**
	 * @var Diagnostic
	 */
	public $Diagnostic;
	
	/**
	 * @var Resume
	 */
	public $Resume;

	
	public function __get($name) {
		if ($name == 'db') {
			return MySQL::getInstance();
		}
		elseif (isset($this->{$name})) {
			return $this->{$name};
		}
		elseif($name == 'paciente'){
			return $this->patient();
		}
		elseif($name == 'inicio'){
			return date('d/m/y', strtotime($this->fecha_hora_inicio));
		}
		else{
			return $this->select($name)->{$name};
		}
	}

	/**
	 * Contructor para Taramiento.
	 *
	 * @throws TreatmentException Si el tratamiento no existe.
	 * @throws TreatmentException Si $id es invalido.
	 * @param Mixed $id Un Numeric para levantar los datos de la BD y un Array de datos para crear un registro.
	 */
	public function __construct($id)
	{
		// CUANDO VIENE UN ARRAY 
		if (is_array($id)) {
			// ES PARA CREAR UN TRATAMIENTO
			$this->create($id);
		}
		elseif (is_numeric($id)) {
			// SI ES UN NUMERICO 
			$q = "SELECT {$id} IN (SELECT id_tratamiento FROM tratamientos WHERE id_tratamiento = {$id})";
			// VALIDO QUE EXISTA
			$treatment_exist = $this->db->oneFieldQuery($q);
			// SI NO EXISTE EL TRATAMIENTO
			if (!$treatment_exist) {
				throw new TreatmentException('EL TRATAMIENTO INDICADO NO EXISTE');
			}
			// SI NO ASIGNO EL ID A LA INSTANCIA
			$this->id = $id;
			// ARMO LA URI ENCODEADA CON LOS DATOS
			$this->url = crypt_params(array(TRATAMIENTO => $this->id, PACIENTE => $this->id_paciente));
		}
		else{
			throw new TreatmentException('OCURRIO UN ERROR CON EL TRATAMIENTO DEL PACIENTE, VUELVA A INTENTARLO OTRA VEZ.');
		}
	}

	/**
	 * Creo el tratamiento en la tabla tratamientos.
	 * Valido y preseteo los datos enviados por parametro.
	 * Y asigna el id del registro creado a la instancia.
	 * 
	 * @throws OdontogramaException Desde el contructor Odontograma.
	 * @throws HistoryException Desde el contructor History.
	 * @throws ExamException Desde el contructor Exam.
	 * @throws DiagnosticException Desde el contructor Diagnostic.
	 * @throws ResumeException Desde el contructor Resume.
	 * @param Array $data Array asociativo con datos del tratamiento.
	 */
	private function create($data)
	{
		// POR DEFAULT EL ESTADO ES ACTIVO
		$fields = array('estado' => BD_TRATAMIENTO_ACTIVO);
		// FORMATEO LA FECHA DE INICIO ENVIADA, O SETEO NOW POR DEFAULT
		$data['fecha_hora_inicio'] = empty($data['fecha_hora_inicio']) ? date('Y-m-d H:i:s') : format_date($data['fecha_hora_inicio']);
		// SI LA TECNICA NO VIENE, ENTONCES USO UNA DEFAULT
		$data['tecnica'] = isset($data['tecnica']) && is_numeric($data['tecnica']) ? $data['tecnica'] : BD_TECNICA_DEFAULT;
		// FILTRO LOS CAMPOS VALIDOS
		foreach ($data as $k => $v) {
			// VALIDO QUE EL CAMPO SEA VALIDO
			if (self::valid_field($k) && $v) {
				// Y AGREGO EL VALOR
				$value = $this->db->escape(utf8_decode($v));

				if ($value) {
					$fields[$k] = $value;
				}
			}
		}
		// CREO EL ODONTOGRAMA PARA EL TRATAMIENTO
		$Odontogram = new Odontogram();
		$fields['id_odontograma'] = $Odontogram->id;
		// LA HISTORIA DEL DIAGNOSTICO PARA EL TRATAMIENTO
		$History = new History();
		$fields['id_historia'] = $History->id;
		// ASIGNO EXAMEN AL TRATAMIENTO
		$Exam = new Exam();
		$fields['id_examen'] = $Exam->id;
		// AGEGO EL DIAGNOSTICO PARA EL TRATAMIENTO
		$Diagnostic = new Diagnostic();
		$fields['id_diagnostico'] = $Diagnostic->id;
		// CREO EL RESUMEN DEL DIAGNOSTICO PARA EL TRATAMIENTO
		$Resume = new Resume();
		$fields['id_resumen'] = $Resume->id;
		// IMPLODE CON LAS COLUMNAS
		$implode_keys = implode(",", array_keys($fields));
		// IMPLODE CON LOS VALORES
		$implode_values = implode(",", array_values($fields));
		// ARMO LA QUERY
		$q = "INSERT INTO tratamientos ({$implode_keys}) VALUES ('{$implode_values}')";
		// EJECUTO LA QUERY
		$this->db->query($q);
		// SETEO EL ID A LA INSTANCIA
		$this->id = $this->db->lastID();
	}

	/**
	 * A esta func se le dan los campos para hacer un pull desde la bbdd, 
	 * los argumentos puede ser un campo o muchos dentro de un array.
	 *
	 * @throws TreatmentException Si falta el id de la instancia.
	 * @param string|array $data nombres validos campo/s .
	 * @return Tratamiento su propia instancia.
	 * */
	public function select($data = '*') 
	{
		if (empty($this->id) || !is_numeric($this->id)) {
			throw new TreatmentException('NO SE PUEDEN CARGAR LOS DATOS DEL TRATAMIENTO.');
		}
		// SI EL PARAMETRO ES UN STRING LO PASO A UN ARRAY
		is_string($data) && $data = array($data);

		if (is_array($data)) {
			$keys = array();

			// FILTRO LOS CAMPOS INVALIDOS
			foreach ($data as $fieldname) {
				// VALIDO EL NOMBRE DEL CAMPO
				if ($fieldname == '*' || self::valid_field($fieldname)) {
					$keys[] = $fieldname;
				}
			}

			if (count($keys)) {
				// FILTRO LAS COLUMNAS REPETIDAS Y HAGO UN IPLODE
				$implode_keys = implode(', ', array_unique($keys));
				// ARMO LA QUERY
				$q = "SELECT {$implode_keys} FROM tratamientos WHERE id_tratamiento = {$this->id}";
				// TRAIGO EL REGISTRO DE LA BD
				$tratamiento = $this->db->oneRowQuery($q);
				// ACTUALIZO LAS PROPS DE LA ISNTANCIA
				foreach ($tratamiento as $k => $v) {
					switch ($k) {
						case 'fecha_hora_inicio':
						$this->{$k} = $v; 
						break;
						case 'estado':
						$this->estado = is_numeric($v) ? constant('TRATAMIENTO_ESTADO_' . $v) : $v; 
						break;
						case 'tecnica':
						$this->tecnica = is_numeric($v) ? constant('TECNICA_' . $v) : $v; 
						break;
						default: 
						$this->{$k} = utf8_encode($v); 
						break;
					}
				}
			}
		}

		return $this;
	}

	/**
	 * Calcula el progreso del tratamiento.
	 *
	 * Si esta funcion ya fue llamada retorna el calculo anterior.
	 * 
	 * @return Integer Progreso del tratamiento.
	 */
	public function progress()
	{
		// SI YA CALCULE EL PROGRESO 
		if (!empty($this->progress)) {
			return $this->progress;
		}
		// VALIDO LA DURACION
		if (!is_numeric($this->duracion) || empty($this->duracion)) {
			return false;
		}
		// FECHA DE INICIO
		$ini = strtotime($this->fecha_hora_inicio);
		// DESDE MARCA DE TIEMPO UNIX DE LA FECHA DE INICIO MAS LA DURACION EN MESES
		$mktime = mktime(0, 0, 0, date('m', $ini) + $this->duracion, date('d', $ini), date('Y', $ini));
		// FORMATEO LA FECHA FINAL
		$end = date('Y-m-d H:i:s', $mktime);

		if ($mktime > time()) {
			$total = 100 / diff_date($this->fecha_hora_inicio, $end);

			$this->progress = round(diff_date($this->fecha_hora_inicio, date('Y-m-d H:i:s')) * $total);

			return $this->progress;
		}
		else {
			return 100;
		}
	}

	/**
	 * Valida los datos y actualiza el registro en la base.
	 * Si no se le pasa un array por parametro, actualiza 
	 * los datos usando las props de la misma instancia.
	 * 
	 * @throws TreatmentException Si falta el id de la instancia.
	 * @param  Array $data Array asociativo con los datos a actualizar.
	 */
	public function update($data = null) 
	{
		if (empty($this->id) || !is_numeric($this->id)) {
			throw new TreatmentException('NO SE PUEDEN CARGAR LOS DATOS DEL TRATAMIENTO.');
		}
		// CAMPOS A ACUTALIZAR
		$fields = array();
		// ESTO LO EXPLICO ARRIBA
		if (!is_array($data) || empty($data)) {
			$data = (array) $this;
		}

		foreach ($data as $k => $v) {
			// CORRIGO LOS NOMBRES DE LAS PROPS Y LOS VALORES
			switch ($k) {
				case 'fecha':
				case 'fecha_inicio':
				case 'fecha_hora_inicio':
				$v = format_date($v);
				$k = 'fecha_hora_inicio';
				break;
				case 'estado':
					// PARA SETEAR EL ESTADO DEL TRATAMIENTO TENGO QUE PASAR POR ESTE JUEGO DE CONSTANTES
				if (defined("TRATAMIENTO_{$v}")) {
						// SI EL ESTADO ES FINALIZADO, SETEO LA HORA DE FINALIZACION
					if (constant("TRATAMIENTO_{$v}") == TRATAMIENTO_FINALIZADO) {
						$fields[] = "fecha_hora_final = '" . date('Y-m-d H:i:s') . "'";
					}
						// ACA GUARDO SOLO LAS CONSTANTES PARA LA BD ej. TRATAMIENTO_BD_INACTIVO = 1
					$v = constant("BD_TRATAMIENTO_{$v}");
				}
				break;
			}

			if (preg_match('/^(fecha_hora_inicio|(estad|presupuest|eliminad)o|tecnica|(descrip|dura)cion)$/', $k) && $v) {
				$fields[] = utf8_decode("{$k} = '{$v}'");
			}
		}

		// SOLO SI HAY CAMPOS PARA ACTUALIZAR
		if (!empty($fields)) {
			$implode = implode(",", $fields);
			// ARMO LA QUERY
			$q = "UPDATE tratamientos SET {$fields} WHERE id_tratamiento = '{$this->id}'";
			// ACTUALIZO
			$this->db->query($q);
			// SINCRONIZO LA INSTANCIA
			$this->select();
		}
	}

	/**
	 * Busca todas las radiografias para este tratamiento.
	 *
	 * @throws TreatmentException Si falta el id de la instancia.
	 * @throws RadiographieException Desde get_radiographie.
	 * @return array array con todas las filas de radiografias
	 */
	public function get_radiographies()
	{
		if (empty($this->id) || !is_numeric($this->id)) {
			throw new TreatmentException('NO SE PUEDEN CARGAR LOS DATOS DEL TRATAMIENTO.');
		}
		// TRAE TODOS LOS ID DE LAS RADIOGRAFIAS PARA ESTE TRATAMIENTO
		$q = "SELECT id_radiografia AS id FROM radiografias WHERE id_tratamiento = {$this->id} AND eliminado <> 1 ORDER BY fecha_hora ASC";

		$this->db->query($q);

		while ($_ = $this->db->fetchAssoc()) {
			$this->get_radiographie($_['id']);
		}
		// RETORNO TODAS LAS INSTANCIAS DE RADIOGRAFIAS
		return $this->radiographies;
	}

	/**
	 * Obtiene una instancia de una radriografia para el id pasado
	 * por parametro.
	 *
	 * Deberia validar si es que esta radiografia le pertenece.
	 *
	 * @throws TreatmentException Los datos enviados no son validos.
	 * @throws RadiographieException Desde el contrutor Radiographie.
	 * @param  Numeric $id Id de la radiografia solicitada.
	 * @return Radiographie Instancia de la radiografia.
	 */
	public function get_radiographie($id)
	{
		if(!is_numeric($id)){
			throw new TreatmentException('OCURRIO UN ERROR AL CARGAR LA SESION DE RADIOGRAFIAS, LOS DATOS ENVIADOS SON INCORRECTOS.');
		}
		// SI VIENE UN NUMERO Y ESTA RADIOGRAFIA YA EXISTE LA MANDO
		if (in_array($id, $this->radiographies)) {
			return $this->radiographies[$id];
		}
		else {
			// SI ES UNA RADIOGRAFIA NUEVA id ES UN ARRAY SINO ES UN NUMERO Y RETORNO LA RADIOGRAFIA POR ID
			$Radiographie = new Radiographie($id);

			$this->radiographies[$Radiographie->id] = $Radiographie;

			return $Radiographie;
		}
	}

	/**
	 * Llama al contructor Radiographie que crea un registro en la base 
	 * con los datos enviados.
	 *
	 * @throws TreatmentException Los datos enviados no son validos.
	 * @throws TreatmentException Es necesario el id de la instancia Treatment.
	 * @throws RadiographieException Desde el contrutor Radiographie.
	 * @return Radiographie Instancia de Radiographie.
	 */
	public function create_radiographie($data) 
	{
		if (empty($this->id) || !is_numeric($this->id)) {
			throw new TreatmentException('NO SE PUEDEN CARGAR LOS DATOS DEL TRATAMIENTO.');
		}
		// SI id ES UN ARRAY ES PORQUE SE INSERTA UNA NUEVA FOTOGRAFIA Y LE ADJUNTO EL id DEL TRATAMIENTO
		if (!is_array($data) || empty($data)) {
			throw new TreatmentException('OCURRIO UN ERROR AL CREAR LA SESION DE RADIOGRAFIAS, LOS DATOS ENVIADOS SON INCORRECTOS.');
		}
		// AGREGO EL ID DEL TRATAMIENTO A LOS DATOS		
		$data['id_tratamiento'] = $this->id;
		// LLAMO AL CONSTRUCTOR
		$Radiographie = new Radiographie($data);
		// LA AGERGO AL RESTO
		$this->radiographies[$Radiographie->id] = $Radiographie;

		return $Radiographie;
	}

	/**
	 * Busca todas las fotografias para este tratamiento
	 *
	 * @throws TreatmentException Es necesario el id de la instancia Treatment.
	 * @throws PhotoException Desde get_photo.
	 * @return array array con todas las filas de fotografias
	 * */
	public function get_photos()
	{
		if (empty($this->id) || !is_numeric($this->id)) {
			throw new TreatmentException('NO SE PUEDEN CARGAR LAS FOTOGRAFIAS DEL TRATAMIENTO.');
		}

		$q = "SELECT id_fotografia AS id FROM fotografias WHERE id_tratamiento = {$this->id} AND eliminado <> 1 ORDER BY fecha_hora ASC";

		$this->photos = array();

		$this->db->query($q);

		while ($_ = $this->db->fetchAssoc()) {
			$this->get_photo($_['id']);
		}

		return $this->photos;
	}

	/**
	 * Obtiene una instancia de Photo desde el id pasado
	 * por parametro.
	 * 
	 * @throws TreatmentException Si los datos enviados son invalidos.
	 * @throws PhotoExeption Desde el contructor Photo.
	 * @param  Numeric $id Id del registro a instanciar
	 * @return Photo 
	 */
	public function get_photo($id) 
	{
		if (empty($id) || !is_numeric($id)) {
			throw new TreatmentException('ERROR AL CARGAR LA SESSION DE FOTOGRAFIAS. LOS DATOS ENVIADOS SON INCORRECTOS');
		}
		// SI VIENE UN NUMERO Y ESTA FOTOGRAFIA YA EXISTE LA MANDO
		if (in_array($id, $this->photos)) {
			return $this->photos[$id];
		}
		else {
			$Photo = new Photo($id);

			$this->photos[$Photo->id] = $Photo;

			return $Photo;
		}
	}

	/**
	 * El nombre no me convence porque no solo puede devolver una foto 
	 * por el id, tambien si se le pasa un array lo puede crear
	 *
	 * @throws TreatmentException Es necesario el id de la instancia Treatment.
	 * @throws TreatmentException Los datos envidaos son invalidos.
	 * @throws PhotoException Desde el constructor Photo.
	 * @return Photo Si todo sale bien devuelve una instancia de Photo
	 */
	public function create_photo($data) 
	{
		if (empty($this->id) || !is_numeric($this->id)) {
			throw new TreatmentException('OCURRIO UN ERROR AL CREAR LA SESION DE FOTOGRAFIAS.');
		}
		if (!is_array($data) || empty($data)) {
			throw new TreatmentException('OCURRIO UN ERROR AL CREAR LA SESION DE FOTOGRAFIAS. LOS DATOS ENVIADOS SON ERRONEOS');
		}
		
		$data['id_tratamiento'] = $this->id;

		$Photo = new Photo($data);

		$this->photos[$Photo->id] = $Photo;

		return $Photo;
	}

	/**
	 * Obtiene todos las cefalometrias que no esten 
	 * eliminadas para este tratamiento.
	 *
	 * @throws TreatmentException Es necesario el id de la instancia Treatment.
	 * @throws CephalometrieException Desde get_cephalometry.
	 * @return Array
	 */
	public function get_cephalometries() 
	{
		if (empty($this->id) || !is_numeric($this->id)) {
			throw new TreatmentException('NO SE PUEDEN CARGAR LOS DATOS DEL TRATAMIENTO.');
		}

		$q = "SELECT id_cefalometria AS id FROM cefalometrias WHERE id_tratamiento = {$this->id} AND eliminado <> 1 ORDER BY fecha_hora ASC";

		$this->db->query($q);

		while ($_ = $this->db->fetchAssoc()) {
			$this->get_cephalometry($_['id']);
		}

		return $this->cephalometries;
	}

	/**
	 * Obtiene una instancia de Cephalometry desde el id pasado
	 * por parametro.
	 *
	 * @throws TreatmentException Si los datos enviados son invalidos.
	 * @throws CephalometryException Desde el contructor de Cephalometry.
	 * @param  Numeric $id Id del registro a instanciar
	 * @return Cephalometry
	 */
	public function get_cephalometry($id) 
	{
		if (empty($id) || !is_numeric($id)) {
			throw new TreatmentException('ERROR AL CARGAR LA SESSION DE CEFALOMETRIAS. LOS DATOS ENVIADOS SON INCORRECTOS');
		}

		$Cephalometry = new Cephalometry($id);

		$this->cephalometries[$Cephalometry->id] = $Cephalometry;

		return $Cephalometry;
	}

	/**
	 * Crea una session de cefalometrias pasandole
	 * los datos al constructor Cephalometry.
	 *
	 * @throws TreatmentException Es necesario el id de la instancia Treatment.
	 * @throws TreatmentException Si los datos enviados son invalidos.
	 * @throws CephalometryException Desde el contructor de Cephalometry.
	 * @param  Array $data Array asociativo con los datos del registro.
	 * @return Cephalometry
	 */
	public function create_cephalometry($data) 
	{
		if (empty($this->id) || !is_numeric($this->id)) {
			throw new TreatmentException('OCURRIO UN ERROR AL CREAR LA SESION DE FOTOGRAFIAS.');
		}
		if (!is_array($data) || empty($data)) {
			throw new TreatmentException('ERROR AL CREAR LA SESSION DE CEFALOMETRIAS. LOS DATOS ENVIADOS SON INCORRECTOS');
		}
		// AGEGO EL ID DEL TRATAMIENTO A LOS DATOS
		$data['id_tratamiento'] = $this->id;

		$Cephalometry = new Cephalometry($data);

		$this->cephalometries[$Cephalometry->id] = $Cephalometry;

		return $Cephalometry;
	}

	/**
	 * Obtiene todos los registros de visita para este tratamiento
	 *
	 * @throws TreatmentException Es necesario el id de la instancia Treatment.
	 * @throws RegisterException Desde get_register.
	 * @return Array
	 */
	public function get_registers() 
	{
		if (empty($this->id) || !is_numeric($this->id)) {
			throw new TreatmentException('NO SE PUEDEN CARGAR LOS REGISTROS DEL TRATAMIENTO.');
		}

		$q = "SELECT id_registro AS id FROM registros WHERE id_tratamiento = {$this->id} ORDER BY fecha_hora ASC";

		$this->db->query($q);

		while ($_ = $this->db->fetchAssoc()) {
			$this->get_register($_['id']);
		}

		return $this->registers;
	}

	/**
	 * Obtiene una instancia de Register desde el id pasado
	 * por parametro.
	 * 
	 * @throws TreatmentException Si los datos enviados son invalidos.
	 * @throws RegisterExeption Desde el contructor Register.
	 * @param  Numeric $id Id del registro a instanciar
	 * @return Register 
	 */
	public function get_register($id) 
	{
		if (is_array($id) || !is_numeric($id)) {
			throw new TreatmentException('ERROR AL CARGAR LOS REGISTROS. LOS DATOS ENVIADOS SON INCORRECTOS');
		}

		$Register = new Register($id);

		$this->registers[$Register->id] = $Register;

		return $Register;
	}

	/**
	 * Crea una session de cefalometrias pasandole
	 * los datos al constructor Register.
	 *
	 * @throws TreatmentException Es necesario el id de la instancia Treatment.
	 * @throws TreatmentException Si los datos enviados son invalidos.
	 * @throws RegisterException Desde el contructor de Register.
	 * @param  Array $data Array asociativo con los datos del registro.
	 * @return Register
	 */
	public function create_register($data) 
	{
		if (empty($this->id) || !is_numeric($this->id)) {
			throw new TreatmentException('OCURRIO UN ERROR AL CREAR EL REGISTRO.');
		}

		if (!is_array($data) || empty($data)) {
			throw new TreatmentException('OCURRIO UN ERROR AL CREAR EL REGISTRO. LOS DATOS ENVIADOS SON INCORRECTOS');
		}

		$data['id_tratamiento'] = $this->id;

		$Register = new Register($data);

		$this->registers[$Register->id] = $Register;

		return $Register;
	}

	/**
	 * Obtiene todos los pagos cargados para este tratamiento
	 *
	 * @throws TreatmentException Es necesario el id de la instancia Treatment.
	 * @throws PaymentException Desde get_payment.
	 * @return Array
	 */
	public function get_payments() 
	{
		if (empty($this->id) || !is_numeric($this->id)) {
			throw new TreatmentException('NO SE PUEDEN CARGAR LOS REGISTROS DE PAGO DEL TRATAMIENTO.');
		}

		$q = "SELECT id_pago AS id FROM pagos WHERE id_tratamiento = {$this->id} ORDER BY fecha_hora ASC";

		$this->db->query($q);

		if ($this->db->numRows()) {
			while ($_ = $this->db->fetchAssoc()) {
				$this->get_payment($_['id']);
			}
		}

		return $this->payments;
	}

	/**
	 * Obtiene una instancia de la clase Payment 
	 * pasandole como parametro el id en $id.
	 * 
	 * @throws TreatmentException Si los datos enviados son invalidos.
	 * @throws PaymentException Desde el contructor Payment.
	 * @param  Numeric $id Id del registro a obtener.
	 * @return Payment 
	 */
	public function get_payment($id) 
	{
		if (is_array($id) || !is_numeric($id)) {
			throw new TreatmentException('NO SE PUEDEN CARGAR EL/LOS REGISTROS DE PAGO DEL TRATAMIENTO. LOS DATOS ENVIADOS SON INCORRECTOS');
		}

		$Payment = new Payment($id);

		$this->payments[$Payment->id] = $Payment;

		return $Payment;
	}

	/**
	 * Crea una instancia de Payment con el 
	 * parametro enviado y la retorna.
	 *
	 * @throws TreatmentException Es necesario el id de la instancia Treatment.
	 * @throws TreatmentException Si los datos enviados son invalidos.
	 * @param  Array $data Array asociativo con la info.
	 * @return Payment     Instancia creada. 
	 */
	public function create_payment($data) 
	{
		if (empty($this->id) || !is_numeric($this->id)) {
			throw new TreatmentException('NO SE PUEDEN CARGAR LOS DATOS DEL TRATAMIENTO.');
		}
		if (!is_array($data) || empty($data)) {
			throw new TreatmentException('ERROR AL CREAR EL REGISTRO DE PAGO, LOS DATOS ENVIADOS SON INCORRECTOS.');
		}
		// AGREGO EL ID DEL TRATMIENTO A LOS DATOS
		$data['id_tratamiento'] = $this->id;

		$Payment = new Payment($data);
		// AGREGO A LOS ANTERIORES
		$this->payments[$Payment->id] = $Payment;

		return $Payment;
	}

	public function get_history()
	{
		return new History($this->id_historia);
	}

	public function get_exam()
	{
		return new Exam($this->id_examen);
	}

	public function get_fullDiagnostic()
	{
		return new Diagnostic($this->id_diagnostico);
	}

	public function get_resume()
	{
		return new Resume($this->id_resumen);
	}

	public function get_patient()
	{
		return new Patient($this->id_paciente);
	}
	
	public function get_odontogram()
	{
		return new Odontogram($this->id_odontograma);
	}

	/**
	 * Devuelve la url para ver o editar el tratamiento.
	 * 
	 * VER TRATAMIENTO ES LA MISMA PAGINA QUE PERFIL DEL PACIENTE(/paciente/[:encode]) 
	 * PERO EDITAR ES UNA DISTINTA(/tratamiento/editar/[:encode]).
	 * 
	 * Usada en html/pacientes/main.php
	 * Usada en modules/paciente.php
	 *
	 * @param String $path Si es igual a 'editar' envia la url para editar el tratamiento, si no siempre va a dar para ver
	 * @return String Url pedida
	 */
	public function url($path = 'ver')
	{
		// EL SUBPATH DEL LA URL
		$path = trim($path);
		// URL BASE
		$url = trim(URL_ROOT, '/');
		// ESTO LO EXIPLICO ARRIBA
		if ('ver' === $path) {
			$url .= "/paciente/";
		}
		else{
			$url .= $path == 'editar' ? "/tratamiento/editar/" : "/{$path}/";
		}
		// AGREGO LOS ID ENCODEADEADOS
		$url .= crypt_params(array(TRATAMIENTO => $this->id, PACIENTE => $this->id_paciente));
		// Y RETORNO
		return $url;
	}

	/**
	 * Obtiene el tototal de lo pagado para este tratamiento.
	 *
	 * @throws TreatmentException Si falta el id de la instancia.
	 * @return Int Monto acumulado
	 */
	public function acumulado() 
	{
		if (empty($this->id) || !is_numeric($this->id)) {
			throw new TreatmentException('NO SE PUEDEN CARGAR LOS DATOS DEL TRATAMIENTO.');
		}
		// SUMA DE TODOS LOS PAGOS
		$q = "SELECT SUM(monto) AS acumulado FROM pagos WHERE id_tratamiento = {$this->id}";

		return (int) $this->db->oneFieldQuery($q);
	}

	/**
	 * Calcula el blance de los pagos. Luego ejecuta
	 * un update en los datos de cada pago.
	 *
	 * @throws TreatmentException Desde acumulado.
	 * @throws PaymentException Desde get_payments.
	 * @throws PaymentException Desde Payment::update.
	 */
	public function balancear() 
	{
		// OBTENGO CUANTO TENGO ACUMULADO
		$acumulado = $this->acumulado();
		// TRAIGO TODOS LOS PAGOS DEL TRATAMIENTO
		$this->get_payments();

		foreach ($this->payments as $Payment) {

			$Payment->acumulado = $acumulado;

			$Payment->balance = $this->presupuesto - $Payment->acumulado;

			$acumulado -= $Payment->monto;

			$Payment->update();
		}
	}
	
	/**
	 * Valida si es una columna valida en la BD.
	 * 
	 * @param  String $fieldname Nombre a validar.
	 * @return Bool
	 */
	public static function valid_field($fieldname)
	{
		// TRUE SI NO ESTA VACIO, ES UN STRING Y MATCHEA CON ALGUNA DE LAS COLUMNAS EN BD
		return !empty($fieldname) && is_string($fieldname) && preg_match("/^(id_(examen|historia|diagnostico|resumen|odontograma|paciente)|(fecha_hora_inici|estad|presupuest|eliminad)o|tecnica|(descrip|dura)cion)$/i", $fieldname);
	}
}