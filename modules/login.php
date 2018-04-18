<?php 

class Page extends Controller{

	public function __construct() {
		_global('title', 'Bienvenido');
		_global('__HTML__', false);
		
		load_class('Session')->__dental__;
		load_class('Session')->__destroy_at__;
		
		include 'html/login.php';
	}
}