<?php $objetoInformacion= new usuarioAcciones();?>

<?php $informacionObjeto=$objetoInformacion->getInformacionGeneral();?>

<?php $informacionFuncionario=$objetoInformacion->getInformacionGeneralFun($informacionObjeto[0]);?>

<input type="hidden" id="fechaPrincipalJ" name="fechaPrincipalJ" />

<input type="hidden" id="idUsuarioC" name="idUsuarioC" value="<?=$informacionObjeto[0]?>" />

<input type="hidden" id="idRolAd" name="idRolAd" value="<?=$informacionObjeto[1]?>" />

<input type="hidden" id="fisicamenteE" name="fisicamenteE" value="<?=$informacionFuncionario[0][fisicamenteEstructura]?>" />

<input type="hidden" id="emailZonales" name="emailZonales" value="<?=$informacionFuncionario[0][email]?>" />

<input type="hidden" id="zonalC" name="zonalC" value="<?=$informacionFuncionario[0][zonal]?>" />

<?php if ($informacionFuncionario[0][fisicamenteEstructura]=="27" || $informacionFuncionario[0][fisicamenteEstructura]=="28" || $informacionFuncionario[0][fisicamenteEstructura]=="29" || $informacionFuncionario[0][fisicamenteEstructura]=="30" || $informacionFuncionario[0][fisicamenteEstructura]=="31" || $informacionFuncionario[0][fisicamenteEstructura]=="32" || $informacionFuncionario[0][fisicamenteEstructura]=="33"): ?>

<li class="nav-item <?=$objetoInformacion->getUrlDinamicaUna('poa2/',$_SERVER['REQUEST_URI'],array("subsecretario","recomendadoZonalesSubses"));?>">

<a href="#" class="nav-link">
	<p>
    	Poas<br>(Coordinación de infraestructura)
    	<i class="fas fa-angle-left right"></i>
    	<span class="badge badge-info right"></span>
	</p>
</a>

<ul class="nav nav-treeview">
	
	<li class="nav-item">

		<a href="subsecretario" class="nav-link <?= $objetoInformacion->getUrlDinamica('poa2/',$_SERVER['REQUEST_URI'],'subsecretario');?>">

		<p>Poas enviados</p>

		</a>

	</li>

	<?php if ($informacionObjeto[1]==4): ?>
		
	<li class="nav-item">

		<a href="recomendadoZonalesSubses" class="nav-link <?= $objetoInformacion->getUrlDinamica('poa2/',$_SERVER['REQUEST_URI'],'recomendadoZonalesSubses');?>">

		<p>Poas recomendados</p>

		</a>

	</li>

	<?php endif ?>

</ul>

</li>

<li class="nav-item <?=$objetoInformacion->getUrlDinamicaUna('poa2/',$_SERVER['REQUEST_URI'],array("subecretariaFinanciero","recomendadoZonalesF"));?>">

<a href="#" class="nav-link">
	<p>
    	Poas<br>(Coordinación financiera)
    	<i class="fas fa-angle-left right"></i>
    	<span class="badge badge-info right"></span>
	</p>
</a>

<ul class="nav nav-treeview">
	
	<li class="nav-item">

		<a href="subecretariaFinanciero" class="nav-link <?= $objetoInformacion->getUrlDinamica('poa2/',$_SERVER['REQUEST_URI'],'subecretariaFinanciero');?>">

		<p>Poas enviados</p>

		</a>

	</li>

	<?php if ($informacionObjeto[1]==4): ?>
		
	<li class="nav-item">

		<a href="recomendadoZonalesF" class="nav-link <?= $objetoInformacion->getUrlDinamica('poa2/',$_SERVER['REQUEST_URI'],'recomendadoZonalesF');?>">

		<p>Poas recomendados</p>

		</a>

	</li>

	<?php endif ?>

</ul>

</li>



<li class="nav-item <?=$objetoInformacion->getUrlDinamicaUna('poa2/',$_SERVER['REQUEST_URI'],array("subsecretarioCoordina","recomendadosSV"));?>">

<a href="#" class="nav-link">
	<p>
    	Poas<br>(Subsecretaría)
    	<i class="fas fa-angle-left right"></i>
    	<span class="badge badge-info right"></span>
	</p>
</a>

<ul class="nav nav-treeview">
	
	<li class="nav-item">

		<a href="subsecretarioCoordina" class="nav-link <?= $objetoInformacion->getUrlDinamica('poa2/',$_SERVER['REQUEST_URI'],'subsecretarioCoordina');?>">

			<p>Poas enviados</p>

		</a>

	</li>

	<?php if ($informacionObjeto[1]==4): ?>

	<li class="nav-item">

		<a href="recomendadosSV" class="nav-link <?= $objetoInformacion->getUrlDinamica('poa2/',$_SERVER['REQUEST_URI'],'recomendadosSV');?>">

			<p>Poas recomendados</p>

		</a>

	</li>

	<?php endif ?>


</ul>

</li>



</hr>
	<li class="text-center">
		<div style="color:white; font-weight: bold; padding-top: .5em; padding-bottom: .5em;">
			Sección de transferencias
		</div>
	</li>
</hr>

<li class="nav-item">

	<a href="poasAprobadosf" class="nav-link <?= $objetoInformacion->getUrlDinamica('poa2/',$_SERVER['REQUEST_URI'],'poasAprobadosf');?>">

		<p>Recibidos</p>

	</a>

</li>

<li class="nav-item">

	<a href="rechazados" class="nav-link <?= $objetoInformacion->getUrlDinamica('poa2/',$_SERVER['REQUEST_URI'],'rechazados');?>">

		<p>Rechazados</p>

	</a>

</li>

<li class="nav-item">

	<a href="aprobadosFinan" class="nav-link <?= $objetoInformacion->getUrlDinamica('poa2/',$_SERVER['REQUEST_URI'],'aprobadosFinan');?>">

		<p>Aprobados</p>

	</a>

</li>

<?php else: ?>

<?php if ($informacionFuncionario[0][fisicamenteEstructura]!=9 && $informacionFuncionario[0][fisicamenteEstructura]!=23 && $informacionFuncionario[0][fisicamenteEstructura]!=20): ?>
	
<li class="nav-item">

<a href="subsecretario" class="nav-link <?= $objetoInformacion->getUrlDinamica('poa2/',$_SERVER['REQUEST_URI'],'subsecretario');?>">

	<p>Poas enviados</p>

</a>

</li>

<?php endif ?>
	

<?php if ($informacionObjeto[1]!=3 && $informacionObjeto[1]!=4 && $informacionFuncionario[0][fisicamenteEstructura]!=23 && $informacionFuncionario[0][fisicamenteEstructura]!=20): ?>
	
<li class="nav-item">

<a href="poasRecomendados" class="nav-link <?= $objetoInformacion->getUrlDinamica('poa2/',$_SERVER['REQUEST_URI'],'poasRecomendados');?>">

	<p>Poas recomendados</p>

</a>

</li>

<?php endif ?>

<?php if (($informacionObjeto[1]==2 || $informacionObjeto[1]==3) && $informacionFuncionario[0][fisicamenteEstructura]==23): ?>

</hr>
	<li class="text-center">
		<div style="color:white; font-weight: bold; padding-top: .5em; padding-bottom: .5em;">
			Sección de transferencias
		</div>
	</li>
</hr>

<li class="nav-item">

<a href="poasAprobadosf" class="nav-link <?= $objetoInformacion->getUrlDinamica('poa2/',$_SERVER['REQUEST_URI'],'poasAprobadosf');?>">

	<p>Recibidos</p>

</a>

</li>

<li class="nav-item">

	<a href="rechazados" class="nav-link <?= $objetoInformacion->getUrlDinamica('poa2/',$_SERVER['REQUEST_URI'],'rechazados');?>">

		<p>Rechazados</p>

	</a>

</li>

<li class="nav-item">

	<a href="aprobadosFinan" class="nav-link <?= $objetoInformacion->getUrlDinamica('poa2/',$_SERVER['REQUEST_URI'],'aprobadosFinan');?>">

		<p>Aprobados</p>

	</a>

</li>

<li class="nav-item">

<a href="suspencionAsignacion" class="nav-link <?= $objetoInformacion->getUrlDinamica('poa2/',$_SERVER['REQUEST_URI'],'suspencionAsignacion');?>">

	<p>Suspención de asignación</p>

</a>

</li>


<li class="nav-item">

<a href="soliTrans" class="nav-link <?= $objetoInformacion->getUrlDinamica('poa2/',$_SERVER['REQUEST_URI'],'soliTrans');?>">

	<p>Solicitudes de transparencia</p>

</a>

</li>

<?php if ($informacionObjeto[1]==2 && $informacionFuncionario[0][fisicamenteEstructura]==23): ?>

<li class="nav-item">

<a href="asignacionPoasRelativos" class="nav-link <?= $objetoInformacion->getUrlDinamica('poa2/',$_SERVER['REQUEST_URI'],'asignacionPoasRelativos');?>">

	<p>Organismos intervenidos</p>

</a>

</li>

<?php endif ?>

<?php endif ?>


<?php if ($informacionObjeto[1]==4 && $informacionFuncionario[0][fisicamenteEstructura]==2): ?>
	

<li class="nav-item <?=$objetoInformacion->getUrlDinamicaUna('poa2/',$_SERVER['REQUEST_URI'],array("recomiendaAdministrativo","recomiendaTalentoHumano"));?>">

<a href="#" class="nav-link">
	<p>
    	Poas recomendados
    	<i class="fas fa-angle-left right"></i>
    	<span class="badge badge-info right"></span>
	</p>
</a>

<ul class="nav nav-treeview">
	
	<li class="nav-item">

		<a href="recomiendaAdministrativo" class="nav-link <?= $objetoInformacion->getUrlDinamica('poa2/',$_SERVER['REQUEST_URI'],'recomiendaAdministrativo');?>">

			<p>Poas recomendados<br>administrativo</p>

		</a>

	</li>

	<li class="nav-item">

		<a href="recomiendaTalentoHumano" class="nav-link <?= $objetoInformacion->getUrlDinamica('poa2/',$_SERVER['REQUEST_URI'],'recomiendaTalentoHumano');?>">

			<p>Poas recomendados<br>talento humano</p>

		</a>

	</li>

</ul>

</li>




<?php endif ?>


<?php if ($informacionObjeto[1]==4 && $informacionFuncionario[0][fisicamenteEstructura]==1): ?>
	

<li class="nav-item <?=$objetoInformacion->getUrlDinamicaUna('poa2/',$_SERVER['REQUEST_URI'],array("recomiendaInfra","recomiendaInsta"));?>">

<a href="#" class="nav-link">
	<p>
    	Poas recomendados
    	<i class="fas fa-angle-left right"></i>
    	<span class="badge badge-info right"></span>
	</p>
</a>

<ul class="nav nav-treeview">
	
	<li class="nav-item">

		<a href="recomiendaInfra" class="nav-link <?= $objetoInformacion->getUrlDinamica('poa2/',$_SERVER['REQUEST_URI'],'recomiendaInfra');?>">

			<p>Poas recomendados<br>infraestructura</p>

		</a>

	</li>

	<li class="nav-item">

		<a href="recomiendaInsta" class="nav-link <?= $objetoInformacion->getUrlDinamica('poa2/',$_SERVER['REQUEST_URI'],'recomiendaInsta');?>">

			<p>Poas recomendados<br>instalaciones deportivas</p>

		</a>

	</li>

</ul>

</li>


<?php endif ?>

<?php endif ?>

<?php if ($informacionFuncionario[0][fisicamenteEstructura]!=9 && $informacionFuncionario[0][fisicamenteEstructura]!=23): ?>
	
<li class="nav-item">

<a href="reporteriaFinal" class="nav-link <?= $objetoInformacion->getUrlDinamica('poa2/',$_SERVER['REQUEST_URI'],'reporteriaFinal');?>">

	<p>Trámites</p>

</a>

</li>

<?php endif ?>


<?php if ($informacionFuncionario[0][fisicamenteEstructura]==9): ?>

<li class="nav-item">

<a href="asignacionPoasRelativos" class="nav-link <?= $objetoInformacion->getUrlDinamica('poa2/',$_SERVER['REQUEST_URI'],'asignacionPoasRelativos');?>">

	<p>Organismos intervenidos</p>

</a>

</li>	



<li class="nav-item">

<a href="organismosRegistrados" class="nav-link <?= $objetoInformacion->getUrlDinamica('poa2/',$_SERVER['REQUEST_URI'],'organismosRegistrados');?>">

	<p>Organismos registrados</p>

</a>

</li>

<?php endif ?>