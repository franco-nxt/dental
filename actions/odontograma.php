<?php 

class Page extends Controller{

	public function __construct() {
		parent::__construct(
			array('odontograma/editar/[:encode]', 'editar'));
	}

	public function editar($id)
	{
        $decrypt_params = decrypt_params($id);
        // SI NO ESTAN ESTOS DATOS NO AVANZA
        if (!isset($decrypt_params[PACIENTE], $decrypt_params[TRATAMIENTO])){
            add_error_flash("NO SE PUDO EDITAR EL TRATAMIENTO.");
            redirect_exit();
        }

        $Patient = get_patient($decrypt_params[PACIENTE]);
        $Treatment = $Patient->get_treatment($decrypt_params[TRATAMIENTO]);
        $Odontogram = $Treatment->get_odontogram();


		$datos_json = filter_input(INPUT_POST, 'json', FILTER_DEFAULT);
		
		if ($datos_json) {
			$Odontogram->datos_json = $datos_json;
			
			$Odontogram->update();
		}

		redirect_exit($Odontogram->url('ver'));
	}
}
