<?php

class Page extends Controller{

	public function __construct() {
		_global('navbar-title', 'ODONTOGRAMA');
		_global('navbar-back', URL_ROOT);
		try{
			parent::__construct(
				array('odontograma/[:encode]', 'main'),
				array('odontograma/ver/[:encode]', 'vista'),
				array('odontograma/editar/[:encode]', 'editar')
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
		catch (OdontogramException $e) {
			add_error_flash($e->getMessage());
			redirect_exit();
		}
		catch (Exception $e) {
			add_error_flash('NO SE PUEDE PROCESAR LA ORDEN.');
			redirect_exit();
		}
	}
	
	public function main($encode) {
		// OBTENGO EL PACIENTE DESDE EL ID ENCODEADO
		$Patient = decode_patient($encode);
		// COMPRUEBO QUE EL USUARIO 
		$this->check_user($Patient);
		// SACO EL TRATAMIENTO
		$Treatment = $Patient->get_treatment();
		// TRATAMIENTOS ANTERIORES
		$old_treatments = (Array) $Patient->old_treatments();
		_global('navbar-back', $Patient->url());
		// VISTA		
		include 'html/odontograma/main.php';
	}

	public function vista($encode) 
	{
		// OBTENGO EL PACIENTE DESDE EL ID ENCODEADO
		$Patient = decode_patient($encode);
		// SI NO ESTAN ESTOS DATOS NO AVANZA		
		$this->check_user($Patient);
		// TRATAMIENTO 
		$Treatment = $Patient->get_treatment(get_from_encode($encode, TRATAMIENTO));
		// // ODONTOGRAMA
		$Odontogram = $Treatment->get_odontogram();

		_global('navbar-back', $Patient->url());
		// // VISTA
		include "html/odontograma/ver.php";
	}

	public function editar($encode) 
	{
		// OBTENGO EL PACIENTE DESDE EL ID ENCODEADO
		$Patient = decode_patient($encode);
		// SI NO ESTAN ESTOS DATOS NO AVANZA
		$this->check_user($Patient);
		// TRATAMIENTO 
		$Treatment = $Patient->get_treatment(get_from_encode($encode, TRATAMIENTO));
		// ODONTOGRAMA
		$Odontogram = $Treatment->get_odontogram();
		
		_global('navbar-back', $Odontogram->url());
		// VISTA
		include "html/odontograma/editar.php";
	}

	public function check_user($Patient)
	{
		if(!$Patient->check_user()){
			// EL USUARIO NO TIENE PERMISOS
			add_error_flash('NO TIENE PERMISOS PARA OPERAR SOBRE EL ODONTOGRAMA DE ESTE PACIENTE.');
			// LO MANDO AL PERFIL DEL PACIENTE
			redirect_exit($Patient->url());
		}
	}
}