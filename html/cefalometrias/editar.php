<div class="bar-subtitle">
	<div class="container">
		<a href="<?= $Patient->url() ?>"><?= $Patient->fullname() ?></a>
	</div>
</div>
<form method="POST" enctype="multipart/form-data">
	<div class="bar-btn">
		<div class="container">
			<button class="btn btn-success btn-ico-check" name="action" value="save">GUARDAR</button>
			<a class="btn btn-default btn-ico-x" href="<?=  $Cephalometry->url('ver') ?>">CANCELAR</a>
			<button class="btn btn-danger btn-ico-delete" name="action" value="delete"> ELIMINAR</button>
		</div>
	</div>
	<div class="container">
		<div class="row pt5">
			<label for="photo_date" class="form-group clear col-sm-6 m0">
				<div class="col-xs-3 label">
					<strong>FECHA : </strong>
				</div>
				<div class="col-xs-9 field field-blue">
					<input type="text" id="photo_date" value="<?= $Cephalometry->fecha_hora ?>" name="fecha_hora" class="input-date text-input full">
				</div>
			</label>
			<div class="form-group clear col-sm-6 m0">
				<div class="col-xs-3 label label-read">
					<strong>ETAPA : </strong>
				</div>
				<div class="col-xs-9 field field-read field-radio-check field-blue">
					<input class="radio-input" type="radio" id="r_etapa_iniciales" <?= checked($Cephalometry->etapa == ETAPA_INICIALES) ?> value="<?= ETAPA_INICIALES ?>" name="etapa">
					<label class="radio-label" for="r_etapa_iniciales">INICIALES</label>
					<input class="radio-input" type="radio" id="r_etapa_intermedias" <?= checked($Cephalometry->etapa == ETAPA_INTERMEDIAS) ?> value="<?= ETAPA_INTERMEDIAS ?>" name="etapa">
					<label class="radio-label" for="r_etapa_intermedias">INTERMEDIAS</label>
					<input class="radio-input" type="radio" id="r_etapa_finales" <?= checked($Cephalometry->etapa == ETAPA_FINALES) ?> value="<?= ETAPA_FINALES ?>" name="etapa">
					<label class="radio-label" for="r_etapa_finales">FINALES</label>
				</div>
			</div>
			<div class="form-group clear col-sm-12 m0">
				<div class="col-xs-3 label label-read">
					<strong>TIPO : </strong>
				</div>
				<div class="col-xs-9 field field-read field-radio-check field-blue">
					<input class="radio-input" type="radio" id="r_etapa_ricketts" value="<?= CEFALOMETRIA_RICKETTS ?>" name="tipo" <?= checked($Cephalometry->tipo == CEFALOMETRIA_RICKETTS) ?>>
					<label class="radio-label" for="r_etapa_ricketts">RICKETTS</label>
					<input class="radio-input" type="radio" id="r_etapa_jarabak" value="<?= CEFALOMETRIA_JARABAK ?>" name="tipo" <?= checked($Cephalometry->tipo == CEFALOMETRIA_JARABAK) ?>>
					<label class="radio-label" for="r_etapa_jarabak">JARABAK</label>
					<input class="radio-input" type="radio" id="r_etapa_mcnamara" value="<?= CEFALOMETRIA_MCNAMARA ?>" name="tipo" <?= checked($Cephalometry->tipo == CEFALOMETRIA_MCNAMARA) ?>>
					<label class="radio-label" for="r_etapa_mcnamara">MCNAMARA</label>
					<input class="radio-input" type="radio" id="r_etapa_steiner" value="<?= CEFALOMETRIA_STEINER ?>" name="tipo" <?= checked($Cephalometry->tipo == CEFALOMETRIA_STEINER) ?>>
					<label class="radio-label" for="r_etapa_steiner">STEINER</label>
					<input class="radio-input" type="radio" id="r_etapa_otro" value="<?= CEFALOMETRIA_OTRO ?>" name="tipo" <?= checked($Cephalometry->tipo == CEFALOMETRIA_OTRO) ?>>
					<label class="radio-label" for="r_etapa_otro">OTRO</label>
					<input class="radio-input" type="radio" id="r_etapa_superposicion" value="<?= CEFALOMETRIA_SUPERPOSICION ?>" name="tipo" <?= checked($Cephalometry->tipo == CEFALOMETRIA_SUPERPOSICION) ?>>
					<label class="radio-label" for="r_etapa_superposicion">SUPERPOSICION</label>
				</div>
			</div>
		</div>
		<div class="sess s-c-<?= $Cephalometry->name ?>">
			<?php foreach (Cephalometry::get_session_model($Cephalometry->name) as $name): $thumb = $Cephalometry->get_thumb($name); $placeholder = constant('C_' . strtoupper($name)); ?>
				<div class="sess-c <?= $name ?>">
					<label for="sess-c-<?= $name ?>" id="label-sess-c-<?= $name ?>" style="background-image: url('<?= isset($thumb) ? $thumb : $placeholder ?>')" data-placeholder="<?= $placeholder ?>">
						<?php if ( $thumb ): // SI LA IMAGEN ESTA SETEADA AGREGO EL BOTON PARA ELEIMINARLA ?>
							<label for="trash_sess-c-<?= $name ?>" class="sess-trash btn-ico-delete">
								<input onchange="del_file.call(this)" type="checkbox" name="trash[]" value="<?= $name ?>" id="trash_sess-c-<?= $name ?>" data-src="<?= $thumb ?>" data-input="sess-c-<?= $name ?>" data-label="label-sess-c-<?= $name ?>">
							</label>
						<?php endif ?>
						<input onchange="drop_file.call(this)" type="file" name="<?= $name ?>" id="sess-c-<?= $name ?>">
					</label>
				</div>
			<?php endforeach ?>
		</div>
	</div>
</form>