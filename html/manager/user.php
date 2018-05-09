<div class="container p5">
	<div>
		<figure class="col-md-3 mb5"><img src="<?= $user->foto ? URL_ROOT . "/img/perfil/{$user->foto}" : USER_IMG ?>" class="paciente-img img-rounded"></figure>
		<div class="clear col-md-9">
			<div class="col-xs-4 label label-read">
				<strong>APELLIDO : </strong>
			</div>
			<div class="col-xs-8 field field-blue field-read">
				<span><?= $user->apellido ?></span>
			</div>
			<div class="col-xs-4 label label-read">
				<strong>NOMBRE : </strong>
			</div>
			<div class="col-xs-8 field field-blue field-read">
				<span><?= $user->nombre ?></span>
			</div>
			<div class="col-xs-4 label label-read">
				<strong>CORREO : </strong>
			</div>
			<div class="col-xs-8 field field-blue field-read">
				<span><?= $user->correo_electronico ?></span>
			</div>
			<div class="col-xs-4 label label-read">
				<strong>TEL&Eacute;FONO : </strong>
			</div>
			<div class="col-xs-8 field field-blue field-read">
				<span><?= $user->telefono ?></span>
			</div>
			<div class="col-xs-4 label label-read">
				<strong>MOVIL : </strong>
			</div>
			<div class="col-xs-8 field field-blue field-read">
				<span><?= $user->celular ?></span>
			</div>
			<div class="col-xs-4 label label-read">
				<strong>DIRECCI&Oacute;N : </strong>
			</div>
			<div class="col-xs-8 field field-blue field-read">
				<span><?= $user->direccion ?></span>
			</div>
			<div class="col-xs-4 label label-read">
				<strong>CIUDAD : </strong>
			</div>
			<div class="col-xs-8 field field-blue field-read">
				<span><?= $user->ciudad ?></span>
			</div>
			<div class="col-xs-4 label label-read">
				<strong>PROVINCIA : </strong>
			</div>
			<div class="col-xs-8 field field-blue field-read">
				<span><?= $user->provincia ?></span>
			</div>
			<div class="col-xs-4 label label-read">
				<strong>PA&Iacute;S : </strong>
			</div>
			<div class="col-xs-8 field field-blue field-read">
				<span><?= $user->codigo_postal ?></span>
			</div>
		</div>
		<h4 class="bar-bordered">
			Suscripciones
		</h4>
		<div class="table-rounded">
			<table class="table">
				<thead>
					<tr>
						<th>ESTADO</th>
						<th>TARJETA</th>
						<th>FECHA SUBSCRIPCION</th>
						<th>IMPORTE</th>
						<th>FECHA DESUBSCRIPCION</th>
					</tr>
				</thead>
				<tbody>
				</tbody>
			</table>
		</div>
		<h4 class="bar-bordered">
			Debitos
		</h4>
		<div class="table-rounded">
			<table class="table">
				<thead>
					<tr>
						<th>ID</th>
						<th>TARJETA</th>
						<th>IMPORTE</th>
						<th>APLICADO</th>
						<th>FECHA DEBITO</th>
						<th>OBSERVACIONES</th>
						<th>COD</th>
					</tr>
				</thead>
				<tbody>
				</tbody>
			</table>
		</div>
	</div>
</div>