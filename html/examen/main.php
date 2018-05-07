<div class="bar-subtitle">
	<div class="container">
		<a href="<?= $Patient->url() ?>"><?= $Patient->fullname() ?></a>
	</div>
</div>
<div class="bar-btn">
	<div class="container">
		<a href="<?= $Exam->url('editar') ?>" class="btn btn-primary">EDITAR</a>
		<a href="<?= $Patient->url('diagnostico') ?>" class="btn btn-default">CANCELAR</a>
	</div>
</div>
<div class="container">
	<div class="bar-bordered mt5">
		<span><?= $Treatment->fecha_hora_inicio ?> - <?= $Treatment->estado ?> - <?= $Treatment->tecnica ?> - <?= $Treatment->descripcion ?></span>
	</div>
	<div class="bar-bordered clear mb5">
		<strong>EXAMEN CLINICO</strong>
	</div>
		<div class="col-sm-5 label label-read">
			<strong>ESTRUCTURAS FACIALES : </strong>
		</div>
		<div class="col-sm-7 field field-radio-check field-blue">
			<span class="<?= empty($Exam->estructuras_faciales->simetricas) ? null : 'checked' ?>">SIMETRICAS</span>
			<span class="<?= empty($Exam->estructuras_faciales->asimetricas) ? null : 'checked' ?>">ASIMETRICAS</span>
		</div>
		<div class="col-sm-5 label label-read">
			<strong>PERFIL : </strong>
		</div>
		<div class="col-sm-7 field field-radio-check field-blue">
			<span class="<?= empty($Exam->perfil->recto) ? null : 'checked' ?>">RECTO</span>
			<span class="<?= empty($Exam->perfil->concavo) ? null : 'checked' ?>">CONCAVO</span>
			<span class="<?= empty($Exam->perfil->convexo) ? null : 'checked' ?>">CONVEXO</span>
		</div>
		<div class="col-sm-5 label label-read">
			<strong>LABIOS EN REPOSO : </strong>
		</div>
		<div class="col-sm-7 field field-radio-check field-blue">
			<span class="<?= empty($Exam->labios_reposo->juntos) ? null : 'checked' ?>">JUNTOS</span>
			<span class="<?= empty($Exam->labios_reposo->separados) ? null : 'checked' ?>">SEPARADOS</span>
			<span class="<?= empty($Exam->labios_reposo->cierre_forzado) ? null : 'checked' ?>">CIERRE FORZADO</span>
		</div>
		<div class="col-sm-5 label label-read">
			<strong>RESPIRACION : </strong>
		</div>
		<div class="col-sm-7 field field-radio-check field-blue">
			<span class="<?= empty($Exam->respiracion->normal) ? null : 'checked' ?>">NORMAL</span>
			<span class="<?= empty($Exam->respiracion->bucal) ? null : 'checked' ?>">BUCAL</span>
			<span class="<?= empty($Exam->respiracion->mixta) ? null : 'checked' ?>">MIXTA</span>
		</div>
		<div class="col-sm-5 label label-read">
			<strong>DEGLUCION : </strong>
		</div>
		<div class="col-sm-7 field field-radio-check field-blue">
			<span class="<?= empty($Exam->deglucion->normal) ? null : 'checked' ?>">NORMAL</span>
			<span class="<?= empty($Exam->deglucion->atipica) ? null : 'checked' ?>">ATIPICA</span>
			<span class="<?= empty($Exam->deglucion->finales) ? null : 'checked' ?>">FINALES</span>
		</div>
		<div class="col-sm-5 label label-read">
			<strong>SURCO MENTOLABIAL : </strong>
		</div>
		<div class="col-sm-7 field field-radio-check field-blue">
			<span class="<?= empty($Exam->surco_mentolabial->normal) ? null : 'checked' ?>">NORMAL</span>
			<span class="<?= empty($Exam->surco_mentolabial->pronunciado) ? null : 'checked' ?>">PRONUNCIADO</span>
			<span class="<?= empty($Exam->surco_mentolabial->inexistente) ? null : 'checked' ?>">INEXISTENTE</span>
		</div>
		<div class="col-sm-5 label label-read">
			<strong>ATM : </strong>
		</div>
		<div class="col-sm-7 field field-radio-check field-blue">
			<span class="<?= empty($Exam->atm->normal) ? null : 'checked' ?>">NORMAL</span>
		</div>
		<div class="col-sm-5 label label-read pl10">
			<strong>DOLOR : </strong>
		</div>
		<div class="col-sm-7 field field-checkbox-check field-blue">
			<span class="<?= empty($Exam->atm->dolor->izq) ? null : 'checked' ?>">IZQUIERDO</span>
			<span class="<?= empty($Exam->atm->dolor->der) ? null : 'checked' ?>">DERECHO</span>
		</div>
		<div class="col-sm-5 label label-read pl10">
			<strong>RUIDO : </strong>
		</div>
		<div class="col-sm-7 field field-checkbox-check field-blue">
			<span class="<?= empty($Exam->atm->ruido->izq) ? null : 'checked' ?>">IZQUIERDO</span>
			<span class="<?= empty($Exam->atm->ruido->der) ? null : 'checked' ?>">DERECHO</span>
		</div>
	<div class="col-sm-12 label">
		<strong>OBVSERVACIONES : </strong>
	</div>
	<div class="col-sm-12 field field-blue">
		<span><?= isset_get($Exam->clinicas_observaciones) ?></span>
	</div>
	<div class="bar-bordered clear mb5">
		<strong>EXAMEN INTRAORAL</strong>
	</div>
	<div class="col-sm-5 label label-read">
		<strong>LINEA MEDIA SUPERIOR : </strong>
	</div>
	<div class="col-sm-7 field field-radio-check field-blue">
		<span class="<?= empty($Exam->linea_media_superior->desvio_izquierda) ? null : 'checked' ?>">DESVIO IZQUIERDA</span>
		<span class="<?= empty($Exam->linea_media_superior->desvio_derecha) ? null : 'checked' ?>">DESVIO DERECHA</span>
	</div>
	<div class="col-sm-5 label label-read">
		<strong>LINEA MEDIA INFERIOR : </strong>
	</div>
	<div class="col-sm-7 field field-radio-check field-blue">
		<span class="<?= empty($Exam->linea_media_inferior->desvio_izquierda) ? null : 'checked' ?>">DESVIO IZQUIERDA</span>
		<span class="<?= empty($Exam->linea_media_inferior->desvio_derecha) ? null : 'checked' ?>">DESVIO DERECHA</span>
	</div>
	<div class="col-sm-5 label label-read">
		<strong>DENTICION : </strong>
	</div>
	<div class="col-sm-7 field field-radio-check field-blue">
		<span class="<?= empty($Exam->denticion->primaria) ? null : 'checked' ?>">PRIMARIA</span>
		<span class="<?= empty($Exam->denticion->mixta) ? null : 'checked' ?>">MIXTA</span>
		<span class="<?= empty($Exam->denticion->permanente) ? null : 'checked' ?>">PERMANENTE</span>
	</div>
	<div class="col-sm-5 label label-read">
		<strong>DIASTEMAS SUPERIORES : </strong>
	</div>
	<div class="col-sm-7 field field-radio-check field-blue">
		<span class="<?= empty($Exam->diastemas_superiores->no) ? null : 'checked' ?>">NO</span>
		<span class="<?= empty($Exam->diastemas_superiores->si) ? null : 'checked' ?>">SI</span>
	</div>
	<div class="col-sm-5 label label-read">
		<strong>DIASTEMAS INFERIORES : </strong>
	</div>
	<div class="col-sm-7 field field-radio-check field-blue">
		<span class="<?= empty($Exam->diastemas_inferiores->no) ? null : 'checked' ?>">NO</span>
		<span class="<?= empty($Exam->diastemas_inferiores->si) ? null : 'checked' ?>">SI</span>
	</div>
	<div class="col-sm-5 label label-read">
		<strong>TAMA&Ntilde;O DE DIENTES : </strong>
	</div>
	<div class="col-sm-7 field field-radio-check field-blue">
		<span class="<?= empty($Exam->tamano_dientes->normal) ? null : 'checked' ?>">NORMAL</span>
	</div>
	<div class="col-sm-5 label label-read pl10">
		<strong>MACRODONCIA : </strong>
	</div>
	<div class="col-sm-7 field field-checkbox-check field-blue">
		<span class="<?= empty($Exam->tamano_dientes->macrodoncia->difusa) ? null : 'checked' ?>">DIFUSA</span>
		<span class="<?= empty($Exam->tamano_dientes->macrodoncia->incisivos) ? null : 'checked' ?>">INCISIVOS</span>
		<span class="<?= empty($Exam->tamano_dientes->macrodoncia->caninos) ? null : 'checked' ?>">CANINOS</span>
	</div>
	<div class="col-sm-5 label label-read pl10">
		<strong>MICRODONCIA : </strong>
	</div>
	<div class="col-sm-7 field field-checkbox-check field-blue">
		<span class="<?= empty($Exam->tamano_dientes->microdoncia->difusa ? null : 'checked') ?>">DIFUSA</span>
		<span class="<?= empty($Exam->tamano_dientes->microdoncia->incisivos ? null : 'checked') ?>">INCISIVOS</span>
		<span class="<?= empty($Exam->tamano_dientes->microdoncia->caninos ? null : 'checked') ?>">CANINOS</span>
	</div>
	<div class="col-sm-5 label label-read">
		<strong>RESALTE</strong>  
	</div>
	<div class="col-sm-7 field field-radio-check field-blue">
		<span class="<?= empty($Exam->resalte->normal) ? null : 'checked' ?>">NORMAL</span>
		<span class="<?= empty($Exam->resalte->excesiva) ? null : 'checked' ?>">EXCESIVA</span>
		<span class="<?= empty($Exam->resalte->negativo) ? null : 'checked' ?>">NEGATIVO</span>
	</div>
	<div class="col-sm-5 label label-read">
		<strong>MORDIDA CRUZADA</strong>
	</div>
	<div class="col-sm-7 field field-radio-check field-blue">
		<span class="<?= empty($Exam->mordida_cruzada->no_presenta) ? null : 'checked' ?>">NO PRESENTA</span>
		<span class="<?= empty($Exam->mordida_cruzada->izquierda) ? null : 'checked' ?>">IZQUIERDA</span>
		<span class="<?= empty($Exam->mordida_cruzada->derecha) ? null : 'checked' ?>">DERECHA</span>
		<span class="<?= empty($Exam->mordida_cruzada->bilateral) ? null : 'checked' ?>">BILATERAL</span>
	</div>
	<div class="col-sm-5 label label-read">
		<strong>DIFIERE EN RC/O DENTARIA</strong>
	</div>
	<div class="col-sm-7 field field-radio-check field-blue">
		<span class="<?= empty($Exam->rco_dentaria->no) ? null : 'checked' ?>">NO</span>
		<span class="<?= empty($Exam->rco_dentaria->si) ? null : 'checked' ?>">SI</span>
	</div>
	<div class="col-sm-5 label label-read">
		<strong>LONG. DE ARCO MAXILAR</strong>
	</div>
	<div class="col-sm-7 field field-radio-check field-blue">
		<span class="<?= empty($Exam->longitud_arco_maxilar->adecuada) ? null : 'checked' ?>">ADECUADA</span>
		<span class="<?= empty($Exam->longitud_arco_maxilar->excesiva) ? null : 'checked' ?>">EXCESIVA</span>
		<span class="<?= empty($Exam->longitud_arco_maxilar->deficiente) ? null : 'checked' ?>">DEFICIENTE</span>
	</div>
	<div class="col-sm-5 label label-read">
		<strong>CURVA DE SPEE</strong>
	</div>
	<div class="col-sm-7 field field-radio-check field-blue">
		<span class="<?= empty($Exam->curva_spee->normal) ? null : 'checked' ?>">NORMAL</span>
		<span class="<?= empty($Exam->curva_spee->pronunciada) ? null : 'checked' ?>">PRONUNCIADA</span>
	</div>
	<div class="col-sm-5 label label-read">
		<strong>PALADAR</strong>
	</div>
	<div class="col-sm-7 field field-radio-check field-blue">
		<span class="<?= empty($Exam->paladar->normal) ? null : 'checked' ?>">NORMAL</span>
		<span class="<?= empty($Exam->paladar->ojival) ? null : 'checked' ?>">OJIVAL</span>
		<span class="<?= empty($Exam->paladar->bajo) ? null : 'checked' ?>">BAJO</span>
	</div>
	<div class="col-sm-5 label label-read">
		<strong>FISURA PALADAR</strong>
	</div>
	<div class="col-sm-7 field field-radio-check field-blue">
		<span class="<?= empty($Exam->fisura_paladar->no) ? null : 'checked' ?>">NO</span>
		<span class="<?= empty($Exam->fisura_paladar->si) ? null : 'checked' ?>">SI</span>
	</div>
	<div class="col-sm-5 label label-read">
		<strong>AGENESIAS : </strong>
	</div>
	<div class="col-sm-7 field field-read field-radio field-blue">
		<span class="<?= empty($Exam->agenesias->si) ? null : 'checked' ?>">SI</span>
		<span class="<?= empty($Exam->agenesias->no) ? null : 'checked' ?>">NO</span>
		<?php if (!empty($Exam->agenesias->si)): ?>
		<strong>ESPECIFICAR </strong>
		<span class="span"><?= isset_get($Exam->agenesias->observaciones) ?></span>
		<?php endif ?>
	</div>
	<div class="col-sm-5 label label-read">
		<strong>SUPERMUMERARIOS : </strong>
	</div>
	<div class="col-sm-7 field field-read field-radio field-blue">
		<span class="<?= empty($Exam->supernumerarios->si) ? null : 'checked' ?>">SI</span>
		<span class="<?= empty($Exam->supernumerarios->no) ? null : 'checked' ?>">NO</span>
		<?php if (!empty($Exam->supernumerarios->si)): ?>
		<strong>POSICION </strong>
		<span class="span"><?= isset_get($Exam->supernumerarios->observaciones) ?></span>
		<?php endif ?>
	</div>
	<div class="col-sm-12 label">
		<strong>OBVSERVACIONES : </strong>
	</div>
	<div class="col-sm-12 field field-blue">
		<span><?= isset_get($Exam->intraoral_observaciones) ?></span>
	</div>
</div>