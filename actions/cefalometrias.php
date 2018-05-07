<?php 

class Page extends Controller{

	public function __construct() {
		try{
			parent::__construct(
				array('cefalometrias/nueva/[:encode]', 'nueva'),
				array('cefalometrias/editar/[:encode]', 'editar')
			);
		} 
		catch (PatientException $e) {
			add_error_flash($e->getMessage());
		}
		catch (TreatmentException $e) {
			add_error_flash($e->getMessage());
		}
		catch (CephalometryException $e) {
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
		if (!isset($decrypt_params[PACIENTE], $decrypt_params[TRATAMIENTO], $decrypt_params[CEFALOMETRIA])){
			add_error_flash("NO SE PUDO CARGAR LA SESION DE CEFALOMETR&Iacute;AS.");
			redirect_exit();			
		}

		$Form = $this->load_form();


		$Patient = get_patient($decrypt_params[PACIENTE]);
		$Treatment = $Patient->get_treatment($decrypt_params[TRATAMIENTO]);
		$Cephalometry = $Treatment->get_cephalometry($decrypt_params[CEFALOMETRIA]);
		
		if ($Form->input('action') == 'delete') {
			$Cephalometry->delete();

			add_msg_flash('SE ELIMINO LA SESION DE CEFALOMETR&Iacute;AS.');
			redirect_exit($Patient->url('cefalometrias'));
		}

		$trash = filter_input(INPUT_POST, 'trash', FILTER_DEFAULT , FILTER_REQUIRE_ARRAY);

		$Cephalometry->trash($trash);

		$files = $this->upload_files($trash);


		$data = $Form->input;
		
		if (!empty($files)) {
			$data['session'] = $files;
		}

		$Cephalometry->update($data);

		add_msg_flash('SESION DE CEFALOMETR&Iacute;AS ACTUALIZADA CON EXITO.');
		redirect_exit($Cephalometry->url('ver'));
	}

	public function nueva($id)
	{
		$decrypt_params = decrypt_params($id);
		// SI NO ESTAN ESTOS DATOS NO AVANZA
		if (!isset($decrypt_params[PACIENTE], $decrypt_params[MODELO])){
			add_error_flash("NO SE PUDO CARGAR LA SESION FOTOGRAFICA.");
			redirect_exit();			
		}

		$Form = $this->load_form();

		$Patient = get_patient($decrypt_params[PACIENTE]);
		$Treatment = $Patient->get_treatment();

		$files = $this->upload_files();
		

		// MENSAJE PARA EL FRONT
		if (empty($files)) {
			redirect_exit($Patient->url('ver'));
		}

		$data = $Form->input;
		$data['name'] = $decrypt_params[MODELO];
		$data['session'] = $files;

		$Cephalometry = $Treatment->create_cephalometry($data);

		if ($Cephalometry->id) {
			add_msg_flash('SESION DE CEFALOMETR&Iacute;AS CREADA CON EXITO.');
			redirect_exit($Cephalometry->url('ver'));
		}
	}

	private function load_form()
	{
		$FormValidator = load_class('FormValidator');
		$FormValidator->add_rule("fecha", "rgx=#^\d{1,2}[\/|-][02]?[1-9]|3[0-2][\/|-]\d{1,4}$#");
		$FormValidator->add_rule("etapa", "rgx=#[" . ETAPA_INICIALES . ETAPA_INTERMEDIAS . ETAPA_FINALES .  "]#");

		if(!$FormValidator->validate()){
			add_error_flash(implode('<br />', $Form->error));
			redirect_exit();			
		}

		return $FormValidator;
	}

	private function upload_files($trash = array())
	{
		$result = array();
		foreach ($_FILES as $k => &$file) {
			// VALIDO EL CAMPO ENVIADO
			if (!isset($file['name'], $file['type']) || !preg_match('/^image\/(?:gif|jpeg|bmp|pjpeg|png)$/i', $file['type']) || (is_array($trash) && in_array($k, $trash))) {
				continue;
			}

			if (preg_match('/^pag[1-6]?$/i', $k)) {
				$w = CEFALOMETRIA_PAG_WIDTH;
				$h = CEFALOMETRIA_PAG_HEIGHT;
			}
			elseif (preg_match('/^p[1-3]_$/i', $k)) {
				$w = CEFALOMETRIA_P_WIDTH;
				$h = CEFALOMETRIA_P_HEIGHT;
			}
			else{
				continue;
			}

			$result[$k] = $this->upload($file, $w, $h);
		}

		return $result;
	}

	private function upload($file, $w, $h)
	{
		$Upload = load_class('Upload', CLASS_PATH);
		$uid = uniqid();
		$filename = $uid . '.' . pathinfo($file['name'], PATHINFO_EXTENSION);

		$Upload->file($file);
		$Upload->set_destination(CEFALOMETRIAS_PATH);
		
		$img = $Upload->run($filename);

		// SI EL ARCHIVO EXISTE AGREGO LA IMAGEN AL JSON Y CREO EL THUMB
		if ($img['status']) {
			img_resample($img['full_path'], $w, $h, CEFALOMETRIAS_PATH . 'thumb/' . $filename, RESAMPLE_TRIM);
			return $filename;
		}
		else{
			return false;
			add_error_flash("ERROR AL CARGAR LA IMAGEN DE {$k}, NO SE PUDO CARGAR.");
		}
	}
}