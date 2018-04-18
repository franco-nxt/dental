<?php 

class Page extends Controller{

	public function __construct() {
		// _global('navbar-title', 'PACIENTES');

		$this->main();
	}
	
	public function main() {
		echo 'asdasdasdas';
		load_class('Session')->destroy();
		redirect_exit();
	}
}