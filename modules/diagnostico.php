<?php

class Page extends Controller{

	public function __construct() {
		_global('navbar-title', 'DIAGNOSTICO');

		try{
			parent::__construct(
				array('diagnostico/[:encode]', 'main'),
				array('diagnostico/[a:vista]/[:encode]', 'vista'),
				array('diagnostico/[a:vista]/editar/[:encode]', 'editar')
			);
		} 
		catch (PatientException $e) {
			add_error_flash($e->getMessage());
		}
		catch (TreatmentException $e) {
			add_error_flash($e->getMessage());
		}
		catch (DiagnosticException $e) {
			add_error_flash($e->getMessage());
		}
		catch (Exception $e) {
			add_error_flash('NO SE PUEDE PROCESAR LA ORDEN.');
		}
		finally{
			redirect_exit();
		}
	}
	
	public function main($encode)
	{
		// OBTENGO EL PACIENTE DESDE EL ID ENCODEADO
		$Patient = decode_patient($encode);
		// TRAIGO EL ULTIMO TRATAMIENTO CON LA DESCRIPCION DEL MISMO
		$Treatment = $Patient->get_treatment()->select('descripcion');
		// TRAIGO LOS TRATAMIENTOS ANTERIORES
		$treatments = (Array) $Patient->old_treatments();
		// LA VISTA
		include 'html/diagnostico/main.php';
	}

	public function vista($vista, $encode) 
	{
		// OBTENGO EL PACIENTE DESDE EL ID ENCODEADO
		$Patient = decode_patient($encode);
		// COMPRUEBO QUE EL USUARIO 
		$this->check_user($Patient);
		// OBTENGO EL TRATAMIENTO
		$Treatment = $Patient->get_treatment(get_from_encode($encode, TRATAMIENTO));

		switch ($vista) {
			case 'historia':
				$History = $Treatment->get_history()->select();
				break;
			case 'resumen':
				$Resume = $Treatment->get_resume()->select();
				break;
			case 'examen':
				$Exam = $Treatment->get_exam()->select();
				break;
			case 'completo':
				$Diagnostic = $Treatment->get_fullDiagnostic()->select();
				break;
		}
		// CARGO LA VISTA PEDIDA
		include "html/" . $vista . "/main.php";
	}

	public function editar($vista, $encode) 
	{
		// OBTENGO EL PACIENTE DESDE EL ID ENCODEADO
		$Patient = decode_patient($encode);
		// COMPRUEBO QUE EL USUARIO 
		$this->check_user($Patient);
		// OBTENGO EL TRATAMIENTO
		$Treatment = $Patient->get_treatment(get_from_encode($encode, TRATAMIENTO));
		// VALIDO SI EL TRATAMIENTO ES EL ULTIMO
		if ($Patient->get_treatment()->id !== $Treatment->id) {
			throw new DiagnosticException("NO SE PUEDE EDITAR UN TRATAMIENTO ANTERIOR.");
		}

		switch ($vista) {
			case 'historia':
				$History = $Treatment->get_history()->select();
				break;
			case 'resumen':
				$Resume = $Treatment->get_resume()->select();
				break;
			case 'examen':
				$Exam = $Treatment->get_exam()->select();
				break;
			case 'completo':
				$Diagnostic = $Treatment->get_fullDiagnostic()->select();
				break;
		}
		// CARGO LA VISTA PEDIDA
		include "html/" . $vista . "/editar.php";
	}

	public function check_user(&$Patient)
	{
		// SI EL USUARIO NO LE PERTENECE
		if(!$Patient->check_user(get_user()->id)){
			// MENSAJE PARA EL FRONT
			add_error_flash('NO TIENE PERMISOS PARA OPERAR SOBRE LOS DIAGNOSTICOS DE ESTE PACIENTE.');
			// REDIRIJO AL PERFIL DEL PACIENTE
			redirect_exit($Patient->url());
		}
	}
}