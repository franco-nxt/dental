<?php 

/**
 * summary
 */
class PaymentException extends Exception
{
	public function __construct($message, $code = 0) {

		$file = @fopen(BASE_PATH . DIRECTORY_SEPARATOR ."PaymentException-logs.txt","a");

		if($file){
			$date = date("d/m/Y H:i:s");
			$trace = $this->getTraceAsString();
			fwrite($file, "$date: $trace \r\n");

			fclose($file);
		}

		parent::__construct($message);
	}
}