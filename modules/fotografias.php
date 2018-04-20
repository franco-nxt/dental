<?php

class Page extends Controller{

	public function __construct() {
		// EL TITULO DE LA PAGINA
		_global('navbar-title', 'FOTOGRAF&Iacute;AS');

		try {
			parent::__construct(
				array('fotografias/[:encode]', 'main'),
				array('fotografias/nueva/[:encode]', 'nueva'),
				array('fotografias/ver/[:encode]', 'ver'),
				array('fotografias/editar/[:encode]', 'editar'),
				array('fotografias/modelos/[:encode]', 'modelos')
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
		catch (PhotoException $e) {
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
		// LA VISTA
		include 'html/fotografias/main.php';
	}

	public function nueva($encode) {
		// OBTENGO EL PACIENTE DESDE EL ID ENCODEADO
		$Patient = decode_patient($encode);
		// COMPRUEBO QUE EL USUARIO 
		$this->check_user($Patient);
		// SACO EL NUMERO DE MODELO EN EL ENCODE
		$model = get_from_encode($encode, MODELO);
		// LA VISTA
		include 'html/fotografias/nueva.php';
	}

	public function modelos($encode) {
		// OBTENGO EL PACIENTE DESDE EL ID ENCODEADO
		$Patient = decode_patient($encode);
		// COMPRUEBO QUE EL USUARIO 
		$this->check_user($Patient);
		// INCLUDE VISTA
		include 'html/fotografias/modelos.php';
	}

	public function ver($encode) {
		// OBTENGO EL PACIENTE DESDE EL ID ENCODEADO
		$Patient = decode_patient($encode);
		// COMPRUEBO QUE EL USUARIO 
		$this->check_user($Patient);
		// OBTENGO EL TRATAMIENTO
		$Treatment = $Patient->treatment(get_from_encode($encode, TRATAMIENTO));
		// OBTENGO LA SESSION DE FOTOS
		$Photo = $Treatment->get_photo(get_from_encode($encode, FOTOGRAFIA));
		// LA VISTA
		include 'html/fotografias/ver.php';
	}

	public function editar($id) {
		// OBTENGO EL PACIENTE DESDE EL ID ENCODEADO
		$Patient = decode_patient($encode);
		// COMPRUEBO QUE EL USUARIO 
		$this->check_user($Patient);
		// OBTENGO EL TRATAMIENTO
		$Treatment = $Patient->treatment(get_from_encode($encode, TRATAMIENTO));
		// OBTENGO LA SESSION DE FOTOS
		$Photo = $Treatment->get_photo(get_from_encode($encode, FOTOGRAFIA));
		// LA VISTA
		include 'html/fotografias/editar.php';
	}

	public function check_user($Patient)
	{
		// SI EL USUARIO NO LE PERTENECE
		if(!$Patient->check_user(get_user()->id)){
			// MENSAJE PARA EL FRONT
			add_error_flash('NO TIENE PERMISOS PARA OPERAR SOBRE LOS FOTOGRAFIAS DE ESTE PACIENTE.');
			// REDIRIJO AL PERFIL DEL PACIENTE
			redirect_exit($Patient->url());
		}
	}
}