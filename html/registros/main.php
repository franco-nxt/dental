<div class="bar-subtitle">
	<div class="container">
		<a href="<?= $Patient->url() ?>"><?= $Patient->fullname() ?></a>
	</div>
</div>
<div class="container pl10 pr10">
	<div class="txt-center p5">
		<a href="<?= URL_ROOT ?>/registros/nuevo/<?= $Treatment->url ?>" class="btn btn-warning">NUEVO REGISTRO</a>
	</div>
	<div class="bar-bordered">
		<span><?= $Treatment->fecha_hora_inicio ?> - <?= $Treatment->estado ?> - <?= $Treatment->tecnica ?> - <?= $Treatment->descripcion ?></span>
	</div>
	<div class="table-rounded">
		<table class="table">
			<thead>
				<tr>
					<th class="p-xs"><strong>NUMERO</strong></th>
					<th class="p-xs txt-center"><strong>FECHA</strong></th>
					<th class="p-xs txt-left"><strong>MOTIVO</strong></th>
				</tr>
			</thead>
			<tbody>
				<?php $c = 0; ?>
				<?php if (count($registers)): foreach ($registers as $Reg) : $c++?>
				<tr>
					<td><a href="<?= $Reg->url('ver') ?>" class="block nexa-l p-xs"><?= $c ?></a></td>
					<td><a href="<?= $Reg->url('ver') ?>" class="block nexa-l p-xs txt-center"><?= $Reg->fecha ?></a></td>
					<td><a href="<?= $Reg->url('ver') ?>" class="block nexa-l p-xs txt-left"><?= $Reg->motivo ?></a></td>
				</tr>
				<?php endforeach;else: ?>
				<tr class="tr-void">
					<td colspan="3"><span class="p-xs">NO SE ENCUENTRAN REGISTROS CARGADOS</span></td>
				</tr>
				<?php endif; ?>
			</tbody>
		</table>
	</div>
	<?php if (!empty($old_treatments)): ?>
	<div class="p5 txt-center">
		<button class="btn show-old-treatments">VER TRATAMIENTOS ANTERIORES</button>
	</div>
	<div id="old-treatments" style="display:none">
		<?php $c = 0; foreach ($old_treatments as $treatment): ?>
		<div class="bar-bordered">
			<span><?= $treatment->fecha_hora_inicio ?> - <?= $treatment->estado ?> - <?= $treatment->tecnica ?> - <?= $treatment->descripcion ?></span>
		</div>
		<div class="table-rounded">
			<table class="table">
				<thead>
					<tr>
						<th class="p-xs"><strong>NUMERO</strong></th>
						<th class="p-xs txt-center"><strong>FECHA</strong></th>
						<th class="p-xs txt-left"><strong>MOTIVO</strong></th>
					</tr>
				</thead>
				<tbody>
					<?php $regs = $treatment->get_registers() ?>
					<?php if (count($regs)): foreach ($regs as $Reg) : $c++?>
					<tr>
						<td><a href="<?= $Reg->url('ver') ?>" class="block nexa-l p-xs"><?= $c ?></a></td>
						<td><a href="<?= $Reg->url('ver') ?>" class="block nexa-l p-xs txt-center"><?= $Reg->fecha ?></a></td>
						<td><a href="<?= $Reg->url('ver') ?>" class="block nexa-l p-xs txt-left"><?= $Reg->motivo ?></a></td>
					</tr>
					<?php endforeach; else: ?>
					<tr class="tr-void">
						<td colspan="3"><span class="p-xs">NO SE ENCUENTRAN REGISTROS CARGADOS</span></td>
					</tr>
					<?php endif; ?>
				</tbody>
			</table>
		</div>
		<?php endforeach ?>
	</div>
	<?php endif ?>
</div>