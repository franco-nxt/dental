<?php 

/**
 * summary
 */
class History
{
	/**
	 * @var Int
	 */
	public $id;

	/**
	 * @var Int
	 */
	public $id_tratamiento;
	
	public function __get($name) {
		if ($name == 'db') {
			return MySQL::getInstance();
		}
		
		return null;
	}


	public function __construct($id = null)
	{
		if ($id) {
			$this->id = $id;
		}
		else{
			$this->create();
		}
	}

	public function create()
	{
		
		$q = "INSERT INTO historia () VALUES ()";

		$this->db->query($q);

		$this->id = $this->db->lastID();
	}

	public function select() {
		if (!$this->id || !is_numeric($this->id)) {
			return false;
		}

		$q = "SELECT motivo, tratamiento_medico, enfermedad_sistemica, medicacion_actual, hepatitis, hiv, medicos_observaciones, higene_bucal, ortopedia, ortodoncia, ginjivitis, periodontitis, xerostomia, placa_dormir, ronca_dormir, resfrio_frecuente, respira_boca, dificultad_masticar, dificultad_tragar, fonoaudiologico, pubertad, dolor_articular, ruido_articular, traumatismo_boca_menton, interposicion_labio_inferior, succion_digital, bruxismo, odontologicos_observaciones FROM historia WHERE id_historia = {$this->id}";
		
		$_ = $this->db->oneRowQuery($q);

		foreach ($_ as $k => $v) {
			$json = json_decode($v);

			$this->{$k} = $json ? $json : utf8_encode($v);
		}

		return $this;
	}

    public function update() {
		if (!$this->id || !is_numeric($this->id)) {
			return false;
		}

        $q = array();

        foreach ((array) $this as $key => $value) {
            if (!$this->valid_field($key)) continue;

            is_array($value) && $value = json_encode($value, JSON_UNESCAPED_UNICODE);
            
            $q[] = "{$key} = '{$value}'";
        }
        
        $q = utf8_decode("UPDATE historia SET " . implode(', ', $q) . " WHERE id_historia = " . $this->id);

        $this->db->query($q);

        $this->db->free();

        return $this->select();
    }

	public function url($action = '') {
		if (!$this->id) {
			return false;
		}

		$Treatment = $this->get_treatment();

		$url = crypt_params(array(TRATAMIENTO => $Treatment->id, PACIENTE => $Treatment->get_patient()->id));
		!empty($action) && $action = "{$action}/";
		$url = trim(URL_ROOT, '/') . "/diagnostico/historia/{$action}{$url}";

		return $url;
	}

	public function get_treatment()
	{
		if (empty($this->id_tratamiento)) {
			$q = "SELECT id_tratamiento AS id FROM tratamientos WHERE id_historia = {$this->id}";
			$this->id_tratamiento = $this->db->oneFieldQuery($q);
		}

		return new Treatment($this->id_tratamiento);
	}

	public function valid_field($name)
	{
		return (Bool) preg_match('/^(bruxismo|dificultad_(masticar|tragar)|fonoaudiologico|hiv|interposicion_labio_inferior|motivo|orto(pedia|doncia)|pubertad|res(pira_boca|frio_frecuente)|tra(umatismo_boca_menton|tamiento_medico)|xerostomia|enfermedad_sistemica|(succion_digit|medicacion_actu|higene_buc)al|(dolor|ruido)_articular|(hepat|ginjiv|periodont)itis|(placa|ronca)_dormir|(odontologicos|medicos)_observaciones)$/i', $name);
	}

}