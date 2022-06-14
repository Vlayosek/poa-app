<?php $objetoInformacion= new usuarioAcciones();?>

<?php $informacionObjeto=$objetoInformacion->getInformacionGeneral();?>

<?php $zonalVariable=$objetoInformacion->getObtenerInformacionGeneral("SELECT zonal,fisicamenteEstructura FROM th_usuario WHERE id_usuario='$informacionObjeto[0]';");?>


<input type="hidden" id="fechaPrincipalJ" name="fechaPrincipalJ" />

<input type="hidden" id="zonalUsuario" name="zonalUsuario" value="<?=$zonalVariable[0][zonal]?>" />

<input type="hidden" id="idRolAd" name="idRolAd" value="<?=$informacionObjeto[1]?>" />

<input type="hidden" id="fisicamenteE" name="fisicamenteE" value="<?=$zonalVariable[0][fisicamenteEstructura]?>" />

<?php if ( $informacionObjeto[1]==1): ?>

<li class="nav-item <?=$objetoInformacion->getUrlDinamicaUna('poa2/',$_SERVER['REQUEST_URI'],array("administracion","administracionGeneral","administracionUsuarios"));?>">
	
<a href="#" class="nav-link">
	<p>
    	Administración
    	<i class="fas fa-angle-left right"></i>
    	<span class="badge badge-info right"></span>
	</p>
</a>

<ul class="nav nav-treeview">

	<li class="nav-item">

		<a href="administracionGeneral" class="nav-link <?=$objetoInformacion->getUrlDinamica('poa2/',$_SERVER['REQUEST_URI'],'administracionGeneral');?>">
			<p>Administración general</p>
		</a>

	</li>

</ul>

</li>

<?php endif ?>

</hr>

	<li class="text-center">
		<div style="color:white; font-weight: bold; padding-top: .5em; padding-bottom: .5em;">
			Asignación presupuestaria 
		</div>
	</li>

</hr>


<li class="nav-item <?=$objetoInformacion->getUrlDinamicaUna('poa2/',$_SERVER['REQUEST_URI'],array("asignacionPresupuesto","modificacionPresupuestaria"));?>">

	<a href="#" class="nav-link">

		<p>
	    	POA
	    	<i class="fas fa-angle-left right"></i>
	    	<span class="badge badge-info right"></span>
		</p>

	</a>

	<ul class="nav nav-treeview">


		<li class="nav-item">

			<a href="asignacionPresupuesto" class="nav-link <?= $objetoInformacion->getUrlDinamica('poa2/',$_SERVER['REQUEST_URI'],'asignacionPresupuesto');?>">

				<p>Asignar</p>

			</a>

		</li>

		<li class="nav-item">

			<a href="modificacionPresupuestaria" class="nav-link <?= $objetoInformacion->getUrlDinamica('poa2/',$_SERVER['REQUEST_URI'],'modificacionPresupuestaria');?>">

				<p>Modificar</p>

			</a>

		</li>

	</ul>

</li>

<li class="nav-item <?=$objetoInformacion->getUrlDinamicaUna('poa2/',$_SERVER['REQUEST_URI'],array("paidproyectos","paidproyectosasignacion","paidasignacionreporterias"));?>">

	<a href="#" class="nav-link">

		<p>
	    	PAID
	    	<i class="fas fa-angle-left right"></i>
	    	<span class="badge badge-info right"></span>
		</p>

	</a>

	<ul class="nav nav-treeview">

		<li class="nav-item">

			<a href="paidproyectos" class="nav-link <?= $objetoInformacion->getUrlDinamica('poa2/',$_SERVER['REQUEST_URI'],'paidproyectos');?>">

				<p>Crear proyectos</p>

			</a>

		</li>

		<li class="nav-item">

			<a href="paidproyectosasignacion" class="nav-link <?= $objetoInformacion->getUrlDinamica('poa2/',$_SERVER['REQUEST_URI'],'paidproyectosasignacion');?>">

				<p>Asignar prespuesto</p>

			</a>

		</li>



		<li class="nav-item">

			<a href="paidasignacionreporterias" class="nav-link <?= $objetoInformacion->getUrlDinamica('poa2/',$_SERVER['REQUEST_URI'],'paidasignacionreporterias');?>">

				<p>Organismos paid</p>

			</a>

		</li>

	</ul>

</li>

<?php if ($informacionObjeto[1]==1 || $informacionObjeto[1]==2 || ($informacionObjeto[1]==3 && $zonalVariable[0][fisicamenteEstructura]==18)): ?>
	
<li class="nav-item">

<a href="poasGlobalesRecibidos" class="nav-link <?= $objetoInformacion->getUrlDinamica('poa2/',$_SERVER['REQUEST_URI'],'poasGlobalesRecibidos');?>">

	<p>Poas enviados</p>

</a>

</li>



<?php if ($informacionObjeto[1]==2): ?>
	
<li class="nav-item">

<a href="coordinadorRe" class="nav-link <?= $objetoInformacion->getUrlDinamica('poa2/',$_SERVER['REQUEST_URI'],'coordinadorRe');?>">

	<p>Poas recomendados</p>

</a>

</li>	

<?php endif ?>

<?php if ($informacionObjeto[1]==2): ?>

<li class="nav-item">

<a href="observadosP" class="nav-link <?= $objetoInformacion->getUrlDinamica('poa2/',$_SERVER['REQUEST_URI'],'observadosP');?>">

	<p>Poas Observados</p>

</a>

</li>

<?php endif ?>



<?php endif ?>


<li class="nav-item">

<a href="reporteriaFinal" class="nav-link <?= $objetoInformacion->getUrlDinamica('poa2/',$_SERVER['REQUEST_URI'],'reporteriaFinal');?>">

	<p>Trámites</p>

</a>

</li>



<li class="nav-item">

<a href="poaResolucionFinal" class="nav-link <?= $objetoInformacion->getUrlDinamica('poa2/',$_SERVER['REQUEST_URI'],'poaResolucionFinal');?>">

	<p>Poas gestionados</p>

</a>

</li>