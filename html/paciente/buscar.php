<form method="GET" enctype="multipart/form-data">
	<div class="bar-btn">
		<div class="container">
			<button class="btn btn-primary btn-ico-search" name="action" value="search">BUSCAR PACIENTE</button>
		</div>
	</div>
	<div class="patient pb10">
		<div class="container">
			<label for="patient_apellido" class="form-group clear m0">
				<div class="col-xs-4 label">
					<strong>APELLIDO</strong>
				</div>
				<div class="col-xs-8 field">
					<input type="text" id="patient_apellido" value="<?= filter_input(INPUT_GET, 'apellido') ?>" name="apellido" class="text-input full">
				</div>
			</label>
			<label for="patient_nombre" class="form-group clear m0">
				<div class="col-xs-4 label">
					<strong>NOMBRE</strong>
				</div>
				<div class="col-xs-8 field">
					<input type="text" id="patient_nombre" value="<?= filter_input(INPUT_GET, 'nombre') ?>" name="nombre" class="text-input full">
				</div>
			</label>
			<div class="form-group clear m0">
				<div class="col-xs-4 label">
					<strong>SEXO</strong>
				</div>
				<div class="col-xs-8 field">
					<input class="radio-input" type="radio" name="sexo" id="patient_genre_male" value="<?= SEXO_1 ?>" <?= checked(filter_input(INPUT_GET, 'sexo') === SEXO_1) ?>><label class="radio-label" for="patient_genre_male">M</label>
					<input class="radio-input" type="radio" name="sexo" id="patient_genre_female" value="<?= SEXO_2 ?>" <?= checked(filter_input(INPUT_GET, 'sexo') === SEXO_2) ?>><label class="radio-label" for="patient_genre_female">F</label>
				</div>
			</div>
			<label for="patient_ciudad" class="form-group clear m0">
				<div class="col-xs-4 label label-read">
					<strong>CIUDAD</strong>
				</div>
				<div class="col-xs-8 field field-read">
					<input type="text" id="patient_ciudad" value="<?= filter_input(INPUT_GET, 'ciudad') ?>" name="ciudad" class="text-input full"/>
				</div>
			</label>
			<label for="patient_provincia" class="form-group clear m0">
				<div class="col-xs-4 label label-read">
					<strong>PROVINCIA</strong>
				</div>
				<div class="col-xs-8 field field-read">
					<input type="text" id="patient_provincia" value="<?= filter_input(INPUT_GET, 'provincia') ?>" name="provincia" class="text-input full"/>
				</div>
			</label>
			<label for="patient_ingreso" class="form-group clear m0">
				<div class="col-xs-4 label">
					<strong>INGRESO</strong>
				</div>
				<div class="col-xs-8 field">
					<input type="text" id="patient_ingreso" value="<?= filter_input(INPUT_GET, 'ingreo') ?>" name="ingreo" class="input-date text-input full">
				</div>
			</label>
		</div>
	</div>
</form>
<?php if (isset($patients) && !empty($_GET)): ?>
<div class="container">
	<div class="table-pacientes">
	    <table class="table">
	        <thead>
	            <tr>
	                <th width="40%" class="txt-left">NOMBRE</th>
	                <th width="30%" class="txt-center">T&Eacute;CNICA</th>
	                <th width="20%" class="txt-center">AVANCE</th>
	                <th width="30%" class="txt-center">ESTADO</th>
	            </tr>
	        </thead>
	        <tbody>
	            <?php if(!empty($patients)):foreach ($patients as $Patient) : $Treatment = $Patient->get_treatment() ?>
	                <tr>
	                    <td class="txt-left"><a href="<?= $Patient->url() ?>" class="show"><?= $Patient->fullname() ?></a></td>
	                    <td class="txt-center"><a href="<?= $Patient->url() ?>" class="show text-center"><?= $Treatment->tecnica ?></a></td>
	                    <td class="txt-center"><a href="<?= $Patient->url() ?>" class="show">
	                            <div class="progress" style="margin:0">
	                                <div class="progress-bar" role="progressbar" aria-valuenow="<?= $Treatment->progress() ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?= $Treatment->progress() ?>%;">
	                                    <span class="sr-only"><?= $Treatment->progress() ?>% Complete</span>
	                                </div>
	                            </div>
	                        </a>
	                    </td>
	                    <td class="txt-center"><a href="<?= $Patient->url() ?>" class="show text-center"><?= $Treatment->estado ?></a></td>
	                </tr>
	            <?php endforeach; else:?>
	                <tr class="tr-void">
	                    <td colspan="4">NO SE ENCUENTRAN PACIENTES</td>
	                </tr>
	            <?php endif; ?>
	        </tbody>
	    </table>
	</div>
</div>
<?php endif ?>