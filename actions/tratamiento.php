<?php 

class Page extends Controller{

    public function __construct() {
        parent::__construct(
            array('tratamiento/editar/[:encode]', 'editar'),
            array('tratamiento/nuevo/[:encode]', 'nuevo'));
    }
    
    public function main($encode) {
        echo $encode;
    }

    public function editar($encode) 
    {
        // OBTENGO EL PACIENTE DESDE EL ID ENCODEADO
        $Patient = decode_patient($encode);
        // OBTENGO EL TRATAMIENTO
        $Treatment = $Patient->get_treatment(get_from_encode($encode, TRATAMIENTO));

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

    public function nuevo($encode) 
    {
        $decrypt_params = decrypt_params($encode);
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
            $Treatment = $Patient->get_treatment($form_data);

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