<?php 

class Page extends Controller{

	public function __construct() 
	{
		// CUANDO ENVIEN EL ACTION RESTORE LLAMO AL METODO 'restaurar'
		$method = filter_input(INPUT_POST, 'action') === 'restore' ? 'restaurar' :  'editar';
		
		try{	
			parent::__construct(
				array('@paciente/([^(nuevo|buscar)]+)$', 'main'),
				array('paciente/nuevo', 'nuevo'),
				array('paciente/editar/[:encode]', $method),
				array('paciente/eliminar/[:encode]', 'eliminar')
			);
		} 
		catch (PatientException $e) {
			add_msg_flash($e->getMessage());
		}
		catch (TreatmentException $e) {
			add_msg_flash($e->getMessage());
		}
		catch (DentalException $e) {
			add_msg_flash($e->getMessage());
		}
		catch (Exception $e) {
		}
		finally{
			redirect_exit();
		}
	}

	public function editar($encode) 
	{

		// OBTENGO EL PACIENTE DESDE EL ID ENCODEADO
		$Patient = decode_patient($encode);
		// VALIDO LOS DATOS, SI HAY ALGO MAL REDIRECT AL PERFIL DEL PACIENTE
		$FormValidator = $this->validate_form($Patient->url('editar'));
		// DATOS DEL FORMULARIO
		$form_data = $FormValidator->input;
		
		if ($form_data['action'] == 'delete') {
			$Patient->delete(true);
			add_msg_flash('PACIENTE ELIMINADO.');
		}

		// SUBO LA IMAGEN, PASO EL FORMULARIO POR REFERENCIA
		$this->upload_profile_image($form_data);
		// ACTUALIZO AL PACIENTE CON LOS DATOS DEL FORMULARIO
		$Patient->update($form_data); 
		// TRAIGO EL ULTIMO TRATAMIENTO
		$Tratamiento = $Patient->get_treatment(); 
		// ACTUALIZO EL TRATAMIENTO CON LOS DATOS DEL FORMULARIO
		$Tratamiento->update($form_data); 
		// MENSAJE PARA EL FRONT
		add_msg_flash('SE REALIZARON LOS CAMBIOS CON EXITO.');
		// REDIRECT AL PERFIL DEL PACIENTE
		redirect_exit($Patient->url());
	}

	public function nuevo() 
	{
		// VALIDO LOS DATOS, SI HAY ALGO MAL REDIRECT AL HOME
		$FormValidator = $this->validate_form();

		// DATOS DEL FORMULARIO
		$form_data = $FormValidator->input;
		// SUBO LA IMAGEN
		$this->upload_profile_image($form_data);
		// AGREGO EL ID DEL USUARIO A LA DATA DEL FORMULARIO, PARA LA CARGA EN BBDD
		$form_data['id_usuario'] = get_user()->id;
		// CREO EL PACIENTE CON LOS DATOS DEL FORMULARIO
		$Patient = new Patient($form_data);
		// TODO ESTA BIEN CREO EL TRATAMIENTO
		if ($Patient->id) {
			// CREO EL TRTAMIENTO CON LOS DATOS DEL FORMULARIO
			$Tratamiento = $Patient->create_treatment($form_data);

			add_msg_flash('SE GUARDO EL NUEVO PACIENTE.');

			redirect_exit($Patient->url());
		}
		else{
			// ANTES DE LLEGAR ACA TENDRIA QUE SALTAR UNA PatientException PERO POR LAS DUDAS
			throw new Exception();
		}
	}

	public function eliminar($encode)
	{
		// OBTENGO EL PACIENTE DESDE EL ID ENCODEADO
		$Patient = decode_patient($encode);
		// UPDATE EN LA BBDD COMO ELIMINADO
		$Patient->delete();
		// MENSAJE PARA EL FRONT
		add_msg_flash('PACIENTE ELIMINADO.');

		redirect_exit();
	}

	public function restaurar($encode)
	{
		// OBTENGO EL PACIENTE DESDE EL ID ENCODEADO
		$Patient = decode_patient($encode);
		
		$Patient->restore();

		// MENSAJE PARA EL FRONT
		add_msg_flash('PACIENTE RESTAURADO.');
		// REDIRJO AL PERFIL DEL PACIENTE            
		redirect_exit($Patient->url());
	}

	private function upload_profile_image(&$form_data)
	{
		// SI NO ESTA LA IMAGEN 
		if (empty($_FILES['img']['name'])) {
			return false;
		}
		// CARGO LA CLASE 'Upload'
		$Upload = load_class('Upload', CLASS_PATH . '/core');
		// ARMO EL FILENAME PARA LA IMG
		$filename = uniqid() . '.' . pathinfo($_FILES['img']['name'], PATHINFO_EXTENSION);
		// PASO EL ARCHIVO QUE QUIERO SUBIR
		$Upload->file($_FILES['img']);
		// FOLDER DESTINO DE LA IMG
		$Upload->set_destination('img/paciente');
		// UPLOAD
		$img = $Upload->run($filename);
		// SI ESTA TODO OK
		if ($img['status']){ 
			// A LA REFERENCIA DEL FORMULARIO LE AGREGO EL NOMBRE DEL ARCHIVO PARA LA BBDD
			$form_data['foto'] = $filename;
			// CREO EL THUMB
			img_resample($img['full_path'], 150, 150, 'img/paciente/thumb_' . $filename, RESAMPLE_TRIM);

			return $filename;
		}
		else{
			// NO SE PUDO SUBIR LA IMAGEN
			throw new DentalException("NO SE PUDO SUBIR LA IMAGEN DEL PACIENTE.");
		}
	}

	private function validate_form($redirect = URL_ROOT)
	{
		// INSTACIO 
		$FormValidator = load_class('FormValidator');

		// AGREGO LAS REGLAS DE VALIDACION
		$FormValidator->add_rule("nombre", "REQ&alpha_s");
		$FormValidator->add_rule("apellido", "REQ&alpha_s");
		$FormValidator->add_rule("dni", "alnum_s");
		$FormValidator->add_rule("telefono", "alnum_s");
		$FormValidator->add_rule("celular", "alnum_s");
		$FormValidator->add_rule("correo_electronico", "email");
		$FormValidator->add_rule("direccion", "alnum_s");
		$FormValidator->add_rule("ciudad", "alnum_s");
		$FormValidator->add_rule("codigo_postal", "alnum_s");
		$FormValidator->add_rule("madre_apellido", "alpha_s");
		$FormValidator->add_rule("madre_nombre", "alpha_s");
		$FormValidator->add_rule("padre_apellido", "alpha_s");
		$FormValidator->add_rule("padre_nombre", "alpha_s");
		$FormValidator->add_rule("derivado_por", "alpha_s");
		$FormValidator->add_rule("duracion", "num&lessthan=99");
		$FormValidator->add_rule("tecnica", "rgx=#1|2#");
		$FormValidator->add_rule("presupuesto", "alnum_s");
		$FormValidator->add_rule("descripcion", "maxlen=200");

		// VALIDO, SI HAY ALGUN ERROR LO REDIRIJO
		if(!$FormValidator->validate()){
			$errors = implode('<br/>', $FormValidator->errors);

			add_error_flash($errors);

			redirect_exit($redirect);
		}

		// RETORNO EL FORM PARA SEGUIR USANDOLO
		return $FormValidator;
	}
}