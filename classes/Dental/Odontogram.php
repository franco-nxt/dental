<?php

class Odontogram {

	/**
	 * Los datos del odotograma 
	 * se guardan en esta variable
	 *
	 * @var Array
	 */
	public $datos_json;

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
	 * Si al constructor se le pasa un id numerico, la instancia
	 * que es creada levanta la info desde la BD. 
	 * Si no es enviado un id, se crea un registro vacio en la base.
	 *
	 * El odontograma se crea al momento de crear un tratamiento.
	 * 
	 * @throws OdontogramException Desde el metodo 'select'.
	 * @param Numeric $id (opcional) id del odontograma a instanciar.
	 */
	function __construct($id = null) 
	{
		if ($id) {
			// ASIGNO EL ID A LA INSTANCIA
			$this->id = $id;
			// SI TENEMOS UN ID ACTUALIZO LA INSTANCIA
			$this->select();
		}
		elseif (empty($id)) {
			// CREO UNO EN BD
			$this->create();
		}
		else{
			throw new OdontogramException('OCURRIO UN ERROR CON EL ODONTROGRAMA. VUELVA A INTENTARLO.');
		}
	}

	/**
	 * Crea un registro vacio en la tabla odotogramas.
	 * 
	 */
	private function create()
	{
		// QUERY PARA CREAR UN ODONTROGRAMA
		$q = "INSERT INTO odontogramas (datos_json) VALUES ('{}')";
		// EJECUTO LA QUERY
		$this->db->query($q);
		// OBTENGO EL ID Y LO ASIGNO A LA INSTACIA		
		$this->id = $this->db->lastID();
	}

	/**
	 * Levanta los TODOS los datos desde la BD y actualiza la informacion en 
	 * la instancia.
	 * 
	 * @throws OdontogramException No hay un id para obtener los datos.
	 * @return Odontogram La misma instancia.
	 */
	public function select() 
	{
		// ES NECESARIO EL ID DEL ODOTOGRAMA
		if (empty($this->id) && !is_numeric($this->id)) {
			// throw new OdontogramException('OCURRIO UN ERROR AL CARGAR EL ODONTROGRAMA.');
		}
		// ARMO LA QUERY
		$q = "SELECT datos_json FROM odontogramas WHERE id_odontograma = {$this->id}";
		// TRAIGO LOS DATOS
		$_ = $this->db->oneFieldQuery($q);
		// LOS DATOS ESTAN EN UN JSON, HAGO UN DECODE Y LOS GUARDO
		$this->datos_json = (array) json_decode($_);
		
		return $this;
	}

	/**
	 * Actualiza el odontograma en la BD.
	 * 
	 * @throws OdontogramException No hay un id para obtener los datos.
	 * @throws OdontogramException El parametro data no es un array.
	 * @param Array $data Datos del odontograma-
	 */
	public function update($data) 
	{
		// ES NECESARIO EL id Y LA INFO
		if (empty($this->id) && !is_numeric($this->id)) {
			throw new OdontogramException('OCURRIO UN ERROR AL INTENTAR ACTUALIZAR EL ODONTROGRAMA.');
		}
		// LA INFO TIENE QUE ESTAR EN UN ARRAY
		if (!is_string($data)) {
			throw new OdontogramException('LOS DATOS DEL ODONTROGRAMA SON ERRONEOS.');
		}
		// ARMO LA QUERY
		$q = "UPDATE odontogramas SET datos_json = '{$data}' WHERE id_odontograma = '{$this->id}'";
		// ACTUALIZO EN BD
		$this->db->query($q);
		// ACTUALIZO LA INSTANCIA
		$this->select();
	}

	/**
	 * Obtener el fill de las piezas del odontrograma.
	 * 
	 * @param  Numeric $ppieza Id de la pieza que se quiere mostrar.
	 * @param  String  $aarea  Area de la pieza que se va a pintar.
	 * @return String          Fill de la pieza.
	 */
	public function piece($_pieza, $_aarea = null) 
	{
		// SI NO ES UN ID CORRECTO LE DOY VACIO
		if (!is_numeric($_pieza)) {
			return null;
		}

		// NOMBRE REAL DEL AREA
		$area = strtolower($_aarea . '');
		// OBTENGO LA PIEZA
		$pieza = isset($this->datos_json['P_' . $_pieza]) ? $this->datos_json['P_' . $_pieza] : false;
		// SEGUN QUE AREA DE LA PIEZA SE QUIERE RELLENAR
		if (preg_match('#a\d+#i', $area)){
			// ES DEL AREA PRINCIPAL DE LA PIEZA
			if(!empty($pieza->SUP) && is_array($pieza->SUP)){
				// ELL FILL DEL AREA PUEDE SER E11 O 3AF
				if (array_search($area . '_e11', $pieza->SUP) !== false) {
					return 'e11';
				}
				elseif (array_search($area . '_3af', $pieza->SUP) !== false) {
					return '3af';
				}
			}
			// SI NO SIEMPRE EL FILL ES BLANCO O VACIO
			return 'FFF';
		}
		elseif ($area == 'rh'){
			// SI EL AREA ES RH EL FILL ES UNA SIGLA
			return isset($pieza->RH) ? $pieza->RH : '...';
		}
		elseif ($area == 'svg') {
			// EL AREA PRINCIPAL DE UNA PIEZA SE PUEDE RELLENAR CON UN SVG TAMBIEN
			if (!empty($pieza->SUP) && is_string($pieza->SUP)) {
				// LA PARTE PRINCIPAL 
				return constant(strtoupper($pieza->SUP));
			}
			elseif(!empty($pieza->INF) && is_string($pieza->INF)){
				// O LA PARTE INFERIOR
				return constant(strtoupper($pieza->INF));
			}
		}
	}

	/**
	 * Obtengo el tratamiento del Odontograma.
	 *
	 * @throws OdontogramException No hay un id para obtener los datos
	 * @throws TreatmentException  Al momento de obtener el Tratamiento
	 * @throws PatientException    Al momento de obtener el Tratamiento
	 * @return Treatment Instancia del tratamiento asignado al odontograma
	 */
	public function get_treatment()
	{
		// ES NECESARIO EL ID DEL ODOTOGRAMA
		if (empty($this->id) && !is_numeric($this->id)) {
			throw new OdontogramException('OCURRIO UN ERROR AL CARGAR EL ODONTROGRAMA.');
		}
		// QUERY
		$q = "SELECT id_tratamiento AS id FROM tratamientos WHERE id_odontograma = {$this->id}";
		// OBTENGO EL ID DEL TRATAMIENTO
		$id_tratamiento = $this->db->oneFieldQuery($q);
		// RETORNO LA INSTANCIA
		return new Treatment($id_tratamiento);
	}

	/**
	 * Obtener la url segun el parametro que se mande.
	 * Si el parametro no es un string devuelve la url principal del odontograma del paciente.
	 *
	 * @throws OdontogramException Al momento de obtener el Tratamiento en get_treatment .
	 * @throws TreatmentException  Al momento de obtener el Tratamiento en get_treatment .
	 * @throws PatientException    Al momento de obtener el Tratamiento en get_treatment .
	 * @param  String $action SubPath de la url que se solicita
	 * @return String         Url absoluta
	 */
	public function url($action = null)
	{
		// OBTENGO EL TRATAMIENTO
		$Treatment = $this->get_treatment();
		// ARMO LA URL ENCODEADA CON LOS DATOS
		$url = crypt_params(array(ODONTOGRAMA => $this->id, TRATAMIENTO => $Treatment->id, PACIENTE => $Treatment->id_paciente));
		// SI HAY ACTION
		if (is_string($action)) {
			// REMUEVO LOS SLASHES SOBRANTES Y LA CONCATENO A LA URL 
			$url = trim($action, '/') . "/{$url}";
		}
		// ARMO LA URL FINAL
		return trim(URL_ROOT, '/') . "/odontograma/{$url}";
	}
}