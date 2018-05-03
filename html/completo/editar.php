<?php 
!isset($Patient , $Treatment) && redirect_exit();
$Diagnostic = $Treatment->get_fullDiagnostic()->select();
?>
<form method="POST">
	<div class="bar-subtitle">
		<div class="container">
			<a href="<?= $Patient->url() ?>"><?= $Patient->fullname() ?></a>
		</div>
	</div>
	<div class="bar-btn">
		<div class="container">
			<button class="btn btn-success" name="action" value="save">GUARDAR</button>
			<a href="<?= $Diagnostic->url() ?>" class="btn btn-default">CANCELAR</a>
		</div>
	</div>
	<div class="container p5">
		<div class="bar-bordered">
			<span><?= $Treatment->fecha_hora_inicio ?> - <?= $Treatment->estado ?> - <?= $Treatment->tecnica ?></span>
		</div>
		<div class="bar-bordered clear mt5 mb5">
			<strong>ANALISIS INDICADOS</strong>
		</div>
		<div class="sm-12 field field-blue">
			<div class="field-checkbox-check">
				<input type="checkbox" id="panoramica" name="panoramica" value="panoramica" <?= checked(!empty($Diagnostic->panoramica)) ?>/><label for="panoramica">PANORAMICA</label>
				<input type="checkbox" id="ricketts" name="ricketts" value="ricketts" <?= checked(!empty($Diagnostic->ricketts)) ?>/><label for="ricketts">TRAZADO DE RICKETTS</label>
				<input type="checkbox" id="fotografias" name="fotografias" value="fotografias" <?= checked(!empty($Diagnostic->fotografias)) ?>/><label for="fotografias">FOTOGRAFIAS</label>
				<input type="checkbox" id="trx_perfil" name="trx_perfil" value="trx_perfil" <?= checked(!empty($Diagnostic->trx_perfil)) ?>/><label for="trx_perfil">TRX PERFIL</label>
				<input type="checkbox" id="jarabak" name="jarabak" value="jarabak" <?= checked(!empty($Diagnostic->jarabak)) ?>/><label for="jarabak">TRX FRONTAL</label>
				<input type="checkbox" id="vto_crecimiento" name="vto_crecimiento" value="vto_crecimiento" <?= checked(!empty($Diagnostic->vto_crecimiento)) ?>/><label for="vto_crecimiento">ESQUELETAL Y DENTARIO</label>
				<input type="checkbox" id="trx_frontal" name="trx_frontal" value="trx_frontal" <?= checked(!empty($Diagnostic->trx_frontal)) ?>/><label for="trx_frontal">VTO CRECIMIENTO</label>
				<input type="checkbox" id="steiner" name="steiner" value="steiner" <?= checked(!empty($Diagnostic->steiner)) ?>/><label for="steiner">VTO TRATAMIENTO</label>
				<input type="checkbox" id="vto_tratamiento" name="vto_tratamiento" value="vto_tratamiento" <?= checked(!empty($Diagnostic->vto_tratamiento)) ?>/><label for="vto_tratamiento">STEINER</label>
				<input type="checkbox" id="seriada" name="seriada" value="seriada" <?= checked(!empty($Diagnostic->seriada)) ?>/><label for="seriada">SERIADA</label>
				<input type="checkbox" id="powell" name="powell" value="powell" <?= checked(!empty($Diagnostic->powell)) ?>/><label for="powell">POWELL</label>
			</div>
		</div>
		<label class="form-group m0">
			<strong class="col-sm-2  label label-read">OTROS : </strong>
			<div class="col-sm-10 field field-blue field-read">
				<input type="text" id="otros" name="otros" value="<?= isset_get($Diagnostic->otros) ?>">
			</div>
		</label>
		<div class="bar-bordered clear mt5 mb5">
			<strong>DIAGNOSTICO FACIAL</strong>
		</div>
		<div class="col-sm-5 label label-read">
			<strong>PATRON (BIOTIPO) : </strong>
		</div>
		<div class="col-sm-7 field field-radio-check field-blue">
			<input type="radio" name="patron" id="patron_meso" value="meso" <?= checked(!empty($Diagnostic->patron->meso)) ?>/><label for="patron_meso">MESO</label>
			<input type="radio" name="patron" id="patron_braqui" value="braqui" <?= checked(!empty($Diagnostic->patron->braqui)) ?>/><label for="patron_braqui">BRAQUI</label>
			<input type="radio" name="patron" id="patron_dolico" value="dolico" <?= checked(!empty($Diagnostic->patron->dolico)) ?>/><label for="patron_dolico">DOLICO</label>
		</div>
		<div class="bar-bordered clear mt5 mb5">
			<strong>DIAGNOSTICO ESQUELETAL</strong>
		</div>
		<div class="col-sm-6 label label-read">
			<strong>CLASE : </strong>
		</div>
		<div class="col-sm-6 field field-radio-check field-blue">
			<input type="radio" name="esq_clase[]" id="esq_clase_1" value="1"  <?= checked(!empty($Diagnostic->esq_clase->{1})) ?>/><label for="esq_clase_1">I</label>
			<input type="radio" name="esq_clase[]" id="esq_clase_2" value="2"  <?= checked(!empty($Diagnostic->esq_clase->{2})) ?>/><label for="esq_clase_2">II</label>
			<input type="radio" name="esq_clase[]" id="esq_clase_3" value="3"  <?= checked(!empty($Diagnostic->esq_clase->{3})) ?>/><label for="esq_clase_3">III</label>
		</div>
		<div class="col-sm-6 label label-read">
			<strong class="md-pl10">POR MAXILAR : </strong>
		</div>
		<div class="col-sm-6 field field-radio-check field-blue">
			<input type="radio" name="esq_clase[maxilar]" id="esq_clase_maxilar_sup" value="sup" <?= checked(!empty($Diagnostic->esq_clase->maxilar->sup)) ?> /><label for="esq_clase_maxilar_sup">SUP.</label>
			<input type="radio" name="esq_clase[maxilar]" id="esq_clase_maxilar_inf" value="inf" <?= checked(!empty($Diagnostic->esq_clase->maxilar->inf)) ?> /><label for="esq_clase_maxilar_inf">INF.</label>
		</div>
		<div class="col-sm-6 label label-read">
			<strong>POSICIONAMIENTO VERTICAL : </strong>
		</div>
		<div class="col-sm-6 field field-radio-check field-blue">
			<input type="radio" name="esq_pos_vertical[]" id="esq_pos_vertical_normal" value="normal" <?= checked(!empty($Diagnostic->esq_pos_vertical->normal)) ?> /><label for="esq_pos_vertical_normal">NORMAL</label>
			<input type="radio" name="esq_pos_vertical[]" id="esq_pos_vertical_aumentado" value="aumentado" <?= checked(!empty($Diagnostic->esq_pos_vertical->aumentado)) ?> /><label for="esq_pos_vertical_aumentado">AUMENTADO</label>
			<input type="radio" name="esq_pos_vertical[]" id="esq_pos_vertical_disminuido" value="disminuido" <?= checked(!empty($Diagnostic->esq_pos_vertical->disminuido)) ?> /><label for="esq_pos_vertical_disminuido">DISMINUIDO</label>
		</div>
		<div class="col-sm-6 label label-read">
			<strong class="md-pl10">POR MAXILAR</strong>
		</div>
		<div class="col-sm-6 field field-radio-check field-blue">
			<input type="radio" name="esq_pos_vertical[maxilar]" id="esq_pos_vertical_sup" value="sup" <?= checked(!empty($Diagnostic->esq_pos_vertical->sup)) ?> /><label for="esq_pos_vertical_sup">SUP.</label>
			<input type="radio" name="esq_pos_vertical[maxilar]" id="esq_pos_vertical_inf" value="inf" <?= checked(!empty($Diagnostic->esq_pos_vertical->inf)) ?> /><label for="esq_pos_vertical_inf">INF.</label>
		</div>
		<div class="bar-bordered clear mt5 mb5">
			<strong>DIAGNOSTICO DENTARIO</strong>
		</div>
		<div class="col-sm-5 label label-read">
			<strong>CLASE MOLAR DERECHA : </strong>
		</div>
		<div class="col-sm-7 field field-radio-check field-blue">
			<input type="radio" name="clase_molar_izq" id="clase_molar_izq_1" value="1" <?= checked(!empty($Diagnostic->clase_molar_izq->{1})) ?> /><label for="clase_molar_izq_1">I</label>
			<input type="radio" name="clase_molar_izq" id="clase_molar_izq_2" value="2" <?= checked(!empty($Diagnostic->clase_molar_izq->{2})) ?> /><label for="clase_molar_izq_2">II</label>
			<input type="radio" name="clase_molar_izq" id="clase_molar_izq_3" value="3" <?= checked(!empty($Diagnostic->clase_molar_izq->{3})) ?> /><label for="clase_molar_izq_3">II</label>
		</div>
		<div class="col-sm-5 label label-read">
			<strong>CLASE MOLAR IZQUIERDA : </strong>
		</div>
		<div class="col-sm-7 field field-radio-check field-blue">
			<input type="radio" name="clase_molar_der" id="clase_molar_der_1" value="1" <?= checked(!empty($Diagnostic->clase_molar_der->{1})) ?> /><label for="clase_molar_der_1">I</label>
			<input type="radio" name="clase_molar_der" id="clase_molar_der_2" value="2" <?= checked(!empty($Diagnostic->clase_molar_der->{2})) ?> /><label for="clase_molar_der_2">II</label>
			<input type="radio" name="clase_molar_der" id="clase_molar_der_3" value="3" <?= checked(!empty($Diagnostic->clase_molar_der->{3})) ?> /><label for="clase_molar_der_3">II</label>
		</div>
		<div class="col-sm-5 label label-read">
			<strong>POSICION MOLAR SUPERIOR : </strong>
		</div>
		<div class="col-sm-7 field field-radio-check field-blue">
			<input type="radio" name="pos_molar_sup" id="posicion_molar_normal" value="normal" <?= checked(!empty($Diagnostic->pos_molar_sup->normal)) ?> /><label for="posicion_molar_normal">NORMAL</label>
			<input type="radio" name="pos_molar_sup" id="posicion_molar_aumentada" value="aumentada" <?= checked(!empty($Diagnostic->pos_molar_sup->aumentada)) ?> /><label for="posicion_molar_aumentada">AUMENTADA</label>
			<input type="radio" name="pos_molar_sup" id="posicion_molar_disminuida" value="disminuida" <?= checked(!empty($Diagnostic->pos_molar_sup->disminuida)) ?> /><label for="posicion_molar_disminuida">AUMENTADA</label>
		</div>
		<div class="col-sm-5 label label-read">
			<strong>POSICION INCISIVO INFERIOR : </strong>
		</div>
		<div class="col-sm-7 field field-radio-check field-blue">
			<input type="radio" name="pos_incisivo_inf" id="posicion_incisivo_inferior_normal" value="normal" <?= checked(!empty($Diagnostic->pos_incisivo_inf->normal)) ?> /><label for="posicion_incisivo_inferior_normal">NORMAL</label>
			<input type="radio" name="pos_incisivo_inf" id="posicion_incisivo_inferior_aumentada" value="aumentada" <?= checked(!empty($Diagnostic->pos_incisivo_inf->aumentada)) ?> /><label for="posicion_incisivo_inferior_aumentada">AUMENTADA</label>
			<input type="radio" name="pos_incisivo_inf" id="posicion_incisivo_inferior_disminuida" value="disminuida" <?= checked(!empty($Diagnostic->pos_incisivo_inf->disminuida)) ?> /><label for="posicion_incisivo_inferior_disminuida">AUMENTADA</label>
		</div>
		<div class="col-sm-5 label label-read">
			<strong>POSICION INCISIVO SUPERIOR : </strong>
		</div>
		<div class="col-sm-7 field field-radio-check field-blue">
			<input type="radio" name="pos_incisivo_sup" id="posicion_incisivo_superior_normal" value="normal" <?= checked(!empty($Diagnostic->pos_incisivo_sup->normal)) ?> /><label for="posicion_incisivo_superior_normal">NORMAL</label>
			<input type="radio" name="pos_incisivo_sup" id="posicion_incisivo_superior_aumentada" value="aumentada" <?= checked(!empty($Diagnostic->pos_incisivo_sup->aumentada)) ?> /><label for="posicion_incisivo_superior_aumentada">AUMENTADA</label>
			<input type="radio" name="pos_incisivo_sup" id="posicion_incisivo_superior_disminuida" value="disminuida" <?= checked(!empty($Diagnostic->pos_incisivo_sup->disminuida)) ?> /><label for="posicion_incisivo_superior_disminuida">AUMENTADA</label>
		</div>
		<div class="col-sm-5 label label-read">
			<strong>INCLINACION INCISIVO INFERIOR : </strong>
		</div>
		<div class="col-sm-7 field field-radio-check field-blue">
			<input type="radio" name="incl_incisivo_inf" id="inclinacion_incisivo_inferior_normal" value="normal" <?= checked(!empty($Diagnostic->incl_incisivo_inf->normal)) ?> /><label for="inclinacion_incisivo_inferior_normal">NORMAL</label>
			<input type="radio" name="incl_incisivo_inf" id="inclinacion_incisivo_inferior_aumentada" value="aumentada" <?= checked(!empty($Diagnostic->incl_incisivo_inf->aumentada)) ?> /><label for="inclinacion_incisivo_inferior_aumentada">AUMENTADA</label>
			<input type="radio" name="incl_incisivo_inf" id="inclinacion_incisivo_inferior_disminuida" value="disminuida" <?= checked(!empty($Diagnostic->incl_incisivo_inf->disminuida)) ?> /><label for="inclinacion_incisivo_inferior_disminuida">AUMENTADA</label>
		</div>
		<div class="col-sm-5 label label-read">
			<strong>INCLINACION INCISIVO SUPERIOR : </strong>
		</div>
		<div class="col-sm-7 field field-radio-check field-blue">
			<input type="radio" name="incl_incisivo_sup" id="inclinacion_incisivo_superior_normal" value="normal" <?= checked(!empty($Diagnostic->incl_incisivo_sup->normal)) ?> /><label for="inclinacion_incisivo_superior_normal">NORMAL</label>
			<input type="radio" name="incl_incisivo_sup" id="inclinacion_incisivo_superior_aumentada" value="aumentada" <?= checked(!empty($Diagnostic->incl_incisivo_sup->aumentada)) ?> /><label for="inclinacion_incisivo_superior_aumentada">AUMENTADA</label>
			<input type="radio" name="incl_incisivo_sup" id="inclinacion_incisivo_superior_disminuida" value="disminuida" <?= checked(!empty($Diagnostic->incl_incisivo_sup->disminuida)) ?> /><label for="inclinacion_incisivo_superior_disminuida">AUMENTADA</label>
		</div>
		<div class="col-sm-5 label label-read">
			<strong>OVERJET : </strong>
		</div>
		<div class="col-sm-7 field field-radio-check field-blue">
			<input type="radio" name="overjet" id="overjet_normal" value="normal" <?= checked(!empty($Diagnostic->overjet->normal)) ?> /><label for="overjet_normal">NORMAL</label>
			<input type="radio" name="overjet" id="overjet_aumentada" value="aumentada" <?= checked(!empty($Diagnostic->overjet->aumentada)) ?> /><label for="overjet_aumentada">AUMENTADA</label>
			<input type="radio" name="overjet" id="overjet_disminuida" value="disminuida" <?= checked(!empty($Diagnostic->overjet->disminuida)) ?> /><label for="overjet_disminuida">AUMENTADA</label>
		</div>
		<div class="col-sm-5 label label-read">
			<strong>OVERBITE : </strong>
		</div>
		<div class="col-sm-7 field field-radio-check field-blue">
			<input type="radio" name="overbite" id="overbite_normal" value="normal" <?= checked(!empty($Diagnostic->overbite->normal)) ?> /><label for="overbite_normal">NORMAL</label>
			<input type="radio" name="overbite" id="overbite_aumentada" value="aumentada" <?= checked(!empty($Diagnostic->overbite->aumentada)) ?> /><label for="overbite_aumentada">AUMENTADA</label>
			<input type="radio" name="overbite" id="overbite_disminuida" value="disminuida" <?= checked(!empty($Diagnostic->overbite->disminuida)) ?> /><label for="overbite_disminuida">AUMENTADA</label>
		</div>
		<div class="col-sm-5 label label-read">
			<strong>ANGULO INTERINCISIVO : </strong>
		</div>
		<div class="col-sm-7 field field-radio-check field-blue">
			<input type="radio" name="angulo_interincisivo" id="angulo_interincisivo_normal" value="normal" <?= checked(!empty($Diagnostic->angulo_interincisivo->normal)) ?> /><label for="angulo_interincisivo_normal">NORMAL</label>
			<input type="radio" name="angulo_interincisivo" id="angulo_interincisivo_aumentada" value="aumentada" <?= checked(!empty($Diagnostic->angulo_interincisivo->aumentada)) ?> /><label for="angulo_interincisivo_aumentada">AUMENTADA</label>
			<input type="radio" name="angulo_interincisivo" id="angulo_interincisivo_disminuida" value="disminuida" <?= checked(!empty($Diagnostic->angulo_interincisivo->disminuida)) ?> /><label for="angulo_interincisivo_disminuida">AUMENTADA</label>
		</div>
		<div class="col-sm-5 label label-read">
			<strong>PROTUSION LABIAL : </strong>
		</div>
		<div class="col-sm-7 field field-radio-check field-blue">
			<input type="radio" name="protusion_labial" id="protusion_labial_normal" value="normal" <?= checked(!empty($Diagnostic->protusion_labial->normal)) ?> /><label for="protusion_labial_normal">NORMAL</label>
			<input type="radio" name="protusion_labial" id="protusion_labial_aumentada" value="aumentada" <?= checked(!empty($Diagnostic->protusion_labial->aumentada)) ?> /><label for="protusion_labial_aumentada">AUMENTADA</label>
			<input type="radio" name="protusion_labial" id="protusion_labial_disminuida" value="disminuida" <?= checked(!empty($Diagnostic->protusion_labial->disminuida)) ?> /><label for="protusion_labial_disminuida">AUMENTADA</label>
		</div>
		<div class="col-sm-12 label label-read">
			<strong>OBSERVACIONES : </strong>
		</div>
		<div class="col-sm-12 field field-read field-blue">
			<textarea name="observaciones" id="observaciones"><?= isset_get($Diagnostic->observaciones) ?></textarea>
		</div>
	</div>
</form>