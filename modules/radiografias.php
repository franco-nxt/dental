<?php

class Page extends Controller{

	public function __construct() {
		_global('navbar-title', 'RADIOGRAF&Iacute;AS');
		_global('navbar-back', URL_ROOT);

		parent::__construct(
			array('radiografias/[:id]', 'main'),
			array('radiografias/nueva/[:id]', 'nueva'),
			array('radiografias/editar/[:id]', 'editar'),
			array('radiografias/ver/[:id]', 'ver'),
			array('radiografias/modelos/[:id]', 'modelos'));
	}
	
	public function main($id) 
	{
		$Patient = get_patient($id);
		
		include 'html/radiografias/main.php';
	}

	public function nueva($id) 
	{
		$decrypt_params = decrypt_params($id);
		$Paciente = get_patient($decrypt_params);
		
		$this->check_user($Paciente);

		$model = $decrypt_params[MODELO];
		
		include 'html/radiografias/nueva.php';
	}

	public function modelos($id) 
	{
		$Patient = get_patient($id);
		
		$this->check_user($Patient);
		
		include 'html/radiografias/modelos.php';
	}

	public function ver($id) 
	{
		$decrypt_params = decrypt_params($id);
		$Patient = get_patient($decrypt_params[PACIENTE]);
		$Treatment = $Patient->treatment($decrypt_params[TRATAMIENTO]);
		$Radiographie = $Treatment->get_radiographie($decrypt_params[RADIOGRAFIA]);
		
		include 'html/radiografias/ver.php';
	}

	public function editar($id) {
		$decrypt_params = decrypt_params($id);
		$Patient = get_patient($decrypt_params[PACIENTE]);
		
		$this->check_user($Patient);

		$Treatment = $Patient->treatment($decrypt_params[TRATAMIENTO]);
		$Radiographie = $Treatment->get_radiographie($decrypt_params[RADIOGRAFIA]);

		include 'html/radiografias/editar.php';
	}

	public function check_user($Patient)
	{
		if(!$Patient->check_user(get_user()->id)){
			add_error_flash('NO TIENE PERMISOS PARA OPERAR SOBRE LOS RADIOGRAFIAS DE ESTE PACIENTE.');
			redirect_exit($Patient->url('radiografias'));
		}
	}
}