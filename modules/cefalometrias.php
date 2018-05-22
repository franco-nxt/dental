<?php

class Page extends Controller{

	public function __construct() {
		_global('navbar-title', 'CEFALOMETR&Iacute;AS');

		try{
			parent::__construct(
				array('cefalometrias/[:encode]', 'main'),
				array('cefalometrias/nueva/[:encode]', 'nueva'),
				array('cefalometrias/ver/[:encode]', 'ver'),
				array('cefalometrias/editar/[:encode]', 'editar'),
				array('cefalometrias/modelos/[:encode]', 'modelos')
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
		catch (CephalometryException $e) {
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
		$Treatment = $Patient->get_treatment();
		$cephalometries = $Treatment->get_cephalometries();
		$old_treatments = $Patient->old_treatments();

		_global('navbar-back', $Patient->url());
		// LA VISTA
		include 'html/cefalometrias/main.php';
	}

	public function nueva($encode) 
	{
		// OBTENGO EL PACIENTE DESDE EL ID ENCODEADO
		$Patient = decode_patient($encode);
		// COMPRUEBO QUE EL USUARIO 
		$this->check_user($Patient);
		// SACO EL NUMERO DE MODELO EN EL ENCODE
		$model = get_from_encode($encode, MODELO);

		_global('navbar-back', $Patient->url('cefalometrias'));
		// LA VISTA
		include 'html/cefalometrias/nueva.php';
	}

	public function modelos($encode) 
	{
		// OBTENGO EL PACIENTE DESDE EL ID ENCODEADO
		$Patient = decode_patient($encode);
		// COMPRUEBO QUE EL USUARIO 
		$this->check_user($Patient);
		
		_global('navbar-back', $Patient->url('cefalometrias'));
		// INCLUDE VISTA		
		include 'html/cefalometrias/modelos.php';
	}

	public function ver($encode) 
	{
		// OBTENGO EL PACIENTE DESDE EL ID ENCODEADO
		$Patient = decode_patient($encode);
		// OBTENGO EL TRATAMIENTO
		$Treatment = $Patient->get_treatment(get_from_encode($encode, TRATAMIENTO));
		// OBTENGO LA SESSION DE FOTOS
		$Cephalometry = $Treatment->get_cephalometry(get_from_encode($encode, CEFALOMETRIA))->select();
		
		_global('navbar-back', $Patient->url('cefalometrias'));
		// LA VISTA
		include 'html/cefalometrias/ver.php';
	}

	public function editar($encode) 
	{
		// OBTENGO EL PACIENTE DESDE EL ID ENCODEADO
		$Patient = decode_patient($encode);
		// COMPRUEBO QUE EL USUARIO 
		$this->check_user($Patient);
		// OBTENGO EL TRATAMIENTO
		$Treatment = $Patient->get_treatment(get_from_encode($encode, TRATAMIENTO));
		// OBTENGO LA SESSION DE FOTOS
		$Cephalometry = $Treatment->get_cephalometry(get_from_encode($encode, CEFALOMETRIA));

		_global('navbar-back', $Patient->url('cefalometrias'));
		// LA VISTA
		include 'html/cefalometrias/editar.php';
	}

	public function check_user($Patient)
	{
		// SI EL USUARIO NO LE PERTENECE
		if(!$Patient->check_user(get_user()->id)){
			// MENSAJE PARA EL FRONT
			add_error_flash('NO TIENE PERMISOS PARA OPERAR SOBRE LOS CEFALOMETRIAS DE ESTE PACIENTE.');
			// REDIRIJO AL PERFIL DEL PACIENTE
			redirect_exit($Patient->url('cefalometrias'));
		}
	}
}