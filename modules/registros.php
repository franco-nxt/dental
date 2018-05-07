<?php 

class Page extends Controller{

	public function __construct() {
		try{
			parent::__construct(
				array('registros/[:encode]', 'main'),
				array('registros/nuevo/[:encode]', 'nuevo'),
				array('registros/editar/[:encode]', 'editar'),
				array('registros/ver/[:encode]', 'ver')
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
		catch (RegisterException $e) {
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
		// VISTA
		include 'html/registros/main.php';
	}

	public function editar($encode)
	{
		// OBTENGO EL PACIENTE DESDE EL ID ENCODEADO
		$Patient = decode_patient($encode);
		// COMPRUEBO QUE EL USUARIO 
		$this->check_user($Patient);
		// OBTENGO EL TRATAMIENTO
		$Treatment = $Patient->get_treatment(get_from_encode($encode, TRATAMIENTO));
		// Y DEL TRATAMIENTO SACO EL REGISTRO DE VISITA
		$Register = $Treatment->get_register(get_from_encode($encode, REGISTRO));
		// VISTA
		include "html/registros/editar.php";
	}
	
	public function ver($encode)
	{
		// OBTENGO EL PACIENTE DESDE EL ID ENCODEADO
		$Patient = decode_patient($encode);
		// COMPRUEBO QUE EL USUARIO 
		$this->check_user($Patient);
		// OBTENGO EL TRATAMIENTO
		$Treatment = $Patient->get_treatment(get_from_encode($encode, TRATAMIENTO));
		// Y DEL TRATAMIENTO SACO EL REGISTRO DE VISITA
		$Register = $Treatment->get_register(get_from_encode($encode, REGISTRO));
		// VISTA
		include "html/registros/ver.php";
	}

	public function nuevo($encode)
	{
		// OBTENGO EL PACIENTE DESDE EL ID ENCODEADO
		$Patient = decode_patient($encode);
		// COMPRUEBO QUE EL USUARIO 
		$this->check_user($Patient);
		// OBTENGO EL TRATAMIENTO
		$Treatment = $Patient->get_treatment(get_from_encode($encode, TRATAMIENTO));
		// VISTA
		include 'html/registros/nuevo.php';
	}

	public function check_user($Patient)
	{
		// SI EL USUARIO NO LE PERTENECE
		if(!$Patient->check_user(get_user()->id)){
			// MENSAJE PARA EL FRONT
			add_error_flash('NO TIENE PERMISOS PARA OPERAR SOBRE LOS REGISTROS DE ESTE PACIENTE.');
			// REDIRIJO AL PERFIL DEL PACIENTE
			redirect_exit($Patient->url());
		}
	}
}