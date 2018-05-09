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
			redirect_exit(URL_ROOT . "/manager");
		}
		catch (AdminException $e) {
			add_error_flash($e->getMessage());
			redirect_exit(URL_ROOT . "/manager");
		}
		catch (Exception $e) {
			add_error_flash("OCURRIO UN ERROR VUELVA A INTENRARLO");
			redirect_exit();
		}
	}

	public function main() 
	{
	}

	public function user($encode) 
	{
		$Admin = get_Admin();

		$user = $Admin->get_axis_user(get_from_encode($encode, USUARIO));
		
		include 'html/manager/user.php';
	}
	public function contrataciones() 
	{
		$Admin = get_Admin();

		$FormValidator = load_class('FormValidator');
		// AGREGO LAS VALIDACIONES
		foreach(array("dni","telefono","celular","direccion","provincia","ciudad") as $key) {
			// CAMPOS REQUERIDOS ALFANUMERICOS QUE PUEDEN LLEVAR ESPACIOS
			$FormValidator->add_rule($key, "REQ&alnum_s");
		}
		
		foreach (array('apellido', 'nombre', 'pais') as $key) {
			// CAMPOS REQUERIDOS QUE SOLO PUEDEN LLEVAR LETRAS Y ESPACIOS
			$FormValidator->add_rule($key, "REQ&alpha_s");
		}
		// ESTAS REGLAS VAN A PARTE PORQUE LLEVAN EL NOMBRE DEL CAMPO PARA EL MSG DE ERROR
		$FormValidator->add_rule("tarjeta_num", "REQ&alnum_s", NULL, "numero de tarjeta");
		$FormValidator->add_rule("codigo_postal", "REQ&alnum_s", NULL, "codigo postal");
		$FormValidator->add_rule("correo_electronico", "REQ&email", NULL, "correo electronico");
		// VALIDO EL FORMULARIO
		if($FormValidator->validate()){
			$form_data = $FormValidator->input();

			$Admin->create_user($form_data);

			add_msg_flash("USUARIO CREADO CON EXITO.");
			redirect_exit(URL_ROOT . "/manager");
		}
		else{
			if (array_key_exists('req' , $FormValidator->violations)) {
				add_error_flash('DEBE COMPLETAR TODOS LOS CAMPOS.');
			}
			else{
				add_error_flash(implode("<br>", $FormValidator->errors));
			}
			
			redirect_exit(URL_ROOT . "/manager/contrataciones/nuevo");
		}
	}
}