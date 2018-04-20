<?php 

class Page extends Controller{

	public function __construct() 
	{
		_global('navbar-title', 'PACIENTE');

		parent::__construct(
			array('@paciente/([^(nuevo|buscar)]+)$', 'main'),
			array('paciente/nuevo', 'nuevo'),
			array('paciente/buscar', 'buscar'),
			array('paciente/compartido/[:encode]', 'compartido'),
			array('paciente/eliminar/[:encode]', 'eliminar'),
			array('paciente/editar/[:encode]', 'editar'));
	}

	public function main($encode) 
	{
		$decrypt_params = decrypt_params($encode);

        $Patient = decode_patient($encode);

        if (empty($decrypt_params[TRATAMIENTO])) {
			$Treatment = $Patient->get_treatment();
        }
        else{
			$Treatment = $Patient->get_treatment($decrypt_params[TRATAMIENTO]);
        }
		// SI EL USUARIO ES EL DUEÑO
		if($Patient->check_user()){
			_global('edit-patient', $Patient->url('editar')); // <- GLOBAL PARA QUE EL BOTON DE EDITAR APAREZCA EN LA BARRA BLANCA de html/index.php
			include 'html/paciente/main.php';
		}
		else{
			include 'html/paciente/shared.php';
		}
	}

	public function editar($encode) 
	{
		$User = get_user();
        $Patient = decode_patient($encode);


		if(!$Patient->check_user($User->id)){
			add_error_flash('NO TIENE PERMISOS PARA EDITAR ESTE PACIENTE.');
			redirect_exit($Patient->url());
		}

		if (!$Patient->eliminado) {
			include 'html/paciente/editar.php';
		}
		else{
			include 'html/paciente/restaurar.php';
		}
	}

	public function nuevo() 
	{
		include 'html/paciente/nuevo.php';
	}

	public function buscar() 
	{
		$patients = get_user()->buscar($_GET);

		include 'html/paciente/buscar.php';
	}

	public function compartido($encode) 
	{
        $Patient = decode_patient($encode);

		$shared = $Patient->get_shared(get_from_encode($encode, COMPARTIR));
		
		include 'html/paciente/compartido.php';
	}

	public function eliminar($encode)
	{
        $Patient = decode_patient($encode);

		if(!$Patient->check_user()){
			add_error_flash('NO TIENE PERMISOS PARA ELIMINAR ESTE PACIENTE.');
			redirect_exit($Patient->url());
		}

		include 'html/paciente/eliminar.php';
	}
}