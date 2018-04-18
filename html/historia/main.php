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
<div class="bar-btn">
	<div class="container">
		<a href="<?= $Treatment->url('historia', 'editar') ?>" class="btn btn-primary">EDITAR</a>
		<a href="<?= $Patient->url('diagnostico') ?>" class="btn btn-default">CANCELAR</a>
	</div>
</div>
<div class="container p5">
	<div class="bar-bordered">
		<span><?= $Treatment->inicio ?> - <?= $Treatment->estado ?> - <?= $Treatment->tecnica ?> - <?= $Treatment->descripcion ?></span>
	</div>
	<div>
		<div class="col-sm-4 label label-read">
			<strong>TRATAMIENTO M&Eacute;DICO ACTUAL : </strong>
		</div>
		<div class="col-sm-8 field field-read field-radio field-blue">
			<span class="<?= empty($History->tratamiento_medico->si) ? null : 'checked' ?>">SI</span>
			<span class="<?= empty($History->tratamiento_medico->no) ? null : 'checked' ?>">NO</span>
			<?php if (!empty($History->tratamiento_medico->si)): ?>
			<strong>CU&Aacute;L? </strong><span class="span"><?= !empty($History->tratamiento_medico->si) && !empty($History->tratamiento_medico->cual) ? $History->tratamiento_medico->cual : null ?></span>
			<?php endif ?>
		</div>
		<div class="col-sm-4 label label-read">
			<strong>ENFERMEDAD SIST&Eacute;MICA : </strong>
		</div>
		<div class="col-sm-8 field field-read field-radio field-blue">
			<span class="<?= empty($History->enfermedad_sistemica->si) ? null : 'checked' ?>">SI</span>
			<span class="<?= empty($History->enfermedad_sistemica->no) ? null : 'checked' ?>">NO</span>
			<?php if (!empty($History->enfermedad_sistemica->si)): ?>
			<strong>CU&Aacute;L? </strong><span class="span"><?= !empty($History->enfermedad_sistemica->si) && !empty($History->enfermedad_sistemica->cual) ? $History->enfermedad_sistemica->cual : null ?></span>
			<?php endif ?>
		</div>
		<div class="col-sm-4 label label-read">
			<strong>MEDICACI&Oacute;N ACTUAL : </strong>
		</div>
		<div class="col-sm-8 field field-read field-radio field-blue">
			<span class="<?= empty($History->medicacion_actual->si) ? null : 'checked' ?>">SI</span>
			<span class="<?= empty($History->medicacion_actual->no) ? null : 'checked' ?>">NO</span>
			<?php if (!empty($History->medicacion_actual->si)): ?>
			<strong>CU&Aacute;L? </strong><span class="span"><?= !empty($History->medicacion_actual->si) && !empty($History->medicacion_actual->cual) ? $History->medicacion_actual->cual : null ?></span>
			<?php endif ?>
		</div>
		<div class="col-sm-4 label label-read">
			<strong>TUVO HEPATITIS : </strong>
		</div>
		<div class="col-sm-8 field field-read field-radio field-blue">
			<span class="<?= empty($History->hepatitis->si) ? null : 'checked' ?>">SI</span>
			<span class="<?= empty($History->hepatitis->no) ? null : 'checked' ?>">NO</span>
			<?php if (!empty($History->hepatitis->si)): ?>
			<strong>CU&Aacute;L? </strong><span class="span"><?= !empty($History->hepatitis->si) && !empty($History->hepatitis->cual) ? $History->hepatitis->cual : null ?></span>
			<?php endif ?>
		</div>
		<div class="col-sm-4 label label-read">
			<strong>HIV : </strong>
		</div>
		<div class="col-sm-8 field field-read field-radio field-blue">
			<span class="<?= empty($History->hiv->si) ? null : 'checked' ?>">SI</span>
			<span class="<?= empty($History->hiv->no) ? null : 'checked' ?>">NO</span>
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
		<div class="col-sm-8 field field-read field-radio field-blue">
			<span class="<?= empty($History->higene_bucal->buena) ? null : 'checked' ?>">BUENA</span>
			<span class="<?= empty($History->higene_bucal->regular) ? null : 'checked' ?>">REGULAR</span>
			<span class="<?= empty($History->higene_bucal->mala) ? null : 'checked' ?>">MALA</span>
		</div>
		<div class="col-sm-4 label label-read">
			<strong>TRAT. ANTERIOR ORTOPEDIA MAXILAR : </strong>
		</div>
		<div class="col-sm-8 field field-read field-radio field-blue">
			<span class="<?= empty($History->ortopedia->si) ? null : 'checked' ?>">SI</span>
			<span class="<?= empty($History->ortopedia->no) ? null : 'checked' ?>">NO</span>
		</div>
		<div class="col-sm-4 label label-read">
			<strong>TRAT. ANTERIOR ORTODONCIA : </strong>
		</div>
		<div class="col-sm-8 field field-read field-radio field-blue">
			<span class="<?= empty($History->ortodoncia->si) ? null : 'checked' ?>">SI</span>
			<span class="<?= empty($History->ortodoncia->no) ? null : 'checked' ?>">NO</span>
		</div>
		<div class="col-sm-4 label label-read">
			<strong>GINJIVITIS : </strong>
		</div>
		<div class="col-sm-8 field field-read field-radio field-blue">
			<span class="<?= empty($History->ginjivitis->si) ? null : 'checked' ?>">SI</span>
			<span class="<?= empty($History->ginjivitis->no) ? null : 'checked' ?>">NO</span>
		</div>
		<div class="col-sm-4 label label-read">
			<strong>PERIODONTITIS : </strong>
		</div>
		<div class="col-sm-8 field field-read field-radio field-blue">
			<span class="<?= empty($History->periodontitis->si) ? null : 'checked' ?>">SI</span>
			<span class="<?= empty($History->periodontitis->no) ? null : 'checked' ?>">NO</span>
		</div>
		<div class="col-sm-4 label label-read">
			<strong>XEROSTOM&Iacute;A(POCA SALIVA) : </strong>
		</div>
		<div class="col-sm-8 field field-read field-radio field-blue">
			<span class="<?= empty($History->xerostomia->si) ? null : 'checked' ?>">SI</span>
			<span class="<?= empty($History->xerostomia->no) ? null : 'checked' ?>">NO</span>
		</div>
		<div class="col-sm-4 label label-read">
			<strong>USA PLACA PARA DORMIR : </strong>
		</div>
		<div class="col-sm-8 field field-read field-radio field-blue">
			<span class="<?= empty($History->placa_dormir->si) ? null : 'checked' ?>">SI</span>
			<span class="<?= empty($History->placa_dormir->no) ? null : 'checked' ?>">NO</span>
		</div>
		<div class="col-sm-4 label label-read">
			<strong>RONCA CUANDO DUERME : </strong>
		</div>
		<div class="col-sm-8 field field-read field-radio field-blue">
			<span class="<?= empty($History->ronca_dormir->si) ? null : 'checked' ?>">SI</span>
			<span class="<?= empty($History->ronca_dormir->no) ? null : 'checked' ?>">NO</span>
		</div>
		<div class="col-sm-4 label label-read">
			<strong>RESPIRA POR LA BOCA : </strong>
		</div>
		<div class="col-sm-8 field field-read field-radio field-blue">
			<span class="<?= empty($History->respira_boca->si) ? null : 'checked' ?>">SI</span>
			<span class="<?= empty($History->respira_boca->no) ? null : 'checked' ?>">NO</span>
		</div>
		<div class="col-sm-4 label label-read">
			<strong>SE RESFRIA CON FRECUENCIA : </strong>
		</div>
		<div class="col-sm-8 field field-read field-radio field-blue">
			<span class="<?= empty($History->resfrio_frecuente->si) ? null : 'checked' ?>">SI</span>
			<span class="<?= empty($History->resfrio_frecuente->no) ? null : 'checked' ?>">NO</span>
		</div>
		<div class="col-sm-4 label label-read">
			<strong>TIENE DIFICULTAD PARA MASTICAR : </strong>
		</div>
		<div class="col-sm-8 field field-read field-radio field-blue">
			<span class="<?= empty($History->dificultad_masticar->si) ? null : 'checked' ?>">SI</span>
			<span class="<?= empty($History->dificultad_masticar->no) ? null : 'checked' ?>">NO</span>
		</div>
		<div class="col-sm-4 label label-read">
			<strong>TIENE DIFICULTAD PARA TRAGAR : </strong>
		</div>
		<div class="col-sm-8 field field-read field-radio field-blue">
			<span class="<?= empty($History->dificultad_tragar->si) ? null : 'checked' ?>">SI</span>
			<span class="<?= empty($History->dificultad_tragar->no) ? null : 'checked' ?>">NO</span>
		</div>
		<div class="col-sm-4 label label-read">
			<strong>TUVO TRATAMIENTO FONOAUDI&Oacute;LOGICO : </strong>
		</div>
		<div class="col-sm-8 field field-read field-radio field-blue">
			<span class="<?= empty($History->fonoaudiologico->si) ? null : 'checked' ?>">SI</span>
			<span class="<?= empty($History->fonoaudiologico->no) ? null : 'checked' ?>">NO</span>
		</div>
		<div class="col-sm-4 label label-read">
			<strong>HA ALCANZADO LA PUBERTAD : </strong>
		</div>
		<div class="col-sm-8 field field-read field-radio field-blue">
			<span class="<?= empty($History->pubertad->si) ? null : 'checked' ?>">SI</span>
			<span class="<?= empty($History->pubertad->no) ? null : 'checked' ?>">NO</span>
		</div>
		<div class="col-sm-4 label label-read">
			<strong>DOLOR EN ARTICULACIONES MANDIBULARES : </strong>
		</div>
		<div class="col-sm-8 field field-read field-radio field-blue">
			<span class="<?= empty($History->dolor_articular->si) ? null : 'checked' ?>">SI</span>
			<span class="<?= empty($History->dolor_articular->no) ? null : 'checked' ?>">NO</span>
		</div>
		<div class="col-sm-4 label label-read">
			<strong>RUIDO EN ARTICULACIONES MANDIBULARES : </strong>
		</div>
		<div class="col-sm-8 field field-read field-radio field-blue">
			<span class="<?= empty($History->ruido_articular->si) ? null : 'checked' ?>">SI</span>
			<span class="<?= empty($History->ruido_articular->no) ? null : 'checked' ?>">NO</span>
		</div>
		<div class="col-sm-4 label label-read">
			<strong>TRAUMATISMO EN BOCA O MENT&Oacute;N : </strong>
		</div>
		<div class="col-sm-8 field field-read field-radio field-blue">
			<span class="<?= empty($History->traumatismo_boca_menton->si) ? null : 'checked' ?>">SI</span>
			<span class="<?= empty($History->traumatismo_boca_menton->no) ? null : 'checked' ?>">NO</span>
		</div>
		<div class="col-sm-4 label label-read">
			<strong>INTERPOSICI&Oacute;N LABIO INFERIOR : </strong>
		</div>
		<div class="col-sm-8 field field-read field-radio field-blue">
			<span class="<?= empty($History->interposicion_labio_inferior->si) ? null : 'checked' ?>">SI</span>
			<span class="<?= empty($History->interposicion_labio_inferior->no) ? null : 'checked' ?>">NO</span>
			<span class="<?= empty($History->interposicion_labio_inferior->si->actual) ? null : 'checked' ?>">ACUTAL</span>
			<span class="<?= empty($History->interposicion_labio_inferior->si->pasado) ? null : 'checked' ?>">PASADO</span>
			<?php if (!empty($History->interposicion_labio_inferior->si) && !empty($History->interposicion_labio_inferior->si->pasado->hasta)): ?>
			<strong>HASTA LOS <?= $History->interposicion_labio_inferior->si->pasado->hasta ?> A&Ntilde;OS</strong>
			<?php endif ?>
		</div>
		<div class="col-sm-4 label label-read">
			<strong>SUCCI&Oacute;N DIGITAL : </strong>
		</div>
		<div class="col-sm-8 field field-read field-radio field-blue">
			<span class="<?= empty($History->succion_digital->si) ? null : 'checked' ?>">SI</span>
			<span class="<?= empty($History->succion_digital->no) ? null : 'checked' ?>">NO</span>
			<span class="<?= empty($History->succion_digital->si->actual) ? null : 'checked' ?>">ACUTAL</span>
			<span class="<?= empty($History->succion_digital->si->pasado) ? null : 'checked' ?>">PASADO</span>
			<?php if (!empty($History->succion_digital->si) && !empty($History->succion_digital->si->pasado->hasta)): ?>
			<strong>HASTA LOS <?= $History->succion_digital->si->pasado->hasta ?> A&Ntilde;OS</strong>
			<?php endif ?>
		</div>
		<div class="col-sm-4 label label-read">
			<strong>BRUXISMO : </strong>
		</div>
		<div class="col-sm-8 field field-read field-radio field-blue">
			<span class="<?= empty($History->bruxismo->si) ? null : 'checked' ?>">SI</span>
			<span class="<?= empty($History->bruxismo->no) ? null : 'checked' ?>">NO</span>
			<span class="<?= empty($History->bruxismo->si->actual) ? null : 'checked' ?>">ACUTAL</span>
			<span class="<?= empty($History->bruxismo->si->pasado) ? null : 'checked' ?>">PASADO</span>
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