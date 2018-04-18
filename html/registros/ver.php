<?php
!isset($Patient, $Treatment, $Register) && redirect_exit();
!isset($User) && $User = get_user();
?>
<div class="bar-subtitle">
	<div class="container">
		<a href="<?= $Patient->url() ?>"><?= $Patient->fullname() ?></a>
	</div>
</div>
<div class="container">
	<div class="txt-center p5">
		<a href="<?= $Register->url('editar') ?>" class="btn btn-primary btn-ico-check">EDITAR REGISTRO</a>
		<a href="<?= $Patient->url('registros') ?>" class="btn btn-default btn-ico-x">CANCELAR</a>
	</div>
	<div class="bar-bordered">
		<span><?= $Treatment->inicio ?>	- <?= $Treatment->estado ?> - <?= $Treatment->tecnica ?></span>
	</div>
	<div class="row pt5">
		<div class="col-sm-6">
			<div class="col-xs-3 label">
				<strong>FECHA : </strong>
			</div>
			<div class="col-xs-9 field field-blue field-read">
				<span><?= $Register->fecha ?></span>
			</div>
		</div>
		<div class="col-sm-6">
			<div class="col-xs-3 label">
				<strong>HORA : </strong>
			</div>
			<div class="col-xs-9 field field-blue field-read">
				<span><?= $Register->hora ?></span>
			</div>
		</div>
		<div class="col-sm-6">
			<div class="col-xs-3 label">
				<strong>TECNICA : </strong>
			</div>
			<div class="col-xs-9 field field-blue field-read">
				<span><?= $Treatment->tecnica ?></span>
			</div>
		</div>
		<div class="col-sm-6">
			<div class="col-xs-3 label label-read">
				<strong>AVANCE : </strong>
			</div>
			<div class="col-xs-9 field field-blue field-read">
				<div class="progress row">
					<div class="progress-bar" role="progressbar" aria-valuenow="<?= $Treatment->progress() ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?= $Treatment->progress() ?>%;">
						<span class="sr-only"><?= $Treatment->progress() ?>%</span>
					</div>
				</div>
			</div>
		</div>
		<div class="col-xs-12">
			<div class="col-xs-3 col-sm-2 label label-read">
				<strong>MOTIVO : </strong>
			</div>
			<div class="col-xs-9 col-sm-10 field field-blue field-read">
				<span><?= $Register->motivo ?></span>
			</div>
		</div>
		<div class="col-xs-12">
			<div class="col-xs-12 label label-read">
				<strong class="show">DESCRIPCI&Oacute;N : </strong>
			</div>
			<div class="col-xs-12 field field-blue field-read">
				<span><?= $Register->descripcion ?></span>
			</div>
		</div>
	</div>
</div>