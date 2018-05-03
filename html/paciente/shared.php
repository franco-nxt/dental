<?php
!isset($Patient) && redirect_exit();
!isset($User) && $User = get_user();
!isset($Treatment) && $Treatment = $Patient->get_treatment();
?>
<div class="paciente">
	<div class="container">
		<figure><img src="<?= $Patient->thumb() ?>" alt="<?= $Patient->fullname() ?>" class="paciente-img img-rounded"></figure>
		<div>
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
			<div class="col-xs-5 col-sm-4 label label-read">
				<strong>NACIMIENTO : </strong>
			</div>
			<div class="col-xs-7 col-sm-8 field field-read">
				<span><?= $Patient->fecha_nacimiento ?></span>
			</div>
			<div class="col-xs-4 label label-read">
				<strong>EDAD : </strong>
			</div>
			<div class="col-xs-8 field field-read">
				<span><?= $Patient->edad() ?></span>
			</div>
		</div>
	</div>
</div>
<div class="paciente-tratamiento">
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
<div class="container">
	<ul class="paciente-menu">
		<li class="paciente-menu-item"><a href="<?= $Patient->url('fotografias') ?>">FOTOGRAF&Iacute;AS</a></li>
		<li class="paciente-menu-item"><a href="<?= $Patient->url('radiografias') ?>">RADIOGRAF&Iacute;AS</a></li>
		<li class="paciente-menu-item"><a href="<?= $Patient->url('cefalometrias') ?>">CEFALOMET&Iacute;AS</a></li>
	</ul>
</div>