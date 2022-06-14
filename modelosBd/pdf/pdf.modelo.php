<?php
	
	ob_start(); 

	extract($_POST);

	require_once "../../config/config2.php";

	require_once "../../modelosBd/convertirLetras/NumeroALetras.php";

	use Luecano\NumeroALetras\NumeroALetras;

	/*============================================
	=            Parametros Iniciales            =
	============================================*/
	
	date_default_timezone_set("America/Guayaquil");

	$fecha_actual = date('Y-m-d');

	$hora_actual= date('H:i:s');	
	
	/*=====  End of Parametros Iniciales  ======*/
	

	$objeto= new usuarioAcciones();

	$informacionCompleto=$objeto->getInformacionCompletaOrganismoDeportivoConsu($idOrganismo);
	$informacionCompletoDosI=$objeto->getInformacionCompletaOrganismoDeportivoConsuDos($idOrganismo);


	$directorConjunto=$objeto->getDirectorPlani();

	$fisicamenteDireccion=$objeto->getObtenerInformacionGeneral("SELECT descripcionFisicamenteEstructura FROM th_fisicamenteestructura WHERE id_FisicamenteEstructura='$fisicamenteEn';");


	$funcionario=$objeto->getObtenerInformacionGeneral("SELECT CONCAT_WS(' ',a.nombre,a.apellido) AS nombreFuncionario,(SELECT a1.descripcionFisicamenteEstructura FROM th_fisicamenteestructura AS a1 WHERE a1.id_FisicamenteEstructura=a.fisicamenteEstructura LIMIT 1) AS descripcionInfraestructurasF,(SELECT a1.id_FisicamenteEstructura FROM th_fisicamenteestructura AS a1 WHERE a1.id_FisicamenteEstructura=a.fisicamenteEstructura LIMIT 1) AS idFisicamenteEstructuras FROM th_usuario AS a WHERE a.id_usuario='$idUsuarioEn';");

	$director=$objeto->getObtenerInformacionGeneral("SELECT (SELECT CONCAT_WS(' ',REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(a1.nombre, 'Ã¡', 'á'),'Ã©','é'),'Ã­','í'),'Ã³','ó'),'Ãº','ú'),'Ã‰','É'),'ÃŒ','Í'),'Ã“','Ó'),'Ãš','Ú'),'Ã±','ñ'),'Ã‘','Ñ'),'&#039;',' ` '),'Ã','Á'),'',' '),'Ã','Á'),'SI','SI'),'â€œ',''),'â€',''),'Á²','ó'),REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(a1.apellido, 'Ã¡', 'á'),'Ã©','é'),'Ã­','í'),'Ã³','ó'),'Ãº','ú'),'Ã‰','É'),'ÃŒ','Í'),'Ã“','Ó'),'Ãš','Ú'),'Ã±','ñ'),'Ã‘','Ñ'),'&#039;',' ` '),'Ã','Á'),'',' '),'Ã','Á'),'SI','SI'),'â€œ',''),'â€',''),'Á²','ó')) FROM th_usuario AS a1 WHERE a1.id_usuario=a.PersonaACargo LIMIT 1) AS nombreDirector,(SELECT a1.PersonaACargo FROM th_usuario AS a1 WHERE a1.id_usuario=a.PersonaACargo LIMIT 1) AS PersonaACargoDirector FROM th_usuario AS a WHERE a.id_usuario='$idUsuarioEn';");

	$subsecretarios=$objeto->getObtenerInformacionGeneral("SELECT CONCAT_WS(' ',nombre,apellido) AS nombreSubses FROM th_usuario WHERE id_usuario='".$director[0][PersonaACargoDirector]."';");

	if ($tipoPdf!="asignacionTecho") {

	$finanCompara=false;
	$instaCompara=false;
	$subsesCompara=false;

	/*=====================================================
	=            Rangos ministerio del deporte            =
	=====================================================*/
	
	$corInsta=$objeto->getObtenerInformacionGeneral("SELECT CONCAT_WS(' ',REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(nombre, 'Ã¡', 'á'),'Ã©','é'),'Ã­','í'),'Ã³','ó'),'Ãº','ú'),'Ã‰','É'),'ÃŒ','Í'),'Ã“','Ó'),'Ãš','Ú'),'Ã±','ñ'),'Ã‘','Ñ'),'&#039;',' ` '),'Ã','Á'),'',' '),'Ã','Á'),'SI','SI'),'â€œ',''),'â€',''),'Á²','ó'),REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(apellido, 'Ã¡', 'á'),'Ã©','é'),'Ã­','í'),'Ã³','ó'),'Ãº','ú'),'Ã‰','É'),'ÃŒ','Í'),'Ã“','Ó'),'Ãš','Ú'),'Ã±','ñ'),'Ã‘','Ñ'),'&#039;',' ` '),'Ã','Á'),'',' '),'Ã','Á'),'SI','SI'),'â€œ',''),'â€',''),'Á²','ó')) AS nombreInsta FROM th_usuario AS a INNER JOIN th_usuario_roles AS b ON a.id_usuario=b.id_usuario WHERE b.id_rol='4' AND a.fisicamenteEstructura='1' AND a.estadoUsuario='A' ORDER BY a.id_usuario DESC LIMIT 1;");

	$corFinan=$objeto->getObtenerInformacionGeneral("SELECT CONCAT_WS(' ',REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(nombre, 'Ã¡', 'á'),'Ã©','é'),'Ã­','í'),'Ã³','ó'),'Ãº','ú'),'Ã‰','É'),'ÃŒ','Í'),'Ã“','Ó'),'Ãš','Ú'),'Ã±','ñ'),'Ã‘','Ñ'),'&#039;',' ` '),'Ã','Á'),'',' '),'Ã','Á'),'SI','SI'),'â€œ',''),'â€',''),'Á²','ó'),REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(apellido, 'Ã¡', 'á'),'Ã©','é'),'Ã­','í'),'Ã³','ó'),'Ãº','ú'),'Ã‰','É'),'ÃŒ','Í'),'Ã“','Ó'),'Ãš','Ú'),'Ã±','ñ'),'Ã‘','Ñ'),'&#039;',' ` '),'Ã','Á'),'',' '),'Ã','Á'),'SI','SI'),'â€œ',''),'â€',''),'Á²','ó')) AS nombreFinan FROM th_usuario AS a INNER JOIN th_usuario_roles AS b ON a.id_usuario=b.id_usuario WHERE b.id_rol='4' AND a.fisicamenteEstructura='2' AND a.estadoUsuario='A' ORDER BY a.id_usuario DESC LIMIT 1;");

	$subsesAcFi=$objeto->getObtenerInformacionGeneral("SELECT CONCAT_WS(' ',REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(nombre, 'Ã¡', 'á'),'Ã©','é'),'Ã­','í'),'Ã³','ó'),'Ãº','ú'),'Ã‰','É'),'ÃŒ','Í'),'Ã“','Ó'),'Ãš','Ú'),'Ã±','ñ'),'Ã‘','Ñ'),'&#039;',' ` '),'Ã','Á'),'',' '),'Ã','Á'),'SI','SI'),'â€œ',''),'â€',''),'Á²','ó'),REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(apellido, 'Ã¡', 'á'),'Ã©','é'),'Ã­','í'),'Ã³','ó'),'Ãº','ú'),'Ã‰','É'),'ÃŒ','Í'),'Ã“','Ó'),'Ãš','Ú'),'Ã±','ñ'),'Ã‘','Ñ'),'&#039;',' ` '),'Ã','Á'),'',' '),'Ã','Á'),'SI','SI'),'â€œ',''),'â€',''),'Á²','ó')) AS nombreSubsesA FROM th_usuario AS a INNER JOIN th_usuario_roles AS b ON a.id_usuario=b.id_usuario WHERE b.id_rol='7' AND a.fisicamenteEstructura='26' AND a.estadoUsuario='A' ORDER BY a.id_usuario DESC LIMIT 1;");

	$preliminarEnvio=$objeto->getObtenerInformacionGeneral("SELECT fecha FROM poa_preliminar_envio WHERE idOrganismo='$idOrganismo';");

	$fechaAsinacion=$objeto->getObtenerInformacionGeneral("SELECT fecha,nombreInversion FROM poa_inversion_usuario AS a INNER JOIN poa_inversion AS b ON a.idInversion=b.idInversion WHERE a.idOrganismo='$idOrganismo';");

	$tipoOrganismo=$objeto->getObtenerInformacionGeneral("SELECT b.nombreTipo FROM poa_competencia_organismo_competencia AS a INNER JOIN poa_tipo_organismo AS b ON a.idTipoOrganismo=b.idTipoOrganismo WHERE a.idOrganismo='$idOrganismo' AND (b.nombreTipo LIKE '%ecuatorianas por%' OR b.nombreTipo LIKE '%pico Ecuatoriano%'  OR b.nombreTipo LIKE '%Federaciones Ecuatorianas de Deporte Adaptado%' OR b.nombreTipo LIKE '%Militar Ecuatoriana%' OR b.nombreTipo LIKE '%Policial Ecuatoriana%' OR b.nombreTipo LIKE '%discapacidad%' OR b.nombreTipo LIKE '%adaptado%');");

	$tipoOrganismoDiscapaci=$objeto->getObtenerInformacionGeneral("SELECT b.nombreTipo FROM poa_competencia_organismo_competencia AS a INNER JOIN poa_tipo_organismo AS b ON a.idTipoOrganismo=b.idTipoOrganismo WHERE a.idOrganismo='$idOrganismo' AND b.nombreTipo LIKE '%adaptado%' OR b.nombreTipo LIKE '%discapa%';");

	$tipoOrganismoFormativo=$objeto->getObtenerInformacionGeneral("SELECT b.nombreTipo FROM poa_competencia_organismo_competencia AS a INNER JOIN poa_tipo_organismo AS b ON a.idTipoOrganismo=b.idTipoOrganismo WHERE a.idOrganismo='$idOrganismo' AND b.nombreTipo LIKE '%deportivas provinciales%' OR b.nombreTipo LIKE '%deportivas estudiantiles%' OR b.nombreTipo LIKE '%deportivas estudiantiles%' OR b.nombreTipo LIKE '%ecuador%';");

	$tipoOrganismoAltoRendimiento=$objeto->getObtenerInformacionGeneral("SELECT b.nombreTipo FROM poa_competencia_organismo_competencia AS a INNER JOIN poa_tipo_organismo AS b ON a.idTipoOrganismo=b.idTipoOrganismo WHERE a.idOrganismo='$idOrganismo' AND b.nombreTipo LIKE '%Ecuatoriano%' OR b.nombreTipo LIKE '%Ecuatoriana%' OR b.nombreTipo LIKE '%ecuatorianas%' OR b.nombreTipo LIKE '%por deporte%';");

	$tipoOrganismoRecreativo=$objeto->getObtenerInformacionGeneral("SELECT b.nombreTipo FROM poa_competencia_organismo_competencia AS a INNER JOIN poa_tipo_organismo AS b ON a.idTipoOrganismo=b.idTipoOrganismo WHERE a.idOrganismo='$idOrganismo' AND b.nombreTipo LIKE '%Ligas Deportivas Barriales y Parroquiales del ecuador%' OR b.nombreTipo LIKE '%Asociaciones de ligas barriales y parroquiales%' OR b.nombreTipo LIKE '%Federaciones de ligas provinciales y cantonales, ligas deportivas barriales y parroquiales del Distrito Metropolitano de Quito%';");

	$tipoOrganismoZonales=$objeto->getObtenerInformacionGeneral("SELECT b.nombreTipo FROM poa_competencia_organismo_competencia AS a INNER JOIN poa_tipo_organismo AS b ON a.idTipoOrganismo=b.idTipoOrganismo WHERE a.idOrganismo='$idOrganismo' AND b.nombreTipo LIKE '%deportivas cantonales%' OR b.nombreTipo LIKE '%Deportivas Barriales y Parroquiales%';");


	/*================================================
	=            Suma actividades e itmes            =
	================================================*/
	
	$actividad1=$objeto->getObtenerInformacionGeneral("SELECT SUM(totalSumaItem) AS sumaItem FROM poa_programacion_financiera WHERE idOrganismo='$idOrganismo' AND idActividad='1' GROUP BY idOrganismo;");

	$actividad2=$objeto->getObtenerInformacionGeneral("SELECT SUM(totalSumaItem) AS sumaItem FROM poa_programacion_financiera WHERE idOrganismo='$idOrganismo' AND idActividad='2' GROUP BY idOrganismo;");

	$actividad3=$objeto->getObtenerInformacionGeneral("SELECT SUM(totalSumaItem) AS sumaItem FROM poa_programacion_financiera WHERE idOrganismo='$idOrganismo' AND idActividad='3' GROUP BY idOrganismo;");

	$actividad4=$objeto->getObtenerInformacionGeneral("SELECT SUM(totalSumaItem) AS sumaItem FROM poa_programacion_financiera WHERE idOrganismo='$idOrganismo' AND idActividad='4' GROUP BY idOrganismo;");

	$actividad5=$objeto->getObtenerInformacionGeneral("SELECT SUM(totalSumaItem) AS sumaItem FROM poa_programacion_financiera WHERE idOrganismo='$idOrganismo' AND idActividad='5' GROUP BY idOrganismo;");

	$actividad6=$objeto->getObtenerInformacionGeneral("SELECT SUM(totalSumaItem) AS sumaItem FROM poa_programacion_financiera WHERE idOrganismo='$idOrganismo' AND idActividad='6' GROUP BY idOrganismo;");

	$actividad7=$objeto->getObtenerInformacionGeneral("SELECT SUM(totalSumaItem) AS sumaItem FROM poa_programacion_financiera WHERE idOrganismo='$idOrganismo' AND idActividad='7' GROUP BY idOrganismo;");
	
	/*=====  End of Suma actividades e itmes  ======*/


	/*==================================
	=            Suma meses            =
	==================================*/
	
	$enero=$objeto->getObtenerInformacionGeneral("SELECT SUM(enero) AS enero FROM poa_programacion_financiera WHERE idOrganismo='$idOrganismo' GROUP BY idOrganismo;");
	$febrero=$objeto->getObtenerInformacionGeneral("SELECT SUM(febrero) AS febrero FROM poa_programacion_financiera WHERE idOrganismo='$idOrganismo' GROUP BY idOrganismo;");
	$marzo=$objeto->getObtenerInformacionGeneral("SELECT SUM(marzo) AS marzo FROM poa_programacion_financiera WHERE idOrganismo='$idOrganismo' GROUP BY idOrganismo;");
	$abril=$objeto->getObtenerInformacionGeneral("SELECT SUM(abril) AS abril FROM poa_programacion_financiera WHERE idOrganismo='$idOrganismo' GROUP BY idOrganismo;");
	$mayo=$objeto->getObtenerInformacionGeneral("SELECT SUM(mayo) AS mayo FROM poa_programacion_financiera WHERE idOrganismo='$idOrganismo' GROUP BY idOrganismo;");
	$junio=$objeto->getObtenerInformacionGeneral("SELECT SUM(junio) AS junio FROM poa_programacion_financiera WHERE idOrganismo='$idOrganismo' GROUP BY idOrganismo;");
	$julio=$objeto->getObtenerInformacionGeneral("SELECT SUM(julio) AS julio FROM poa_programacion_financiera WHERE idOrganismo='$idOrganismo' GROUP BY idOrganismo;");
	$agosto=$objeto->getObtenerInformacionGeneral("SELECT SUM(agosto) AS agosto FROM poa_programacion_financiera WHERE idOrganismo='$idOrganismo' GROUP BY idOrganismo;");
	$septiembre=$objeto->getObtenerInformacionGeneral("SELECT SUM(septiembre) AS septiembre FROM poa_programacion_financiera WHERE idOrganismo='$idOrganismo' GROUP BY idOrganismo;");
	$octubre=$objeto->getObtenerInformacionGeneral("SELECT SUM(octubre) AS octubre FROM poa_programacion_financiera WHERE idOrganismo='$idOrganismo' GROUP BY idOrganismo;");
	$noviembre=$objeto->getObtenerInformacionGeneral("SELECT SUM(noviembre) AS noviembre FROM poa_programacion_financiera WHERE idOrganismo='$idOrganismo' GROUP BY idOrganismo;");
	$diciembre=$objeto->getObtenerInformacionGeneral("SELECT SUM(diciembre) AS diciembre FROM poa_programacion_financiera WHERE idOrganismo='$idOrganismo' GROUP BY idOrganismo;");
	
	/*=====  End of Suma meses  ======*/
	
	


	if(!empty($tipoOrganismoDiscapaci[0][nombreTipo])){

		$variableDireccion_c="organizaciones deportivas de Deporte Adaptado para personas con discapacidad";

	}else if(!empty($tipoOrganismoFormativo[0][nombreTipo])){

		$variableDireccion_c="organizaciones deportivas de Deporte formativo";

	}else if(!empty($tipoOrganismoAltoRendimiento[0][nombreTipo])){

		$variableDireccion_c="organizaciones deportivas de Alto rendimiento";

	}else if(!empty($tipoOrganismoRecreativo[0][nombreTipo])){

		$variableDireccion_c="organizaciones deportivas de Recreación";

	}else{

		$variableDireccion_c="organizaciones zonales";

	}


	if (!empty($tipoOrganismo[0][nombreTipo])) {
		$variableTipoOrganizacion="para la Dirección de Deporte Convencional para el Alto Rendimiento y Dirección de Deporte para Personas con Discapacidad";
	}else{
		$variableTipoOrganizacion="para la Dirección de Deporte Formativo y Educación física y Dirección de Recreación";
	}


	/*=====  End of Rangos ministerio del deporte  ======*/

	$arrayAsignacion = explode("-", $fechaAsinacion[0][fecha]);

	setlocale(LC_TIME, "spanish");
	
	$anioAsignacion = date($arrayAsignacion[0]);
	$mesAsignacion=date($arrayAsignacion[1]);
	$dateObjAsignacion   = DateTime::createFromFormat('!m', $mesAsignacion);
	$monthNameAsignacion = strftime('%B', $dateObjAsignacion->getTimestamp());
	$diaAsignacion=date($arrayAsignacion[2]);	


	setlocale(LC_TIME, "spanish");

	$arrayAsignacionDos = explode("-", $preliminarEnvio[0][fecha]);
	
	$anioAsignacionDos = date($arrayAsignacionDos[0]);
	$mesAsignacionDos=date($arrayAsignacionDos[1]);
	$dateObjAsignacionDos   = DateTime::createFromFormat('!m', $mesAsignacionDos);
	$monthNameAsignacionDos = strftime('%B', $dateObjAsignacionDos->getTimestamp());
	$diaAsignacionDos=date($arrayAsignacionDos[2]);	


	if ($funcionario[0][idFisicamenteEstructuras]=="13" OR $funcionario[0][idFisicamenteEstructuras]=="19") {
		
		$subrectariaNombres="SUBSECRETARIA DE DESARROLLO DE LA ACTIVIDAD FÍSICA";

	}else if($funcionario[0][idFisicamenteEstructuras]=="12" OR $funcionario[0][idFisicamenteEstructuras]=="14"){

		$subrectariaNombres="SUBSECRETARIA DE DEPORTE DE ALTO RENDIMIENTO";
		
	}else if($funcionario[0][idFisicamenteEstructuras]=="5" OR $funcionario[0][idFisicamenteEstructuras]=="7"){

		$subrectariaNombres="COORDINACIÓN GENERAL ADMINISTRATIVA FINANCIERA";

	}else if($funcionario[0][idFisicamenteEstructuras]=="6" OR $funcionario[0][idFisicamenteEstructuras]=="15"){
		
		$subrectariaNombres="COORDINACION DE ADMINISTRACION E INFRAESTRUCTURA DEPORTIVA";

	}


	}


	/*==============================
	=            Fechas            =
	==============================*/
	
	setlocale(LC_TIME, "spanish");

	$anio = date('Y');

	$mes=date('m');

	$dateObj   = DateTime::createFromFormat('!m', $mes);
	$monthName = strftime('%B', $dateObj->getTimestamp());

	$dia=date('d');		
	
	/*=====  End of Fechas  ======*/
	



	switch ($tipoPdf) {

		case  "resolucionAprobacion":

			$documentoCuerpo.='

			<table class="tabla__bordadaTresCD">

				<tr>

					<th align="center" style="font-weight:bold;">CONSIDERANDO: </th>

				</tr>

			</table>';

			$documentoCuerpo.='

			<table class="tabla__bordadaTresCD">

				<tr>

					<td style="text-align:justify;">

						<span style="font-weight:bold;">Que</span>, el artículo 226 de la Constitución de la República del Ecuador señala que: “Las instituciones del Estado, sus organismos, dependencias, las servidoras o servidores públicos y las personas que actúen en virtud de una potestad estatal ejercerán solamente las competencias y facultades que les sean atribuidas en la Constitución y la ley. Tendrán el deber de coordinar acciones para el cumplimiento de sus fines y hacer efectivo el goce y ejercicio de los derechos reconocidos en la Constitución”;

					</td>

				</tr>

			</table>

			<table class="tabla__bordadaTresCD">

				<tr>

					<td style="text-align:justify;">

						<span style="font-weight:bold;">Que</span>, el inciso segundo del artículo 297 de la Constitución de la República del Ecuador señala que: “Las instituciones y entidades que reciban o transfieran bienes o recursos públicos se someterán a las normas que las regulan y a los principios y procedimientos de transparencia, rendición de cuentas y control público.”; 

					</td>

				</tr>

			</table>

			<table class="tabla__bordadaTresCD">

				<tr>

					<td style="text-align:justify;">

						<span style="font-weight:bold;">Que</span>, el artículo 381 de Constitución de la República del Ecuador dispone:  “El Estado protegerá, promoverá y coordinará la cultura física que comprende el deporte, la educación física y la recreación, como actividades que contribuyen a la salud, formación y desarrollo integral de las personas; impulsará el acceso masivo al deporte y a las actividades deportivas a nivel formativo, barrial y parroquial; auspiciará la preparación y participación de los deportistas en competencias nacionales e internacionales, que incluyen los Juegos Olímpicos y Paraolímpicos; y fomentará la participación de las personas con discapacidad. El Estado garantizará los recursos y la infraestructura necesaria para estas actividades. Los recursos se sujetarán al control estatal, rendición de cuentas y deberán distribuirse en forma equitativa”; 

					</td>

				</tr>

			</table>

			<table class="tabla__bordadaTresCD">

				<tr>

					<td style="text-align:justify;">

						<span style="font-weight:bold;">Que</span>, el artículo 5 del Código Orgánico de Planificación y Finanzas Públicas establece: “Para la aplicación de las disposiciones contenidas en el presente Código, se observarán los siguientes principios: 1. Sujeción a la planificación. - “La programación, formulación, aprobación, asignación, ejecución, seguimiento y evaluación del Presupuesto General del Estado, los demás presupuestos de las entidades públicas y todos los recursos públicos, se sujetarán a los lineamientos de la planificación del desarrollo de todos los niveles de gobierno, en observancia a lo dispuesto en los artículos 280 y 293 de la Constitución de la República”; 

					</td>

				</tr>

			</table>

			<table class="tabla__bordadaTresCD">

				<tr>

					<td style="text-align:justify;">

						<span style="font-weight:bold;">Que</span>, el artículo 65 del Código Orgánico Administrativo señala: “La competencia es la medida en la que la Constitución y la ley habilitan a un órgano para obrar y cumplir sus fines, en razón de la materia, el territorio, el tiempo y el grado.”;

					</td>

				</tr>

			</table>

			<table class="tabla__bordadaTresCD">

				<tr>

					<td style="text-align:justify;">

						<span style="font-weight:bold;">Que</span>, el artículo 13 de la Ley del Deporte, Educación Física y Recreación establece: “El Ministerio Sectorial es el órgano rector y planificador del deporte, educación física y recreación y le corresponde establecer, ejercer, garantizar y aplicar las políticas, directrices y planes aplicables en las áreas correspondientes para el desarrollo del sector de conformidad con lo dispuesto en la Constitución, leyes, instrumentos internacionales y reglamentos aplicables. (…)”;

					</td>

				</tr>

			</table>

			<table class="tabla__bordadaTresCD">

				<tr>

					<td style="text-align:justify;">

						<span style="font-weight:bold;">Que</span>, el artículo 14 de la Ley del Deporte, Educación Física y Recreación señala: "Las funciones y atribuciones del ministerio son: (...) c) Supervisar y evaluar a las organizaciones deportivas en el cumplimiento de esta Ley y en el correcto uso y destino de los recursos públicos que reciban del Estado, debiendo notificar a la Contraloría General del Estado en el ámbito de sus competencias”; 

					</td>

				</tr>

			</table>

			<table class="tabla__bordadaTresCD">

				<tr>

					<td style="text-align:justify;">

						<span style="font-weight:bold;">Que</span>, el artículo 19 de la  Ley del Deporte, Educación Física y Recreación  establece: "Las organizaciones deportivas que reciban recursos públicos, tendrán la obligación de presentar toda la información pertinente a su gestión financiera, técnica y administrativa al Ministerio Sectorial en el plazo que el reglamento determine”;

					</td>

				</tr>

			</table>


			<table class="tabla__bordadaTresCD">

				<tr>

					<td style="text-align:justify;">

						<span style="font-weight:bold;">Que</span>, el artículo 23 de la Ley del Deporte, Educación Física y Recreación establece: "Las organizaciones deportivas reguladas en esta Ley, podrán implementar mecanismos para la obtención de recursos propios los mismos que deberán ser obligatoriamente reinvertidos en el deporte, educación física y/o recreación, así como también, en la construcción y mantenimiento de infraestructura. // Los recursos de autogestión generados por las organizaciones deportivas serán sujetos de auditoría privada anual y sus informes deberán ser remitidos durante el primer trimestre de cada año, los mismos que serán sujetos de verificación por parte del Ministerio Sectorial”;

					</td>

				</tr>

			</table>

			<table class="tabla__bordadaTresCD">

				<tr>

					<td style="text-align:justify;">

						<span style="font-weight:bold;">Que</span>,  el artículo 130 de la Ley del Deporte, Educación Física y Recreación indica: “(…) La distribución de los fondos públicos a las organizaciones deportivas estará a cargo del Ministerio Sectorial y se realizará de acuerdo a su política, su presupuesto, la planificación anual aprobada enmarcada en el Plan Nacional del Buen Vivir y la Constitución. // Para la asignación presupuestaria desde el deporte formativo hasta de alto rendimiento, se considerarán los siguientes criterios: calidad de gestión sustentada en una matriz de evaluación, que incluya resultados deportivos, impacto social del deporte y su potencial desarrollo, así como la naturaleza de cada organización. Para el caso de la provincia de Galápagos se considerará los costos por su ubicación geográfica. // Para la asignación presupuestaria a la educación física y recreación, se considerarán los siguientes criterios: de igualdad, número de beneficiarios potenciales, el índice de sedentarismo de la localidad y su nivel socioeconómico, así como la naturaleza de cada organización y la infraestructura no desarrollada. (...)”;

					</td>

				</tr>

			</table>

			<table class="tabla__bordadaTresCD">

				<tr>

					<td style="text-align:justify;">

						<span style="font-weight:bold;">Que</span>,  el artículo 134 de la Ley del Deporte, Educación Física y Recreación establece: "El Ministerio Sectorial realizará las transferencias a las organizaciones deportivas de forma mensual y de conformidad a la planificación anual previamente aprobada por el mismo, la política sectorial y el Plan Nacional de Desarrollo. (...)";

					</td>

				</tr>

			</table>


			<table class="tabla__bordadaTresCD">

				<tr>

					<td style="text-align:justify;">

						<span style="font-weight:bold;">Que</span>,  el artículo 138 de la Ley del Deporte, Educación Física y Recreación indica: “Las organizaciones deportivas deberán presentar una evaluación semestral de su planificación anual de acuerdo a la metodología establecida por el Ministerio Sectorial y con los documentos y materiales que prueben la ejecución de los proyectos, en el plazo indicado por el mismo.";

					</td>

				</tr>

			</table>

			<table class="tabla__bordadaTresCD">

				<tr>

					<td style="text-align:justify;">

						<span style="font-weight:bold;">Que</span>,  el artículo 173 de la Ley del Deporte, Educación Física y Recreación establece: “Se contemplan tres tipos de sanciones económicas, a saber:
						<div></div>
						<div>a) Multas;</div>
						<div>b) Suspensión temporal de asignaciones presupuestarias; y,</div>
						<div>c) Retiro definitivo de asignaciones presupuestarias. </div>
						<div>
							No se podrá suspender temporal o definitivamente las asignaciones presupuestarias, sin que previamente se hayan aplicado las multas correspondientes; sin embargo, en el caso en que la organización deportiva no haya registrado su directorio en el Ministerio Sectorial, no haya presentado el plan operativo anual dentro del plazo establecido en la presente Ley, o la información anual requerida, se suspenderá de manera inmediata y sin más trámite las transferencias, hasta que se subsane dicha inobservancia.”;
						</div>

					</td>

				</tr>

			</table>

			<table class="tabla__bordadaTresCD">

				<tr>

					<td style="text-align:justify;">

						<span style="font-weight:bold;">Que</span>,  el artículo 66 del Reglamento Sustitutivo al Reglamento General de la Ley del Deporte, Educación Física y Recreación indica: “Las organizaciones deberán presentar a la Entidad Rectora del Deporte sus planificaciones, hasta 15 días luego de notificado el techo presupuestario por parte de la Entidad Rectora del Deporte”;

					</td>

				</tr>

			</table>

			<table class="tabla__bordadaTresCD">

				<tr>

					<td style="text-align:justify;">

						<span style="font-weight:bold;">Que</span>,  el artículo 1 del Decreto Ejecutivo Nro. 3 de 24 de mayo de 2021, se señala “La Secretaría del Deporte se denominará Ministerio del Deporte. Esta entidad, con excepción del cambio de denominación, mantendrá la misma estructura legal constante en el Decreto Ejecutivo No. 438 publicado en el Suplemento del Registro Oficial No. 278 del 6 de julio de 2018 y demás normativa vigente.”;

					</td>

				</tr>

			</table>


			<table class="tabla__bordadaTresCD">

				<tr>

					<td style="text-align:justify;">

						<span style="font-weight:bold;">Que</span>, el Presidente Constitucional de la República del Ecuador con Decreto Ejecutivo Nro. 24 de 24 de mayo de 2021, designó al señor Juan Sebastián Palacios Muñoz como Ministro de Deporte;

					</td>

				</tr>

			</table>

			<table class="tabla__bordadaTresCD">

				<tr>

					<td style="text-align:justify;">

						<span style="font-weight:bold;">Que</span>, mediante resolución 7 publicada en el Registro Oficial 426 de 12 de febrero de 2019, Expide la REFORMA AL ESTATUTO ORGÁNICO DE GESTIÓN ORGANIZACIONAL POR PROCESOS DE LA SECRETARIA DEL DEPORTE publicado mediante Resolución No. 0034, expedida el 20 de junio de 2016, publicado en el Registro Oficial No. 808 de 29 de julio de 2016;

					</td>

				</tr>

			</table>

			<table class="tabla__bordadaTresCD">

				<tr>

					<td style="text-align:justify;">

						<span style="font-weight:bold;">Que</span>, mediante Resolución Nro. 030 de 29 de mayo de 2020, se expide las Reformas al Estatuto Orgánico de Gestión Organizacional por Procesos de esta entidad;
					</td>

				</tr>

			</table>

			<table class="tabla__bordadaTresCD">

				<tr>

					<td style="text-align:justify;">

						<span style="font-weight:bold;">Que</span>, el artículo 7 del Acuerdo Ministerial Nro. 0456 de 30 de diciembre del 2021 establece: “El Ministerio del Deporte definirá anualmente un Modelo de Asignación de recursos públicos para el financiamiento de la Planificación Operativa Anual de las organizaciones deportivas. // Este modelo contemplará la metodología, variables, indicadores, parámetros y demás criterios de asignación para determinar el porcentaje del recurso público que será distribuido entre todas las organizaciones deportivas que hayan obtenido la aprobación de su Planificación Operativa Anual. Dicho modelo deberá estar alineado con el Plan Decenal del Deporte Educación Física y Recreación, con los objetivos estratégicos institucionales del Ministerio del Deporte y con el Plan Nacional de Desarrollo, de conformidad con lo establecido en el artículo 130 de la Ley del Deporte, Educación Física y Recreación”;
					</td>

				</tr>

			</table>

			<table class="tabla__bordadaTresCD">

				<tr>

					<td style="text-align:justify;">

						<span style="font-weight:bold;">Que</span>, el artículo 12 del Acuerdo Ministerial Nro. 0456 de 30 de diciembre del 2021 establece: “El Ministerio del Deporte, definirá las políticas, instrumentos, actividades, formatos, ítems, requisitos y demás criterios técnicos, que deben ser considerados por parte de las organizaciones deportivas en el proceso de elaboración, presentación y aprobación de su Planificación Operativa Anual; así como, aquellos que deben observarse previa la realización de las transferencias de recursos públicos. (…)”; 
					</td>

				</tr>

			</table>

			<table class="tabla__bordadaTresCD">

				<tr>

					<td style="text-align:justify;">

						<span style="font-weight:bold;">Que</span>, el artículo 17 del Acuerdo Ministerial Nro. 0456 de 30 de diciembre del 2021 indica: “A través del aplicativo informático, y de contarse con los respectivos informes técnicos de viabilidad, el/la titular de la Dirección de Planificación e Inversión del Ministerio del Deporte, verificará que los informes citados en los artículos precedentes se encuentren debidamente motivados y suscritos. Hecho esto, emitirá las correspondientes resoluciones de aprobación a las Planificaciones Operativas Anuales de cada una de las organizaciones deportivas. Dichas resoluciones contendrán, entre otros aspectos, el flujo de transferencias presupuestarias a realizarse. (…)”;  
					</td>

				</tr>

			</table>

			<table class="tabla__bordadaTresCD">

				<tr>

					<td style="text-align:justify;">

						<span style="font-weight:bold;">Que</span>, el artículo 51 del Acuerdo Ministerial Nro. 0456 de 30 de diciembre del 2021 manifiesta: “Las organizaciones deportivas reportarán a través del aplicativo informático los remanentes hasta el 15 de enero de cada año.
					</td>

				</tr>

			</table>


			<table class="tabla__bordadaTresCD">

				<tr>

					<td style="text-align:justify;">

						El/la titular de la Dirección de Seguimiento, Planes, Programas y Proyectos del Ministerio del Deporte, procederá a revisar, analizar y consolidar la información reportada por las organizaciones deportivas. Hecho esto, generará un reporte consolidado de los remanentes, el cual será remitido a:

					</td>

				</tr>

			</table>

			<table class="tabla__bordadaTresCD">

				<tr>

					<td style="text-align:justify;">

						1. Al/la titular de la Dirección de Planificación e Inversión, a fin de que proceda a descontar los remanentes del POA de las asignaciones presupuestarias establecidas para las respectivas Planificaciones Operativas Anuales del ejercicio fiscal vigente; y,

					</td>

				</tr>

			</table>

			<table class="tabla__bordadaTresCD">

				<tr>

					<td style="text-align:justify;">

						2. A los titulares de las áreas técnicas, responsables de los proyectos de inversión a fin de que cuenten con un registro de los remanentes reportados por las organizaciones deportivas respecto a las Planificaciones Anuales de Inversión Deportiva. (…)”;

					</td>

				</tr>

			</table>

			<table class="tabla__bordadaTresCD">

				<tr>

					<td style="text-align:justify;">

						<span style="font-weight:bold;">Que</span>, con memorando Nro. MD-DSPPP-2022-0107 MEM, de 10 de febrero de 2022, la Dirección de Seguimiento de Planes, Programas y Proyectos, notifica los saldos remanentes, a ser descontados a las organizaciones deportivas por concepto de gasto corriente en la Planificación Operativa Anual 2022 que sea aprobada;
					</td>

				</tr>

			</table>

			<table class="tabla__bordadaTresCD">

				<tr>

					<td style="text-align:justify;">

						<span style="font-weight:bold;">Que</span>, con memorando Nro. MD-DSPPP-2022-0115-MEM, de 16 de febrero de 2022, la Dirección de Seguimiento de Planes, Programas y Proyectos, notifica el reporte de cumplimiento de entrega de información de evaluaciones al POA de las organizaciones deportivas por concepto de gasto corriente;
					</td>

				</tr>

			</table>


			<table class="tabla__bordadaTresCD">

				<tr>

					<td style="text-align:justify;">

						<span style="font-weight:bold;">Que</span>, mediante Acción de Personal No. 0317-MD-DATH-2021 de 01 de julio de 2021, se nombra al Mgs. Cristian Gustavo Morales Valencia Director de Planificación e Inversión;
					</td>

				</tr>

			</table>


			<table class="tabla__bordadaTresCD">

				<tr>

					<td style="text-align:justify;">

						<span style="font-weight:bold;">Que</span>, el Estatuto Orgánico de Gestión organizacional por Procesos en el numeral 1.3.1.4.1. Gestión de Planificación e Inversión dentro de sus atribuciones y responsabilidades literal d) establece: “Aprobar las programaciones y reprogramaciones, del Plan Anual de Inversión y Plan Operativo Anual institucional y de organizaciones deportivas, según corresponda; así como emitir las certificaciones y avales.”; 
					</td>

				</tr>

			</table>

			<table class="tabla__bordadaTresCD">

				<tr>

					<td style="text-align:justify;">

						<span style="font-weight:bold;">Que</span>, el Ministerio del Deporte, notifica el techo presupuestario a la '.$informacionCompleto[0][nombreDelOrganismoSegunAcuerdo].' con fecha '.$diaAsignacion.' de '.$monthNameAsignacion.' de '.$anioAsignacion.', mismo que con fecha '.$diaAsignacionDos.' de '.$monthNameAsignacionDos.' de '.$anioAsignacionDos.' realiza el registro y carga de la información correspondiente a la Planificación Operativa Anual en el Aplicativo desarrollado para el efecto.
					</td>

				</tr>

			</table>

			<table class="tabla__bordadaTresCD">

				<tr>

					<td style="text-align:justify;">

						<span style="font-weight:bold;">Que</span>, con Memorando Nro. MD-DPI-2022-0233-MEM de 16 de febrero de 2022, la Dirección e Planificación e Inversión del Ministerio del Deporte, emite la Certificación POA 2022 Gasto Corriente '.$variableTipoOrganizacion.', correspondiente a las tareas: “Transferencia de recursos a '.$variableTipoOrganizacion.'” incluye el 5 por mil para la Contraloría General del Estado .”; 
					</td>

				</tr>

			</table>

			<table class="tabla__bordadaTresCD">

				<tr>

					<td style="text-align:justify;">

						<span style="font-weight:bold;">Que</span>, con Memorando Nro. MD-DF-2022-0193-MEM de 16 de febrero de 2022, la Dirección Financiera del Ministerio del Deporte, emite la certificación presupuestaria '.$variableTipoOrganizacion.', correspondiente a "Transferencia de recursos a '.$rotulo1.'" por el valor de $'.$valor1.' ('.$letras1.') y "Transferencias de recursos a '.$rotulo2.'" por el valor de $'.$valor2.' ('.$letras2.'), incluye el 5 por mil para la Contraloría General del Estado .”; 
					</td>

				</tr>

			</table>

			<table class="tabla__bordadaTresCD">

				<tr>

					<td style="text-align:justify;">

						En ejercicio de las facultades y atribuciones determinadas en el Estatuto Orgánico de Gestión Organizacional por Procesos de esta Cartera de Estado y al Acuerdo Ministerial Nro. 0456 de 30 de diciembre del 2021,
					</td>

				</tr>

			</table>

			';


			$documentoCuerpo.='

			<table class="tabla__bordadaTresCD">

				<tr>

					<th align="center" style="font-weight:bold;">RESUELVE: </th>

				</tr>

			</table>


			<table class="tabla__bordadaTresCD">

				<tr>

					<td style="text-align:justify;">

						<span style="font-weight:bold;">Artículo 1.- </span>, Aprobar la Planificación Operativa Anual del Gasto Corriente correspondiente al ejercicio fiscal 2022 de la '.$informacionCompletoDosI[0][nombreDelOrganismoSegunAcuerdo].'.  Toda vez que, las Direcciones de la Subsecretaría de Deporte de Alto Rendimiento, Subsecretaría de Desarrollo de la Actividad Física, Coordinación de Administración e Infraestructura Deportiva, Coordinación General Administrativa Financiera y unidades de las Coordinaciones Zonales, en coordinación con la Dirección de Planificación e Inversión, han validado la información registrada por la organización deportiva en el Aplicativo POA, éste cumple con los lineamientos definidos para la aprobación de la  Planificación Operativa Anual 2022 del gasto corriente, de conformidad a los informes de revisión remitidos por las unidades involucradas en el proceso de aprobación del POA.; 
					</td>

				</tr>

			</table>


			<table class="tabla__bordadaTresCD">

				<tr>

					<td style="text-align:justify;">

						<span style="font-weight:bold;">Artículo 2.- </span>, La asignación presupuestaria aprobada para el ejercicio fiscal 2022 es de $ '.$fechaAsinacion[0][nombreInversion].' sin incluir el valor del cinco por mil, monto que, conforme a la información validada y aprobada, su Planificación Operativa Anual del Gasto Corriente se distribuye de acuerdo al siguiente detalle: 
					</td>

				</tr>

			</table>

			<br><br>

			<table class="tablas__bordes__necesarias">

				<thead>

					<tr>

						<th align="center">Actividades</th>
						<th align="center">Monto en dolares</th>

					</tr>


				</thead>

				<tbody>

					<tr>

						<td>GESTIÓN ADMINISTRATIVA Y FUNCIONAMIENTO DE ESCENARIOS DEPORTIVOS</td>
						<td>'.$actividad1[0][sumaItem].'</td>

					</tr>

					<tr>

						<td>MANTENIMIENTO DE ESCENARIOS E INFRAESTRUCTURA DEPORTIVA</td>
						<td>'.$actividad2[0][sumaItem].'</td>

					</tr>


					<tr>

						<td>CAPACITACIÓN DEPORTIVA O RECREATIVA</td>
						<td>'.$actividad3[0][sumaItem].'</td>

					</tr>

					<tr>

						<td>OPERACIÓN DEPORTIVA</td>
						<td>'.$actividad4[0][sumaItem].'</td>

					</tr>

					<tr>

						<td>EVENTOS DE PREPARACIÓN Y COMPETENCIA</td>
						<td>'.$actividad5[0][sumaItem].'</td>

					</tr>

					<tr>

						<td>ACTIVIDADES RECREATIVAS</td>
						<td>'.$actividad6[0][sumaItem].'</td>

					</tr>


					<tr>

						<td>IMPLEMENTACIÓN Y EQUIPAMIENTO DEPORTIVO</td>
						<td>'.$actividad7[0][sumaItem].'</td>

					</tr>


					<tr>

						<td>Total</td>
						<td>'.$fechaAsinacion[0][nombreInversion].'</td>

					</tr>

				</tbody>

			</table>

			<table class="tabla__bordadaTresCD">

				<tr>

					<td style="text-align:justify;">

						<span style="font-weight:bold;">Artículo 3.- </span>, El flujo correspondiente de asignación por la Planificación Operativa Anual del gasto corriente del ejercicio fiscal 2022 y una vez descontado el remanente validado por la Dirección de Seguimiento de Planes, Programas y Proyectos se conforma con el siguiente detalle:
					</td>

				</tr>

			</table>

			<br><br>

			<table class="tablas__bordes__necesarias">

				<thead>

					<tr>

						<th align="center" colspan="2">FLUJO APROBADO DE ASIGNACIÓN POA 2022</th>

					</tr>


				</thead>

				<tbody>

					<tr>

						<td>MONTO ASIGNADO</td>
						<td>'.$fechaAsinacion[0][nombreInversion].'</td>

					</tr>

					<tr>

						<td>5 X MIL CONTRALORIA</td>
						<td>'.$cincoMil.'</td>

					</tr>


					<tr>

						<td>MONTO SIN EL CINCO POR MIL</td>
						<td>'.$cincoMilDSin.'</td>

					</tr>

					<tr>

						<td>REMANENTE</td>
						<td>'.$remanentes.'</td>

					</tr>

					<tr>

						<td>MESES</td>
						<td>ASIGNACIÓN MENSUAL</td>

					</tr>

					<tr>

						<td>ENERO</td>
						<td>'.$enero[0][enero].'</td>

					</tr>

					<tr>

						<td>FEBRERO</td>
						<td>'.$febrero[0][febrero].'</td>

					</tr>


					<tr>

						<td>MARZO</td>
						<td>'.$marzo[0][marzo].'</td>

					</tr>


					<tr>

						<td>ABRIL</td>
						<td>'.$abril[0][abril].'</td>

					</tr>


					<tr>

						<td>MAYO</td>
						<td>'.$mayo[0][mayo].'</td>

					</tr>

					<tr>

						<td>JUNIO</td>
						<td>'.$junio[0][junio].'</td>

					</tr>


					<tr>

						<td>JULIO</td>
						<td>'.$julio[0][julio].'</td>

					</tr>

					<tr>

						<td>AGOSTO</td>
						<td>'.$agosto[0][agosto].'</td>

					</tr>

					<tr>

						<td>SEPTIEMBRE</td>
						<td>'.$septiembre[0][septiembre].'</td>

					</tr>


					<tr>

						<td>OCTUBRE</td>
						<td>'.$octubre[0][octubre].'</td>

					</tr>


					<tr>

						<td>NOVIEMBRE</td>
						<td>'.$noviembre[0][noviembre].'</td>

					</tr>

					<tr>

						<td>DICIEMBRE</td>
						<td>'.$diciembre[0][diciembre].'</td>

					</tr>

					<tr>

						<td>TOTAL</td>
						<td>'.$fechaAsinacion[0][nombreInversion].'</td>

					</tr>



				</tbody>

			</table>


			';


			$documentoCuerpo.='

			<table class="tabla__bordadaTresCD">

				<tr>

					<th align="center" style="font-weight:bold;">DISPOSICIONES GENERALES</th>

				</tr>

			</table>

			<table class="tabla__bordadaTresCD">

				<tr>

					<td style="text-align:justify;">

						<span style="font-weight:bold;">PRIMERA. -</span>, El manejo de los recursos públicos transferidos a la Organización Deportiva señalada en la presente resolución, estará sujeta a lo dispuesto en la normativa vigente que regula el manejo, uso y control de los recursos públicos.
					</td>

				</tr>

				<tr>

					<td style="text-align:justify;">

						Corresponderá a las unidades respectivas realizar el monitoreo, seguimiento y evaluación de la ejecución de los recursos económicos conforme a las actividades aprobadas por esta Cartera de Estado. Así mismo, de conformidad al artículo 138 de la Ley del Deporte, Educación Física y Recreación, la organización deportiva remitirá la evaluación semestral del POA en los plazos establecidos.
					</td>

				</tr>



			</table>

			<table class="tabla__bordadaTresCD">

				<tr>

					<td style="text-align:justify;">

						<span style="font-weight:bold;">SEGUNDA. -</span>, La organización deportiva, posterior a la notificación de la presente resolución, deberá presentar al titular de la Dirección Financiera del Ministerio del Deporte los requisitos necesarios para la asignación del recurso, conforme lo establecido en el artículo 20 del Acuerdo Ministerial 0456 de 30 de diciembre del 2021, donde se establece la presentación de requisitos y trasferencia de recursos.
					</td>

				</tr>

			</table>


			<table class="tabla__bordadaTresCD">

				<tr>

					<td style="text-align:justify;">

						<span style="font-weight:bold;">TERCERA. -</span>, Las Direcciones Técnicas del Ministerio del Deporte y Coordinaciones Zonales realizaran la solicitud de transferencia de los recursos asignados a las organizaciones deportivas según el cuadro adjunto:
					</td>

				</tr>

			</table>

			<br><br>


			<table class="tablas__bordes__necesarias">

				<thead>

					<tr>

						<th align="center">MINISTERIO DEL DEPORTE</th>
						<th align="center">TIPO DE ORGANISMO DEPORTIVO</th>

					</tr>


				</thead>

				<tbody>

					<tr>

						<td>Dirección de Deporte Formativo y Educación Física</td>
						<td>Federaciones deportivas provinciales, Federaciones deportivas estudiantiles, Federación Deportiva Nacional Estudiantil (FEDENAES) y Federación Deportiva Nacional de Ecuador (FEDENADOR).</td>

					</tr>

					<tr>

						<td>Deporte Convencional para el Alto Rendimiento</td>
						<td>Comité Olímpico Ecuatoriano (COE), Federación Deportiva Militar Ecuatoriana (FEDEME), Federación Deportiva Policial Ecuatoriana (FEDEPOE), Federaciones Ecuatorianas por Deporte</td>

					</tr>


					<tr>

						<td>Deporte Para Personas con Discapacidad</td>
						<td>Comité Paralímpico Ecuatoriano, Federación Ecuatoriana de Deportes para Personas con Discapacidad Intelectual (FEDEDI), Federación Ecuatoriana de Deportes para Personas con Discapacidad Visual ( FEDEDIV),  Federación Ecuatoriana de Deportes para Personas con Discapacidad Intelectual (FEDEPDAL) y Federación Ecuatoriana de Deportes para Personas con Discapacidad Física (FEDEPDIF) </td>

					</tr>

					<tr>

						<td>Dirección de Recreación</td>
						<td>Federación Nacional de Ligas Deportivas Barriales y Parroquiales del ecuador (FEDENALIGAS), Asociaciones de ligas barriales y parroquiales, Federaciones de ligas provinciales y cantonales, ligas deportivas barriales y parroquiales del Distrito Metropolitano de Quito</td>

					</tr>

					<tr>

						<td>Coordinaciones Zonales</td>
						<td>Ligas deportivas cantonales, Ligas Deportivas Barriales y Parroquiales</td>

					</tr>


				</tbody>

			</table>

			';


			$documentoCuerpo.='

			<table class="tabla__bordadaTresCD">

				<tr>

					<th align="center" style="font-weight:bold;">DISPOSICIONES FINALES</th>

				</tr>

			</table>

			<table class="tabla__bordadaTresCD">

				<tr>

					<td style="text-align:justify;">

						<span style="font-weight:bold;">PRIMERA. -</span> Encárguese a la Dirección de Planificación e Inversión la notificación de la presente resolución a la organización deportiva respectiva, a la (incluir direcciones técnicas), Coordinación General Administrativa Financiera y sus Direcciones, para el registro institucional de archivo y remitir al Registro Oficial para su publicación.
					</td>

				</tr>

			</table>


			<table class="tabla__bordadaTresCD">

				<tr>

					<td style="text-align:justify;">

						<span style="font-weight:bold;">SEGUNDA. -</span> Encárguese a la Dirección de Comunicación Social, publique la presente resolución en la página web de la institución.
					</td>

				</tr>

			</table>


			<table class="tabla__bordadaTresCD">

				<tr>

					<td style="text-align:justify;">

						<span style="font-weight:bold;">TERCERA. -</span> El presente instrumento rige desde la suscripción sin perjuicio de la publicación en el Registro Oficial.
					</td>

				</tr>

			</table>
			<br><br>

			<table class="tabla__bordadaTresCD">

				<tr>

					<td style="text-align:justify;">

						Comuníquese y publíquese. –

					</td>

				</tr>

			</table>

			<table class="tabla__bordadaTresCD">

				<tr>

					<td style="text-align:justify;">
	 
						Por delegación de la máxima autoridad.
						
					</td>

				</tr>

			</table>

			';



			/*===================================
			=            Generar pdf            =
			===================================*/

			$parametro1="../../documentos/resolucionAprobacion/";
			$parametro2="resolucionAprobacion";	
			$parametro3=$idOrganismo;
			
			/*=====  End of Generar pdf  ======*/
			
		break;	

		case  "informeTecnico":

			$documentoCuerpo='

			<table class="tabla__bordadaTresCD">

				<tr>

					<th align="center">'.$subrectariaNombres.'</th>

				</tr>


				<tr>

					<th align="center">'.$funcionario[0][descripcionInfraestructurasF].'</th>

				</tr>

			</table>

			<br>
			<br>

			<table class="tabla__bordadaTresCD">

				<tr>

					<th align="center">INFORME DE VIABILIDAD TÉCNICA DE LA PLANIFICACIÓN OPERATIVA ANUAL POA </th>

				</tr>

				<tr>

					<th align="center">ORGANIZACIONES DEPORTIVAS  '.$anio.'</th>

				</tr>

			</table>

			<br>

			<table class="tabla__bordadaTresCD">

				<tr>


					<td align="left">

						<span class="enfacis__letras">Numeración y/o Codificación:</span>'.$informacionCompleto[0][idInversion].'

					</td>

					<td align="right">

						<span class="enfacis__letras">Fecha de elaboración:</span>'.$dia.' de '. ucwords($monthName).' del '.$anio.' 

					</td>


				<tr>	

			</table>

			<br>

			<br>


			<table class="tabla__bordadaTresCD">

				<tr>


					<th align="left">

						ANTECEDENTE

					</th>

				<tr>	

			</table>	

			<br>		

			<table class="tabla__bordadaTresCD">

				<tr>


					<th style="text-align:justify;">

						El Acuerdo Ministerial 456 denominado <span style="font-style: oblique;">“PROCEDIMIENTO QUE REGULA EL CICLO DE PLANIFICACIÓN DE LAS ORGANIZACIONES DEPORTIVAS”</span> determina: 

					</th>

				<tr>	

			</table>

			<br>

			<table class="tabla__bordadaTresCD">

				<tr>


					<td style="text-align:justify; font-style: oblique;">

						<span class="enfacis__letras">Artículo 5. De la Planificación anual de actividades deportivas:</span> Comprende el conjunto de  actividades vinculadas al deporte, actividad física y/o recreación que las organizaciones deportivas  ejecutarán dentro del correspondiente ejercicio fiscal, financiadas con recursos públicos, orientadas al  cumplimiento de objetivos y metas propias, articuladas al Plan Decenal del Deporte Educación Física y Recreación, a la Planificación Estratégica Institucional del Ministerio del Deporte y al Plan Nacional de  Desarrollo. 
					</td>

				<tr>	

			</table>	

			<table class="tabla__bordadaTresCD">

				<tr>

					<td style="text-align:justify; font-style: oblique;">

						La Planificación Anual de Actividades Deportivas estará compuesta por la Planificación Operativa Anual  y la Planificación Anual de Inversión Deportiva.

					</td>

				</tr>

			</table>			


			<table class="tabla__bordadaTresCD">

				<tr>


					<td style="text-align:justify; font-style: oblique;">

						<span class="enfacis__letras">Artículo 6. De La Planificación Operativa Anual.-</span> constituye una herramienta que permite estructurar el conjunto de actividades y/o tareas vinculadas al  fomento del deporte, educación física y recreación; rehabilitación, readecuación y/o mantenimiento de los  escenarios e infraestructura deportiva; así como, aquellos relacionados a la gestión administrativa, las cuales serán definidas por la organización deportiva conforme los lineamientos generados para el efecto por el Ministerio del Deporte para el correspondiente ejercicio fiscal. Su fin es contribuir al cumplimiento  de los objetivos y metas propios, los institucionales y los del Plan Nacional de Desarrollo.
					</td>

				<tr>	

			</table>

			<table class="tabla__bordadaTresCD">

				<tr>

					<td style="text-align:justify; font-style: oblique;">

						Esta herramienta permite estimar y planificar la asignación presupuestaria necesaria para la realización de las citadas actividades y tareas; así como, verificar el cumplimiento de los objetivos, metas e indicadores.

					</td>

				</tr>

			</table>	

			<table class="tabla__bordadaTresCD">

				<tr>

					<td style="text-align:justify; font-style: oblique;">

						La Planificación Operativa Anual de las organizaciones deportivas será financiada a través del recurso de gasto permanente asignado por el Ministerio del Deporte.

					</td>

				</tr>

			</table>	

			<table class="tabla__bordadaTresCD">

				<tr>

					<td style="text-align:justify; font-style: oblique;">

						<span class="enfacis__letras">Artículo 8. De las actividades vinculadas al fomento deportivo, actividad física y recreación.- </span> Comprenden el conjunto de actividades orientadas a promover y ejecutar capacitaciones, concentraciones, campamentos y/o base de entrenamientos, evaluaciones deportivas, campeonatos y/o selectivos, juegos, actividades recreativas, implementación y equipamiento deportivo, y otras definidas por el Ministerio del Deporte.

					</td>

				</tr>

				<tr>

					<td style="text-align:justify; font-style: oblique;">

						Se consideran parte de estas actividades, aquellas relacionadas a financiar sueldos, salarios u honorarios profesionales del equipo técnico que forma parte de la organización deportiva, entendido como parte de este a todo profesional que colabora con los y las deportistas en su preparación física, entrenamiento, servicios médicos, nutrición, psicología, y otros específicos relacionados a la particularidad de cada tipo de deporte o actividad física.

					</td>

				</tr>

			</table>	


			<br>
			<br>

			<table class="tabla__bordadaTresCD">

				<tr>

					<td style="text-align:justify;">

						<span class="enfacis__letras">DESARROLLO:</span>

					</td>

				</tr>

			</table>	

			<br>

			<table class="tabla__bordadaTresCD">

				<tr>

					<td style="text-align:justify;">

						El Ministerio del Deporte por medio de la Dirección de Planificación e Inversión notificó el Techo Presupuestario de '.number_format((float)$informacionCompletoDosI[0][nombreInversion], 2, '.', '').' al organismo '.$informacionCompletoDosI[0][nombreDelOrganismoSegunAcuerdo].' para la Planificación Operativa Anual POA '.$anio.' con fecha '.$dia.'/'.$mes.'/'.$anio.'.

					</td>

				</tr>

			</table>



			<table class="tabla__bordadaTresCD">

				<tr>

					<td style="text-align:justify;">

						El organismo '.$informacionCompletoDosI[0][nombreDelOrganismoSegunAcuerdo].'  realiza la carga de la Planificación Operativa Anual POA '.$anio.' con fecha '.$dia.'/'.$mes.'/'.$anio.' en cumplimiento a lo establecido en el artículo 15 del Acuerdo Ministerial 456 denominado: <span style="font-style: oblique;">“Procedimiento que regula el ciclo de planificación de las organizaciones deportivas”</span>.

					</td>

				</tr>

			</table>


			<table class="tabla__bordadaTresCD">

				<tr>

					<td style="text-align:justify;">

						En referencia a lo mencionado, la <span class="enfacis__letras">'.$fisicamenteDireccion[0][descripcionFisicamenteEstructura].'</span> procede a realizar el siguiente análisis:

					</td>

				</tr>

			</table>


			';

			if ($fisicamenteEn!=12 && $fisicamenteEn!=14) {

			$documentoCuerpo.='
				<br>

				<table class="tablas__bordes__necesarias">

					<thead>

						<tr style="padding:2em; background:#0d47a1; color:white;">

							<th align="center">N°</th>
							<th align="center">CONDICIÓN</th>
							<th align="center">CUMPLE</th>
							<th align="center">OBSERVACIONES PARA LA ORGANIZACIÓN DEPORTIVA</th>

						</tr>


					</thead>

					<tbody>';

			}



			if ($fisicamenteEn==12 || $fisicamenteEn==14) {
				
				$documentoCuerpo.='

					<table class="tablas__bordes__necesarias">
				';


				if (!empty($salario3)) {
					
					$documentoCuerpo.='

						<tr style="padding:2em; background:#0d47a1; color:white;">

							<th colspan="3" rowspan="2" style="vertical-align:middle;">
								003 CAPACITACIÓN DEPORTIVA O RECREATIVA
							</th>

							<th colspan="1" rowspan="1" style="vertical-align:middle;">
								MONTO POA
							</th>

						</tr>

						<tr style="padding:2em; background:#0d47a1; color:white;">

							<th colspan="1" rowspan="1" style="vertical-align:middle;">
								'.$salario3.'
							</th>

						</tr>

						<tr style="padding:2em; background:#0d47a1; color:white;">

							<th>N°</th>
							<th align="center">ANÁLISIS DE LA CONDICIÓN</th>
							<th>CUMPLE</th>
							<th>OBSERVACIONES PARA LA<br>ORGANIZACIÓN<br>DEPORTIVA<br>(MANDATORIA)</th>

						</tr>


						<tr>

							<td align="center">1</td>
							<td style="text-align:justify;">REGISTRA EN LA PROGRAMACION DEPORTIVA ANUAL ACTIVIDADES CORRESPONDIENTES A LA ACTIVIDAD 003 GASTOS EN TEMAS DE CAPACITACIÓN DEPORTIVA</td>
							<td align="center">'.$gastosCapacitacion.'</td>
							<td style="text-align:justify;">'.$text_gastosCapacitacion.'</td>

						</tr>


						<tr>

							<td align="center">2</td>
							<td style="text-align:justify;">REGISTRA EVENTOS DE CAPACITACIÓN (TALLERES, SEMINARIOS, CONGRESOS, ETC) PARA PARA CIENCIAS APLICADAS DE MANERA PROGRESIVA ORIENTADOS A ATLETAS, FUERZA TÉCNICA, CIENCIAS APLICADAS, DIRECTIVOS Y PERSONAL DE JUZGAMIENTO</td>
							<td align="center">'.$talleresSeminarios.'</td>
							<td style="text-align:justify;">'.$text_talleresSeminarios.'</td>

						</tr>


					';


				}


				if (!empty($salario4)) {
					
					$documentoCuerpo.='

						<tr>

							<th colspan="3" rowspan="2" style="vertical-align:middle; padding:2em; background:#0d47a1; color:white;">
								004 OPERACIÓN DEPORTIVA
							</th>

							<th colspan="1" rowspan="1" style="vertical-align:middle; padding:2em; background:#0d47a1; color:white;">
								MONTO POA
							</th>

						</tr>

						<tr>

							<th colspan="1" rowspan="1" style="vertical-align:middle; padding:2em; background:#0d47a1; color:white;">
								'.$salario4.'
							</th>

						</tr>

						<tr>

							<th>N°</th>
							<th align="center">ANÁLISIS DE LA CONDICIÓN</th>
							<th>CUMPLE</th>
							<th>OBSERVACIONES PARA LA<br>ORGANIZACIÓN<br>DEPORTIVA<br>(MANDATORIA)</th>

						</tr>


						<tr>

							<td align="center">1</td>
							<td style="text-align:justify;">REGISTRA LOS RECURSOS DESTINADOS PARA SUELDOS Y SALARIOS DE ENTRENADORES, EQUIPO TÉCNICO DE APOYO (MONITOR, INSTRUCTOR), EQUPO TÉCNICO DE CIENCIAS APLICADAS, Y ESTÁ ACORDE AL OBJETO DEL ORGANISMO DEPORTIVO</td>
							<td align="center">'.$recursosSueldos.'</td>
							<td style="text-align:justify;">'.$text_recursosSueldos.'</td>

						</tr>


						<tr>

							<td align="center">2</td>
							<td style="text-align:justify;">NO SE HAN CREADO NUEVOS PUESTOS DE TRABAJO DE TÉCNICOS EN RELACIÓN AL POA OD 2021</td>
							<td align="center">'.$noCreacionP.'</td>
							<td style="text-align:justify;">'.$text_noCreacionP.'</td>

						</tr>

						<tr>

							<td align="center">3</td>
							<td style="text-align:justify;">EL ORGANISMO DEPORTIVO NO INCREMENTA EL MONTO TOTAL DE HONORARIOS DEL PERSONAL TÉCNICO RESPECTO DEL POA OD 2021</td>
							<td align="center">'.$noIncrementaH.'</td>
							<td style="text-align:justify;">'.$text_noIncrementaH.'</td>

						</tr>

						<tr>

							<td align="center">4</td>
							<td style="text-align:justify;">LOS RECURSOS DESTINADOS PARA SUELDOS Y SALARIOS DE ENTRENADORES, EQUIPO TÉCNICO DE APOYO (MONITOR, INSTRUCTOR), EQUPO TÉCNICO DE CIENCIAS APLICADAS, ESTÁN ACORDE A LA PRIORIDAD DEPORTIVA DE LA INSITUCIÓN </td>
							<td align="center">'.$prioridadInstitucion.'</td>
							<td style="text-align:justify;">'.$text_prioridadInstitucion.'</td>

						</tr>


					';


				}

				if (!empty($salario5)) {
					
					$documentoCuerpo.='

						<tr>

							<th colspan="3" rowspan="2" style="vertical-align:middle; padding:2em; background:#0d47a1; color:white;">
								005 EVENTOS DE PREPARACIÓN Y COMPETENCIA
							</th>

							<th colspan="1" rowspan="1" style="vertical-align:middle; padding:2em; background:#0d47a1; color:white;">
								MONTO POA
							</th>

						</tr>

						<tr>

							<th colspan="1" rowspan="1" style="vertical-align:middle; padding:2em; background:#0d47a1; color:white;">
								'.$salario5.'
							</th>

						</tr>

						<tr style="vertical-align:middle; padding:2em; background:#0d47a1; color:white;">

							<th>N°</th>
							<th align="center">ANÁLISIS DE LA CONDICIÓN</th>
							<th>CUMPLE</th>
							<th>OBSERVACIONES PARA LA<br>ORGANIZACIÓN<br>DEPORTIVA<br>(MANDATORIA)</th>

						</tr>


						<tr>

							<td align="center">1</td>
							<td style="text-align:justify;">REGISTRA EN LAS ACTIVIDADES DEPORTIVAS CORRESPONDIENTES A LA ACTIVIDAD  CONCENTRADO, CAMPAMENTO, BASE DE ENTRENAMIENTO, EVALUACIONES Y CAMPEONATO ACORDE A LA PRIORIDAD DE LA DISCIPLIAN DEPORTIVA</td>
							<td align="center">'.$registraConcentrado.'</td>
							<td style="text-align:justify;">'.$text_registraConcentrado.'</td>

						</tr>


						<tr>

							<td align="center">2</td>
							<td style="text-align:justify;">PRESENTA EL CERTIFICADO DE VALIDACIÓN DE EVENTOS, SUSCRITO POR EL DIRECTOR TÉCNICO METODOLÓGICO (SOLO PROVINCIALES)</td>
							<td align="center">'.$certificadoValidacion.'</td>
							<td style="text-align:justify;">'.$text_certificadoValidacion.'</td>

						</tr>

						<tr>

							<td align="center">3</td>
							<td style="text-align:justify;">LA PLANIFICACIÓN DEL INDICADOR COINCIDE CON LOS EVENTOS DEPORTIVOS PLANIFICADOS </td>
							<td align="center">'.$coincidePla.'</td>
							<td style="text-align:justify;">'.$text_coincidePla.'</td>

						</tr>

						<tr>

							<td align="center">4</td>
							<td style="text-align:justify;">UTILIZA LA SINTAXIS CLARA PARA EL REGISTRO DE LOS EVENTOS</td>
							<td align="center">'.$sintaxisClaraRe.'</td>
							<td style="text-align:justify;">'.$text_sintaxisClaraRe.'</td>

						</tr>


						<tr>

							<td align="center">5</td>
							<td style="text-align:justify;">REGISTRA CONCENTRADO, CAMPAMENTO, BASE DE ENTRENAMIENTO, EVALUACIONES Y CAMPEONATO PARA LA CATEGORÍA MENORES, PREJUVENIL, JUVENIL Y ABSOLUTO A NIVEL INTERNACIONAL</td>
							<td align="center">'.$registraConcentradoA5Inter.'</td>
							<td style="text-align:justify;">'.$text_registraConcentradoA5Inter.'</td>

						</tr>



						<tr>

							<td align="center">6</td>
							<td style="text-align:justify;">REGISTRA CONCENTRADO, CAMPAMENTO, BASE DE ENTRENAMIENTO, EVALUACIONES Y CAMPEONATO PARA LA CATEGORÍA MENORES, PREJUVENIL, JUVENIL Y ABSOLUTO A NIVEL NACIONAL</td>
							<td align="center">'.$registraConcentradoA5Nacio.'</td>
							<td style="text-align:justify;">'.$text_registraConcentradoA5Nacio.'</td>

						</tr>



						<tr>

							<td align="center">7</td>
							<td style="text-align:justify;">UTILIZA RECURSOS PARA CUBRIR GASTOS AUTORIZADOS DE: PASAJES, ALIMENTACIÓN, HOSPEDAJE,  HIDRATACIÓN, MEDICINAS, ATENCIÓN MÉDICA, HONORARIOS DE ÁRBITROS Y JUECES, UNIFORMES, MOVILIZACIÓN INTERNA Y AL EXTERIOR DE LA DELEGACIÓN</td>
							<td align="center">'.$gastosDelega.'</td>
							<td style="text-align:justify;">'.$text_gastosDelega.'</td>

						</tr>


						<tr>

							<td align="center">8</td>
							<td style="text-align:justify;">UTILIZA RECURSOS PARA CUBRIR PAGOS POR CONCEPTO DE SEGUROS Y BONO DEPORTIVO EN CONCENTRADO, CAMPAMENTO, BASE DE ENTRENAMIENTO, EVALUACIONES Y CAMPEONATO A NIVEL INTERNACIONAL</td>
							<td align="center">'.$segurosBonosI.'</td>
							<td style="text-align:justify;">'.$text_segurosBonosI.'</td>

						</tr>


						<tr>

							<td align="center">9</td>
							<td style="text-align:justify;">LA PLANIFICACIÓN OPERATIVA ANUAL DEL ORGANISMO DEPORTIVO SE ENCUENTRA ENMARCADA EN LO ESTABLECIDO EN EL ACUERDO MINISTERIAL 456 Y EL ACUERDO MINISTERIAL 457.</td>
							<td align="center">'.$acuerdoC7.'</td>
							<td style="text-align:justify;">'.$text_acuerdoC7.'</td>

						</tr>




					';


				}


				if (!empty($salario6)) {
					
					$documentoCuerpo.='

						<tr>

							<th colspan="3" rowspan="2" style="vertical-align:middle; padding:2em; background:#0d47a1; color:white;">
								006 ACTIVIDADES RECREATIVAS
							</th>

							<th colspan="1" rowspan="1" style="vertical-align:middle; padding:2em; background:#0d47a1; color:white;">
								MONTO POA
							</th>

						</tr>

						<tr>

							<th colspan="1" rowspan="1" style="vertical-align:middle; padding:2em; background:#0d47a1; color:white;">
								'.$salario6.'
							</th>

						</tr>

						<tr style="vertical-align:middle; padding:2em; background:#0d47a1; color:white;">

							<th>N°</th>
							<th align="center">ANÁLISIS DE LA CONDICIÓN</th>
							<th>CUMPLE</th>
							<th>OBSERVACIONES PARA LA<br>ORGANIZACIÓN<br>DEPORTIVA<br>(MANDATORIA)</th>

						</tr>


						<tr>

							<td align="center">1</td>
							<td style="text-align:justify;">REGISTRA EN LA PROGRAMACION DEPORTIVA ANUAL ACTIVIDADES  006 ACTIVIDADES RECREATIVAS</td>
							<td align="center">'.$actividadesSe.'</td>
							<td style="text-align:justify;">'.$text_actividadesSe.'</td>

						</tr>


						<tr>

							<td align="center">2</td>
							<td style="text-align:justify;">UTILIZA RECURSOS PARA CUBRIR PAGOS POR CONCEPTO DE: MOVILIZACIÓN, ALIMENTACIÓN, HOSPEDAJE, INSCRIPCIONES, MEDICINAS, ATENCIÓN MÉDICA, HONORARIOS ÁRBITROS Y JUECES, INAUGURACIÓN Y CLAUSURA DEL EVENTO</td>
							<td align="center">'.$moMed.'</td>
							<td style="text-align:justify;">'.$text_moMed.'</td>

						</tr>


					';


				}



				if (!empty($salario7)) {
					
					$documentoCuerpo.='

						<tr>

							<th colspan="3" rowspan="2" style="vertical-align:middle; padding:2em; background:#0d47a1; color:white;">
								007 IMPLEMENTACIÓN DEPORTIVA
							</th>

							<th colspan="1" rowspan="1" style="vertical-align:middle; padding:2em; background:#0d47a1; color:white;">
								MONTO POA
							</th>

						</tr>

						<tr>

							<th colspan="1" rowspan="1" style="vertical-align:middle; padding:2em; background:#0d47a1; color:white;">
								'.$salario7.'
							</th>

						</tr>

						<tr style="vertical-align:middle; padding:2em; background:#0d47a1; color:white;">

							<th>N°</th>
							<th align="center">ANÁLISIS DE LA CONDICIÓN</th>
							<th>CUMPLE</th>
							<th>OBSERVACIONES PARA LA<br>ORGANIZACIÓN<br>DEPORTIVA<br>(MANDATORIA)</th>

						</tr>


						<tr>

							<td align="center">1</td>
							<td style="text-align:justify;">EN EL CASO QUE PLANIFIQUE  IMPLEMENTACIÓN Y EQUIPAMIENTO DEPORTIVO REGISTRA EL DETALLE Y CANTIDADES REQUERIDAS DE CADA  IMPLEMENTO Y EQUIPO DEPORTIVO.</td>
							<td align="center">'.$implementaEqui.'</td>
							<td style="text-align:justify;">'.$text_implementaEqui.'</td>

						</tr>


						<tr>

							<td align="center">2</td>
							<td style="text-align:justify;">UTILIZA  RECURSOS PARA LA COMPRA DE  IMPLEMENTACIÓN Y EQUIPAMIENTO DEPORTIVO ACORDE A LA NORMATIVA TÉCNICA DE LAS DISCIPLINAS DEPORTIVAS</td>
							<td align="center">'.$comprasDisci.'</td>
							<td style="text-align:justify;">'.$text_comprasDisci.'</td>

						</tr>


					';


				}


				$documentoCuerpo.='

						<tr>

							<th colspan="4" rowspan="1" style="vertical-align:middle; padding:2em; background:#0d47a1; color:white;">
								CONDICIÓNES GENERALES
							</th>

	
						</tr>


						<tr style="vertical-align:middle; padding:2em; background:#0d47a1; color:white;">

							<th>N°</th>
							<th align="center">ANÁLISIS DE LA CONDICIÓN</th>
							<th>CUMPLE</th>
							<th>OBSERVACIONES PARA LA<br>ORGANIZACIÓN<br>DEPORTIVA<br>(MANDATORIA)</th>

						</tr>


						<tr>

							<td align="center">1</td>
							<td style="text-align:justify;">LA PLANIFICACIÓN OPERATIVA ANUAL DEL ORGANISMO DEPORTIVO SE ENCUENTRA ENMARCADA EN LO ESTABLECIDO EN EL ACUERDO MINISTERIAL 456 Y EL ACUERDO MINISTERIAL 457.</td>
							<td align="center">'.$enmarcada456.'</td>
							<td style="text-align:justify;">'.$text_enmarcada456.'</td>

						</tr>

						<tr style="vertical-align:middle; padding:2em; background:#0d47a1; color:white;">

							<th>N°</th>
							<th colspan="2" align="center">RESUMEN DE PRESUPUESTO POR ACTIVIDAD</th>
							<th>MONTO POA</th>

						</tr>


				';

				if (!empty($salario3)) {

				$documentoCuerpo.='

					<tr>

						<td colspan="1" rowspan="1" style="vertical-align:middle;">
							003 
						</td>

	
						<td colspan="2" rowspan="1" style="vertical-align:middle;">
							CAPACITACIÓN DEPORTIVA O RECREATIVA
						</td>	

						<td colspan="1" rowspan="1" style="vertical-align:middle;">
							'.$salario3.'
						</td>	

					</tr>


				';

				}


				if (!empty($salario4)) {

				$documentoCuerpo.='

					<tr>

						<td colspan="1" rowspan="1" style="vertical-align:middle;">
							004
						</td>

	
						<td colspan="2" rowspan="1" style="vertical-align:middle;">
							OPERACIÓN DEPORTIVA
						</td>	

						<td colspan="1" rowspan="1" style="vertical-align:middle;">
							'.$salario4.'
						</td>	

					</tr>


				';

				}

				if (!empty($salario5)) {

				$documentoCuerpo.='

					<tr>

						<td colspan="1" rowspan="1" style="vertical-align:middle;">
							005
						</td>

	
						<td colspan="2" rowspan="1" style="vertical-align:middle;">
							EVENTOS DE PREPARACIÓN Y COMPETENCIA
						</td>	

						<td colspan="1" rowspan="1" style="vertical-align:middle;">
							'.$salario5.'
						</td>	

					</tr>


				';

				}

				if (!empty($salario6)) {

				$documentoCuerpo.='

					<tr>

						<td colspan="1" rowspan="1" style="vertical-align:middle;">
							006
						</td>

	
						<td colspan="2" rowspan="1" style="vertical-align:middle;">
							ACTIVIDADES RECREATIVAS
						</td>	

						<td colspan="1" rowspan="1" style="vertical-align:middle;">
							'.$salario6.'
						</td>	

					</tr>


				';

				}

				if (!empty($salario7)) {

				$documentoCuerpo.='

					<tr>

						<td colspan="1" rowspan="1" style="vertical-align:middle;">
							007
						</td>

	
						<td colspan="2" rowspan="1" style="vertical-align:middle;">
							IMPLEMENTACIÓN DEPORTIVA
						</td>	

						<td colspan="1" rowspan="1" style="vertical-align:middle;">
							'.$salario7.'
						</td>	

					</tr>


				';

				}


			}



			if ($fisicamenteEn==13 || $fisicamenteEn==19 || $fisicamenteEn=="subsecretariaSubse") {

				if ($fisicamenteEn=="subsecretariaSubse") {
					$subsesCompara=true;
				}
				
				$documentoCuerpo.='

						<tr>

							<td align="center">1</td>
							<td style="text-align:justify;">La meta anual del indicador coincide  con el No. de eventos planificados  en el PDA</td>
							<td align="center">'.$numerosEventosPlanificadosPda.'</td>
							<td style="text-align:justify;">'.$text_numerosEventosPlanificadosPda.'</td>

						</tr>
			
						<tr>

							<td align="center">2</td>
							<td style="text-align:justify;">Utiliza la sintaxis clara (verbos en infinitivo) para el registro de los eventos</td>
							<td align="center">'.$sintaxis__clara.'</td>
							<td style="text-align:justify;">'.$text_sintaxis__clara.'</td>

						</tr>

						<tr>

							<td align="center">3</td>
							<td style="text-align:justify;">Presenta el certificado de validación de eventos, registrados en el PDA suscrito por el director técnico metodológico (solo provinciales)</td>
							<td align="center">'.$validacionEventos.'</td>
							<td style="text-align:justify;">'.$text_validacionEventos.'</td>

						</tr>

						<tr>

							<td align="center">4</td>
							<td style="text-align:justify;">Detalla satisfactoriamente la contratación o  adquisición de bienes o servicios orientados al fomento deportivo de acuerdo a la característica del deporte (implementación deportiva) con la debida justificación técnica</td>
							<td align="center">'.$detalleContratacion.'</td>
							<td style="text-align:justify;">'.$text_detalleContratacion.'</td>

						</tr>


						<tr>

							<td align="center">5</td>
							<td style="text-align:justify;">No se han incrementado nuevos puestos de trabajo de técnicos en relación de dependencia con respecto al POA OD 2021</td>
							<td align="center">'.$nuevosPuestos.'</td>
							<td style="text-align:justify;">'.$text_nuevosPuestos.'</td>

						</tr>

						<tr>

							<td align="center">6</td>
							<td style="text-align:justify;">Justifica satisfactoriamente la contratación de personal técnico bajo la modalidad de contratos de servicios de honorarios profesionales</td>
							<td align="center">'.$justificaTecnico.'</td>
							<td style="text-align:justify;">'.$text_justificaTecnico.'</td>

						</tr>

						<tr>

							<td align="center">7</td>
							<td style="text-align:justify;">En caso que planifique bienes de larga duración presenta el informe justificado de acuerdo a la característica del deporte para implementación deportiva, equipos tecnológicos y electrónicos</td>
							<td align="center">'.$bienesLarga.'</td>
							<td style="text-align:justify;">'.$text_bienesLarga.'</td>

						</tr>

						<tr>

							<td align="center">8</td>
							<td style="text-align:justify;">Planifica seguros contra accidentes, vida y de salud para los deportistas que participarán en los eventos deportivos.</td>
							<td align="center">'.$seguroAccidentes.'</td>
							<td style="text-align:justify;">'.$text_seguroAccidentes.'</td>

						</tr>

						<tr>

							<td align="center">9</td>
							<td style="text-align:justify;">Detalla las especificaciones de la implementación y equipamiento deportivo que sea adquirido por cada deporte beneficiario y demuestre la no duplicidad en el presente año fiscal.</td>
							<td align="center">'.$detalleImplementacion.'</td>
							<td style="text-align:justify;">'.$text_detalleImplementacion.'</td>

						</tr>


						<tr>

							<td align="center">10</td>
							<td style="text-align:justify;">La Planificación Operativa Anual del Organismo Deportivo se encuentra enmarcada en lo establecido en el Acuerdo Ministerial 456 y el Acuerdo Ministerial 457.</td>
							<td align="center">'.$acuerdoEnmarcado.'</td>
							<td style="text-align:justify;">'.$text_acuerdoEnmarcado.'</td>

						</tr>



				';

			}


			if ($fisicamenteEn==5) {
				
				$documentoCuerpo.='

						<tr>

							<td align="center">1</td>
							<td style="text-align:justify;">etalla satisfactoriamente la contratación o adquisición de bienes o servicios</td>
							<td align="center">'.$detallaContratacion.'</td>
							<td style="text-align:justify;">'.$text_detallaContratacion.'</td>

						</tr>
			
						<tr>

							<td align="center">2</td>
							<td style="text-align:justify;">Justifica satisfactoriamente la contratación o adquisición del bien o servicio</td>
							<td align="center">'.$adquisicionBien.'</td>
							<td style="text-align:justify;">'.$text_adquisicionBien.'</td>

						</tr>

						<tr>

							<td align="center">3</td>
							<td style="text-align:justify;">El monto total de la actividad 001 correspondientes a los grupos 53 y 57, no excede el valor total aprobado para esta misma actividad y grupo de gasto en el 2021</td>
							<td align="center">'.$montoAc53.'</td>
							<td style="text-align:justify;">'.$text_montoAc53.'</td>

						</tr>

						<tr>

							<td align="center">4</td>
							<td style="text-align:justify;">Describe la actividad que justifica el pago de impuestos, tasas y contribuciones</td>
							<td align="center">'.$tasasContri.'</td>
							<td style="text-align:justify;">'.$text_tasasContri.'</td>

						</tr>


						<tr>

							<td align="center">5</td>
							<td style="text-align:justify;">El pago de cada suministro de servicios básicos descrito, se encuentra en el informe aprobado del Ministerio del Deporte remitido por la Dirección de Planificación e Inversión</td>
							<td align="center">'.$informeRemitido.'</td>
							<td style="text-align:justify;">'.$text_informeRemitido.'</td>

						</tr>



						<tr>

							<td align="center">6</td>
							<td style="text-align:justify;">Presenta el reporte de inventarios de los vehículos, inmuebles, bienes de larga duración, bienes de control administrativo y existencias descargado de su sistema contable (donde conste toda la información financiera, fecha compra, descripción del bien, depreciación, valor en libros, saldos etc.) debidamente suscrito por el responsable financiero (contador/a) y el representante legal.</td>
							<td align="center">'.$financieraRe.'</td>
							<td style="text-align:justify;">'.$text_financieraRe.'</td>

						</tr>



						<tr>

							<td align="center">7</td>
							<td style="text-align:justify;">Presenta Plan de mantenimiento de vehículos, bienes muebles e inmuebles, maquinaria y equipo debidamente suscrito por el representante legal.</td>
							<td align="center">'.$planMaquinaria.'</td>
							<td style="text-align:justify;">'.$text_planMaquinaria.'</td>

						</tr>



						<tr>

							<td align="center">8</td>
							<td style="text-align:justify;">Presenta Declaración de Contrataciones y Adquisiciones donde conste el tipo de contratación pública de las actividades descritas en el POA y el trimestre en el que se contratará</td>
							<td align="center">'.$declaracionAdqui.'</td>
							<td style="text-align:justify;">'.$text_declaracionAdqui.'</td>

						</tr>



						<tr>

							<td align="center">9</td>
							<td style="text-align:justify;">Presenta Declaración de Contrataciones y Adquisiciones donde conste el tipo de contratación pública de las actividades descritas en el POA y el trimestre en el que se contratará</td>
							<td align="center">'.$informeSeguridad.'</td>
							<td style="text-align:justify;">'.$text_informeSeguridad.'</td>

						</tr>



						<tr>

							<td align="center">10</td>
							<td style="text-align:justify;">Presenta el informe debidamente suscrito por el representante legal, en el que se detalle qué tipo de servicio de limpieza requiere contratar y los metros cuadrados de la infraestructura administrativa anexando documentos de respaldo</td>
							<td align="center">'.$servicioLimpieza.'</td>
							<td style="text-align:justify;">'.$text_servicioLimpieza.'</td>

						</tr>


				';

			}


			if ($fisicamenteEn==7) {
				
				$documentoCuerpo.='

						<tr>

							<td align="center">1</td>
							<td style="text-align:justify;">La planificación del  indicador tiene coherencia con el nombre del indicador y  se encuentra redactado en número entero.</td>
							<td align="center">'.$coherenciaIndica.'</td>
							<td style="text-align:justify;">'.$text_coherenciaIndica.'</td>

						</tr>
			
						<tr>

							<td align="center">2</td>
							<td style="text-align:justify;">Ejecuta la Planificación anual del personal administrativo y de servicios amparado en el Código de Trabajo.</td>
							<td align="center">'.$codigoTrabajo.'</td>
							<td style="text-align:justify;">'.$text_codigoTrabajo.'</td>

						</tr>

						<tr>

							<td align="center">3</td>
							<td style="text-align:justify;">Ejecuta la Planificación anual del personal administrativo, relacionado a Contratos Civiles de servicios profesionales.</td>
							<td align="center">'.$ejecutaPlani.'</td>
							<td style="text-align:justify;">'.$text_ejecutaPlani.'</td>

						</tr>

						<tr>

							<td align="center">4</td>
							<td style="text-align:justify;">El organismo deportivo no ha creado nuevos puestos de trabajo administrativos y de servicios respecto del POA 2021 (Acta de certificación  suscrita por el responsable).</td>
							<td align="center">'.$nuevosPuestos.'</td>
							<td style="text-align:justify;">'.$text_nuevosPuestos.'</td>

						</tr>


						<tr>

							<td align="center">5</td>
							<td style="text-align:justify;">El organismo deportivo no ha incrementado  Contratos Civiles de servicios profesionales de personal administrativo,  respecto del POA 2021 (Acta de certificación suscrita por el responsable).</td>
							<td align="center">'.$incrementoCiviles.'</td>
							<td style="text-align:justify;">'.$text_incrementoCiviles.'</td>

						</tr>

						<tr>

							<td align="center">6</td>
							<td style="text-align:justify;">El organismo deportivo no incrementa la masa salarial relacionada al personal administrativo y de servicios respecto del POA 2021 (Acta de certificación suscrita por el responsable).</td>
							<td align="center">'.$masaSa.'</td>
							<td style="text-align:justify;">'.$text_masaSa.'</td>

						</tr>


						<tr>

							<td align="center">7</td>
							<td style="text-align:justify;">El organismo deportivo no incrementa presupuesto relacionado a honorarios para Contratos Civiles de servicios profesionales de personal administrativo, respecto del POA 2021 (Acta de certificación suscrita por el responsable).</td>
							<td align="center">'.$contratosCiviles.'</td>
							<td style="text-align:justify;">'.$text_contratosCiviles.'</td>

						</tr>

						<tr>

							<td align="center">8</td>
							<td style="text-align:justify;">Si planificó servicios básicos verificar que en la matriz de suministro el número de suministro cuente con informe de aprobación del Ministerio del Deporte.</td>
							<td align="center">'.$serviciosVeri.'</td>
							<td style="text-align:justify;">'.$text_serviciosVeri.'</td>

						</tr>


						<tr>

							<td align="center">9</td>
							<td style="text-align:justify;">En caso que planifique seguros de bienes y vehículos presenta el listado de bienes o vehículos con la respectiva cobertura.</td>
							<td align="center">'.$planificoBienes.'</td>
							<td style="text-align:justify;">'.$text_planificoBienes.'</td>

						</tr>


				';

			}

			if ($fisicamenteEn==6 || $fisicamenteEn==15 || $fisicamenteEn==27 || $fisicamenteEn==28 || $fisicamenteEn==29 || $fisicamenteEn==30 || $fisicamenteEn==31 || $fisicamenteEn==32 || $fisicamenteEn==33) {

				if($fisicamenteEn==15 || $fisicamenteEn==27 || $fisicamenteEn==28 || $fisicamenteEn==29 || $fisicamenteEn==30 || $fisicamenteEn==31 || $fisicamenteEn==32 || $fisicamenteEn==33){

					$instaCompara=true;

				}
				
				$documentoCuerpo.='

						<tr>

							<td align="center">1</td>
							<td style="text-align:justify;">La planificación del indicador tiene coherencia con el nombre del indicador   de la actividad 002 y  se encuentra redactado con número entero.</td>
							<td align="center">'.$tieneCoherencia.'</td>
							<td style="text-align:justify;">'.$text_tieneCoherencia.'</td>

						</tr>
			
						<tr>

							<td align="center">2</td>
							<td style="text-align:justify;">Planifican únicamente gastos de rehabilitación, readecuación y/o mantenimiento en aquellos escenarios deportivos que sean propiedad de la organización deportiva<br>Anexo:Documentación de la legalidad del predio (escritura, certificado de propiedad, etc.).</td>
							<td align="center">'.$gastosRea.'</td>
							<td style="text-align:justify;">'.$text_gastosRea.'</td>

						</tr>

						<tr>

							<td align="center">3</td>
							<td style="text-align:justify;">Dentro de la planificación, destinan recursos para gastos de rehabilitación, readecuación y/o mantenimiento de los escenarios deportivos que son propiedad del Ministerio del Deporte, precautelando su correcto uso y funcionamiento<br>Anexo: Documentación de la legalidad del predio (escritura, certificado de propiedad etc.).</td>
							<td align="center">'.$dentroRecursos.'</td>
							<td style="text-align:justify;">'.$text_dentroRecursos.'</td>

						</tr>

						<tr>

							<td align="center">4</td>
							<td style="text-align:justify;">Utiliza los ítems presupuestarios aprobados del anexo 1, para la contratación del bienes y servicios respecto al tipo de intervenciones aprobados para la  rehabilitación, readecuación  y/o mantenimiento.</td>
							<td align="center">'.$itemsAnexo1.'</td>
							<td style="text-align:justify;">'.$text_itemsAnexo1.'</td>

						</tr>


						<tr>

							<td align="center">5</td>
							<td style="text-align:justify;">Mantiene concordancia el nombre de la intervención para rehabilitación, readecuación y/o mantenimiento con el escenario deportivo a intervenir y, los bienes y servicios involucrados en la intervención.</td>
							<td align="center">'.$interRea.'</td>
							<td style="text-align:justify;">'.$text_interRea.'</td>

						</tr>

						<tr>

							<td align="center">6.1</td>
							<td style="text-align:justify;">Presenta el Informe justificativo del gasto para la contratación o  adquisición de bienes o servicios en escenarios deportivo respecto a Rehabilitación y readecuación incluye:<br>- Análisis de precios unitarios<br>-Presupuesto<br>-Planos y anexos gráficos (debidamente suscritos por el profesional en la rama-Registro fotográfico de la intervención a subsanar,<br>-Contemplar parámetros de accesibilidad universal; según corresponda al tipo de intervención aprobada en los lineamientos (fachadas exteriores, interiores, cubierta, pisos interiores, pisos exteriores, piscinas, instalaciones hidrosanitarias de las edificaciones deportivas, sistema eléctrico-electrónico). </td>
							<td align="center">'.$justificacionOperativa.'</td>
							<td style="text-align:justify;">'.$text_justificacionOperativa.'</td>

						</tr>


						<tr>

							<td align="center">6.2</td>
							<td style="text-align:justify;">Presenta el Informe justificativo del gasto para la contratación o adquisición de bienes o servicios en escenarios deportivos respecto Mantenimiento incluye:<br>-Cuadro comparativo como estudio de mercado con análisis de precios unitarios respaldado por 3 cotizaciones<br>-Registro fotográfico de la intervención a subsanar<br>-Documentación de la legalidad del predio; según corresponda al tipo de intervención aprobada en los lineamientos (fachadas exteriores, interiores, cubierta, pisos interiores, pisos exteriores, piscinas, instalaciones hidrosanitarias de las edificaciones deportivas, sistema eléctrico-electrónico).</td>
							<td align="center">'.$informeJus.'</td>
							<td style="text-align:justify;">'.$text_informeJus.'</td>

						</tr>


				';

			}


			if ($fisicamenteEn=="cordinacionFinan") {

				$finanCompara=true;
				
				$documentoCuerpo.='

						<tr>

							<td align="center">1</td>
							<td style="text-align:justify;">Presenta el  Informe de justificación del gasto operativo y de mantenimiento en escenarios deportivos que debe contener el cuadro comparativo como estudio de mercado respaldado por 3 cotizaciones, el registro fotográfico, así como la documentación de la legalidad del predio.</td>
							<td align="center">'.$gastoOperativo.'</td>
							<td style="text-align:justify;">'.$text_gastoOperativo.'</td>

						</tr>
			
						<tr>

							<td align="center">2</td>
							<td style="text-align:justify;">Mantiene concordancia  la descripción del escenario o infraestructura y demás campos correspondiente a su mantenimiento</td>
							<td align="center">'.$descripcionCon.'</td>
							<td style="text-align:justify;">'.$text_descripcionCon.'</td>

						</tr>

						<tr>

							<td align="center">3</td>
							<td style="text-align:justify;">La descripción de materiales o servicios para el mantenimiento es completa y adecuada para el tipo de mantenimiento</td>
							<td align="center">'.$descripMate.'</td>
							<td style="text-align:justify;">'.$text_descripMate.'</td>

						</tr>

						<tr>

							<td align="center">4</td>
							<td style="text-align:justify;">Detalla satisfactoriamente la contratación o  adquisición de bienes o servicios</td>
							<td align="center">'.$adquiBienes.'</td>
							<td style="text-align:justify;">'.$text_adquiBienes.'</td>

						</tr>


						<tr>

							<td align="center">5</td>
							<td style="text-align:justify;">Justifica satisfactoriamente la contratación o adquisición del bien o servicio</td>
							<td align="center">'.$justificaCrea.'</td>
							<td style="text-align:justify;">'.$text_justificaCrea.'</td>

						</tr>

						<tr>

							<td align="center">6</td>
							<td style="text-align:justify;">Describe satisfactoriamente los bienes y servicios que se adquirirán de acuerdo a su tipo o característica (contratación pública, pago de impuestos y tasas)</td>
							<td align="center">'.$bienesImpuestos.'</td>
							<td style="text-align:justify;">'.$text_bienesImpuestos.'</td>

						</tr>


						<tr>

							<td align="center">7</td>
							<td style="text-align:justify;">El monto de la contratación o adquisición del bien o servicio es igual o inferior al monto ejecutado el año anterior o el monto establecido en materia de contratación pública.</td>
							<td align="center">'.$montoIn.'</td>
							<td style="text-align:justify;">'.$text_montoIn.'</td>

						</tr>


						<tr>

							<td align="center">8</td>
							<td style="text-align:justify;">Presenta el reporte de inventarios de los vehículos, inmuebles, bienes de larga duración, bienes de control administrativo y existencias descargado de su sistema contable (donde conste toda la información financiera, fecha compra, descripción del bien, depreciación, valor en libros, saldos etc.) debidamente suscrito por el responsable financiero (contador/a) y el representante legal.</td>
							<td align="center">'.$reporteInven.'</td>
							<td style="text-align:justify;">'.$text_reporteInven.'</td>

						</tr>


						<tr>

							<td align="center">9</td>
							<td style="text-align:justify;">Presenta Plan de mantenimiento de vehículos, bienes muebles e inmuebles, maquinaria y equipo debidamente suscrito por el representante legal.</td>
							<td align="center">'.$planVehiculos.'</td>
							<td style="text-align:justify;">'.$text_planVehiculos.'</td>

						</tr>


						<tr>

							<td align="center">10</td>
							<td style="text-align:justify;">Presenta Declaración de Contrataciones y Adquisiciones donde conste el tipo de contratación pública de las actividades descritas en el POA y el trimestre en el que se contratará.</td>
							<td align="center">'.$declaracionCon.'</td>
							<td style="text-align:justify;">'.$text_declaracionCon.'</td>

						</tr>



						<tr>

							<td align="center">11</td>
							<td style="text-align:justify;">Presenta Informe de seguridad y riesgos de las instalaciones donde se describa los puntos de seguridad y vigilancia privada necesarios.</td>
							<td align="center">'.$informeSegu.'</td>
							<td style="text-align:justify;">'.$text_informeSegu.'</td>

						</tr>


						<tr>

							<td align="center">12</td>
							<td style="text-align:justify;">Presenta el informe debidamente suscrito por el representante legal, en el que se detalle qué tipo de servicio de limpieza requiere contratar y los metros cuadrados de la infraestructura administrativa anexando documentos de respaldo.</td>
							<td align="center">'.$legalDetalle.'</td>
							<td style="text-align:justify;">'.$text_legalDetalle.'</td>

						</tr>


						<tr>

							<td align="center">13</td>
							<td style="text-align:justify;">La planificación del  indicador tiene coherencia con el nombre del indicador y  se encuentra redactado en número entero.</td>
							<td align="center">'.$indicaCoherente.'</td>
							<td style="text-align:justify;">'.$text_indicaCoherente.'</td>

						</tr>

						<tr>

							<td align="center">14</td>
							<td style="text-align:justify;">Ejecuta la Planificación anual del personal administrativo y de servicios amparado en el Código de Trabajo.</td>
							<td align="center">'.$personalAdmin.'</td>
							<td style="text-align:justify;">'.$text_personalAdmin.'</td>

						</tr>

						<tr>

							<td align="center">15</td>
							<td style="text-align:justify;">Ejecuta la Planificación anual del personal administrativo, relacionado a Contratos Civiles de servicios profesionales.</td>
							<td align="center">'.$contratosCivi.'</td>
							<td style="text-align:justify;">'.$text_contratosCivi.'</td>

						</tr>

						<tr>

							<td align="center">16</td>
							<td style="text-align:justify;">La Organización Deportiva no ha creado nuevos puestos de trabajo administrativos y de servicios respecto del POA 2021 (Acta de certificación  suscrita por el responsable).</td>
							<td align="center">'.$nuevosServicios.'</td>
							<td style="text-align:justify;">'.$text_nuevosServicios.'</td>

						</tr>


						<tr>

							<td align="center">17</td>
							<td style="text-align:justify;">La Organización Deportiva no ha incrementado  Contratos Civiles de servicios profesionales de personal administrativo,  respecto del POA 2021 (Acta de certificación suscrita por el responsable).</td>
							<td align="center">'.$personalCertifi.'</td>
							<td style="text-align:justify;">'.$text_personalCertifi.'</td>

						</tr>

						<tr>

							<td align="center">18</td>
							<td style="text-align:justify;">La Organización Deportiva no incrementa la masa salarial relacionada al personal administrativo y de servicios respecto del POA 2021 (Acta de certificación suscrita por el responsable).</td>
							<td align="center">'.$masaAdmin.'</td>
							<td style="text-align:justify;">'.$text_masaAdmin.'</td>

						</tr>

						<tr>

							<td align="center">19</td>
							<td style="text-align:justify;">La Organización Deportiva no incrementa presupuesto relacionado a honorarios para Contratos Civiles de servicios profesionales de personal administrativo, respecto del POA 2021 (Acta de certificación suscrita por el responsable).</td>
							<td align="center">'.$honorariosIncre.'</td>
							<td style="text-align:justify;">'.$text_honorariosIncre.'</td>

						</tr>


						<tr>

							<td align="center">20</td>
							<td style="text-align:justify;">Si planificó servicios básicos verificar que en la matriz de suministro el número de suministro cuente con informe de aprobación del Ministerio del Deporte.</td>
							<td align="center">'.$matrizServicios.'</td>
							<td style="text-align:justify;">'.$text_matrizServicios.'</td>

						</tr>


						<tr>

							<td align="center">21</td>
							<td style="text-align:justify;">En caso que planifique seguros de bienes y vehículos presenta el listado de bienes o vehículos con la respectiva cobertura.</td>
							<td align="center">'.$segurosBienes.'</td>
							<td style="text-align:justify;">'.$text_segurosBienes.'</td>

						</tr>



				';

			}



			$documentoCuerpo.='
					</tbody>

				</table>';


			if (!empty($observaAdicionales)) {

			$documentoCuerpo.='

			<table class="tabla__bordadaTresCD" style="width:100%important;">

				<tr>

					<td style="text-align:justify; width:30%!important;  padding-top:2em; padding-bottom:2em;" class="enfacis__letras">

						OBSERVACIONES ADICIONALES: 

					</td>


					<td style="text-align:justify; width:70%!important;  padding-top:2em; padding-bottom:2em;">

						'.$observaAdicionales.'

					</td>

				</tr>

			</table>				


			';

			}


			$documentoCuerpo.='

			<table class="tabla__bordadaTresCD" style="width:100%important;">

				<tr>

					<td style="text-align:justify; width:30%!important;  padding-top:2em; padding-bottom:2em;" class="enfacis__letras">

						CONCLUSIÓN:

					</td>


					<td style="text-align:justify; width:70%!important;  padding-top:2em; padding-bottom:2em;">

						'.$conlcusion.'

					</td>

				</tr>

			</table>				


			';

			if ($fisicamenteEn==5) {
				

				$documentoCuerpo.='

				<table class="tabla__bordadaTresCD" style="width:100%important;">

					<tr>

						<td style="text-align:justify; width:30%!important;">

							Se deja constancia, que la Coordinación General Administrativa Financiera a través de las Dirección Administrativa y Dirección de Administración de Talento Humano a procedió realizar la REVISIÓN de los montos planificados por los Organismos Deportivos para el presente año comparando los montos ejecutados en el año fiscal anterior según información proporcionada por la Coordinación de Planificación y Gestión Estratégica y los lineamientos y restricciones establecidas en el Acuerdo Ministerial Nro. 456 del año 2021 y sus anexos. 

						</td>

					</tr>

					<tr>

						<td style="text-align:justify; width:30%!important;">

							Además, los montos y actividades administrativas planificadas y señaladas por las entidades deportivas para el presente año, así como su ejecución y correcto uso de los recursos públicos es responsabilidad de los Organismos Deportivos.

						</td>

					</tr>

					<tr>

						<td style="text-align:justify; width:30%!important;">

							Es importante mencionar que los Organismos Deportivos al administrar y ejecutar Recursos Públicos deben regirse en la Normativa Legal Vigente:

						</td>

					</tr>


				</table>				


				';



				$documentoCuerpo.='

				<table class="tabla__bordadaTresCD" style="width:100%important;">

					<tr>

						<td style="text-align:justify; width:30%!important;">

							• Los procesos de contratación pública realizados por los Organismos Deportivos deben regirse a la Ley Orgánica del Sistema Nacional de Contratación Pública, su reglamento, resoluciones, acuerdos y demás instrumentos que sean emitidos por el SERCOP. 

						</td>

					</tr>

					<tr>

						<td style="text-align:justify; width:30%!important;">

							• La Administración, custodia, cuidado y control de los bienes y existencias adquiridos por los Organismos Deportivos deben regirse a lo establecido en el Reglamento General Sustitutivo para la Administración, Utilización, Manejo y Control de los Bienes e Inventarios del Sector Publico, Acuerdo de la Contraloría General del Estado 67 y en el Reglamento Sustitutivo para el Control de los Vehículos del Sector Público y de las Entidades de Derecho Privado que disponen de Recursos Públicos, Acuerdo de la Contraloría General del Estado 42.


						</td>

					</tr>

					<tr>

						<td style="text-align:justify; width:30%!important;">

							• Previo al inicio de un procedimiento de contratación pública, así como para la aceptación de cualquier obligación que genere la erogación de recursos públicos, el Organismo deportivo deberá observar lo dispuesto en el Art. 115 y 101 establecido en el Código Orgánico de Planificación y Finanzas Públicas y su reglamento respectivamente. 


						</td>

					</tr>


				</table>

				<br><br>				


				';


			}

			if ($fisicamenteEn=="cordinacionFinan") {
				
				$asignador__elaborado="Revisado por: ";
				$asignador__validador="Validado por: ";

			}else{

				$asignador__elaborado="Elaborado por: ";
				$asignador__validador="Validado por: ";

			}

			if ($fisicamenteEn!=7 && $fisicamenteEn!=5) {
				
				$documentoCuerpo.='

				<table class="tablas__bordes__necesarias" style="width:100%important;">

					<tr>

						<td style="text-align:center; width:100%!important;  padding-top:4em; padding-bottom:4em;"  class="enfacis__letras" colspan="2">

						'.$asignador__elaborado." ".$funcionario[0][nombreFuncionario].'

						</td>


					</tr>


					</table>

					';


			}


			$documentoCuerpo.='

			<table class="tablas__bordes__necesarias" style="width:100%important;">


				<tr>

					<td style="text-align:justify; width:50%!important;  padding-top:4em; padding-bottom:4em;" class="enfacis__letras">

						'.$asignador__validador." ".$director[0][nombreDirector].'

					</td>


					<td style="text-align:justify; width:50%!important;  padding-top:4em; padding-bottom:4em;"  class="enfacis__letras">

						Firma

					</td>

				</tr>';

				if ($fisicamenteEn=="cordinacionFinan") {
					
					$documentoCuerpo.='

					<tr>

						<td style="text-align:justify; padding-top:1em; padding-bottom:1em;" colspan="2" >

							SOBRE LA BASE DE LA INFORMACION VALIDADA POR EL COORDINADOR ZONAL SE SUGIERE PROCEDER CON TRAMITE ADMINISTRATIVO CORRESPONDIENTE.

						</td>

					</tr>					

					';

				}


				$variableAprobacion="Revisado por";


				if ($fisicamenteEn==5) {

					$documentoCuerpo.='

						<tr>

							<td style="text-align:justify; width:30%!important;  padding-top:2em; padding-bottom:2em;" colspan="2">

								Una vez realizada la revisión de los ítems asignados a la Dirección Administrativa conforme la actividad 001 estipulada en los lineamientos del ciclo de planificación, esta Coordinación acepta los parámetros revisados por la dirección antes mencionada.

							</td>

						</tr>';

				}

				if ($fisicamenteEn==5 || $fisicamenteEn==7) {

					$variableAprobacion="Revisado por";

				}


				if ($fisicamenteEn=="cordinacionFinan") {



				}else if ($finanCompara==true) {

					$documentoCuerpo.='<tr>

							<td style="text-align:justify; width:50%!important;  padding-top:4em; padding-bottom:4em;" class="enfacis__letras">

								Revisado por: '.$corFinan[0][nombreFinan].'

							</td>


							<td style="text-align:justify; width:50%!important;  padding-top:4em; padding-bottom:4em;" class="enfacis__letras">

								Firma

							</td>

						</tr>

					</table>';

				}else if ($instaCompara==true) {

					$documentoCuerpo.='<tr>

							<td style="text-align:justify; width:50%!important;  padding-top:4em; padding-bottom:4em;" class="enfacis__letras">

								Revisado por: '.$corInsta[0][nombreInsta].'

							</td>


							<td style="text-align:justify; width:50%!important;  padding-top:4em; padding-bottom:4em;" class="enfacis__letras">

								Firma

							</td>

						</tr>

					</table>';					
					
				}else if ($subsesCompara==true) {

					$documentoCuerpo.='<tr>

							<td style="text-align:justify; width:50%!important;  padding-top:4em; padding-bottom:4em;" class="enfacis__letras">

								Revisado por: '.$subsesAcFi[0][nombreSubsesA].'

							</td>


							<td style="text-align:justify; width:50%!important;  padding-top:4em; padding-bottom:4em;" class="enfacis__letras">

								Firma

							</td>

						</tr>

					</table>';	

				}else{

					$documentoCuerpo.='<tr>

							<td style="text-align:justify; width:50%!important;  padding-top:4em; padding-bottom:4em;" class="enfacis__letras">

								'.$variableAprobacion." ".$subsecretarios[0][nombreSubses].'

							</td>


							<td style="text-align:justify; width:50%!important;  padding-top:4em; padding-bottom:4em;" class="enfacis__letras">

								Firma

							</td>

						</tr>

					</table>';

				}


			/*===================================
			=            Generar pdf            =
			===================================*/

			$parametro1="../../documentos/informesTecnicos/";
			$parametro2="informeTecnico";	
			$parametro3="informeTecnico";
			
			/*=====  End of Generar pdf  ======*/

		break;


		case  "asignacionTecho":

			$formatter = new NumeroALetras();

			$inserta=$objeto->getInserta('poa_inversion', array("`idInversion`, ","`nombreInversion`, ","`estado`, ","`fecha`, ","`hora`, ","`inversionQueda`, ","`ejercicioFiscal`"),array(":nombreInversion, ",":estado, ",":fecha, ",":hora, ",":inversionQueda, ",":ejercicioFiscal"),array("$asignacionPresupuestaria","A","$fecha_actual","$hora_actual","$asignacionPresupuestaria","$periodoAsignacion-01-01"),array(":nombreInversion",":estado",":fecha",":hora",":inversionQueda",":ejercicioFiscal"));	
			
			$maximo=$objeto->getMaximoFuncion('idInversion','poa_inversion');	

			$inserta2=$objeto->getInserta('poa_inversion_usuario', array("`idInversionUsuario`, ","`idUsuario`, ","`idInversion`, ","`idOrganismo`"),array(":idUsuario, ",":idInversion, ",":idOrganismo"),array("$idUsuarioPrincipalDos","$maximo","$idOrganismo"),array(":idUsuario",":idInversion",":idOrganismo"));	

			$inserta3=$objeto->getInserta('poa_organismo_documento', array("`idOrganismoDocumento`, ","`direccionDelDocumento`, ","`fecha`, ","`hora`, ","`idUsuario`, ","`idOrganismo`, ","`numeroDeAcuerdo`"),array(":direccionDelDocumento, ",":fecha, ",":hora, ",":idUsuario, ",":idOrganismo, ",":numeroDeAcuerdo"),array("N/A","$fecha_actual","$hora_actual","$idUsuarioPrincipalDos","$idOrganismo","N/A"),array(":direccionDelDocumento",":fecha",":hora",":idUsuario",":idOrganismo",":numeroDeAcuerdo"));	

			$valores=array("periodo='$periodoAsignacion'");
			$actualiza2=$objeto->getActualiza("poa_organismo",$valores,"idOrganismo",$idOrganismo);

			/*===========================================
			=            Enviador de correos            =
			===========================================*/

			$obtenerInformacion=$objeto->getObtenerInformacionGeneral("SELECT a.nombreOrganismo,b.email FROM poa_organismo AS a INNER JOIN poa_usuario AS b ON a.idUsuario=b.idUsuario WHERE a.idOrganismo='$idOrganismo';");

			$bodyMensaje='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><title>POA</title><style type="text/css">body {background:#EEE; padding:30px; font-size:16px;}'.'</style>'.'</head>'.'<span style="font-weight:bold;">COORDINACIÓN GENERAL DE PLANIFICACIÓN Y GESTIÓN ESTRATEGICA,</span><br><br>El Organismo Deportivo <span style="font-weight:bold;">'.$obtenerInformacion[0][nombreOrganismo].'</span>&nbsp; fue asignado su presupuesto de '.$asignacionPresupuestaria.' para el periodo '.$periodoAsignacion.'.<br> El documento de asignación fue generado por favor ingresar al aplicativo con sus credenciales.</body></html>';

			$emailArray = array($obtenerInformacion[0][email]);
					
			$correosEnviados=$objeto->getEnviarCorreo($emailArray,$bodyMensaje);

			/*=====  End of Enviador de correos  ======*/

			/*===================================
			=            Generar pdf            =
			===================================*/

			$parametro1="../../documentos/asignacionRecursos/";
			$parametro2="asignacionTecho";	
			$parametro3=$maximo;
			
			/*=====  End of Generar pdf  ======*/
			
			/*========================================
			=            Cuerpo documetno            =
			========================================*/
			

			$formatterES = new NumberFormatter("es-ES", NumberFormatter::SPELLOUT);
			$n = $asignacionPresupuestaria;
			$izquierda = intval(floor($n));

			$derecha = intval(($n - floor($n)) * 100);

			$pos = strpos($asignacionPresupuestaria,".01");


			if($derecha<1 && $pos === false){

				$asignadorReal=$formatterES->format($izquierda) . " CON " . $formatterES->format($derecha);

			}else{

				$asignadorReal=strtolower($formatter->toWords($asignacionPresupuestaria));

			}


			$documentoCuerpo='  

			<table class="tabla__bordadaTresCD">

				<tr>

					<td style="text-align: left;">

						<span class="enfacis__letras">Quito, '.$dia.' de '. ucwords($monthName).' del '.$anio.' </span>

					</td>

					<td style="text-align: right;">

						<span class="enfacis__letras">Código asignación:</span>'.$parametro3.'

					</td>

				<tr>		

			</table>


			<table class="tabla__bordada">

				<tr>

					<td>

						<span class="enfacis__letras">Para:</span> '.$informacionCompleto[0][nombreResponsablePoa].' / '.strtoupper($informacionCompleto[0][nombreOrganismo]).'

					</td>

				<tr>		

			</table>

			<table class="tabla__bordadaTresC">

				<tr>

					<td>

						<span class="enfacis__letras">De:</span> '.$directorConjunto[0][nombreDi].'

					</td>

				<tr>

			</table>


			<table class="tabla__bordadaTresCD">

				<tr>

					<td>

						<span class="enfacis__letras">Asunto:</span> Notificación de Techo Presupuestario asignado – '.strtoupper($informacionCompleto[0][nombreOrganismo]).'

					</td>

				<tr>		

			</table>

			<br>
			<br>


			<table class="tabla__bordadaTresCD">

				<tr>

					<td>

						<span class="enfacis__letras">De mi consideración:</span>

					</td>

				<tr>		

			</table>


			<table class="tabla__bordadaTresCDE">

				<tr>

					<td class="justify__class">

						El Art. 130 de la Ley del Deporte, Educación Física y Recreación menciona, <span class="enfacis__letrasOblic">“Asignaciones.- De conformidad con el artículo 298 de la Constitución de la República quedan prohibidas todos las preasignaciones presupuestarias destinadas para el sector. La distribución de los fondos públicos a las organizaciones deportivas estará a cargo del Ministerio Sectorial y se realizará de acuerdo a su política, su presupuesto, la planificación anual aprobada enmarcada en el Plan Nacional del Buen Vivir y la Constitución. Para la asignación presupuestaria desde el deporte formativo hasta de alto rendimiento, se considerarán los siguientes criterios: calidad de gestión sustentada en una matriz de evaluación, que incluya resultados deportivos, impacto social del deporte y su potencial desarrollo, así como la naturaleza de cada organización. Para el caso de la provincia de Galápagos se considerará los costos por su ubicación geográfica. Para la asignación presupuestaria a la educación física y recreación, se considerarán los siguientes criterios: de igualdad, número de beneficiarios potenciales, el índice de sedentarismo de la localidad y su nivel socioeconómico, así como la naturaleza de cada organización y la infraestructura no desarrollada. En todos los casos prevalecerá lo dispuesto en el artículo 4 de esta Ley y su Reglamento”</span>.

					</td>

				<tr>		

			</table>

			<br>
			<br>

			<table class="tabla__bordadaTresCD">

				<tr>

					<td class="justify__class">

						Por otra parte, mediante Acuerdo Ministerial No.0456 de 30 de diciembre del 2021 se expide el procedimiento que regula el Ciclo de la Planificación de las Organizaciones Deportivas, en el que establece en la sección1- Procedimiento para la elaboración y Planificación de la Programación Operativa Anual <span class="enfacis__letrasOblic">“Art. 13. Notificación de techos presupuestarios.- Al inicio de cada año, una vez que el ente rector de la Economía y Finanzas Públicas defina el presupuesto otorgado al Ministerio del Deporte para el correspondiente ejercicio fiscal, y con base a la metodología establecida en el Modelo de Asignación Presupuestaria al que hace referencia el artículo 7 del presente Acuerdo Ministerial, se establecerá y notificará el techo presupuestario asignado a cada organización deportiva. Dicho proceso estará a cargo de la Dirección de Planificación e Inversión del Ministerio del Deporte. Los techos presupuestarios por organización deportiva serán publicados en la página institucional del Ministerio del Deporte”</span>.

					</td>

				<tr>		

			</table>

			<br>
			<br>

			<table class="tabla__bordadaTresCD">

				<tr>

					<td class="justify__class">

						Por lo expuesto me permito notificar la asignación presupuestaria correspondiente al gasto corriente, para el presente ejercicio fiscal, por el monto de $'.number_format((float)$asignacionPresupuestaria, 2, '.', '').' ('.$asignadorReal.' centavos), sin incluir el valor del cinco por mil.

					</td>

				<tr>		

			</table>


			<br>
			<br>

			<table class="tabla__bordadaTresCD">

				<tr>

					<td class="justify__class">

						Finalmente, se solicita continuar con el proceso de ingreso de información en el aplicativo conforme las directrices y lineamientos vigentes.

					</td>

				<tr>		

			</table>


			<br>
			<br>

			<table class="tabla__bordadaTresCD">

				<tr>

					<td class="justify__class">

						Con sentimientos de distinguida consideración	

					</td>

				<tr>		

			</table>



			';
			
			/*=====  End of Cuerpo documetno  ======*/
			


		break;	


	}


?>

<html>

   <head>

      <link href="../../layout/styles/css/estilosPdf.css" rel="stylesheet" type="text/css" media="all">

   </head>

   <body>


     <div id="" style="position: relative; left: 10%;">

       <img src="../../images/headerPdf.png" />

     </div>

     <div id="footer">

       <img src="../../images/footer.png"/>

     </div>  	

     <div id="content">

		<?=$documentoCuerpo?>

	</div>

	</body>

</html>

<?php

include_once "../../dompdf/autoload.inc.php";

use Dompdf\Dompdf;

$dompdf = new Dompdf();

$dompdf->loadHtml(ob_get_clean());

$dompdf->render();

$canvas = $dompdf->get_canvas(); 
$canvas->page_text(510, 12, "Página {PAGE_NUM} de {PAGE_COUNT}","helvetica", 8, array(0,0,0)); //header//header
$canvas->page_text(54, 778, "", "helvetica", 8, array(0,0,0)); //footer

$contenido = $dompdf->output();

$nombreDelDocumento =$parametro1.$parametro3.".pdf";

$bytes = file_put_contents($nombreDelDocumento, $contenido);

$dompdf->render();

$dompdf->stream($parametro2);