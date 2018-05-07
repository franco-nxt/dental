<?php 

class Diagnostic
{

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
	 * @throws DiagnosticException El parametro es erroneo.
	 * @throws DiagnosticException Lanzada desde create.
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
			throw new DiagnosticException('OCURRIO UN ERROR VUELVA A INTENTARLO.');
		}
	}

	/**
	 * Crea un registro vacio en la tabla diagnosticos.
	 * 
	 */
	public function create()
	{
		// LA QUERY CREA UN REGISTRO VACIO EN LA DB
		$q = "INSERT INTO diagnosticos () VALUES ()";
		// EJCUTO
		$this->db->query($q);
		// ASIGNO EL ID A LA INSTANCIA
		$this->id = $this->db->lastID();
	}

	/**
	 * Levanta todos los datos para la instancia.
	 * 
	 * @throws DiagnosticException Falta el id del diagnostico.
	 * @return Diagnostic Retorna la misma instancia.
	 */
	public function select() 
	{
		// SI NO TENEMOS EL ID DEL DIAGNOSTICO
		if (!$this->id || !is_numeric($this->id)) {
			throw new DiagnosticException('OCURRIO UN ERROR, NO SE PUEDEN OBTENER LOS DATOS DEL DIAGNOSTICO.');
		}
		// QUERY QUE TRAE TODOS LOS DATOS DEL DIAGNOSTICO
		$q = "SELECT panoramica, ricketts, fotografias, trx_perfil, jarabak, vto_crecimiento, trx_frontal, steiner, vto_tratamiento, seriada, powell, otros, patron, esq_clase, esq_pos_vertical, clase_molar_der, clase_molar_izq, pos_molar_sup, pos_incisivo_inf, pos_incisivo_sup, incl_incisivo_inf, incl_incisivo_sup, overjet, overbite, angulo_interincisivo, protusion_labial, observaciones FROM diagnosticos WHERE id_diagnostico = {$this->id}";
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
	 * @throws DiagnosticException No hay un id para obtener y modificar los datos.
	 * @throws DiagnosticException El parametro data no es un array.
	 * @param Array $data Datos a guardar en BD.
	 */
	public function update($data) 
	{
		// ES NECESARIO EL ID DE LA SESSION
		if (empty($this->id) || !is_numeric($this->id)) {
			throw new DiagnosticException('OCURRIO UN ERROR, NO SE PUEDEN ACTUALIZAR LOS DATOS DEL DIAGNOSTICO.');
		}
		// LA DATA ENVIADA ESTA MAL
		if (empty($data) || !is_array($data)) {
			throw new DiagnosticException('ERROR AL ACTUALIZAR EL DIAGNOSTICO. LOS DATOS SON INCORRECTOS.');
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
		$q = utf8_decode("UPDATE diagnosticos SET {$implode} WHERE id_diagnostico = {$this->id}");
		// EJECUTO
		$this->db->query($q);
		// SINCRONIZO LA INSTANCIA
		$this->select();
	}

	/**
	 * Obtiene una instancia del tratamiento, asignado en la BD.
	 * 
	 * @throws DiagnosticException No hay un id para obtener y modificar los datos.
	 * @throws TreatmentException Lanzada por el construcrot de Treatment.
	 * @return Treatment Instancia del tratamiento asignado al resumen.
	 */
	public function get_treatment()
	{
		// ES NECESARIO EL ID DE LA SESSION
		if (empty($this->id) || !is_numeric($this->id)) {
			throw new DiagnosticException('ERROR AL CARGAR EL RESUMEN.');
		}
		// SI EL ID NO ESTA CARGADO
		if (empty($this->id_tratamiento)) {
			$q = "SELECT id_tratamiento AS id FROM tratamientos WHERE id_diagnostico = {$this->id}";
			$this->id_tratamiento = $this->db->oneFieldQuery($q);
		}

		return new Treatment($this->id_tratamiento);
	}

	/**
	 * Obtiene una url absoluta para ver o editar 
	 * el resumen en el front.
	 * 
	 * @throws DiagnosticException Lanzada por get_treatment.
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
		$url = trim(URL_ROOT, '/') . "/diagnostico/completo/{$path}{$uri}";

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
		return (Bool) !empty($fieldname) && is_string($fieldname) && preg_match('/^(angulo_interincisivo|clase_molar_(der|izq)|esq_(clase|pos_vertical)|fotografias|incl_incisivo_(inf|sup)|jarabak|o(tros|ver(bite|jet)|bservaciones)|p(os_(incisivo|molar)_(inf|sup)|anoramica|atron|owell|rotusion_labial)|ricketts|s(eriada|teiner)|tr(x_(fronta|perfi)l|atamiento)|vto_(creci|trata)miento)$/i', $fieldname);
	}
}