<?php 

class Page extends Controller{

	public function __construct() {
		try{
			parent::__construct(
				array('economia/nuevo/[:encode]', 'nuevo'),
				array('economia/ver/[:encode]', 'ver')
			);
		} 
		catch (PatientException $e) {
			add_error_flash($e->getMessage());
		}
		catch (TreatmentException $e) {
			add_error_flash($e->getMessage());
		}
		catch (PaymentException $e) {
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
		// OBTENGO EL PACIENTE DESDE EL ID ENCODEADO
		$Patient = decode_patient($encode);

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
			dump($Treatment);
			$Payment = $Treatment->create_payment($FormValidator->input);
			// add_msg_flash("PAGO REGISTRADO.");
			// redirect_exit($Payment->url());
		}
	}

	public function ver($encode)
	{
		// OBTENGO EL PACIENTE DESDE EL ID ENCODEADO
		$Patient = decode_patient($encode);
		// OBTENGO EL TRATAMIENTO
		$Treatment = $Patient->get_treatment(get_from_encode($encode, TRATAMIENTO));
		// OBTENGO EL PAGO
		$Payment = $Treatment->get_payment(get_from_encode($encode, PAGO));
		// LA UNICA ACCION POR LA QUE LLEGO ACA ES PARA ELIMINARLO
		$Payment->delete();
		// AHORA HAY QUE HACER UNA BALANCE
		$Treatment->balancear();
		// MENSJAE PARA EL FORNT
		add_msg_flash("PAGO ELIMINADO.");
		// REDIRIJO
		redirect_exit($Patient->url('economia'));
	}
}
