<form method="POST">
    <div class="bar-btn">
        <div class="container">
            <a class="btn btn-default" href="<?= URL_ROOT ?>/perfil">CANCELAR</a>
            <button class="btn btn-success" type="submit" name="action" value="guardar">GUARDAR</button>
        </div>
    </div>
    <div class="container">
        <label for="share_id" class="form-group m0 clear">
            <div class="col-xs-4 label">
                <strong>ID : </strong>
            </div>
            <div class="col-xs-8 field field-blue">
                <input type="text" id="share_id" name="id" autocomplete="off">
            </div>
        </label>
        <label for="share_ref" class="form-group m0 clear">
            <div class="col-xs-4 label">
                <strong>NOMBRE : </strong>
            </div>
            <div class="col-xs-8 field field-blue">
                <input type="text" id="share_ref" name="ref" autocomplete="off">
            </div>
        </label>
    </div>
</form>