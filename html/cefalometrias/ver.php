<div class="bar-subtitle">
	<div class="container">
		<a href="<?= $Patient->url() ?>"><?= $Patient->fullname() ?></a>
	</div>
</div>
<?php if ($Patient->check_user(get_user()->id)): ?>
<div class="bar-btn">
	<div class="container">
		<a class="btn btn-primary" href="<?=  $Cephalometry->url('editar') ?>">EDITAR</a>
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
				<span><?= $Cephalometry->fecha_hora ?></span>
			</div>
		</div>
		<div class="form-group clear col-sm-6 m0">
			<div class="col-xs-3 label label-read">
				<strong>ETAPA : </strong>
			</div>
			<div class="col-xs-9 field field-read field-radio-check field-blue">
				<span class="radio-label <?= $Cephalometry->etapa == ETAPA_INICIALES ? 'checked' : null ?>">INICIALES</span>
				<span class="radio-label <?= $Cephalometry->etapa == ETAPA_INTERMEDIAS ? 'checked' : null ?>">INTERMEDIAS</span>
				<span class="radio-label <?= $Cephalometry->etapa == ETAPA_FINALES ? 'checked' : null ?>">FINALES</span>
			</div>
		</div>
		<div class="form-group clear col-sm-12 m0">
			<div class="col-xs-3 label label-read">
				<strong>TIPO : </strong>
			</div>
			<div class="col-xs-9 field field-read field-radio-check field-blue">
				<span class="radio-label <?= $Cephalometry->tipo == CEFALOMETRIA_RICKETTS ? 'checked' : null ?>">RICKETTS</span>
				<span class="radio-label <?= $Cephalometry->tipo == CEFALOMETRIA_JARABAK ? 'checked' : null ?>">JARABAK</span>
				<span class="radio-label <?= $Cephalometry->tipo == CEFALOMETRIA_MCNAMARA ? 'checked' : null ?>">MCNAMARA</span>
				<span class="radio-label <?= $Cephalometry->tipo == CEFALOMETRIA_STEINER ? 'checked' : null ?>">STEINER</span>
				<span class="radio-label <?= $Cephalometry->tipo == CEFALOMETRIA_OTRO ? 'checked' : null ?>">OTRO</span>
				<span class="radio-label <?= $Cephalometry->tipo == CEFALOMETRIA_SUPERPOSICION ? 'checked' : null ?>">SUPERPOSICION</span>
			</div>
		</div>
	</div>
	<div class="sess s-c-<?= $Cephalometry->name ?>">
		<?php foreach (Cephalometry::get_session_model($Cephalometry->name) as $classname): $thumb = $Cephalometry->get_thumb($classname);?>
			<div class="sess-c <?= $classname ?>">
				<div style="background-image: url('<?= $thumb ? $thumb : constant('C_' . strtoupper($classname)) ?>')">
					<?php if ($thumb): ?>
					<a href="<?= $Cephalometry->get_picture($classname) ?>" data-lightbox="image-1"></a>
					<?php endif ?>
					<img src="<?= $thumb ? $thumb : constant('C_' . strtoupper($classname)) ?>" alt="<?= $classname ?>" class="visible-print" />
				</div>
			</div>
		<?php endforeach ?>
	</div>
</div>
