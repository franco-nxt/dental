<form action="" method="POST" enctype="multipart/form-data" style="padding-bottom: 10px;" ng-app="dragModule">
    <div class="bar-btn">
        <div class="container">
            <a class="btn btn-default" href="<?= URL_ROOT ?>/perfil">CANCELAR</a>
            <button class="btn btn-primary" type="submit" name="action" value="guardar">GUARDAR</button>
        </div>
    </div>
    <div class="container p5">
        <div class="row">
            <h3 class="h5 c-fff col-xs-12">Datos del usuario.</h3>
            <label for="user_apellido" class="form-group m0 clear col-md-4">
                <div class="col-xs-4 label">
                    <strong>APELLIDO :</strong>
                </div>
                <div class="col-xs-8 field field-blue">
                    <input type="text" id="user_apellido" value="" name="apellido" autocomplete="off">
                </div>
            </label>
            <label for="user_nombre" class="form-group m0 clear col-md-4">
                <div class="col-xs-4 label">
                    <strong>NOMBRE :</strong>
                </div>
                <div class="col-xs-8 field field-blue">
                    <input type="text" id="user_nombre" value="" name="nombre" autocomplete="off">
                </div>
            </label>
            <label for="user_dni" class="form-group m0 clear col-md-4">
                <div class="col-xs-4 label">
                    <strong>DNI  :</strong>
                </div>
                <div class="col-xs-8 field field-blue">
                    <input type="text" id="user_dni" value="" name="dni" autocomplete="off">
                </div>
            </label>
            <label for="user_correo_electronico" class="form-group m0 clear col-md-6">
                <div class="col-xs-4 label">
                    <strong>EMAIL :</strong>
                </div>
                <div class="col-xs-8 field field-blue">
                    <input type="text" id="user_correo_electronico" value="" name="correo_electronico" autocomplete="off">
                </div>
            </label>
            <label for="user_correo_electronico_revalid" class="form-group m0 clear col-md-6">
                <div class="col-xs-4 label">
                    <strong>CONFIRMAR EMAIL :</strong>
                </div>
                <div class="col-xs-8 field field-blue">
                    <input type="text" id="user_correo_electronico_revalid" value="" name="correo_electronico_revalid" autocomplete="off">
                </div>
            </label>
            <label for="user_telefono" class="form-group m0 clear col-md-6">
                <div class="col-xs-4 label">
                    <strong>TEL&Eacute;FONO :</strong>
                </div>
                <div class="col-xs-8 field field-blue">
                    <input type="text" id="user_telefono" value="" name="telefono" autocomplete="off">
                </div>
            </label>
            <label for="user_celular" class="form-group m0 clear col-md-6">
                <div class="col-xs-4 label">
                    <strong>CELULAR :</strong>
                </div>
                <div class="col-xs-8 field field-blue">
                    <input type="text" id="user_celular" value="" name="celular" autocomplete="off">
                </div>
            </label>
            <label for="user_direccion" class="form-group m0 clear col-md-6">
                <div class="col-xs-4 label">
                    <strong>DIRECCI&Oacute;N :</strong>
                </div>
                <div class="col-xs-8 field field-blue">
                    <input type="text" id="user_direccion" value="" name="direccion" autocomplete="off">
                </div>
            </label>
            <label for="user_codigo_postal" class="form-group m0 clear col-md-6">
                <div class="col-xs-4 label">
                    <strong>CP :</strong>
                </div>
                <div class="col-xs-8 field field-blue">
                    <input type="text" id="user_codigo_postal" value="" name="codigo_postal" autocomplete="off">
                </div>
            </label>
            <label for="user_ciudad" class="form-group m0 clear col-md-4">
                <div class="col-xs-4 label">
                    <strong>CIUDAD :</strong>
                </div>
                <div class="col-xs-8 field field-blue">
                    <input type="text" id="user_ciudad" value="" name="ciudad" autocomplete="off">
                </div>
            </label>
            <label for="user_provincia" class="form-group m0 clear col-md-4">
                <div class="col-xs-4 label">
                    <strong>PROVINCIA :</strong>
                </div>
                <div class="col-xs-8 field field-blue">
                    <input type="text" id="user_provincia" value="" name="provincia" autocomplete="off">
                </div>
            </label>
            <label for="user_pais" class="form-group m0 clear col-md-4">
                <div class="col-xs-4 label">
                    <strong>PA&Iacute;S :</strong>
                </div>
                <div class="col-xs-8 field field-blue">
                    <input type="text" id="user_pais" value="" name="pais" autocomplete="off">
                </div>
            </label>
            <h3 class="h5 c-fff col-xs-12">Datos de pago.</h3>
            <div class="col-md-5">
                <div class="col-xs-4 col-md-3 label label-read">
                    <strong>TARJETA :</strong>
                </div>
                <div class="col-xs-8 col-md-9 field field-blue field-radio-check">
                    <input type="radio" id="user_cartype-visa" value="VISA" name="tarjeta_tipo">
                    <label for="user_cartype-visa">VISA</label>
                    <input type="radio" id="user_cartype-mastercard" value="MASTERCARD" name="tarjeta_tipo">
                    <label for="user_cartype-mastercard">MASTERCARD</label>
                    <input type="radio" id="user_cartype-amex" value="AMEX" name="tarjeta_tipo">
                    <label for="user_cartype-amex">AMEX</label>
                </div>
            </div>
            <label for="user_tarjeta_num" class="form-group m0 clear col-md-4">
                <div class="col-xs-4 col-md-3 label">
                    <strong>N&Uacute;MERO :</strong>
                </div>
                <div class="col-xs-8 col-md-9 field field-blue">
                    <input type="text" id="user_tarjeta_num" value="" name="tarjeta_num" autocomplete="off" class="card-num">
                </div>
            </label>
            <label for="user_tarjeta_fecha_mmyy" class="form-group m0 clear col-md-3">
                <div class="col-xs-4 col-md-6 label">
                    <strong>VENCIMIENTO :</strong>
                </div>
                <div class="col-xs-8 col-md-6 field field-blue">
                    <input type="text" id="user_tarjeta_fecha_mmyy" value="" name="tarjeta_fecha_mmyy" autocomplete="off" class="input-vto">
                </div>
            </label>
        </div>
    </div>
</form>