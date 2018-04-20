<?php
class Page extends Controller {

	function __construct() {
		parent::__construct(
			array('compartir/editar/[:encode]', 'editar'),
			array('compartir/[:encode]', 'eliminar'));
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

		dump($decrypt_params);

		// $User = get_user();

		// if (!empty($decrypt_params[COMPARTIR])) {
		// 	$User->edit_share_patient($_POST) && add_msg_flash('SE CAMBIARON LAS SECCIONES COMPARTIDAS DEL PACIENTE.');
		// }
		// else{
		// 	add_error_flash('NO SE ENCUENTRA EL PACIENTE SOLICITADO.');
		// }

		// redirect_exit('/compartir');

   //      if (empty($decrypt_params[VINCULO]) ||empty($decrypt_params[PACIENTE])) {
			// add_error_flash("NO SE ENCUENTRA AL PACIENTE O EL USUARIO INDICADO.");
   //      }
   //      else{

        // }
		$User = get_user();
		$Patient = get_patient($decrypt_params[PACIENTE]);
		
		$User->edit_share_patient($decrypt_params[COMPARTIR], $_POST);

		redirect_exit("/paciente/compartido/{$id}");

	}
}