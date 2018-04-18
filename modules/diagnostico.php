<?php

class Page extends Controller{

	public function __construct() {
		_global('navbar-title', 'DIAGNOSTICO');
		_global('navbar-back', URL_ROOT);

		parent::__construct(
			array('diagnostico/[:id]', 'main'),
			array('diagnostico/[a:vista]/[:id]', 'vista'),
			array('diagnostico/[a:vista]/editar/[:id]', 'editar')
		);
	}
	
	public function main($id) {
		$Patient = get_patient($id);

		include 'html/diagnostico/main.php';
	}

	public function vista($vista, $id) 
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

		include "html/" . $vista . "/main.php";
	}

	public function editar($vista, $id) 
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

		include "html/" . $vista . "/editar.php";
	}

	public function check_user($Patient)
	{
		if(!$Patient->check_user(get_user()->id)){
			add_error_flash('NO TIENE PERMISOS PARA OPERAR SOBRE LOS DIAGNOSTICOS DE ESTE PACIENTE.');
			redirect_exit($Patient->url());
		}
	}
}