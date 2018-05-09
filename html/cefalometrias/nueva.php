<?php
!isset($Patient, $model) && redirect_exit();
// !isset($Tratamiento) && $Tratamiento = $Patient->get_treatment();
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
			<a class="btn btn-default btn-ico-x" href="<?= URL_ROOT ?>/radiografias/modelos/<?=  $Patient->url ?>">CANCELAR</a>
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
			<div class="form-group clear col-sm-12 m0">
				<div class="col-xs-3 label label-read">
					<strong>TIPO : </strong>
				</div>
				<div class="col-xs-9 field field-read field-radio-check field-blue">
					<input type="radio" id="r_etapa_ricketts" value="<?= CEFALOMETRIA_RICKETTS ?>" name="tipo">
					<label for="r_etapa_ricketts">RICKETTS</label>
					<input type="radio" id="r_etapa_jarabak" value="<?= CEFALOMETRIA_JARABAK ?>" name="tipo">
					<label for="r_etapa_jarabak">JARABAK</label>
					<input type="radio" id="r_etapa_mcnamara" value="<?= CEFALOMETRIA_MCNAMARA ?>" name="tipo">
					<label for="r_etapa_mcnamara">MCNAMARA</label>
					<input type="radio" id="r_etapa_steiner" value="<?= CEFALOMETRIA_STEINER ?>" name="tipo">
					<label for="r_etapa_steiner">STEINER</label>
					<input type="radio" id="r_etapa_otro" value="<?= CEFALOMETRIA_OTRO ?>" name="tipo" <?= checked(true) ?>>
					<label for="r_etapa_otro">OTRO</label>
					<input type="radio" id="r_etapa_superposicion" value="<?= CEFALOMETRIA_SUPERPOSICION ?>" name="tipo">
					<label for="r_etapa_superposicion">SUPERPOSICION</label>
				</div>
			</div>
		</div>
		<div class="sess s-c-<?= $model ?>">
			<?php foreach (Cephalometry::get_session_model($model) as $classname): ?>
				<div class="sess-c <?= $classname ?>" <?= constant('C_' . strtoupper($classname)) ?>>
					<label for="sess-c-<?= $classname ?>" id="label-sess_c_<?= $classname ?>" style="background-image: url(<?= constant('C_' . strtoupper($classname)) ?>)">
						<input type="file" name="<?= $classname ?>" data-drop-label="label-sess_c_<?= $classname ?>">
					</label>
				</div>
			<?php endforeach ?>
		</div>
	</div>
</form>
