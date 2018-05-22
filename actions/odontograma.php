<?php 

class Page extends Controller{

	public function __construct() {
		try {
			parent::__construct(
				array('odontograma/editar/[:encode]', 'editar')
			);
		}
		catch (PatientException $e) {
			add_error_flash($e->getMessage());
		}
		catch (TreatmentException $e) {
			add_error_flash($e->getMessage());
		}
		catch (OdontogramException $e) {
			add_error_flash($e->getMessage());
		}
		catch (Exception $e) {
			add_error_flash('NO SE PUEDE PROCESAR LA ORDEN.');
		}
		finally{
			redirect_exit();
		}
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

		$Odontogram->update($datos_json);
		
		redirect_exit($Odontogram->url('ver'));
	}
}
