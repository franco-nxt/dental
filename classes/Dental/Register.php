<?php 

class Register {

	public $id;
	public $fecha_hora;
	public $motivo;
	public $descripcion;
	public $Treatment;
	private static $RGX_BD = "#^(id_(registro|tratamiento)|fecha_hora|motivo|descripcion)$#";

	public function __get($name) {
		if ($name == 'db') {
			return MySQL::getInstance();
		}
		elseif ($name == 'fecha') {
			return date("d/m/y", strtotime($this->fecha_hora));
		}
		elseif ($name == 'hora') {
			return date("H:i", strtotime($this->fecha_hora));
		}
		elseif (isset($this->{$name})) {
			return $this->{$name};
		}

		return null;
	}

	public function __construct($id = null) {
		if (is_array($id)) {
			if (!$this->create($id)) {
				return false;
			}

			return $this->select();
		}
		elseif (is_numeric($id)) {

			$this->id = $id;

			// TRAIGO ALGUN CAMPO PARA VALIDAR
			return $this->select();
		}
		else {
			return false;
		}
	}

	/**
	 * Crea un registro en la BD
	 *
	 * @return void
	 */
	public function create($data)
	{
		if (!isset($data['id_tratamiento']) || !is_numeric($data['id_tratamiento'])) {
			return false;
		}

		// PRESETEO ALGUNOS CAMPOS
		$keys   = array();
		$values = array();

		// SI LA FECHA NO ES ENVIADA DENTRO DE LOS DATOS LA MARCO YO
		if (isset($data['fecha']) && isset($data['hora'])) {
			$date = self::format_date($data['fecha']);
			$data['fecha_hora'] = date('Y-m-d H:i:s', strtotime($date . ' ' . $data['hora']));
		}
		elseif (isset($data['fecha']) && !isset($data['hora'])) {
			$date = self::format_date($data['fecha']);
			$data['fecha_hora'] = date('Y-m-d H:i:s', strtotime($date));
		}
		elseif (isset($data['fecha_hora'])) {
			$date = self::format_date($data['fecha']);
			$data['fecha_hora'] = date('Y-m-d H:i:s', strtotime($date));
		}
		else {
			$data['fecha_hora'] = date('Y-m-d H:i:s');
		}

		foreach ($data as $k => $v) {
			if (preg_match(self::$RGX_BD, $k) && $v) {
				$value = utf8_decode($v);
				$keys[]   = $k;
				$values[] = $this->db->escape($value);
			}
		}

		$q = "INSERT INTO registros (" . implode(",", $keys) . ") VALUES ('" . implode("','", $values) . "')";

		$this->db->query($q);

		$this->id = $this->db->lastID();

		$this->db->free();

		return (Bool) $this->id;
	}

	public function select() 
	{
		if (!$this->id || !is_numeric($this->id)) {
			return false;
		}

		$q = "SELECT id_registro AS id, fecha_hora, motivo, descripcion, id_tratamiento FROM registros WHERE id_registro = {$this->id}";
		$_ = $this->db->oneRowQuery($q);

		if (!empty($_)) {
			foreach ($_ as $k => $v) {
				$this->{$k} = utf8_encode($v);
			}
		}

		return $this;
	}

	public function update($data = null) {
		if (!$this->id || !is_numeric($this->id)) {
			return false;
		}

		is_array($data) || $data = (array) $this;

		// SI LA FECHA NO ES ENVIADA DENTRO DE LOS DATOS LA MARCO YO
		if (isset($data['fecha']) && isset($data['hora'])) {
			$date = self::format_date($data['fecha']);
			$data['fecha_hora'] = date('Y-m-d H:i:s', strtotime($date . ' ' . $data['hora']));
		}
		elseif (isset($data['fecha']) && !isset($data['hora'])) {
			$date = self::format_date($data['fecha']);
			$data['fecha_hora'] = date('Y-m-d H:i:s', strtotime($date));
		}
		elseif (isset($data['fecha_hora'])) {
			$date = self::format_date($data['fecha_hora']);
			$data['fecha_hora'] = date('Y-m-d H:i:s', strtotime($date));
		}

		foreach ($data as $k => $v) {
			if (preg_match(self::$RGX_BD, $k)) {
				$value = utf8_decode($v);
				$this->{$k} = $this->db->escape($value);
			}
		}

		$q = "UPDATE registros SET fecha_hora = '{$this->fecha_hora}', motivo = '{$this->motivo}', descripcion = '{$this->descripcion}' WHERE id_registro = " . $this->id;
		$this->db->query($q);
		$this->db->free();

		return $this->select();
	}

	public function url($action = '') {
		if (!$this->id) {
			return false;
		}

		$url = crypt_params(array(REGISTRO => $this->id, TRATAMIENTO => $this->Treatment->id, PACIENTE => $this->Treatment->paciente->id));

		!preg_match('/(ve|edita)r/i', $action) || $url = URL_ROOT . '/registros/' . strtolower($action) . '/' . $url;

		return $url;
	}

	private static function format_date($date)
	{
		preg_match('#^(?<D>\d{1,2})[\/|-](?<M>[0-2]?[1-9]|3[0-2])[\/|-](?<Y>\d{1,4})$#', $date, $result); 

		if ($result) {
			return $result['Y'] . '-' . $result['M'] . '-' . $result['D'];
		}

		return false;
	}
}