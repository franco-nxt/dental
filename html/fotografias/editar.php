<?php
!isset($Patient, $Treatment, $Photo) && redirect_exit();
!isset($model) && $model = $Photo->name;
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
			<a class="btn btn-default btn-ico-x" href="<?=  $Photo->url('ver') ?>">CANCELAR</a>
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
					<input type="text" id="photo_date" value="<?= $Photo->fecha_hora ?>" name="fecha_hora" class="input-date text-input full">
				</div>
			</label>
			<div class="form-group clear col-sm-6 m0">
				<div class="col-xs-3 label label-read">
					<strong>ETAPA : </strong>
				</div>
				<div class="col-xs-9 field field-read field-radio-check field-blue">
					<input class="radio-input" type="radio" id="r_etapa_iniciales" <?= checked($Photo->etapa == ETAPA_INICIALES) ?> value="<?= ETAPA_INICIALES ?>" name="etapa">
					<label class="radio-label" for="r_etapa_iniciales">INICIALES</label>
					<input class="radio-input" type="radio" id="r_etapa_intermedias" <?= checked($Photo->etapa == ETAPA_INTERMEDIAS) ?> value="<?= ETAPA_INTERMEDIAS ?>" name="etapa">
					<label class="radio-label" for="r_etapa_intermedias">INTERMEDIAS</label>
					<input class="radio-input" type="radio" id="r_etapa_finales" <?= checked($Photo->etapa == ETAPA_FINALES) ?> value="<?= ETAPA_FINALES ?>" name="etapa">
					<label class="radio-label" for="r_etapa_finales">FINALES</label>
				</div>
			</div>
		</div>
		<div class="sess s-f-<?= $model ?>">
			<?php foreach (Photo::get_session_model($model) as $name): $thumb = $Photo->get_thumb($name); $placeholder = constant('F_' . strtoupper($name)); ?>
				<div class="sess-f <?= $name ?>">
					<label for="sess-f-<?= $name ?>" id="label-sess-f-<?= $name ?>" style="background-image: url('<?= isset($thumb) ? $thumb : $placeholder ?>')" data-placeholder="<?= $placeholder ?>">
						<?php if ( $thumb ): // SI LA IMAGEN ESTA SETEADA AGREGO EL BOTON PARA ELEIMINARLA ?>
							<label for="trash_sess-f-<?= $name ?>" class="sess-trash btn-ico-delete">
								<input onchange="del_file.call(this)" type="checkbox" name="trash[]" value="<?= $name ?>" id="trash_sess-f-<?= $name ?>" data-src="<?= $thumb ?>" data-input="sess-f-<?= $name ?>" data-label="label-sess-f-<?= $name ?>">
							</label>
						<?php endif ?>
						<input onchange="drop_file.call(this)" type="file" name="<?= $name ?>" id="sess-f-<?= $name ?>">
					</label>
				</div>
			<?php endforeach ?>
		</div>
	</div>
</form>