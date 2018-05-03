<?php 

/**
 * summary
 */
class History
{
	/**
	 * @var Int
	 */
	public $id;

	/**
	 * 
	 * @var String
	 */
	public $motivo;
	
	/**
	 * 
	 * @var String
	 */
	public $tratamiento_medico;
	
	/**
	 * 
	 * @var String
	 */
	public $enfermedad_sistemica;
	
	/**
	 * 
	 * @var String
	 */
	public $medicacion_actual;
	
	/**
	 * 
	 * @var String
	 */
	public $hepatitis;
	
	/**
	 * 
	 * @var String
	 */
	public $hiv;
	
	/**
	 * 
	 * @var String
	 */
	public $medicos_observaciones;
	
	/**
	 * 
	 * @var String
	 */
	public $higene_bucal;
	
	/**
	 * 
	 * @var String
	 */
	public $ortopedia;
	
	/**
	 * 
	 * @var String
	 */
	public $ortodoncia;
	
	/**
	 * 
	 * @var String
	 */
	public $ginjivitis;
	
	/**
	 * 
	 * @var String
	 */
	public $periodontitis;
	
	/**
	 * 
	 * @var String
	 */
	public $xerostomia;
	
	/**
	 * 
	 * @var String
	 */
	public $placa_dormir;
	
	/**
	 * 
	 * @var String
	 */
	public $ronca_dormir;
	
	/**
	 * 
	 * @var String
	 */
	public $resfrio_frecuente;
	
	/**
	 * 
	 * @var String
	 */
	public $respira_boca;
	
	/**
	 * 
	 * @var String
	 */
	public $dificultad_masticar;
	
	/**
	 * 
	 * @var String
	 */
	public $dificultad_tragar;
	
	/**
	 * 
	 * @var String
	 */
	public $fonoaudiologico;
	
	/**
	 * 
	 * @var String
	 */
	public $pubertad;
	
	/**
	 * 
	 * @var String
	 */
	public $dolor_articular;
	
	/**
	 * 
	 * @var String
	 */
	public $ruido_articular;
	
	/**
	 * 
	 * @var String
	 */
	public $traumatismo_boca_menton;
	
	/**
	 * 
	 * @var String
	 */
	public $interposicion_labio_inferior;
	
	/**
	 * 
	 * @var String
	 */
	public $succion_digital;
	
	/**
	 * 
	 * @var String
	 */
	public $bruxismo;
	
	/**
	 * 
	 * @var String
	 */
	public $odontologicos_observaciones;

	/**
	 * @var Int
	 */
	public $id_tratamiento;
	
	public function __get($name) {
		if ($name == 'db') {
			return MySQL::getInstance();
		}
		
		return null;
	}


	/**
	 * El constructor espera un id numerico que va a usar 
	 * para trabajar en BD. Si no se le pasa ningun parametro
	 * crea un registro vacio en la base.
	 *
	 * @throws HistoryException El parametro es erroneo.
	 * @throws HistoryException Lanzada desde create.
	 * @param Numeric $id Id numerico del resumen.
	 */
	public function __construct($id = null)
	{
		if ($id) {
			$this->id = $id;
		}
		elseif (empty($id)) {
			$this->create();
		}
		else{
			throw new HistoryException('OCURRIO UN ERROR CON LA HISTORIA MEDICA Y DENTAL DEL PACIENTE. VUELVA A INTENTARLO.');
		}
	}

	/**
	 * Crea un registro vacio en la tabla examen.
	 * 
	 */
	public function create()
	{
		// LA QUERY CREA UN REGISTRO VACIO EN LA DB
		$q = "INSERT INTO historia () VALUES ()";
		// EJCUTO
		$this->db->query($q);
		// ASIGNO EL ID A LA INSTANCIA
		$this->id = $this->db->lastID();
	}

	/**
	 * Levanta todos los datos para la instancia.
	 * 
	 * @throws HistoryException Falta el id de la instancia.
	 * @return History Retorna la misma instancia.
	 */
	public function select() 
	{
		// SI NO TENEMOS EL ID
		if (!$this->id || !is_numeric($this->id)) {
			throw new HistoryException('OCURRIO UN ERROR, NO SE PUEDEN ACTUALIZAR LA HISTORIA MEDICA Y DENTAL DEL PACIENTE.');
		}
		// QUERY QUE TRAE TODOS LOS DATOS
		$q = "SELECT motivo, tratamiento_medico, enfermedad_sistemica, medicacion_actual, hepatitis, hiv, medicos_observaciones, higene_bucal, ortopedia, ortodoncia, ginjivitis, periodontitis, xerostomia, placa_dormir, ronca_dormir, resfrio_frecuente, respira_boca, dificultad_masticar, dificultad_tragar, fonoaudiologico, pubertad, dolor_articular, ruido_articular, traumatismo_boca_menton, interposicion_labio_inferior, succion_digital, bruxismo, odontologicos_observaciones FROM historia WHERE id_historia = {$this->id}";
		// EJECUTO
		$_ = $this->db->oneRowQuery($q);
		// FILL SOBRE LA INSTANCIA
		foreach ($_ as $k => $v) {
			// ALGUNOS DATOS VIENEN EN JSON
			$json = json_decode(utf8_encode($v));
			// LOS QUE NO SON JSON QUEDAN EN NULL, USO EL VALOR REAL
			$this->{$k} = empty($json) ? $json : utf8_encode($v);
		}
		// RETORNA LA MISMA INSTACIA CON LOS CAMPOS SINCRONIZADOS
		return $this;
	}

	/**
	 * Actualiza el el registro en la BD.
	 * Y luego ejecuta un select para sincronizar 
	 * las props de la instancia
	 * 
	 * @throws HistoryException No hay un id para obtener y modificar los datos.
	 * @throws HistoryException El parametro data no es un array.
	 * @param Array $data Datos a guardar en BD.
	 */
	public function update($data) 
	{
		// ES NECESARIO EL ID DE LA SESSION
		if (empty($this->id) || !is_numeric($this->id)) {
			throw new HistoryException('OCURRIO UN ERROR, NO SE PUEDEN ACTUALIZAR LA HISTORIA MEDICA Y DENTAL DEL PACIENTE.');
		}
		// LA DATA ENVIADA ESTA MAL
		if (empty($data) || !is_array($data)) {
			throw new HistoryException('ERROR AL ACTUALIZAR LA HISTORIA MEDICA Y DENTAL. LOS DATOS SON INCORRECTOS.');
		}
		// VAR SET 
		$set = array();
		foreach ((array) $data as $key => $value) {
			if (self:: valid_field($key)){
				// LOS CAMPOS QUE SEAN UN ARRAY LOS GUARDO COMO JSON
				is_array($value) && $value = json_encode($value, JSON_UNESCAPED_UNICODE);
				// AGREGO EL SET
				$set[] = "{$key} = '{$value}'";
			}
		}
		// IMPLODE SOBRE LOS CAMPOS;
		$implode = implode(', ', $q);
		// GUARDO LA QUERY
		$q = utf8_decode("UPDATE historia SET {$implode} WHERE id_historia = {$this->id}");
		// EJECUTO
		$this->db->query($q);
		// SINCRONIZO LA INSTANCIA
		$this->select();
	}

	/**
	 * Obtiene una instancia del tratamiento, asignado en la BD.
	 * 
	 * @throws HistoryException No hay un id para obtener y modificar los datos.
	 * @throws TreatmentException Lanzada por el construcrot de Treatment.
	 * @return Treatment Instancia del tratamiento asignado al resumen.
	 */
	public function get_treatment()
	{
		// ES NECESARIO EL ID DE LA SESSION
		if (empty($this->id) || !is_numeric($this->id)) {
			throw new HistoryException('ERROR AL CARGAR EL RESUMEN.');
		}
		// SI EL ID NO ESTA CARGADO
		if (empty($this->id_tratamiento)) {
			$q = "SELECT id_tratamiento AS id FROM tratamientos WHERE id_historia = {$this->id}";
			$this->id_tratamiento = $this->db->oneFieldQuery($q);
		}

		return new Treatment($this->id_tratamiento);
	}

	/**
	 * Obtiene una url absoluta para ver o editar 
	 * el resumen en el front.
	 * 
	 * @throws HistoryException Lanzada por get_treatment.
	 * @throws TreatmentException Lanzada por get_treatment.
	 * @param Array $data Datos a guardar en BD.
	 * @return String Url de la instancia.
	 */
	public function url($path = null) 
	{
		// CARGO EL TRATAMIENTO
		$Treatment = $this->get_treatment();
		// USO LA MISMA URI QUE EN EL TRATAMIENTO
		$uri = $Treatment->url;
		// $path SOLO PUEDE SER 'editar'
		$path = strcasecmp($path, 'editar') == 0 ? "{$path}/" : null;
		// ARMO LA URL COMPLETA
		$url = trim(URL_ROOT, '/') . "/diagnostico/historia/{$path}{$uri}";

		return $url;
	}

	/**
	 * Valido que el campo corresponda con los de la BD.
	 *
	 * @param String $fieldname
	 * @return Bool
	 */
	public function valid_field($fieldname)
	{
		$ptrn = '/^(bruxismo|d(ificultad_(mastic|trag)|olor_articul)ar|enfermedad_sistemica|fonoaudiologico|ginjivitis|h(epatitis|i(gene_bucal|v))|interposicion_labio_inferior|m(edic(acion_actual|os_observaciones)|otivo)|o(dontologicos_observaciones|rto(donc|ped)ia)|p(eriodontitis|laca_dormir|ubertad)|r(es(frio_frecuente|pira_boca)|onca_dormir|uido_articular)|succion_digital|tratamiento_(medico|boca_menton)|xerostomia)$/i';
		// TRUE SI NO ESTA VACIO, ES UN STRING Y MATCHEA CON ALGUNA DE LAS COLUMNAS EN BD
		return (Bool) !empty($fieldname) && is_string($fieldname) && preg_match($ptrn, $fieldname);
	}

}