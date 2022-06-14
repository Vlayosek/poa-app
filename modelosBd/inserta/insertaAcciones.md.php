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

		case  "proyecto__paid":

			$objetivo__especificos = json_decode($objetivo__especificos);
			$actividades__rubros = json_decode($actividades__rubros);
			$matriz__auxiliar = json_decode($matriz__auxiliar);
			$campo__columna = json_decode($campo__columna);
			$items__proyecto = json_decode($items__proyecto);
			$codigo__proyecto = json_decode($codigo__proyecto);
			$indicador__proyecto = json_decode($indicador__proyecto);

			$inserta=$objeto->getInsertaNormal('poa_paid_proyecto', array("`idProyectoPaid`, ","`programa__creado`, ","`proyecto__inversion`, ","`codigo__proyecto`, ","`fecha__inicioProyecto`, ","`fecha__finProyecto`, ","`area__responsable`, ","`lider__proyecto`, ","`cup__proyecto`, ","`objetivos__proyectos`, ","`general__proyecto`, ","`idUsuario`, ","`fecha`, ","`hora`"),array("'$progra__creado', ","'$proyecto__inversion', ","'$codigo__proyecto__solo', ","'$fecha__inicioProyecto', ","'$fecha__finProyecto', ","'$area__responsable', ","'$lider__proyecto', ","'$cup__proyecto', ","'$objetivos__proyectos', ","'$general__proyecto', ","'$idUsuarioPrincipal', ","'$fecha_actual', ","'$hora_actual'"));

			$maximo=$objeto->getMaximoFuncion('idProyectoPaid','poa_paid_proyecto');

			$data1=array();

			array_push($data1, count($objetivo__especificos));
			array_push($data1, count($actividades__rubros));
			array_push($data1, count($matriz__auxiliar));
			array_push($data1, count($campo__columna));
			array_push($data1, count($items__proyecto));
			array_push($data1, count($codigo__proyecto));
			array_push($data1, count($indicador__proyecto));


			for ($i=0; $i < max($data1); $i++) { 

				if (empty($objetivo__especificos[$i])) {
					$obEspecifico=NULL;
				}else{
					$obEspecifico=$objetivo__especificos[$i];
				}

				if (empty($actividades__rubros[$i])) {
					$rubroAc=NULL;
				}else{
					$rubroAc=$actividades__rubros[$i];
				}

				if (empty($matriz__auxiliar[$i])) {
					$matrizAux=NULL;
				}else{
					$matrizAux=$matriz__auxiliar[$i];
				}

				if (empty($campo__columna[$i])) {
					$campoColum=NULL;
				}else{
					$campoColum=$campo__columna[$i];
				}

				if (empty($items__proyecto[$i])) {
					$itemsPro=NULL;
				}else{
					$itemsPro=$items__proyecto[$i];
				}

				if (empty($codigo__proyecto[$i])) {
					$codigoProye=NULL;
				}else{
					$codigoProye=$codigo__proyecto[$i];
				}


				if (empty($indicador__proyecto[$i])) {
					$indicadorPro=NULL;
				}else{
					$indicadorPro=$indicador__proyecto[$i];
				}


				$inserta2=$objeto->getInsertaNormal('poa_paid_proyecto_enlace', array("`idElementosProyecto`, ","`objetivo__especificos`, ","`actividades__rubros`, ","`matriz__auxiliar`, ","`campo__columna`, ","`items__proyecto`, ","`codigo__proyecto`, ","`indicador__proyecto`, ","`idProyectoPaid`, ","`fecha`, ","`hora`, ","`idUsuario`"),array("'$obEspecifico', ","'$rubroAc', ","'$matrizAux', ","'$campoColum', ","'$itemsPro', ","'$codigoProye', ","'$indicadorPro', ","'$maximo', ","'$fecha_actual', ","'$hora_actual', ","'$idUsuarioPrincipal'"));
					
			}

			$mensaje=1;
			$jason['mensaje']=$mensaje;

		break;


		case  "honorarios":

			$mesesArray = json_decode($mesesArray);
			$valoresArray = json_decode($valoresArray);

			$inversionOrganismo=$objeto->getObtenerInformacionGeneral("SELECT b.nombreInversion FROM poa_inversion_usuario AS a INNER JOIN poa_inversion AS b ON a.idInversion=b.idInversion WHERE a.idOrganismo='".$idOrganismo."' ORDER BY b.idInversion DESC LIMIT 1;");

			$inversionOrganismoAsignada=$objeto->getObtenerInformacionGeneral("SELECT SUM(totalSumaItem) AS sumaItemTotal FROM poa_programacion_financiera WHERE idOrganismo='".$idOrganismo."' GROUP BY idOrganismo;");

			$sumar=round(floatval($inversionOrganismoAsignada[0][sumaItemTotal]) + floatval($mesesArray[12]),2);	


			if (floatval($sumar)>floatval($inversionOrganismo[0][nombreInversion])) {

				$mensaje=20;
					
			}else{

				$honorarios=$objeto->getObtenerInformacionGeneral("SELECT a.idProgramacionFinanciera AS honorarios, a.enero,a.febrero,a.marzo,a.abril,a.mayo,a.junio,a.julio,a.agosto,a.septiembre,a.octubre,a.noviembre,a.diciembre,a.totalSumaItem,a.totalTotales FROM poa_programacion_financiera AS a INNER JOIN poa_item AS b ON a.idItem=b.idItem WHERE b.itemPreesupuestario='530606' AND a.idOrganismo='$idOrganismo' AND idActividad='$idActividad';");

				if (empty($honorarios[0][honorarios])) {
					
					$mensaje=105;

				}else{


						$sumarUniEnero=$objeto->mesesSumarS($honorarios[0][enero],$mesesArray[0]);
						$sumarUniFebrero=$objeto->mesesSumarS($honorarios[0][febrero],$mesesArray[1]);
						$sumarUniMarzo=$objeto->mesesSumarS($honorarios[0][marzo],$mesesArray[2]);
						$sumarUniAbril=$objeto->mesesSumarS($honorarios[0][abril],$mesesArray[3]);
						$sumarUniMayo=$objeto->mesesSumarS($honorarios[0][mayo],$mesesArray[4]);
						$sumarUniJunio=$objeto->mesesSumarS($honorarios[0][junio],$mesesArray[5]);
						$sumarUniJulio=$objeto->mesesSumarS($honorarios[0][julio],$mesesArray[6]);
						$sumarUniAgosto=$objeto->mesesSumarS($honorarios[0][agosto],$mesesArray[7]);
						$sumarUniSeptiembre=$objeto->mesesSumarS($honorarios[0][septiembre],$mesesArray[8]);
						$sumarUniOctubre=$objeto->mesesSumarS($honorarios[0][octubre],$mesesArray[9]);
						$sumarUniNoviembre=$objeto->mesesSumarS($honorarios[0][noviembre],$mesesArray[10]);
						$sumarUniDiciembre=$objeto->mesesSumarS($honorarios[0][diciembre],$mesesArray[11]);
						$totalUnificado=floatval($mesesArray[12]) + floatval($honorarios[0][totalSumaItem]);



					$valoresHonorarios=array("enero='$sumarUniEnero', febrero='$sumarUniFebrero', marzo='$sumarUniMarzo', abril='$sumarUniAbril', mayo='$sumarUniMayo', junio='$sumarUniJunio', julio='$sumarUniJulio',agosto='$sumarUniAgosto',septiembre='$sumarUniSeptiembre',octubre='$sumarUniOctubre',noviembre='$sumarUniNoviembre',diciembre='$sumarUniDiciembre', totalSumaItem='$totalUnificado', totalTotales='$totalUnificado'");
					$actualizaUnificados=$objeto->getActualiza("poa_programacion_financiera",$valoresHonorarios,"idProgramacionFinanciera",$honorarios[0][honorarios]);

		
					$inserta=$objeto->getInsertaNormal('poa_honorarios2022', array("`idHonorarios`, ","`cedula`, ","`nombres`, ","`cargo`, ","`tipoCargo`, ","`honorarioMensual`, ","`enero`, ","`febrero`, ","`marzo`, ","`abril`, ","`mayo`, ","`junio`, ","`julio`, ","`agosto`, ","`septiembre`, ","`octubre`, ","`noviembre`, ","`diciembre`, ","`total`, ","`idOrganismo`, ","`fecha`, ","`idActividad`"),array("'$valoresArray[0]', ","'$valoresArray[1]', ","'$valoresArray[2]', ","'$valoresArray[3]', ", "'$valoresArray[4]', ", "'$mesesArray[0]', ", "'$mesesArray[1]', ", "'$mesesArray[2]', ", "'$mesesArray[3]', ", "'$mesesArray[4]', ", "'$mesesArray[5]', ", "'$mesesArray[6]', ", "'$mesesArray[7]', ", "'$mesesArray[8]', ", "'$mesesArray[9]', ", "'$mesesArray[10]', ", "'$mesesArray[11]', ", "'$mesesArray[12]', ", "'$idOrganismo', ", "'$fecha_actual', ", "'$idActividad'"));

					$mensaje=1;

				}

			}

			$jason['mensaje']=$mensaje;

		break;		



		case  "sueldosSalarios":

			$mesesArray = json_decode($mesesArray);
			$valoresArray = json_decode($valoresArray);

			$salariosUnificados=$objeto->getObtenerInformacionGeneral("SELECT a.idProgramacionFinanciera AS salariosUnificados, a.enero,a.febrero,a.marzo,a.abril,a.mayo,a.junio,a.julio,a.agosto,a.septiembre,a.octubre,a.noviembre,a.diciembre,a.totalSumaItem,a.totalTotales FROM poa_programacion_financiera AS a INNER JOIN poa_item AS b ON a.idItem=b.idItem WHERE b.itemPreesupuestario='510106' AND a.idOrganismo='$idOrganismo' AND a.idActividad='$idActividad';");

			$aportePatronal=$objeto->getObtenerInformacionGeneral("SELECT a.idProgramacionFinanciera AS aportPatronal, a.enero AS eneroPa,a.febrero AS febreroP,a.marzo AS marzoP,a.abril AS abrilP,a.mayo AS mayoP,a.junio AS junioP,a.julio AS julioP,a.agosto AS agostoP,a.septiembre AS septiembreP,a.octubre AS octubreP,a.noviembre AS noviembreP,a.diciembre AS diciembreP,a.totalSumaItem AS totalSumaItemP,a.totalTotales AS totalTotalesP FROM poa_programacion_financiera AS a INNER JOIN poa_item AS b ON a.idItem=b.idItem  WHERE b.itemPreesupuestario='510601' AND a.idOrganismo='$idOrganismo' AND a.idActividad='$idActividad';");

			$fondoReserva=$objeto->getObtenerInformacionGeneral("SELECT a.idProgramacionFinanciera AS fondoReserva, a.enero AS eneroFondo,a.febrero AS febreroFondo,a.marzo AS marzoFondo,a.abril AS abrilFondo,a.mayo AS mayoFondo,a.junio AS junioFondo,a.julio AS julioFondo,a.agosto AS agostoFondo,a.septiembre AS septiembreFondo,a.octubre AS octubreFondo,a.noviembre AS noviembreFondo,a.diciembre AS diciembreFondo,a.totalSumaItem AS totalSumaItemFondo,a.totalTotales AS totalTotalesFondo FROM poa_programacion_financiera AS a INNER JOIN poa_item AS b ON a.idItem=b.idItem  WHERE b.itemPreesupuestario='510602' AND a.idOrganismo='$idOrganismo' AND a.idActividad='$idActividad';");


			$decimoTercera=$objeto->getObtenerInformacionGeneral("SELECT a.idProgramacionFinanciera AS decimoTercero, a.enero AS eneroTercero,a.febrero AS febreroTercero,a.marzo AS marzoTercero,a.abril AS abrilTercero,a.mayo AS mayoTercero,a.junio AS junioTercero,a.julio AS julioTercero,a.agosto AS agostoTercero,a.septiembre AS septiembreTercero,a.octubre AS octubreTercero,a.noviembre AS noviembreTercero,a.diciembre AS diciembreTercero,a.totalSumaItem AS totalSumaItemTercero,a.totalTotales AS totalTotalesTercero FROM poa_programacion_financiera AS a INNER JOIN poa_item AS b ON a.idItem=b.idItem  WHERE b.itemPreesupuestario='510203' AND a.idOrganismo='$idOrganismo' AND a.idActividad='$idActividad';");

			$decimoCuarta=$objeto->getObtenerInformacionGeneral("SELECT a.idProgramacionFinanciera AS decimoCuarta, a.enero AS eneroCuarta,a.febrero AS febreroCuarta,a.marzo AS marzoCuarta,a.abril AS abrilCuarta,a.mayo AS mayoCuarta,a.junio AS junioCuarta,a.julio AS julioCuarta,a.agosto AS agostoCuarta,a.septiembre AS septiembreCuarta,a.octubre AS octubreCuarta,a.noviembre AS noviembreCuarta,a.diciembre AS diciembreCuarta,a.totalSumaItem AS totalSumaItemCuarta,a.totalTotales AS totalTotalesCuarta FROM poa_programacion_financiera AS a INNER JOIN poa_item AS b ON a.idItem=b.idItem WHERE b.itemPreesupuestario='510204' AND a.idOrganismo='$idOrganismo' AND a.idActividad='$idActividad';");


			if (empty($salariosUnificados[0][salariosUnificados]) || empty($aportePatronal[0][aportPatronal]) || empty($fondoReserva[0][fondoReserva]) || empty($decimoTercera[0][decimoTercero]) || empty($decimoCuarta[0][decimoCuarta])) {
				
				$mensaje=25;

			}else{

				/*===========================================
				=       Sumadores Salarios Unificados   =
				===========================================*/
				
				$sumarUniEnero=$objeto->mesesSumarS($salariosUnificados[0][enero],$valoresArray[5]);
				$sumarUniFebrero=$objeto->mesesSumarS($salariosUnificados[0][febrero],$valoresArray[5]);
				$sumarUniMarzo=$objeto->mesesSumarS($salariosUnificados[0][marzo],$valoresArray[5]);
				$sumarUniAbril=$objeto->mesesSumarS($salariosUnificados[0][abril],$valoresArray[5]);
				$sumarUniMayo=$objeto->mesesSumarS($salariosUnificados[0][mayo],$valoresArray[5]);
				$sumarUniJunio=$objeto->mesesSumarS($salariosUnificados[0][junio],$valoresArray[5]);
				$sumarUniJulio=$objeto->mesesSumarS($salariosUnificados[0][julio],$valoresArray[5]);
				$sumarUniAgosto=$objeto->mesesSumarS($salariosUnificados[0][agosto],$valoresArray[5]);
				$sumarUniSeptiembre=$objeto->mesesSumarS($salariosUnificados[0][septiembre],$valoresArray[5]);
				$sumarUniOctubre=$objeto->mesesSumarS($salariosUnificados[0][octubre],$valoresArray[5]);
				$sumarUniNoviembre=$objeto->mesesSumarS($salariosUnificados[0][noviembre],$valoresArray[5]);
				$sumarUniDiciembre=$objeto->mesesSumarS($salariosUnificados[0][diciembre],$valoresArray[5]);
				$totalUnificado=floatval($valoresArray[5] *12) + floatval($salariosUnificados[0][totalSumaItem]);

				/*=====  End of Sumadores Salarios Unificados ======*/

				/*=======================================
				=            Aporte patronal            =
				=======================================*/
				
				$sumarPatronal=$objeto->mesesSumarS($aportePatronal[0][eneroPa],$valoresArray[6]);
				$totalPatronal=$sumarPatronal + $sumarPatronal + $sumarPatronal + $sumarPatronal + $sumarPatronal + $sumarPatronal + $sumarPatronal + $sumarPatronal + $sumarPatronal + $sumarPatronal + $sumarPatronal + $sumarPatronal +  $aportePatronal[0][totalSumaItemP];			
				
				/*=====  End of Aporte patronal  ======*/
				

				/*========================================
				=            Fondo de reserva            =
				========================================*/
				
				$sumarReserva=$objeto->mesesSumarS($fondoReserva[0][eneroFondo],$valoresArray[11]);
				$totalReserva=$sumarReserva + $sumarReserva + $sumarReserva + $sumarReserva + $sumarReserva + $sumarReserva + $sumarReserva + $sumarReserva + $sumarReserva + $sumarReserva + $sumarReserva + $sumarReserva + $fondoReserva[0][totalSumaItemFondo];		
				
				/*=====  End of Fondo de reserva  ======*/
				

				$inversionOrganismo=$objeto->getObtenerInformacionGeneral("SELECT b.nombreInversion FROM poa_inversion_usuario AS a INNER JOIN poa_inversion AS b ON a.idInversion=b.idInversion WHERE a.idOrganismo='".$idOrganismo."' ORDER BY b.idInversion DESC LIMIT 1;");

				$inversionOrganismoAsignada=$objeto->getObtenerInformacionGeneral("SELECT SUM(totalSumaItem) AS sumaItemTotal FROM poa_programacion_financiera WHERE idOrganismo='".$idOrganismo."' GROUP BY idOrganismo;");

				$sumar=round(floatval($inversionOrganismoAsignada[0][sumaItemTotal]) + floatval($mesesArray[12]),2);	


				if (floatval($sumar)>floatval($inversionOrganismo[0][nombreInversion])) {

					$mensaje=20;
					$jason['sumar']=$sumar;
					
				}else{

					$regimen=$objeto->getObtenerInformacionGeneral("SELECT regimen FROM poa_organismo WHERE idOrganismo='$idOrganismo';");


					$valoresUnificados=array("enero='$sumarUniEnero', febrero='$sumarUniFebrero', marzo='$sumarUniMarzo', abril='$sumarUniAbril', mayo='$sumarUniMayo', junio='$sumarUniJunio', julio='$sumarUniJulio',agosto='$sumarUniAgosto',septiembre='$sumarUniSeptiembre',octubre='$sumarUniOctubre',noviembre='$sumarUniNoviembre',diciembre='$sumarUniDiciembre', totalSumaItem='$totalUnificado', totalTotales='$totalUnificado'");


					$actualizaUnificados=$objeto->getActualiza("poa_programacion_financiera",$valoresUnificados,"idProgramacionFinanciera",$salariosUnificados[0][salariosUnificados]);

					$aportePatronalDef=0;

					$aportePatronalDef=floatval($sumarPatronal) * 12;

					$valoresPatronal=array("enero='$sumarPatronal', febrero='$sumarPatronal', marzo='$sumarPatronal', abril='$sumarPatronal', mayo='$sumarPatronal', junio='$sumarPatronal', julio='$sumarPatronal',agosto='$sumarPatronal',septiembre='$sumarPatronal',octubre='$sumarPatronal',noviembre='$sumarPatronal',diciembre='$sumarPatronal', totalSumaItem='$aportePatronalDef', totalTotales='$aportePatronalDef'");
					$actualizaPatronal=$objeto->getActualiza("poa_programacion_financiera",$valoresPatronal,"idProgramacionFinanciera",$aportePatronal[0][aportPatronal]);

					$sumaReservasF=0;
				
					$sumaReservasF=floatval($sumarReserva) * 12;

					$valoresFondoR=array("enero='$sumarReserva', febrero='$sumarReserva', marzo='$sumarReserva', abril='$sumarReserva', mayo='$sumarReserva', junio='$sumarReserva', julio='$sumarReserva',agosto='$sumarReserva',septiembre='$sumarReserva',octubre='$sumarReserva',noviembre='$sumarReserva',diciembre='$sumarReserva', totalSumaItem='$sumaReservasF', totalTotales='$sumaReservasF'");
					$actualizaFondoR=$objeto->getActualiza("poa_programacion_financiera",$valoresFondoR,"idProgramacionFinanciera",$fondoReserva[0][fondoReserva]);

					$regimenInstanciado=$regimen[0][regimen];

					if ($valoresArray[10]=="no") {


						if ($regimenInstanciado=="Costa") {

							$resultantesCuartos=floatval($decimoCuarta[0][marzoCuarta]) + floatval($valoresArray[9]);

							$totalDecimoCuarto= floatval($decimoCuarta[0][totalSumaItemCuarta]) + ($valoresArray[9]);

							$valoresCuarta=array("marzo='$resultantesCuartos', totalSumaItem='$totalDecimoCuarto', totalTotales='$totalDecimoCuarto'");
							$actualizaCuarta=$objeto->getActualiza("poa_programacion_financiera",$valoresCuarta,"idProgramacionFinanciera",$decimoCuarta[0][decimoCuarta]);



						}else{

							$resultantesCuartos=floatval($decimoCuarta[0][agostoCuarta]) + floatval($valoresArray[9]);

							$totalDecimoCuarto= floatval($decimoCuarta[0][totalSumaItemCuarta]) + ($valoresArray[9]);

							$valoresCuarta=array("agosto='$resultantesCuartos', totalSumaItem='$totalDecimoCuarto', totalTotales='$totalDecimoCuarto'");
							$actualizaCuarta=$objeto->getActualiza("poa_programacion_financiera",$valoresCuarta,"idProgramacionFinanciera",$decimoCuarta[0][decimoCuarta]);


						}


					}else{

						$obtenerDecimoCuarto=floatval(425.00) / 12;

						$sumarUniEneroCuarto=$objeto->mesesSumarS($decimoCuarta[0][eneroCuarta],$obtenerDecimoCuarto);
						$sumarUniFebreroCuarto=$objeto->mesesSumarS($decimoCuarta[0][febreroCuarta],$obtenerDecimoCuarto);
						$sumarUniMarzoCuarto=$objeto->mesesSumarS($decimoCuarta[0][marzoCuarta],$obtenerDecimoCuarto);
						$sumarUniAbrilCuarto=$objeto->mesesSumarS($decimoCuarta[0][abrilCuarta],$obtenerDecimoCuarto);
						$sumarUniMayoCuarto=$objeto->mesesSumarS($decimoCuarta[0][mayoCuarta],$obtenerDecimoCuarto);
						$sumarUniJunioCuarto=$objeto->mesesSumarS($decimoCuarta[0][junioCuarta],$obtenerDecimoCuarto);
						$sumarUniJulioCuarto=$objeto->mesesSumarS($decimoCuarta[0][julioCuarta],$obtenerDecimoCuarto);
						$sumarUniAgostoCuarto=$objeto->mesesSumarS($decimoCuarta[0][agostoCuarta],$obtenerDecimoCuarto);
						$sumarUniSeptiembreCuarto=$objeto->mesesSumarS($decimoCuarta[0][septiembreCuarta],$obtenerDecimoCuarto);
						$sumarUniOctubreCuarto=$objeto->mesesSumarS($decimoCuarta[0][octubreCuarta],$obtenerDecimoCuarto);
						$sumarUniNoviembreCuarto=$objeto->mesesSumarS($decimoCuarta[0][noviembreCuarta],$obtenerDecimoCuarto);
						$sumarUniDiciembreCuarto=$objeto->mesesSumarS($decimoCuarta[0][diciembreCuarta],$obtenerDecimoCuarto);

						$totalDecimoCuarto= floatval($decimoCuarta[0][totalSumaItemCuarta]) + ($valoresArray[9]);


						$valoresCuarta=array("enero='$sumarUniEneroCuarto', febrero='$sumarUniFebreroCuarto', marzo='$sumarUniMarzoCuarto', abril='$sumarUniAbrilCuarto', mayo='$sumarUniMayoCuarto', junio='$sumarUniJunioCuarto', julio='$sumarUniJulioCuarto',agosto='$sumarUniAgostoCuarto',septiembre='$sumarUniSeptiembreCuarto',octubre='$sumarUniOctubreCuarto',noviembre='$sumarUniNoviembreCuarto',diciembre='$sumarUniDiciembreCuarto', totalSumaItem='$totalDecimoCuarto', totalTotales='$totalDecimoCuarto'");
						$actualizaCuarta=$objeto->getActualiza("poa_programacion_financiera",$valoresCuarta,"idProgramacionFinanciera",$decimoCuarta[0][decimoCuarta]);


					}


					if ($valoresArray[8]=="no") {


						$totalDecimoTercero=$decimoTercera[0][totalSumaItemTercero] + $valoresArray[7];

						$resultantesTerceros=floatval($decimoTercera[0][diciembreTercero]) + floatval($valoresArray[7]);

						$valoresTercero=array("diciembre='$resultantesTerceros', totalSumaItem='$totalDecimoTercero', totalTotales='$totalDecimoTercero'");
						$actualizaTercero=$objeto->getActualiza("poa_programacion_financiera",$valoresTercero,"idProgramacionFinanciera",$decimoTercera[0][decimoTercero]);


					}else{

						$obtenerDecimoTercero=floatval($valoresArray[7]) / 12;


						$sumarUniEneroTercero=$objeto->mesesSumarS($decimoTercera[0][eneroTercero],$obtenerDecimoTercero);
						$sumarUniFebreroTercero=$objeto->mesesSumarS($decimoTercera[0][febreroTercero],$obtenerDecimoTercero);
						$sumarUniMarzoTercero=$objeto->mesesSumarS($decimoTercera[0][marzoTercero],$obtenerDecimoTercero);
						$sumarUniAbrilTercero=$objeto->mesesSumarS($decimoTercera[0][abrilTercero],$obtenerDecimoTercero);
						$sumarUniMayoTercero=$objeto->mesesSumarS($decimoTercera[0][mayoTercero],$obtenerDecimoTercero);
						$sumarUniJunioTercero=$objeto->mesesSumarS($decimoTercera[0][junioTercero],$obtenerDecimoTercero);
						$sumarUniJulioTercero=$objeto->mesesSumarS($decimoTercera[0][julioTercero],$obtenerDecimoTercero);
						$sumarUniAgostoTercero=$objeto->mesesSumarS($decimoTercera[0][agostoTercero],$obtenerDecimoTercero);
						$sumarUniSeptiembreTercero=$objeto->mesesSumarS($decimoTercera[0][septiembreTercero],$obtenerDecimoTercero);
						$sumarUniOctubreTercero=$objeto->mesesSumarS($decimoTercera[0][octubreTercero],$obtenerDecimoTercero);
						$sumarUniNoviembreTercero=$objeto->mesesSumarS($decimoTercera[0][noviembreTercero],$obtenerDecimoTercero);
						$sumarUniDiciembreTercero=$objeto->mesesSumarS($decimoTercera[0][diciembreTercero],$obtenerDecimoTercero);

						$totalDecimoTercero=$decimoTercera[0][totalSumaItemTercero] + $valoresArray[7];

						$valoresTercero=array("enero='$sumarUniEneroTercero', febrero='$sumarUniFebreroTercero', marzo='$sumarUniMarzoTercero', abril='$sumarUniAbrilTercero', mayo='$sumarUniMayoTercero', junio='$sumarUniJunioTercero', julio='$sumarUniJulioTercero',agosto='$sumarUniAgostoTercero',septiembre='$sumarUniSeptiembreTercero',octubre='$sumarUniOctubreTercero',noviembre='$sumarUniNoviembreTercero',diciembre='$sumarUniDiciembreTercero', totalSumaItem='$totalDecimoTercero', totalTotales='$totalDecimoTercero'");
						$actualizaTercero=$objeto->getActualiza("poa_programacion_financiera",$valoresTercero,"idProgramacionFinanciera",$decimoTercera[0][decimoTercero]);


					}
					


					$inserta=$objeto->getInsertaNormal('poa_sueldossalarios2022', array("`idSueldos`, ","`cedula`, ","`nombres`, ","`cargo`, ","`tipoCargo`, ","`tiempoTrabajo`, ","`sueldoSalario`, ","`aportePatronal`, ","`decimoTercera`, ","`mensualizaTercera`, ","`decimoCuarta`, ","`menusalizaCuarta`, ","`fondosReserva`, ","`enero`, ","`febrero`, ","`marzo`, ","`abril`, ","`mayo`, ","`junio`, ","`julio`, ","`agosto`, ","`septiembre`, ","`octubre`, ","`noviembre`, ","`diciembre`, ","`total`, ","`idOrganismo`, ","`fecha`, ","`idActividad`"),array("'$valoresArray[0]', ","'$valoresArray[1]', ","'$valoresArray[2]', ","'$valoresArray[3]', ", "'$valoresArray[4]', ", "'$valoresArray[5]', ", "'$valoresArray[6]', ", "'$valoresArray[7]', ", "'$valoresArray[8]', ", "'$valoresArray[9]', ", "'$valoresArray[10]', ", "'$valoresArray[11]', ", "'$mesesArray[0]', ", "'$mesesArray[1]', ", "'$mesesArray[2]', ", "'$mesesArray[3]', ", "'$mesesArray[4]', ", "'$mesesArray[5]', ", "'$mesesArray[6]', ", "'$mesesArray[7]', ", "'$mesesArray[8]', ", "'$mesesArray[9]', ", "'$mesesArray[10]', ", "'$mesesArray[11]', ", "'$mesesArray[12]', ", "'$idOrganismo', ", "'$fecha_actual', ", "'$idActividad'"));



					$mensaje=1;

					

					$jason['sumar']=$sumar;

				}


			}

			
			$jason['mensaje']=$mensaje;

		break;		


		case  "regimen":

			$valores=array("regimen='$idValor'");
			$actualiza=$objeto->getActualiza("poa_organismo",$valores,"idOrganismo",$idOrganismo);

			$mensaje=1;
			$jason['mensaje']=$mensaje;

		break;		

		case  "suministrosAE":

			$mesesArray = json_decode($mesesArray);
			$valoresArray = json_decode($valoresArray);
			$suministrosArray = json_decode($suministrosArray);
			$valoresSArray = json_decode($valoresSArray);

			$inserta=$objeto->getInsertaNormal('poa_suministrosn', array("`idSumi`, ","`tipo`, ","`nombreEscenario`, ","`idOrganismo`, ","`fecha`"),array("'$valoresArray[0]', ","'$valoresArray[1]', ","'$idOrganismo', ","'$fecha_actual'"));

			$maximo=$objeto->getMaximoFuncion('idSumi','poa_suministrosn');

				for ($i=0; $i < count($suministrosArray); $i++) { 

					if ($suministrosArray[$i]=="energia") {

						$inserta=$objeto->getInsertaNormal('poa_suministros', array("`idSuministros`, ","`luz`, ","`agua`, ","`idSumiN`"),array("'$valoresSArray[$i]', ","'N/A', ","'$maximo'"));

					}else{

						$inserta=$objeto->getInsertaNormal('poa_suministros', array("`idSuministros`, ","`luz`, ","`agua`, ","`idSumiN`"),array("'N/A', ","'$valoresSArray[$i]', ","'$maximo'"));

					}
					
				}

			$mensaje=1;
			$jason['mensaje']=$mensaje;

		break;


		case  "mantenimientoAc":

			$mesesArray = json_decode($mesesArray);
			$valoresArray = json_decode($valoresArray);

			$inversionOrganismo=$objeto->getObtenerInformacionGeneral("SELECT b.nombreInversion FROM poa_inversion_usuario AS a INNER JOIN poa_inversion AS b ON a.idInversion=b.idInversion WHERE a.idOrganismo='".$idOrganismo."' ORDER BY b.idInversion DESC LIMIT 1;");

			$inversionOrganismoAsignada=$objeto->getObtenerInformacionGeneral("SELECT SUM(totalSumaItem) AS sumaItemTotal FROM poa_programacion_financiera WHERE idOrganismo='".$idOrganismo."' GROUP BY idOrganismo;");


			$restarAntiguo=$objeto->getObtenerInformacionGeneral("SELECT totalSumaItem AS sumaAntiguo FROM poa_programacion_financiera WHERE idProgramacionFinanciera='$idProgramacionFinanciera';");

			$sumar=round(floatval($inversionOrganismoAsignada[0][sumaItemTotal]) + floatval($mesesArray[12]) - floatval($restarAntiguo[0][sumaAntiguo]),2);


			if (floatval($mesesArray[12])<=0) {

				$mensaje=21;

			}else if (floatval($sumar)>floatval($inversionOrganismo[0][nombreInversion])) {

				$mensaje=20;

			}else{

				$valores=array("enero='$mesesArray[0]',febrero='$mesesArray[1]',marzo='$mesesArray[2]',abril='$mesesArray[3]',mayo='$mesesArray[4]',junio='$mesesArray[5]',julio='$mesesArray[6]',agosto='$mesesArray[7]',septiembre='$mesesArray[8]',octubre='$mesesArray[9]',noviembre='$mesesArray[10]',diciembre='$mesesArray[11]',totalSumaItem='$mesesArray[12]',totalTotales='$mesesArray[12]'");

				$actualiza2=$objeto->getActualiza("poa_programacion_financiera",$valores,"idProgramacionFinanciera",$idProgramacionFinanciera);

				$inserta=$objeto->getInsertaNormal('poa_mantenimiento', array("`idMantenimiento`, ","`nombreInfras`, ","`provincia`, ","`direccionCompleta`, ","`estado`, ","`tipoRecursos`, ","`tipoIntervencion`, ","`detallarTipoIn`, ","`tipoMantenimiento`, ","`materialesServicios`, ","`fechaUltimo`, ","`idProgramacionFinanciera`, ","`fecha`"),array("'$valoresArray[0]', ","'$valoresArray[1]', ","'$valoresArray[2]', ","'$valoresArray[3]', ", "'$valoresArray[4]', ", "'$valoresArray[5]', ", "'$valoresArray[6]', ", "'$valoresArray[7]', ", "'$valoresArray[8]', ", "'$valoresArray[9]', ","'$idProgramacionFinanciera', ","'$fecha_actual'"));

				$mensaje=1;

			}			

			$jason['mensaje']=$mensaje;
			$jason['sumar']=$sumar;

		break;


		case  "actividadesDeportivades":

			$mesesArray = json_decode($mesesArray);
			$valoresArray = json_decode($valoresArray);


			$honorarios=$objeto->getObtenerInformacionGeneral("SELECT a.idProgramacionFinanciera AS honorarios, a.enero,a.febrero,a.marzo,a.abril,a.mayo,a.junio,a.julio,a.agosto,a.septiembre,a.octubre,a.noviembre,a.diciembre,a.totalSumaItem,a.totalTotales FROM poa_programacion_financiera AS a INNER JOIN poa_item AS b ON a.idItem=b.idItem WHERE a.idProgramacionFinanciera='$idProgramacionFinanciera' AND a.idOrganismo='$idOrganismo';");

			$sumarUniEnero=$objeto->mesesSumarS($honorarios[0][enero],$mesesArray[0]);
			$sumarUniFebrero=$objeto->mesesSumarS($honorarios[0][febrero],$mesesArray[1]);
			$sumarUniMarzo=$objeto->mesesSumarS($honorarios[0][marzo],$mesesArray[2]);
			$sumarUniAbril=$objeto->mesesSumarS($honorarios[0][abril],$mesesArray[3]);
			$sumarUniMayo=$objeto->mesesSumarS($honorarios[0][mayo],$mesesArray[4]);
			$sumarUniJunio=$objeto->mesesSumarS($honorarios[0][junio],$mesesArray[5]);
			$sumarUniJulio=$objeto->mesesSumarS($honorarios[0][julio],$mesesArray[6]);
			$sumarUniAgosto=$objeto->mesesSumarS($honorarios[0][agosto],$mesesArray[7]);
			$sumarUniSeptiembre=$objeto->mesesSumarS($honorarios[0][septiembre],$mesesArray[8]);
			$sumarUniOctubre=$objeto->mesesSumarS($honorarios[0][octubre],$mesesArray[9]);
			$sumarUniNoviembre=$objeto->mesesSumarS($honorarios[0][noviembre],$mesesArray[10]);
			$sumarUniDiciembre=$objeto->mesesSumarS($honorarios[0][diciembre],$mesesArray[11]);
			$sumar=floatval($mesesArray[12]) + $honorarios[0][totalTotales];





			$inversionOrganismo=$objeto->getObtenerInformacionGeneral("SELECT b.nombreInversion FROM poa_inversion_usuario AS a INNER JOIN poa_inversion AS b ON a.idInversion=b.idInversion WHERE a.idOrganismo='".$idOrganismo."' ORDER BY b.idInversion DESC LIMIT 1;");

			$inversionOrganismoAsignada=$objeto->getObtenerInformacionGeneral("SELECT SUM(totalSumaItem) AS sumaItemTotal FROM poa_programacion_financiera WHERE idOrganismo='".$idOrganismo."' GROUP BY idOrganismo;");

			// $sumar=round(floatval($inversionOrganismoAsignada[0][sumaItemTotal]) + floatval($mesesArray[12]),2);


			if (floatval($mesesArray[12])<=0) {

				$mensaje=21;

			}else if (floatval($sumar)>floatval($inversionOrganismo[0][nombreInversion]) && $valoresArray[1]=="autogestion") {

				$mensaje=20;

			}else{

				$inserta=$objeto->getInsertaNormal('poa_actdeportivas', array("`idPda`, ","`tipoFinanciamiento`, ","`nombreEvento`, ","`Deporte`, ","`provincia`, ","`ciudadPais`, ","`alcance`, ","`fechaInicio`, ","`fechaFin`, ","`genero`, ","`categoria`, ","`numeroEntreandores`, ","`numeroAtletas`, ","`total`, ","`mBenefici`, ","`hBenefici`, ","`detalleBien`, ","`justificacionAd`, ","`canitdarBie`, ","`idProgramacionFinanciera`, ","`fecha`, ","`enero`, ","`febrero`, ","`marzo`, ","`abril`, ","`mayo`, ","`junio`, ","`julio`, ","`agosto`, ","`septiembre`, ","`octubre`, ","`noviembre`, ","`diciembre`, ","`totalElem`"),array("'$valoresArray[0]', ","'$valoresArray[1]', ","'$valoresArray[2]', ","'$valoresArray[3]', ", "'$valoresArray[4]', ", "'$valoresArray[5]', ", "'$valoresArray[6]', ", "'$valoresArray[7]', ", "'$valoresArray[8]', ", "'$valoresArray[9]', ", "'$valoresArray[10]', ", "'$valoresArray[11]', ", "'$valoresArray[12]', ","'$valoresArray[13]', ","'$valoresArray[14]', ","'$valoresArray[15]', ","'$valoresArray[16]', ","'$valoresArray[17]', ","'$idProgramacionFinanciera', ","'$fecha_actual', ","'$mesesArray[0]', ","'$mesesArray[1]', ","'$mesesArray[2]', ","'$mesesArray[3]', ","'$mesesArray[4]', ","'$mesesArray[5]', ","'$mesesArray[6]', ","'$mesesArray[7]', ","'$mesesArray[8]', ","'$mesesArray[9]', ","'$mesesArray[10]', ","'$mesesArray[11]', ","'$mesesArray[12]'"));


				if ($valoresArray[1]!="autogestion") {

					$valores=array("enero='$sumarUniEnero',febrero='$sumarUniFebrero',marzo='$sumarUniMarzo',abril='$sumarUniAbril',mayo='$sumarUniMayo',junio='$sumarUniJunio',julio='$sumarUniJulio',agosto='$sumarUniAgosto',septiembre='$sumarUniSeptiembre',octubre='$sumarUniOctubre',noviembre='$sumarUniNoviembre',diciembre='$sumarUniDiciembre',totalSumaItem='$sumar',totalTotales='$sumar'");

					$actualiza2=$objeto->getActualiza("poa_programacion_financiera",$valores,"idProgramacionFinanciera",$idProgramacionFinanciera);

				}

				$mensaje=1;

			}			

			$jason['mensaje']=$mensaje;
			$jason['sumar']=$sumar;

		break;

		case  "actividadesAdministrativas":

			$mesesArray = json_decode($mesesArray);
			$valoresArray = json_decode($valoresArray);

			$inversionOrganismo=$objeto->getObtenerInformacionGeneral("SELECT b.nombreInversion FROM poa_inversion_usuario AS a INNER JOIN poa_inversion AS b ON a.idInversion=b.idInversion WHERE a.idOrganismo='".$idOrganismo."' ORDER BY b.idInversion DESC LIMIT 1;");

			$inversionOrganismoAsignada=$objeto->getObtenerInformacionGeneral("SELECT SUM(totalSumaItem) AS sumaItemTotal FROM poa_programacion_financiera WHERE idOrganismo='".$idOrganismo."' GROUP BY idOrganismo;");

			$restarAntiguo=$objeto->getObtenerInformacionGeneral("SELECT totalSumaItem AS sumaAntiguo FROM poa_programacion_financiera WHERE idProgramacionFinanciera='$idProgramacionFinanciera';");

			$sumar=round(floatval($inversionOrganismoAsignada[0][sumaItemTotal]) + floatval($mesesArray[12]) - floatval($restarAntiguo[0][sumaAntiguo]),2);


			if (floatval($mesesArray[12])<=0) {

				$mensaje=21;

			}else if (floatval($sumar)>floatval($inversionOrganismo[0][nombreInversion])) {

				$mensaje=20;

			}else{

				$valores=array("enero='$mesesArray[0]',febrero='$mesesArray[1]',marzo='$mesesArray[2]',abril='$mesesArray[3]',mayo='$mesesArray[4]',junio='$mesesArray[5]',julio='$mesesArray[6]',agosto='$mesesArray[7]',septiembre='$mesesArray[8]',octubre='$mesesArray[9]',noviembre='$mesesArray[10]',diciembre='$mesesArray[11]',totalSumaItem='$mesesArray[12]',totalTotales='$mesesArray[12]'");

				$actualiza2=$objeto->getActualiza("poa_programacion_financiera",$valores,"idProgramacionFinanciera",$idProgramacionFinanciera);

				$inserta=$objeto->getInsertaNormal('poa_actividadesadministrativas', array("`idActividadAd`, ","`justificacionActividad`, ","`cantidadBien`, ","`idProgramacionFinanciera`, ","`fecha`"),array("'$valoresArray[0]', ","'$valoresArray[1]', ","'$idProgramacionFinanciera', ","'$fecha_actual'"));

				$mensaje=1;

			}			

			$jason['mensaje']=$mensaje;
			$jason['sumar']=$sumar;

		break;

		case  "itemsCiudadanosPre":

			$sumar=0;

			$arrayInformacion = json_decode($arrayInformacion);

			$inserta=$objeto->getInsertaNormal('poa_programacion_financiera', array("`idProgramacionFinanciera`, ","`enero`, ","`febrero`, ","`marzo`, ","`abril`, ","`mayo`, ","`junio`, ","`julio`, ","`agosto`, ","`septiembre`, ","`octubre`, ","`noviembre`, ","`diciembre`, ","`totalSumaItem`, ","`totalTotales`, ","`idOrganismo`, ","`idItem`, ","`idActividad`, " ,"`fecha`"),array("'0.00', ","'0.00', ","'0.00', ","'0.00', ","'0.00', ","'0.00', ","'0.00', ","'0.00', ","'0.00', ","'0.00', ","'0.00', ","'0.00', ","'0.00', ","'0.00', ","'$idOrganismoPrincipal', ","'$arrayInformacion[0]', ","'$actividadEnvidada', ","'$fecha_actual'"));

			$mensaje=1;
			$jason['mensaje']=$mensaje;

		break;

		case  "poaOrganismo":

			$arrayInformacion = json_decode($arrayInformacion);

			$inserta=$objeto->getInserta('poa_poainicial', array("`idPoaEnviado`, ","`primertrimestre`, ","`segundotrimestre`, ","`tercertrimestre`, ","`idOrganismo`, ","`fecha`, ","`idActividad`, ","`cuartotrimestre`, ","`metaindicador`"),array(":idObjetivoEstrategico, ",":idObjetivo, ",":idPrograma, ",":idOrganismo, ",":fecha, ",":idActividad, ",":cuartotrimestre, ",":metaindicador"),array("$arrayInformacion[2]","$arrayInformacion[3]","$arrayInformacion[4]","$arrayInformacion[0]","$fecha_actual","$arrayInformacion[1]","$arrayInformacion[5]","$arrayInformacion[6]"),array(":idObjetivoEstrategico",":idObjetivo",":idPrograma",":idOrganismo",":fecha",":idActividad",":cuartotrimestre",":metaindicador"));

			$mensaje=1;
			$jason['mensaje']=$mensaje;

		break;

		case  "agregarItemsInserta":

			$arrayInformacion = json_decode($arrayInformacion);

			$inserta=$objeto->getInserta('poa_item', array("`idItem`, ","`nombreItem`, ","`fecha`, ","`hora`, ","`itemPreesupuestario`"),array(":nombreItem, ",":fecha, ",":hora, ",":itemPreesupuestario"),array("$arrayInformacion[0]","$fecha_actual","$hora_actual","$arrayInformacion[1]"),array(":nombreItem",":fecha",":hora",":itemPreesupuestario"));

			$mensaje=1;
			$jason['mensaje']=$mensaje;

		break;

		case  "editarCorreoOrga":

			$arrayInformacion = json_decode($arrayInformacion);

			$idUsuario=$objeto->getBuscadorInicial("idUsuario","poa_organismo",'idOrganismo',$arrayInformacion[0]);
			

			$valores2=array("correo='$arrayInformacion[1]',correoResponsablePoa='$arrayInformacion[1]'");
			$actualiza2=$objeto->getActualiza("poa_organismo",$valores2,"idOrganismo",$arrayInformacion[0]);

			$valores2=array("email='$arrayInformacion[1]'");
			$actualiza2=$objeto->getActualiza("poa_usuario",$valores2,"idUsuario",$idUsuario);

			$valores3=array("idTipoOrganismo='$arrayInformacion[2]'");
			$actualiza3=$objeto->getActualiza("poa_competencia_organismo_competencia",$valores3,"idOrganismo",$arrayInformacion[0]);

			$mensaje=1;
			$jason['mensaje']=$mensaje;

		break;	


		case  "itemsPrincipalActualiza":

			$arrayInformacion = json_decode($arrayInformacion);

			$valores2=array("nombreItem='$arrayInformacion[1]',itemPreesupuestario='$arrayInformacion[2]'");
			$actualiza2=$objeto->getActualiza("poa_item",$valores2,"idItem",$enviado);

			$mensaje=1;
			$jason['mensaje']=$mensaje;

		break;		

		case  "actividadesActualiza":

			$arrayInformacion = json_decode($arrayInformacion);

			$valores2=array("idActividades='$inputActividades',nombreActividades='$input__1',idClasificacionGastos='$select__grupoG',idLineaPolitica='$select__indiCadores'");
			$actualiza2=$objeto->getActualiza("poa_actividades",$valores2,"idActividades",$arrayInformacion[4]);

			$mensaje=1;
			$jason['mensaje']=$mensaje;

		break;		

		case  "grupoGastoActualiza":

			$valores2=array("nombreClasificacionGastos='$input__1'");
			$actualiza2=$objeto->getActualiza("poa_clasificaciongastos",$valores2,"idClasificacionGastos",$enviado);

			$mensaje=1;
			$jason['mensaje']=$mensaje;

		break;


		case  "lineaBaseActualiza":

			$valores2=array("nombreLinea='$input__1'");
			$actualiza2=$objeto->getActualiza("poa_linea_base",$valores2,"idLineas",$enviado);

			$mensaje=1;
			$jason['mensaje']=$mensaje;

		break;

		case  "programaActualiza":

			$valores2=array("nombrePrograma='$input__1'");
			$actualiza2=$objeto->getActualiza("poa_programa",$valores2,"idPrograma",$enviado);


			$mensaje=1;
			$jason['mensaje']=$mensaje;

		break;


		case  "indicadoresActualiza":

			$valores2=array("nombreIndicador='$input__1'");
			$actualiza2=$objeto->getActualiza("poa_indicadores",$valores2,"idIndicadores",$enviado);

			$mensaje=1;
			$jason['mensaje']=$mensaje;

		break;


		case  "deportesActualiza":

			$valores2=array("nombreDeporte='$input__1'");
			$actualiza2=$objeto->getActualiza("poa_deporte",$valores2,"idDeporte",$enviado);

			$mensaje=1;
			$jason['mensaje']=$mensaje;

		break;


		case  "alcanceActualiza":

			$valores2=array("nombreAlcanse='$input__1'");
			$actualiza2=$objeto->getActualiza("poa_alcanse",$valores2,"idAlcanse",$enviado);

			$mensaje=1;
			$jason['mensaje']=$mensaje;

		break;


		case  "tipoFinanActualiza":

			$valores2=array("nombreTipo='$input__1'");
			$actualiza2=$objeto->getActualiza("poa_tipo",$valores2,"idTipo",$enviado);

			$mensaje=1;
			$jason['mensaje']=$mensaje;

		break;

		case  "cargosActualiza":

			$valores2=array("nombreCargo='$input__1'");
			$actualiza2=$objeto->getActualiza("poa_cargo",$valores2,"idCargo",$enviado);

			$mensaje=1;
			$jason['mensaje']=$mensaje;

		break;


		case  "objetivosActualiza":

			$arrayInformacion = json_decode($arrayInformacion);

			$valores2=array("nombreObjetivo='$arrayInformacion[1]'");
			$actualiza2=$objeto->getActualiza("poa_objetivos",$valores2,"idObjetivos",$arrayInformacion[0]);

			$valores3=array("idPrograma='$arrayInformacion[2]'");
			$actualiza3=$objeto->getActualiza("poa_objetivos_usuario",$valores3,"idObjetivos",$arrayInformacion[0]);

			$mensaje=1;
			$jason['mensaje']=$mensaje;

		break;

		case  "tipoOrganismoActualiza":

			$valores2=array("nombreTipo='$input__1',idAreaAccion='$select__1',idObjetivos='$select__2',idAreaEncargada='$select__3'");
			$actualiza2=$objeto->getActualiza("poa_tipo_organismo",$valores2,"idTipoOrganismo",$enviado);

			$mensaje=1;
			$jason['mensaje']=$mensaje;

		break;

		case  "areaAccionActualiza":

			$valores2=array("accion='$input__1'");
			$actualiza2=$objeto->getActualiza("poa_area_accion",$valores2,"idAreaAccion",$enviado);

			$mensaje=1;
			$jason['mensaje']=$mensaje;

		break;

		case  "areaEncargadaActualiza":

			$valores2=array("nombreArea='$input__1'");
			$actualiza2=$objeto->getActualiza("poa_areaEncargada",$valores2,"idAreaEncargada",$enviado);

			$mensaje=1;
			$jason['mensaje']=$mensaje;

		break;


		case  "lineaPolitica":

			$inserta=$objeto->getInserta('poa_linea_base', array("`idLineas`, ","`nombreLinea`, ","`fecha`, ","`hora`, ","`estado`"),array(":nombreLinea, ",":fecha, ",":hora, ",":estado"),array("$agregado","$fecha_actual","$hora_actual","A"),array(":nombreLinea",":fecha",":hora",":estado"));

			$maximo=$objeto->getMaximoFuncion('idLineas','poa_linea_base');

			$inserta2=$objeto->getInserta('poa_linea_base_usuario',array("`idLineaBaseUsuario`, ","`idUsuario`, ","`idLineaBase`"),array(":idUsuario, ",":idLineaBase"),array("$idUsuarioPrincipal","$maximo"),array(":idUsuario",":idLineaBase"));


			$mensaje=1;
			$jason['mensaje']=$mensaje;

		break;


		case  "programaInserta":

			$inserta=$objeto->getInserta('poa_programa', array("`idPrograma`, ","`nombrePrograma`, ","`fecha`, ","`hora`, ","`estado`"),array(":nombreLinea, ",":fecha, ",":hora, ",":estado"),array("$agregado","$fecha_actual","$hora_actual","A"),array(":nombreLinea",":fecha",":hora",":estado"));

			$maximo=$objeto->getMaximoFuncion('idPrograma','poa_programa');

			$inserta2=$objeto->getInserta('poa_programa_usuario',array("`idProgramaUsuarion`, ","`idUsuario`, ","`idPrograma`"),array(":idUsuario, ",":idLineaBase"),array("$idUsuarioPrincipal","$maximo"),array(":idUsuario",":idLineaBase"));


			$mensaje=1;
			$jason['mensaje']=$mensaje;

		break;


		case  "indicadoresInserta":

			$inserta=$objeto->getInserta('poa_indicadores', array("`idIndicadores`, ","`nombreIndicador`, ","`fecha`, ","`hora`, ","`estado`"),array(":nombreLinea, ",":fecha, ",":hora, ",":estado"),array("$agregado","$fecha_actual","$hora_actual","A"),array(":nombreLinea",":fecha",":hora",":estado"));

			$maximo=$objeto->getMaximoFuncion('idIndicadores','poa_indicadores');

			$inserta2=$objeto->getInserta('poa_indicadores_usuario',array("`idIndicadorUsuario`, ","`idUsuario`, ","`idIndicador`"),array(":idUsuario, ",":idLineaBase"),array("$idUsuarioPrincipal","$maximo"),array(":idUsuario",":idLineaBase"));


			$mensaje=1;
			$jason['mensaje']=$mensaje;

		break;


		case  "deportesInserta":

			$inserta=$objeto->getInserta('poa_deporte', array("`idDeporte`, ","`nombreDeporte`, ","`fecha`, ","`hora`, ","`estado`"),array(":nombreLinea, ",":fecha, ",":hora, ",":estado"),array("$agregado","$fecha_actual","$hora_actual","A"),array(":nombreLinea",":fecha",":hora",":estado"));

			$maximo=$objeto->getMaximoFuncion('idDeporte','poa_deporte');

			$inserta2=$objeto->getInserta('poa_deporte_usuario',array("`idDeporteUsuario`, ","`idUsuario`, ","`idDeporte`"),array(":idUsuario, ",":idLineaBase"),array("$idUsuarioPrincipal","$maximo"),array(":idUsuario",":idLineaBase"));


			$mensaje=1;
			$jason['mensaje']=$mensaje;

		break;


		case  "alcanseInserta":

			$inserta=$objeto->getInserta('poa_alcanse', array("`idAlcanse`, ","`nombreAlcanse`, ","`fecha`, ","`hora`, ","`estado`"),array(":nombreLinea, ",":fecha, ",":hora, ",":estado"),array("$agregado","$fecha_actual","$hora_actual","A"),array(":nombreLinea",":fecha",":hora",":estado"));

			$maximo=$objeto->getMaximoFuncion('idAlcanse','poa_alcanse');

			$inserta2=$objeto->getInserta('poa_alcanse_usuario',array("`idAlcanseUsuario`, ","`idUsuario`, ","`idAlcanse`"),array(":idUsuario, ",":idLineaBase"),array("$idUsuarioPrincipal","$maximo"),array(":idUsuario",":idLineaBase"));


			$mensaje=1;
			$jason['mensaje']=$mensaje;

		break;


		case  "financiamientoInserta":

			$inserta=$objeto->getInserta('poa_tipo', array("`idTipo`, ","`nombreTipo`, ","`fecha`, ","`hora`, ","`estado`"),array(":nombreLinea, ",":fecha, ",":hora, ",":estado"),array("$agregado","$fecha_actual","$hora_actual","A"),array(":nombreLinea",":fecha",":hora",":estado"));

			$maximo=$objeto->getMaximoFuncion('idTipo','poa_tipo');

			$inserta2=$objeto->getInserta('poa_tipo_usuario',array("`idTipoUsuario`, ","`idUsuario`, ","`idTipo`"),array(":idUsuario, ",":idLineaBase"),array("$idUsuarioPrincipal","$maximo"),array(":idUsuario",":idLineaBase"));


			$mensaje=1;
			$jason['mensaje']=$mensaje;

		break;


		case  "cargoInserta":

			$inserta=$objeto->getInserta('poa_cargo', array("`idCargo`, ","`nombreCargo`, ","`fecha`, ","`hora`, ","`usado`"),array(":nombreLinea, ",":fecha, ",":hora, ",":estado"),array("$agregado","$fecha_actual","$hora_actual","A"),array(":nombreLinea",":fecha",":hora",":estado"));

			$maximo=$objeto->getMaximoFuncion('idCargo','poa_cargo');

			$inserta2=$objeto->getInserta('poa_cargo_usuario',array("`idCargoUsuario`, ","`idUsuario`, ","`idCargo`"),array(":idUsuario, ",":idLineaBase"),array("$idUsuarioPrincipal","$maximo"),array(":idUsuario",":idLineaBase"));


			$mensaje=1;
			$jason['mensaje']=$mensaje;

		break;


		case  "objetivoInserta":

			$arrayInformacion = json_decode($arrayInformacion);

			$inserta=$objeto->getInserta('poa_objetivos', array("`idObjetivos`, ","`nombreObjetivo`, ","`fecha`, ","`hora`, ","`estado`"),array(":nombreLinea, ",":fecha, ",":hora, ",":estado"),array("$arrayInformacion[0]","$fecha_actual","$hora_actual","A"),array(":nombreLinea",":fecha",":hora",":estado"));

			$maximo=$objeto->getMaximoFuncion('idObjetivos','poa_objetivos');

			$inserta2=$objeto->getInserta('poa_objetivos_usuario',array("`idObjetivosUsuario`, ","`idUsuario`, ","`idObjetivos`, ","`idPrograma`"),array(":idUsuario, ",":idLineaBase, ",":argumento"),array("$idUsuarioPrincipal","$maximo","$arrayInformacion[1]"),array(":idUsuario",":idLineaBase",":argumento"));


			$mensaje=1;
			$jason['mensaje']=$mensaje;

		break;

		

		case  "actividadInserta":

			$arrayCheckeds = json_decode($arrayCheckeds);

			$arrayInformacion = json_decode($arrayInformacion);

			$inserta=$objeto->getInserta('poa_actividades', array("`idActividades`, ","`nombreActividades`, ","`fecha`, ","`hora`, ","`idClasificacionGastos`, ","`idLineaPolitica`"),array(":nombreActividades, ",":fecha, ",":hora, ",":idClasificacionGastos, ",":idLineaPolitica"),array("$arrayInformacion[0]","$fecha_actual","$hora_actual","$arrayInformacion[1]","$arrayInformacion[2]"),array(":nombreActividades",":fecha",":hora",":idClasificacionGastos",":idLineaPolitica"));

			$maximo=$objeto->getMaximoFuncion('idActividades','poa_actividades');

			$inserta2=$objeto->getInserta('poa_actividades_usuario',array("`idActividadesUsuario`, ","`idUsuario`, ","`idActividades`"),array(":idUsuario, ",":idActividades"),array("$idUsuarioPrincipal","$maximo"),array(":idUsuario",":idActividades"));

			for ($i=0; $i < count($arrayCheckeds); $i++) { 

				$inserta3=$objeto->getInserta('poa_item_actividad',array("`idActividadItem`, ","`idActividad`, ","`idItem`, ","`fecha`, ","`hora`"),array(":idActividad, ",":idItem, ",":fecha, ",":hora"),array("$maximo","$arrayCheckeds[$i]","$fecha_actual","$hora_actual"),array(":idActividad",":idItem",":fecha",":hora"));

			}

			$mensaje=1;
			$jason['mensaje']=$mensaje;

		break;

		case  "tipoOrganismoInserta":

			$arrayInformacion = json_decode($arrayInformacion);

			$inserta=$objeto->getInserta('poa_tipo_organismo', array("`idTipoOrganismo`, ","`nombreTipo`, ","`estado`, ","`idAreaAccion`, ","`idObjetivos`, ","`idAreaEncargada`"),array(":nombreTipo, ",":estado, ",":idAreaAccion, ",":idObjetivos, ",":idAreaEncargada"),array("$arrayInformacion[0]","A","$arrayInformacion[1]","$arrayInformacion[2]","$arrayInformacion[3]"),array(":nombreTipo",":estado",":idAreaAccion",":idObjetivos",":idAreaEncargada"));

			$mensaje=1;
			$jason['mensaje']=$mensaje;

		break;


		case  "areaAccionInserta":

			$inserta=$objeto->getInserta('poa_area_accion', array("`idAreaAccion`, ","`accion`, ","`estado`"),array(":accion, ",":estado"),array("$agregado","A"),array(":accion",":estado"));


			$mensaje=1;
			$jason['mensaje']=$mensaje;

		break;


		case  "areaEncargadaInserta":

			$inserta=$objeto->getInserta('poa_areaEncargada', array("`idAreaEncargada`, ","`nombreArea`, ","`estado`"),array(":accion, ",":estado"),array("$agregado","A"),array(":accion",":estado"));


			$mensaje=1;
			$jason['mensaje']=$mensaje;

		break;

		case  "grupoGastoInserta":

			$inserta=$objeto->getInserta('poa_clasificaciongastos', array("`idClasificacionGastos`, ","`nombreClasificacionGastos`, ","`estado`, ","`fecha`, ","`hora`"),array(":nombreClasificacionGastos, ",":estado, ",":fecha, ",":hora"),array("$agregado","A","$fecha_actual","$hora_actual"),array(":nombreClasificacionGastos",":estado",":fecha",":hora"));


			$mensaje=1;
			$jason['mensaje']=$mensaje;

		break;

		case  "itemActividadInserta":

			$arrayInformacion=json_decode($arrayInformacion);

			$inserta=$objeto->getInserta('poa_item_actividad', array("`idActividadItem`, ","`idActividad`, ","`idItem`, ","`fecha`, ","`hora`"),array(":idActividad, ",":idItem, ",":fecha, ",":hora"),array("$elemento__escondidoI","$arrayInformacion[0]","$fecha_actual","$hora_actual"),array(":idActividad",":idItem",":fecha",":hora"));


			$mensaje=1;
			$jason['mensaje']=$mensaje;

		break;

		case  "enviarDesicion":

			$tabla=$tabla;
			$campos=json_decode($campos);
			$parametros=json_decode($parametros);
			$valores=json_decode($valores);
			$parametrosEnvio =json_decode($parametrosEnvio);
			$inserta=$objeto->getInserta($tabla,$campos,$parametros,$valores,$parametrosEnvio);

			$tablaBusqueda="poa_organismo";

			$campoBuscado="correo";

			$valorBuscado="$enviado";

			$buscador=$objeto->getBuscadorInicial($campoBuscado,$tablaBusqueda,'idOrganismo',$valorBuscado);


			/*=============================
			=            Email            =
			=============================*/
			
			$bodyMensaje='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><title>POA</title><style type="text/css">body {background:#EEE; padding:30px; font-size:16px;}'.'</style>'.'</head>'.'<span style="font-weight:bold;">COORDINACIÓN GENERAL DE PLANIFICACIÓN Y GESTIÓN ESTRATEGICA,</span><br><br>El Organismo Deportivo <span style="font-weight:bold;">'.$nombrePrincipalU.'</span>&nbsp; fue puesto en observación para la aprobación de usuario. Esperar respuesta del ministerio del deporte.</body></html>';

			$emailArray = array($emailPrincipal);
				
			$correosEnviados=$objeto->getEnviarCorreo($emailArray,$bodyMensaje);
			
			
			/*=====  End of Email  ======*/


			$mensaje=1;
			$jason['mensaje']=$mensaje;

		break;


		case  "aprobarSolicitudUsuario":

			$valores=array("activado='D'");
			$actualiza=$objeto->getActualiza("poa_organismo",$valores,"idOrganismo",$enviado);


			$valores2=array("estado='S'");
			$actualiza2=$objeto->getActualiza("poa_observaciones",$valores2,"idOrganismo",$enviado);


			$tablaBusqueda="poa_organismo";

			$campoBuscado="correo";

			$valorBuscado="$enviado";

			$buscador=$objeto->getBuscadorInicial($campoBuscado,$tablaBusqueda,'idOrganismo',$valorBuscado);

			/*=============================
			=            Email            =
			=============================*/
			
			$bodyMensaje='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><title>POA</title><style type="text/css">body {background:#EEE; padding:30px; font-size:16px;}'.'</style>'.'</head>'.'<span style="font-weight:bold;">COORDINACIÓN GENERAL DE PLANIFICACIÓN Y GESTIÓN ESTRATEGICA,</span><br><br>El Organismo Deportivo <span style="font-weight:bold;">'.$nombrePrincipalU.'</span>&nbsp; fue aprobado el usuario, debe esperar de asignación de presupuesto para poder continuar. Esperar respuesta del ministerio del deporte.</body></html>';

			$emailArray = array($emailPrincipal);
				
			$correosEnviados=$objeto->getEnviarCorreo($emailArray,$bodyMensaje);
			
			
			/*=====  End of Email  ======*/

			$mensaje=1;
			$jason['mensaje']=$mensaje;

		break;


		case  "aprobacionUsuarioR":


			$valores2=array("estado='C'");
			$actualiza2=$objeto->getActualiza("poa_observaciones",$valores2,"idOrganismo",$idOrganismoPrincipal);


			/*=============================
			=            Email            =
			=============================*/
			
			$bodyMensaje='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><title>POA</title><style type="text/css">body {background:#EEE; padding:30px; font-size:16px;}'.'</style>'.'</head>'.'<span style="font-weight:bold;">COORDINACIÓN GENERAL DE PLANIFICACIÓN Y GESTIÓN ESTRATEGICA,</span><br><br>El Organismo Deportivo <span style="font-weight:bold;">'.$nombrePrincipalU.'</span>&nbsp; envió las rectificaciones de aprobación de usuario. Esperar respuesta del ministerio del deporte.</body></html>';

			$emailArray = array($emailPrincipal);
				
			$correosEnviados=$objeto->getEnviarCorreo($emailArray,$bodyMensaje);
			
			
			/*=====  End of Email  ======*/
			

			$mensaje=1;
			$jason['mensaje']=$mensaje;

		break;


	}

	echo json_encode($jason);





