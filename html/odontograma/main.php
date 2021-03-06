<div class="bar-subtitle">
	<div class="container">
		<a href="<?= $Patient->url() ?>"><?= $Patient->fullname() ?></a>
	</div>
</div>
<div class="container p5">
	<div class="bar-bordered">
		<span><?= $Treatment->fecha_hora_inicio ?> - <?= $Treatment->estado ?> - <?= $Treatment->tecnica ?> - <?= $Treatment->descripcion ?></span>
	</div>
	<ul class="p0">
		<li class="p5 sm-4 center"><a href="<?= URL_ROOT ?>/odontograma/ver/<?= $Treatment->url ?>" class="btn btn-primary btn-block"><strong>VER ODONTOGRAMA</strong></a></li>
	</ul>
	<?php if (!empty($old_treatments)): ?>
	<div class="p5 txt-center">
		<button class="btn show-old-treatments">VER TRATAMIENTOS ANTERIORES</button>
	</div>
	<div id="old-treatments" style="display:none">
		<?php foreach ($old_treatments as $treatment): ?>
		<div class="bar-bordered">
			<span><?= $Treatment->fecha_hora_inicio ?> - <?= $treatment->estado ?> - <?= $treatment->tecnica ?> - <?= $treatment->descripcion ?></span>
		</div>
		<ul class="p0">
			<li class="p5 sm-4 center"><a href="<?= URL_ROOT ?>/odontograma/ver/<?= $treatment->url ?>" class="btn btn-primary btn-block"><strong>VER ODONTOGRAMA</strong></a></li>
		</ul>
		<?php endforeach ?>
	</div>
	<?php endif ?>
</div>