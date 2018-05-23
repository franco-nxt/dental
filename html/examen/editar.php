<form method="POST">
	<div class="bar-subtitle">
		<div class="container">
			<a href="<?= $Patient->url() ?>"><?= $Patient->fullname() ?></a>
		</div>
	</div>
	<div class="bar-btn">
		<div class="container">
			<button class="btn btn-success" name="action" value="save">GUARDAR</button>
			<a href="<?= $Exam->url() ?>" class="btn btn-default">CANCELAR</a>
		</div>
	</div>
	<div class="container">
		<div class="bar-bordered mt5">
			<span><?= $Treatment->resume() ?></span>
		</div>
		<div class="bar-bordered clear mb5">
			<strong>EXAMEN CLINICO</strong>
		</div>
		<div class="col-sm-5 label label-read">
			<strong>ESTRUCTURAS FACIALES : </strong>
		</div>
		<div class="col-sm-7 field field-radio-check field-blue" data-check-one>
			<input class="radio-input" type="checkbox" id="estructuras_faciales_simetricas" name="estructuras_faciales" value="simetricas" <?= checked(!empty($Exam->estructuras_faciales->simetricas)) ?>>
			<label class="radio-label" for="estructuras_faciales_simetricas">SIMETRICAS</label>
			<input class="radio-input" type="checkbox" id="estructuras_faciales_asimetricas" name="estructuras_faciales" value="asimetricas" <?= checked(!empty($Exam->estructuras_faciales->asimetricas)) ?>>
			<label class="radio-label" for="estructuras_faciales_asimetricas">ASIMETRICAS</label>
		</div>
		<div class="col-sm-5 label label-read">
			<strong>PERFIL : </strong>
		</div>
		<div class="col-sm-7 field field-radio-check field-blue" data-check-one>
			<input class="radio-input" type="checkbox" id="perfil_recto" name="perfil" value="recto" <?= checked(!empty($Exam->perfil->recto)) ?>>
			<label class="radio-label" for="perfil_recto">RECTO</label>
			<input class="radio-input" type="checkbox" id="perfil_concavo" name="perfil" value="concavo" <?= checked(!empty($Exam->perfil->concavo)) ?>>
			<label class="radio-label" for="perfil_concavo">CONCAVO</label>
			<input class="radio-input" type="checkbox" id="perfil_convexo" name="perfil" value="convexo" <?= checked(!empty($Exam->perfil->convexo)) ?>>
			<label class="radio-label" for="perfil_convexo">CONVEXO</label>
		</div>
		<div class="col-sm-5 label label-read">
			<strong>LABIOS EN REPOSO : </strong>
		</div>

		<div class="col-sm-7 field field-radio-check field-blue" data-check-one>
			<input class="radio-input" type="checkbox" id="labios_reposo_juntos" name="labios_reposo" value="juntos" <?= checked(!empty($Exam->labios_reposo->juntos)) ?>>
			<label class="radio-label" for="labios_reposo_juntos">JUNTOS</label>
			<input class="radio-input" type="checkbox" id="labios_reposo_separados" name="labios_reposo" value="separados" <?= checked(!empty($Exam->labios_reposo->separados)) ?>>
			<label class="radio-label" for="labios_reposo_separados">SEPARADOS</label>
			<input class="radio-input" type="checkbox" id="labios_reposo_forzado" name="labios_reposo" value="cierre_forzado" <?= checked(!empty($Exam->labios_reposo->cierre_forzado)) ?>>
			<label class="radio-label" for="labios_reposo_forzado">CIERRE FORZADO</label>
		</div>
		<div class="col-sm-5 label label-read">
			<strong>RESPIRACION : </strong>
		</div>
		<div class="col-sm-7 field field-radio-check field-blue" data-check-one>
			<input class="radio-input" type="checkbox" id="respiracion_normal" name="respiracion" value="normal" <?= checked(!empty($Exam->respiracion->normal)) ?>>
			<label class="radio-label" for="respiracion_normal">NORMAL</label>
			<input class="radio-input" type="checkbox" id="respiracion_bucal" name="respiracion" value="bucal" <?= checked(!empty($Exam->respiracion->bucal)) ?>>
			<label class="radio-label" for="respiracion_bucal">BUCAL</label>
			<input class="radio-input" type="checkbox" id="respiracion_mixta" name="respiracion" value="mixta" <?= checked(!empty($Exam->respiracion->mixta)) ?>>
			<label class="radio-label" for="respiracion_mixta">MIXTA</label>
		</div>
		<div class="col-sm-5 label label-read">
			<strong>DEGLUCION : </strong>
		</div>
		<div class="col-sm-7 field field-radio-check field-blue" data-check-one>
			<input class="radio-input" type="checkbox" id="deglucion_normal" name="deglucion" value="normal" <?= checked(!empty($Exam->deglucion->normal)) ?>>
			<label class="radio-label" for="deglucion_normal">NORMAL</label>
			<input class="radio-input" type="checkbox" id="deglucion_atipica" name="deglucion" value="atipica" <?= checked(!empty($Exam->deglucion->atipica)) ?>>
			<label class="radio-label" for="deglucion_atipica">ATIPICA</label>
			<input class="radio-input" type="checkbox" id="deglucion_finales" name="deglucion" value="finales" <?= checked(!empty($Exam->deglucion->finales)) ?>>
			<label class="radio-label" for="deglucion_finales">FINALES</label>
		</div>
		<div class="col-sm-5 label label-read">
			<strong>SURCO MENTOLABIAL : </strong>
		</div>
		<div class="col-sm-7 field field-radio-check field-blue" data-check-one>
			<input class="radio-input" type="checkbox" id="surco_mentolabial_normal" name="surco_mentolabial" value="normal" <?= checked(!empty($Exam->surco_mentolabial->normal)) ?>>
			<label class="radio-label" for="surco_mentolabial_normal">NORMAL</label>
			<input class="radio-input" type="checkbox" id="surco_mentolabial_pronunciado" name="surco_mentolabial" value="pronunciado" <?= checked(!empty($Exam->surco_mentolabial->pronunciado)) ?>>
			<label class="radio-label" for="surco_mentolabial_pronunciado">PRONUNCIADO</label>
			<input class="radio-input" type="checkbox" id="surco_mentolabial_inexistente" name="surco_mentolabial" value="inexistente" <?= checked(!empty($Exam->surco_mentolabial->inexistente)) ?>>
			<label class="radio-label" for="surco_mentolabial_inexistente">INEXISTENTE</label>
		</div>
		<div class="col-sm-5 label label-read">
			<strong>ATM : </strong>
		</div>
		<div class="col-sm-7 field field-radio-check field-blue">
			<input class="radio-input" type="checkbox" data-discheck=".atm_dolor,.atm_ruido" id="atm_normal" name="atm" value="normal" <?= checked(!empty($Exam->atm->normal)) ?>>
			<label class="radio-label" for="atm_normal">NORMAL</label>
		</div>
		<div class="col-sm-5 label label-read pl10">
			<strong>DOLOR : </strong>
		</div>
		<div class="col-sm-7 field field-blue" data-check-one>
			<input class="radio-input atm_dolor" type="checkbox" data-discheck="#atm_normal" id="atm_dolor_izq" name="atm[dolor][]" value="izq" <?= checked(!empty($Exam->atm->dolor->izq)) ?>>
			<label class="radio-label" for="atm_dolor_izq">IZQUIERDO</label>
			<input class="radio-input atm_dolor" type="checkbox" data-discheck="#atm_normal" id="atm_dolor_der" name="atm[dolor][]" value="der" <?= checked(!empty($Exam->atm->dolor->der)) ?>>
			<label class="radio-label" for="atm_dolor_der">DERECHO</label>
		</div>
		<div class="col-sm-5 label label-read pl10">
			<strong>RUIDO : </strong>
		</div>
		<div class="col-sm-7 field field-blue" data-check-one>
			<input class="radio-input atm_ruido" type="checkbox" data-discheck="#atm_normal" id="atm_ruido_izq" name="atm[ruido][]" value="izq" <?= checked(!empty($Exam->atm->ruido->izq)) ?>>
			<label class="radio-label" for="atm_ruido_izq">IZQUIERDO</label>
			<input class="radio-input atm_ruido" type="checkbox" data-discheck="#atm_normal" id="atm_ruido_der" name="atm[ruido][]" value="der" <?= checked(!empty($Exam->atm->ruido->der)) ?>>
			<label class="radio-label" for="atm_ruido_der">DERECHO</label>
		</div>
		<label for="clinicas_observaciones" class="clear form-group">
			<div class="col-sm-12 label">
				<strong>OBVSERVACIONES : </strong>
			</div>
			<div class="col-sm-12 field field-blue">
				<textarea name="clinicas_observaciones" id="clinicas_observaciones"><?= isset_get($Exam->clinicas_observaciones) ?></textarea>
			</div>
		</label>
		<div class="bar-bordered clear mb5">
			<strong>EXAMEN INTRAORAL</strong>
		</div>
		<div class="col-sm-5 label label-read">
			<strong>LINEA MEDIA SUPERIOR : </strong>
		</div>
		<div class="col-sm-7 field field-radio-check field-blue" data-check-one>
			<input class="radio-input" type="checkbox" name="linea_media_superior" id="linea_media_superior_desvio_izquierda" value="desvio_izquierda" <?= checked(!empty($Exam->linea_media_superior->desvio_izquierda)) ?>>
			<label class="radio-label" for="linea_media_superior_desvio_izquierda">DESVIO IZQUIERDA</label>
			<input class="radio-input" type="checkbox" name="linea_media_superior" id="linea_media_superior_desvio_derecha" value="desvio_derecha" <?= checked(!empty($Exam->linea_media_superior->desvio_derecha)) ?>>
			<label class="radio-label" for="linea_media_superior_desvio_derecha">DESVIO DERECHA</label>
		</div>
		<div class="col-sm-5 label label-read">
			<strong>LINEA MEDIA INFERIOR : </strong>
		</div>
		<div class="col-sm-7 field field-radio-check field-blue" data-check-one>
			<input class="radio-input" type="checkbox" name="linea_media_inferior" id="linea_media_inferior_desvio_izquierda" value="desvio_izquierda" <?= checked(!empty($Exam->linea_media_inferior->desvio_izquierda)) ?>>
			<label class="radio-label" for="linea_media_inferior_desvio_izquierda">DESVIO IZQUIERDA</label>
			<input class="radio-input" type="checkbox" name="linea_media_inferior" id="linea_media_inferior_desvio_derecha" value="desvio_derecha" <?= checked(!empty($Exam->linea_media_inferior->desvio_derecha)) ?>>
			<label class="radio-label" for="linea_media_inferior_desvio_derecha">DESVIO DERECHA</label>
		</div>
		<div class="col-sm-5 label label-read">
			<strong>DENTICION : </strong>
		</div>
		<div class="col-sm-7 field field-radio-check field-blue" data-check-one>
			<input class="radio-input" type="checkbox" id="denticion_primaria" name="denticion" value="primaria"  <?= checked(!empty($Exam->denticion->primaria)) ?>>
			<label class="radio-label" for="denticion_primaria">PRIMARIA</label>
			<input class="radio-input" type="checkbox" id="denticion_mixta" name="denticion" value="mixta"  <?= checked(!empty($Exam->denticion->mixta)) ?>>
			<label class="radio-label" for="denticion_mixta">MIXTA</label>
			<input class="radio-input" type="checkbox" id="denticion_permanente" name="denticion" value="permanente"  <?= checked(!empty($Exam->denticion->permanente)) ?>>
			<label class="radio-label" for="denticion_permanente">PERMANENTE</label>
		</div>
		<div class="col-sm-5 label label-read">
			<strong>DIASTEMAS SUPERIORES : </strong>
		</div>
		<div class="col-sm-7 field field-radio-check field-blue" data-check-one>
			<input class="radio-input" type="checkbox" name="diastemas_superiores" id="diastemas_superiores_no" value="no" <?= checked(!empty($Exam->diastemas_superiores->no)) ?>>
			<label class="radio-label" for="diastemas_superiores_no">NO</label>
			<input class="radio-input" type="checkbox" name="diastemas_superiores" id="diastemas_superiores_si" value="si" <?= checked(!empty($Exam->diastemas_superiores->si)) ?>>
			<label class="radio-label" for="diastemas_superiores_si">SI</label>
		</div>
		<div class="col-sm-5 label label-read">
			<strong>DIASTEMAS INFERIORES : </strong>
		</div>
		<div class="col-sm-7 field field-radio-check field-blue" data-check-one>
			<input class="radio-input" type="checkbox" name="diastemas_inferiores" id="diastemas_inferiores_no" value="no" <?= checked(!empty($Exam->diastemas_inferiores->no)) ?>>
			<label class="radio-label" for="diastemas_inferiores_no">NO</label>
			<input class="radio-input" type="checkbox" name="diastemas_inferiores" id="diastemas_inferiores_si" value="si" <?= checked(!empty($Exam->diastemas_inferiores->si)) ?>>
			<label class="radio-label" for="diastemas_inferiores_si">SI</label>
		</div>
		<div class="col-sm-5 label label-read">
			<strong>TAMA&Ntilde;O DE DIENTES : </strong>
		</div>
		<div class="col-sm-7 field field-radio-check field-blue">
			<input class="radio-input" type="checkbox" data-discheck=".macrodoncia,.microdoncia" id="tamano_dientes_normal" name="tamano_dientes" value="normal" <?= checked(!empty($Exam->tamano_dientes->normal)) ?>>
			<label class="radio-label" for="tamano_dientes_normal">NORMAL</label>
		</div>
		<div class="col-sm-5 label label-read pl10">
			<strong>MACRODONCIA : </strong>
		</div>
		<div class="col-sm-7 field field-blue">
			<input class="radio-input macrodoncia" type="checkbox" id="macrodoncia_difusa" data-discheck=".microdoncia,#tamano_dientes_normal,#macrodoncia_incisivos,#macrodoncia_caninos" name="tamano_dientes[macrodoncia]" value="difusa" <?= checked(!empty($Exam->tamano_dientes->macrodoncia->difusa)) ?>>
			<label class="radio-label" for="macrodoncia_difusa">DIFUSA</label>
			<input class="radio-input macrodoncia" type="checkbox" id="macrodoncia_incisivos" data-discheck=".microdoncia,#tamano_dientes_normal,#macrodoncia_difusa" name="tamano_dientes[macrodoncia][]" value="incisivos" <?= checked(!empty($Exam->tamano_dientes->macrodoncia->incisivos)) ?>>
			<label class="radio-label" for="macrodoncia_incisivos">INCISIVOS</label>
			<input class="radio-input macrodoncia" type="checkbox" id="macrodoncia_caninos" data-discheck=".microdoncia,#tamano_dientes_normal,#macrodoncia_difusa" name="tamano_dientes[macrodoncia][]" value="caninos" <?= checked(!empty($Exam->tamano_dientes->macrodoncia->caninos)) ?>>
			<label class="radio-label" for="macrodoncia_caninos">CANINOS</label>
		</div>
		<div class="col-sm-5 label label-read pl10">
			<strong>MICRODONCIA : </strong>
		</div>
		<div class="col-sm-7 field field-blue">
			<input class="radio-input microdoncia" id="microdoncia_difusa" type="checkbox" data-discheck=".macrodoncia,#tamano_dientes_normal,#microdoncia_incisivos,#microdoncia_caninos" name="tamano_dientes[microdoncia]" value="difusa" <?= checked(!empty($Exam->tamano_dientes->microdoncia->difusa)) ?>>
			<label class="radio-label" for="microdoncia_difusa">DIFUSA</label>
			<input class="radio-input microdoncia" id="microdoncia_incisivos" type="checkbox" data-discheck=".macrodoncia,#tamano_dientes_normal,#microdoncia_difusa" name="tamano_dientes[microdoncia][]" value="incisivos" <?= checked(!empty($Exam->tamano_dientes->microdoncia->incisivos)) ?>>
			<label class="radio-label" for="microdoncia_incisivos">INCISIVOS</label>
			<input class="radio-input microdoncia" id="microdoncia_caninos" type="checkbox" data-discheck=".macrodoncia,#tamano_dientes_normal,#microdoncia_difusa" name="tamano_dientes[microdoncia][]" value="caninos" <?= checked(!empty($Exam->tamano_dientes->microdoncia->caninos)) ?>>
			<label class="radio-label" for="microdoncia_caninos">CANINOS</label>
		</div>
		<div class="col-sm-5 label label-read">
			<strong>RESALTE</strong>  
		</div>
		<div class="col-sm-7 field field-radio-check field-blue" data-check-one>
			<input class="radio-input" type="checkbox" name="resalte" id="resalte_normal" value="normal" <?= checked(!empty($Exam->resalte->normal)) ?>>
			<label class="radio-label" for="resalte_normal">NORMAL</label>
			<input class="radio-input" type="checkbox" name="resalte" id="resalte_excesiva" value="excesiva" <?= checked(!empty($Exam->resalte->excesiva)) ?>>
			<label class="radio-label" for="resalte_excesiva">EXCESIVA</label>
			<input class="radio-input" type="checkbox" name="resalte" id="resalte_negativo" value="negativo" <?= checked(!empty($Exam->resalte->negativo)) ?>>
			<label class="radio-label" for="resalte_negativo">NEGATIVO</label>
		</div>
		<div class="col-sm-5 label label-read">
			<strong>MORDIDA CRUZADA</strong>
		</div>
		<div class="col-sm-7 field field-radio-check field-blue" data-check-one>
			<input class="radio-input" type="checkbox" name="mordida_cruzada" id="mordida_cruzada_no_presenta" value="no_presenta"<?= checked(!empty($Exam->mordida_cruzada->no_presenta)) ?>>
			<label class="radio-label" for="mordida_cruzada_no_presenta">NO PRESENTA</label>
			<input class="radio-input" type="checkbox" name="mordida_cruzada" id="mordida_cruzada_izquierda" value="izquierda" <?= checked(!empty($Exam->mordida_cruzada->izquierda)) ?>>
			<label class="radio-label" for="mordida_cruzada_izquierda">IZQUIERDA</label>
			<input class="radio-input" type="checkbox" name="mordida_cruzada" id="mordida_cruzada_derecha" value="derecha" <?= checked(!empty($Exam->mordida_cruzada->derecha)) ?>>
			<label class="radio-label" for="mordida_cruzada_derecha">DERECHA</label>
			<input class="radio-input" type="checkbox" name="mordida_cruzada" id="mordida_cruzada_bilateral" value="bilateral" <?= checked(!empty($Exam->mordida_cruzada->bilateral)) ?>>
			<label class="radio-label" for="mordida_cruzada_bilateral">BILATERAL</label>
		</div>
		<div class="col-sm-5 label label-read">
			<strong>DIFIERE EN RC/O DENTARIA</strong>
		</div>
		<div class="col-sm-7 field field-radio-check field-blue" data-check-one>
			<input class="radio-input" type="checkbox" name="rco_dentaria" id="rco_dentaria_no" value="no" <?= checked(!empty($Exam->rco_dentaria->no)) ?>>
			<label class="radio-label" for="rco_dentaria_no">NO</label>
			<input class="radio-input" type="checkbox" name="rco_dentaria" id="rco_dentaria_si" value="si" <?= checked(!empty($Exam->rco_dentaria->si)) ?>>
			<label class="radio-label" for="rco_dentaria_si">SI</label>
		</div>
		<div class="col-sm-5 label label-read">
			<strong>LONG. DE ARCO MAXILAR</strong>
		</div>
		<div class="col-sm-7 field field-radio-check field-blue" data-check-one>
			<input class="radio-input" type="checkbox" name="longitud_arco_maxilar" id="longitud_arco_maxilar_adecuada" value="adecuada" <?= checked(!empty($Exam->longitud_arco_maxilar->adecuada)) ?>>
			<label class="radio-label" for="longitud_arco_maxilar_adecuada">ADECUADA</label>
			<input class="radio-input" type="checkbox" name="longitud_arco_maxilar" id="longitud_arco_maxilar_excesiva" value="excesiva" <?= checked(!empty($Exam->longitud_arco_maxilar->excesiva)) ?>>
			<label class="radio-label" for="longitud_arco_maxilar_excesiva">EXCESIVA</label>
			<input class="radio-input" type="checkbox" name="longitud_arco_maxilar" id="longitud_arco_maxilar_deficiente" value="deficiente" <?= checked(!empty($Exam->longitud_arco_maxilar->deficiente)) ?>>
			<label class="radio-label" for="longitud_arco_maxilar_deficiente">DEFICIENTE</label>
		</div>
		<div class="col-sm-5 label label-read">
			<strong>CURVA DE SPEE</strong>
		</div>
		<div class="col-sm-7 field field-radio-check field-blue" data-check-one>
			<input class="radio-input" type="checkbox" name="curva_spee" id="curva_spee_normal" value="normal" <?= checked(!empty($Exam->curva_spee->normal)) ?>>
			<label class="radio-label" for="curva_spee_normal">NORMAL</label>
			<input class="radio-input" type="checkbox" name="curva_spee" id="curva_spee_pronunciada" value="pronunciada" <?= checked(!empty($Exam->curva_spee->pronunciada)) ?>>
			<label class="radio-label" for="curva_spee_pronunciada">PRONUNCIADA</label>
		</div>
		<div class="col-sm-5 label label-read">
			<strong>PALADAR</strong>
		</div>
		<div class="col-sm-7 field field-radio-check field-blue" data-check-one>
			<input class="radio-input" type="checkbox" name="paladar" id="paladar_normal" value="normal" <?= checked(!empty($Exam->paladar->normal)) ?>>
			<label class="radio-label" for="paladar_normal">NORMAL</label>
			<input class="radio-input" type="checkbox" name="paladar" id="paladar_ojival" value="ojival" <?= checked(!empty($Exam->paladar->ojival)) ?>>
			<label class="radio-label" for="paladar_ojival">OJIVAL</label>
			<input class="radio-input" type="checkbox" name="paladar" id="paladar_bajo" value="bajo" <?= checked(!empty($Exam->paladar->bajo)) ?>>
			<label class="radio-label" for="paladar_bajo">BAJO</label>
		</div>
		<div class="col-sm-5 label label-read">
			<strong>FISURA PALADAR</strong>
		</div>
		<div class="col-sm-7 field field-radio-check field-blue" data-check-one>
			<input class="radio-input" type="checkbox" name="fisura_paladar" id="fisura_no" value="no" <?= checked(!empty($Exam->fisura_paladar->no)) ?>>
			<label class="radio-label" for="fisura_no">NO</label>
			<input class="radio-input" type="checkbox" name="fisura_paladar" id="fisura_si" value="si" <?= checked(!empty($Exam->fisura_paladar->si)) ?>>
			<label class="radio-label" for="fisura_si">SI</label>
		</div>
		<div class="col-sm-5 label label-read">
			<strong>AGENESIAS : </strong>
		</div>
		<div class="col-sm-7 field field-blue" data-check-one>
			<input class="radio-input" type="checkbox" name="agenesias[]" id="agenesias_si" value="si" data-enable-text="#agenesias_observaciones" <?= checked(!empty($Exam->agenesias->si)) ?>>
			<label class="radio-label pointer" for="agenesias_si">SI</label>
			<input class="radio-input" type="checkbox" name="agenesias[]" id="agenesias_no" value="no" data-disable-text="#agenesias_observaciones" <?= checked(!empty($Exam->agenesias->no)) ?>>
			<label class="radio-label pointer" for="agenesias_no">NO</label>
			<label class="text-label <?= isset_disabled($Exam->agenesias->si) ?>" for="agenesias_observaciones">ESPECIFICAR </label>
			<input class="text-input" type="text" name="agenesias[observaciones]" id="agenesias_observaciones" value="<?= isset_get($Exam->agenesias->observaciones) ?>" <?= disabled(!empty($Exam->agenesias->si)) ?>/>
		</div>
		<div class="col-sm-5 label label-read">
			<strong>SUPERMUMERARIOS : </strong>
		</div>
		<div class="col-sm-7 field field-blue" data-check-one>
			<input class="radio-input" type="checkbox" name="supernumerarios[]" id="supernumerarios_si" value="si" data-enable-text="#supernumerarios_observaciones" <?= checked(!empty($Exam->supernumerarios->si)) ?>>
			<label class="radio-label pointer" for="supernumerarios_si">SI</label>
			<input class="radio-input" type="checkbox" name="supernumerarios[]" id="supernumerarios_no" value="no" data-disable-text="#supernumerarios_observaciones" <?= checked(!empty($Exam->supernumerarios->no)) ?>>
			<label class="radio-label pointer" for="supernumerarios_no">NO</label>
			<label class="text-label <?= isset_disabled($Exam->supernumerarios->si) ?>" for="supernumerarios_observaciones">POSICION </label>
			<input class="text-input" type="text" name="supernumerarios[observaciones]" id="supernumerarios_observaciones" value="<?= isset_get($Exam->supernumerarios->observaciones) ?>" <?= disabled(!empty($Exam->supernumerarios->si)) ?>/>
		</div>
		<label for="intraoral_observaciones" class="clear form-group">
			<div class="col-sm-12 label">
				<strong>OBVSERVACIONES : </strong>
			</div>
			<div class="col-sm-12 field field-blue">
				<textarea name="intraoral_observaciones" id="intraoral_observaciones"><?= isset_get($Exam->intraoral_observaciones) ?></textarea>
			</div>
		</label>
	</div>
</form>