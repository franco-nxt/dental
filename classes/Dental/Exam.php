<?php 

class Exam
{
	
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
	 * @throws ExamException El parametro es erroneo.
	 * @throws ExamException Lanzada desde create.
	 * @param Numeric $id Id numerico del resumen.
	 */
	public function __construct($id = null)
	{
		if (is_numeric($id)) {
			$this->id = $id;
		}
		elseif (empty($id)) {
			$this->create();
		}
		else{
			throw new ExamException('OCURRIO UN ERROR CON EL EXAMEN CLINICO Y BUCAL DEL PACIENTE. VUELVA A INTENTARLO.');
		}
	}

	/**
	 * Crea un registro vacio en la tabla examen.
	 * 
	 */
	public function create()
	{
		// LA QUERY CREA UN REGISTRO VACIO EN LA DB
		$q = "INSERT INTO examen () VALUES ()";
		// EJCUTO
		$this->db->query($q);
		// ASIGNO EL ID A LA INSTANCIA
		$this->id = $this->db->lastID();
	}
	
	/**
	 * Levanta todos los datos para la instancia.
	 * 
	 * @throws ExamException Falta el id del examen.
	 * @return Exam Retorna la misma instancia.
	 */
	public function select() 
	{
		// SI NO TENEMOS EL ID DEL EXAMEN
		if (!$this->id || !is_numeric($this->id)) {
			throw new ExamException('OCURRIO UN ERROR, NO SE PUEDEN OBTENER LOS DATOS DEL EXAMEN.');
		}
		// QUERY QUE TRAE TODOS LOS DATOS DEL EXAMEN
		$q = "SELECT agenesias, atm, clinicas_observaciones, curva_spee, deglucion, denticion, diastemas_inferiores, diastemas_superiores, estructuras_faciales, fisura_paladar, intraoral_observaciones, labios_reposo, linea_media_inferior, linea_media_superior, longitud_arco_mandibulal, longitud_arco_maxilar, mordida_cruzada, paladar, perfil, rco_dentaria, resalte, respiracion, sobremordida, supernumerarios, surco_mentolabial, tamano_dientes FROM examen WHERE id_examen = {$this->id}";
		// EJECUTO
		$_ = $this->db->oneRowQuery($q);
		// FILL SOBRE LA INSTANCIA
		foreach ($_ as $k => $v) {
			// ALGUNOS DATOS VIENEN EN JSON
			$json = json_decode(utf8_encode($v));
			// LOS QUE NO SON JSON QUEDAN EN NULL, USO EL VALOR REAL
			$this->{$k} = $json ? $json : utf8_encode($v);
		}
		// RETORNA LA MISMA INSTACIA CON LOS CAMPOS SINCRONIZADOS
		return $this;
	}

	/**
	 * Actualiza el el registro en la BD.
	 * Y luego ejecuta un select para sincronizar 
	 * las props de la instancia
	 * 
	 * @throws ExamException No hay un id para obtener y modificar los datos.
	 * @throws ExamException El parametro data no es un array.
	 * @param Array $data Datos a guardar en BD.
	 */
	public function update($data) 
	{
		// ES NECESARIO EL ID DE LA SESSION
		if (empty($this->id) || !is_numeric($this->id)) {
			throw new ExamException('OCURRIO UN ERROR, NO SE PUEDEN ACTUALIZAR LOS DATOS DEL EXAMEN.');
		}
		// LA DATA ENVIADA ESTA MAL
		if (empty($data) || !is_array($data)) {
			throw new ExamException('ERROR AL ACTUALIZAR EL EXAMEN. LOS DATOS SON INCORRECTOS.');
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
		$q = utf8_decode("UPDATE examen SET {$implode} WHERE id_examen = {$this->id}");
		// EJECUTO
		$this->db->query($q);
		// SINCRONIZO LA INSTANCIA
		$this->select();
	}

	/**
	 * Obtiene una instancia del tratamiento, asignado en la BD.
	 * 
	 * @throws ExamException No hay un id para obtener y modificar los datos.
	 * @throws TreatmentException Lanzada por el construcrot de Treatment.
	 * @return Treatment Instancia del tratamiento asignado al resumen.
	 */
	public function get_treatment()
	{
		// ES NECESARIO EL ID DE LA SESSION
		if (empty($this->id) || !is_numeric($this->id)) {
			throw new ExamException('ERROR AL CARGAR EXAMEN CLINICO Y BUCAL.');
		}
		// SI EL ID NO ESTA CARGADO
		if (empty($this->id_tratamiento)) {
			$q = "SELECT id_tratamiento AS id FROM tratamientos WHERE id_examen = {$this->id}";
			$this->id_tratamiento = $this->db->oneFieldQuery($q);
		}

		return new Treatment($this->id_tratamiento);
	}

	/**
	 * Obtiene una url absoluta para ver o editar 
	 * el resumen en el front.
	 * 
	 * @throws ExamException Lanzada por get_treatment.
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
		$url = trim(URL_ROOT, '/') . "/diagnostico/examen/{$path}{$uri}";

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
		return (Bool) !empty($fieldname) && is_string($fieldname) && preg_match('/^(a(genesias|tm)|c(linicas_observaciones|urva_spee)|d(e(glu|nti)cion|iastemas_(inf|sup)eriores)|estructuras_faciales|fisura_paladar|intraoral_observaciones|l(abios_reposo|inea_media_(inf|sup)erior|ongitud_arco_ma(ndibulal|xilar))|mordida_cruzada|p(aladar|erfil)|r(co_dentaria|es(alte|piracion))|s(obremordida|u(pernumerarios|rco_mentolabial)))$/i', $fieldname);
	}
}