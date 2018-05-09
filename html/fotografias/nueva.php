<?php
!isset($Patient) && redirect_exit();
!isset($model) && redirect_exit();
!isset($User) && $User = get_user();
!isset($Tratamiento) && $Tratamiento = $Patient->get_treatment();
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
			<a class="btn btn-default btn-ico-x" href="<?= URL_ROOT ?>/fotografias/modelos/<?=  $Patient->url ?>">CANCELAR</a>
		</div>
	</div>
	<div class="container">
		<div class="row pt5">
			<label for="patient_apellido" class="form-group clear col-sm-6 m0">
				<div class="col-xs-3 label">
					<strong>FECHA</strong>
				</div>
				<div class="col-xs-9 field field-blue">
					<input type="text" id="patient_apellido" value="<?= date('d/m/y') ?>" name="fecha" class="input-date">
				</div>
			</label>
			<div class="form-group clear col-sm-6 m0">
				<div class="col-xs-3 label label-read">
					<strong>ETAPA : </strong>
				</div>
				<div class="col-xs-9 field field-read field-radio-check field-blue">
					<input type="radio" id="r_etapa_iniciales" value="<?= ETAPA_INICIALES ?>" name="etapa" <?= checked(true) ?>>
					<label for="r_etapa_iniciales">INICIALES</label>
					<input type="radio" id="r_etapa_intermedias" value="<?= ETAPA_INTERMEDIAS ?>" name="etapa">
					<label for="r_etapa_intermedias">INTERMEDIAS</label>
					<input type="radio" id="r_etapa_finales" value="<?= ETAPA_FINALES ?>" name="etapa">
					<label for="r_etapa_finales">FINALES</label>
				</div>
			</div>
		</div>
		<div class="sess s-f-<?= $model ?>">
			<?php foreach (Photo::get_session_model($model) as $classname): ?>
				<div class="sess-f <?= $classname ?>">
					<label for="sess-f-<?= $classname ?>" id="label-sess_f_<?= $classname ?>" style="background-image: url(<?= constant('F_' . strtoupper($classname)) ?>)">
						<input type="file" name="<?= $classname ?>" data-drop-label="label-sess_f_<?= $classname ?>">
					</label>
				</div>
			<?php endforeach ?>
		</div>
	</div>
</form>
