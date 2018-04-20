<?php 

class Treatment
{

	/**
	 * Esta rgx valida los nombres de las columnas en la BD
	 *
	 * @var string
	 */
	private static $RGX_BD = '/^(id_(examen|historia|diagnostico|resumen|odontograma|paciente)|(fecha_hora_inici|estad|presupuest|eliminad)o|tecnica|(descrip|dura)cion|avance|paciente)$/';

	public $id;
	
	public $Patient;

	public $registers = array();

	public $payments = array();

	public $photos = array();

	public $radiographies;
	
	public $cephalometries;

	public $odontogram;
	
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

	public function __construct($id)
	{
		if (empty($id)) {
			throw new TreatmentException("ES NECESARIO UN ID PARA ENCONTRAR EL TRATAMIENTO");
		}

		if (is_array($id)) {
			$this->create($id);
		}
		elseif (is_numeric($id)) {
			$q = "SELECT {$id} IN (SELECT id_tratamiento FROM tratamientos WHERE id_tratamiento = {$id})";

			$treatment_exist = $this->db->oneFieldQuery($q);

			if (!$treatment_exist) {
				throw new TreatmentException('EL TRATAMIENTO INDICADO NO EXISTE');
			}

			$this->id = $id;

			$this->url = crypt_params(array(TRATAMIENTO => $this->id, PACIENTE => $this->id_paciente));

			return $this;
		}
		else {
			return false;
		}
	}

	/**
	 * Creo el tratamiento en BD
	 *
	 * @return Bool Segun como salio la operacion
	 */
	private function create($data)
	{
		// PRESETEO ALGUNOS CAMPOS
		$keys   = array('estado', 'fecha_hora_inicio');
		$values = array(BD_TRATAMIENTO_ACTIVO);

		// SI LA FECHA NO ES ENVIADA DENTRO DE LOS DATOS LA MARCO YO
		if (isset($data['fecha_hora_inicio'])) {
			$values[] = format_date($data['fecha_hora_inicio']);
			unset($data['fecha_hora_inicio']);
		}
		else {
			$values[] = date('Y-m-d H:i:s');
		}

		// SI LA TECNICA NO VIENE, ENTONCES USO UNA DEFAULT
		$data['tecnica'] = isset($data['tecnica']) && is_numeric($data['tecnica']) ? $data['tecnica'] : BD_TECNICA_DEFAULT;

		// FILTRO LOS CAMPOS VALIDOS
		foreach ($data as $k => $v) {
			if (preg_match('/^(id_paciente|duracion|tecnica|presupuesto|descripcion)$/', $k) && $v) {
				$value = $this->db->escape(utf8_decode($v));

				if ($value) {
					$keys[]   = $k;
					$values[] = $v;
				}
			}
		}

		// $this->odontograma = new Odontograma();
		$this->History = new History();
		$this->Exam = new Exam();
		$this->Diagnostic = new Diagnostic();
		$this->Resume = new Resume();

		// if ($this->odontograma->id) {
		// 	$keys[]   = 'id_odontograma';
		// 	$values[] = $odontograma->id;
		// }

		if ($this->History->id) {
			$keys[]   = 'id_historia';
			$values[] = $this->History->id;
		}

		if ($this->Exam->id) {
			$keys[]   = 'id_examen';
			$values[] = $this->Exam->id;
		}

		if ($this->Diagnostic->id) {
			$keys[]   = 'id_diagnostico';
			$values[] = $this->Diagnostic->id;
		}

		if ($this->Resume->id) {
			$keys[]   = 'id_resumen';
			$values[] = $this->Resume->id;
		}

		$q = "INSERT INTO tratamientos (" . implode(",", $keys) . ") VALUES ('" . implode("','", $values) . "')";

		$this->db->query($q);

		$this->id = $this->db->lastID();

		$this->db->free();

		return (Bool) $this->id;
	}

	/**
	 * A esta func se le dan los campos para hacer un pull desde la bbdd, los argumentos puede ser un campo o muchos dentro de un array.
	 * 
	 * @param string|array $data nombres validos campo/s 
	 * @return Tratamiento su propia instancia
	 * */
	public function select($data = '*') 
	{
		if (!isset($this->id)) {
			return false;
		}
		// SI EL PARAMETRO ES UN STRING LO PASO A UN ARRAY
		is_string($data) && $data = array($data);

		if (is_array($data)) {
			$keys = array();

			// FILTRO LOS CAMPOS INVALIDOS
			foreach ($data as $field) {
				if ($field == '*' || preg_match(self::$RGX_BD, $field)) {
					$keys[] = $field;
				}
			}

			if (count($keys)) {
				$q = "SELECT " . implode(', ', array_unique($keys)) . " FROM tratamientos WHERE id_tratamiento = {$this->id}";

				$tratamiento = $this->db->oneRowQuery($q);

				if ($tratamiento) {
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
		}

		return $this;
	}

	public function patient()
	{
		if (!isset($this->Patient) || !($this->Patient instanceof Patient)) {
			$this->Patient = new Patient($this->id_paciente);
		}
		
		return $this->Patient;
	}

	public function get_patient()
	{
		return new Patient($this->id_paciente);
	}

	public function progress()
	{
		if (isset($this->progress)) {
			return $this->progress;
		}

		if (!is_numeric($this->duracion) || $this->duracion == 0) {
			return false;
		}

		$ini = strtotime($this->fecha_hora_inicio);
		$endU = mktime(0, 0, 0, date('m', $ini) + $this->duracion, date('d', $ini), date('Y', $ini));
		$end = date('Y-m-d H:i:s', $endU);

		if ($endU > time()) {
			$total = 100 / diff_date($this->fecha_hora_inicio, $end);

			$this->progress = round(diff_date($this->fecha_hora_inicio, date('Y-m-d H:i:s')) * $total);

			return $this->progress;
		}
		else {
			return 100;
		}
	}

	public function update($data = null) 
	{
		$q = array();

		if (!is_array($data)) {
			$data = (array) $this;
		}
		foreach ($data as $k => $v) {
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
						$q[] = "fecha_hora_final = '" . date('Y-m-d H:i:s') . "'";
					}
						// ACA GUARDO SOLO LAS CONSTANTES PARA LA BD ej. TRATAMIENTO_BD_INACTIVO = 1
					$v = constant("BD_TRATAMIENTO_{$v}");
				}
				break;
			}

			if (preg_match('/^(fecha_hora_inicio|(estad|presupuest|eliminad)o|tecnica|(descrip|dura)cion)$/', $k) && $v) {
				$q[] = utf8_decode("{$k} = '{$v}'");
			}
		}

		if (!empty($q)) {
			$q = "UPDATE tratamientos SET " . implode(",", $q) . " WHERE id_tratamiento = '{$this->id}'";

			$this->db->query($q);

			return $this->select();
		}

		return false;
	}
	
	public function get_odontogram()
	{

		$Odontogram = new Odontogram($this->id_odontograma);

		$this->odontogram = $Odontogram;

		return $Odontogram;
	}

	/**
	 * Busca todas las radiografias para este tratamiento
	 *
	 * @return array array con todas las filas de radiografias
	 * */
	public function get_radiographies()
	{
		$q = "SELECT id_radiografia AS id FROM radiografias WHERE id_tratamiento = {$this->id} AND eliminado <> 1 ORDER BY fecha_hora ASC";

		$this->radiographies = array();

		$this->db->query($q);

		if ($this->db->numRows()) {
			while ($_ = $this->db->fetchAssoc()) {
				$this->get_radiographie($_['id']);
			}
		}

		return $this->radiographies;
	}

	public function get_radiographie($id ='')
	{
		// SI VIENE UN NUMERO Y ESTA RADIOGRAFIA YA EXISTE LA MANDO
		if (is_numeric($id) && is_array($this->radiographies) && in_array($id, $this->radiographies)) {
			return $this->radiographies[$id];
		}
		else {
			// SI id ES UN ARRAY ES PORQUE SE INSERTA UNA NUEVA RADIOGRAFIA Y LE ADJUNTO EL id DEL TRATAMIENTO
			if (is_array($id)) {
				$id['id_tratamiento'] = $this->id;
			}
			// SI ES UNA RADIOGRAFIA NUEVA id ES UN ARRAY SINO ES UN NUMERO Y RETORNO LA RADIOGRAFIA POR ID
			$Radiographie = new Radiographie($id);

			if ($Radiographie) {
				$this->radiographies[$Radiographie->id] = $Radiographie;

				return $Radiographie;
			}
		}

		return false;		
	}

	/**
	 * El nombre no me convence porque no solo puede devolver una foto 
	 * por el id, tambien si se le pasa un array lo puede crear
	 *
	 * @return Photo|Bool Si todo sale bien devuelve una instancia de Photo
	 */
	public function create_radiographie($data) 
	{
		// SI id ES UN ARRAY ES PORQUE SE INSERTA UNA NUEVA FOTOGRAFIA Y LE ADJUNTO EL id DEL TRATAMIENTO
		if (!is_array($data)) {
			return false;
		}
		
		$data['id_tratamiento'] = $this->id;

		// SI ES UNA FOTOGRAFIA NUEVA id ES UN ARRAY SINO ES UN NUMERO Y RETORNO LA FOTOGRAFIA POR ID
		$Radiographie = new Radiographie($data);

		if ($Radiographie) {
			$this->radiographies[$Radiographie->id] = $Radiographie;

			return $Radiographie;
		}

		return false;
	}

	/**
	 * Busca todas las fotografias para este tratamiento
	 *
	 * @return array array con todas las filas de fotografias
	 * */
	public function get_photos()
	{
		$q = "SELECT id_fotografia AS id FROM fotografias WHERE id_tratamiento = {$this->id} AND eliminado <> 1 ORDER BY fecha_hora ASC";

		$this->photos = array();

		$this->db->query($q);

		if ($this->db->numRows()) {
			while ($_ = $this->db->fetchAssoc()) {
				$this->get_photo($_['id']);
			}
		}

		return $this->photos;
	}

	/**
	 * El nombre no me convence porque no solo puede devolver una foto 
	 * por el id, tambien si se le pasa un array lo puede crear
	 *
	 * @return Photo|Bool Si todo sale bien devuelve una instancia de Photo
	 */
	public function get_photo($id) 
	{
		// SI VIENE UN NUMERO Y ESTA FOTOGRAFIA YA EXISTE LA MANDO
		if (is_numeric($id) && is_array($this->photos) && in_array($id, $this->photos)) {
			return $this->photos[$id];
		}
		else {
			// SI id ES UN ARRAY ES PORQUE SE INSERTA UNA NUEVA FOTOGRAFIA Y LE ADJUNTO EL id DEL TRATAMIENTO
			if (is_array($id)) {
				$id['id_tratamiento'] = $this->id;
			}
			// SI ES UNA FOTOGRAFIA NUEVA id ES UN ARRAY SINO ES UN NUMERO Y RETORNO LA FOTOGRAFIA POR ID
			$Photo = new Photo($id);

			if ($Photo) {
				$this->photos[$Photo->id] = $Photo;

				return $Photo;
			}
		}

		return false;
	}

	/**
	 * El nombre no me convence porque no solo puede devolver una foto 
	 * por el id, tambien si se le pasa un array lo puede crear
	 *
	 * @return Photo|Bool Si todo sale bien devuelve una instancia de Photo
	 */
	public function create_photo($data) 
	{
		// SI id ES UN ARRAY ES PORQUE SE INSERTA UNA NUEVA FOTOGRAFIA Y LE ADJUNTO EL id DEL TRATAMIENTO
		if (!is_array($data)) {
			return false;
		}
		
		$data['id_tratamiento'] = $this->id;

		// SI ES UNA FOTOGRAFIA NUEVA id ES UN ARRAY SINO ES UN NUMERO Y RETORNO LA FOTOGRAFIA POR ID
		$Photo = new Photo($data);

		if ($Photo) {
			$this->photos[$Photo->id] = $Photo;

			return $Photo;
		}

		return false;
	}

	/**
	 * Obtiene todos los registros para este tratamiento
	 *
	 * @return Array
	 */
	public function get_cephalometries() 
	{
		$q = "SELECT id_cefalometria AS id FROM cefalometrias WHERE id_tratamiento = {$this->id} AND eliminado <> 1 ORDER BY fecha_hora ASC";

		$this->db->query($q);

		if ($this->db->numRows()) {
			while ($_ = $this->db->fetchAssoc()) {
				$this->get_cephalometry($_['id']);
			}
		}

		return $this->cephalometries;
	}

	public function get_cephalometry($id) 
	{
		if (is_array($id) || !is_numeric($id)) {
			return false;
		}

		$Cephalometry = new Cephalometry($id);

		if ($Cephalometry) {

			$Cephalometry->Treatment = &$this;

			$this->cephalometries[$Cephalometry->id] = $Cephalometry;

			return $Cephalometry;
		}
	}

	public function create_cephalometry($data) 
	{
		if (!is_array($data)) {
			return false;
		}

		$data['id_tratamiento'] = $this->id;

		$Cephalometry = new Cephalometry($data);

		if ($Cephalometry) {

			$this->cephalometries[$Cephalometry->id] = $Cephalometry;

			return $Cephalometry;
		}
	}

	/**
	 * Obtiene todos los registros para este tratamiento
	 *
	 * @return Array
	 */
	public function get_registers() 
	{
		$q = "SELECT id_registro AS id FROM registros WHERE id_tratamiento = {$this->id} ORDER BY fecha_hora ASC";

		$this->db->query($q);

		if ($this->db->numRows()) {
			while ($_ = $this->db->fetchAssoc()) {
				$this->get_register($_['id']);
			}
		}

		return $this->registers;
	}

	public function get_register($id) 
	{
		if (is_array($id) || !is_numeric($id)) {
			return false;
		}

		$Register = new Register($id);

		if ($Register) {

			$Register->Treatment = &$this;

			$this->registers[$Register->id] = $Register;

			return $Register;
		}
	}

	public function create_register($data) 
	{
		if (!is_array($data)) {
			return false;
		}

		$data['id_tratamiento'] = $this->id;

		$Register = new Register($data);

		if ($Register) {

			$this->registers[$Register->id] = $Register;

			return $Register;
		}
	}

	/**
	 * Obtiene todos los pagos cargados para este tratamiento
	 *
	 * @return Array
	 */
	public function get_payments() 
	{
		$q = "SELECT id_pago AS id FROM pagos WHERE id_tratamiento = {$this->id} ORDER BY fecha_hora ASC";

		$this->db->query($q);

		if ($this->db->numRows()) {
			while ($_ = $this->db->fetchAssoc()) {
				$this->get_payment($_['id']);
			}
		}

		return $this->payments;
	}

	public function get_payment($id) 
	{
		if (is_array($id) || !is_numeric($id)) {
			return false;
		}

		$Payment = new Payment($id);

		if ($Payment) {

			// $Payment->Treatment = &$this;

			$this->payments[$Payment->id] = $Payment;

			return $Payment;
		}
	}

	public function create_payment($data) 
	{
		if (!is_array($data)) {
			return false;
		}

		$data['id_tratamiento'] = $this->id;

		$Payment = new Payment($data);

		if ($Payment) {

			$this->payments[$Payment->id] = $Payment;

			return $Payment;
		}
	}
	
	/**
	 * Retorna la historia Diagnostico para este tramtamiento
	 *
	 * @return History
	 */
	public function get_history()
	{
		return new History($this->id_historia);
	}
	
	/**
	 * Retorna Examen Diagnostico para este tramtamiento
	 *
	 * @return History
	 */
	public function get_exam()
	{
		return new Exam($this->id_examen);
	}
	/**
	 * Retorna Examen Diagnostico para este tramtamiento
	 *
	 * @return History
	 */
	public function get_fullDiagnostic()
	{
		return new Diagnostic($this->id_diagnostico);
	}

	/**
	 * Retorna Examen Diagnostico para este tramtamiento
	 *
	 * @return History
	 */
	public function get_resume()
	{
		return new Resume($this->id_resumen);
	}

	/**
	 * Devuelve la url para ver o editar el tratamiento.
	 * Usada en html/pacientes/main.php
	 * Usada en modules/paciente.php
	 *
	 * @param String $action Si es igual a 'editar' envia la url para editar el tratamiento, si no siempre va a dar para ver
	 * @return String Url pedida
	 */
	public function url($action = 'ver')
	{
		$action = trim($action);
		$url = trim(URL_ROOT, '/') . "/paciente/";

		if ('editar' === $action ) {
			$url .= "editar/";
		}

		$url .= crypt_params(array(TRATAMIENTO => $this->id, PACIENTE => $this->id_paciente));

		return $url;
	}

	/**
	 * Obtioene el tototal de lo pagado para este tratamiento.
	 *
	 * @return Int Monto acumulado
	 */
	public function acumulado() {
		$q = "SELECT SUM(monto) AS acumulado FROM pagos WHERE id_tratamiento = {$this->id}";

		return (int) $this->db->oneFieldQuery($q);
	}

	/**
	 * Genera un blance de los pagos,
	 * en la BD desde el objeto Payment
	 */
	public function balancear() {

		$acumulado = $this->acumulado();

		foreach ($this->get_payments() as $Payments) {

			$Payments->acumulado = $acumulado;

			$Payments->balance = $this->presupuesto - $Payments->acumulado;

			$acumulado -= $Payments->monto;

			$Payments->update();
		}
	}
}