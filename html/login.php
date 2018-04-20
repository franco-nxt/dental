<?php
!isset($Errors) && $Errors = get_error_flash();
!isset($Messages) && $Messages = get_msg_flash();
?>
<?php if ($Errors): !is_string($Errors) && $Errors = implode('<br>', $Errors); ?>
	<div class="alert bg-red">
		<div class="container p10">
			<a class="dismiss-alert"></a>
			<span><?= $Errors ?></span>
		</div>
	</div>
<?php elseif ($Messages): !is_string($Messages) && $Messages = implode('<br>', $Messages); ?>
	<div class="alert bg-green">
		<div class="container p10">
			<a class="dismiss-alert"></a>
			<span><?= $Messages ?></span>
		</div>
	</div>
<?php endif ?>
<div class="login">
	<div class="">
		<figure class="login-figure">
			<img src="<?= URL_ROOT ?>/img/res/login.png" alt="Axis">
		</figure>
		<form class="login-form" method="POST">
			<div class="form-group">
				<label for="email" class="sr-only">EMAIL USUARIO</label>
				<input type="email" id="email" name="email" class="form-control txt-center" placeholder="EMAIL" required autofocus autocomplete="false" value="<?= DEBUG ? 'admin@admin.com' : null ?>">
			</div>
			<div class="form-group">
				<label for="password" class="sr-only">CONTRASE&Ntilde;A</label>
				<input type="password" id="password" name="password" class="form-control txt-center" placeholder="CONTRASE&Ntilde;A" required autocomplete="false" value="<?= DEBUG ? 'admin' : null ?>">
			</div>
			<div class="form-group">
				<button class="btn btn-block" type="submit" name="login" value="true">INGRESAR</button>
			</div>
		</form>
	</div>
</div>
