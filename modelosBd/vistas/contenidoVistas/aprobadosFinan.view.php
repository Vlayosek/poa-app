<?php $componentes= new componentes();?>

<div class="content-wrapper">

	<section class="content row d d-flex justify-content-center">

		<?=$componentes->getComponentes(1,"POAS RECHAZADOS");?>

		<div class="row">

		<table id="poasGestionados__finan__aprobado" class="col col-12 cell-border">

			<thead>

				<tr>

					<th><center>Ruc</center></th>
					<th><center>Organismo deportivo</center></th>
					<th><center>Techo Notificado ( sin descuentos)</center></th>
					<th><center>Fecha de Aprobación de la Resolución POA (Fecha del quipux de la resolución)</center></th>
					<th><center>Fecha de aprobación</center></th>

				</tr>

			</thead>

		</table>

		</div>

	</section>

</div>

<?=$componentes->getModalMatricezObserva("reasignarTra","formAsignarTraS","enviarTramite__Financiero__rechazos","Enviar");?>

