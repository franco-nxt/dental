<?php 

/**
 * summary
 */
class Dental
{
	/**
	 * Aca se van a guardar todos los pacientes de este usuario.
	 * @var array
	 */
	public $patients = array();

	protected static $instance;

	public function __get($name) {
		if (isset($this->{$name})) {
			return $this->{$name};
		}

		return null;
	}

	/**
	 * La clase es un singleton para poder obtener 
	 * siempre la misma instancia desde toda la pagina.
	 *
	 * Si el usuario existe y la password es correcta.
	 * Levanta la info basica de la BD
	 * 
	 * @throws DentalException Los parametros son incorrecto.
	 * @throws DentalException La contraseña no coincide.
	 * @param String $user Email del usuario.
	 * @param Strign $pass Password del usuario.
	 */
	protected function __construct($user, $pass)
	{
		// VALIDO LOS PARAMETROS
		if (empty($user) || empty($pass) || !is_string($user) || !is_string($pass)) {
			throw new DentalException("ES NECESARIO COMPLETAR LOS CAMPOS USUARIO Y CONTRASEÑA");
		}
		// EMAIL DEL USUAIRO
		$user = self::DB()->escape($user);
		// TRAIGO LA PASS EN LA BD
		$pass_bd = self::DB()->oneFieldQuery("SELECT clave_seguridad FROM usuarios WHERE correo_electronico = '{$user}'");
		// MD5 DE LA PASSWORD ENVIADA
		$pass_md5 = md5($pass);
		// COMPARO LOS STRINGS
		if (strcmp($pass_bd, $pass_md5) !== 0) {
			throw new DentalException("USUARIO O CONTRASEÑA INCORRECTOS");
		}
		// SI TODO ESTA BIEN TRAIGO ALGUNOS DATOS DE LA BD
		$row = self::DB()->oneRowQuery("SELECT A.habilitado as habilitado, U.id_usuario, U.correo_electronico, U.nombre, U.apellido, U.admin FROM usuarios AS U LEFT JOIN administracion AS A ON A.id_axis = U.id_usuario WHERE U.correo_electronico = '{$user}'");

		if (empty($row['habilitado']) && empty($row['admin'])) {
			throw new DentalException("EL USUARIO NO ESTA HABILITADO.");
		}
		// INFO FILL
		$this->id = $row['id_usuario'];
		$this->fullname = "{$row['apellido']}, {$row['nombre']}";
		$this->apellido = $row['apellido'];
		$this->nombre = $row['nombre'];
		$this->admin = $row['admin'];
		$this->email = $user;
		$this->pass = $pass;
	}

	/**
	 * Actualiza el registro del usuario en la BD.
	 * Si no se le pasa ninguna parametro la query 
	 * se arma usando los datos en la instancia.
	 * 
	 * @throws DentalException Es necesario el id del usuario para actualizar el registro.
	 * @param  aRRAY $data Datos para actualizar.
	 */
	public function update($data = null) 
	{
		// ES NECESARIO EL ID
		if (empty($this->id) || !is_numeric($this->id)) {
			throw new DentalException('ERROR AL ACTUALIZAR LOS DATOS DEL USUARIO.');
		}
		// VAR FIELDS GUARDA LOS SETS PARA LA QUERY
		$fields = array();
		// EL UPDATE LO PUEDE HACER CON LOS DATOS DE LA MISMA INSTANCIA
		if (empty($data) || !is_array($data)) {
			$data = (array) $this;
		}
		// VALIDO Y SETEO LOS CAMPOS
		foreach ($data as $k => $v) {
			if (self:: valid_field($k)) {
				// EL CAMPO clave_seguridad TIENE QUE SER HASHEADO
				$value = $k == 'clave_seguridad' ?  md5($v) : utf8_decode($v);
				// AGERGO EL CAMPO
				$fields[$k] = "{$k} ='{$v}'";
			} 
		}
		// SI HAY ALGUN CAMPO PARA HACER EL UPDATE
		if (!empty($fields)) {
			// IMPLODE SOBRE LOS CAMOS
			$implode = implode(",", $fields);
			// QUERY FINALE
			$q = "UPDATE usuarios SET {$implode} WHERE id_usuario = '{$this->id}'";
			// EJECUTO
			self::DB()->query($q);
		}
		// SINC EN LA INSTANCIA
		$this->select();
	}

	/**
	 * Levanta los campos, enviados por parametro en 
	 * un array o en un string en BD.
	 * 
	 * Por default es '*' que significa todos los campos.
	 *
	 * @throws DentalException Si no hay un id en la instancia.
	 * @param  Mixed $data Array con nombres de campo o strign con un solo campo.
	 * @return Dental       La misma instancia.
	 */
	public function select($data = '*') 
	{
		// ES NECESARIO EL ID
		if (empty($this->id) || !is_numeric($this->id)) {
			throw new DentalException('ERROR AL ACTUALIZAR LOS DATOS DEL USUARIO.');
		}
		// PASO ESE STRING A UN ARRAY
		if (is_string($data)) {
			$data = array($data);
		}
		// ALGO ESTA MAL
		if (empty($data) || !is_array($data)) {
			throw new DentalException('ERROR AL CARGAR LA INFO DEL USUARIO. LOS DATOS SON INCORRECTOS.');
		}
		// ARRAY PARA GUARDAR LOS NOMBRES DE LAS COLUMNAS
		$keys = array();
		// FILTRO LOS CAMPOS
		foreach ($data as $key) {
			if ($key == '*' || self:: valid_field($key)) {
				$keys[$key] = $key;
			}
		}

		if (count($keys)) {
			// IMPLODE CON LAS COLUMNAS
			$implode = implode(', ', $keys);
			// QUERY FINALE
			$q = "SELECT {$implode} FROM usuarios WHERE id_usuario = {$this->id}";
			// EJECUTO LA QERY
			$row = self::DB()->oneRowQuery($q);
			// FILL EN LA INSTANCIA
			foreach ($row as $k => $v) {
				$this->{$k} = $k == 'admin' ? boolval($v) : utf8_encode($v);
			}

			return $this;
		}
	}
	
	/**
	 * Este metodo es como el getInstance, solo que 
	 * me gusto mas esta vez llamarlo login.
	 * 
	 * @throws DentalException Los parametros son incorrecto.
	 * @throws DentalException La contraseña no coincide.
	 * @param String $user Email del usuario.
	 * @param Strign $pass Password del usuario.
	 * @return Dental      Retorna la instancia Dental del usuario.
	 */
	public static function login($user, $pass)
	{
		// SI LA INSTANCIA NO EXISTE LA CREO
		!isset(self:: $instance) && (self:: $instance = new Dental($user, $pass));
		// Y LA RETORNO
		return self:: $instance;
	}

	/**
	 * Levanta todos los pacientes del usuario 
	 * en la BD.
	 *
	 * @throws PatientException Desde patient.
	 * @throws DentalException Faltan el id del usuario para usarlo en la query.
	 * @return Array Todos los pacientes correspondientes a este usuario.
	 */
	public function patients()
	{
		// ES NECESARIO EL ID
		if (empty($this->id) || !is_numeric($this->id)) {
			throw new DentalException('ERROR AL CARGAR LOS PACIENTES.');
		}
		// EL CAMPO 'BORRADO' ES BORRADO LOGICO, LA COLUMNA 'ELIMINADO' ES UN PASO PREVIO A SER BORRADO
		$q = "SELECT id_paciente AS id FROM pacientes WHERE id_usuario = {$this->id} AND (borrado <> 1 OR borrado IS NULL)";
		// EJECUTO
		self::DB()->query($q);
		// POR CADA FILA 
		while ($_ = self::DB()->fetchAssoc()) {
			// GUARDO EL PACIENTE
			$this->patient($_['id']);
		}
		// RETORNO EL ARRAY DE PACIENTES
		return $this->patients;
	}

	/**
	 * Dados ciertos campos, por parametro, busca pacientes en BD
	 * que coincidan con los datos eviados.
	 * 
	 * @throws PatientException Desde patient.
	 * @throws DentalException Faltan el id del usuario para usarlo en la query.
	 * @param  Array $fields Array asociativo con las columnas y el valor del campo para hacer la busqueda.
	 * @return Array         Array de pacientes encontrados.
	 */
	public function buscar($fields)
	{
		// ES NECESARIO EL ID
		if (empty($this->id) || !is_numeric($this->id)) {
			throw new DentalException('ERROR AL CARGAR LOS PACIENTES.');
		}
		// LOS PACIENTES QUE ENCUENTRE
		$patients = array();
		// LAS COLUMNAS DE LA QUERY
		$conditions = array();
		// ESTOS SON SOLO LOS VALORES DE TIPO STRING
		foreach (array('apellido','nombre','ciudad','provincia') as $k) {
			!empty($fields[$k]) && $conditions[$k] = "{$k} LIKE '%{$fields[$k]}%'";
		}
		// SEXO ES UN VALOR INT O TINYINT
		if(!empty($fields['sexo']) && defined("BD_{$fields['sexo']}")) {
			$conditions['sexo'] = "sexo = " . constant("BD_{$fields['sexo']}");
		}
		// FORMATEO EL CAMPO DE INGRESO SI ES QUE ES ENVIADO
		if(!empty($fields['fecha_ingreso'])) {
			$conditions['fecha_ingreso'] = "fecha_ingreso = " . format_date($fields['fecha_ingreso']);
		}
		
		if (!empty($conditions)) {
			$implode = implode(' AND ', $conditions);	
			// QUERY CON LAS CONDICIONES QUE ARME
			$q = "SELECT id_paciente AS id FROM pacientes WHERE id_usuario = {$this->id} AND {$implode}";
			// EJECUTO LA QUERY
			self::DB()->query($q);
			// CARGO LOS PACIENTES
			while ($_ = self::DB()->fetchAssoc()) {
				$patients[] = $this->patient($_['id']);
			}
		}
		// RETORNO EL ARRAY COMO ESTE
		return $patients;
	}

	/**
	 * Si se le pasa un numerico devuelve un Paciente con el id enviado, si el
	 * parametro es un array con los campos validos crea un Paciente y lo retorna
	 * 
	 * @throws PatientException Desde patient.
	 * @throws DentalException Faltan el id del usuario para usarlo en la query.
	 * @param numeric|array $id id del paciente o array clave valor con los datos del paciente.
	 * @return Patient|Bool Instancia del paciente.
	 */
	public function patient($id)
	{
		// ES NECESARIO EL ID
		if (empty($this->id) || !is_numeric($this->id)) {
			throw new DentalException('ERROR AL CARGAR EL USUARIO.');
		}
		// SI ES UN ARRAY ES PORQUE SE CREA UN PACIENTE
		if(is_array($id)){
			$id['id_usuario'] = $this->id; 
		}
		// INSTANCIO EL PACIENTE
		$Patient = new Patient($id);
		// SI TODO ESTA BIEN AGREGO EL PACIENTE
		$this->patients[$Patient->id] = $Patient;

		return $Patient;
	}

	/**
	 * Trae la info de los pacientes que comparto y de 
	 * los usuarios con los que comparto.
	 *
	 * Cada fila del array viene con esta info:
	 * - 'id' => id del paciente
	 * - 'PACIENTE' => nombre completo del paciente.
	 * - 'USUARIO' => nombre completo del usuario con el que este usuario comparte el paciente.
	 * - 'COMPARTIR' => Encode del id del paciente con id del vinculo de compartir.
	 * 
	 * @throws DentalException Faltan el id del usuario para usarlo en la query.
	 * @return Array Info paciente/usuario
	 */
	public function get_shareds_by_me() 
	{
		// ES NECESARIO EL ID
		if (empty($this->id) || !is_numeric($this->id)) {
			throw new DentalException('ERROR AL CARGAR EL USUARIO.');
		}
		// ARRAY DE PACIENTES QUE COMPARTO
		$comparto = array();
		// QUERY 
		$q = "SELECT P.id_paciente AS id, concat(P.apellido, ', ', P.nombre) AS PACIENTE, concat(U.apellido, ', ', U.nombre) AS USUARIO, id_compartir AS COMPARTIR FROM compartidos AS C INNER JOIN vinculos AS V ON V.id_vinculo = C.id_vinculo INNER JOIN pacientes AS P ON P.id_paciente = C.id_paciente INNER JOIN usuarios AS U ON U.id_usuario = V.id_usuario_out WHERE V.id_usuario_in = {$this->id}";
		// EJECUTA
		self::DB()->query($q);

		while ($_ = self::DB()->fetchAssoc()) {
			// URI PARA COMPARTIR
			$_['COMPARTIR'] = crypt_params(array(PACIENTE => $_['id'], COMPARTIR => $_['COMPARTIR']));
			$comparto[] = $_;
		}

		return $comparto;
	}

	/**
	 * Parecido a get_shareds_by_me, trae la misma info 
	 * pero de los pacientes que los usuario comparten conmigo.
	 *
	 * Cada fila del array viene con esta info:
	 * - 'id' => id del paciente
	 * - 'PACIENTE' => nombre completo del paciente
	 * - 'USUARIO' => nombre completo del usuario que comparte el paciente con este usuario
	 * - 'COMPARTIR' => id_compartir que vincula esta info con este usuario
	 * - 'URL' => es la url absoluta al perfil del paciente
	 * 
	 * @throws DentalException Faltan el id del usuario para usarlo en la query.
	 * @return Array Info paciente/usuario
	 */
	public function get_shareds_to_me() 
	{
		// ES NECESARIO EL ID
		if (empty($this->id) || !is_numeric($this->id)) {
			throw new DentalException('ERROR AL CARGAR EL USUARIO.');
		}
		// INFO
		$mecomarten = array();
		// QUERY
		$q = "SELECT P.id_paciente AS id, concat(P.apellido, ', ', P.nombre) AS PACIENTE, concat(U.apellido, ', ', U.nombre) AS USUARIO, id_compartir AS COMPARTIR FROM compartidos AS C INNER JOIN vinculos AS V ON V.id_vinculo = C.id_vinculo INNER JOIN pacientes AS P ON P.id_paciente = C.id_paciente INNER JOIN usuarios AS U ON U.id_usuario = V.id_usuario_in WHERE V.id_usuario_out = {$this->id}";
		// EJECUTO
		self::DB()->query($q);

		while ($_ = self::DB()->fetchAssoc()) {
			// URL ABSOLUTA AL PERFIL DEL PACIENTE
			$_['URL'] = URL_ROOT . '/paciente/' . crypt_params(array(PACIENTE => $_['id']));
			$mecomarten[] = $_;
		}

		return $mecomarten;
	}

	/**
	 * Dado un id de algun paciente devuelve los usuarios 
	 * que estan disponibles para compartir info.
	 *
	 * Si el parametro es nulo los usuarios retornados
	 * son todos los disponible para compartir cualquier paciente.
	 *
	 * Esta es la info que vienen en las filas:
	 * - 'id_vinculo' => 
	 * - 'vinculo' => 
	 * - 'id' => id del usuario
	 * - 'foto' => Foto miniatura del usuario.
	 * - 'ref' => Texto de referencia asignado al usuario.
	 * - 'fullname' => Nombre completo de los usuarios disponibles.
	 * - 'correo_electronico' => 
	 * 
	 * @throws DentalException Faltan el id del usuario para usarlo en la query.
	 * @param  Patient $patient Instancia del paciente.
	 * @return Array            Info de usuarios.
	 */
	public function get_available_users($Patient = null)
	{
		// ES NECESARIO EL ID
		if (empty($this->id) || !is_numeric($this->id)) {
			throw new DentalException('ERROR AL CARGAR EL USUARIO.');
		}
		// RESULT
		$users = array();
		// ESTA VALIDACION LA USO MAS ADELATNE
		$is_patient = $Patient instanceof Patient && is_numeric($Patient->id);

		if ($is_patient) {
			// SI $Patient ES PACIENTE BUSCO LOS USUARIOS DISPONIBLES PARA COMPARTIR ESE PACIENTE
			$q = "SELECT id_vinculo, id_axis AS vinculo, V.id_usuario_in AS id, foto, ref, concat(U.apellido, ', ', U.nombre) AS fullname, correo_electronico FROM vinculos AS V INNER JOIN usuarios AS U ON V.id_usuario_in = {$this->id} WHERE V.id_usuario_out = U.id_usuario AND V.id_vinculo NOT IN (SELECT compartidos.id_vinculo FROM compartidos WHERE id_paciente = {$Patient->id})";
		} 
		elseif(empty($Patient)) {
			// ESTO LO EXPLICO 
			$q = "SELECT id_vinculo, id_axis AS vinculo, V.id_usuario_in AS id, foto, ref, concat(U.apellido, ', ', U.nombre) AS fullname, correo_electronico FROM vinculos AS V INNER JOIN usuarios AS U ON V.id_usuario_out = U.id_usuario WHERE V.id_usuario_in = {$this->id}";
		}

		self::DB()->query($q);

		while ($_ = self::DB()->fetchAssoc()) {
			// MINIATURA DEL USUARIO
			$photo = empty($_['foto']) ? 'res/pic-placeholder.png' : "perfil/thumb/{$_['foto']}";

			$_['foto'] = URL_ROOT . "/img/{$photo}";

			if ($is_patient) {
				$_['url'] = crypt_params(array(PACIENTE => $Patient->id, VINCULO => $_['id_vinculo']));
			}

			$users[$_['id']] = $_;
		}

		self::DB()->free();

		return $users;       
	}

	/**
	 * Obtiene la miniatura de la imagen del usuario.
	 * 
	 * @throws DentalException Desde select.
	 * @return String Ruta absoluta de la miniatura.
	 */
	public function get_picture() 
	{
		// ACTUALIZO EL DATO DE LA INSTANCIA
		$this->select('foto');
		// PATH DONDE SE GUARDA LA MINNIATURA
		$thumb = "/img/perfil/thumb/{$this->foto}";
		// SI EL ARCHIVO NO EXISTE RETORNA LA IMAGEN POR DEFAULT
		return file_exists(getcwd() . $thumb) ? URL_ROOT . $thumb : USER_IMG;
	}

	/**
	 * Genera el id para compartir para otros.
	 *
	 * @throws DentalException Faltan el id del usuario para usarlo en la query.
	 * @return String Id encodeado para compartir info con otros usuarios.
	 */
	public function generate_share_id() 
	{
		// ES NECESARIO EL ID
		if (empty($this->id) || !is_numeric($this->id)) {
			throw new DentalException('ERROR AL CARGAR EL USUARIO.');
		}
		// CANTIDAD DE VINCULOS QUE GENERO ESTE USUARIO
		$q = "SELECT COUNT(id_vinculo) FROM vinculos WHERE id_usuario_out = '{$this->id}'";
		// EJECUTO
		$count = self::DB()->oneFieldQuery($q);
		// RETORNO UN ENCODE DEL MISMO ID DEL USUARIO Y LA CANTIDAD DE VINCULOS
		return base64url_encode("{$this->id}-{$count}");
	}

	/**
	 * Desde el id generado por otro usuario con generate_share_id
	 * Extraigo el id de ese usuario.
	 * 
	 * @param  String $encode Info encodeada.
	 * @return Numeric        Id del usuario decodeado.
	 */
	public function decode_share_id($encode) 
	{
		// PRIMERO DECODE DEL STRING
		$did = base64url_decode($encode);
		// EK STRING DEBERIA TENER LA FORMA "{id}-{count}"
		$split = explode("-", $did);
		// RETORNO SOLO EL ID
		return empty($split[0]) ? null : $split[0];
	}

	/**
	 * Crea un vinculo entre este usuario y otro mas.
	 * 
	 * @param  Numeric $user_id Id de otro usuario.
	 * @param  String $share_id Id unico encodeado.
	 * @param  String $ref      Referencia que le asigna al usuario.
	 * @return Bool           	Resultado de la query que crea el vinculo.
	 */
	public function create_link($user_id, $share_id, $ref)
	{
		// VALIDO LOS PARAMETROS ENVIADOS
		if (empty($user_id) || !is_numeric($user_id) || empty($this->id) || !is_numeric($this->id)) {
			throw new DentalException('ERROR AL CARGAR EL USUARIO.');
		}
		// VALIDO QUE ESTE VINCULO NO EXISTA
		$q = "SELECT COUNT(id_vinculo) FROM vinculos WHERE (id_usuario_out = '{$user_id}' AND id_usuario_in = '{$this->id}') OR id_axis = '{$share_id}'";
		// EJECUTO
		$isset_link = self::DB()->oneFieldQuery($q);

		if (!$isset_link) {
			// CREO EL VINCULO
			$q = "INSERT INTO vinculos(id_axis, id_usuario_out, id_usuario_in, ref) VALUES ('{$share_id}', '{$user_id}', '{$this->id}', '{$ref}')";
			// LO QUE RETORNO ES EL RESULTADO DE LA QUERY
			return self::DB()->query($q);
		}
		else{
			// EL VINCULO YA ESTA EN USO
			throw new DentalException('ID ERRONEO, INTENTE CON UNO DISTINTO');
		}
	}

	/**
	 * Elimina el vinculo entre usuarios.
	 * Tendria que eliminar tambien los pacientes que 
	 * se comparten mediante este vinculo.
	 * 
	 * @param  Numeric $user_id Id del usuario con el que se comparte el vinculo.
	 * @param  String $share_id Id encodeado unico del vinculo.
	 * @return Bool             Resultado de la query que elimina el vinculo.
	 */
	public function delete_link($user_id, $share_id)
	{
		// VALIDO LOS PARAMETROS ENVIADOS
		if (empty($user_id) || !is_numeric($user_id) || empty($this->id) || !is_numeric($this->id)) {
			throw new DentalException('ERROR AL CARGAR EL USUARIO.');
		}
		// TRAIGO EL VINCULO DESDE LA BD
		$q = "SELECT id_usuario_out, id_usuario_in FROM vinculos WHERE id_axis = '{$share_id}'";
		// VINCULO
		$link = self::DB()->oneRowQuery($q);
		// SI ESTA TODO BIEN 
		if (!empty($link) && in_array($this->id, $link) && in_array($user_id, $link)) {
			// LO ELIMINO
			$q = "DELETE FROM vinculos WHERE id_axis = '{$share_id}'";

			return self::DB()->query($q);
		}
		else{
			// EL VINCULO YA ESTA EN USO
			throw new DentalException('ESTE VINCULO NO SE PUEDE ELIMINAR.');
		}
	}

	/**
	 * Comparte el paciente dado en el primer parametro con el usuario del 
	 * segundo parametro.
	 *
	 * @throws DentalException Los parametros no son validos.
	 * @param  Patient $Patient Paciente a ser compartido
	 * @param  Numeric $usuario Usuario con quien compartir paciente
	 * @param  Array   $items   Array con las key de las areas que seran compartidas
	 * @return Bool 			Puede retornar falso si es que la fila ya existe
	 */
	public function share_patient($Patient, $link_id, $items) 
	{
		// VALIDO LOS PARAMETROS ENVIADOS
		if (empty($Patient->id) || empty($link_id) || !is_numeric($link_id) || !is_numeric($Patient->id)) {
			throw new DentalException('NO SE PUEDE COMPARTIR EL PACIENTE. LOS DATOS ENVIADOS SON ERRONEOS.');
		}
		// QUERY PARA SABER SI EL PACIENTE YA ESTA COMPARTIDO EN ESTE VINCULO.
		$q = "SELECT count(id_compartir) FROM compartidos WHERE id_paciente = '{$Patient->id}' AND id_vinculo = '{$link_id}'";

		$is_shared = (int) self::DB()->oneFieldQuery($q);

		if (!$is_shared) {
			// INFO QUE DEL USUARIO QUE SE VA A COMPARTIR
			$fotografias = (int) in_array('fotografias', $items);
			$radiografias = (int) in_array('radiografias', $items);
			$cefalometrias = (int) in_array('cefalometrias', $items);
			// $q = "INSERT INTO compartidos (id_vinculo, id_paciente, fotografias, radiografias, cefalometrias) VALUES ((SELECT id_vinculo FROM vinculos WHERE id_usuario_in = {$usuario} AND id_usuario_out = {$this->id}), {$Patient->id}, {$fotografias}, {$radiografias}, {$cefalometrias})";
			$q = "INSERT INTO compartidos (id_vinculo, id_paciente, fotografias, radiografias, cefalometrias) VALUES ({$link_id}, {$Patient->id}, {$fotografias}, {$radiografias}, {$cefalometrias})";
			// EJECUTO
			return self::DB()->query($q);
		}
		// SI EL PACIENTE YA ESTA COMPARTIDO.
		return false;
	}

	/**
	 * Edita la info del paciente que se comparte.
	 * Para esto es necesario el id de la relacion compartir.
	 * 
	 * @throws DentalException Los parametros no son validos.
	 * @param  Numeric $share_id Id de la tabla relacional compartir.
	 * @param  Array   $items    Array con las key de las areas que seran compartidas
	 * @return Bool           	 Resultados de la query que hace el update.
	 */
	public function edit_share_patient($share_id, $items) 
	{
		if (empty($share_id) || !is_numeric($share_id) || !is_array($items)) {
			throw new DentalException('NO SE PUEDE COMPARTIR EL PACIENTE. LOS DATOS ENVIADOS SON ERRONEOS.');
		}
		// INFO QUE DEL USUARIO QUE SE VA A COMPARTIR
		$fotografias = (int) in_array('fotografias', $items);
		$radiografias = (int) in_array('radiografias', $items);
		$cefalometrias = (int) in_array('cefalometrias', $items);
		// QUERY UPDATE
		$q = "UPDATE compartidos SET radiografias = '{$radiografias}', fotografias = '{$fotografias}', cefalometrias = '{$cefalometrias}' WHERE  id_compartir = {$share_id}";
		// EJECUTO
		return self::DB()->query($q);
	}

	/**
	 * Deja de compartir dado el id compartir.
	 * 
	 * @param  Numeric $share_id Relacion usuario paciente
	 * @return Bool 
	 */
	public function stop_share_patient($share_id) 
	{
		// VALIDO LOS CAMPOS
		if (empty($share_id) || !is_numeric($share_id)) {
			throw new DentalException('NO SE PUEDE DEJAR DE COMPARTIR EL PACIENTE. LOS DATOS ENVIADOS SON ERRONEOS.');
		}

		$q = "DELETE FROM compartidos WHERE id_compartir = {$share_id}";

		return self::DB()->query($q);
	}

	/**
	 * Obtiene un paciente segun el id enviado.
	 *
	 * @throws PatientException Al momento de instanciar Patient.
	 * @param  Numeric $id Id numerico del paciente.
	 * @return Patient     [description]
	 */
	public function get_patient($id)
	{
		// SI YA EXISTE LO RETORNO
		if (!empty($this->patients[$id])) {
			return $this->patients[$id];
		}

		$Patient = new Patient($id);
		// SI TODO ESTA BIEN AGREGO EL PACIENTE
		$this->patients[$Patient->id] = $Patient;
		return $Patient;
	}

	/**
	 * Obtiene segun el $state enviado, la info 
	 * de todos pacientes y tratmientos que tengan ese estado.
	 * 
	 * @throws DentalException Los parametros no son validos.
	 * @throws PatientException desde get_patient.
	 * @throws TreatmentException desde get_treatment.
	 * @param  Numeric $state Uno de los posibles valores de la columna estado.
	 * @return Array          Array con la info.
	 */
	public function get_patients_and_treatments_by_state($state)
	{
		// VALIDO EL PARAMETRO Y LA INSTANCIA
		if (empty($state) || !is_numeric($state) || !defined("TRATAMIENTO_ESTADO_{$state}") || empty($this->id) || !is_numeric($this->id)) {
			throw new DentalException('NO SE PUEDEN CARGAR LOS TRATAMIENTOS.');
		}
		// RESULTADO
		$return = array();
		// QUERY QUE BUSCA TRATAMIENTOS Y SU PACIENTE SEGUN $state, QUE EL PACIENTE NO ESTE NI ELIMINADO NI BORRADO
		$q = "SELECT P.id_paciente AS patient, T.id_tratamiento as treatment FROM pacientes AS P INNER JOIN tratamientos AS T ON T.id_paciente = P.id_paciente AND T.estado = {$state} WHERE id_usuario = {$this->id} AND (P.borrado <> 1 OR P.borrado IS NULL) AND (P.eliminado <> 1 OR P.eliminado IS NULL)";
		// EJECUTO
		self::DB()->query($q);

		while ($_ = self::DB()->fetchAssoc()) {
			// OBTENGO EL PACIENTE
			$Patient = $this->get_patient($_['patient']);
			// OBTENGO EL TRATAMIENTO
			$Treatment = $Patient->get_treatment($_['treatment']);
			// AGREGO LAS INSTANCIAS AL RESULTADO
			$return[] = array('Patient' => $Patient, 'Treatment' => $Treatment);
		}
		// RESULTADO
		return $return;
	}
	
	/**
	 * Obtiene la info de todos pacientes y 
	 * tratmientos que esten eliminado.
	 * 
	 * @throws DentalException Los parametros no son validos.
	 * @throws PatientException desde get_patient.
	 * @throws TreatmentException desde get_treatment.
	 * @return Array          Array con la info.
	 */
	public function get_treatments_and_patients_deleted()
	{
		// VALIDO EL PARAMETRO
		if (empty($this->id) || !is_numeric($this->id)) {
			throw new DentalException('NO SE PUEDEN CARGAR LOS TRATAMIENTOS.');
		}
		// RESULTADO
		$return = array();
		// QUERY QUE BUSCA TRATAMIENTOS Y SU PACIENTE, QUE EL TRATMIENTO ESTE ELIMINADO Y EL PACIENTE NO ESTE NI ELIMINADO NI BORRADO
		$q = "SELECT P.id_paciente AS patient, T.id_tratamiento as treatment FROM pacientes AS P INNER JOIN tratamientos AS T ON T.id_paciente = P.id_paciente WHERE id_usuario = {$this->id} AND P.eliminado = 1 AND (P.borrado <> 1 OR P.borrado IS NULL)";
		// EJECUTO
		self::DB()->query($q);

		while ($_ = self::DB()->fetchAssoc()) {
			// OBTENGO EL PACIENTE
			$Patient = $this->get_patient($_['patient']);
			// OBTENGO EL TRATAMIENTO
			$Treatment = $Patient->get_treatment($_['treatment']);
			// AGREGO LAS INSTANCIAS AL RESULTADO
			$return[] = array('Patient' => $Patient, 'Treatment' => $Treatment);
		}
		// RESULTADO
		return $return;
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
		$ptrn = '/^(a(dmin|pellido)|c(elular|iudad|lave_seguridad|o(digo_postal|mentarios_(c(efalometrias|ompartir)|diagnostico|economia|generales|odontograma|(foto|radio)grafias|tratamiento)|rreo_electronico))|direccion|foto|nombre|p(ais|rovincia)|telefono)$/';
		// TRUE SI NO ESTA VACIO, ES UN STRING Y MATCHEA CON ALGUNA DE LAS COLUMNAS EN BD
		return !empty($fieldname) && is_string($fieldname) && preg_match($ptrn, $fieldname);
	}

	public static function toggle($id)
	{
		// VALIDO EL PARAMETRO
		if (empty($id) || !is_numeric($id)) {
			throw new DentalException('NO SE PUEDE CAMBIAR EL ESTADO DEL PACIENTE, LOS DATOS ENVIADOS SON INVALIDOS.');
		}
		$q = "SELECT habilitado FROM administracion WHERE id_axis =  {$id}";
		// EJECUTO
		$enable = (int) empty(self::DB()->oneFieldQuery($q));

		self::DB()->query("UPDATE administracion SET habilitado = {$enable} WHERE id_axis = {$id}");		
	}

	protected static function DB()
	{
		return MySQL::getInstance();
	}
}