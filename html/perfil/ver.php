<div class="bar-btn">
	<div class="container">
		<a class="btn btn-info" href="<?= URL_ROOT ?>/perfil/id">GENERAR ID</a>
		<a class="btn btn-primary" href="<?= URL_ROOT ?>/perfil/editar">EDITAR</a>
	</div>
</div>
<div class="container p5">
	<div>
		<figure class="col-md-3 mb5"><img src="<?= $User->get_picture() ?>" class="paciente-img img-rounded"></figure>
		<div class="clear col-md-9">
			<div class="col-xs-4 label label-read">
				<strong>APELLIDO : </strong>
			</div>
			<div class="col-xs-8 field field-blue field-read">
				<span><?= $User->apellido ?></span>
			</div>
			<div class="col-xs-4 label label-read">
				<strong>NOMBRE : </strong>
			</div>
			<div class="col-xs-8 field field-blue field-read">
				<span><?= $User->nombre ?></span>
			</div>
			<div class="col-xs-4 label label-read">
				<strong>CORREO : </strong>
			</div>
			<div class="col-xs-8 field field-blue field-read">
				<span><?= $User->correo_electronico ?></span>
			</div>
			<div class="col-xs-4 label label-read">
				<strong>CLAVE : </strong>
			</div>
			<div class="col-xs-8 field field-blue field-read">
				<span><?= str_repeat('&bull;', strlen($User->pass)) ?></span>
			</div>
			<div class="col-xs-4 label label-read">
				<strong>TEL&Eacute;FONO : </strong>
			</div>
			<div class="col-xs-8 field field-blue field-read">
				<span><?= $User->telefono ?></span>
			</div>
			<div class="col-xs-4 label label-read">
				<strong>MOVIL : </strong>
			</div>
			<div class="col-xs-8 field field-blue field-read">
				<span><?= $User->celular ?></span>
			</div>
			<div class="col-xs-4 label label-read">
				<strong>DIRECCI&Oacute;N : </strong>
			</div>
			<div class="col-xs-8 field field-blue field-read">
				<span><?= $User->direccion ?></span>
			</div>
			<div class="col-xs-4 label label-read">
				<strong>CIUDAD : </strong>
			</div>
			<div class="col-xs-8 field field-blue field-read">
				<span><?= $User->ciudad ?></span>
			</div>
			<div class="col-xs-4 label label-read">
				<strong>PROVINCIA : </strong>
			</div>
			<div class="col-xs-8 field field-blue field-read">
				<span><?= $User->provincia ?></span>
			</div>
			<div class="col-xs-4 label label-read">
				<strong>PA&Iacute;S : </strong>
			</div>
			<div class="col-xs-8 field field-blue field-read">
				<span><?= $User->codigo_postal ?></span>
			</div>
		</div>
		<h3 class="h5 c-fff">
			Usuarios para compartir <a class="btn btn-primary" href="<?= URL_ROOT ?>/perfil/compartir">NUEVO</a>
		</h3>
		<div class="table-users">
			<table class="table">
				<thead>
					<tr>
						<th class="">FOTOGRAFIA</th>
						<th class="pl5">USUARIO</th>
						<th colspan="2" class="pl5">COMENTARIO</th>
					</tr>
				</thead>
				<tbody>
					<?php if (count($available_users)): foreach ($available_users as $usuario) :?>
						<tr class="tr-hover">
							<td><span class="show"><img src="<?= $usuario['foto'] ?>" alt="<?= $usuario['fullname'] ?>" widht="32" height="32" /></span></td>
							<td><span class="show"><?= $usuario['fullname'] ?></span></td>
							<td><span class="show"><?= $usuario['ref'] ?></span></td>
							<td class="txt-right">
								<form action="<?= URL_ROOT ?>/perfil/eliminar/<?= $usuario['vinculo'] ?>" method="POST">
									<button class="btn btn-danger" name="action" value="eliminar">ELIMINAR</button>
								</form>
							</td>
						</tr>
					<?php endforeach;else: ?>
					<tr class="tr-void">
						<td colspan="3">NO SE ENCUENTRAN USUARIOS DISPONIBLES</td>
					</tr>
				<?php endif; ?>
				</tbody>
			</table>
		</div>
	</div>
</div>