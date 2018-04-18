<div class="bar-subtitle">
	<div class="container">
		<a href="<?= $Patient->url() ?>"><?= $Patient->fullname() ?></a>
	</div>
</div>
<form class="bar-btn" method="POST">
	<div class="container">
		<button class="btn btn-danger btn-ico-delete" name="action" value="delete">ELIMINAR</button>
	</div>
</form>
<div class="container">
	<div>
		<div class="col-xs-4 label label-read">
			<strong>FECHA : </strong>
		</div>
		<div class="col-xs-8 field field-blue">
			<span><?= $Payment->fecha ?></span>
		</div>
		<div class="col-xs-4 label label-read">
			<strong>MONTO : </strong>
		</div>
		<div class="col-xs-8 field field-blue">
			<span><?= $Payment->monto ?></span>
		</div>
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
		<div class="col-xs-4 label label-read">
			<strong>MOTIVO DE PAGO : </strong>
		</div>
		<div class="col-xs-8 field field-blue">
			<span><?= $Payment->motivo ?></span>
		</div>
		<div class="col-xs-4 label label-read">
			<strong>ANOTACIONES : </strong>
		</div>
		<div class="col-xs-8 field field-blue">
			<span><?= $Payment->anotaciones ?></span>
		</div>
	</div>
</div>