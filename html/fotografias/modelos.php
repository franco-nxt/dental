<?php
!isset($Paciente) && redirect_exit();
!isset($User) && $User = get_user();
!isset($Tratamiento) && $Tratamiento = $Paciente->treatment();
?>
<div class="bar-subtitle">
	<div class="container">
		<a href="<?= $Paciente->url() ?>"><?= $Paciente->fullname() ?></a>
	</div>
</div>
<div class="container">
	<h3 class="h5 c-fff p5">Elegir el modelo de sesi&oacute;n fotogr&aacute;fica.</h3>
	<div class="row">
		<div class="col-xs-3 model-f"><a href="<?= URL_ROOT ?>/fotografias/nueva/<?= crypt_params(array(PACIENTE => $Paciente->id, MODELO => 1)) ?>" style="background-image:url(<?= URL_ROOT ?>/img/res/fotografias/c4ca4238a0b923820dcc509a6f75849b.png);"></a></div>
		<div class="col-xs-3 model-f"><a href="<?= URL_ROOT ?>/fotografias/nueva/<?= crypt_params(array(PACIENTE => $Paciente->id, MODELO => 2)) ?>" style="background-image:url(<?= URL_ROOT ?>/img/res/fotografias/c81e728d9d4c2f636f067f89cc14862c.png);"></a></div>
		<div class="col-xs-3 model-f"><a href="<?= URL_ROOT ?>/fotografias/nueva/<?= crypt_params(array(PACIENTE => $Paciente->id, MODELO => 3)) ?>" style="background-image:url(<?= URL_ROOT ?>/img/res/fotografias/eccbc87e4b5ce2fe28308fd9f2a7baf3.png);"></a></div>
		<div class="col-xs-3 model-f"><a href="<?= URL_ROOT ?>/fotografias/nueva/<?= crypt_params(array(PACIENTE => $Paciente->id, MODELO => 4)) ?>" style="background-image:url(<?= URL_ROOT ?>/img/res/fotografias/a87ff679a2f3e71d9181a67b7542122c.png);"></a></div>
		<div class="col-xs-3 model-f"><a href="<?= URL_ROOT ?>/fotografias/nueva/<?= crypt_params(array(PACIENTE => $Paciente->id, MODELO => 5)) ?>" style="background-image:url(<?= URL_ROOT ?>/img/res/fotografias/e4da3b7fbbce2345d7772b0674a318d5.png);"></a></div>
		<div class="col-xs-3 model-f"><a href="<?= URL_ROOT ?>/fotografias/nueva/<?= crypt_params(array(PACIENTE => $Paciente->id, MODELO => 6)) ?>" style="background-image:url(<?= URL_ROOT ?>/img/res/fotografias/1679091c5a880faf6fb5e6087eb1b2dc.png);"></a></div>
		<div class="col-xs-3 model-f"><a href="<?= URL_ROOT ?>/fotografias/nueva/<?= crypt_params(array(PACIENTE => $Paciente->id, MODELO => 7)) ?>" style="background-image:url(<?= URL_ROOT ?>/img/res/fotografias/8f14e45fceea167a5a36dedd4bea2543.png);"></a></div>
		<div class="col-xs-3 model-f"><a href="<?= URL_ROOT ?>/fotografias/nueva/<?= crypt_params(array(PACIENTE => $Paciente->id, MODELO => 8)) ?>" style="background-image:url(<?= URL_ROOT ?>/img/res/fotografias/c9f0f895fb98ab9159f51fd0297e236d.png);"></a></div>
		<div class="col-xs-3 model-f"><a href="<?= URL_ROOT ?>/fotografias/nueva/<?= crypt_params(array(PACIENTE => $Paciente->id, MODELO => 9)) ?>" style="background-image:url(<?= URL_ROOT ?>/img/res/fotografias/45c48cce2e2d7fbdea1afc51c7c6ad26.png);"></a></div>
		<div class="col-xs-3 model-f"><a href="<?= URL_ROOT ?>/fotografias/nueva/<?= crypt_params(array(PACIENTE => $Paciente->id, MODELO => 10)) ?>" style="background-image:url(<?= URL_ROOT ?>/img/res/fotografias/d3d9446802a44259755d38e6d163e820.png);"></a></div>
		<div class="col-xs-3 model-f"><a href="<?= URL_ROOT ?>/fotografias/nueva/<?= crypt_params(array(PACIENTE => $Paciente->id, MODELO => 11)) ?>" style="background-image:url(<?= URL_ROOT ?>/img/res/fotografias/6512bd43d9caa6e02c990b0a82652dca.png);"></a></div>
		<div class="col-xs-3 model-f"><a href="<?= URL_ROOT ?>/fotografias/nueva/<?= crypt_params(array(PACIENTE => $Paciente->id, MODELO => 12)) ?>" style="background-image:url(<?= URL_ROOT ?>/img/res/fotografias/c20ad4d76fe97759aa27a0c99bff6710.png);"></a></div>
	</div>
</div>