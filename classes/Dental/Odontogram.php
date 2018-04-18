<?php

class Odontogram {
	public function __get($name) {
		if ($name == 'db') {
			return MySQL::getInstance();
		}
		elseif (isset($this->{$name})) {
			return $this->{$name};
		}
		return null;
	}

	function __construct($id = null) 
	{
		if (!$id) {
			$id = $this->create();
		}

		$this->id = $id;
		
		return $this->select();
	}

	public function create()
	{
		$q = "INSERT INTO odontogramas (datos_json) VALUES ('{}')";
		
		$this->db->query($q);
		
		return $this->db->lastID();
	}

	public function select() {
		if (empty($this->id) && !is_numeric($this->id)) {
			return false;
		}

		$q = "SELECT datos_json FROM odontogramas WHERE id_odontograma = {$this->id}";

		$_ = $this->db->oneFieldQuery($q);
		
		$this->datos_json = (array) json_decode($_);
		
		return $this;
	}

	public function update($data = null) {
		// ES NECESARIO EL id Y LA INFO
		if (!$this->id) {
			return false;
		}

		$name = strtolower(get_class($this));

		if (!is_string($this->datos_json)) {
			$this->datos_json = json_encode($this->datos_json);
		}

		$q = "UPDATE odontogramas SET datos_json = '{$this->datos_json}' WHERE id_odontograma = '{$this->id}'";

		$this->db->query($q);
		
		$this->db->free();

		return $this->select();
	}

	/**
	 * Funcion para obtener el fil de las piezas del odontrograma.
	 * 
	 *
	 * @return void
	 * @author 
	 */
	public function piece($ppieza, $aarea = null) 
	{
		if (!is_numeric($ppieza)) {
			return null;
		}

		$area = strtolower($aarea . '');
		$pieza = isset($this->datos_json['P_' . $ppieza]) ? $this->datos_json['P_' . $ppieza] : false;

		if (preg_match('#a\d+#i', $area)){
			if($pieza && isset($pieza->SUP) && is_array($pieza->SUP)){
				if (array_search($area . '_e11', $pieza->SUP) !== false) {
					return 'e11';
				}
				elseif (array_search($area . '_3af', $pieza->SUP) !== false) {
					return '3af';
				}
			}
			return 'FFF';
		}
		elseif ($area == 'rh'){
			return isset($pieza->RH) ? $pieza->RH : '...';
		}
		elseif ($area == 'svg') {
			if (isset($pieza->SUP) && is_string($pieza->SUP)) {
				return constant(strtoupper($pieza->SUP));
			}
			elseif(isset($pieza->INF) && is_string($pieza->INF)){
				return constant(strtoupper($pieza->INF));
			}
		}
	}

	public function get_treatment()
	{
		$q = "SELECT id_tratamiento AS id FROM tratamientos WHERE id_odontograma = {$this->id}";
		
		$id_tratamiento = $this->db->oneFieldQuery($q);

		return new Treatment($id_tratamiento);
	}

	public function url($action = null)
	{
		$Treatment = $this->get_treatment();

		$url = crypt_params(array(ODONTOGRAMA => $this->id, TRATAMIENTO => $Treatment->id, PACIENTE => $Treatment->paciente->id));

		if ($action) {
			$url = trim($action, '/') . "/{$url}";
		}

		return trim(URL_ROOT, '/') . "/odontograma/{$url}";
	}
}



