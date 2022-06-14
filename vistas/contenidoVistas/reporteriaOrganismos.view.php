<?php $componentes= new componentes();?>

<?php $anio__actual = date('Y');;?>

<div class="content-wrapper d d-flex flex-column align-items-center">

	<?=$componentes->getComponentes(1,"REPORTERÍA DE MATRICES INGRESADAS PARA EL AÑO $anio__actual");?>

	<section class="content__configuraciones row d d-flex justify-content-center">

		<?=$componentes->getLinksConfiguracion__parametros(["poa__indi"],["Poa"],'poaIn');?>

		<?=$componentes->getLinksConfiguracion__parametros(["poa_indicadores"],["Indicadores"],'poaIndica');?>

		<?=$componentes->getLinksConfiguracion__parametros(["sueldosSalarios"],["Sueldos y salarios"],'sueldos');?>

		<?=$componentes->getLinksConfiguracion__parametros(["honorarios__ll"],["Honorarios"],'honorarios');?>

		<?=$componentes->getLinksConfiguracion__parametros(["actividadesDeportivas"],["Actividades deportivas"],'actividades');?>

		<?=$componentes->getLinksConfiguracion__parametros(["actividadAdministrativa"],["Actividad administrativa"],'administrativo');?>

		<?=$componentes->getLinksConfiguracion__parametros(["mantenimiento__ll"],["Mantenimiento"],'mantenimiento');?>

		<?=$componentes->getLinksConfiguracion__parametros(["suministros__ll"],["Suministros"],'suministros');?>


	</section>

</div>

<!--=============================
=            Modales            =
==============================-->

<?=$componentes->getModalConfiguracion__reporteria__organismos("poa__indi","POA","poa__inicial__poa",["Actividad","Ítem","Código Ítem","Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre","Total"]);?>

<?=$componentes->getModalConfiguracion__reporteria__organismos("poa_indicadores","INDICADORES","poa__indicadores__poa",["Actividad","Primer trimestre","Segundo trimestre","Tercer trimestre","Cuarto trimestre","Meta indicador"]);?>

<?=$componentes->getModalConfiguracion__reporteria__organismos("sueldosSalarios","SUELDOS Y SALARIOS","reporteria__sueldosySalarios",["Actividad","Cédula","Cargo","Nombres","Tipo cargo","Tiempo Trabajo<br>en meses","Sueldo salario","Aporte patronal","Decimo tercer<br>Sueldo","Mensualiza<br>décimo tercer sueldo","Décimo cuarto<br>sueldo","Mensualiza<br>décimo cuarto sueldo","Fondos de reserva"]);?>

<?=$componentes->getModalConfiguracion__reporteria__organismos("honorarios__ll","HONORARIOS","reporteria__honorarios",["Actividad","Cédula","Nombres","Cargo","Honorario mensual"]);?>


<?=$componentes->getModalConfiguracion__reporteria__organismos("actividadesDeportivas","Actividades deportivas","reporteria__actividades",["Actividad","Tipo financiamiento","Evento","Deporte","Provincia","País","Alcance","Fecha<br>inicio","Fecha<br>fin","Genero","Categoria","Número entrenadores","Número atletas","Total","Beneficiarios","Beneficiaros2","Justificación","Cantidad Bienes","Detalle adquisición"]);?>

<?=$componentes->getModalConfiguracion__reporteria__organismos("actividadAdministrativa","Actividades administrativas","reporteria__administrativas",["Actividad","Justificación","Cantidad"]);?>

<?=$componentes->getModalConfiguracion__reporteria__organismos("mantenimiento__ll","Mantenimiento","reporteria__mantenimiento",["Actividad","Nombre infraestructura","Provincia","Dirección","Estado","Tipo recursos","Tipo intervención","Detallar tipo intervención","Tipo Mantenimiento","Materiales servicios"]);?>


<?=$componentes->getModalConfiguracion__reporteria__organismos("suministros__ll","Suministros","reporteria__suministros",["Tipo","Nombre Escenario","Energía","Agua"]);?>

<!--====  End of Modales  ====-->


