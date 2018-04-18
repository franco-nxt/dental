<?php

class Page extends Controller{

	public function __construct() {
		_global('navbar-title', 'ODONTOGRAMA');
		_global('navbar-back', URL_ROOT);

		parent::__construct(
			array('odontograma/[:id]', 'main'),
			array('odontograma/ver/[:id]', 'vista'),
			array('odontograma/editar/[:id]', 'editar')
		);
	}
	
	public function main($id) {
		$Patient = get_patient($id);
		// $Treatment = $Patient->get_treatment();
		
		$this->check_user($Patient);


		include 'html/odontograma/main.php';
	}

	public function vista($id) 
	{
		$decrypt_params = decrypt_params($id);

		// SI NO ESTAN ESTOS DATOS NO AVANZA
		if (!isset($decrypt_params[PACIENTE], $decrypt_params[TRATAMIENTO])){
			add_error_flash("NO SE ENCUENTRA AL PACIENTE INDICADO.");
			redirect_exit();
		}

		$Patient = get_patient($decrypt_params[PACIENTE]);
		
		$this->check_user($Patient);

		$Treatment = $Patient->get_treatment($decrypt_params[TRATAMIENTO]);
		$Odontogram = $Treatment->get_odontogram();

		include "html/odontograma/ver.php";
	}

	public function editar($id) 
	{
		$decrypt_params = decrypt_params($id);

		// SI NO ESTAN ESTOS DATOS NO AVANZA
		if (!isset($decrypt_params[PACIENTE])){
			add_error_flash("NO SE ENCUENTRA AL PACIENTE INDICADO.");
			redirect_exit();
		}

		$Patient = get_patient($decrypt_params[PACIENTE]);
		
		$this->check_user($Patient);

		$Treatment = $Patient->get_treatment($decrypt_params[TRATAMIENTO]);
		$Odontogram = $Treatment->get_odontogram();

		include "html/odontograma/editar.php";
	}

	public function check_user($Patient)
	{
		if(!$Patient->check_user(get_user()->id)){
			add_error_flash('NO TIENE PERMISOS PARA OPERAR SOBRE EL ODONTOGRAMA DE ESTE PACIENTE.');
			redirect_exit($Patient->url());
		}
	}
}