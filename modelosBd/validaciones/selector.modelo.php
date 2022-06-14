<?php

	define('CONTROLADOR7', '../../conexion/');

	require_once CONTROLADOR7.'conexion.php';

	extract($_POST);

	class lugar{

		public static function lugarFuncion($indicador){
			
		  	$conexionRecuperada= new conexion();
 			$conexionEstablecida=$conexionRecuperada->cConexion();	

 			// $conexionEstablecida->exec("set names utf8");

 			extract($_POST);

 			if ($indicador==1) {

	 			$query="SELECT DISTINCT idProvincia,nombreProvincia FROM in_md_provincias ORDER BY nombreProvincia;";
			 	$resultado = $conexionEstablecida->query($query);

			 	$listas="<option value=''>--Elige una provincia--</option>";

			 	while($registro = $resultado->fetch()) {
			 	
			 		$listas.="<option value='".$registro["idProvincia"]."'>".utf8_decode(utf8_encode($registro["nombreProvincia"]))."</option>";

			 	}

			 	return $listas;

 			}else if($indicador==2){


 				$query="SELECT DISTINCT idCanton,nombreCanton FROM in_md_canton WHERE idProvincia='$provincia' ORDER BY nombreCanton;";
			 	$resultado = $conexionEstablecida->query($query);

			 	$listas="<option value=''>--Elige un cantón-</option>";

			 	while($registro = $resultado->fetch()) {
			 	
			 		$listas.="<option value='".$registro["idCanton"]."'>".utf8_decode(utf8_encode($registro["nombreCanton"]))."</option>";

			 	}

			 	return $listas;

 			}else if($indicador==3){

 				$query="SELECT DISTINCT idParroquia,nombreParroquia FROM in_md_parroquia WHERE idCanton='$canton' ORDER BY nombreParroquia;";

			 	$resultado = $conexionEstablecida->query($query);

			 	$listas="<option value=''>--Elige una parroquia-</option>";

			 	while($registro = $resultado->fetch()) {
			 	
			 		$listas.="<option value='".$registro["idParroquia"]."'>".utf8_decode(utf8_encode($registro["nombreParroquia"]))."</option>";

			 	}

			 	return $listas;

 			}else if($indicador==4){

 				$query="SELECT id,REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(paisnombre , 'Ã¡', 'á'),'Ã©','é'),'Ã­','í'),'Ã³','ó'),'Ãº','ú'),'Ã‰','É'),'ÃŒ','Í'),'Ã“','Ó'),'Ãš','Ú'),'Ã±','ñ'),'Ã‘','Ñ'),'&#039;',' ` '),'Ã','Á'),'',' '),'Ã','Í'),'SI','SI'),'â€œ',''),'â€',''),'Á²','ó'),'','') AS paisnombre  FROM poa_pais ORDER BY paisnombre;";

			 	$resultado = $conexionEstablecida->query($query);

			 	$listas="<option value=''>--Elige un país-</option>";

			 	while($registro = $resultado->fetch()) {
			 	
			 		$listas.="<option value='".$registro["id"]."'>".utf8_decode(utf8_encode($registro["paisnombre"]))."</option>";

			 	}

			 	return $listas;

 			}else if($indicador==5){

 				$query="SELECT DISTINCT idCanton,nombreCanton FROM in_md_canton ORDER BY nombreCanton;";
			 	$resultado = $conexionEstablecida->query($query);

			 	$listas="<option value=''>--Elige un cantón-</option>";

			 	while($registro = $resultado->fetch()) {
			 	
			 		$listas.="<option value='".$registro["idCanton"]."'>".utf8_decode(utf8_encode($registro["nombreCanton"]))."</option>";

			 	}

			 	return $listas;

 			}else if($indicador==6){


 				$query="SELECT DISTINCT idParroquia,nombreParroquia FROM in_md_parroquia ORDER BY nombreParroquia;";

			 	$resultado = $conexionEstablecida->query($query);

			 	$listas="<option value=''>--Elige una parroquia-</option>";

			 	while($registro = $resultado->fetch()) {
			 	
			 		$listas.="<option value='".$registro["idParroquia"]."'>".utf8_decode(utf8_encode($registro["nombreParroquia"]))."</option>";

			 	}

			 	return $listas;

 			}else if($indicador==7){

 				$query="SELECT idLineas,nombreLinea FROM poa_linea_base WHERE estado='A' AND nombreLinea!='';";

			 	$resultado = $conexionEstablecida->query($query);

			 	$listas="<option value=''>--Elige una línea política-</option>";

			 	while($registro = $resultado->fetch()) {
			 	
			 		$listas.="<option value='".$registro["idLineas"]."'>".utf8_decode(utf8_encode($registro["nombreLinea"]))."</option>";

			 	}

			 	return $listas;

 			}else if($indicador==8){

 				$query="SELECT idAreaAccion,accion FROM poa_area_accion WHERE estado='A' AND accion!='';";

			 	$resultado = $conexionEstablecida->query($query);

			 	$listas="<option value=''>--Elige una àrea de acciòn--</option>";

			 	while($registro = $resultado->fetch()) {
			 	
			 		$listas.="<option value='".$registro["idAreaAccion"]."'>".utf8_decode(utf8_encode($registro["accion"]))."</option>";

			 	}

			 	return $listas;

 			}else if($indicador==9){

 				$query="SELECT nombreObjetivo,idObjetivos FROM poa_objetivos WHERE estado='A';";

			 	$resultado = $conexionEstablecida->query($query);

			 	$listas="<option value=''>--Elige un objetivo--</option>";

			 	while($registro = $resultado->fetch()) {
			 	
			 		$listas.="<option value='".$registro["idObjetivos"]."'>".utf8_decode(utf8_encode($registro["nombreObjetivo"]))."</option>";

			 	}

			 	return $listas;

 			}else if($indicador==10){

 				$query="SELECT idAreaEncargada,nombreArea FROM poa_areaencargada WHERE estado='A' ";

			 	$resultado = $conexionEstablecida->query($query);

			 	$listas="<option value=''>--Elige un área--</option>";

			 	while($registro = $resultado->fetch()) {
			 	
			 		$listas.="<option value='".$registro["idAreaEncargada"]."'>".utf8_decode(utf8_encode($registro["nombreArea"]))."</option>";

			 	}

			 	return $listas;

 			}else if($indicador==11){

 				$query="SELECT a.idTipoOrganismo,a.nombreTipo,b.idAreaAccion,b.accion,c.idObjetivos,c.nombreObjetivo,e.idLineas,e.nombreLinea,f.idAreaEncargada,f.nombreArea FROM poa_tipo_organismo AS a INNER JOIN poa_area_accion AS b ON b.idAreaAccion=a.idAreaAccion INNER JOIN poa_objetivos AS c ON c.idObjetivos=a.idObjetivos INNER JOIN poa_objetivos_usuario AS d ON d.idObjetivos=c.idObjetivos LEFT JOIN poa_linea_base AS e ON e.idLineas=d.idLineaBase LEFT JOIN poa_areaencargada AS f ON f.idAreaEncargada=a.idAreaEncargada;";

			 	$resultado = $conexionEstablecida->query($query);

			 	$listas="<option value=''>--Elige un tipo de organismo--</option>";

			 	while($registro = $resultado->fetch()) {
			 	
			 		$listas.="<option value='".$registro["idTipoOrganismo"]."' idAreaAccion='".$registro["idAreaAccion"]."' accion='".$registro["accion"]."' idObjetivos='".$registro["idObjetivos"]."' nombreObjetivo='".$registro["nombreObjetivo"]."' idLineas='".$registro["idLineas"]."' nombreLinea='".$registro["nombreLinea"]."' idAreaEncargada='".$registro["idAreaEncargada"]."' nombreArea='".$registro["nombreArea"]."'>".utf8_decode(utf8_encode($registro["nombreTipo"]))."</option>";

			 	}

			 	return $listas;

 			}else if($indicador==12){

 				$sumador=2021;

			 	$listas="<option value=''>--Elige un periodo--</option>";

			 	for ($i=0; $i < 100; $i++) { 

			 		$sumador=$sumador+1;

			 		$listas.="<option value='".$sumador."'>".$sumador."</option>";

			 	}

			 	return $listas;


 			}else if($indicador==13){


 				$query="SELECT idClasificacionGastos,nombreClasificacionGastos FROM poa_clasificaciongastos";

			 	$resultado = $conexionEstablecida->query($query);

			 	$listas="<option value=''>--Elige un grupo de gasto--</option>";

			 	while($registro = $resultado->fetch()) {
			 	
			 		$listas.="<option value='".$registro["idClasificacionGastos"]."'>".utf8_decode(utf8_encode($registro["nombreClasificacionGastos"]))."</option>";

			 	}

			 	return $listas;



 			}else if($indicador==14){

 				$array = [];

 				$query="SELECT c.idItem,c.nombreItem FROM poa_item_actividad AS a INNER JOIN poa_actividades AS b ON a.idActividad=b.idActividades INNER JOIN poa_item AS c ON c.idItem=a.idItem WHERE a.idActividad='$elementos' GROUP BY c.idItem;";

			 	$resultado = $conexionEstablecida->query($query);

			 	while($registro = $resultado->fetch()) {
			 	
			 		array_push($array, $registro["idItem"]);

			 	}

			 	$validaItem = implode(",",$array);  

			 	$listas="<option value=''>--Elige un item--</option>";

			 	if (count($array)>0) {
			 		$query2="SELECT idItem,nombreItem,itemPreesupuestario FROM poa_item WHERE idItem NOT IN ($validaItem) ORDER BY itemPreesupuestario ASC;";
			 	}else{
			 		$query2="SELECT idItem,nombreItem,itemPreesupuestario FROM poa_item  ORDER BY itemPreesupuestario ASC;";
			 	}


	 			

				$resultado2 = $conexionEstablecida->query($query2);

				while($registro2 = $resultado2->fetch()) {
				 	
					$listas.="<option value='".$registro2["idItem"]."'>".utf8_decode(utf8_encode("(".$registro2["itemPreesupuestario"].")".$registro2["nombreItem"]))."</option>";

				} 	

			 	return $listas;


 			}else if($indicador==15){

 				$query="SELECT idPrograma,nombrePrograma FROM poa_programa;";

			 	$resultado = $conexionEstablecida->query($query);

			 	$listas="<option value=''>--Elige un programa--</option>";

			 	while($registro = $resultado->fetch()) {
			 	
			 		$listas.="<option value='".$registro["idPrograma"]."'>".utf8_decode(utf8_encode($registro["nombrePrograma"]))."</option>";

			 	}

			 	return $listas;


 			}else if($indicador==16){

 				$query="SELECT idTipo,nombreTipo FROM poa_tipo WHERE estado='A' AND nombreTipo!='';";

			 	$resultado = $conexionEstablecida->query($query);

			 	$listas="<option value=''>--Elige un programa--</option>";

			 	while($registro = $resultado->fetch()) {
			 	
			 		$listas.="<option value='".$registro["idTipo"]."'>".utf8_decode(utf8_encode($registro["nombreTipo"]))."</option>";

			 	}

			 	return $listas;

 			}else if($indicador==17){

 				$query="SELECT b.idPrograma,b.nombrePrograma FROM poa_objetivos_usuario AS a INNER JOIN poa_programa AS b ON a.idPrograma=b.idPrograma WHERE a.idObjetivos='$parametro2';";

			 	$resultado = $conexionEstablecida->query($query);

			 	$listas="<option value=''>--Elige un programa--</option>";

			 	while($registro = $resultado->fetch()) {
			 	
			 		$listas.="<option value='".$registro["idPrograma"]."'>".utf8_decode(utf8_encode($registro["nombrePrograma"]))."</option>";

			 	}

			 	return $listas; 				

 			}else if($indicador==18){

 				$query="SELECT b.idPrograma,b.nombrePrograma FROM poa_objetivos_usuario AS a INNER JOIN poa_programa AS b ON a.idPrograma=b.idPrograma;";

			 	$resultado = $conexionEstablecida->query($query);

			 	$listas="<option value=''>--Elige un programa--</option>";

			 	while($registro = $resultado->fetch()) {
			 	
			 		$listas.="<option value='".$registro["idPrograma"]."'>".utf8_decode(utf8_encode($registro["nombrePrograma"]))."</option>";

			 	}

			 	return $listas; 				

 			}else if($indicador==19){

 				$arraySeleccionado = [];

 				$arrayItemsActividades=[];


 				$querySeleccionado="SELECT idItem FROM poa_programacion_financiera WHERE idOrganismo='$idOrganismo' AND idActividad='$elementos';";

			 	$resultadoSeleccionado = $conexionEstablecida->query($querySeleccionado);

			 	while($registroSeleccionado = $resultadoSeleccionado->fetch()) {
			 	
			 		array_push($arraySeleccionado, $registroSeleccionado["idItem"]);

			 	}


 				$querySeleccionadoSegus="SELECT idItem AS itemActEn FROM poa_item_actividad WHERE idActividad='$elementos';";

			 	$resultadoSeleccionadoSegus = $conexionEstablecida->query($querySeleccionadoSegus);

			 	while($registroSeleccionadoSegus = $resultadoSeleccionadoSegus->fetch()) {
			 	
			 		array_push($arrayItemsActividades, $registroSeleccionadoSegus["itemActEn"]);

			 	}

			 	if (count($arraySeleccionado)>0) {
			 		$validaItem = implode(",",$arraySeleccionado);  
			 	}


			 
			 	$validaItem2 = implode(",",$arrayItemsActividades);  



			 	$listas="<option value=''>--Elige un item usuario--</option>";

			 	if (count($arraySeleccionado)<=0 || count($arraySeleccionado)=="0") {
			 		$query2="SELECT idItem,nombreItem,itemPreesupuestario FROM poa_item WHERE idItem  IN($validaItem2) ORDER BY nombreItem;";
			 	}else{
			 		$query2="SELECT idItem,nombreItem,itemPreesupuestario FROM poa_item WHERE idItem NOT IN ($validaItem) AND idItem  IN($validaItem2) ORDER BY nombreItem;";
			 	}

				 $resultado2 = $conexionEstablecida->query($query2);

				 while($registro2 = $resultado2->fetch()) {
				 	
					$listas.="<option value='".$registro2["idItem"]."'>".utf8_decode(utf8_encode("(".$registro2["itemPreesupuestario"].") ".$registro2["nombreItem"]))."</option>";

				 } 	

				 return $listas;


 			}else if($indicador==20){


 				$query="SELECT idIndicadores,nombreIndicador FROM poa_indicadores;";

			 	$resultado = $conexionEstablecida->query($query);

			 	$listas="<option value=''>--Elige un indicador--</option>";

			 	while($registro = $resultado->fetch()) {
			 	
			 		$listas.="<option value='".$registro["idIndicadores"]."'>".utf8_decode(utf8_encode($registro["nombreIndicador"]))."</option>";

			 	}

			 	return $listas; 

 			}else if($indicador==21){

 				$query="SELECT idDeporte,nombreDeporte FROM poa_deporte;";

			 	$resultado = $conexionEstablecida->query($query);

			 	$listas="<option value=''>--Seleccione--</option>";

			 	while($registro = $resultado->fetch()) {
			 	
			 		$listas.="<option value='".$registro["idDeporte"]."'>".utf8_decode(utf8_encode($registro["nombreDeporte"]))."</option>";

			 	}

			 	return $listas; 

 			}else if($indicador==22){

 				$query="SELECT id,paisnombre FROM poa_pais;";

			 	$resultado = $conexionEstablecida->query($query);

			 	$listas="<option value=''>--Seleccione--</option>";

			 	while($registro = $resultado->fetch()) {
			 	
			 		$listas.="<option value='".$registro["id"]."'>".utf8_decode(utf8_encode($registro["paisnombre"]))."</option>";

			 	}

			 	return $listas; 

 			}else if($indicador==23){

 				$query="SELECT idAlcanse,nombreAlcanse FROM poa_alcanse;";

			 	$resultado = $conexionEstablecida->query($query);

			 	$listas="<option value=''>--Seleccione--</option>";

			 	while($registro = $resultado->fetch()) {
			 	
			 		$listas.="<option value='".$registro["idAlcanse"]."'>".utf8_decode(utf8_encode($registro["nombreAlcanse"]))."</option>";

			 	}

			 	return $listas; 

 			}else if($indicador==24){

 				$conexionEstablecida->exec("set names utf8");

 				$query="SELECT a.id_usuario,REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(CONCAT_WS(' ',a.nombre,a.apellido), 'Ã¡', 'á'),'Ã©','é'),'Ã­','í'),'Ã³','ó'),'Ãº','ú'),'Ã‰','É'),'ÃŒ','Í'),'Ã“','Ó'),'Ãš','Ú'),'Ã±','ñ'),'Ã‘','Ñ'),'&#039;',' ` '),'Ã','Á'),'',' '),'Ã','Á'),'SI','SI'),'â€œ',''),'â€',''),'Á²','ó') AS nombreCompleto, CONCAT_WS('-',c.descripcionZonal,d.nombre) AS descripcionZonal,b.id_rol,a.fisicamenteEstructura FROM th_usuario AS a INNER JOIN th_usuario_roles AS b ON a.id_usuario=b.id_usuario INNER JOIN th_zonal AS c ON c.id_Zonal=a.zonal INNER JOIN th_roles AS d ON d.id_rol=b.id_rol  WHERE a.estadoUsuario='A' AND (b.id_rol='4' AND a.zonal>1) OR (a.fisicamenteEstructura='24' AND b.id_rol='7') OR (a.PersonaACargo='$idUsuario') AND b.id_rol!='3' AND a.estadoUsuario='A' ORDER BY b.id_rol,a.zonal;";

			 	$resultado = $conexionEstablecida->query($query);

			 	$listas="<option value=''>--Seleccione--</option>";

			 	while($registro = $resultado->fetch()) {


			 		$listas.="<option value='".$registro["id_usuario"]."'>".utf8_decode(utf8_encode($registro["nombreCompleto"])." (".utf8_encode($registro["descripcionZonal"])).")"."</option>";
			 	

			 	}

			 	return $listas; 

 			}else if($indicador==25){

 				$conexionEstablecida->exec("set names utf8");

 				$query2="SELECT PersonaACargo FROM th_usuario WHERE id_usuario='$idUsuario';";
			 	$resultado2 = $conexionEstablecida->query($query2);

			 	while($registro2 = $resultado2->fetch()) {

			 		$idBuscadorDic=$registro2["PersonaACargo"];
			 	
			 	}

			 	$query3="SELECT a.id_usuario,REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(CONCAT_WS(' ',a.nombre,a.apellido), 'Ã¡', 'á'),'Ã©','é'),'Ã­','í'),'Ã³','ó'),'Ãº','ú'),'Ã‰','É'),'ÃŒ','Í'),'Ã“','Ó'),'Ãš','Ú'),'Ã±','ñ'),'Ã‘','Ñ'),'&#039;',' ` '),'Ã','Á'),'',' '),'Ã','Á'),'SI','SI'),'â€œ',''),'â€',''),'Á²','ó') AS nombreCompleto, CONCAT_WS('-',c.descripcionZonal,d.nombre) AS descripcionZonal,b.id_rol,a.fisicamenteEstructura FROM th_usuario AS a INNER JOIN th_usuario_roles AS b ON a.id_usuario=b.id_usuario INNER JOIN th_zonal AS c ON c.id_Zonal=a.zonal INNER JOIN th_roles AS d ON d.id_rol=b.id_rol  WHERE a.id_usuario='$idBuscadorDic'  ORDER BY c.id_Zonal;";

			 	$resultado3 = $conexionEstablecida->query($query3);


 				$query="SELECT a.id_usuario,CONCAT_WS(' ',a.nombre,a.apellido) AS nombreCompleto, CONCAT_WS('-',c.descripcionZonal,d.nombre) AS descripcionZonal,b.id_rol,a.fisicamenteEstructura FROM th_usuario AS a INNER JOIN th_usuario_roles AS b ON a.id_usuario=b.id_usuario INNER JOIN th_zonal AS c ON c.id_Zonal=a.zonal INNER JOIN th_roles AS d ON d.id_rol=b.id_rol INNER JOIN th_puestoinstitucional AS e ON e.id_PuestoInstitucional=a.puestoInstitucional WHERE a.estadoUsuario='A' AND a.PersonaACargo='$idUsuario'  AND a.estadoUsuario='A' ORDER BY c.id_Zonal;";

			 	$resultado = $conexionEstablecida->query($query);

			 	$listas="<option value=''>--Seleccione--</option>";


			 	while($registro3 = $resultado3->fetch()) {


			 		$listas.="<option value='".$registro3["id_usuario"]."'>".utf8_decode(utf8_encode($registro3["nombreCompleto"])." (".utf8_encode($registro3["descripcionZonal"])).")"."</option>";
			 	

			 	}


			 	while($registro = $resultado->fetch()) {


			 		$listas.="<option value='".$registro["id_usuario"]."'>".utf8_decode(utf8_encode($registro["nombreCompleto"])." (".utf8_encode($registro["descripcionZonal"])).")"."</option>";
			 	

			 	}

			 	return $listas; 

 			}else if($indicador==26){

 				$conexionEstablecida->exec("set names utf8");

 				$query="SELECT a.id_usuario,REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(CONCAT_WS(' ',a.nombre,a.apellido), 'Ã¡', 'á'),'Ã©','é'),'Ã­','í'),'Ã³','ó'),'Ãº','ú'),'Ã‰','É'),'ÃŒ','Í'),'Ã“','Ó'),'Ãš','Ú'),'Ã±','ñ'),'Ã‘','Ñ'),'&#039;',' ` '),'Ã','Á'),'',' '),'Ã','Á'),'SI','SI'),'â€œ',''),'â€',''),'Á²','ó') AS nombreCompleto, CONCAT_WS('-',c.descripcionZonal,d.nombre) AS descripcionZonal,b.id_rol,a.fisicamenteEstructura FROM th_usuario AS a INNER JOIN th_usuario_roles AS b ON a.id_usuario=b.id_usuario INNER JOIN th_zonal AS c ON c.id_Zonal=a.zonal INNER JOIN th_roles AS d ON d.id_rol=b.id_rol  WHERE a.estadoUsuario='A' AND (a.fisicamenteEstructura='26' AND b.id_rol='7') OR (a.PersonaACargo='$idUsuario') AND a.estadoUsuario='A' ORDER BY b.id_rol,a.zonal;";

			 	$resultado = $conexionEstablecida->query($query);

			 	$listas="<option value=''>--Seleccione--</option>";

			 	while($registro = $resultado->fetch()) {

			 		$listas.="<option value='".$registro["id_usuario"]."'>".utf8_decode(utf8_encode($registro["nombreCompleto"])." (".utf8_encode($registro["descripcionZonal"])).")"."</option>";
			 	
			 	}

			 	return $listas; 

 			}else if($indicador==27){

 				$conexionEstablecida->exec("set names utf8");

 				$query="SELECT a.id_usuario,REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(CONCAT_WS(' ',a.nombre,a.apellido), 'Ã¡', 'á'),'Ã©','é'),'Ã­','í'),'Ã³','ó'),'Ãº','ú'),'Ã‰','É'),'ÃŒ','Í'),'Ã“','Ó'),'Ãš','Ú'),'Ã±','ñ'),'Ã‘','Ñ'),'&#039;',' ` '),'Ã','Á'),'',' '),'Ã','Á'),'SI','SI'),'â€œ',''),'â€',''),'Á²','ó') AS nombreCompleto, CONCAT_WS('-',c.descripcionZonal,d.nombre) AS descripcionZonal,b.id_rol,a.fisicamenteEstructura,e.descripcionFisicamenteEstructura FROM th_usuario AS a INNER JOIN th_usuario_roles AS b ON a.id_usuario=b.id_usuario INNER JOIN th_zonal AS c ON c.id_Zonal=a.zonal INNER JOIN th_roles AS d ON d.id_rol=b.id_rol INNER JOIN th_fisicamenteestructura AS e ON e.id_FisicamenteEstructura=a.fisicamenteEstructura  WHERE a.estadoUsuario='A' AND (b.id_rol='4' AND a.zonal>1 AND a.estadoUsuario='A') OR (a.PersonaACargo='$idUsuario' AND a.estadoUsuario='A' AND b.id_rol='2') AND a.estadoUsuario='A'  ORDER BY b.id_rol,a.zonal;";

			 	$resultado = $conexionEstablecida->query($query);


			 	while($registro = $resultado->fetch()) {

			 		$listas.="<option value='".$registro["id_usuario"]."'>".utf8_decode(utf8_encode($registro["nombreCompleto"])." (".utf8_encode($registro["descripcionZonal"])).") DIECCIÓN: ".$registro["descripcionFisicamenteEstructura"]."</option>";

			 	}

			 	return $listas; 

 			}else if($indicador==28){

 				$conexionEstablecida->exec("set names utf8");

 				$query="SELECT a.id_usuario,REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(CONCAT_WS(' ',a.nombre,a.apellido), 'Ã¡', 'á'),'Ã©','é'),'Ã­','í'),'Ã³','ó'),'Ãº','ú'),'Ã‰','É'),'ÃŒ','Í'),'Ã“','Ó'),'Ãš','Ú'),'Ã±','ñ'),'Ã‘','Ñ'),'&#039;',' ` '),'Ã','Á'),'',' '),'Ã','Á'),'SI','SI'),'â€œ',''),'â€',''),'Á²','ó') AS nombreCompleto, CONCAT_WS('-',c.descripcionZonal,d.nombre) AS descripcionZonal,b.id_rol,a.fisicamenteEstructura,e.descripcionFisicamenteEstructura FROM th_usuario AS a INNER JOIN th_usuario_roles AS b ON a.id_usuario=b.id_usuario INNER JOIN th_zonal AS c ON c.id_Zonal=a.zonal INNER JOIN th_roles AS d ON d.id_rol=b.id_rol INNER JOIN th_fisicamenteestructura AS e ON e.id_FisicamenteEstructura=a.fisicamenteEstructura  WHERE a.estadoUsuario='A' AND (a.PersonaACargo='$idUsuario') AND a.estadoUsuario='A' AND (a.fisicamenteEstructura='7' OR a.fisicamenteEstructura='5') OR (b.id_rol='4' AND a.zonal>1) ORDER BY b.id_rol,a.zonal;";

			 	$resultado = $conexionEstablecida->query($query);


			 	while($registro = $resultado->fetch()) {

			 		$listas.="<option value='".$registro["id_usuario"]."'>".utf8_decode(utf8_encode($registro["nombreCompleto"])." (".utf8_encode($registro["descripcionZonal"])).") DIECCIÓN: ".$registro["descripcionFisicamenteEstructura"]."</option>";

			 	}

			 	return $listas; 

 			}else if($indicador==29){

 				$conexionEstablecida->exec("set names utf8");

 				if ($identificador=="subses") {
 					
 					$query="SELECT a.id_usuario,REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(CONCAT_WS(' ',a.nombre,a.apellido), 'Ã¡', 'á'),'Ã©','é'),'Ã­','í'),'Ã³','ó'),'Ãº','ú'),'Ã‰','É'),'ÃŒ','Í'),'Ã“','Ó'),'Ãš','Ú'),'Ã±','ñ'),'Ã‘','Ñ'),'&#039;',' ` '),'Ã','Á'),'',' '),'Ã','Á'),'SI','SI'),'â€œ',''),'â€',''),'Á²','ó') AS nombreCompleto, CONCAT_WS('-',c.descripcionZonal,d.nombre) AS descripcionZonal,b.id_rol,a.fisicamenteEstructura FROM th_usuario AS a INNER JOIN th_usuario_roles AS b ON a.id_usuario=b.id_usuario INNER JOIN th_zonal AS c ON c.id_Zonal=a.zonal INNER JOIN th_roles AS d ON d.id_rol=b.id_rol  WHERE a.estadoUsuario='A' AND (a.fisicamenteEstructura='26' AND b.id_rol='7') OR (a.PersonaACargo='$idUsuario') AND a.estadoUsuario='A' ORDER BY b.id_rol DESC;";

 				}else{

 					$query="SELECT a.id_usuario,REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(CONCAT_WS(' ',a.nombre,a.apellido), 'Ã¡', 'á'),'Ã©','é'),'Ã­','í'),'Ã³','ó'),'Ãº','ú'),'Ã‰','É'),'ÃŒ','Í'),'Ã“','Ó'),'Ãš','Ú'),'Ã±','ñ'),'Ã‘','Ñ'),'&#039;',' ` '),'Ã','Á'),'',' '),'Ã','Á'),'SI','SI'),'â€œ',''),'â€',''),'Á²','ó') AS nombreCompleto, CONCAT_WS('-',c.descripcionZonal,d.nombre) AS descripcionZonal,b.id_rol,a.fisicamenteEstructura FROM th_usuario AS a INNER JOIN th_usuario_roles AS b ON a.id_usuario=b.id_usuario INNER JOIN th_zonal AS c ON c.id_Zonal=a.zonal INNER JOIN th_roles AS d ON d.id_rol=b.id_rol  WHERE a.estadoUsuario='A' AND (a.fisicamenteEstructura='1' AND b.id_rol='4') OR (a.PersonaACargo='$idUsuario') AND a.estadoUsuario='A' ORDER BY b.id_rol DESC;";

 				}

 				

			 	$resultado = $conexionEstablecida->query($query);

			 	$listas="<option value=''>--Seleccione--</option>";

			 	while($registro = $resultado->fetch()) {


			 		$listas.="<option value='".$registro["id_usuario"]."'>".utf8_decode(utf8_encode($registro["nombreCompleto"])." (".utf8_encode($registro["descripcionZonal"])).")"."</option>";
			 	

			 	}

			 	return $listas; 

 			}else if($indicador==30){

 				$conexionEstablecida->exec("set names utf8");

 				$query2="SELECT PersonaACargo FROM th_usuario WHERE id_usuario='$idUsuario';";
			 	$resultado2 = $conexionEstablecida->query($query2);

			 	while($registro2 = $resultado2->fetch()) {

			 		$idBuscadorDic=$registro2["PersonaACargo"];
			 	
			 	}

			 	$query3="SELECT a.id_usuario,REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(CONCAT_WS(' ',a.nombre,a.apellido), 'Ã¡', 'á'),'Ã©','é'),'Ã­','í'),'Ã³','ó'),'Ãº','ú'),'Ã‰','É'),'ÃŒ','Í'),'Ã“','Ó'),'Ãš','Ú'),'Ã±','ñ'),'Ã‘','Ñ'),'&#039;',' ` '),'Ã','Á'),'',' '),'Ã','Á'),'SI','SI'),'â€œ',''),'â€',''),'Á²','ó') AS nombreCompleto, CONCAT_WS('-',c.descripcionZonal,d.nombre) AS descripcionZonal,b.id_rol,a.fisicamenteEstructura FROM th_usuario AS a INNER JOIN th_usuario_roles AS b ON a.id_usuario=b.id_usuario INNER JOIN th_zonal AS c ON c.id_Zonal=a.zonal INNER JOIN th_roles AS d ON d.id_rol=b.id_rol  WHERE a.id_usuario='$idBuscadorDic'  ORDER BY c.id_Zonal;";

			 	$resultado3 = $conexionEstablecida->query($query3);


 				$query="SELECT a.id_usuario,CONCAT_WS(' ',a.nombre,a.apellido) AS nombreCompleto, CONCAT_WS('-',c.descripcionZonal,d.nombre) AS descripcionZonal,b.id_rol,a.fisicamenteEstructura FROM th_usuario AS a INNER JOIN th_usuario_roles AS b ON a.id_usuario=b.id_usuario INNER JOIN th_zonal AS c ON c.id_Zonal=a.zonal INNER JOIN th_roles AS d ON d.id_rol=b.id_rol  WHERE a.estadoUsuario='A' AND a.PersonaACargo='$idUsuario'  ORDER BY c.id_Zonal;";

			 	$resultado = $conexionEstablecida->query($query);

			 	$listas="<option value=''>--Seleccione--</option>";


			 	while($registro3 = $resultado3->fetch()) {


			 		$listas.="<option value='".$registro3["id_usuario"]."'>".utf8_decode(utf8_encode($registro3["nombreCompleto"])." (".utf8_encode($registro3["descripcionZonal"])).")"."</option>";
			 	

			 	}


			 	while($registro = $resultado->fetch()) {


			 		$listas.="<option value='".$registro["id_usuario"]."'>".utf8_decode(utf8_encode($registro["nombreCompleto"])." (".utf8_encode($registro["descripcionZonal"])).")"."</option>";
			 	

			 	}

			 	return $listas;  				
 				
 			}else if($indicador==31){


 				$conexionEstablecida->exec("set names utf8");

 				if ($identificador=="subses") {
 					
 					$query="SELECT a.id_usuario,REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(CONCAT_WS(' ',a.nombre,a.apellido), 'Ã¡', 'á'),'Ã©','é'),'Ã­','í'),'Ã³','ó'),'Ãº','ú'),'Ã‰','É'),'ÃŒ','Í'),'Ã“','Ó'),'Ãš','Ú'),'Ã±','ñ'),'Ã‘','Ñ'),'&#039;',' ` '),'Ã','Á'),'',' '),'Ã','Á'),'SI','SI'),'â€œ',''),'â€',''),'Á²','ó') AS nombreCompleto, CONCAT_WS('-',c.descripcionZonal,d.nombre) AS descripcionZonal,b.id_rol,a.fisicamenteEstructura FROM th_usuario AS a INNER JOIN th_usuario_roles AS b ON a.id_usuario=b.id_usuario INNER JOIN th_zonal AS c ON c.id_Zonal=a.zonal INNER JOIN th_roles AS d ON d.id_rol=b.id_rol  WHERE a.estadoUsuario='A' AND (a.fisicamenteEstructura='26' AND b.id_rol='7') OR (a.PersonaACargo='$idUsuario') AND a.estadoUsuario='A' ORDER BY b.id_rol DESC;";

 				}else{

 					$query="SELECT a.id_usuario,REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(CONCAT_WS(' ',a.nombre,a.apellido), 'Ã¡', 'á'),'Ã©','é'),'Ã­','í'),'Ã³','ó'),'Ãº','ú'),'Ã‰','É'),'ÃŒ','Í'),'Ã“','Ó'),'Ãš','Ú'),'Ã±','ñ'),'Ã‘','Ñ'),'&#039;',' ` '),'Ã','Á'),'',' '),'Ã','Á'),'SI','SI'),'â€œ',''),'â€',''),'Á²','ó') AS nombreCompleto, CONCAT_WS('-',c.descripcionZonal,d.nombre) AS descripcionZonal,b.id_rol,a.fisicamenteEstructura FROM th_usuario AS a INNER JOIN th_usuario_roles AS b ON a.id_usuario=b.id_usuario INNER JOIN th_zonal AS c ON c.id_Zonal=a.zonal INNER JOIN th_roles AS d ON d.id_rol=b.id_rol  WHERE a.estadoUsuario='A' AND (a.fisicamenteEstructura='2' AND b.id_rol='4') OR (a.PersonaACargo='$idUsuario') AND a.estadoUsuario='A' ORDER BY b.id_rol DESC;";

 				}

 				

			 	$resultado = $conexionEstablecida->query($query);

			 	$listas="<option value=''>--Seleccione--</option>";

			 	while($registro = $resultado->fetch()) {


			 		$listas.="<option value='".$registro["id_usuario"]."'>".utf8_decode(utf8_encode($registro["nombreCompleto"])." (".utf8_encode($registro["descripcionZonal"])).")"."</option>";

			 	

			 	}

			 	return $listas; 

 			}else if($indicador==32){


 				$conexionEstablecida->exec("set names utf8");

 				if ($identificador=="subses") {
 					
 					$query="SELECT a.id_usuario,REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(CONCAT_WS(' ',a.nombre,a.apellido), 'Ã¡', 'á'),'Ã©','é'),'Ã­','í'),'Ã³','ó'),'Ãº','ú'),'Ã‰','É'),'ÃŒ','Í'),'Ã“','Ó'),'Ãš','Ú'),'Ã±','ñ'),'Ã‘','Ñ'),'&#039;',' ` '),'Ã','Á'),'',' '),'Ã','Á'),'SI','SI'),'â€œ',''),'â€',''),'Á²','ó') AS nombreCompleto, CONCAT_WS('-',c.descripcionZonal,d.nombre) AS descripcionZonal,b.id_rol,a.fisicamenteEstructura FROM th_usuario AS a INNER JOIN th_usuario_roles AS b ON a.id_usuario=b.id_usuario INNER JOIN th_zonal AS c ON c.id_Zonal=a.zonal INNER JOIN th_roles AS d ON d.id_rol=b.id_rol  WHERE a.estadoUsuario='A' AND (a.fisicamenteEstructura='26' AND b.id_rol='7') OR (a.PersonaACargo='$idUsuario') AND a.estadoUsuario='A' ORDER BY b.id_rol DESC;";

 				}else{

 					$query="SELECT a.id_usuario,REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(CONCAT_WS(' ',a.nombre,a.apellido), 'Ã¡', 'á'),'Ã©','é'),'Ã­','í'),'Ã³','ó'),'Ãº','ú'),'Ã‰','É'),'ÃŒ','Í'),'Ã“','Ó'),'Ãš','Ú'),'Ã±','ñ'),'Ã‘','Ñ'),'&#039;',' ` '),'Ã','Á'),'',' '),'Ã','Á'),'SI','SI'),'â€œ',''),'â€',''),'Á²','ó') AS nombreCompleto, CONCAT_WS('-',c.descripcionZonal,d.nombre) AS descripcionZonal,b.id_rol,a.fisicamenteEstructura FROM th_usuario AS a INNER JOIN th_usuario_roles AS b ON a.id_usuario=b.id_usuario INNER JOIN th_zonal AS c ON c.id_Zonal=a.zonal INNER JOIN th_roles AS d ON d.id_rol=b.id_rol  WHERE a.estadoUsuario='A' AND (a.fisicamenteEstructura='26' AND b.id_rol='7') OR (a.PersonaACargo='$idUsuario') AND a.estadoUsuario='A' ORDER BY b.id_rol DESC;";

 				}

 				

			 	$resultado = $conexionEstablecida->query($query);

			 	$listas="<option value=''>--Seleccione--</option>";

			 	while($registro = $resultado->fetch()) {

			 		$listas.="<option value='".$registro["id_usuario"]."'>".utf8_decode(utf8_encode($registro["nombreCompleto"])." (".utf8_encode($registro["descripcionZonal"])).")"."</option>";
			 	

			 	}

			 	return $listas; 

 			}else if($indicador==33){

				$conexionEstablecida->exec("set names utf8");

 				$query="SELECT a.id_usuario,REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(CONCAT_WS(' ',a.nombre,a.apellido), 'Ã¡', 'á'),'Ã©','é'),'Ã­','í'),'Ã³','ó'),'Ãº','ú'),'Ã‰','É'),'ÃŒ','Í'),'Ã“','Ó'),'Ãš','Ú'),'Ã±','ñ'),'Ã‘','Ñ'),'&#039;',' ` '),'Ã','Á'),'',' '),'Ã','Á'),'SI','SI'),'â€œ',''),'â€',''),'Á²','ó') AS nombreCompleto, CONCAT_WS('-',c.descripcionZonal,d.nombre) AS descripcionZonal,b.id_rol,a.fisicamenteEstructura FROM th_usuario AS a INNER JOIN th_usuario_roles AS b ON a.id_usuario=b.id_usuario INNER JOIN th_zonal AS c ON c.id_Zonal=a.zonal INNER JOIN th_roles AS d ON d.id_rol=b.id_rol  WHERE a.estadoUsuario='A' AND (a.zonal=1 AND a.PersonaACargo='$idUsuario')  AND a.estadoUsuario='A' ORDER BY b.id_rol,a.zonal;";

			 	$resultado = $conexionEstablecida->query($query);


 				$queryCoordinador="SELECT a.id_usuario,REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(CONCAT_WS(' ',a.nombre,a.apellido), 'Ã¡', 'á'),'Ã©','é'),'Ã­','í'),'Ã³','ó'),'Ãº','ú'),'Ã‰','É'),'ÃŒ','Í'),'Ã“','Ó'),'Ãš','Ú'),'Ã±','ñ'),'Ã‘','Ñ'),'&#039;',' ` '),'Ã','Á'),'',' '),'Ã','Á'),'SI','SI'),'â€œ',''),'â€',''),'Á²','ó') AS nombreCompleto, CONCAT_WS('-',c.descripcionZonal,d.nombre) AS descripcionZonal,b.id_rol,a.fisicamenteEstructura FROM th_usuario AS a INNER JOIN th_usuario_roles AS b ON a.id_usuario=b.id_usuario INNER JOIN th_zonal AS c ON c.id_Zonal=a.zonal INNER JOIN th_roles AS d ON d.id_rol=b.id_rol WHERE a.estadoUsuario='A' AND b.id_rol='4' AND a.fisicamenteEstructura='3';";

			 	$resultadoCoordinador = $conexionEstablecida->query($queryCoordinador);


 				$queryCoordinador__zonales="SELECT a.id_usuario,REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(CONCAT_WS(' ',a.nombre,a.apellido), 'Ã¡', 'á'),'Ã©','é'),'Ã­','í'),'Ã³','ó'),'Ãº','ú'),'Ã‰','É'),'ÃŒ','Í'),'Ã“','Ó'),'Ãš','Ú'),'Ã±','ñ'),'Ã‘','Ñ'),'&#039;',' ` '),'Ã','Á'),'',' '),'Ã','Á'),'SI','SI'),'â€œ',''),'â€',''),'Á²','ó') AS nombreCompleto, CONCAT_WS('-',c.descripcionZonal,d.nombre) AS descripcionZonal,b.id_rol,a.fisicamenteEstructura FROM th_usuario AS a INNER JOIN th_usuario_roles AS b ON a.id_usuario=b.id_usuario INNER JOIN th_zonal AS c ON c.id_Zonal=a.zonal INNER JOIN th_roles AS d ON d.id_rol=b.id_rol WHERE a.estadoUsuario='A' AND b.id_rol='4' AND a.zonal>1 ORDER BY a.zonal;";

			 	$resultadoCoordinador__zonales = $conexionEstablecida->query($queryCoordinador__zonales);			 	

			 	$listas="<option value=''>--Seleccione--</option>";

			 	while($registroCoordinador = $resultadoCoordinador->fetch()) {

			 		$listas.="<option value='".$registroCoordinador["id_usuario"]."'>".utf8_decode(utf8_encode($registroCoordinador["nombreCompleto"])." (".utf8_encode($registroCoordinador["descripcionZonal"])).")"."</option>";
			 	
			 	}

			 	while($registro = $resultado->fetch()) {

			 		$listas.="<option value='".$registro["id_usuario"]."'>".utf8_decode(utf8_encode($registro["nombreCompleto"])." (".utf8_encode($registro["descripcionZonal"])).")"."</option>";
			 	

			 	}

			 	while($registro__zonales = $resultadoCoordinador__zonales->fetch()) {

			 		$listas.="<option value='".$registro__zonales["id_usuario"]."'>".utf8_decode(utf8_encode($registro__zonales["nombreCompleto"])." (".utf8_encode($registro__zonales["descripcionZonal"])).")"."</option>";
			 	

			 	}
			 	

			 	return $listas; 

 			}else if($indicador==34){

				$conexionEstablecida->exec("set names utf8");

 				$query="SELECT a.id_usuario,REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(CONCAT_WS(' ',a.nombre,a.apellido), 'Ã¡', 'á'),'Ã©','é'),'Ã­','í'),'Ã³','ó'),'Ãº','ú'),'Ã‰','É'),'ÃŒ','Í'),'Ã“','Ó'),'Ãš','Ú'),'Ã±','ñ'),'Ã‘','Ñ'),'&#039;',' ` '),'Ã','Á'),'',' '),'Ã','Á'),'SI','SI'),'â€œ',''),'â€',''),'Á²','ó') AS nombreCompleto, CONCAT_WS('-',c.descripcionZonal,d.nombre) AS descripcionZonal,b.id_rol,a.fisicamenteEstructura FROM th_usuario AS a INNER JOIN th_usuario_roles AS b ON a.id_usuario=b.id_usuario INNER JOIN th_zonal AS c ON c.id_Zonal=a.zonal INNER JOIN th_roles AS d ON d.id_rol=b.id_rol  WHERE a.estadoUsuario='A' AND (a.zonal=1 AND a.PersonaACargo='$idUsuario') AND b.id_rol!='3' AND a.fisicamenteEstructura='6' AND a.estadoUsuario='A' ORDER BY b.id_rol,a.zonal;";

			 	$resultado = $conexionEstablecida->query($query);


 				$queryCoordinador="SELECT a.id_usuario,REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(CONCAT_WS(' ',a.nombre,a.apellido), 'Ã¡', 'á'),'Ã©','é'),'Ã­','í'),'Ã³','ó'),'Ãº','ú'),'Ã‰','É'),'ÃŒ','Í'),'Ã“','Ó'),'Ãš','Ú'),'Ã±','ñ'),'Ã‘','Ñ'),'&#039;',' ` '),'Ã','Á'),'',' '),'Ã','Á'),'SI','SI'),'â€œ',''),'â€',''),'Á²','ó') AS nombreCompleto, CONCAT_WS('-',c.descripcionZonal,d.nombre) AS descripcionZonal,b.id_rol,a.fisicamenteEstructura FROM th_usuario AS a INNER JOIN th_usuario_roles AS b ON a.id_usuario=b.id_usuario INNER JOIN th_zonal AS c ON c.id_Zonal=a.zonal INNER JOIN th_roles AS d ON d.id_rol=b.id_rol WHERE a.estadoUsuario='A' AND b.id_rol='4'  AND a.fisicamenteEstructura='3';";

			 	$resultadoCoordinador = $conexionEstablecida->query($queryCoordinador);

			 	$listas="<option value=''>--Seleccione--</option>";

			 	while($registroCoordinador = $resultadoCoordinador->fetch()) {

			 		$listas.="<option value='".$registroCoordinador["id_usuario"]."'>".utf8_decode(utf8_encode($registroCoordinador["nombreCompleto"])." (".utf8_encode($registroCoordinador["descripcionZonal"])).")"."</option>";
			 	
			 	}

			 	while($registro = $resultado->fetch()) {

			 		$listas.="<option value='".$registro["id_usuario"]."'>".utf8_decode(utf8_encode($registro["nombreCompleto"])." (".utf8_encode($registro["descripcionZonal"])).")"."</option>";
			 	

			 	}

			 	return $listas; 

 			}else if($indicador==35){

				$conexionEstablecida->exec("set names utf8");

 				$query="SELECT a.id_usuario,REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(CONCAT_WS(' ',a.nombre,a.apellido), 'Ã¡', 'á'),'Ã©','é'),'Ã­','í'),'Ã³','ó'),'Ãº','ú'),'Ã‰','É'),'ÃŒ','Í'),'Ã“','Ó'),'Ãš','Ú'),'Ã±','ñ'),'Ã‘','Ñ'),'&#039;',' ` '),'Ã','Á'),'',' '),'Ã','Á'),'SI','SI'),'â€œ',''),'â€',''),'Á²','ó') AS nombreCompleto, CONCAT_WS('-',c.descripcionZonal,d.nombre) AS descripcionZonal,b.id_rol,a.fisicamenteEstructura FROM th_usuario AS a INNER JOIN th_usuario_roles AS b ON a.id_usuario=b.id_usuario INNER JOIN th_zonal AS c ON c.id_Zonal=a.zonal INNER JOIN th_roles AS d ON d.id_rol=b.id_rol  WHERE a.estadoUsuario='A' AND (a.zonal=1 AND a.PersonaACargo='$idUsuario') AND b.id_rol!='3' AND a.fisicamenteEstructura='15' AND a.estadoUsuario='A' ORDER BY b.id_rol,a.zonal;";

			 	$resultado = $conexionEstablecida->query($query);


 				$queryCoordinador="SELECT a.id_usuario,REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(CONCAT_WS(' ',a.nombre,a.apellido), 'Ã¡', 'á'),'Ã©','é'),'Ã­','í'),'Ã³','ó'),'Ãº','ú'),'Ã‰','É'),'ÃŒ','Í'),'Ã“','Ó'),'Ãš','Ú'),'Ã±','ñ'),'Ã‘','Ñ'),'&#039;',' ` '),'Ã','Á'),'',' '),'Ã','Á'),'SI','SI'),'â€œ',''),'â€',''),'Á²','ó') AS nombreCompleto, CONCAT_WS('-',c.descripcionZonal,d.nombre) AS descripcionZonal,b.id_rol,a.fisicamenteEstructura FROM th_usuario AS a INNER JOIN th_usuario_roles AS b ON a.id_usuario=b.id_usuario INNER JOIN th_zonal AS c ON c.id_Zonal=a.zonal INNER JOIN th_roles AS d ON d.id_rol=b.id_rol WHERE a.estadoUsuario='A' AND b.id_rol='4'  AND a.fisicamenteEstructura='3';";

			 	$resultadoCoordinador = $conexionEstablecida->query($queryCoordinador);




 				$queryCoordinador__zonales="SELECT a.id_usuario,REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(CONCAT_WS(' ',a.nombre,a.apellido), 'Ã¡', 'á'),'Ã©','é'),'Ã­','í'),'Ã³','ó'),'Ãº','ú'),'Ã‰','É'),'ÃŒ','Í'),'Ã“','Ó'),'Ãš','Ú'),'Ã±','ñ'),'Ã‘','Ñ'),'&#039;',' ` '),'Ã','Á'),'',' '),'Ã','Á'),'SI','SI'),'â€œ',''),'â€',''),'Á²','ó') AS nombreCompleto, CONCAT_WS('-',c.descripcionZonal,d.nombre) AS descripcionZonal,b.id_rol,a.fisicamenteEstructura FROM th_usuario AS a INNER JOIN th_usuario_roles AS b ON a.id_usuario=b.id_usuario INNER JOIN th_zonal AS c ON c.id_Zonal=a.zonal INNER JOIN th_roles AS d ON d.id_rol=b.id_rol WHERE a.estadoUsuario='A' AND b.id_rol='4' AND a.zonal>1 ORDER BY a.zonal;";

			 	$resultadoCoordinador__zonales = $conexionEstablecida->query($queryCoordinador__zonales);

			 	$listas="<option value=''>--Seleccione--</option>";

			 	while($registroCoordinador = $resultadoCoordinador->fetch()) {

			 		$listas.="<option value='".$registroCoordinador["id_usuario"]."'>".utf8_decode(utf8_encode($registroCoordinador["nombreCompleto"])." (".utf8_encode($registroCoordinador["descripcionZonal"])).")"."</option>";
			 	
			 	}

			 	while($registro = $resultado->fetch()) {

			 		$listas.="<option value='".$registro["id_usuario"]."'>".utf8_decode(utf8_encode($registro["nombreCompleto"])." (".utf8_encode($registro["descripcionZonal"])).")"."</option>";
			 	

			 	}

			 	while($registro__zonales = $resultadoCoordinador__zonales->fetch()) {

			 		$listas.="<option value='".$registro__zonales["id_usuario"]."'>".utf8_decode(utf8_encode($registro__zonales["nombreCompleto"])." (".utf8_encode($registro__zonales["descripcionZonal"])).")"."</option>";
			 	

			 	}



			 	return $listas; 

 			}else if($indicador==36){

				$conexionEstablecida->exec("set names utf8");

 				$query="SELECT a.id_usuario,REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(CONCAT_WS(' ',a.nombre,a.apellido), 'Ã¡', 'á'),'Ã©','é'),'Ã­','í'),'Ã³','ó'),'Ãº','ú'),'Ã‰','É'),'ÃŒ','Í'),'Ã“','Ó'),'Ãš','Ú'),'Ã±','ñ'),'Ã‘','Ñ'),'&#039;',' ` '),'Ã','Á'),'',' '),'Ã','Á'),'SI','SI'),'â€œ',''),'â€',''),'Á²','ó') AS nombreCompleto, CONCAT_WS('-',c.descripcionZonal,d.nombre) AS descripcionZonal,b.id_rol,a.fisicamenteEstructura FROM th_usuario AS a INNER JOIN th_usuario_roles AS b ON a.id_usuario=b.id_usuario INNER JOIN th_zonal AS c ON c.id_Zonal=a.zonal INNER JOIN th_roles AS d ON d.id_rol=b.id_rol  WHERE a.estadoUsuario='A' AND (a.zonal=1 AND a.PersonaACargo='$idUsuario') AND b.id_rol!='3' AND a.fisicamenteEstructura='7' AND a.estadoUsuario='A' ORDER BY b.id_rol,a.zonal;";

			 	$resultado = $conexionEstablecida->query($query);


 				$queryCoordinador="SELECT a.id_usuario,REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(CONCAT_WS(' ',a.nombre,a.apellido), 'Ã¡', 'á'),'Ã©','é'),'Ã­','í'),'Ã³','ó'),'Ãº','ú'),'Ã‰','É'),'ÃŒ','Í'),'Ã“','Ó'),'Ãš','Ú'),'Ã±','ñ'),'Ã‘','Ñ'),'&#039;',' ` '),'Ã','Á'),'',' '),'Ã','Á'),'SI','SI'),'â€œ',''),'â€',''),'Á²','ó') AS nombreCompleto, CONCAT_WS('-',c.descripcionZonal,d.nombre) AS descripcionZonal,b.id_rol,a.fisicamenteEstructura FROM th_usuario AS a INNER JOIN th_usuario_roles AS b ON a.id_usuario=b.id_usuario INNER JOIN th_zonal AS c ON c.id_Zonal=a.zonal INNER JOIN th_roles AS d ON d.id_rol=b.id_rol WHERE a.estadoUsuario='A' AND b.id_rol='4'  AND a.fisicamenteEstructura='3';";

			 	$resultadoCoordinador = $conexionEstablecida->query($queryCoordinador);




 				$queryCoordinador__zonales="SELECT a.id_usuario,REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(CONCAT_WS(' ',a.nombre,a.apellido), 'Ã¡', 'á'),'Ã©','é'),'Ã­','í'),'Ã³','ó'),'Ãº','ú'),'Ã‰','É'),'ÃŒ','Í'),'Ã“','Ó'),'Ãš','Ú'),'Ã±','ñ'),'Ã‘','Ñ'),'&#039;',' ` '),'Ã','Á'),'',' '),'Ã','Á'),'SI','SI'),'â€œ',''),'â€',''),'Á²','ó') AS nombreCompleto, CONCAT_WS('-',c.descripcionZonal,d.nombre) AS descripcionZonal,b.id_rol,a.fisicamenteEstructura FROM th_usuario AS a INNER JOIN th_usuario_roles AS b ON a.id_usuario=b.id_usuario INNER JOIN th_zonal AS c ON c.id_Zonal=a.zonal INNER JOIN th_roles AS d ON d.id_rol=b.id_rol WHERE a.estadoUsuario='A' AND b.id_rol='4' AND a.zonal>1 ORDER BY a.zonal;";

			 	$resultadoCoordinador__zonales = $conexionEstablecida->query($queryCoordinador__zonales);


			 	$listas="<option value=''>--Seleccione--</option>";

			 	while($registroCoordinador = $resultadoCoordinador->fetch()) {

			 		$listas.="<option value='".$registroCoordinador["id_usuario"]."'>".utf8_decode(utf8_encode($registroCoordinador["nombreCompleto"])." (".utf8_encode($registroCoordinador["descripcionZonal"])).")"."</option>";
			 	
			 	}

			 	while($registro = $resultado->fetch()) {

			 		$listas.="<option value='".$registro["id_usuario"]."'>".utf8_decode(utf8_encode($registro["nombreCompleto"])." (".utf8_encode($registro["descripcionZonal"])).")"."</option>";
			 	

			 	}

			 	while($registro__zonales = $resultadoCoordinador__zonales->fetch()) {

			 		$listas.="<option value='".$registro__zonales["id_usuario"]."'>".utf8_decode(utf8_encode($registro__zonales["nombreCompleto"])." (".utf8_encode($registro__zonales["descripcionZonal"])).")"."</option>";
			 	

			 	}


			 	return $listas; 

 			}else if($indicador==37){

				$conexionEstablecida->exec("set names utf8");

 				$query="SELECT a.id_usuario,REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(CONCAT_WS(' ',a.nombre,a.apellido), 'Ã¡', 'á'),'Ã©','é'),'Ã­','í'),'Ã³','ó'),'Ãº','ú'),'Ã‰','É'),'ÃŒ','Í'),'Ã“','Ó'),'Ãš','Ú'),'Ã±','ñ'),'Ã‘','Ñ'),'&#039;',' ` '),'Ã','Á'),'',' '),'Ã','Á'),'SI','SI'),'â€œ',''),'â€',''),'Á²','ó') AS nombreCompleto, CONCAT_WS('-',c.descripcionZonal,d.nombre) AS descripcionZonal,b.id_rol,a.fisicamenteEstructura FROM th_usuario AS a INNER JOIN th_usuario_roles AS b ON a.id_usuario=b.id_usuario INNER JOIN th_zonal AS c ON c.id_Zonal=a.zonal INNER JOIN th_roles AS d ON d.id_rol=b.id_rol  WHERE a.estadoUsuario='A' AND (a.zonal=1 AND a.PersonaACargo='$idUsuario') AND b.id_rol!='3' AND a.fisicamenteEstructura='5' AND a.estadoUsuario='A' ORDER BY b.id_rol,a.zonal;";

			 	$resultado = $conexionEstablecida->query($query);


 				$queryCoordinador="SELECT a.id_usuario,REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(CONCAT_WS(' ',a.nombre,a.apellido), 'Ã¡', 'á'),'Ã©','é'),'Ã­','í'),'Ã³','ó'),'Ãº','ú'),'Ã‰','É'),'ÃŒ','Í'),'Ã“','Ó'),'Ãš','Ú'),'Ã±','ñ'),'Ã‘','Ñ'),'&#039;',' ` '),'Ã','Á'),'',' '),'Ã','Á'),'SI','SI'),'â€œ',''),'â€',''),'Á²','ó') AS nombreCompleto, CONCAT_WS('-',c.descripcionZonal,d.nombre) AS descripcionZonal,b.id_rol,a.fisicamenteEstructura FROM th_usuario AS a INNER JOIN th_usuario_roles AS b ON a.id_usuario=b.id_usuario INNER JOIN th_zonal AS c ON c.id_Zonal=a.zonal INNER JOIN th_roles AS d ON d.id_rol=b.id_rol WHERE a.estadoUsuario='A' AND b.id_rol='4'  AND a.fisicamenteEstructura='3';";

			 	$resultadoCoordinador = $conexionEstablecida->query($queryCoordinador);

			 	$listas="<option value=''>--Seleccione--</option>";

			 	while($registroCoordinador = $resultadoCoordinador->fetch()) {

			 		$listas.="<option value='".$registroCoordinador["id_usuario"]."'>".utf8_decode(utf8_encode($registroCoordinador["nombreCompleto"])." (".utf8_encode($registroCoordinador["descripcionZonal"])).")"."</option>";
			 	
			 	}

			 	while($registro = $resultado->fetch()) {

			 		$listas.="<option value='".$registro["id_usuario"]."'>".utf8_decode(utf8_encode($registro["nombreCompleto"])." (".utf8_encode($registro["descripcionZonal"])).")"."</option>";
			 	

			 	}

			 	return $listas; 

 			}else if($indicador==38){

 				$conexionEstablecida->exec("set names utf8");


 				$query="SELECT a.id_usuario,CONCAT_WS(' ',a.nombre,a.apellido) AS nombreCompleto, CONCAT_WS('-',c.descripcionZonal,d.nombre) AS descripcionZonal,b.id_rol,a.fisicamenteEstructura FROM th_usuario AS a INNER JOIN th_usuario_roles AS b ON a.id_usuario=b.id_usuario INNER JOIN th_zonal AS c ON c.id_Zonal=a.zonal INNER JOIN th_roles AS d ON d.id_rol=b.id_rol INNER JOIN th_puestoinstitucional AS e ON e.id_PuestoInstitucional=a.puestoInstitucional WHERE a.estadoUsuario='A' AND a.PersonaACargo='$idUsuario' AND a.estadoUsuario='A' ORDER BY c.id_Zonal;";


			 	$resultado = $conexionEstablecida->query($query);

			 	$listas="<option value=''>--Seleccione--</option>";


			 	while($registro = $resultado->fetch()) {


			 		$listas.="<option value='".$registro["id_usuario"]."'>".utf8_decode(utf8_encode($registro["nombreCompleto"])." (".utf8_encode($registro["descripcionZonal"])).")"."</option>";
			 	

			 	}

			 	return $listas; 

 			}else if($indicador==39){


 				$conexionEstablecida->exec("set names utf8");


 				$query="SELECT a.id_usuario,CONCAT_WS(' ',a.nombre,a.apellido) AS nombreCompleto, CONCAT_WS('-',c.descripcionZonal,d.nombre) AS descripcionZonal,b.id_rol,a.fisicamenteEstructura FROM th_usuario AS a INNER JOIN th_usuario_roles AS b ON a.id_usuario=b.id_usuario INNER JOIN th_zonal AS c ON c.id_Zonal=a.zonal INNER JOIN th_roles AS d ON d.id_rol=b.id_rol INNER JOIN th_puestoinstitucional AS e ON e.id_PuestoInstitucional=a.puestoInstitucional WHERE a.estadoUsuario='A' AND a.PersonaACargo='$idUsuario' AND a.estadoUsuario='A' AND a.fisicamenteEstructura='23' ORDER BY c.id_Zonal;";


			 	$resultado = $conexionEstablecida->query($query);

			 	$listas="<option value=''>--Seleccione--</option>";


			 	while($registro = $resultado->fetch()) {


			 		$listas.="<option value='".$registro["id_usuario"]."'>".utf8_decode(utf8_encode($registro["nombreCompleto"])." (".utf8_encode($registro["descripcionZonal"])).")"."</option>";
			 	

			 	}

			 	return $listas; 

 			}else if($indicador==40){


 				$conexionEstablecida->exec("set names utf8");


 				$query="SELECT a.id_usuario,CONCAT_WS(' ',a.nombre,a.apellido) AS nombreCompleto, CONCAT_WS('-',c.descripcionZonal,d.nombre) AS descripcionZonal,b.id_rol,a.fisicamenteEstructura FROM th_usuario AS a INNER JOIN th_usuario_roles AS b ON a.id_usuario=b.id_usuario INNER JOIN th_zonal AS c ON c.id_Zonal=a.zonal INNER JOIN th_roles AS d ON d.id_rol=b.id_rol INNER JOIN th_puestoinstitucional AS e ON e.id_PuestoInstitucional=a.puestoInstitucional WHERE a.estadoUsuario='A' AND a.PersonaACargo='$idUsuario' AND a.estadoUsuario='A' AND a.fisicamenteEstructura='23' ORDER BY c.id_Zonal;";


			 	$resultado = $conexionEstablecida->query($query);



 				$queryCoordinador__zonales="SELECT a.id_usuario,REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(CONCAT_WS(' ',a.nombre,a.apellido), 'Ã¡', 'á'),'Ã©','é'),'Ã­','í'),'Ã³','ó'),'Ãº','ú'),'Ã‰','É'),'ÃŒ','Í'),'Ã“','Ó'),'Ãš','Ú'),'Ã±','ñ'),'Ã‘','Ñ'),'&#039;',' ` '),'Ã','Á'),'',' '),'Ã','Á'),'SI','SI'),'â€œ',''),'â€',''),'Á²','ó') AS nombreCompleto, CONCAT_WS('-',c.descripcionZonal,d.nombre) AS descripcionZonal,b.id_rol,a.fisicamenteEstructura FROM th_usuario AS a INNER JOIN th_usuario_roles AS b ON a.id_usuario=b.id_usuario INNER JOIN th_zonal AS c ON c.id_Zonal=a.zonal INNER JOIN th_roles AS d ON d.id_rol=b.id_rol WHERE a.estadoUsuario='A' AND b.id_rol='4' AND a.zonal>1 ORDER BY a.zonal;";

			 	$resultadoCoordinador__zonales = $conexionEstablecida->query($queryCoordinador__zonales);


			 	$listas="<option value='' class='text-center'>--Seleccione--</option>";

			 	$listas.=" <optgroup label = 'FUNCIONARIOS QUE PERTENECEN A LA DIRECCIÓN ADMINISTRATIVA' class='text-center'>";


			 	while($registro = $resultado->fetch()) {


			 		$listas.="<option value='".$registro["id_usuario"]."'>".utf8_decode(utf8_encode($registro["nombreCompleto"])." (".utf8_encode($registro["descripcionZonal"])).")"."</option>";
			 	

			 	}

			 	$listas.="</optgroup>";

			 	$listas.=" <optgroup label = 'COORDINACIONES ZONALES' class='text-center'>";

			 	while($registro__zonales = $resultadoCoordinador__zonales->fetch()) {

			 		$listas.="<option value='".$registro__zonales["id_usuario"]."'>".utf8_decode(utf8_encode($registro__zonales["nombreCompleto"])." (".utf8_encode($registro__zonales["descripcionZonal"])).")"."</option>";
			 	

			 	}

			 	$listas.="</optgroup>";			 	

			 	return $listas; 

 			}else if($indicador==41){

 				$query="SELECT a.id_usuario,CONCAT_WS(' ',a.nombre,a.apellido) AS nombreCompleto, CONCAT_WS('-',c.descripcionZonal,d.nombre) AS descripcionZonal,b.id_rol,a.fisicamenteEstructura FROM th_usuario AS a INNER JOIN th_usuario_roles AS b ON a.id_usuario=b.id_usuario INNER JOIN th_zonal AS c ON c.id_Zonal=a.zonal INNER JOIN th_roles AS d ON d.id_rol=b.id_rol INNER JOIN th_puestoinstitucional AS e ON e.id_PuestoInstitucional=a.puestoInstitucional WHERE a.estadoUsuario='A' AND a.PersonaACargo='$idUsuario' AND a.estadoUsuario='A' ORDER BY c.id_Zonal;";
			 	$resultado = $conexionEstablecida->query($query);



 				$query__DOS="SELECT a.id_usuario,CONCAT_WS(' ',a.nombre,a.apellido) AS nombreCompleto, CONCAT_WS('-',c.descripcionZonal,d.nombre) AS descripcionZonal,b.id_rol,a.fisicamenteEstructura FROM th_usuario AS a INNER JOIN th_usuario_roles AS b ON a.id_usuario=b.id_usuario INNER JOIN th_zonal AS c ON c.id_Zonal=a.zonal INNER JOIN th_roles AS d ON d.id_rol=b.id_rol INNER JOIN th_puestoinstitucional AS e ON e.id_PuestoInstitucional=a.puestoInstitucional WHERE b.id_rol='2' AND a.fisicamenteEstructura='23' ORDER BY a.id_usuario DESC LIMIT 1";
			 	$resultado__DOS = $conexionEstablecida->query($query__DOS);



			 	$listas="<option value='' class='text-center'>--Seleccione--</option>";

			 	$listas.=" <optgroup label = 'DIRECTOR FINANCIERO (Seleccionar en caso de querer devolver el trámite)' class='text-center'>";

			 	while($registro__DOS = $resultado__DOS->fetch()) {


			 		$listas.="<option value='".$registro__DOS["id_usuario"]."'>".utf8_decode(utf8_encode($registro__DOS["nombreCompleto"])." (".utf8_encode($registro__DOS["descripcionZonal"])).")"."</option>";
			 	

			 	}

			 	$listas.=" <optgroup label = 'FUNCIONARIOS QUE PERTENECEN A LA COORDINACIÓN' class='text-center'>";

			 	while($registro = $resultado->fetch()) {


			 		$listas.="<option value='".$registro["id_usuario"]."'>".utf8_encode($registro["nombreCompleto"])." (".utf8_encode($registro["descripcionZonal"]).")"."</option>";
			 	

			 	}

			 	return $listas; 


 			}else if($indicador==42){


 				$query="SELECT PersonaACargo FROM th_usuario WHERE id_usuario='$idUsuario';";
			 	$resultado = $conexionEstablecida->query($query);

			 	while($registro = $resultado->fetch()) {

			 		$idJefe=$registro["PersonaACargo"];
			 	
			 	}			 	


 				$query__DOS="SELECT a.id_usuario,CONCAT_WS(' ',a.nombre,a.apellido) AS nombreCompleto, CONCAT_WS('-',c.descripcionZonal,d.nombre) AS descripcionZonal,b.id_rol,a.fisicamenteEstructura FROM th_usuario AS a INNER JOIN th_usuario_roles AS b ON a.id_usuario=b.id_usuario INNER JOIN th_zonal AS c ON c.id_Zonal=a.zonal INNER JOIN th_roles AS d ON d.id_rol=b.id_rol INNER JOIN th_puestoinstitucional AS e ON e.id_PuestoInstitucional=a.puestoInstitucional WHERE a.id_usuario='$idJefe'";
			 	$resultado__DOS = $conexionEstablecida->query($query__DOS);


			 	$listas="<option value='' class='text-center'>--Seleccione--</option>";

			 	$listas.=" <optgroup label = 'SUPERIOR INMEDIATO (Seleccionar en caso de querer devolver el trámite)' class='text-center'>";

			 	while($registro__DOS = $resultado__DOS->fetch()) {


			 		$listas.="<option value='".$registro__DOS["id_usuario"]."'>".utf8_decode(utf8_encode($registro__DOS["nombreCompleto"])." (".utf8_encode($registro__DOS["descripcionZonal"])).")"."</option>";
			 	

			 	}

			 	return $listas; 


 			}else if($indicador==43){


 				$query="SELECT b.idActividades,b.nombreActividades,a.idProgramacionFinanciera FROM poa_programacion_financiera AS a INNER JOIN poa_actividades AS b ON a.idActividad=b.idActividades WHERE a.idOrganismo='$idOrganismo' GROUP BY  a.idActividad;";
			 	$resultado = $conexionEstablecida->query($query);


			 	$listas="<option value='' class='text-center'>--Seleccione una actividad--</option>";


			 	while($registro = $resultado->fetch()) {


			 		$listas.="<option value='".$registro["idActividades"]."'>".$registro["nombreActividades"].""."</option>";
			 	

			 	}

			 	return $listas; 

 			}else if($indicador==44){


 				$query="SELECT c.idItem,c.nombreItem,a.idProgramacionFinanciera FROM poa_programacion_financiera AS a INNER JOIN poa_actividades AS b ON a.idActividad=b.idActividades INNER JOIN poa_item AS c ON c.idItem=a.idItem WHERE a.idOrganismo='$idOrganismo' AND idActividad='$idActividades';";
			 	$resultado = $conexionEstablecida->query($query);

			 	while($registro = $resultado->fetch()) {


			 		$listas.="<div class='d d-flex'><div class='col col-10'>".$registro["nombreItem"]."</div><div class='col col-2'><input type='checkbox' class='check_modificaciones text-center' attr='".$registro["idProgramacionFinanciera"]."' nombreItems='".$registro["nombreItem"]."'></div></div>";
			 	

			 	}

			 	return $listas; 

 			}else if($indicador==45){


 				$query="SELECT id_FisicamenteEstructura,REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(descripcionFisicamenteEstructura, 'Ã¡', 'á'),'Ã©','é'),'Ã­','í'),'Ã³','ó'),'Ãº','ú'),'Ã‰','É'),'ÃŒ','Í'),'Ã“','Ó'),'Ãš','Ú'),'Ã±','ñ'),'Ã‘','Ñ'),'&#039;',' ` '),'Ã','Á'),'',' '),'Ã','Á'),'SI','SI'),'â€œ',''),'â€',''),'Á²','ó') AS descripcionFisicamenteEstructura  FROM th_fisicamenteestructura WHERE estado='A' ORDER BY descripcionFisicamenteEstructura ASC;";
			 	$resultado = $conexionEstablecida->query($query);

			 	$listas="<option value='' class='text-center'>--Seleccione un área responsable--</option>";

			 	while($registro = $resultado->fetch()) {

			 		$listas.="<option value='".$registro["id_FisicamenteEstructura"]."'>".utf8_decode($registro["descripcionFisicamenteEstructura"])."</option>";
			 	

			 	}

			 	return $listas; 

 			}else if($indicador==46){

 				if ($idFisicamente==1 || $idFisicamente==2 || $idFisicamente==3 || $idFisicamente==27 || $idFisicamente==28 || $idFisicamente==29 || $idFisicamente==30 || $idFisicamente==31 || $idFisicamente==32 || $idFisicamente==33) {
 					
 					$query="SELECT a.id_usuario,CONCAT_WS(' ',a.nombre,REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(a.apellido, 'Ã¡', 'á'),'Ã©','é'),'Ã­','í'),'Ã³','ó'),'Ãº','ú'),'Ã‰','É'),'ÃŒ','Í'),'Ã“','Ó'),'Ãš','Ú'),'Ã±','ñ'),'Ã‘','Ñ'),'&#039;',' ` '),'Ã','Á'),'',' '),'Ã','Á'),'SI','SI'),'â€œ',''),'â€',''),'Á²','ó')) AS nombreCompleto FROM th_usuario AS a INNER JOIN th_usuario_roles AS b ON a.id_usuario=b.id_usuario WHERE b.id_rol='4' AND a.fisicamenteEstructura='$idFisicamente' AND a.estadoUsuario='A' LIMIT 1;";

 				}else if($idFisicamente==5){

 					$query="SELECT a.id_usuario,CONCAT_WS(' ',a.nombre,REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(a.apellido, 'Ã¡', 'á'),'Ã©','é'),'Ã­','í'),'Ã³','ó'),'Ãº','ú'),'Ã‰','É'),'ÃŒ','Í'),'Ã“','Ó'),'Ãš','Ú'),'Ã±','ñ'),'Ã‘','Ñ'),'&#039;',' ` '),'Ã','Á'),'',' '),'Ã','Á'),'SI','SI'),'â€œ',''),'â€',''),'Á²','ó')) AS nombreCompleto FROM th_usuario AS a INNER JOIN th_usuario_roles AS b ON a.id_usuario=b.id_usuario WHERE b.id_rol='5' AND a.fisicamenteEstructura='$idFisicamente' AND a.estadoUsuario='A' LIMIT 1;";

 				}else if ($idFisicamente==24 || $idFisicamente==25 || $idFisicamente==26) {
 					
 					$query="SELECT a.id_usuario,CONCAT_WS(' ',a.nombre,REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(a.apellido, 'Ã¡', 'á'),'Ã©','é'),'Ã­','í'),'Ã³','ó'),'Ãº','ú'),'Ã‰','É'),'ÃŒ','Í'),'Ã“','Ó'),'Ãš','Ú'),'Ã±','ñ'),'Ã‘','Ñ'),'&#039;',' ` '),'Ã','Á'),'',' '),'Ã','Á'),'SI','SI'),'â€œ',''),'â€',''),'Á²','ó')) AS nombreCompleto FROM th_usuario AS a INNER JOIN th_usuario_roles AS b ON a.id_usuario=b.id_usuario WHERE b.id_rol='7' AND a.fisicamenteEstructura='$idFisicamente' AND a.estadoUsuario='A' LIMIT 1;";

 				}else{

 					$query="SELECT a.id_usuario,CONCAT_WS(' ',a.nombre,REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(a.apellido, 'Ã¡', 'á'),'Ã©','é'),'Ã­','í'),'Ã³','ó'),'Ãº','ú'),'Ã‰','É'),'ÃŒ','Í'),'Ã“','Ó'),'Ãš','Ú'),'Ã±','ñ'),'Ã‘','Ñ'),'&#039;',' ` '),'Ã','Á'),'',' '),'Ã','Á'),'SI','SI'),'â€œ',''),'â€',''),'Á²','ó')) AS nombreCompleto FROM th_usuario AS a INNER JOIN th_usuario_roles AS b ON a.id_usuario=b.id_usuario WHERE b.id_rol='2' AND a.fisicamenteEstructura='$idFisicamente' AND a.estadoUsuario='A' LIMIT 1;";

 				}

			 	$resultado = $conexionEstablecida->query($query);

			 	while($registro = $resultado->fetch()) {

			 		$listas.="<option value='".$registro["id_usuario"]."'>".utf8_decode($registro["nombreCompleto"])."</option>";
			 	

			 	}

			 	return $listas; 

 			}else if($indicador==47){

 				if (empty($valoresAplicados)) {
 					$query="SELECT idProyectoPaid,proyecto__inversion FROM poa_paid_proyecto;";
 				}else{
 					$query="SELECT idProyectoPaid,proyecto__inversion FROM poa_paid_proyecto WHERE idProyectoPaid NOT IN($valoresAplicados);";
 				}

			 	$resultado = $conexionEstablecida->query($query);

			 	$listas="<option value='0' class='text-center'>--Seleccione un proyecto de inversión--</option>";

			 	while($registro = $resultado->fetch()) {

			 		$listas.="<option value='".$registro["idProyectoPaid"]."'>".utf8_decode($registro["proyecto__inversion"])."</option>";
			 	

			 	}


			 	return $listas; 

 			}else if($indicador==48){

 				$query="SELECT idOrganismo,nombreOrganismo FROM poa_organismo;";
			 	$resultado = $conexionEstablecida->query($query);

			 	$listas="<option value='' class='text-center'>--Seleccione nombre del organismo deportivo--</option>";

			 	while($registro = $resultado->fetch()) {

			 		$listas.="<option value='".$registro["idOrganismo"]."'>".utf8_decode($registro["nombreOrganismo"])."</option>";
			 	

			 	}


			 	return $listas; 

 			}

		}

	}


	echo lugar::lugarFuncion($indicador);

