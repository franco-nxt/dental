<?php
!isset($Patient) && redirect_exit();
!isset($User) && $User = get_user();
!isset($Treatment) && $Treatment = $Patient->treatment();
?>
<div class="bar-subtitle">
	<div class="container">
		<a href="<?= $Patient->url() ?>"><?= $Patient->fullname() ?></a>
	</div>
</div>
<div class="container pl10 pr10">
	<?php if ($Patient->check_user(get_user()->id)): ?>
	<div class="txt-center p5">
		<a href="<?= URL_ROOT ?>/fotografias/modelos/<?= $Patient->url ?>" class="btn btn-warning">TOMA DE FOTOGRAF&Iacute;AS</a>
	</div>
	<?php endif ?>
	<div class="bar-bordered">
		<span><?= $Treatment->inicio ?> - <?= $Treatment->estado ?> - <?= $Treatment->tecnica ?></span>
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
				<?php $photos = $Treatment->get_photos() ?>
				<?php if (count($photos)): foreach ($photos as $Photo) : ?>
				<tr>
					<td><a href="<?= $Photo->url('ver') ?>" class="block nexa-l p-xs"><?= $Photo->fecha_hora ?></a></td>
					<td><a href="<?= $Photo->url('ver') ?>" class="block nexa-l p-xs txt-center"><?= $Photo->cantidad ?></a></td>
					<td><a href="<?= $Photo->url('ver') ?>" class="block nexa-l p-xs txt-center"><?= $Photo->etapa ?></a></td>
				</tr>
				<?php endforeach;else: ?>
				<tr class="tr-void">
					<td colspan="3"><span class="p-xs">NO SE ENCUENTRAN FOTOGRAFIAS CARGADAS</span></td>
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
				<span><?= $treatment->inicio ?> - <?= $treatment->estado ?> - <?= $treatment->tecnica ?></span>
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
						<?php $photos = $treatment->get_photos() ?>
						<?php if (count($photos)): foreach ($photos as $Photo) : ?>
							<tr>
								<td><a href="<?= $Photo->url('ver') ?>" class="block nexa-l p-xs"><?= $Photo->fecha_hora ?></a></td>
								<td><a href="<?= $Photo->url('ver') ?>" class="block nexa-l p-xs txt-center"><?= $Photo->cantidad ?></a></td>
								<td><a href="<?= $Photo->url('ver') ?>" class="block nexa-l p-xs txt-center"><?= $Photo->etapa ?></a></td>
							</tr>
						<?php endforeach;else: ?>
						<tr class="tr-void">
							<td colspan="3"><span class="p-xs">NO SE ENCUENTRAN FOTOGRAFIAS CARGADAS</span></td>
						</tr>
						<?php endif; ?>
					</tbody>
				</table>
			</div>
		<?php endforeach ?>
	</div>
	<?php endif ?>
</div>