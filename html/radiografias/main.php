<?php
!isset($Patient) && redirect_exit();
!isset($Treatment) && $Treatment = $Patient->get_treatment();
?>
<div class="bar-subtitle">
	<div class="container">
		<a href="<?= $Patient->url() ?>"><?= $Patient->fullname() ?></a>
	</div>
</div>
<div class="container pl10 pr10">
	<?php if ($Patient->check_user(get_user()->id)): ?>
	<div class="txt-center p5">
		<a href="<?= URL_ROOT ?>/radiografias/modelos/<?= $Patient->url ?>" class="btn btn-warning">TOMA DE RADIOGRAF&Iacute;AS</a>
	</div>
	<?php endif ?>
	<div class="bar-bordered">
		<span><?= $Treatment->fecha_hora_inicio ?> - <?= $Treatment->estado ?> - <?= $Treatment->tecnica ?></span>
	</div>
	<div class="table-rounded">
		<table class="table">
			<thead>
				<tr>
					<th class="p-xs"><strong>FECHA</strong></th>
					<th class="p-xs txt-center"><strong>CANTIDAD</strong></th>
					<th class="p-xs txt-center"><strong>ETAPA</strong></th>
				</tr>
			</thead>
			<tbody>
				<?php $radiographies = $Treatment->get_radiographies() ?>
				<?php if (count($radiographies)): foreach ($radiographies as $Radiographie) : ?>
				<tr>
					<td><a href="<?= $Radiographie->url('ver') ?>" class="block nexa-l p-xs"><?= $Radiographie->fecha_hora ?></a></td>
					<td><a href="<?= $Radiographie->url('ver') ?>" class="block nexa-l p-xs txt-center"><?= $Radiographie->cantidad ?></a></td>
					<td><a href="<?= $Radiographie->url('ver') ?>" class="block nexa-l p-xs txt-center"><?= $Radiographie->etapa ?></a></td>
				</tr>
				<?php endforeach;else: ?>
				<tr class="tr-void">
					<td colspan="3"><span class="p-xs">NO SE ENCUENTRAN RADIOGRAF&Iacute;AS CARGADAS</span></td>
				</tr>
			<?php endif; ?>
			</tbody>
		</table>
	</div>
	<?php $treatments = $Patient->old_treatments() ?>
	<?php if ($treatments): ?>
	<div class="p5 txt-center">
		<button class="btn show-old-treatments">VER TRATAMIENTOS ANTERIORES</button>
	</div>
	<div id="old-treatments" style="display:none">
		<?php foreach ($treatments as $treatment): if ($treatment->id == $Treatment->id) continue ?>
			<div class="bar-bordered">
				<span><?= $Treatment->fecha_hora_inicio ?> - <?= $treatment->estado ?> - <?= $treatment->tecnica ?></span>
			</div>
			<div class="table-rounded">
				<table class="table">
					<thead>
						<tr>
							<th class="p-xs"><strong>FECHA</strong></th>
							<th class="p-xs txt-center"><strong>CANTIDAD</strong></th>
							<th class="p-xs txt-center"><strong>ETAPA</strong></th>
						</tr>
					</thead>
					<tbody>
						<?php $radiographies = $treatment->get_radiographies() ?>
						<?php if (count($radiographies)): foreach ($radiographies as $Radiographie) : ?>
							<tr>
								<td><a href="<?= $Radiographie->url('ver') ?>" class="block nexa-l p-xs"><?= $Radiographie->fecha_hora ?></a></td>
								<td><a href="<?= $Radiographie->url('ver') ?>" class="block nexa-l p-xs txt-center"><?= $Radiographie->cantidad ?></a></td>
								<td><a href="<?= $Radiographie->url('ver') ?>" class="block nexa-l p-xs txt-center"><?= $Radiographie->etapa ?></a></td>
							</tr>
						<?php endforeach;else: ?>
						<tr class="tr-void">
							<td colspan="3"><span class="p-xs">NO SE ENCUENTRAN RADIOGRAF&Iacute;AS CARGADAS</span></td>
						</tr>
						<?php endif; ?>
					</tbody>
				</table>
			</div>
		<?php endforeach ?>
	</div>
	<?php endif ?>
</div>