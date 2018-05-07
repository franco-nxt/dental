<?php
class Page extends Controller {

	function __construct() {
		try{
			parent::__construct(
				array('compartir/editar/[:encode]', 'editar'),
				array('compartir/[:encode]', 'eliminar')
			);
		} 
		catch (PatientException $e) {
			add_error_flash($e->getMessage());
		}
		catch (TreatmentException $e) {
			add_error_flash($e->getMessage());
		}
		catch (DentalException $e) {
			add_error_flash($e->getMessage());
		}
		catch (Exception $e) {
			add_error_flash('NO SE PUEDE PROCESAR LA ORDEN.');
		}
		finally{
			redirect_exit();
		}
	}

	public function eliminar($id) 
	{
		$decrypt_params = decrypt_params($id);
		$User = get_user();

		if (!empty($decrypt_params[COMPARTIR])) {
			$User->stop_share_patient($decrypt_params[COMPARTIR]) && add_msg_flash('SE DEJO DE COMPARTIR EL PACIENTE.');
		}
		else{
			add_error_flash('NO SE ENCUENTRA EL PACIENTE SOLICITADO.');
		}

		redirect_exit('/compartir');
	}

	public function editar($id) 
	{
		$decrypt_params = decrypt_params($id);

		$User = get_user();
		
		$Patient = get_patient($decrypt_params[PACIENTE]);
		
		$User->edit_share_patient($decrypt_params[COMPARTIR], $_POST);

		add_msg_flash('SE EDITARON LOS PERMISOS, CON EXITO.');
		
		redirect_exit("/paciente/compartido/{$id}");
	}
}