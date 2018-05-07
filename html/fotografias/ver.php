<?php
!isset($Patient, $Treatment, $Photo) && redirect_exit();
!isset($model) && $model = $Photo->name;
?>
<div class="bar-subtitle">
	<div class="container">
		<a href="<?= $Patient->url() ?>"><?= $Patient->fullname() ?></a>
	</div>
</div>
<?php if ($Patient->check_user(get_user()->id)): ?>
<div class="bar-btn">
	<div class="container">
		<a class="btn btn-primary" href="<?=  $Photo->url('editar') ?>">EDITAR</a>
        <button class="btn btn-info" onclick="javascript:window.print()">IMPRIMIR</button>
	</div>
</div>
<?php endif ?>
<div class="container">
	<div class="row pt5">
		<div class="form-group clear col-sm-6 m0">
			<div class="col-xs-3 label label-read">
				<strong>FECHA : </strong>
			</div>
			<div class="col-xs-9 field field-blue field-read">
				<span><?= $Photo->fecha_hora ?></span>
			</div>
		</div>
		<div class="form-group clear col-sm-6 m0">
			<div class="col-xs-3 label label-read">
				<strong>ETAPA : </strong>
			</div>
			<div class="col-xs-9 field field-read field-radio field-blue">
				<span class="<?= $Photo->etapa == ETAPA_INICIALES ? 'checked' : null ?>">INICIALES</span>
				<span class="<?= $Photo->etapa == ETAPA_INTERMEDIAS ? 'checked' : null ?>">INTERMEDIAS</span>
				<span class="<?= $Photo->etapa == ETAPA_FINALES ? 'checked' : null ?>">FINALES</span>
			</div>
		</div>
	</div>
	<div class="sess s-f-<?= $model ?>">
		<?php foreach (Photo::get_session_model($model) as $classname): $thumb = $Photo->get_thumb($classname)?>
			<div class="sess-f <?= $classname ?>">
				<div style="background-image: url('<?= $thumb ? $thumb : constant('F_' . strtoupper($classname)) ?>')">
					<?php if ($thumb): ?>
					<a href="<?= $Photo->get_picture($classname) ?>" data-lightbox="image-1" ></a>
					<?php endif ?>
					<img src="<?= $thumb ? $thumb : constant('F_' . strtoupper($classname)) ?>" alt="<?= $classname ?>" class="visible-print" />
				</div>
			</div>
		<?php endforeach ?>
	</div>
</div>
