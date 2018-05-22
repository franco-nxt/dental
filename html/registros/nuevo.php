<?php
!isset($Patient, $Treatment) && redirect_exit();
!isset($User) && $User = get_user();
?>
<div class="bar-subtitle">
	<div class="container">
		<a href="<?= $Patient->url() ?>"><?= $Patient->fullname() ?></a>
	</div>
</div>
<form class="container" method="POST">
	<div class="txt-center p5">
		<button class="btn btn-primary btn-ico-check">GUARDAR</button>
		<a href="<?= $Patient->url('registros') ?>" class="btn btn-default btn-ico-x">CANCELAR</a>
	</div>
	<div class="bar-bordered">
		<span><?= $Treatment->fecha_hora_inicio ?>	- <?= $Treatment->estado ?> - <?= $Treatment->tecnica ?></span>
	</div>
	<div class="row pt5">
		<label for="reg_fecha" class="form-group col-sm-6 m0">
			<div class="col-xs-3 label">
				<strong>FECHA : </strong>
			</div>
			<div class="col-xs-9 field field-blue">
				<input type="text" id="reg_fecha" value="<?= date('d/m/Y') ?>" name="fecha" class="input-date text-input full">
			</div>
		</label>
		<label for="reg_hora" class="form-group col-sm-6 m0">
			<div class="col-xs-3 label">
				<strong>HORA : </strong>
			</div>
			<div class="col-xs-9 field field-blue">
				<input type="text" id="reg_hora" value="<?= date('H:i') ?>" name="hora" class="input-time text-input full">
			</div>
		</label>
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
		<label for="reg_motiv" class="form-group col-sm-12 m0">
			<div class="col-xs-3 col-sm-2 label">
				<strong>MOTIVO : </strong>
			</div>
			<div class="col-xs-9 col-sm-10 field field-blue">
				<input type="text" id="reg_motiv" value="<?= '' ?>" name="motivo" class="text-input full">
			</div>
		</label>
		<label for="reg_descripcion" class="form-group col-sm-12 m0">
			<strong class="col-xs-12 label label-read">DESCRIPCI&Oacute;N : </strong>
			<div class="col-xs-12 field field-blue field-read">
				<textarea id="reg_descripcion" name="descripcion"><?= '' ?></textarea>
			</div>
		</label>
	</div>
</form>