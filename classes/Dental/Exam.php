<?php 

/**
 * summary
 */
class Exam
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
		
		$q = "INSERT INTO examen () VALUES ()";

		$this->db->query($q);

		$this->id = $this->db->lastID();
	}
	
	public function select() {
		if (!$this->id || !is_numeric($this->id)) {
			return false;
		}

		$q = "SELECT agenesias, atm, clinicas_observaciones, curva_spee, deglucion, denticion, diastemas_inferiores, diastemas_superiores, estructuras_faciales, fisura_paladar, intraoral_observaciones, labios_reposo, linea_media_inferior, linea_media_superior, longitud_arco_mandibulal, longitud_arco_maxilar, mordida_cruzada, paladar, perfil, rco_dentaria, resalte, respiracion, sobremordida, supernumerarios, surco_mentolabial, tamano_dientes FROM examen WHERE id_examen = {$this->id}";
		$_ = $this->db->oneRowQuery($q);

		foreach ($_ as $k => $v) {
			$json = json_decode(utf8_encode($v));

			$this->{$k} = $json ? $json : utf8_encode($v);
		}

		return $this;
	}


	public function update($data) 
	{
		$q = array();

		foreach ((array) $data as $k => $v) {

			switch ($k) {
				case "estructuras_faciales":
				case "perfil":
				case "labios_reposo":
				case "respiracion":
				case "deglucion":
				case "surco_mentolabial":
				case "denticion":
				case "resalte":
				case "mordida_cruzada":
				case "longitud_arco_maxilar":
				case "curva_spee":
				case "paladar":
				case "linea_media_superior":
				case "linea_media_inferior":
				case "rco_dentaria":
				case "fisura_paladar":
				case "diastemas_superiores":
				case "diastemas_inferiores":
				case "atm":
				case "tamano_dientes":
				case "supernumerarios":
				case "agenesias":
					$json_encode = json_encode($v, JSON_UNESCAPED_UNICODE);
					$q[] = "{$k} = '{$json_encode}'";
				break;
				case "clinicas_observaciones":
				case "intraoral_observaciones":
					$q[] = "{$k} = '{$v}'";
					break;
				default: continue; break;
			}
		}

		$fields = implode(', ', $q);

		$q = utf8_decode("UPDATE examen SET {$fields} WHERE id_examen = {$this->id}");

		$this->db->query($q);

		$this->db->free();

		return $this->select();
	}

	public function get_treatment()
	{
		if (empty($this->id_tratamiento)) {
			$q = "SELECT id_tratamiento AS id FROM tratamientos WHERE id_examen = {$this->id}";
			$this->id_tratamiento = $this->db->oneFieldQuery($q);
		}

		return new Treatment($this->id_tratamiento);
	}

	public function url($action = '') 
	{
		if (!$this->id) {
			return false;
		}

		$Treatment = $this->get_treatment();

		$url = crypt_params(array(TRATAMIENTO => $Treatment->id, PACIENTE => $Treatment->get_patient()->id));
		!empty($action) && $action = "{$action}/";
		$url = trim(URL_ROOT, '/') . "/diagnostico/examen/{$action}{$url}";

		return $url;
	}
}