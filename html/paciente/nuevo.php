<form action="" method="POST" enctype="multipart/form-data">
	<div class="container bar-btn">
		<button class="btn btn-success btn-ico-check" name="action" value="save">GUARDAR</button>
		<a class="btn btn-default btn-ico-x" href="<?= URL_ROOT ?>">CANCELAR</a>
	</div>
	<div class="container paciente">
		<figure class="paciente-img-wrap">
			<div class="paciente-img" id="paciente-img">
				<img src="<?= PACIENTE_IMG ?>" class="img-rounded">
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
			<label for="patient_apellido" class="m0 form-group clear">
				<div class="col-xs-4 label">
					<strong>APELLIDO : </strong>
				</div>
				<div class="col-xs-8 field">
					<input type="text" id="patient_apellido" value="" name="apellido">
				</div>
			</label>
			<label for="patient_nombre" class="m0 form-group clear">
				<div class="col-xs-4 label">
					<strong>NOMBRE : </strong>
				</div>
				<div class="col-xs-8 field">
					<input type="text" id="patient_nombre" value="" name="nombre">
				</div>
			</label>
			<label for="patient_dni" class="m0 form-group clear">
				<div class="col-xs-4 label">
					<strong>DNI : </strong>
				</div>
				<div class="col-xs-8 field">
					<input type="text" id="patient_dni" value="" name="dni">
				</div>
			</label>
			<label for="patient_telefono" class="m0 form-group clear">
				<div class="col-xs-4 label">
					<strong>TEL&Eacute;FONO : </strong>
				</div>
				<div class="col-xs-8 field">
					<input type="text" id="patient_telefono" value="" name="telefono">
				</div>
			</label>
			<label for="patient_celular" class="m0 form-group clear">
				<div class="col-xs-4 label">
					<strong>M&Oacute;VIL : </strong>
				</div>
				<div class="col-xs-8 field">
					<input type="text" id="patient_celular" value="" name="celular">
				</div>
			</label>
			<label for="patient_correo_electronico" class="m0 form-group clear">
				<div class="col-xs-4 label">
					<strong>EMAIL : </strong>
				</div>
				<div class="col-xs-8 field">
					<input type="text" id="patient_correo_electronico" value="" name="correo_electronico">
				</div>
			</label>
			<div class="m0 form-group clear">
				<div class="col-xs-4 label">
					<strong>SEXO : </strong>
				</div>
				<div class="col-xs-8 field field-radio-check">
					<input type="radio" name="sexo" id="patient_genre_male" name="<?= MALE ?>">
					<label for="patient_genre_male">M</label>
					<input type="radio" name="sexo" id="patient_genre_female" name="<?= FEMALE ?>">
					<label for="patient_genre_female">F</label>
				</div>
			</div>
			<label for="patient_nacimiento" class="m0 form-group clear">
				<div class="col-xs-4 label">
					<strong>NACIMIENTO : </strong>
				</div>
				<div class="col-xs-8 field">
					<input type="text" id="patient_nacimiento" value="" name="fecha_nacimiento" class="input-date">
				</div>
			</label>
			<label for="patient_direccion" class="m0 form-group clear">
				<div class="col-xs-4 label label-read">
					<strong>DIRECCIÓN : </strong>
				</div>
				<div class="col-xs-8 field field-read">
					<input type="text" id="patient_direccion" value="" name="direccion"/>
				</div>
			</label>
			<label for="patient_ciudad" class="m0 form-group clear">
				<div class="col-xs-4 label label-read">
					<strong>CIUDAD : </strong>
				</div>
				<div class="col-xs-8 field field-read">
					<input type="text" id="patient_ciudad" value="" name="ciudad"/>
				</div>
			</label>
			<label for="patient_provincia" class="m0 form-group clear">
				<div class="col-xs-4 label label-read">
					<strong>PROVINCIA : </strong>
				</div>
				<div class="col-xs-8 field field-read">
					<input type="text" id="patient_provincia" value="" name="provincia"/>
				</div>
			</label>
			<label for="patient_cp" class="m0 form-group clear">
				<div class="col-xs-4 label label-read">
					<strong>CP : </strong>
				</div>
				<div class="col-xs-8 field field-read">
					<input type="text" id="patient_cp" value="" name="codigo_postal"/>
				</div>
			</label>
			<label for="patient_madre_apellido" class="m0 form-group clear">
				<div class="col-xs-6 col-sm-4 label label-read">
					<strong>APELLIDO MADRE : </strong>
				</div>
				<div class="col-xs-6 col-sm-8 field field-read">
					<input type="text" id="patient_madre_apellido" value="" name="madre_apellido"/>
				</div>
			</label>
			<label for="patient_madre_nombre" class="m0 form-group clear">
				<div class="col-xs-6 col-sm-4 label label-read">
					<strong>NOMBRE MADRE : </strong>
				</div>
				<div class="col-xs-6 col-sm-8 field field-read">
					<input type="text" id="patient_madre_nombre" value="" name="madre_nombre"/>
				</div>
			</label>
			<label for="patient_padre_apellido" class="m0 form-group clear">
				<div class="col-xs-6 col-sm-4 label label-read">
					<strong>APELLIDO PADRE : </strong>
				</div>
				<div class="col-xs-6 col-sm-8 field field-read">
					<input type="text" id="patient_padre_apellido" value="" name="padre_apellido"/>
				</div>
			</label>
			<label for="patient_padre_nombre" class="m0 form-group clear">
				<div class="col-xs-6 col-sm-4 label label-read">
					<strong>NOMBRE PADRE : </strong>
				</div>
				<div class="col-xs-6 col-sm-8 field field-read">
					<input type="text" id="patient_padre_nombre" value="" name="padre_nombre"/>
				</div>
			</label>
			<label for="patient_derivado_por" class="m0 form-group clear">
				<div class="col-xs-6 col-sm-4 label label-read">
					<strong>DERIVADO POR : </strong>
				</div>
				<div class="col-xs-6 col-sm-8 field field-read">
					<input type="text" id="patient_derivado_por" value="" name="derivado_por"/>
				</div>
			</label>
		</div>
	</div>
	<div class="container paciente-tratamiento">
		<label class="col-xs-10 col-sm-4 label label-read" for="treatment_duracion"><strong>DURACION DEL TRATAMIENTO : </strong></label> 
		<div class="col-xs-2 col-sm-8 field field-read">
			<select id="treatment_duracion" name="duracion">
				<?php for ($c = 1;$c <= 99;$c++): ?>
					<option value="<?= $c ?>"><?= $c ?> MES<?= $c != 1 ? 'ES' : null ?></option>
				<?php endfor ?>
			</select>
		</div>
		<label class="col-xs-4 label label-read" for="treatment_tecnica"><strong>T&Eacute;CNICA : </strong></label>
		<div class="col-xs-8 field field-read">
			<select id="treatment_tecnica" name="tecnica">
				<option value="2">ORTODONCIA</option>
				<option value="1" <?= selected(true) ?>>ORTOPEDIA FUNCIONAL</option>
			</select>
		</div>
		<label for="treatment_inicio" class="m0 form-group clear">
			<div class="col-xs-5 col-sm-4 label">
				<strong>FECHA INICIO : </strong>
			</div>
			<div class="col-xs-7 col-sm-8 field">
				<input type="text" id="treatment_inicio" value="" name="fecha_hora_inicio" class="input-date">
			</div>
		</label>
		<label for="treatment_presupuesto" class="form-group">
			<div class="col-xs-5 col-sm-4 label label-read">
				<strong>PRESUPUESTO : </strong>
			</div>
			<div class="col-xs-7 col-sm-8 field field-read">
				<input type="text" id="treatment_presupuesto" value="" name="presupuesto">
			</div>
		</label>
		<label for="treatment_descripcion" class="m0 form-group clear">
			<strong class="col-xs-12 label label-read">DESCRIPCI&Oacute;N : </strong>
			<div class="col-xs-12 field field-read">
				<textarea id="treatment_descripcion" name="descripcion"></textarea>
			</div>
		</label>
	</div>
</form>