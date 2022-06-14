<?php
	
	extract($_POST);

	require_once "../../config/config2.php";

	/*============================================
	=            Parametros Iniciales            =
	============================================*/
	
	date_default_timezone_set("America/Guayaquil");

	$fecha_actual = date('Y-m-d');

	$hora_actual= date('H:i:s');	
	
	/*=====  End of Parametros Iniciales  ======*/
	

	$objeto= new usuarioAcciones();

	switch ($tipo) {
		
		case  "seleccionExcel":

			$check_modificaciones = json_decode($check_modificaciones);

			$idProgramacionFinanciera=array();
			$nombreItem=array();
			$enero=array();
			$febrero=array();
			$marzo=array();
			$abril=array();
			$mayo=array();
			$junio=array();
			$julio=array();
			$agosto=array();
			$septiembre=array();
			$octubre=array();
			$noviembre=array();
			$diciembre=array();
			$totalTotales=array();

			foreach ($check_modificaciones as $value) {
				
				$consulta=$objeto->getObtenerInformacionGeneral("SELECT a.idProgramacionFinanciera,REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(b.nombreItem, 'Ã¡', 'á'),'Ã©','é'),'Ã­','í'),'Ã³','ó'),'Ãº','ú'),'Ã‰','É'),'ÃŒ','Í'),'Ã“','Ó'),'Ãš','Ú'),'Ã±','ñ'),'Ã‘','Ñ'),'&#039;',' ` '),'Ã','Á'),'',' '),'Ã','Á'),'SI','SI'),'â€œ',''),'â€',''),'Á²','ó') AS nombreItem,a.enero,a.febrero,a.marzo,a.abril,a.mayo,a.junio,a.julio,a.agosto,a.septiembre,a.octubre,a.noviembre,a.diciembre,a.totalTotales FROM poa_programacion_financiera AS a INNER JOIN poa_item AS b ON a.idItem=b.idItem WHERE a.idProgramacionFinanciera='$value';");

				array_push($idProgramacionFinanciera,$consulta[0][idProgramacionFinanciera]);
				array_push($nombreItem,$consulta[0][nombreItem]);
				array_push($enero,$consulta[0][enero]);
				array_push($febrero,$consulta[0][febrero]);
				array_push($marzo,$consulta[0][marzo]);
				array_push($abril,$consulta[0][abril]);
				array_push($mayo,$consulta[0][mayo]);
				array_push($junio,$consulta[0][junio]);
				array_push($julio,$consulta[0][julio]);
				array_push($agosto,$consulta[0][agosto]);
				array_push($septiembre,$consulta[0][septiembre]);
				array_push($octubre,$consulta[0][octubre]);
				array_push($noviembre,$consulta[0][noviembre]);
				array_push($diciembre,$consulta[0][diciembre]);
				array_push($totalTotales,$consulta[0][totalTotales]);

			}

			$jason['idProgramacionFinanciera']=$idProgramacionFinanciera;
			$jason['nombreItem']=$nombreItem;
			$jason['enero']=$enero;
			$jason['febrero']=$febrero;
			$jason['marzo']=$marzo;
			$jason['abril']=$abril;
			$jason['mayo']=$mayo;
			$jason['junio']=$junio;
			$jason['julio']=$julio;
			$jason['agosto']=$agosto;
			$jason['septiembre']=$septiembre;
			$jason['octubre']=$octubre;
			$jason['noviembre']=$noviembre;
			$jason['diciembre']=$diciembre;
			$jason['totalTotales']=$totalTotales;

		break;

		case  "ruc_i":

			$informacion__obtenidas=$objeto->getObtenerInformacionGeneral("SELECT a.idOrganismo,REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(a.nombreOrganismo, 'Ã¡', 'á'),'Ã©','é'),'Ã­','í'),'Ã³','ó'),'Ãº','ú'),'Ã‰','É'),'ÃŒ','Í'),'Ã“','Ó'),'Ãš','Ú'),'Ã±','ñ'),'Ã‘','Ñ'),'&#039;',' ` '),'Ã','Á'),'',' '),'Ã','Á'),'SI','SI'),'â€œ',''),'â€',''),'Á²','ó') AS nombreOrganismo,(SELECT a1.nombreProvincia FROM in_md_provincias AS a1 WHERE a1.idProvincia=a.idProvincia) AS nombreProvincia,(SELECT a1.nombreCanton FROM in_md_canton AS a1 WHERE a1.idCanton=a.idCanton) AS nombreCanton,(SELECT a1.nombreParroquia FROM in_md_parroquia AS a1 WHERE a1.idParroquia=a.idParroquia) AS nombreParroquia FROM poa_organismo AS a WHERE a.ruc='$rucOrganismo';");

			$jason['informacion__obtenidas']=$informacion__obtenidas;

		break;

		case  "observasEstados":

			$informacion__obtenidas=$objeto->getObtenerInformacionGeneral("SELECT documento,observaciones FROM poa_concluciones WHERE estadoObservacion='A' AND idOrganismo='$idOrganismos' AND tipoObservacion='$disgustador';");

			$jason['informacion__obtenidas']=$informacion__obtenidas;

		break;

		case  "seleccionasCoordinas":

			$obtenerInformacion=$objeto->getObtenerInformacionGeneral("SELECT c.idActividades,REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(c.nombreActividades, 'Ã¡', 'á'),'Ã©','é'),'Ã­','í'),'Ã³','ó'),'Ãº','ú'),'Ã‰','É'),'ÃŒ','Í'),'Ã“','Ó'),'Ãš','Ú'),'Ã±','ñ'),'Ã‘','Ñ'),'&#039;',' ` '),'Ã','Á'),'',' '),'Ã','Á'),'SI','SI'),'â€œ',''),'â€',''),'Á²','ó') AS nombreActividades,REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(b.nombreItem, 'Ã¡', 'á'),'Ã©','é'),'Ã­','í'),'Ã³','ó'),'Ãº','ú'),'Ã‰','É'),'ÃŒ','Í'),'Ã“','Ó'),'Ãš','Ú'),'Ã±','ñ'),'Ã‘','Ñ'),'&#039;',' ` '),'Ã','Á'),'',' '),'Ã','Á'),'SI','SI'),'â€œ',''),'â€',''),'Á²','ó') AS nombreItem,a.enero,a.febrero,a.marzo,a.abril,a.mayo,a.junio, a.julio,a.agosto,a.septiembre,a.octubre,a.noviembre,a.diciembre,a.totalSumaItem,b.itemPreesupuestario AS subsecretaria,b.itemPreesupuestario FROM poa_programacion_financiera AS a INNER JOIN poa_item AS b ON a.idItem=b.idItem INNER JOIN poa_actividades AS c ON c.idActividades=a.idActividad WHERE a.idOrganismo='$idOrganismo' ORDER BY a.idActividad ASC;");




			$indicadorInformacion=$objeto->getObtenerInformacionGeneral("SELECT CONCAT_WS(' ',(SELECT REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(b1.nombreIndicador, 'Ã¡', 'á'),'Ã©','é'),'Ã­','í'),'Ã³','ó'),'Ãº','ú'),'Ã‰','É'),'ÃŒ','Í'),'Ã“','Ó'),'Ãš','Ú'),'Ã±','ñ'),'Ã‘','Ñ'),'&#039;',' ` '),'Ã','Á'),'',' '),'Ã','Á'),'SI','SI'),'â€œ',''),'â€',''),'Á²','ó') FROM poa_actividades AS a1 INNER JOIN poa_indicadores AS b1 ON a1.idLineaPolitica=b1.idIndicadores WHERE a1.idActividades=a.idActividad LIMIT 1)) AS indicador, a.primertrimestre AS primertrimestre,a.segundotrimestre,a.tercertrimestre,a.cuartotrimestre,a.metaindicador,a.idActividad FROM poa_poainicial AS a WHERE a.idOrganismo='$idOrganismo' ORDER BY a.idPoaEnviado DESC;");

			

			$obtenerArchivoCoordinas__infras=$objeto->getObtenerInformacionGeneral("SELECT documento FROM poa_concluciones WHERE (documento LIKE '%__1__4.pdf%' OR documento LIKE '%__1___15__4%') AND idOrganismo='$idOrganismo' ORDER BY idObservacionesTecnicas DESC LIMIT 1;");

			$obtenerArchivoCoordinas__administrativos=$objeto->getObtenerInformacionGeneral("SELECT documento FROM poa_concluciones WHERE (documento LIKE '%__2__4.pdf%' OR documento LIKE '%__2___7__4.pdf%') AND idOrganismo='$idOrganismo' ORDER BY idObservacionesTecnicas DESC LIMIT 2;");

			$obtenerArchivoCoordinas__subcess=$objeto->getObtenerInformacionGeneral("SELECT documento FROM poa_concluciones WHERE (documento LIKE '%__26__7.pdf%' OR documento LIKE '%__24__7.pdf%') AND idOrganismo='$idOrganismo' ORDER BY idObservacionesTecnicas DESC LIMIT 1;");

			$obtenernombre__organismos=$objeto->getObtenerInformacionGeneral("SELECT REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(nombreOrganismo, 'Ã¡', 'á'),'Ã©','é'),'Ã­','í'),'Ã³','ó'),'Ãº','ú'),'Ã‰','É'),'ÃŒ','Í'),'Ã“','Ó'),'Ãš','Ú'),'Ã±','ñ'),'Ã‘','Ñ'),'&#039;',' ` '),'Ã','Á'),'',' '),'Ã','Á'),'SI','SI'),'â€œ',''),'â€',''),'Á²','ó') AS nombreOrganismo FROM poa_organismo WHERE idOrganismo='$idOrganismo';");

			$comprobador1=true;
			$comprobador2=true;
			$comprobador3=false;

			/*===================================
			=            Actividades            =
			===================================*/

			$coordinadorId=$objeto->getObtenerInformacionGeneral("SELECT a.id_usuario FROM th_usuario AS a INNER JOIN th_usuario_roles AS b ON a.id_usuario=b.id_usuario WHERE b.id_rol='4' AND a.fisicamenteEstructura='3' AND a.estadoUsuario='A' ORDER BY a.id_usuario DESC;");

			$directorId=$objeto->getObtenerInformacionGeneral("SELECT a.id_usuario FROM th_usuario AS a INNER JOIN th_usuario_roles AS b ON a.id_usuario=b.id_usuario WHERE b.id_rol='2' AND a.fisicamenteEstructura='18' AND a.estadoUsuario='A' ORDER BY a.id_usuario DESC;");



			$actividadUno=$objeto->getObtenerInformacionGeneral("SELECT a.idOrganismo FROM poa_programacion_financiera AS a INNER JOIN poa_preliminar_envio AS b ON a.idOrganismo=b.idOrganismo WHERE a.idOrganismo='$idOrganismo' AND a.idActividad='1';");

			if (!empty($actividadUno[0][idOrganismo])) {

				$actividadFinanciero=$objeto->getObtenerInformacionGeneral("SELECT IF(financiero IS NOT NULL AND financiero2 IS NOT NULL,IF((SELECT idPoaInicial FROM poa_preliminar_envio AS a1 WHERE a1.idOrganismo=a.idOrganismo AND  b.idActividad='1' AND a.financieroE='".$coordinadorId[0][id_usuario]."' AND a.financieroE2='".$coordinadorId[0][id_usuario]."' OR a.planificacion='".$directorId[0][id_usuario]."' OR financieroE2='T' OR financieroE='E' LIMIT 1)IS NOT NULL,1,NULL),IF(financiero IS NOT NULL AND financiero2 IS NULL,IF((SELECT idPoaInicial FROM poa_preliminar_envio AS a1 WHERE a1.idOrganismo=a.idOrganismo AND  b.idActividad='1' AND a.financieroE='".$coordinadorId[0][id_usuario]."' OR a.planificacion='".$directorId[0][id_usuario]."' LIMIT 1) IS NOT NULL,1,NULL),IF(financiero IS NULL AND financiero2 IS NOT NULL,IF((SELECT idPoaInicial FROM poa_preliminar_envio AS a1 WHERE a1.idOrganismo=a.idOrganismo AND  b.idActividad='1' AND a.financieroE2='".$coordinadorId[0][id_usuario]."' OR a.planificacion='".$directorId[0][id_usuario]."' LIMIT 1) IS NOT NULL,1,NULL),1))) AS resultado FROM poa_preliminar_envio AS a INNER JOIN poa_programacion_financiera AS b ON a.idOrganismo=b.idOrganismo WHERE a.idOrganismo='$idOrganismo' AND b.idActividad='1' GROUP BY b.idActividad;");


				if ($actividadFinanciero[0][resultado]==1) {
					
					$comprobador1=true;

				}

			}else{

				$comprobador1=true;
	
			}

			$actividadDos=$objeto->getObtenerInformacionGeneral("SELECT a.idOrganismo FROM poa_programacion_financiera AS a INNER JOIN poa_preliminar_envio AS b ON a.idOrganismo=b.idOrganismo WHERE a.idOrganismo='$idOrganismo' AND a.idActividad='2';");

			if (!empty($actividadDos[0][idOrganismo])) {

				$actividadMantenimiento=$objeto->getObtenerInformacionGeneral("SELECT IF(instalaciones IS NOT NULL AND instlaaciones2 IS NOT NULL,IF((SELECT idPoaInicial FROM poa_preliminar_envio AS a1 WHERE a1.idOrganismo=a.idOrganismo AND  b.idActividad='2' AND a.instalacionesE='".$coordinadorId[0][id_usuario]."' AND a.instalacionesE2='".$coordinadorId[0][id_usuario]."' OR a.planificacion='".$directorId[0][id_usuario]."' LIMIT 1)IS NOT NULL,1,NULL),IF(instalaciones IS NOT NULL AND instlaaciones2 IS NULL,IF((SELECT idPoaInicial FROM poa_preliminar_envio AS a1 WHERE a1.idOrganismo=a.idOrganismo AND  b.idActividad='2' AND a.instalacionesE='".$coordinadorId[0][id_usuario]."' OR a.planificacion='".$directorId[0][id_usuario]."' LIMIT 1) IS NOT NULL,1,NULL),IF(instalaciones IS NULL AND instlaaciones2 IS NOT NULL,IF((SELECT idPoaInicial FROM poa_preliminar_envio AS a1 WHERE a1.idOrganismo=a.idOrganismo AND  b.idActividad='2' AND a.instlaaciones2='".$coordinadorId[0][id_usuario]."' OR a.planificacion='".$directorId[0][id_usuario]."' LIMIT 1) IS NOT NULL,1,NULL),1))) AS resultado FROM poa_preliminar_envio AS a INNER JOIN poa_programacion_financiera AS b ON a.idOrganismo=b.idOrganismo WHERE a.idOrganismo='$idOrganismo' AND b.idActividad='2' GROUP BY b.idActividad;");


				if ($actividadMantenimiento[0][resultado]==1) {
					
					$comprobador2=true;

				}

			}else{

				$comprobador2=true;

			}		

			$actividadTres=$objeto->getObtenerInformacionGeneral("SELECT a.idOrganismo FROM poa_programacion_financiera AS a INNER JOIN poa_preliminar_envio AS b ON a.idOrganismo=b.idOrganismo WHERE a.idOrganismo='$idOrganismo' AND (a.idActividad='3' OR a.idActividad='4' OR a.idActividad='5' OR a.idActividad='6' OR a.idActividad='7');");	

			if (!empty($actividadTres[0][idOrganismo])) {

				$actividadSubsecretario=$objeto->getObtenerInformacionGeneral("SELECT IF(a.subsecretariaE='".$coordinadorId[0][id_usuario]."' OR a.planificacion='".$directorId[0][id_usuario]."' OR a.subsecretaria=NULL,1,NULL) AS resultado FROM poa_preliminar_envio AS a  INNER JOIN poa_programacion_financiera AS b ON a.idOrganismo=b.idOrganismo WHERE a.idOrganismo='$idOrganismo' AND (b.idActividad='3' OR b.idActividad='4' OR b.idActividad='5' OR b.idActividad='6' OR b.idActividad='7') GROUP BY b.idActividad;");
					$comprobador3=true;


				if ($actividadSubsecretario[0][resultado]==1) {
					
					$comprobador3=true;

				}

			}else{

				$comprobador3=true;

			}		

			
			
			/*=====  End of Actividades  ======*/


			/*==========================================
			=            Actividad elegidas            =
			==========================================*/
			
			$actividad1=$objeto->getObtenerInformacionGeneral("SELECT a.idProgramacionFinanciera FROM poa_programacion_financiera AS a WHERE a.idActividad='1' AND a.idOrganismo='$idOrganismo' GROUP BY a.idOrganismo;");

			$actividad2=$objeto->getObtenerInformacionGeneral("SELECT a.idProgramacionFinanciera FROM poa_programacion_financiera AS a WHERE a.idActividad='2' AND a.idOrganismo='$idOrganismo' GROUP BY a.idOrganismo;");

			$actividad3=$objeto->getObtenerInformacionGeneral("SELECT a.idProgramacionFinanciera FROM poa_programacion_financiera AS a WHERE a.idActividad='3' OR a.idActividad='4' OR a.idActividad='5' OR a.idActividad='6' OR a.idActividad='7' AND a.idOrganismo='$idOrganismo' GROUP BY a.idOrganismo;");
			
			/*=====  End of Actividad elegidas  ======*/
			
			$actividad1__en=$actividad1[0][idProgramacionFinanciera];
			$actividad2__en=$actividad2[0][idProgramacionFinanciera];
			$actividad3__en=$actividad3[0][idProgramacionFinanciera];


			$jason['actividad1__en']=$actividad1__en;
			$jason['actividad2__en']=$actividad2__en;
			$jason['actividad3__en']=$actividad3__en;

			$jason['comprobador1']=$comprobador1;
			$jason['comprobador2']=$comprobador2;
			$jason['comprobador3']=$comprobador3;


			$jason['obtenerInformacion']=$obtenerInformacion;
			$jason['indicadorInformacion']=$indicadorInformacion;

			$jason['obtenerArchivoCoordinas__infras']=$obtenerArchivoCoordinas__infras;
			$jason['obtenerArchivoCoordinas__administrativos']=$obtenerArchivoCoordinas__administrativos;
			$jason['obtenerArchivoCoordinas__subcess']=$obtenerArchivoCoordinas__subcess;
			$jason['obtenernombre__organismos']=$obtenernombre__organismos;

		break;	

		case  "seleccionaItemsEditables":

			$obtenerInformacion=$objeto->getObtenerInformacionGeneral("SELECT enero,febrero,marzo,abril,mayo,junio,julio,agosto,septiembre,octubre,noviembre,diciembre,idProgramacionFinanciera,totalSumaItem FROM poa_programacion_financiera WHERE idProgramacionFinanciera='$idEnviado';");

			$jason['obtenerInformacion']=$obtenerInformacion;

		break;	

		case  "matricesSC":

			if ($idActividad==3 || $idActividad==5 || $idActividad==6 || $idActividad==7) {
				
				$obtenerAcCa=$objeto->getObtenerInformacionGeneral("SELECT b.idActividad FROM poa_actdeportivas AS a INNER JOIN poa_programacion_financiera AS b ON a.idProgramacionFinanciera=b.idProgramacionFinanciera WHERE b.idActividad='$idActividad' AND b.idOrganismo='$idOrganismo' GROUP BY b.idOrganismo LIMIT 1;");

				$mensajeActividad="actDeportivas";

			}else if($idActividad==1){

				$obtenerAcCa=$objeto->getObtenerInformacionGeneral("SELECT idActividad FROM poa_sueldossalarios2022 WHERE idOrganismo='$idOrganismo' AND idActividad='$idActividad' GROUP BY idOrganismo LIMIT 1;");

				

				$obtenerAcCahHono=$objeto->getObtenerInformacionGeneral("SELECT idActividad FROM poa_honorarios2022 WHERE idOrganismo='$idOrganismo' AND idActividad='$idActividad' GROUP BY idOrganismo LIMIT 1;");

			
				$obtenerAcAdmini=$objeto->getObtenerInformacionGeneral("SELECT a.idActividadAd FROM poa_actividadesadministrativas AS a INNER JOIN poa_programacion_financiera AS b ON a.idProgramacionFinanciera=b.idProgramacionFinanciera WHERE b.idActividad='$idActividad' AND b.idOrganismo='$idOrganismo' GROUP BY b.idOrganismo LIMIT 1;");

				$obtenerSuministros=$objeto->getObtenerInformacionGeneral("SELECT idOrganismo FROM poa_suministrosn WHERE idOrganismo='$idOrganismo';");


				if (!empty($obtenerAcCa[0][idActividad])) {
					
					$mensajeActividad="sueldos__salarios";

				}else{

					$mensajeActividad=false;

				}



				if (!empty($obtenerSuministros[0][idOrganismo])) {
					
					$jason['obtenerSuministros']=$obtenerSuministros;
					$mensajeSuministros="suministros";

				}else{

					$mensajeSuministros=false;

				}

				if (!empty($obtenerAcAdmini[0][idActividadAd])) {
					
					$jason['obtenerAcAdmini']=$obtenerAcAdmini;
					$mensajeAdministrativas="administrativas";

				}else{

					$mensajeAdministrativas=false;

				}


				if (!empty($obtenerAcCahHono[0][idActividad])) {
					
					$jason['obtenerAcCahHono']=$obtenerAcCahHono;
					$mensajeActividadH="honorarios";

				}else{

					$mensajeActividadH=false;

				}
				

			}else if($idActividad==4){

				$obtenerAcCa=$objeto->getObtenerInformacionGeneral("SELECT idActividad FROM poa_sueldossalarios2022 WHERE idOrganismo='$idOrganismo' AND idActividad='$idActividad' GROUP BY idOrganismo LIMIT 1;");

				$mensajeActividad="sueldos__salarios";

				$obtenerAcCahHono=$objeto->getObtenerInformacionGeneral("SELECT idActividad FROM poa_honorarios2022 WHERE idOrganismo='$idOrganismo' AND idActividad='$idActividad' GROUP BY idOrganismo LIMIT 1;");



				if (!empty($obtenerAcCa[0][idActividad])) {
					
					$mensajeActividad="sueldos__salarios";

				}else{

					$mensajeActividad=false;

				}


				if (!empty($obtenerAcCahHono)) {
					
					$jason['obtenerAcCahHono']=$obtenerAcCahHono;
					$mensajeActividadH="honorarios";

				}else{

					$mensajeActividadH=false;

				}

			}else if($idActividad==2){

				$obtenerAcCa=$objeto->getObtenerInformacionGeneral("SELECT b.idActividad FROM poa_mantenimiento AS a INNER JOIN poa_programacion_financiera AS b ON a.idProgramacionFinanciera=b.idProgramacionFinanciera WHERE b.idActividad='$idActividad' AND b.idOrganismo='$idOrganismo';");

				$mensajeActividad="mantenimiento";

			}


			$jason['mensajeSuministros']=$mensajeSuministros;

			$jason['mensajeAdministrativas']=$mensajeAdministrativas;

			$jason['mensajeActividadH']=$mensajeActividadH;

			$jason['mensajeActividad']=$mensajeActividad;

			$jason['obtenerAcCa']=$obtenerAcCa;

		break;	


		case  "informacioSubsessFinan":

			$obtenerInformacion=$objeto->getObtenerInformacionGeneral("SELECT c.idActividades,c.nombreActividades,b.nombreItem,a.enero,a.febrero,a.marzo,a.abril,a.mayo,a.junio, a.julio,a.agosto,a.septiembre,a.octubre,a.noviembre,a.diciembre,a.totalSumaItem,b.itemPreesupuestario AS subsecretaria FROM poa_programacion_financiera AS a INNER JOIN poa_item AS b ON a.idItem=b.idItem INNER JOIN poa_actividades AS c ON c.idActividades=a.idActividad WHERE a.idOrganismo='$idOrganismo' ORDER BY a.idActividad ASC;");

			$obtenerInformacionPre=$objeto->getObtenerInformacionGeneral("SELECT a1.subsecretaria FROM poa_preliminar_envio AS a1 WHERE a1.idOrganismo='$idOrganismo' ORDER BY a1.idPoaInicial DESC LIMIT 1;");


			$obtenerInformacionPeriodos=$objeto->getObtenerInformacionGeneral("SELECT periodo FROM poa_organismo WHERE idOrganismo='$idOrganismo';");

			$obtenerInformacionObservaciones=$objeto->getObtenerInformacionGeneral("SELECT REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(a.observaciones, 'Ã¡', 'á'),'Ã©','é'),'Ã­','í'),'Ã³','ó'),'Ãº','ú'),'Ã‰','É'),'ÃŒ','Í'),'Ã“','Ó'),'Ãš','Ú'),'Ã±','ñ'),'Ã‘','Ñ'),'&#039;',' ` '),'Ã','Á'),'',' '),'Ã','Á'),'SI','SI'),'â€œ',''),'â€',''),'Á²','ó') AS observaciones,CONCAT_WS(' ',REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(b.nombre, 'Ã¡', 'á'),'Ã©','é'),'Ã­','í'),'Ã³','ó'),'Ãº','ú'),'Ã‰','É'),'ÃŒ','Í'),'Ã“','Ó'),'Ãš','Ú'),'Ã±','ñ'),'Ã‘','Ñ'),'&#039;',' ` '),'Ã','Á'),'',' '),'Ã','Á'),'SI','SI'),'â€œ',''),'â€',''),'Á²','ó') ,REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(b.apellido, 'Ã¡', 'á'),'Ã©','é'),'Ã­','í'),'Ã³','ó'),'Ãº','ú'),'Ã‰','É'),'ÃŒ','Í'),'Ã“','Ó'),'Ãš','Ú'),'Ã±','ñ'),'Ã‘','Ñ'),'&#039;',' ` '),'Ã','Á'),'',' '),'Ã','Á'),'SI','SI'),'â€œ',''),'â€',''),'Á²','ó') ) AS nombreCompleto FROM poa_observacionesenviadas AS a INNER JOIN th_usuario AS b ON a.idUsuario=b.id_usuario WHERE a.idOrganismo='$idOrganismo' AND YEAR(a.fecha)='".$obtenerInformacionPeriodos[0][periodo]."';");

			if ($fisicamenteE==27 || $fisicamenteE==28 || $fisicamenteE==29 || $fisicamenteE==30 || $fisicamenteE==31 || $fisicamenteE==32 || $fisicamenteE==33) {
				
				$obtenerAcCa=$objeto->getObtenerInformacionGeneral("SELECT c.idActividades,REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(c.nombreActividades, 'Ã¡', 'á'),'Ã©','é'),'Ã­','í'),'Ã³','ó'),'Ãº','ú'),'Ã‰','É'),'ÃŒ','Í'),'Ã“','Ó'),'Ãš','Ú'),'Ã±','ñ'),'Ã‘','Ñ'),'&#039;',' ` '),'Ã','Á'),'',' '),'Ã','Á'),'SI','SI'),'â€œ',''),'â€',''),'Á²','ó') ,a.idOrganismo FROM poa_programacion_financiera AS a INNER JOIN poa_item AS b ON a.idItem=b.idItem INNER JOIN poa_actividades AS c ON c.idActividades=a.idActividad WHERE a.idOrganismo='$idOrganismo' AND a.idActividad='1' GROUP BY a.idActividad ORDER BY a.idActividad ASC;");


			}


			$indicadorInformacion=$objeto->getObtenerInformacionGeneral("SELECT CONCAT_WS(' ',(SELECT CONCAT_WS('.- ',REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(a1.nombreActividades, 'Ã¡', 'á'),'Ã©','é'),'Ã­','í'),'Ã³','ó'),'Ãº','ú'),'Ã‰','É'),'ÃŒ','Í'),'Ã“','Ó'),'Ãš','Ú'),'Ã±','ñ'),'Ã‘','Ñ'),'&#039;',' ` '),'Ã','Á'),'',' '),'Ã','Á'),'SI','SI'),'â€œ',''),'â€',''),'Á²','ó'),REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(b1.nombreIndicador, 'Ã¡', 'á'),'Ã©','é'),'Ã­','í'),'Ã³','ó'),'Ãº','ú'),'Ã‰','É'),'ÃŒ','Í'),'Ã“','Ó'),'Ãš','Ú'),'Ã±','ñ'),'Ã‘','Ñ'),'&#039;',' ` '),'Ã','Á'),'',' '),'Ã','Á'),'SI','SI'),'â€œ',''),'â€',''),'Á²','ó')) FROM poa_actividades AS a1 INNER JOIN poa_indicadores AS b1 ON a1.idLineaPolitica=b1.idIndicadores WHERE a1.idActividades=b.idActividad LIMIT 1)) AS indicador,(SELECT a1.primertrimestre FROM poa_poainicial AS a1 WHERE a1.idActividad=b.idActividad ORDER BY a1.idPoaEnviado DESC LIMIT 1) AS primertrimestre,(SELECT a1.segundotrimestre FROM poa_poainicial AS a1 WHERE a1.idActividad=b.idActividad ORDER BY a1.idPoaEnviado DESC LIMIT 1) AS segundotrimestre,(SELECT a1.tercertrimestre FROM poa_poainicial AS a1 WHERE a1.idActividad=b.idActividad ORDER BY a1.idPoaEnviado DESC LIMIT 1) AS tercertrimestre,(SELECT a1.cuartotrimestre FROM poa_poainicial AS a1 WHERE a1.idActividad=b.idActividad ORDER BY a1.idPoaEnviado DESC LIMIT 1) AS cuartotrimestre,(SELECT a1.metaindicador FROM poa_poainicial AS a1 WHERE a1.idActividad=b.idActividad ORDER BY a1.idPoaEnviado DESC LIMIT 1) AS metaindicador,(SELECT a1.idActividad FROM poa_poainicial AS a1 WHERE a1.idActividad=b.idActividad ORDER BY a1.idPoaEnviado DESC LIMIT 1) AS idActividad  FROM poa_programacion_financiera AS b WHERE b.idOrganismo='$idOrganismo' GROUP BY b.idActividad;");


			$jason['indicadorInformacion']=$indicadorInformacion;


			$jason['obtenerInformacion']=$obtenerInformacion;
			$jason['obtenerAcCa']=$obtenerAcCa;

			$jason['obtenerInformacionPre']=$obtenerInformacionPre;

			$jason['obtenerInformacionObservaciones']=$obtenerInformacionObservaciones;

		break;	


		case  "informacioSubsessCoordina":

			$obtenerInformacion=$objeto->getObtenerInformacionGeneral("SELECT c.idActividades,c.nombreActividades,b.nombreItem,a.enero,a.febrero,a.marzo,a.abril,a.mayo,a.junio, a.julio,a.agosto,a.septiembre,a.octubre,a.noviembre,a.diciembre,a.totalSumaItem,b.itemPreesupuestario AS subsecretaria FROM poa_programacion_financiera AS a INNER JOIN poa_item AS b ON a.idItem=b.idItem INNER JOIN poa_actividades AS c ON c.idActividades=a.idActividad WHERE a.idOrganismo='$idOrganismo' ORDER BY a.idActividad ASC;");

			$obtenerInformacionPre=$objeto->getObtenerInformacionGeneral("SELECT a1.subsecretaria FROM poa_preliminar_envio AS a1 WHERE a1.idOrganismo='$idOrganismo' ORDER BY a1.idPoaInicial DESC LIMIT 1;");


			$obtenerInformacionPeriodos=$objeto->getObtenerInformacionGeneral("SELECT periodo FROM poa_organismo WHERE idOrganismo='$idOrganismo';");

			$obtenerInformacionObservaciones=$objeto->getObtenerInformacionGeneral("SELECT REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(a.observaciones, 'Ã¡', 'á'),'Ã©','é'),'Ã­','í'),'Ã³','ó'),'Ãº','ú'),'Ã‰','É'),'ÃŒ','Í'),'Ã“','Ó'),'Ãš','Ú'),'Ã±','ñ'),'Ã‘','Ñ'),'&#039;',' ` '),'Ã','Á'),'',' '),'Ã','Á'),'SI','SI'),'â€œ',''),'â€',''),'Á²','ó') AS observaciones,CONCAT_WS(' ',REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(b.nombre, 'Ã¡', 'á'),'Ã©','é'),'Ã­','í'),'Ã³','ó'),'Ãº','ú'),'Ã‰','É'),'ÃŒ','Í'),'Ã“','Ó'),'Ãš','Ú'),'Ã±','ñ'),'Ã‘','Ñ'),'&#039;',' ` '),'Ã','Á'),'',' '),'Ã','Á'),'SI','SI'),'â€œ',''),'â€',''),'Á²','ó'),REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(b.apellido, 'Ã¡', 'á'),'Ã©','é'),'Ã­','í'),'Ã³','ó'),'Ãº','ú'),'Ã‰','É'),'ÃŒ','Í'),'Ã“','Ó'),'Ãš','Ú'),'Ã±','ñ'),'Ã‘','Ñ'),'&#039;',' ` '),'Ã','Á'),'',' '),'Ã','Á'),'SI','SI'),'â€œ',''),'â€',''),'Á²','ó')) AS nombreCompleto FROM poa_observacionesenviadas AS a INNER JOIN th_usuario AS b ON a.idUsuario=b.id_usuario WHERE a.idOrganismo='$idOrganismo' AND YEAR(a.fecha)='".$obtenerInformacionPeriodos[0][periodo]."';");

			if ($fisicamenteE==27 || $fisicamenteE==28 || $fisicamenteE==29 || $fisicamenteE==30 || $fisicamenteE==31 || $fisicamenteE==32 || $fisicamenteE==33) {
				
				$obtenerAcCa=$objeto->getObtenerInformacionGeneral("SELECT c.idActividades,REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(c.nombreActividades, 'Ã¡', 'á'),'Ã©','é'),'Ã­','í'),'Ã³','ó'),'Ãº','ú'),'Ã‰','É'),'ÃŒ','Í'),'Ã“','Ó'),'Ãš','Ú'),'Ã±','ñ'),'Ã‘','Ñ'),'&#039;',' ` '),'Ã','Á'),'',' '),'Ã','Á'),'SI','SI'),'â€œ',''),'â€',''),'Á²','ó') AS nombreActividades,a.idOrganismo FROM poa_programacion_financiera AS a INNER JOIN poa_item AS b ON a.idItem=b.idItem INNER JOIN poa_actividades AS c ON c.idActividades=a.idActividad WHERE a.idOrganismo='$idOrganismo' AND (a.idActividad='3' OR a.idActividad='4' OR a.idActividad='5' OR a.idActividad='6' OR a.idActividad='7') GROUP BY a.idActividad ORDER BY a.idActividad ASC;");


			}

			$indicadorInformacion=$objeto->getObtenerInformacionGeneral("SELECT CONCAT_WS(' ',(SELECT CONCAT_WS('.- ',REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(a1.nombreActividades, 'Ã¡', 'á'),'Ã©','é'),'Ã­','í'),'Ã³','ó'),'Ãº','ú'),'Ã‰','É'),'ÃŒ','Í'),'Ã“','Ó'),'Ãš','Ú'),'Ã±','ñ'),'Ã‘','Ñ'),'&#039;',' ` '),'Ã','Á'),'',' '),'Ã','Á'),'SI','SI'),'â€œ',''),'â€',''),'Á²','ó'),REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(b1.nombreIndicador, 'Ã¡', 'á'),'Ã©','é'),'Ã­','í'),'Ã³','ó'),'Ãº','ú'),'Ã‰','É'),'ÃŒ','Í'),'Ã“','Ó'),'Ãš','Ú'),'Ã±','ñ'),'Ã‘','Ñ'),'&#039;',' ` '),'Ã','Á'),'',' '),'Ã','Á'),'SI','SI'),'â€œ',''),'â€',''),'Á²','ó')) FROM poa_actividades AS a1 INNER JOIN poa_indicadores AS b1 ON a1.idLineaPolitica=b1.idIndicadores WHERE a1.idActividades=b.idActividad LIMIT 1)) AS indicador,(SELECT a1.primertrimestre FROM poa_poainicial AS a1 WHERE a1.idOrganismo=b.idOrganismo AND a1.idActividad=b.idActividad ORDER BY a1.idPoaEnviado DESC LIMIT 1) AS primertrimestre,(SELECT a1.segundotrimestre FROM poa_poainicial AS a1 WHERE a1.idOrganismo=b.idOrganismo AND a1.idActividad=b.idActividad ORDER BY a1.idPoaEnviado DESC LIMIT 1) AS segundotrimestre,(SELECT a1.tercertrimestre FROM poa_poainicial AS a1 WHERE a1.idOrganismo=b.idOrganismo AND a1.idActividad=b.idActividad ORDER BY a1.idPoaEnviado DESC LIMIT 1) AS tercertrimestre,(SELECT a1.cuartotrimestre FROM poa_poainicial AS a1 WHERE a1.idActividad=b.idActividad ORDER BY a1.idPoaEnviado DESC LIMIT 1) AS cuartotrimestre,(SELECT a1.metaindicador FROM poa_poainicial AS a1 WHERE a1.idOrganismo=b.idOrganismo AND a1.idActividad=b.idActividad ORDER BY a1.idPoaEnviado DESC LIMIT 1) AS metaindicador,(SELECT a1.idActividad FROM poa_poainicial AS a1 WHERE a1.idOrganismo=b.idOrganismo AND a1.idActividad=b.idActividad ORDER BY a1.idPoaEnviado DESC LIMIT 1) AS idActividad  FROM poa_programacion_financiera AS b WHERE b.idOrganismo='$idOrganismo' GROUP BY b.idActividad;");


			$jason['indicadorInformacion']=$indicadorInformacion;

			$jason['obtenerInformacion']=$obtenerInformacion;
			$jason['obtenerAcCa']=$obtenerAcCa;

			$jason['obtenerInformacionPre']=$obtenerInformacionPre;

			$jason['obtenerInformacionObservaciones']=$obtenerInformacionObservaciones;

		break;	


		case  "informacioSubsess__finan__rechazos":

			$obtenerInformacion=$objeto->getObtenerInformacionGeneral("SELECT c.idActividades,REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(c.nombreActividades, 'Ã¡', 'á'),'Ã©','é'),'Ã­','í'),'Ã³','ó'),'Ãº','ú'),'Ã‰','É'),'ÃŒ','Í'),'Ã“','Ó'),'Ãš','Ú'),'Ã±','ñ'),'Ã‘','Ñ'),'&#039;',' ` '),'Ã','Á'),'',' '),'Ã','Á'),'SI','SI'),'â€œ',''),'â€',''),'Á²','ó') AS nombreActividades,REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(b.nombreItem, 'Ã¡', 'á'),'Ã©','é'),'Ã­','í'),'Ã³','ó'),'Ãº','ú'),'Ã‰','É'),'ÃŒ','Í'),'Ã“','Ó'),'Ãš','Ú'),'Ã±','ñ'),'Ã‘','Ñ'),'&#039;',' ` '),'Ã','Á'),'',' '),'Ã','Á'),'SI','SI'),'â€œ',''),'â€',''),'Á²','ó') AS nombreItem,a.enero,a.febrero,a.marzo,a.abril,a.mayo,a.junio, a.julio,a.agosto,a.septiembre,a.octubre,a.noviembre,a.diciembre,a.totalSumaItem,b.itemPreesupuestario AS subsecretaria,b.itemPreesupuestario FROM poa_programacion_financiera AS a INNER JOIN poa_item AS b ON a.idItem=b.idItem INNER JOIN poa_actividades AS c ON c.idActividades=a.idActividad WHERE a.idOrganismo='$idOrganismo' ORDER BY a.idActividad ASC;");

			$obtenerInformacion__docus=$objeto->getObtenerInformacionGeneral("SELECT idFinancieroD,polizaOriginal,caucionOrginal,copiaCertificadoBancario,copiaRegistroD,copia_adminFinanciero,copia_adminGeneral,copia__registroIn,copia_acuerdoRegistro,copia_ruc FROM poa_financiero_documentos WHERE idOrganismo='$idOrganismo' ORDER BY idFinancieroD DESC LIMIT 1;");

			$idFinancieroD=$obtenerInformacion__docus[0][idFinancieroD];

			$obtenerInformacion__docus__observas=$objeto->getObtenerInformacionGeneral("SELECT idDocumentos,polizaOriginal,caucionOrginal,copiaCertificadoBancario,copiaRegistroD,copia_adminFinanciero,copia_adminGeneral,copia__registroIn,copia_acuerdoRegistro,copia_ruc,observa__polizaOriginal,observa__caucionOrginal,observa__copiaCertificadoBancario,observa__copiaRegistroD,observa__copia_adminFinanciero,observa__copia_adminGeneral,observa__copia__registroIn,observa__copia_acuerdoRegistro,observa__copia_ruc FROM poa_documentos_calificados WHERE idOrganismo='$idOrganismo' AND idFinancieroD='$idFinancieroD';");

			$jason['obtenerInformacion']=$obtenerInformacion;
			$jason['obtenerInformacion__docus']=$obtenerInformacion__docus;
			$jason['obtenerInformacion__docus__observas']=$obtenerInformacion__docus__observas;

		break;	


		case  "informacioSubsess__finan":

			$obtenerInformacion=$objeto->getObtenerInformacionGeneral("SELECT c.idActividades,REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(c.nombreActividades, 'Ã¡', 'á'),'Ã©','é'),'Ã­','í'),'Ã³','ó'),'Ãº','ú'),'Ã‰','É'),'ÃŒ','Í'),'Ã“','Ó'),'Ãš','Ú'),'Ã±','ñ'),'Ã‘','Ñ'),'&#039;',' ` '),'Ã','Á'),'',' '),'Ã','Á'),'SI','SI'),'â€œ',''),'â€',''),'Á²','ó') AS nombreActividades,REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(b.nombreItem, 'Ã¡', 'á'),'Ã©','é'),'Ã­','í'),'Ã³','ó'),'Ãº','ú'),'Ã‰','É'),'ÃŒ','Í'),'Ã“','Ó'),'Ãš','Ú'),'Ã±','ñ'),'Ã‘','Ñ'),'&#039;',' ` '),'Ã','Á'),'',' '),'Ã','Á'),'SI','SI'),'â€œ',''),'â€',''),'Á²','ó') AS nombreItem,a.enero,a.febrero,a.marzo,a.abril,a.mayo,a.junio, a.julio,a.agosto,a.septiembre,a.octubre,a.noviembre,a.diciembre,a.totalSumaItem,b.itemPreesupuestario AS subsecretaria,b.itemPreesupuestario FROM poa_programacion_financiera AS a INNER JOIN poa_item AS b ON a.idItem=b.idItem INNER JOIN poa_actividades AS c ON c.idActividades=a.idActividad WHERE a.idOrganismo='$idOrganismo' ORDER BY a.idActividad ASC;");

			$obtenerInformacion__docus=$objeto->getObtenerInformacionGeneral("SELECT polizaOriginal,caucionOrginal,copiaCertificadoBancario,copiaRegistroD,copia_adminFinanciero,copia_adminGeneral,copia__registroIn,copia_acuerdoRegistro,copia_ruc FROM poa_financiero_documentos WHERE idOrganismo='$idOrganismo' ORDER BY idFinancieroD DESC LIMIT 1;");

			$obtenerInformacion__docus__negados=$objeto->getObtenerInformacionGeneral("SELECT polizaOriginal,caucionOrginal,copiaCertificadoBancario,copiaRegistroD,copia_adminFinanciero,copia_adminGeneral,copia__registroIn,copia_acuerdoRegistro,copia_ruc,observa__polizaOriginal,observa__caucionOrginal,observa__copiaCertificadoBancario,observa__copiaRegistroD,observa__copia_adminFinanciero,observa__copia_adminGeneral,observa__copia__registroIn,observa__copia_acuerdoRegistro,observa__copia_ruc FROM poa_documentos_calificados WHERE idOrganismo='$idOrganismo';");


			if(empty($obtenerInformacion__docus__negados[0][polizaOriginal])){

				$obtenerInformacion__docus__negados="no";

			}


			$jason['obtenerInformacion']=$obtenerInformacion;
			$jason['obtenerInformacion__docus']=$obtenerInformacion__docus;
			$jason['obtenerInformacion__docus__negados']=$obtenerInformacion__docus__negados;

		break;	



		case  "informacioSubsess":

			$obtenerInformacion=$objeto->getObtenerInformacionGeneral("SELECT c.idActividades,REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(c.nombreActividades, 'Ã¡', 'á'),'Ã©','é'),'Ã­','í'),'Ã³','ó'),'Ãº','ú'),'Ã‰','É'),'ÃŒ','Í'),'Ã“','Ó'),'Ãš','Ú'),'Ã±','ñ'),'Ã‘','Ñ'),'&#039;',' ` '),'Ã','Á'),'',' '),'Ã','Á'),'SI','SI'),'â€œ',''),'â€',''),'Á²','ó') AS nombreActividades,REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(b.nombreItem, 'Ã¡', 'á'),'Ã©','é'),'Ã­','í'),'Ã³','ó'),'Ãº','ú'),'Ã‰','É'),'ÃŒ','Í'),'Ã“','Ó'),'Ãš','Ú'),'Ã±','ñ'),'Ã‘','Ñ'),'&#039;',' ` '),'Ã','Á'),'',' '),'Ã','Á'),'SI','SI'),'â€œ',''),'â€',''),'Á²','ó') AS nombreItem,a.enero,a.febrero,a.marzo,a.abril,a.mayo,a.junio, a.julio,a.agosto,a.septiembre,a.octubre,a.noviembre,a.diciembre,a.totalSumaItem,b.itemPreesupuestario AS subsecretaria,b.itemPreesupuestario FROM poa_programacion_financiera AS a INNER JOIN poa_item AS b ON a.idItem=b.idItem INNER JOIN poa_actividades AS c ON c.idActividades=a.idActividad WHERE a.idOrganismo='$idOrganismo' ORDER BY a.idActividad ASC;");

			$obtenerInformacionPre=$objeto->getObtenerInformacionGeneral("SELECT a1.subsecretaria FROM poa_preliminar_envio AS a1 WHERE a1.idOrganismo='$idOrganismo' ORDER BY a1.idPoaInicial DESC LIMIT 1;");

			$obtenerInformacionPeriodos=$objeto->getObtenerInformacionGeneral("SELECT periodo FROM poa_organismo WHERE idOrganismo='$idOrganismo';");

			$obtenerInformacionObservaciones=$objeto->getObtenerInformacionGeneral("SELECT REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(a.observaciones, 'Ã¡', 'á'),'Ã©','é'),'Ã­','í'),'Ã³','ó'),'Ãº','ú'),'Ã‰','É'),'ÃŒ','Í'),'Ã“','Ó'),'Ãš','Ú'),'Ã±','ñ'),'Ã‘','Ñ'),'&#039;',' ` '),'Ã','Á'),'',' '),'Ã','Á'),'SI','SI'),'â€œ',''),'â€',''),'Á²','ó') AS observaciones,CONCAT_WS(' ',b.nombre,b.apellido) AS nombreCompleto FROM poa_observacionesenviadas AS a INNER JOIN th_usuario AS b ON a.idUsuario=b.id_usuario WHERE a.idOrganismo='$idOrganismo' AND YEAR(a.fecha)='".$obtenerInformacionPeriodos[0][periodo]."';");

			/*====================================
			=             Actividades            =
			====================================*/
			
			$actividad3=$objeto->getObtenerInformacionGeneral("SELECT SUM(totalSumaItem) AS totalActividad3 FROM poa_programacion_financiera WHERE idOrganismo='$idOrganismo' AND idActividad='3' GROUP BY idOrganismo;");

			$actividad4=$objeto->getObtenerInformacionGeneral("SELECT SUM(totalSumaItem) AS totalActividad4 FROM poa_programacion_financiera WHERE idOrganismo='$idOrganismo' AND idActividad='4' GROUP BY idOrganismo;");

			$actividad5=$objeto->getObtenerInformacionGeneral("SELECT SUM(totalSumaItem) AS totalActividad5 FROM poa_programacion_financiera WHERE idOrganismo='$idOrganismo' AND idActividad='5' GROUP BY idOrganismo;");

			$actividad6=$objeto->getObtenerInformacionGeneral("SELECT SUM(totalSumaItem) AS totalActividad6 FROM poa_programacion_financiera WHERE idOrganismo='$idOrganismo' AND idActividad='6' GROUP BY idOrganismo;");

			$actividad7=$objeto->getObtenerInformacionGeneral("SELECT SUM(totalSumaItem) AS totalActividad7 FROM poa_programacion_financiera WHERE idOrganismo='$idOrganismo' AND idActividad='7' GROUP BY idOrganismo;");
			
			/*=====  End of  Actividades  ======*/
			

			if($fisicamenteE==18 || $idRolAd=="1"){

				$obtenerAcCa=$objeto->getObtenerInformacionGeneral("SELECT c.idActividades,REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(c.nombreActividades, 'Ã¡', 'á'),'Ã©','é'),'Ã­','í'),'Ã³','ó'),'Ãº','ú'),'Ã‰','É'),'ÃŒ','Í'),'Ã“','Ó'),'Ãš','Ú'),'Ã±','ñ'),'Ã‘','Ñ'),'&#039;',' ` '),'Ã','Á'),'',' '),'Ã','Á'),'SI','SI'),'â€œ',''),'â€',''),'Á²','ó') AS nombreActividades,a.idOrganismo FROM poa_programacion_financiera AS a INNER JOIN poa_item AS b ON a.idItem=b.idItem INNER JOIN poa_actividades AS c ON c.idActividades=a.idActividad WHERE a.idOrganismo='$idOrganismo' GROUP BY a.idActividad ORDER BY a.idActividad ASC;");


			}else if ($fisicamenteE==26 || $fisicamenteE==24 || $fisicamenteE=="12" || $fisicamenteE=="13" || $fisicamenteE=="14" || $fisicamenteE=="19" || $fisicamenteE=="13" || $fisicamenteE=="13" || $fisicamenteE=="13" || $fisicamenteE=="13" || $fisicamenteE=="13") {
				
				$obtenerAcCa=$objeto->getObtenerInformacionGeneral("SELECT c.idActividades,REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(c.nombreActividades, 'Ã¡', 'á'),'Ã©','é'),'Ã­','í'),'Ã³','ó'),'Ãº','ú'),'Ã‰','É'),'ÃŒ','Í'),'Ã“','Ó'),'Ãš','Ú'),'Ã±','ñ'),'Ã‘','Ñ'),'&#039;',' ` '),'Ã','Á'),'',' '),'Ã','Á'),'SI','SI'),'â€œ',''),'â€',''),'Á²','ó') AS nombreActividades,a.idOrganismo FROM poa_programacion_financiera AS a INNER JOIN poa_item AS b ON a.idItem=b.idItem INNER JOIN poa_actividades AS c ON c.idActividades=a.idActividad WHERE a.idOrganismo='$idOrganismo' AND (a.idActividad='3' OR a.idActividad='4' OR a.idActividad='5' OR a.idActividad='6' OR a.idActividad='7') GROUP BY a.idActividad ORDER BY a.idActividad ASC;");


			}else if($fisicamenteE==1 || $fisicamenteE==6 || $fisicamenteE==15 || $fisicamenteE==27 || $fisicamenteE==28 || $fisicamenteE==29 || $fisicamenteE==30 || $fisicamenteE==31 || $fisicamenteE==32 || $fisicamenteE==33){

				$obtenerAcCa=$objeto->getObtenerInformacionGeneral("SELECT c.idActividades,REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(c.nombreActividades, 'Ã¡', 'á'),'Ã©','é'),'Ã­','í'),'Ã³','ó'),'Ãº','ú'),'Ã‰','É'),'ÃŒ','Í'),'Ã“','Ó'),'Ãš','Ú'),'Ã±','ñ'),'Ã‘','Ñ'),'&#039;',' ` '),'Ã','Á'),'',' '),'Ã','Á'),'SI','SI'),'â€œ',''),'â€',''),'Á²','ó') AS nombreActividades,a.idOrganismo FROM poa_programacion_financiera AS a INNER JOIN poa_item AS b ON a.idItem=b.idItem INNER JOIN poa_actividades AS c ON c.idActividades=a.idActividad WHERE a.idOrganismo='$idOrganismo' AND (a.idActividad='2') GROUP BY a.idActividad ORDER BY a.idActividad ASC;");

			}else if($fisicamenteE==2 || $fisicamenteE==23 || $fisicamenteE==5 || $fisicamenteE==7){

				$obtenerAcCa=$objeto->getObtenerInformacionGeneral("SELECT c.idActividades,REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(c.nombreActividades, 'Ã¡', 'á'),'Ã©','é'),'Ã­','í'),'Ã³','ó'),'Ãº','ú'),'Ã‰','É'),'ÃŒ','Í'),'Ã“','Ó'),'Ãš','Ú'),'Ã±','ñ'),'Ã‘','Ñ'),'&#039;',' ` '),'Ã','Á'),'',' '),'Ã','Á'),'SI','SI'),'â€œ',''),'â€',''),'Á²','ó') AS nombreActividades,a.idOrganismo FROM poa_programacion_financiera AS a INNER JOIN poa_item AS b ON a.idItem=b.idItem INNER JOIN poa_actividades AS c ON c.idActividades=a.idActividad WHERE a.idOrganismo='$idOrganismo' AND (a.idActividad='1') GROUP BY a.idActividad ORDER BY a.idActividad ASC;");

			}

			$indicadorInformacion=$objeto->getObtenerInformacionGeneral("SELECT CONCAT_WS(' ',(SELECT CONCAT_WS('.- ',REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(a1.nombreActividades, 'Ã¡', 'á'),'Ã©','é'),'Ã­','í'),'Ã³','ó'),'Ãº','ú'),'Ã‰','É'),'ÃŒ','Í'),'Ã“','Ó'),'Ãš','Ú'),'Ã±','ñ'),'Ã‘','Ñ'),'&#039;',' ` '),'Ã','Á'),'',' '),'Ã','Á'),'SI','SI'),'â€œ',''),'â€',''),'Á²','ó'),REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(b1.nombreIndicador, 'Ã¡', 'á'),'Ã©','é'),'Ã­','í'),'Ã³','ó'),'Ãº','ú'),'Ã‰','É'),'ÃŒ','Í'),'Ã“','Ó'),'Ãš','Ú'),'Ã±','ñ'),'Ã‘','Ñ'),'&#039;',' ` '),'Ã','Á'),'',' '),'Ã','Á'),'SI','SI'),'â€œ',''),'â€',''),'Á²','ó')) FROM poa_actividades AS a1 INNER JOIN poa_indicadores AS b1 ON a1.idLineaPolitica=b1.idIndicadores WHERE a1.idActividades=b.idActividad LIMIT 1)) AS indicador,(SELECT a1.primertrimestre FROM poa_poainicial AS a1 WHERE a1.idActividad=b.idActividad ORDER BY a1.idPoaEnviado DESC LIMIT 1) AS primertrimestre,(SELECT a1.segundotrimestre FROM poa_poainicial AS a1 WHERE a1.idActividad=b.idActividad ORDER BY a1.idPoaEnviado DESC LIMIT 1) AS segundotrimestre,(SELECT a1.tercertrimestre FROM poa_poainicial AS a1 WHERE a1.idActividad=b.idActividad ORDER BY a1.idPoaEnviado DESC LIMIT 1) AS tercertrimestre,(SELECT a1.cuartotrimestre FROM poa_poainicial AS a1 WHERE a1.idActividad=b.idActividad ORDER BY a1.idPoaEnviado DESC LIMIT 1) AS cuartotrimestre,(SELECT a1.metaindicador FROM poa_poainicial AS a1 WHERE a1.idActividad=b.idActividad ORDER BY a1.idPoaEnviado DESC LIMIT 1) AS metaindicador,(SELECT a1.idActividad FROM poa_poainicial AS a1 WHERE a1.idActividad=b.idActividad ORDER BY a1.idPoaEnviado DESC LIMIT 1) AS idActividad  FROM poa_programacion_financiera AS b WHERE b.idOrganismo='$idOrganismo' GROUP BY b.idActividad;");


			$jason['indicadorInformacion']=$indicadorInformacion;
			
			$jason['obtenerInformacion']=$obtenerInformacion;
			$jason['obtenerAcCa']=$obtenerAcCa;

			$jason['obtenerInformacionPre']=$obtenerInformacionPre;

			$jason['obtenerInformacionObservaciones']=$obtenerInformacionObservaciones;

			/*===================================
			=            Actividades            =
			===================================*/
			
			$jason['actividad3']=$actividad3;
			$jason['actividad4']=$actividad4;
			$jason['actividad5']=$actividad5;
			$jason['actividad6']=$actividad6;
			$jason['actividad7']=$actividad7;
			
			/*=====  End of Actividades  ======*/
			

		break;	


		case  "honorarios":

			$obtenerInformacion=$objeto->getObtenerInformacionGeneral("SELECT idHonorarios,cedula,nombres,cargo,honorarioMensual,enero,febrero,marzo,abril,mayo,junio,julio,agosto,septiembre,octubre,noviembre,diciembre,total,honorarioMensual,tipoCargo FROM poa_honorarios2022 WHERE idOrganismo='$idOrganismo' AND idActividad='$idActividad' ORDER BY idHonorarios;");

			$jason['obtenerInformacion']=$obtenerInformacion;
			$jason['idActividad']=$idActividad;

		break;	

		case  "sueldosSalarios":

			$arrayInformacionE=array();
			$arrayInformacionA=array();

			$obtenerInformacion=$objeto->getObtenerInformacionGeneral("SELECT idSueldos,cedula,REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(nombres, 'Ã¡', 'á'),'Ã©','é'),'Ã­','í'),'Ã³','ó'),'Ãº','ú'),'Ã‰','É'),'ÃŒ','Í'),'Ã“','Ó'),'Ãš','Ú'),'Ã±','ñ'),'Ã‘','Ñ'),'&#039;',' ` '),'Ã','Á'),'',' '),'Ã','Á'),'SI','SI'),'â€œ',''),'â€',''),'Á²','ó') AS nombres,cargo,tipoCargo,tiempoTrabajo,sueldoSalario,aportePatronal,decimoTercera,mensualizaTercera,decimoCuarta,menusalizaCuarta,fondosReserva,enero,febrero,marzo,abril,mayo,junio,julio,agosto,septiembre,octubre,noviembre,diciembre,total FROM poa_sueldossalarios2022 WHERE idOrganismo='$idOrganismo' AND idActividad='$idActividad' ORDER BY idSueldos;");


			$regimen=$objeto->getObtenerInformacionGeneral("SELECT regimen FROM poa_organismo WHERE idOrganismo='$idOrganismo';");

			$jason['regimen']=$regimen;

			$jason['obtenerInformacion']=$obtenerInformacion;
			$jason['idActividad']=$idActividad;

		break;	

		case  "suminitrosAEe":

			$arrayInformacionE=array();
			$arrayInformacionA=array();

			$obtenerInformacion=$objeto->getObtenerInformacionGeneral("SELECT a.idSumi,a.tipo,a.nombreEscenario,GROUP_CONCAT(b.luz SEPARATOR '---') AS energia,GROUP_CONCAT(b.agua SEPARATOR '---') AS agua FROM poa_suministrosn AS a INNER JOIN poa_suministros AS b ON a.idSumi=b.idSumiN WHERE a.idOrganismo='$idOrganismo' GROUP BY a.idSumi;");


			$regimen=$objeto->getObtenerInformacionGeneral("SELECT regimen FROM poa_organismo WHERE idOrganismo='$idOrganismo';");

			$jason['regimen']=$regimen;


			$jason['obtenerInformacion']=$obtenerInformacion;
			$jason['idActividad']=$idActividad;

		break;	


		case  "actividadesDepor":

			$arrayInformacion=array();
			$arrayMatrizDC = json_decode($arrayMatrizD);

			for ($i=0; $i < count($arrayMatrizDC); $i++) { 
	
				$obtenerInformacion=$objeto->getObtenerInformacionGeneral("SELECT a.idProgramacionFinanciera,c.Deporte,b.idItem,b.itemPreesupuestario,b.nombreItem, GROUP_CONCAT(c.provincia SEPARATOR '---') AS provinciaId, GROUP_CONCAT(c.ciudadPais SEPARATOR '---') AS ciudadPaisId,GROUP_CONCAT(c.alcance SEPARATOR '---') AS alcanceId,GROUP_CONCAT(c.Deporte SEPARATOR '---') AS Deporte,GROUP_CONCAT(c.idPda SEPARATOR '---') AS idPda, GROUP_CONCAT(c.tipoFinanciamiento SEPARATOR '---') AS tipoFinanciamiento,GROUP_CONCAT(c.nombreEvento SEPARATOR '---') AS nombreEvento, GROUP_CONCAT((SELECT a1.nombreDeporte FROM poa_deporte AS a1 WHERE a1.idDeporte=c.Deporte) SEPARATOR '---') AS deporte,GROUP_CONCAT((SELECT a1.nombreProvincia FROM in_md_provincias AS a1 WHERE a1.idProvincia=c.provincia)  SEPARATOR '---') AS provincia, GROUP_CONCAT((SELECT paisnombre FROM poa_pais AS a1 WHERE a1.id=c.ciudadPais)  SEPARATOR '---') AS ciudadPais,GROUP_CONCAT((SELECT nombreAlcanse FROM poa_alcanse AS a1 WHERE a1.idAlcanse=c.alcance) SEPARATOR '---') AS alcanceFuncion, GROUP_CONCAT(c.fechaInicio SEPARATOR '---') AS fechaInicio,GROUP_CONCAT(c.fechaFin SEPARATOR '---') AS fechaFin, GROUP_CONCAT(c.genero SEPARATOR '---') AS genero, GROUP_CONCAT(c.categoria SEPARATOR '---') AS categoria, GROUP_CONCAT(c.numeroEntreandores SEPARATOR '---') AS numeroEntreandores,GROUP_CONCAT(c.numeroAtletas SEPARATOR '---') AS numeroAtletas, GROUP_CONCAT(c.total SEPARATOR '---') AS total,GROUP_CONCAT(c.mBenefici SEPARATOR '---') AS mBenefici,GROUP_CONCAT(c.hBenefici SEPARATOR '---') AS hBenefici, GROUP_CONCAT(c.justificacionAd SEPARATOR '---') AS justificacionAd,GROUP_CONCAT(c.canitdarBie SEPARATOR '---') AS canitdarBie, GROUP_CONCAT(c.enero SEPARATOR '---') AS enero, GROUP_CONCAT(c.febrero SEPARATOR '---') AS febrero, GROUP_CONCAT(c.marzo SEPARATOR '---') AS marzo, GROUP_CONCAT(c.abril SEPARATOR '---') AS abril, GROUP_CONCAT(c.mayo SEPARATOR '---') AS mayo, GROUP_CONCAT(c.junio SEPARATOR '---') AS junio,GROUP_CONCAT(c.julio SEPARATOR '---') AS julio,GROUP_CONCAT(c.agosto SEPARATOR '---') AS agosto, GROUP_CONCAT(c.septiembre SEPARATOR '---') AS septiembre,GROUP_CONCAT(c.octubre SEPARATOR '---') AS octubre, GROUP_CONCAT(c.noviembre SEPARATOR '---') AS noviembre,GROUP_CONCAT(c.diciembre SEPARATOR '---') AS diciembre, GROUP_CONCAT(c.totalElem SEPARATOR '---') AS totalElem, GROUP_CONCAT(c.idProgramacionFinanciera SEPARATOR '---') AS idProgramacionFinanciera2, GROUP_CONCAT(c.detalleBien SEPARATOR '---') AS detalleBien FROM poa_programacion_financiera AS a INNER JOIN poa_item AS b ON b.idItem=a.idItem LEFT JOIN poa_actdeportivas AS c ON c.idProgramacionFinanciera=a.idProgramacionFinanciera WHERE a.idActividad='$idActividad' AND a.idOrganismo='$idOrganismo' AND a.idItem='$arrayMatrizDC[$i]' GROUP BY b.itemPreesupuestario,b.nombreItem;");

				array_push($arrayInformacion,$obtenerInformacion);

			}

			$regimen=$objeto->getObtenerInformacionGeneral("SELECT regimen FROM poa_organismo WHERE idOrganismo='$idOrganismo';");

			$jason['regimen']=$regimen;

			$jason['arrayInformacion']=$arrayInformacion;
			$jason['idActividad']=$idActividad;
			$jason['idItem']=$idItem;

		break;	



		case  "matricez":

			$arrayInformacion=array();
			$arrayMatrizDC = json_decode($arrayMatrizD);

			for ($i=0; $i < count($arrayMatrizDC); $i++) { 
	
				$obtenerInformacion=$objeto->getObtenerInformacionGeneral("SELECT a.idProgramacionFinanciera,b.idItem,b.itemPreesupuestario,b.nombreItem,a.enero,a.febrero,a.marzo,a.abril,a.mayo,a.junio,a.julio,a.agosto,a.septiembre,a.octubre,a.noviembre,a.diciembre,a.totalSumaItem,(SELECT REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(a1.justificacionActividad, 'Ã¡', 'á'),'Ã©','é'),'Ã­','í'),'Ã³','ó'),'Ãº','ú'),'Ã‰','É'),'ÃŒ','Í'),'Ã“','Ó'),'Ãš','Ú'),'Ã±','ñ'),'Ã‘','Ñ'),'&#039;',' ` '),'Ã','Á'),'',' '),'Ã','Á'),'SI','SI'),'â€œ',''),'â€',''),'Á²','ó')  FROM poa_actividadesadministrativas AS a1 WHERE a1.idProgramacionFinanciera=a.idProgramacionFinanciera ORDER BY a1.idActividadAd DESC LIMIT 1) AS justificacionBien,(SELECT a1.cantidadBien FROM poa_actividadesadministrativas AS a1 WHERE a1.idProgramacionFinanciera=a.idProgramacionFinanciera ORDER BY a1.idActividadAd DESC LIMIT 1) AS cantidadBien,(SELECT a1.tipoFinanciamiento FROM poa_actdeportivas AS a1 WHERE a1.idProgramacionFinanciera=a.idProgramacionFinanciera ORDER BY idPda DESC LIMIT 1) AS tipoFinanciamiento,(SELECT a1.nombreEvento FROM poa_actdeportivas AS a1 WHERE a1.idProgramacionFinanciera=a.idProgramacionFinanciera ORDER BY idPda DESC LIMIT 1) AS nombreEvento,(SELECT a1.Deporte FROM poa_actdeportivas AS a1 WHERE a1.idProgramacionFinanciera=a.idProgramacionFinanciera ORDER BY idPda DESC LIMIT 1) AS deporte, (SELECT a1.provincia FROM poa_actdeportivas AS a1 WHERE a1.idProgramacionFinanciera=a.idProgramacionFinanciera ORDER BY idPda DESC LIMIT 1) AS provincia, (SELECT a1.ciudadPais FROM poa_actdeportivas AS a1 WHERE a1.idProgramacionFinanciera=a.idProgramacionFinanciera ORDER BY idPda DESC LIMIT 1) AS pais, (SELECT a1.alcance FROM poa_actdeportivas AS a1 WHERE a1.idProgramacionFinanciera=a.idProgramacionFinanciera ORDER BY idPda DESC LIMIT 1) AS alcanse, (SELECT a1.fechaInicio FROM poa_actdeportivas AS a1 WHERE a1.idProgramacionFinanciera=a.idProgramacionFinanciera ORDER BY idPda DESC LIMIT 1) AS fechaInicio, (SELECT a1.fechaFin FROM poa_actdeportivas AS a1 WHERE a1.idProgramacionFinanciera=a.idProgramacionFinanciera ORDER BY idPda DESC LIMIT 1) AS fechaFin, (SELECT a1.genero FROM poa_actdeportivas AS a1 WHERE a1.idProgramacionFinanciera=a.idProgramacionFinanciera ORDER BY idPda DESC LIMIT 1) AS genero, (SELECT a1.categoria FROM poa_actdeportivas AS a1 WHERE a1.idProgramacionFinanciera=a.idProgramacionFinanciera ORDER BY idPda DESC LIMIT 1) AS categoria, (SELECT a1.numeroEntreandores FROM poa_actdeportivas AS a1 WHERE a1.idProgramacionFinanciera=a.idProgramacionFinanciera ORDER BY idPda DESC LIMIT 1) AS numeroEntrenadores, (SELECT a1.numeroAtletas FROM poa_actdeportivas AS a1 WHERE a1.idProgramacionFinanciera=a.idProgramacionFinanciera ORDER BY idPda DESC LIMIT 1) AS numeroAtletas, (SELECT a1.total FROM poa_actdeportivas AS a1 WHERE a1.idProgramacionFinanciera=a.idProgramacionFinanciera ORDER BY idPda DESC LIMIT 1) AS total, (SELECT a1.mBenefici FROM poa_actdeportivas AS a1 WHERE a1.idProgramacionFinanciera=a.idProgramacionFinanciera ORDER BY idPda DESC LIMIT 1) AS mBenefi, (SELECT a1.hBenefici FROM poa_actdeportivas AS a1 WHERE a1.idProgramacionFinanciera=a.idProgramacionFinanciera ORDER BY idPda DESC LIMIT 1) AS hBenefi, (SELECT a1.justificacionAd FROM poa_actdeportivas AS a1 WHERE a1.idProgramacionFinanciera=a.idProgramacionFinanciera ORDER BY idPda DESC LIMIT 1) AS justificacionAd, (SELECT a1.canitdarBie FROM poa_actdeportivas AS a1 WHERE a1.idProgramacionFinanciera=a.idProgramacionFinanciera ORDER BY idPda DESC LIMIT 1) AS cantidadBie,(SELECT REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(a1.nombreInfras, 'Ã¡', 'á'),'Ã©','é'),'Ã­','í'),'Ã³','ó'),'Ãº','ú'),'Ã‰','É'),'ÃŒ','Í'),'Ã“','Ó'),'Ãš','Ú'),'Ã±','ñ'),'Ã‘','Ñ'),'&#039;',' ` '),'Ã','Á'),'',' '),'Ã','Á'),'SI','SI'),'â€œ',''),'â€',''),'Á²','ó') FROM poa_mantenimiento AS a1 WHERE a1.idProgramacionFinanciera=a.idProgramacionFinanciera ORDER BY a1.idMantenimiento DESC LIMIT 1) AS nombresInfras,(SELECT a1.provincia FROM poa_mantenimiento AS a1 WHERE a1.idProgramacionFinanciera=a.idProgramacionFinanciera ORDER BY a1.idMantenimiento DESC LIMIT 1) AS provinciaMantenimiento, (SELECT REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(a1.direccionCompleta, 'Ã¡', 'á'),'Ã©','é'),'Ã­','í'),'Ã³','ó'),'Ãº','ú'),'Ã‰','É'),'ÃŒ','Í'),'Ã“','Ó'),'Ãš','Ú'),'Ã±','ñ'),'Ã‘','Ñ'),'&#039;',' ` '),'Ã','Á'),'',' '),'Ã','Á'),'SI','SI'),'â€œ',''),'â€',''),'Á²','ó') FROM poa_mantenimiento AS a1 WHERE a1.idProgramacionFinanciera=a.idProgramacionFinanciera ORDER BY a1.idMantenimiento DESC LIMIT 1) AS direccionCompleta, (SELECT a1.estado FROM poa_mantenimiento AS a1 WHERE a1.idProgramacionFinanciera=a.idProgramacionFinanciera ORDER BY a1.idMantenimiento DESC LIMIT 1) AS estado, (SELECT a1.tipoRecursos FROM poa_mantenimiento AS a1 WHERE a1.idProgramacionFinanciera=a.idProgramacionFinanciera ORDER BY a1.idMantenimiento DESC LIMIT 1) AS tipoRecursos, (SELECT a1.tipoIntervencion FROM poa_mantenimiento AS a1 WHERE a1.idProgramacionFinanciera=a.idProgramacionFinanciera ORDER BY a1.idMantenimiento DESC LIMIT 1) AS tipoInvercion, (SELECT a1.detallarTipoIn FROM poa_mantenimiento AS a1 WHERE a1.idProgramacionFinanciera=a.idProgramacionFinanciera ORDER BY a1.idMantenimiento DESC LIMIT 1) AS detallarTipoIn, (SELECT a1.tipoMantenimiento FROM poa_mantenimiento AS a1 WHERE a1.idProgramacionFinanciera=a.idProgramacionFinanciera ORDER BY a1.idMantenimiento DESC LIMIT 1) AS tipoMantenimiento, (SELECT REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(a1.materialesServicios, 'Ã¡', 'á'),'Ã©','é'),'Ã­','í'),'Ã³','ó'),'Ãº','ú'),'Ã‰','É'),'ÃŒ','Í'),'Ã“','Ó'),'Ãš','Ú'),'Ã±','ñ'),'Ã‘','Ñ'),'&#039;',' ` '),'Ã','Á'),'',' '),'Ã','Á'),'SI','SI'),'â€œ',''),'â€',''),'Á²','ó') FROM poa_mantenimiento AS a1 WHERE a1.idProgramacionFinanciera=a.idProgramacionFinanciera ORDER BY a1.idMantenimiento DESC LIMIT 1) AS materialesServicios, (SELECT a1.fechaUltimo FROM poa_mantenimiento AS a1 WHERE a1.idProgramacionFinanciera=a.idProgramacionFinanciera ORDER BY a1.idMantenimiento DESC LIMIT 1) AS fechaUltimo  FROM poa_programacion_financiera AS a INNER JOIN poa_item AS b ON b.idItem=a.idItem WHERE a.idActividad='$idActividad' AND a.idOrganismo='$idOrganismo' AND a.idItem='$arrayMatrizDC[$i]';");

				array_push($arrayInformacion,$obtenerInformacion);

			}

			$regimen=$objeto->getObtenerInformacionGeneral("SELECT regimen FROM poa_organismo WHERE idOrganismo='$idOrganismo';");

			$jason['regimen']=$regimen;

			$jason['arrayInformacion']=$arrayInformacion;
			$jason['idActividad']=$idActividad;
			$jason['idItem']=$idItem;

		break;	



		case  "gruposItems":

			$arrayGrupo51=array();
			$arrayGrupo53=array();
			$arrayGrupo57=array();
			$arrayGrupo58=array();
			$arrayGrupo84=array();
			$arrayAguaLuz=array();
			$arrayGrupoHonorarios=array();


			$obtenerInformacion=$objeto->getObtenerInformacionGeneral("SELECT a.idActividad,a.idItem,b.itemPreesupuestario FROM poa_programacion_financiera AS a INNER JOIN poa_item AS b ON a.idItem=b.idItem WHERE a.idOrganismo='$idOrganismoPrincipal' AND a.idActividad='$idActividades' ORDER BY a.idActividad;");

			foreach ($obtenerInformacion as $clave => $valor) {

				$grupo53=$objeto->getObtenerInformacionGeneral("SELECT a.idItem AS grupo53 FROM poa_item AS a WHERE a.idItem='".$obtenerInformacion[$clave]['idItem']."' AND (a.itemPreesupuestario LIKE '%53%'  AND a.itemPreesupuestario!='530606');");


				foreach ($grupo53 as $claveGrupo53 => $valorGrupo53) {

					array_push($arrayGrupo53,$grupo53[$claveGrupo53]['grupo53']);

				}
				
				$grupo57=$objeto->getObtenerInformacionGeneral("SELECT a.idItem AS grupo57 FROM poa_item AS a WHERE a.idItem='".$obtenerInformacion[$clave]['idItem']."' AND (a.itemPreesupuestario LIKE '%57%');");


				foreach ($grupo57 as $claveGrupo57 => $valorGrupo57) {

					array_push($arrayGrupo57,$grupo57[$claveGrupo57]['grupo57']);

				}

				$grupo58=$objeto->getObtenerInformacionGeneral("SELECT a.idItem AS grupo58 FROM poa_item AS a WHERE a.idItem='".$obtenerInformacion[$clave]['idItem']."' AND (a.itemPreesupuestario LIKE '%58%');");


				foreach ($grupo58 as $claveGrupo58 => $valorGrupo58) {

					array_push($arrayGrupo58,$grupo58[$claveGrupo58]['grupo58']);

				}


				$grupo84=$objeto->getObtenerInformacionGeneral("SELECT a.idItem AS grupo84 FROM poa_item AS a WHERE a.idItem='".$obtenerInformacion[$clave]['idItem']."' AND (a.itemPreesupuestario LIKE '%84%');");


				foreach ($grupo84 as $claveGrupo84 => $valorGrupo84) {

					array_push($arrayGrupo84,$grupo84[$claveGrupo84]['grupo84']);

				}

				$aguaLuz=$objeto->getObtenerInformacionGeneral("SELECT a.idItem AS aguaLuz FROM poa_item AS a WHERE a.idItem='".$obtenerInformacion[$clave]['idItem']."' AND (a.itemPreesupuestario LIKE '%530101%' OR a.itemPreesupuestario LIKE '%530104%');");


				foreach ($aguaLuz as $claveAguaLuz => $valorAguaLuz) {

					array_push($arrayAguaLuz,$aguaLuz[$claveAguaLuz]['aguaLuz']);

				}



			}


			$obtenerInformacion22=$objeto->getObtenerInformacionGeneral("SELECT a.idActividad,a.idItem,b.itemPreesupuestario FROM poa_programacion_financiera AS a INNER JOIN poa_item AS b ON a.idItem=b.idItem WHERE a.idOrganismo='$idOrganismoPrincipal' ORDER BY a.idActividad;");

			foreach ($obtenerInformacion22 as $clave => $valor) {

				$grupoHonorarios=$objeto->getObtenerInformacionGeneral("SELECT a.idItem AS grupoHonorarios FROM poa_item AS a WHERE a.idItem='".$obtenerInformacion22[$clave]['idItem']."' AND (a.itemPreesupuestario LIKE '%530606%');");

				foreach ($grupoHonorarios as $claveGrupoHonorarios => $valorGrupoHonorarios) {

					array_push($arrayGrupoHonorarios,$grupoHonorarios[$claveGrupoHonorarios]['grupoHonorarios']);

				}



				$grupo51=$objeto->getObtenerInformacionGeneral("SELECT a.idItem AS grupo51 FROM poa_item AS a WHERE a.idItem='".$obtenerInformacion22[$clave]['idItem']."' AND (a.itemPreesupuestario LIKE '%51%');");

				foreach ($grupo51 as $claveGrupo51 => $valorGrupo51) {

					array_push($arrayGrupo51,$grupo51[$claveGrupo51]['grupo51']);

				}

			}


			$jason['arrayAguaLuz']=$arrayAguaLuz;

			$jason['obtenerInformacionItems']=$obtenerInformacion;

			$jason['arrayGrupo51']=$arrayGrupo51;
			$jason['arrayGrupo53']=$arrayGrupo53;
			$jason['arrayGrupo57']=$arrayGrupo57;
			$jason['arrayGrupo58']=$arrayGrupo58;
			$jason['arrayGrupo84']=$arrayGrupo84;
			$jason['arrayGrupoHonorarios']=$arrayGrupoHonorarios;

			$jason['idActividades']=$idActividades;

		break;	

		case  "actividadesPoas":

			$informacionSeleccionada=$objeto->getObtenerInformacionGeneral("SELECT a.idActividades,REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(a.nombreActividades, 'Ã¡', 'á'),'Ã©','é'),'Ã­','í'),'Ã³','ó'),'Ãº','ú'),'Ã‰','É'),'ÃŒ','Í'),'Ã“','Ó'),'Ãš','Ú'),'Ã±','ñ'),'Ã‘','Ñ'),'&#039;',' ` '),'Ã','Á'),'',' '),'Ã','Á'),'SI','SI'),'â€œ',''),'â€',''),'Á²','ó') AS nombreActividades,(SELECT REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(a1.nombreIndicador, 'Ã¡', 'á'),'Ã©','é'),'Ã­','í'),'Ã³','ó'),'Ãº','ú'),'Ã‰','É'),'ÃŒ','Í'),'Ã“','Ó'),'Ãš','Ú'),'Ã±','ñ'),'Ã‘','Ñ'),'&#039;',' ` '),'Ã','Á'),'',' '),'Ã','Á'),'SI','SI'),'â€œ',''),'â€',''),'Á²','ó')  FROM poa_indicadores AS a1 WHERE a1.idIndicadores=a.idLineaPolitica) AS indicador FROM poa_actividades AS a ORDER BY a.idActividades ASC;");

			$obtenerInformacion2=$objeto->getObtenerInformacionGeneral("SELECT idActividad FROM poa_poainicial WHERE idOrganismo='$idOrganismoPrincipal' GROUP BY idActividad ORDER BY idActividad ASC;");

			$obtenerInformacion3=$objeto->getObtenerInformacionGeneral("SELECT idActividad FROM poa_programacion_financiera WHERE idOrganismo='$idOrganismoPrincipal' GROUP BY idActividad ORDER BY idActividad ASC;");

	
			$jason['obtenerInformacion3']=$obtenerInformacion3;
			$jason['obtenerInformacion2']=$obtenerInformacion2;
			$jason['informacionSeleccionada']=$informacionSeleccionada;


		break;


		case  "actividadesUso":

			$arrayInformacion = json_decode($arrayInformacion);

			$obtenerInformacion=$objeto->getObtenerInformacionGeneral("SELECT primertrimestre,segundotrimestre,tercertrimestre,cuartotrimestre,metaindicador,idActividad FROM poa_poainicial WHERE idOrganismo='$arrayInformacion[0]' AND idActividad='$arrayInformacion[1]' ORDER BY idPoaEnviado DESC LIMIT 1;");

			$jason['informacionSeleccionada']=$obtenerInformacion;

		break;	

		case  "administrativas":

			
			$obtenerInformacion=$objeto->getObtenerInformacionGeneral("SELECT c.itemPreesupuestario,REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(c.nombreItem, 'Ã¡', 'á'),'Ã©','é'),'Ã­','í'),'Ã³','ó'),'Ãº','ú'),'Ã‰','É'),'ÃŒ','Í'),'Ã“','Ó'),'Ãš','Ú'),'Ã±','ñ'),'Ã‘','Ñ'),'&#039;',' ` '),'Ã','Á'),'',' '),'Ã','Á'),'SI','SI'),'â€œ',''),'â€',''),'Á²','ó') AS nombreItem,(SELECT REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(a1.justificacionActividad, 'Ã¡', 'á'),'Ã©','é'),'Ã­','í'),'Ã³','ó'),'Ãº','ú'),'Ã‰','É'),'ÃŒ','Í'),'Ã“','Ó'),'Ãš','Ú'),'Ã±','ñ'),'Ã‘','Ñ'),'&#039;',' ` '),'Ã','Á'),'',' '),'Ã','Á'),'SI','SI'),'â€œ',''),'â€',''),'Á²','ó') FROM poa_actividadesadministrativas AS a1 WHERE a1.idProgramacionFinanciera=a.idProgramacionFinanciera ORDER BY a1.idActividadAd DESC LIMIT 1) AS justificacionActividad, (SELECT a1.cantidadBien FROM poa_actividadesadministrativas AS a1 WHERE a1.idProgramacionFinanciera=a.idProgramacionFinanciera ORDER BY a1.idActividadAd DESC LIMIT 1) AS cantidadBien,b.enero,b.febrero,b.marzo,b.abril,b.mayo,b.junio,b.julio,b.agosto,b.septiembre,b.noviembre,b.octubre,b.diciembre,b.totalSumaItem FROM poa_actividadesadministrativas AS a INNER JOIN poa_programacion_financiera AS b ON a.idProgramacionFinanciera=b.idProgramacionFinanciera INNER JOIN poa_item AS c ON c.idItem=b.idItem WHERE b.idOrganismo='$idOrganismo' AND b.idActividad='$idActividad' GROUP BY a.idProgramacionFinanciera;");

			$jason['obtenerInformacion']=$obtenerInformacion;

		break;	


		case  "mantenimiento":

			
			$obtenerInformacion=$objeto->getObtenerInformacionGeneral("SELECT c.itemPreesupuestario,REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(c.nombreItem, 'Ã¡', 'á'),'Ã©','é'),'Ã­','í'),'Ã³','ó'),'Ãº','ú'),'Ã‰','É'),'ÃŒ','Í'),'Ã“','Ó'),'Ãš','Ú'),'Ã±','ñ'),'Ã‘','Ñ'),'&#039;',' ` '),'Ã','Á'),'',' '),'Ã','Á'),'SI','SI'),'â€œ',''),'â€',''),'Á²','ó') AS nombreItem,(SELECT REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(a1.nombreInfras, 'Ã¡', 'á'),'Ã©','é'),'Ã­','í'),'Ã³','ó'),'Ãº','ú'),'Ã‰','É'),'ÃŒ','Í'),'Ã“','Ó'),'Ãš','Ú'),'Ã±','ñ'),'Ã‘','Ñ'),'&#039;',' ` '),'Ã','Á'),'',' '),'Ã','Á'),'SI','SI'),'â€œ',''),'â€',''),'Á²','ó') FROM poa_mantenimiento AS a1 WHERE a1.idProgramacionFinanciera=b.idProgramacionFinanciera ORDER BY a1.idMantenimiento DESC LIMIT 1) AS nombreInfras,(SELECT a1.nombreProvincia FROM in_md_provincias AS a1 INNER JOIN poa_mantenimiento AS a2 ON a2.provincia=a1.idProvincia WHERE a2.idProgramacionFinanciera=b.idProgramacionFinanciera LIMIT 1) AS nombreProvincia,(SELECT REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(a1.direccionCompleta, 'Ã¡', 'á'),'Ã©','é'),'Ã­','í'),'Ã³','ó'),'Ãº','ú'),'Ã‰','É'),'ÃŒ','Í'),'Ã“','Ó'),'Ãš','Ú'),'Ã±','ñ'),'Ã‘','Ñ'),'&#039;',' ` '),'Ã','Á'),'',' '),'Ã','Á'),'SI','SI'),'â€œ',''),'â€',''),'Á²','ó')  FROM poa_mantenimiento AS a1 WHERE a1.idProgramacionFinanciera=b.idProgramacionFinanciera ORDER BY a1.idMantenimiento DESC LIMIT 1) AS direccionCompleta,(SELECT a1.estado FROM poa_mantenimiento AS a1 WHERE a1.idProgramacionFinanciera=b.idProgramacionFinanciera ORDER BY a1.idMantenimiento DESC LIMIT 1) AS estado,(SELECT a1.tipoRecursos FROM poa_mantenimiento AS a1 WHERE a1.idProgramacionFinanciera=b.idProgramacionFinanciera ORDER BY a1.idMantenimiento DESC LIMIT 1) AS tipoRecursos,(SELECT a1.tipoIntervencion FROM poa_mantenimiento AS a1 WHERE a1.idProgramacionFinanciera=b.idProgramacionFinanciera ORDER BY a1.idMantenimiento DESC LIMIT 1) AS tipoIntervencion,(SELECT a1.detallarTipoIn FROM poa_mantenimiento AS a1 WHERE a1.idProgramacionFinanciera=b.idProgramacionFinanciera ORDER BY a1.idMantenimiento DESC LIMIT 1) AS detallarTipoIn,(SELECT a1.tipoMantenimiento FROM poa_mantenimiento AS a1 WHERE a1.idProgramacionFinanciera=b.idProgramacionFinanciera ORDER BY a1.idMantenimiento DESC LIMIT 1) AS tipoMantenimiento, (SELECT REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(a1.materialesServicios, 'Ã¡', 'á'),'Ã©','é'),'Ã­','í'),'Ã³','ó'),'Ãº','ú'),'Ã‰','É'),'ÃŒ','Í'),'Ã“','Ó'),'Ãš','Ú'),'Ã±','ñ'),'Ã‘','Ñ'),'&#039;',' ` '),'Ã','Á'),'',' '),'Ã','Á'),'SI','SI'),'â€œ',''),'â€',''),'Á²','ó')  FROM poa_mantenimiento AS a1 WHERE a1.idProgramacionFinanciera=b.idProgramacionFinanciera ORDER BY a1.idMantenimiento DESC LIMIT 1) AS materialesServicios,(SELECT a1.fechaUltimo FROM poa_mantenimiento AS a1 WHERE a1.idProgramacionFinanciera=b.idProgramacionFinanciera ORDER BY a1.idMantenimiento DESC LIMIT 1) AS fechaUltimo,b.enero,b.febrero,b.marzo,b.abril,b.mayo,b.junio,b.julio,b.agosto,b.septiembre,b.octubre,b.noviembre,b.diciembre,b.totalTotales FROM poa_programacion_financiera AS b INNER JOIN poa_item AS c ON c.idItem=b.idItem INNER JOIN poa_mantenimiento AS zL ON zL.idProgramacionFinanciera=b.idProgramacionFinanciera WHERE b.idOrganismo='$idOrganismo' AND b.idActividad='$idActividad' GROUP BY zL.idProgramacionFinanciera ORDER BY zL.idMantenimiento;");

			$jason['obtenerInformacion']=$obtenerInformacion;

		break;	



		case  "actDeportivasIns":

			
			$obtenerInformacion=$objeto->getObtenerInformacionGeneral("SELECT c.itemPreesupuestario,REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(c.nombreItem, 'Ã¡', 'á'),'Ã©','é'),'Ã­','í'),'Ã³','ó'),'Ãº','ú'),'Ã‰','É'),'ÃŒ','Í'),'Ã“','Ó'),'Ãš','Ú'),'Ã±','ñ'),'Ã‘','Ñ'),'&#039;',' ` '),'Ã','Á'),'',' '),'Ã','Á'),'SI','SI'),'â€œ',''),'â€',''),'Á²','ó') AS nombreItem,a.tipoFinanciamiento,REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(a.nombreEvento, 'Ã¡', 'á'),'Ã©','é'),'Ã­','í'),'Ã³','ó'),'Ãº','ú'),'Ã‰','É'),'ÃŒ','Í'),'Ã“','Ó'),'Ãš','Ú'),'Ã±','ñ'),'Ã‘','Ñ'),'&#039;',' ` '),'Ã','Á'),'',' '),'Ã','Á'),'SI','SI'),'â€œ',''),'â€',''),'Á²','ó') AS nombreEvento,(SELECT a1.nombreDeporte FROM poa_deporte AS a1 WHERE a1.idDeporte=a.Deporte LIMIT 1) AS Deporte,(SELECT a1.nombreProvincia FROM in_md_provincias AS a1 WHERE a1.idProvincia=a.provincia) AS provincia,(SELECT REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(a1.paisnombre, 'Ã¡', 'á'),'Ã©','é'),'Ã­','í'),'Ã³','ó'),'Ãº','ú'),'Ã‰','É'),'ÃŒ','Í'),'Ã“','Ó'),'Ãš','Ú'),'Ã±','ñ'),'Ã‘','Ñ'),'&#039;',' ` '),'Ã','Á'),'',' '),'Ã','Á'),'SI','SI'),'â€œ',''),'â€',''),'Á²','ó') FROM poa_pais AS a1 WHERE a1.id=a.ciudadPais) AS ciudadPais,IF((SELECT a1.nombreAlcanse FROM poa_alcanse AS a1 WHERE a1.idAlcanse=a.alcance) IS NULL, 'INT',(SELECT a1.nombreAlcanse FROM poa_alcanse AS a1 WHERE a1.idAlcanse=a.alcance)) AS alcance,a.fechaInicio,a.fechaFin,a.genero,a.categoria,a.numeroEntreandores,a.numeroAtletas,a.total,a.mBenefici,a.hBenefici,REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(a.justificacionAd, 'Ã¡', 'á'),'Ã©','é'),'Ã­','í'),'Ã³','ó'),'Ãº','ú'),'Ã‰','É'),'ÃŒ','Í'),'Ã“','Ó'),'Ãš','Ú'),'Ã±','ñ'),'Ã‘','Ñ'),'&#039;',' ` '),'Ã','Á'),'',' '),'Ã','Á'),'SI','SI'),'â€œ',''),'â€',''),'Á²','ó') AS justificacionAd,a.canitdarBie,REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(a.detalleBien, 'Ã¡', 'á'),'Ã©','é'),'Ã­','í'),'Ã³','ó'),'Ãº','ú'),'Ã‰','É'),'ÃŒ','Í'),'Ã“','Ó'),'Ãš','Ú'),'Ã±','ñ'),'Ã‘','Ñ'),'&#039;',' ` '),'Ã','Á'),'',' '),'Ã','Á'),'SI','SI'),'â€œ',''),'â€',''),'Á²','ó') AS detalleBien,a.enero,a.febrero,a.marzo,a.abril,a.mayo,a.junio,a.julio,a.agosto,a.septiembre,a.octubre,a.noviembre,a.diciembre,a.totalElem FROM poa_programacion_financiera AS b LEFT JOIN poa_actdeportivas AS a  ON a.idProgramacionFinanciera=b.idProgramacionFinanciera LEFT JOIN poa_item AS c ON c.idItem=b.idItem WHERE b.idOrganismo='$idOrganismo' AND b.idActividad='$idActividad' ORDER BY b.idItem;");

			$jason['obtenerInformacion']=$obtenerInformacion;

		break;	


	}

	echo json_encode($jason);





