<?php $componentes= new componentes();?>

<div class="content-wrapper">

	<section class="content row d d-flex justify-content-center">

		<?=$componentes->getComponentes(1,"POAS APROBADOS");?>

		<div class="row">

		<table id="poasGestionados" class="col col-12 cell-border">

			<thead>

				<tr>

					<th><center>RUC</center></th>
					<th><center>ORGANISMO DEPORTIVO</center></th>
					<th><center>PROVINCIA</center></th>
					<th><center>CANTÓN</center></th>
					<th><center>PARROQUIA</center></th>
					<th><center>NÚMERO DE<br>RESOLUCIÓN</center></th>
					<th><center>RESOLUCIÓN</center></th>
					<th><center>FECHA TRAMITADO</center></th>
					<th><center>TECHO NOTIFICADO (SIN DESCUENTOS)</center></th>
					<th><center>EDITAR</center></th>

				</tr>

			</thead>

		</table>

		</div>

	</section>

</div>

<?=$componentes->getModal__inforDefinitivas("editarInfor__gestionados","EDITAR INFORMACIÓN","editarInfor","form__editarInfors");?>
