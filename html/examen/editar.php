<form method="POST">
	<div class="bar-subtitle">
		<div class="container">
			<a href="<?= $Patient->url() ?>"><?= $Patient->fullname() ?></a>
		</div>
	</div>
	<div class="bar-btn">
		<div class="container">
			<button class="btn btn-success" name="action" value="save">GUARDAR</button>
			<a href="<?= $Patient->url('diagnostico') ?>" class="btn btn-default">CANCELAR</a>
		</div>
	</div>
	<div class="container">
		<div class="bar-bordered mt5">
			<span><?= $Treatment->fecha_hora_inicio ?> - <?= $Treatment->estado ?> - <?= $Treatment->tecnica ?> - <?= $Treatment->descripcion ?></span>
		</div>
		<div class="bar-bordered clear mb5">
			<strong>EXAMEN CLINICO</strong>
		</div>
		<div class="col-sm-5 label label-read">
			<strong>ESTRUCTURAS FACIALES : </strong>
		</div>
		<div class="col-sm-7 field field-radio-check field-blue">
			<input type="radio" id="estructuras_faciales_simetricas" name="estructuras_faciales" value="simetricas" <?= checked(!empty($Exam->estructuras_faciales->simetricas)) ?>><label for="estructuras_faciales_simetricas">SIMETRICAS</label>
			<input type="radio" id="estructuras_faciales_asimetricas" name="estructuras_faciales" value="asimetricas" <?= checked(!empty($Exam->estructuras_faciales->asimetricas)) ?>><label for="estructuras_faciales_asimetricas">ASIMETRICAS</label>
		</div>
		<div class="col-sm-5 label label-read">
			<strong>PERFIL : </strong>
		</div>
		<div class="col-sm-7 field field-radio-check field-blue">
			<input type="radio" id="perfil_recto" name="perfil" value="recto" <?= checked(!empty($Exam->perfil->recto)) ?>><label for="perfil_recto">RECTO</label>
			<input type="radio" id="perfil_concavo" name="perfil" value="concavo" <?= checked(!empty($Exam->perfil->concavo)) ?>><label for="perfil_concavo">CONCAVO</label>
			<input type="radio" id="perfil_convexo" name="perfil" value="convexo" <?= checked(!empty($Exam->perfil->convexo)) ?>><label for="perfil_convexo">CONVEXO</label>
		</div>
		<div class="col-sm-5 label label-read">
			<strong>LABIOS EN REPOSO : </strong>
		</div>
		<div class="col-sm-7 field field-radio-check field-blue">
			<input type="radio" id="labios_reposo_juntos" name="labios_reposo" value="juntos" <?= checked(!empty($Exam->labios_reposo->juntos)) ?>><label for="labios_reposo_juntos">JUNTOS</label>
			<input type="radio" id="labios_reposo_separados" name="labios_reposo" value="separados" <?= checked(!empty($Exam->labios_reposo->separados)) ?>><label for="labios_reposo_separados">SEPARADOS</label>
			<input type="radio" id="labios_reposo_forzado" name="labios_reposo" value="cierre_forzado" <?= checked(!empty($Exam->labios_reposo->cierre_forzado)) ?>><label for="labios_reposo_forzado">CIERRE FORZADO</label>
		</div>
		<div class="col-sm-5 label label-read">
			<strong>RESPIRACION : </strong>
		</div>
		<div class="col-sm-7 field field-radio-check field-blue">
			<input type="radio" id="respiracion_normal" name="respiracion" value="normal" <?= checked(!empty($Exam->respiracion->normal)) ?>><label for="respiracion_normal">NORMAL</label>
			<input type="radio" id="respiracion_bucal" name="respiracion" value="bucal" <?= checked(!empty($Exam->respiracion->bucal)) ?>><label for="respiracion_bucal">BUCAL</label>
			<input type="radio" id="respiracion_mixta" name="respiracion" value="mixta" <?= checked(!empty($Exam->respiracion->mixta)) ?>><label for="respiracion_mixta">MIXTA</label>
		</div>
		<div class="col-sm-5 label label-read">
			<strong>DEGLUCION : </strong>
		</div>
		<div class="col-sm-7 field field-radio-check field-blue">
			<input type="radio" id="deglucion_normal" name="deglucion" value="normal" <?= checked(!empty($Exam->deglucion->normal)) ?>><label for="deglucion_normal">NORMAL</label>
			<input type="radio" id="deglucion_atipica" name="deglucion" value="atipica" <?= checked(!empty($Exam->deglucion->atipica)) ?>><label for="deglucion_atipica">ATIPICA</label>
			<input type="radio" id="deglucion_finales" name="deglucion" value="finales" <?= checked(!empty($Exam->deglucion->finales)) ?>><label for="deglucion_finales">FINALES</label>
		</div>
		<div class="col-sm-5 label label-read">
			<strong>SURCO MENTOLABIAL : </strong>
		</div>
		<div class="col-sm-7 field field-radio-check field-blue">
			<input type="radio" id="surco_mentolabial_normal" name="surco_mentolabial" value="normal" <?= checked(!empty($Exam->surco_mentolabial->normal)) ?>><label for="surco_mentolabial_normal">NORMAL</label>
			<input type="radio" id="surco_mentolabial_pronunciado" name="surco_mentolabial" value="pronunciado" <?= checked(!empty($Exam->surco_mentolabial->pronunciado)) ?>><label for="surco_mentolabial_pronunciado">PRONUNCIADO</label>
			<input type="radio" id="surco_mentolabial_inexistente" name="surco_mentolabial" value="inexistente" <?= checked(!empty($Exam->surco_mentolabial->inexistente)) ?>><label for="surco_mentolabial_inexistente">INEXISTENTE</label>
		</div>
		<div class="col-sm-5 label label-read">
			<strong>ATM : </strong>
		</div>
		<div class="col-sm-7 field field-radio-check field-blue">
			<input type="radio" data-discheck=".atm_dolor,.atm_ruido" id="atm_normal" name="atm" value="normal" <?= checked(!empty($Exam->atm->normal)) ?>><label for="atm_normal">NORMAL</label>
		</div>
		<div class="col-sm-5 label label-read pl10">
			<strong>DOLOR : </strong>
		</div>
		<div class="col-sm-7 field field-checkbox-check field-blue">
			<input type="checkbox" class="atm_dolor" data-discheck="#atm_normal" id="atm_dolor_izq" name="atm[dolor][]" value="izq" <?= checked(!empty($Exam->atm->dolor->izq)) ?>><label for="atm_dolor_izq">IZQUIERDO</label>
			<input type="checkbox" class="atm_dolor" data-discheck="#atm_normal" id="atm_dolor_der" name="atm[dolor][]" value="der" <?= checked(!empty($Exam->atm->dolor->der)) ?>><label for="atm_dolor_der">DERECHO</label>
		</div>
		<div class="col-sm-5 label label-read pl10">
			<strong>RUIDO : </strong>
		</div>
		<div class="col-sm-7 field field-checkbox-check field-blue">
			<input type="checkbox" class="atm_ruido" data-discheck="#atm_normal" id="atm_ruido_izq" name="atm[ruido][]" value="izq" <?= checked(!empty($Exam->atm->ruido->izq)) ?>><label for="atm_ruido_izq">IZQUIERDO</label>
			<input type="checkbox" class="atm_ruido" data-discheck="#atm_normal" id="atm_ruido_der" name="atm[ruido][]" value="der" <?= checked(!empty($Exam->atm->ruido->der)) ?>><label for="atm_ruido_der">DERECHO</label>
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
		<div class="col-sm-7 field field-radio-check field-blue">
			<input type="radio" name="linea_media_superior" id="linea_media_superior_desvio_izquierda" value="desvio_izquierda" <?= checked(!empty($Exam->linea_media_superior->desvio_izquierda)) ?>><label for="linea_media_superior_desvio_izquierda">DESVIO IZQUIERDA</label>
			<input type="radio" name="linea_media_superior" id="linea_media_superior_desvio_derecha" value="desvio_derecha" <?= checked(!empty($Exam->linea_media_superior->desvio_derecha)) ?>><label for="linea_media_superior_desvio_derecha">DESVIO DERECHA</label>
		</div>
		<div class="col-sm-5 label label-read">
			<strong>LINEA MEDIA INFERIOR : </strong>
		</div>
		<div class="col-sm-7 field field-radio-check field-blue">
			<input type="radio" name="linea_media_inferior" id="linea_media_inferior_desvio_izquierda" value="desvio_izquierda" <?= checked(!empty($Exam->linea_media_inferior->desvio_izquierda)) ?>><label for="linea_media_inferior_desvio_izquierda">DESVIO IZQUIERDA</label>
			<input type="radio" name="linea_media_inferior" id="linea_media_inferior_desvio_derecha" value="desvio_derecha" <?= checked(!empty($Exam->linea_media_inferior->desvio_derecha)) ?>><label for="linea_media_inferior_desvio_derecha">DESVIO DERECHA</label>
		</div>
		<div class="col-sm-5 label label-read">
			<strong>DENTICION : </strong>
		</div>
		<div class="col-sm-7 field field-radio-check field-blue">
			<input type="radio" id="denticion_primaria" name="denticion" value="primaria"  <?= checked(!empty($Exam->denticion->primaria)) ?>><label for="denticion_primaria">PRIMARIA</label>
			<input type="radio" id="denticion_mixta" name="denticion" value="mixta"  <?= checked(!empty($Exam->denticion->mixta)) ?>><label for="denticion_mixta">MIXTA</label>
			<input type="radio" id="denticion_permanente" name="denticion" value="permanente"  <?= checked(!empty($Exam->denticion->permanente)) ?>><label for="denticion_permanente">PERMANENTE</label>
		</div>
		<div class="col-sm-5 label label-read">
			<strong>DIASTEMAS SUPERIORES : </strong>
		</div>
		<div class="col-sm-7 field field-radio-check field-blue">
			<input type="radio" name="diastemas_superiores" id="diastemas_superiores_no" value="no" <?= checked(!empty($Exam->diastemas_superiores->no)) ?>><label for="diastemas_superiores_no">NO</label>
			<input type="radio" name="diastemas_superiores" id="diastemas_superiores_si" value="si" <?= checked(!empty($Exam->diastemas_superiores->si)) ?>><label for="diastemas_superiores_si">SI</label>
		</div>
		<div class="col-sm-5 label label-read">
			<strong>DIASTEMAS INFERIORES : </strong>
		</div>
		<div class="col-sm-7 field field-radio-check field-blue">
			<input type="radio" name="diastemas_inferiores" id="diastemas_inferiores_no" value="no" <?= checked(!empty($Exam->diastemas_inferiores->no)) ?>><label for="diastemas_inferiores_no">NO</label>
			<input type="radio" name="diastemas_inferiores" id="diastemas_inferiores_si" value="si" <?= checked(!empty($Exam->diastemas_inferiores->si)) ?>><label for="diastemas_inferiores_si">SI</label>
		</div>
		<div class="col-sm-5 label label-read">
			<strong>TAMA&Ntilde;O DE DIENTES : </strong>
		</div>
		<div class="col-sm-7 field field-radio-check field-blue">
			<input type="radio" data-discheck=".macrodoncia,.microdoncia" id="tamano_dientes_normal" name="tamano_dientes" value="normal" <?= checked(!empty($Exam->tamano_dientes->normal)) ?>><label for="tamano_dientes_normal">NORMAL</label>
		</div>
		<div class="col-sm-5 label label-read pl10">
			<strong>MACRODONCIA : </strong>
		</div>
		<div class="col-sm-7 field field-checkbox-check field-blue">
			<input type="checkbox" class="macrodoncia" data-discheck=".microdoncia,#tamano_dientes_normal,#macrodoncia_incisivos,#macrodoncia_caninos" id="macrodoncia_difusa" name="tamano_dientes[macrodoncia]" value="difusa" <?= checked(!empty($Exam->tamano_dientes->macrodoncia->difusa)) ?>><label for="macrodoncia_difusa">DIFUSA</label>
			<input type="checkbox" class="macrodoncia" data-discheck=".microdoncia,#tamano_dientes_normal,#macrodoncia_difusa" id="macrodoncia_incisivos" name="tamano_dientes[macrodoncia][]" value="incisivos" <?= checked(!empty($Exam->tamano_dientes->macrodoncia->incisivos)) ?>><label for="macrodoncia_incisivos">INCISIVOS</label>
			<input type="checkbox" class="macrodoncia" data-discheck=".microdoncia,#tamano_dientes_normal,#macrodoncia_difusa" id="macrodoncia_caninos" name="tamano_dientes[macrodoncia][]" value="caninos" <?= checked(!empty($Exam->tamano_dientes->macrodoncia->caninos)) ?>><label for="macrodoncia_caninos">CANINOS</label>
		</div>
		<div class="col-sm-5 label label-read pl10">
			<strong>MICRODONCIA : </strong>
		</div>
		<div class="col-sm-7 field field-checkbox-check field-blue">
			<input type="checkbox" class="microdoncia" data-discheck=".macrodoncia,#tamano_dientes_normal,#microdoncia_incisivos,#microdoncia_caninos" id="microdoncia_difusa" name="tamano_dientes[microdoncia]" value="difusa" <?= checked(!empty($Exam->tamano_dientes->microdoncia->difusa)) ?>><label for="microdoncia_difusa">DIFUSA</label>
			<input type="checkbox" class="microdoncia" data-discheck=".macrodoncia,#tamano_dientes_normal,#microdoncia_difusa" id="microdoncia_incisivos" name="tamano_dientes[microdoncia][]" value="incisivos" <?= checked(!empty($Exam->tamano_dientes->microdoncia->incisivos)) ?>><label for="microdoncia_incisivos">INCISIVOS</label>
			<input type="checkbox" class="microdoncia" data-discheck=".macrodoncia,#tamano_dientes_normal,#microdoncia_difusa" id="microdoncia_caninos" name="tamano_dientes[microdoncia][]" value="caninos" <?= checked(!empty($Exam->tamano_dientes->microdoncia->caninos)) ?>><label for="microdoncia_caninos">CANINOS</label>
		</div>
		<div class="col-sm-5 label label-read">
			<strong>RESALTE</strong>  
		</div>
		<div class="col-sm-7 field field-radio-check field-blue">
			<input type="radio" name="resalte" id="resalte_normal" value="normal" <?= checked(!empty($Exam->resalte->normal)) ?>><label for="resalte_normal">NORMAL</label>
			<input type="radio" name="resalte" id="resalte_excesiva" value="excesiva" <?= checked(!empty($Exam->resalte->excesiva)) ?>><label for="resalte_excesiva">EXCESIVA</label>
			<input type="radio" name="resalte" id="resalte_negativo" value="negativo" <?= checked(!empty($Exam->resalte->negativo)) ?>><label for="resalte_negativo">NEGATIVO</label>
		</div>
		<div class="col-sm-5 label label-read">
			<strong>MORDIDA CRUZADA</strong>
		</div>
		<div class="col-sm-7 field field-radio-check field-blue">
			<input type="radio" name="mordida_cruzada" id="mordida_cruzada_no_presenta" value="no_presenta"<?= checked(!empty($Exam->mordida_cruzada->no_presenta)) ?>><label for="mordida_cruzada_no_presenta">NO PRESENTA</label>
			<input type="radio" name="mordida_cruzada" id="mordida_cruzada_izquierda" value="izquierda" <?= checked(!empty($Exam->mordida_cruzada->izquierda)) ?>><label for="mordida_cruzada_izquierda">IZQUIERDA</label>
			<input type="radio" name="mordida_cruzada" id="mordida_cruzada_derecha" value="derecha" <?= checked(!empty($Exam->mordida_cruzada->derecha)) ?>><label for="mordida_cruzada_derecha">DERECHA</label>
			<input type="radio" name="mordida_cruzada" id="mordida_cruzada_bilateral" value="bilateral" <?= checked(!empty($Exam->mordida_cruzada->bilateral)) ?>><label for="mordida_cruzada_bilateral">BILATERAL</label>
		</div>
		<div class="col-sm-5 label label-read">
			<strong>DIFIERE EN RC/O DENTARIA</strong>
		</div>
		<div class="col-sm-7 field field-radio-check field-blue">
			<input type="radio" name="rco_dentaria" id="rco_dentaria_no" value="no" <?= checked(!empty($Exam->rco_dentaria->no)) ?>><label for="rco_dentaria_no">NO</label>
			<input type="radio" name="rco_dentaria" id="rco_dentaria_si" value="si" <?= checked(!empty($Exam->rco_dentaria->si)) ?>><label for="rco_dentaria_si">SI</label>
		</div>
		<div class="col-sm-5 label label-read">
			<strong>LONG. DE ARCO MAXILAR</strong>
		</div>
		<div class="col-sm-7 field field-radio-check field-blue">
			<input type="radio" name="longitud_arco_maxilar" id="longitud_arco_maxilar_adecuada" value="adecuada" <?= checked(!empty($Exam->longitud_arco_maxilar->adecuada)) ?>><label for="longitud_arco_maxilar_adecuada">ADECUADA</label>
			<input type="radio" name="longitud_arco_maxilar" id="longitud_arco_maxilar_excesiva" value="excesiva" <?= checked(!empty($Exam->longitud_arco_maxilar->excesiva)) ?>><label for="longitud_arco_maxilar_excesiva">EXCESIVA</label>
			<input type="radio" name="longitud_arco_maxilar" id="longitud_arco_maxilar_deficiente" value="deficiente" <?= checked(!empty($Exam->longitud_arco_maxilar->deficiente)) ?>><label for="longitud_arco_maxilar_deficiente">DEFICIENTE</label>
		</div>
		<div class="col-sm-5 label label-read">
			<strong>CURVA DE SPEE</strong>
		</div>
		<div class="col-sm-7 field field-radio-check field-blue">
			<input type="radio" name="curva_spee" id="curva_spee_normal" value="normal" <?= checked(!empty($Exam->curva_spee->normal)) ?>><label for="curva_spee_normal">NORMAL</label>
			<input type="radio" name="curva_spee" id="curva_spee_pronunciada" value="pronunciada" <?= checked(!empty($Exam->curva_spee->pronunciada)) ?>><label for="curva_spee_pronunciada">PRONUNCIADA</label>
		</div>
		<div class="col-sm-5 label label-read">
			<strong>PALADAR</strong>
		</div>
		<div class="col-sm-7 field field-radio-check field-blue">
			<input type="radio" name="paladar" id="paladar_normal" value="normal" <?= checked(!empty($Exam->paladar->normal)) ?>><label for="paladar_normal">NORMAL</label>
			<input type="radio" name="paladar" id="paladar_ojival" value="ojival" <?= checked(!empty($Exam->paladar->ojival)) ?>><label for="paladar_ojival">OJIVAL</label>
			<input type="radio" name="paladar" id="paladar_bajo" value="bajo" <?= checked(!empty($Exam->paladar->bajo)) ?>><label for="paladar_bajo">BAJO</label>
		</div>
		<div class="col-sm-5 label label-read">
			<strong>FISURA PALADAR</strong>
		</div>
		<div class="col-sm-7 field field-radio-check field-blue">
			<input type="radio" name="fisura_paladar" id="fisura_no" value="no" <?= checked(!empty($Exam->fisura_paladar->no)) ?>><label for="fisura_no">NO</label>
			<input type="radio" name="fisura_paladar" id="fisura_si" value="si" <?= checked(!empty($Exam->fisura_paladar->si)) ?>><label for="fisura_si">SI</label>
		</div>
		<div class="col-sm-5 label label-read">
			<strong>AGENESIAS : </strong>
		</div>
		<div class="col-sm-7 field field-read field-radio field-blue">
			<input type="radio" name="agenesias[]" id="agenesias_si" value="si" onchange="seton('#agenesias_observaciones')"  <?= checked(!empty($Exam->agenesias->si)) ?>><label class="pointer" for="agenesias_si">SI</label>
			<input type="radio" name="agenesias[]" id="agenesias_no" value="no" onchange="setoff('#agenesias_observaciones')"  <?= checked(!empty($Exam->agenesias->no)) ?>><label class="pointer" for="agenesias_no">NO</label>
			<label for="agenesias_observaciones" class="<?= isset_disabled($Exam->agenesias->si) ?>">ESPECIFICAR </label>
			<input type="text" name="agenesias[observaciones]" id="agenesias_observaciones" value="<?= isset_get($Exam->agenesias->observaciones) ?>" <?= disabled(!empty($Exam->agenesias->si)) ?>/>
		</div>
		<div class="col-sm-5 label label-read">
			<strong>SUPERMUMERARIOS : </strong>
		</div>
		<div class="col-sm-7 field field-read field-radio field-blue">
			<input type="radio" name="supernumerarios[]" id="supernumerarios_si" value="si" onchange="seton('#supernumerarios_observaciones')" <?= checked(!empty($Exam->supernumerarios->si)) ?>><label class="pointer" for="supernumerarios_si">SI</label>
			<input type="radio" name="supernumerarios[]" id="supernumerarios_no" value="no" onchange="setoff('#supernumerarios_observaciones')" <?= checked(!empty($Exam->supernumerarios->no)) ?>><label class="pointer" for="supernumerarios_no">NO</label>
			<label for="supernumerarios_observaciones" class="<?= isset_disabled($Exam->supernumerarios->si) ?>">POSICION </label>
			<input type="text" name="supernumerarios[observaciones]" id="supernumerarios_observaciones" value="<?= isset_get($Exam->supernumerarios->observaciones) ?>" <?= disabled(!empty($Exam->supernumerarios->si)) ?>/>
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