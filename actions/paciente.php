<?php 

class Page extends Controller{

	public function __construct() {
		parent::__construct(
            array('@paciente/([^(nuevo|buscar)]+)$', 'main'),
            array('paciente/nuevo', 'nuevo'),
            array('paciente/editar/[:id]', 'editar'),
            array('paciente/eliminar/[:id]', 'delete'));
	}
	
	public function main($id) {
		echo $id;
	}

    public function editar($id) {
        $Patient = get_patient($id);

        // ACA VIENE SI TIENEN QUE RESTAURAR EL PACIENTE
        if (filter_input(INPUT_POST, 'action') === 'restore') {
            $Patient->restore();

            // MENSAJE PARA EL FRONT
            add_msg_flash('PACIENTE RESTAURADO.');
            redirect_exit($Patient->url());
        }
        
        $FormValidator = $this->validate_form();

        // VALIDO EL FORM
        if($FormValidator->validate()){
            $form_data = $FormValidator->input; // POST DATA

            $this->upload_profile_image($form_data);

            $Patient->update($form_data); // ACUTALIZO LOS DATOS DEL PACIENTE
            $Tratamiento = $Patient->treatment(); // TRAIGO EL ULTIMO TRATAMIENTO ACTIVC
            $Tratamiento->update($form_data); // ACTUALIZO DATOS DEL TRATAMIENTO

            // MENSAJE PARA EL FRONT
            // add_msg_flash('SE REALIZARON LOS CAMBIOS CON EXITO.');
            // redirect_exit($Patient->url());
        }
        else{
            // add_error_flash(implode('<br/>', $FormValidator->errors));
            // redirect_exit($Patient->url('editar'));
        }
    }

    public function nuevo() {

        $FormValidator = $this->validate_form();

        if($FormValidator->validate()){
            $form_data = $FormValidator->input;
            
            $form_data['id_usuario'] = get_user()->id;
            
            $this->upload_profile_image($form_data);

            $Patient = new Patient($form_data);

            if ($Patient) {
                $form_data['tecnica'] = isset($form_data['tecnica']) && is_numeric($form_data['tecnica']) ? $form_data['tecnica'] : ORTOPEDIA_FUNCIONAL;

                $Tratamiento = $Patient->treatment($form_data);
            }

            // MENSAJE PARA EL FRONT
            add_msg_flash('SE GUARDO EL NUEVO PACIENTE.');
            redirect_exit($Patient->url());
        }
        else{
            $error = $FormValidator->errors;
        }

        isset($error) && add_msg_flash($error);

        // redirect_exit($Patient->url('editar'));
    }

    private function upload_profile_image(&$form_data){
        // SUBO LA IMAGEN SI ES QUE EXISTE
        if (isset($_FILES['img']['name']) && $_FILES['img']['name'] != '') {
            $Upload = load_class('Upload', CLASS_PATH . '/core');
            $filename = uniqid() . '.' . pathinfo($_FILES['img']['name'], PATHINFO_EXTENSION);

            $Upload->file($_FILES['img']);
            $Upload->set_destination('img/paciente');

            $img = $Upload->run($filename);
            if ($img['status']){
                $form_data['foto'] = $filename;
                img_resample($img['full_path'], 150, 150, 'img/paciente/thumb_' . $filename, RESAMPLE_TRIM);
            }
            else{
                load_class('Session')->form = $form_data;
                add_error_flash('NO SE PUDO SUBIR LA IMAGEN AL SERVIDOR.');
                redirect_exit($Patient->url());
            }

        }
    }

    public function delete($id)
    {
        get_patient($id)->delete();
        add_msg_flash('PACIENTE ELIMINADO.');
        redirect_exit();
    }

    private function validate_form(){

        $FormValidator = load_class('FormValidator');
        
        // $FormValidator->add_rule("action", "REQ&rgx=#save|cancel#");
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

        return $FormValidator;
    }
}