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


		case  "itemsSelect":

			$obtenerInformacion=$objeto->getObtenerInformacionGeneral("SELECT idItem,nombreItem FROM poa_item WHERE estado='A';");

			$jason['obtenerInformacion']=$obtenerInformacion;

		break;

	}

	echo json_encode($jason);



