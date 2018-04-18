<?php 

/**
 * summary
 */
class Patient
{

	public $treatments = array();
	/**
	 * Esta rgx valida los nombres de las columnas en la BD
	 *
	 * @var string
	 */
	private static $RGX_BD = '/^(id_usuario|fecha_(nacimient|ingres)o|(apellid|telefon|eliminad|estad|fot|sex|correo_electronic)o|[mp]adre_(apellido|nombre)|dni|celular|direccion|ciudad|provincia|nombre|derivado_por|codigo_postal)$/';

	public function __get($name) {
		if ($name == 'db') {
			return MySQL::getInstance();
		}
		elseif (isset($this->{$name})) {
			return $this->{$name};
		}
		elseif ($name == 'nacimiento') {
			return date('d/m/y', strtotime($this->fecha_nacimiento));
		}
		elseif ($name == 'genero') {
			return constant("SEXO_{$this->sexo}");
		}
		else{
			return $this->select($name)->{$name};
		}
	}

	/**
	 * Crea un Patient nuevo en la BBDD. 
	 * Tambien devuelve una instancia de 
	 * un paciente que existe en la base, 
	 * usando el id pasado por parametro
	 * 
	 * @param Numeric|Array $id Si se pasa un id numerico es porque el paciente ya existe, cuando se pasa un diccionario para crear el paciente
	 * @return Patient|Boolean Si el paciente existe y todo es correcto lo retorna si no es asi devuelve false
	 */
	public function __construct($id = null)
	{
		if (!$id) {
			return false;
		}

		// CUANDO VENGA UN ARRAY ES PARA CREAR UN PACIENTE
		if (is_array($id)) {
			if (!$this->create($id)) {
				return false;
			}
		}
		elseif (is_numeric($id)) {
			$this->id  = $id;

			if (!$this->select('id_usuario')) {
				return false;
			}

		}

		$this->url = crypt_params(array(PACIENTE => $this->id));

		return $this;
	}

	/**
	 * Crea un paciente en la BD
	 *
	 * @return Bool Segun como salio la operacion
	 */
	private function create($data)
	{
		$keys = array('estado', 'borrado', 'eliminado', 'fecha_nacimiento', 'fecha_ingreso');
		$values = array(BD_PACIENTE_ESTADO_ACTIVO, 0, 0); // <-- PARA INICIAR UN PACIENTE NO TIENE QUE ESTAR ELIMINADO

		$date = date('Y-m-d H:i:s');

		// SI LA FECHA DE NACIMIENTO NO ES ENVIADA DENTRO DE LOS DATOS LA MARCO YO
		$values[] = isset($data['fecha_nacimiento']) && $data['fecha_nacimiento'] ? date('Y-m-d H:i:s', strtotime($data['fecha_nacimiento'])) : $date;

		unset($data['fecha_nacimiento']);

		// SI LA FECHA DE INGRESO NO ES ENVIADA DENTRO DE LOS DATOS LA MARCO YO
		$values[] = isset($data['fecha_ingreso']) && $data['fecha_ingreso'] ? date('Y-m-d H:i:s', strtotime($data['fecha_ingreso'])) : $date;

		unset($data['fecha_ingreso']);

		foreach ($data as $key => $value) {
			// SOLO LAS CLAVES DEL ARRAY CORRECTAS VAN A SER GUARDADAS
			if (preg_match(self::$RGX_BD , $key) && $value) {
				$keys[]   = $key;
				$values[] = $this->db->escape($value);
			}
		}

		$q = "INSERT INTO pacientes (" . implode(",", $keys) . ") VALUES ('" . implode("','", $values) . "')";

		$this->db->query(utf8_decode($q));

		$this->id = $this->db->lastID();

		$this->db->free();

		return (Bool) $this->id;
	}

	/**
	 * A esta func se le dan los campos para hacer un pull desde la bbdd, 
	 * los argumentos puede ser un campo o muchos dentro de un array.
	 * 
	 * @param string|array $data nombres validos campo/s 
	 *  @return Patient su propia instancia
	 * */
	public function select($data = '*') 
	{
		if (!$this->id) {
			return false;
		}

		// SI EL PARAMETRO ES UN STRING LO PASO A UN ARRAY
		is_string($data) && $data = array($data);

		if (is_array($data)) {
			$keys = array();

			// FILTRO LOS CAMPOS Y AJUSTO LOS NOMBRES DE LOS CAMPOS SOLICITADOS A LOS REALES DE LA BBDD
			foreach ($data as $field) {

				switch ($field) {
					case 'usuario':
					$field = 'id_' . $field;
					break;
					case 'nacimiento':
					case 'ingreso':
					$field = 'fecha_' . $field;
					break;
					case 'mail':
					case 'email':
					$field = 'correo_electronico';
					break;					
				}

				if (preg_match(self::$RGX_BD, $field)) {
					$keys[] = $field;
				}
			}

			if (count($keys)) {
				$q = "SELECT " . implode(', ', array_unique($keys)) . " FROM pacientes WHERE id_paciente = {$this->id}";
				$paciente = $this->db->oneRowQuery($q);

				if ($paciente) {
					// FILL EN LAS PROPIEDADES DEL PACIENTE
					foreach ($paciente as $k => $v) {
						if (!preg_match('/^fecha_(nacimient|ingres)o$/', $k)) {
							$v = utf8_encode($v);
						}

						$this->{$k} = $v;
					}

				}
				else{
					return false;
				}
			}
		}

		return $this;
	}
	
	/**
	 * Actualiza los datos del paciente en BD
	 *
	 * @param Array $data Si data es null actualiza usando los datos de las propiedades
	 * @return Paciente Devuelve el mismo paciente pero con los datos actualizados
	 * @author 
	 */
	public function update($data = null) 
	{
		$q = array();

		is_array($data) || $data = (array) $this;

		foreach ($data as $k => $v) {
			if (preg_match(self::$RGX_BD, $k) && $v) {
				if (preg_match('/^fecha_(nacimient|ingres)o$/', $k)) {
					$v = self::format_date($v);
				}

				$q[] = utf8_decode("{$k} = '{$v}'");
			}
		}

		if (!empty($q)) {
			$q = "UPDATE pacientes SET " . implode(', ', $q) .  " WHERE id_paciente = '{$this->id}'";

			$this->db->query($q);

			return $this->select();
		}

		return false;
	}

	/**
	 * Busca los tratamientos disponibles para la instancia del Paciente
	 *
	 * @return array la propiedad tratamientos, conjuntos de tratamientos
	 * */
	public function treatments() {
		$q = "SELECT T.id_tratamiento AS id FROM tratamientos T INNER JOIN pacientes P ON P.id_paciente = T.id_paciente AND P.id_paciente = {$this->id} AND (T.eliminado <> 1 OR T.eliminado IS NULL) ORDER BY T.id_tratamiento DESC";

		$this->db->query($q);
		
		!isset($this->treatments) && $this->treatments = array();

		if ($this->db->numRows()) {
			while ($_ = $this->db->fetchAssoc()) {
				$this->get_treatment($_['id']); //] = new Tratamiento($_['id']);
			}
		}

		$this->db->free();

		return $this->treatments;
	}

	/**
	 * 
	 *
	 * @return array la propiedad tratamientos, conjuntos de tratamientos
	 * */
	public function old_treatments() {
		$q = "SELECT T.id_tratamiento AS id FROM tratamientos T INNER JOIN pacientes P ON P.id_paciente = T.id_paciente AND P.id_paciente = {$this->id} AND (T.eliminado <> 1 OR T.eliminado IS NULL) ORDER BY T.id_tratamiento DESC LIMIT 1,100";

		$this->db->query($q);
		
		$treatments = array();

		if ($this->db->numRows()) {
			while ($_ = $this->db->fetchAssoc()) {
				$treatments[] = $this->get_treatment($_['id']);
			}
		}

		$this->db->free();

		return $treatments;
	}

	/**
	 * si se le pasa un numerico devuelve un Tratamiento con el id enviado, 
	 * si el parametro es un array con los campos validos crea un Trtamiento 
	 * y lo retorna
	 * 
	 * @param void|numeric|array $id id del tratamiento o array clave valor con los datos del tratamiento o vacio para traer el ultimo tratamiento
	 * @return Tratamiento
	 * */
	public function treatment($id = null) {
		if (!$id) {
			// TRAIGO EL ULTIMO TRATAMIENTO
			$q  = "SELECT id_tratamiento as id FROM tratamientos WHERE id_paciente = {$this->id} AND (eliminado <> 1 OR eliminado IS NULL) ORDER BY id_tratamiento DESC LIMIT 0, 1";
			$id = $this->db->oneFieldQuery($q);
		}

        // SI ES UN ARRAY ES PORQUE SE CREA UN TRATAMIENTO
		is_array($id) && ($id['id_paciente'] = $this->id);

		$Treatment = new Treatment($id);

		if ($Treatment->id) {
            // SI TODO ESTA BIEN AGREGO EL TRATAMIENTO
			$this->treatments[$Treatment->id] = $Treatment;

			return $Treatment;
		}

		return false;
	}

	/**
	 * si se le pasa un numerico devuelve un Tratamiento con el id enviado, 
	 * si el parametro es un array con los campos validos crea un Trtamiento 
	 * y lo retorna
	 * 
	 * @param void|numeric|array $id id del tratamiento o array clave valor con los datos del tratamiento o vacio para traer el ultimo tratamiento
	 * @return Tratamiento
	 * */
	public function get_treatment($id = null) 
	{
		// TRAIGO EL ULTIMO TRATAMIENTO
		if (!$id) {
			$q  = "SELECT id_tratamiento as id FROM tratamientos WHERE id_paciente = {$this->id} AND (eliminado <> 1 OR eliminado IS NULL) ORDER BY id_tratamiento DESC LIMIT 0, 1";
			$id = $this->db->oneFieldQuery($q);
		}

		if (!is_numeric($id)) {
			dump($id);
            // add_error_flash("NO SE ENCUENTRA EL TRATAMIENTO.");
            redirect_exit();
		}

		$Treatment = new Treatment($id);

		if ($Treatment->id) {
            // SI TODO ESTA BIEN AGREGO EL TRATAMIENTO
			$this->treatments[$Treatment->id] = $Treatment;

			return $Treatment;
		}

		return false;
	}


	/**
	 * concatena los datos para y forma la url para redirigir a la seccion solicitada
	 * 
	 * @param string $section seccion a la cual se quiere redirigir
	 * @return sting url formada
	 * */
	public function url($section = 'paciente') {
		if ($section == 'editar') {
			$section = 'paciente/editar';
		}
		elseif ($section == 'eliminar') {
			$section = 'paciente/eliminar';
		}
		elseif (!preg_match('/^(editar|((foto|radio)graf|cefalometr)ias|odontograma|economia|diagnostico(\/completo|\/resumen|\/examen|\/historia)?|(economia|tratamiento|registros)(\/nuevo)?)$/', $section)) {
			$section = 'paciente';
		}

		return trim(URL_ROOT, '/') . '/' . $section . '/' . $this->url;
	}

	/**
	 * Obtengo el nombre completo del paciente
	 *
	 * @return string
	 */
	public function fullname()
	{
		return $this->apellido . ', ' . $this->nombre;
	}

	/**
	 * Retorna la miniatura de perfil del paciente
	 *
	 * @return string
	 * @author 
	 */
	public function thumb() {
		if ($this->id && $this->foto) {
			$path = '/img/paciente/thumb_' . $this->foto;
			
			if (file_exists(getcwd() . $path)) {
				return URL_ROOT . $path;
			}
		}

		return PACIENTE_IMG;
	}

	public function edad()
	{
		$this->edad = $this->id ? (int) floor(diff_date($this->fecha_nacimiento, date('Y-m-d')) / 365) : null;
		
		return $this->edad;
	}

	private static function format_date($date)
	{
		preg_match('#^(?<D>\d{1,2})[\/|-](?<M>[0-2]?[1-9]|3[0-2])[\/|-](?<Y>\d{1,4})$#', $date, $result); 

		if ($result) {
			return date('Y-m-d H:i:s', strtotime($result['Y'] . '-' . $result['M'] . '-' . $result['D']));
		}

		return false;
	}

	public function get_shared($share_id)
	{
		if (!is_numeric($share_id)) {
			return false;	
		}

		$q = "SELECT fotografias, radiografias, cefalometrias FROM compartidos WHERE id_compartir = {$share_id} AND id_paciente = {$this->id}";

		return $this->db->oneRowQuery($q);
	}

	public function check_user($user_id)
	{
		return $this->id_usuario == $user_id;
	}

	public function delete()
	{
		$q = "UPDATE pacientes SET eliminado = 1 WHERE id_paciente = '{$this->id}'";

		$this->db->query($q);
	}

	public function restore()
	{
		$q = "UPDATE pacientes SET eliminado = 0 WHERE id_paciente = '{$this->id}'";

		$this->db->query($q);
	}
}