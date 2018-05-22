<?php 
class Page extends Controller{

	public function __construct() 
	{
		_global('navbar-title', 'USUARIOS');

		try{
			parent::__construct(
				array('manager', 'main'),
				array('manager/contrataciones/nuevo', 'contrataciones'),
				array('manager/[:encode]', 'user')
			);
		}
		catch (DentalException $e) {
			add_error_flash($e->getMessage());
			redirect_exit();
		}
		catch (AdminException $e) {
			add_error_flash($e->getMessage());
			redirect_exit();
		}
		catch (Exception $e) {
			add_error_flash($e->getMessage());
			redirect_exit();
		}
	}

	public function main() 
	{
		_global('navbar-back', URL_ROOT);

		$Admin = get_Admin();
		$all_users = $Admin->get_axis_users();

		include 'html/manager/main.php';
	}

	public function user($encode) 
	{
		_global('navbar-back', URL_ROOT . '/manager');

		$Admin = get_Admin();

		$user = $Admin->get_axis_user(get_from_encode($encode, USUARIO));
		
		$debits = $Admin->get_user_debits($user->id);
		
		include 'html/manager/user.php';
	}

	public function contrataciones() 
	{
		$Admin = get_Admin();

		include 'html/manager/nuevo.php';
	}
}