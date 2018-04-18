<div class="login">
	<div class="">
		<figure class="login-figure">
			<img src="<?= URL_ROOT ?>/img/res/login.png" alt="Axis">
		</figure>
		<form class="login-form" method="POST">
			<div class="form-group">
				<label for="email" class="sr-only">EMAIL USUARIO</label>
				<input type="email" id="email" name="email" class="form-control txt-center" placeholder="EMAIL" required autofocus autocomplete="false" value="admin@admin.com">
			</div>
			<div class="form-group">
				<label for="password" class="sr-only">CONTRASE&Ntilde;A</label>
				<input type="password" id="password" name="password" class="form-control txt-center" placeholder="CONTRASE&Ntilde;A" required autocomplete="false" value="admin">
			</div>
			<div class="form-group">
				<button class="btn btn-block" type="submit" name="login" value="true">INGRESAR</button>
			</div>
		</form>
	</div>
</div>
