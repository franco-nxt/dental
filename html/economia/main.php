<div class="bar-subtitle">
	<div class="container">
		<a href="<?= $Patient->url() ?>"><?= $Patient->fullname() ?></a>
	</div>
</div>
<div class="bar-btn">
	<div class="container">
		<?php if (!$Treatment->presupuesto || $Treatment->presupuesto <= 0): ?>
			<a href="<?= $Treatment->url('editar') ?>" class="btn btn-warning">ASIGNAR PRESUPUESTO</a>
		<?php else: ?>
			<a class="btn btn-primary" href="<?= $Patient->url('economia/nuevo') ?>">CARGAR PAGO</a>
		<?php endif ?>
	</div>
</div>
<div class="container p5">
	<?php if (!$Treatment->presupuesto || $Treatment->presupuesto <= 0): ?>
	<div class="h5">
		<span>PARA AGREGAR UN PAGO PRIMERO ES NECESARIO ASIGNAR UN PRESUPUESTO</span> 
	</div>
	<?php endif ?>
	<div class="bar-bordered">
		<span><?= $Treatment->fecha_hora_inicio ?> - <?= $Treatment->estado ?> - <?= $Treatment->tecnica ?></span>
	</div>
	<div class="table-rounded">
		<table class="table">
			<thead>
				<tr>
					<th class="p-xs"><strong>NUM.</strong></th>
					<th class="p-xs"><strong>FECHA</strong></th>
					<th class="p-xs txt-center"><strong>PAGO</strong></th>
					<th class="p-xs txt-center"><strong>ACUM.</strong></th>
					<th class="p-xs txt-center"><strong>BALANCE</strong></th>
				</tr>
			</thead>
			<tbody>
				<?php $payments = $Treatment->get_payments() ?>
				<?php if (count($payments)): $c = 0; foreach ($payments as $Payment) : $c++ ?>
				<tr>
					<td><a href="<?= $Payment->url('ver') ?>" class="block nexa-l p-xs"><?= $c ?></a></td>
					<td><a href="<?= $Payment->url('ver') ?>" class="block nexa-l p-xs"><?= $Payment->fecha_hora ?></a></td>
					<td><a href="<?= $Payment->url('ver') ?>" class="block nexa-l p-xs txt-center"><?= $Payment->monto ?></a></td>
					<td><a href="<?= $Payment->url('ver') ?>" class="block nexa-l p-xs txt-center"><?= $Payment->acumulado ?></a></td>
					<td><a href="<?= $Payment->url('ver') ?>" class="block nexa-l p-xs txt-center"><?= $Payment->balance ?></a></td>
				</tr>
				<?php endforeach;else: ?>
				<tr class="tr-void">
					<td colspan="3"><span class="p-xs">NO SE ENCUENTRAN PAGOS REGISTRADOS</span></td>
				</tr>
				<?php endif; ?>
			</tbody>
		</table>
	</div>
	<?php $tratments = $Patient->get_treatments(); ?>
	<?php if ($tratments): ?>
		<div class="p5 txt-center">
			<button class="btn show-old-treatments">VER TRATAMIENTOS ANTERIORES</button>
		</div>
		<div id="old-treatments" style="display:none">
		<?php foreach ($tratments as $treatment): if ($treatment->id == $Treatment->id) continue ?>
		<div class="bar-bordered">
			<span><?= $Treatment->fecha_hora_inicio ?> - <?= $treatment->estado ?> - <?= $treatment->tecnica ?></span>
		</div>
		<div class="table-rounded">
			<table class="table">
				<thead>
					<tr>
						<th class="p-xs"><strong>NUM.</strong></th>
						<th class="p-xs"><strong>FECHA</strong></th>
						<th class="p-xs txt-center"><strong>PAGO</strong></th>
						<th class="p-xs txt-center"><strong>ACUM.</strong></th>
						<th class="p-xs txt-center"><strong>BALANCE</strong></th>
					</tr>
				</thead>
				<tbody>
					<?php $payments = $treatment->get_payments() ?>
					<?php if (count($payments)): $c = 0; foreach ($payments as $Payment) : $c++ ?>
					<tr>
						<td><a href="<?= $Payment->url('ver') ?>" class="block nexa-l p-xs"><?= $c ?></a></td>
						<td><a href="<?= $Payment->url('ver') ?>" class="block nexa-l p-xs"><?= $Payment->fecha_hora ?></a></td>
						<td><a href="<?= $Payment->url('ver') ?>" class="block nexa-l p-xs txt-center"><?= $Payment->monto ?></a></td>
						<td><a href="<?= $Payment->url('ver') ?>" class="block nexa-l p-xs txt-center"><?= $Payment->acumulado ?></a></td>
						<td><a href="<?= $Payment->url('ver') ?>" class="block nexa-l p-xs txt-center"><?= $Payment->balance ?></a></td>
					</tr>
					<?php endforeach;else: ?>
					<tr class="tr-void">
						<td colspan="3"><span class="p-xs">NO SE ENCUENTRAN PAGOS REGISTRADOS</span></td>
					</tr>
					<?php endif; ?>
				</tbody>
			</table>
		</div>
		<?php endforeach ?>
	</div>
	<?php endif ?>
</div>