<?php
!isset($Patient, $Treatment, $Radiographie) && redirect_exit();
!isset($model) && $model = $Radiographie->name;
?>
<div class="bar-subtitle">
	<div class="container">
		<a href="<?= $Patient->url() ?>"><?= $Patient->fullname() ?></a>
	</div>
</div>
<?php if ($Patient->check_user(get_user()->id)): ?>
<div class="bar-btn">
	<div class="container">
		<a class="btn btn-primary" href="<?=  $Radiographie->url('editar') ?>">EDITAR</a>
        <button class="btn btn-info" onclick="javascript:window.print()">IMPRIMIR</button>
	</div>
</div>
<?php endif ?>
<div class="container">
	<div class="row pt5">
		<div class="form-group clear col-sm-6">
			<div class="col-xs-3 label label-read">
				<strong>FECHA : </strong>
			</div>
			<div class="col-xs-9 field field-blue field-read">
				<span><?= $Radiographie->fecha_hora ?></span>
			</div>
		</div>
		<div class="form-group clear col-sm-6">
			<div class="col-xs-3 label label-read">
				<strong>ETAPA : </strong>
			</div>
			<div class="col-xs-9 field field-read field-radio-check field-blue">
				<span class="<?= $Radiographie->etapa == ETAPA_INICIALES ? 'checked' : null ?>">INICIALES</span>
				<span class="<?= $Radiographie->etapa == ETAPA_INTERMEDIAS ? 'checked' : null ?>">INTERMEDIAS</span>
				<span class="<?= $Radiographie->etapa == ETAPA_FINALES ? 'checked' : null ?>">FINALES</span>
			</div>
		</div>
	</div>
	<div class="sess s-r-<?= $model ?>">
		<?php foreach (Radiographie::get_session_model($model) as $classname): $thumb = $Radiographie->get_thumb($classname);?>
			<div class="sess-r <?= $classname ?>">
				<div style="background-image: url('<?= $thumb ? $thumb : constant('R_' . strtoupper($classname)) ?>')">
					<?php if ($thumb): ?>
					<a href="<?= $Radiographie->get_picture($classname) ?>" data-lightbox="image-1"></a>
					<?php endif ?>
					<img src="<?= $thumb ? $thumb : constant('R_' . strtoupper($classname)) ?>" alt="<?= $classname ?>" class="visible-print" />
				</div>
			</div>
		<?php endforeach ?>
	</div>
</div>
