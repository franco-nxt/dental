<?php 

class Page extends Controller{

	public function __construct() {
		parent::__construct(
			array('registros/nuevo/[:encode]', 'nuevo'),
			array('registros/editar/[:encode]', 'editar'));
	}

	public function nuevo($id)
	{
		$decrypt_params = decrypt_params($id);
		// SI NO ESTAN ESTOS DATOS NO AVANZA
		if (isset($decrypt_params[PACIENTE], $decrypt_params[TRATAMIENTO])){
			$Patient = get_patient($decrypt_params[PACIENTE]);
			$Treatment = $Patient->get_treatment($decrypt_params[TRATAMIENTO]);
	
			$FormValidator = $this->validate_form();

			if($FormValidator->validate()){
				$Register = $Treatment->create_register($FormValidator->input);

				// MENSAJE PARA EL FRONT
				add_msg_flash('REGISTRO CREADO CON EXITO.');
				redirect_exit($Register->url('ver'));
			}
			else{
				$error = implode('<br/>', $FormValidator->errors);
				add_error_flash($error);
				redirect_exit(URL_ROOT . "/registros/nuevo/" . $Treatment->url);
			}
		}
		else{
			dump($decrypt_params);
			// add_msg_flash("NO SE PUEDE PROCESAR LA ORDEN.");
			// redirect_exit();
		}
	}

	public function editar($id)
	{
		$decrypt_params = decrypt_params($id);
		// SI NO ESTAN ESTOS DATOS NO AVANZA
		if (isset($decrypt_params[PACIENTE], $decrypt_params[TRATAMIENTO], $decrypt_params[REGISTRO])){
			$Patient = get_patient($decrypt_params[PACIENTE]);
			$Treatment = $Patient->get_treatment($decrypt_params[TRATAMIENTO]);
			$Register = $Treatment->get_register($decrypt_params[REGISTRO]);
	
			$FormValidator = $this->validate_form();

			if($FormValidator->validate()){

				$Register->update($FormValidator->input);

				// MENSAJE PARA EL FRONT
				add_msg_flash('SE GUARDARON LOS CAMBIOS CON EXITO.');
				redirect_exit($Register->url('ver'));
			}
			else{
				$error = implode('<br/>', $FormValidator->errors);
				add_error_flash($error);
				redirect_exit($Register->url('editar'));
			}
		}
		else{
			add_msg_flash("NO SE PUEDE PROCESAR LA ORDEN.");
			redirect_exit();
		}
	}

	private function validate_form(){

		$FormValidator = load_class('FormValidator');
		
		$FormValidator->add_rule("fecha", "REQ&rgx=#^\d{1,2}[\/|-][02]?[1-9]|3[0-2][\/|-]\d{1,4}$#");
		// $FormValidator->add_rule("etapa", "REQ&rgx=#^\d{1,2}\:\d{1,2}#");

		return $FormValidator;
	}
}