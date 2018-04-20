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
		
		include 'html/pacientes/main.php';
	}
}