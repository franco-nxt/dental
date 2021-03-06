<?php 

class Page extends Controller{

	public function __construct() {
		try {
			parent::__construct(
				array('fotografias/nueva/[:encode]', 'nueva'),
				array('fotografias/editar/[:encode]', 'editar')
			);
		}
		catch (PatientException $e) {
			add_error_flash($e->getMessage());
		}
		catch (TreatmentException $e) {
			add_error_flash($e->getMessage());
		}
		catch (PhotoException $e) {
			add_error_flash($e->getMessage());
		}
		catch (Exception $e) {
			add_error_flash('NO SE PUEDE PROCESAR LA ORDEN.');
		}
		finally{
			redirect_exit();
		}
	}

	public function editar($encode)
	{
		// SI NO ESTAN ESTOS DATOS NO AVANZA
		$Form = $this->load_form();

		$Patient = decode_patient($encode);
		$Treatment = $Patient->get_treatment(get_from_encode($encode, TRATAMIENTO));
		$Photo = $Treatment->get_photo(get_from_encode($encode, FOTOGRAFIA));
		
		if ($Form->input('action') == 'delete') {
			$Photo->delete();

			add_msg_flash('SE ELIMINO LA SESION DE FOTOGRAF&Iacute;AS.');
			redirect_exit($Patient->url('fotografias'));
		}
		// SI APARECE ALGUNA ALGUNA IMAGEN A ELIMINAR
		$trash = filter_input(INPUT_POST, 'trash', FILTER_DEFAULT , FILTER_REQUIRE_ARRAY);

		if (!empty($trash)) {
			$Photo->trash($trash);
		}

		$files = $this->upload_files($trash);
		$data = $Form->input;

		if (!empty($files)) {
			$data['session'] = $files;
		}
		$Photo->update($data);

		add_msg_flash('SESION DE FOTOGRAF&Iacute;AS ACTUALIZADA CON EXITO.');
		redirect_exit($Photo->url('ver'));
	}

	public function nueva($encode)
	{
		$decrypt_params = decrypt_params($encode);
		// SI NO ESTAN ESTOS DATOS NO AVANZA
		if (!isset($decrypt_params[PACIENTE], $decrypt_params[MODELO])){
			add_error_flash("NO SE PUDO CARGAR LA SESION DE FOTOGRAF&Iacute;AS.");
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

		$Photo = $Treatment->create_photo($data);

		add_msg_flash('SESION DE FOTOGRAF&Iacute;AS CREADA CON EXITO.');
		redirect_exit($Photo->url('ver'));
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

			if (preg_match('/^eo(frente|3*4*perfilderecho)(co|si)nsonrisa|01|02$$/i', $k)) {
				$w = FOTOGRAFIA_VERTICAL_WIDTH;
				$h = FOTOGRAFIA_VERTICAL_HEIGHT;			
			}
			elseif (preg_match('/^io(lateral(izquierd|derech)o|frontal|overjet|uno|dos|oclusal(inf|sup)erior)$/i', $k)) {
				$w = FOTOGRAFIA_HORIZONTAL_WIDTH;
				$h = FOTOGRAFIA_HORIZONTAL_HEIGHT;
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
		$Upload->set_destination(FOTOGRAFIAS_PATH);
		
		$img = $Upload->run($filename);

		// SI EL ARCHIVO EXISTE AGREGO LA IMAGEN AL JSON Y CREO EL THUMB
		if ($img['status']) {
			img_resample($img['full_path'], $w, $h, FOTOGRAFIAS_PATH . 'thumb/' . $filename, RESAMPLE_TRIM);
			return $filename;
		}
		else{
			return false;
			add_error_flash("ERROR AL CARGAR LA IMAGEN DE {$k}, NO SE PUDO CARGAR.");
		}
	}
}