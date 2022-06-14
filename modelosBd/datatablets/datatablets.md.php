<?php
	
	extract($_POST);

	require_once "../../config/config2.php";

	$objeto= new usuarioAcciones();

	$anioA = date('Y');

	$corPlanificas=$objeto->getObtenerInformacionGeneral("SELECT a.id_usuario FROM th_usuario AS a INNER JOIN th_usuario_roles AS b ON a.id_usuario=b.id_usuario WHERE b.id_rol='4' AND a.fisicamenteEstructura='3' AND a.estadoUsuario='A' ORDER BY a.id_usuario DESC LIMIT 1;");

	$corInsta=$objeto->getObtenerInformacionGeneral("SELECT a.id_usuario FROM th_usuario AS a INNER JOIN th_usuario_roles AS b ON a.id_usuario=b.id_usuario WHERE b.id_rol='4' AND a.fisicamenteEstructura='1' AND a.estadoUsuario='A' ORDER BY a.id_usuario DESC LIMIT 1;");

	$directorPlanificacion=$objeto->getObtenerInformacionGeneral("SELECT a.id_usuario FROM th_usuario AS a INNER JOIN th_usuario_roles AS b ON a.id_usuario=b.id_usuario WHERE b.id_rol='2' AND a.fisicamenteEstructura='18' AND a.estadoUsuario='A' ORDER BY a.id_usuario DESC LIMIT 1;");

	$planificacion=$corPlanificas[0][id_usuario];
	$instalaciones=$corInsta[0][id_usuario];
	$directorVariables=$directorPlanificacion[0][id_usuario];

	switch ($identificador) {


		case "paid__poas__asignaciones":

			$query="SELECT b.ruc,b.nombreOrganismo,a.monto,a.archivo AS documento ,(SELECT a1.programa__creado FROM poa_paid_proyecto AS a1 WHERE a1.idProyectoPaid=a.idProyecto) AS proyecto FROM poa_paid_proyecto_organismo AS a INNER JOIN poa_organismo AS b ON a.idOrganismo=b.idOrganismo;";

			$dataTablets=$objeto->getDatatablets2($query);


			echo json_encode($dataTablets);

		break;

		case "reporteriaDefinitiva__c":

			$query="SELECT (SELECT REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(a2.nombreTipo, 'Ã¡', 'á'),'Ã©','é'),'Ã­','í'),'Ã³','ó'),'Ãº','ú'),'Ã‰','É'),'ÃŒ','Í'),'Ã“','Ó'),'Ãš','Ú'),'Ã±','ñ'),'Ã‘','Ñ'),'&#039;',' ` '),'Ã','Á'),'',' '),'Ã','Á'),'SI','SI'),'â€œ',''),'â€',''),'Á²','ó') FROM poa_competencia_organismo_competencia AS a1 INNER JOIN poa_tipo_organismo AS a2  ON a1.idTipoOrganismo=a2.idTipoOrganismo WHERE a1.idOrganismo=a.idOrganismo ORDER BY a1.idCompetenciaOrganismo DESC LIMIT 1) AS nombreTipo,(SELECT REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(a1.nombreOrganismo, 'Ã¡', 'á'),'Ã©','é'),'Ã­','í'),'Ã³','ó'),'Ãº','ú'),'Ã‰','É'),'ÃŒ','Í'),'Ã“','Ó'),'Ãš','Ú'),'Ã±','ñ'),'Ã‘','Ñ'),'&#039;',' ` '),'Ã','Á'),'',' '),'Ã','Á'),'SI','SI'),'â€œ',''),'â€',''),'Á²','ó') FROM poa_organismo AS a1 WHERE a1.idOrganismo=a.idOrganismo) AS nombreOrganismo,IF((SELECT a1.idProgramacionFinanciera FROM poa_programacion_financiera AS a1 WHERE a1.idOrganismo=a.idOrganismo AND a1.idActividad='1' LIMIT 1) IS NOT NULL AND (SELECT a6.idProgramacionFinanciera FROM poa_actividadesadministrativas AS a5 INNER JOIN poa_programacion_financiera AS a6 ON a5.idProgramacionFinanciera=a6.idProgramacionFinanciera WHERE a6.idOrganismo=a.idOrganismo LIMIT 1) IS NOT NULL OR (a.financieroE!='T' AND a.financieroE IS NOT NULL AND (SELECT a6.idProgramacionFinanciera FROM poa_actividadesadministrativas AS a5 INNER JOIN poa_programacion_financiera AS a6 ON a5.idProgramacionFinanciera=a6.idProgramacionFinanciera WHERE a6.idOrganismo=a.idOrganismo LIMIT 1) IS NOT NULL),if(a.financieroE IS NOT NULL AND a.financieroE!='T',(SELECT CONCAT_WS(' ','BANDEJA RECOMENDADO:',a1.nombre,a1.apellido) FROM th_usuario AS a1 WHERE a1.id_usuario=a.financieroE),IF(a.financieroE='T',IF(a.planificacion='T','GESTIONADO',(SELECT CONCAT_WS(' ',y2.nombre,y2.apellido) FROM th_usuario AS y2 WHERE y2.id_usuario=a.planificacion)),IF(a.financiero IS NOT NULL,(SELECT CONCAT_WS(' ','BANDEJA RECIBIDOS:',a1.nombre,a1.apellido) FROM th_usuario AS a1 WHERE a1.id_usuario=a.financiero),IF(a.financiero IS NULL AND a.financiero2 IS NULL,'BANDEJA RECIBIDOS COORDINADOR','NO CORRESPONDE')))),'NO CORRESPONDE') AS administrativo,IF((SELECT a1.idProgramacionFinanciera FROM poa_programacion_financiera AS a1 WHERE a1.idOrganismo=a.idOrganismo AND a1.idActividad='1' LIMIT 1) IS NOT NULL AND ((SELECT a1.idSueldos FROM poa_sueldossalarios2022 AS a1 WHERE a1.idOrganismo=a.idOrganismo AND a1.idActividad='1' LIMIT 1) IS NOT NULL OR (SELECT a1.idHonorarios FROM poa_honorarios2022 AS a1 WHERE a1.idOrganismo=a.idOrganismo AND a1.idActividad='1' LIMIT 1) IS NOT NULL OR (a.financieroE2!='T' AND a.financieroE2 IS NOT NULL) OR (a.financiero2 IS NOT NULL AND (SELECT a1.idProgramacionFinanciera FROM poa_programacion_financiera AS a1 WHERE a1.idOrganismo=a.idOrganismo AND a1.idActividad='1' LIMIT 1) IS NOT NULL)),if(a.financieroE2 IS NOT NULL AND a.financieroE2!='T',(SELECT CONCAT_WS(' ','BANDEJA RECOMENDADO:',a1.nombre,a1.apellido) FROM th_usuario AS a1 WHERE a1.id_usuario=a.financieroE2),IF(a.financieroE2='T',IF(a.planificacion='T','GESTIONADO',(SELECT CONCAT_WS(' ',y2.nombre,y2.apellido) FROM th_usuario AS y2 WHERE y2.id_usuario=a.planificacion)),IF(a.financiero2 IS NOT NULL,(SELECT CONCAT_WS(' ','BANDEJA RECIBIDOS:',a1.nombre,a1.apellido) FROM th_usuario AS a1 WHERE a1.id_usuario=a.financiero2),IF(a.financiero IS NULL AND a.financiero2 IS NULL,'BANDEJA RECIBIDOS COORDINADOR','NO CORRESPONDE')))),'NO CORRESPONDE') AS talentoHumano,IF((SELECT a1.idProgramacionFinanciera FROM poa_programacion_financiera AS a1 WHERE a1.idOrganismo=a.idOrganismo AND a1.idActividad='2' LIMIT 1) IS NOT NULL AND (SELECT a1.idProgramacionFinanciera FROM poa_programacion_financiera AS a1 INNER JOIN poa_mantenimiento AS a2 ON a1.idProgramacionFinanciera=a2.idProgramacionFinanciera WHERE a1.idOrganismo=a.idOrganismo LIMIT 1) IS NOT NULL,if(a.instalaciones='$instalaciones' AND a.instalacionesE2='$planificacion','NO CORRESPONDE',if(a.instalaciones='$instalaciones' AND a.instalacionesE2='$directorVariables','NO CORRESPONDE',if(a.instalacionesE IS NOT NULL AND a.instalacionesE!='T',(SELECT CONCAT_WS(' ','BANDEJA RECOMENDADO:',a1.nombre,a1.apellido) FROM th_usuario AS a1 WHERE a1.id_usuario=a.instalacionesE),IF(a.instalacionesE='T',IF(a.planificacion='T','GESTIONADO',(SELECT CONCAT_WS(' ',y2.nombre,y2.apellido) FROM th_usuario AS y2 WHERE y2.id_usuario=a.planificacion)),IF(a.instalaciones IS NOT NULL,(SELECT CONCAT_WS(' ','BANDEJA RECIBIDOS:',a1.nombre,a1.apellido) FROM th_usuario AS a1 WHERE a1.id_usuario=a.instalaciones),IF(a.instalaciones IS NULL AND a.instlaaciones2 IS NULL,'BANDEJA RECIBIDOS COORDINADOR','NO CORRESPONDE')))))),'NO CORRESPONDE') AS instalacionesDeportivas,IF((SELECT a1.idProgramacionFinanciera FROM poa_programacion_financiera AS a1 WHERE a1.idOrganismo=a.idOrganismo AND a1.idActividad='2' LIMIT 1) IS NOT NULL AND (SELECT a1.idProgramacionFinanciera FROM poa_programacion_financiera AS a1 INNER JOIN poa_mantenimiento AS a2 ON a1.idProgramacionFinanciera=a2.idProgramacionFinanciera WHERE a1.idOrganismo=a.idOrganismo LIMIT 1) IS NOT NULL,if(a.instlaaciones2='$instalaciones' AND a.instalacionesE='$planificacion','NO CORRESPONDE',if(a.instlaaciones2='$instalaciones' AND a.instalacionesE='$directorVariables','NO CORRESPONDE',if(a.instalacionesE2 IS NOT NULL AND a.instalacionesE2!='T',(SELECT CONCAT_WS(' ','BANDEJA RECOMENDADO:',a1.nombre,a1.apellido) FROM th_usuario AS a1 WHERE a1.id_usuario=a.instalacionesE2),IF(a.instalacionesE2='T',IF(a.planificacion='T','GESTIONADO',(SELECT CONCAT_WS(' ',y2.nombre,y2.apellido) FROM th_usuario AS y2 WHERE y2.id_usuario=a.planificacion)),IF(a.instlaaciones2 IS NOT NULL,(SELECT CONCAT_WS(' ','BANDEJA RECIBIDOS:',a1.nombre,a1.apellido) FROM th_usuario AS a1 WHERE a1.id_usuario=a.instlaaciones2),IF(a.instalaciones IS NULL AND a.instlaaciones2 IS NULL,'BANDEJA RECIBIDOS COORDINADOR','NO CORRESPONDE')))))),'NO CORRESPONDE') AS infraestructura,IF((SELECT a1.idProgramacionFinanciera FROM poa_programacion_financiera AS a1 INNER JOIN poa_competencia_organismo_competencia AS a2 ON a1.idOrganismo=a2.idOrganismo INNER JOIN poa_tipo_organismo AS a3 ON a3.idTipoOrganismo=a2.idTipoOrganismo WHERE a1.idOrganismo=a.idOrganismo AND (a1.idActividad='3' OR a1.idActividad='4'OR a1.idActividad='5'OR a1.idActividad='6' OR a1.idActividad='7') AND (a3.nombreTipo LIKE '%ecuatorianas por%' OR a3.nombreTipo LIKE '%pico Ecuatoriano%'  OR a3.nombreTipo LIKE '%Federaciones Ecuatorianas de Deporte Adaptado%' OR a3.nombreTipo LIKE '%Militar Ecuatoriana%' OR a3.nombreTipo LIKE '%Policial Ecuatoriana%')  LIMIT 1) IS NOT NULL,if(a.subsecretariaE IS NOT NULL AND a.subsecretariaE!='T',(SELECT CONCAT_WS(' ','BANDEJA RECOMENDADO:',a1.nombre,a1.apellido) FROM th_usuario AS a1 WHERE a1.id_usuario=a.subsecretariaE),IF(a.subsecretariaE='T',IF(a.planificacion='T','GESTIONADO',(SELECT CONCAT_WS(' ',y2.nombre,y2.apellido) FROM th_usuario AS y2 WHERE y2.id_usuario=a.planificacion)),IF(a.subsecretaria IS NOT NULL,(SELECT CONCAT_WS(' ','BANDEJA RECIBIDOS:',a1.nombre,a1.apellido) FROM th_usuario AS a1 WHERE a1.id_usuario=a.subsecretaria),'BANDEJA RECIBIDOS SUBSECRETARIO'))),'NO CORRESPONDE') AS subsecetariaAlto,IF((SELECT a1.idProgramacionFinanciera FROM poa_programacion_financiera AS a1 INNER JOIN poa_competencia_organismo_competencia AS a2 ON a1.idOrganismo=a2.idOrganismo INNER JOIN poa_tipo_organismo AS a3 ON a3.idTipoOrganismo=a2.idTipoOrganismo WHERE a1.idOrganismo=a.idOrganismo AND (a1.idActividad='3' OR a1.idActividad='4'OR a1.idActividad='5'OR a1.idActividad='6' OR a1.idActividad='7') AND (a3.nombreTipo LIKE '%cantonales%' OR a3.nombreTipo LIKE '%comunitarias%'  OR a3.nombreTipo LIKE '%deportivas provinciales%' OR a3.nombreTipo LIKE '%barriales y parroquiales%' OR a3.nombreTipo LIKE '%Federaciones provinciales de ligas%' OR a3.nombreTipo LIKE '%Federaciones provinciales de ligas%' OR a3.nombreTipo LIKE '%Federaciones provinciales de ligas%' OR a3.nombreTipo LIKE '%Federaciones provinciales de ligas%' OR a3.nombreTipo LIKE '%Federaciones deportivas provinciales de r%' OR a3.nombreTipo LIKE '%Nacional de Ligas Deportivas%' OR a3.nombreTipo LIKE '%Nacional del Ecuador%' OR a3.nombreTipo LIKE '%de Deporte Universitario%' OR a3.nombreTipo LIKE '%Estudiantil%' OR a3.nombreTipo LIKE '%Rurales%' OR a3.nombreTipo LIKE '%Ligas deportivas barriales,%' OR a3.nombreTipo LIKE '%Federaciones cantonales de ligas deportivas barriales y parroquiales%')  LIMIT 1) IS NOT NULL,if(a.subsecretariaE IS NOT NULL AND a.subsecretariaE!='T',(SELECT CONCAT_WS(' ','BANDEJA RECOMENDADO:',a1.nombre,a1.apellido) FROM th_usuario AS a1 WHERE a1.id_usuario=a.subsecretariaE),IF(a.subsecretariaE='T',IF(a.planificacion='T','GESTIONADO',(SELECT CONCAT_WS(' ',y2.nombre,y2.apellido) FROM th_usuario AS y2 WHERE y2.id_usuario=a.planificacion)),IF(a.subsecretaria IS NOT NULL,(SELECT CONCAT_WS(' ','BANDEJA RECIBIDOS:',a1.nombre,a1.apellido) FROM th_usuario AS a1 WHERE a1.id_usuario=a.subsecretaria),'BANDEJA RECIBIDOS SUBSECRETARIO'))),'NO CORRESPONDE') AS subsecretariaActividad FROM poa_preliminar_envio AS a;";

			$dataTablets=$objeto->getDatatablets2($query);


			echo json_encode($dataTablets);

		break;


		case "organismosRegistrados_i":

			$query="SELECT a.ruc,a.nombreOrganismo,(SELECT a1.nombreProvincia FROM in_md_provincias AS a1 WHERE a1.idProvincia=a.idProvincia) AS nombreProvincia,(SELECT a1.nombreCanton FROM in_md_canton AS a1 WHERE a1.idCanton=a.idCanton) AS nombreCanton,(SELECT a1.nombreParroquia FROM in_md_parroquia AS a1 WHERE a1.idParroquia=a.idParroquia LIMIT 1) AS nombreParroquia,if((SELECT b.nombreInversion FROM poa_inversion_usuario AS a1 INNER JOIN poa_inversion AS b ON a1.idInversion=b.idInversion WHERE a1.idOrganismo=a.idOrganismo LIMIT 1) IS NOT NULL,IF((SELECT a1.idFinal FROM poa_documentofinal AS a1 WHERE a1.idOrganismo=a.idOrganismo LIMIT 1) IS NOT NULL,'Trámite gestionado','Asignación presupuestada realizada'),'Presupuesto no asignado') AS estado FROM poa_organismo	AS a;";

			$dataTablets=$objeto->getDatatablets2($query);


			echo json_encode($dataTablets);

		break;


		case "reporteria__suministros":

			$query="SELECT a.idSumi,a.tipo,a.nombreEscenario,GROUP_CONCAT(b.luz SEPARATOR '---') AS energia,GROUP_CONCAT(b.agua SEPARATOR '---') AS agua FROM poa_suministrosn AS a INNER JOIN poa_suministros AS b ON a.idSumi=b.idSumiN WHERE a.idOrganismo='$datos[0]' GROUP BY a.idSumi;";

			$dataTablets=$objeto->getDatatablets($query);

			echo json_encode($dataTablets);

		break;



		case "reporteria__mantenimiento":

			$query="SELECT CONCAT_WS(' ','Actividad',b.idActividad) AS idActividad, a.nombreInfras,(SELECT a1.nombreProvincia FROM in_md_provincias AS a1 WHERE a1.idProvincia=a.provincia) AS provincia,a.direccionCompleta,a.estado,a.tipoRecursos,a.tipoIntervencion,a.detallarTipoIn,a.tipoMantenimiento,a.materialesServicios,b.enero,b.febrero,b.marzo,b.abril,b.mayo,b.junio,b.julio,b.agosto,b.septiembre,b.octubre,b.noviembre,b.diciembre,b.totalTotales FROM poa_mantenimiento AS a INNER JOIN poa_programacion_financiera AS b ON a.idProgramacionFinanciera=b.idProgramacionFinanciera WHERE b.idOrganismo='$datos[0]' GROUP BY a.idProgramacionFinanciera ORDER BY a.idMantenimiento DESC;";

			$dataTablets=$objeto->getDatatablets($query);

			echo json_encode($dataTablets);

		break;



		case "reporteria__administrativas":

			$query="SELECT CONCAT_WS(' ','Actividad',b.idActividad) AS idActividad, a.justificacionActividad,a.cantidadBien,b.enero,b.febrero,b.marzo,b.abril,b.mayo,b.junio,b.julio,b.agosto,b.septiembre,b.octubre,b.noviembre,b.diciembre,b.totalTotales FROM poa_actividadesadministrativas AS a INNER JOIN poa_programacion_financiera AS b ON a.idProgramacionFinanciera=b.idProgramacionFinanciera WHERE b.idOrganismo='$datos[0]' GROUP BY a.idProgramacionFinanciera ORDER BY a.idActividadAd DESC;";

			$dataTablets=$objeto->getDatatablets($query);

			echo json_encode($dataTablets);

		break;



		case "reporteria__actividades":

			$query="SELECT CONCAT_WS(' ','Actividad',b.idActividad) AS idActividad,a.tipoFinanciamiento,a.nombreEvento,(SELECT a1.nombreDeporte FROM poa_deporte AS a1 WHERE a1.idDeporte=a.Deporte) AS nombreDeporte,(SELECT a1.nombreProvincia FROM in_md_provincias AS a1 WHERE a1.idProvincia=a.provincia) AS nombreProvincia,(SELECT a1.paisnombre FROM poa_pais AS a1 WHERE a1.id=a.ciudadPais) AS paisNombre, (SELECT a1.nombreAlcanse FROM poa_alcanse AS a1 WHERE a1.idAlcanse=a.alcance) AS alcance,a.fechaInicio,a.fechaFin,a.genero,a.categoria,a.numeroEntreandores,a.numeroAtletas,a.total,a.mBenefici,a.hBenefici,a.justificacionAd,a.canitdarBie,a.detalleBien,a.enero,a.febrero,a.marzo,a.abril,a.mayo,a.junio,a.julio,a.agosto,a.septiembre,a.octubre,a.noviembre,a.diciembre,a.totalElem FROM poa_actdeportivas AS a INNER JOIN poa_programacion_financiera AS b ON a.idProgramacionFinanciera=b.idProgramacionFinanciera WHERE b.idOrganismo='$datos[0]' ORDER BY idActividad;";

			$dataTablets=$objeto->getDatatablets($query);

			echo json_encode($dataTablets);

		break;

		case "reporteria__honorarios":

			$query="SELECT CONCAT_WS(' ','Actividad',idActividad) AS idActividad,cedula,nombres,cargo,honorarioMensual,enero,febrero,marzo,abril,mayo,junio,julio,agosto,septiembre,octubre,noviembre,diciembre,total,honorarioMensual,tipoCargo FROM poa_honorarios2022 WHERE idOrganismo='$datos[0]' ORDER BY idHonorarios;";

			$dataTablets=$objeto->getDatatablets($query);

			echo json_encode($dataTablets);

		break;


		case "poa__inicial__poa":

			$query="SELECT b.nombreActividades,c.nombreItem,c.itemPreesupuestario, a.enero,a.febrero,a.marzo,a.abril, a.mayo,a.junio,a.julio, a.agosto, a.septiembre, a.octubre,a.noviembre,a.diciembre, a.totalTotales FROM poa_programacion_financiera AS a INNER JOIN poa_actividades AS b ON a.idActividad=b.idActividades INNER JOIN poa_item AS c ON c.idItem=a.idItem WHERE a.idOrganismo='$datos[0]';";

			$dataTablets=$objeto->getDatatablets($query);

			echo json_encode($dataTablets);

		break;

		case "poa__indicadores__poa":

			$query="(SELECT b.nombreActividades,a.primertrimestre,a.segundotrimestre,a.tercertrimestre,a.cuartotrimestre,a.metaindicador FROM poa_poainicial AS a INNER JOIN poa_actividades AS b ON a.idActividad=b.idActividades WHERE a.idActividad='1' AND a.idOrganismo='$datos[0]' AND a.metaindicador>0 ORDER BY a.idPoaEnviado DESC LIMIT 1) UNION (SELECT b.nombreActividades,a.primertrimestre,a.segundotrimestre,a.tercertrimestre,a.cuartotrimestre,a.metaindicador FROM poa_poainicial AS a INNER JOIN poa_actividades AS b ON a.idActividad=b.idActividades WHERE a.idActividad='2' AND a.idOrganismo='$datos[0]' ORDER BY a.idPoaEnviado DESC LIMIT 1) UNION (SELECT b.nombreActividades,a.primertrimestre,a.segundotrimestre,a.tercertrimestre,a.cuartotrimestre,a.metaindicador FROM poa_poainicial AS a INNER JOIN poa_actividades AS b ON a.idActividad=b.idActividades WHERE a.idActividad='3' AND a.idOrganismo='$datos[0]' ORDER BY a.idPoaEnviado DESC LIMIT 1) UNION (SELECT b.nombreActividades,a.primertrimestre,a.segundotrimestre,a.tercertrimestre,a.cuartotrimestre,a.metaindicador FROM poa_poainicial AS a INNER JOIN poa_actividades AS b ON a.idActividad=b.idActividades WHERE a.idActividad='4' AND a.idOrganismo='$datos[0]' ORDER BY a.idPoaEnviado DESC LIMIT 1) UNION (SELECT b.nombreActividades,a.primertrimestre,a.segundotrimestre,a.tercertrimestre,a.cuartotrimestre,a.metaindicador FROM poa_poainicial AS a INNER JOIN poa_actividades AS b ON a.idActividad=b.idActividades WHERE a.idActividad='5' AND a.idOrganismo='$datos[0]' ORDER BY a.idPoaEnviado DESC LIMIT 1) UNION (SELECT b.nombreActividades,a.primertrimestre,a.segundotrimestre,a.tercertrimestre,a.cuartotrimestre,a.metaindicador FROM poa_poainicial AS a INNER JOIN poa_actividades AS b ON a.idActividad=b.idActividades WHERE a.idActividad='6' AND a.idOrganismo='$datos[0]' ORDER BY a.idPoaEnviado DESC LIMIT 1) UNION (SELECT b.nombreActividades,a.primertrimestre,a.segundotrimestre,a.tercertrimestre,a.cuartotrimestre,a.metaindicador FROM poa_poainicial AS a INNER JOIN poa_actividades AS b ON a.idActividad=b.idActividades WHERE a.idActividad='7' AND a.idOrganismo='$datos[0]' ORDER BY a.idPoaEnviado DESC LIMIT 1);";

			$dataTablets=$objeto->getDatatablets($query);

			echo json_encode($dataTablets);

		break;


		case "reporteria__sueldosySalarios":

			$query="SELECT CONCAT_WS(' ','Actividad',idActividad) AS idActividad,cedula,REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(nombres, 'Ã¡', 'á'),'Ã©','é'),'Ã­','í'),'Ã³','ó'),'Ãº','ú'),'Ã‰','É'),'ÃŒ','Í'),'Ã“','Ó'),'Ãš','Ú'),'Ã±','ñ'),'Ã‘','Ñ'),'&#039;',' ` '),'Ã','Á'),'',' '),'Ã','Á'),'SI','SI'),'â€œ',''),'â€',''),'Á²','ó') AS nombres,cargo,tipoCargo,tiempoTrabajo,sueldoSalario,aportePatronal,decimoTercera,mensualizaTercera,decimoCuarta,menusalizaCuarta,fondosReserva,enero,febrero,marzo,abril,mayo,junio,julio,agosto,septiembre,octubre,noviembre,diciembre,total FROM poa_sueldossalarios2022 WHERE idOrganismo='$datos[0]'  ORDER BY idActividad;";

			$dataTablets=$objeto->getDatatablets($query);

			echo json_encode($dataTablets);

		break;


		case "intervencionesAsuntos":

			$query="SELECT b.ruc,b.nombreOrganismo,(SELECT a1.nombreProvincia FROM in_md_provincias AS a1 WHERE a1.idProvincia=b.idProvincia) AS provincia,(SELECT a1.nombreCanton FROM in_md_canton AS a1 WHERE a1.idCanton=b.idCanton) AS canton,(SELECT a1.nombreParroquia FROM in_md_parroquia AS a1 WHERE a1.idParroquia=b.idParroquia) AS parroquia, a.cedulaInterventor,a.nombreInterventor,a.fechaInicioIntervencion,a.fechaFinalIntervencion,a.idInterventor FROM poa_interventores AS a INNER JOIN poa_organismo AS b ON a.idOrganismo=b.idOrganismo;";

			$dataTablets=$objeto->getDatatablets($query);

			echo json_encode($dataTablets);

		break;

		case "poasGestionados__finan__rechado":

			$query="SELECT (SELECT a1.ruc FROM poa_organismo AS a1 WHERE a1.idOrganismo=a.idOrganismo LIMIT 1) AS ruc,(SELECT REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(a1.nombreOrganismo, 'Ã¡', 'á'),'Ã©','é'),'Ã­','í'),'Ã³','ó'),'Ãº','ú'),'Ã‰','É'),'ÃŒ','Í'),'Ã“','Ó'),'Ãš','Ú'),'Ã±','ñ'),'Ã‘','Ñ'),'&#039;',' ` '),'Ã','Á'),'',' '),'Ã','Á'),'SI','SI'),'â€œ',''),'â€',''),'Á²','ó') FROM poa_organismo AS a1 WHERE a1.idOrganismo=a.idOrganismo LIMIT 1) AS nombreOrganismo,(SELECT a2.nombreInversion FROM poa_inversion_usuario AS a1 INNER JOIN poa_inversion AS a2 ON a1.idInversion=a2.idInversion WHERE a1.idOrganismo=a.idOrganismo LIMIT 1) AS nombreInversion,a.fecha_quipux,a.fecha_dias,IF(now()<=a.fecha_dias,'Presenta en tiempo establecido','Notificado por no presentación de requisitos') AS estado,(SELECT a1.nombreZonal FROM poa_organismo_zonal AS a1 WHERE a1.idOrganismo=a.idOrganismo) AS zonal,a.idOrganismo,(SELECT a1.idFinancieroD FROM poa_financiero_documentos AS a1 WHERE a1.idOrganismo=a.idOrganismo LIMIT 1) AS final FROM poa_documentofinal AS a INNER JOIN poa_preliminar_envio AS b ON a.idOrganismo=b.idOrganismo LEFT JOIN poa_financiero_documentos AS c ON c.idOrganismo=a.idOrganismo WHERE YEAR(a.fecha_quipux)='$anioA' AND (c.idUsuario='$datos[0]' OR c.idUsuario IS NULL AND now()<=a.fecha_dias)  AND c.rechazo='r' GROUP BY a.idOrganismo ORDER BY a.idFinal;";

			$dataTablets=$objeto->getDatatablets($query);

			echo json_encode($dataTablets);

		break;

		case "poasGestionados__finan":

			if ($datos[2]==2 && $datos[1]==23) {
				
				$query="SELECT (SELECT a1.ruc FROM poa_organismo AS a1 WHERE a1.idOrganismo=a.idOrganismo LIMIT 1) AS ruc,(SELECT REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(a1.nombreOrganismo, 'Ã¡', 'á'),'Ã©','é'),'Ã­','í'),'Ã³','ó'),'Ãº','ú'),'Ã‰','É'),'ÃŒ','Í'),'Ã“','Ó'),'Ãš','Ú'),'Ã±','ñ'),'Ã‘','Ñ'),'&#039;',' ` '),'Ã','Á'),'',' '),'Ã','Á'),'SI','SI'),'â€œ',''),'â€',''),'Á²','ó') FROM poa_organismo AS a1 WHERE a1.idOrganismo=a.idOrganismo LIMIT 1) AS nombreOrganismo,(SELECT a2.nombreInversion FROM poa_inversion_usuario AS a1 INNER JOIN poa_inversion AS a2 ON a1.idInversion=a2.idInversion WHERE a1.idOrganismo=a.idOrganismo LIMIT 1) AS nombreInversion,a.fecha_quipux,a.fecha_dias,IF(c.rechazo='p',CONCAT_WS(' ','Rectificado el ',c.fechaCorreccion),IF(now()<=a.fecha_dias,'Presenta en tiempo establecido','Notificado por no presentación de requisitos')) AS estado,(SELECT a1.nombreZonal FROM poa_organismo_zonal AS a1 WHERE a1.idOrganismo=a.idOrganismo) AS zonal,a.idOrganismo,(SELECT a1.idFinancieroD FROM poa_financiero_documentos AS a1 WHERE a1.idOrganismo=a.idOrganismo LIMIT 1) AS final,c.rechazo FROM poa_documentofinal AS a INNER JOIN poa_preliminar_envio AS b ON a.idOrganismo=b.idOrganismo LEFT JOIN poa_financiero_documentos AS c ON c.idOrganismo=a.idOrganismo WHERE YEAR(a.fecha_quipux)='$anioA' AND (c.idUsuario='$datos[0]' OR c.idUsuario IS NULL) AND now()<=a.fecha_dias GROUP BY a.idOrganismo ORDER BY a.idFinal;";

			}else if($datos[2]==3){

				$query="SELECT (SELECT a1.ruc FROM poa_organismo AS a1 WHERE a1.idOrganismo=a.idOrganismo LIMIT 1) AS ruc,(SELECT REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(a1.nombreOrganismo, 'Ã¡', 'á'),'Ã©','é'),'Ã­','í'),'Ã³','ó'),'Ãº','ú'),'Ã‰','É'),'ÃŒ','Í'),'Ã“','Ó'),'Ãš','Ú'),'Ã±','ñ'),'Ã‘','Ñ'),'&#039;',' ` '),'Ã','Á'),'',' '),'Ã','Á'),'SI','SI'),'â€œ',''),'â€',''),'Á²','ó') FROM poa_organismo AS a1 WHERE a1.idOrganismo=a.idOrganismo LIMIT 1) AS nombreOrganismo,(SELECT a2.nombreInversion FROM poa_inversion_usuario AS a1 INNER JOIN poa_inversion AS a2 ON a1.idInversion=a2.idInversion WHERE a1.idOrganismo=a.idOrganismo LIMIT 1) AS nombreInversion,a.fecha_quipux,a.fecha_dias,IF(c.rechazo='p',CONCAT_WS(' ','Rectificado el ',c.fechaCorreccion),IF(now()<=a.fecha_dias,'Presenta en tiempo establecido','Notificado por no presentación de requisitos')) AS estado,(SELECT a1.nombreZonal FROM poa_organismo_zonal AS a1 WHERE a1.idOrganismo=a.idOrganismo) AS zonal,a.idOrganismo,(SELECT a1.idFinancieroD FROM poa_financiero_documentos AS a1 WHERE a1.idOrganismo=a.idOrganismo LIMIT 1) AS final,c.rechazo FROM poa_documentofinal AS a INNER JOIN poa_preliminar_envio AS b ON a.idOrganismo=b.idOrganismo LEFT JOIN poa_financiero_documentos AS c ON c.idOrganismo=a.idOrganismo WHERE YEAR(a.fecha_quipux)='$anioA' AND (c.idUsuario='$datos[0]' AND (c.rechazo='A' OR c.rechazo IS NULL) AND c.idUsuario='$datos[0]' AND now()<=a.fecha_dias) OR (c.rechazo='p' AND c.idUsuario='$datos[0]' AND now()<=a.fecha_dias) GROUP BY a.idOrganismo ORDER BY a.idFinal;";

			}else{

				$query="SELECT (SELECT a1.ruc FROM poa_organismo AS a1 WHERE a1.idOrganismo=a.idOrganismo LIMIT 1) AS ruc,(SELECT REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(a1.nombreOrganismo, 'Ã¡', 'á'),'Ã©','é'),'Ã­','í'),'Ã³','ó'),'Ãº','ú'),'Ã‰','É'),'ÃŒ','Í'),'Ã“','Ó'),'Ãš','Ú'),'Ã±','ñ'),'Ã‘','Ñ'),'&#039;',' ` '),'Ã','Á'),'',' '),'Ã','Á'),'SI','SI'),'â€œ',''),'â€',''),'Á²','ó') FROM poa_organismo AS a1 WHERE a1.idOrganismo=a.idOrganismo LIMIT 1) AS nombreOrganismo,(SELECT a2.nombreInversion FROM poa_inversion_usuario AS a1 INNER JOIN poa_inversion AS a2 ON a1.idInversion=a2.idInversion WHERE a1.idOrganismo=a.idOrganismo LIMIT 1) AS nombreInversion,a.fecha_quipux,a.fecha_dias,IF(c.rechazo='p',CONCAT_WS(' ','Rectificado el ',c.fechaCorreccion),IF(now()<=a.fecha_dias,'Presenta en tiempo establecido','Notificado por no presentación de requisitos')) AS estado,(SELECT a1.nombreZonal FROM poa_organismo_zonal AS a1 WHERE a1.idOrganismo=a.idOrganismo) AS zonal,a.idOrganismo,(SELECT a1.idFinancieroD FROM poa_financiero_documentos AS a1 WHERE a1.idOrganismo=a.idOrganismo LIMIT 1) AS final,c.rechazo FROM poa_documentofinal AS a INNER JOIN poa_preliminar_envio AS b ON a.idOrganismo=b.idOrganismo LEFT JOIN poa_financiero_documentos AS c ON c.idOrganismo=a.idOrganismo WHERE YEAR(a.fecha_quipux)='$anioA' AND c.idUsuario='$datos[0]' AND now()<=a.fecha_dias  GROUP BY a.idOrganismo ORDER BY a.idFinal;";

			}

			$dataTablets=$objeto->getDatatablets($query);

			echo json_encode($dataTablets);

		break;

		case "poasGestionados__finan__suspencion":

				
			$query="SELECT (SELECT a1.ruc FROM poa_organismo AS a1 WHERE a1.idOrganismo=a.idOrganismo LIMIT 1) AS ruc,(SELECT REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(a1.nombreOrganismo, 'Ã¡', 'á'),'Ã©','é'),'Ã­','í'),'Ã³','ó'),'Ãº','ú'),'Ã‰','É'),'ÃŒ','Í'),'Ã“','Ó'),'Ãš','Ú'),'Ã±','ñ'),'Ã‘','Ñ'),'&#039;',' ` '),'Ã','Á'),'',' '),'Ã','Á'),'SI','SI'),'â€œ',''),'â€',''),'Á²','ó') FROM poa_organismo AS a1 WHERE a1.idOrganismo=a.idOrganismo LIMIT 1) AS nombreOrganismo,(SELECT a2.nombreInversion FROM poa_inversion_usuario AS a1 INNER JOIN poa_inversion AS a2 ON a1.idInversion=a2.idInversion WHERE a1.idOrganismo=a.idOrganismo LIMIT 1) AS nombreInversion,a.fecha_quipux,a.fecha_dias,IF(now()<=a.fecha_dias,'Presenta en tiempo establecido','Notificado por no presentación de requisitos') AS estado,(SELECT a1.nombreZonal FROM poa_organismo_zonal AS a1 WHERE a1.idOrganismo=a.idOrganismo) AS zonal,a.idOrganismo,(SELECT a1.idFinancieroD FROM poa_financiero_documentos AS a1 WHERE a1.idOrganismo=a.idOrganismo LIMIT 1) AS final FROM poa_documentofinal AS a INNER JOIN poa_preliminar_envio AS b ON a.idOrganismo=b.idOrganismo LEFT JOIN poa_financiero_documentos AS c ON c.idOrganismo=a.idOrganismo WHERE YEAR(a.fecha_quipux)='$anioA' AND now()>=a.fecha_dias OR a.fecha_dias IS NULL GROUP BY a.idOrganismo ORDER BY a.idFinal;";

			$dataTablets=$objeto->getDatatablets($query);

			echo json_encode($dataTablets);

		break;

		case "poasGestionados__finan__aprobado__dos":

			$usuarioFisicamente=$objeto->getObtenerInformacionGeneral("SELECT a.fisicamenteEstructura,a.zonal FROM th_usuario AS a  WHERE a.id_usuario='$datos[0]';");

			$zonal=$usuarioFisicamente[0][zonal];
			$fisicamente=$usuarioFisicamente[0][fisicamenteEstructura];

			if ($zonal>1) {
				
				$query="SELECT (SELECT a1.ruc FROM poa_organismo AS a1 WHERE a1.idOrganismo=a.idOrganismo LIMIT 1) AS ruc,(SELECT REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(a1.nombreOrganismo, 'Ã¡', 'á'),'Ã©','é'),'Ã­','í'),'Ã³','ó'),'Ãº','ú'),'Ã‰','É'),'ÃŒ','Í'),'Ã“','Ó'),'Ãš','Ú'),'Ã±','ñ'),'Ã‘','Ñ'),'&#039;',' ` '),'Ã','Á'),'',' '),'Ã','Á'),'SI','SI'),'â€œ',''),'â€',''),'Á²','ó') FROM poa_organismo AS a1 WHERE a1.idOrganismo=a.idOrganismo LIMIT 1) AS nombreOrganismo,(SELECT a2.nombreInversion FROM poa_inversion_usuario AS a1 INNER JOIN poa_inversion AS a2 ON a1.idInversion=a2.idInversion WHERE a1.idOrganismo=a.idOrganismo LIMIT 1) AS nombreInversion,a.fecha_quipux,c.fechaFuncionario_calific,a.fecha_dias,IF(now()<=a.fecha_dias,'Presenta en tiempo establecido','Notificado por no presentación de requisitos') AS estado,(SELECT a1.nombreZonal FROM poa_organismo_zonal AS a1 WHERE a1.idOrganismo=a.idOrganismo) AS zonal,a.idOrganismo,(SELECT a1.idFinancieroD FROM poa_financiero_documentos AS a1 WHERE a1.idOrganismo=a.idOrganismo LIMIT 1) AS final FROM poa_documentofinal AS a INNER JOIN poa_preliminar_envio AS b ON a.idOrganismo=b.idOrganismo INNER JOIN poa_financiero_documentos AS c ON c.idOrganismo=a.idOrganismo INNER JOIN th_usuario AS d ON d.id_usuario=c.idUsuario WHERE c.rechazo='T' AND d.zonal='$zonal' GROUP BY a.idOrganismo ORDER BY a.idFinal;";

			}else{

				if($fisicamente=="12"){

					$consultados="(e.nombreTipo LIKE '%ecuatorianas%' AND c.rechazo='T')";

				}else if($fisicamente=="14"){

					$consultados="(e.nombreTipo LIKE '%ParalÃ­mpico Ecuatoriano%' OR e.nombreTipo LIKE '%discapacidad%' AND c.rechazo='T')";

				}else if($fisicamente=="13"){

					$consultados="(e.nombreTipo LIKE '%o. FederaciÃ³n Provincial de Deporte Estudiantil%' OR e.nombreTipo LIKE '%deprovinciales%' OR e.nombreTipo LIKE '%a. Ligas deportivas cantonales;%' AND c.rechazo='T'  OR e.nombreTipo LIKE '%Universitario%' AND c.rechazo='T')";

				}else if($fisicamente=="19"){

					$consultados="(e.nombreTipo LIKE '%c. Asociaciones deportivas provinciales;%' OR e.nombreTipo LIKE '%r. Asociaciones Metropolitanas de Ligas Parroquiales Rurales%' OR e.nombreTipo LIKE '%d. Federaciones cantonales de ligas deportivas barriales y parroquiales%'  OR e.nombreTipo LIKE '%b. Ligas deportivas barriales, parroquiales, urbanas, rurales y comunitarias;%' OR d.nombreTipo LIKE '%Nacional%' AND c.rechazo='T')";

				}


				$query="SELECT (SELECT a1.ruc FROM poa_organismo AS a1 WHERE a1.idOrganismo=a.idOrganismo LIMIT 1) AS ruc,(SELECT REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(a1.nombreOrganismo, 'Ã¡', 'á'),'Ã©','é'),'Ã­','í'),'Ã³','ó'),'Ãº','ú'),'Ã‰','É'),'ÃŒ','Í'),'Ã“','Ó'),'Ãš','Ú'),'Ã±','ñ'),'Ã‘','Ñ'),'&#039;',' ` '),'Ã','Á'),'',' '),'Ã','Á'),'SI','SI'),'â€œ',''),'â€',''),'Á²','ó') FROM poa_organismo AS a1 WHERE a1.idOrganismo=a.idOrganismo LIMIT 1) AS nombreOrganismo,(SELECT a2.nombreInversion FROM poa_inversion_usuario AS a1 INNER JOIN poa_inversion AS a2 ON a1.idInversion=a2.idInversion WHERE a1.idOrganismo=a.idOrganismo LIMIT 1) AS nombreInversion,a.fecha_quipux,c.fechaFuncionario_calific,a.fecha_dias,IF(now()<=a.fecha_dias,'Presenta en tiempo establecido','Notificado por no presentación de requisitos') AS estado,(SELECT a1.nombreZonal FROM poa_organismo_zonal AS a1 WHERE a1.idOrganismo=a.idOrganismo) AS zonal,a.idOrganismo,(SELECT a1.idFinancieroD FROM poa_financiero_documentos AS a1 WHERE a1.idOrganismo=a.idOrganismo LIMIT 1) AS final FROM poa_documentofinal AS a INNER JOIN poa_preliminar_envio AS b ON a.idOrganismo=b.idOrganismo INNER JOIN poa_financiero_documentos AS c ON c.idOrganismo=a.idOrganismo INNER JOIN poa_competencia_organismo_competencia AS d ON d.idOrganismo=a.idOrganismo INNER JOIN poa_tipo_organismo AS e ON e.idTipoOrganismo=d.idTipoOrganismo WHERE c.rechazo='T' AND $consultados GROUP BY a.idOrganismo ORDER BY a.idFinal;";



			}

			

			$dataTablets=$objeto->getDatatablets($query);

			echo json_encode($dataTablets);

		break;

		case "poasGestionados__finan__aprobado":

			$query="SELECT (SELECT a1.ruc FROM poa_organismo AS a1 WHERE a1.idOrganismo=a.idOrganismo LIMIT 1) AS ruc,(SELECT REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(a1.nombreOrganismo, 'Ã¡', 'á'),'Ã©','é'),'Ã­','í'),'Ã³','ó'),'Ãº','ú'),'Ã‰','É'),'ÃŒ','Í'),'Ã“','Ó'),'Ãš','Ú'),'Ã±','ñ'),'Ã‘','Ñ'),'&#039;',' ` '),'Ã','Á'),'',' '),'Ã','Á'),'SI','SI'),'â€œ',''),'â€',''),'Á²','ó') FROM poa_organismo AS a1 WHERE a1.idOrganismo=a.idOrganismo LIMIT 1) AS nombreOrganismo,(SELECT a2.nombreInversion FROM poa_inversion_usuario AS a1 INNER JOIN poa_inversion AS a2 ON a1.idInversion=a2.idInversion WHERE a1.idOrganismo=a.idOrganismo LIMIT 1) AS nombreInversion,a.fecha_quipux,c.fechaFuncionario_calific,a.fecha_dias,IF(now()<=a.fecha_dias,'Presenta en tiempo establecido','Notificado por no presentación de requisitos') AS estado,(SELECT a1.nombreZonal FROM poa_organismo_zonal AS a1 WHERE a1.idOrganismo=a.idOrganismo) AS zonal,a.idOrganismo,(SELECT a1.idFinancieroD FROM poa_financiero_documentos AS a1 WHERE a1.idOrganismo=a.idOrganismo LIMIT 1) AS final FROM poa_documentofinal AS a INNER JOIN poa_preliminar_envio AS b ON a.idOrganismo=b.idOrganismo LEFT JOIN poa_financiero_documentos AS c ON c.idOrganismo=a.idOrganismo WHERE c.rechazo='T' GROUP BY a.idOrganismo ORDER BY a.idFinal;";

			$dataTablets=$objeto->getDatatablets($query);

			echo json_encode($dataTablets);

		break;

		case "asignaciones__realizadas__finan":
				
			$query="SELECT (SELECT a1.ruc FROM poa_organismo AS a1 WHERE a1.idOrganismo=a.idOrganismo LIMIT 1) AS ruc,(SELECT REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(a1.nombreOrganismo, 'Ã¡', 'á'),'Ã©','é'),'Ã­','í'),'Ã³','ó'),'Ãº','ú'),'Ã‰','É'),'ÃŒ','Í'),'Ã“','Ó'),'Ãš','Ú'),'Ã±','ñ'),'Ã‘','Ñ'),'&#039;',' ` '),'Ã','Á'),'',' '),'Ã','Á'),'SI','SI'),'â€œ',''),'â€',''),'Á²','ó') FROM poa_organismo AS a1 WHERE a1.idOrganismo=a.idOrganismo LIMIT 1) AS nombreOrganismo, (SELECT a1.nombreProvincia FROM in_md_provincias AS a1 INNER JOIN poa_organismo AS a2 ON a2.idProvincia=a1.idProvincia WHERE a2.idOrganismo=a.idOrganismo) AS provincia, (SELECT a1.nombreCanton FROM in_md_canton AS a1 INNER JOIN poa_organismo AS a2 ON a2.idCanton=a1.idCanton WHERE a2.idOrganismo=a.idOrganismo) AS canton,(SELECT a1.nombreParroquia FROM in_md_parroquia AS a1 INNER JOIN poa_organismo AS a2 ON a2.idParroquia=a1.idParroquia WHERE a2.idOrganismo=a.idOrganismo) AS parroquia,(SELECT CONCAT_WS(' ', REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(a1.nombre, 'Ã¡', 'á'),'Ã©','é'),'Ã­','í'),'Ã³','ó'),'Ãº','ú'),'Ã‰','É'),'ÃŒ','Í'),'Ã“','Ó'),'Ãš','Ú'),'Ã±','ñ'),'Ã‘','Ñ'),'&#039;',' ` '),'Ã','Á'),'',' '),'Ã','Á'),'SI','SI'),'â€œ',''),'â€',''),'Á²','ó'),REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(a1.apellido, 'Ã¡', 'á'),'Ã©','é'),'Ã­','í'),'Ã³','ó'),'Ãº','ú'),'Ã‰','É'),'ÃŒ','Í'),'Ã“','Ó'),'Ãš','Ú'),'Ã±','ñ'),'Ã‘','Ñ'),'&#039;',' ` '),'Ã','Á'),'',' '),'Ã','Á'),'SI','SI'),'â€œ',''),'â€',''),'Á²','ó')) FROM th_usuario AS a1 WHERE a1.id_usuario=a.idUsuario) AS funcionario,a.fechaDirector_envia,(SELECT a1.fecha_quipux FROM poa_documentofinal AS a1 WHERE a1.idOrganismo=a.idOrganismo ORDER BY a1.idFinal LIMIT 1) AS fechaQuipux,(SELECT a1.fecha_dias FROM poa_documentofinal AS a1 WHERE a1.idOrganismo=a.idOrganismo ORDER BY a1.idFinal LIMIT 1) AS fecha_dias,a.idOrganismo,x.documentoQuipux,x.fecha AS fecha__quipuxEnvio FROM poa_financiero_documentos AS a INNER JOIN poa_quipuxdocumento AS x ON a.idOrganismo=x.idOrganismo WHERE a.rechazo='F' GROUP BY a.idOrganismo ORDER BY x.idQuipux DESC;";


			$dataTablets=$objeto->getDatatablets($query);

			echo json_encode($dataTablets);

		break;



		case "poasGestionados":

			$query="SELECT b.ruc,b.nombreOrganismo,(SELECT a1.nombreProvincia FROM in_md_provincias AS a1 WHERE a1.idProvincia=b.idProvincia) AS provincia,(SELECT a1.nombreCanton FROM in_md_canton AS a1 WHERE a1.idCanton=b.idCanton) AS canton,(SELECT a1.nombreParroquia FROM in_md_parroquia AS a1 WHERE a1.idParroquia=b.idParroquia) AS parroquia,a.numeroOficioNoti,a.documento,a.fecha_quipux,a.montoSinDescuentos,a.idOrganismo FROM poa_documentofinal AS a INNER JOIN poa_organismo AS b ON a.idOrganismo=b.idOrganismo GROUP BY a.idOrganismo;";

			$dataTablets=$objeto->getDatatablets($query);

			echo json_encode($dataTablets);

		break;



		case "valores__adicionalesAct":

			$query="SELECT REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(c.nombreItem, 'Ã¡', 'á'),'Ã©','é'),'Ã­','í'),'Ã³','ó'),'Ãº','ú'),'Ã‰','É'),'ÃŒ','Í'),'Ã“','Ó'),'Ãš','Ú'),'Ã±','ñ'),'Ã‘','Ñ'),'&#039;',' ` '),'Ã','Á'),'',' '),'Ã','Á'),'SI','SI'),'â€œ',''),'â€',''),'Á²','ó') AS nombreItem,a.tipoFinanciamiento,REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(a.nombreEvento, 'Ã¡', 'á'),'Ã©','é'),'Ã­','í'),'Ã³','ó'),'Ãº','ú'),'Ã‰','É'),'ÃŒ','Í'),'Ã“','Ó'),'Ãš','Ú'),'Ã±','ñ'),'Ã‘','Ñ'),'&#039;',' ` '),'Ã','Á'),'',' '),'Ã','Á'),'SI','SI'),'â€œ',''),'â€',''),'Á²','ó') AS nombreEvento,(SELECT a1.nombreDeporte FROM poa_deporte AS a1 WHERE a1.idDeporte=a.Deporte LIMIT 1) AS Deporte,(SELECT a1.nombreProvincia FROM in_md_provincias AS a1 WHERE a1.idProvincia=a.provincia) AS provincia,(SELECT REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(a1.paisnombre, 'Ã¡', 'á'),'Ã©','é'),'Ã­','í'),'Ã³','ó'),'Ãº','ú'),'Ã‰','É'),'ÃŒ','Í'),'Ã“','Ó'),'Ãš','Ú'),'Ã±','ñ'),'Ã‘','Ñ'),'&#039;',' ` '),'Ã','Á'),'',' '),'Ã','Á'),'SI','SI'),'â€œ',''),'â€',''),'Á²','ó') FROM poa_pais AS a1 WHERE a1.id=a.ciudadPais) AS ciudadPais,IF((SELECT a1.nombreAlcanse FROM poa_alcanse AS a1 WHERE a1.idAlcanse=a.alcance) IS NULL, 'INT',(SELECT a1.nombreAlcanse FROM poa_alcanse AS a1 WHERE a1.idAlcanse=a.alcance)) AS alcance,a.fechaInicio,a.fechaFin,a.genero,a.categoria,a.numeroEntreandores,a.numeroAtletas,a.total,a.mBenefici,a.hBenefici,REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(a.detalleBien, 'Ã¡', 'á'),'Ã©','é'),'Ã­','í'),'Ã³','ó'),'Ãº','ú'),'Ã‰','É'),'ÃŒ','Í'),'Ã“','Ó'),'Ãš','Ú'),'Ã±','ñ'),'Ã‘','Ñ'),'&#039;',' ` '),'Ã','Á'),'',' '),'Ã','Á'),'SI','SI'),'â€œ',''),'â€',''),'Á²','ó') AS detalleBien,REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(a.justificacionAd, 'Ã¡', 'á'),'Ã©','é'),'Ã­','í'),'Ã³','ó'),'Ãº','ú'),'Ã‰','É'),'ÃŒ','Í'),'Ã“','Ó'),'Ãš','Ú'),'Ã±','ñ'),'Ã‘','Ñ'),'&#039;',' ` '),'Ã','Á'),'',' '),'Ã','Á'),'SI','SI'),'â€œ',''),'â€',''),'Á²','ó') AS justificacionAd,a.canitdarBie,a.enero,a.febrero,a.marzo,a.abril,a.mayo,a.junio,a.julio,a.agosto,a.septiembre,a.octubre,a.noviembre,a.diciembre,a.totalElem FROM poa_programacion_financiera AS b LEFT JOIN poa_actdeportivas AS a  ON a.idProgramacionFinanciera=b.idProgramacionFinanciera LEFT JOIN poa_item AS c ON c.idItem=b.idItem WHERE b.idOrganismo='$datos[0]' AND b.idActividad='$datos[1]' ORDER BY b.idItem;";

			$dataTablets=$objeto->getDatatablets($query);

			echo json_encode($dataTablets);

		break;


		case "tablaItemsAc16":

			$query="SELECT b.itemPreesupuestario,b.nombreItem,a.enero,a.febrero,a.marzo,a.abril,a.mayo,a.junio,a.julio,a.agosto,a.septiembre,a.octubre,a.noviembre,a.diciembre,a.totalSumaItem,a.idProgramacionFinanciera,a.idItem FROM poa_programacion_financiera AS a INNER JOIN poa_item AS b ON a.idItem=b.idItem WHERE idOrganismo='$datos[0]' AND a.idActividad='$datos[1]';";

			$dataTablets=$objeto->getDatatablets($query);

			echo json_encode($dataTablets);

		break;

		case "tablaItemsAc15":

			$query="SELECT b.itemPreesupuestario,b.nombreItem,a.enero,a.febrero,a.marzo,a.abril,a.mayo,a.junio,a.julio,a.agosto,a.septiembre,a.octubre,a.noviembre,a.diciembre,a.totalSumaItem,a.idProgramacionFinanciera,a.idItem FROM poa_programacion_financiera AS a INNER JOIN poa_item AS b ON a.idItem=b.idItem WHERE idOrganismo='$datos[0]' AND a.idActividad='$datos[1]';";

			$dataTablets=$objeto->getDatatablets($query);

			echo json_encode($dataTablets);

		break;


		case "tablaItemsAc14":

			$query="SELECT b.itemPreesupuestario,b.nombreItem,a.enero,a.febrero,a.marzo,a.abril,a.mayo,a.junio,a.julio,a.agosto,a.septiembre,a.octubre,a.noviembre,a.diciembre,a.totalSumaItem,a.idProgramacionFinanciera,a.idItem FROM poa_programacion_financiera AS a INNER JOIN poa_item AS b ON a.idItem=b.idItem WHERE idOrganismo='$datos[0]' AND a.idActividad='$datos[1]';";

			$dataTablets=$objeto->getDatatablets($query);

			echo json_encode($dataTablets);

		break;

		case "tablaItemsAc13":

			$query="SELECT b.itemPreesupuestario,b.nombreItem,a.enero,a.febrero,a.marzo,a.abril,a.mayo,a.junio,a.julio,a.agosto,a.septiembre,a.octubre,a.noviembre,a.diciembre,a.totalSumaItem,a.idProgramacionFinanciera,a.idItem FROM poa_programacion_financiera AS a INNER JOIN poa_item AS b ON a.idItem=b.idItem WHERE idOrganismo='$datos[0]' AND a.idActividad='$datos[1]';";

			$dataTablets=$objeto->getDatatablets($query);

			echo json_encode($dataTablets);

		break;


		case "tablaItemsAc12":

			$query="SELECT b.itemPreesupuestario,b.nombreItem,a.enero,a.febrero,a.marzo,a.abril,a.mayo,a.junio,a.julio,a.agosto,a.septiembre,a.octubre,a.noviembre,a.diciembre,a.totalSumaItem,a.idProgramacionFinanciera,a.idItem FROM poa_programacion_financiera AS a INNER JOIN poa_item AS b ON a.idItem=b.idItem WHERE idOrganismo='$datos[0]' AND a.idActividad='$datos[1]';";

			$dataTablets=$objeto->getDatatablets($query);

			echo json_encode($dataTablets);

		break;


		case "tablaItemsAc11":

			$query="SELECT b.itemPreesupuestario,b.nombreItem,a.enero,a.febrero,a.marzo,a.abril,a.mayo,a.junio,a.julio,a.agosto,a.septiembre,a.octubre,a.noviembre,a.diciembre,a.totalSumaItem,a.idProgramacionFinanciera,a.idItem FROM poa_programacion_financiera AS a INNER JOIN poa_item AS b ON a.idItem=b.idItem WHERE idOrganismo='$datos[0]' AND a.idActividad='$datos[1]';";

			$dataTablets=$objeto->getDatatablets($query);

			echo json_encode($dataTablets);

		break;

		case "tablaItemsAc10":

			$query="SELECT b.itemPreesupuestario,b.nombreItem,a.enero,a.febrero,a.marzo,a.abril,a.mayo,a.junio,a.julio,a.agosto,a.septiembre,a.octubre,a.noviembre,a.diciembre,a.totalSumaItem,a.idProgramacionFinanciera,a.idItem FROM poa_programacion_financiera AS a INNER JOIN poa_item AS b ON a.idItem=b.idItem WHERE idOrganismo='$datos[0]' AND a.idActividad='$datos[1]';";

			$dataTablets=$objeto->getDatatablets($query);

			echo json_encode($dataTablets);

		break;


		case "tablaItemsAc9":

			$query="SELECT b.itemPreesupuestario,b.nombreItem,a.enero,a.febrero,a.marzo,a.abril,a.mayo,a.junio,a.julio,a.agosto,a.septiembre,a.octubre,a.noviembre,a.diciembre,a.totalSumaItem,a.idProgramacionFinanciera,a.idItem FROM poa_programacion_financiera AS a INNER JOIN poa_item AS b ON a.idItem=b.idItem WHERE idOrganismo='$datos[0]' AND a.idActividad='$datos[1]';";

			$dataTablets=$objeto->getDatatablets($query);

			echo json_encode($dataTablets);

		break;


		case "tablaItemsAc8":

			$query="SELECT b.itemPreesupuestario,b.nombreItem,a.enero,a.febrero,a.marzo,a.abril,a.mayo,a.junio,a.julio,a.agosto,a.septiembre,a.octubre,a.noviembre,a.diciembre,a.totalSumaItem,a.idProgramacionFinanciera,a.idItem FROM poa_programacion_financiera AS a INNER JOIN poa_item AS b ON a.idItem=b.idItem WHERE idOrganismo='$datos[0]' AND a.idActividad='$datos[1]';";

			$dataTablets=$objeto->getDatatablets($query);

			echo json_encode($dataTablets);

		break;


		case "tablaItemsAc7":

			$query="SELECT b.itemPreesupuestario,b.nombreItem,a.enero,a.febrero,a.marzo,a.abril,a.mayo,a.junio,a.julio,a.agosto,a.septiembre,a.octubre,a.noviembre,a.diciembre,a.totalSumaItem,a.idProgramacionFinanciera,a.idItem FROM poa_programacion_financiera AS a INNER JOIN poa_item AS b ON a.idItem=b.idItem WHERE idOrganismo='$datos[0]' AND a.idActividad='$datos[1]';";

			$dataTablets=$objeto->getDatatablets($query);

			echo json_encode($dataTablets);

		break;



		case "tablaItemsAc6":

			$query="SELECT b.itemPreesupuestario,b.nombreItem,a.enero,a.febrero,a.marzo,a.abril,a.mayo,a.junio,a.julio,a.agosto,a.septiembre,a.octubre,a.noviembre,a.diciembre,a.totalSumaItem,a.idProgramacionFinanciera,a.idItem FROM poa_programacion_financiera AS a INNER JOIN poa_item AS b ON a.idItem=b.idItem WHERE idOrganismo='$datos[0]' AND a.idActividad='$datos[1]';";

			$dataTablets=$objeto->getDatatablets($query);

			echo json_encode($dataTablets);

		break;



		case "tablaItemsAc5":

			$query="SELECT b.itemPreesupuestario,b.nombreItem,a.enero,a.febrero,a.marzo,a.abril,a.mayo,a.junio,a.julio,a.agosto,a.septiembre,a.octubre,a.noviembre,a.diciembre,a.totalSumaItem,a.idProgramacionFinanciera,a.idItem FROM poa_programacion_financiera AS a INNER JOIN poa_item AS b ON a.idItem=b.idItem WHERE idOrganismo='$datos[0]' AND a.idActividad='$datos[1]';";

			$dataTablets=$objeto->getDatatablets($query);

			echo json_encode($dataTablets);

		break;



		case "tablaItemsAc4":

			$query="SELECT b.itemPreesupuestario,b.nombreItem,a.enero,a.febrero,a.marzo,a.abril,a.mayo,a.junio,a.julio,a.agosto,a.septiembre,a.octubre,a.noviembre,a.diciembre,a.totalSumaItem,a.idProgramacionFinanciera,a.idItem FROM poa_programacion_financiera AS a INNER JOIN poa_item AS b ON a.idItem=b.idItem WHERE idOrganismo='$datos[0]' AND a.idActividad='$datos[1]';";

			$dataTablets=$objeto->getDatatablets($query);

			echo json_encode($dataTablets);

		break;


		case "tablaItemsAc3":

			$query="SELECT b.itemPreesupuestario,b.nombreItem,a.enero,a.febrero,a.marzo,a.abril,a.mayo,a.junio,a.julio,a.agosto,a.septiembre,a.octubre,a.noviembre,a.diciembre,a.totalSumaItem,a.idProgramacionFinanciera,a.idItem FROM poa_programacion_financiera AS a INNER JOIN poa_item AS b ON a.idItem=b.idItem WHERE idOrganismo='$datos[0]' AND a.idActividad='$datos[1]';";

			$dataTablets=$objeto->getDatatablets($query);

			echo json_encode($dataTablets);

		break;



		case "tablaItemsAc2":

			$query="SELECT b.itemPreesupuestario,b.nombreItem,a.enero,a.febrero,a.marzo,a.abril,a.mayo,a.junio,a.julio,a.agosto,a.septiembre,a.octubre,a.noviembre,a.diciembre,a.totalSumaItem,a.idProgramacionFinanciera,a.idItem FROM poa_programacion_financiera AS a INNER JOIN poa_item AS b ON a.idItem=b.idItem WHERE idOrganismo='$datos[0]' AND a.idActividad='$datos[1]';";

			$dataTablets=$objeto->getDatatablets($query);

			echo json_encode($dataTablets);

		break;


		case "tablaItemsAc1":

			$query="SELECT b.itemPreesupuestario,b.nombreItem,a.enero,a.febrero,a.marzo,a.abril,a.mayo,a.junio,a.julio,a.agosto,a.septiembre,a.octubre,a.noviembre,a.diciembre,a.totalSumaItem,a.idProgramacionFinanciera,a.idItem FROM poa_programacion_financiera AS a INNER JOIN poa_item AS b ON a.idItem=b.idItem WHERE idOrganismo='$datos[0]' AND a.idActividad='$datos[1]';";

			$dataTablets=$objeto->getDatatablets($query);

			echo json_encode($dataTablets);

		break;

		case "tablaItemsAnidados":

			$query="SELECT b.itemPreesupuestario,b.nombreItem,a.enero,a.febrero,a.marzo,a.abril,a.mayo,a.junio,a.julio,a.agosto,a.septiembre,a.octubre,a.noviembre,a.diciembre,a.totalSumaItem,a.idProgramacionFinanciera FROM poa_programacion_financiera AS a INNER JOIN poa_item AS b ON a.idItem=b.idItem WHERE idOrganismo='$datos[0]' AND a.idActividad='$datos[1]';";

			$dataTablets=$objeto->getDatatablets($query);

			echo json_encode($dataTablets);

		break;

		case "aprobacionUsuarios":

			$query="SELECT b.ruc,b.nombreOrganismo,b.correo,b.telefonoOficina,CONCAT_WS(' ',a.nombre,a.apellido) AS nomprePresidente,(SELECT a1.nombreProvincia FROM in_md_provincias AS a1 WHERE a1.idProvincia=b.idProvincia) AS nombreProvincia,b.correo,b.telefonoOficina,(SELECT a2.nombreCanton FROM in_md_canton AS a2 WHERE a2.idCanton=b.idCanton) AS nombreCanton,(SELECT a3.nombreParroquia FROM in_md_parroquia AS a3 WHERE a3.idParroquia=b.idParroquia) AS nombreParroquia,b.correo,b.direccion,b.referenciaDireccion,b.idProvincia,b.idCanton,b.idParroquia,b.barrioPoa,c.numeroDeAcuerdo,c.documento,c.fecha AS fechaAcuerdo,b.idOrganismo,a.cedula, a.sexo AS sexoPresidente,a.fechaNacimiento AS fechaPresidente,a.email AS emailPresidente,a.telefono AS celularPresidente,b.cedulaResponsable,b.nombreResponsablePoa,b.correoResponsablePoa,a.idUsuario,d.nombreDocumentoDeAprobacion,b.activado,b.idOrganismo,(SELECT a1.observacion FROM poa_observaciones AS a1 WHERE a1.idOrganismo=b.idOrganismo AND a1.tipoObservacion='aprobacionUsuario' ORDER BY a1.idObservaciones DESC LIMIT 1) AS observacionAprobacion, (SELECT a1.estado FROM poa_observaciones AS a1 WHERE a1.idOrganismo=b.idOrganismo AND a1.tipoObservacion='aprobacionUsuario' ORDER BY a1.idObservaciones DESC LIMIT 1) AS estadoAprobacion FROM poa_usuario AS a INNER JOIN poa_organismo AS b ON a.idUsuario=b.idUsuario INNER JOIN poa_organismo_acuerdo_ministerial AS c ON c.idOrganismo=b.idOrganismo LEFT JOIN poa_organismo_documento_aprobacion AS d ON d.idOrganismo=b.idOrganismo WHERE b.activado='I';";

			$dataTablets=$objeto->getDatatablets($query);

			echo json_encode($dataTablets);

		break;

		case "tablaLineaP":

			$query="SELECT nombreLinea,idLineas FROM poa_linea_base WHERE estado='A' AND nombreLinea!='' ORDER BY idLineas ASC;";

			$dataTablets=$objeto->getDatatablets($query);

			echo json_encode($dataTablets);

		break;

		case "tablaPrograma":

			$query="SELECT nombrePrograma,idPrograma FROM poa_programa WHERE estado='A' AND nombrePrograma!='';";

			$dataTablets=$objeto->getDatatablets($query);

			echo json_encode($dataTablets);

		break;

		case "tablaIndicadores":

			$query="SELECT nombreIndicador,idIndicadores FROM poa_indicadores WHERE estado='A' AND nombreIndicador!='';";

			$dataTablets=$objeto->getDatatablets($query);

			echo json_encode($dataTablets);

		break;

		case "tablaDeportes":

			$query="SELECT nombreDeporte,idDeporte FROM poa_deporte WHERE estado='A' AND nombreDeporte!='';";

			$dataTablets=$objeto->getDatatablets($query);

			echo json_encode($dataTablets);

		break;


		case "tablaAlcance":

			$query="SELECT nombreAlcanse,idAlcanse FROM poa_alcanse WHERE estado='A' AND nombreAlcanse!='';";

			$dataTablets=$objeto->getDatatablets($query);

			echo json_encode($dataTablets);

		break;


		case "tablaFinanciamiento":

			$query="SELECT nombreTipo,idTipo FROM poa_tipo WHERE estado='A' AND nombreTipo!='';";

			$dataTablets=$objeto->getDatatablets($query);

			echo json_encode($dataTablets);

		break;


		case "tablaCargo":

			$query="SELECT nombreCargo,idCargo FROM poa_cargo WHERE nombreCargo!='';";

			$dataTablets=$objeto->getDatatablets($query);

			echo json_encode($dataTablets);

		break;				

		case "tablaObjetivo":

			$query="SELECT a.nombreObjetivo,a.idObjetivos,c.nombrePrograma,c.idPrograma FROM poa_objetivos AS a INNER JOIN poa_objetivos_usuario AS b ON a.idObjetivos=b.idObjetivos LEFT JOIN poa_programa AS c ON c.idPrograma=b.idPrograma WHERE a.nombreObjetivo!='';";

			$dataTablets=$objeto->getDatatablets($query);

			echo json_encode($dataTablets);

		break;		


		case "tablaTipoOrganismo":

			$query="SELECT a.nombreTipo,a.idTipoOrganismo,b.accion,c.nombreObjetivo,d.nombreArea,a.idAreaAccion,a.idObjetivos,a.idAreaEncargada FROM poa_tipo_organismo AS a INNER JOIN poa_area_accion AS b ON a.idAreaAccion=b.idAreaAccion INNER JOIN poa_objetivos AS c ON c.idObjetivos=a.idObjetivos INNER JOIN poa_areaencargada AS d ON a.idAreaEncargada=d.idAreaEncargada WHERE a.nombreTipo!='';";

			$dataTablets=$objeto->getDatatablets($query);

			echo json_encode($dataTablets);

		break;		


		case "tablaAreaAccion":

			$query="SELECT accion,idAreaAccion FROM poa_area_accion WHERE estado='A' AND accion!='';";

			$dataTablets=$objeto->getDatatablets($query);

			echo json_encode($dataTablets);

		break;		


		case "tablaAreaEncargada":

			$query="SELECT nombreArea,idAreaEncargada FROM poa_areaencargada WHERE estado='A';";

			$dataTablets=$objeto->getDatatablets($query);

			echo json_encode($dataTablets);

		break;		

		case "asignarPresupuestoMo":

			switch ($datos[1]) {

				case 1:
						
					$variableZonal="PLANTA CENTRAL";

				break;


				case 2:
						
					$variableZonal="ZONAL 1";

				break;

				case 3:
						
					$variableZonal="ZONAL 2";

				break;

				case 4:
						
					$variableZonal="ZONAL 3";

				break;

				case 5:
						
					$variableZonal="ZONAL 4";

				break;


				case 7:
						
					$variableZonal="ZONAL 6";

				break;

				case 8:					
					$variableZonal="ZONAL 7";
				break;


				case 9:	
					$variableZonal="ZONAL 8";
				break;


			}		

			if ($datos[2]==1) {
				$query="SELECT a.ruc,a.nombreOrganismo,a.correo,(SELECT telefono FROM poa_usuario AS a1 WHERE a1.idUsuario=a.idUsuario LIMIT 1) AS telefonoOficina,a.idOrganismo,(SELECT a2.nombreInversion FROM poa_inversion_usuario AS a1 INNER JOIN poa_inversion AS a2 ON a1.idInversion=a2.idInversion WHERE a1.idOrganismo=a.idOrganismo ORDER BY a2.idInversion DESC LIMIT 1) AS nombreInversion, (SELECT a2.idInversion FROM poa_inversion_usuario AS a1 INNER JOIN poa_inversion AS a2 ON a1.idInversion=a2.idInversion WHERE a1.idOrganismo=a.idOrganismo ORDER BY a2.idInversion DESC LIMIT 1) AS idInversion FROM poa_organismo AS a  WHERE a.activado='A' AND (a.periodo IS NOT NULL OR a.periodo='I') GROUP BY a.idOrganismo;";
			}else{

				$query="SELECT a.ruc,a.nombreOrganismo,a.correo,(SELECT telefono FROM poa_usuario AS a1 WHERE a1.idUsuario=a.idUsuario LIMIT 1) AS telefonoOficina,a.idOrganismo,(SELECT a2.nombreInversion FROM poa_inversion_usuario AS a1 INNER JOIN poa_inversion AS a2 ON a1.idInversion=a2.idInversion WHERE a1.idOrganismo=a.idOrganismo ORDER BY a2.idInversion DESC LIMIT 1) AS nombreInversion, (SELECT a2.idInversion FROM poa_inversion_usuario AS a1 INNER JOIN poa_inversion AS a2 ON a1.idInversion=a2.idInversion WHERE a1.idOrganismo=a.idOrganismo ORDER BY a2.idInversion DESC LIMIT 1) AS idInversion FROM poa_organismo AS a  WHERE a.activado='A' AND (a.periodo IS NOT NULL OR a.periodo='I') GROUP BY a.idOrganismo;";

			}

			$dataTablets=$objeto->getDatatablets($query);

			echo json_encode($dataTablets);

		break;			

		case "asignarPresupuesto":

			switch ($datos[1]) {

				case 1:
						
					$variableZonal="PLANTA CENTRAL";

				break;


				case 2:
						
					$variableZonal="ZONAL 1";

				break;

				case 3:
						
					$variableZonal="ZONAL 2";

				break;

				case 4:
						
					$variableZonal="ZONAL 3";

				break;

				case 5:
						
					$variableZonal="ZONAL 4";

				break;


				case 7:
						
					$variableZonal="ZONAL 6";

				break;

				case 8:					
					$variableZonal="ZONAL 7";
				break;


				case 9:	
					$variableZonal="ZONAL 8";
				break;


			}		

			if ($datos[2]==1) {
				$query="SELECT a.ruc,a.nombreOrganismo,a.correo,(SELECT telefono FROM poa_usuario AS a1 WHERE a1.idUsuario=a.idUsuario LIMIT 1) AS telefonoOficina,IF(c.nombreTipo IS NULL, 'r. Asociaciones Metropolitanas de Ligas Parroquiales Rurales',c.nombreTipo) AS tipoOrganismo,a.idOrganismo,c.idTipoOrganismo,(SELECT UPPER(a1.nombreProvincia) FROM in_md_provincias AS a1 WHERE a1.idProvincia=a.idProvincia) AS provincia,a.cedulaResponsable,a.nombreResponsablePoa FROM poa_organismo AS a LEFT JOIN poa_competencia_organismo_competencia AS b ON a.idOrganismo=b.idOrganismo LEFT JOIN poa_tipo_organismo AS c ON c.idTipoOrganismo=b.idTipoOrganismo WHERE a.activado='A' AND (a.periodo IS NULL OR a.periodo='I') GROUP BY a.idOrganismo;";
			}else{

				$query="SELECT a.ruc,a.nombreOrganismo,a.correo,(SELECT telefono FROM poa_usuario AS a1 WHERE a1.idUsuario=a.idUsuario LIMIT 1) AS telefonoOficina,IF(c.nombreTipo IS NULL, 'r. Asociaciones Metropolitanas de Ligas Parroquiales Rurales',c.nombreTipo) AS tipoOrganismo,a.idOrganismo,c.idTipoOrganismo,(SELECT UPPER(a1.nombreProvincia) FROM in_md_provincias AS a1 WHERE a1.idProvincia=a.idProvincia) AS provincia,a.cedulaResponsable,a.nombreResponsablePoa FROM poa_organismo AS a LEFT JOIN poa_competencia_organismo_competencia AS b ON a.idOrganismo=b.idOrganismo LEFT JOIN poa_tipo_organismo AS c ON c.idTipoOrganismo=b.idTipoOrganismo WHERE a.activado='A' AND (a.periodo IS NULL OR a.periodo='I') GROUP BY a.idOrganismo;";

			}

			$dataTablets=$objeto->getDatatablets($query);

			echo json_encode($dataTablets);

		break;	


		case "organismoSubsesReInsta":

			$query="SELECT a.ruc,  REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(a.nombreOrganismo, 'Ã¡', 'á'),'Ã©','é'),'Ã­','í'),'Ã³','ó'),'Ãº','ú'),'Ã‰','É'),'ÃŒ','Í'),'Ã“','Ó'),'Ãš','Ú'),'Ã±','ñ'),'Ã‘','Ñ'),'&#039;',' ` '),'Ã','Á'),'',' '),'Ã','Á'),'SI','SI'),'â€œ',''),'â€',''),'Á²','ó') AS nombreOrganismo, a.correo, a.telefonoOficina,d.nombreTipo, a.nombreResponsablePoa, b.fecha, a.idOrganismo, d.idTipoOrganismo, (SELECT a1.documento FROM poa_concluciones AS a1 WHERE a1.idOrganismo=a.idOrganismo ORDER BY a1.idObservacionesTecnicas DESC LIMIT 1) AS documentoAs FROM poa_organismo AS a INNER JOIN poa_preliminar_envio AS b ON a.idOrganismo=b.idOrganismo INNER JOIN poa_competencia_organismo_competencia AS c ON c.idOrganismo=a.idOrganismo INNER JOIN poa_tipo_organismo AS d ON d.idTipoOrganismo=c.idTipoOrganismo WHERE b.instalaciones='T' AND b.instalacionesE='".$datos[0]."';";

			$dataTablets=$objeto->getDatatablets2($query);
			echo json_encode($dataTablets);

		break;


		case "organismosActivosPre":

			$query="SELECT a.ruc,REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(a.nombreOrganismo, 'Ã¡', 'á'),'Ã©','é'),'Ã­','í'),'Ã³','ó'),'Ãº','ú'),'Ã‰','É'),'ÃŒ','Í'),'Ã“','Ó'),'Ãš','Ú'),'Ã±','ñ'),'Ã‘','Ñ'),'&#039;',' ` '),'Ã','Á'),'',' '),'Ã','Á'),'SI','SI'),'â€œ',''),'â€',''),'Á²','ó') AS nombreOrganismo,CONCAT_WS(';;;;',if(financiero IS NOT NULL AND financiero!='T',(SELECT CONCAT_WS(' ','Administrativo: ',REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(a1.nombre, 'Ã¡', 'á'),'Ã©','é'),'Ã­','í'),'Ã³','ó'),'Ãº','ú'),'Ã‰','É'),'ÃŒ','Í'),'Ã“','Ó'),'Ãš','Ú'),'Ã±','ñ'),'Ã‘','Ñ'),'&#039;',' ` '),'Ã','Á'),'',' '),'Ã','Á'),'SI','SI'),'â€œ',''),'â€',''),'Á²','ó') ,REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(a1.apellido, 'Ã¡', 'á'),'Ã©','é'),'Ã­','í'),'Ã³','ó'),'Ãº','ú'),'Ã‰','É'),'ÃŒ','Í'),'Ã“','Ó'),'Ãš','Ú'),'Ã±','ñ'),'Ã‘','Ñ'),'&#039;',' ` '),'Ã','Á'),'',' '),'Ã','Á'),'SI','SI'),'â€œ',''),'â€',''),'Á²','ó') ) FROM th_usuario AS a1 WHERE a1.id_usuario=b.financiero),' '),if(financiero2 IS NOT NULL AND financiero2!='T',(SELECT CONCAT_WS(' ','Talento humano: ',REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(a1.nombre, 'Ã¡', 'á'),'Ã©','é'),'Ã­','í'),'Ã³','ó'),'Ãº','ú'),'Ã‰','É'),'ÃŒ','Í'),'Ã“','Ó'),'Ãš','Ú'),'Ã±','ñ'),'Ã‘','Ñ'),'&#039;',' ` '),'Ã','Á'),'',' '),'Ã','Á'),'SI','SI'),'â€œ',''),'â€',''),'Á²','ó') ,REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(a1.apellido, 'Ã¡', 'á'),'Ã©','é'),'Ã­','í'),'Ã³','ó'),'Ãº','ú'),'Ã‰','É'),'ÃŒ','Í'),'Ã“','Ó'),'Ãš','Ú'),'Ã±','ñ'),'Ã‘','Ñ'),'&#039;',' ` '),'Ã','Á'),'',' '),'Ã','Á'),'SI','SI'),'â€œ',''),'â€',''),'Á²','ó') ) FROM th_usuario AS a1 WHERE a1.id_usuario=b.financiero2),' '),if(instalaciones IS NOT NULL AND instalaciones!='T',(SELECT CONCAT_WS(' ','Instalaciones: ',REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(a1.nombre, 'Ã¡', 'á'),'Ã©','é'),'Ã­','í'),'Ã³','ó'),'Ãº','ú'),'Ã‰','É'),'ÃŒ','Í'),'Ã“','Ó'),'Ãš','Ú'),'Ã±','ñ'),'Ã‘','Ñ'),'&#039;',' ` '),'Ã','Á'),'',' '),'Ã','Á'),'SI','SI'),'â€œ',''),'â€',''),'Á²','ó') ,REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(a1.apellido, 'Ã¡', 'á'),'Ã©','é'),'Ã­','í'),'Ã³','ó'),'Ãº','ú'),'Ã‰','É'),'ÃŒ','Í'),'Ã“','Ó'),'Ãš','Ú'),'Ã±','ñ'),'Ã‘','Ñ'),'&#039;',' ` '),'Ã','Á'),'',' '),'Ã','Á'),'SI','SI'),'â€œ',''),'â€',''),'Á²','ó') ) FROM th_usuario AS a1 WHERE a1.id_usuario=b.instalaciones),' '),if(instlaaciones2 IS NOT NULL AND instlaaciones2!='T',(SELECT CONCAT_WS(' ','Infraestructura: ',REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(a1.nombre, 'Ã¡', 'á'),'Ã©','é'),'Ã­','í'),'Ã³','ó'),'Ãº','ú'),'Ã‰','É'),'ÃŒ','Í'),'Ã“','Ó'),'Ãš','Ú'),'Ã±','ñ'),'Ã‘','Ñ'),'&#039;',' ` '),'Ã','Á'),'',' '),'Ã','Á'),'SI','SI'),'â€œ',''),'â€',''),'Á²','ó') ,REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(a1.apellido, 'Ã¡', 'á'),'Ã©','é'),'Ã­','í'),'Ã³','ó'),'Ãº','ú'),'Ã‰','É'),'ÃŒ','Í'),'Ã“','Ó'),'Ãš','Ú'),'Ã±','ñ'),'Ã‘','Ñ'),'&#039;',' ` '),'Ã','Á'),'',' '),'Ã','Á'),'SI','SI'),'â€œ',''),'â€',''),'Á²','ó') ) FROM th_usuario AS a1 WHERE a1.id_usuario=b.instlaaciones2),' '),if(subsecretaria IS NOT NULL AND subsecretaria!='T',(SELECT CONCAT_WS(' ','Subsecretaría: ',REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(a1.nombre, 'Ã¡', 'á'),'Ã©','é'),'Ã­','í'),'Ã³','ó'),'Ãº','ú'),'Ã‰','É'),'ÃŒ','Í'),'Ã“','Ó'),'Ãš','Ú'),'Ã±','ñ'),'Ã‘','Ñ'),'&#039;',' ` '),'Ã','Á'),'',' '),'Ã','Á'),'SI','SI'),'â€œ',''),'â€',''),'Á²','ó') ,REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(a1.apellido, 'Ã¡', 'á'),'Ã©','é'),'Ã­','í'),'Ã³','ó'),'Ãº','ú'),'Ã‰','É'),'ÃŒ','Í'),'Ã“','Ó'),'Ãš','Ú'),'Ã±','ñ'),'Ã‘','Ñ'),'&#039;',' ` '),'Ã','Á'),'',' '),'Ã','Á'),'SI','SI'),'â€œ',''),'â€',''),'Á²','ó') ) FROM th_usuario AS a1 WHERE a1.id_usuario=b.subsecretaria),' ')) AS custodioUno,CONCAT_WS(';;;;',if(financieroE IS NOT NULL AND financiero='T',(SELECT CONCAT_WS(' ','Administrativo: ',REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(a1.nombre, 'Ã¡', 'á'),'Ã©','é'),'Ã­','í'),'Ã³','ó'),'Ãº','ú'),'Ã‰','É'),'ÃŒ','Í'),'Ã“','Ó'),'Ãš','Ú'),'Ã±','ñ'),'Ã‘','Ñ'),'&#039;',' ` '),'Ã','Á'),'',' '),'Ã','Á'),'SI','SI'),'â€œ',''),'â€',''),'Á²','ó') ,REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(a1.apellido, 'Ã¡', 'á'),'Ã©','é'),'Ã­','í'),'Ã³','ó'),'Ãº','ú'),'Ã‰','É'),'ÃŒ','Í'),'Ã“','Ó'),'Ãš','Ú'),'Ã±','ñ'),'Ã‘','Ñ'),'&#039;',' ` '),'Ã','Á'),'',' '),'Ã','Á'),'SI','SI'),'â€œ',''),'â€',''),'Á²','ó') ) FROM th_usuario AS a1 WHERE a1.id_usuario=b.financieroE),' '),if(financieroE2 IS NOT NULL AND financiero2='T',(SELECT CONCAT_WS(' ','Talento humano: ',REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(a1.nombre, 'Ã¡', 'á'),'Ã©','é'),'Ã­','í'),'Ã³','ó'),'Ãº','ú'),'Ã‰','É'),'ÃŒ','Í'),'Ã“','Ó'),'Ãš','Ú'),'Ã±','ñ'),'Ã‘','Ñ'),'&#039;',' ` '),'Ã','Á'),'',' '),'Ã','Á'),'SI','SI'),'â€œ',''),'â€',''),'Á²','ó') ,REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(a1.apellido, 'Ã¡', 'á'),'Ã©','é'),'Ã­','í'),'Ã³','ó'),'Ãº','ú'),'Ã‰','É'),'ÃŒ','Í'),'Ã“','Ó'),'Ãš','Ú'),'Ã±','ñ'),'Ã‘','Ñ'),'&#039;',' ` '),'Ã','Á'),'',' '),'Ã','Á'),'SI','SI'),'â€œ',''),'â€',''),'Á²','ó') ) FROM th_usuario AS a1 WHERE a1.id_usuario=b.financieroE2),' '),if(instalacionesE IS NOT NULL AND instalaciones='T',(SELECT CONCAT_WS(' ','Instalaciones: ',REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(a1.nombre, 'Ã¡', 'á'),'Ã©','é'),'Ã­','í'),'Ã³','ó'),'Ãº','ú'),'Ã‰','É'),'ÃŒ','Í'),'Ã“','Ó'),'Ãš','Ú'),'Ã±','ñ'),'Ã‘','Ñ'),'&#039;',' ` '),'Ã','Á'),'',' '),'Ã','Á'),'SI','SI'),'â€œ',''),'â€',''),'Á²','ó') ,REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(a1.apellido, 'Ã¡', 'á'),'Ã©','é'),'Ã­','í'),'Ã³','ó'),'Ãº','ú'),'Ã‰','É'),'ÃŒ','Í'),'Ã“','Ó'),'Ãš','Ú'),'Ã±','ñ'),'Ã‘','Ñ'),'&#039;',' ` '),'Ã','Á'),'',' '),'Ã','Á'),'SI','SI'),'â€œ',''),'â€',''),'Á²','ó') ) FROM th_usuario AS a1 WHERE a1.id_usuario=b.instalacionesE),' '),if(instalacionesE2 IS NOT NULL AND instlaaciones2='T',(SELECT CONCAT_WS(' ','Infraestructura: ',REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(a1.nombre, 'Ã¡', 'á'),'Ã©','é'),'Ã­','í'),'Ã³','ó'),'Ãº','ú'),'Ã‰','É'),'ÃŒ','Í'),'Ã“','Ó'),'Ãš','Ú'),'Ã±','ñ'),'Ã‘','Ñ'),'&#039;',' ` '),'Ã','Á'),'',' '),'Ã','Á'),'SI','SI'),'â€œ',''),'â€',''),'Á²','ó') ,REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(a1.apellido, 'Ã¡', 'á'),'Ã©','é'),'Ã­','í'),'Ã³','ó'),'Ãº','ú'),'Ã‰','É'),'ÃŒ','Í'),'Ã“','Ó'),'Ãš','Ú'),'Ã±','ñ'),'Ã‘','Ñ'),'&#039;',' ` '),'Ã','Á'),'',' '),'Ã','Á'),'SI','SI'),'â€œ',''),'â€',''),'Á²','ó') ) FROM th_usuario AS a1 WHERE a1.id_usuario=b.instalacionesE2),' '),if(subsecretariaE IS NOT NULL AND subsecretaria='T',(SELECT CONCAT_WS(' ','Subsecretaría: ',REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(a1.nombre, 'Ã¡', 'á'),'Ã©','é'),'Ã­','í'),'Ã³','ó'),'Ãº','ú'),'Ã‰','É'),'ÃŒ','Í'),'Ã“','Ó'),'Ãš','Ú'),'Ã±','ñ'),'Ã‘','Ñ'),'&#039;',' ` '),'Ã','Á'),'',' '),'Ã','Á'),'SI','SI'),'â€œ',''),'â€',''),'Á²','ó') ,REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(a1.apellido, 'Ã¡', 'á'),'Ã©','é'),'Ã­','í'),'Ã³','ó'),'Ãº','ú'),'Ã‰','É'),'ÃŒ','Í'),'Ã“','Ó'),'Ãš','Ú'),'Ã±','ñ'),'Ã‘','Ñ'),'&#039;',' ` '),'Ã','Á'),'',' '),'Ã','Á'),'SI','SI'),'â€œ',''),'â€',''),'Á²','ó') ) FROM th_usuario AS a1 WHERE a1.id_usuario=b.subsecretariaE),' ')) AS custodioDos, a.telefonoOficina,REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(d.nombreTipo, 'Ã¡', 'á'),'Ã©','é'),'Ã­','í'),'Ã³','ó'),'Ãº','ú'),'Ã‰','É'),'ÃŒ','Í'),'Ã“','Ó'),'Ãš','Ú'),'Ã±','ñ'),'Ã‘','Ñ'),'&#039;',' ` '),'Ã','Á'),'',' '),'Ã','Á'),'SI','SI'),'â€œ',''),'â€',''),'Á²','ó') AS nombreTipo, b.fecha FROM poa_organismo AS a INNER JOIN poa_preliminar_envio AS b ON a.idOrganismo=b.idOrganismo INNER JOIN poa_competencia_organismo_competencia AS c ON c.idOrganismo=a.idOrganismo INNER JOIN poa_tipo_organismo AS d ON d.idTipoOrganismo=c.idTipoOrganismo WHERE (b.financiero IS NOT NULL OR b.financiero2 IS NOT NULL OR b.instalaciones IS NOT NULL OR b.instlaaciones2 IS NOT NULL OR b.subsecretaria IS NOT NULL) AND b.subsecretaria!='sF' AND b.subsecretaria!='sA';";

			$dataTablets=$objeto->getDatatablets2($query);
			echo json_encode($dataTablets);

		break;


		case "organismoSubsesReInfra":

			$query="SELECT a.ruc,  REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(a.nombreOrganismo, 'Ã¡', 'á'),'Ã©','é'),'Ã­','í'),'Ã³','ó'),'Ãº','ú'),'Ã‰','É'),'ÃŒ','Í'),'Ã“','Ó'),'Ãš','Ú'),'Ã±','ñ'),'Ã‘','Ñ'),'&#039;',' ` '),'Ã','Á'),'',' '),'Ã','Á'),'SI','SI'),'â€œ',''),'â€',''),'Á²','ó') AS nombreOrganismo, a.correo, a.telefonoOficina,d.nombreTipo, a.nombreResponsablePoa, b.fecha, a.idOrganismo, d.idTipoOrganismo, IF((SELECT a1.documento FROM poa_concluciones AS a1 WHERE a1.idOrganismo=a.idOrganismo AND (a1.documento LIKE '%i__27__3.pdf%' OR a1.documento LIKE '%i__28__3.pdf%' OR a1.documento LIKE '%i__29__3.pdf%' OR a1.documento LIKE '%i__30__3.pdf%' OR a1.documento LIKE '%i__31__3.pdf%' OR a1.documento LIKE '%i__32__3.pdf%' OR a1.documento LIKE '%i__33__3.pdf%') AND a1.idOrganismo=a.idOrganismo ORDER BY a1.idObservacionesTecnicas DESC LIMIT 1) IS NOT NULL,(SELECT a1.documento FROM poa_concluciones AS a1 WHERE a1.idOrganismo=a.idOrganismo AND (a1.documento LIKE '%i__27__3.pdf%' OR a1.documento LIKE '%i__28__3.pdf%' OR a1.documento LIKE '%i__29__3.pdf%' OR a1.documento LIKE '%i__30__3.pdf%' OR a1.documento LIKE '%i__31__3.pdf%' OR a1.documento LIKE '%i__32__3.pdf%' OR a1.documento LIKE '%i__33__3.pdf%') AND a1.idOrganismo=a.idOrganismo ORDER BY a1.idObservacionesTecnicas DESC LIMIT 1),(SELECT a1.documento FROM poa_concluciones AS a1 WHERE a1.idOrganismo=a.idOrganismo ORDER BY a1.idObservacionesTecnicas DESC LIMIT 1)) AS documentoAs FROM poa_organismo AS a INNER JOIN poa_preliminar_envio AS b ON a.idOrganismo=b.idOrganismo INNER JOIN poa_competencia_organismo_competencia AS c ON c.idOrganismo=a.idOrganismo INNER JOIN poa_tipo_organismo AS d ON d.idTipoOrganismo=c.idTipoOrganismo WHERE b.instlaaciones2='T' AND b.instalacionesE2='".$datos[0]."';";

			$dataTablets=$objeto->getDatatablets2($query);
			echo json_encode($dataTablets);

		break;

		case "organismoSubsesReAdminis":

			if ($datos[2]=="5") {
				$buscador="5__2";
			}else{
				$buscador="7__2";
			}


			$query="SELECT a.ruc,  REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(a.nombreOrganismo, 'Ã¡', 'á'),'Ã©','é'),'Ã­','í'),'Ã³','ó'),'Ãº','ú'),'Ã‰','É'),'ÃŒ','Í'),'Ã“','Ó'),'Ãš','Ú'),'Ã±','ñ'),'Ã‘','Ñ'),'&#039;',' ` '),'Ã','Á'),'',' '),'Ã','Á'),'SI','SI'),'â€œ',''),'â€',''),'Á²','ó') AS nombreOrganismo, a.correo, a.telefonoOficina,d.nombreTipo, a.nombreResponsablePoa, b.fecha, a.idOrganismo, d.idTipoOrganismo, (SELECT a1.documento FROM poa_concluciones AS a1 WHERE a1.idOrganismo=a.idOrganismo AND a1.documento LIKE '%__5__2.pdf%' ORDER BY a1.idObservacionesTecnicas DESC LIMIT 1) AS documentoAs FROM poa_organismo AS a INNER JOIN poa_preliminar_envio AS b ON a.idOrganismo=b.idOrganismo INNER JOIN poa_competencia_organismo_competencia AS c ON c.idOrganismo=a.idOrganismo INNER JOIN poa_tipo_organismo AS d ON d.idTipoOrganismo=c.idTipoOrganismo WHERE b.financiero='T' AND b.financieroE='".$datos[0]."';";

			$dataTablets=$objeto->getDatatablets2($query);
			echo json_encode($dataTablets);

		break;


		case "organismoSubsesReTalentoHu":

			$query="SELECT a.ruc,  REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(a.nombreOrganismo, 'Ã¡', 'á'),'Ã©','é'),'Ã­','í'),'Ã³','ó'),'Ãº','ú'),'Ã‰','É'),'ÃŒ','Í'),'Ã“','Ó'),'Ãš','Ú'),'Ã±','ñ'),'Ã‘','Ñ'),'&#039;',' ` '),'Ã','Á'),'',' '),'Ã','Á'),'SI','SI'),'â€œ',''),'â€',''),'Á²','ó') AS nombreOrganismo, a.correo, a.telefonoOficina,d.nombreTipo, a.nombreResponsablePoa, b.fecha, a.idOrganismo, d.idTipoOrganismo, (SELECT a1.documento FROM poa_concluciones AS a1 WHERE a1.idOrganismo=a.idOrganismo AND (a1.documento LIKE '%__7__2.pdf%' OR a1.documento LIKE '%__27__4.pdf%' OR a1.documento LIKE '%__28__4.pdf%' OR a1.documento LIKE '%__29__4.pdf%' OR a1.documento LIKE '%__30__4.pdf%' OR a1.documento LIKE '%__31__4.pdf%' OR a1.documento LIKE '%__32__4.pdf%' OR a1.documento LIKE '%__33__4.pdf%') ORDER BY a1.idObservacionesTecnicas DESC LIMIT 1) AS documentoAs FROM poa_organismo AS a INNER JOIN poa_preliminar_envio AS b ON a.idOrganismo=b.idOrganismo INNER JOIN poa_competencia_organismo_competencia AS c ON c.idOrganismo=a.idOrganismo INNER JOIN poa_tipo_organismo AS d ON d.idTipoOrganismo=c.idTipoOrganismo WHERE b.financiero2='T' AND b.financieroE2='".$datos[0]."' GROUP BY a.idOrganismo;";


			$dataTablets=$objeto->getDatatablets2($query);
			echo json_encode($dataTablets);

		break;

		case "organismoSubsesRe":

			if ($datos[2]=="24" && $datos[1]=="7") {

				$buscador="14__2";
				$buscador2="12__2";

				

				// $query="SELECT a.ruc,  REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(a.nombreOrganismo, 'Ã¡', 'á'),'Ã©','é'),'Ã­','í'),'Ã³','ó'),'Ãº','ú'),'Ã‰','É'),'ÃŒ','Í'),'Ã“','Ó'),'Ãš','Ú'),'Ã±','ñ'),'Ã‘','Ñ'),'&#039;',' ` '),'Ã','Á'),'',' '),'Ã','Á'),'SI','SI'),'â€œ',''),'â€',''),'Á²','ó') AS nombreOrganismo, a.correo, a.telefonoOficina,d.nombreTipo, a.nombreResponsablePoa, b.fecha, a.idOrganismo, d.idTipoOrganismo, (SELECT a1.documento FROM poa_concluciones AS a1 WHERE a1.idOrganismo=a.idOrganismo AND a1.documento LIKE '%$buscador%' OR  a1.documento LIKE '%$buscador2%' ORDER BY a1.idObservacionesTecnicas DESC LIMIT 1) AS documentoAs FROM poa_organismo AS a INNER JOIN poa_preliminar_envio AS b ON a.idOrganismo=b.idOrganismo INNER JOIN poa_competencia_organismo_competencia AS c ON c.idOrganismo=a.idOrganismo INNER JOIN poa_tipo_organismo AS d ON d.idTipoOrganismo=c.idTipoOrganismo WHERE b.subsecretaria='T' AND b.subsecretariaE='".$datos[0]."';";

				$query="SELECT a.ruc,  REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(a.nombreOrganismo, 'Ã¡', 'á'),'Ã©','é'),'Ã­','í'),'Ã³','ó'),'Ãº','ú'),'Ã‰','É'),'ÃŒ','Í'),'Ã“','Ó'),'Ãš','Ú'),'Ã±','ñ'),'Ã‘','Ñ'),'&#039;',' ` '),'Ã','Á'),'',' '),'Ã','Á'),'SI','SI'),'â€œ',''),'â€',''),'Á²','ó') AS nombreOrganismo, a.correo, a.telefonoOficina,d.nombreTipo, a.nombreResponsablePoa, b.fecha, a.idOrganismo, d.idTipoOrganismo, (SELECT a1.documento FROM poa_concluciones AS a1 WHERE a1.idOrganismo=a.idOrganismo  ORDER BY a1.idObservacionesTecnicas DESC LIMIT 1) AS documentoAs FROM poa_organismo AS a INNER JOIN poa_preliminar_envio AS b ON a.idOrganismo=b.idOrganismo INNER JOIN poa_competencia_organismo_competencia AS c ON c.idOrganismo=a.idOrganismo INNER JOIN poa_tipo_organismo AS d ON d.idTipoOrganismo=c.idTipoOrganismo WHERE b.subsecretaria='T' AND b.subsecretariaE='".$datos[0]."';";



			}else if($datos[2]=="26" && $datos[1]=="7"){


				$buscador="13__2";
				$buscador2="19__2";

				/*===============================
				=            Zonales            =
				===============================*/
				
				$buscador3="27__4";
				$buscador4="28__4";
				$buscador5="29__4";
				$buscador6="30__4";
				$buscador7="31__4";
				$buscador8="32__4";
				$buscador9="33__4";

				
				/*=====  End of Zonales  ======*/


				// $query="SELECT a.ruc,  REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(a.nombreOrganismo, 'Ã¡', 'á'),'Ã©','é'),'Ã­','í'),'Ã³','ó'),'Ãº','ú'),'Ã‰','É'),'ÃŒ','Í'),'Ã“','Ó'),'Ãš','Ú'),'Ã±','ñ'),'Ã‘','Ñ'),'&#039;',' ` '),'Ã','Á'),'',' '),'Ã','Á'),'SI','SI'),'â€œ',''),'â€',''),'Á²','ó') AS nombreOrganismo, a.correo, a.telefonoOficina,d.nombreTipo, a.nombreResponsablePoa, b.fecha, a.idOrganismo, d.idTipoOrganismo, (SELECT a1.documento FROM poa_concluciones AS a1 WHERE a1.idOrganismo=a.idOrganismo AND a1.documento LIKE '%$buscador%' OR a1.documento LIKE '%$buscador2%' OR a1.documento LIKE '%$buscador3%' OR a1.documento LIKE '%$buscador4%' OR a1.documento LIKE '%$buscador5%' OR a1.documento LIKE '%$buscador6%' OR a1.documento LIKE '%$buscador7%' OR a1.documento LIKE '%$buscador8%' OR a1.documento LIKE '%$buscador9%' ORDER BY a1.idObservacionesTecnicas DESC LIMIT 1) AS documentoAs FROM poa_organismo AS a INNER JOIN poa_preliminar_envio AS b ON a.idOrganismo=b.idOrganismo INNER JOIN poa_competencia_organismo_competencia AS c ON c.idOrganismo=a.idOrganismo INNER JOIN poa_tipo_organismo AS d ON d.idTipoOrganismo=c.idTipoOrganismo WHERE b.subsecretaria='T' AND b.subsecretariaE='".$datos[0]."';";

				$query="SELECT a.ruc,  REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(a.nombreOrganismo, 'Ã¡', 'á'),'Ã©','é'),'Ã­','í'),'Ã³','ó'),'Ãº','ú'),'Ã‰','É'),'ÃŒ','Í'),'Ã“','Ó'),'Ãš','Ú'),'Ã±','ñ'),'Ã‘','Ñ'),'&#039;',' ` '),'Ã','Á'),'',' '),'Ã','Á'),'SI','SI'),'â€œ',''),'â€',''),'Á²','ó') AS nombreOrganismo, a.correo, a.telefonoOficina,d.nombreTipo, a.nombreResponsablePoa, b.fecha, a.idOrganismo, d.idTipoOrganismo, (SELECT a1.documento FROM poa_concluciones AS a1 WHERE a1.idOrganismo=a.idOrganismo  AND a1.documento NOT LIKE '%__7__2.pdf' AND a1.documento NOT LIKE '%__5__2.pdf' AND a1.documento NOT LIKE '%__5__3.pdf'  AND a1.documento NOT LIKE '%__7__3.pdf' AND a1.documento NOT LIKE '%__2___7__4.pdf' AND a1.documento NOT LIKE '%__5__4.pdf' AND a1.documento NOT LIKE '%__6__4.pdf' AND a1.documento NOT LIKE '%__15__4.pdf' AND a1.documento NOT LIKE '%__6__2.pdf' AND a1.documento NOT LIKE '%__15__2.pdf' AND a1.documento NOT LIKE '%__6__3.pdf' AND a1.documento NOT LIKE '%__15__3.pdf' AND a1.idOrganismo=a.idOrganismo  ORDER BY a1.idObservacionesTecnicas DESC LIMIT 1) AS documentoAs FROM poa_organismo AS a INNER JOIN poa_preliminar_envio AS b ON a.idOrganismo=b.idOrganismo INNER JOIN poa_competencia_organismo_competencia AS c ON c.idOrganismo=a.idOrganismo INNER JOIN poa_tipo_organismo AS d ON d.idTipoOrganismo=c.idTipoOrganismo WHERE b.subsecretaria='T' AND b.subsecretariaE='".$datos[0]."';";

			}else if($datos[2]=="2" && $datos[1]=="4"){

				$query="SELECT a.ruc,  REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(a.nombreOrganismo, 'Ã¡', 'á'),'Ã©','é'),'Ã­','í'),'Ã³','ó'),'Ãº','ú'),'Ã‰','É'),'ÃŒ','Í'),'Ã“','Ó'),'Ãš','Ú'),'Ã±','ñ'),'Ã‘','Ñ'),'&#039;',' ` '),'Ã','Á'),'',' '),'Ã','Á'),'SI','SI'),'â€œ',''),'â€',''),'Á²','ó') AS nombreOrganismo, a.correo, a.telefonoOficina,d.nombreTipo, a.nombreResponsablePoa, b.fecha, a.idOrganismo, d.idTipoOrganismo, (SELECT a1.documento FROM poa_concluciones AS a1 WHERE a1.idOrganismo=a.idOrganismo ORDER BY a1.idObservacionesTecnicas DESC LIMIT 1) AS documentoAs FROM poa_organismo AS a INNER JOIN poa_preliminar_envio AS b ON a.idOrganismo=b.idOrganismo INNER JOIN poa_competencia_organismo_competencia AS c ON c.idOrganismo=a.idOrganismo INNER JOIN poa_tipo_organismo AS d ON d.idTipoOrganismo=c.idTipoOrganismo WHERE b.financiero='T' AND b.financieroE='".$datos[0]."';";


			}else if($datos[2]=="1" && $datos[1]=="4"){

				$query="SELECT a.ruc,  REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(a.nombreOrganismo, 'Ã¡', 'á'),'Ã©','é'),'Ã­','í'),'Ã³','ó'),'Ãº','ú'),'Ã‰','É'),'ÃŒ','Í'),'Ã“','Ó'),'Ãš','Ú'),'Ã±','ñ'),'Ã‘','Ñ'),'&#039;',' ` '),'Ã','Á'),'',' '),'Ã','Á'),'SI','SI'),'â€œ',''),'â€',''),'Á²','ó') AS nombreOrganismo, a.correo, a.telefonoOficina,d.nombreTipo, a.nombreResponsablePoa, b.fecha, a.idOrganismo, d.idTipoOrganismo, (SELECT a1.documento FROM poa_concluciones AS a1 WHERE a1.idOrganismo=a.idOrganismo ORDER BY a1.idObservacionesTecnicas DESC LIMIT 1) AS documentoAs FROM poa_organismo AS a INNER JOIN poa_preliminar_envio AS b ON a.idOrganismo=b.idOrganismo INNER JOIN poa_competencia_organismo_competencia AS c ON c.idOrganismo=a.idOrganismo INNER JOIN poa_tipo_organismo AS d ON d.idTipoOrganismo=c.idTipoOrganismo WHERE b.instalaciones='T' AND b.instalacionesE='".$datos[0]."';";

			}else if (($datos[1]=="2" || $datos[1]=="3") && ($datos[2]=="12" || $datos[2]=="13" || $datos[2]=="14" || $datos[2]=="19" || $datos[2]=="13" || $datos[2]=="13" || $datos[2]=="13" || $datos[2]=="13" || $datos[2]=="13")) {

				if ($datos[2]=="13") {
					$buscador="13__3";
				}else if($datos[2]=="14"){
					$buscador="14__3";
				}else if($datos[2]=="19"){
					$buscador="19__3";
				}else if($datos[2]=="12"){
					$buscador="12__3";
				}

				$query="SELECT a.ruc,  REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(a.nombreOrganismo, 'Ã¡', 'á'),'Ã©','é'),'Ã­','í'),'Ã³','ó'),'Ãº','ú'),'Ã‰','É'),'ÃŒ','Í'),'Ã“','Ó'),'Ãš','Ú'),'Ã±','ñ'),'Ã‘','Ñ'),'&#039;',' ` '),'Ã','Á'),'',' '),'Ã','Á'),'SI','SI'),'â€œ',''),'â€',''),'Á²','ó') AS nombreOrganismo, a.correo, a.telefonoOficina,d.nombreTipo, a.nombreResponsablePoa, b.fecha, a.idOrganismo, d.idTipoOrganismo, (SELECT a1.documento FROM poa_concluciones AS a1 WHERE a1.idOrganismo=a.idOrganismo AND a1.documento LIKE '%$buscador%' ORDER BY a1.idObservacionesTecnicas DESC LIMIT 1) AS documentoAs FROM poa_organismo AS a INNER JOIN poa_preliminar_envio AS b ON a.idOrganismo=b.idOrganismo INNER JOIN poa_competencia_organismo_competencia AS c ON c.idOrganismo=a.idOrganismo INNER JOIN poa_tipo_organismo AS d ON d.idTipoOrganismo=c.idTipoOrganismo WHERE b.subsecretaria='T' AND b.subsecretariaE='".$datos[0]."';";


			}else if (($datos[1]=="2" || $datos[1]=="3") && ($datos[2]=="6" || $datos[2]=="15")) {

				if ($datos[2]=="6") {
					$buscador="6__3";
				}else{
					$buscador="15__3";
				}


				$query="SELECT a.ruc,  REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(a.nombreOrganismo, 'Ã¡', 'á'),'Ã©','é'),'Ã­','í'),'Ã³','ó'),'Ãº','ú'),'Ã‰','É'),'ÃŒ','Í'),'Ã“','Ó'),'Ãš','Ú'),'Ã±','ñ'),'Ã‘','Ñ'),'&#039;',' ` '),'Ã','Á'),'',' '),'Ã','Á'),'SI','SI'),'â€œ',''),'â€',''),'Á²','ó') AS nombreOrganismo, a.correo, a.telefonoOficina,d.nombreTipo, a.nombreResponsablePoa, b.fecha, a.idOrganismo, d.idTipoOrganismo, (SELECT a1.documento FROM poa_concluciones AS a1 WHERE a1.idOrganismo=a.idOrganismo AND a1.documento LIKE '%$buscador%' ORDER BY a1.idObservacionesTecnicas DESC LIMIT 1) AS documentoAs FROM poa_organismo AS a INNER JOIN poa_preliminar_envio AS b ON a.idOrganismo=b.idOrganismo INNER JOIN poa_competencia_organismo_competencia AS c ON c.idOrganismo=a.idOrganismo INNER JOIN poa_tipo_organismo AS d ON d.idTipoOrganismo=c.idTipoOrganismo WHERE (b.instalaciones='T' OR b.instlaaciones2='T') AND (b.instalacionesE='".$datos[0]."' OR b.instalacionesE2='".$datos[0]."');";


			}else if (($datos[1]=="2" || $datos[1]=="3") && $datos[2]=="5") {

				if ($datos[2]=="5") {
					$buscador="5__3";
				}else{
					$buscador="7__3";
				}

				$query="SELECT a.ruc,  REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(a.nombreOrganismo, 'Ã¡', 'á'),'Ã©','é'),'Ã­','í'),'Ã³','ó'),'Ãº','ú'),'Ã‰','É'),'ÃŒ','Í'),'Ã“','Ó'),'Ãš','Ú'),'Ã±','ñ'),'Ã‘','Ñ'),'&#039;',' ` '),'Ã','Á'),'',' '),'Ã','Á'),'SI','SI'),'â€œ',''),'â€',''),'Á²','ó') AS nombreOrganismo, a.correo, a.telefonoOficina,d.nombreTipo, a.nombreResponsablePoa, b.fecha, a.idOrganismo, d.idTipoOrganismo, (SELECT a1.documento FROM poa_concluciones AS a1 WHERE a1.idOrganismo=a.idOrganismo AND a1.documento LIKE '%$buscador%' ORDER BY a1.idObservacionesTecnicas DESC LIMIT 1) AS documentoAs FROM poa_organismo AS a INNER JOIN poa_preliminar_envio AS b ON a.idOrganismo=b.idOrganismo INNER JOIN poa_competencia_organismo_competencia AS c ON c.idOrganismo=a.idOrganismo INNER JOIN poa_tipo_organismo AS d ON d.idTipoOrganismo=c.idTipoOrganismo INNER JOIN poa_programacion_financiera AS z2 ON z2.idOrganismo=a.idOrganismo INNER JOIN poa_actividadesadministrativas AS z3 ON z3.idProgramacionFinanciera=z2.idProgramacionFinanciera WHERE (b.financiero='T' OR b.financiero2='T') AND (b.financieroE='".$datos[0]."' OR b.financieroE2='".$datos[0]."');";


			}else if (($datos[1]=="2" || $datos[1]=="3") && $datos[2]=="7") {

				if ($datos[2]=="5") {
					$buscador="5__3";
				}else{
					$buscador="7__3";
				}

				$query="SELECT a.ruc,  REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(a.nombreOrganismo, 'Ã¡', 'á'),'Ã©','é'),'Ã­','í'),'Ã³','ó'),'Ãº','ú'),'Ã‰','É'),'ÃŒ','Í'),'Ã“','Ó'),'Ãš','Ú'),'Ã±','ñ'),'Ã‘','Ñ'),'&#039;',' ` '),'Ã','Á'),'',' '),'Ã','Á'),'SI','SI'),'â€œ',''),'â€',''),'Á²','ó') AS nombreOrganismo, a.correo, a.telefonoOficina,d.nombreTipo, a.nombreResponsablePoa, b.fecha, a.idOrganismo, d.idTipoOrganismo, (SELECT a1.documento FROM poa_concluciones AS a1 WHERE a1.idOrganismo=a.idOrganismo AND a1.documento LIKE '%$buscador%' ORDER BY a1.idObservacionesTecnicas DESC LIMIT 1) AS documentoAs FROM poa_organismo AS a INNER JOIN poa_preliminar_envio AS b ON a.idOrganismo=b.idOrganismo INNER JOIN poa_competencia_organismo_competencia AS c ON c.idOrganismo=a.idOrganismo INNER JOIN poa_tipo_organismo AS d ON d.idTipoOrganismo=c.idTipoOrganismo  WHERE (b.financiero='T' OR b.financiero2='T') AND (b.financieroE='".$datos[0]."' OR b.financieroE2='".$datos[0]."') AND (EXISTS (SELECT NULL FROM poa_sueldossalarios2022 AS a1 WHERE a1.idOrganismo=a.idOrganismo) OR EXISTS (SELECT NULL FROM poa_honorarios2022 AS a1 WHERE a1.idOrganismo=a.idOrganismo));";


			}

			$dataTablets=$objeto->getDatatablets2($query);


			echo json_encode($dataTablets);

		break;		


		case "organismoGeneralEn":

			$query="SELECT a.ruc,  REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(a.nombreOrganismo, 'Ã¡', 'á'),'Ã©','é'),'Ã­','í'),'Ã³','ó'),'Ãº','ú'),'Ã‰','É'),'ÃŒ','Í'),'Ã“','Ó'),'Ãš','Ú'),'Ã±','ñ'),'Ã‘','Ñ'),'&#039;',' ` '),'Ã','Á'),'',' '),'Ã','Á'),'SI','SI'),'â€œ',''),'â€',''),'Á²','ó') AS nombreOrganismo, a.correo, a.telefonoOficina,d.nombreTipo, a.nombreResponsablePoa, b.fecha, a.idOrganismo, d.idTipoOrganismo,GROUP_CONCAT(z.nombreAnexo SEPARATOR '_________') AS separaciones FROM poa_organismo AS a INNER JOIN poa_preliminar_envio AS b ON a.idOrganismo=b.idOrganismo INNER JOIN poa_competencia_organismo_competencia AS c ON c.idOrganismo=a.idOrganismo INNER JOIN poa_tipo_organismo AS d ON d.idTipoOrganismo=c.idTipoOrganismo LEFT JOIN poa_anexos2022 AS z ON z.idOrganismo=a.idOrganismo GROUP BY a.idOrganismo;";

			$dataTablets=$objeto->getDatatablets2($query);


			echo json_encode($dataTablets);

		break;		


		case "organismoSubsesCoordinasFinan":

			if(($datos[2]=="27" || $datos[2]=="28" || $datos[2]=="29" || $datos[2]=="30" || $datos[2]=="31" || $datos[2]=="32" || $datos[2]=="33") && ($datos[1]=="4" || $datos[1]=="3")){

				$query="SELECT a.ruc,  REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(a.nombreOrganismo, 'Ã¡', 'á'),'Ã©','é'),'Ã­','í'),'Ã³','ó'),'Ãº','ú'),'Ã‰','É'),'ÃŒ','Í'),'Ã“','Ó'),'Ãš','Ú'),'Ã±','ñ'),'Ã‘','Ñ'),'&#039;',' ` '),'Ã','Á'),'',' '),'Ã','Á'),'SI','SI'),'â€œ',''),'â€',''),'Á²','ó') AS nombreOrganismo, a.correo, a.telefonoOficina,d.nombreTipo, a.nombreResponsablePoa, b.fecha, a.idOrganismo, d.idTipoOrganismo,GROUP_CONCAT(z.nombreAnexo SEPARATOR '_________') AS separaciones,IF(zL.idOrganismo IS NOT NULL AND zL.tipoObservacion='zonalFinan',IF(zL.estado='A','OBSERVADO','RECTIFICADO'),'ENVIADO') AS estado FROM poa_organismo AS a INNER JOIN poa_preliminar_envio AS b ON a.idOrganismo=b.idOrganismo INNER JOIN poa_competencia_organismo_competencia AS c ON c.idOrganismo=a.idOrganismo INNER JOIN poa_tipo_organismo AS d ON d.idTipoOrganismo=c.idTipoOrganismo LEFT JOIN poa_anexos2022 AS z ON z.idOrganismo=a.idOrganismo LEFT JOIN poa_conclusion_observacion AS zL ON zL.idOrganismo=a.idOrganismo WHERE  b.financiero='$datos[0]' OR b.financiero2='$datos[0]' GROUP BY a.idOrganismo;";

			}

			$dataTablets=$objeto->getDatatablets2($query);


			echo json_encode($dataTablets);

		break;		


		case "organismoSubsesCoordinasFinanRe":

			$buscador=$datos[2]."__3";


			$query="SELECT a.ruc,  REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(a.nombreOrganismo, 'Ã¡', 'á'),'Ã©','é'),'Ã­','í'),'Ã³','ó'),'Ãº','ú'),'Ã‰','É'),'ÃŒ','Í'),'Ã“','Ó'),'Ãš','Ú'),'Ã±','ñ'),'Ã‘','Ñ'),'&#039;',' ` '),'Ã','Á'),'',' '),'Ã','Á'),'SI','SI'),'â€œ',''),'â€',''),'Á²','ó') AS nombreOrganismo, a.correo, a.telefonoOficina,d.nombreTipo, a.nombreResponsablePoa, b.fecha, a.idOrganismo, d.idTipoOrganismo,IF((SELECT a1.documento FROM poa_concluciones AS a1 WHERE a1.idOrganismo=a.idOrganismo AND a1.documento LIKE '%$buscador%' AND (a1.documento LIKE '%f__27__3.pdf%' OR a1.documento LIKE '%f__28__3.pdf%' OR a1.documento LIKE '%f__29__3.pdf%' OR a1.documento LIKE '%f__30__3.pdf%' OR a1.documento LIKE '%f__31__3.pdf%' OR a1.documento LIKE '%f__32__3.pdf%' OR a1.documento LIKE '%f__33__3.pdf%') AND a1.idOrganismo=a.idOrganismo ORDER BY a1.idObservacionesTecnicas DESC LIMIT 1) IS NOT NULL,(SELECT a1.documento FROM poa_concluciones AS a1 WHERE a1.idOrganismo=a.idOrganismo AND a1.documento LIKE '%$buscador%' AND (a1.documento LIKE '%f__27__3.pdf%' OR a1.documento LIKE '%f__28__3.pdf%' OR a1.documento LIKE '%f__29__3.pdf%' OR a1.documento LIKE '%f__30__3.pdf%' OR a1.documento LIKE '%f__31__3.pdf%' OR a1.documento LIKE '%f__32__3.pdf%' OR a1.documento LIKE '%f__33__3.pdf%') AND a1.idOrganismo=a.idOrganismo ORDER BY a1.idObservacionesTecnicas DESC LIMIT 1),(SELECT a1.documento FROM poa_concluciones AS a1 WHERE a1.idOrganismo=a.idOrganismo AND a1.documento LIKE '%$buscador%' ORDER BY a1.idObservacionesTecnicas DESC LIMIT 1)) AS documentoAs FROM poa_organismo AS a INNER JOIN poa_preliminar_envio AS b ON a.idOrganismo=b.idOrganismo INNER JOIN poa_competencia_organismo_competencia AS c ON c.idOrganismo=a.idOrganismo INNER JOIN poa_tipo_organismo AS d ON d.idTipoOrganismo=c.idTipoOrganismo WHERE  b.financiero2='T' AND b.financieroE2='$datos[0]';";


			$dataTablets=$objeto->getDatatablets2($query);


			echo json_encode($dataTablets);

		break;	


		case "organismoSubsesRecomen":

			$buscador=$datos[2]."__3";


			$query="SELECT a.ruc,  REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(a.nombreOrganismo, 'Ã¡', 'á'),'Ã©','é'),'Ã­','í'),'Ã³','ó'),'Ãº','ú'),'Ã‰','É'),'ÃŒ','Í'),'Ã“','Ó'),'Ãš','Ú'),'Ã±','ñ'),'Ã‘','Ñ'),'&#039;',' ` '),'Ã','Á'),'',' '),'Ã','Á'),'SI','SI'),'â€œ',''),'â€',''),'Á²','ó') AS nombreOrganismo, a.correo, a.telefonoOficina,d.nombreTipo, a.nombreResponsablePoa, b.fecha, a.idOrganismo, d.idTipoOrganismo,IF((SELECT a1.documento FROM poa_concluciones AS a1 WHERE a1.idOrganismo=a.idOrganismo AND (a1.documento LIKE '%i__27__3.pdf%' OR a1.documento LIKE '%i__28__3.pdf%' OR a1.documento LIKE '%i__29__3.pdf%' OR a1.documento LIKE '%i__30__3.pdf%' OR a1.documento LIKE '%i__31__3.pdf%' OR a1.documento LIKE '%i__32__3.pdf%' OR a1.documento LIKE '%i__33__3.pdf%') AND a1.idOrganismo=a.idOrganismo ORDER BY a1.idObservacionesTecnicas DESC LIMIT 1) IS NOT NULL,(SELECT a1.documento FROM poa_concluciones AS a1 WHERE a1.idOrganismo=a.idOrganismo AND (a1.documento LIKE '%i__27__3.pdf%' OR a1.documento LIKE '%i__28__3.pdf%' OR a1.documento LIKE '%i__29__3.pdf%' OR a1.documento LIKE '%i__30__3.pdf%' OR a1.documento LIKE '%i__31__3.pdf%' OR a1.documento LIKE '%i__32__3.pdf%' OR a1.documento LIKE '%i__33__3.pdf%') AND a1.idOrganismo=a.idOrganismo ORDER BY a1.idObservacionesTecnicas DESC LIMIT 1),(SELECT a1.documento FROM poa_concluciones AS a1 WHERE a1.idOrganismo=a.idOrganismo AND a1.documento LIKE '%$buscador%' ORDER BY a1.idObservacionesTecnicas DESC LIMIT 1)) AS documentoAs FROM poa_organismo AS a INNER JOIN poa_preliminar_envio AS b ON a.idOrganismo=b.idOrganismo INNER JOIN poa_competencia_organismo_competencia AS c ON c.idOrganismo=a.idOrganismo INNER JOIN poa_tipo_organismo AS d ON d.idTipoOrganismo=c.idTipoOrganismo WHERE  b.instlaaciones2='T' AND b.instalacionesE2='$datos[0]';";


			$dataTablets=$objeto->getDatatablets2($query);


			echo json_encode($dataTablets);

		break;	


		case "organismoSubsesCoordinas":

			if(($datos[2]=="27" || $datos[2]=="28" || $datos[2]=="29" || $datos[2]=="30" || $datos[2]=="31" || $datos[2]=="32" || $datos[2]=="33") && ($datos[1]=="4" || $datos[1]=="3")){

				$query="SELECT a.ruc,  REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(a.nombreOrganismo, 'Ã¡', 'á'),'Ã©','é'),'Ã­','í'),'Ã³','ó'),'Ãº','ú'),'Ã‰','É'),'ÃŒ','Í'),'Ã“','Ó'),'Ãš','Ú'),'Ã±','ñ'),'Ã‘','Ñ'),'&#039;',' ` '),'Ã','Á'),'',' '),'Ã','Á'),'SI','SI'),'â€œ',''),'â€',''),'Á²','ó') AS nombreOrganismo, a.correo, a.telefonoOficina,d.nombreTipo, a.nombreResponsablePoa, b.fecha, a.idOrganismo, d.idTipoOrganismo,GROUP_CONCAT(z.nombreAnexo SEPARATOR '_________') AS separaciones, IF(zL.idOrganismo IS NOT NULL AND zL.tipoObservacion='zonalFinan',IF(zL.estado='A','OBSERVADO','RECTIFICADO'),'ENVIADO') AS estado FROM poa_organismo AS a INNER JOIN poa_preliminar_envio AS b ON a.idOrganismo=b.idOrganismo INNER JOIN poa_competencia_organismo_competencia AS c ON c.idOrganismo=a.idOrganismo INNER JOIN poa_tipo_organismo AS d ON d.idTipoOrganismo=c.idTipoOrganismo LEFT JOIN poa_anexos2022 AS z ON z.idOrganismo=a.idOrganismo LEFT JOIN poa_conclusion_observacion AS zL ON zL.idOrganismo=a.idOrganismo WHERE b.subsecretaria='$datos[0]' GROUP BY a.idOrganismo;";

			}
			
			$dataTablets=$objeto->getDatatablets2($query);


			echo json_encode($dataTablets);

		break;		

		case "observciones__enviados":
				
			$query="SELECT (SELECT a1.ruc FROM poa_organismo AS a1 WHERE a1.idOrganismo=a.idOrganismo) AS ruc,(SELECT REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(a1.nombreOrganismo, 'Ã¡', 'á'),'Ã©','é'),'Ã­','í'),'Ã³','ó'),'Ãº','ú'),'Ã‰','É'),'ÃŒ','Í'),'Ã“','Ó'),'Ãš','Ú'),'Ã±','ñ'),'Ã‘','Ñ'),'&#039;',' ` '),'Ã','Á'),'',' '),'Ã','Á'),'SI','SI'),'â€œ',''),'â€',''),'Á²','ó') FROM poa_organismo AS a1 WHERE a1.idOrganismo=a.idOrganismo) AS nombreOrganismo, (SELECT b1.nombreProvincia FROM poa_organismo AS a1 INNER JOIN in_md_provincias AS b1 ON a1.idProvincia=b1.idProvincia WHERE a1.idOrganismo=a.idOrganismo) AS provincia, (SELECT b1.nombreCanton FROM poa_organismo AS a1 INNER JOIN in_md_canton AS b1 ON a1.idCanton=b1.idCanton WHERE a1.idOrganismo=a.idOrganismo) AS canton, (SELECT b1.nombreParroquia FROM poa_organismo AS a1 INNER JOIN in_md_parroquia AS b1 ON a1.idParroquia=b1.idParroquia WHERE a1.idOrganismo=a.idOrganismo) AS parroquia,a.idOrganismo  FROM poa_preliminar_envio AS a INNER JOIN poa_conclusion_observacion AS zL ON zL.idOrganismo=a.idOrganismo WHERE zL.idUsuario='$datos[0]' GROUP BY a.idOrganismo;";

			
			$dataTablets=$objeto->getDatatablets2($query);

			echo json_encode($dataTablets);

		break;	


		case "aprobadosTecnicos__enviados":

			if ($datos[2]==4) {
				
				$query="SELECT (SELECT a1.ruc FROM poa_organismo AS a1 WHERE a1.idOrganismo=a.idOrganismo LIMIT 1) AS ruc,(SELECT REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(a1.nombreOrganismo, 'Ã¡', 'á'),'Ã©','é'),'Ã­','í'),'Ã³','ó'),'Ãº','ú'),'Ã‰','É'),'ÃŒ','Í'),'Ã“','Ó'),'Ãš','Ú'),'Ã±','ñ'),'Ã‘','Ñ'),'&#039;',' ` '),'Ã','Á'),'',' '),'Ã','Á'),'SI','SI'),'â€œ',''),'â€',''),'Á²','ó') FROM poa_organismo AS a1 WHERE a1.idOrganismo=a.idOrganismo LIMIT 1) AS nombreOrganismo, (SELECT b1.nombreProvincia FROM poa_organismo AS a1 INNER JOIN in_md_provincias AS b1 ON a1.idProvincia=b1.idProvincia WHERE a1.idOrganismo=a.idOrganismo LIMIT 1) AS provincia, (SELECT b1.nombreCanton FROM poa_organismo AS a1 INNER JOIN in_md_canton AS b1 ON a1.idCanton=b1.idCanton WHERE a1.idOrganismo=a.idOrganismo LIMIT 1) AS canton, (SELECT b1.nombreParroquia FROM poa_organismo AS a1 INNER JOIN in_md_parroquia AS b1 ON a1.idParroquia=b1.idParroquia WHERE a1.idOrganismo=a.idOrganismo LIMIT 1) AS parroquia,a.idOrganismo FROM poa_preliminar_envio AS a INNER JOIN poa_poainicial AS b ON a.idOrganismo=b.idOrganismo  WHERE IF(b.idActividad=1,(SELECT a1.idOrganismo FROM poa_poainicial AS a1 WHERE a.idOrganismo=a1.idOrganismo AND (a.financieroE='$datos[0]' OR a.financieroE2='$datos[0]') LIMIT 1),1) IS NOT NULL AND IF(b.idActividad=2,(SELECT a1.idOrganismo FROM poa_poainicial AS a1 WHERE a.idOrganismo=a1.idOrganismo AND (a.instalacionesE='$datos[0]' OR a.instalacionesE2='$datos[0]') LIMIT 1),1) IS NOT NULL AND IF(b.idActividad>2,(SELECT a1.idOrganismo FROM poa_poainicial AS a1 WHERE a.idOrganismo=a1.idOrganismo AND a.subsecretariaE='$datos[0]' LIMIT 1),1) IS NOT NULL GROUP BY a.idOrganismo ORDER BY b.idActividad ASC;";

			}else{

				$query="SELECT (SELECT a1.ruc FROM poa_organismo AS a1 WHERE a1.idOrganismo=a.idOrganismo LIMIT 1) AS ruc,(SELECT REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(a1.nombreOrganismo, 'Ã¡', 'á'),'Ã©','é'),'Ã­','í'),'Ã³','ó'),'Ãº','ú'),'Ã‰','É'),'ÃŒ','Í'),'Ã“','Ó'),'Ãš','Ú'),'Ã±','ñ'),'Ã‘','Ñ'),'&#039;',' ` '),'Ã','Á'),'',' '),'Ã','Á'),'SI','SI'),'â€œ',''),'â€',''),'Á²','ó') FROM poa_organismo AS a1 WHERE a1.idOrganismo=a.idOrganismo LIMIT 1) AS nombreOrganismo, (SELECT b1.nombreProvincia FROM poa_organismo AS a1 INNER JOIN in_md_provincias AS b1 ON a1.idProvincia=b1.idProvincia WHERE a1.idOrganismo=a.idOrganismo LIMIT 1) AS provincia, (SELECT b1.nombreCanton FROM poa_organismo AS a1 INNER JOIN in_md_canton AS b1 ON a1.idCanton=b1.idCanton WHERE a1.idOrganismo=a.idOrganismo LIMIT 1) AS canton, (SELECT b1.nombreParroquia FROM poa_organismo AS a1 INNER JOIN in_md_parroquia AS b1 ON a1.idParroquia=b1.idParroquia WHERE a1.idOrganismo=a.idOrganismo LIMIT 1) AS parroquia,a.idOrganismo, (SELECT REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(b1.nombreTipo, 'Ã¡', 'á'),'Ã©','é'),'Ã­','í'),'Ã³','ó'),'Ãº','ú'),'Ã‰','É'),'ÃŒ','Í'),'Ã“','Ó'),'Ãš','Ú'),'Ã±','ñ'),'Ã‘','Ñ'),'&#039;',' ` '),'Ã','Á'),'',' '),'Ã','Á'),'SI','SI'),'â€œ',''),'â€',''),'Á²','ó') FROM poa_competencia_organismo_competencia AS a1 INNER JOIN poa_tipo_organismo AS b1 ON a1.idTipoOrganismo=b1.idTipoOrganismo WHERE a1.idOrganismo=a.idOrganismo LIMIT 1) AS tipoOrganismo FROM poa_preliminar_envio AS a INNER JOIN poa_poainicial AS b ON a.idOrganismo=b.idOrganismo WHERE a.planificacion='$datos[0]' GROUP BY a.idOrganismo ORDER BY b.idActividad ASC;";



			}

			
			$dataTablets=$objeto->getDatatablets2($query);

			echo json_encode($dataTablets);

		break;	

		case "organismoSubsesCoordinasReco":

				$buscador=$datos[2]."__3";


			$query="SELECT a.ruc,  REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(a.nombreOrganismo, 'Ã¡', 'á'),'Ã©','é'),'Ã­','í'),'Ã³','ó'),'Ãº','ú'),'Ã‰','É'),'ÃŒ','Í'),'Ã“','Ó'),'Ãš','Ú'),'Ã±','ñ'),'Ã‘','Ñ'),'&#039;',' ` '),'Ã','Á'),'',' '),'Ã','Á'),'SI','SI'),'â€œ',''),'â€',''),'Á²','ó') AS nombreOrganismo, a.correo, a.telefonoOficina,d.nombreTipo, a.nombreResponsablePoa, b.fecha, a.idOrganismo, d.idTipoOrganismo,IF((SELECT a1.documento FROM poa_concluciones AS a1 WHERE a1.idOrganismo=a.idOrganismo AND a1.documento LIKE '%$buscador%' AND (a1.documento LIKE '%s__27__3.pdf%' OR a1.documento LIKE '%s__28__3.pdf%' OR a1.documento LIKE '%s__29__3.pdf%' OR a1.documento LIKE '%s__30__3.pdf%' OR a1.documento LIKE '%s__31__3.pdf%' OR a1.documento LIKE '%s__32__3.pdf%' OR a1.documento LIKE '%s__33__3.pdf%') AND a1.idOrganismo=a.idOrganismo ORDER BY a1.idObservacionesTecnicas DESC LIMIT 1) IS NOT NULL,(SELECT a1.documento FROM poa_concluciones AS a1 WHERE a1.idOrganismo=a.idOrganismo AND a1.documento LIKE '%$buscador%' AND (a1.documento LIKE '%s__27__3.pdf%' OR a1.documento LIKE '%s__28__3.pdf%' OR a1.documento LIKE '%s__29__3.pdf%' OR a1.documento LIKE '%s__30__3.pdf%' OR a1.documento LIKE '%s__31__3.pdf%' OR a1.documento LIKE '%s__32__3.pdf%' OR a1.documento LIKE '%s__33__3.pdf%') AND a1.idOrganismo=a.idOrganismo ORDER BY a1.idObservacionesTecnicas DESC LIMIT 1),(SELECT a1.documento FROM poa_concluciones AS a1 WHERE a1.idOrganismo=a.idOrganismo AND a1.documento LIKE '%$buscador%' ORDER BY a1.idObservacionesTecnicas DESC LIMIT 1)) AS documentoAs FROM poa_organismo AS a INNER JOIN poa_preliminar_envio AS b ON a.idOrganismo=b.idOrganismo INNER JOIN poa_competencia_organismo_competencia AS c ON c.idOrganismo=a.idOrganismo INNER JOIN poa_tipo_organismo AS d ON d.idTipoOrganismo=c.idTipoOrganismo WHERE b.subsecretaria='T' AND b.subsecretariaE='$datos[0]';";

			$dataTablets=$objeto->getDatatablets2($query);

			echo json_encode($dataTablets);

		break;		



		case "organismoSubses":

			if ($datos[2]=="24" && $datos[1]=="7") {

					$query="SELECT a.ruc,  REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(a.nombreOrganismo, 'Ã¡', 'á'),'Ã©','é'),'Ã­','í'),'Ã³','ó'),'Ãº','ú'),'Ã‰','É'),'ÃŒ','Í'),'Ã“','Ó'),'Ãš','Ú'),'Ã±','ñ'),'Ã‘','Ñ'),'&#039;',' ` '),'Ã','Á'),'',' '),'Ã','Á'),'SI','SI'),'â€œ',''),'â€',''),'Á²','ó') AS nombreOrganismo, a.correo, a.telefonoOficina,d.nombreTipo, a.nombreResponsablePoa, b.fecha, a.idOrganismo, d.idTipoOrganismo,GROUP_CONCAT(z.nombreAnexo SEPARATOR '_________') AS separaciones,IF(zL.idOrganismo IS NOT NULL AND zL.tipoObservacion='altoRendi',IF(zL.estado='A','OBSERVADO','RECTIFICADO'),'ENVIADO') AS estado,(SELECT a1.nombreProvincia FROM in_md_provincias AS a1 WHERE a1.idProvincia=a.idProvincia) AS nombreProvincia FROM poa_organismo AS a INNER JOIN poa_preliminar_envio AS b ON a.idOrganismo=b.idOrganismo INNER JOIN poa_competencia_organismo_competencia AS c ON c.idOrganismo=a.idOrganismo INNER JOIN poa_tipo_organismo AS d ON d.idTipoOrganismo=c.idTipoOrganismo LEFT JOIN poa_anexos2022 AS z ON z.idOrganismo=a.idOrganismo LEFT JOIN poa_conclusion_observacion AS zL ON zL.idOrganismo=a.idOrganismo  WHERE (d.nombreTipo LIKE '%ecuatorianas por%' OR d.nombreTipo LIKE '%pico Ecuatoriano%'  OR d.nombreTipo LIKE '%Federaciones Ecuatorianas de Deporte Adaptado%' OR d.nombreTipo LIKE '%Militar Ecuatoriana%' OR d.nombreTipo LIKE '%Policial Ecuatoriana%' OR b.subsecretaria='sA') AND (b.subsecretaria IS NULL OR b.subsecretaria='sA' OR b.subsecretaria='$datos[0]') GROUP BY a.idOrganismo;";


			}else if($datos[2]=="26" && $datos[1]=="7"){

				$query="SELECT a.ruc,  REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(a.nombreOrganismo, 'Ã¡', 'á'),'Ã©','é'),'Ã­','í'),'Ã³','ó'),'Ãº','ú'),'Ã‰','É'),'ÃŒ','Í'),'Ã“','Ó'),'Ãš','Ú'),'Ã±','ñ'),'Ã‘','Ñ'),'&#039;',' ` '),'Ã','Á'),'',' '),'Ã','Á'),'SI','SI'),'â€œ',''),'â€',''),'Á²','ó') AS nombreOrganismo, a.correo, a.telefonoOficina,d.nombreTipo, a.nombreResponsablePoa, b.fecha, a.idOrganismo, d.idTipoOrganismo,GROUP_CONCAT(z.nombreAnexo SEPARATOR '_________') AS separaciones,IF(zL.idOrganismo IS NOT NULL AND zL.tipoObservacion='subFisica',IF(zL.estado='A','OBSERVADO','RECTIFICADO'),'ENVIADO') AS estado,(SELECT a1.nombreProvincia FROM in_md_provincias AS a1 WHERE a1.idProvincia=a.idProvincia) AS nombreProvincia FROM poa_organismo AS a INNER JOIN poa_preliminar_envio AS b ON a.idOrganismo=b.idOrganismo INNER JOIN poa_competencia_organismo_competencia AS c ON c.idOrganismo=a.idOrganismo INNER JOIN poa_tipo_organismo AS d ON d.idTipoOrganismo=c.idTipoOrganismo LEFT JOIN poa_anexos2022 AS z ON z.idOrganismo=a.idOrganismo LEFT JOIN poa_conclusion_observacion AS zL ON zL.idOrganismo=a.idOrganismo  WHERE (d.nombreTipo LIKE '%cantonales%' OR d.nombreTipo LIKE '%comunitarias%'  OR d.nombreTipo LIKE '%deportivas provinciales%' OR d.nombreTipo LIKE '%barriales y parroquiales%' OR d.nombreTipo LIKE '%Federaciones provinciales de ligas%' OR d.nombreTipo LIKE '%Federaciones provinciales de ligas%' OR d.nombreTipo LIKE '%Federaciones provinciales de ligas%' OR d.nombreTipo LIKE '%Federaciones provinciales de ligas%' OR d.nombreTipo LIKE '%Federaciones deportivas provinciales de r%' OR d.nombreTipo LIKE '%Nacional de Ligas Deportivas%' OR d.nombreTipo LIKE '%Nacional del Ecuador%' OR d.nombreTipo LIKE '%de Deporte Universitario%' OR d.nombreTipo LIKE '%Estudiantil%' OR d.nombreTipo LIKE '%Rurales%' OR b.subsecretaria='sF') AND (b.subsecretaria IS NULL OR b.subsecretaria='sF' OR b.subsecretaria='$datos[0]') GROUP BY a.idOrganismo;";

			}else if($datos[2]=="2" && $datos[1]=="4"){

				$query="SELECT a.ruc,  REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(a.nombreOrganismo, 'Ã¡', 'á'),'Ã©','é'),'Ã­','í'),'Ã³','ó'),'Ãº','ú'),'Ã‰','É'),'ÃŒ','Í'),'Ã“','Ó'),'Ãš','Ú'),'Ã±','ñ'),'Ã‘','Ñ'),'&#039;',' ` '),'Ã','Á'),'',' '),'Ã','Á'),'SI','SI'),'â€œ',''),'â€',''),'Á²','ó') AS nombreOrganismo, a.correo, a.telefonoOficina,d.nombreTipo, a.nombreResponsablePoa, b.fecha, a.idOrganismo, d.idTipoOrganismo,GROUP_CONCAT(z.nombreAnexo SEPARATOR '_________') AS separaciones,IF(zL.idOrganismo IS NOT NULL AND zL.tipoObservacion='administrativo',IF(zL.estado='A','OBSERVADO','RECTIFICADO'),'ENVIADO') AS estado,(SELECT a1.nombreProvincia FROM in_md_provincias AS a1 WHERE a1.idProvincia=a.idProvincia) AS nombreProvincia FROM poa_organismo AS a INNER JOIN poa_preliminar_envio AS b ON a.idOrganismo=b.idOrganismo INNER JOIN poa_competencia_organismo_competencia AS c ON c.idOrganismo=a.idOrganismo INNER JOIN poa_tipo_organismo AS d ON d.idTipoOrganismo=c.idTipoOrganismo LEFT JOIN poa_anexos2022 AS z ON z.idOrganismo=a.idOrganismo LEFT JOIN poa_conclusion_observacion AS zL ON zL.idOrganismo=a.idOrganismo  WHERE (SELECT a1.idActividad FROM poa_programacion_financiera AS a1 WHERE a1.idOrganismo=a.idOrganismo AND a1.idActividad='1' LIMIT 1) IS NOT NULL AND (SELECT if(SUM(a1.totalSumaItem)>0,1,null) FROM poa_programacion_financiera AS a1 WHERE a1.idOrganismo=a.idOrganismo AND a1.idActividad='1' GROUP BY a1.idOrganismo) IS NOT NULL AND (b.financieroE2 IS NULL AND b.financieroE IS NULL AND b.financiero2 IS NULL) OR (b.financiero='T' AND b.financiero2='$datos[0]') OR (b.financiero IS NOT NULL AND b.financiero2='$datos[0]') OR (b.financiero='$datos[0]' AND b.financiero2 IS NOT NULL) OR (b.financiero='T' AND b.financiero2='$datos[0]') OR (b.financiero IS NULL AND b.financiero2='$datos[0]') OR (b.financiero='$datos[0]' AND b.financiero2 IS NULL) OR (b.financiero IS NULL AND b.financiero2='$datos[0]') OR (b.financiero IS NULL AND b.financiero2 IS NULL) GROUP BY a.idOrganismo;";


			}else if($datos[2]=="1" && $datos[1]=="4"){

				$query="SELECT a.ruc,  REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(a.nombreOrganismo, 'Ã¡', 'á'),'Ã©','é'),'Ã­','í'),'Ã³','ó'),'Ãº','ú'),'Ã‰','É'),'ÃŒ','Í'),'Ã“','Ó'),'Ãš','Ú'),'Ã±','ñ'),'Ã‘','Ñ'),'&#039;',' ` '),'Ã','Á'),'',' '),'Ã','Á'),'SI','SI'),'â€œ',''),'â€',''),'Á²','ó') AS nombreOrganismo, a.correo, a.telefonoOficina,d.nombreTipo, a.nombreResponsablePoa, b.fecha, a.idOrganismo, d.idTipoOrganismo,GROUP_CONCAT(z.nombreAnexo SEPARATOR '_________') AS separaciones,IF(zL.idOrganismo IS NOT NULL AND zL.tipoObservacion='zonalE',IF(zL.estado='A','OBSERVADO','RECTIFICADO'),'ENVIADO') AS estado,(SELECT a1.nombreProvincia FROM in_md_provincias AS a1 WHERE a1.idProvincia=a.idProvincia) AS nombreProvincia FROM poa_organismo AS a INNER JOIN poa_preliminar_envio AS b ON a.idOrganismo=b.idOrganismo INNER JOIN poa_competencia_organismo_competencia AS c ON c.idOrganismo=a.idOrganismo INNER JOIN poa_tipo_organismo AS d ON d.idTipoOrganismo=c.idTipoOrganismo LEFT JOIN poa_anexos2022 AS z ON z.idOrganismo=a.idOrganismo LEFT JOIN poa_conclusion_observacion AS zL ON zL.idOrganismo=a.idOrganismo  WHERE (SELECT a1.idActividad FROM poa_programacion_financiera AS a1 WHERE a1.idOrganismo=a.idOrganismo AND a1.idActividad='2' LIMIT 1) IS NOT NULL AND (SELECT if(SUM(a1.totalSumaItem)>0,1,null) FROM poa_programacion_financiera AS a1 WHERE a1.idOrganismo=a.idOrganismo AND a1.idActividad='2' GROUP BY a1.idOrganismo) IS NOT NULL AND (SELECT a1.idActividad FROM poa_programacion_financiera AS a1 WHERE a1.idOrganismo=a.idOrganismo AND a1.idActividad='2' LIMIT 1) IS NOT NULL AND (SELECT if(SUM(a1.totalSumaItem)>0,1,null) FROM poa_programacion_financiera AS a1 WHERE a1.idOrganismo=a.idOrganismo AND a1.idActividad='2' GROUP BY a1.idOrganismo) IS NOT NULL AND (b.instalacionesE2 IS NULL AND b.instalacionesE IS NULL AND b.instalaciones IS NULL AND b.instlaaciones2 IS NULL) OR (b.instalaciones='$datos[0]' AND b.instlaaciones2='$datos[0]' AND (SELECT a.idMantenimiento FROM poa_mantenimiento AS a INNER JOIN poa_programacion_financiera AS b ON a.idProgramacionFinanciera=b.idProgramacionFinanciera WHERE b.idOrganismo=a.idOrganismo LIMIT 1) IS NOT NULL) OR (b.instalaciones IS NULL AND b.instlaaciones2='$datos[0]' AND (SELECT a.idMantenimiento FROM poa_mantenimiento AS a INNER JOIN poa_programacion_financiera AS b ON a.idProgramacionFinanciera=b.idProgramacionFinanciera WHERE b.idOrganismo=a.idOrganismo LIMIT 1) IS NOT NULL) OR (b.instalaciones='$datos[0]' AND b.instlaaciones2 IS NULL) OR (b.instalaciones IS NOT NULL AND b.instlaaciones2='$datos[0]' AND instalacionesE!='$planificacion' AND instalacionesE!='$directorVariables' AND (SELECT a.idMantenimiento FROM poa_mantenimiento AS a INNER JOIN poa_programacion_financiera AS b ON a.idProgramacionFinanciera=b.idProgramacionFinanciera WHERE b.idOrganismo=a.idOrganismo LIMIT 1) IS NOT NULL AND planificacion!='$directorVariables') OR (b.instalaciones='$datos[0]' AND b.instlaaciones2 IS NOT NULL  AND instalacionesE2!='$planificacion' AND instalacionesE2!='$directorVariables' AND (SELECT a.idMantenimiento FROM poa_mantenimiento AS a INNER JOIN poa_programacion_financiera AS b ON a.idProgramacionFinanciera=b.idProgramacionFinanciera WHERE b.idOrganismo=a.idOrganismo LIMIT 1) IS NOT NULL AND planificacion!='$directorVariables')  GROUP BY a.idOrganismo;";


			}else if(($datos[2]=="27" || $datos[2]=="28" || $datos[2]=="29" || $datos[2]=="30" || $datos[2]=="31" || $datos[2]=="32" || $datos[2]=="33") && ($datos[1]=="4" || $datos[1]=="3")){

				$query="SELECT a.ruc,  REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(a.nombreOrganismo, 'Ã¡', 'á'),'Ã©','é'),'Ã­','í'),'Ã³','ó'),'Ãº','ú'),'Ã‰','É'),'ÃŒ','Í'),'Ã“','Ó'),'Ãš','Ú'),'Ã±','ñ'),'Ã‘','Ñ'),'&#039;',' ` '),'Ã','Á'),'',' '),'Ã','Á'),'SI','SI'),'â€œ',''),'â€',''),'Á²','ó') AS nombreOrganismo, a.correo, a.telefonoOficina,d.nombreTipo, a.nombreResponsablePoa, b.fecha, a.idOrganismo, d.idTipoOrganismo,GROUP_CONCAT(z.nombreAnexo SEPARATOR '_________') AS separaciones,IF(zL.idOrganismo IS NOT NULL AND zL.tipoObservacion='zonalE',IF(zL.estado='A','OBSERVADO','RECTIFICADO'),'ENVIADO') AS estado,(SELECT a1.nombreProvincia FROM in_md_provincias AS a1 WHERE a1.idProvincia=a.idProvincia) AS nombreProvincia FROM poa_organismo AS a INNER JOIN poa_preliminar_envio AS b ON a.idOrganismo=b.idOrganismo INNER JOIN poa_competencia_organismo_competencia AS c ON c.idOrganismo=a.idOrganismo INNER JOIN poa_tipo_organismo AS d ON d.idTipoOrganismo=c.idTipoOrganismo LEFT JOIN poa_anexos2022 AS z ON z.idOrganismo=a.idOrganismo LEFT JOIN poa_conclusion_observacion AS zL ON zL.idOrganismo=a.idOrganismo  WHERE (SELECT a1.idActividad FROM poa_programacion_financiera AS a1 WHERE a1.idOrganismo=a.idOrganismo AND a1.idActividad='2' LIMIT 1) IS NOT NULL AND b.instlaaciones2='$datos[0]' GROUP BY a.idOrganismo;";

			}else if (($datos[1]=="2" || $datos[1]=="3") && ($datos[2]=="12" || $datos[2]=="13" || $datos[2]=="14" || $datos[2]=="19" || $datos[2]=="13" || $datos[2]=="13" || $datos[2]=="13" || $datos[2]=="13" || $datos[2]=="13"  || $datos[2]=="24" || $datos[2]=="26")) {

				$query="SELECT a.ruc,  REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(a.nombreOrganismo, 'Ã¡', 'á'),'Ã©','é'),'Ã­','í'),'Ã³','ó'),'Ãº','ú'),'Ã‰','É'),'ÃŒ','Í'),'Ã“','Ó'),'Ãš','Ú'),'Ã±','ñ'),'Ã‘','Ñ'),'&#039;',' ` '),'Ã','Á'),'',' '),'Ã','Á'),'SI','SI'),'â€œ',''),'â€',''),'Á²','ó') AS nombreOrganismo, a.correo, a.telefonoOficina,d.nombreTipo, a.nombreResponsablePoa, b.fecha, a.idOrganismo, d.idTipoOrganismo,GROUP_CONCAT(z.nombreAnexo SEPARATOR '_________') AS separaciones,IF(zL.idOrganismo IS NOT NULL AND zL.tipoObservacion='subFisica',IF(zL.estado='A','OBSERVADO','RECTIFICADO'),'ENVIADO') AS estado,(SELECT a1.nombreProvincia FROM in_md_provincias AS a1 WHERE a1.idProvincia=a.idProvincia) AS nombreProvincia FROM poa_organismo AS a INNER JOIN poa_preliminar_envio AS b ON a.idOrganismo=b.idOrganismo INNER JOIN poa_competencia_organismo_competencia AS c ON c.idOrganismo=a.idOrganismo INNER JOIN poa_tipo_organismo AS d ON d.idTipoOrganismo=c.idTipoOrganismo LEFT JOIN poa_anexos2022 AS z ON z.idOrganismo=a.idOrganismo LEFT JOIN poa_conclusion_observacion AS zL ON zL.idOrganismo=a.idOrganismo WHERE b.subsecretaria='$datos[0]' GROUP BY a.idOrganismo;";


			}else if (($datos[1]=="2" || $datos[1]=="3") && ($datos[2]=="6" || $datos[2]=="15"  || $datos[2]=="1")) {

				$query="SELECT a.ruc,  REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(a.nombreOrganismo, 'Ã¡', 'á'),'Ã©','é'),'Ã­','í'),'Ã³','ó'),'Ãº','ú'),'Ã‰','É'),'ÃŒ','Í'),'Ã“','Ó'),'Ãš','Ú'),'Ã±','ñ'),'Ã‘','Ñ'),'&#039;',' ` '),'Ã','Á'),'',' '),'Ã','Á'),'SI','SI'),'â€œ',''),'â€',''),'Á²','ó') AS nombreOrganismo, a.correo, a.telefonoOficina,d.nombreTipo, a.nombreResponsablePoa, b.fecha, a.idOrganismo, d.idTipoOrganismo,GROUP_CONCAT(z.nombreAnexo SEPARATOR '_________') AS separaciones,IF(zL.idOrganismo IS NOT NULL AND zL.tipoObservacion='zonalE',IF(zL.estado='A','OBSERVADO','RECTIFICADO'),'ENVIADO') AS estado,(SELECT a1.nombreProvincia FROM in_md_provincias AS a1 WHERE a1.idProvincia=a.idProvincia) AS nombreProvincia FROM poa_organismo AS a INNER JOIN poa_preliminar_envio AS b ON a.idOrganismo=b.idOrganismo INNER JOIN poa_competencia_organismo_competencia AS c ON c.idOrganismo=a.idOrganismo INNER JOIN poa_tipo_organismo AS d ON d.idTipoOrganismo=c.idTipoOrganismo LEFT JOIN poa_anexos2022 AS z ON z.idOrganismo=a.idOrganismo LEFT JOIN poa_conclusion_observacion AS zL ON zL.idOrganismo=a.idOrganismo  WHERE (b.instalaciones='$datos[0]' OR b.instlaaciones2='$datos[0]') AND (SELECT if(SUM(a1.totalSumaItem)>0,1,null) FROM poa_programacion_financiera AS a1 WHERE a1.idOrganismo=a.idOrganismo AND a1.idActividad='2' GROUP BY a1.idOrganismo) IS NOT NULL GROUP BY a.idOrganismo;";


			}else if (($datos[1]=="2" || $datos[1]=="3") && ($datos[2]=="23" || $datos[2]=="5" || $datos[2]=="2")) {

				$query="SELECT DISTINCT a.ruc,  REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(a.nombreOrganismo, 'Ã¡', 'á'),'Ã©','é'),'Ã­','í'),'Ã³','ó'),'Ãº','ú'),'Ã‰','É'),'ÃŒ','Í'),'Ã“','Ó'),'Ãš','Ú'),'Ã±','ñ'),'Ã‘','Ñ'),'&#039;',' ` '),'Ã','Á'),'',' '),'Ã','Á'),'SI','SI'),'â€œ',''),'â€',''),'Á²','ó') AS nombreOrganismo, a.correo, a.telefonoOficina,d.nombreTipo, a.nombreResponsablePoa, b.fecha, a.idOrganismo, d.idTipoOrganismo,z.nombreAnexo AS separaciones,IF(zL.idOrganismo IS NOT NULL AND zL.tipoObservacion='administrativo',IF(zL.estado='A','OBSERVADO','RECTIFICADO'),'ENVIADO') AS estado,(SELECT a1.nombreProvincia FROM in_md_provincias AS a1 WHERE a1.idProvincia=a.idProvincia) AS nombreProvincia FROM poa_organismo AS a INNER JOIN poa_preliminar_envio AS b ON a.idOrganismo=b.idOrganismo INNER JOIN poa_competencia_organismo_competencia AS c ON c.idOrganismo=a.idOrganismo INNER JOIN poa_tipo_organismo AS d ON d.idTipoOrganismo=c.idTipoOrganismo LEFT JOIN poa_anexos2022 AS z ON z.idOrganismo=a.idOrganismo LEFT JOIN poa_conclusion_observacion AS zL ON zL.idOrganismo=a.idOrganismo INNER JOIN poa_programacion_financiera AS z2 ON z2.idOrganismo=a.idOrganismo INNER JOIN poa_actividadesadministrativas AS z3 ON z3.idProgramacionFinanciera=z2.idProgramacionFinanciera  WHERE (b.financiero='$datos[0]') AND (SELECT if(SUM(a1.totalSumaItem)>0,1,null) FROM poa_programacion_financiera AS a1 WHERE a1.idOrganismo=a.idOrganismo AND a1.idActividad='1' GROUP BY a1.idOrganismo) IS NOT NULL AND (b.financieroE IS NULL)  GROUP BY a.idOrganismo;";


			}else if (($datos[1]=="2" || $datos[1]=="3") && ($datos[2]=="23" || $datos[2]=="7" || $datos[2]=="2")) {

				$query="SELECT DISTINCT a.ruc,  REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(a.nombreOrganismo, 'Ã¡', 'á'),'Ã©','é'),'Ã­','í'),'Ã³','ó'),'Ãº','ú'),'Ã‰','É'),'ÃŒ','Í'),'Ã“','Ó'),'Ãš','Ú'),'Ã±','ñ'),'Ã‘','Ñ'),'&#039;',' ` '),'Ã','Á'),'',' '),'Ã','Á'),'SI','SI'),'â€œ',''),'â€',''),'Á²','ó') AS nombreOrganismo, a.correo, a.telefonoOficina,d.nombreTipo, a.nombreResponsablePoa, b.fecha, a.idOrganismo, d.idTipoOrganismo,z.nombreAnexo AS separaciones,IF(zL.idOrganismo IS NOT NULL AND zL.tipoObservacion='administrativo',IF(zL.estado='A','OBSERVADO','RECTIFICADO'),'ENVIADO') AS estado,(SELECT a1.nombreProvincia FROM in_md_provincias AS a1 WHERE a1.idProvincia=a.idProvincia) AS nombreProvincia FROM poa_organismo AS a INNER JOIN poa_preliminar_envio AS b ON a.idOrganismo=b.idOrganismo INNER JOIN poa_competencia_organismo_competencia AS c ON c.idOrganismo=a.idOrganismo INNER JOIN poa_tipo_organismo AS d ON d.idTipoOrganismo=c.idTipoOrganismo LEFT JOIN poa_anexos2022 AS z ON z.idOrganismo=a.idOrganismo LEFT JOIN poa_conclusion_observacion AS zL ON zL.idOrganismo=a.idOrganismo WHERE (b.financiero2='$datos[0]') AND (SELECT if(SUM(a1.totalSumaItem)>0,1,null) FROM poa_programacion_financiera AS a1 WHERE a1.idOrganismo=a.idOrganismo AND a1.idActividad='1' GROUP BY a1.idOrganismo) IS NOT NULL AND (EXISTS (SELECT NULL FROM poa_sueldossalarios2022 AS a1 WHERE a1.idOrganismo=a.idOrganismo) OR EXISTS (SELECT NULL FROM poa_honorarios2022 AS a1 WHERE a1.idOrganismo=a.idOrganismo)) AND (b.financieroE2 IS NULL) GROUP BY a.idOrganismo;";


			}

			$dataTablets=$objeto->getDatatablets2($query);


			echo json_encode($dataTablets);

		break;		


		case "usuariosAplicativo":

			$query="SELECT UPPER(CONCAT_WS(' ',a.nombre,a.apellido)) AS nombreCompletoU,c.nombreRol AS nombreRolUs,a.idUsuario,a.cedula,REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(a.nombre, 'Ã¡', 'á'),'Ã©','é'),'Ã­','í'),'Ã³','ó'),'Ãº','ú'),'Ã‰','É'),'ÃŒ','Í'),'Ã“','Ó'),'Ãš','Ú'),'Ã±','ñ'),'Ã‘','Ñ'),'&#039;',' ` '),'Ã','Á'),'',' '),'Ã','Í'),'SI','SI'),'â€œ',''),'â€',''),'Á²','ó'),'','') AS nombre,REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(a.apellido, 'Ã¡', 'á'),'Ã©','é'),'Ã­','í'),'Ã³','ó'),'Ãº','ú'),'Ã‰','É'),'ÃŒ','Í'),'Ã“','Ó'),'Ãš','Ú'),'Ã±','ñ'),'Ã‘','Ñ'),'&#039;',' ` '),'Ã','Á'),'',' '),'Ã','Í'),'SI','SI'),'â€œ',''),'â€',''),'Á²','ó'),'','') AS apellido,a.sexo,a.fechaNacimiento,a.usuario,a.email,a.telefono,a.estado,b.fechaIngreso,c.nombreRol,c.idRol,a.estado AS estadosPerfilesDados,a.usuario,a.`password` AS contrasena,d.nombreDireccion,a.zonal,e.nombreDireccion,e.idDireccion FROM poa_usuario AS a INNER JOIN poa_usuariorol AS b ON a.idUsuario=b.idUsuario INNER JOIN poa_roles as c ON c.idRol=b.idRol LEFT JOIN poa_direccion_pertenece_usuario AS d ON d.idDireccion=a.idDireccion LEFT JOIN poa_direccion_pertenece_usuario AS e ON e.idDireccion=a.idDireccion;";

			$dataTablets=$objeto->getDatatablets2($query);

			echo json_encode($dataTablets);

		break;		

		case "tablaGrupoGasto":

			$query="SELECT nombreClasificacionGastos,idClasificacionGastos FROM poa_clasificaciongastos;";

			$dataTablets=$objeto->getDatatablets($query);

			echo json_encode($dataTablets);

		break;		

		case "tablaItems":

			$query="SELECT a.nombreItem,a.idItem,a.estado,a.subdividePima,a.subdivideGastos,a.subdivideDeclaracion,b.campoCero,b.idLuzAguaSeleccionada,a.itemPreesupuestario FROM poa_item AS a LEFT JOIN poa_item_luzagua_seleccionadas AS b ON a.idItem=b.idItem;";

			$dataTablets=$objeto->getDatatablets($query);

			echo json_encode($dataTablets);

		break;		

		case "tablaActividades":

			$query="SELECT a.idActividades AS idActividadSecond,a.nombreActividades,a.idActividades,b.idActividadItem,a.idClasificacionGastos,(SELECT a1.nombreIndicador FROM poa_indicadores AS a1 WHERE a1.idIndicadores=a.idLineaPolitica) AS indicador, (SELECT a1.idIndicadores FROM poa_indicadores AS a1 WHERE a1.idIndicadores=a.idLineaPolitica) AS indicadorId,(SELECT a2.nombreClasificacionGastos FROM poa_clasificaciongastos AS a2 WHERE a2.idClasificacionGastos=a.idClasificacionGastos) AS nomClasi FROM poa_actividades AS a LEFT JOIN poa_item_actividad AS b ON a.idActividades=b.idActividad LEFT JOIN poa_item AS c ON c.idItem=b.idItem GROUP BY a.idActividades;";

			$dataTablets=$objeto->getDatatablets($query);

			echo json_encode($dataTablets);

		break;		


		case "tablaItemsAc":

			$query="SELECT b.nombreItem,a.idActividadItem FROM poa_item_actividad AS a INNER JOIN poa_item AS b ON a.idItem=b.idItem WHERE a.idActividad='$datos[0]';";

			$dataTablets=$objeto->getDatatablets($query);

			echo json_encode($dataTablets);

		break;		

	}


