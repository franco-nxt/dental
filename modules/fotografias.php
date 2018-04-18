<?php

class Page extends Controller{

	public function __construct() {
		_global('navbar-title', 'FOTOGRAF&Iacute;AS');
		_global('navbar-back', URL_ROOT);

		parent::__construct(
			array('fotografias/[:id]', 'main'),
			array('fotografias/nueva/[:id]', 'nueva'),
			array('fotografias/ver/[:id]', 'ver'),
			array('fotografias/editar/[:id]', 'editar'),
			array('fotografias/modelos/[:id]', 'modelos'));
	}
	
	public function main($id) {
		$Patient = get_patient($id);
		
		include 'html/fotografias/main.php';
	}

	public function nueva($id) {
		$decrypt_params = decrypt_params($id);
		$Paciente = get_patient($decrypt_params);
		
		$this->check_user($Paciente);

		$model = $decrypt_params[MODELO];
		
		include 'html/fotografias/nueva.php';
	}

	public function modelos($id) {
		$Paciente = get_patient($id);
		
		
		$this->check_user($Paciente);

		include 'html/fotografias/modelos.php';
	}

	public function ver($id) {
		$decrypt_params = decrypt_params($id);
		$Patient = get_patient($decrypt_params[PACIENTE]);
		$Treatment = $Patient->treatment($decrypt_params[TRATAMIENTO]);
		$Photo = $Treatment->get_photo($decrypt_params[FOTOGRAFIA]);

		include 'html/fotografias/ver.php';
	}

	public function editar($id) {
		$decrypt_params = decrypt_params($id);
		$Patient = get_patient($decrypt_params[PACIENTE]);
		
		$this->check_user($Patient);

		$Treatment = $Patient->treatment($decrypt_params[TRATAMIENTO]);
		$Photo = $Treatment->get_photo($decrypt_params[FOTOGRAFIA]);

		include 'html/fotografias/editar.php';
	}

	public function check_user($Patient)
	{
		if(!$Patient->check_user(get_user()->id)){
			add_error_flash('NO TIENE PERMISOS PARA OPERAR SOBRE LOS FOTOGRAFIAS DE ESTE PACIENTE.');
			redirect_exit($Patient->url('fotografias'));
		}
	}
}