<?php 

/**
 * summary
 */
class Patient
{
	/**
	 * 	
	 * @var Numeric
	 */
	public $id;
	
	/**
	 * 
	 * @var String
	 */
	public $apellido;
	
	/**
	 * 
	 * @var String
	 */
	public $nombre;
	
	/**
	 * 
	 * @var String
	 */
	public $sexo;
	
	/**
	 * 
	 * @var String
	 */
	public $dni;
	
	/**
	 * 
	 * @var String
	 */
	public $fecha_nacimiento;
	
	/**
	 * 
	 * @var String
	 */
	public $fecha_ingreso;
	
	/**
	 * 
	 * @var String
	 */
	public $telefono;
	
	/**
	 * 
	 * @var String
	 */
	public $celular;
	
	/**
	 * 
	 * @var String
	 */
	public $correo_electronico;
	
	/**
	 * 
	 * @var String
	 */
	public $direccion;
	
	/**
	 * 
	 * @var String
	 */
	public $ciudad;
	
	/**
	 * 
	 * @var String
	 */
	public $provincia;
	
	/**
	 * 
	 * @var String
	 */
	public $madre_apellido;
	
	/**
	 * 
	 * @var String
	 */
	public $madre_nombre;
	
	/**
	 * 
	 * @var String
	 */
	public $padre_apellido;
	
	/**
	 * 
	 * @var String
	 */
	public $padre_nombre;
	
	/**
	 * 
	 * @var String
	 */
	public $codigo_postal;
	
	/**
	 * 
	 * @var String
	 */
	public $foto;
	
	/**
	 * 
	 * @var String
	 */
	public $estado;
	
	/**
	 * 
	 * @var String
	 */
	public $derivado_por;
	
	/**
	 * 
	 * @var String
	 */
	public $eliminado;
	
	/**
	 * 
	 * @var String
	 */
	public $borrado;

	/**
	 * Id del usuario asigando al paciente.
	 *
	 * @var Numeric
	 */
	public $id_usuario; 

	/**
	 * Uri que encodea $id.
	 * 
	 * @var String
	 */
	private $url;
	
	/**
	 * Array con todos los tratamientos del paciente
	 *
	 * @var Array
	 */
	public $treatments = array();

	/**
	 * Este mtodo magico sirve para llamar a la 
	 * conexion con BD dentro de la instancia y 
	 * cuando se usan algunos sinonimos de las propiedades.
	 *
	 * @throws PatientException Desde select.
	 * @param  String $name Nombre de la prop a obtener.
	 * @return Mixed        
	 */
	public function __get($name) {
		if ($name == 'db') {
			return MySQL::getInstance();
		}
		elseif ($name == 'nacimiento') {
			return date('d/m/y', strtotime($this->fecha_nacimiento));
		}
		elseif ($name == 'genero') {
			return defined("SEXO_{$this->sexo}") ? constant("SEXO_{$this->sexo}") : null;
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
	 * Esta clase es usada en todo el sitio.
	 * 
	 * @param Numeric|Array $id Si se pasa un id numerico es porque el paciente ya existe, cuando se pasa un diccionario para crear el paciente
	 * @return Patient|Boolean Si el paciente existe y todo es correcto lo retorna si no es asi devuelve false
	 */
	public function __construct($id)
	{
		// SIEMPRE NECESITAMOS ALGUN DATO
		if (empty($id)) {
			throw new PatientException("ES NECESARIO UN ID PARA ENCONTRAR AL PACIENTE");
		}
		// CUANDO VENGA UN ARRAY ES PARA CREAR EN LA BD SI NO SOLO PARA INSTANCIAR
		if (is_array($id)) {
			// LLAMO A CREAR EL PACIENTE EN LA BD
			$this->create($id);
		}
		elseif (is_numeric($id)) {
			// SACO EL ID DEL USUARIO EN SESSION
			$user_id = get_user()->id;
			// QUERY PARA TRAER A QUIEN REALMENTE LE PERTENCE EL PACIENTE
			$q = "SELECT id_usuario FROM pacientes WHERE id_paciente = {$id}";
			// ID DEL USUARIO ASIGANDO A ESTE PACIENTE
			$owner_user_id = $this->db->oneFieldQuery($q);
			// SI SON DISTINTOS USUARIOS
			if ($owner_user_id != $user_id) {
				// QUERY PARA CHEQUEAR SI EL PACIENTE ESTA COMPARTIDO A ESTE USUARIO DEDE ALGUN OTRO
				$q = "SELECT {$id} IN (SELECT C.id_paciente FROM vinculos AS V  LEFT JOIN compartidos AS C ON C.id_vinculo = V.id_vinculo WHERE V.id_usuario_out = {$owner_user_id} AND V.id_usuario_in = {$user_id})";
				// EJECUTO 
				$is_shared = (Bool) $this->db->oneFieldQuery($q);
				// EL PACIENTE NO ES SUYO NI ESTA COMPARTIDO POR OTRO PACIENTE
				if (!$is_shared) {
					throw new PatientException('EL PACIENTE INDICADO NO EXISTE');
				}
			}
			// TODO OK ASIGNO EL ID ENVIADO A LA INSTANCIA
			$this->id = $id;
			$this->id_usuario = $user_id;
		}
		// ASIGNO EL ENCODE QUE LLEVA LA URL
		$this->url = crypt_params(array(PACIENTE => $this->id));
	}

	/**
	 * Crea un paciente en la BBDD.
	 * 
	 * Usada en el constructor de la Clase.
	 * 
	 * @param Array $data Datos con los que se va a crear el paciente.
	 * */
	private function create($data)
	{
		// ESTOS DOS DATOS SON REQUERIDOS
		if (empty($data['apellido']) || empty($data['nombre'])) {
			throw new PatientException('ES NECESARIO COMPLETAR AL MENOS LOS CAMPOS NOMBRE Y APELLIDO');	
		}
		// COLUMNAS INICIALES
		$keys = array('estado', 'borrado', 'eliminado', 'fecha_nacimiento', 'fecha_ingreso');
		// VALORES INICIALES, PARA INICIAR UN PACIENTE TIENE QUE ESTAR ACTIVO Y SIN ELIMINAR NI BORRAR
		$values = array(BD_PACIENTE_ESTADO_ACTIVO, '0', '0'); 
		// USO ESTA FECHA CUANDO NO ME MANDAN UNA
		$date = date('Y-m-d H:i:s');
		// SI LA FECHA DE NACIMIENTO NO ES ENVIADA DENTRO DE LOS DATOS LA MARCO YO
		$values[] = isset($data['fecha_nacimiento']) && $data['fecha_nacimiento'] ? date('Y-m-d H:i:s', strtotime($data['fecha_nacimiento'])) : $date;
		// YA LA AGREGUE A LOS VALORES, NO LA USO MAS
		unset($data['fecha_nacimiento']);
		// SI LA FECHA DE INGRESO NO ES ENVIADA DENTRO DE LOS DATOS LA MARCO YO
		$values[] = isset($data['fecha_ingreso']) && $data['fecha_ingreso'] ? date('Y-m-d H:i:s', strtotime($data['fecha_ingreso'])) : $date;
		// YA LA AGREGUE A LOS VALORES, NO LA USO MAS
		unset($data['fecha_ingreso']);
		// EMPIEZO A CARGAR LOS DATOS ENVIADOS
		foreach ($data as $key => $value) {
			// SOLO LAS CLAVES DEL ARRAY CORRECTAS VAN A SER GUARDADAS
			if ($this->valid_field($key) && is_string($value)) {
				$keys[]   = $key;
				$values[] = $this->db->escape($value);
			}
		}
		// IMPLODE CON LOS CAMPOS
		$implode_keys = implode(",", $keys);
		// IMPLODE CON LOS VALORES
		$implode_values = implode("','", $values);
		// QUERY FINAL
		$q = utf8_decode("INSERT INTO pacientes ({$implode_keys}) VALUES ('{$implode_values}')");
		// EJECUTO
		$this->db->query($q);
		// ASIGNO EL ID DEL PACIENTE A LA INSTANCIA
		$this->id = $this->db->lastID();
	}

	/**
	 * A esta func se le dan los campos para hacer un pull desde la bbdd, 
	 * los argumentos puede ser un campo o muchos dentro de un array.
	 * 
	 * Usado en casi todo el sitio y en la misma clase.
	 * 
	 * @param string|array $data nombres validos campo/s 
	 * @return Patient su propia instancia
	 * */
	public function select($data = '*') 
	{
		// ES NECESARIO EL ID DEL PACIENTE
		if (empty($this->id) || !is_numeric($this->id)) {
			throw new PatientException('PACIENTE NO ENCONTRADO.');
		}
		// SI EL PARAMETRO ES UN STRING LO PASO A UN ARRAY
		!is_array($data) && $data = array($data);
		// VAR PARA GUARDAR LAS COLUMNAS DEL SELECT
		$keys = array();
		// FILTRO LOS CAMPOS Y AJUSTO LOS NOMBRES DE LOS CAMPOS SOLICITADOS A LOS REALES DE LA BBDD
		foreach ($data as $field) {
			// FILTRO LOS CAMPOS VALIDOS
			if ($this->valid_field($field)) {
				$keys[] = $field;
			}
		}
		// SIEMPRE QUE HAYA ALGUNA COLUMNA PARA TRAER
		if (!empty($keys)) {
			// IMPLODE CON LOS CAMPOS SIN REPETIR
			$unique_implode = implode(', ', array_unique($keys));
			// ARMO LA QUERY FINAL
			$q = "SELECT {$unique_implode} FROM pacientes WHERE id_paciente = {$this->id}";
			// EJECUTO
			$paciente = $this->db->oneRowQuery($q);
			// FILL EN LAS PROPIEDADES DEL PACIENTE
			foreach ($paciente as $k => $v) {
				// SI ES ALGUNA DE LAS FECHA LA FORMATEO, SINO MANDO EL ENCODE
				$this->{$k} = preg_match('/^fecha_(nacimient|ingres)o$/', $k) ? date('d/m/y', strtotime($v)) : utf8_encode($v);
			}
		}
		// SE RETORNA A SI MISMO
		return $this;
	}
	
	/**
	 * Actualiza los datos del paciente en BD.
	 * Es usado en actions/paciente.php
	 *
	 * @param Array $data Si data es null actualiza usando los datos de las propiedades
	 * @return Bool true || false Si es que el paciente fue actualizado
	 */
	public function update($data) 
	{	
		// ES NECESARIO EL ID DEL PACIENTE
		if (!$this->id) {
			throw new PatientException('NO ES POSIBLE ACTUALIZAR AL PACIENTE.');
		}
		// ES NECESARIA LA DATA PARA ACTUALIZAR
		if (!is_array($data) || empty($data)){
			throw new PatientException('NO SE PUEDE ACTUALIZAR AL PACIENTE, LOS DATOS ENVIADOS SON ERRONEOS.');
		}
		// VARIABLE PARA GUARDAR LOS CAMPOS SET DE LA QUERY
		$set_query = array();

		// SI LA FECHA DE NACIMIENTO ES ENVIADA LA FORMATEO
		if(!empty($data['fecha_nacimiento'])) {
			$data['fecha_nacimiento'] = self::format_date($data['fecha_nacimiento']);
		} 
		// SI LA FECHA DE INGRESO ES ENVIADA LA FORMATEO
		if(!empty($data['fecha_ingreso'])) {
			$data['fecha_ingreso'] = self::format_date($data['fecha_ingreso']);
		} 

		foreach ($data as $k => $v) {
			// SI EL NOMBRE DEL CAMPO Y EL VALOR SON CORRECTOS
			if ($this->valid_field($k) && is_string($v)) {
				// AGREGO EL CAMPO
				$set_query[] = utf8_decode("{$k} = '{$v}'");
			}
		}
		// SOLO HAGO LA QUERY SI HAY ALGUN DATO PARA ACTUALIZAR
		if (!empty($set_query)) {
			// NECESITO UN STRING CON LOS CAMPOS
			$implode = implode(', ', $set_query);
			// ARMO LA QUERY FINAL
			$q = "UPDATE pacientes SET {$implode} WHERE id_paciente = '{$this->id}'";
			// EJECUTO
			$this->db->query($q);
			// LLAMO A select PARA ACTUALIZAR LOS DATOS DE LA INSTANCIA
			$this->select();
			// EL PACIENTE FUE ACTUALIZADO
			return true; 
		}
		// EL PACIENTE NO FUE ACTUALIZADO
		return false;
	}

	/**
	 * Busca los tratamientos disponibles para la instancia del Paciente
	 *
	 * @return array la propiedad tratamientos, conjuntos de tratamientos
	 * */
	public function get_treatments() 
	{
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
	public function old_treatments() 
	{
		$q = "SELECT T.id_tratamiento AS id FROM tratamientos T INNER JOIN pacientes P ON P.id_paciente = T.id_paciente AND P.id_paciente = {$this->id} AND (T.eliminado <> 1 OR T.eliminado IS NULL) ORDER BY T.id_tratamiento DESC LIMIT 1,100";

		$this->db->query($q);
		
		$treatments = array();

		while ($_ = $this->db->fetchAssoc()) {
			$treatments[] = $this->get_treatment($_['id']);
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
	public function create_treatment($data) 
	{
		if (!is_array($data)) {
			throw new PatientException('IMPOSIBLE CREAR TRATAMIENTO CON LOS DATOS ENVIADOS');
		}

		$data['id_paciente'] = $this->id;

		$Treatment = new Treatment($data);

		if ($Treatment->id) {
            // SI TODO ESTA BIEN AGREGO EL TRATAMIENTO
			$this->treatments[$Treatment->id] = $Treatment;

			return $Treatment;
		}
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
		// ES NECESARIO EL ID
		if (empty($this->id)) {
			throw new PatientException('PACIENTE NO ENCONTRADO');
		}
		// SI NO VIENE UN ID
		if (empty($id)) {
			// TRAIGO EL ID DEL ULTIMO TRATAMIENTO DEL PACIENTE
			$q  = "SELECT id_tratamiento as id FROM tratamientos WHERE id_paciente = {$this->id} AND (eliminado <> 1 OR eliminado IS NULL) ORDER BY id_tratamiento DESC LIMIT 0, 1";
			// EJECUTO Y SETEO ESTE ID
			$id = $this->db->oneFieldQuery($q);
		}
		// COMPRUEBO SI NO ESTA CARGADO PREVIAMENTE
		if (!empty($this->treatments[$id]) && $this->treatments[$id] instanceof Treatment) {
			// SETEO CON EL TRATAMIENTO PRECARGADO
			$Treatment = $this->treatments[$id];
		}
		else{
			// OBTENGO LA INSTANCIA DEL TRATAMIENTO
			$Treatment = new Treatment($id);
			// AGREGO EL TRATAMIENTO A LOS DEL PACIENTE
			$this->treatments[$Treatment->id] = $Treatment;
		}
		// Y LO RETORNO
		return $Treatment;
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
		$formated_born = self::format_date($this->fecha_nacimiento);
		$today = date('Y-m-d');
		
		return (int) floor(diff_date($formated_born, $today) / 365);
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

	/**
	 * Valida que el usuario en session sea el correcto
	 *
	 * @return Bool Segun se de esa condicion.
	 */
	public function check_user()
	{
		return $this->id_usuario == get_user()->id;
	}

	public function delete()
	{
		if (!$this->id) {
			throw new PatientException('PACIENTE NO ENCONTRADO');
		}

		$q = "UPDATE pacientes SET eliminado = 1 WHERE id_paciente = '{$this->id}'";

		$this->db->query($q);
	}

	public function restore()
	{
		if (!$this->id) {
			throw new PatientException('PACIENTE NO ENCONTRADO');
		}

		$q = "UPDATE pacientes SET eliminado = 0 WHERE id_paciente = '{$this->id}'";

		$this->db->query($q);
	}

	/**
	 * Valida que el nombre del campo enviado corresponda con el de la BBDD 
	 * y que se puedan actualizar.
	 * el campo id_paciente o id no lo valida porque se carga una sola vez.
	 *
	 * Este metodo es usado en update, select y create.
	 *
	 * @param String $fielname Nombre del campo a validar.
	 * @return Bool Si es valido o no.
	 */
	public function valid_field($fieldname)
	{
		return !empty($fieldname) && is_string($fieldname) && preg_match("#^(id_usuario|(fecha_(nacimient|ingres)|apellid|telefon|eliminad|estad|fot|sex|correo_electronic)o|[mp]adre_(apellido|nombre)|d(ni|erivado_por|ireccion)|c(elular|iudad|odigo_postal)|provincia|nombre)$#", $fieldname);
	}
}