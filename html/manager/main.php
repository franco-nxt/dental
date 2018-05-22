<div class="bar-btn">
	<form class="container" method="POST" enctype="multipart/form-data">
		<label class="btn btn-default"><input name="csv" id="fileSelect" type="file" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" class="hide" onchange="check_csv(this)" /> IMPORTAR CSV</label>
		<a class="btn btn-default" href="#">EXPORTAR SUBSCRIPCIONES</a>
	</form>
</div>
<div class="container">
	<div class="table-users">
		<table class="table">
			<thead>
				<tr>
	               <th class="text-left">NOMBRE</th>
	               <th class="text-left">EMAIL</th>
	               <th class="text-left">DNI</th>
	               <th class="text-left">TELEFONO</th>
	               <th class="text-left">CELULAR</th>
	               <th class="text-left">DIRECCION</th>
	               <th class="text-left">CIUDAD</th>
	               <th class="text-left">PROVINCIA</th>
	               <th class="text-left">PAIS</th>
				</tr>
			</thead>
			<tbody>
				<?php if (count($all_users)): foreach ($all_users as $usuario) :?>
					<tr class="tr-hover">
	                    <td><a href="<?= URL_ROOT ?>/manager/<?= $usuario->url ?>" class="show" style="white-space: nowrap;"><?= $usuario->fullname ?></a></td>
	                    <td><a href="<?= URL_ROOT ?>/manager/<?= $usuario->url ?>" class="show"><?= $usuario->correo_electronico ?></a></td>
	                    <td><a href="<?= URL_ROOT ?>/manager/<?= $usuario->url ?>" class="show"><?= $usuario->dni ?></a></td>
	                    <td><a href="<?= URL_ROOT ?>/manager/<?= $usuario->url ?>" class="show"><?= $usuario->telefono ?></a></td>
	                    <td><a href="<?= URL_ROOT ?>/manager/<?= $usuario->url ?>" class="show"><?= $usuario->celular ?></a></td>
	                    <td><a href="<?= URL_ROOT ?>/manager/<?= $usuario->url ?>" class="show"><?= $usuario->direccion ?></a></td>
	                    <td><a href="<?= URL_ROOT ?>/manager/<?= $usuario->url ?>" class="show"><?= $usuario->ciudad ?></a></td>
	                    <td><a href="<?= URL_ROOT ?>/manager/<?= $usuario->url ?>" class="show"><?= $usuario->provincia ?></a></td>
	                    <td><a href="<?= URL_ROOT ?>/manager/<?= $usuario->url ?>" class="show"><?= $usuario->pais ?></a></td>
	                    <td class="txt-right">
	                        <?php $action = boolval($usuario->habilitado) ? 'INHABILITADO' : 'HABILITADO' ?>
	                        <?php $msg = boolval($usuario->habilitado) ? 'INHABILITAR' : 'HABILITAR' ?>
	                        <form method="POST" action="<?= URL_ROOT ?>/manager/habilitar/<?= $usuario->url ?>" class="axis-row" style="padding:0">
	                            <button class="btn btn-primary" type="submit" name="action" value="<?= $action ?>"><?= $msg ?></button>
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