<?php 

class Page extends Controller{

	public function __construct() {
		parent::__construct(
			array('radiografias/nueva/[:id]', 'nueva'), // CREO UNA SESSION DE FOTOS NUEVAS
			array('radiografias/editar/[:id]', 'editar')); // EDITO UNA SESSION DE FOTOS
	}

	public function editar($id)
	{
		$decrypt_params = decrypt_params($id);
		// SI NO ESTAN ESTOS DATOS NO AVANZA
		if (!isset($decrypt_params[PACIENTE], $decrypt_params[TRATAMIENTO], $decrypt_params[RADIOGRAFIA])){
			add_error_flash("NO SE PUDO CARGAR LA SESION DE RADIOGRAF&Iacute;AS.");
			redirect_exit();			
		}

		$Form = $this->load_form();


		$Patient = get_patient($decrypt_params[PACIENTE]);
		$Treatment = $Patient->treatment($decrypt_params[TRATAMIENTO]);
		$Radiographie = $Treatment->get_radiographie($decrypt_params[RADIOGRAFIA]);
		
		if ($Form->input('action') == 'delete') {
			$Radiographie->delete();

			add_msg_flash('SE ELIMINO LA SESION DE RADIOGRAF&Iacute;AS.');
			redirect_exit($Patient->url('radiografias'));
		}

		$trash = filter_input(INPUT_POST, 'trash', FILTER_DEFAULT , FILTER_REQUIRE_ARRAY);

		$Radiographie->trash($trash);

		$files = $this->upload_files($trash);


		$data = $Form->input;
		
		if (!empty($files)) {
			$data['session'] = $files;
		}

		$Radiographie->update($data);

		add_msg_flash('SESION DE RADIOGRAF&Iacute;AS ACTUALIZADA CON EXITO.');
		redirect_exit($Radiographie->url('ver'));
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
		$Treatment = $Patient->treatment();

		$files = $this->upload_files();
		

		// MENSAJE PARA EL FRONT
		if (empty($files)) {
			redirect_exit($Patient->url('ver'));
		}

		$data = $Form->input;
		$data['name'] = $decrypt_params[MODELO];
		$data['session'] = $files;

		$Radiographies = $Treatment->create_radiographie($data);

		if ($Radiographies->id) {
			add_msg_flash('SESION DE RADIOGRAF&Iacute;AS CREADA CON EXITO.');
			redirect_exit($Radiographies->url('ver'));
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

			if (preg_match('/^panoramica[1-3]?$/i', $k)) {
				$w = RADIOGRAFIA_PANORAMICA_WIDTH;
				$h = RADIOGRAFIA_PANORAMICA_HEIGHT;
			}
			elseif (preg_match('/^trx[1-3]?$/i', $k)) {
				$w = RADIOGRAFIA_TRX_WIDTH;
				$h = RADIOGRAFIA_TRX_HEIGHT;
			}
			elseif (preg_match('/^trx[1-6]_$/i', $k)) {
				$w = RADIOGRAFIA_TRX__WIDTH;
				$h = RADIOGRAFIA_TRX__HEIGHT;
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
		$Upload->set_destination(RADIOGRAFIAS_PATH);
		
		$img = $Upload->run($filename);

		// SI EL ARCHIVO EXISTE AGREGO LA IMAGEN AL JSON Y CREO EL THUMB
		if ($img['status']) {
			img_resample($img['full_path'], $w, $h, RADIOGRAFIAS_PATH . 'thumb/' . $filename, RESAMPLE_TRIM);
			return $filename;
		}
		else{
			return false;
			add_error_flash("ERROR AL CARGAR LA IMAGEN DE {$k}, NO SE PUDO CARGAR.");
		}
	}
}