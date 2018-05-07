<?php 

class Page extends Controller{

	public function __construct() {
		load_class('Session')->destroy();
		redirect_exit();
	}
}