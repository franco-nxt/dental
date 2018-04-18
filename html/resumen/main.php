<?php 
!isset($Patient , $Treatment) && redirect_exit();
$Resume = $Treatment->get_resume()->select();
?>
<div class="bar-subtitle">
	<div class="container">
		<a href="<?= $Patient->url() ?>"><?= $Patient->fullname() ?></a>
	</div>
</div>
<div class="bar-btn">
	<div class="container">
		<a href="<?= $Treatment->url('resumen', 'editar') ?>" class="btn btn-primary">EDITAR</a>
		<a href="<?= $Patient->url('diagnostico') ?>" class="btn btn-default">CANCELAR</a>
	</div>
</div>
<div class="container p5">
		<div class="bar-bordered">
			<span><?= $Treatment->inicio ?> - <?= $Treatment->estado ?> - <?= $Treatment->tecnica ?></span>
		</div>
	<div class="bar-bordered clear mb5">
		<strong>RESUMEN DIAGNOSTICO</strong>
	</div>
	<div class="sm-12 field field-radio-check field-blue">
		<span class="<?= empty($Resume->interceptivo_correctivo->interceptivo) ? null : 'checked' ?>">INTERCEPTIVO</span>
		<span class="<?= empty($Resume->interceptivo_correctivo->correctivo) ? null : 'checked' ?>">CORRECTIVO</span>
		<span class="<?= empty($Resume->esqueletal_dentario->esqueletal) ? null : 'checked' ?>">ESQUELETAL</span>
		<span class="<?= empty($Resume->esqueletal_dentario->dentario) ? null : 'checked' ?>">DENTARIO</span>
		<span class="<?= empty($Resume->esqueletal_dentario->esqueletal_dentario) ? null : 'checked' ?>">ESQUELETAL Y DENTARIO</span>
	</div>
	<div class="col-sm-4 col-md-3 label label-read">
		<strong>EXTRACCIONES : </strong>
	</div>
	<div class="col-sm-8 col-md-9 field field-radio field-blue">
		<span class="<?= empty($Resume->extracciones->si) ? null : 'checked' ?>">SI</span>
		<span class="<?= empty($Resume->extracciones->no) ? null : 'checked' ?>">NO</span>
		<?php if (!empty($Resume->extracciones->si)): ?>
		<strong>ESPECIFIRAR </strong>
		<span class="light c-fff"><?= isset_get($Resume->extracciones->especificar) ?></span>
		<?php endif ?>
	</div>
	<div class="col-sm-4 col-md-3 label label-read">
		<strong>ANCLAJE SUPERIOR : </strong>
	</div>
	<div class="col-sm-8 col-md-9 field field-radio-check field-blue">
		<span class="<?= empty($Resume->anclaje_sup->minimo) ? null : 'checked' ?>">MINIMO</span>
		<span class="<?= empty($Resume->anclaje_sup->moderado) ? null : 'checked' ?>">MODERADO</span>
		<span class="<?= empty($Resume->anclaje_sup->maximo) ? null : 'checked' ?>">MAXIMO</span>
	</div>
	<div class="col-sm-4 col-md-3 label label-read">
		<strong>ANCLAJE INFERIOR : </strong>
	</div>
	<div class="col-sm-8 col-md-9 field field-radio-check field-blue">
		<span class="<?= empty($Resume->anclaje_inf->minimo) ? null : 'checked' ?>">MINIMO</span>
		<span class="<?= empty($Resume->anclaje_inf->moderado) ? null : 'checked' ?>">MODERADO</span>
		<span class="<?= empty($Resume->anclaje_inf->maximo) ? null : 'checked' ?>">MAXIMO</span>
	</div>
	<div class="col-sm-4 col-md-3 label label-read">
		<strong>OBJETIVO EN ETAPAS : </strong>
	</div>
	<div class="col-sm-8 col-md-9 field field-read field-blue">
		<span><?= $Resume->objetivo_etapas ?></span>
	</div>
	<div class="col-sm-4 col-md-3 label label-read">
		<strong>PRONOSTICO : </strong>
	</div>
	<div class="col-sm-8 col-md-9 field field-radio-check field-blue">
		<span class="<?= empty($Resume->pronostico->favorable) ? null : 'checked' ?>">FAVORABLE</span>
		<span class="<?= empty($Resume->pronostico->reservado) ? null : 'checked' ?>">RESERVADO</span>
		<span class="<?= empty($Resume->pronostico->desfavorable) ? null : 'checked' ?>">DESFAVORABLE</span>
	</div>
	<div class="col-sm-4 col-md-3 label label-read">
		<strong>OBSERVACIONES : </strong>
	</div>
	<div class="col-sm-8 col-md-9 field field-read field-blue">
		<span><?= $Resume->observaciones ?></span>
	</div>
	<div class="clear m10 p10 txt-center" style="clear:both;">
		<h3 class="h5 c-fff">Duracion estimada del tratamiento <?= $Treatment->duracion ?> mes<?= $Treatment->duracion > 1 ? 'es' : null ?></h3>
	</div>
</div>