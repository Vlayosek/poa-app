<?php $objetoInformacion= new usuarioAcciones();?>

<?php $informacionObjeto=$objetoInformacion->getInformacionCompletaOrganismoDeportivo();?>

<?php $anioActual = date('Y');?>

<?php $informacionSeleccionada=$objetoInformacion->getObtenerInformacionGeneral("SELECT idActividades,nombreActividades FROM poa_actividades;");?>

<?php $actividadesSeleccionadas=$objetoInformacion->getObtenerInformacionGeneral("SELECT idActividad FROM poa_poainicial WHERE idOrganismo='".$informacionObjeto[0][idOrganismo]."' GROUP BY idActividad LIMIT 1;");?>

<?php $inversionOrganismo=$objetoInformacion->getObtenerInformacionGeneral("SELECT b.nombreInversion FROM poa_inversion_usuario AS a INNER JOIN poa_inversion AS b ON a.idInversion=b.idInversion WHERE a.idOrganismo='".$informacionObjeto[0][idOrganismo]."' ORDER BY b.idInversion DESC LIMIT 1;");?>

<?php $inversionOrganismoQueda=$objetoInformacion->getObtenerInformacionGeneral("SELECT SUM(totalSumaItem) AS sumaItemTotal FROM poa_programacion_financiera WHERE idOrganismo='".$informacionObjeto[0][idOrganismo]."' GROUP BY idOrganismo;");?>

<?php $inversionRestante=$objetoInformacion->getRestar($inversionOrganismo[0][nombreInversion],$inversionOrganismoQueda[0][sumaItemTotal]);?>


<?php $poaPreEn=$objetoInformacion->getObtenerInformacionGeneral("SELECT activo FROM poa_preliminar_envio WHERE idOrganismo='".$informacionObjeto[0][idOrganismo]."' AND activo='A';");?>

<?php $observacionOrganismo=$objetoInformacion->getObtenerInformacionGeneral("SELECT estado FROM poa_conclusion_observacion WHERE idOrganismo='".$informacionObjeto[0][idOrganismo]."' AND estado='A';");?>

<?php $estadoFinal=$objetoInformacion->getObtenerInformacionGeneral("SELECT idOrganismo FROM poa_documentofinal WHERE idOrganismo='".$informacionObjeto[0][idOrganismo]."' AND  YEAR(NOW())='$anioActual';");?>

<?php $componentes= new componentes();?>

<div class="content-wrapper d d-flex flex-column align-items-center">

	<form class="content__configuraciones row d d-flex flex-column align-items-center mt-4 formulario__preliminarEnvio">

		<input type="hidden" id="estadoFinal" name="estadoFinal" value="<?=$estadoFinal[0][idOrganismo]?>">

		<input type="hidden" id="poaActividad" name="poaActividad" value="<?=$actividadesSeleccionadas[0][idActividad]?>">

		<input type="hidden" id="observacionOr" name="observacionOr" value="<?=$observacionOrganismo[0][estado]?>">

		<input type="hidden" id="envioPreliminar" name="envioPreliminar" value="<?=$poaPreEn[0][activo]?>">

		<input type="hidden" id="montoAsginadoFe" name="montoAsginadoFe" value="<?=number_format((float)$inversionOrganismo[0][nombreInversion], 2, '.', '')?>">

		<input type="hidden" id="montoDisponible" name="montoDisponible" value="<?=number_format((float)$inversionOrganismoQueda[0][sumaItemTotal], 2, '.', '')?>">

		<div class="text-center col col-12 titulo__enfasis uppercase__texto texto__titulo-hoja">

			Seleccionar el tipo de planificación

		</div>

		<select id="tipoAsignacionRecursos" class="mt-4 ancho__total__input__selects select-css-decorator">

			<option value="">--Seleccione el tipo de planificación--</option>

			<option value="1">Quiero registrar el Plan Operativo Anual (POA)</option>

			<option value="2">Quiero registrar el Plan Anual de Inversión Deportiva (PAID)</option>

		</select>

		<!--==================================
		=            Sección poas            =
		===================================-->

		<input type='hidden' id='despejar__montoP' name='despejar__montoP' value='<?=$inversionRestante?>'>

		<?=$componentes->getContenidoActividadesPoa("tablaPoaInicial","<tr><th colspan='6' class='uppercase__texto monto__especial__titulo'><center>Monto: ".number_format((float)$inversionOrganismo[0][nombreInversion], 2, '.', '')."</center></th></th></tr><tr class='monto__despejarEnvio'><th colspan='3' class='uppercase__texto'><center>Monto por asignar: ".number_format((float)$inversionRestante, 2, '.', '')."</center></th><th colspan='3' class='uppercase__texto'><center>Monto asignado: ".number_format((float)$inversionOrganismoQueda[0][sumaItemTotal], 2, '.', '')."</center></th></tr><tr><th><center>Código actividad</center></th><th style='width:15%!important;'><center>Nombre actividad</center></th><th style='width:20%!important;'><center>Indicador</center></th><th style='width:5%!important;'><center>Planificación de indicadores</center></th><th class='columna__item' style='width:5%!important;'><center>Planificar Items</center></th><th class='columna__matricez'><center>Mátricez<br>(Seleccionar la mátriz para INGRESAR / EDITAR información)</center></th></tr>","body__actividadesEs");?>		
		
		
		<!--====  End of Sección poas  ====-->

	</form>

</div>

<!--=====================================
=            Sección modales            =
======================================-->

<?php foreach ($informacionSeleccionada as $clave => $valor): ?>

	<?php foreach ($valor as $clave2 => $valor2): ?>

		<?=$componentes->getModalAtributos("modalActividad".$valor2,"formModalActividades".$valor2,$informacionSeleccionada[$clave]['idActividades'].".-".$informacionSeleccionada[$clave]['nombreActividades'],"insertar".$informacionSeleccionada[$clave]['idActividades'],["PLANIFICACIÓN DE INDICADORES","I Trimestre","II Trimestre","III Trimestre","IV Trimestre","Meta Anual del indicador"],["planificacionIndicadores","primerTrimestre".$valor2,"segundoTrimestre".$valor2,"tercerTrimestre".$valor2,"cuartoTrimestre".$valor2,"metaAnualIndicador".$valor2,"botonItems".$valor2],["textos","input","input","input","input","input","boton"],["textos","numero","numero","numero","numero","disabled","boton"],"<i class='fas fa-save'></i>&nbsp;&nbsp;GUARDAR");?>


		<?=$componentes->getModalConfiguracionItemsPoa("modalActividadItem".$valor2,"Items de ".$informacionSeleccionada[$clave]['nombreActividades'],"itemsContents".$valor2,"agregarItems".$valor2,"verItemsActividades".$valor2,"tablaItemsAc".$valor2,["Código","Item","Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre","Total","Eliminar","Editar"],"contenedorItemsAc","contenedorItemsC".$valor2);?>

	<?php endforeach ?>

	<?=$componentes->getModalMatricez("modalMatriz".$informacionSeleccionada[$clave]['idActividades'],"formMatriz".$informacionSeleccionada[$clave]['idActividades'],$informacionSeleccionada[$clave]['idActividades'].".-".$informacionSeleccionada[$clave]['nombreActividades'],"tablaHead".$informacionSeleccionada[$clave]['idActividades'],"cuerpoMatriz".$informacionSeleccionada[$clave]['idActividades']);?>

	
<?php endforeach ?>



<?=$componentes->getModalMeses("editarMesesItems","formMesesNece","Organismo",["input__1","select__tipoOrga"],["Correo","Tipo de organismo"],"editarOrganismoC");?>

<!--====  End of Sección modales  ====-->


