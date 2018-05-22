<div class="bar-subtitle">
	<div class="container">
		<a href="<?= $Patient->url() ?>"><?= $Patient->fullname() ?></a>
	</div>
</div>
<form method="POST" enctype="multipart/form-data">
	<div class="bar-btn">
		<div class="container">
			<button class="btn btn-success btn-ico-check" name="action" value="save">GUARDAR</button>
			<a class="btn btn-default btn-ico-x" href="<?=  $Patient->url('economia') ?>">CANCELAR</a>
		</div>
	</div>
	<div class="container">
		<h3 class="h5"><span>Presupuesto : $<?= $Treatment->presupuesto ?></span></h3>
		<label for="p_fecha" class="m0 form-group">
			<div class="col-sm-4 label">
				<strong>FECHA : </strong>
			</div>
			<div class="col-sm-8 field field-blue">
				<input type="text" id="p_fecha" value="<?= date('d/m/Y') ?>" name="fecha" class="input-date text-input full">
			</div>
		</label>
		<label for="p_monto" class="m0 form-group">
			<div class="col-sm-4 label">
				<strong>MONTO : </strong>
			</div>
			<div class="col-sm-8 field field-blue">
				<input type="text" id="p_monto" value="" name="monto" class="text-input full">
			</div>
		</label>
		<div class="col-sm-4 label label-read">
			<strong>AVANCE : </strong>
		</div>
		<div class="col-sm-8 field field-blue">
			<div class="progress row">
				<div class="progress-bar" role="progressbar" aria-valuenow="<?= $Treatment->progress() ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?= $Treatment->progress() ?>%;">
					<span class="sr-only"><?= $Treatment->progress() ?>%</span>
				</div>
			</div>
		</div>
		<label for="p_motivo" class="m0 form-group">
			<div class="col-sm-4 label">
				<strong>MOTIVO DE PAGO : </strong>
			</div>
			<div class="col-sm-8 field field-blue">
				<input type="text" id="p_motivo" value="" name="motivo" class="text-input full">
			</div>
		</label>
		<label for="p_anotaciones" class="m0 form-group clear">
			<strong class="label label-read">ANOTACIONES : </strong>
			<div class="field field-blue">
				<textarea id="p_anotaciones" name="anotaciones"></textarea>
			</div>
		</label>
	</div>
</form>