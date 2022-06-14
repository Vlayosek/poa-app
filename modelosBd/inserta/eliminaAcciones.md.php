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

		case  "eliminarHonorarios":

			$honorarios=$objeto->getObtenerInformacionGeneral("SELECT a.idProgramacionFinanciera AS honorarios, a.enero,a.febrero,a.marzo,a.abril,a.mayo,a.junio,a.julio,a.agosto,a.septiembre,a.octubre,a.noviembre,a.diciembre,a.totalSumaItem,a.totalTotales FROM poa_programacion_financiera AS a INNER JOIN poa_item AS b ON a.idItem=b.idItem WHERE b.itemPreesupuestario='530606' AND a.idOrganismo='$idOrganismo' AND a.idActividad='$idActividad';");

			$honarios2=$objeto->getObtenerInformacionGeneral("SELECT enero AS ene2,febrero AS feb2,marzo AS mar2,abril AS abril2,mayo AS may2,junio AS junio2,julio AS julio2,agosto AS agosto2,septiembre AS septiembre2,octubre AS octubre2,noviembre AS noviembre2,diciembre AS diciembre2,total AS totalHono FROM poa_honorarios2022 WHERE idHonorarios='$idEnviado';");

			$sumarUniEnero=$objeto->restarSumas($honorarios[0][enero],$honarios2[0][ene2]);
			$sumarUniFebrero=$objeto->restarSumas($honorarios[0][febrero],$honarios2[0][feb2]);
			$sumarUniMarzo=$objeto->restarSumas($honorarios[0][marzo],$honarios2[0][mar2]);
			$sumarUniAbril=$objeto->restarSumas($honorarios[0][abril],$honarios2[0][abril2]);
			$sumarUniMayo=$objeto->restarSumas($honorarios[0][mayo],$honarios2[0][may2]);
			$sumarUniJunio=$objeto->restarSumas($honorarios[0][junio],$honarios2[0][junio2]);
			$sumarUniJulio=$objeto->restarSumas($honorarios[0][julio],$honarios2[0][julio2]);
			$sumarUniAgosto=$objeto->restarSumas($honorarios[0][agosto],$honarios2[0][agosto2]);
			$sumarUniSeptiembre=$objeto->restarSumas($honorarios[0][septiembre],$honarios2[0][septiembre2]);
			$sumarUniOctubre=$objeto->restarSumas($honorarios[0][octubre],$honarios2[0][octubre2]);
			$sumarUniNoviembre=$objeto->restarSumas($honorarios[0][noviembre],$honarios2[0][noviembre2]);
			$sumarUniDiciembre=$objeto->restarSumas($honorarios[0][diciembre],$honarios2[0][diciembre2]);
			

			$totalRestas=floatval($honorarios[0][totalTotales]) - floatval($honarios2[0][totalHono]);


			if ($totalRestas<=0) {
				$totalRestas=0;
			}


			$valores=array("enero='$sumarUniEnero',febrero='$sumarUniFebrero',marzo='$sumarUniMarzo',abril='$sumarUniAbril',mayo='$sumarUniMayo',junio='$sumarUniJunio',julio='$sumarUniJulio',agosto='$sumarUniAgosto',septiembre='$sumarUniSeptiembre',octubre='$sumarUniOctubre',noviembre='$sumarUniNoviembre',diciembre='$sumarUniDiciembre',totalSumaItem='$totalRestas',totalTotales='$totalRestas'");
			$actualiza2=$objeto->getActualiza("poa_programacion_financiera",$valores,"idProgramacionFinanciera",$honorarios[0][honorarios]);

			$elimina=$objeto->getElimina('poa_honorarios2022','idHonorarios',$idEnviado);

			$mensaje=1;
			$jason['mensaje']=$mensaje;

		break;


		case  "eliminaPda":


			$mesesPda=$objeto->getObtenerInformacionGeneral("SELECT enero,febrero,marzo,abril,mayo,junio,julio,agosto,septiembre,octubre,noviembre,diciembre,totalElem FROM poa_actdeportivas WHERE idPda='$idEnviado';");

			$honorarios=$objeto->getObtenerInformacionGeneral("SELECT a.idProgramacionFinanciera AS honorarios, a.enero,a.febrero,a.marzo,a.abril,a.mayo,a.junio,a.julio,a.agosto,a.septiembre,a.octubre,a.noviembre,a.diciembre,a.totalSumaItem,a.totalTotales FROM poa_programacion_financiera AS a INNER JOIN poa_item AS b ON a.idItem=b.idItem WHERE a.idProgramacionFinanciera='$idProgramacionFinanciera' AND a.idOrganismo='$idOrganismo';");


			$sumarUniEnero=$objeto->restarSumas($honorarios[0][enero],$mesesPda[0][enero]);
			$sumarUniFebrero=$objeto->restarSumas($honorarios[0][febrero],$mesesPda[0][febrero]);
			$sumarUniMarzo=$objeto->restarSumas($honorarios[0][marzo],$mesesPda[0][marzo]);
			$sumarUniAbril=$objeto->restarSumas($honorarios[0][abril],$mesesPda[0][abril]);
			$sumarUniMayo=$objeto->restarSumas($honorarios[0][mayo],$mesesPda[0][mayo]);
			$sumarUniJunio=$objeto->restarSumas($honorarios[0][junio],$mesesPda[0][junio]);
			$sumarUniJulio=$objeto->restarSumas($honorarios[0][julio],$mesesPda[0][julio]);
			$sumarUniAgosto=$objeto->restarSumas($honorarios[0][agosto],$mesesPda[0][agosto]);
			$sumarUniSeptiembre=$objeto->restarSumas($honorarios[0][septiembre],$mesesPda[0][septiembre]);
			$sumarUniOctubre=$objeto->restarSumas($honorarios[0][octubre],$mesesPda[0][octubre]);
			$sumarUniNoviembre=$objeto->restarSumas($honorarios[0][noviembre],$mesesPda[0][noviembre]);
			$sumarUniDiciembre=$objeto->restarSumas($honorarios[0][diciembre],$mesesPda[0][diciembre]);

			$totalRestas= floatval($honorarios[0][totalSumaItem]) - floatval($mesesPda[0][totalElem]);

			if ($totalRestas<=0) {
				$totalRestas=0;
			}


			$valores=array("enero='$sumarUniEnero',febrero='$sumarUniFebrero',marzo='$sumarUniMarzo',abril='$sumarUniAbril',mayo='$sumarUniMayo',junio='$sumarUniJunio',julio='$sumarUniJulio',agosto='$sumarUniAgosto',septiembre='$sumarUniSeptiembre',octubre='$sumarUniOctubre',noviembre='$sumarUniNoviembre',diciembre='$sumarUniDiciembre',totalSumaItem='$totalRestas',totalTotales='$totalRestas'");
			$actualiza2=$objeto->getActualiza("poa_programacion_financiera",$valores,"idProgramacionFinanciera",$idProgramacionFinanciera);


			$elimina=$objeto->getElimina('poa_actdeportivas','idPda',$idEnviado);

			$mensaje=1;
			$jason['mensaje']=$mensaje;

		break;


		case  "eliminaSueldos":


			$salariosUnificados=$objeto->getObtenerInformacionGeneral("SELECT a.idProgramacionFinanciera AS salariosUnificados, a.enero,a.febrero,a.marzo,a.abril,a.mayo,a.junio,a.julio,a.agosto,a.septiembre,a.octubre,a.noviembre,a.diciembre,a.totalSumaItem,a.totalTotales FROM poa_programacion_financiera AS a INNER JOIN poa_item AS b ON a.idItem=b.idItem WHERE b.itemPreesupuestario='510106' AND a.idOrganismo='$idOrganismo' AND a.idActividad='$idActividad';");

			$aportePatronal=$objeto->getObtenerInformacionGeneral("SELECT a.idProgramacionFinanciera AS aportPatronal, a.enero AS eneroPa,a.febrero AS febreroP,a.marzo AS marzoP,a.abril AS abrilP,a.mayo AS mayoP,a.junio AS junioP,a.julio AS julioP,a.agosto AS agostoP,a.septiembre AS septiembreP,a.octubre AS octubreP,a.noviembre AS noviembreP,a.diciembre AS diciembreP,a.totalSumaItem AS totalSumaItemP,a.totalTotales AS totalTotalesP FROM poa_programacion_financiera AS a INNER JOIN poa_item AS b ON a.idItem=b.idItem  WHERE b.itemPreesupuestario='510601' AND a.idOrganismo='$idOrganismo' AND a.idActividad='$idActividad';");

			$fondoReserva=$objeto->getObtenerInformacionGeneral("SELECT a.idProgramacionFinanciera AS fondoReserva, a.enero AS eneroFondo,a.febrero AS febreroFondo,a.marzo AS marzoFondo,a.abril AS abrilFondo,a.mayo AS mayoFondo,a.junio AS junioFondo,a.julio AS julioFondo,a.agosto AS agostoFondo,a.septiembre AS septiembreFondo,a.octubre AS octubreFondo,a.noviembre AS noviembreFondo,a.diciembre AS diciembreFondo,a.totalSumaItem AS totalSumaItemFondo,a.totalTotales AS totalTotalesFondo FROM poa_programacion_financiera AS a INNER JOIN poa_item AS b ON a.idItem=b.idItem  WHERE b.itemPreesupuestario='510602' AND a.idOrganismo='$idOrganismo' AND a.idActividad='$idActividad';");


			$decimoTercera=$objeto->getObtenerInformacionGeneral("SELECT a.idProgramacionFinanciera AS decimoTercero, a.enero AS eneroTercero,a.febrero AS febreroTercero,a.marzo AS marzoTercero,a.abril AS abrilTercero,a.mayo AS mayoTercero,a.junio AS junioTercero,a.julio AS julioTercero,a.agosto AS agostoTercero,a.septiembre AS septiembreTercero,a.octubre AS octubreTercero,a.noviembre AS noviembreTercero,a.diciembre AS diciembreTercero,a.totalSumaItem AS totalSumaItemTercero,a.totalTotales AS totalTotalesTercero FROM poa_programacion_financiera AS a INNER JOIN poa_item AS b ON a.idItem=b.idItem  WHERE b.itemPreesupuestario='510203' AND a.idOrganismo='$idOrganismo' AND a.idActividad='$idActividad';");

			$decimoCuarta=$objeto->getObtenerInformacionGeneral("SELECT a.idProgramacionFinanciera AS decimoCuarta, a.enero AS eneroCuarta,a.febrero AS febreroCuarta,a.marzo AS marzoCuarta,a.abril AS abrilCuarta,a.mayo AS mayoCuarta,a.junio AS junioCuarta,a.julio AS julioCuarta,a.agosto AS agostoCuarta,a.septiembre AS septiembreCuarta,a.octubre AS octubreCuarta,a.noviembre AS noviembreCuarta,a.diciembre AS diciembreCuarta,a.totalSumaItem AS totalSumaItemCuarta,a.totalTotales AS totalTotalesCuarta FROM poa_programacion_financiera AS a INNER JOIN poa_item AS b ON a.idItem=b.idItem WHERE b.itemPreesupuestario='510204' AND a.idOrganismo='$idOrganismo' AND a.idActividad='$idActividad';");


			$solicitante=$objeto->getObtenerInformacionGeneral("SELECT sueldoSalario,aportePatronal,decimoTercera,decimoCuarta,fondosReserva,mensualizaTercera,menusalizaCuarta FROM poa_sueldossalarios2022 WHERE idOrganismo='$idOrganismo' AND idSueldos='$idSueldos';");

			$organismoRegimen=$objeto->getObtenerInformacionGeneral("SELECT regimen FROM poa_organismo WHERE idOrganismo='$idOrganismo';");

			/*==================================
			=            Unificados            =
			==================================*/
			

			$sumarUniEnero=$objeto->restarSumas($salariosUnificados[0][enero],$solicitante[0][sueldoSalario]);
			$sumarUniFebrero=$objeto->restarSumas($salariosUnificados[0][febrero],$solicitante[0][sueldoSalario]);
			$sumarUniMarzo=$objeto->restarSumas($salariosUnificados[0][marzo],$solicitante[0][sueldoSalario]);
			$sumarUniAbril=$objeto->restarSumas($salariosUnificados[0][abril],$solicitante[0][sueldoSalario]);
			$sumarUniMayo=$objeto->restarSumas($salariosUnificados[0][mayo],$solicitante[0][sueldoSalario]);
			$sumarUniJunio=$objeto->restarSumas($salariosUnificados[0][junio],$solicitante[0][sueldoSalario]);
			$sumarUniJulio=$objeto->restarSumas($salariosUnificados[0][julio],$solicitante[0][sueldoSalario]);
			$sumarUniAgosto=$objeto->restarSumas($salariosUnificados[0][agosto],$solicitante[0][sueldoSalario]);
			$sumarUniSeptiembre=$objeto->restarSumas($salariosUnificados[0][septiembre],$solicitante[0][sueldoSalario]);
			$sumarUniOctubre=$objeto->restarSumas($salariosUnificados[0][octubre],$solicitante[0][sueldoSalario]);
			$sumarUniNoviembre=$objeto->restarSumas($salariosUnificados[0][noviembre],$solicitante[0][sueldoSalario]);
			$sumarUniDiciembre=$objeto->restarSumas($salariosUnificados[0][diciembre],$solicitante[0][sueldoSalario]);	


			$totalRestas=$salariosUnificados[0][totalSumaItem] - ($solicitante[0][sueldoSalario] * 12);


			if ($totalRestas<0) {
				$totalRestas=0;
			}



			$valores=array("enero='$sumarUniEnero',febrero='$sumarUniFebrero',marzo='$sumarUniMarzo',abril='$sumarUniAbril',mayo='$sumarUniMayo',junio='$sumarUniJunio',julio='$sumarUniJulio',agosto='$sumarUniAgosto',septiembre='$sumarUniSeptiembre',octubre='$sumarUniOctubre',noviembre='$sumarUniNoviembre',diciembre='$sumarUniDiciembre',totalSumaItem='$totalRestas',totalTotales='$totalRestas'");
			$actualiza2=$objeto->getActualiza("poa_programacion_financiera",$valores,"idProgramacionFinanciera",$salariosUnificados[0][salariosUnificados]);

			
			/*=====  End of Unificados  ======*/
			

			/*=======================================
			=            Aporte patronal            =
			=======================================*/


			$sumarUniEneroApat=$objeto->restarSumas($aportePatronal[0][eneroPa],$solicitante[0][aportePatronal]);
			$sumarUniFebreroApat=$objeto->restarSumas($aportePatronal[0][febreroP],$solicitante[0][aportePatronal]);
			$sumarUniMarzoApat=$objeto->restarSumas($aportePatronal[0][marzoP],$solicitante[0][aportePatronal]);
			$sumarUniAbrilApat=$objeto->restarSumas($aportePatronal[0][abrilP],$solicitante[0][aportePatronal]);
			$sumarUniMayoApat=$objeto->restarSumas($aportePatronal[0][mayoP],$solicitante[0][aportePatronal]);
			$sumarUniJunioApat=$objeto->restarSumas($aportePatronal[0][junioP],$solicitante[0][aportePatronal]);
			$sumarUniJulioApat=$objeto->restarSumas($aportePatronal[0][julioP],$solicitante[0][aportePatronal]);
			$sumarUniAgostoApat=$objeto->restarSumas($aportePatronal[0][agostoP],$solicitante[0][aportePatronal]);
			$sumarUniSeptiembreApat=$objeto->restarSumas($aportePatronal[0][septiembreP],$solicitante[0][aportePatronal]);
			$sumarUniOctubreApat=$objeto->restarSumas($aportePatronal[0][octubreP],$solicitante[0][aportePatronal]);
			$sumarUniNoviembreApat=$objeto->restarSumas($aportePatronal[0][noviembreP],$solicitante[0][aportePatronal]);
			$sumarUniDiciembreApat=$objeto->restarSumas($aportePatronal[0][diciembreP],$solicitante[0][aportePatronal]);	


			$totalRestasApat=floatval($aportePatronal[0][totalSumaItemP]) - (floatval($aportePatronal[0][eneroPa]) * 12);

			if ($totalRestasApat<0) {
				$totalRestasApat=0;
			}


			$valores3=array("enero='$sumarUniEneroApat',febrero='$sumarUniFebreroApat',marzo='$sumarUniMarzoApat',abril='$sumarUniAbrilApat',mayo='$sumarUniMayoApat',junio='$sumarUniJunioApat',julio='$sumarUniJulioApat',agosto='$sumarUniAgostoApat',septiembre='$sumarUniSeptiembreApat',octubre='$sumarUniOctubreApat',noviembre='$sumarUniNoviembreApat',diciembre='$sumarUniDiciembreApat',totalSumaItem='$totalRestasApat',totalTotales='$totalRestasApat'");
			$actualiza3=$objeto->getActualiza("poa_programacion_financiera",$valores3,"idProgramacionFinanciera",$aportePatronal[0][aportPatronal]);	



			/*=====  End of Aporte patronal  ======*/
			

			/*=========================================
			=            Fondos de reserva            =
			=========================================*/


			$sumarUniEneroFondo=$objeto->restarSumas($fondoReserva[0][eneroFondo],$solicitante[0][fondosReserva]);
			$sumarUniFebreroFondo=$objeto->restarSumas($fondoReserva[0][febreroFondo],$solicitante[0][fondosReserva]);
			$sumarUniMarzoFondo=$objeto->restarSumas($fondoReserva[0][marzoFondo],$solicitante[0][fondosReserva]);
			$sumarUniAbrilFondo=$objeto->restarSumas($fondoReserva[0][abrilFondo],$solicitante[0][fondosReserva]);
			$sumarUniMayoFondo=$objeto->restarSumas($fondoReserva[0][mayoFondo],$solicitante[0][fondosReserva]);
			$sumarUniJunioFondo=$objeto->restarSumas($fondoReserva[0][junioFondo],$solicitante[0][fondosReserva]);
			$sumarUniJulioFondo=$objeto->restarSumas($fondoReserva[0][julioFondo],$solicitante[0][fondosReserva]);
			$sumarUniAgostoFondo=$objeto->restarSumas($fondoReserva[0][agostoFondo],$solicitante[0][fondosReserva]);
			$sumarUniSeptiembreFondo=$objeto->restarSumas($fondoReserva[0][septiembreFondo],$solicitante[0][fondosReserva]);
			$sumarUniOctubreFondo=$objeto->restarSumas($fondoReserva[0][octubreFondo],$solicitante[0][fondosReserva]);
			$sumarUniNoviembreFondo=$objeto->restarSumas($fondoReserva[0][noviembreFondo],$solicitante[0][fondosReserva]);
			$sumarUniDiciembreFondo=$objeto->restarSumas($fondoReserva[0][diciembreFondo],$solicitante[0][fondosReserva]);	


			$totalRestasFondos=floatval($fondoReserva[0][totalSumaItemFondo]) - (floatval($fondoReserva[0][eneroFondo]) * 12);

			if ($totalRestasFondos<0) {
				$totalRestasFondos=0;
			}

			$valores4=array("enero='$sumarUniEneroFondo',febrero='$sumarUniFebreroFondo',marzo='$sumarUniMarzoFondo',abril='$sumarUniAbrilFondo',mayo='$sumarUniMayoFondo',junio='$sumarUniJunioFondo',julio='$sumarUniJulioFondo',agosto='$sumarUniAgostoFondo',septiembre='$sumarUniSeptiembreFondo',octubre='$sumarUniOctubreFondo',noviembre='$sumarUniNoviembreFondo',diciembre='$sumarUniDiciembreFondo',totalSumaItem='$totalRestasFondos',totalTotales='$totalRestasFondos'");
			$actualiza4=$objeto->getActualiza("poa_programacion_financiera",$valores4,"idProgramacionFinanciera",$fondoReserva[0][fondoReserva]);

			


			/*=====  End of Fondos de reserva  ======*/

			/*======================================
			=            Decimo tercero            =
			======================================*/

			$obtenerDecimoTercero=floatval($solicitante[0][sueldoSalario]) / 12;
			
			if (floatval($decimoTercera[0][eneroTercero])>0 && $solicitante[0][mensualizaTercera]=="si") {

				$sumarUniEnerTercero=$objeto->restarSumas($decimoTercera[0][eneroTercero],$obtenerDecimoTercero);

			}

			if (floatval($decimoTercera[0][febreroTercero])>0 && $solicitante[0][mensualizaTercera]=="si") {

				$sumarUniFebrerTercero=$objeto->restarSumas($decimoTercera[0][febreroTercero],$obtenerDecimoTercero);

			}

			if (floatval($decimoTercera[0][marzoTercero])>0 && $solicitante[0][mensualizaTercera]=="si") {

				$sumarUniMarzTercero=$objeto->restarSumas($decimoTercera[0][marzoTercero],$obtenerDecimoTercero);

			}
		
				
			if (floatval($decimoTercera[0][abrilTercero])>0 && $solicitante[0][mensualizaTercera]=="si") {

				$sumarUniAbriTercero=$objeto->restarSumas($decimoTercera[0][abrilTercero],$obtenerDecimoTercero);

			}

		
			if (floatval($decimoTercera[0][mayoTercero])>0 && $solicitante[0][mensualizaTercera]=="si") {

				$sumarUniMayTercero=$objeto->restarSumas($decimoTercera[0][mayoTercero],$obtenerDecimoTercero);

			}
		
			if (floatval($decimoTercera[0][junioTercero])>0 && $solicitante[0][mensualizaTercera]=="si") {

				$sumarUniJuniTercero=$objeto->restarSumas($decimoTercera[0][junioTercero],$obtenerDecimoTercero);

			}

		
			if (floatval($decimoTercera[0][julioTercero])>0 && $solicitante[0][mensualizaTercera]=="si") {

				$sumarUniJuliTercero=$objeto->restarSumas($decimoTercera[0][julioTercero],$obtenerDecimoTercero);

			}

		
			if (floatval($decimoTercera[0][agostoTercero])>0 && $solicitante[0][mensualizaTercera]=="si") {

				$sumarUniAgostTercero=$objeto->restarSumas($decimoTercera[0][agostoTercero],$obtenerDecimoTercero);

			}

			if (floatval($decimoTercera[0][septiembreTercero])>0 && $solicitante[0][mensualizaTercera]=="si") {

				$sumarUniSeptiembrTercero=$objeto->restarSumas($decimoTercera[0][septiembreTercero],$obtenerDecimoTercero);

			}
			

			if (floatval($decimoTercera[0][octubreTercero])>0 && $solicitante[0][mensualizaTercera]=="si") {

				$sumarUniOctubrTercero=$objeto->restarSumas($decimoTercera[0][octubreTercero],$obtenerDecimoTercero);

			}

			
			if (floatval($decimoTercera[0][noviembreTercero])>0 && $solicitante[0][mensualizaTercera]=="si") {

				$sumarUniNoviembrTercero=$objeto->restarSumas($decimoTercera[0][noviembreTercero],$obtenerDecimoTercero);

			}		
						
			
			if (floatval($decimoTercera[0][diciembreTercero])>0 && $solicitante[0][mensualizaTercera]=="si") {

				$sumarUniDiciembrTercero=$objeto->restarSumas($decimoTercera[0][diciembreTercero],$obtenerDecimoTercero);	


			}else if(floatval($decimoTercera[0][diciembreTercero])>0 && $solicitante[0][mensualizaTercera]=="no"){

				$sumarUniDiciembrTercero=$objeto->restarSumas($decimoTercera[0][diciembreTercero],$solicitante[0][sueldoSalario]);	

			}					
			
		

			$totalRestasTercero=floatval($decimoTercera[0][totalSumaItemTercero]) - floatval($solicitante[0][decimoTercera]);

			if ($totalRestasTercero<0) {
				$totalRestasTercero=0;
			}

			if ($solicitante[0][mensualizaTercera]=="si") {

				$valores5=array("enero='$sumarUniEnerTercero',febrero='$sumarUniFebrerTercero',marzo='$sumarUniMarzTercero',abril='$sumarUniAbriTercero',mayo='$sumarUniMayTercero',junio='$sumarUniJuniTercero',julio='$sumarUniJuliTercero',agosto='$sumarUniAgostTercero',septiembre='$sumarUniSeptiembrTercero',octubre='$sumarUniOctubrTercero',noviembre='$sumarUniNoviembrTercero',diciembre='$sumarUniDiciembrTercero',totalSumaItem='$totalRestasTercero',totalTotales='$totalRestasTercero'");
				
			}else{

				$valores5=array("diciembre='$sumarUniDiciembrTercero',totalSumaItem='$totalRestasTercero',totalTotales='$totalRestasTercero'");

			}

			
			$actualiza5=$objeto->getActualiza("poa_programacion_financiera",$valores5,"idProgramacionFinanciera",$decimoTercera[0][decimoTercero]);	

			
			/*=====  End of Decimo tercero  ======*/
			
			/*=====================================
			=            Decimo cuarto            =
			=====================================*/

			$obtenerDecimoCuarto=floatval(425.00) / 12;
			
			if (floatval($decimoCuarta[0][eneroCuarta])>0 && $solicitante[0][menusalizaCuarta]=="si") {

				$sumarUniEnerCuarto=$objeto->restarSumas($decimoCuarta[0][eneroCuarta],$obtenerDecimoCuarto);
			
			}else{

				$sumarUniEnerCuarto=$decimoCuarta[0][eneroCuarta];

			}


			if (floatval($decimoCuarta[0][febreroCuarta])>0 && $solicitante[0][menusalizaCuarta]=="si") {

				$sumarUniFebrerCuarto=$objeto->restarSumas($decimoCuarta[0][febreroCuarta],$obtenerDecimoCuarto);

			}else{

				$sumarUniFebrerCuarto=$decimoCuarta[0][febreroCuarta];

			}


			if (floatval($decimoCuarta[0][marzoCuarta])>0 && $solicitante[0][menusalizaCuarta]=="si") {

				$sumarUniMarzCuarto=$objeto->restarSumas($decimoCuarta[0][marzoCuarta],$obtenerDecimoCuarto);
				
			}else if(floatval($decimoCuarta[0][marzoCuarta])>0 && $solicitante[0][menusalizaCuarta]=="no" && $organismoRegimen[0]["regimen"]=="Costa"){

				$sumarUniMarzCuarto=$objeto->restarSumas($decimoCuarta[0][marzoCuarta],$solicitante[0][decimoCuarta]);

			}else{

				$sumarUniMarzCuarto=$decimoCuarta[0][marzoCuarta];

			}



			if (floatval($decimoCuarta[0][abrilCuarta])>0 && $solicitante[0][menusalizaCuarta]=="si") {

				$sumarUniAbriCuarto=$objeto->restarSumas($decimoCuarta[0][abrilCuarta],$obtenerDecimoCuarto);
				
			}else{

				$sumarUniAbriCuarto=$decimoCuarta[0][abrilCuarta];

			}
			

			if (floatval($decimoCuarta[0][mayoCuarta])>0  && $solicitante[0][menusalizaCuarta]=="si") {

				$sumarUniMayCuarto=$objeto->restarSumas($decimoCuarta[0][mayoCuarta],$obtenerDecimoCuarto);
				
			}else{

				$sumarUniMayCuarto=$decimoCuarta[0][mayoCuarta];

			}


			if (floatval($decimoCuarta[0][junioCuarta])>0 && $solicitante[0][menusalizaCuarta]=="si") {

				$sumarUniJuniCuarto=$objeto->restarSumas($decimoCuarta[0][junioCuarta],$obtenerDecimoCuarto);
				
			}else{

				$sumarUniJuniCuarto=$decimoCuarta[0][junioCuarta];

			}
									
			
			if (floatval($decimoCuarta[0][julioCuarta])>0 && $solicitante[0][menusalizaCuarta]=="si") {

				$sumarUniJuliCuarto=$objeto->restarSumas($decimoCuarta[0][julioCuarta],$obtenerDecimoCuarto);
				
			}else{

				$sumarUniJuliCuarto=$decimoCuarta[0][julioCuarta];

			}



			
			if (floatval($decimoCuarta[0][agostoCuarta])>0 && $solicitante[0][menusalizaCuarta]=="si") {

				$sumarUniAgostCuarto=$objeto->restarSumas($decimoCuarta[0][agostoCuarta],$obtenerDecimoCuarto);
				
			}else if(floatval($decimoCuarta[0][agostoCuarta])>0 && $solicitante[0][menusalizaCuarta]=="no" && ($organismoRegimen[0]["regimen"]=="Sierra" || $organismoRegimen[0]["regimen"]=="Amazonia")){

				$sumarUniAgostCuarto=$objeto->restarSumas($decimoCuarta[0][agostoCuarta],$solicitante[0][decimoCuarta]);

			}else{

				$sumarUniAgostCuarto=$decimoCuarta[0][agostoCuarta];

			}
			
			
			if (floatval($decimoCuarta[0][septiembreCuarta])>0 && $solicitante[0][menusalizaCuarta]=="si") {

				$sumarUniSeptiembrCuarto=$objeto->restarSumas($decimoCuarta[0][septiembreCuarta],$obtenerDecimoCuarto);
				
			}else{

				$sumarUniSeptiembrCuarto=$decimoCuarta[0][septiembreCuarta];

			}




			if (floatval($decimoCuarta[0][octubreCuarta])>0 && $solicitante[0][menusalizaCuarta]=="si") {

				$sumarUniOctubrCuarto=$objeto->restarSumas($decimoCuarta[0][octubreCuarta],$obtenerDecimoCuarto);
				
			}else{

				$sumarUniOctubrCuarto=$decimoCuarta[0][octubreCuarta];

			}
					

			if (floatval($decimoCuarta[0][noviembreCuarta])>0 && $solicitante[0][menusalizaCuarta]=="si") {

				$sumarUniNoviembrCuarto=$objeto->restarSumas($decimoCuarta[0][noviembreCuarta],$obtenerDecimoCuarto);
				
			}else{

				$sumarUniNoviembrCuarto=$decimoCuarta[0][noviembreCuarta];

			}
								
			
			
			if (floatval($decimoCuarta[0][diciembreCuarta])>0 && $solicitante[0][menusalizaCuarta]=="si") {

				$sumarUniDiciembrCuarto=$objeto->restarSumas($decimoCuarta[0][diciembreCuarta],$obtenerDecimoCuarto);	
				
			}else{

				$sumarUniDiciembrCuarto=$decimoCuarta[0][diciembreCuarta];

			}
								

			$totalRestasCuarta=$decimoCuarta[0][totalSumaItemCuarta] - $solicitante[0][decimoCuarta];

			if ($totalRestasCuarta<0) {
				$totalRestasCuarta=0;
			}



			$valores6=array("enero='$sumarUniEnerCuarto',febrero='$sumarUniFebrerCuarto',marzo='$sumarUniMarzCuarto',abril='$sumarUniAbriCuarto',mayo='$sumarUniMayCuarto',junio='$sumarUniJuniCuarto',julio='$sumarUniJuliCuarto',agosto='$sumarUniAgostCuarto',septiembre='$sumarUniSeptiembrCuarto',octubre='$sumarUniOctubrCuarto',noviembre='$sumarUniNoviembrCuarto',diciembre='$sumarUniDiciembrCuarto',totalSumaItem='$totalRestasCuarta',totalTotales='$totalRestasCuarta'");
			$actualiza6=$objeto->getActualiza("poa_programacion_financiera",$valores6,"idProgramacionFinanciera",$decimoCuarta[0][decimoCuarta]);		
		
			
			/*=====  End of Decimo cuarto  ======*/
			

			$elimina=$objeto->getElimina('poa_sueldossalarios2022','idSueldos',$idEnviado);

			$mensaje=1;
			$jason['mensaje']=$mensaje;

		break;

		case  "eliminasItemsFin":


			$elimina=$objeto->getElimina('poa_programacion_financiera','idProgramacionFinanciera',$idEnviado2);

			$mensaje=1;
			$jason['mensaje']=$mensaje;

		break;

		case  "eliminaSuministros":


			$elimina=$objeto->getElimina('poa_suministrosn','idSumi',$idEnviado);

			$mensaje=1;
			$jason['mensaje']=$mensaje;

		break;

		case  "itemsElimina":


			$elimina=$objeto->getElimina('poa_item','idItem',$idEnviado);

			$mensaje=1;
			$jason['mensaje']=$mensaje;

		break;


		case  "actividadesElimina":


			$elimina=$objeto->getElimina('poa_actividades','idActividades',$idEnviado2);

			$mensaje=1;
			$jason['mensaje']=$mensaje;

		break;


		case  "itemAcElimina":


			$elimina=$objeto->getElimina('poa_item_actividad','idActividadItem',$idEnviado);

			$mensaje=1;
			$jason['mensaje']=$mensaje;

		break;

		case  "gastosElimina":


			$elimina=$objeto->getElimina('poa_clasificaciongastos','idClasificacionGastos',$idEnviado);


			$mensaje=1;
			$jason['mensaje']=$mensaje;

		break;


		case  "lineaElimina":


			$elimina=$objeto->getElimina('poa_linea_base','idLineas',$idEnviado);


			$mensaje=1;
			$jason['mensaje']=$mensaje;

		break;

		case  "programaElimina":


			$elimina=$objeto->getElimina('poa_programa','idPrograma',$idEnviado);


			$mensaje=1;
			$jason['mensaje']=$mensaje;

		break;


		case  "indicadoresElimina":


			$elimina=$objeto->getElimina('poa_indicadores','idIndicadores',$idEnviado);


			$mensaje=1;
			$jason['mensaje']=$mensaje;

		break;


		case  "deportesElimina":


			$elimina=$objeto->getElimina('poa_deporte','idDeporte',$idEnviado);


			$mensaje=1;
			$jason['mensaje']=$mensaje;

		break;


		case  "alcanceElimina":


			$elimina=$objeto->getElimina('poa_alcanse','idAlcanse',$idEnviado);


			$mensaje=1;
			$jason['mensaje']=$mensaje;

		break;

		case  "tipoFiElimina":


			$elimina=$objeto->getElimina('poa_tipo','idTipo',$idEnviado);


			$mensaje=1;
			$jason['mensaje']=$mensaje;

		break;

		case  "cargoElimina":


			$elimina=$objeto->getElimina('poa_cargo','idCargo',$idEnviado);


			$mensaje=1;
			$jason['mensaje']=$mensaje;

		break;


		case  "objetivosElimina":


			$elimina=$objeto->getElimina('poa_objetivos','idObjetivos',$idEnviado);


			$mensaje=1;
			$jason['mensaje']=$mensaje;

		break;

		case  "tipoOrganismoElimina":


			$elimina=$objeto->getElimina('poa_tipo_organismo','idTipoOrganismo',$idEnviado);


			$mensaje=1;
			$jason['mensaje']=$mensaje;

		break;

		case  "accionElimina":


			$elimina=$objeto->getElimina('poa_area_accion','idAreaAccion',$idEnviado);


			$mensaje=1;
			$jason['mensaje']=$mensaje;

		break;

		case  "areaEnElimina":


			$elimina=$objeto->getElimina('poa_areaEncargada','idAreaEncargada',$idEnviado);


			$mensaje=1;
			$jason['mensaje']=$mensaje;

		break;

	}

	echo json_encode($jason);





