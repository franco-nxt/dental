<?php
!isset($Patient, $Treatment) && redirect_exit();
!isset($User) && $User = get_user();
?>
<div class="bar-subtitle">
	<div class="container">
		<a href="<?= $Patient->url() ?>"><?= $Patient->fullname() ?></a>
	</div>
</div>
<form method="POST" enctype="multipart/form-data">
	<div class="bar-btn">
		<div class="container">
			<button class="btn btn-success btn-ico-check" name="action" value="save">GUARDAR</button>
			<a class="btn btn-default btn-ico-x" href="<?= URL_ROOT ?>/fotografias/modelos/<?=  $Paciente->url ?>">CANCELAR</a>
		</div>
	</div>
	<div class="container">
		<label class="col-xs-10 col-sm-4 label label-read" for="treatment_duracion"><strong>DURACION DEL TRATAMIENTO : </strong></label> 
		<div class="col-xs-2 col-sm-8 field field-blue">
			<select id="treatment_duracion" name="duracion">
				<?php for ($c = 1;$c <= 99;$c++): ?>
					<option value="<?= $c ?>" <?= selected($Treatment->duracion == $c) ?>><?= $c ?> MES<?= $c != 1 ? 'ES' : null ?></option>
				<?php endfor ?>
			</select>
		</div>
		<label class="col-xs-4 label label-read" for="treatment_tecnica"><strong>T&Eacute;CNICA : </strong></label>
		<div class="col-xs-8 field field-blue">
			<select id="treatment_tecnica" name="tecnica">
				<option value="1" <?= selected($Treatment->tecnica == TECNICA_ORTOPEDIA_FUNCIONAL) ?>>ORTOPEDIA FUNCIONAL</option>
				<option value="2" <?= selected($Treatment->tecnica == TECNICA_ORTODONCIA) ?>>ORTODONCIA</option>
			</select>
		</div>
		<label for="treatment_inicio" class="form-group clear m0">
			<div class="col-xs-4 label">
				<strong>FECHA INICIO : </strong>
			</div>
			<div class="col-xs-8 field field-blue">
				<input type="text" id="treatment_inicio" value="<?= $Treatment->inicio ?>" name="fecha_hora_inicio" class="input-date">
			</div>
		</label>
		<label for="treatment_presupuesto" class="form-group clear m0">
			<div class="col-xs-5 col-sm-4 label label-read">
				<strong>PRESUPUESTO : </strong>
			</div>
			<div class="col-xs-7 col-sm-8 field field-blue">
				<input type="text" id="treatment_presupuesto" value="<?= $Treatment->presupuesto ?>" name="presupuesto">
			</div>
		</label>
		<label for="treatment_descripcion" class="form-group clear m0">
			<strong class="label label-read">DESCRIPCI&Oacute;N : </strong>
			<div class="field field-blue">
				<textarea id="treatment_descripcion" name="descripcion"><?= $Treatment->descripcion ?></textarea>
			</div>
		</label>
	</div>
</form>