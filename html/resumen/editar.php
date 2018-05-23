<form method="POST">
	<div class="bar-subtitle">
		<div class="container">
			<a href="<?= $Patient->url() ?>"><?= $Patient->fullname() ?></a>
		</div>
	</div>
	<div class="bar-btn">
		<div class="container">
			<button class="btn btn-success" name="action" value="save">GUARDAR</button>
			<a href="<?= $Resume->url() ?>" class="btn btn-default">CANCELAR</a>
		</div>
	</div>
	<div class="container p5">
		<div class="bar-bordered">
			<span><?= $Treatment->resume() ?></span>
		</div>
		<div class="bar-bordered clear mb5">
			<strong>RESUMEN DIAGNOSTICO</strong>
		</div>
		<div class="sm-12 field field-blue">
			<input class="radio-input" type="checkbox" name="interceptivo_correctivo" value="interceptivo" id="interceptivo" data-discheck="#correctivo" <?= checked(!empty($Resume->interceptivo_correctivo->interceptivo)) ?>/>
			<label class="radio-label" for="interceptivo">INTERCEPTIVO</label>
			<input class="radio-input" type="checkbox" name="interceptivo_correctivo" value="correctivo" id="correctivo" data-discheck="#interceptivo" <?= checked(!empty($Resume->interceptivo_correctivo->correctivo)) ?>/>
			<label class="radio-label" for="correctivo">CORRECTIVO</label>
			<input class="radio-input" type="checkbox" name="esqueletal_dentario" value="esqueletal" id="esqueletal" data-discheck="#dentario,#esqueletal_dentario" <?= checked(!empty($Resume->esqueletal_dentario->esqueletal)) ?>/>
			<label class="radio-label" for="esqueletal">ESQUELETAL</label>
			<input class="radio-input" type="checkbox" name="esqueletal_dentario" value="dentario" id="dentario" data-discheck="#esqueletal_dentario,#esqueletal" <?= checked(!empty($Resume->esqueletal_dentario->dentario)) ?>/>
			<label class="radio-label" for="dentario">DENTARIO</label>
			<input class="radio-input" type="checkbox" name="esqueletal_dentario" value="esqueletal_dentario" id="esqueletal_dentario" data-discheck="#esqueletal,#dentario" <?= checked(!empty($Resume->esqueletal_dentario->esqueletal_dentario)) ?>/>
			<label class="radio-label" for="esqueletal_dentario">ESQUELETAL Y DENTARIO</label>
		</div>
		<div class="col-sm-4 col-md-3 label label-read">
			<strong>EXTRACCIONES : </strong>
		</div>
		<div class="col-sm-7 col-md-9 field field-blue" data-check-one>
			<input class="radio-input" type="checkbox" name="extracciones[]" id="extracciones_si" value="si" data-enable-text="#extracciones_especificar" <?= checked(!empty($Resume->extracciones->si)) ?>/>
			<label class="radio-label" for="extracciones_si">SI</label>
			<input class="radio-input" type="checkbox" name="extracciones[]" id="extracciones_no" value="no" data-disable-text="#extracciones_especificar" <?= checked(!empty($Resume->extracciones->no)) ?>/>
			<label class="radio-label" for="extracciones_no">NO</label>
			<label class="text-label" for="extracciones_especificar" id="l_extracciones_especificar" class="<?= empty($Resume->extracciones->si) ? null : 'active' ?>">ESPECIFICAR </label>
			<input class="text-input <?= disabled($Resume->extracciones->si) ?>" type="text" name="extracciones[especificar]" id="extracciones_especificar" value="<?= isset_get($Resume->extracciones->especificar) ?>" autocomplete="off">
		</div>
		<div class="col-sm-4 col-md-3 label label-read">
			<strong>ANCLAJE SUPERIOR : </strong>
		</div>
		<div class="col-sm-8 col-md-9 field field-blue" data-check-one>
			<input class="radio-input" type="checkbox" name="anclaje_sup" id="anclaje_sup_normal" value="minimo" <?= checked(!empty($Resume->anclaje_sup->minimo)) ?>/><label class="radio-label" for="anclaje_sup_normal">MINIMO</label>
			<input class="radio-input" type="checkbox" name="anclaje_sup" id="anclaje_sup_aumentada" value="moderado" <?= checked(!empty($Resume->anclaje_sup->moderado)) ?>/><label class="radio-label" for="anclaje_sup_aumentada">MODERADO</label>
			<input class="radio-input" type="checkbox" name="anclaje_sup" id="anclaje_sup_disminuida" value="maximo" <?= checked(!empty($Resume->anclaje_sup->maximo)) ?>/><label class="radio-label" for="anclaje_sup_disminuida">MAXIMO</label>
		</div>
		<div class="col-sm-4 col-md-3 label label-read">
			<strong>ANCLAJE INFERIOR : </strong>
		</div>
		<div class="col-sm-8 col-md-9 field field-blue" data-check-one>
			<input class="radio-input" type="checkbox" name="anclaje_inf" id="anclaje_inf_normal" value="minimo" <?= checked(!empty($Resume->anclaje_inf->minimo)) ?>/><label class="radio-label" for="anclaje_inf_normal">MINIMO</label>
			<input class="radio-input" type="checkbox" name="anclaje_inf" id="anclaje_inf_aumentada" value="moderado" <?= checked(!empty($Resume->anclaje_inf->moderado)) ?>/><label class="radio-label" for="anclaje_inf_aumentada">MODERADO</label>
			<input class="radio-input" type="checkbox" name="anclaje_inf" id="anclaje_inf_disminuida" value="maximo" <?= checked(!empty($Resume->anclaje_inf->maximo)) ?>/><label class="radio-label" for="anclaje_inf_disminuida">MAXIMO</label>
		</div>
		<label for="objetivo_etapas" class="clear form-group m0">
			<div class="col-xs-12 label label-read">
				<strong>OBJETIVO EN ETAPAS : </strong>
			</div>
			<div class="col-xs-12 field field-read field-blue">
				<textarea name="objetivo_etapas" id="OBJETIVO_ETAPAS" rows="5"><?= $Resume->objetivo_etapas ?></textarea>
			</div>
		</label>
		<div class="col-sm-4 col-md-3 label label-read">
			<strong>PRONOSTICO : </strong>
		</div>
		<div class="col-sm-8 col-md-9 field field-blue" data-check-one>
			<input class="radio-input" type="checkbox" name="pronostico" id="pronostico_favorable" value="favorable" <?= checked(!empty($Resume->pronostico->favorable)) ?>/><label class="radio-label" for="pronostico_favorable">FAVORABLE</label>
			<input class="radio-input" type="checkbox" name="pronostico" id="pronostico_reservado" value="reservado" <?= checked(!empty($Resume->pronostico->reservado)) ?>/><label class="radio-label" for="pronostico_reservado">RESERVADO</label>
			<input class="radio-input" type="checkbox" name="pronostico" id="pronostico_desfavorable" value="desfavorable" <?= checked(!empty($Resume->pronostico->desfavorable)) ?>/><label class="radio-label" for="pronostico_desfavorable">DESFAVORABLE</label>
		</div>
		<label for="observaciones" class="clear form-group m0">
			<div class="col-xs-12 label label-read">
				<strong>OBVSERVACIONES : </strong>
			</div>
			<div class="col-xs-12 field field-read field-blue">
				<textarea name="observaciones" id="observaciones" rows="5"><?= $Resume->observaciones ?></textarea>
			</div>
		</label>
		<div class="clear m10 p10 txt-center" style="clear:both;">
			<h3 class="h5 c-fff">Duracion estimada del tratamiento <?= $Treatment->duracion ?> mes<?= $Treatment->duracion > 1 ? 'es' : null ?></h3>
		</div>
	</div>
</form>