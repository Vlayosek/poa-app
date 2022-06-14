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

		case "rectificacion__docus__financieros":

			if (isset($archivo)) {
				
				$mensaje=2;
				$jason['mensaje']=$mensaje;

			}else{


				$nombre__archivo=$fecha_actual."__".$organismoId.".pdf";

				if ($tipologia=="polizaVigencia") {
					$direccion="../../documentos/financiero/polizaOriginal/";
					$campo="polizaOriginal";	
				}else if($tipologia=="caucionOriginal"){
					$direccion="../../documentos/financiero/caucionOrginal/";
					$campo="caucionOrginal";
				}else if($tipologia=="certificadoBancario"){
					$direccion="../../documentos/financiero/copiaCertificadoBancario/";
					$campo="copiaCertificadoBancario";
				}else if($tipologia=="copiaRegistroD"){
					$direccion="../../documentos/financiero/copiaRegistroD/";
					$campo="copiaRegistroD";
				}else if($tipologia=="financieroCopia"){
					$direccion="../../documentos/financiero/copia_adminFinanciero/";
					$campo="copia_adminFinanciero";
				}else if($tipologia=="copiaAdminGeneral"){
					$direccion="../../documentos/financiero/copia_adminGeneral/";
					$campo="copia_adminGeneral";
				}else if($tipologia=="copiaIntervencion"){
					$direccion="../../documentos/financiero/copia__registroIn/";
					$campo="copia__registroIn";
				}else if($tipologia=="copiaRegistro"){
					$direccion="../../documentos/financiero/copia_acuerdoRegistro/";
					$campo="copia_acuerdoRegistro";
				}else if($tipologia=="copiaRegistro__acuerdos"){
					$direccion="../../documentos/financiero/copia_ruc/";
					$campo="copia_ruc";
				}

				$documento=$objeto->getEnviarPdf($_FILES["archivo"]['type'],$_FILES["archivo"]['size'],$_FILES["archivo"]['tmp_name'],$_FILES["archivo"]['name'],$direccion,$nombre__archivo);

				$valores2=array("$campo='p'");
				$actualiza2=$objeto->getActualiza("poa_documentos_calificados",$valores2,"idOrganismo",$organismoId);


				$obtenerInformacion=$objeto->getObtenerInformacionGeneral("SELECT idDocumentos FROM poa_documentos_calificados WHERE polizaOriginal='p' AND caucionOrginal='p' AND copiaCertificadoBancario='p' AND copiaRegistroD='p' AND copia_acuerdoRegistro='p' AND copia_ruc='p' AND idOrganismo='$organismoId';");

				// if (!empty($obtenerInformacion[0][idDocumentos]) && $obtenerInformacion[0][idDocumentos]!=null && $obtenerInformacion[0][idDocumentos]!="null") {
				
					$valores=array("rechazo='p', fechaCorreccion='$fecha_actual',$campo='$nombre__archivo'");
					$actualiza=$objeto->getActualiza("poa_financiero_documentos",$valores,"idOrganismo",$organismoId);	

				// }


				$mensaje=1;
				$jason['mensaje']=$mensaje;

			}

		break;			


		case "inserta__funcionario__finan__funcionarios":

			if ($checked=="no") {
				
				$banderaAcredita=true;

				if ($polizaOriginal=="r" || $polizaOriginal=="p") {
					$banderaAcredita=false;
				}

				$observa__polizaOriginal=filter_var($observa__polizaOriginal, FILTER_SANITIZE_MAGIC_QUOTES);


				if ($caucionOrginal=="r" || $caucionOrginal=="p") {
					$banderaAcredita=false;
				}

				$observa__caucionOrginal=filter_var($observa__caucionOrginal, FILTER_SANITIZE_MAGIC_QUOTES);


				if ($copiaCertificadoBancario=="r" || $copiaCertificadoBancario=="p") {
					$banderaAcredita=false;
				}

				$observa__copiaCertificadoBancario=filter_var($observa__copiaCertificadoBancario, FILTER_SANITIZE_MAGIC_QUOTES);

				if ($copiaRegistroD=="r" || $copiaRegistroD=="p") {
					$banderaAcredita=false;
				}

				$observa__copiaRegistroD=filter_var($observa__copiaRegistroD, FILTER_SANITIZE_MAGIC_QUOTES);

				if (isset($copia_adminFinanciero)) {
					
					if ($copia_adminFinanciero=="r" || $copia_adminFinanciero=="p") {
						$banderaAcredita=false;
					}

					$observa__copia_adminFinanciero=filter_var($observa__copia_adminFinanciero, FILTER_SANITIZE_MAGIC_QUOTES);

				}else{

					$copia_adminFinanciero="NULL";
					$observa__copia_adminFinanciero="NULL";

				}

				if (isset($copia_adminGeneral)) {
					
					if ($copia_adminGeneral=="r" || $copia_adminGeneral=="p") {
						$banderaAcredita=false;
					}

					$observa__copia_adminGeneral=filter_var($observa__copia_adminGeneral, FILTER_SANITIZE_MAGIC_QUOTES);

				}else{

					$copia_adminGeneral="NULL";
					$observa__copia_adminGeneral="NULL";

				}


				if (isset($copia__registroIn)) {
					
					if ($copia__registroIn=="r" || $copia__registroIn=="p") {
						$banderaAcredita=false;
					}

					$observa__copia__registroIn=filter_var($observa__copia__registroIn, FILTER_SANITIZE_MAGIC_QUOTES);

				}else{

					$copia__registroIn="NULL";
					$observa__copia__registroIn="NULL";


				}

				if ($copia_acuerdoRegistro=="r" || $copia_acuerdoRegistro=="p") {
					$banderaAcredita=false;
				}

				$observa__copia_acuerdoRegistro=filter_var($observa__copia_acuerdoRegistro, FILTER_SANITIZE_MAGIC_QUOTES);

				if ($copia_ruc=="r" || $copia_ruc=="p") {
					$banderaAcredita=false;
				}
				
				$observa__copia_ruc=filter_var($observa__copia_ruc, FILTER_SANITIZE_MAGIC_QUOTES);

				if ($banderaAcredita==false) {
					$numeradorAprobador="r";
				}else{
					$numeradorAprobador="T";
				}

				$obtenerInformacion=$objeto->getObtenerInformacionGeneral("SELECT idFinancieroD FROM poa_financiero_documentos WHERE idOrganismo='$idOrganismo' ORDER BY idFinancieroD DESC LIMIT 1;");

				$valores=array("fechaFuncionario_calific='$fecha_actual', rechazo='$numeradorAprobador'");
				$actualiza=$objeto->getActualiza("poa_financiero_documentos",$valores,"idOrganismo",$idOrganismo);	

				$organismoDeportivos=$objeto->getObtenerInformacionGeneral("SELECT nombreOrganismo,correo FROM poa_organismo WHERE idOrganismo='$idOrganismo';");

				if ($numeradorAprobador=="T") {

					$bodyMensaje='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><title>POA</title><style type="text/css">body {background:#EEE; padding:30px; font-size:16px;}'.'</style>'.'</head>'.'<span style="font-weight:bold;">COORDINACIÓN GENERAL DE PLANIFICACIÓN Y GESTIÓN ESTRATEGICA,</span><br><br>El organismo deportivo '.$organismoDeportivos[0][nombreOrganismo].' fue aprobado.</body></html>';

					$emailArray = array($organismoDeportivos[0][correo]);

					$correosEnviados=$objeto->getEnviarCorreo($emailArray,$bodyMensaje);	

					
				}else{


					$bodyMensaje='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><title>POA</title><style type="text/css">body {background:#EEE; padding:30px; font-size:16px;}'.'</style>'.'</head>'.'<span style="font-weight:bold;">COORDINACIÓN GENERAL DE PLANIFICACIÓN Y GESTIÓN ESTRATEGICA,</span><br><br>El organismo deportivo '.$organismoDeportivos[0][nombreOrganismo].' fue rechazado, favor verificar las observaciones en el menú de transferencias del organismo deportivo.</body></html>';

					$emailArray = array($organismoDeportivos[0][correo]);

					$correosEnviados=$objeto->getEnviarCorreo($emailArray,$bodyMensaje);	

				}

				$idUtiliza=$obtenerInformacion[0][idFinancieroD];


				$inserta=$objeto->getInsertaNormal('poa_documentos_calificados', array("`idDocumentos`, ","`polizaOriginal`, ","`caucionOrginal`, ","`copiaCertificadoBancario`, ","`copiaRegistroD`, ","`copia_adminFinanciero`, ","`copia_adminGeneral`, ","`copia__registroIn`, ","`copia_acuerdoRegistro`, ","`copia_ruc`, ","`idOrganismo`, ","`idFinancieroD`, ","`fecha`, ","`observa__polizaOriginal`, ","`observa__caucionOrginal`, ","`observa__copiaCertificadoBancario`, ","`observa__copiaRegistroD`, ","`observa__copia_adminFinanciero`, ","`observa__copia_adminGeneral`, ","`observa__copia__registroIn`, ","`observa__copia_acuerdoRegistro`, ","`observa__copia_ruc`"),array("'$polizaOriginal', ","'$caucionOrginal', ","'$copiaCertificadoBancario', ","'$copiaRegistroD', ","'$copia_adminFinanciero', ","'$copia_adminGeneral', ","'$copia__registroIn', ","'$copia_acuerdoRegistro', ","'$copia_ruc', ","'$idOrganismo', ","'$idUtiliza', ","'$fecha_actual', ","'$observa__polizaOriginal', ","'$observa__caucionOrginal', ","'$observa__copiaCertificadoBancario', ","'$observa__copiaRegistroD', ","'$observa__copia_adminFinanciero', ","'$observa__copia_adminGeneral', ","'$observa__copia__registroIn', ","'$observa__copia_acuerdoRegistro', ","'$observa__copia_ruc'"));

			}else{

				$valores=array("idUsuario=NULL");
				$actualiza=$objeto->getActualiza("poa_financiero_documentos",$valores,"idOrganismo",$idOrganismo);						

			}

			$mensaje=1;
			$jason['mensaje']=$mensaje;

		break;		


		case "inserta__funcionario__finan__coordinas":

		
			$valores=array("fechaCoordinador_envia='$fecha_actual', idUsuario='$texto__finan'");
			$actualiza=$objeto->getActualiza("poa_financiero_documentos",$valores,"idOrganismo",$idOrganismo);	


			$emailEnviados=$objeto->getObtenerInformacionGeneral("SELECT email,CONCAT_WS(' ',nombre,apellido) AS nombreCompleto FROM th_usuario WHERE id_usuario='$texto__finan';");

			$organismoDeportivos=$objeto->getObtenerInformacionGeneral("SELECT nombreOrganismo FROM poa_organismo WHERE idOrganismo='$idOrganismo';");

			$bodyMensaje='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><title>POA</title><style type="text/css">body {background:#EEE; padding:30px; font-size:16px;}'.'</style>'.'</head>'.'<span style="font-weight:bold;">COORDINACIÓN GENERAL DE PLANIFICACIÓN Y GESTIÓN ESTRATEGICA,</span><br><br>Estimado '.$emailEnviados[0][nombreCompleto].', el organismo deportivo '.$organismoDeportivos[0][nombreOrganismo].' fue puesto en su bandeja de recibidos en la sección de transferencias del aplicativo POA.</body></html>';

			$emailArray = array($emailEnviados[0][email]);

			$correosEnviados=$objeto->getEnviarCorreo($emailArray,$bodyMensaje);							

			$mensaje=1;
			$jason['mensaje']=$mensaje;

		break;		


		case "editasInfor__final":

			$direccionDocumentos="../../documentos/aprobacion/";

			if ($estaDocumento=="si") {
				
				$documento=$objeto->getEnviarPdf($_FILES["documentoFinal"]['type'],$_FILES["documentoFinal"]['size'],$_FILES["documentoFinal"]['tmp_name'],$_FILES["documentoFinal"]['name'],$direccionDocumentos,$fecha_actual."__".$organismoId.".pdf");

				$nombreDocumento=$fecha_actual."__".$organismoId.".pdf";

				$valores3=array("documento='$nombreDocumento'");
				$actualiza3=$objeto->getActualiza("poa_documentofinal",$valores3,"idOrganismo",$organismoId);	

			}


			$fecha__quipux__segundos= strtotime($fecha__poasE);
			$quinceDias = $objeto->sumasdiasemana(date('Y-m-d',$fecha__quipux__segundos),15);


			$valores=array("numeroOficioNoti='$numeroResolucion__ed', fecha_quipux='$fecha__poasE', montoSinDescuentos='$notificado__sin', fecha_dias='$quinceDias'");
			$actualiza2=$objeto->getActualiza("poa_documentofinal",$valores,"idOrganismo",$organismoId);			

			$mensaje=1;
			$jason['mensaje']=$mensaje;

		break;		



		case "inserta__funcionario__finan":

			$valores=array("fechaDirector_envia='$fecha_actual', idUsuario='$texto__finan'");
			$actualiza=$objeto->getActualiza("poa_financiero_documentos",$valores,"idOrganismo",$idOrganismo);

			$emailEnviados=$objeto->getObtenerInformacionGeneral("SELECT email,CONCAT_WS(' ',nombre,apellido) AS nombreCompleto FROM th_usuario WHERE id_usuario='$texto__finan';");

			$organismoDeportivos=$objeto->getObtenerInformacionGeneral("SELECT nombreOrganismo FROM poa_organismo WHERE idOrganismo='$idOrganismo';");

			$bodyMensaje='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><title>POA</title><style type="text/css">body {background:#EEE; padding:30px; font-size:16px;}'.'</style>'.'</head>'.'<span style="font-weight:bold;">COORDINACIÓN GENERAL DE PLANIFICACIÓN Y GESTIÓN ESTRATEGICA,</span><br><br>Estimado '.$emailEnviados[0][nombreCompleto].', el organismo deportivo '.$organismoDeportivos[0][nombreOrganismo].' fue puesto en su bandeja de recibidos en la sección de transferencias del aplicativo POA.</body></html>';

			$emailArray = array($emailEnviados[0][email]);

			$correosEnviados=$objeto->getEnviarCorreo($emailArray,$bodyMensaje);	

			
			$mensaje=1;
			$jason['mensaje']=$mensaje;

		break;		


		case "eliminar_intervencion":

			
			$actualiza2=$objeto->getEliminarNormal("poa_interventores",$organismoId);

			$mensaje=1;
			$jason['mensaje']=$mensaje;

		break;		


		case "intervencion":

			$nombreInterventor__i=filter_var($nombreInterventor__i, FILTER_SANITIZE_MAGIC_QUOTES);

			$inserta=$objeto->getInsertaNormal('poa_interventores', array("`idInterventor`, ","`idOrganismo`, ","`cedulaInterventor`, ","`nombreInterventor`, ","`fechaInicioIntervencion`, ","`fechaFinalIntervencion`, ","`fecha`"),array("'$idOrganismo_i', ","'$cedulaInterventor', ","'$nombreInterventor__i', ","'$fechaInicialI', ","'$fechaFinalI', ","'$fecha_actual'"));

			$mensaje=1;
			$jason['mensaje']=$mensaje;

		break;		


		case "reasinar__planis":

			if ($identificado=="subsecretaria") {
				
				$valores=array("subsecretaria=NULL, subsecretariaE=NULL");
				$actualiza2=$objeto->getActualiza("poa_preliminar_envio",$valores,"idOrganismo",$idOrganismoM);

			}else if($identificado=="instalaciones"){

				$valores=array("instalaciones=NULL, instalacionesE=NULL, instlaaciones2=NULL, instalacionesE2=NULL");
				$actualiza2=$objeto->getActualiza("poa_preliminar_envio",$valores,"idOrganismo",$idOrganismoM);

			}else if($identificado=="financiero"){

				$valores=array("financiero=NULL, financiero2=NULL, financieroE=NULL, financieroE2=NULL");
				$actualiza2=$objeto->getActualiza("poa_preliminar_envio",$valores,"idOrganismo",$idOrganismoM);

			}

			$mensaje=1;
			$jason['mensaje']=$mensaje;


		break;		


		case "asignarDocus__financieros":

			$direccion__polizaOriginal="../../documentos/financiero/polizaOriginal/";
			$direccion__caucionOrginal="../../documentos/financiero/caucionOrginal/";
			$direccion__copiaCertificadoBancario="../../documentos/financiero/copiaCertificadoBancario/";
			$direccion__copiaRegistroD="../../documentos/financiero/copiaRegistroD/";
			$direccion__copia_adminFinanciero="../../documentos/financiero/copia_adminFinanciero/";
			$direccion__copia_adminGeneral="../../documentos/financiero/copia_adminGeneral/";
			$direccion__copia__registroIn="../../documentos/financiero/copia__registroIn/";
			$direccion__copia_acuerdoRegistro="../../documentos/financiero/copia_acuerdoRegistro/";
			$direccion__copia_ruc="../../documentos/financiero/copia_ruc/";

			$nombre__archivo=$fecha_actual."__".$idOrganismo.".pdf";

			$documento=$objeto->getEnviarPdf($_FILES["archivo0"]['type'],$_FILES["archivo0"]['size'],$_FILES["archivo0"]['tmp_name'],$_FILES["archivo0"]['name'],$direccion__polizaOriginal,$nombre__archivo);

			$documento=$objeto->getEnviarPdf($_FILES["archivo1"]['type'],$_FILES["archivo1"]['size'],$_FILES["archivo1"]['tmp_name'],$_FILES["archivo1"]['name'],$direccion__caucionOrginal,$nombre__archivo);

			$documento=$objeto->getEnviarPdf($_FILES["archivo2"]['type'],$_FILES["archivo2"]['size'],$_FILES["archivo2"]['tmp_name'],$_FILES["archivo2"]['name'],$direccion__copiaCertificadoBancario,$nombre__archivo);

			$documento=$objeto->getEnviarPdf($_FILES["archivo3"]['type'],$_FILES["archivo3"]['size'],$_FILES["archivo3"]['tmp_name'],$_FILES["archivo3"]['name'],$direccion__copiaRegistroD,$nombre__archivo);

			if (!isset($archivo4)) {

				$documento=$objeto->getEnviarPdf($_FILES["archivo4"]['type'],$_FILES["archivo4"]['size'],$_FILES["archivo4"]['tmp_name'],$_FILES["archivo4"]['name'],$direccion__copia_adminFinanciero,$nombre__archivo);

				$nombre__archivo5=$fecha_actual."__".$idOrganismo.".pdf";

			}else{

				$nombre__archivo5=null;

			}



			if (!isset($archivo5)) {

				$documento=$objeto->getEnviarPdf($_FILES["archivo5"]['type'],$_FILES["archivo5"]['size'],$_FILES["archivo5"]['tmp_name'],$_FILES["archivo5"]['name'],$direccion__copia_adminGeneral,$nombre__archivo);

				$nombre__archivo6=$fecha_actual."__".$idOrganismo.".pdf";

			}else{

				$nombre__archivo6=null;

			}


			if(!isset($archivo6)){

				$documento=$objeto->getEnviarPdf($_FILES["archivo6"]['type'],$_FILES["archivo6"]['size'],$_FILES["archivo6"]['tmp_name'],$_FILES["archivo6"]['name'],$direccion__copia__registroIn,$nombre__archivo);

				$nombre__archivo7=$fecha_actual."__".$idOrganismo.".pdf";

			}else{

				$nombre__archivo7=null;

			}


			

			$documento=$objeto->getEnviarPdf($_FILES["archivo7"]['type'],$_FILES["archivo7"]['size'],$_FILES["archivo7"]['tmp_name'],$_FILES["archivo7"]['name'],$direccion__copia_acuerdoRegistro,$nombre__archivo);

			$documento=$objeto->getEnviarPdf($_FILES["archivo8"]['type'],$_FILES["archivo8"]['size'],$_FILES["archivo8"]['tmp_name'],$_FILES["archivo8"]['name'],$direccion__copia_ruc,$nombre__archivo);

			$inserta=$objeto->getInsertaNormal('poa_financiero_documentos', array("`idFinancieroD`, ","`polizaOriginal`, ","`caucionOrginal`, ","`copiaCertificadoBancario`, ","`copiaRegistroD`, ","`copia_adminFinanciero`, ","`copia_adminGeneral`, ","`copia__registroIn`, ","`copia_acuerdoRegistro`, ","`copia_ruc`, ","`idOrganismo`, ","`fecha`"),array("'$nombre__archivo', ","'$nombre__archivo', ","'$nombre__archivo', ","'$nombre__archivo', ","'$nombre__archivo5', ","'$nombre__archivo6', ","'$nombre__archivo7', ","'$nombre__archivo', ","'$nombre__archivo', ","'$idOrganismo', ","'$fecha_actual'"));



			$mensaje=1;
			$jason['mensaje']=$mensaje;

		break;		



		case "edicionMatricez":


			$valores=array("$campo='$valor'");
			$actualiza2=$objeto->getActualiza($tabla,$valores,$campoComparado,$idOrganismo);


			$mensaje=1;
			$jason['mensaje']=$mensaje;

		break;		



		case "poaFinales":

			$direccionDocumentos="../../documentos/aprobacion/";

			$documento=$objeto->getEnviarPdf($_FILES["documentoFinal"]['type'],$_FILES["documentoFinal"]['size'],$_FILES["documentoFinal"]['tmp_name'],$_FILES["documentoFinal"]['name'],$direccionDocumentos,$fecha_actual."__".$organismoIdPrin.".pdf");

			$fecha__quipux__segundos= strtotime($fecha__quipux);

			$quinceDias = $objeto->sumasdiasemana(date('Y-m-d',$fecha__quipux__segundos),15);

			$inserta=$objeto->getInsertaNormal('poa_documentofinal', array("`idFinal`, ","`documento`, ","`idOrganismo`, ","`fecha`, ","`numeroOficioNoti`, ","`numeroNotificacion`, ","`fecha_quipux`, ","`montoSinDescuentos`, ","`fecha_dias`"),array("'$fecha_actual"."__"."$organismoIdPrin.pdf', ","'$organismoIdPrin', ","'$fecha_actual', ","'$numeroOficioNoti', ","'$numeroNotificacion', ","'$fecha__quipux', ","'$montoTechoSin', ","'$quinceDias'"));

			$valores=array("planificacion='T'");
			$actualiza2=$objeto->getActualiza("poa_preliminar_envio",$valores,"idOrganismo",$organismoIdPrin);

			$mensaje=1;
			$jason['mensaje']=$mensaje;

		break;		


		case "observacionesPoa":

			$valores=array("estado='R'");
			$actualiza2=$objeto->getActualiza("poa_conclusion_observacion",$valores,"idOrganismo",$organismoIdPrin);

			$mensaje=1;
			$jason['mensaje']=$mensaje;

		break;		


		case "observacionPlanificacion":

			if ($informador=="d") {
				$valorUnico='T';
			}else{
				$valorUnico='T';
			}

			$valores=array("idUsuario='$valorUnico'");
			$actualiza2=$objeto->getActualiza("poa_conclusion_observacion",$valores,"idOrganismo",$idOrganismo);

			$mensaje=1;
			$jason['mensaje']=$mensaje;

		break;		

		case "insertarObservaciones":

			$array=json_decode($valoresAnadidos);
			$array2=json_decode($valoresAnadidos2);

			$elimina=$objeto->getElimina__indices('poa_conclusion_observacion','idOrganismo',$idOrganismo,'tipoObservacion',$tipoDocumento);

			$elimina2=$objeto->getElimina__indices('poa_concluciones','idOrganismo',$idOrganismo,'tipoObservacion',$tipoDocumento);


			$valores=array("estadoObservacion=NULL");
			$actualiza2=$objeto->getActualiza__confirmado("poa_concluciones",$valores,"idOrganismo",$idOrganismo,"tipoObservacion",$tipoDocumento);

			$obtenerInformacion=$objeto->getObtenerInformacionGeneral("SELECT a.id_usuario,a.usuario FROM th_usuario AS a INNER JOIN th_usuario_roles AS b ON a.id_usuario=b.id_usuario WHERE b.id_rol='2' AND a.fisicamenteEstructura='18' AND a.estadoUsuario='A';");

			$idRenderizados=$obtenerInformacion[0][id_usuario];

			$inserta2=$objeto->getInsertaNormal('poa_conclusion_observacion', array("`idConclucionO`, ","`idOrganismo`, ","`estado`, ","`idUsuario`, ","`fecha`, ","`tipoObservacion`"),array("'$idOrganismo', ","'A', ", "'$idRenderizados', ","'$fecha_actual', ","'$tipoDocumento'"));

			foreach ($array as $key => $value) {
				
				$inserta=$objeto->getInsertaNormal('poa_concluciones', array("`idObservacionesTecnicas`, ","`observaciones`, ","`concluciones`, ","`idOrganismo`, ","`fecha`, ","`idUsuario`, ","`documento`, ","`tipoObservacion`, ","`estadoObservacion`"),array("'$array2[$key]', ","'$observaAdicionales', ", "'$idOrganismo', ","'$fecha_actual', ","'$idUsuarioEn', ","'$value', ","'$tipoDocumento', ","'A'"));

			}


			$mensaje=1;
			$jason['mensaje']=$mensaje;

		break;

		case "inforPlanificacion":

			$obtenerInformacion=$objeto->getObtenerInformacionGeneral("SELECT a.id_usuario,a.usuario FROM th_usuario AS a INNER JOIN th_usuario_roles AS b ON a.id_usuario=b.id_usuario WHERE b.id_rol='2' AND a.fisicamenteEstructura='18' AND a.estadoUsuario='A';");

			if ($informador=="c") {
				$valorUnico=$obtenerInformacion[0][id_usuario];
			}else{
				$valorUnico=$valorObtenido;
			}

			$valores=array("financieroE='T',financieroE2='T',instalacionesE='T',instalacionesE2='T',subsecretariaE='T',planificacion='$valorUnico'");
			$actualiza2=$objeto->getActualiza("poa_preliminar_envio",$valores,"idOrganismo",$idOrganismo);

			$mensaje=1;
			$jason['mensaje']=$mensaje;

		break;

		case "editaInforItemsF":

			$sumatoreComparas=(floatval($disponibleP) - floatval($montoRestar)) + floatval($total__items);

			$sumatoreComparas=round($sumatoreComparas, 2);

			// if (floatval($sumatoreComparas)>floatval($asignadoP)) {
				
			// 	$mensaje=2;
			// 	$jason['sumatoreComparas']=$sumatoreComparas;
			// 	$jason['mensaje']=$mensaje;

			// }else{


				$valoresCuarta=array("enero='$enero__items', febrero='$febrero__items', marzo='$marzo__items', abril='$abril__items', mayo='$mayo__items', junio='$junio__items', julio='$julio__items',agosto='$agosto__items',septiembre='$septiembre__items',octubre='$octubre__items',noviembre='$noviembre__items',diciembre='$diciembre__items', totalSumaItem='$total__items', totalTotales='$total__items'");
				$actualizaCuarta=$objeto->getActualiza("poa_programacion_financiera",$valoresCuarta,"idProgramacionFinanciera",$idFinancierosIP);

				$mensaje=1;
				$jason['sumatoreComparas']=$sumatoreComparas;
				$jason['mensaje']=$mensaje;


			// }


		break;

		case "recomendadoUni":

				if ($talentos=="si") {
					$fisicamenteE=$fisicamenteE."___"."7";
				}

				if ($infrasEs=="si") {
					$fisicamenteE=$fisicamenteE."___"."15";
				}
				
				if ($fisicamenteEn==24 || $fisicamenteEn==26 || $fisicamenteEn=="12" || $fisicamenteEn=="13" || $fisicamenteEn=="14" || $fisicamenteEn=="19" || $fisicamenteEn=="13" || $fisicamenteEn=="13" || $fisicamenteEn=="13" || $fisicamenteEn=="13" || $fisicamenteEn=="13" || $variableNotificaciones=="corrdinacionSubsecc" && $variableNotificaciones!="tramiteFinan__coordinas"  && $variableNotificaciones!="subsesAsigna__corInstalac") {

					$nombrePdf=$fecha_actual."__".$idOrganismo."s"."__".$fisicamenteEn."__".$idRolRealizados.".pdf";

				}else if($fisicamenteEn==1 || $fisicamenteEn==6 || $fisicamenteEn==15 || $variableNotificaciones=="subsesAsigna__corInstalac"){

					$nombrePdf=$fecha_actual."__".$idOrganismo."i"."__".$fisicamenteEn."__".$idRolRealizados.".pdf";
					
				}else if($fisicamenteEn==2 || $fisicamenteEn==5 || $fisicamenteEn==7 || $variableNotificaciones=="tramiteFinan__coordinas"){

					$nombrePdf=$fecha_actual."__".$idOrganismo."f"."__".$fisicamenteEn."__".$idRolRealizados.".pdf";

				}else{

					$nombrePdf=$fecha_actual."__".$idOrganismo."__".$fisicamenteEn."__".$idRolRealizados.".pdf";

				}


				$documento=$objeto->getEnviarPdf($_FILES["pdfArchivos"]['type'],$_FILES["pdfArchivos"]['size'],$_FILES["pdfArchivos"]['tmp_name'],$_FILES["pdfArchivos"]['name'],"../../documentos/informesTecnicos/",$nombrePdf);

			// if ($idRolRealizados==3) {

	

				$inserta=$objeto->getInsertaNormal('poa_concluciones', array("`idObservacionesTecnicas`, ","`observaciones`, ","`concluciones`, ","`idOrganismo`, ","`fecha`, ","`idUsuario`, ","`documento`"),array("'N/A', ","'N/A', ", "'$idOrganismo', ","'$fecha_actual', ","'$idUsuarioEn', ","'".$nombrePdf."'"));

			// }

			$fisicamenteE=$fisicamenteE;

			
			$obtenerInformacion=$objeto->getObtenerInformacionGeneral("SELECT email,PersonaACargo FROM th_usuario WHERE id_usuario='$idUsuarioEn';");

			$obtenerInformacion2=$objeto->getObtenerInformacionGeneral("SELECT nombreOrganismo FROM poa_organismo WHERE idOrganismo='$idOrganismo';");


			$obtenerInformacionRoles=$objeto->getObtenerInformacionGeneral("SELECT b.id_rol FROM th_usuario AS a INNER JOIN th_usuario_roles AS b ON a.id_usuario=b.id_usuario INNER JOIN th_roles AS c ON c.id_rol=b.id_rol WHERE a.id_usuario='$idUsuarioEnvio';");



			if ($obtenerInformacionRoles[0][id_rol]==3) {


				if ($fisicamenteE==24 || $fisicamenteE==26 || $fisicamenteE=="12" || $fisicamenteE=="13" || $fisicamenteE=="14" || $fisicamenteE=="19" || $fisicamenteE=="13" || $fisicamenteE=="13" || $fisicamenteE=="13" || $fisicamenteE=="13" || $fisicamenteE=="13" || $variableNotificaciones=="coordinacionSubsess" || $variableNotificaciones=="subsesAsigna__cor" && $variableNotificaciones!="subsesAsigna__corFinans" && $variableNotificaciones!="subsesAsigna__corInstalaciones") {
				
					$valores=array("subsecretaria='$idUsuarioEnvio', subsecretariaE=NULL");
					$actualiza2=$objeto->getActualiza("poa_preliminar_envio",$valores,"idOrganismo",$idOrganismo);


				}else if(($fisicamenteE==1 || $fisicamenteE==6 || $fisicamenteE==15 || $fisicamenteE==27 || $fisicamenteE==28 || $fisicamenteE==29 || $fisicamenteE==30 || $fisicamenteE==31 || $fisicamenteE==32 || $fisicamenteE==33 || $variableNotificaciones=="subsesAsigna__corInstalaciones") && $variableNotificaciones!="subsesAsigna__corFinans"){


					$arrayCadena = explode(",", $idUsuarioEnvio);

					foreach ($arrayCadena as $clave => $valor) {
						
						$obtenerInformacion=$objeto->getObtenerInformacionGeneral("SELECT fisicamenteEstructura,zonal FROM th_usuario WHERE id_usuario='$valor';");

						if (count($arrayCadena)>1 && $obtenerInformacion[0][zonal]>1) {
							
							$mensajeAho="zonalError";
					
						}else if(count($arrayCadena)>2){

							$mensajeAho="zonalEleccion";

						}else if ($obtenerInformacion[0][fisicamenteEstructura]==6 || $fisicamenteE==6) {
								
							$valores=array("instalaciones='$valor', instalacionesE=NULL");
							$actualiza2=$objeto->getActualiza("poa_preliminar_envio",$valores,"idOrganismo",$idOrganismo);

						}else{

							$valores2=array("instlaaciones2='$valor', instalacionesE2=NULL");
							$actualiza3=$objeto->getActualiza("poa_preliminar_envio",$valores2,"idOrganismo",$idOrganismo);
							
						}

					}

					

				}else if($fisicamenteE==2 || $fisicamenteE==5 || $fisicamenteE==7 || $variableNotificaciones=="subsesAsigna__corFinans"){

					$arrayCadena = explode(",", $idUsuarioEnvio);

					foreach ($arrayCadena as $clave => $valor) {
						
						$obtenerInformacion=$objeto->getObtenerInformacionGeneral("SELECT fisicamenteEstructura FROM th_usuario WHERE id_usuario='$valor';");

						if ($obtenerInformacion[0][fisicamenteEstructura]==5) {
							
							$valores=array("financiero='$valor', financieroE=NULL");

							$actualiza2=$objeto->getActualiza("poa_preliminar_envio",$valores,"idOrganismo",$idOrganismo);

						}else{

							$valores2=array("financiero2='$valor', financieroE2=NULL");

							$actualiza3=$objeto->getActualiza("poa_preliminar_envio",$valores2,"idOrganismo",$idOrganismo);

						}

					}

				}

				if (!empty($textoObservaciones) && $textoObservaciones!=undefined) {

					$inserta=$objeto->getInsertaNormal('poa_observacionesenviadas', array("`idObservaEnvios`, ","`observaciones`, ","`fecha`, ","`idOrganismo`, ","`idUsuario`"),array("'$textoObservaciones', ", "'$fecha_actual', ","'$idOrganismo', ","'$idUsuarioEnvio'"));			
				}

					
					
			}else{

				if ($fisicamenteEn==24 || $fisicamenteEn==26 || $fisicamenteEn=="12" || $fisicamenteEn=="13" || $fisicamenteEn=="14" || $fisicamenteEn=="19" || $fisicamenteEn=="13" || $fisicamenteEn=="13" || $fisicamenteEn=="13" || $fisicamenteEn=="13" || $fisicamenteEn=="13" || $variableNotificaciones=="coordinacionSubsess" || $variableNotificaciones=="subsesAsigna__cor" && $variableNotificaciones!="subsesAsigna__corFinans" && $variableNotificaciones!="subsesAsigna__corInstalaciones") {

					$valores=array("subsecretariaE='$idUsuarioEnvio'");
					$actualiza2=$objeto->getActualiza("poa_preliminar_envio",$valores,"idOrganismo",$idOrganismo);


				}else if($fisicamenteEn==1 || $fisicamenteEn==6 || $fisicamenteEn==15 || $variableNotificaciones=="subsesAsigna__corInstalaciones"){		

					$obtenerInformacionIR=$objeto->getObtenerInformacionGeneral("SELECT fisicamenteEstructura FROM th_usuario WHERE id_usuario='$idUsuarioEn';");

					if ($obtenerInformacionIR[0][fisicamenteEstructura]==6 || $variableNotificaciones=="instalaciones") {
								
						$valores=array("instalacionesE='$idUsuarioEnvio'");
						$actualiza2=$objeto->getActualiza("poa_preliminar_envio",$valores,"idOrganismo",$idOrganismo);


					}else{

						$valores=array("instalacionesE2='$idUsuarioEnvio'");
						$actualiza2=$objeto->getActualiza("poa_preliminar_envio",$valores,"idOrganismo",$idOrganismo);

							
					}	


				}else if($fisicamenteEn==2 || $fisicamenteEn==5 || $fisicamenteEn==7 || $variableNotificaciones=="subsesAsigna__corFinans"){


					$obtenerInformacionIR=$objeto->getObtenerInformacionGeneral("SELECT fisicamenteEstructura FROM th_usuario WHERE id_usuario='$idUsuarioEn';");

					if ($obtenerInformacionIR[0][fisicamenteEstructura]==5 || $variableNotificaciones=="administrativo") {
								
						$valores=array("financieroE='$idUsuarioEnvio'");
						$actualiza2=$objeto->getActualiza("poa_preliminar_envio",$valores,"idOrganismo",$idOrganismo);

					}else{

						$valores=array("financieroE2='$idUsuarioEnvio'");
						$actualiza2=$objeto->getActualiza("poa_preliminar_envio",$valores,"idOrganismo",$idOrganismo);

					}			


				}

				if (!empty($textoObservaciones) && $textoObservaciones!=undefined && $idRolRealizados!=3) {

					$inserta=$objeto->getInsertaNormal('poa_observacionesenviadas', array("`idObservaEnvios`, ","`observaciones`, ","`fecha`, ","`idOrganismo`, ","`idUsuario`"),array("'$textoObservaciones', ", "'$fecha_actual', ","'$idOrganismo', ","'$idUsuarioEnvio'"));			
				}

				
			}

				
			$bodyMensaje='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><title>POA</title><style type="text/css">body {background:#EEE; padding:30px; font-size:16px;}'.'</style>'.'</head>'.'<span style="font-weight:bold;">COORDINACIÓN GENERAL DE PLANIFICACIÓN Y GESTIÓN ESTRATEGICA,</span><br><br>El organismo deportivo '.$obtenerInformacion2[0][nombreOrganismo].' fue reasignado a su bandeja para su respectiva revisión.</body></html>';

			$emailArray = array($obtenerInformacion[0][email]);

			$correosEnviados=$objeto->getEnviarCorreo($emailArray,$bodyMensaje);

			$mensaje=1;
						
			$jason['mensaje']=$mensaje;			
						

		break;


		case "reasignarEnvioFun":

			if ($fisicamenteEn=="subsecretariaSubse" || $variableNotificaciones=="tramiteFinan__coordinas" || $variableNotificaciones=="subsesAsigna__corInstalac") {
				$fisicamenteEn=$fisicamenteEnDoces;
				$idRolRealizados=3;
			}

			if ($fisicamenteEn==24 || $fisicamenteEn==26 || $fisicamenteEn=="12" || $fisicamenteEn=="13" || $fisicamenteEn=="14" || $fisicamenteEn=="19" || $fisicamenteEn=="13" || $fisicamenteEn=="13" || $fisicamenteEn=="13" || $fisicamenteEn=="13" || $fisicamenteEn=="13" || $variableNotificaciones=="corrdinacionSubsecc" && $variableNotificaciones!="tramiteFinan__coordinas"  && $variableNotificaciones!="subsesAsigna__corInstalac") {

				$nombrePdf=$fecha_actual."__".$idOrganismo."s"."__".$fisicamenteEn."__".$idRolRealizados.".pdf";

			}else if($fisicamenteEn==1 || $fisicamenteEn==6 || $fisicamenteEn==15 || $variableNotificaciones=="subsesAsigna__corInstalac"){

				$nombrePdf=$fecha_actual."__".$idOrganismo."i"."__".$fisicamenteEn."__".$idRolRealizados.".pdf";
				
			}else if($fisicamenteEn==2 || $fisicamenteEn==5 || $fisicamenteEn==7 || $variableNotificaciones=="tramiteFinan__coordinas"){

				$nombrePdf=$fecha_actual."__".$idOrganismo."f"."__".$fisicamenteEn."__".$idRolRealizados.".pdf";

			}else{

				$nombrePdf=$fecha_actual."__".$idOrganismo."__".$fisicamenteEn."__".$idRolRealizados.".pdf";

			}

			$documento=$objeto->getEnviarPdf($_FILES["pdfArchivos"]['type'],$_FILES["pdfArchivos"]['size'],$_FILES["pdfArchivos"]['tmp_name'],$_FILES["pdfArchivos"]['name'],"../../documentos/informesTecnicos/",$nombrePdf);

			$obtenerInformacion=$objeto->getObtenerInformacionGeneral("SELECT email,PersonaACargo,fisicamenteEstructura FROM th_usuario WHERE id_usuario='$idUsuarioEn';");

			$obtenerInformacion2=$objeto->getObtenerInformacionGeneral("SELECT nombreOrganismo FROM poa_organismo WHERE idOrganismo='$idOrganismo';");




			if ($fisicamenteEn==24 || $fisicamenteEn==26 || $fisicamenteEn=="12" || $fisicamenteEn=="13" || $fisicamenteEn=="14" || $fisicamenteEn=="19" || $fisicamenteEn=="13" || $fisicamenteEn=="13" || $fisicamenteEn=="13" || $fisicamenteEn=="13" || $fisicamenteEn=="13" || $variableNotificaciones=="corrdinacionSubsecc" && $variableNotificaciones!="tramiteFinan__coordinas"  && $variableNotificaciones!="subsesAsigna__corInstalac") {

			
				$valores=array("subsecretaria='T', subsecretariaE='".$obtenerInformacion[0][PersonaACargo]."'");
				$actualiza2=$objeto->getActualiza("poa_preliminar_envio",$valores,"idOrganismo",$idOrganismo);



			}else if($fisicamenteEn==1 || $fisicamenteEn==6 || $fisicamenteEn==15 || $variableNotificaciones=="subsesAsigna__corInstalac"){

				if ($obtenerInformacion[0][fisicamenteEstructura]==6) {
								
					$valores=array("instalaciones='T', instalacionesE='".$obtenerInformacion[0][PersonaACargo]."'");
					$actualiza2=$objeto->getActualiza("poa_preliminar_envio",$valores,"idOrganismo",$idOrganismo);

				}else{

					$valores=array("instlaaciones2='T', instalacionesE2='".$obtenerInformacion[0][PersonaACargo]."'");
					$actualiza2=$objeto->getActualiza("poa_preliminar_envio",$valores,"idOrganismo",$idOrganismo);
							
				}	


			}else if($fisicamenteEn==2 || $fisicamenteEn==5 || $fisicamenteEn==7 || $variableNotificaciones=="tramiteFinan__coordinas"){


				if ($obtenerInformacion[0][fisicamenteEstructura]==5) {
								
					$valores=array("financiero='T', financieroE='".$obtenerInformacion[0][PersonaACargo]."'");
					$actualiza2=$objeto->getActualiza("poa_preliminar_envio",$valores,"idOrganismo",$idOrganismo);

				}else{

					$valores=array("financiero2='T', financieroE2='".$obtenerInformacion[0][PersonaACargo]."'");
					$actualiza2=$objeto->getActualiza("poa_preliminar_envio",$valores,"idOrganismo",$idOrganismo);
							
				}	

			}

			$observaAdicionales=filter_var($observaAdicionales, FILTER_SANITIZE_MAGIC_QUOTES);
			$conlcusion=filter_var($conlcusion, FILTER_SANITIZE_MAGIC_QUOTES);

			$inserta=$objeto->getInsertaNormal('poa_concluciones', array("`idObservacionesTecnicas`, ","`observaciones`, ","`concluciones`, ","`idOrganismo`, ","`fecha`, ","`idUsuario`, ","`documento`"),array("'$observaAdicionales', ","'$conlcusion', ", "'$idOrganismo', ","'$fecha_actual', ","'$idUsuarioEn', ","'".$nombrePdf."'"));


			$bodyMensaje='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><title>POA</title><style type="text/css">body {background:#EEE; padding:30px; font-size:16px;}'.'</style>'.'</head>'.'<span style="font-weight:bold;">COORDINACIÓN GENERAL DE PLANIFICACIÓN Y GESTIÓN ESTRATEGICA,</span><br><br>El organismo deportivo '.$obtenerInformacion2[0][nombreOrganismo].' fue reasignado a su bandeja para su respectiva revisión.</body></html>';

			$emailArray = array($obtenerInformacion[0][email]);

			$correosEnviados=$objeto->getEnviarCorreo($emailArray,$bodyMensaje);
					
			$mensaje=1;
			$jason['mensaje']=$mensaje;			
					

		break;


		case "reasignarEnvioFinans":

			$obtenerInformacion=$objeto->getObtenerInformacionGeneral("SELECT email FROM th_usuario WHERE id_usuario='$idUsuarioEnvio';");

			$obtenerInformacion2=$objeto->getObtenerInformacionGeneral("SELECT nombreOrganismo FROM poa_organismo WHERE idOrganismo='$idOrganismo';");

			$mensajeAho=false;

			if($fisicamenteE==2 || $fisicamenteE==27 || $fisicamenteE==28 || $fisicamenteE==29 || $fisicamenteE==30 || $fisicamenteE==31 || $fisicamenteE==32 || $fisicamenteE==33){

				$arrayCadena = explode(",", $idUsuarioEnvio);

				foreach ($arrayCadena as $clave => $valor) {
					
					$obtenerInformacion=$objeto->getObtenerInformacionGeneral("SELECT fisicamenteEstructura FROM th_usuario WHERE id_usuario='$valor';");

					if ($obtenerInformacion[0][fisicamenteEstructura]==5) {
						
						$valores=array("financiero='$valor'");

						$actualiza2=$objeto->getActualiza("poa_preliminar_envio",$valores,"idOrganismo",$idOrganismo);

					}else{

						$valores2=array("financiero2='$valor'");

						$actualiza3=$objeto->getActualiza("poa_preliminar_envio",$valores2,"idOrganismo",$idOrganismo);

					}

				}

			}

			if (!empty($textoObservaciones) && $textoObservaciones!=undefined) {

				$inserta=$objeto->getInsertaNormal('poa_observacionesenviadas', array("`idObservaEnvios`, ","`observaciones`, ","`fecha`, ","`idOrganismo`, ","`idUsuario`"),array("'$textoObservaciones', ", "'$fecha_actual', ","'$idOrganismo', ","'$idUsuarioEnvio'"));			
			}


			$bodyMensaje='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><title>POA</title><style type="text/css">body {background:#EEE; padding:30px; font-size:16px;}'.'</style>'.'</head>'.'<span style="font-weight:bold;">COORDINACIÓN GENERAL DE PLANIFICACIÓN Y GESTIÓN ESTRATEGICA,</span><br><br>El organismo deportivo '.$obtenerInformacion2[0][nombreOrganismo].' fue reasignado a su bandeja para su respectiva revisión.</body></html>';

			$emailArray = array($obtenerInformacion[0][email]);

			$correosEnviados=$objeto->getEnviarCorreo($emailArray,$bodyMensaje);
					
			if ($mensajeAho=="zonalError") {
				$mensaje=2;
			}else if($mensajeAho=="zonalEleccion"){
				$mensaje=3;
			}else{
				$mensaje=1;
			}
			
			$jason['mensaje']=$mensaje;
					

		break;



		case "reasignarEnvioCoordin":

			$obtenerInformacion=$objeto->getObtenerInformacionGeneral("SELECT email FROM th_usuario WHERE id_usuario='$idUsuarioEnvio';");

			$obtenerInformacion2=$objeto->getObtenerInformacionGeneral("SELECT nombreOrganismo FROM poa_organismo WHERE idOrganismo='$idOrganismo';");

			$mensajeAho=false;

			if ($fisicamenteE==24 || $fisicamenteE==26 || $fisicamenteE=="12" || $fisicamenteE=="13" || $fisicamenteE=="14" || $fisicamenteE=="19" || $fisicamenteE=="13" || $fisicamenteE=="13" || $fisicamenteE=="13" || $fisicamenteE=="13" || $fisicamenteE=="13" || $fisicamenteE==27 || $fisicamenteE==28 || $fisicamenteE==29 || $fisicamenteE==30 || $fisicamenteE==31 || $fisicamenteE==32 || $fisicamenteE==33) {
			
				$valores=array("subsecretaria='$idUsuarioEnvio'");
				$actualiza2=$objeto->getActualiza("poa_preliminar_envio",$valores,"idOrganismo",$idOrganismo);


			}
			
			if (!empty($textoObservaciones) && $textoObservaciones!=undefined) {

				$inserta=$objeto->getInsertaNormal('poa_observacionesenviadas', array("`idObservaEnvios`, ","`observaciones`, ","`fecha`, ","`idOrganismo`, ","`idUsuario`"),array("'$textoObservaciones', ", "'$fecha_actual', ","'$idOrganismo', ","'$idUsuarioEnvio'"));			
			}


			$bodyMensaje='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><title>POA</title><style type="text/css">body {background:#EEE; padding:30px; font-size:16px;}'.'</style>'.'</head>'.'<span style="font-weight:bold;">COORDINACIÓN GENERAL DE PLANIFICACIÓN Y GESTIÓN ESTRATEGICA,</span><br><br>El organismo deportivo '.$obtenerInformacion2[0][nombreOrganismo].' fue reasignado a su bandeja para su respectiva revisión.</body></html>';

			$emailArray = array($obtenerInformacion[0][email]);

			$correosEnviados=$objeto->getEnviarCorreo($emailArray,$bodyMensaje);
					
			if ($mensajeAho=="zonalError") {
				$mensaje=2;
			}else if($mensajeAho=="zonalEleccion"){
				$mensaje=3;
			}else{
				$mensaje=1;
			}
			
			$jason['mensaje']=$mensaje;
					

		break;


		case "reasignarEnvioC":

			$obtenerInformacion=$objeto->getObtenerInformacionGeneral("SELECT email FROM th_usuario WHERE id_usuario='$idUsuarioEnvio';");

			$obtenerInformacion2=$objeto->getObtenerInformacionGeneral("SELECT nombreOrganismo FROM poa_organismo WHERE idOrganismo='$idOrganismo';");

			$mensajeAho=false;

			if ($fisicamenteE==24 || $fisicamenteE==26 || $fisicamenteE=="12" || $fisicamenteE=="13" || $fisicamenteE=="14" || $fisicamenteE=="19" || $fisicamenteE=="13" || $fisicamenteE=="13" || $fisicamenteE=="13" || $fisicamenteE=="13" || $fisicamenteE=="13") {
			
				$valores=array("subsecretaria='$idUsuarioEnvio'");
				$actualiza2=$objeto->getActualiza("poa_preliminar_envio",$valores,"idOrganismo",$idOrganismo);


			}else if($fisicamenteE==1 || $fisicamenteE==6 || $fisicamenteE==15 || $fisicamenteE==27 || $fisicamenteE==28 || $fisicamenteE==29 || $fisicamenteE==30 || $fisicamenteE==31 || $fisicamenteE==32 || $fisicamenteE==33){


				$arrayCadena = explode(",", $idUsuarioEnvio);

				foreach ($arrayCadena as $clave => $valor) {
					
					$obtenerInformacion=$objeto->getObtenerInformacionGeneral("SELECT fisicamenteEstructura,zonal FROM th_usuario WHERE id_usuario='$valor';");

					if (count($arrayCadena)>1 && $obtenerInformacion[0][zonal]>1) {
						
						$mensajeAho="zonalError";
				
					}else if(count($arrayCadena)>2){

						$mensajeAho="zonalEleccion";

					}else if ($obtenerInformacion[0][fisicamenteEstructura]==6 || $fisicamenteE==6) {
							
						$valores=array("instalaciones='$valor'");
						$actualiza2=$objeto->getActualiza("poa_preliminar_envio",$valores,"idOrganismo",$idOrganismo);

					}else{

						$valores2=array("instlaaciones2='$valor'");
						$actualiza3=$objeto->getActualiza("poa_preliminar_envio",$valores2,"idOrganismo",$idOrganismo);
						
					}

				}



			}else if($fisicamenteE==2 || $fisicamenteE==5 || $fisicamenteE==7){

				$arrayCadena = explode(",", $idUsuarioEnvio);

				foreach ($arrayCadena as $clave => $valor) {
					
					$obtenerInformacion=$objeto->getObtenerInformacionGeneral("SELECT fisicamenteEstructura FROM th_usuario WHERE id_usuario='$valor';");

					if ($obtenerInformacion[0][fisicamenteEstructura]==5) {
						
						$valores=array("financiero='$valor'");

						$actualiza2=$objeto->getActualiza("poa_preliminar_envio",$valores,"idOrganismo",$idOrganismo);

					}else{

						$valores2=array("financiero2='$valor'");

						$actualiza3=$objeto->getActualiza("poa_preliminar_envio",$valores2,"idOrganismo",$idOrganismo);

					}

				}

			}

			if (!empty($textoObservaciones) && $textoObservaciones!=undefined) {

				$inserta=$objeto->getInsertaNormal('poa_observacionesenviadas', array("`idObservaEnvios`, ","`observaciones`, ","`fecha`, ","`idOrganismo`, ","`idUsuario`"),array("'$textoObservaciones', ", "'$fecha_actual', ","'$idOrganismo', ","'$idUsuarioEnvio'"));			
			}


			$bodyMensaje='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><title>POA</title><style type="text/css">body {background:#EEE; padding:30px; font-size:16px;}'.'</style>'.'</head>'.'<span style="font-weight:bold;">COORDINACIÓN GENERAL DE PLANIFICACIÓN Y GESTIÓN ESTRATEGICA,</span><br><br>El organismo deportivo '.$obtenerInformacion2[0][nombreOrganismo].' fue reasignado a su bandeja para su respectiva revisión.</body></html>';

			$emailArray = array($obtenerInformacion[0][email]);

			$correosEnviados=$objeto->getEnviarCorreo($emailArray,$bodyMensaje);
					
			if ($mensajeAho=="zonalError") {
				$mensaje=2;
			}else if($mensajeAho=="zonalEleccion"){
				$mensaje=3;
			}else{
				$mensaje=1;
			}
			
			$jason['mensaje']=$mensaje;
					

		break;


		case "preliminarPoa":

			$inserta=$objeto->getInsertaNormal('poa_preliminar_envio', array("`idPoaInicial`, ","`idOrganismo`, ","`activo`, ","`fecha`, ","`hora`"),array("'$organismoIdPrin', ","'A', ", "'$fecha_actual', ","'$hora_actual'"));

			$obtenerInformacion=$objeto->getObtenerInformacionGeneral("SELECT correo,nombreDelOrganismoSegunAcuerdo FROM poa_organismo WHERE idOrganismo='$organismoIdPrin';");



			$bodyMensaje='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><title>POA</title><style type="text/css">body {background:#EEE; padding:30px; font-size:16px;}'.'</style>'.'</head>'.'<span style="font-weight:bold;">COORDINACIÓN GENERAL DE PLANIFICACIÓN Y GESTIÓN ESTRATEGICA,</span><br><br>El organismo deportivo '.$obtenerInformacion[0][nombreDelOrganismoSegunAcuerdo].' realizó el envío del POA PRELIMINAR.</body></html>';

			$emailArray = array($obtenerInformacion[0][nombreDelOrganismoSegunAcuerdo]);

			$correosEnviados=$objeto->getEnviarCorreo($emailArray,$bodyMensaje);
					

			$mensaje=1;
			$jason['mensaje']=$mensaje;


		break;


		case "mensajeContacto":

			$insertaZonal=$objeto->getInserta('poa_organismocorreo',array("`idMensajeriaPoa`, ","`texto`, ","`idOrganismo`, ","`fecha`, ","`hora`"),array(":texto, ",":idOrganismo, ",":fecha, ",":hora"),array("$observacionOnrganismos","$idOrganismo","$fecha_actual","$hora_actual"),array(":texto",":idOrganismo",":fecha",":hora"));

			$bodyMensaje='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><title>POA</title><style type="text/css">body {background:#EEE; padding:30px; font-size:16px;}'.'</style>'.'</head>'.'<span style="font-weight:bold;">COORDINACIÓN GENERAL DE PLANIFICACIÓN Y GESTIÓN ESTRATEGICA,</span><br><br>El organismo deportivo '.$nombreOrganismo.' realizó la siguiente observación:<br><br>'.$observacionOnrganismos.'</body></html>';

			$emailArray = array($correoResponsable);
				
			$correosEnviados=$objeto->getEnviarCorreoDosParametros($emailArray,$bodyMensaje,$emailOrganismo);		


			$mensaje=1;
			$jason['mensaje']=$mensaje;


		break;


		case  "asignacionPresupuestos":

		$nombreOrganismo=$objeto->getBuscadorInicial("nombreOrganismo","poa_organismo","idOrganismo",$idOrganismo);
		$correoOrganismo=$objeto->getBuscadorInicial("correo","poa_organismo","idOrganismo",$idOrganismo);

		/*===========================================
		=            Ingresar documentos            =
		===========================================*/

		// $documento=$objeto->getEnviarPdf($_FILES["documentoAsignacion"]['type'],$_FILES["documentoAsignacion"]['size'],$_FILES["documentoAsignacion"]['tmp_name'],$_FILES["documentoAsignacion"]['name'],"../../documentos/asignacionRecursos/",$nombreOrganismo.$asignacionPresupuestaria.".pdf");		
		
		
		/*=====  End of Ingresar documentos  ======*/

		// if ($documento=="no") {

		// 	$mensaje=2;
		// 	$jason['mensaje']=$mensaje;
				
		// }else if($documento=="nopdf"){

		// 	$mensaje=3;
		// 	$jason['mensaje']=$mensaje;

		// }else{

			$inserta=$objeto->getInserta('poa_inversion', array("`idInversion`, ","`nombreInversion`, ","`estado`, ","`fecha`, ","`hora`, ","`inversionQueda`, ","`ejercicioFiscal`"),array(":nombreInversion, ",":estado, ",":fecha, ",":hora, ",":inversionQueda, ",":ejercicioFiscal"),array("$asignacionPresupuestaria","A","$fecha_actual","$hora_actual","$asignacionPresupuestaria","$periodoAsignacion-01-01"),array(":nombreInversion",":estado",":fecha",":hora",":inversionQueda",":ejercicioFiscal"));	
			
			$maximo=$objeto->getMaximoFuncion('idInversion','poa_inversion');	

			$inserta2=$objeto->getInserta('poa_inversion_usuario', array("`idInversionUsuario`, ","`idUsuario`, ","`idInversion`, ","`idOrganismo`"),array(":idUsuario, ",":idInversion, ",":idOrganismo"),array("$idUsuarioPrincipal","$maximo","$idOrganismo"),array(":idUsuario",":idInversion",":idOrganismo"));	

			$inserta3=$objeto->getInserta('poa_organismo_documento', array("`idOrganismoDocumento`, ","`direccionDelDocumento`, ","`fecha`, ","`hora`, ","`idUsuario`, ","`idOrganismo`, ","`numeroDeAcuerdo`"),array(":direccionDelDocumento, ",":fecha, ",":hora, ",":idUsuario, ",":idOrganismo, ",":numeroDeAcuerdo"),array("N/A","$fecha_actual","$hora_actual","$idUsuarioPrincipal","$idOrganismo","N/A"),array(":direccionDelDocumento",":fecha",":hora",":idUsuario",":idOrganismo",":numeroDeAcuerdo"));	

			$valores=array("periodo='$periodoAsignacion'");
			$actualiza2=$objeto->getActualiza("poa_organismo",$valores,"idOrganismo",$idOrganismo);

			/*===========================================
			=            Enviador de correos            =
			===========================================*/

			$bodyMensaje='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><title>POA</title><style type="text/css">body {background:#EEE; padding:30px; font-size:16px;}'.'</style>'.'</head>'.'<span style="font-weight:bold;">COORDINACIÓN GENERAL DE PLANIFICACIÓN Y GESTIÓN ESTRATEGICA,</span><br><br>El Organismo Deportivo <span style="font-weight:bold;">'.$nombreOrganismo.'</span>&nbsp; fue asignado su presupuesto de '.$asignacionPresupuestaria.' para el periodo '.$periodoAsignacion.' ya puede ingresar su planificación anual desde el aplicativo.</body></html>';

			$emailArray = array($correoOrganismo);
					
			$correosEnviados=$objeto->getEnviarCorreo($emailArray,$bodyMensaje);

			/*=====  End of Enviador de correos  ======*/

			$mensaje=1;
			$jason['mensaje']=$mensaje;


		// }
		

		break;


	}

	echo json_encode($jason);





