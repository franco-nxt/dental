<?php

class Page extends Controller{

	public function __construct() {
		try{
			parent::__construct(
				array('diagnostico/historia/editar/[:encode]', 'history'),
				array('diagnostico/resumen/editar/[:encode]', 'resume'),
				array('diagnostico/completo/editar/[:encode]', 'complete'),
				array('diagnostico/examen/editar/[:encode]', 'exam')
			);
		} 
		catch (PatientException $e) {
			add_error_flash($e->getMessage());
			redirect_exit();
		}
		catch (TreatmentException $e) {
			add_error_flash($e->getMessage());
			redirect_exit();
		}
		catch (DiagnosticException $e) {
			add_error_flash($e->getMessage());
			redirect_exit();
		}
		catch (Exception $e) {
			add_error_flash('NO SE PUEDE PROCESAR LA ORDEN.');
			redirect_exit();
		}
	}
	
	public function history($encode) 
	{
		$Patient = decode_patient($encode);
		$Treatment = $Patient->get_treatment(get_from_encode($encode, TRATAMIENTO));
		$History = $Treatment->get_history();
		// CAMPOS DE LA TALBA HISTORIA
		$fieldnames = History::get_fieldnames();
		// VAR DATA
		$data = array();

		foreach ($fieldnames as $k) {
			
			if(empty($_POST[$k])) continue;
			
			$field = $_POST[$k];

			if(is_string($field)) {
				$data[$k] = $field;
			}
			elseif(!empty($field[0])){
				if (preg_match('/^(tratamiento_medico|enfermedad_sistemica|medicacion_actual|hepatitis)$/', $k)) {
					$data[$k] = array(strtolower($field[0]) => true);
					$field[0] == SI && !empty($field['cual']) && ($data[$k]['cual'] = $field['cual']);
				}
				elseif (preg_match('/^(interposicion_labio_inferior|succion_digital|bruxismo)$/i', $k)) {
					$data[$k] = array(strtolower($field[0]) => true);

					if($field[0] == SI && !empty($field['si'])){

						strcasecmp($field['si'], 'actual') == 0 && $data[$k] = array('si' => array('actual' => true));

						if (strcasecmp($field['si'], 'pasado') == 0){
							$data[$k] = array('si' => array('pasado' => true));

							!empty($field['pasado']) && $data[$k]['si']['pasado'] = array('hasta' => $field['pasado']);
						}
					}
				}
				elseif (preg_match('/^(orto(pedia|doncia)|(dolor|ruido)_articular|(ginjiv|periodont)itis|(placa|ronca)_dormir|res(pira_boca|frio_frecuente)|dificultad_(masticar|tragar)|traumatismo_boca_menton|fonoaudiologico|pubertad|hiv|xerostomia)$/i', $k) || ($k == 'higene_bucal' && preg_match('/^(buena|mala|regular)$/i', $field[0]))) {
					$data[$k] = array(strtolower($field[0]) => true);
				}
			}
			else{
				$data[$k] = '';
			}
		}

		if (!empty($data)) {
			$History->update($data);
		}

		add_msg_flash('HISTORIA MEDICA EDITADA CON EXITO.');
		redirect_exit($History->url());
	}

	public function exam($encode) 
	{
		$Patient = decode_patient($encode);
		$Treatment = $Patient->get_treatment(get_from_encode($encode, TRATAMIENTO));
		$Exam = $Treatment->get_exam();
		// CAMPOS DE LA TALBA HISTORIA
		$fieldnames = Exam::get_fieldnames();
		// VAR DATA
		$data = array();

		foreach ($fieldnames as $k) {
			
			if(empty($_POST[$k])) continue;
			
			$field = $_POST[$k];

			switch ($k) {
				case "estructuras_faciales":
				preg_match('/^a?simetricas$/i', $field) && $data[$k] = array($field => true);
				break;
				case "perfil":
				preg_match('/^(rect|con(cav|vex))o$/i', $field) && $data[$k] = array($field => true);
				break;
				case "labios_reposo":
				preg_match('/^(juntos|separados|cierre_forzado)$/i', $field) && $data[$k] = array($field => true);
				break;
				case "respiracion":
				preg_match('/^(normal|bucal|mixta)$/i', $field) && $data[$k] = array($field => true);
				break;
				case "deglucion":
				preg_match('/^(normal|atipica|finales)$/i', $field) && $data[$k] = array($field => true);
				break;
				case "surco_mentolabial":
				preg_match('/^(normal|pronunciado|inexistente)$/i', $field) && $data[$k] = array($field => true);
				break;
				case "denticion":
				preg_match('/^(primaria|mixta|permanente)$/i', $field) && $data[$k] = array($field => true);
				break;
				case "resalte":
				preg_match('/^(normal|excesiva|negativo)$/i', $field) && $data[$k] = array($field => true);
				break;
				case "mordida_cruzada":
				preg_match('/^(no_presenta|izquierda|derecha|bilateral)$/i', $field) && $data[$k] = array($field => true);
				break;
				case "longitud_arco_maxilar":
				preg_match('/^(adecuada|excesiva|deficiente)$/i', $field) && $data[$k] = array($field => true);
				break;
				case "curva_spee":
				preg_match('/^(normal|pronunciada)$/i', $field) && $data[$k] = array($field => true);
				break;
				case "paladar":
				preg_match('/^(normal|ojival|bajo)$/i', $field) && $data[$k] = array($field => true);
				break;
				case "linea_media_superior":
				case "linea_media_inferior":
				preg_match('/^desvio_(izquierd|derech)a$/i', $field) && $data[$k] = array($field => true);
				break;
				case "rco_dentaria":
				case "fisura_paladar":
				case "diastemas_superiores":
				case "diastemas_inferiores":
				preg_match('/^(si|no)$/i', $field) && $data[$k] = array($field => true);
				break;
				case "atm":
				if($field === 'normal') {
					$data[$k] = array('normal' => true);
				}
				else{
					$value = array();

					foreach (array('dolor', 'ruido') as $key) {
						if (!empty($field[$key])) {
							$value[$key] = array();
							
							in_array('izq', $field[$key]) && $value[$key]['izq'] = true;
							in_array('der', $field[$key]) && $value[$key]['der'] = true;

							$data[$k] = $value;
						}
					}
				}
				break;
				case "agenesias":
				case "supernumerarios":
				if(!empty($field[0])){

					$data[$k] = $field[0] == 'si' && !empty($field['observaciones']) ? array('si' => true, 'observaciones' => $field['observaciones']) : array('si' => true);
					
					$field[0] == 'no' && $data[$k] = array('no' => true);
				}
				break;
				case "tamano_dientes":
				if ($field === 'normal') {
					$data[$k] = array('normal' => true);
				}
				else{
					$value = array();

					foreach (array('macrodoncia', 'microdoncia') as $key) {	
						if (!empty($field[$key])) {

							if ($field[$key] === 'difusa'){
								$value[$key] = array('difusa' => true);
							}
							else{
								$value[$key] = array();
								
								in_array('incisivos', $field[$key]) && $value[$key]['incisivos'] = true;
								in_array('caninos', $field[$key]) && $value[$key]['caninos'] = true;
							}
						}						
					}

					!empty($value) && $data[$k] = $value;
				}

				break;
				case "clinicas_observaciones":
				case "intraoral_observaciones":
				is_string($field) && $data[$k] = $field;
				break;
				default: continue; break;
			}
		}

		if (!empty($data)) {
			$Exam->update($data);
		}
		
		add_msg_flash('DIAGNOSTICO EXAMEN EDITADO CON EXITO.');
		redirect_exit($Exam->url());
	}

	public function complete($encode)
	{
		$Patient = decode_patient($encode);
		$Treatment = $Patient->get_treatment(get_from_encode($encode, TRATAMIENTO));
		$Diagnostic = $Treatment->get_fullDiagnostic();
		$fieldnames = Diagnostic::get_fieldnames();

		$data = array();

		foreach ($fieldnames as $k) {

			if(empty($_POST[$k])) continue;
			
			$field = $_POST[$k];

			switch ($k) {
				case 'otros':
				case 'observaciones':
				if(isset($_POST[$k]) && is_string($_POST[$k])){
					$data[$k] = $_POST[$k];
				}
				break;
				case 'pos_molar_sup':
				case 'pos_incisivo_inf':
				case 'pos_incisivo_sup':
				case 'incl_incisivo_inf':
				case 'incl_incisivo_sup':
				case 'overjet':
				case 'overbite':
				case 'angulo_interincisivo':
				case 'protusion_labial':
				preg_match('#^(normal|aumentada|disminuida)$#i', $field) && $data[$k] = array($field => true);
				break;
				case 'clase_molar_izq':
				case 'clase_molar_der':
				preg_match('#^[1-3]$#i', $field) && $data[$k] = array($field => true);
				break;
				case 'patron':
				preg_match('#^(meso|braqui|dolico)$#i', $field) && $data[$k] = array($field => true);
				break;
				case 'esq_clase':
				case 'esq_pos_vertical':
				if (is_array($field)) {
					$clase = reset($field);
					
					if (preg_match('#^(normal|aumentado|disminuido|[1-3])$#i', $clase)) {
						$value = array($clase => true);	
						
						if (!empty($field['maxilar'])) {
							preg_match('#^(sup|inf)$#i', $field['maxilar']) && $value['maxilar'] = array($field['maxilar'] => true);
						}
						
						$data[$k] = $value;
					}
				}
				case 'panoramica':
				case 'ricketts' :
				case 'fotografias' :
				case 'trx_perfil' :
				case 'jarabak' :
				case 'vto_crecimiento' :
				case 'trx_frontal' :
				case 'steiner' :
				case 'vto_tratamiento' :
				case 'seriada' :
				case 'powell' :
					$data[$k] = empty($_POST[$k]) ? false : strcasecmp($k, $_POST[$k]) == 0;
				break;
			}
		}

		if (!empty($data)) {
			$Diagnostic->update($data);
		}

		add_msg_flash('DIAGNOSTICO COMPLETO EDITADO CON EXITO.');
		redirect_exit($Diagnostic->url());
	}

	public function resume($encode)
	{
		$Patient = decode_patient($encode);
		$Treatment = $Patient->get_treatment(get_from_encode($encode, TRATAMIENTO));
		$Resume = $Treatment->get_resume();
		$fieldnames = Resume::get_fieldnames();
		$data = array();

		foreach ($fieldnames as $k) {

			if(empty($_POST[$k])) continue;
			
			$field = $_POST[$k];

			switch ($k) {
				case 'interceptivo_correctivo':
				preg_match('#^(interceptivo|correctivo)$#i', $field) && $data[$k] = array($field => true);
				break;
				case 'esqueletal_dentario':
				preg_match('#^(esqueletal|dentario|esqueletal_dentario)$#i', $field) && $data[$k] = array($field => true);
				break;
				case 'extracciones':
				if (is_array($field)) {
					if (reset($field) === 'si'){
						$data[$k] = array('si' => true);
						!empty($field['especificar']) && $data[$k]['especificar'] = $field['especificar'];
					}
					else{
						$data[$k] = array('no' => true);
					}
				}
				break;
				case 'anclaje_sup':
				case 'anclaje_sup':
				preg_match('#^m(inim|oderad|axim)o$#i', $field) && $data[$k] = array($field => true);
				break;
				case 'pronostico':
				preg_match('#^(reservado|(des)?favorable)$#i', $field) && $data[$k] = array($field => true);
				break;
				case 'observaciones':
				case 'objetivo_etapas':
				is_string($_POST[$k]) && $data[$k] = $_POST[$k];
				break;
			}
		}

		if (!empty($data)) {
			$Resume->update($data);
		}

		add_msg_flash('DIAGNOSTICO COMPLETO EDITADO CON EXITO.');
		redirect_exit($Resume->url());
	}
}