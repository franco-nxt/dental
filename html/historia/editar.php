<?php 
!isset($Patient , $Treatment) && redirect_exit();
$History = $Treatment->get_history();
$History->select();
?>
<div class="bar-subtitle">
	<div class="container">
		<a href="<?= $Patient->url() ?>"><?= $Patient->fullname() ?></a>
	</div>
</div>
<form method="POST">
	<div class="bar-btn">
		<div class="container">
			<button class="btn btn-success" name="action" value="save">GUARDAR</button>
			<a href="<?= $History->url() ?>" class="btn btn-default">CANCELAR</a>
		</div>
	</div>
	<div class="container p5">
		<div class="bar-bordered">
			<span><?= $Treatment->fecha_hora_inicio ?> - <?= $Treatment->estado ?> - <?= $Treatment->tecnica ?></span>
		</div>
		<div>
			<div class="col-sm-5 col-md-3 label label-read">
				<strong>TRAT. M&Eacute;DICO ACTUAL : </strong>
			</div>
			<div class="col-sm-7 col-md-9 field field-radio field-blue">
				<input type="radio" id="tratamiento_medico_<?= SI ?>" <?= checked(!empty($History->tratamiento_medico->si)) ?> value="<?= SI ?>" name="tratamiento_medico[]" onchange="seton('#tratamiento_medico_cual')"><label for="tratamiento_medico_<?= SI ?>">SI</label>
				<input type="radio" id="tratamiento_medico_<?= NO ?>" <?= checked(!empty($History->tratamiento_medico->no)) ?> value="<?= NO ?>" name="tratamiento_medico[]" onchange="setoff('#tratamiento_medico_cual')"><label for="tratamiento_medico_<?= NO ?>">NO</label>
				<label for="tratamiento_medico_cual" class="<?= empty($History->tratamiento_medico->si) ? 'disabled' : 'active' ?>">CU&Aacute;L? </label>
				<input type="text" id="tratamiento_medico_cual" value="<?= isset_get($History->tratamiento_medico->cual) ?>" name="tratamiento_medico[cual]" <?= isset_disabled($History->tratamiento_medico->si) ?>/>
			</div>
			<div class="col-sm-5 col-md-3 label label-read">
				<strong>ENFERMEDAD SIST&Eacute;MICA : </strong>
			</div>
			<div class="col-sm-7 col-md-9 field field-radio field-blue">
				<input type="radio" id="enfermedad_sistemica_<?= SI ?>" <?= checked(!empty($History->enfermedad_sistemica->si)) ?> value="<?= SI ?>" name="enfermedad_sistemica[]" onchange="seton('#enfermedad_sistemica_cual')"><label for="enfermedad_sistemica_<?= SI ?>">SI</label>
				<input type="radio" id="enfermedad_sistemica_<?= NO ?>" <?= checked(!empty($History->enfermedad_sistemica->no)) ?> value="<?= NO ?>" name="enfermedad_sistemica[]" onchange="setoff('#enfermedad_sistemica_cual')"><label for="enfermedad_sistemica_<?= NO ?>">NO</label>
				<label for="enfermedad_sistemica_cual" class="<?= empty($History->enfermedad_sistemica->si) ? 'disabled' : 'active' ?>">CU&Aacute;L? </label>
				<input type="text" id="enfermedad_sistemica_cual" value="<?= isset_get($History->enfermedad_sistemica->cual) ?>" name="enfermedad_sistemica[cual]" <?= isset_disabled($History->enfermedad_sistemica->si) ?>/>
			</div>
			<div class="col-sm-5 col-md-3 label label-read">
				<strong>MEDICACI&Oacute;N ACTUAL : </strong>
			</div>
			<div class="col-sm-7 col-md-9 field field-radio field-blue">
				<input type="radio" id="medicacion_actual_<?= SI ?>" <?= checked(!empty($History->medicacion_actual->si)) ?> value="<?= SI ?>" name="medicacion_actual[]" onchange="seton('#medicacion_actual_cual')"><label for="medicacion_actual_<?= SI ?>">SI</label>
				<input type="radio" id="medicacion_actual_<?= NO ?>" <?= checked(!empty($History->medicacion_actual->no)) ?> value="<?= NO ?>" name="medicacion_actual[]" onchange="setoff('#medicacion_actual_cual')"><label for="medicacion_actual_<?= NO ?>">NO</label>
				<label for="medicacion_actual_cual" class="<?= empty($History->medicacion_actual->si) ? 'disabled' : 'active' ?>">CU&Aacute;L? </label>
				<input type="text" id="medicacion_actual_cual" value="<?= isset_get($History->medicacion_actual->cual) ?>" name="medicacion_actual[cual]" <?= isset_disabled($History->medicacion_actual->si) ?>/>
			</div>
			<div class="col-sm-5 col-md-3 label label-read">
				<strong>TUVO HEPATITIS : </strong>
			</div>
			<div class="col-sm-7 col-md-9 field field-radio field-blue">
				<input type="radio" id="hepatitis_<?= SI ?>" <?= checked(!empty($History->hepatitis->si)) ?> value="<?= SI ?>" name="hepatitis[]" onchange="seton('#hepatitis_cual')"><label for="hepatitis_<?= SI ?>">SI</label>
				<input type="radio" id="hepatitis_<?= NO ?>" <?= checked(!empty($History->hepatitis->no)) ?> value="<?= NO ?>" name="hepatitis[]" onchange="setoff('#hepatitis_cual')"><label for="hepatitis_<?= NO ?>">NO</label>
				<label for="hepatitis_cual" class="<?= empty($History->hepatitis->si) ? 'disabled' : 'active' ?>">CU&Aacute;L? </label>
				<input type="text" id="hepatitis_cual" value="<?= isset_get($History->hepatitis->cual) ?>" name="hepatitis[cual]" <?= isset_disabled($History->hepatitis->si) ?>/>
			</div>
			<div class="col-sm-5 col-md-3 label label-read">
				<strong>HIV : </strong>
			</div>
			<div class="col-sm-7 col-md-9 field field-radio field-blue">
				<input type="radio" id="hiv_<?= SI ?>" <?= checked(!empty($History->hiv->si)) ?> value="<?= SI ?>" name="hiv[]"><label for="hiv_<?= SI ?>">SI</label>
				<input type="radio" id="hiv_<?= NO ?>" <?= checked(!empty($History->hiv->no)) ?> value="<?= NO ?>" name="hiv[]"><label for="hiv_<?= NO ?>">NO</label>
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
			<div class="col-sm-6 col-md-7 field field-radio field-blue">
				<input type="radio" id="higene_bucal_<?= BUENA ?>" <?= checked(!empty($History->higene_bucal->buena)) ?> value="<?= BUENA ?>" name="higene_bucal[]"><label for="higene_bucal_<?= BUENA ?>">BUENA</label>
				<input type="radio" id="higene_bucal_<?= REGULAR ?>" <?= checked(!empty($History->higene_bucal->regular)) ?> value="<?= REGULAR ?>" name="higene_bucal[]"><label for="higene_bucal_<?= REGULAR ?>">REGULAR</label>
				<input type="radio" id="higene_bucal_<?= MALA ?>" <?= checked(!empty($History->higene_bucal->mala)) ?> value="<?= MALA ?>" name="higene_bucal[]"><label for="higene_bucal_<?= MALA ?>">MALA</label>
			</div>
			<div class="col-sm-6 col-md-5 label label-read">
				<strong>TRAT. ANTERIOR ORTOPEDIA MAXILAR : </strong>
			</div>
			<div class="col-sm-6 col-md-7 field field-radio field-blue">
				<input type="radio" id="ortopedia_<?= SI ?>" <?= checked(!empty($History->ortopedia->si)) ?> value="<?= SI ?>" name="ortopedia[]"><label for="ortopedia_<?= SI ?>">SI</label>
				<input type="radio" id="ortopedia_<?= NO ?>" <?= checked(!empty($History->ortopedia->no)) ?> value="<?= NO ?>" name="ortopedia[]"><label for="ortopedia_<?= NO ?>">NO</label>
			</div>
			<div class="col-sm-6 col-md-5 label label-read">
				<strong>TRAT. ANTERIOR ORTODONCIA : </strong>
			</div>
			<div class="col-sm-6 col-md-7 field field-radio field-blue">
				<input type="radio" id="ortodoncia_<?= SI ?>" <?= checked(!empty($History->ortodoncia->si)) ?> value="<?= SI ?>" name="ortodoncia[]" onchang"><label for="ortodoncia_<?= SI ?>">SI</label>
				<input type="radio" id="ortodoncia_<?= NO ?>" <?= checked(!empty($History->ortodoncia->no)) ?> value="<?= NO ?>" name="ortodoncia[]"><label for="ortodoncia_<?= NO ?>">NO</label>
			</div>
			<div class="col-sm-6 col-md-5 label label-read">
				<strong>GINJIVITIS : </strong>
			</div>
			<div class="col-sm-6 col-md-7 field field-radio field-blue">
				<input type="radio" id="ginjivitis_<?= SI ?>" <?= checked(!empty($History->ginjivitis->si)) ?> value="<?= SI ?>" name="ginjivitis[]"><label for="ginjivitis_<?= SI ?>">SI</label>
				<input type="radio" id="ginjivitis_<?= NO ?>" <?= checked(!empty($History->ginjivitis->no)) ?> value="<?= NO ?>" name="ginjivitis[]"><label for="ginjivitis_<?= NO ?>">NO</label>
			</div>
			<div class="col-sm-6 col-md-5 label label-read">
				<strong>PERIODONTITIS : </strong>
			</div>
			<div class="col-sm-6 col-md-7 field field-radio field-blue">
				<input type="radio" id="periodontitis_<?= SI ?>" <?= checked(!empty($History->periodontitis->si)) ?> value="<?= SI ?>" name="periodontitis[]"><label for="periodontitis_<?= SI ?>">SI</label>
				<input type="radio" id="periodontitis_<?= NO ?>" <?= checked(!empty($History->periodontitis->no)) ?> value="<?= NO ?>" name="periodontitis[]"><label for="periodontitis_<?= NO ?>">NO</label>
			</div>
			<div class="col-sm-6 col-md-5 label label-read">
				<strong>XEROSTOM&Iacute;A(POCA SALIVA) : </strong>
			</div>
			<div class="col-sm-6 col-md-7 field field-radio field-blue">
				<input type="radio" id="xerostomia_<?= SI ?>" <?= checked(!empty($History->xerostomia->si)) ?> value="<?= SI ?>" name="xerostomia[]"><label for="xerostomia_<?= SI ?>">SI</label>
				<input type="radio" id="xerostomia_<?= NO ?>" <?= checked(!empty($History->xerostomia->no)) ?> value="<?= NO ?>" name="xerostomia[]"><label for="xerostomia_<?= NO ?>">NO</label>
			</div>
			<div class="col-sm-6 col-md-5 label label-read">
				<strong>USA PLACA PARA DORMIR : </strong>
			</div>
			<div class="col-sm-6 col-md-7 field field-radio field-blue">
				<input type="radio" id="placa_dormir_<?= SI ?>" <?= checked(!empty($History->placa_dormir->si)) ?> value="<?= SI ?>" name="placa_dormir[]"><label for="placa_dormir_<?= SI ?>">SI</label>
				<input type="radio" id="placa_dormir_<?= NO ?>" <?= checked(!empty($History->placa_dormir->no)) ?> value="<?= NO ?>" name="placa_dormir[]"><label for="placa_dormir_<?= NO ?>">NO</label>
			</div>
			<div class="col-sm-6 col-md-5 label label-read">
				<strong>RONCA CUANDO DUERME : </strong>
			</div>
			<div class="col-sm-6 col-md-7 field field-radio field-blue">
				<input type="radio" id="ronca_dormir_<?= SI ?>" <?= checked(!empty($History->ronca_dormir->si)) ?> value="<?= SI ?>" name="ronca_dormir[]"><label for="ronca_dormir_<?= SI ?>">SI</label>
				<input type="radio" id="ronca_dormir_<?= NO ?>" <?= checked(!empty($History->ronca_dormir->no)) ?> value="<?= NO ?>" name="ronca_dormir[]"><label for="ronca_dormir_<?= NO ?>">NO</label>
			</div>
			<div class="col-sm-6 col-md-5 label label-read">
				<strong>RESPIRA POR LA BOCA : </strong>
			</div>
			<div class="col-sm-6 col-md-7 field field-radio field-blue">
				<input type="radio" id="respira_boca_<?= SI ?>" <?= checked(!empty($History->respira_boca->si)) ?> value="<?= SI ?>" name="respira_boca[]"><label for="respira_boca_<?= SI ?>">SI</label>
				<input type="radio" id="respira_boca_<?= NO ?>" <?= checked(!empty($History->respira_boca->no)) ?> value="<?= NO ?>" name="respira_boca[]"><label for="respira_boca_<?= NO ?>">NO</label>
			</div>
			<div class="col-sm-6 col-md-5 label label-read">
				<strong>SE RESFRIA CON FRECUENCIA : </strong>
			</div>
			<div class="col-sm-6 col-md-7 field field-radio field-blue">
				<input type="radio" id="resfrio_frecuente_<?= SI ?>" <?= checked(!empty($History->resfrio_frecuente->si)) ?> value="<?= SI ?>" name="resfrio_frecuente[]"><label for="resfrio_frecuente_<?= SI ?>">SI</label>
				<input type="radio" id="resfrio_frecuente_<?= NO ?>" <?= checked(!empty($History->resfrio_frecuente->no)) ?> value="<?= NO ?>" name="resfrio_frecuente[]"><label for="resfrio_frecuente_<?= NO ?>">NO</label>
			</div>
			<div class="col-sm-6 col-md-5 label label-read">
				<strong>TIENE DIFICULTAD PARA MASTICAR : </strong>
			</div>
			<div class="col-sm-6 col-md-7 field field-radio field-blue">
				<input type="radio" id="dificultad_masticar_<?= SI ?>" <?= checked(!empty($History->dificultad_masticar->si)) ?> value="<?= SI ?>" name="dificultad_masticar[]"><label for="dificultad_masticar_<?= SI ?>">SI</label>
				<input type="radio" id="dificultad_masticar_<?= NO ?>" <?= checked(!empty($History->dificultad_masticar->no)) ?> value="<?= NO ?>" name="dificultad_masticar[]"><label for="dificultad_masticar_<?= NO ?>">NO</label>
			</div>
			<div class="col-sm-6 col-md-5 label label-read">
				<strong>TIENE DIFICULTAD PARA TRAGAR : </strong>
			</div>
			<div class="col-sm-6 col-md-7 field field-radio field-blue">
				<input type="radio" id="dificultad_tragar_<?= SI ?>" <?= checked(!empty($History->dificultad_tragar->si)) ?> value="<?= SI ?>" name="dificultad_tragar[]"><label for="dificultad_tragar_<?= SI ?>">SI</label>
				<input type="radio" id="dificultad_tragar_<?= NO ?>" <?= checked(!empty($History->dificultad_tragar->no)) ?> value="<?= NO ?>" name="dificultad_tragar[]"><label for="dificultad_tragar_<?= NO ?>">NO</label>
			</div>
			<div class="col-sm-6 col-md-5 label label-read">
				<strong>TUVO TRATAMIENTO FONOAUDI&Oacute;LOGICO : </strong>
			</div>
			<div class="col-sm-6 col-md-7 field field-radio field-blue">
				<input type="radio" id="fonoaudiologico_<?= SI ?>" <?= checked(!empty($History->fonoaudiologico->si)) ?> value="<?= SI ?>" name="fonoaudiologico[]"><label for="fonoaudiologico_<?= SI ?>">SI</label>
				<input type="radio" id="fonoaudiologico_<?= NO ?>" <?= checked(!empty($History->fonoaudiologico->no)) ?> value="<?= NO ?>" name="fonoaudiologico[]"><label for="fonoaudiologico_<?= NO ?>">NO</label>
			</div>
			<div class="col-sm-6 col-md-5 label label-read">
				<strong>HA ALCANZADO LA PUBERTAD : </strong>
			</div>
			<div class="col-sm-6 col-md-7 field field-radio field-blue">
				<input type="radio" id="pubertad_<?= SI ?>" <?= checked(!empty($History->pubertad->si)) ?> value="<?= SI ?>" name="pubertad[]"><label for="pubertad_<?= SI ?>">SI</label>
				<input type="radio" id="pubertad_<?= NO ?>" <?= checked(!empty($History->pubertad->no)) ?> value="<?= NO ?>" name="pubertad[]"><label for="pubertad_<?= NO ?>">NO</label>
			</div>
			<div class="col-sm-6 col-md-5 label label-read">
				<strong>DOLOR EN ARTICULACIONES MANDIBULARES : </strong>
			</div>
			<div class="col-sm-6 col-md-7 field field-radio field-blue">
				<input type="radio" id="dolor_articular_<?= SI ?>" <?= checked(!empty($History->dolor_articular->si)) ?> value="<?= SI ?>" name="dolor_articular[]"><label for="dolor_articular_<?= SI ?>">SI</label>
				<input type="radio" id="dolor_articular_<?= NO ?>" <?= checked(!empty($History->dolor_articular->no)) ?> value="<?= NO ?>" name="dolor_articular[]"><label for="dolor_articular_<?= NO ?>">NO</label>
			</div>
			<div class="col-sm-6 col-md-5 label label-read">
				<strong>RUIDO EN ARTICULACIONES MANDIBULARES : </strong>
			</div>
			<div class="col-sm-6 col-md-7 field field-radio field-blue">
				<input type="radio" id="ruido_articular_<?= SI ?>" <?= checked(!empty($History->ruido_articular->si)) ?> value="<?= SI ?>" name="ruido_articular[]"><label for="ruido_articular_<?= SI ?>">SI</label>
				<input type="radio" id="ruido_articular_<?= NO ?>" <?= checked(!empty($History->ruido_articular->no)) ?> value="<?= NO ?>" name="ruido_articular[]"><label for="ruido_articular_<?= NO ?>">NO</label>
			</div>
			<div class="col-sm-6 col-md-5 label label-read">
				<strong>TRAUMATISMO EN BOCA O MENT&Oacute;N : </strong>
			</div>
			<div class="col-sm-6 col-md-7 field field-radio field-blue">
				<input type="radio" id="traumatismo_boca_menton_<?= SI ?>" <?= checked(!empty($History->traumatismo_boca_menton->si)) ?> value="<?= SI ?>" name="traumatismo_boca_menton[]"><label for="traumatismo_boca_menton_<?= SI ?>">SI</label>
				<input type="radio" id="traumatismo_boca_menton_<?= NO ?>" <?= checked(!empty($History->traumatismo_boca_menton->no)) ?> value="<?= NO ?>" name="traumatismo_boca_menton[]"><label for="traumatismo_boca_menton_<?= NO ?>">NO</label>
			</div>
			<?php 
			$ilf_si = !empty($History->interposicion_labio_inferior->si);
			$ilf_no = !empty($History->interposicion_labio_inferior->no);
			$ilf_actual = !empty($History->interposicion_labio_inferior->si->actual);
			$ilf_pasado = !empty($History->interposicion_labio_inferior->si->pasado);
			$ilf_hasta = !empty($History->interposicion_labio_inferior->si->pasado->hasta) ? $History->interposicion_labio_inferior->si->pasado->hasta : 0;
			?>
			<div class="col-sm-4 label label-read">
				<strong>INTERPOSICI&Oacute;N LABIO INFERIOR : </strong>
			</div>
			<div class="col-sm-8 field field-radio field-blue">
				<input type="radio" id="ilf_si" value="<?= SI ?>" name="interposicion_labio_inferior[]" onchange="seton('.ilf_si-active')" <?= checked($ilf_si) ?>>
				<label for="ilf_si">SI</label>
				<input type="radio" id="ilf_no" value="<?= NO ?>" name="interposicion_labio_inferior[]" onchange="setoff('.ilf_hasta-active > *, .ilf_si-active')" <?= checked($ilf_no) ?>>
				<label for="ilf_no">NO</label>
				<input type="radio" id="ilf_actual" class="ilf_si-active" value="<?= ACTUAL ?>" name="interposicion_labio_inferior[si]" onchange="setoff('.ilf_hasta-active > *')" <?= checked($ilf_actual) ?> <?= disabled($ilf_si) ?>>
				<label for="ilf_actual" class="ilf_si-active <?= disabled($ilf_si) ?>">ACTUAL</label>
				<input type="radio" id="ilf_pasado" class="ilf_si-active" value="<?= PASADO ?>" name="interposicion_labio_inferior[si]" onchange="seton('.ilf_hasta-active > *')" <?= checked($ilf_pasado) ?> <?= disabled($ilf_si) ?>>
				<label for="ilf_pasado" class="ilf_si-active <?= disabled($ilf_si) ?>">PASADO</label>
				<div style="display:inline-block;width:170px;vertical-align:middle;" class="ilf_hasta-active">
					<select id="ilf_hasta" <?= disabled($ilf_pasado) ?> name="interposicion_labio_inferior[pasado]">
						<?php for ($c = 1;$c <= 99;$c++): ?>
							<option value="<?= $c ?>" <?= selected($ilf_hasta == $c) ?>>HASTA <?= $c == 1 ? 'EL' : 'LOS' ?> <?= $c ?> A&Ntilde;O<?= $c != 1 ? 'S' : null ?></option>
						<?php endfor ?>
					</select>
				</div>
			</div>
			<?php 
			$succiondigital_si = !empty($History->succion_digital->si);
			$succiondigital_no = !empty($History->succion_digital->no);
			$succiondigital_actual = !empty($History->succion_digital->si->actual);
			$succiondigital_pasado = !empty($History->succion_digital->si->pasado);
			$succiondigital_hasta = !empty($History->succion_digital->si->pasado->hasta) ? $History->succion_digital->si->pasado->hasta : 0;
			?>
			<div class="col-sm-4 label label-read">
				<strong>SUCCI&Oacute;N DIGITAL : </strong>
			</div>
			<div class="col-sm-8 field field-radio field-blue">
				<input type="radio" id="succiondigital_si" value="<?= SI ?>" name="succion_digital[]" onchange="seton('.succiondigital_si-active')" <?= checked($succiondigital_si) ?>>
				<label for="succiondigital_si">SI</label>
				<input type="radio" id="succiondigital_no" value="<?= NO ?>" name="succion_digital[]" onchange="setoff('.succiondigital_hasta-active > *, .succiondigital_si-active')" <?= checked($succiondigital_no) ?>>
				<label for="succiondigital_no">NO</label>
				<input type="radio" id="succiondigital_actual" class="succiondigital_si-active" value="<?= ACTUAL ?>" name="succion_digital[si]" onchange="setoff('.succiondigital_hasta-active > *')" <?= checked($succiondigital_actual) ?> <?= disabled($succiondigital_si) ?>>
				<label for="succiondigital_actual" class="succiondigital_si-active <?= disabled($succiondigital_si) ?>">ACTUAL</label>
				<input type="radio" id="succiondigital_pasado" class="succiondigital_si-active" value="<?= PASADO ?>" name="succion_digital[si]" onchange="seton('.succiondigital_hasta-active > *')" <?= checked($succiondigital_pasado) ?> <?= disabled($succiondigital_si) ?>>
				<label for="succiondigital_pasado" class="succiondigital_si-active <?= disabled($succiondigital_si) ?>">PASADO</label>
				<div style="display:inline-block;width:170px;vertical-align:middle;" class="succiondigital_hasta-active">
					<select id="succiondigital_hasta" <?= disabled($succiondigital_pasado) ?> name="succion_digital[pasado]">
						<?php for ($c = 1;$c <= 99;$c++): ?>
							<option value="<?= $c ?>" <?= selected($succiondigital_hasta == $c) ?>>HASTA <?= $c == 1 ? 'EL' : 'LOS' ?> <?= $c ?> A&Ntilde;O<?= $c != 1 ? 'S' : null ?></option>
						<?php endfor ?>
					</select>
				</div>
			</div>
			<?php 
			$bruxismo_si = !empty($History->bruxismo->si);
			$bruxismo_no = !empty($History->bruxismo->no);
			$bruxismo_actual = !empty($History->bruxismo->si->actual);
			$bruxismo_pasado = !empty($History->bruxismo->si->pasado);
			$bruxismo_hasta = !empty($History->bruxismo->si->pasado->hasta) ? $History->bruxismo->si->pasado->hasta : 0;
			?>
			<div class="col-sm-4 label label-read">
				<strong>BRUXISMO : </strong>
			</div>
			<div class="col-sm-8 field field-radio field-blue">
				<input type="radio" id="bruxismo_si" value="<?= SI ?>" name="bruxismo[]" onchange="seton('.bruxismo_si-active')" <?= checked($bruxismo_si) ?>>
				<label for="bruxismo_si">SI</label>
				<input type="radio" id="bruxismo_no" value="<?= NO ?>" name="bruxismo[]" onchange="setoff('.bruxismo_hasta-active > *,.bruxismo_si-active')" <?= checked($bruxismo_no) ?>>
				<label for="bruxismo_no">NO</label>
				<input type="radio" id="bruxismo_actual" class="bruxismo_si-active" value="<?= ACTUAL ?>" name="bruxismo[si]" onchange="setoff('.bruxismo_hasta-active > *')" <?= checked($bruxismo_actual) ?> <?= disabled($bruxismo_si) ?>>
				<label for="bruxismo_actual" class="bruxismo_si-active <?= disabled($bruxismo_si) ?>">ACTUAL</label>
				<input type="radio" id="bruxismo_pasado" class="bruxismo_si-active" value="<?= PASADO ?>" name="bruxismo[si]" onchange="seton('.bruxismo_hasta-active > *')" <?= checked($bruxismo_pasado) ?> <?= disabled($bruxismo_si) ?>>
				<label for="bruxismo_pasado" class="bruxismo_si-active <?= disabled($bruxismo_si) ?>">PASADO</label>
				<div style="display:inline-block;width:170px;vertical-align:middle;" class="bruxismo_hasta-active">
					<select id="bruxismo_hasta" <?= disabled($bruxismo_pasado) ?> name="bruxismo[pasado]">
						<?php for ($c = 1;$c <= 99;$c++): ?>
							<option value="<?= $c ?>" <?= selected($bruxismo_hasta == $c) ?>>HASTA <?= $c == 1 ? 'EL' : 'LOS' ?> <?= $c ?> A&Ntilde;O<?= $c != 1 ? 'S' : null ?></option>
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
