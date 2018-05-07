<?php 

class Page extends Controller{

	public function __construct() {
		_global('navbar-title', 'PACIENTE');
		
		try{
			parent::__construct(
				array('tratamiento/[:encode]', 'main'),
				array('tratamiento/nuevo/[:encode]', 'nuevo'),
				array('tratamiento/editar/[:encode]', 'editar')
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
		catch (Exception $e) {
			add_error_flash('NO SE PUEDE PROCESAR LA ORDEN.');
			redirect_exit();
		}
	}

	public function main($encode) {
		$Patient = decode_patient($encode);
		include 'html/tratamiento/main.php';
	}

	public function editar($encode) 
	{
		// OBTENGO EL PACIENTE DESDE EL ID ENCODEADO
		$Patient = decode_patient($encode);
		// COMPRUEBO QUE EL USUARIO 
		if(!$Patient->check_user(get_user()->id)){
			add_error_flash('NO TIENE PERMISOS PARA EDITAR ESTE TRATAMIENTO.');
			redirect_exit($Patient->url());
		}
		// OBTENGO EL TRATAMIENTO
		$Treatment = $Patient->get_treatment(get_from_encode($encode, TRATAMIENTO));

		include 'html/tratamiento/editar.php';
	}

	public function nuevo($encode)
	{
		$Patient = decode_patient($encode);

		if(!$Patient->check_user($User->id)){
			add_error_flash('NO TIENE PERMISOS PARA CREAR UN TRATAMIENTO SOBRE ESTE PACIENTE.');
			redirect_exit($Patient->url());
		}

		include 'html/tratamiento/nuevo.php';
	}
}