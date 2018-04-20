<?php 

/**
 * summary
 */
class Dental
{
	public $patients = array();

	private static $instance;

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
	 * summary
	 */
	private function __construct($user, $pass)
	{
		if (empty($user) || empty($pass)) {
			throw new DentalException("ES NECESARIO COMPLETAR LOS CAMPOS USUARIO Y CONTRASEÑA");
		}
		
		$user = $this->db->escape($user);
		$pass_bd = $this->db->oneFieldQuery("SELECT clave_seguridad FROM usuarios WHERE correo_electronico = '{$user}'");
		$pass_md5 = md5($pass);

		if ($pass_bd !== $pass_md5) {
			throw new DentalException("USUARIO O CONTRASEÑA INCORRECTOS");
		}

		$row = $this->db->oneRowQuery("SELECT id_usuario, correo_electronico, nombre, apellido FROM usuarios WHERE correo_electronico = '{$user}'");

		$this->id = $row['id_usuario'];
		$this->fullname = "{$row['apellido']}, {$row['nombre']}";
		$this->apellido = $row['apellido'];
		$this->nombre = $row['nombre'];
		$this->email = $user;
		$this->pass = $pass;
	}

	public function update($data = null) {
		$q = "";

		if (!is_array($data)) {
			$data = (array) $this;
		}

		foreach ($data as $k => $v) {
			if (preg_match('/^(apellido|c(elular|iudad|odigo_postal|omentarios_(cefalometrias|compartir|diagnostico|economia|fotografias|generales|odontograma|radiografias|tratamiento)|orreo_electronico)|direccion|foto|nombre|p(ais|rovincia)|telefono)$/', $k)) {
				$q .= $k . "='" . utf8_decode($v) . "',";
			} 
			elseif ($k == 'clave_seguridad') {
				$q .= $k . "='" . md5($v) . "',";
			}
		}

		if ($q) {
			$q = "UPDATE usuarios SET " . rtrim($q, ",") . " WHERE id_usuario = '{$this->id}'";

			$this->db->query($q);

			return $this->select();
		}

		return false;
	}

	/**
	 * A esta func se le dan los campos para hacer un pull desde la bbdd, los 
	 * argumentos puede ser un campo o muchos dentro de un array.
	 * 
	 * @param string|array $data nombres validos campo/s 
	 *  @return Paciente su propia instancia
	 * */
	public function select($data = '*') {
		if (is_string($data)) {
			$data = array($data);
		}

		if (is_array($data)) {
			$keys = array();

			// FILTRO LOS CAMPOS Y AJUSTO LOS NOMBRES DE LOS CAMPOS SOLICITADOS A LOS REALES DE LA BBDD
			foreach ($data as $field) {
				if (preg_match('/^(apellido|c(elular|(iu|lave_seguri)dad|odigo_postal|omentarios_(cefalometrias|compartir|diagnostico|economia|fotografias|generales|odontograma|radiografias|tratamiento)|orreo_electronico)|direccion|foto|nombre|p(ais|rovincia)|telefono|\*)$/', $field)) {
					$keys[] = $field;
				}
			}

			if (count($keys)) {
				$q = "SELECT " . implode(', ', array_unique($keys)) . " FROM usuarios WHERE id_usuario = {$this->id}";
				$usuario = $this->db->oneRowQuery($q);

				if ($usuario) {
					foreach ($usuario as $k => $v) {
						$this->{$k} = utf8_encode($v);
					}
				}

				return $this;
			}
		}

		return false;
	}
	
	public static function login($user, $pass)
	{
		!isset(self:: $instance) && (self:: $instance = new Dental($user, $pass));

		return self:: $instance;
	}

	public function patients()
	{
		// EL CAMPO 'BORRADO' ES BORRADO LOGICO, LA COLUMNA 'ELIMINADO' ES UN PASO PREVIO A SER BORRADO
		$q = "SELECT id_paciente AS id FROM pacientes WHERE id_usuario = {$this->id} AND (borrado <> 1 OR borrado IS NULL)";

		$this->db->query($q);

		if ($this->db->numRows()) {
			while ($_ = $this->db->fetchAssoc()) {
				$this->patient($_['id']);
			}
		}

		$this->db->free();

		return $this->patients;
	}

	public function buscar($fields)
	{

		$patients = array();
		$q = array();

		foreach (array('apellido','nombre','ciudad','provincia') as $k) {
			!empty($fields[$k]) && $q[] = "{$k} LIKE '%{$fields[$k]}%'";
		}

		!empty($fields['sexo']) && defined("BD_{$fields['sexo']}") && $q[] = "sexo = " . constant("BD_{$fields['sexo']}");
		!empty($fields['fecha_ingreso']) && $q[] = "fecha_ingreso = " . format_date($fields['fecha_ingreso']);
		
		if (empty($q)) {
			return array();
		}

		$implode = implode(' AND ', $q);		
		
		$q = "SELECT id_paciente AS id FROM pacientes WHERE id_usuario = {$this->id} AND {$implode}";
		
		$this->db->query($q);

		if ($this->db->numRows()) {
			while ($_ = $this->db->fetchAssoc()) {
				$patients[] = $this->patient($_['id']);
			}
		}

		$this->db->free();

		return $patients;
	}

	/**
	 * Si se le pasa un numerico devuelve un Paciente con el id enviado, si el
	 * parametro es un array con los campos validos crea un Paciente y lo retorna
	 * 
	 * @param numeric|array $id id del paciente o array clave valor con los datos del paciente
	 * @return Patient|Bool
	 * */
	public function patient($id)
	{
		// SI ES UN ARRAY ES PORQUE SE CREA UN PACIENTE
		is_array($id) && ($id['id_usuario'] = $this->id); 

		$Patient = new Patient($id);

		if ($Patient->id) {
			// SI TODO ESTA BIEN AGREGO EL PACIENTE
			$this->patients[$Patient->id] = $Patient;

			return $Patient;
		}

		return false;
	}

	/**
	 * trae a todas las filas paciente/usuario que comparto
	 *
	 * @return void
	 * @author 
	 * */
	public function get_shareds_by_me() 
	{
		$comparto = array();

		$q = "SELECT P.id_paciente AS id, concat(P.apellido, ', ', P.nombre) AS PACIENTE, concat(U.apellido, ', ', U.nombre) AS USUARIO, id_compartir AS COMPARTIR FROM compartidos AS C INNER JOIN vinculos AS V ON V.id_vinculo = C.id_vinculo INNER JOIN pacientes AS P ON P.id_paciente = C.id_paciente INNER JOIN usuarios AS U ON U.id_usuario = V.id_usuario_in WHERE V.id_usuario_out = {$this->id}";

		$this->db->query($q);

		if ($this->db->numRows()) {
			while ($_ = $this->db->fetchAssoc()) {
				$_['COMPARTIR'] = crypt_params(array(PACIENTE => $_['id'], COMPARTIR => $_['COMPARTIR']));
				// $_['URL'] = URL_ROOT . '/paciente/compartido/' . crypt_params(array(PACIENTE => $_['id']));
				$comparto[] = $_;
			}
		}

		$this->db->free();

		return $comparto;
	}

	public function get_shareds_to_me() {

		$mecomarten = array();

		$q = "SELECT P.id_paciente AS id, concat(P.apellido, ', ', P.nombre) AS PACIENTE, concat(U.apellido, ', ', U.nombre) AS USUARIO, id_compartir AS COMPARTIR FROM compartidos AS C INNER JOIN vinculos AS V ON V.id_vinculo = C.id_vinculo INNER JOIN pacientes AS P ON P.id_paciente = C.id_paciente INNER JOIN usuarios AS U ON U.id_usuario = V.id_usuario_out WHERE V.id_usuario_in = {$this->id}";

		$this->db->query($q);

		if ($this->db->numRows()) {
			while ($_ = $this->db->fetchAssoc()) {
				$_['URL'] = URL_ROOT . '/paciente/' . crypt_params(array(PACIENTE => $_['id']));
				$mecomarten[] = $_;
			}
		}

		$this->db->free();

		return $mecomarten;
	}

	public function get_available_users($patient = null)
	{
		$usuarios = array();
		$is_patient = $patient instanceof Patient && is_numeric($patient->id);

		if ($is_patient) {
			$q = "SELECT id_vinculo, id_axis AS vinculo, V.id_usuario_in AS id, foto, ref, apellido, nombre, correo_electronico FROM vinculos AS V INNER JOIN usuarios AS U ON V.id_usuario_in = U.id_usuario WHERE V.id_usuario_out = {$this->id} AND V.id_vinculo NOT IN (SELECT compartidos.id_vinculo FROM compartidos WHERE id_paciente = {$patient->id})";
		} 
		else {
			$q = "SELECT id_vinculo, id_axis AS vinculo, V.id_usuario_in AS id, foto, ref, apellido, nombre, correo_electronico FROM vinculos AS V INNER JOIN usuarios AS U ON V.id_usuario_in = U.id_usuario WHERE V.id_usuario_out = {$this->id}";
			// LA QUERY BELOW TRAE LOS USUARIOS CON UN VINCULO BIDIRECCIONAL PERO TENDRIA QUE DIFERENCIAR CUAL ES EL OTRO USUARIO
			// $q = "SELECT id_axis AS vinculo, V.id_usuario_in AS id, foto, ref, apellido, nombre, correo_electronico FROM vinculos AS V INNER JOIN usuarios AS U ON V.id_usuario_in = U.id_usuario WHERE V.id_usuario_out = {$this->id} OR V.id_usuario_in = {$this->id}";
		}

		// dump($q);
		
		$this->db->query($q);

		if ($this->db->numRows()) {
			while ($_ = $this->db->fetchAssoc()) {
				$photo = empty($_['foto']) ? 'res/pic-placeholder.png' : "perfil/thumb/{$_['foto']}";
				
				$_['foto'] = URL_ROOT . "/img/{$photo}";
				
				if ($is_patient) {
					$_['url'] = crypt_params(array(PACIENTE => $patient->id, VINCULO => $_['id_vinculo']));
				}

				$_['fullname'] = $_['apellido'] . ', ' . $_['nombre'];

				$usuarios[$_['id']] = $_;
			}
		}

		$this->db->free();

		return $usuarios;       
	}

	public function get_picture() 
	{
		return $this->id && $this->select('foto')->foto && file_exists(getcwd() . '/img/perfil/' . $this->foto) ? URL_ROOT . '/img/perfil/thumb/' . $this->foto : 'http://placehold.it/150x150';
	}

	/*
	 * Genera el id para compartir para otros
	 */
	public function generate_share_id() 
	{
		$q = "SELECT COUNT(id_vinculo) FROM vinculos WHERE id_usuario_out = '{$this->id}'";

		$count = $this->db->oneFieldQuery($q);

		return base64url_encode("{$this->id}-{$count}");
	}
	
	/*
	 * Genera el id para compartir para otros
	 */
	public function decode_share_id($encode) 
	{
		$did = base64url_decode($encode);

		$split = explode("-", $did);

		return empty($split[0]) ? null : $split[0];
	}

	public function create_link($user_id, $share_id, $ref)
	{
		if (!is_numeric($user_id)) {
			return false;
		}

		$q = "SELECT COUNT(id_vinculo) FROM vinculos WHERE (id_usuario_out = '{$user_id}' AND id_usuario_in = '{$this->id}') OR id_axis = '{$share_id}'";

		$isset_link = $this->db->oneFieldQuery($q);
		if (!$isset_link) {
			$q = "INSERT INTO vinculos(id_axis, id_usuario_out, id_usuario_in, ref) VALUES ('{$share_id}', '{$user_id}', '{$this->id}', '{$ref}')";

			return $this->db->query($q);
		}
		else{
			add_error_flash('ID ERRONEO, INTENTE CON UNO DISTINTO');
			return false;
		}
	}
	
	public function delete_link($user_id, $share_id)
	{
		if (!is_numeric($user_id)) {
			return false;
		}

		$q = "SELECT id_usuario_out, id_usuario_in FROM vinculos WHERE id_axis = '{$share_id}'";

		$link = $this->db->oneRowQuery($q);

		if (!empty($link) && in_array($this->id, $link) && in_array($user_id, $link)) {
			$q = "DELETE FROM vinculos WHERE id_axis = '{$share_id}'";

			return $this->db->query($q);
		}
		else{
			add_error_flash('ESTE VINCULO NO SE PUEDE ELIMINAR.');
			return false;
		}
	}

	/**
	 * comparte el paciente dado en el primer parametro con el usuario del 
	 * segundo parametro
	 * 
	 * @param Paciente $paciente paciente a ser compartido
	 * @param numeric $usuario usuario con quien compartir paciente
	 * @param array $items array con las key de las areas que seran compartidas
	 * @return bool puede retornar falso si es que la fila ya existe
	 * */
	public function share_patient($Patient, $link_id, $items) 
	{
		if (empty($Patient->id) || !$link_id || !is_numeric($link_id) || !is_numeric($Patient->id)) {
			return false;
		}

		$q = "SELECT count(id_compartir) FROM compartidos WHERE id_paciente = '{$Patient->id}' AND id_vinculo = '{$link_id}'";

		$is_shared = (int) $this->db->oneFieldQuery($q);

		if (!$is_shared) {
			$fotografias = array_key_exists('fotografias', $items) ? 1 : 0;
			$radiografias = array_key_exists('radiografias', $items) ? 1 : 0;
			$cefalometrias = array_key_exists('cefalometrias', $items) ? 1 : 0;
			// $q = "INSERT INTO compartidos (id_vinculo, id_paciente, fotografias, radiografias, cefalometrias) VALUES ((SELECT id_vinculo FROM vinculos WHERE id_usuario_in = {$usuario} AND id_usuario_out = {$this->id}), {$Patient->id}, {$fotografias}, {$radiografias}, {$cefalometrias})";
			$q = "INSERT INTO compartidos (id_vinculo, id_paciente, fotografias, radiografias, cefalometrias) VALUES ({$link_id}, {$Patient->id}, {$fotografias}, {$radiografias}, {$cefalometrias})";
			
			return $this->db->query($q);
		}

		return false;
	}

	public function edit_share_patient($share_id, $items) 
	{
		if (!$share_id || !is_numeric($share_id)) {
			return false;
		}

		$fotografias = array_key_exists('fotografias', $items) ? 1 : 0;
		$radiografias = array_key_exists('radiografias', $items) ? 1 : 0;
		$cefalometrias = array_key_exists('cefalometrias', $items) ? 1 : 0;

		$q = "UPDATE compartidos SET radiografias = '{$radiografias}', fotografias = '{$fotografias}', cefalometrias = '{$cefalometrias}' WHERE  id_compartir = {$share_id}";

		return $this->db->query($q);
	}

	/**
	 * deja de compartir dado el id compartir
	 * 
	 * @param numeric $id relacion usuario paciente
	 * @return bool retorna 0 si se elimino la relacion
	 * */
	public function stop_share_patient($share_id) 
	{
		if (empty($id) || !is_numeric($id)) {
			return false;
		}

		$q = "DELETE FROM compartidos WHERE id_compartir = {$share_id}";

		return $this->db->query($q);
	}

	public function get_patient($id)
	{
		if (!empty($this->patients[$id])) {
			return $this->patients[$id];
		}

		$Patient = new Patient($id);

		if ($Patient->id) {
			// SI TODO ESTA BIEN AGREGO EL PACIENTE
			$this->patients[$Patient->id] = $Patient;

			return $Patient;
		}
	}

	public function get_patients_and_treatments_by_state($state)
	{
		$return = array();

		try{

			$q = "SELECT P.id_paciente AS patient, T.id_tratamiento as treatment FROM pacientes AS P INNER JOIN tratamientos AS T ON T.id_paciente = P.id_paciente AND T.estado = {$state} WHERE id_usuario = {$this->id} AND (P.borrado <> 1 OR P.borrado IS NULL) AND (P.eliminado <> 1 OR P.eliminado IS NULL)";

			$this->db->query($q);

			while ($_ = $this->db->fetchAssoc()) {
				$Patient = $this->get_patient($_['patient']);

				if ($Patient) {
					$Treatment = $Patient->get_treatment($_['treatment']);

					if ($Treatment) {
						$return[] = array('Patient' => $Patient, 'Treatment' => $Treatment);
					}
				}	
			}

			$this->db->free();
			
		}
		finally{
			return $return;
		}
	}

	public function get_treatments_and_patients_deleted()
	{
		$return = array();

		try{

			$q = "SELECT P.id_paciente AS patient, T.id_tratamiento as treatment FROM pacientes AS P INNER JOIN tratamientos AS T ON T.id_paciente = P.id_paciente WHERE id_usuario = {$this->id} AND P.eliminado = 1 AND (P.borrado <> 1 OR P.borrado IS NULL)";

			$this->db->query($q);

			while ($_ = $this->db->fetchAssoc()) {
				$Patient = $this->get_patient($_['patient']);

				if ($Patient) {
					$Treatment = $Patient->get_treatment($_['treatment']);

					if ($Treatment) {
						$return[] = array('Patient' => $Patient, 'Treatment' => $Treatment);
					}
				}	
			}

			$this->db->free();
		}
		finally{
			return $return;
		}
	}
}