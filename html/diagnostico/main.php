<div class="bar-subtitle">
	<div class="container">
		<a href="<?= $Patient->url() ?>"><?= $Patient->fullname() ?></a>
	</div>
</div>
<div class="bar-btn">
	<div class="container">
		<a class="btn btn-default" href="<?= $Patient->url() ?>">CANCELAR</a>
	</div>
</div>
<div class="container p5">
	<div class="bar-bordered">
		<span><?= $Treatment->fecha_hora_inicio ?> - <?= $Treatment->estado ?> - <?= $Treatment->tecnica ?> - <?= $Treatment->descripcion ?></span>
	</div>
	<ul class="p0">
		<li class="p5 sm-4 center"><a href="<?= $Treatment->url('diagnostico/historia') ?>" class="btn btn-primary btn-block"><strong>HISTORIA MEDICA Y DENTAL</strong></a></li>
		<li class="p5 sm-4 center"><a href="<?= $Treatment->url('diagnostico/examen') ?>" class="btn btn-primary btn-block"><strong>EXAMEN CLINICO Y BUCAL</strong></a></li>
		<li class="p5 sm-4 center"><a href="<?= $Treatment->url('diagnostico/completo') ?>" class="btn btn-primary btn-block"><strong>DIAGNÓSTICO</strong></a></li>
		<li class="p5 sm-4 center"><a href="<?= $Treatment->url('diagnostico/resumen') ?>" class="btn btn-primary btn-block"><strong>RESUMEN DIAGNÓSTICO</strong></a></li>
	</ul>
	<?php if (!empty($treatments)): ?>
		<div class="p5 txt-center">
			<button class="btn show-old-treatments">VER TRATAMIENTOS ANTERIORES</button>
		</div>
		<div id="old-treatments" style="display:none">
			<?php foreach ($treatments as $treatment): ?>
				<div class="bar-bordered">
					<span><?= $Treatment->fecha_hora_inicio ?> - <?= $treatment->estado ?> - <?= $treatment->tecnica ?> - <?= $treatment->descripcion ?></span>
				</div>
				<ul class="p0">
					<li class="p5 sm-4 center"><a href="<?= $treatment->url('diagnostico/historia') ?>" class="btn btn-primary btn-block"><strong>HISTORIA MEDICA Y DENTAL</strong></a></li>
					<li class="p5 sm-4 center"><a href="<?= $treatment->url('diagnostico/examen') ?>" class="btn btn-primary btn-block"><strong>EXAMEN CLINICO Y BUCAL</strong></a></li>
					<li class="p5 sm-4 center"><a href="<?= $treatment->url('diagnostico/completo') ?>" class="btn btn-primary btn-block"><strong>DIAGNÓSTICO</strong></a></li>
					<li class="p5 sm-4 center"><a href="<?= $treatment->url('diagnostico/resumen') ?>" class="btn btn-primary btn-block"><strong>RESUMEN DIAGNÓSTICO</strong></a></li>
				</ul>
			<?php endforeach ?>
		</div>
	<?php endif ?>
</div>