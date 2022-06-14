<?php

	class componentes{

		/*=============================================================
		=            Editar información global definitivas            =
		=============================================================*/
		public function getModal__inforDefinitivas($parametro1,$parametro2,$parametro3,$parametro4){


			$modal="

			<div class='modal fade modal__ItemsGrup' id='$parametro1' aria-hidden='true'>

				<div class='modal-dialog'>

					<form class='modal-content formulario__intervencion__eliminar $parametro4'>

					<div class='modal-header row'>

					    <div class='col col-11 text-center'>

					    	<h5 class='modal-title'>$parametro2</h5>

					    </div>

					    <div class='col col-1'>

					    	<button type='button' class='btn-close cerrar__modalRegistros' data-bs-dismiss='modal' aria-label='Close'></button>

					    </div>

					</div>

						<div class='modal-body row'>

							<input type='hidden' id='organismoId' name='organismoId'/>

							<label class='col col-12'>Fecha de aprobación de la resolución del POAS (fecha del quipux de la resolución)</label>

							<div class='col col-12'>

								<input type='date' id='fecha__poasE' name='fecha__poasE' style='width:100%;'/>

							</div>


							<label class='col col-12'>Número de resolución</label>

							<div class='col col-12'>

								<input type='text' id='numeroResolucion__ed' name='numeroResolucion__ed' style='width:100%;'/>

							</div>



							<label class='col col-12'>Techo Notificado ( sin descuentos)</label>

							<div class='col col-12'>

								<input type='text' class='solo__numero__montos' id='notificado__sin' name='notificado__sin' style='width:100%;'/>

							</div>


							<label class='col col-8'>¿Desea editar el documento?</label>

							<div class='col col-4'>

								<input type='checkbox' id='aceptarDocumentos__c' name='aceptarDocumentos__c'/>

							</div>

							<label class='col col-4 documento__ocultos'>Seleccionar documento</label>


							<div class='col col-8 documento__ocultos'>

								<input type='file' id='documentos__nue' name='documentos__nue' style='width:100%;'/>

							</div>


							<div class='col col-12 text-center d d-flex justify-content-center'>

								<button class='btn btn-danger' class='btn-close cerrar__modalRegistros' data-bs-dismiss='modal'>CERRAR</button>

								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

								<button class='btn btn-info' id='$parametro3'>ENVIAR</button>

							</div>

						</div>

					</form>

				</div>

			</div>
			";

			return $modal;


		}
		
		
		
		/*=====  End of Editar información global definitivas  ======*/
		

		/*====================================================
		=            Funciones principales clases            =
		====================================================*/

		public function getModalConfiguracion__reporteria__organismos($parametro1,$parametro2,$parametro3,$parametro4){


			$modal="

			<div class='modal fade modal__ItemsGrup' id='$parametro1' aria-hidden='true'>

				<div class='modal-dialog' style='min-width:100%!important;'>

					<form class='modal-content formularioConfiguracion'>

					<div class='modal-header row'>

					    <div class='col col-11 text-center'>

					    	<h5 class='modal-title $parametro2'></h5>

					    </div>

					    <div class='col col-1'>

					    	<button type='button' class='btn-close cerrar__modalRegistros' data-bs-dismiss='modal' aria-label='Close'></button>

					    </div>

					</div>

					<div class='modal-body row'>

						<div style='width:100%;'>

						<table class='$parametro3'>

							<thead>

								<tr>

						";


				foreach ($parametro4 as $clave => $valor) {

							$modal.="<th><center>$valor</center></th>";
					
				}

				if ($parametro2!="Suministros" && $parametro2!="POA" && $parametro2!="INDICADORES") {
					
				$modal.="
									<th><center>Enero</center></th>
									<th><center>Febrero</center></th>
									<th><center>Marzo</center></th>
									<th><center>Abril</center></th>
									<th><center>Mayo</center></th>
									<th><center>Junio</center></th>
									<th><center>Julio</center></th>
									<th><center>Agosto</center></th>
									<th><center>Septiembre</center></th>
									<th><center>Octubre</center></th>
									<th><center>Noviembre</center></th>
									<th><center>Diciembre</center></th>
									<th><center>Total</center></th>";


				}


					$modal.="

								</tr>

							</thead>

						</table>

						</div>


					</div>

					</form>

				</div>

			</div>

			";

			return $modal;


		}

		public function getModalEliminar__informacion($parametro1,$parametro2){


			$modal="

			<div class='modal fade modal__ItemsGrup' id='$parametro1' aria-hidden='true'>

				<div class='modal-dialog'>

					<form class='modal-content formulario__intervencion__eliminar'>

					<div class='modal-header row'>

					    <div class='col col-11 text-center'>

					    	<h5 class='modal-title'>$parametro2</h5>

					    </div>

					    <div class='col col-1'>

					    	<button type='button' class='btn-close cerrar__modalRegistros' data-bs-dismiss='modal' aria-label='Close'></button>

					    </div>

					</div>

						<div class='modal-body row'>

							<input type='hidden' id='organismoId' name='organismoId'/>

							<div class='col col-12 text-center d d-flex justify-content-center'>

								<button class='btn btn-danger' class='btn-close cerrar__modalRegistros' data-bs-dismiss='modal'>No</button>

								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

								<button class='btn btn-info' id='eliminarInfor'>Si</button>

							</div>

						</div>

					</form>

				</div>

			</div>
			";

			return $modal;


		}



		public function getModalAgregar__informacion($parametro1,$parametro2){


			$modal="


			<div class='modal fade modal__ItemsGrup' id='$parametro1' aria-hidden='true'>

				<div class='modal-dialog'>

					<form class='modal-content formulario__intervencion'>

					<div class='modal-header row'>

					    <div class='col col-11 text-center'>

					    	<h5 class='modal-title'>$parametro2</h5>

					    </div>

					    <div class='col col-1'>

					    	<button type='button' class='btn-close cerrar__modalRegistros' data-bs-dismiss='modal' aria-label='Close'></button>

					    </div>

					</div>

						<div class='modal-body row'>

							<label class='col col-12'>Ingrese ruc del organismo deportivo (dar click en la lupa para busar acción obligatoria)</label>

							<input type='text' class='col col-10 solo__numero campos__obligatorios' placeholder='Ingrese ruc del organismo deportivo' id='rucOrganismo' name='rucOrganismo'/>

							<div class='col col-2'>

								<span class='btn btn-info' id='buscarRuc__i'><i class='fa fa-search' aria-hidden='true'></i></span>

								<div class='reload__rucI'></div>

							</div>

							<input type='hidden' id='idOrganismo_i' name='idOrganismo_i' class='campos__obligatorios'>

							<input type='text' class='col col-12' id='nombreOrganismo__i' name='nombreOrganismo__i' readonly='' class='campos__obligatorios'/>

							<input type='text' class='col col-12' id='provincia__i' name='provincia__i' readonly='' class='campos__obligatorios'/>

							<input type='text' class='col col-12' id='canton__i' name='canton__i' readonly='' class='campos__obligatorios'/>

							<input type='text' class='col col-12' id='parroquia__i' name='parroquia__i' readonly='' class='campos__obligatorios'/>

							<label class='col col-12'>Ingrese cédula Interventor (dar click en la lupa para busar acción obligatoria)</label>

							<input type='text' class='col col-10 solo__numero campos__obligatorios' id='cedulaInterventor' name='cedulaInterventor' placeholder='Ingrese cédula Interventor'/>

							<div class='col col-2'>

								<span class='btn btn-info' id='buscarCedula__i'><i class='fa fa-search' aria-hidden='true'></i></span>

								<div class='buscarCedula__i'></div>

							</div>

							<input type='text' class='col col-12' id='nombreInterventor__i' name='nombreInterventor__i' readonly='' class='campos__obligatorios'/>

							<label class='col col-12'>Ingrese fecha inicial de la intervención</label>

							<input type='date' class='col col-12 campos__obligatorios' id='fechaInicialI' name='fechaInicialI'/>


							<label class='col col-12'>Ingrese fecha final de la intervención</label>

							<input type='date' class='col col-12 campos__obligatorios' id='fechaFinalI' name='fechaFinalI'/>

							<div class='col col-12 text-center'>

								<button class='btn btn-info' id='guardarInfor__i'><i class='fa fa-floppy-o' aria-hidden='true'></i>&nbsp;&nbsp;Guardar</button>

							</div>

						</div>

					</form>

				</div>

			</div>

			";

			return $modal;


		}

		
		public function getModalMeses($parametro1,$parametro2){


			$modal="

			<div class='modal modal__ItemsGrup fade' id='$parametro1' aria-hidden='true'>

				<div class='modal-dialog' style='min-width:90%!important;'>

					<form class='modal-content $parametro2'>

						<div class='modal-header row'>

					        <div class='col col-11 text-center'>

					          <h5 class='modal-title titulos__financierosI'></h5>

					        </div>

					        <div class='col col-1'>

					          <button type='button' class='btn-close cerrar__modalRegistros' data-bs-dismiss='modal' aria-label='Close'></button>

					        </div>

						</div>

						<div class='modal-body row d d-flex justify-content-center'>

							<div class='overflow_c' style='width:20%!important;'>

							<input type='hidden' class='idFinancierosIP' name='idFinancierosIP'/>

							<table class='col col-12 mt-4 cell-border table table-striped'>

								<tbody>

									<tr>

										<td align='center'>Enero</td>
										<td><input type='text' class='enero__items meses__atadosItems' name='enero__items' style='width:100%!important;'/></td>

									</tr>

									<tr>

										<td align='center'>Febrero</td>
										<td><input type='text' class='febrero__items meses__atadosItems' name='febrero__items' style='width:100%!important;'/></td>

									</tr>


									<tr>

										<td align='center'>Marzo</td>
										<td><input type='text' class='marzo__items meses__atadosItems' name='marzo__items' style='width:100%!important;'/></td>

									</tr>


									<tr>

										<td align='center'>Abril</td>
										<td><input type='text' class='abril__items meses__atadosItems' name='abril__items' style='width:100%!important;'/></td>

									</tr>


									<tr>

										<td align='center'>Mayo</td>
										<td><input type='text' class='mayo__items meses__atadosItems' name='mayo__items' style='width:100%!important;'/></td>

									</tr>


									<tr>

										<td align='center'>Junio</td>
										<td><input type='text' class='junio__items meses__atadosItems' name='junio__items' style='width:100%!important;'/></td>

									</tr>


									<tr>

										<td align='center'>Julio</td>
										<td><input type='text' class='julio__items meses__atadosItems' name='julio__items' style='width:100%!important;'/></td>

									</tr>

									<tr>

										<td align='center'>Agosto</td>
										<td><input type='text' class='agosto__items meses__atadosItems' name='agosto__items' style='width:100%!important;'/></td>

									</tr>

									<tr>

										<td align='center'>Septiembre</td>
										<td><input type='text' class='septiembre__items meses__atadosItems' name='septiembre__items' style='width:100%!important;'/></td>

									</tr>

									<tr>

										<td align='center'>Octubre</td>
										<td><input type='text' class='octubre__items meses__atadosItems' name='octubre__items' style='width:100%!important;'/></td>

									</tr>

									<tr>

										<td align='center'>Noviembre</td>
										<td><input type='text' class='noviembre__items meses__atadosItems' name='noviembre__items' style='width:100%!important;'/></td>

									</tr>

									<tr>

										<td align='center'>Diciembre</td>
										<td><input type='text' class='diciembre__items meses__atadosItems' name='diciembre__items' style='width:100%!important;'/></td>

									</tr>

									<tr>

										<td align='center'>Total</td>
										<td><input type='text' class='total__items' name='total__items' style='width:100%!important;' readonly='readonly'/></td>

									</tr>

								</tbody>

							</table>

							</div>

						</div>

						<div class='modal-footer d d-flex justify-content-center row'>

							<a type='button' class='btn btn-danger  left__margen pointer__botones col-1' data-dismiss='modal' aria-label='Close' aria-label='Close'>CERRAR</a>

							<a type='button' class='btn btn-primary left__margen pointer__botones guardar__itemsItems col-1'>GUARDAR</a>

						</div>						

					</form>

				</div>

			</div>

			";

			return $modal;


		}

		public function get__modal__terminaFinanciero($parametro1,$parametro2){


			$modal="

			<div class='modal modal__ItemsGrup fade' id='$parametro1' aria-hidden='true'>

				<div class='modal-dialog' style='min-width:50%!important;'>

					<form class='modal-content $parametro2'>

						<div class='modal-header row'>

					        <div class='col col-11 text-center'>

					          <h5 class='modal-title titulo__mS'></h5>

					        </div>

					        <div class='col col-1'>

					          <button type='button' class='btn-close cerrar__modalRegistros' data-bs-dismiss='modal' aria-label='Close'></button>

					        </div>

						</div>

						<div class='modal-body row'>

							<div class='row'>

								<input type='hidden' id='idOrganismo' name='idOrganismo' />

								<div class='col col-2'>

									Documento

								</div>

								<div class='col col-4'>

									<a class='documento__total__financiero' target='_blank'>Documento de notificación</a>

								</div>

								<div class='col col-2'>

									Regresar támite

								</div>

								<div class='col col-2'>

									<button class='btn btn-warning' id='regresarTramite'>Regresar</button>

								</div>

							</div>


						</div>


						<div class='modal-footer d d-flex justify-content-center row'>

							<div class='col col-12 d d-flex justify-content-center flex-wrap grupo__especifico_botones'>

								<a type='button' class='btn btn-danger  left__margen modales__reload pointer__botones' data-dismiss='modal' aria-label='Close' aria-label='Close'>CERRAR</a>

								&nbsp;&nbsp;&nbsp;

								<button class='btn btn-info' id='cerrarTramiteTransferencias'><i class='fa fa-floppy-o' aria-hidden='true'></i>&nbsp;&nbsp;Guardar</button>

							</div>


							<div class='col col-12 reolad__mMa text-center'></div>

						</div>	


					</form>

				</div>

			</div>

			";

			return $modal;


		}

		
		public function getModalMatricezObserva__tres__aprobados($parametro1,$parametro2){


			$modal="

			<div class='modal modal__ItemsGrup fade' id='$parametro1' aria-hidden='true'>

				<div class='modal-dialog' style='min-width:80%!important;'>

					<form class='modal-content $parametro2'>

						<div class='modal-header row'>

					        <div class='col col-11 text-center'>

					          <h5 class='modal-title titulo__mS'></h5>

					        </div>

					        <div class='col col-1'>

					          <button type='button' class='btn-close cerrar__modalRegistros' data-bs-dismiss='modal' aria-label='Close'></button>

					        </div>

						</div>

						<div class='modal-body row contenedor__bodyCMatrizDefi'>

							<input type='hidden' id='idOrganismo' name='idOrganismo' />

							<div class='col col-4'>

								Cargar quipux suscrito

							</div>

							<div class='col col-8'>

								<label for='quipux__Suscritos' class='file-picker clase__quipux__suscrito'>Cargar pdf obligatorio&nbsp;&nbsp; <i class='fas fa-search pointer__botones col col-1 mt-4 posicion__lupas'></i></label>

								<input type='file' id='quipux__Suscritos' name='quipux__Suscritos' class='obligatorios__archivos' accept='application/pdf'/>


							</div>

							<div class='col col-12' id='visualiza__quipux__gestion'></div>


						</div>


						<div class='modal-footer d d-flex justify-content-center row'>

							<div class='col col-12 d d-flex justify-content-center flex-wrap grupo__especifico_botones'>

								<a type='button' class='btn btn-danger  left__margen modales__reload pointer__botones' data-dismiss='modal' aria-label='Close' aria-label='Close'>CERRAR</a>

								<button class='btn btn-info' id='gaurdarTransferencias'><i class='fa fa-floppy-o' aria-hidden='true'></i>&nbsp;&nbsp;Guardar</button>

							</div>


							<div class='col col-12 reolad__mMa text-center'></div>

						</div>	


					</form>

				</div>

			</div>

			";

			return $modal;


		}


		public function getModalMatricezObserva2($parametro1,$parametro2){

			$modal="

			<div class='modal modal__ItemsGrup fade' id='$parametro1' aria-hidden='true'>

				<div class='modal-dialog' style='min-width:80%!important;'>

					<form class='modal-content $parametro2'>

						<div class='modal-header row'>

					        <div class='col col-11 text-center'>

					          <h5 class='modal-title titulo__mS'></h5>

					        </div>

					        <div class='col col-1'>

					          <button type='button' class='btn-close cerrar__modalRegistros' data-bs-dismiss='modal' aria-label='Close'></button>

					        </div>

						</div>

						<div class='modal-body row contenedor__bodyCMatrizDefi'>

							


						</div>

					</form>

				</div>

			</div>

			";

			return $modal;


		}

		public function getModalMatricezObserva2__indice($parametro1,$parametro2){


			$modal="

			<div class='modal modal__ItemsGrup fade' id='$parametro1' aria-hidden='true'>

				<div class='modal-dialog' style='min-width:80%!important;'>

					<form class='modal-content'>

						<div class='modal-header row'>

					        <div class='col col-11 text-center'>

					          <h5 class='modal-title titulo__mS'>$parametro2</h5>

					        </div>

						</div>

						<div class='modal-body row contenedor__bodyCMatrizDefi'>

							
							<table>

								<thead>

									<tr>

										<th align='center'>N</th>
										<th align='center'>CONDICIÓN</th>
										<th align='center'>CUMPLE</th>
										<th align='center'>OBSERVACIONES PARA LA ORGANIZACIÓN DEPORTIVA</th>

									</tr>

								</thead>

								<tbody class='body__observacionesContenidas'>

								</tbody>

							</table>


						</div>

						<div class='modal-footer d d-flex justify-content-center row'>

							<div class='col col-12 d d-flex justify-content-center flex-wrap grupo__especifico_botones'>

								<a type='button' class='btn btn-danger  left__margen modales__reload pointer__botones' data-dismiss='modal' aria-label='Close' aria-label='Close'>CERRAR</a>


							</div>

							<div class='col col-12 reolad__mMa text-center'></div>

						</div>	

					</form>

				</div>

			</div>

			";

			return $modal;


		}


		public function getModalMatricezObserva__terminar($parametro1,$parametro2){


			$modal="

			<div class='modal modal__ItemsGrup fade' id='$parametro1' aria-hidden='true'>

				<div class='modal-dialog' style='min-width:70%!important;'>

					<form class='modal-content $parametro2' id='form-modal'>

						<div class='modal-header row'>

					        <div class='col text-center'>

					          <h5 class='modal-title titulo__mS mb-0'></h5>

					        </div>

					        <div class='col col-1' id='btn-cerrar__icon'>

					          <button type='button' class='btn-close cerrar__modalRegistros modales__reload' data-bs-dismiss='modal' aria-label='Close'><i class='far fa-times-circle'></i></button>

					        </div>

						</div>

						<div class='modal-body row contenedor__bodyCMatriz'>

							<input type='hidden' id='idOrganismoM' class='idOrganismoM'/>
							<input type='hidden' id='texto__finan' name='texto__finan' />


						</div>

						<div class='modal-footer d d-flex justify-content-center row'>

							<div class='col col-12 d d-flex justify-content-center flex-wrap grupo__especifico_botones'>


								<a type='button' class='btn btn-danger  left__margen modales__reload pointer__botones' data-dismiss='modal' aria-label='Close' aria-label='Close' id='btn-cerrar'>CERRAR</a>


							</div>

							<div class='col col-12 reolad__mMa text-center'></div>

						</div>						

					</form>

				</div>

			</div>

			";

			return $modal;


		}


		public function getModalMatricezObserva($parametro1,$parametro2,$parametro3,$parametro4){


			$modal="

			<div class='modal modal__ItemsGrup fade' id='$parametro1' aria-hidden='true'>

				<div class='modal-dialog' style='min-width:70%!important;'>

					<form class='modal-content $parametro2' id='form-modal'>

						<div class='modal-header row'>

					        <div class='col text-center'>

					          <h5 class='modal-title titulo__mS mb-0'></h5>

					        </div>

					        <div class='col col-1' id='btn-cerrar__icon'>

					          <button type='button' class='btn-close cerrar__modalRegistros modales__reload' data-bs-dismiss='modal' aria-label='Close'><i class='far fa-times-circle'></i></button>

					        </div>

						</div>

						<div class='modal-body row contenedor__bodyCMatriz'>

							<input type='hidden' id='idOrganismoM' class='idOrganismoM'/>
							<input type='hidden' id='texto__finan' name='texto__finan' />


						</div>

						<div class='modal-footer d d-flex justify-content-center row'>

							<div class='col col-12 d d-flex justify-content-center flex-wrap grupo__especifico_botones'>

								<button type='submit' class='btn__enviar btn left__margen boton__enlacesOcultos' id='$parametro3' name='$parametro3'>$parametro4</button>

								&nbsp;&nbsp;&nbsp;&nbsp;

								<a type='button' class='btn btn-danger  left__margen modales__reload pointer__botones' data-dismiss='modal' aria-label='Close' aria-label='Close' id='btn-cerrar'>CERRAR</a>


							</div>

							<div class='col col-12 reolad__mMa text-center'></div>

						</div>						

					</form>

				</div>

			</div>

			";

			return $modal;


		}


		public function getModalMatricez($parametro1,$parametro2,$parametro3,$parametro4,$parametro5){


			$modal="

			<div class='modal modal__ItemsGrup fade' id='$parametro1' aria-hidden='true'>

				<div class='modal-dialog' style='min-width:90%!important;'>

					<form class='modal-content $parametro2'>

						<div class='modal-header row'>

					        <div class='col col-11 text-center'>

					          <h5 class='modal-title'>$parametro3</h5>

					        </div>

					        <div class='col col-1'>

					          <button type='button' class='btn-close cerrar__modalRegistros modales__reload' data-bs-dismiss='modal' aria-label='Close'></button>

					        </div>

						</div>

						<div class='modal-body row'>

							<div class='overflow_c'>

							<table class='col col-12 mt-4 cell-border table table-striped tabla__matricesJ'>

								<thead class='$parametro4'>

									<tr></tr>

								</thead>

								<tbody class='$parametro5'></tbody>

							</table>

							</div>

						</div>

						<div class='modal-footer d d-flex justify-content-center row'>

							<div class='col col-12 d d-flex justify-content-center flex-wrap'>

								<a type='button' class='btn btn-danger  left__margen modales__reload pointer__botones' data-dismiss='modal' aria-label='Close' aria-label='Close'>CERRAR</a>

							</div>

						</div>						

					</form>

				</div>

			</div>

			";

			return $modal;


		}


		public function getContenidoActividadesPoa($parametro1,$parametro2,$parametro3){
			
			return "
				<table id='$parametro1' class='col col-12 mt-4 cell-border table table-dark table-striped'>

					<thead>

						$parametro2

					</thead>

					<tbody class='$parametro3'></tbody>
					

				</table>
			";


		}

		public function getComponentes($parametro1,$parametro2){

			switch ($parametro1) {

				case 1:
					
					return "<div clas='row text-center d d-flex justify-content-center'>

						<div class='col col-12 text-center mt-2 titulo__enfasis'>

							$parametro2

						</div>

					</div>";

				break;

			}

		}

		public function getLinksConfiguracion($parametro1,$parametro2){


			$flujoLinks;

			for ($i=0; $i < count($parametro1); $i++) { 

				$flujoLinks.="<div class='row d d-flex flex-column justify-content-center card mt-4'>

					<div class='card-body row'>

							<a class='card-title text-center titulo__enfasis pointer__botones' data-bs-toggle='modal' data-bs-target='#$parametro1[$i]'>$parametro2[$i]</a>

					</div>

				</div>";

			}

					
			return $flujoLinks;

		}


		public function getLinksConfiguracion__parametros($parametro1,$parametro2,$parametro3){


			$flujoLinks;

			for ($i=0; $i < count($parametro1); $i++) { 

				$flujoLinks.="<div class='row d d-flex flex-column justify-content-center card mt-4'>

					<div class='card-body row'>

							<a class='card-title text-center titulo__enfasis pointer__botones' data-bs-toggle='modal' data-bs-target='#$parametro1[$i]' id='$parametro3'>$parametro2[$i]</a>

					</div>

				</div>";

			}

					
			return $flujoLinks;

		}		

		public function getLinksConfiguracion__activado($parametro1,$parametro2,$parametro3){


			$flujoLinks;

			for ($i=0; $i < count($parametro1); $i++) { 

				$flujoLinks.="<div class='row d d-flex flex-column justify-content-center card mt-4'>

					<div class='card-body row'>

							<a class='card-title text-center titulo__enfasis pointer__botones' data-bs-toggle='modal' data-bs-target='#$parametro1[$i]' id='$parametro3[$i]'>$parametro2[$i]</a>

					</div>

				</div>";

			}

					
			return $flujoLinks;

		}



		public function getModalEstados($parametro1,$parametro2,$parametro3){


			$modal="

			<div class='modal fade' id='$parametro1' aria-hidden='true'>

				<div class='modal-dialog'>

					<form class='modal-content $parametro2'>

						<div class='modal-header row'>

					        <div class='col col-11 text-center'>

					          <h5 class='modal-title' id='exampleModalLabel'>FORMULARIO DE CONTACTO</h5>

					        </div>

					        <div class='col col-1'>

					          <button type='button' class='btn-close cerrar__modalRegistros' data-bs-dismiss='modal' aria-label='Close'></button>

					        </div>

						</div>

						<div class='modal-body row'>

							$parametro3

						</div>

					</form>

				</div>

			</div>

			";

			return $modal;


		}

		public function getModalAtributosDos($parametro1,$parametro2,$parametro3,$parametro4,$parametro5,$parametro6,$parametro7,$parametro8,$parametro9){

			$modal="
			<div class='modal fade' id='$parametro1' aria-hidden='true'>

				<div class='modal-dialog modal-xl'>

					<form class='modal-content $parametro2'>

						<div class='modal-header row'>

					        <div class='col col-11 text-center'>

					          <h5 class='modal-title' id='modalTitulo'>$parametro3<br><span class='asignado__titulos'></span></h5>

					        </div>

						</div>

						<div class='modal-body row'>

							<input type='hidden' class='idOrganismo' name='idOrganismo'/>

							<input type='hidden' class='idAtributoEscondido' name='idAtributoEscondido'/>

						";


			foreach ($parametro5 as $clave => $valor) {

				if ($parametro7[$clave]=="input") {

					if ($parametro8[$clave]=="numero") {

						$modal.="

						<div class='col col-12 titulo__enfasis mt-2'>
							$parametro5[$clave]
						</div>


						<div class='col col-12 mt-2'>
							<input type='text' class='$parametro6[$clave] ancho__total__input solo__numero campos__obligatorios' name='$parametro6[$clave]'/>
						</div>

						";

					}else if($parametro8[$clave]=="monto"){


						$modal.="

						<div class='col col-12 titulo__enfasis mt-2'>
							$parametro5[$clave]
						</div>


						<div class='col col-12 mt-2'>
							<input type='text' class='$parametro6[$clave] ancho__total__input solo__numero__montos campos__obligatorios' name='$parametro6[$clave]'/>
						</div>

						";						
						
					}else{

						$modal.="

						<div class='col col-12 titulo__enfasis mt-2'>
							$parametro5[$clave]
						</div>


						<div class='col col-12 mt-2'>
							<input type='text' class='$parametro6[$clave] ancho__total__input campos__obligatorios' name='$parametro6[$clave]'/>
						</div>

						";

					}
		

				}else if($parametro7[$clave]=="boton"){

					$modal.="

						<div class='col col-10 titulo__enfasis mt-2'>
							$parametro5[$clave]
						</div>

						<div class='col col-2 mt-2 text-center'>
							<button class='btn btn-warning $parametro6[$clave]' id='botonAc$parametro6[$clave]'>Agregar</button>'
						</div>

						";						

				}else if($parametro7[$clave]=="select"){

					$modal.="

					<div class='col col-12 titulo__enfasis mt-2'>
						$parametro5[$clave]
					</div>

					<div class='col col-12 mt-2'>
						<select class='$parametro6[$clave] ancho__total__input campos__obligatorios' name='$parametro6[$clave]'></select>
					</div>

					";				

				}else if($parametro7[$clave]=="file"){



					$modal.="

					<div class='col col-12 titulo__enfasis mt-2'>
						$parametro5[$clave]
					</div>

					<div class='col col-12 mt-2'>
						<input type='file' class='$parametro6[$clave] ancho__total__input campos__obligatorios' name='$parametro6[$clave]'/>
					</div>

					";				

				}


			}


			$modal.="
					</div>

						<div class='modal-footer d d-flex justify-content-center row $parametro9'>

						</div>

					</form>

				</div>

			</div>
			";

			return $modal;

		} 

		public function getModalAtributosPdfs($parametro1,$parametro2,$parametro3,$parametro4,$parametro5,$parametro6,$parametro7,$parametro8,$parametro9,$parametro10){

			$modal="
			<div class='modal fade modal__ItemsGrup' id='$parametro1' aria-hidden='true'>

				<div class='modal-dialog modal-lg'>

					<form class='modal-content $parametro2' action='modelosBd/pdf/pdf.modelo.php' method='post'>

						<div class='modal-header row'>

					        <div class='col col-11 text-center'>

					          <h5 class='modal-title' id='modalTitulo'>$parametro3<br><span class='asignado__titulos'></span></h5>

					        </div>

					        <div class='col col-1'>

					          <span class='button pointer__botones modales__reload' data-dismiss='modal' aria-label='Close' aria-label='Close'><i class='fas fa-times-circle'></i></span>

					        </div>

						</div>

						<div class='modal-body row'>

							<input type='hidden' class='idOrganismo' name='idOrganismo'/>

							<input type='hidden' class='idAtributoEscondido' name='idAtributoEscondido'/>

							<input type='hidden' class='idUsuarioPrincipalDos' name='idUsuarioPrincipalDos'/>

						";


			foreach ($parametro5 as $clave => $valor) {

				if ($parametro7[$clave]=="input") {

					if ($parametro8[$clave]=="disabled") {

						$modal.="

						<div class='col col-4 titulo__enfasis mt-2'>
							$parametro5[$clave]
						</div>


						<div class='col col-8 mt-2'>
							<input type='text' class='$parametro6[$clave] ancho__total__input solo__numero campos__obligatorios text-center' name='$parametro6[$clave]' readonly='readonly' value='0'/>
						</div>

						";

					
					}else if ($parametro8[$clave]=="numero") {

						$modal.="

						<div class='col col-4 titulo__enfasis mt-2'>
							$parametro5[$clave]
						</div>


						<div class='col col-8 mt-2'>
							<input type='text' class='$parametro6[$clave] ancho__total__input solo__numero campos__obligatorios text-center' name='$parametro6[$clave]' value='0'/>
						</div>

						";

					}else if($parametro8[$clave]=="monto"){


						$modal.="

						<div class='col col-4 titulo__enfasis mt-2'>
							$parametro5[$clave]
						</div>


						<div class='col col-8 mt-2'>
							<input type='text' class='$parametro6[$clave] ancho__total__input solo__numero__montos campos__obligatorios text-center' name='$parametro6[$clave]' value='0.00'/>
						</div>

						";						
						
					}else{

						$modal.="

						<div class='col col-4 titulo__enfasis mt-2'>
							$parametro5[$clave]
						</div>


						<div class='col col-8 mt-2'>
							<input type='text' class='$parametro6[$clave] ancho__total__input campos__obligatorios text-center' name='$parametro6[$clave]'/>
						</div>

						";

					}
		

				}else if($parametro7[$clave]=="boton"){

					$modal.="

						<div class='col col-10 titulo__enfasis mt-2'>
							$parametro5[$clave]
						</div>

						<div class='col col-2 mt-2 text-center'>
							<a data-bs-toggle='modal' data-bs-target='#$parametro6[$clave]' class='btn btn-secondary botonAc$parametro6[$clave]'><i class='fas fa-address-card'></i>&nbsp;&nbsp;Agregar</a>'
						</div>

						";						

				}else if($parametro7[$clave]=="select"){

					$modal.="

					<div class='col col-12 titulo__enfasis mt-2'>
						$parametro5[$clave]
					</div>

					<div class='col col-12 mt-2'>
						<select class='$parametro6[$clave] ancho__total__input campos__obligatorios' name='$parametro6[$clave]'></select>
					</div>

					";				

				}else if($parametro7[$clave]=="file"){



					$modal.="

					<div class='col col-12 titulo__enfasis mt-2'>
						$parametro5[$clave]
					</div>

					<div class='col col-12 mt-2'>
						<input type='file' class='$parametro6[$clave] ancho__total__input campos__obligatorios' name='$parametro6[$clave]' accept='application/pdf'/>
					</div>

					";				

				}else if ($parametro8[$clave]=="textos") {
						
					$modal.="

					<div class='col col-12 titulo__enfasis mt-2 uppercase__texto text-center textos__titulazos'>
						
					</div>

					";


				}


			}

			$modal.="
					</div>

						<div class='modal-footer d d-flex justify-content-center row'>

							<div class='col col-12 d d-flex justify-content-center flex-wrap'>

								<button type='submit' class='btn btn-primary left__margen boton__enlacesOcultos' id='$parametro4' name='$parametro4'>$parametro9</button>

								&nbsp;&nbsp;&nbsp;&nbsp;

								<a type='button' class='btn btn-danger  left__margen modales__reload pointer__botones' data-dismiss='modal' aria-label='Close' aria-label='Close'>CERRAR</a>


							</div>

							<div class='col col-1 reload__Enviosrealizados text-center'></div>

						</div>

						<input type='hidden' id='tipoPdf' name='tipoPdf' value='".$parametro10."'/>

					</form>

				</div>

			</div>
			";

			return $modal;

		} 




		public function getModalAtributos($parametro1,$parametro2,$parametro3,$parametro4,$parametro5,$parametro6,$parametro7,$parametro8,$parametro9){

			$modal="
			<div class='modal fade modal__ItemsGrup' id='$parametro1' aria-hidden='true'>

				<div class='modal-dialog modal-lg'>

					<form class='modal-content $parametro2'>

						<div class='modal-header row'>

					        <div class='col col-11 text-center'>

					          <h5 class='modal-title' id='modalTitulo'>$parametro3<br><span class='asignado__titulos'></span></h5>

					        </div>

					        <div class='col col-1'>

					          <span class='button pointer__botones modales__reload' data-dismiss='modal' aria-label='Close' aria-label='Close'><i class='fas fa-times-circle'></i></span>

					        </div>

						</div>

						<div class='modal-body row'>

							<input type='hidden' class='idOrganismo' name='idOrganismo'/>

							<input type='hidden' class='idAtributoEscondido' name='idAtributoEscondido'/>

						";


			foreach ($parametro5 as $clave => $valor) {

				if ($parametro7[$clave]=="input") {

					if ($parametro8[$clave]=="disabled") {

						$modal.="

						<div class='col col-4 titulo__enfasis mt-2'>
							$parametro5[$clave]
						</div>


						<div class='col col-8 mt-2'>
							<input type='text' class='$parametro6[$clave] ancho__total__input solo__numero campos__obligatorios text-center' name='$parametro6[$clave]' readonly='readonly' value='0'/>
						</div>

						";

					
					}else if ($parametro8[$clave]=="numero") {

						$modal.="

						<div class='col col-4 titulo__enfasis mt-2'>
							$parametro5[$clave]
						</div>


						<div class='col col-8 mt-2'>
							<input type='text' class='$parametro6[$clave] ancho__total__input solo__numero campos__obligatorios text-center' name='$parametro6[$clave]' value='0'/>
						</div>

						";

					}else if($parametro8[$clave]=="monto"){


						$modal.="

						<div class='col col-4 titulo__enfasis mt-2'>
							$parametro5[$clave]
						</div>


						<div class='col col-8 mt-2'>
							<input type='text' class='$parametro6[$clave] ancho__total__input solo__numero__montos campos__obligatorios text-center' name='$parametro6[$clave]' value='0.00'/>
						</div>

						";						
						
					}else{

						$modal.="

						<div class='col col-4 titulo__enfasis mt-2'>
							$parametro5[$clave]
						</div>


						<div class='col col-8 mt-2'>
							<input type='text' class='$parametro6[$clave] ancho__total__input campos__obligatorios text-center' name='$parametro6[$clave]'/>
						</div>

						";

					}
		

				}else if($parametro7[$clave]=="boton"){

					$modal.="

						<div class='col col-10 titulo__enfasis mt-2'>
							$parametro5[$clave]
						</div>

						<div class='col col-2 mt-2 text-center'>
							<a data-bs-toggle='modal' data-bs-target='#$parametro6[$clave]' class='btn btn-secondary botonAc$parametro6[$clave]'><i class='fas fa-address-card'></i>&nbsp;&nbsp;Agregar</a>'
						</div>

						";						

				}else if($parametro7[$clave]=="select"){

					$modal.="

					<div class='col col-12 titulo__enfasis mt-2'>
						$parametro5[$clave]
					</div>

					<div class='col col-12 mt-2'>
						<select class='$parametro6[$clave] ancho__total__input campos__obligatorios' name='$parametro6[$clave]'></select>
					</div>

					";				

				}else if($parametro7[$clave]=="file"){



					$modal.="

					<div class='col col-12 titulo__enfasis mt-2'>
						$parametro5[$clave]
					</div>

					<div class='col col-12 mt-2'>
						<input type='file' class='$parametro6[$clave] ancho__total__input campos__obligatorios' name='$parametro6[$clave]' accept='application/pdf'/>
					</div>

					";				

				}else if ($parametro8[$clave]=="textos") {
						
					$modal.="

					<div class='col col-12 titulo__enfasis mt-2 uppercase__texto text-center textos__titulazos'>
						
					</div>

					";


				}


			}

			$modal.="
					</div>

						<div class='modal-footer d d-flex justify-content-center row'>

							<div class='col col-12 d d-flex justify-content-center flex-wrap'>

								<a type='button' class='btn btn-primary  left__margen boton__enlacesOcultos' id='$parametro4' name='$parametro4'>$parametro9</a>

								&nbsp;&nbsp;&nbsp;&nbsp;

								<a type='button' class='btn btn-danger  left__margen modales__reload pointer__botones' data-dismiss='modal' aria-label='Close' aria-label='Close'>CERRAR</a>


							</div>

							<div class='col col-1 reload__Enviosrealizados text-center'></div>

						</div>

					</form>

				</div>

			</div>
			";

			return $modal;

		} 


		public function getModalConfiguracionItemsPoa($parametro1,$parametro2,$parametro3,$parametro4,$parametro5,$parametro6,$parametro7,$parametro8,$parametro9){

			$modal= "
			
			<div class='modal fade modal__ItemsGrup' id='$parametro1' aria-hidden='true'>";

			if ($parametro8=="contenedorItemsAc") {
				$modal.="<div class='modal-dialog' style='max-width:90%!important;'>";
			}else{
				$modal.="<div class='modal-dialog modal-lg'>";
			}

			
			$modal.="	<form class='modal-content formularioConfiguracion'>

						<div class='modal-header row'>

					        <div class='col col-11 text-center'>

					          <h5 class='modal-title' id='exampleModalLabel'>$parametro2</h5>

					        </div>

					        <div class='col col-1'>";

				if ($parametro1=="actividadesEditaModalAc") {
					
					$modal.="<span class='button pointer__botones' data-dismiss='modal' aria-label='Close' aria-label='Close'><i class='fas fa-times-circle'></i></span>";

				}else{

					$modal.="<span class='button pointer__botones modales__reload' data-dismiss='modal' aria-label='Close' aria-label='Close'><i class='fas fa-times-circle'></i></span>";

				}


				$modal.= "
					        </div>

						</div>

						<div class='modal-body row $parametro3'>

							<div class='col col-6 d d-flex justify-content-center'>

								<a class='btn btn-warning pointer__botones' id='$parametro4' name='$parametro4'><i class='fas fa-user-plus'></i>&nbsp;&nbsp;Agregar</a>

								<input type='hidden' class='elemento__escondidoI' name='elemento__escondidoI'>

							</div>

							<div class='col col-6 d d-flex justify-content-center'>

								<a class='btn btn-info pointer__botones refrezcar__tabla' id='$parametro5' name='$parametro5'><i class='fas fa-eye'></i>&nbsp;&nbsp;Ver</a>

							</div>

							<div class='$parametro8 $parametro9'>

							<table id='$parametro6' class='col col-12 cell-border mt-4'>

								<thead>

									<tr>";


								foreach ($parametro7 as $clave => $valor) {
								
									$modal.="<th><center>$valor</center></th>";

								}

								$modal.="</tr>

								</thead>

							</table>

						  </div>

						</div>

						<div class='modal-footer d d-flex justify-content-center row'>

							<div class='col col-12 d d-flex justify-content-center flex-wrap'>

								<a type='button' class='btn btn-danger  left__margen modales__reload pointer__botones' data-dismiss='modal' aria-label='Close' aria-label='Close'>CERRAR</a>

							</div>

						</div>

					</form>

				</div>

			</div>";

			return $modal;


		}


		public function getModalConfiguracion($parametro1,$parametro2,$parametro3,$parametro4,$parametro5,$parametro6,$parametro7,$parametro8){

			$modal= "
			
			<div class='modal fade' id='$parametro1' aria-hidden='true'>";

			if ($parametro8=="contenedorItemsAc") {
				$modal.="<div class='modal-dialog modal-xl'>";
			}else{
				$modal.="<div class='modal-dialog modal-lg'>";
			}

			
			$modal.="	<form class='modal-content formularioConfiguracion'>

						<div class='modal-header row'>

					        <div class='col col-11 text-center'>

					          <h5 class='modal-title titulo__modalItems' id='exampleModalLabel'>$parametro2</h5>

					        </div>

					        <div class='col col-1'>";

				if ($parametro1=="actividadesEditaModalAc") {
					
					$modal.="<span class='button pointer__botones' data-dismiss='modal' aria-label='Close' aria-label='Close'><i class='fas fa-times-circle'></i></span>";

				}else{

					$modal.="<span class='button pointer__botones modales__reload' data-dismiss='modal' aria-label='Close' aria-label='Close'><i class='fas fa-times-circle'></i></span>";

				}


				$modal.= "
					        </div>

						</div>

						<div class='modal-body row $parametro3'>

							<div class='col col-6 d d-flex justify-content-center'>

								<a class='btn btn-warning pointer__botones' id='$parametro4' name='$parametro4'><i class='fas fa-user-plus'></i>&nbsp;&nbsp;Agregar</a>

								<input type='hidden' class='elemento__escondidoI' name='elemento__escondidoI'>

							</div>

							<div class='col col-6 d d-flex justify-content-center'>

								<a class='btn btn-info pointer__botones refrezcar__tabla' id='$parametro5' name='$parametro5'><i class='fas fa-eye'></i>&nbsp;&nbsp;Ver</a>

							</div>

							<div class='$parametro8'>

							<table id='$parametro6' class='col col-12 cell-border mt-4'>

								<thead>

									<tr>";


								foreach ($parametro7 as $clave => $valor) {
								
									$modal.="<th><center>$valor</center></th>";

								}

								if ($parametro1!="actividadesEditaModalAc") {
									$modal.="<th>Editar</th>";
								}

								


								$modal.="<th>Eliminar</th>";

								$modal.="</tr>

								</thead>

							</table>

						  </div>

						</div>

					</form>

				</div>

			</div>";

			return $modal;


		}

		public function getModalEditargetModalAuxiliar($parametro1,$parametro2,$parametro3,$parametro4,$parametro5,$parametro6){

			$modal="

				<div class='modal fade' id='$parametro1' aria-hidden='true'>

					<div class='modal-dialog'>

						<form id='$parametro2' class='modal-content'>

						  <input type='hidden' class='enviado' name='enviado'/>

					      <div class='modal-header row'>

					        <div class='col col-11 text-center'>

					          <h5 class='modal-title'>$parametro3</h5>

					        </div>

					        <div class='col col-1'>

					        <span class='button pointer__botones reload__ModalesA' data-dismiss='modal' aria-label='Close' aria-label='Close'><i class='fas fa-times-circle'></i></span>

					        </div>

					      </div>

					      <div class='modal-body row'>

					      ";		



			foreach ($parametro4 as $clavePrincipal => $valorPrincipal) {

				if ($valorPrincipal=="select__1" || $valorPrincipal=="select__2" || $valorPrincipal=="select__3" || $valorPrincipal=="select__grupoG" || $valorPrincipal=="select__tipoOrga" || $valorPrincipal=="select__2Objetivos" || $valorPrincipal=="select__indiCadores") {

					$modal.="
						<div class='col col-4 titulo__enfasis'>$parametro5[$clavePrincipal]</div>
						<select type='text' class='$parametro4[$clavePrincipal]' name='$parametro4[$clavePrincipal]' class='col col-8 text-left'></select>
					";


				}else if($parametro5[$clavePrincipal]=="escondido"){

				$modal.="
						<input type='hidden' class='$parametro4[$clavePrincipal]' name='$parametro4[$clavePrincipal]' class='col col-8 text-left' />
					";



				}else{

					$modal.="
						<div class='col col-4 titulo__enfasis'>$parametro5[$clavePrincipal]</div>
						<input type='text' class='$parametro4[$clavePrincipal]' name='$parametro4[$clavePrincipal]' class='col col-8 text-left' />
					";

				}

			}


			$modal.="
							</div>

							<div class='modal-footer d d-flex justify-content-center row'>

								<div class='col col-12 d d-flex justify-content-center flex-wrap'>

									<a type='button' class='btn btn-primary  left__margen' id='$parametro6' name='$parametro6'>Editar</a>

								</div>

							</div>

						</form>

					</div>

				</div>

			";

			return $modal;

		}




		public function getModalEditargetModal($parametro1,$parametro2,$parametro3,$parametro4,$parametro5,$parametro6){

			$modal="

				<div class='modal fade' id='$parametro1' aria-hidden='true'>

					<div class='modal-dialog'>

						<form id='$parametro2' class='modal-content'>

						  <input type='hidden' class='enviado' name='enviado'/>

					      <div class='modal-header row'>

					        <div class='col col-11 text-center'>

					          <h5 class='modal-title'>$parametro3</h5>

					        </div>

					        <div class='col col-1'>

					        <span class='button pointer__botones' data-dismiss='modal' aria-label='Close' aria-label='Close'><i class='fas fa-times-circle'></i></span>

					        </div>

					      </div>

					      <div class='modal-body row'>

					      ";		



			foreach ($parametro4 as $clavePrincipal => $valorPrincipal) {

				if ($valorPrincipal=="select__1" || $valorPrincipal=="select__2" || $valorPrincipal=="select__3" || $valorPrincipal=="select__grupoG" || $valorPrincipal=="select__2Objetivos" || $valorPrincipal=="select__indiCadores") {

					$modal.="
						<div class='col col-4 titulo__enfasis'>$parametro5[$clavePrincipal]</div>
						<select type='text' class='$parametro4[$clavePrincipal]' name='$parametro4[$clavePrincipal]' class='col col-8 text-left'></select>
					";


				}else if($parametro5[$clavePrincipal]=="escondido"){

				$modal.="
						<input type='hidden' class='$parametro4[$clavePrincipal]' name='$parametro4[$clavePrincipal]' class='col col-8 text-left' />
					";



				}else{

					$modal.="
						<div class='col col-4 titulo__enfasis'>$parametro5[$clavePrincipal]</div>
						<input type='text' class='$parametro4[$clavePrincipal]' name='$parametro4[$clavePrincipal]' class='col col-8 text-left' />
					";

				}

			}


			$modal.="
							</div>

							<div class='modal-footer d d-flex justify-content-center row'>

								<div class='col col-12 d d-flex justify-content-center flex-wrap'>

									<a type='button' class='btn btn-primary  left__margen' id='$parametro6' name='$parametro6'>Editar</a>

								</div>

							</div>

						</form>

					</div>

				</div>

			";

			return $modal;

		}


		public function getModal($parametro1,$parametro2,$parametro3,$parametro4,$parametro5,$parametro6,$parametro7,$parametro8,$parametro9,$parametro10,$parametro11,$parametro12){

			$modal= "
			
			<div class='modal fade' id='$parametro1' aria-hidden='true'>

				<div class='modal-dialog'>

					<form id='$parametro2' class='modal-content'>

					  <input type='hidden' id='enviado' name='enviado'/>

					  <input type='hidden' id='comentarioNecesario' name='comentarioNecesario'/>

				      <div class='modal-header row'>

				        <div class='col col-11 text-center'>

				          <h5 class='modal-title' id='exampleModalLabel'>$parametro3</h5>

				        </div>

				        <div class='col col-1'>

				          <button class='btn-close cerrar__modalRegistros modalCerrar__modales'></button>

				        </div>

				      </div>					 

				      <div class='modal-body row'>

			";

			$acumuladorModales=0;

			foreach ($parametro7 as $clavePrincipal => $valorPrincipal) {

				if ($clavePrincipal==0) {
					$modal.="<div class='row mt-1 estilo__enlaces__modales $parametro11[$clavePrincipal] pointer__botones'>";
				}else{
					$modal.="<div class='row mt-4 estilo__enlaces__modales $parametro11[$clavePrincipal] pointer__botones'>";
				}
				
				$modal.="
					<div class='col col-11 titulo__enfasis modales__titulos text-left'>

						$valorPrincipal

					</div>

					<div class='col col-1 item__remplazoModales'>

						<i class='fas fa-angle-left'></i>

					</div>

				</div>";


				$modal.="<div class='row d d-flex justify-content-center mt-2 $parametro12[$clavePrincipal]'>";

				for ($i=0; $i < $parametro8[$clavePrincipal]; $i++) { 

					$modal.="
						<div class='col col-4 titulo__enfasis $parametro12[$clavePrincipal]'>$parametro6[$acumuladorModales]</div>
						<div id='$parametro5[$acumuladorModales]' name='$parametro5[$acumuladorModales]' class='col col-8 text-left $parametro12[$clavePrincipal]'></div>
					";

					$acumuladorModales++;

				}

				$modal.="</div>";

			}

			$modal.="

				</div>

				<div class='modal-footer d d-flex justify-content-center row'>

				        <div class='col col-12 d d-flex justify-content-center flex-wrap'>";

			foreach ($parametro9 as $claveBoton => $valorBoton) {
			
				$modal.="<button type='button' class='btn $parametro10[$claveBoton] left__margen boton__enlacesOcultos' id='$parametro4[$claveBoton]' name='$parametro4[$claveBoton]'>$valorBoton</button>";

			}

			$modal.="</div>

				        <div class='col col-12 reload__Modales d d-flex justify-content-center'></div>

				        <div class='col col-12 reload__Enviosrealizados d d-flex justify-content-center'></div>

				      </div>

					</form>

				</div>

			</div>";

			return $modal;


		}

		/*=====  End of Funciones principales clases  ======*/
		
		public function getObservacionesPoa($parametro1,$parametro2,$parametro3,$parametro4,$parametro5){

			switch ($parametro1) {

				case 1:
					
					return "<div clas='row text-center d d-flex justify-content-center'>

						<div class='col col-12 text-center mt-2 titulo__enfasis mt-4'>

							$parametro2

						</div>

					</div>";

				break;


				case 2:
					
					return "

						<div class='row d d-flex flex-column justify-content-center card mt-4'>

							<div class='card-body row'>

								<h5 class='card-title text-center titulo__enfasis'>$parametro2</h5>

								<div class='col col-12 mt-4 justificado__textos'>

									$parametro3

								</div>

								<div class='row d d-flex align-items-center justify-content-center col col-12'>

									<div class='col col-6 text-center mt-4'>

										<a href='$parametro4' class='btn btn-info pointer__botones'>IR&nbsp;&nbsp;&nbsp;&nbsp;<i class='fas fa-angle-right'></i></a>

									</div>


									<div class='col col-6 text-center mt-4'>

										<button class='btn btn-primary pointer__botones boton__enlacesOcultos' id='$parametro5' name='$parametro5'><i class='fas fa-share-square'></i>&nbsp;&nbsp;&nbsp;&nbsp;Enviar</button>

										<div class='reload__Enviosrealizados'></div>

									</div>

								</div>

							</div>

						</div>

					";

				break;


			}

		}


	}