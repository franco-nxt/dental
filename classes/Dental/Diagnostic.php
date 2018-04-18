<?php 

class Diagnostic
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
		
		$q = "INSERT INTO diagnosticos () VALUES ()";

		$this->db->query($q);

		$this->id = $this->db->lastID();
	}

	public function select() {
		if (!$this->id || !is_numeric($this->id)) {
			return false;
		}

		$q = "SELECT panoramica, ricketts, fotografias, trx_perfil, jarabak, vto_crecimiento, trx_frontal, steiner, vto_tratamiento, seriada, powell, otros, patron, esq_clase, esq_pos_vertical, clase_molar_der, clase_molar_izq, pos_molar_sup, pos_incisivo_inf, pos_incisivo_sup, incl_incisivo_inf, incl_incisivo_sup, overjet, overbite, angulo_interincisivo, protusion_labial, observaciones FROM diagnosticos WHERE id_diagnostico = {$this->id}";
		$_ = $this->db->oneRowQuery($q);

		foreach ($_ as $k => $v) {
			$json = json_decode(utf8_encode($v));

			$this->{$k} = $json ? $json : utf8_encode($v);
		}

		return $this;
	}

    public function update($data) {
		if (!$this->id || !is_numeric($this->id)) {
			return false;
		}

        $q = array();

        foreach ((array) $data as $key => $value) {
            if (!$this->valid_field($key)) continue;

            is_array($value) && $value = json_encode($value, JSON_UNESCAPED_UNICODE);

            $q[] = "{$key} = '{$value}'";
        }

        $fields = implode(', ', $q);

        $q = utf8_decode("UPDATE diagnosticos SET {$fields} WHERE id_diagnostico = {$this->id}");

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

		$url = trim(URL_ROOT, '/') . "/diagnostico/completo/{$action}{$url}";

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
		return (Bool) preg_match('/^(angulo_interincisivo|clase_molar_(der|izq)|esq_(clase|pos_vertical)|fotografias|incl_incisivo_(inf|sup)|jarabak|o(tros|ver(bite|jet)|bservaciones)|p(os_(incisivo|molar)_(inf|sup)|anoramica|atron|owell|rotusion_labial)|ricketts|s(eriada|teiner)|tr(x_(fronta|perfi)l|atamiento)|vto_(creci|trata)miento)$/i', $name);
	}
}