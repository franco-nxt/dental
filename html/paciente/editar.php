<?php
!isset($Patient) && redirect_exit();
!isset($User) && $User = get_user();
!isset($Treatment) && $Treatment = $Patient->get_treatment();
?>
<form action="" method="POST" enctype="multipart/form-data">
	<div class="bar-btn">
		<div class="container">
			<button class="btn btn-success btn-ico-check" name="action" value="save">GUARDAR</button>
			<a class="btn btn-default btn-ico-x" href="<?= $Treatment->url() ?>">CANCELAR</a>
			<a class="btn btn-danger btn-ico-delete" href="<?= $Patient->url('eliminar') ?>">ELIMINAR</a>
		</div>
	</div>
	<div class="paciente">
		<div class="container">
			<figure class="paciente-img-wrap">
				<div class="paciente-img" id="paciente-img">
					<img src="<?= $Patient->thumb() ?>" alt="<?= $Patient->fullname() ?>" class="img-rounded">
				</div>
				<div>
					<figcaption>
						<label for="patient_img" class="btn btn-primary">
							<input type="file" id="patient_img" class="upload-img-btn" data-target="paciente-img" style="display: none" name="img" />
							CARGAR FOTO
						</label>
						<h5>150 x 150</h5>
					</figcaption>
				</div>
			</figure>
			<div>
				<label for="patient_apellido" class="form-group m0 clear">
					<div class="col-xs-4 label">
						<strong>APELLIDO : </strong>
					</div>
					<div class="col-xs-8 field">
						<input type="text" id="patient_apellido" value="<?= $Patient->apellido ?>" name="apellido">
					</div>
				</label>
				<label for="patient_nombre" class="form-group m0 clear">
					<div class="col-xs-4 label">
						<strong>NOMBRE : </strong>
					</div>
					<div class="col-xs-8 field">
						<input type="text" id="patient_nombre" value="<?= $Patient->nombre ?>" name="nombre">
					</div>
				</label>
				<label for="patient_dni" class="form-group m0 clear">
					<div class="col-xs-4 label">
						<strong>DNI : </strong>
					</div>
					<div class="col-xs-8 field">
						<input type="text" id="patient_dni" value="<?= $Patient->dni ?>" name="dni">
					</div>
				</label>
				<label for="patient_telefono" class="form-group m0 clear">
					<div class="col-xs-4 label">
						<strong>TEL&Eacute;FONO : </strong>
					</div>
					<div class="col-xs-8 field">
						<input type="text" id="patient_telefono" value="<?= $Patient->telefono ?>" name="telefono">
					</div>
				</label>
				<label for="patient_celular" class="form-group m0 clear">
					<div class="col-xs-4 label">
						<strong>M&Oacute;VIL : </strong>
					</div>
					<div class="col-xs-8 field">
						<input type="text" id="patient_celular" value="<?= $Patient->celular ?>" name="celular">
					</div>
				</label>
				<label for="patient_correo_electronico" class="form-group m0 clear">
					<div class="col-xs-4 label">
						<strong>EMAIL : </strong>
					</div>
					<div class="col-xs-8 field">
						<input type="text" id="patient_correo_electronico" value="<?= $Patient->correo_electronico ?>" name="correo_electronico">
					</div>
				</label>
				<div class="form-group m0 clear">
					<div class="col-xs-4 label">
						<strong>SEXO : </strong>
					</div>
					<div class="col-xs-8 field field-radio-check">
						<input type="radio" name="sexo" id="patient_genre_male" <?= checked($Patient->genero == MALE) ?> value="<?= BD_MALE ?>"><label for="patient_genre_male">M</label>
						<input type="radio" name="sexo" id="patient_genre_female" <?= checked($Patient->genero == FEMALE) ?> value="<?= BD_FEMALE ?>"><label for="patient_genre_female">F</label>
					</div>
				</div>
				<label for="patient_fecha_nacimiento" class="form-group m0 clear">
					<div class="col-xs-4 label">
						<strong>NACIMIENTO : </strong>
					</div>
					<div class="col-xs-8 field">
						<input type="text" id="patient_fecha_nacimiento" value="<?= $Patient->nacimiento ?>" name="fecha_nacimiento" class="input-date">
					</div>
				</label>
				<label for="patient_direccion" class="form-group m0 clear">
					<div class="col-xs-4 label label-read">
						<strong>DIRECCIÓN : </strong>
					</div>
					<div class="col-xs-8 field field-read">
						<input type="text" id="patient_direccion" value="<?= $Patient->direccion ?>" name="direccion"/>
					</div>
				</label>
				<label for="patient_ciudad" class="form-group m0 clear">
					<div class="col-xs-4 label label-read">
						<strong>CIUDAD : </strong>
					</div>
					<div class="col-xs-8 field field-read">
						<input type="text" id="patient_ciudad" value="<?= $Patient->ciudad ?>" name="ciudad"/>
					</div>
				</label>
				<label for="patient_provincia" class="form-group m0 clear">
					<div class="col-xs-4 label label-read">
						<strong>PROVINCIA : </strong>
					</div>
					<div class="col-xs-8 field field-read">
						<input type="text" id="patient_provincia" value="<?= $Patient->provincia ?>" name="provincia"/>
					</div>
				</label>
				<label for="patient_cp" class="form-group m0 clear">
					<div class="col-xs-4 label label-read">
						<strong>CP : </strong>
					</div>
					<div class="col-xs-8 field field-read">
						<input type="text" id="patient_cp" value="<?= $Patient->codigo_postal ?>" name="codigo_postal"/>
					</div>
				</label>
				<label for="patient_madre_apellido" class="form-group m0 clear">
					<div class="col-xs-6 col-sm-4 label label-read">
						<strong>APELLIDO MADRE : </strong>
					</div>
					<div class="col-xs-6 col-sm-8 field field-read">
						<input type="text" id="patient_madre_apellido" value="<?= $Patient->madre_apellido ?>" name="madre_apellido"/>
					</div>
				</label>
				<label for="patient_madre_nombre" class="form-group m0 clear">
					<div class="col-xs-6 col-sm-4 label label-read">
						<strong>NOMBRE MADRE : </strong>
					</div>
					<div class="col-xs-6 col-sm-8 field field-read">
						<input type="text" id="patient_madre_nombre" value="<?= $Patient->madre_nombre ?>" name="madre_nombre"/>
					</div>
				</label>
				<label for="patient_padre_apellido" class="form-group m0 clear">
					<div class="col-xs-6 col-sm-4 label label-read">
						<strong>APELLIDO PADRE : </strong>
					</div>
					<div class="col-xs-6 col-sm-8 field field-read">
						<input type="text" id="patient_padre_apellido" value="<?= $Patient->padre_apellido ?>" name="padre_apellido"/>
					</div>
				</label>
				<label for="patient_padre_nombre" class="form-group m0 clear">
					<div class="col-xs-6 col-sm-4 label label-read">
						<strong>NOMBRE PADRE : </strong>
					</div>
					<div class="col-xs-6 col-sm-8 field field-read">
						<input type="text" id="patient_padre_nombre" value="<?= $Patient->padre_nombre ?>" name="padre_nombre"/>
					</div>
				</label>
				<label for="patient_derivado_por" class="form-group m0 clear">
					<div class="col-xs-6 col-sm-4 label label-read">
						<strong>DERIVADO POR : </strong>
					</div>
					<div class="col-xs-6 col-sm-8 field field-read">
						<input type="text" id="patient_derivado_por" value="<?= $Patient->derivado_por ?>" name="derivado_por"/>
					</div>
				</label>
			</div>
		</div>
	</div>
	<div class="paciente-tratamiento">
		<div class="container">
			<?php if ($Treatment->estado !== TRATAMIENTO_ACTIVO): ?>
			<div class="notification mb5">
				<span>Para iniciar un tratamiento nuevo o eliminar, primero es necesario <strong>FINALIZAR</strong> o <strong>INACTIVAR</strong> el corriente.</span>
			</div>
			<?php endif ?>
			<label class="col-xs-10 col-sm-4 label label-read" for="treatment_duracion"><strong>DURACION DEL TRATAMIENTO : </strong></label> 
			<div class="col-xs-2 col-sm-8 field field-read">
				<select id="treatment_duracion" name="duracion">
					<?php for ($c = 1;$c <= 99;$c++): ?>
						<option value="<?= $c ?>" <?= selected($Treatment->duracion == $c) ?>><?= $c ?> MES<?= $c != 1 ? 'ES' : null ?></option>
					<?php endfor ?>
				</select>
			</div>
			<label class="col-xs-4 label label-read" for="treatment_tecnica"><strong>T&Eacute;CNICA : </strong></label>
			<div class="col-xs-8 field field-read">
				<select id="treatment_tecnica" name="tecnica">
					<option value="2" <?= selected($Treatment->tecnica == TECNICA_2) ?>>ORTODONCIA</option>
					<option value="1" <?= selected($Treatment->tecnica == TECNICA_1) ?>>ORTOPEDIA FUNCIONAL</option>
				</select>
			</div>
			<div class="col-xs-3 col-sm-4 label label-read">
				<strong>ESTADO : </strong>
			</div>
			<div class="col-xs-9 col-sm-8 field field-read field-radio">
				<input type="radio" id="treatment_<?= TRATAMIENTO_FINALIZADO ?>" <?= checked($Treatment->estado == TRATAMIENTO_FINALIZADO) ?> value="<?= TRATAMIENTO_FINALIZADO ?>" name="estado">
				<label for="treatment_<?= TRATAMIENTO_FINALIZADO ?>">FINALIZADO</label>
				<input type="radio" id="treatment_<?= TRATAMIENTO_INACTIVO ?>" <?= checked($Treatment->estado == TRATAMIENTO_INACTIVO) ?> value="<?= TRATAMIENTO_INACTIVO ?>" name="estado">
				<label for="treatment_<?= TRATAMIENTO_INACTIVO ?>">INACTIVO</label>
				<input type="radio" id="treatment_<?= TRATAMIENTO_ACTIVO ?>" <?= checked($Treatment->estado == TRATAMIENTO_ACTIVO) ?> value="<?= TRATAMIENTO_ACTIVO ?>" name="estado">
				<label for="treatment_<?= TRATAMIENTO_ACTIVO ?>">ACTIVO</label>
			</div>
			<label for="treatment_inicio" class="form-group m0 clear">
				<div class="col-xs-4 label">
					<strong>FECHA INICIO : </strong>
				</div>
				<div class="col-xs-8 field">
					<input type="text" id="treatment_inicio" value="<?= $Treatment->inicio ?>" name="fecha_hora_inicio" class="input-date">
				</div>
			</label>
			<label for="treatment_presupuesto" class="form-group m0 clear">
				<div class="col-xs-5 col-sm-4 label label-read">
					<strong>PRESUPUESTO : </strong>
				</div>
				<div class="col-xs-7 col-sm-8 field field-read">
					<input type="text" id="treatment_presupuesto" value="<?= $Treatment->presupuesto ?>" name="presupuesto">
				</div>
			</label>
			<label for="treatment_descripcion" class="form-group m0 clear">
				<strong class="col-xs-12 label label-read">DESCRIPCI&Oacute;N : </strong>
				<div class="col-xs-12 field field-read">
					<textarea id="treatment_descripcion" name="descripcion"><?= $Treatment->descripcion ?></textarea>
				</div>
			</label>
			<?php if ($Treatment->estado !== TRATAMIENTO_ACTIVO): ?>
			<div class="clear p10 txt-center">
				<a class="btn btn-primary" href="<?= $Patient->url('tratamiento/nuevo') ?>">INICIAR NUEVO TRATAMIENTO</a>
			</div>
			<?php endif ?>
		</div>
	</div>
</form>