<?php 

class Page extends Controller{

	public function __construct() {
		_global('navbar-title', 'PACIENTE');

		parent::__construct(
			array('tratamiento/[:encode]', 'main'),
			array('tratamiento/nuevo/[:encode]', 'nuevo'),
			array('tratamiento/editar/[:encode]', 'editar'));
	}

	public function main($id) {
		$Patient = get_patient($id);
		include 'html/tratamiento/main.php';
	}

	public function editar($id) 
	{

		$decrypt_params = decrypt_params($id);
		// SI NO ESTAN ESTOS DATOS NO AVANZA
		if (!isset($decrypt_params[PACIENTE], $decrypt_params[TRATAMIENTO])){
			add_error_flash("NO SE PUDO EDITAR EL TRATAMIENTO.");
			redirect_exit();
		}

		if(!$Patient->check_user($User->id)){
			add_error_flash('NO TIENE PERMISOS PARA EDITAR EL TRATAMIENTO SOBRE ESTE PACIENTE.');
			redirect_exit($Patient->url());
		}

		$Patient = get_patient($decrypt_params[PACIENTE]);
		$Treatment = $Patient->get_treatment($decrypt_params[TRATAMIENTO]);

		include 'html/tratamiento/editar.php';
	}

	public function nuevo($id)
	{
		$decrypt_params = decrypt_params($id);
		// SI NO ESTAN ESTOS DATOS NO AVANZA
		if (!isset($decrypt_params[PACIENTE])){
			add_error_flash("NO SE ENCUENTRA EL TRATAMIENTO.");
			redirect_exit();
		}

		if(!$Patient->check_user($User->id)){
			add_error_flash('NO TIENE PERMISOS PARA CREAR UN TRATAMIENTO SOBRE ESTE PACIENTE.');
			redirect_exit($Patient->url());
		}

		$Patient = get_patient($decrypt_params[PACIENTE]);

		include 'html/tratamiento/nuevo.php';
	}
}