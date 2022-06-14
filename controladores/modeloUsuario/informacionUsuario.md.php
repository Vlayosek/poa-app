<?php


class usuarioAcciones{


	public function getUrlDinamica($parametro1,$paraemtro2,$parametro3){

		$path = parse_url($paraemtro2, PHP_URL_PATH);

		$components = explode($parametro1, $path);

		$first_part = $components[1];

		if($first_part==$parametro3){
			return "active__menu";
		}else{
			return "noActive__menu";
		}

	}

	public function getUrlDinamicaUna($parametro1,$paraemtro2,$paraemtro3){

		$path = parse_url($paraemtro2, PHP_URL_PATH);

		$components = explode($parametro1, $path);

		$first_part = $components[1];

		if (in_array($first_part, $paraemtro3)) {

    		return "menu-open";

		}else{

			return "menu-openNo";

		}

	}

	public function getInformacionGeneral(){

		$idUsuario=$_SESSION["idUsuario"];
		$idRol=$_SESSION["idRol"];
		$tipo=$_SESSION["tipo"];

		$parametrosEnvio = array($idUsuario,$idRol,$tipo);

		return $parametrosEnvio;

	}



	public function getInformacionUsuarioPerfil($parametro1){

		$conexionRecuperada= new conexion();
 		$conexionEstablecida=$conexionRecuperada->cConexion();

		$query="SELECT CONCAT_WS(' ',nombre,apellido) AS nombreCompleto FROM poa_usuario WHERE idUsuario='$parametro1' LIMIT 1;";
		$resultado = $conexionEstablecida->query($query);

		while($registro = $resultado->fetch()) {

			$nombreCompleto=$registro['nombreCompleto'];
			
		}

		return $nombreCompleto;

	}	


	public function getInformacionGeneralFun($parametro1){

		$conexionRecuperada= new conexion();
 		$conexionEstablecida=$conexionRecuperada->cConexion();

 		$query = $conexionEstablecida->prepare("SELECT a.fisicamenteEstructura,a.email,a.zonal FROM th_usuario AS a INNER JOIN th_usuario_roles AS b ON a.id_usuario=b.id_usuario WHERE a.id_usuario='$parametro1';");
		$query->execute();

		$resultado = $query->fetchAll(\PDO::FETCH_ASSOC);

		return $resultado;


	}	

	public function getInformacionEmail($parametro1){

		$conexionRecuperada= new conexion();
 		$conexionEstablecida=$conexionRecuperada->cConexion();

		$query="SELECT email FROM poa_usuario WHERE idUsuario='$parametro1' LIMIT 1;";
		$resultado = $conexionEstablecida->query($query);

		while($registro = $resultado->fetch()) {

			$email=$registro['email'];
			
		}

		return $email;

	}


	public function getInformacionOrganismoDeportivo($parametro1){

		$conexionRecuperada= new conexion();
 		$conexionEstablecida=$conexionRecuperada->cConexion();

		$query="SELECT b.nombreOrganismo FROM poa_usuario AS a INNER JOIN poa_organismo AS b ON a.idUsuario=b.idUsuario WHERE a.idUsuario='$parametro1' LIMIT 1;";
		$resultado = $conexionEstablecida->query($query);

		while($registro = $resultado->fetch()) {

			$nombreOrganismo=$registro['nombreOrganismo'];
			
		}

		return $nombreOrganismo;

	}	

	public function getInformacionCompletaOrganismoDeportivo(){

		$conexionRecuperada= new conexion();
 		$conexionEstablecida=$conexionRecuperada->cConexion();

 		$idUsuario=$_SESSION["idUsuario"];


 		$query = $conexionEstablecida->prepare("SELECT b.ruc,b.nombreOrganismo,b.correo,b.direccion,b.referenciaDireccion,(SELECT a1.nombreProvincia FROM in_md_provincias AS a1 WHERE a1.idProvincia=b.idProvincia) AS nombreProvincia,(SELECT a2.nombreCanton FROM in_md_canton AS a2 WHERE a2.idCanton=b.idCanton) AS nombreCanton,(SELECT a3.nombreParroquia FROM in_md_parroquia AS a3 WHERE a3.idParroquia=b.idParroquia) AS nombreParroquia,b.idProvincia,b.idCanton,b.idParroquia,b.barrioPoa,c.numeroDeAcuerdo,c.documento,c.fecha AS fechaAcuerdo,b.idOrganismo,a.cedula,a.nombre AS nombrePresidente,a.apellido AS apellidoPresidente, a.sexo AS sexoPresidente,a.fechaNacimiento AS fechaPresidente,a.email AS emailPresidente,a.telefono AS celularPresidente,b.cedulaResponsable,b.nombreResponsablePoa,b.correoResponsablePoa,b.telefonoOficina,a.idUsuario,d.nombreDocumentoDeAprobacion,b.activado,b.periodo,(SELECT a1.idInversion FROM poa_inversion AS a1 INNER JOIN poa_inversion_usuario AS a2 WHERE a1.idInversion=a2.idInversion AND a2.idOrganismo=b.idOrganismo ORDER BY a1.idInversion DESC LIMIT 1) AS idInversion,f.idTipoOrganismo FROM poa_usuario AS a INNER JOIN poa_organismo AS b ON a.idUsuario=b.idUsuario INNER JOIN poa_organismo_acuerdo_ministerial AS c ON c.idOrganismo=b.idOrganismo LEFT JOIN poa_organismo_documento_aprobacion AS d ON d.idOrganismo=b.idOrganismo LEFT JOIN poa_competencia_organismo_competencia AS e ON e.idOrganismo=b.idOrganismo LEFT JOIN poa_tipo_organismo AS f ON f.idTipoOrganismo=e.idTipoOrganismo WHERE a.idUsuario='$idUsuario' GROUP BY f.idTipoOrganismo ORDER BY f.idTipoOrganismo DESC LIMIT 1;");
		$query->execute();

		$resultado = $query->fetchAll(\PDO::FETCH_ASSOC);

		return $resultado;

	}	

	public function getObservacionesAprobacionUsuarios($parametro1){

		$conexionRecuperada= new conexion();
 		$conexionEstablecida=$conexionRecuperada->cConexion();

 		$query = $conexionEstablecida->prepare("SELECT idObservaciones,observacion,tipoObservacion FROM poa_observaciones WHERE idOrganismo='$parametro1' AND tipoObservacion='aprobacionUsuario' AND estado='A' ORDER BY idObservaciones DESC LIMIT 1;");
		$query->execute();

		$resultado = $query->fetchAll(\PDO::FETCH_ASSOC);

		return $resultado;

	}	

	public function getObtenerInformacionGeneral($parametro1){

		$conexionRecuperada= new conexion();
 		$conexionEstablecida=$conexionRecuperada->cConexion();

 		$query = $conexionEstablecida->prepare($parametro1);
		$query->execute();

		$resultado = $query->fetchAll(\PDO::FETCH_ASSOC);

		return $resultado;

	}	

	public function getRestar($parametro1,$parametro2){

		$restar=0;

		$restar=round(floatval($parametro1) - floatval($parametro2),2);

		return $restar;

	}	

}