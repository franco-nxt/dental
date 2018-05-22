<?php
!isset($Patient, $Treatment, $Radiographie) && redirect_exit();
!isset($model) && $model = $Radiographie->name;
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
			<a class="btn btn-default btn-ico-x" href="<?=  $Radiographie->url('ver') ?>">CANCELAR</a>
			<button class="btn btn-danger btn-ico-delete" name="action" value="delete"> ELIMINAR</button>
		</div>
	</div>
	<div class="container">
		<div class="row pt5">
			<label for="photo_date" class="form-group clear col-sm-6">
				<div class="col-xs-3 label">
					<strong>FECHA : </strong>
				</div>
				<div class="col-xs-9 field field-blue">
					<input type="text" id="photo_date" value="<?= $Radiographie->fecha_hora ?>" name="fecha_hora" class="input-date text-input full">
				</div>
			</label>
			<div class="form-group clear col-sm-6">
				<div class="col-xs-3 label label-read">
					<strong>ETAPA : </strong>
				</div>
				<div class="col-xs-9 field field-read field-radio-check field-blue">
					<input class="radio-input" type="radio" id="r_etapa_iniciales" <?= checked($Radiographie->etapa == ETAPA_INICIALES) ?> value="<?= ETAPA_INICIALES ?>" name="etapa">
					<label class="radio-label" for="r_etapa_iniciales">INICIALES</label>
					<input class="radio-input" type="radio" id="r_etapa_intermedias" <?= checked($Radiographie->etapa == ETAPA_INTERMEDIAS) ?> value="<?= ETAPA_INTERMEDIAS ?>" name="etapa">
					<label class="radio-label" for="r_etapa_intermedias">INTERMEDIAS</label>
					<input class="radio-input" type="radio" id="r_etapa_finales" <?= checked($Radiographie->etapa == ETAPA_FINALES) ?> value="<?= ETAPA_FINALES ?>" name="etapa">
					<label class="radio-label" for="r_etapa_finales">FINALES</label>
				</div>
			</div>
		</div>
		<div class="sess s-r-<?= $model ?>">
			<?php foreach (Radiographie::get_session_model($model) as $name): $thumb = $Radiographie->get_thumb($name); $placeholder = constant('R_' . strtoupper($name)); ?>
				<div class="sess-r <?= $name ?>">
					<label for="sess-r-<?= $name ?>" id="label-sess-r-<?= $name ?>" style="background-image: url('<?= isset($thumb) ? $thumb : $placeholder ?>')" data-placeholder="<?= $placeholder ?>">
						<?php if ( $thumb ): // SI LA IMAGEN ESTA SETEADA AGREGO EL BOTON PARA ELEIMINARLA ?>
							<label for="trash_sess-r-<?= $name ?>" class="sess-trash btn-ico-delete">
								<input onchange="del_file.call(this)" type="checkbox" name="trash[]" value="<?= $name ?>" id="trash_sess-r-<?= $name ?>" data-src="<?= $thumb ?>" data-input="sess-r-<?= $name ?>" data-label="label-sess-r-<?= $name ?>">
							</label>
						<?php endif ?>
						<input onchange="drop_file.call(this)" type="file" name="<?= $name ?>" id="sess-r-<?= $name ?>">
					</label>
				</div>
			<?php endforeach ?>
		</div>
	</div>
</form>