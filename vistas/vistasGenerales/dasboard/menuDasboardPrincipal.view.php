<?php $objetoInformacion= new usuarioAcciones();?>

<?php $informacionObjeto=$objetoInformacion->getInformacionGeneral();?>

<?php $analistaTecnico=$objetoInformacion->getObtenerInformacionGeneral("SELECT a.id_usuario AS idFuncionario,a.usuario AS usuarioFuncionario, a.`password` AS contrasenaFun,b.id_rol AS rolFun, a.fisicamenteEstructura FROM th_usuario AS a INNER JOIN th_usuario_roles AS b ON a.id_usuario=b.id_usuario INNER JOIN th_roles AS c ON c.id_rol=b.id_rol WHERE a.id_usuario='$informacionObjeto[0]' AND a.estadoUsuario='A' AND b.id_rol='3';");?>

<?php $nombreFunPoa=$objetoInformacion->getObtenerInformacionGeneral("SELECT a.usuario AS usuarioPoaFun FROM th_usuario AS a INNER JOIN th_usuario_roles AS b ON a.id_usuario=b.id_usuario INNER JOIN th_roles AS c ON c.id_rol=b.id_rol WHERE a.id_usuario='$informacionObjeto[0]';");?>

<?php $directorTecniA=$objetoInformacion->getObtenerInformacionGeneral("SELECT a.fisicamenteEstructura,b.id_rol FROM th_usuario AS a INNER JOIN th_usuario_roles AS b ON a.id_usuario=b.id_usuario WHERE a.id_usuario='$informacionObjeto[0]';");?>


<body class="hold-transition sidebar-mini layout-fixed">

<div class="wrapper">

  <!--=======================================
  =            Imagen de entrada            =
  ========================================-->
  
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="dist/img/AdminLTELogo.png" alt="logoMinisterio" height="60" width="60">
  </div>


  <!--====  End of Imagen de entrada  ====-->
  
  <!--=======================================================
  =            Navar dentro del indice principal            =
  ========================================================-->
  
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">

    <ul class="navbar-nav ml-auto">

      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button">
          <i class="fas fa-bars"></i>
        </a>
      </li>
    </ul>

  </nav>
  
  <!--====  End of Navar dentro del indice principal  ====-->
  

  <!--===========================================================
  =            Sección del header dasboard principal            =
  ============================================================-->
  <aside class="main-sidebar sidebar-dark-primary elevation-4 row">

    <a class="col col-12 text-center">

      <img src="images/dasboardImages.png" alt="logo ministerio" class="brand-image imagen__dasboardLogo">

    </a>

    <!-- Sidebar -->
    <div class="sidebar">

      <!--===================================
      =            Nombre person            =
      ====================================-->
      
      <div class="user-panel mt-3 pb-3 mb-3 d-flex row">

        <div class="info col col-12">

          <a class="d-block text-center">

            <input type="hidden" id="idUsuarioPrincipal" name="idUsuarioPrincipal" value="<?=$informacionObjeto[0]?>">

            <input type="hidden" id="emailPrincipal" name="emailPrincipal" value="<?=$objetoInformacion->getInformacionEmail($informacionObjeto[0])?>">

            <?php if ($informacionObjeto[1]==3 && empty($nombreFunPoa[0][usuarioPoaFun])): ?>

              <?php $objetoInformacionSe= new usuarioAcciones();?>
              <?php $informacionObjetoSe=$objetoInformacionSe->getInformacionCompletaOrganismoDeportivo();?>

              <input type="hidden" id="idOrganismoPrincipal" name="idOrganismoPrincipal" value="<?= $informacionObjetoSe[0][idOrganismo]?>" />

              <?php $nombreOrganismo=$objetoInformacion->getInformacionOrganismoDeportivo($informacionObjeto[0]);?>

              <input type="hidden" id="nombrePrincipalU" name="nombrePrincipalU" value="<?=$nombreOrganismo?>" />
              

              <?=$nombreOrganismo?>
              
            <?php else: ?>

              <input type="hidden" id="idOrganismoPrincipal" name="idOrganismoPrincipal" />

              <?php $nombreFuncionario=$objetoInformacion->getInformacionUsuarioPerfil($informacionObjeto[0]);?>

              <?php if (!empty($nombreFuncionario)): ?>


                <?=$nombreFuncionario?>

                 <input type="hidden" id="nombrePrincipalU" name="nombrePrincipalU" value="<?=$nombreFuncionario?>" />

                
              <?php else: ?>

                 <?=$nombreFunPoa[0][usuarioPoaFun]?>

                 <input type="hidden" id="nombrePrincipalU" name="nombrePrincipalU" value="<?=$nombreFunPoa[0][usuarioPoaFun]?>" />
              
              <?php endif ?>

            <?php endif ?>

          </a>

        </div>

      </div>      
      
      <!--====  End of Nombre person  ====-->
      
      <!--==================================================
      =            Menú principal del dasboards            =
      ===================================================-->

      <nav class="mt-2">

        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

          <?php $objetoMenu= new menuPlantilla();?>

          <?php if(!empty($analistaTecnico[0][idFuncionario])){?>

            <?php if((($directorTecniA[0][id_rol]==3 && $directorTecniA[0][fisicamenteEstructura]!=18) || ($directorTecniA[0][id_rol]==2 && $directorTecniA[0][fisicamenteEstructura]!=18)) && $informacionObjeto[2]=="funcionario"){?>

               <?php $objetoMenu->getMenuUbicacion(10);?>

            <?php }else{?>

             <?php $objetoMenu->getMenuUbicacion(1);?>

            <?php }?>

          <?php }else{?>

            <?php if((($directorTecniA[0][id_rol]==3 && $directorTecniA[0][fisicamenteEstructura]!=18) || ($directorTecniA[0][id_rol]==2 && $directorTecniA[0][fisicamenteEstructura]!=18)) && $informacionObjeto[2]=="funcionario"){?>

               <?php $objetoMenu->getMenuUbicacion(10);?>

            <?php }else{?>

              <?php if ($directorTecniA[0][id_rol]==4 && $directorTecniA[0][fisicamenteEstructura]==3): ?>

                 <?php $objetoMenu->getMenuUbicacion(5);?>
                
              <?php else: ?>
                
                 <?php $objetoMenu->getMenuUbicacion($informacionObjeto[1]);?> 

              <?php endif ?>

            <?php }?>

          <?php }?>

          <li class="nav-item">

            <a href="salir" class="nav-link">

              <p>Salir</p>

            </a>

          </li>

        </ul>

      </nav>
      
      <!--====  End of Menú principal del dasboards  ====-->
  
    </div>

  </aside>

   <!--====  End of Sección del header dasboard principal  ====-->

