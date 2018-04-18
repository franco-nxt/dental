<?php 

class Page extends Controller{

	public function __construct() {
		_global('navbar-title', 'REGISTROS');

		parent::__construct(
			array('registros/[:id]', 'main'),
			array('registros/nuevo/[:id]', 'nuevo'),
			array('registros/editar/[:id]', 'editar'),
			array('registros/ver/[:id]', 'ver'));

	}

	public function main($id)
	{
		$Patient = get_patient($id);

		$this->check_user($Patient);

		include 'html/registros/main.php';
	}

	public function editar($id)
	{
		$decrypt_params = decrypt_params($id);
		$Patient = get_patient($decrypt_params);
		$Treatment = $Patient->treatment($decrypt_params[TRATAMIENTO]);
		$Register = $Treatment->get_register($decrypt_params[REGISTRO]);

		include "html/registros/editar.php";
	}
	
	public function ver($id)
	{
		$decrypt_params = decrypt_params($id);
		$Patient = get_patient($decrypt_params);
		
		$this->check_user($Patient);

		$Treatment = $Patient->treatment($decrypt_params[TRATAMIENTO]);
		$Register = $Treatment->get_register($decrypt_params[REGISTRO]);


		include "html/registros/ver.php";
	}

	public function nuevo($id)
	{
		$decrypt_params = decrypt_params($id);
		$Patient = get_patient($decrypt_params);

		$this->check_user($Patient);

		$Treatment = $Patient->treatment($decrypt_params[TRATAMIENTO]);

		include 'html/registros/nuevo.php';
	}

	public function check_user($Patient)
	{
		if(!$Patient->check_user(get_user()->id)){
			add_error_flash('NO TIENE PERMISOS PARA OPERAR SOBRE LOS REGISTROS DE ESTE PACIENTE.');
			redirect_exit($Patient->url());
		}
	}
}