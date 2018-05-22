<div class="bar-subtitle">
	<div class="container">
		<a href="<?= $Patient->url() ?>"><?= $Patient->fullname() ?></a>
	</div>
</div>
<form method="POST" id="app">
	<div class="bar-btn">
		<div class="container">
			<button class="btn btn-success" name="action" value="save">GUARDAR</button>
			<a href="<?= $History->url() ?>" class="btn btn-default">CANCELAR</a>
		</div>
	</div>
	<div class="container p5">
		<div class="bar-bordered">
			<span><?= $Treatment->resume() ?></span>
		</div>
		<div>
			<div class="col-sm-5 col-md-3 label label-read">
				<strong>TRAT. M&Eacute;DICO ACTUAL : </strong>
			</div>
			<div class="col-sm-7 col-md-9 field field-blue" data-check-one>
				<input class="radio-input" type="checkbox" id="htm_si" value="<?= SI ?>" name="tratamiento_medico[]" data-enable-text="#htm_cual" <?= checked(!empty($History->tratamiento_medico->si)) ?>>
				<label class="radio-label" for="htm_si">SI</label>
				<input class="radio-input" type="checkbox" id="htm_no" value="<?= NO ?>" name="tratamiento_medico[]" data-disable-text="#htm_cual" <?= checked(!empty($History->tratamiento_medico->no)) ?>>
				<label class="radio-label" for="htm_no">NO</label>
				<label for="htm_cual" class="text-label <?= empty($History->tratamiento_medico->si) ? 'disabled' : 'active' ?>">CU&Aacute;L? </label>
				<input class="text-input" type="text" id="htm_cual" value="<?= isset_get($History->tratamiento_medico->cual) ?>" name="tratamiento_medico[cual]" <?= isset_disabled($History->tratamiento_medico->si) ?>/>
			</div>
			<div class="col-sm-5 col-md-3 label label-read">
				<strong>ENFERMEDAD SIST&Eacute;MICA : </strong>
			</div>
			<div class="col-sm-7 col-md-9 field field-blue" data-check-one>
				<input class="radio-input" type="checkbox" id="hes_si" value="<?= SI ?>" name="enfermedad_sistemica[]" data-enable-text="#hes_cual" <?= checked(!empty($History->enfermedad_sistemica->si)) ?>>
				<label class="radio-label" for="hes_si">SI</label>
				<input class="radio-input" type="checkbox" id="hes_no" value="<?= NO ?>" name="enfermedad_sistemica[]" data-disable-text="#hes_cual" <?= checked(!empty($History->enfermedad_sistemica->no)) ?>>
				<label class="radio-label" for="hes_no">NO</label>
				<label for="hes_cual" class="text-label <?= empty($History->enfermedad_sistemica->si) ? 'disabled' : 'active' ?>">CU&Aacute;L? </label>
				<input type="text" id="hes_cual" value="<?= isset_get($History->enfermedad_sistemica->cual) ?>" name="enfermedad_sistemica[cual]" <?= isset_disabled($History->enfermedad_sistemica->si) ?>/>
			</div>
			<div class="col-sm-5 col-md-3 label label-read">
				<strong>MEDICACI&Oacute;N ACTUAL : </strong>
			</div>
			<div class="col-sm-7 col-md-9 field field-blue" data-check-one>
				<input class="radio-input" type="checkbox" id="hma_si" value="<?= SI ?>" name="medicacion_actual[]" data-enable-text="#hma_cual" <?= checked(!empty($History->medicacion_actual->si)) ?>>
				<label class="radio-label" for="hma_si">SI</label>
				<input class="radio-input" type="checkbox" id="hma_no" value="<?= NO ?>" name="medicacion_actual[]" data-disable-text="#hma_cual" <?= checked(!empty($History->medicacion_actual->no)) ?>>
				<label class="radio-label" for="hma_no">NO</label>
				<label for="hma_cual" class="text-label <?= empty($History->medicacion_actual->si) ? 'disabled' : 'active' ?>">CU&Aacute;L? </label>
				<input type="text" id="hma_cual" value="<?= isset_get($History->medicacion_actual->cual) ?>" name="medicacion_actual[cual]" <?= isset_disabled($History->medicacion_actual->si) ?>/>
			</div>
			<div class="col-sm-5 col-md-3 label label-read">
				<strong>TUVO HEPATITIS : </strong>
			</div>
			<div class="col-sm-7 col-md-9 field field-blue" data-check-one>
				<input class="radio-input" type="checkbox" id="hh_si" value="<?= SI ?>" name="hepatitis[]" data-enable-text="#hh_cual" <?= checked(!empty($History->hepatitis->si)) ?>>
				<label class="radio-label" for="hh_si">SI</label>
				<input class="radio-input" type="checkbox" id="hh_no" value="<?= NO ?>" name="hepatitis[]" data-disable-text="#hh_cual" <?= checked(!empty($History->hepatitis->no)) ?>>
				<label class="radio-label" for="hh_no">NO</label>
				<label for="hh_cual" class="text-label <?= empty($History->hepatitis->si) ? 'disabled' : 'active' ?>">CU&Aacute;L? </label>
				<input type="text" id="hh_cual" value="<?= isset_get($History->hepatitis->cual) ?>" name="hepatitis[cual]" <?= isset_disabled($History->hepatitis->si) ?>/>
			</div>
			<div class="col-sm-5 col-md-3 label label-read">
				<strong>HIV : </strong>
			</div>
			<div class="col-sm-7 col-md-9 field field-blue" data-check-one>
				<input class="radio-input" type="checkbox" id="hhiv_si" value="<?= SI ?>" name="hiv[]" <?= checked(!empty($History->hiv->si)) ?>>
				<label class="radio-label" for="hhiv_si">SI</label>
				<input class="radio-input" type="checkbox" id="hhiv_no" value="<?= NO ?>" name="hiv[]" <?= checked(!empty($History->hiv->no)) ?>>
				<label class="radio-label" for="hhiv_no">NO</label>
			</div>
			<label for="medicos_observaciones" class="clear form-group">
				<div class="col-sm-12 label">
					<strong>OBVSERVACIONES : </strong>
				</div>
				<div class="col-sm-12 field field-blue">
					<textarea name="medicos_observaciones" id="medicos_observaciones"><?= $History->medicos_observaciones ?></textarea>
				</div>
			</label>
			<div class="col-sm-6 col-md-5 label label-read">
				<strong>HIGIENE BUCAL : </strong>
			</div>
			<div class="col-sm-6 col-md-7 field field-blue" data-check-one>
				<input class="radio-input" type="checkbox" id="hhb_buena" value="<?= BUENA ?>" name="higene_bucal[]"" <?= checked(!empty($History->higene_bucal->buena)) ?>>
				<label class="radio-label" for="hhb_buena">BUENA</label>
				<input class="radio-input" type="checkbox" id="hhb_regular" value="<?= REGULAR ?>" name="higene_bucal[]"" <?= checked(!empty($History->higene_bucal->regular)) ?>>
				<label class="radio-label" for="hhb_regular">REGULAR</label>
				<input class="radio-input" type="checkbox" id="hhb_mala" value="<?= MALA ?>" name="higene_bucal[]"" <?= checked(!empty($History->higene_bucal->mala)) ?>>
				<label class="radio-label" for="hhb_mala">MALA</label>
			</div>
			<div class="col-sm-6 col-md-5 label label-read">
				<strong>TRAT. ANTERIOR ORTOPEDIA MAXILAR : </strong>
			</div>
			<div class="col-sm-6 col-md-7 field field-blue" data-check-one>
				<input class="radio-input" type="checkbox" id="ortopedia_si" value="<?= SI ?>" name="ortopedia[]" <?= checked(!empty($History->ortopedia->si)) ?>>
				<label class="radio-label" for="ortopedia_si">SI</label>
				<input class="radio-input" type="checkbox" id="ortopedia_no" value="<?= NO ?>" name="ortopedia[]" <?= checked(!empty($History->ortopedia->no)) ?>>
				<label class="radio-label" for="ortopedia_no">NO</label>
			</div>
			<div class="col-sm-6 col-md-5 label label-read">
				<strong>TRAT. ANTERIOR ORTODONCIA : </strong>
			</div>
			<div class="col-sm-6 col-md-7 field field-blue" data-check-one>
				<input class="radio-input" type="checkbox" id="ortodoncia_si" value="<?= SI ?>" name="ortodoncia[]" <?= checked(!empty($History->ortodoncia->si)) ?>>
				<label class="radio-label" for="ortodoncia_si">SI</label>
				<input class="radio-input" type="checkbox" id="ortodoncia_no" value="<?= NO ?>" name="ortodoncia[]" <?= checked(!empty($History->ortodoncia->no)) ?>>
				<label class="radio-label" for="ortodoncia_no">NO</label>
			</div>
			<div class="col-sm-6 col-md-5 label label-read">
				<strong>GINJIVITIS : </strong>
			</div>
			<div class="col-sm-6 col-md-7 field field-blue" data-check-one>
				<input class="radio-input" type="checkbox" id="ginjivitis_si" value="<?= SI ?>" name="ginjivitis[]" <?= checked(!empty($History->ginjivitis->si)) ?>>
				<label class="radio-label" for="ginjivitis_si">SI</label>
				<input class="radio-input" type="checkbox" id="ginjivitis_no" value="<?= NO ?>" name="ginjivitis[]" <?= checked(!empty($History->ginjivitis->no)) ?>>
				<label class="radio-label" for="ginjivitis_no">NO</label>
			</div>
			<div class="col-sm-6 col-md-5 label label-read">
				<strong>PERIODONTITIS : </strong>
			</div>
			<div class="col-sm-6 col-md-7 field field-blue" data-check-one>
				<input class="radio-input" type="checkbox" id="periodontitis_si" value="<?= SI ?>" name="periodontitis[]" <?= checked(!empty($History->periodontitis->si)) ?>>
				<label class="radio-label" for="periodontitis_si">SI</label>
				<input class="radio-input" type="checkbox" id="periodontitis_no" value="<?= NO ?>" name="periodontitis[]" <?= checked(!empty($History->periodontitis->no)) ?>>
				<label class="radio-label" for="periodontitis_no">NO</label>
			</div>
			<div class="col-sm-6 col-md-5 label label-read">
				<strong>XEROSTOM&Iacute;A(POCA SALIVA) : </strong>
			</div>
			<div class="col-sm-6 col-md-7 field field-blue" data-check-one>
				<input class="radio-input" type="checkbox" id="xerostomia_si" value="<?= SI ?>" name="xerostomia[]" <?= checked(!empty($History->xerostomia->si)) ?>>
				<label class="radio-label" for="xerostomia_si">SI</label>
				<input class="radio-input" type="checkbox" id="xerostomia_no" value="<?= NO ?>" name="xerostomia[]" <?= checked(!empty($History->xerostomia->no)) ?>>
				<label class="radio-label" for="xerostomia_no">NO</label>
			</div>
			<div class="col-sm-6 col-md-5 label label-read">
				<strong>USA PLACA PARA DORMIR : </strong>
			</div>
			<div class="col-sm-6 col-md-7 field field-blue" data-check-one>
				<input class="radio-input" type="checkbox" id="placa_dormir_si" value="<?= SI ?>" name="placa_dormir[]" <?= checked(!empty($History->placa_dormir->si)) ?>>
				<label class="radio-label" for="placa_dormir_si">SI</label>
				<input class="radio-input" type="checkbox" id="placa_dormir_no" value="<?= NO ?>" name="placa_dormir[]" <?= checked(!empty($History->placa_dormir->no)) ?>>
				<label class="radio-label" for="placa_dormir_no">NO</label>
			</div>
			<div class="col-sm-6 col-md-5 label label-read">
				<strong>RONCA CUANDO DUERME : </strong>
			</div>
			<div class="col-sm-6 col-md-7 field field-blue" data-check-one>
				<input class="radio-input" type="checkbox" id="ronca_dormir_si" value="<?= SI ?>" name="ronca_dormir[]" <?= checked(!empty($History->ronca_dormir->si)) ?>>
				<label class="radio-label" for="ronca_dormir_si">SI</label>
				<input class="radio-input" type="checkbox" id="ronca_dormir_no" value="<?= NO ?>" name="ronca_dormir[]" <?= checked(!empty($History->ronca_dormir->no)) ?>>
				<label class="radio-label" for="ronca_dormir_no">NO</label>
			</div>
			<div class="col-sm-6 col-md-5 label label-read">
				<strong>RESPIRA POR LA BOCA : </strong>
			</div>
			<div class="col-sm-6 col-md-7 field field-blue" data-check-one>
				<input class="radio-input" type="checkbox" id="respira_boca_si" value="<?= SI ?>" name="respira_boca[]" <?= checked(!empty($History->respira_boca->si)) ?>>
				<label class="radio-label" for="respira_boca_si">SI</label>
				<input class="radio-input" type="checkbox" id="respira_boca_no" value="<?= NO ?>" name="respira_boca[]" <?= checked(!empty($History->respira_boca->no)) ?>>
				<label class="radio-label" for="respira_boca_no">NO</label>
			</div>
			<div class="col-sm-6 col-md-5 label label-read">
				<strong>SE RESFRIA CON FRECUENCIA : </strong>
			</div>
			<div class="col-sm-6 col-md-7 field field-blue" data-check-one>
				<input class="radio-input" type="checkbox" id="resfrio_frecuente_si" value="<?= SI ?>" name="resfrio_frecuente[]" <?= checked(!empty($History->resfrio_frecuente->si)) ?>>
				<label class="radio-label" for="resfrio_frecuente_si">SI</label>
				<input class="radio-input" type="checkbox" id="resfrio_frecuente_no" value="<?= NO ?>" name="resfrio_frecuente[]" <?= checked(!empty($History->resfrio_frecuente->no)) ?>>
				<label class="radio-label" for="resfrio_frecuente_no">NO</label>
			</div>
			<div class="col-sm-6 col-md-5 label label-read">
				<strong>TIENE DIFICULTAD PARA MASTICAR : </strong>
			</div>
			<div class="col-sm-6 col-md-7 field field-blue" data-check-one>
				<input class="radio-input" type="checkbox" id="dificultad_masticar_si" value="<?= SI ?>" name="dificultad_masticar[]" <?= checked(!empty($History->dificultad_masticar->si)) ?>>
				<label class="radio-label" for="dificultad_masticar_si">SI</label>
				<input class="radio-input" type="checkbox" id="dificultad_masticar_no" value="<?= NO ?>" name="dificultad_masticar[]" <?= checked(!empty($History->dificultad_masticar->no)) ?>>
				<label class="radio-label" for="dificultad_masticar_no">NO</label>
			</div>
			<div class="col-sm-6 col-md-5 label label-read">
				<strong>TIENE DIFICULTAD PARA TRAGAR : </strong>
			</div>
			<div class="col-sm-6 col-md-7 field field-blue" data-check-one>
				<input class="radio-input" type="checkbox" id="dificultad_tragar_si" value="<?= SI ?>" name="dificultad_tragar[]" <?= checked(!empty($History->dificultad_tragar->si)) ?>>
				<label class="radio-label" for="dificultad_tragar_si">SI</label>
				<input class="radio-input" type="checkbox" id="dificultad_tragar_no" value="<?= NO ?>" name="dificultad_tragar[]" <?= checked(!empty($History->dificultad_tragar->no)) ?>>
				<label class="radio-label" for="dificultad_tragar_no">NO</label>
			</div>
			<div class="col-sm-6 col-md-5 label label-read">
				<strong>TUVO TRATAMIENTO FONOAUDI&Oacute;LOGICO : </strong>
			</div>
			<div class="col-sm-6 col-md-7 field field-blue" data-check-one>
				<input class="radio-input" type="checkbox" id="fonoaudiologico_si" value="<?= SI ?>" name="fonoaudiologico[]" <?= checked(!empty($History->fonoaudiologico->si)) ?>>
				<label class="radio-label" for="fonoaudiologico_si">SI</label>
				<input class="radio-input" type="checkbox" id="fonoaudiologico_no" value="<?= NO ?>" name="fonoaudiologico[]" <?= checked(!empty($History->fonoaudiologico->no)) ?>>
				<label class="radio-label" for="fonoaudiologico_no">NO</label>
			</div>
			<div class="col-sm-6 col-md-5 label label-read">
				<strong>HA ALCANZADO LA PUBERTAD : </strong>
			</div>
			<div class="col-sm-6 col-md-7 field field-blue" data-check-one>
				<input class="radio-input" type="checkbox" id="pubertad_si" value="<?= SI ?>" name="pubertad[]" <?= checked(!empty($History->pubertad->si)) ?>>
				<label class="radio-label" for="pubertad_si">SI</label>
				<input class="radio-input" type="checkbox" id="pubertad_no" value="<?= NO ?>" name="pubertad[]" <?= checked(!empty($History->pubertad->no)) ?>>
				<label class="radio-label" for="pubertad_no">NO</label>
			</div>
			<div class="col-sm-6 col-md-5 label label-read">
				<strong>DOLOR EN ARTICULACIONES MANDIBULARES : </strong>
			</div>
			<div class="col-sm-6 col-md-7 field field-blue" data-check-one>
				<input class="radio-input" type="checkbox" id="dolor_articular_si" value="<?= SI ?>" name="dolor_articular[]" <?= checked(!empty($History->dolor_articular->si)) ?>>
				<label class="radio-label" for="dolor_articular_si">SI</label>
				<input class="radio-input" type="checkbox" id="dolor_articular_no" value="<?= NO ?>" name="dolor_articular[]" <?= checked(!empty($History->dolor_articular->no)) ?>>
				<label class="radio-label" for="dolor_articular_no">NO</label>
			</div>
			<div class="col-sm-6 col-md-5 label label-read">
				<strong>RUIDO EN ARTICULACIONES MANDIBULARES : </strong>
			</div>
			<div class="col-sm-6 col-md-7 field field-blue" data-check-one>
				<input class="radio-input" type="checkbox" id="ruido_articular_si" value="<?= SI ?>" name="ruido_articular[]" <?= checked(!empty($History->ruido_articular->si)) ?>>
				<label class="radio-label" for="ruido_articular_si">SI</label>
				<input class="radio-input" type="checkbox" id="ruido_articular_no" value="<?= NO ?>" name="ruido_articular[]" <?= checked(!empty($History->ruido_articular->no)) ?>>
				<label class="radio-label" for="ruido_articular_no">NO</label>
			</div>
			<div class="col-sm-6 col-md-5 label label-read">
				<strong>TRAUMATISMO EN BOCA O MENT&Oacute;N : </strong>
			</div>
			<div class="col-sm-6 col-md-7 field field-blue" data-check-one>
				<input class="radio-input" type="checkbox" id="traumatismo_boca_menton_si" value="<?= SI ?>" name="traumatismo_boca_menton[]" <?= checked(!empty($History->traumatismo_boca_menton->si)) ?>>
				<label class="radio-label" for="traumatismo_boca_menton_si">SI</label>
				<input class="radio-input" type="checkbox" id="traumatismo_boca_menton_no" value="<?= NO ?>" name="traumatismo_boca_menton[]" <?= checked(!empty($History->traumatismo_boca_menton->no)) ?>>
				<label class="radio-label" for="traumatismo_boca_menton_no">NO</label>
			</div>
			<?php 
			$name = 'interposicion_labio_inferior';
			$input = new StdClass;
			$input->si = !empty($History->interposicion_labio_inferior->si);
			$input->no = !empty($History->interposicion_labio_inferior->no);
			$input->actual = !empty($History->interposicion_labio_inferior->si->actual);
			$input->pasado = !empty($History->interposicion_labio_inferior->si->pasado);
			$input->hasta = !empty($History->interposicion_labio_inferior->si->pasado->hasta) ? $History->interposicion_labio_inferior->si->pasado->hasta : 0;

			$ids = str_replace("\"" , "'", json_encode(array('si' => "#{$name}_si", 'no' => "#{$name}_no", 'actual' => "#{$name}_actual", 'pasado' => "#{$name}_pasado",'hasta' => "#{$name}_hasta")));
			$edad = $Patient->edad();
			$edad = $edad == 0 ? 99 : $edad;
			?>
			<div class="col-sm-4 label label-read">
				<strong>INTERPOSICI&Oacute;N LABIO INFERIOR : </strong>
			</div>
			<div class="col-sm-8 field field-blue">
				<input class="radio-input" type="checkbox" id="<?= $name ?>_si" value="<?= SI ?>" name="<?= $name ?>[]" onchange="change_si.call(this,<?= $ids ?>)" <?= checked($input->si) ?>>
				<label class="radio-label" for="<?= $name ?>_si">SI</label>
				<input class="radio-input" type="checkbox" id="<?= $name ?>_no" value="<?= NO ?>" name="<?= $name ?>[]" onchange="change_no.call(this,<?= $ids ?>)" <?= checked($input->no) ?>>
				<label class="radio-label" for="<?= $name ?>_no">NO</label>
				<input class="radio-input" type="checkbox" id="<?= $name ?>_actual" value="<?= ACTUAL ?>" name="<?= $name ?>[si]" onchange="change_actual.call(this,<?= $ids ?>)" <?= checked($input->actual) ?> <?= disabled($input->si) ?>>
				<label class="radio-label <?= disabled($input->si) ?>" for="<?= $name ?>_actual">ACTUAL</label>
				<input class="radio-input" type="checkbox" id="<?= $name ?>_pasado" value="<?= PASADO ?>" name="<?= $name ?>[si]" onchange="change_pasado.call(this,<?= $ids ?>)" <?= checked($input->pasado) ?> <?= disabled($input->si) ?>>
				<label class="radio-label <?= disabled($input->si) ?>" for="<?= $name ?>_pasado">PASADO</label>
				<div class="select-inline">
					<select id="<?= $name ?>_hasta" <?= disabled($input->pasado) ?> name="<?= $name ?>[pasado]">
						<?php for ($c = 1;$c <= $edad; $c++): ?>
							<option value="<?= $c ?>" <?= selected($input->hasta == $c) ?>>HASTA <?= $c == 1 ? 'EL' : 'LOS' ?> <?= $c ?> A&Ntilde;O<?= $c != 1 ? 'S' : null ?></option>
						<?php endfor ?>
					</select>
				</div>
			</div>
			<?php
			$name = 'succiondigital';
			$input = new StdClass;
			$input->si = !empty($History->succion_digital->si);
			$input->no = !empty($History->succion_digital->no);
			$input->actual = !empty($History->succion_digital->si->actual);
			$input->pasado = !empty($History->succion_digital->si->pasado);
			$input->hasta = !empty($History->succion_digital->si->pasado->hasta) ? $History->succion_digital->si->pasado->hasta : 0;
			$ids = str_replace("\"" , "'", json_encode(array('si' => "#{$name}_si", 'no' => "#{$name}_no", 'actual' => "#{$name}_actual", 'pasado' => "#{$name}_pasado",'hasta' => "#{$name}_hasta")));
			?>
			<div class="col-sm-4 label label-read">
				<strong>SUCCI&Oacute;N DIGITAL : </strong>
			</div>
			<div class="col-sm-8 field field-blue">
				<input class="radio-input" type="checkbox" id="<?= $name ?>_si" value="<?= SI ?>" name="<?= $name ?>[]" onchange="change_si.call(this,<?= $ids ?>)" <?= checked($input->si) ?>>
				<label class="radio-label" for="<?= $name ?>_si">SI</label>
				<input class="radio-input" type="checkbox" id="<?= $name ?>_no" value="<?= NO ?>" name="<?= $name ?>[]" onchange="change_no.call(this,<?= $ids ?>)" <?= checked($input->no) ?>>
				<label class="radio-label" for="<?= $name ?>_no">NO</label>
				<input class="radio-input" type="checkbox" id="<?= $name ?>_actual" value="<?= ACTUAL ?>" name="<?= $name ?>[si]" onchange="change_actual.call(this,<?= $ids ?>)" <?= checked($input->actual) ?> <?= disabled($input->si) ?>>
				<label class="radio-label <?= disabled($input->si) ?>" for="<?= $name ?>_actual">ACTUAL</label>
				<input class="radio-input" type="checkbox" id="<?= $name ?>_pasado" value="<?= PASADO ?>" name="<?= $name ?>[si]" onchange="change_pasado.call(this,<?= $ids ?>)" <?= checked($input->pasado) ?> <?= disabled($input->si) ?>>
				<label class="radio-label <?= disabled($input->si) ?>" for="<?= $name ?>_pasado">PASADO</label>
				<div class="select-inline">
					<select id="<?= $name ?>_hasta" <?= disabled($input->pasado) ?> name="<?= $name ?>[pasado]">
						<?php for ($c = 1;$c <= $edad; $c++): ?>
							<option value="<?= $c ?>" <?= selected($input->hasta == $c) ?>>HASTA <?= $c == 1 ? 'EL' : 'LOS' ?> <?= $c ?> A&Ntilde;O<?= $c != 1 ? 'S' : null ?></option>
						<?php endfor ?>
					</select>
				</div>
			</div>
			<?php 
			$name = 'bruxismo';
			$input = new StdClass;
			$input->si = !empty($History->bruxismo->si);
			$input->no = !empty($History->bruxismo->no);
			$input->actual = !empty($History->bruxismo->si->actual);
			$input->pasado = !empty($History->bruxismo->si->pasado);
			$input->hasta = !empty($History->bruxismo->si->pasado->hasta) ? $History->bruxismo->si->pasado->hasta : 0;
			$ids = str_replace("\"" , "'", json_encode(array('si' => "#{$name}_si", 'no' => "#{$name}_no", 'actual' => "#{$name}_actual", 'pasado' => "#{$name}_pasado",'hasta' => "#{$name}_hasta")));
			?>
			<div class="col-sm-4 label label-read">
				<strong>BRUXISMO : </strong>
			</div>
			<div class="col-sm-8 field field-blue" data-change="<?= $ids ?>">
				<input class="radio-input" type="checkbox" id="<?= $name ?>_si" value="<?= SI ?>" name="<?= $name ?>[]" onchange="change_si.call(this,<?= $ids ?>)" <?= checked($input->si) ?>>
				<label class="radio-label" for="<?= $name ?>_si">SI</label>
				<input class="radio-input" type="checkbox" id="<?= $name ?>_no" value="<?= NO ?>" name="<?= $name ?>[]" onchange="change_no.call(this,<?= $ids ?>)" <?= checked($input->no) ?>>
				<label class="radio-label" for="<?= $name ?>_no">NO</label>
				<input class="radio-input" type="checkbox" id="<?= $name ?>_actual" value="<?= ACTUAL ?>" name="<?= $name ?>[si]" onchange="change_actual.call(this,<?= $ids ?>)" <?= checked($input->actual) ?> <?= disabled($input->si) ?>>
				<label class="radio-label <?= disabled($input->si) ?>" for="<?= $name ?>_actual">ACTUAL</label>
				<input class="radio-input" type="checkbox" id="<?= $name ?>_pasado" value="<?= PASADO ?>" name="<?= $name ?>[si]" onchange="change_pasado.call(this,<?= $ids ?>)" <?= checked($input->pasado) ?> <?= disabled($input->si) ?>>
				<label class="radio-label <?= disabled($input->si) ?>" for="<?= $name ?>_pasado">PASADO</label>
				<div class="select-inline">
					<select id="<?= $name ?>_hasta" <?= disabled($input->pasado) ?> name="<?= $name ?>[pasado]">
						<?php for ($c = 1;$c <= $edad; $c++): ?>
							<option value="<?= $c ?>" <?= selected($input->hasta == $c) ?>>HASTA <?= $c == 1 ? 'EL' : 'LOS' ?> <?= $c ?> A&Ntilde;O<?= $c != 1 ? 'S' : null ?></option>
						<?php endfor ?>
					</select>
				</div>
			</div>
			<label for="odontologicos_observaciones" class="clear form-group">
				<div class="col-sm-12 label">
					<strong>OBVSERVACIONES : </strong>
				</div>
				<div class="col-sm-12 field field-blue">
					<textarea name="odontologicos_observaciones" id="odontologicos_observaciones"><?= $History->odontologicos_observaciones ?></textarea>
				</div>
			</label>
		</div>
	</div>
</form>
