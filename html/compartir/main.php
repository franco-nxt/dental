<?php 
!isset($User) && $User = get_user();
$shareds_by_me = $User->get_shareds_by_me();
$shareds_to_me = $User->get_shareds_to_me();
?>
<div class="bar-btn">
	<div class="container">
		<a class="btn btn-primary btn-ico-share" href="<?= URL_ROOT ?>/compartir/nuevo">COMPARTIR</a>
	</div>
</div>
<div class="container">
	<div class="tab-wrap">
		<div class="tabs">
			<div class="xs-6 tab active"><a class="">COMPARTO</a></div>
			<div class="xs-6 tab"><a class="">ME COMPARTEN</a></div>
		</div>
		<div class="tab-panes">
			<div class="tab-pane active">
				<div class="table-pacientes">
					<table class="table">
						<thead>
							<tr>
								<th class="xs-5 txt-left">USUARIO</th>
								<th class="xs-5 txt-center">PACIENTE</th>
								<th class="xs-2 txt-center">CANCELAR</th>
							</tr>
						</thead>
						<tbody>
							<?php if(!empty($shareds_by_me)): foreach($shareds_by_me as $patient): ?>
								<tr>
									<td><a href="<?= URL_ROOT ?>/paciente/compartido/<?= $patient['COMPARTIR'] ?>" class="show"><?= utf8_encode($patient['USUARIO']) ?></a></td>
									<td><a href="<?= URL_ROOT ?>/paciente/compartido/<?= $patient['COMPARTIR'] ?>" class="show txt-center"><?= utf8_encode($patient['PACIENTE']) ?></a></td>
									<td style="padding: 5px">
										<form action="<?= URL_ROOT ?>/compartir/<?= $patient['COMPARTIR'] ?>" method="POST">
											<button class="btn btn-danger" name="action" value="eliminar">DEJAR DE COMPARTIR</button>
										</form>
									</td>
								</tr>
							<?php endforeach; else:?>
							<tr class="tr-void">
								<td colspan="3">NO SE ENCUENTRAN PACIENTES COMPARTIDOS</td>
							</tr>
							<?php endif; ?>
						</tbody>
					</table>
				</div>
			</div>
			<div class="tab-pane">
				<div class="table-pacientes">
					<table class="table">
						<thead>
							<tr>
								<th class="xs-5 txt-left">USUARIO</th>
								<th class="xs-5 txt-center">PACIENTE</th>
								<th class="xs-2 txt-center">CANCELAR</th>
							</tr>
						</thead>
						<tbody>
							<?php if(!empty($shareds_to_me)): foreach($shareds_to_me as $patient): ?>
								<tr>
									<td><a href="<?= $patient['URL'] ?>" class="show"><?= utf8_encode($patient['USUARIO']) ?></a></td>
									<td><a href="<?= $patient['URL'] ?>" class="show txt-center"><?= utf8_encode($patient['PACIENTE']) ?></a></td>
									<td><a href="<?= $patient['URL'] ?>" class="show txt-center"></a></td>
								</tr>
							<?php endforeach; else:?>
							<tr class="tr-void">
								<td colspan="3">NO SE ENCUENTRAN PACIENTES COMPARTIDOS</td>
							</tr>
							<?php endif; ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>