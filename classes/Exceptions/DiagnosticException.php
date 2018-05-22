<?php 

class DiagnosticException extends Exception
{
	public function __construct($message, $code = 0) {

		$json = json_encode($this);

		try {
			$Session = load_class('Session');
			$user = $Session->__dental__;
		} 
		catch (DentalException $e) {
			$user = '';
		}

		$q = "INSERT INTO exceptions (msg, json, user) VALUES ('', '{$json}', '{$user}')";

		MySQL::getInstance()->query($q);

		parent::__construct($message);
	}
}