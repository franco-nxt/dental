<?php 

/**
 * summary
 */
class RegisterException extends Exception
{
    public function __construct($message, $code = 0) {

    	if ($code == 1) {
	    	$file = @fopen("RegisterException-logs.txt","a");

			if($file){
				$date = date("d/m/Y H:i:s");

				fwrite($file, "$date: $message \r\n");

				fclose($file);
			}
    	}

        parent::__construct($message);
    }
}