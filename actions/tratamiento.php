<?php 

class Page extends Controller{

    public function __construct() {
        try{
            parent::__construct(
                array('tratamiento/editar/[:encode]', 'editar'),
                array('tratamiento/nuevo/[:encode]', 'nuevo')
            );
        } 
        catch (PatientException $e) {
            add_error_flash($e->getMessage());
        }
        catch (TreatmentException $e) {
            add_error_flash($e->getMessage());
        }
        catch (Exception $e) {
            add_error_flash('NO SE PUEDE PROCESAR LA ORDEN.');
        }
        finally{
            redirect_exit();
        }
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
        // OBTENGO EL PACIENTE DESDE EL ID ENCODEADO
        $Patient = decode_patient($encode);
        $FormValidator = $this->validate_form();
        // VALIDO EL FORM
        if($FormValidator->validate()){
            // POST DATA
            $form_data = $FormValidator->input; 
            // CON ESA INFO CREO EL TRATAMIENTO
            $Treatment = $Patient->create_treatment($form_data);
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