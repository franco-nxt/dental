<?php 

class Page extends Controller{

    public function __construct() {
        parent::__construct(
            array('tratamiento/editar/[:id]', 'editar'),
            array('tratamiento/nuevo/[:id]', 'nuevo'));
    }
    
    public function main($id) {
        echo $id;
    }

    public function editar($id) 
    {
        $decrypt_params = decrypt_params($id);
        // SI NO ESTAN ESTOS DATOS NO AVANZA
        if (!isset($decrypt_params[PACIENTE], $decrypt_params[TRATAMIENTO])){
            add_error_flash("NO SE PUDO EDITAR EL TRATAMIENTO.");
            redirect_exit();
        }

        $Patient = get_patient($decrypt_params[PACIENTE]);
        $Treatment = $Patient->get_treatment($decrypt_params[TRATAMIENTO]);

        $FormValidator = $this->validate_form();
        
        $FormValidator->add_rule("duracion", "num&lessthan=99");
        $FormValidator->add_rule("tecnica", "rgx=#1|2#");
        $FormValidator->add_rule("presupuesto", "alnum_s");
        $FormValidator->add_rule("descripcion", "maxlen=200");

        // VALIDO EL FORM
        if($FormValidator->validate()){
            $form_data = $FormValidator->input; // POST DATA
            $Treatment->update($form_data); // ACTUALIZO DATOS DEL TRATAMIENTO

            // MENSAJE PARA EL FRONT
            add_msg_flash('SE REALIZARON LOS CAMBIOS CON EXITO.');
            redirect_exit($Patient->url('economia'));
        }
        else{
            add_error_flash(implode('<br/>', $FormValidator->errors));
            redirect_exit($Treatment->url('editar'));
        }
    }

    public function nuevo($id) 
    {
        $decrypt_params = decrypt_params($id);
        // SI NO ESTAN ESTOS DATOS NO AVANZA
        if (!isset($decrypt_params[PACIENTE])){
            add_error_flash("NO SE PUDO EDITAR EL TRATAMIENTO.");
            redirect_exit();
        }

        $Patient = get_patient($decrypt_params[PACIENTE]);

        $FormValidator = $this->validate_form();
        
        $FormValidator->add_rule("duracion", "num&lessthan=99");
        $FormValidator->add_rule("tecnica", "rgx=#1|2#");
        $FormValidator->add_rule("presupuesto", "alnum_s");
        $FormValidator->add_rule("descripcion", "maxlen=200");

        // VALIDO EL FORM
        if($FormValidator->validate()){
            $form_data = $FormValidator->input; // POST DATA
            $Treatment = $Patient->treatment($form_data);

            // MENSAJE PARA EL FRONT
            add_msg_flash('SE CREO UN NUEVO TRATAMIENTO CON EXITO.');
        }
        else{
            add_error_flash(implode('<br/>', $FormValidator->errors));
        }
        redirect_exit($Patient->url());
    }

    private function validate_form(){
        $FormValidator = load_class('FormValidator');
        
        $FormValidator->add_rule("duracion", "num&lessthan=99");
        $FormValidator->add_rule("tecnica", "rgx=#1|2#");
        $FormValidator->add_rule("presupuesto", "alnum_s");
        $FormValidator->add_rule("descripcion", "maxlen=200");

        return $FormValidator;
    }
}