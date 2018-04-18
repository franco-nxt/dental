<?php 
!isset($User) && $User = get_user();

$patients = (Array) $User->patients();
?>
<div class="container">
	<div class="table-pacientes">
		<table class="table">
			<thead>
				<tr>
					<th width="40%" class="txt-left">NOMBRE</th>
					<th width="40%" class="txt-center">TECNICA</th>
					<th width="20%" class="txt-center">ESTADO</th>
				</tr>
			</thead>
			<tbody>
				<?php if(!empty($patients)): foreach($patients as $patient) : if (!$patient->estado !== BD_PACIENTE_ESTADO_ELIMINADO) :  $treatment = $patient->get_treatment() ?>
					<tr>
						<td><a href="<?= URL_ROOT ?>/compartir/paciente/<?= $patient->url ?>" class="show"><?= $patient->fullname() ?></a></td>
						<td><a href="<?= URL_ROOT ?>/compartir/paciente/<?= $patient->url ?>" class="show txt-center"><?= $treatment->tecnica ?></a></td>
						<td><a href="<?= URL_ROOT ?>/compartir/paciente/<?= $patient->url ?>" class="show txt-center"><?= $treatment->estado ?></a></td>
					</tr>
				<?php endif; endforeach; else:?>
				<tr class="tr-void">
					<td colspan="3">NO SE ENCUENTRAN PACIENTES ACTIVOS</td>
				</tr>
			<?php endif; ?>
			</tbody>
		</table>
	</div>
</div>