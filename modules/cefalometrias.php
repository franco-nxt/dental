<?php

class Page extends Controller{

	public function __construct() {
		_global('navbar-title', 'CEFALOMETR&Iacute;AS');
		_global('navbar-back', URL_ROOT);

		parent::__construct(
			array('cefalometrias/[:encode]', 'main'),
			array('cefalometrias/nueva/[:encode]', 'nueva'),
			array('cefalometrias/ver/[:encode]', 'ver'),
			array('cefalometrias/editar/[:encode]', 'editar'),
			array('cefalometrias/modelos/[:encode]', 'modelos'));
	}
	
	public function main($id) {
		$Patient = get_patient($id);
		
		include 'html/cefalometrias/main.php';
	}

	public function nueva($id) {
		$decrypt_params = decrypt_params($id);
		$Patient = get_patient($decrypt_params);
		
		$this->check_user($Patient);

		$model = $decrypt_params[MODELO];
		
		include 'html/cefalometrias/nueva.php';
	}

	public function modelos($id) {
		$Patient = get_patient($id);
		
		$this->check_user($Patient);

		
		include 'html/cefalometrias/modelos.php';
	}

	public function ver($id) 
	{
		$decrypt_params = decrypt_params($id);
		$Patient = get_patient($decrypt_params[PACIENTE]);
		$Treatment = $Patient->treatment($decrypt_params[TRATAMIENTO]);
		$Cephalometry = $Treatment->get_cephalometry($decrypt_params[CEFALOMETRIA]);
		
		include 'html/cefalometrias/ver.php';
	}

	public function editar($id) 
	{
		$decrypt_params = decrypt_params($id);
		$Patient = get_patient($decrypt_params[PACIENTE]);
		
		$this->check_user($Patient);

		$Treatment = $Patient->treatment($decrypt_params[TRATAMIENTO]);
		$Cephalometry = $Treatment->get_cephalometry($decrypt_params[CEFALOMETRIA]);
		
		include 'html/cefalometrias/editar.php';
	}

	public function check_user($Patient)
	{
		if(!$Patient->check_user(get_user()->id)){
			add_error_flash('NO TIENE PERMISOS PARA OPERAR SOBRE LOS CEFALOMETRIAS DE ESTE PACIENTE.');
			redirect_exit($Patient->url('cefalometrias'));
		}
	}
}