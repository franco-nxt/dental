<form action="" method="POST" enctype="multipart/form-data" style="padding-bottom: 10px;" ng-app="dragModule">
    <div class="bar-btn">
        <div class="container">
            <a class="btn btn-info" href="<?= URL_ROOT ?>/perfil">CANCELAR</a>
            <button class="btn btn-primary" type="submit" name="action" value="guardar">GUARDAR</button>
        </div>
    </div>
    <div class="container p5">
        <div class="notification mb5">
            <SPAN>AL GUARDAR LOS CAMBIOS, ES NECESARIO VOLVER A INICIAR SESI&Oacute;N</SPAN>
        </div>
        <figure class="paciente-img-wrap">
            <div class="paciente-img" id="paciente-img">
                <img src="<?= $User->get_picture() ?>" alt="<?= $User->fullname ?>" class="img-rounded">
            </div>
            <div>
                <figcaption>
                    <label for="user_img" class="btn btn-primary">
                        <input type="file" id="user_img" class="upload-img-btn" data-target="paciente-img" style="display: none" name="img" />
                        CARGAR FOTO
                    </label>
                    <h5 style="color: #FFF">150 x 150</h5>
                </figcaption>
            </div>
        </figure>
        <div>
            <label for="user_apellido" class="form-group m0 clear">
                <div class="col-xs-4 label">
                    <strong>APELLIDO : </strong>
                </div>
                <div class="col-xs-8 field field-blue">
                    <input type="text" id="user_apellido" value="<?= $User->apellido ?>" name="apellido" autocomplete="off">
                </div>
            </label>
            <label for="user_nombre" class="form-group m0 clear">
                <div class="col-xs-4 label">
                    <strong>NOMBRE : </strong>
                </div>
                <div class="col-xs-8 field field-blue">
                    <input type="text" id="user_nombre" value="<?= $User->nombre ?>" name="nombre" autocomplete="off">
                </div>
            </label>
            <label for="user_correo_electronico" class="form-group m0 clear">
                <div class="col-xs-4 label">
                    <strong>CORREO  : </strong>
                </div>
                <div class="col-xs-8 field field-blue">
                    <input type="text" id="user_correo_electronico" value="<?= $User->email ?>" name="correo_electronico" autocomplete="off">
                </div>
            </label>
            <label for="user_pass" class="form-group m0 clear">
                <div class="col-xs-4 label">
                    <strong>CLAVE : </strong>
                </div>
                <div class="col-xs-8 field field-blue">
                    <input type="password" id="user_pass" value="<?= $User->pass ?>" name="pass" autocomplete="off">
                </div>
            </label>
            <label for="user_telefono" class="form-group m0 clear">
                <div class="col-xs-4 label">
                    <strong>TEL&Eacute;FONO : </strong>
                </div>
                <div class="col-xs-8 field field-blue">
                    <input type="text" id="user_telefono" value="<?= $User->telefono ?>" name="telefono" autocomplete="off">
                </div>
            </label>
            <label for="user_celular" class="form-group m0 clear">
                <div class="col-xs-4 label">
                    <strong>MOVIL : </strong>
                </div>
                <div class="col-xs-8 field field-blue">
                    <input type="text" id="user_celular" value="<?= $User->celular ?>" name="celular" autocomplete="off">
                </div>
            </label>
            <label for="user_direccion" class="form-group m0 clear">
                <div class="col-xs-4 label">
                    <strong>DIRECCI&Oacute;N : </strong>
                </div>
                <div class="col-xs-8 field field-blue">
                    <input type="text" id="user_direccion" value="<?= $User->direccion ?>" name="direccion" autocomplete="off">
                </div>
            </label>
            <label for="user_ciudad" class="form-group m0 clear">
                <div class="col-xs-4 label">
                    <strong>CIUDAD : </strong>
                </div>
                <div class="col-xs-8 field field-blue">
                    <input type="text" id="user_ciudad" value="<?= $User->ciudad ?>" name="ciudad" autocomplete="off">
                </div>
            </label>
            <label for="user_provincia" class="form-group m0 clear">
                <div class="col-xs-4 label">
                    <strong>PROVINCIA : </strong>
                </div>
                <div class="col-xs-8 field field-blue">
                    <input type="text" id="user_provincia" value="<?= $User->provincia ?>" name="provincia" autocomplete="off">
                </div>
            </label>
            <label for="user_pais" class="form-group m0 clear">
                <div class="col-xs-4 label">
                    <strong>PA&Iacute;S : </strong>
                </div>
                <div class="col-xs-8 field field-blue">
                    <input type="text" id="user_pais" value="<?= $User->pais ?>" name="pais" autocomplete="off">
                </div>
            </label>
        </div>
    </div>
</form>