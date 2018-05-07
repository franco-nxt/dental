<form action="" method="POST" enctype="multipart/form-data">
	<div class="bar-btn">
		<div class="container">
			<h5 class="txt-left"><strong>ESTE PACIENTE HA SIDO SELECCIONADO PARA BORRAR</strong> : Si se procede a borrar se eliminara toda informaci&oacute;n y si las hubiera, fotograf&iacute;as, radiograf&iacute;as, cefalometr&iacute;as, diagn&oacute;stico, odontograma, tratamiento y datos econ&oacute;micos.</h5>
			<button class="btn btn-danger btn-ico-delete">ELIMINAR</button>
			<a class="btn btn-default btn-ico-x" href="<?= $Patient->url() ?>">CANCELAR</a>
		</div>
	</div>
</form>
<div class="patient">
	<div class="container">
		<div class="patient-main-data">
			<div class="patient-main-fields">
				<div class="col-xs-4 label label-read">
					<strong>APELLIDO : </strong>
				</div>
				<div class="col-xs-8 field field-read">
					<span><?= $Patient->apellido ?></span>
				</div>
				<div class="col-xs-4 label label-read">
					<strong>NOMBRE : </strong>
				</div>
				<div class="col-xs-8 field field-read">
					<span><?= $Patient->nombre ?></span>
				</div>
				<div class="col-xs-5 col-sm-4 label label-read">
					<strong>NACIMIENTO : </strong>
				</div>
				<div class="col-xs-7 col-sm-8 field field-read">
					<span><?= $Patient->fecha_nacimiento ?></span>
				</div>
			</div>
			<figure class="patient-main-img">
				<img src="<?= $Patient->thumb() ?>" alt="<?= $Patient->fullname() ?>" class="patient-img img-rounded" />
			</figure>
		</div>
	</div>
	<div class="patient-menu">
		<ul class="container">
			<li class="patient-menu-item"><a href="<?= $Patient->url('fotografias') ?>">FOTOGRAF&Iacute;AS</a></li>
			<li class="patient-menu-item"><a href="<?= $Patient->url('radiografias') ?>">RADIOGRAF&Iacute;AS</a></li>
			<li class="patient-menu-item"><a href="<?= $Patient->url('cefalometrias') ?>">CEFALOMET&Iacute;AS</a></li>
			<li class="patient-menu-item"><a href="<?= $Patient->url('diagnostico') ?>">DIAGN&Oacute;STICO</a></li>
			<li class="patient-menu-item"><a href="<?= $Patient->url('economia') ?>">ECONOM&Iacute;A</a></li>
			<li class="patient-menu-item"><a href="<?= $Patient->url('odontograma') ?>">ODONTOGRAMA</a></li>
			<li class="patient-menu-item"><a href="<?= $Patient->url('registros') ?>">REGISTRO DE ATENC&Iacute;ON</a></li>
		</ul>
	</div>
	<div class="container">
		<div>
			<div class="col-xs-4 label label-read">
				<strong>DNI : </strong>
			</div>
			<div class="col-xs-8 field field-read">
				<span><?= $Patient->dni ?></span>
			</div>
			<div class="col-xs-4 label label-read">
				<strong>TEL&Eacute;FONO : </strong>
			</div>
			<div class="col-xs-8 field field-read">
				<span><?= $Patient->telefono ?></span>
			</div>
			<div class="col-xs-4 label label-read">
				<strong>M&Oacute;VIL : </strong>
			</div>
			<div class="col-xs-8 field field-read">
				<span><?= $Patient->celular ?></span>
			</div>
			<div class="col-xs-4 label label-read">
				<strong>EMAIL : </strong>
			</div>
			<div class="col-xs-8 field field-read">
				<span><?= $Patient->correo_electronico ?></span>
			</div>
			<div class="col-xs-4 label label-read">
				<strong>SEXO : </strong>
			</div>
			<div class="col-xs-8 field field-read field-radio-check">
				<span class="<?= $Patient->sexo == MALE ? 'checked' : null ?>">M</span>
				<span class="<?= $Patient->sexo == FEMALE ? 'checked' : null ?>">F</span>
			</div>
			<div class="col-xs-4 label label-read">
				<strong>EDAD : </strong>
			</div>
			<div class="col-xs-8 field field-read">
				<span><?= $Patient->edad() ?></span>
			</div>
			<button class="more-data collapse-toggle" data-target="more-data">MAS DATOS</button>
			<div class="clear" id="more-data" style="display:none;">
				<div class="col-xs-4 label label-read">
					<strong>DIRECCIÓN : </strong>
				</div>
				<div class="col-xs-8 field field-read">
					<span><?= $Patient->direccion ?></span>
				</div>
				<div class="col-xs-4 label label-read">
					<strong>CIUDAD : </strong>
				</div>
				<div class="col-xs-8 field field-read">
					<span><?= $Patient->ciudad ?></span>
				</div>
				<div class="col-xs-4 label label-read">
					<strong>PROVINCIA : </strong>
				</div>
				<div class="col-xs-8 field field-read">
					<span><?= $Patient->provincia ?></span>
				</div>
				<div class="col-xs-4 label label-read">
					<strong>CP : </strong>
				</div>
				<div class="col-xs-8 field field-read">
					<span><?= $Patient->codigo_postal ?></span>
				</div>
				<div class="col-xs-6 col-sm-4 label label-read">
					<strong>APELLIDO MADRE : </strong>
				</div>
				<div class="col-xs-6 col-sm-8 field field-read">
					<span><?= $Patient->madre_apellido ?></span>
				</div>
				<div class="col-xs-6 col-sm-4 label label-read">
					<strong>NOMBRE MADRE : </strong>
				</div>
				<div class="col-xs-6 col-sm-8 field field-read">
					<span><?= $Patient->madre_nombre ?></span>
				</div>
				<div class="col-xs-6 col-sm-4 label label-read">
					<strong>APELLIDO PADRE : </strong>
				</div>
				<div class="col-xs-6 col-sm-8 field field-read">
					<span><?= $Patient->padre_apellido ?></span>
				</div>
				<div class="col-xs-6 col-sm-4 label label-read">
					<strong>NOMBRE PADRE : </strong>
				</div>
				<div class="col-xs-6 col-sm-8 field field-read">
					<span><?= $Patient->padre_nombre ?></span>
				</div>
				<div class="col-xs-6 col-sm-4 label label-read">
					<strong>DERIVADO POR : </strong>
				</div>
				<div class="col-xs-6 col-sm-8 field field-read">
					<span><?= $Patient->derivado_por ?></span>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="patient-tratamiento">
	<div class=" container">
		<div class="col-xs-10 col-sm-4 label label-read">
			<strong>DURACION DEL TRATAMIENTO : </strong> 
		</div>
		<div class="col-xs-2 col-sm-8 field field-read">
			<span><?= $Treatment->duracion ?> MES<?= $Treatment->duracion > 1 ? 'ES' : null ?></span>
		</div>
		<div class="col-xs-4 label label-read">
			<strong>T&Eacute;CNICA : </strong> 
		</div>
		<div class="col-xs-8 field field-read">
			<span><?= $Treatment->tecnica ?></span>
		</div>
		<div class="col-xs-3 col-sm-4 label label-read">
			<strong>ESTADO : </strong>
		</div>
		<div class="col-xs-9 col-sm-8 field field-read field-radio">
			<span class="<?= $Treatment->estado == TRATAMIENTO_FINALIZADO ? 'checked' : null ?>">FINALIZADO</span>
			<span class="<?= $Treatment->estado == TRATAMIENTO_INACTIVO ? 'checked' : null ?>">INACTIVO</span>
			<span class="<?= $Treatment->estado == TRATAMIENTO_ACTIVO ? 'checked' : null ?>">ACTIVO</span>
		</div>
		<div class="col-xs-5 col-sm-4 label label-read">
			<strong>FECHA INICIO : </strong>
		</div>
		<div class="col-xs-7 col-sm-8 field field-read">
			<span><?= $Treatment->fecha_hora_inicio ?> </span>
		</div>
		<div class="col-xs-5 col-sm-4 label label-read">
			<strong>PRESUPUESTO : </strong>
		</div>
		<div class="col-xs-7 col-sm-8 field field-read">
			<span><?= $Treatment->presupuesto ?> </span>
		</div>
		<div class="col-xs-3 col-sm-4 label label-read">
			<strong>AVANCE : </strong>
		</div>
		<div class="col-xs-9 col-sm-8 field field-read">
			<div class="progress row">
				<div class="progress-bar" role="progressbar" aria-valuenow="<?= $Treatment->progress() ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?= $Treatment->progress() ?>%;">
					<span class="sr-only"><?= $Treatment->progress() ?>%</span>
				</div>
			</div>
		</div>
		<div class="col-xs-12 label label-read">
			<strong class="show">DESCRIPCI&Oacute;N : </strong>
		</div>
		<div class="col-xs-12 field field-read">
			<span><?= $Treatment->descripcion ?></span>
		</div>
	</div>
</div>