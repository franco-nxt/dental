<?php 

/**
 * summary
 */
class Admin extends Dental
{
	protected static $instance;

	public static function login($username, $pass)
	{
		$User = parent::login($username, $pass)->select('admin');

		if (!$User->admin) {
			throw new AdminException('ACCESO DENEGADO.');
		}
		// SI LA INSTANCIA NO EXISTE LA CREO
		!isset(self:: $instance) && (self:: $instance = new self($username, $pass));
		// Y LA RETORNO
		return self:: $instance;
	}

	/**
	 * [name description]
	 * @return [type] [description]
	 */
	public function get_axis_users()
	{
		$q = "SELECT habilitado, dni, id_usuario as id, CONCAT(U.apellido, ', ', U.nombre) as fullname, U.correo_electronico, U.telefono, U.celular, U.direccion, U.codigo_postal, U.ciudad, U.provincia, U.pais FROM usuarios AS U LEFT JOIN administracion ON id_axis = id_usuario WHERE admin != 1";
		$rows = array();

		$db = MySQL::getInstance();
		$db->query($q);

		while ($row = $db->fetchAssoc()) {
			$row['url'] = crypt_params(array(USUARIO => $row['id']));
			$rows[] = (Object) $row;
		}

		return $rows;
	}

	/**
	 * [name description]
	 * @return [type] [description]
	 */
	public function get_axis_user($id)
	{
		// VALIDO EL ID
		if (empty($id) || !is_numeric($id)) {
			throw new AdminException('NO SE ENCUENTRA EL USUARIO INDICADO, LOS DATOS ENVIADOS SON INCORRECTOS.');
		}
		//QUERY
		$q = "SELECT habilitado, dni, U.apellido, U.nombre, U.correo_electronico, U.telefono, U.celular, U.direccion, U.codigo_postal, U.ciudad, U.provincia, U.pais, U.foto FROM usuarios AS U LEFT JOIN administracion ON id_axis = {$id} WHERE id_usuario = {$id}";
		$return = MySQL::getInstance()->oneRowQuery($q);

		$return && $return['id'] = $id;
			
		return (Object) $return;
	}

	public function create_user($input_data)
	{   
		// CAMPOS REQUERIDOS PARA LA TABLA ADMINISTRACIONS
		$admin_keys = array("apellido","nombre","dni","correo_electronico","telefono","celular","direccion","codigo_postal","ciudad","provincia","pais","tarjeta_tipo","tarjeta_num","tarjeta_fecha_mmyy");
		// OBTENGO SOLO LOS CAMPOS UTILES Y QUE NO ESTEN VACIOS
		$data = array_filter(array_intersect_key($input_data, array_flip($admin_keys)));
		// AMBOS ARRAY DEBERIAN TENER LA MISMA LENGTH
		if (count($data) !== count($admin_keys)) {
			// SI NO ES PORQUE ALGUNO ESTA VACIO
			throw new AdminException('NO SE PUEDE CREAR EL USUARIO, LOS DATOS ENVIADOS SON INCOMPLETOS.');
		}

		$db = MySQL::getInstance();
		// AHORA VALIDO QUE LOS DATOS NO ESTEN DUPLICADOS
		$q = "SELECT dni as 'DNI', correo_electronico AS 'CORREO ELECTRONICO', tarjeta_num AS 'NUMERO DE TARJETA' FROM administracion WHERE dni = '{$data['dni']}' OR correo_electronico = '{$data['correo_electronico']}' OR tarjeta_num = '{$data['tarjeta_num']}'";
		$db->query($q);

		while ($duplicated_data = $db->fetchAssoc()) {
			// COLUMNAS QUE TENGAN VALOR DUPLICADO
			$duplicated_fields = array_keys(array_intersect($duplicated_data, $data));
			// EL MENSAJE DEPENDE DE CUANTOS CAMPOS ENCUENTRE
			switch (count($duplicated_fields)) {
				case 1: throw new AdminException("EL VALOR INGRESADO EN {$duplicated_fields[0]} ESTA DUPLICADO, INTENTE CON OTRO DISTINTO."); break;
				case 2: throw new AdminException("LOS VALORES INGRESADOS EN {$duplicated_fields[0]} y {$duplicated_fields[1]} ESTAN DUPLICADOS. INTENTE CON OTROS DISTINTOS."); break;
				case 3: throw new AdminException("LOS VALORES INGRESADOS EN {$duplicated_fields[0]}, {$duplicated_fields[1]} Y {$duplicated_fields[2]} ESTAN DUPLICADOS. INTENTE CON OTROS DISTINTOS."); break;
			}
		}
		// UNA CLAVE DE SEGURIDAD POR DEFECTO
		$data["clave_seguridad"] = md5($data['dni'] . '@Axis');
		// COLUMNAS DE LA TABLA USUARIOS
		$user_keys = array("clave_seguridad", "apellido", "nombre", "correo_electronico", "telefono", "celular", "direccion", "codigo_postal", "ciudad", "provincia", "pais");
		// OBTENGO LOS CAMPOS QUE USA LA TABLA USUARIOS
		$user_fields = array_filter(array_intersect_key($data, array_flip($user_keys)));
		// CONCATENO LAS COLUMNAS DE LA TABLA USUARIOS
        $kstr = implode(",", array_keys($user_fields));
        // CONCATENO LOS VALORES PARA LA TABLA USUARIOS
        $vstr = implode("','", $user_fields);
        // CREO EL PACIENTE EN LA TABLA USUARIOS
        $db->query("INSERT INTO usuarios ({$kstr}) VALUES ('{$vstr}')");
        // ID DEL USUARIO NUEVO
        $id_axis = $db->lastID();
        // SI ALGO SALIO MAL
        if (empty($id_axis)) {
        	throw new AdminException('EL USUARIO NO PUDO SER CREADO VUELVA A INTENTARLO POR FAVOR.');	
        }
        // REPITO EL PROCESO PERO CON LA TABLA ADMINISTRACION
        $data['id_axis'] = $id_axis;
		// MONTO DE SUSCRIPCION
        $data['subscripcion_monto'] = 50;
		// CONCATENO LAS COLUMNAS DE LA TABLA ADMINISTRACION
        $kstr = implode(",", array_keys($data));
        // CONCATENO LOS VALORES PARA LA TABLA ADMINISTRACION
        $vstr = implode("','", $data);
        // INSERTO
        try{
        	$db->query("INSERT INTO administracion ({$kstr})  VALUES ('{$vstr}')");
        }
        catch(Exception $e){
        	// echo $e->getMessage();
        }
	}
}