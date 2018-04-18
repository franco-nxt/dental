<?php

class Page extends Controller{

	public function __construct() {
		_global('navbar-title', 'PACIENTES');

		$this->main();
	}
	
	public function main() {
		_global('navbar-back', URL_ROOT);
		_global('navbar-options', true);

		$User = get_user();

		$patients = (Array) $User->patients();
		$eliminado  = array();
		$activo     = array();
		$finalizado = array();
		$inactivo   = array();

		if (!empty($patients)) {
			foreach ($patients as $patient) {
				if ($patient->eliminado == PACIENTE_ELIMINADO) {
					array_push($eliminado, $patient->treatment());
				}
				else {
					$treatments = (Array) $patient->treatments();

					if (!empty($treatments)) {
						foreach ($treatments as $treatment) {
							$grupo = strtolower($treatment->estado);
							if ($treatment->estado && isset($$grupo)) {
								array_push($$grupo, $treatment);
							}
						}
					}
				}
			}
		}
		include 'html/pacientes/main.php';
	}
}