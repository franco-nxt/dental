<div class="bar-subtitle">
	<div class="container">
		<a href="<?= $Patient->url() ?>"><?= $Patient->fullname() ?></a>
	</div>
</div>
<div class="bar-btn">
	<div class="container">
		<a href="<?= $Diagnostic->url('editar') ?>" class="btn btn-primary">EDITAR</a>
	</div>
</div>
<div class="container p5">
	<div class="bar-bordered">
		<span><?= $Treatment->resume() ?></span>
	</div>
	<div class="bar-bordered clear mt5 mb5">
		<strong>ANALISIS INDICADOS</strong>
	</div>
	<div class="sm-12 field field-blue">
		<div class="field-checkbox-check">
			<span class="radio-label <?= empty($Diagnostic->panoramica) ? null : 'checked' ?>">PANORAMICA</span>
			<span class="radio-label <?= empty($Diagnostic->ricketts) ? null : 'checked' ?>">TRAZADO DE RICKETTS</span>
			<span class="radio-label <?= empty($Diagnostic->fotografias) ? null : 'checked' ?>">FOTOGRAFIAS</span>
			<span class="radio-label <?= empty($Diagnostic->trx_perfil) ? null : 'checked' ?>">TRX PERFIL</span>
			<span class="radio-label <?= empty($Diagnostic->jarabak) ? null : 'checked' ?>">TRX FRONTAL</span>
			<span class="radio-label <?= empty($Diagnostic->vto_crecimiento) ? null : 'checked' ?>">ESQUELETAL Y DENTARIO</span>
			<span class="radio-label <?= empty($Diagnostic->trx_frontal) ? null : 'checked' ?>">VTO CRECIMIENTO</span>
			<span class="radio-label <?= empty($Diagnostic->steiner) ? null : 'checked' ?>">VTO TRATAMIENTO</span>
			<span class="radio-label <?= empty($Diagnostic->vto_tratamiento) ? null : 'checked' ?>">STEINER</span>
			<span class="radio-label <?= empty($Diagnostic->seriada) ? null : 'checked' ?>">SERIADA</span>
			<span class="radio-label <?= empty($Diagnostic->powell) ? null : 'checked' ?>">POWELL</span>
		</div>
	</div>
	<div class="col-sm-2 label label-read">
		<strong>OTROS : </strong>
	</div>
	<div class="col-sm-10 field field-read field-blue">
		<span><?= isset_get($Diagnostic->otros) ?></span>
	</div>
	<div class="bar-bordered clear mt5 mb5">
		<strong>DIAGNOSTICO FACIAL</strong>
	</div>
	<div class="col-sm-5 label label-read">
		<strong>PATRON (BIOTIPO) : </strong>
	</div>
	<div class="col-sm-7 field field-radio-check field-blue">
		<span class="radio-label <?= empty($Diagnostic->patron->meso) ? null : 'checked' ?>">MESO</span>
		<span class="radio-label <?= empty($Diagnostic->patron->braqui) ? null : 'checked' ?>">BRAQUI</span>
		<span class="radio-label <?= empty($Diagnostic->patron->dolico) ? null : 'checked' ?>">DOLICO</span>
	</div>
	<div class="bar-bordered clear mt5 mb5">
		<strong>DIAGNOSTICO ESQUELETAL</strong>
	</div>
	<div class="col-sm-6 label label-read">
		<strong>CLASE : </strong>
	</div>
	<div class="col-sm-6 field field-radio-check field-blue">
		<span class="radio-label <?= empty($Diagnostic->esq_clase->{1}) ? null : 'checked' ?>">I</span>
		<span class="radio-label <?= empty($Diagnostic->esq_clase->{2}) ? null : 'checked' ?>">II</span>
		<span class="radio-label <?= empty($Diagnostic->esq_clase->{3}) ? null : 'checked' ?>">III</span>
	</div>
	<div class="col-sm-6 label label-read">
		<strong class="md-pl5">POR MAXILAR : </strong>
	</div>
	<div class="col-sm-6 field field-radio-check field-blue">
		<span class="radio-label <?= empty($Diagnostic->esq_clase->maxilar->sup) ? null : 'checked' ?>">SUP.</span>
		<span class="radio-label <?= empty($Diagnostic->esq_clase->maxilar->inf) ? null : 'checked' ?>">INF.</span>
	</div>
	<div class="col-sm-6 label label-read">
		<strong>POSICIONAMIENTO VERTICAL : </strong>
	</div>
	<div class="col-sm-6 field field-radio-check field-blue">
		<span class="radio-label <?= empty($Diagnostic->esq_pos_vertical->normal) ? null : 'checked' ?>">NORMAL</span>
		<span class="radio-label <?= empty($Diagnostic->esq_pos_vertical->aumentado) ? null : 'checked' ?>">AUMENTADO</span>
		<span class="radio-label <?= empty($Diagnostic->esq_pos_vertical->disminuido) ? null : 'checked' ?>">DISMINUIDO</span>
	</div>
	<div class="col-sm-6 label label-read">
		<strong class="md-pl5">POR MAXILAR</strong>
	</div>
	<div class="col-sm-6 field field-radio-check field-blue">
		<span class="radio-label <?= empty($Diagnostic->esq_pos_vertical->maxilar->sup) ? null : 'checked' ?>">SUP.</span>
		<span class="radio-label <?= empty($Diagnostic->esq_pos_vertical->maxilar->inf) ? null : 'checked' ?>">INF.</span>
	</div>
	<div class="bar-bordered clear mt5 mb5">
		<strong>DIAGNOSTICO DENTARIO</strong>
	</div>
	<div class="col-sm-5 label label-read">
		<strong>CLASE MOLAR DERECHA : </strong>
	</div>
	<div class="col-sm-7 field field-radio-check field-blue">
		<span class="radio-label <?= empty($Diagnostic->clase_molar_izq->{1}) ? null : 'checked' ?>">I</span>
		<span class="radio-label <?= empty($Diagnostic->clase_molar_izq->{2}) ? null : 'checked' ?>">II</span>
		<span class="radio-label <?= empty($Diagnostic->clase_molar_izq->{3}) ? null : 'checked' ?>">II</span>
	</div>
	<div class="col-sm-5 label label-read">
		<strong>CLASE MOLAR IZQUIERDA : </strong>
	</div>
	<div class="col-sm-7 field field-radio-check field-blue">
		<span class="radio-label <?= empty($Diagnostic->clase_molar_der->{1}) ? null : 'checked' ?>">I</span>
		<span class="radio-label <?= empty($Diagnostic->clase_molar_der->{2}) ? null : 'checked' ?>">II</span>
		<span class="radio-label <?= empty($Diagnostic->clase_molar_der->{3}) ? null : 'checked' ?>">II</span>
	</div>
	<div class="col-sm-5 label label-read">
		<strong>POSICION MOLAR SUPERIOR : </strong>
	</div>
	<div class="col-sm-7 field field-radio-check field-blue">
		<span class="radio-label <?= empty($Diagnostic->pos_molar_sup->normal) ? null : 'checked' ?>">NORMAL</span>
		<span class="radio-label <?= empty($Diagnostic->pos_molar_sup->aumentada) ? null : 'checked' ?>">AUMENTADA</span>
		<span class="radio-label <?= empty($Diagnostic->pos_molar_sup->disminuida) ? null : 'checked' ?>">AUMENTADA</span>
	</div>
	<div class="col-sm-5 label label-read">
		<strong>POSICION INCISIVO INFERIOR : </strong>
	</div>
	<div class="col-sm-7 field field-radio-check field-blue">
		<span class="radio-label <?= empty($Diagnostic->pos_incisivo_inf->normal) ? null : 'checked' ?>">NORMAL</span>
		<span class="radio-label <?= empty($Diagnostic->pos_incisivo_inf->aumentada) ? null : 'checked' ?>">AUMENTADA</span>
		<span class="radio-label <?= empty($Diagnostic->pos_incisivo_inf->disminuida) ? null : 'checked' ?>">AUMENTADA</span>
	</div>
	<div class="col-sm-5 label label-read">
		<strong>POSICION INCISIVO SUPERIOR : </strong>
	</div>
	<div class="col-sm-7 field field-radio-check field-blue">
		<span class="radio-label <?= empty($Diagnostic->pos_incisivo_sup->normal) ? null : 'checked' ?>">NORMAL</span>
		<span class="radio-label <?= empty($Diagnostic->pos_incisivo_sup->aumentada) ? null : 'checked' ?>">AUMENTADA</span>
		<span class="radio-label <?= empty($Diagnostic->pos_incisivo_sup->disminuida) ? null : 'checked' ?>">AUMENTADA</span>
	</div>
	<div class="col-sm-5 label label-read">
		<strong>INCLINACION INCISIVO INFERIOR : </strong>
	</div>
	<div class="col-sm-7 field field-radio-check field-blue">
		<span class="radio-label <?= empty($Diagnostic->incl_incisivo_inf->normal) ? null : 'checked' ?>">NORMAL</span>
		<span class="radio-label <?= empty($Diagnostic->incl_incisivo_inf->aumentada) ? null : 'checked' ?>">AUMENTADA</span>
		<span class="radio-label <?= empty($Diagnostic->incl_incisivo_inf->disminuida) ? null : 'checked' ?>">AUMENTADA</span>
	</div>
	<div class="col-sm-5 label label-read">
		<strong>INCLINACION INCISIVO SUPERIOR : </strong>
	</div>
	<div class="col-sm-7 field field-radio-check field-blue">
		<span class="radio-label <?= empty($Diagnostic->incl_incisivo_sup->normal) ? null : 'checked' ?>">NORMAL</span>
		<span class="radio-label <?= empty($Diagnostic->incl_incisivo_sup->aumentada) ? null : 'checked' ?>">AUMENTADA</span>
		<span class="radio-label <?= empty($Diagnostic->incl_incisivo_sup->disminuida) ? null : 'checked' ?>">AUMENTADA</span>
	</div>
	<div class="col-sm-5 label label-read">
		<strong>OVERJET : </strong>
	</div>
	<div class="col-sm-7 field field-radio-check field-blue">
		<span class="radio-label <?= empty($Diagnostic->overjet->normal) ? null : 'checked' ?>">NORMAL</span>
		<span class="radio-label <?= empty($Diagnostic->overjet->aumentada) ? null : 'checked' ?>">AUMENTADA</span>
		<span class="radio-label <?= empty($Diagnostic->overjet->disminuida) ? null : 'checked' ?>">AUMENTADA</span>
	</div>
	<div class="col-sm-5 label label-read">
		<strong>OVERBITE : </strong>
	</div>
	<div class="col-sm-7 field field-radio-check field-blue">
		<span class="radio-label <?= empty($Diagnostic->overbite->normal) ? null : 'checked' ?>">NORMAL</span>
		<span class="radio-label <?= empty($Diagnostic->overbite->aumentada) ? null : 'checked' ?>">AUMENTADA</span>
		<span class="radio-label <?= empty($Diagnostic->overbite->disminuida) ? null : 'checked' ?>">AUMENTADA</span>
	</div>
	<div class="col-sm-5 label label-read">
		<strong>ANGULO INTERINCISIVO : </strong>
	</div>
	<div class="col-sm-7 field field-radio-check field-blue">
		<span class="radio-label <?= empty($Diagnostic->angulo_interincisivo->normal) ? null : 'checked' ?>">NORMAL</span>
		<span class="radio-label <?= empty($Diagnostic->angulo_interincisivo->aumentada) ? null : 'checked' ?>">AUMENTADA</span>
		<span class="radio-label <?= empty($Diagnostic->angulo_interincisivo->disminuida) ? null : 'checked' ?>">AUMENTADA</span>
	</div>
	<div class="col-sm-5 label label-read">
		<strong>PROTUSION LABIAL : </strong>
	</div>
	<div class="col-sm-7 field field-radio-check field-blue">
		<span class="radio-label <?= empty($Diagnostic->protusion_labial->normal) ? null : 'checked' ?>">NORMAL</span>
		<span class="radio-label <?= empty($Diagnostic->protusion_labial->aumentada) ? null : 'checked' ?>">AUMENTADA</span>
		<span class="radio-label <?= empty($Diagnostic->protusion_labial->disminuida) ? null : 'checked' ?>">AUMENTADA</span>
	</div>
	<div class="col-sm-5 label label-read">
		<strong>OBSERVACIONES : </strong>
	</div>
	<div class="col-sm-7 field field-read field-blue">
		<span><?= isset_get($Diagnostic->observaciones) ?></span>
	</div>
</div>
