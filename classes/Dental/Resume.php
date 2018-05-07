<?php 

/**
 * summary
 */
class Resume
{
	
	/**
	 * @var Numeric
	 */
	public $id_tratamiento;
	
	/**
	 * @var String
	 */
	public $esqueletal_dentario;
	
	/**
	 * @var String
	 */
	public $extracciones;
	
	/**
	 * @var String
	 */
	public $anclaje_sup;
	
	/**
	 * @var String
	 */
	public $anclaje_inf;
	
	/**
	 * @var String
	 */
	public $pronostico;
	
	/**
	 * @var String
	 */
	public $observaciones;
	
	/**
	 * @var String
	 */
	public $objetivo_etapas;
	
	/**
	 * @var String
	 */
	public $interceptivo_correctivo;

	public function __get($name) {
		if ($name == 'db') {
			return MySQL::getInstance();
		}
		elseif (isset($this->{$name})) {
			return $this->{$name};
		}
		
		return null;
	}

	/**
	 * El constructor espera un id numerico que va a usar 
	 * para trabajar en BD. Si no se le pasa ningun parametro
	 * crea un registro vacio en la base.
	 *
	 * @throws ResumeException El parametro es erroneo.
	 * @throws ResumeException Lanzada desde create.
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
			throw new ResumeException('OCURRIO UN ERROR CON EL RESUMEN DE DIAGNOSTICO, VUELVA A INTENTARLO OTRA VEZ.');
		}
	}

	/**
	 * Crea una registro en la tabla resumen.
	 * 
	 */
	public function create()
	{
		// LA QUERY CREA UN REGISTRO VACIO EN LA DB
		$q = "INSERT INTO resumen () VALUES ()";
		// EJECUTO
		$this->db->query($q);
		// ASIGNO EL ID A LA INSTANCIA
		$this->id = $this->db->lastID();
	}

	/**
	 * Levanta el registro desde la BD.
	 * Completa las propiedades en la instancia y la retorna.
	 * 
	 * @return Resume La misma instancia.
	 */
	public function select() 
	{
		// ES NECESARIO EL ID DEL RESUMEN
		if (empty($this->id) || !is_numeric($this->id)) {
			throw new ResumeException('ERROR AL CARGAR EL RESUMEN.');
		}
		$columns = implode(',', self::get_fieldnames());
		// QUERY QUE TRAE TODOS LOS DATOS
		$q = "SELECT {$columns} FROM resumen WHERE id_resumen = {$this->id}";
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
	 * @throws ResumeException No hay un id para obtener y modificar los datos.
	 * @throws ResumeException El parametro data no es un array.
	 * @param Array $data Datos a guardar en BD.
	 */
	public function update($data) 
	{
		// ES NECESARIO EL ID DE LA SESSION
		if (empty($this->id) || !is_numeric($this->id)) {
			throw new ResumeException('ERROR AL ACTUALIZAR EL RESUMEN.');
		}
		// LA DATA ENVIADA ESTA MAL
		if (empty($data) || !is_array($data)) {
			throw new ResumeException('ERROR AL ACTUALIZAR EL RESUMEN. LOS DATOS SON INCORRECTOS.');
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
		$implode = implode(', ', $set);
		// GUARDO LA QUERY
		$q = utf8_decode("UPDATE resumen SET {$implode} WHERE id_resumen = {$this->id}");
		// EJECUTO
		$this->db->query($q);
		// SINCRONIZO LA INSTANCIA
		$this->select();
	}

	/**
	 * Obtiene una url absoluta para ver o editar 
	 * el resumen en el front.
	 * 
	 * @throws ResumeException Lanzada por get_treatment.
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
		$url = trim(URL_ROOT, '/') . "/diagnostico/resumen/{$path}{$uri}";

		return $url;
	}

	/**
	 * Obtiene una instancia del tratamiento, asignado en la BD.
	 * 
	 * @throws ResumeException No hay un id para obtener y modificar los datos.
	 * @throws TreatmentException Lanzada por el construcrot de Treatment.
	 * @return Treatment Instancia del tratamiento asignado al resumen.
	 */
	public function get_treatment()
	{
		// ES NECESARIO EL ID DE LA SESSION
		if (empty($this->id) || !is_numeric($this->id)) {
			throw new ResumeException('ERROR AL CARGAR EL RESUMEN.');
		}
		// SI EL ID NO ESTA CARGADO
		if (empty($this->id_tratamiento)) {
			$q = "SELECT id_tratamiento AS id FROM tratamientos WHERE id_resumen = {$this->id}";
			$this->id_tratamiento = $this->db->oneFieldQuery($q);
		}

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
		return (Bool) !empty($fieldname) && is_string($fieldname) && preg_match('/^(anclaje_(inf|sup)|dentario|e(squeletal_dentario|xtracciones)|interceptivo_correctivo|ob(jetivo_etapa|servacione)s|pronostico)$/i', $fieldname);
	}

	private static function DB()
	{
		return MySQL::getInstance();
	}

	/**
	 * Retorna todos los nombres de las columnas
	 * de la tabla historia.
	 * 
	 * @return Array Colleccion de strings.
	 */
	public static function get_fieldnames()
	{
		$COLUMNS = array(
			'esqueletal_dentario',
			'extracciones',
			'anclaje_sup',
			'anclaje_inf',
			'pronostico',
			'observaciones',
			'objetivo_etapas',
			'interceptivo_correctivo'
		);

		return $COLUMNS;
	}
}