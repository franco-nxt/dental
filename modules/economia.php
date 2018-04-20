<?php 

class Page extends Controller{

	public function __construct() {
		_global('navbar-title', 'PACIENTE');

		parent::__construct(
			array('economia/[:encode]', 'main'),
			array('economia/nuevo/[:encode]', 'nuevo'),
			array('economia/ver/[:encode]', 'ver'));
	}

	public function main($id) 
	{
		$decrypt_params = decrypt_params($id);
		// SI NO ESTAN ESTOS DATOS NO AVANZA
		if (!isset($decrypt_params[PACIENTE])){
			add_error_flash("NO SE ENCUENTRA LA SECCI&Oacute;N ECONOMIA PARA EL PACIENTE.");
			redirect_exit();
		}

		$Patient = get_patient($decrypt_params[PACIENTE]);
		
		$this->check_user($Patient);

		$Treatment = $Patient->get_treatment();

		include 'html/economia/main.php';
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
		
		$this->check_user($Patient);

		$Treatment = $Patient->get_treatment($decrypt_params[TRATAMIENTO]);
		$Payment = $Treatment->get_payment($decrypt_params[PAGO]);
		
		include 'html/economia/ver.php';
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
		
		$this->check_user($Patient);

		$Treatment = $Patient->get_treatment();
		
		include 'html/economia/nuevo.php';
	}

	public function check_user($Patient)
	{
		if(!$Patient->check_user(get_user()->id)){
			add_error_flash('NO TIENE PERMISOS PARA OPERAR SOBRE LOS PAGOS DE ESTE PACIENTE.');
			redirect_exit($Patient->url());
		}
	}
}