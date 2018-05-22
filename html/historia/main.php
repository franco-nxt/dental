<div class="bar-subtitle">
	<div class="container">
		<a href="<?= $Patient->url() ?>"><?= $Patient->fullname() ?></a>
	</div>
</div>
<div class="bar-btn">
	<div class="container">
		<a href="<?= $History->url('editar') ?>" class="btn btn-primary">EDITAR</a>
	</div>
</div>
<div class="container p5">
	<div class="bar-bordered">
		<span><?= $Treatment->fecha_hora_inicio ?> - <?= $Treatment->estado ?> - <?= $Treatment->tecnica ?> - <?= $Treatment->descripcion ?></span>
	</div>
	<div>
		<div class="col-sm-4 label label-read">
			<strong>TRATAMIENTO M&Eacute;DICO ACTUAL : </strong>
		</div>
		<div class="col-sm-8 field field-read field-blue">
			<span class="radio-label <?= checked_if($History->tratamiento_medico->si) ?>">SI</span>
			<span class="radio-label <?= checked_if($History->tratamiento_medico->no) ?>">NO</span>
			<?php if (!empty($History->tratamiento_medico->si)): ?>
			<strong>CU&Aacute;L? </strong><span><?= get_if($History->tratamiento_medico->cual) ?></span>
			<?php endif ?>
		</div>
		<div class="col-sm-4 label label-read">
			<strong>ENFERMEDAD SIST&Eacute;MICA : </strong>
		</div>
		<div class="col-sm-8 field field-read field-blue">
			<span class="radio-label <?= checked_if($History->enfermedad_sistemica->si) ?>">SI</span>
			<span class="radio-label <?= checked_if($History->enfermedad_sistemica->no) ?>">NO</span>
			<?php if (!empty($History->enfermedad_sistemica->si)): ?>
			<strong>CU&Aacute;L? </strong><span><?= get_if($History->enfermedad_sistemica->si) ?></span>
			<?php endif ?>
		</div>
		<div class="col-sm-4 label label-read">
			<strong>MEDICACI&Oacute;N ACTUAL : </strong>
		</div>
		<div class="col-sm-8 field field-read field-blue">
			<span class="radio-label <?= checked_if($History->medicacion_actual->si) ?>">SI</span>
			<span class="radio-label <?= checked_if($History->medicacion_actual->no) ?>">NO</span>
			<?php if (!empty($History->medicacion_actual->si)): ?>
			<strong>CU&Aacute;L? </strong><span><?= get_if($History->medicacion_actual->si) ?></span>
			<?php endif ?>
		</div>
		<div class="col-sm-4 label label-read">
			<strong>TUVO HEPATITIS : </strong>
		</div>
		<div class="col-sm-8 field field-read field-blue">
			<span class="radio-label <?= checked_if($History->hepatitis->si) ?>">SI</span>
			<span class="radio-label <?= checked_if($History->hepatitis->no) ?>">NO</span>
			<?php if (!empty($History->hepatitis->si)): ?>
			<strong>CU&Aacute;L? </strong><span><?= get_if($History->hepatitis->si) ?></span>
			<?php endif ?>
		</div>
		<div class="col-sm-4 label label-read">
			<strong>HIV : </strong>
		</div>
		<div class="col-sm-8 field field-read field-blue">
			<span class="radio-label <?= checked_if($History->hiv->si) ?>">SI</span>
			<span class="radio-label <?= checked_if($History->hiv->no) ?>">NO</span>
		</div>
		<div class="col-sm-4 label label-read">
			<strong>OBVSERVACIONES : </strong>
		</div>
		<div class="col-sm-8 field field-read field-blue">
			<span><?= $History->medicos_observaciones ?> </span>
		</div>
		<div class="col-sm-4 label label-read">
			<strong>HIGIENE BUCAL : </strong>
		</div>
		<div class="col-sm-8 field field-read field-blue">
			<span class="radio-label <?= checked_if($History->higene_bucal->buena) ?>">BUENA</span>
			<span class="radio-label <?= checked_if($History->higene_bucal->regular) ?>">REGULAR</span>
			<span class="radio-label <?= checked_if($History->higene_bucal->mala) ?>">MALA</span>
		</div>
		<div class="col-sm-4 label label-read">
			<strong>TRAT. ANTERIOR ORTOPEDIA MAXILAR : </strong>
		</div>
		<div class="col-sm-8 field field-read field-blue">
			<span class="radio-label <?= checked_if($History->ortopedia->si) ?>">SI</span>
			<span class="radio-label <?= checked_if($History->ortopedia->no) ?>">NO</span>
		</div>
		<div class="col-sm-4 label label-read">
			<strong>TRAT. ANTERIOR ORTODONCIA : </strong>
		</div>
		<div class="col-sm-8 field field-read field-blue">
			<span class="radio-label <?= checked_if($History->ortodoncia->si) ?>">SI</span>
			<span class="radio-label <?= checked_if($History->ortodoncia->no) ?>">NO</span>
		</div>
		<div class="col-sm-4 label label-read">
			<strong>GINJIVITIS : </strong>
		</div>
		<div class="col-sm-8 field field-read field-blue">
			<span class="radio-label <?= checked_if($History->ginjivitis->si) ?>">SI</span>
			<span class="radio-label <?= checked_if($History->ginjivitis->no) ?>">NO</span>
		</div>
		<div class="col-sm-4 label label-read">
			<strong>PERIODONTITIS : </strong>
		</div>
		<div class="col-sm-8 field field-read field-blue">
			<span class="radio-label <?= checked_if($History->periodontitis->si) ?>">SI</span>
			<span class="radio-label <?= checked_if($History->periodontitis->no) ?>">NO</span>
		</div>
		<div class="col-sm-4 label label-read">
			<strong>XEROSTOM&Iacute;A(POCA SALIVA) : </strong>
		</div>
		<div class="col-sm-8 field field-read field-blue">
			<span class="radio-label <?= checked_if($History->xerostomia->si) ?>">SI</span>
			<span class="radio-label <?= checked_if($History->xerostomia->no) ?>">NO</span>
		</div>
		<div class="col-sm-4 label label-read">
			<strong>USA PLACA PARA DORMIR : </strong>
		</div>
		<div class="col-sm-8 field field-read field-blue">
			<span class="radio-label <?= checked_if($History->placa_dormir->si) ?>">SI</span>
			<span class="radio-label <?= checked_if($History->placa_dormir->no) ?>">NO</span>
		</div>
		<div class="col-sm-4 label label-read">
			<strong>RONCA CUANDO DUERME : </strong>
		</div>
		<div class="col-sm-8 field field-read field-blue">
			<span class="radio-label <?= checked_if($History->ronca_dormir->si) ?>">SI</span>
			<span class="radio-label <?= checked_if($History->ronca_dormir->no) ?>">NO</span>
		</div>
		<div class="col-sm-4 label label-read">
			<strong>RESPIRA POR LA BOCA : </strong>
		</div>
		<div class="col-sm-8 field field-read field-blue">
			<span class="radio-label <?= checked_if($History->respira_boca->si) ?>">SI</span>
			<span class="radio-label <?= checked_if($History->respira_boca->no) ?>">NO</span>
		</div>
		<div class="col-sm-4 label label-read">
			<strong>SE RESFRIA CON FRECUENCIA : </strong>
		</div>
		<div class="col-sm-8 field field-read field-blue">
			<span class="radio-label <?= checked_if($History->resfrio_frecuente->si) ?>">SI</span>
			<span class="radio-label <?= checked_if($History->resfrio_frecuente->no) ?>">NO</span>
		</div>
		<div class="col-sm-4 label label-read">
			<strong>TIENE DIFICULTAD PARA MASTICAR : </strong>
		</div>
		<div class="col-sm-8 field field-read field-blue">
			<span class="radio-label <?= checked_if($History->dificultad_masticar->si) ?>">SI</span>
			<span class="radio-label <?= checked_if($History->dificultad_masticar->no) ?>">NO</span>
		</div>
		<div class="col-sm-4 label label-read">
			<strong>TIENE DIFICULTAD PARA TRAGAR : </strong>
		</div>
		<div class="col-sm-8 field field-read field-blue">
			<span class="radio-label <?= checked_if($History->dificultad_tragar->si) ?>">SI</span>
			<span class="radio-label <?= checked_if($History->dificultad_tragar->no) ?>">NO</span>
		</div>
		<div class="col-sm-4 label label-read">
			<strong>TUVO TRATAMIENTO FONOAUDI&Oacute;LOGICO : </strong>
		</div>
		<div class="col-sm-8 field field-read field-blue">
			<span class="radio-label <?= checked_if($History->fonoaudiologico->si) ?>">SI</span>
			<span class="radio-label <?= checked_if($History->fonoaudiologico->no) ?>">NO</span>
		</div>
		<div class="col-sm-4 label label-read">
			<strong>HA ALCANZADO LA PUBERTAD : </strong>
		</div>
		<div class="col-sm-8 field field-read field-blue">
			<span class="radio-label <?= checked_if($History->pubertad->si) ?>">SI</span>
			<span class="radio-label <?= checked_if($History->pubertad->no) ?>">NO</span>
		</div>
		<div class="col-sm-4 label label-read">
			<strong>DOLOR EN ARTICULACIONES MANDIBULARES : </strong>
		</div>
		<div class="col-sm-8 field field-read field-blue">
			<span class="radio-label <?= checked_if($History->dolor_articular->si) ?>">SI</span>
			<span class="radio-label <?= checked_if($History->dolor_articular->no) ?>">NO</span>
		</div>
		<div class="col-sm-4 label label-read">
			<strong>RUIDO EN ARTICULACIONES MANDIBULARES : </strong>
		</div>
		<div class="col-sm-8 field field-read field-blue">
			<span class="radio-label <?= checked_if($History->ruido_articular->si) ?>">SI</span>
			<span class="radio-label <?= checked_if($History->ruido_articular->no) ?>">NO</span>
		</div>
		<div class="col-sm-4 label label-read">
			<strong>TRAUMATISMO EN BOCA O MENT&Oacute;N : </strong>
		</div>
		<div class="col-sm-8 field field-read field-blue">
			<span class="radio-label <?= checked_if($History->traumatismo_boca_menton->si) ?>">SI</span>
			<span class="radio-label <?= checked_if($History->traumatismo_boca_menton->no) ?>">NO</span>
		</div>
		<div class="col-sm-4 label label-read">
			<strong>INTERPOSICI&Oacute;N LABIO INFERIOR : </strong>
		</div>
		<div class="col-sm-8 field field-read field-blue">
			<span class="radio-label <?= checked_if($History->interposicion_labio_inferior->si) ?>">SI</span>
			<span class="radio-label <?= checked_if($History->interposicion_labio_inferior->no) ?>">NO</span>
			<span class="radio-label <?= checked_if($History->interposicion_labio_inferior->si->actual) ?>">ACUTAL</span>
			<span class="radio-label <?= checked_if($History->interposicion_labio_inferior->si->pasado) ?>">PASADO</span>
			<?php if (!empty($History->interposicion_labio_inferior->si) && !empty($History->interposicion_labio_inferior->si->pasado->hasta)): ?>
			<strong>HASTA LOS <?= $History->interposicion_labio_inferior->si->pasado->hasta ?> A&Ntilde;OS</strong>
			<?php endif ?>
		</div>
		<div class="col-sm-4 label label-read">
			<strong>SUCCI&Oacute;N DIGITAL : </strong>
		</div>
		<div class="col-sm-8 field field-read field-blue">
			<span class="radio-label <?= checked_if($History->succion_digital->si) ?>">SI</span>
			<span class="radio-label <?= checked_if($History->succion_digital->no) ?>">NO</span>
			<span class="radio-label <?= checked_if($History->succion_digital->si->actual) ?>">ACUTAL</span>
			<span class="radio-label <?= checked_if($History->succion_digital->si->pasado) ?>">PASADO</span>
			<?php if (!empty($History->succion_digital->si) && !empty($History->succion_digital->si->pasado->hasta)): ?>
			<strong>HASTA LOS <?= $History->succion_digital->si->pasado->hasta ?> A&Ntilde;OS</strong>
			<?php endif ?>
		</div>
		<div class="col-sm-4 label label-read">
			<strong>BRUXISMO : </strong>
		</div>
		<div class="col-sm-8 field field-read field-blue">
			<span class="radio-label <?= checked_if($History->bruxismo->si) ?>">SI</span>
			<span class="radio-label <?= checked_if($History->bruxismo->no) ?>">NO</span>
			<span class="radio-label <?= checked_if($History->bruxismo->si->actual) ?>">ACUTAL</span>
			<span class="radio-label <?= checked_if($History->bruxismo->si->pasado) ?>">PASADO</span>
			<?php if (!empty($History->bruxismo->si) && !empty($History->bruxismo->si->pasado->hasta)): ?>
			<strong>HASTA LOS <?= $History->bruxismo->si->pasado->hasta ?> A&Ntilde;OS</strong>
			<?php endif ?>
		</div>
		<div class="col-sm-4 label label-read">
			<strong>OBVSERVACIONES : </strong>
		</div>
		<div class="col-sm-8 field field-read field-blue">
			<span><?= $History->odontologicos_observaciones ?> </span>
		</div>
	</div>
</div>