<?php 

class Page extends Controller{

	public function __construct() 
	{
		$FormValidator = load_class('FormValidator');
		
		$FormValidator->add_rule("email", "REQ&email");
		$FormValidator->add_rule("password", "REQ&alpha");

		// VALIDO EL FORM
		if($FormValidator->validate()){
			// dump($FormValidator->input);
			$email = $FormValidator->input('email');
			$password = $FormValidator->input('password');

			try {
				$User = Dental::login($email, $password);

				if ($User->id) {
					load_class('Session')->__dental__ = json_encode($User);
					load_class('Session')->__destroy_at__ = time() + USER_TIMEOUT;
				}
				// MENSAJE PARA EL FRONT
				add_msg_flash("Bienvenido {$User->fullname}.");
			}
			catch (DentalException $e) {
				add_error_flash($e->getMessage(), true);
				redirect_exit("/login");
			}
		}
		else{
			add_error_flash(implode('<br/>', $FormValidator->errors));
		}
		redirect_exit();
	}
}