<?php

class Page extends Controller{

	public function __construct() {
		_global('navbar-title', 'COMPARTIR');
		_global('navbar-back', URL_ROOT);

		parent::__construct(
			array('compartir', 'main'),
			array('compartir/paciente/[:encode]', 'paciente'),
			array('compartir/out/[:encode]', 'out'),
			array('compartir/usuarios/[:encode]', 'usuarios'),
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
	
	public function paciente($encode) 
	{
		// OBTENGO EL PACIENTE DESDE EL ID ENCODEADO
		$Patient = decode_patient($encode);
		// DEL PACIENTE OBTENGO EL TRATAMIENTO
		$Treatment = $Patient->get_treatment();
		// HTML
		include 'html/compartir/paciente.php';
	}

	public function usuarios($encode)
	{
		// USUARIO
		$User = get_user();
		// OBTENGO EL PACIENTE DESDE EL ID ENCODEADO
		$Patient = decode_patient($encode);
		// USAURIOS DISPONIBLES CON QUIEN COMPARTIR EL PACIENTE
		$available_users = $User->get_available_users($Patient);
		// HTML
		include 'html/compartir/usuarios.php';
	}

	public function out($encode)
	{
		// USUARIO
		$User = get_user();
		// OBTENGO EL PACIENTE DESDE EL ID ENCODEADO
		$Patient = decode_patient($encode);
		// ACCESOS QUE SE LE VAN A PERMITIR AL USUARIO
		$access = empty($_GET['access']) || !is_array($_GET['access'])? null : $_GET['access'];
		// VINCULO ENTRE USUARIOS
		$link = get_from_encode($encode, VINCULO);
		// COMPARTO AL PACIENTE 
		$User->share_patient($Patient, $link, $access);
		// VUELVO A LA VISTA PRINCIPAÑ
        $this->main();
	}
}