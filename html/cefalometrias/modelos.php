<?php
!isset($Patient) && redirect_exit();
?>
<div class="bar-subtitle">
	<div class="container">
		<a href="<?= $Patient->url() ?>"><?= $Patient->fullname() ?></a>
	</div>
</div>
<div class="container">
	<h3 class="h5 c-fff p5">Elegir el modelo de sesi&oacute;n radiogr&aacute;fica.</h3>
	<div class="row">
		<div class="col-xs-3 model-f">
			<a href="<?= URL_ROOT ?>/cefalometrias/nueva/<?= crypt_params(array(PACIENTE => $Patient->id, MODELO => 1)) ?>" style="background-image:url('<?= URL_ROOT ?>/img/res/cephalometries/c4ca4238a0b923820dcc509a6f75849b.png')"></a>
		</div>
		<div class="col-xs-3 model-f">
			<a href="<?= URL_ROOT ?>/cefalometrias/nueva/<?= crypt_params(array(PACIENTE => $Patient->id, MODELO => 2)) ?>" style="background-image:url('<?= URL_ROOT ?>/img/res/cephalometries/c81e728d9d4c2f636f067f89cc14862c.png')"></a>
		</div>
		<div class="col-xs-3 model-f">
			<a href="<?= URL_ROOT ?>/cefalometrias/nueva/<?= crypt_params(array(PACIENTE => $Patient->id, MODELO => 3)) ?>" style="background-image:url('<?= URL_ROOT ?>/img/res/cephalometries/eccbc87e4b5ce2fe28308fd9f2a7baf3.png')"></a>
		</div>
		<div class="col-xs-3 model-f">
			<a href="<?= URL_ROOT ?>/cefalometrias/nueva/<?= crypt_params(array(PACIENTE => $Patient->id, MODELO => 4)) ?>" style="background-image:url('<?= URL_ROOT ?>/img/res/cephalometries/a87ff679a2f3e71d9181a67b7542122c.png')"></a>
		</div>
		<div class="col-xs-3 model-f">
			<a href="<?= URL_ROOT ?>/cefalometrias/nueva/<?= crypt_params(array(PACIENTE => $Patient->id, MODELO => 5)) ?>" style="background-image:url('<?= URL_ROOT ?>/img/res/cephalometries/e4da3b7fbbce2345d7772b0674a318d5.png')"></a>
		</div>
		<div class="col-xs-3 model-f">
			<a href="<?= URL_ROOT ?>/cefalometrias/nueva/<?= crypt_params(array(PACIENTE => $Patient->id, MODELO => 6)) ?>" style="background-image:url('<?= URL_ROOT ?>/img/res/cephalometries/1679091c5a880faf6fb5e6087eb1b2dc.png')"></a>
		</div>
		<div class="col-xs-3 model-f">
			<a href="<?= URL_ROOT ?>/cefalometrias/nueva/<?= crypt_params(array(PACIENTE => $Patient->id, MODELO => 7)) ?>" style="background-image:url('<?= URL_ROOT ?>/img/res/cephalometries/8f14e45fceea167a5a36dedd4bea2543.png')"></a>
		</div>
		<div class="col-xs-3 model-f">
			<a href="<?= URL_ROOT ?>/cefalometrias/nueva/<?= crypt_params(array(PACIENTE => $Patient->id, MODELO => 8)) ?>" style="background-image:url('<?= URL_ROOT ?>/img/res/cephalometries/c9f0f895fb98ab9159f51fd0297e236d.png')"></a>
		</div>
	</div>
</div>