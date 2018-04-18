<div class="bar-btn">
    <div class="container">
        <a class="btn btn-default" href="<?= URL_ROOT ?>/perfil">CANCELAR</a>
    </div>
</div>
<?php if(isset($uniqid)) : ?>    
    <div class="container">
        <h3 class="h5 c-fff">
            <strong>ID UNICO</strong> <span>Para generar un vinculo con otro usuario para luego compartir pacientes</span>
        </h3>
        <button class="btn btn-primary">COPIAR</button></label>
        <button class="btn btn-link"><?= $uniqid ?></button>
        <!-- <span class="tablet-hidden tablet-lg-hidden desktop-hidden"><?= $uniqid ?></span> -->
    </div>
    <script>
        document.querySelectorAll('button').forEach(function(a,b){
            a.onclick = function(){
                var _ = document.createElement('input');
                _.setAttribute('value', '<?= $uniqid ?>');
                document.body.appendChild(_);
                _.select();
                document.execCommand('copy');
                document.body.removeChild(_);
            }
        });
    </script>
<?php endif ?> 