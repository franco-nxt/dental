<?php 

/**
 * summary
 */
class Resume
{

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
		
		$q = "INSERT INTO resumen () VALUES ()";

		$this->db->query($q);

		$this->id = $this->db->lastID();
	}

	public function select() 
	{
		if (!$this->id || !is_numeric($this->id)) {
			return false;
		}

		$q = "SELECT interceptivo_correctivo, esqueletal_dentario, extracciones, anclaje_sup, anclaje_inf, pronostico, observaciones, objetivo_etapas FROM resumen WHERE id_resumen = {$this->id}";
		$_ = $this->db->oneRowQuery($q);

		foreach ($_ as $k => $v) {
			$json = json_decode(utf8_encode($v));

			$this->{$k} = $json ? $json : utf8_encode($v);
		}

		return $this;
	}

	public function update($data) 
	{
		if (!$this->id || !is_numeric($this->id)) {
			return false;
		}

		$q = array();

		foreach ((array) $data as $key => $value) {
			if (!$this->valid_field($key)) continue;

			is_array($value) && $value = json_encode($value, JSON_UNESCAPED_UNICODE);

			$q[] = "{$key} = '{$value}'";
		}

		// dump($q);
		$fields = implode(', ', $q);

		$q = utf8_decode("UPDATE resumen SET {$fields} WHERE id_resumen = {$this->id}");

		$this->db->query($q);

		$this->db->free();

		return $this->select();
	}

	public function url($action = '') 
	{
		if (!$this->id) {
			return false;
		}

		$Treatment = $this->get_treatment();

		$url = crypt_params(array(TRATAMIENTO => $Treatment->id, PACIENTE => $Treatment->get_patient()->id));
		
		!empty($action) && $action = "{$action}/";

		$url = trim(URL_ROOT, '/') . "/diagnostico/resumen/{$action}{$url}";

		return $url;
	}

	public function get_treatment()
	{
		if (empty($this->id_tratamiento)) {
			$q = "SELECT id_tratamiento AS id FROM tratamientos WHERE id_resumen = {$this->id}";
			$this->id_tratamiento = $this->db->oneFieldQuery($q);
		}

		return new Treatment($this->id_tratamiento);
	}

	public function valid_field($name)
	{
		return (Bool) preg_match('/^(anclaje_(inf|sup)|dentario|e(squeletal_dentario|xtracciones)|interceptivo_correctivo|ob(jetivo_etapa|servacione)s|pronostico|tratamiento)$/i', $name);
	}
}