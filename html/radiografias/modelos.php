<?php
!isset($Patient) && redirect_exit();
!isset($Tratamiento) && $Tratamiento = $Patient->treatment();
?>
<div class="bar-subtitle">
	<div class="container">
		<a href="<?= $Patient->url() ?>"><?= $Patient->fullname() ?></a>
	</div>
</div>
<div class="bar-btn">
	<div class="container">
		<a class="btn btn-default btn-ico-x" href="<?= $Patient->url('radiografias') ?>">CANCELAR</a>
	</div>
</div>
<div class="container">
	<h3 class="h5 c-fff p5">Elegir el modelo de sesi&oacute;n de radiogr&aacute;fias.</h3>
	<div class="row">
		<div class="col-xs-3 model-f">
			<a href="<?= URL_ROOT ?>/radiografias/nueva/<?= crypt_params(array(PACIENTE => $Patient->id, MODELO => 1)) ?>" style="background-image:url('<?= URL_ROOT ?>/img/res/radiographies/c4ca4238a0b923820dcc509a6f75849b.jpg')"></a>
		</div>
		<div class="col-xs-3 model-f">
			<a href="<?= URL_ROOT ?>/radiografias/nueva/<?= crypt_params(array(PACIENTE => $Patient->id, MODELO => 2)) ?>" style="background-image:url('<?= URL_ROOT ?>/img/res/radiographies/c81e728d9d4c2f636f067f89cc14862c.jpg')"></a>
		</div>
		<div class="col-xs-3 model-f">
			<a href="<?= URL_ROOT ?>/radiografias/nueva/<?= crypt_params(array(PACIENTE => $Patient->id, MODELO => 3)) ?>" style="background-image:url('<?= URL_ROOT ?>/img/res/radiographies/eccbc87e4b5ce2fe28308fd9f2a7baf3.jpg')"></a>
		</div>
		<div class="col-xs-3 model-f">
			<a href="<?= URL_ROOT ?>/radiografias/nueva/<?= crypt_params(array(PACIENTE => $Patient->id, MODELO => 4)) ?>" style="background-image:url('<?= URL_ROOT ?>/img/res/radiographies/a87ff679a2f3e71d9181a67b7542122c.jpg')"></a>
		</div>
		<div class="col-xs-3 model-f">
			<a href="<?= URL_ROOT ?>/radiografias/nueva/<?= crypt_params(array(PACIENTE => $Patient->id, MODELO => 5)) ?>" style="background-image:url('<?= URL_ROOT ?>/img/res/radiographies/e4da3b7fbbce2345d7772b0674a318d5.jpg')"></a>
		</div>
		<div class="col-xs-3 model-f">
			<a href="<?= URL_ROOT ?>/radiografias/nueva/<?= crypt_params(array(PACIENTE => $Patient->id, MODELO => 6)) ?>" style="background-image:url('<?= URL_ROOT ?>/img/res/radiographies/1679091c5a880faf6fb5e6087eb1b2dc.jpg')"></a>
		</div>
		<div class="col-xs-3 model-f">
			<a href="<?= URL_ROOT ?>/radiografias/nueva/<?= crypt_params(array(PACIENTE => $Patient->id, MODELO => 7)) ?>" style="background-image:url('<?= URL_ROOT ?>/img/res/radiographies/8f14e45fceea167a5a36dedd4bea2543.jpg')"></a>
		</div>
		<div class="col-xs-3 model-f">
			<a href="<?= URL_ROOT ?>/radiografias/nueva/<?= crypt_params(array(PACIENTE => $Patient->id, MODELO => 8)) ?>" style="background-image:url('<?= URL_ROOT ?>/img/res/radiographies/c9f0f895fb98ab9159f51fd0297e236d.jpg')"></a>
		</div>
		<div class="col-xs-3 model-f">
			<a href="<?= URL_ROOT ?>/radiografias/nueva/<?= crypt_params(array(PACIENTE => $Patient->id, MODELO => 9)) ?>" style="background-image:url('<?= URL_ROOT ?>/img/res/radiographies/45c48cce2e2d7fbdea1afc51c7c6ad26.jpg')"></a>
		</div>
		<div class="col-xs-3 model-f">
			<a href="<?= URL_ROOT ?>/radiografias/nueva/<?= crypt_params(array(PACIENTE => $Patient->id, MODELO => 10)) ?>" style="background-image:url('<?= URL_ROOT ?>/img/res/radiographies/d3d9446802a44259755d38e6d163e820.jpg')"></a>
		</div>
		<div class="col-xs-3 model-f">
			<a href="<?= URL_ROOT ?>/radiografias/nueva/<?= crypt_params(array(PACIENTE => $Patient->id, MODELO => 11)) ?>" style="background-image:url('<?= URL_ROOT ?>/img/res/radiographies/6512bd43d9caa6e02c990b0a82652dca.jpg')"></a>
		</div>
		<div class="col-xs-3 model-f">
			<a href="<?= URL_ROOT ?>/radiografias/nueva/<?= crypt_params(array(PACIENTE => $Patient->id, MODELO => 12)) ?>" style="background-image:url('<?= URL_ROOT ?>/img/res/radiographies/c20ad4d76fe97759aa27a0c99bff6710.jpg')"></a>
		</div>
	</div>
</div>