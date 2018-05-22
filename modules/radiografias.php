<?php

class Page extends Controller{

	public function __construct() {
		// TITULO DE LA PAGINA
		_global('navbar-title', 'RADIOGRAF&Iacute;AS');

		try{
			parent::__construct(
				array('radiografias/[:encode]', 'main'),
				array('radiografias/nueva/[:encode]', 'nueva'),
				array('radiografias/editar/[:encode]', 'editar'),
				array('radiografias/ver/[:encode]', 'ver'),
				array('radiografias/modelos/[:encode]', 'modelos')
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
		catch (RadiographieException $e) {
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
		// LA VISTA
		_global('navbar-back', $Patient->url());
		include 'html/radiografias/main.php';
	}

	public function nueva($encode) 
	{
		// OBTENGO EL PACIENTE DESDE EL ID ENCODEADO
		$Patient = decode_patient($encode);
		// COMPRUEBO QUE EL USUARIO 
		$this->check_user($Patient);
		// SACO EL NUMERO DE MODELO EN EL ENCODE
		$model = get_from_encode($encode, MODELO);

		_global('navbar-back', $Patient->url('radiografias'));
		// LA VISTA
		include 'html/radiografias/nueva.php';
	}

	public function modelos($encode) 
	{
		// OBTENGO EL PACIENTE DESDE EL ID ENCODEADO
		$Patient = decode_patient($encode);
		// COMPRUEBO QUE EL USUARIO 
		$this->check_user($Patient);

		_global('navbar-back', $Patient->url('radiografias'));
		// INCLUDE VISTA
		include 'html/radiografias/modelos.php';
	}

	public function ver($encode) 
	{
		// OBTENGO EL PACIENTE DESDE EL ID ENCODEADO
		$Patient = decode_patient($encode);
		// COMPRUEBO QUE EL USUARIO 
		$this->check_user($Patient);
		// OBTENGO EL TRATAMIENTO
		$Treatment = $Patient->get_treatment(get_from_encode($encode, TRATAMIENTO));
		// OBTENGO LA SESSION DE RADIOGRAFIAS
		$Radiographie = $Treatment->get_radiographie(get_from_encode($encode, RADIOGRAFIA));

		_global('navbar-back', $Patient->url('radiografias'));
		// LA VISTA
		include 'html/radiografias/ver.php';
	}

	public function editar($encode) 
	{
		// OBTENGO EL PACIENTE DESDE EL ID ENCODEADO
		$Patient = decode_patient($encode);
		// COMPRUEBO QUE EL USUARIO 
		$this->check_user($Patient);
		// OBTENGO EL TRATAMIENTO
		$Treatment = $Patient->get_treatment(get_from_encode($encode, TRATAMIENTO));
		// OBTENGO LA SESSION DE RADIOGRAFIAS
		$Radiographie = $Treatment->get_radiographie(get_from_encode($encode, RADIOGRAFIA));
		
		_global('navbar-back', $Radiographie->url());
		// LA VISTA
		include 'html/radiografias/editar.php';
	}

	public function check_user($Patient)
	{
		// SI EL USUARIO NO LE PERTENECE
		if(!$Patient->check_user(get_user()->id)){
			// MENSAJE PARA EL FRONT
			add_error_flash('NO TIENE PERMISOS PARA OPERAR SOBRE LOS RADIOGRAFIAS DE ESTE PACIENTE.');
			redirect_exit($Patient->url());
		}
	}
}