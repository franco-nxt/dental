<?php 
!isset($activo, $inactivo, $finalizado, $eliminado) && redirect_exit();
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
                            <?php if(!empty($activo)):foreach ($activo as $tratamiento) : ?>
                                <tr>
                                    <td class="txt-left"><a href="<?= $tratamiento->paciente->url() ?>" class="show"><?= $tratamiento->paciente->fullname() ?></a></td>
                                    <td class="txt-center"><a href="<?= $tratamiento->paciente->url() ?>" class="show text-center"><?= $tratamiento->tecnica ?></a></td>
                                    <td class="txt-center"><a href="<?= $tratamiento->paciente->url() ?>" class="show">
                                            <div class="progress" style="margin:0">
                                                <div class="progress-bar" role="progressbar" aria-valuenow="<?= $tratamiento->progress() ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?= $tratamiento->progress() ?>%;">
                                                    <span class="sr-only"><?= $tratamiento->progress() ?>% Complete</span>
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
                            <?php if(!empty($inactivo)):foreach ($inactivo as $tratamiento) : ?>
                                <tr>
                                    <td class="txt-left"><a href="<?= $tratamiento->paciente->url() ?>" class="show"><?= $tratamiento->paciente->fullname() ?></a></td>
                                    <td class="txt-center"><a href="<?= $tratamiento->paciente->url() ?>" class="show text-center"><?= $tratamiento->tecnica ?></a></td>
                                    <td class="txt-center"><a href="<?= $tratamiento->paciente->url() ?>" class="show">
                                            <div class="progress" style="margin:0">
                                                <div class="progress-bar" role="progressbar" aria-valuenow="<?= $tratamiento->progress() ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?= $tratamiento->progress() ?>%;">
                                                    <span class="sr-only"><?= $tratamiento->progress() ?>% Complete</span>
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
                            <?php if(!empty($finalizado)):foreach ($finalizado as $tratamiento) : ?>
                                <tr>
                                    <td class="txt-left"><a href="<?= $tratamiento->paciente->url() ?>" class="show"><?= $tratamiento->paciente->fullname() ?></a></td>
                                    <td class="txt-center"><a href="<?= $tratamiento->paciente->url() ?>" class="show text-center"><?= $tratamiento->tecnica ?></a></td>
                                    <td class="txt-center"><a href="<?= $tratamiento->paciente->url() ?>" class="show">
                                            <div class="progress" style="margin:0">
                                                <div class="progress-bar" role="progressbar" aria-valuenow="<?= $tratamiento->progress() ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?= $tratamiento->progress() ?>%;">
                                                    <span class="sr-only"><?= $tratamiento->progress() ?>% Complete</span>
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
                            <?php if(!empty($eliminado)):foreach ($eliminado as $tratamiento) : if(!$tratamiento) continue; $patient = $tratamiento->get_patient() ?>
                                <tr>
                                    <td class="txt-left"><a href="<?= $patient->url() ?>" class="show"><?= $patient->fullname() ?></a></td>
                                    <td class="txt-center"><a href="<?= $patient->url() ?>" class="show text-center"><?= $tratamiento->tecnica ?></a></td>
                                    <td class="txt-center"><a href="<?= $patient->url() ?>" class="show">
                                            <div class="progress" style="margin:0">
                                                <div class="progress-bar" role="progressbar" aria-valuenow="<?= $tratamiento->progress() ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?= $tratamiento->progress() ?>%;">
                                                    <span class="sr-only"><?= $tratamiento->progress() ?>% Complete</span>
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