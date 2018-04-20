<?php
class Page extends Controller {

	function __construct() {
		_global('navbar-title', 'COMPARTIR');
		_global('navbar-back', URL_ROOT);

		parent::__construct(
			array('perfil/editar', 'editar'),
			array('perfil/eliminar/[:encode]', 'eliminar'),
			array('perfil/compartir', 'compartir'));
	}

	public function editar() 
	{
		$User = get_user();

		$Form = $this->validate_form();
		$data = $Form->input;
		
		$this->upload_profile_image($data);
		$User->update($data);

		redirect_exit('/perfil');
	}

	public function compartir() 
	{
		$User = get_user();

		$ref =  filter_input(INPUT_POST, 'ref', FILTER_DEFAULT);
		$link_id =  filter_input(INPUT_POST, 'id', FILTER_DEFAULT);
		
		$id =  $User->decode_share_id($link_id);

		if($User->create_link($id, $link_id, $ref)){
			add_msg_flash('VINCULO CREADO CON EXITO AHORA PUEDEN COMPARTIR PACIENTES ENTRE LOS USUARIOS.');
		}
		else{
			add_error_flash('NO SE PUDO GENERAR EL VINCULO ENTRE LOS USUARIOS.');
		}

		redirect_exit('/perfil');
	}

	private function upload_profile_image(&$form_data)
	{
		// SUBO LA IMAGEN SI ES QUE EXISTE
		if (isset($_FILES['img']['name']) && $_FILES['img']['name'] != '') {
			$Upload = load_class('Upload', CLASS_PATH . '/core');
			$filename = uniqid() . '.' . pathinfo($_FILES['img']['name'], PATHINFO_EXTENSION);

			$Upload->file($_FILES['img']);
			$Upload->set_destination('img/perfil');

			$img = $Upload->run($filename);
			if ($img['status']){
				$form_data['foto'] = $filename;
				img_resample($img['full_path'], 150, 150, 'img/perfil/thumb/' . $filename, RESAMPLE_TRIM);
			}
			else{
				add_error_flash('NO SE PUDO SUBIR LA IMAGEN AL SERVIDOR.');
			}
		}
	}

	public function eliminar($link_id)
	{
		$User = get_user();
		$decode_share_id =  $User->decode_share_id($link_id);
		
		if($User->delete_link($decode_share_id, $link_id)){
			add_msg_flash('VINCULO ELIMINADO.');
		}

		redirect_exit('/perfil');
	}

	private function validate_form()
	{
		$FormValidator = load_class('FormValidator');
		
		$FormValidator->add_rule("nombre", "REQ&alpha_s");
		$FormValidator->add_rule("apellido", "REQ&alpha_s");
		$FormValidator->add_rule("telefono", "alnum_s");
		$FormValidator->add_rule("celular", "alnum_s");
		$FormValidator->add_rule("correo_electronico", "REQ&email");
		$FormValidator->add_rule("direccion", "alnum_s");
		$FormValidator->add_rule("ciudad", "alnum_s");
		$FormValidator->add_rule("pais", "alnum_s");
		$FormValidator->add_rule("pass", "REQ&alnum_s");

		if(!$FormValidator->validate()){
			add_error_flash(implode('<br />', $FormValidator->errors));
			redirect_exit();
		}

		return $FormValidator;
	}
}