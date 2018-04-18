<?PHP
class FormValidator {

	private static $msg = array(
		"FORM_REQUIRED_VALUE" =>  "Debe completar el campo %s.",
		"FORM_MAXLEN_EXCEEDED" =>  "El campo %s supera el limite de caracteres.",
		"FORM_MINLEN_CHECK_FAILED" =>  "El campo %s debe contener al menos %d caracteres.",
		"FORM_ALNUM_CHECK_FAILED" =>  "El valor del campo %s debe ser un alfanumerico.",
		"FORM_ALNUM_S_CHECK_FAILED" =>  "El valor del campo %s debe ser un alfanumerico.",
		"FORM_NUM_CHECK_FAILED" =>  "El valor del campo %s debe contener solo numeros.",
		"FORM_ALPHA_CHECK_FAILED" =>  "El valor del campo %s debe contener solo letras.",
		"FORM_ALPHA_S_CHECK_FAILED" =>  "El valor del campo %s debe contener solo letras.",
		"FORM_EMAIL_CHECK_FAILED" =>  "La direccion de correo es invalida.",
		"FORM_LESSTHAN_CHECK_FAILED" =>  "El valor del campo %s debe ser menor a %d.",
		"FORM_GREATERTHAN_CHECK_FAILED" =>  "El valor del campo %s debe ser mayor a %d.",
		"FORM_REGEXP_CHECK_FAILED" =>  "El valor del campo %s no es valido.",
		"FORM_EQELMNT_CHECK_FAILED" =>  "El valor del campo %s debe ser el mismo de %s.",
		"FORM_NOT_VALIDATION" =>  "No existe una regla para validar el campo."
	);

	public $errors = array();

	public $rules = array();

	public $violations = array();

	public $method;
	
	public function __construct($method = NULL) {
		$this->set_method($method);

		$this->input = filter_input_array($this->method);
	}

	public function set_method($method = NULL) {
		$method || $method = $_SERVER['REQUEST_METHOD'];
		
		$this->method = strcmp(strtoupper($method), 'POST') == 0 ? INPUT_POST : INPUT_GET;
	}
	/**
	 * Agrega una regla de validacion a la clase, para que
	 * despues las procese.
	 *
	 * @param String $key Nombre del campo a validar.
	 * @param String $rule Httpbuildquery de forma clave = valor, con las reglas que deve validar el campo.
	 * @param String $error Mensaje de error personalizado.
	 * @param String $name Alias que se le da al campo para pasar al mensaje de error.
	 * @return void
	 **/
	public function add_rule($key, $rule, $error = NULL, $name = NULL) {
		$this->rules[] = (object) array('key' => $key, 'rule' => $rule, 'error_msg' => $error, 'name' => $name);
	}

	public function validate($brak_on_first = FALSE, $method = NULL) {
		$this->set_method($method);
		
		$this->input = filter_input_array($this->method);
		foreach($this->rules as &$rule) {
			$value = filter_input($this->method, $rule->key);

			parse_str($rule->rule, $rule->commands);

			foreach ($rule->commands as $command => $ref) {
				$lower_command = strtolower($command);
				$error = $this->_eval($lower_command, $value, $ref, $rule->key);

				if ($error) {
					$rule->error_msg && $error = $rule->error_msg;
					$name = $rule->name;
					$name || $name = $rule->key;

					$this->add_default_error($error, $name, $ref, $rule->key);

					$this->violations[$lower_command] = TRUE;

					if ($command !== $lower_command) {
						break;
					}
					elseif ($brak_on_first) {
						break 2;
					}
				}
			}
		}

		return empty($this->errors);
	}

	public function input($key = FALSE) {
		return !$key ? $this->input : filter_input($this->method, $key);
	}

	public function error_msg($glue = "\n") {
		return implode($glue, $this->errors);
	}

	private function add_default_error($msg, $name = '', $ref = '', $key) {
		if(isset($this->errors[$key]) && strlen($this->errors[$key])){
			$this->errors[$key] .= "\n" . sprintf($msg, $name, $ref);
		} 
		else{
			$this->errors[$key] = sprintf($msg, $name, $ref);
		}
	}

	public function validate_req($value = NULL) {
		return is_array($value) ? (empty($value) === FALSE) : ($value || strlen($value) ||trim($value) !== '');
	}

	public function validate_maxlen($value = NULL, $max_len = NULL) {
		if (!$value || !$max_len || !$this->validate_numeric($max_len)) {
			return false;
		}

		return (strlen($value) > $max_len);
	}

	public function validate_minlen($value = NULL, $min_len = NULL) {
		if (!$value || !$min_len || !$this->validate_numeric($min_len)) {
			return false;
		}

		return (strlen($value) < $min_len);
	}

	public function validate_email($value = NULL)  {
		if (!$value) {
			return false;
		}

		if (function_exists('idn_to_ascii') && preg_match('#\A([^@]+)@(.+)\z#', $value, $matches)) {
			$value = $matches[1].'@'.idn_to_ascii($matches[2]);
		}

		return (bool) filter_var($value, FILTER_VALIDATE_EMAIL);
	}

	public function validate_numeric($value = NULL) {
		return ($value && (is_numeric($value) || (Bool) preg_match('/^[\-+]?[0-9]*\.?[0-9]+$/', $value)));
	}

	public function validate_lessthan($value, $ref) {
		if(!$this->validate_numeric($value) || !$this->validate_numeric($ref)) {
			return false;
		}

		return (doubleval($ref) > doubleval($value));
	}

	public function validate_greaterthan($value, $ref) {
		if(!$this->validate_numeric($value) || !$this->validate_numeric($ref)) {
			return false;
		}
		return (doubleval($ref) < doubleval($value));
	}

	public function validate_eqfield($value = NULL, $fieldname = NULL) {
		if (!$value || !$fieldname) {
			return false;
		}

		return strcmp($value, filter_input($this->method, $fieldname)) == 0 ;
	}

	public function validate_rgx($value = NULL, $rgx = NULL) {
		if (!$value || !$rgx) {
			return false;
		}
		return (Bool) preg_match($rgx, $value);
    }
    
	private function _eval($command, $value = NULL, $ref = NULL, $key) {
		$error = NULL;
		
		if(strtolower($command) != 'req' && !$value){
			return NULL;
		}

		if (!$command) {
			return self::$msg['FORM_NOT_VALIDATION'];
		}
		
		if ($ref) {
			switch ($command) {
				case "rgx": 
				case "regexp": 
				!$this->validate_rgx($value, $ref) && $error = self::$msg['FORM_REGEXP_CHECK_FAILED']; 
				break;
				
				case 'maxlen': 
				$this->validate_maxlen($value, intval($ref)) && $error = self::$msg['FORM_MAXLEN_EXCEEDED'];
				break;
				
				case 'minlen':
				!$this->validate_minlen($value, intval($ref)) && $error = self::$msg['FORM_MINLEN_CHECK_FAILED'];
				break;
				
				case "lt": 
				case "lessthan": 
				!$this->validate_lessthan($value, $ref) && $error = self::$msg['FORM_LESSTHAN_CHECK_FAILED'];
				break;
				
				case "gt": 
				case "greaterthan": 
				!$this->validate_greaterthan($value, $ref) && $error = self::$msg['FORM_GREATERTHAN_CHECK_FAILED'];
				break;
				
				case "eqelmnt":
				!$this->validate_eqfield($value, $ref) && $error = self::$msg['FORM_EQELMNT_CHECK_FAILED'];
				
				break;
			}
		}
		
		switch($command) {
			case 'req':
			!$this->validate_req($value, $key) && $error = self::$msg['FORM_REQUIRED_VALUE'];
			break;
			
			case 'alnum':
			$this->validate_rgx($value, "#[^A-Za-zÁÉÍÓÚáéíóúÄËÏÖÜäëïöüÑñ0-9]+#i") && $error = self::$msg['FORM_ALNUM_CHECK_FAILED'];
			break;
			
			case 'alnum_s':
			$this->validate_rgx($value, "#[^A-Za-zÁÉÍÓÚáéíóúÄËÏÖÜäëïöüÑñ0-9\s]+#i") && $error = self::$msg['FORM_ALNUM_S_CHECK_FAILED'];
			break;
			
			case 'num':
			case 'numeric':
			!$this->validate_numeric($value) && $error = self::$msg['FORM_NUM_CHECK_FAILED'];
			break;
			
			case 'alpha':
			$this->validate_rgx($value, "#[^A-Za-zÁÉÍÓÚáéíóúÄËÏÖÜäëïöüÑñ]+#i") && $error = self::$msg['FORM_ALPHA_CHECK_FAILED'];
			break;
			
			case 'alpha_s':
			$this->validate_rgx($value, "#[^A-Za-zÁÉÍÓÚáéíóúÄËÏÖÜäëïöüÑñ\s]+#i", $value) && $error = self::$msg['FORM_ALPHA_S_CHECK_FAILED'];
			break;
			
			case 'email':
			!$this->validate_email($value) && $error = self::$msg['FORM_EMAIL_CHECK_FAILED'];
			break;
		}
		
		return $error;
	}
}