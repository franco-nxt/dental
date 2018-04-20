<?php 
// !isset($activos, $inactivos, $finalizados, $eliminados) && redirect_exit();
$actives = $User->get_patients_and_treatments_by_state(BD_TRATAMIENTO_ACTIVO);
$inactives = $User->get_patients_and_treatments_by_state(BD_TRATAMIENTO_INACTIVO);
$finisheds = $User->get_patients_and_treatments_by_state(BD_TRATAMIENTO_FINALIZADO);
$deleteds = $User->get_treatments_and_patients_deleted();
?>
<div class="container pacientes">
    <div class="tab-wrap">
        <div class="tabs">
            <div class="tab active"><a class="">ACTIVOS</a></div>
            <div class="tab"><a class="">INACTIVOS</a></div>
            <div class="tab"><a class="">FINALIZADOS</a></div>
            <div class="tab"><a class="">ELIMINADOS</a></div>
        </div>
        <div class="tab-panes">
            <div class="tab-pane active">
                <div class="table-pacientes">
                    <table class="table">
                        <thead>
                            <tr>
                                <th width="40%" class="txt-left">NOMBRE</th>
                                <th width="40%" class="txt-center">T&Eacute;CNICA</th>
                                <th width="20%" class="txt-center">AVANCE</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(!empty($actives)):foreach ($actives as $row) : $progress = $row['Treatment']->progress(); ?>
                                <tr>
                                    <td class="txt-left"><a href="<?= $row['Treatment']->url() ?>" class="show"><?= $row['Patient']->fullname() ?></a></td>
                                    <td class="txt-center"><a href="<?= $row['Treatment']->url() ?>" class="show text-center"><?= $row['Treatment']->tecnica ?></a></td>
                                    <td class="txt-center"><a href="<?= $row['Treatment']->url() ?>" class="show">
                                            <div class="progress" style="margin:0">
                                                <div class="progress-bar" role="progressbar" aria-valuenow="<?= $progress ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?= $progress ?>%;">
                                                    <span class="sr-only"><?= $progress ?>% Complete</span>
                                                </div>
                                            </div>
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; else:?>
                                <tr class="tr-void">
                                    <td colspan="3">NO SE ENCUENTRAN PACIENTES ACTIVOS</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="tab-pane">
                <div class="table-pacientes">
                    <table class="table">
                        <thead>
                            <tr>
                                <th width="40%" class="txt-left">NOMBRE</th>
                                <th width="40%" class="txt-center">T&Eacute;CNICA</th>
                                <th width="20%" class="txt-center">AVANCE</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(!empty($inactives)):foreach ($inactives as $row) : $progress = $row['Treatment']->progress(); ?>
                                <tr>
                                    <td class="txt-left"><a href="<?= $row['Treatment']->url() ?>" class="show"><?= $row['Patient']->fullname() ?></a></td>
                                    <td class="txt-center"><a href="<?= $row['Treatment']->url() ?>" class="show text-center"><?= $row['Treatment']->tecnica ?></a></td>
                                    <td class="txt-center"><a href="<?= $row['Treatment']->url() ?>" class="show">
                                            <div class="progress" style="margin:0">
                                                <div class="progress-bar" role="progressbar" aria-valuenow="<?= $progress ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?= $progress ?>%;">
                                                    <span class="sr-only"><?= $progress ?>% Complete</span>
                                                </div>
                                            </div>
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; else:?>
                                <tr class="tr-void">
                                    <td colspan="3">NO SE ENCUENTRAN PACIENTES INACTIVOS</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="tab-pane">
                <div class="table-pacientes">
                    <table class="table">
                        <thead>
                            <tr>
                                <th width="40%" class="txt-left">NOMBRE</th>
                                <th width="40%" class="txt-center">T&Eacute;CNICA</th>
                                <th width="20%" class="txt-center">AVANCE</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(!empty($finisheds)):foreach ($finisheds as $row) : $progress = $row['Treatment']->progress(); ?>
                                <tr>
                                    <td class="txt-left"><a href="<?= $row['Treatment']->url() ?>" class="show"><?= $row['Patient']->fullname() ?></a></td>
                                    <td class="txt-center"><a href="<?= $row['Treatment']->url() ?>" class="show text-center"><?= $row['Treatment']->tecnica ?></a></td>
                                    <td class="txt-center"><a href="<?= $row['Treatment']->url() ?>" class="show">
                                            <div class="progress" style="margin:0">
                                                <div class="progress-bar" role="progressbar" aria-valuenow="<?= $progress ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?= $progress ?>%;">
                                                    <span class="sr-only"><?= $progress ?>% Complete</span>
                                                </div>
                                            </div>
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; else:?>
                                <tr class="tr-void">
                                    <td colspan="3">NO SE ENCUENTRAN PACIENTES CON TRATAMIENTOS FINALIZADOS</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>                
                </div>
            </div>
            <div class="tab-pane">
                <div class="table-pacientes">
                    <table class="table">
                        <thead>
                            <tr>
                                <th width="40%" class="txt-left">NOMBRE</th>
                                <th width="40%" class="txt-center">T&Eacute;CNICA</th>
                                <th width="20%" class="txt-center">AVANCE</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(!empty($deleteds)):foreach ($deleteds as $row) : $progress = $row['Treatment']->progress(); ?>
                                <tr>
                                    <td class="txt-left"><a href="<?= $row['Treatment']->url() ?>" class="show"><?= $row['Patient']->fullname() ?></a></td>
                                    <td class="txt-center"><a href="<?= $row['Treatment']->url() ?>" class="show text-center"><?= $row['Treatment']->tecnica ?></a></td>
                                    <td class="txt-center"><a href="<?= $row['Treatment']->url() ?>" class="show">
                                            <div class="progress" style="margin:0">
                                                <div class="progress-bar" role="progressbar" aria-valuenow="<?= $progress ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?= $progress ?>%;">
                                                    <span class="sr-only"><?= $progress ?>% Complete</span>
                                                </div>
                                            </div>
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; else:?>
                                <tr class="tr-void">
                                    <td colspan="3">NO SE ENCUENTRAN PACIENTES ELIMINADOS</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>                
                </div>
            </div>
        </div>
    </div>
</div>