<?php
class Page extends Controller {

	function __construct() {
		_global('navbar-title', 'PERFIL');
		_global('navbar-back', URL_ROOT);

		try{
			parent::__construct(
				array('perfil', 'main'),
				array('perfil/editar', 'editar'),
				array('perfil/usuarios', 'usuarios'),
				array('perfil/compartir', 'compartir'),
				array('perfil/id', 'generate_id')
			);
		} 
		catch (DentalException $e) {
			add_error_flash($e->getMessage());
			redirect_exit();
		}
		catch (Exception $e) {
			add_error_flash('NO SE PUEDE PROCESAR LA ORDEN.');
			redirect_exit();
		}
	}


	public function main() 
	{
		$User = get_user()->select();
		$available_users = $User->get_available_users();

		include 'html/perfil/ver.php';
	}

	public function editar() 
	{
		$User = get_user()->select();
		_global('navbar-back', URL_ROOT ."/perfil");

		include 'html/perfil/editar.php';
	}

	public function compartir() 
	{
		_global('navbar-back', URL_ROOT ."/perfil");
		$User = get_user();

		include 'html/perfil/compartir.php';
	}

	public function generate_id()
	{
		_global('navbar-back', URL_ROOT ."/perfil");
		$User = get_user();

		$uniqid = $User->generate_share_id();

		include 'html/perfil/id.php';
	}
}