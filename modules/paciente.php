<?php 

class Page extends Controller{

	public function __construct() 
	{
		_global('navbar-title', 'PACIENTE');

		parent::__construct(
			array('@paciente/([^(nuevo|buscar)]+)$', 'main'),
			array('paciente/nuevo', 'nuevo'),
			array('paciente/buscar', 'buscar'),
			array('paciente/compartido/[:id]', 'compartido'),
			array('paciente/eliminar/[:id]', 'delete'),
			array('paciente/editar/[:id]', 'editar'));
	}

	public function main($id) 
	{
		$User = get_user();
		$Patient = get_patient($id);

		if($Patient->check_user($User->id)){
			// SI EL USUARIO ES EL DUEÑO
			_global('edit-patient', $Patient->url('editar')); // GLOBAL PARA QUE EL BOTON DE EDITAR APAREZCA EN LA BARRA BLANCA de html/index.php
			include 'html/paciente/main.php';
		}
		else{
			include 'html/paciente/shared.php';
		}
	}

	public function editar($id) 
	{
		$User = get_user();
		$Patient = get_patient($id);

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
		$Patient = new Patient;

		include 'html/paciente/nuevo.php';
	}

	public function buscar() 
	{
		$patients = get_user()->buscar($_GET);

		include 'html/paciente/buscar.php';
	}

	public function compartido($id) 
	{
		$decrypt_params = decrypt_params($id);
		$Patient = get_patient($id);


		$shared = $Patient->get_shared($decrypt_params[COMPARTIR]);
		
		include 'html/paciente/compartido.php';
	}

	public function delete($id)
	{
		$User = get_user();
		$Patient = get_patient($id);

		if(!$Patient->check_user($User->id)){
			add_error_flash('NO TIENE PERMISOS PARA ELIMINAR ESTE PACIENTE.');
			redirect_exit($Patient->url());
		}

		include 'html/paciente/eliminar.php';
	}
}