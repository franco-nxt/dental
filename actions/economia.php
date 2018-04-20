<?php 

class Page extends Controller{

	public function __construct() {
		parent::__construct(
			array('economia/nuevo/[:encode]', 'nuevo'),
			array('economia/ver/[:encode]', 'ver'));
	}

	public function nuevo($id)
	{
		$decrypt_params = decrypt_params($id);
		// SI NO ESTAN ESTOS DATOS NO AVANZA
		if (!isset($decrypt_params[PACIENTE])){
			add_error_flash("NO SE ENCUENTRA LA SECCI&Oacute;N ECONOMIA PARA EL PACIENTE.");
			redirect_exit();
		}
		$Patient = get_patient($decrypt_params[PACIENTE]);

        $FormValidator = load_class('FormValidator');
        
        $FormValidator->add_rule("monto", "REQ&greaterthan=0");
        $FormValidator->add_rule("motivo", "alnum_s&maxlen=200");
        $FormValidator->add_rule("anotaciones", "alnum_s&maxlen=200");

        // VALIDO EL FORM
        if(!$FormValidator->validate()){
			add_error_flash(implode("<br/>", $FormValidator->errors));
			redirect_exit($Patient->url('economia'));
        }
        else{
			$Treatment = $Patient->get_treatment();
			$Payment = $Treatment->create_payment($FormValidator->input);
			add_msg_flash("PAGO REGISTRADO.");
			redirect_exit($Payment->url());
        }
	}

	public function ver($id)
	{
		
		$decrypt_params = decrypt_params($id);
		// SI NO ESTAN ESTOS DATOS NO AVANZA
		if (!isset($decrypt_params[PACIENTE], $decrypt_params[TRATAMIENTO], $decrypt_params[PAGO])){
			add_error_flash("NO SE ENCUENTRA LA SECCI&Oacute;N ECONOMIA PARA EL PACIENTE.");
			redirect_exit();
		}

		$Patient = get_patient($decrypt_params[PACIENTE]);
		$Treatment = $Patient->get_treatment($decrypt_params[TRATAMIENTO]);
		$Payment = $Treatment->get_payment($decrypt_params[PAGO]);

		$Payment->delete();
		$Treatment->balancear();

		add_msg_flash("PAGO ELIMINADO.");
		redirect_exit($Patient->url('economia'));
	}
}
