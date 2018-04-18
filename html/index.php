<?php
!isset($Errors) && $Errors = get_error_flash();
!isset($Messages) && $Messages = get_msg_flash();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>DentalPhotoNet | <?= _global('title') ?></title>
    <link href="https://fonts.googleapis.com/css?family=Montserrat:100,200,300,400,500,600,700,800,900" rel="stylesheet">
    <link href="<?= URL_ROOT ?>/css/main.css" rel="stylesheet">
    <!--[if lt IE 9]><script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script><script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
</head>
<body class="bg-axis">
    <?php if (_global('__HTML__')): ?>
    <nav class="nav">
        <ul class="nav-list container">
            <li class="nav-item"><a href="<?= URL_ROOT ?>"><img src="<?= URL_ROOT ?>/img/res/nav-logo-140x50.png" alt="axis-brand" class="axis-brand"></a></li>
            <li class="nav-item txt-right">Bienvenido, <a href="#"><?= get_user()->fullname ?></a></li>
            <li class="nav-item txt-right">
                <a href="#" class="nav-options" data-dropdown="menu-dropdown">&nbsp;</a>
                <ul class="nav-drop" id="menu-dropdown" style="display:none">
                    <li class="nav-drop-item"><a href="<?= URL_ROOT ?>/logout">Logout</a></li>
                    <li class="nav-drop-item"><a href="<?= URL_ROOT ?>/perfil">Perfil</a></li>
                </ul>
            </li>
        </ul>
    </nav>
    <?php if ($Messages): !is_string($Messages) && $Messages = implode('<br>', $Messages); ?>
        <div class="alert bg-green">
            <div class="container p10">
                <a class="dismiss-alert"></a>
                <span><?= $Messages ?></span>
            </div>
        </div>
    <?php endif ?>
    <?php if ($Errors): !is_string($Errors) && $Errors = implode('<br>', $Errors); ?>
        <div class="alert bg-red">
            <div class="container p10">
                <a class="dismiss-alert"></a>
                <span><?= $Errors ?></span>
            </div>
        </div>
    <?php endif ?>
    <div class="bg-w">
        <ul class="navbar container">
            <li class="navbar-item navbar-item-btn"><a href="<?= URL_ROOT ?>" class="navbar-btn btn-ico-back">&nbsp;</a></li>
            <li class="navbar-item"><strong><?= _global('navbar-title') ?></strong></li>
            <?php if (_global('edit-patient')): ?>
            <li class="navbar-item navbar-item-btn"><a href="<?= _global('edit-patient') ?>" class="btn btn-primary">EDITAR</a></li>
            <?php endif ?>
            <?php if (_global('navbar-options')): ?>
            <li class="navbar-item navbar-item-btn"><a href="/paciente/nuevo" class="navbar-btn btn-ico-plus">&nbsp;</a></li>
            <li class="navbar-item navbar-item-btn"><a href="/paciente/buscar" class="navbar-btn btn-ico-search">&nbsp;</a></li>
            <li class="navbar-item navbar-item-btn"><a href="/compartir" class="navbar-btn btn-ico-share">&nbsp;</a></li>
            <?php endif ?>
        </ul>
    </div>
    <?php endif ?>
    <?php if (_global('__content__')): echo _global('__content__'); endif; ?>
    <?php if (_global('__HTML__')): ?>
    <footer class="noprint">
        <ul class="container">
            <li>Axis Orthodontic Solution &reg;</li>
            <li class="links"><a href="mailto:info@axis.com">info@axis.com</a> | <a href="tel:+5411513665548">+54 11 513 665 548</a></li>
            <li class="footer-brand"><img src="<?= URL_ROOT ?>/img/res/logo_footer.png" alt=""></li>
        </ul>
    </footer>
    <?php endif ?>
    <script src="js/main.js"></script>
</body>
</html>