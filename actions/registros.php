<?php 

class Page extends Controller{

	public function __construct() {
		try {
			parent::__construct(
				array('registros/nuevo/[:encode]', 'nuevo'),
				array('registros/editar/[:encode]', 'editar')
			);
		}
		catch (PatientException $e) {
			add_error_flash($e->getMessage());
		}
		catch (TreatmentException $e) {
			add_error_flash($e->getMessage());
		}
		catch (RegisterException $e) {
			add_error_flash($e->getMessage());
		}
		catch (Exception $e) {
			add_error_flash('NO SE PUEDE PROCESAR LA ORDEN.');
		}
		finally{
			redirect_exit();
		}
	}

	public function nuevo($encode)
	{
		$Patient = decode_patient($encode);
		$Treatment = $Patient->get_treatment(get_from_encode($encode, TRATAMIENTO));
		
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

	public function editar($encode)
	{
		$Patient = decode_patient($encode);
		$Treatment = $Patient->get_treatment(get_from_encode($encode, TRATAMIENTO));
		$Register = $Treatment->get_register(get_from_encode($encode, REGISTRO));
	
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

	private function validate_form(){

		$FormValidator = load_class('FormValidator');
		
		$FormValidator->add_rule("fecha", "REQ&rgx=#^\d{1,2}[\/|-][02]?[1-9]|3[0-2][\/|-]\d{1,4}$#");
		$FormValidator->add_rule("motivo", "REQ");
		// $FormValidator->add_rule("etapa", "REQ&rgx=#^\d{1,2}\:\d{1,2}#");

		return $FormValidator;
	}
}