
<?php $componentes= new componentes();?>

<div class="content-wrapper">

	<section class="content row d d-flex justify-content-center">

		<?=$componentes->getComponentes(1,"ORGANISMOS REGISTRADOS");?>

		<div class="row">

			<table id="asignaciones__realizadas__finan" class="col col-12 cell-border">

				<thead>

					<tr>

						<th><center>RUC</center></th>
						<th><center>ORGANISMO DEPORTIVO</center></th>
						<th><center>PROVINCIA</center></th>
						<th><center>CANTÓN</center></th>
						<th><center>PARROQUIA</center></th>
						<th><center>ENCARGADO</center></th>
						<th><center>FECHA REASIGNA<br>DIRECTOR FINANCIERO</center></th>
						<th><center>FECHA DE APROBACIÓN<br>(RESOLUCIÓN DEL QUIPUX)</center></th>
						<th><center>FECHA LÍMITE 15 DÍAS TÉRMINO</center></th>


					</tr>

				</thead>

			</table>

		</div>

	</section>

</div>


