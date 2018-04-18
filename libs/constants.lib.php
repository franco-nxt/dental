<?php 

/*
 * -----------------------------
 * CONSTANTES USADAS POR LA WEB
 * -----------------------------
 */

define('NAMESPACE_WORK', '');

define('CEFALOMETRIA', 'C');
define('PAGO', 'E');
define('TRATAMIENTO', 'T');
define('RADIOGRAFIA', 'R');
define('USUARIO', 'U');
define('MODELO', 'M');
define('PACIENTE', 'P');
define('FOTOGRAFIA', 'F');
define('ODONTOGRAMA', 'O');
define('COMPARTIR', 'X');
define('REGISTRO', 'S');
define('QUERY', 'Q');
define('VINCULO', 'V');

define('TRATAMIENTO_ACTIVO', 'ACTIVO');
define('TRATAMIENTO_INACTIVO', 'INACTIVO');
define('TRATAMIENTO_FINALIZADO', 'FINALIZADO');

define('TRATAMIENTO_ESTADO_1', 'ACTIVO');
define('TRATAMIENTO_ESTADO_2', 'INACTIVO');
define('TRATAMIENTO_ESTADO_3', 'FINALIZADO');

define('BD_TRATAMIENTO_ACTIVO', 1);
define('BD_TRATAMIENTO_INACTIVO', 2);
define('BD_TRATAMIENTO_FINALIZADO', 3);

define('TECNICA_1', 'ORTOPEDIA FUNCIONAL');
define('TECNICA_2', 'ORTODONCIA');

define('TECNICA_ORTOPEDIA_FUNCIONAL', 'ORTOPEDIA FUNCIONAL');
define('TECNICA_ORTODONCIA', 'ORTODONCIA');

define('BD_ORTOPEDIA_FUNCIONAL', 1);
define('BD_ORTODONCIA', 2);

define('MALE', 'MALE');
define('FEMALE', 'FEMALE');

define('SEXO_1', 'MALE');
define('SEXO_2', 'FEMALE');

define('BD_MALE', '1');
define('BD_FEMALE', '2');

define('ETAPA_1', 'INICIALES');
define('ETAPA_2', 'INTERMEDIAS');
define('ETAPA_3', 'FINALES');

define('ETAPA_INICIALES', 'INICIALES');
define('ETAPA_INTERMEDIAS', 'INTERMEDIAS');
define('ETAPA_FINALES', 'FINALES');

define('BD_ETAPA_INICIALES', 1);
define('BD_ETAPA_INTERMEDIAS', 2);
define('BD_ETAPA_FINALES', 3);

define('PACIENTE_BORRADO', 1);
define('PACIENTE_ELIMINADO', 1);
define('PACIENTE_ACTIVO', 0);

define('BD_PACIENTE_BORRADO', 1);
define('BD_PACIENTE_ELIMINADO', 1);
define('BD_PACIENTE_ACTIVO', 0);

define('BD_PACIENTE_ESTADO_BORRADO', 'BORRADO');
define('BD_PACIENTE_ESTADO_ELIMINADO', 'ELIMINADO');
define('BD_PACIENTE_ESTADO_ACTIVO', 'ACTIVO');

define('PACIENTE_IMG', 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAJYAAACWBAMAAADOL2zRAAAAG1BMVEXMzMyWlpaqqqq3t7fFxcW+vr6xsbGjo6OcnJyLKnDGAAAACXBIWXMAAA7EAAAOxAGVKw4bAAABAElEQVRoge3SMW+DMBiE4YsxJqMJtHOTITPeOsLQnaodGImEUMZEkZhRUqn92f0MaTubtfeMh/QGHANEREREREREREREtIJJ0xbH299kp8l8FaGtLdTQ19HjofxZlJ0m1+eBKZcikd9PWtXC5DoDotRO04B9YOvFIXmXLy2jEbiqE6Df7DTleA5socLqvEFVxtJyrpZFWz/pHM2CVte0lS8g2eDe6prOyqPglhzROL+Xye4tmT4WvRcQ2/m81p+/rdguOi8Hc5L/8Qk4vhZzy08DduGt9eVQyP2qoTM1zi0/uf4hvBWf5c77e69Gf798y08L7j0RERERERERERH9P99ZpSVRivB/rgAAAABJRU5ErkJggg==');

define('NO', 'NO');
define('SI', 'SI');
define('BUENA', 'BUENA');
define('REGULAR', 'REGULAR');
define('MALA', 'MALA');
define('ACTUAL', 'ACTUAL');
define('PASADO', 'PASADO');

define('FOTOGRAFIAS_PATH', 'img/fotografias/');

define('F_EOFRENTESINSONRISA', URL_ROOT . '/img/res/fotografias/F_EOFRENTESINSONRISA.png');
define('F_EOFRENTECONSONRISA', URL_ROOT . '/img/res/fotografias/F_EOFRENTECONSONRISA.png');
define('F_EO01', URL_ROOT . '/img/res/fotografias/F_EO01.png');
define('F_EO02', URL_ROOT . '/img/res/fotografias/F_EO02.png');
define('F_EOPERFILDERECHOSINSONRISA', URL_ROOT . '/img/res/fotografias/F_EOPERFILDERECHOSINSONRISA.png');
define('F_EO34PERFILDERECHOCONSONRISA', URL_ROOT . '/img/res/fotografias/F_EO34PERFILDERECHOCONSONRISA.png');
define('F_IOFRONTAL', URL_ROOT . '/img/res/fotografias/F_IOFRONTAL.png');
define('F_IOOVERJET', URL_ROOT . '/img/res/fotografias/F_IOOVERJET.png');
define('F_IOUNO', URL_ROOT . '/img/res/fotografias/F_IOUNO.png');
define('F_IODOS', URL_ROOT . '/img/res/fotografias/F_IODOS.png');
define('F_IOLATERALDERECHO', URL_ROOT . '/img/res/fotografias/F_IOLATERALDERECHO.png');
define('F_IOLATERALIZQUIERDO', URL_ROOT . '/img/res/fotografias/F_IOLATERALIZQUIERDO.png');
define('F_IOOCLUSALINFERIOR', URL_ROOT . '/img/res/fotografias/F_IOOCLUSALINFERIOR.png');
define('F_IOOCLUSALSUPERIOR', URL_ROOT . '/img/res/fotografias/F_IOOCLUSALSUPERIOR.png');

define('FOTOGRAFIA_HORIZONTAL_WIDTH', 566);
define('FOTOGRAFIA_HORIZONTAL_HEIGHT', 345);
define('FOTOGRAFIA_VERTICAL_WIDTH', 278);
define('FOTOGRAFIA_VERTICAL_HEIGHT', 345);


define('RADIOGRAFIAS_PATH', 'img/radiografias/');

define('R_TRX1_', URL_ROOT . '/img/res/radiographies/trx_.png');
define('R_TRX2_', URL_ROOT . '/img/res/radiographies/trx_.png');
define('R_TRX3_', URL_ROOT . '/img/res/radiographies/trx_.png');
define('R_TRX4_', URL_ROOT . '/img/res/radiographies/trx_.png');
define('R_TRX5_', URL_ROOT . '/img/res/radiographies/trx_.png');
define('R_TRX6_', URL_ROOT . '/img/res/radiographies/trx_.png');

define('R_PANORAMICA', URL_ROOT . '/img/res/radiographies/panoramica.png');
define('R_PANORAMICA1', URL_ROOT . '/img/res/radiographies/panoramica.png');
define('R_PANORAMICA2', URL_ROOT . '/img/res/radiographies/panoramica.png');
define('R_PANORAMICA3', URL_ROOT . '/img/res/radiographies/panoramica.png');

define('R_TRX1', URL_ROOT . '/img/res/radiographies/trx.png');
define('R_TRX2', URL_ROOT . '/img/res/radiographies/trx.png');
define('R_TRX3', URL_ROOT . '/img/res/radiographies/trx.png');

define('RADIOGRAFIA_PANORAMICA_WIDTH', 1140);
define('RADIOGRAFIA_PANORAMICA_HEIGHT', 565);
define('RADIOGRAFIA_TRX_WIDTH', 565);
define('RADIOGRAFIA_TRX_HEIGHT', 845);
define('RADIOGRAFIA_TRX__WIDTH', 565);
define('RADIOGRAFIA_TRX__HEIGHT', 565);


define('CEFALOMETRIAS_PATH', 'img/cefalometrias/');

define('BD_TIPO_RICKETTS', 1);
define('BD_TIPO_JARABAK', 2);
define('BD_TIPO_MCNAMARA', 3);
define('BD_TIPO_STEINER', 4);
define('BD_TIPO_OTRO', 5);
define('BD_TIPO_SUPERPOSICION', 6);

define('CEFALOMETRIA_TIPO_1', 'RICKETTS');
define('CEFALOMETRIA_TIPO_2', 'JARABAK');
define('CEFALOMETRIA_TIPO_3', 'MCNAMARA');
define('CEFALOMETRIA_TIPO_4', 'STEINER');
define('CEFALOMETRIA_TIPO_5', 'OTRO');
define('CEFALOMETRIA_TIPO_6', 'SUPERPOSICION');

define('CEFALOMETRIA_RICKETTS', 'RICKETTS');
define('CEFALOMETRIA_JARABAK', 'JARABAK');
define('CEFALOMETRIA_MCNAMARA', 'MCNAMARA');
define('CEFALOMETRIA_STEINER', 'STEINER');
define('CEFALOMETRIA_OTRO', 'OTRO');
define('CEFALOMETRIA_SUPERPOSICION', 'SUPERPOSICION');

define('C_P1', URL_ROOT . '/img/res/cephalometries/PAG1.png');
define('C_P2', URL_ROOT . '/img/res/cephalometries/PAG2.png');
define('C_P3', URL_ROOT . '/img/res/cephalometries/PAG3.png');
define('C_P4', URL_ROOT . '/img/res/cephalometries/PAG4.png');

define('C_PAG1', URL_ROOT . '/img/res/cephalometries/P1.png');
define('C_PAG2', URL_ROOT . '/img/res/cephalometries/P2.png');
define('C_PAG3', URL_ROOT . '/img/res/cephalometries/P3.png');
define('C_PAG4', URL_ROOT . '/img/res/cephalometries/P4.png');
define('C_PAG5', URL_ROOT . '/img/res/cephalometries/P5.png');
define('C_PAG6', URL_ROOT . '/img/res/cephalometries/P6.png');

define('CEFALOMETRIA_PAG_WIDTH', 565);
define('CEFALOMETRIA_PAG_HEIGHT', 845);
define('CEFALOMETRIA_P_WIDTH', 565);
define('CEFALOMETRIA_P_HEIGHT', 565);



define('O_E11', '<g class="SUP"><path d="M22.2,13.3c0,5-4,9-9,9s-9-4-9-9s4-9,9-9S22.2,8.3,22.2,13.3z M13.2,2.4c-6,0-10.9,4.9-10.9,10.9s4.9,10.9,10.9,10.9s10.9-4.9,10.9-10.9S19.2,2.4,13.2,2.4z" fill="#e11"></path></g>');

define('O_3AF', '<g class="SUP"><path d="M22.2,13.3c0,5-4,9-9,9s-9-4-9-9s4-9,9-9S22.2,8.3,22.2,13.3z M13.2,2.4c-6,0-10.9,4.9-10.9,10.9s4.9,10.9,10.9,10.9s10.9-4.9,10.9-10.9S19.2,2.4,13.2,2.4z" fill="#3af"></path></g>');

define('X_E11', '<g class="SUP"><path d="M15.3,13.3l8.4-8.4c0.6-0.6,0.6-1.5,0-2.1c-0.6-0.6-1.5-0.6-2.1,0l-8.4,8.4L4.8,2.8c-0.6-0.6-1.5-0.6-2.1,0c-0.6,0.6-0.6,1.5,0,2.1l8.4,8.4l-8.4,8.4c-0.6,0.6-0.6,1.5,0,2.1c0.6,0.6,1.5,0.6,2.1,0l8.4-8.3l8.4,8.3c0.6,0.6,1.5,0.6,2.1,0c0.6-0.6,0.6-1.5,0-2.1L15.3,13.3z" fill="#e11"></path></g>');

define('X_3AF', '<g class="SUP"><path d="M15.3,13.3l8.4-8.4c0.6-0.6,0.6-1.5,0-2.1c-0.6-0.6-1.5-0.6-2.1,0l-8.4,8.4L4.8,2.8c-0.6-0.6-1.5-0.6-2.1,0c-0.6,0.6-0.6,1.5,0,2.1l8.4,8.4l-8.4,8.4c-0.6,0.6-0.6,1.5,0,2.1c0.6,0.6,1.5,0.6,2.1,0l8.4-8.3l8.4,8.3c0.6,0.6,1.5,0.6,2.1,0c0.6-0.6,0.6-1.5,0-2.1L15.3,13.3z" fill="#3af"></path></g>');

define('D_E11', '<g class="SUP"><rect y="5.6" width="26.5" height="6.2" fill="#e11"></rect><rect y="14.7" width="26.5" height="6.2" fill="#e11"></rect></g>');

define('S_3AF', '<g class="SUP"><rect y="10.1" width="26.5" height="6.2" fill="#3af"></rect></g>');

define('BS1_E11', '<g class="INF"><path d="M26.4,39.2H10.6V27.8h2.8v8.7h13V39.2L26.4,39.2z" fill="#e11"></path></g>');

define('BS2_E11', '<g class="INF"><rect y="36.5" width="26.5" height="2.7" fill="#e11"></rect></g>');

define('BS3_E11', '<g class="INF"><path d="M0,39.2v-2.7h13v-8.7h2.8v11.4H0.1H0z" fill="#e11"></path></g>');

define('BS1_3AF', '<g class="INF"><path d="M26.4,39.2H10.6V27.8h2.8v8.7h13V39.2L26.4,39.2z" fill="#3af"></path></g>');

define('BS2_3AF', '<g class="INF"><rect y="36.5" width="26.5" height="2.7" fill="#3af"></rect></g>');

define('BS3_3AF', '<g class="INF"><path d="M0,39.2v-2.7h13v-8.7h2.8v11.4H0.1H0z" fill="#3af"></path></g>');

define('BD1_E11', '<g class="INF"><path d="M26.2,39.3H11.6V28.7h1.9v8.8h12.7V39.3z" fill="#e11"></path><path d="M26.2,36.3H15.7v-7.6h1.9v5.8h8.7L26.2,36.3L26.2,36.3z" fill="#e11"></path></g>');

define('BD2_E11', '<g class="INF"><rect y="37.4" width="26.5" height="1.9" fill="#e11"></rect><rect y="34.4" width="26.5" height="1.9" fill="#e11"></rect></g>');

define('BD3_E11', '<g class="INF"><path d="M0.2,37.4h12.7v-8.8h1.9v10.6H0.2V37.4z" fill="#e11"></path><path d="M0.2,34.4h8.7v-5.8h1.9v7.6H0.2V34.4z" fill="#e11"></path></g>');

define('BD1_3AF', '<g class="INF"><path d="M26.2,39.3H11.6V28.7h1.9v8.8h12.7V39.3z" fill="#3af"></path><path d="M26.2,36.3H15.7v-7.6h1.9v5.8h8.7L26.2,36.3L26.2,36.3z" fill="#3af"></path></g>');

define('BD2_3AF', '<g class="INF"><rect y="37.4" width="26.5" height="1.9" fill="#3af"></rect><rect y="34.4" width="26.5" height="1.9" fill="#3af"></rect></g>');

define('BD3_3AF', '<g class="INF"><path d="M0.2,37.4h12.7v-8.8h1.9v10.6H0.2V37.4z" fill="#3af"></path><path d="M0.2,34.4h8.7v-5.8h1.9v7.6H0.2V34.4z" fill="#3af"></path></g>');



define('ODONTOGRAMA_JSON', "{p_11:{SUP:'',INF:'',RH:''},p_12:{SUP:'',INF:'',RH:''},p_13:{SUP:'',INF:'',RH:''},p_14:{SUP:'',INF:'',RH:''},p_15:{SUP:'',INF:'',RH:''},p_16:{SUP:'',INF:'',RH:''},p_17:{SUP:'',INF:'',RH:''},p_18:{SUP:'',INF:'',RH:''},p_21:{SUP:'',INF:'',RH:''},p_22:{SUP:'',INF:'',RH:''},p_23:{SUP:'',INF:'',RH:''},p_24:{SUP:'',INF:'',RH:''},p_25:{SUP:'',INF:'',RH:''},p_26:{SUP:'',INF:'',RH:''},p_27:{SUP:'',INF:'',RH:''},p_28:{SUP:'',INF:'',RH:''},p_31:{SUP:'',INF:'',RH:''},p_32:{SUP:'',INF:'',RH:''},p_33:{SUP:'',INF:'',RH:''},p_34:{SUP:'',INF:'',RH:''},p_35:{SUP:'',INF:'',RH:''},p_36:{SUP:'',INF:'',RH:''},p_37:{SUP:'',INF:'',RH:''},p_38:{SUP:'',INF:'',RH:''},p_41:{SUP:'',INF:'',RH:''},p_42:{SUP:'',INF:'',RH:''},p_43:{SUP:'',INF:'',RH:''},p_44:{SUP:'',INF:'',RH:''},p_45:{SUP:'',INF:'',RH:''},p_46:{SUP:'',INF:'',RH:''},p_47:{SUP:'',INF:'',RH:''},p_48:{SUP:'',INF:'',RH:''},p_51:{SUP:''},p_52:{SUP:''},p_53:{SUP:''},p_54:{SUP:''},p_55:{SUP:''},p_61:{SUP:''},p_62:{SUP:''},p_63:{SUP:''},p_64:{SUP:''},p_65:{SUP:''},p_71:{SUP:''},p_72:{SUP:''},p_73:{SUP:''},p_74:{SUP:''},p_75:{SUP:''},p_81:{SUP:''},p_82:{SUP:''},p_83:{SUP:''},p_84:{SUP:''},p_85:{SUP:''}}");