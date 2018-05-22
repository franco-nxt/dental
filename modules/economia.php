<?php 

class Page extends Controller{

	public function __construct() {
		_global('navbar-title', 'PACIENTE');

		try{
			parent::__construct(
				array('economia/[:encode]', 'main'),
				array('economia/nuevo/[:encode]', 'nuevo'),
				array('economia/ver/[:encode]', 'ver')
			);
		} 
		catch (PatientException $e) {
			add_error_flash($e->getMessage());
			redirect_exit();
		}
		catch (TreatmentException $e) {
			add_error_flash($e->getMessage());
			redirect_exit();
		}
		catch (PaymentException $e) {
			add_error_flash($e->getMessage());
			redirect_exit();
		}
		catch (Exception $e) {
			add_error_flash('NO SE PUEDE PROCESAR LA ORDEN.');
			redirect_exit();
		}
	}

	public function main($encode) 
	{
		// OBTENGO EL PACIENTE DESDE EL ID ENCODEADO
		$Patient = decode_patient($encode);
		// COMPRUEBO QUE EL USUARIO 
		$this->check_user($Patient);
		// OBTENGO EL TRATAMIENTO
		$Treatment = $Patient->get_treatment()->select();
		_global('navbar-back', $Patient->url());
		// HTML
		include 'html/economia/main.php';
	}

	public function ver($encode) 
	{
		// OBTENGO EL PACIENTE DESDE EL ID ENCODEADO
		$Patient = decode_patient($encode);
		// COMPRUEBO QUE EL USUARIO 
		$this->check_user($Patient);
		// OBTENGO EL TRATAMIENTO
		$Treatment = $Patient->get_treatment(get_from_encode($encode, TRATAMIENTO));
		// OBTENGO EL PAGO
		$Payment = $Treatment->get_payment(get_from_encode($encode, PAGO));
		_global('navbar-back', $Patient->url('economia'));
		// HTML
		include 'html/economia/ver.php';
	}

	public function nuevo($encode)
	{
		// OBTENGO EL PACIENTE DESDE EL ID ENCODEADO
		$Patient = decode_patient($encode);
		// COMPRUEBO QUE EL USUARIO 
		$this->check_user($Patient);
		// OBTENGO EL TRATAMIENTO
		$Treatment = $Patient->get_treatment()->select();
		_global('navbar-back', $Patient->url('economia'));
		// HTML
		include 'html/economia/nuevo.php';
	}

	public function check_user(&$Patient)
	{
		// SI EL USUARIO NO LE PERTENECE
		if(!$Patient->check_user(get_user()->id)){
			// MENSAJE PARA EL FRONT
			add_error_flash('NO TIENE PERMISOS PARA OPERAR SOBRE LOS PAGOS DE ESTE PACIENTE.');
			// REDIRIJO AL PERFIL DEL PACIENTE
			redirect_exit($Patient->url());
		}
	}
}