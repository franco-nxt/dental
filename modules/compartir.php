<?php

class Page extends Controller{

	public function __construct() {
		_global('navbar-title', 'COMPARTIR');
		_global('navbar-back', URL_ROOT);

		parent::__construct(
			array('compartir', 'main'),
			array('compartir/paciente/[:id]', 'paciente'),
			array('compartir/out/[:id]', 'out'),
			array('compartir/usuarios/[:id]', 'usuarios'),
			array('compartir/nuevo', 'nuevo'));
	}
	
	public function main() {

		$User = get_user();

		include 'html/compartir/main.php';
	}
	
	public function nuevo() {

		$User = get_user();

		include 'html/compartir/nuevo.php';
	}
	
	public function paciente($id) 
	{
		$decrypt_params = decrypt_params($id);

		// SI NO ESTAN ESTOS DATOS NO AVANZA
		if (!isset($decrypt_params[PACIENTE])){
			add_error_flash("NO SE ENCUENTRA AL PACIENTE INDICADO.");
			redirect_exit();
		}

		$Patient = get_patient($decrypt_params[PACIENTE]);
		$Treatment = $Patient->get_treatment();

		include 'html/compartir/paciente.php';
	}

	public function usuarios($id)
	{
		$decrypt_params = decrypt_params($id);
		$User = get_user();
		$Patient = get_patient($decrypt_params[PACIENTE]);

		$available_users = $User->get_available_users($Patient);

		include 'html/compartir/usuarios.php';
	}

	public function out($encode)
	{
		$decrypt_params = decrypt_params($encode);

        if (empty($decrypt_params[VINCULO]) ||empty($decrypt_params[PACIENTE])) {
			add_error_flash("NO SE ENCUENTRA AL PACIENTE O EL USUARIO INDICADO.");
        }
        else{
			$User = get_user();
			$Patient = get_patient($decrypt_params[PACIENTE]);

			$User->share_patient($Patient, $decrypt_params[VINCULO], $_GET);
        }


        $this->main();
	}
}