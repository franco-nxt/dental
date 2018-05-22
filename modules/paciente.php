<?php 
class Page extends Controller{

	public function __construct() 
	{
		_global('navbar-title', 'PACIENTE');

		try{
			parent::__construct(
				array('@paciente/([^(nuevo|buscar)]+)$', 'main'),
				array('paciente/nuevo', 'nuevo'),
				array('paciente/buscar', 'buscar'),
				array('paciente/compartido/[:encode]', 'compartido'),
				array('paciente/eliminar/[:encode]', 'eliminar'),
				array('paciente/editar/[:encode]', 'editar')
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

	public function main($encode) 
	{
		_global('navbar-back', URL_ROOT);
		// OBTENGO EL PACIENTE
        $Patient = decode_patient($encode)->select();
        // SACO LOS PARAMETROS ENCODEADO
		$decrypt_params = decrypt_params($encode);
		// SI VIENE UN ID DE TRATAMIENTO INSTANCIO SI NO INSTANCIO EL ULTIMO TRATAMIENTO
		$treatment_id = empty($decrypt_params[TRATAMIENTO]) ? null : $decrypt_params[TRATAMIENTO];
	
		$Treatment = $Patient->get_treatment($treatment_id)->select();

		if($Patient->check_user()){
			// SI EL USUARIO ES EL DUEÑO
			_global('edit-patient', $Patient->url('editar')); // <- GLOBAL PARA QUE EL BOTON DE EDITAR APAREZCA EN LA BARRA BLANCA de html/index.php
			
			include 'html/paciente/main.php';
		}
		else{
			// SECCIONES COMPARTIDAS DESDE OTRO USUARIO
			$allowed_sections = $Patient->get_allowed_sections();

			include 'html/paciente/shared.php';
		}
	}

	public function editar($encode) 
	{
		$User = get_user();
        $Patient = decode_patient($encode)->select();

		if(!$Patient->check_user($User->id)){
			add_error_flash('NO TIENE PERMISOS PARA EDITAR ESTE PACIENTE.');
			redirect_exit($Patient->url());
		}

		$Treatment = $Patient->get_treatment()->select();

		if (!$Patient->eliminado) {
			include 'html/paciente/editar.php';
		}
		else{
			include 'html/paciente/restaurar.php';
		}
	}

	public function nuevo() 
	{
		include 'html/paciente/nuevo.php';
	}

	public function buscar() 
	{
		$patients = get_user()->buscar($_GET);

		include 'html/paciente/buscar.php';
	}

	public function compartido($encode) 
	{
        $Patient = decode_patient($encode)->select();

		$shared = $Patient->get_shared_sections(get_from_encode($encode, COMPARTIR));
		
		include 'html/paciente/compartido.php';
	}

	public function eliminar($encode)
	{
        $Patient = decode_patient($encode)->select();

		if(!$Patient->check_user()){
			add_error_flash('NO TIENE PERMISOS PARA ELIMINAR ESTE PACIENTE.');
			redirect_exit($Patient->url());
		}

		$Treatment = $Patient->get_treatment()->select();
		
		include 'html/paciente/eliminar.php';
	}
}