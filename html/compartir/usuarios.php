<div class="bar-btn">
    <div class="container">
        <a class="btn btn-default" href="<?= URL_ROOT ?>/compartir">CANCELAR</a>
    </div>
</div>
<div class="container">
    <h3 class="h5 c-fff">Seleccione un usuario con quien compartir el paciente</h3>
    <div class="mobile-row">
        <div class="table-users">
            <table class="table">
                <thead>
                    <tr>
                        <th>FOTOGRAFIA</th>
                        <th>USUARIO</th>
                        <th class="txt-center">COMENTARIO</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($available_users)): foreach ($available_users as $user) :?>
                    <tr class="tr-hover">
                        <td><a href="<?= URL_ROOT ?>/compartir/out/<?= $user['url'] ?>?<?= $_SERVER['QUERY_STRING'] ?>" class="show"><img src="<?= $user['foto'] ?>" alt="<?= $user['fullname'] ?>" width="32" height="32"></a></td>
                        <td><a href="<?= URL_ROOT ?>/compartir/out/<?= $user['url'] ?>?<?= $_SERVER['QUERY_STRING'] ?>" class="show"><?= $user['fullname'] ?></a></td>
                        <td><a href="<?= URL_ROOT ?>/compartir/out/<?= $user['url'] ?>?<?= $_SERVER['QUERY_STRING'] ?>" class="show txt-center"><?= $user['ref'] ?></a></td>
                    </tr>
                    <?php endforeach;else: ?>
                    <tr class="tr-void">
                        <td colspan="3">NO SE ENCUENTRAN USUARIOS DISPONIBLES</td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>