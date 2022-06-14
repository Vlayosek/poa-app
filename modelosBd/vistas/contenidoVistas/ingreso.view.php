<!--=======================================
=            Sección principal            =
========================================-->

<?php $modal= new modal();?>


<div class="wrapper">


<div class="d d-md-flex">

	<div class="d d-md-flex align-items-center">

		<img src="images/logoMinisterio.png" />

	</div>

	<figure class="d d-flex flex-column  align-items-center justify-content-center">

		<img src="images/fondoLogin.jpeg" class="ancho__imagen" />

		<figcaption class="redes__socialesLogin row">
			
			<div class="col col-12 text-center mt-2 color__loginTitulo titulo__principalLogin">

				POA

			</div>

			<div class="col col-12 text-center mt-2 color__loginTitulo">

				SIGUENOS EN

			</div>

			<a class="col col-4 text-center mt-2" href="https://www.facebook.com/MinisterioDeporteEcuador" target="_blank">

				<i class="fab fa-facebook iconos__blancos iconos__inicio"></i>

			</a>

			<a class="col col-4 text-center mt-2" href="https://twitter.com/DeporteEc" target="_blank">

				<i class="fab fa-twitter iconos__blancos iconos__inicio"></i>

			</a>

			<a class="col col-4 text-center mt-2" href="https://www.youtube.com/user/DeporteEc" target="_blank">

				<i class="fab fa-youtube iconos__blancos iconos__inicio"></i>

			</a>

			<a class="col col-12 text-center mt-2 color__loginTitulo">

				SE RECOMIENDA EL USO DEL NAVEGADOR GOOGLE CHROME PARA MEJOR EXPERIENCIA <i class="fab fa-chrome"></i>

			</a>



		</figcaption>

	</figure>

</div>


<form class="row contenedor__negro d d-flex flex-column align-items-center"  method="post">

	<div class="row contenedor__formulario__dos">


		<div class="col col-12 usuario__indicada letras__blancas">


		</div>

		<div class="col col-12 d d-flex align-items-center justify-content-center mt-4">

			<i class="far fa-user iconos__blancos"></i>

			&nbsp;&nbsp;

			<input type="text" id="username" name="username"  class="estilos__inputsRadios letras__blancas" placeholder="Ingrese usuario" />

		</div>

		<div class="col col-12 contrasena__indicada letras__blancas mt-4">


		</div>

		<div class="col col-12 d d-flex align-items-center justify-content-center mt-4">

			<i class="far fa-unlock-alt iconos__blancos"></i>

			&nbsp;&nbsp;

			<input type="password" id="password" name="password"  class="estilos__inputsRadios letras__blancas" placeholder="Ingrese contraseña" />

		</div>

		<div class="col col-6 mt-4 d d-flex justify-content-start">

			<a class="botones__iniciales registro__clases registrar__funciones" data-bs-toggle="modal" data-bs-target="#modalRegistros">REGISTRARSE</a>

		</div>


		<div class="col col-6 mt-4 d d-flex justify-content-end">

			<button type="submit" class="botones__iniciales ingresar__clases active__form" name="ingresarUsuario" id="ingresarUsuario">INGRESAR</button>

		</div>

		<div class="col col-12 text-center letras__blancas mt-4 olvido__funciones pointer__botones" data-bs-toggle="modal" data-bs-target="#modalRegistros">

			<a>¿Olvido su contraseña?</a>

		</div>

	</div>

	<?php

		require_once CONTROLADOR.INICIOSESION.'ingreso.controlador.php';

		$ingreso= new ingreso();
		$ingreso->ingresoCtr();

	?>

</form>

</div>

<!--====  End of Sección principal  ====-->

<!--=============================
=            Modales            =
==============================-->

<!--====================================
=            Modal registro            =
=====================================-->

<div class="modal fade" id="modalRegistros" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<?php $modal->getModales(1);?>
</div>

<!--====  End of Modal registro  ====-->

<!--===============================
=            Terminots            =
================================-->

<div class="modal fade" id="terminosCondicionesModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<?php $modal->getModales(2);?>
</div>

<!--====  End of Terminots  ====-->

  

<!--====  End of Modales  ====-->



