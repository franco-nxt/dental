<?php
!isset($Patient) && redirect_exit();
?>
<div class="bar-subtitle">
	<div class="container">
		<a href="<?= $Patient->url() ?>"><?= $Patient->fullname() ?></a>
	</div>
</div>
<form action="<?= URL_ROOT ?>/compartir/usuarios/<?= $Patient->url ?>" method="GET" enctype="multipart/form-data">
	<div class="bar-btn">
		<div class="container">
        	<a class="btn btn-default" href="<?= URL_ROOT ?>/compartir/nuevo">CANCELAR</a>
			<button class="btn btn-success">GUARDAR</button>
		</div>
	</div>
	<div class="container">
		<h3 class="h5 c-fff">
			Secciones a compartir
		</h3>
		<div class="pl5 field field-blue field-checkbox-check">
			<input type="checkbox" id="FOTOGRAFIAS" name="access[]" value="fotografias">
			<label for="FOTOGRAFIAS" class="show">
				<strong>FOTOGRAFIAS</strong>
			</label>
		</div>

		<div class="pl5 field field-blue field-checkbox-check">
			<input type="checkbox" id="CEFALOMETRIAS" name="access[]" value="cefalometrias">
			<label for="CEFALOMETRIAS" class="show">
				<strong>CEFALOMETRIAS</strong>
			</label>
		</div>

		<div class="pl5 field field-blue field-checkbox-check">
			<input type="checkbox" id="RADIOGRAFIAS" name="access[]" value="radiografias">
			<label for="RADIOGRAFIAS" class="show">
				<strong>RADIOGRAFIAS</strong>
			</label>
		</div>
	</div>
</form>