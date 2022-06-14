var funcionSoloNumeros=function(parametro1){

$(parametro1).on('input', function () {

	this.value = this.value.replace(/[^0-9]/g, '');

});

}

var solo__numero__montosEscritura=function(parametro1){

$(parametro1).keypress(function(event) {

var $this = $(this);
										    
if ((event.which != 46 || $this.val().indexOf('.') != -1) && ((event.which < 48 || event.which > 57) && (event.which != 0 && event.which != 8))) {
	event.preventDefault();
}

var text = $(this).val();

if ((event.which == 46) && (text.indexOf('.') == -1)) {

	setTimeout(function() {
		
		if ($this.val().substring($this.val().indexOf('.')).length > 3) {

			$this.val($this.val().substring(0, $this.val().indexOf('.') + 3));
		}

	}, 1);
}

if ((text.indexOf('.') != -1) && (text.substring(text.indexOf('.')).length > 2) && (event.which != 0 && event.which != 8) && ($(this)[0].selectionStart >= text.length - 2)) {
	event.preventDefault();
}
										          
});

}


var solo__numero__montos=function(parametro1){

$(parametro1).on('input', function () {

	this.value = this.value.replace(/[^0-9,.]/g, '').replace(',','.');

});

}

var sumarIndicadoresGlobal=function(parametro1,parametro2){

	$(parametro1).on('input', function () {

		var sum = 0;

		$(parametro1).each(function(){
		    sum += parseFloat($(this).val());
		});

		$(parametro2).val(sum.toFixed(2));

	});

}


var sumarIndicadoresGlobalNormal=function(parametro1,parametro2){

	$(parametro1).on('input', function () {

		var sum = 0;

		$(parametro1).each(function(){
		    sum += parseFloat($(this).val());
		});

		$(parametro2).val(sum);

	});

}

var cambiantesNum=function(parametro1){

$(parametro1).click(function(event) {

	if ($(this).val()=="0" || $(this).val()=="vacante") {

		$(this).val(" ");

	}
										          
});	

$(parametro1).blur(function(event) {

	if ($(this).val()==" ") {

		$(this).val("0");

	}
										          
});	

}

var cambiantesInputs=function(parametro1){

$(parametro1).click(function(event) {

	if ($(this).val()=="0.00") {

		$(this).val(" ");

	}
										          
});	

$(parametro1).blur(function(event) {

	if ($(this).val()==" ") {

		$(this).val("0.00");

	}
										          
});	

}

function validacionRegistro(parametro1){

	var sumadorErrores=0;

	$(parametro1).each(function(index) {

		if($(this).val()==""){
	     	sumadorErrores++;
		}

	});

	if (sumadorErrores==0) {
		return true;
	}else{
		return false;
	}

}

var validacionRegistroMostrarErrores=function(parametro1){

	var sumadorErrores=0;

	$(parametro1).each(function(index) {

		if($(this).val()==""){
	    	$(this).addClass('error');
		}else{
	    	$(this).removeClass('error');
		}
	  
	});

}

function concatenarValores(parametro1){
	
	var array = new Array(); 

    $(parametro1).each(function(index) {

        array.push($(this).val());

    });

    return array;

}


function concatenarValoresAttr(parametro1,parametro2,parametro3){
	
	var array = new Array(); 

    $(parametro1).each(function(index) {

    	if($(this).hasClass(parametro2+parametro3)) {

        	array.push($(this).attr('attr'));

    	}

    });

    return array;

}

function concatenarValoresAttrPre(parametro1,parametro2,parametro3){
	
	var array = new Array(); 

    $(parametro1).each(function(index) {

	    if($(this).hasClass(parametro2+parametro3)) {

	        array.push($(this).val());

	    } 

    });

    return array;

}


var guardarElementosGeneral=function(parametro1,parametro2,parametro3,parametro4){

$(parametro1).click(function(e){

	e.preventDefault();	

		var mesesArray = concatenarValores($(".meses__atadosAjax"+parametro2));
		var valoresArray = concatenarValores($(".obligatorios"+parametro2));

		if (parametro3=="suministrosAE") {

			var suministrosArray = concatenarValoresAttr($(".obligatorios"+parametro2),"clase__suministros",parametro2);
			var valoresSArray = concatenarValoresAttrPre($(".obligatorios"+parametro2),"clase__suministros",parametro2);

		}

		var validador= validacionRegistro($(".obligatorios"+parametro2));
		validacionRegistroMostrarErrores($(".obligatorios"+parametro2));

		$(parametro1).hide();
		$(parametro4).html('<img src="images/reloadGit.webp" style="width:50%; height:30px; border-radius:1em;">');

		var idProgramacionFinanciera=$(this).attr('idProgramacionFinanciera');
		var idOrganismo=$(this).attr('idOrganismo');
		var idActividad=$(this).attr('idActividad');
		var idItem=$(this).attr('idItem');

		if (validador==false) {

			alertify.set("notifier","position", "top-center");
			alertify.notify("Elementos obligatorios", "error", 5, function(){});

			$(parametro1).show();
			$(parametro4).html(' ');

		}else{


		var confirm= alertify.confirm('¿Está seguro de la información ingresada?','¿Está seguro de la información ingresada?',null,null).set('labels', {ok:'Confirmar', cancel:'Cancelar'});   

		confirm.set({transition:'slide'});    

		confirm.set('onok', function(){ //callbak al pulsar botón positivo


			var paqueteDeDatos = new FormData();

			paqueteDeDatos.append("idProgramacionFinanciera",idProgramacionFinanciera);
			paqueteDeDatos.append("idOrganismo",idOrganismo);
			paqueteDeDatos.append("idActividad",idActividad);
			paqueteDeDatos.append("idItem",idItem);

			paqueteDeDatos.append("tipo",parametro3);
			paqueteDeDatos.append("mesesArray",JSON.stringify(mesesArray));
			paqueteDeDatos.append("valoresArray",JSON.stringify(valoresArray));

			if (parametro3=="suministrosAE") {

				paqueteDeDatos.append("suministrosArray",JSON.stringify(suministrosArray));
				paqueteDeDatos.append("valoresSArray",JSON.stringify(valoresSArray));

			}

			$.ajax({

				type:"POST",
				url:"modelosBd/inserta/insertaAcciones.md.php",
				contentType: false,
				data:paqueteDeDatos,
				processData: false,
				cache: false, 
				success:function(response){

			      	var elementos=JSON.parse(response);

			      	var mensaje=elementos['mensaje'];
			      	var sumar=elementos['sumar'];

			      	if (mensaje==20) {

						alertify.set("notifier","position", "top-center");
						alertify.notify("Su valor suma "+sumar+" superando el techo presupuestario", "error", 4, function(){});


						$(parametro1).show();
						$(parametro4).html(' ');


			      	}else if(mensaje==21){

						alertify.set("notifier","position", "top-center");
						alertify.notify("El presupuesto total del Ítem no puede ser cero", "error", 4, function(){});


						$(parametro1).show();
						$(parametro4).html(' ');


			      	}else if(mensaje==25){

						alertify.set("notifier","position", "top-center");
						alertify.notify("Es necesario escoger los items Salarios unificados, Aporte patronal, Fondos de reserva, Décimo tercer sueldo y Décimo cuarto sueldo para poder llenar está mátriz", "error", 20, function(){});


						$(parametro1).show();
						$(parametro4).html(' ');

			      	}else if(mensaje==105){

						alertify.set("notifier","position", "top-center");
						alertify.notify("Es obligatorio escoger el item de honorarios para esta actividad", "error", 20, function(){});


						$(parametro1).show();
						$(parametro4).html(' ');

			      	}else{

						alertify.set("notifier","position", "top-center");
						alertify.notify("Presupuesto ingresado correctamente", "success", 4, function(){});


						$(parametro1).show();
						$(parametro4).html(' ');

						$(parametro1).hide();

						$(".eliminarDeportivas"+parametro2).hide();
						$(".eliminarFilaS"+parametro2).hide();
						$(".eliminarSueldos"+parametro2).hide();
						$(".eliminarHonorarios"+parametro2).hide();


			      	}


				},
				error:function(){

				}
					
			});	

			});

			confirm.set('oncancel', function(){ //callbak al pulsar botón negativo
				alertify.set("notifier","position", "top-center");
				alertify.notify("Acción cancelada", "error", 1, function(){

					$(".boton__enlacesOcultos").show();
					$('.reload__Enviosrealizados').html(' ');

				}); 
			});
					

		}
 	

});
		

}


var tipoDeporte=function(parametro1,parametro2){

	indicador=21;

	$.ajax({

	  data: {indicador:indicador},
      dataType: 'html',
      type:'POST',
	  url:'modelosBd/validaciones/selector.modelo.php'

	}).done(function(listar__lugar){

	  $(parametro1).html(listar__lugar);

	  if (parametro2!=null && parametro2!=undefined && parametro2!="") {

	  	$(parametro1).val(parametro2);

	  }

	}).fail(function(){

	  

	});


}


var provincias=function(parametro1,parametro2){

	indicador=1;

	$.ajax({

	  data: {indicador:indicador},
      dataType: 'html',
      type:'POST',
	  url:'modelosBd/validaciones/selector.modelo.php'

	}).done(function(listar__lugar){

	  $(parametro1).html(listar__lugar);


	  if (parametro2!=null && parametro2!=undefined && parametro2!="") {

	  	$(parametro1).val(parametro2);

	  }

	}).fail(function(){

	  

	});

}


var pais=function(parametro1,parametro2){

	indicador=22;

	$.ajax({

	  data: {indicador:indicador},
      dataType: 'html',
      type:'POST',
	  url:'modelosBd/validaciones/selector.modelo.php'

	}).done(function(listar__lugar){

	  $(parametro1).html(listar__lugar);


	  if (parametro2!=null && parametro2!=undefined && parametro2!="") {

	  	$(parametro1).val(parametro2);

	  }


	}).fail(function(){

	  

	});

}

var alcance=function(parametro1,parametro2){

	indicador=23;

	$.ajax({

	  data: {indicador:indicador},
      dataType: 'html',
      type:'POST',
	  url:'modelosBd/validaciones/selector.modelo.php'

	}).done(function(listar__lugar){

	  $(parametro1).html(listar__lugar);


	  if (parametro2!=null && parametro2!=undefined && parametro2!="") {

	  	$(parametro1).val(parametro2);

	  }


	}).fail(function(){

	  

	});

}

var eliminarFilas=function(parametro1,parametro2){

	$(parametro1).click(function(e){

		$(parametro2).remove();

	});

}


var consultaDinardap=function(parametro1,parametro2){

	$(parametro1).on('input', function () {

	var contador=$(this).val();

	if (contador.length==10) {

		$.ajax({

			url:"php/dinardap.php",
			type:"POST",
			dataType:"json",
			data:"cedula="+$(this).val(),
			success:function(datos){

		    	if (datos==null) {
		                 
					alertify.set("notifier","position", "top-center");
					alertify.notify("La cédula ingresada no existe", "error", 5, function(){});

		    	}else{

		    		for (var i = 0; i < parametro2.length; i++) {
		    			$(parametro2[i]).val(datos.nombre);
		    		}

		        }          
		               
		    },
		    error:function(response,status,error){
		    	alert("no encontrado");
		    } 

	});


	}


 });

}

var regimenChange=function(parametro1){

	$(parametro1).change(function(e){

		if ($(this).val()=="") {

			alertify.set("notifier","position", "top-center");
			alertify.notify("El régimen no puede ser vacío", "error", 4, function(){});

			$(".regimenValidas").hide();

		}else{

			var paqueteDeDatos = new FormData();

			var idValor=$(this).val();
			var idOrganismo=$(this).attr('idOrganismo');

			paqueteDeDatos.append('tipo',"regimen");	
			paqueteDeDatos.append('idValor',idValor);	
			paqueteDeDatos.append('idOrganismo',idOrganismo);	

			$.ajax({

				type:"POST",
				url:"modelosBd/inserta/insertaAcciones.md.php",
				contentType: false,
				data:paqueteDeDatos,
				processData: false,
				cache: false, 
				success:function(response){

				   	var elementos=JSON.parse(response);

				   	var mensaje=elementos['mensaje'];

					if(mensaje==1){

						alertify.set("notifier","position", "top-center");
						alertify.notify("Registro actualizado", "success", 4, function(){});

						$(".regimenValidas").show();

				   	}

				},
				error:function(){

				}
						
			});	

		}

	});

}


var eliminarEdit=function(parametro1,parametro2,parametro3,parametro4,idProgramacionFinanciera,idActividad){

	$(parametro1).click(function(e){

		e.preventDefault();	

		var confirm= alertify.confirm('¿Está seguro de eliminar?','¿Está seguro de eliminar?',null,null).set('labels', {ok:'Confirmar', cancel:'Cancelar'});   

		confirm.set({transition:'slide'});    

		confirm.set('onok', function(){ //callbak al pulsar botón positivo

			var paqueteDeDatos = new FormData();


			if (parametro3=="eliminarHonorarios") {

				var organismoIdPrin=$("#organismoIdPrin").val();
				paqueteDeDatos.append('idOrganismo',organismoIdPrin);
				paqueteDeDatos.append('idActividad',idActividad);
				
			}

			if (parametro3=="eliminaSueldos") {


				var organismoIdPrin=$("#organismoIdPrin").val();
				paqueteDeDatos.append('idOrganismo',organismoIdPrin);
				paqueteDeDatos.append('idActividad',idActividad);
				paqueteDeDatos.append('idSueldos',parametro4);
				
			}

			if (parametro3=="eliminaPda") {
				var organismoIdPrin=$("#organismoIdPrin").val();
				paqueteDeDatos.append('idProgramacionFinanciera',idProgramacionFinanciera);	
				paqueteDeDatos.append('idOrganismo',organismoIdPrin);	
			}

			paqueteDeDatos.append('tipo',parametro3);	
			paqueteDeDatos.append('idEnviado',parametro4);
				  
			$.ajax({

				type:"POST",
				url:"modelosBd/inserta/eliminaAcciones.md.php",
				contentType: false,
				data:paqueteDeDatos,
				processData: false,
				cache: false, 
				success:function(response){

			      	var elementos=JSON.parse(response);

			      	var mensaje=elementos['mensaje'];

					if(mensaje==1){

						alertify.set("notifier","position", "top-center");
						alertify.notify("Registro eliminado", "success", 4, function(){});

						$(parametro2).remove();

			      	}

				},
				error:function(){

				}
					
			});	

		});

		confirm.set('oncancel', function(){ 

			alertify.set("notifier","position", "top-center");
			alertify.notify("Acción cancelada", "error", 1, function(){

				$(boton).show();

			}); 

		});   

	});

}



var segmentosAnadidos=function(parametro1,parametro2,parametro3,parametro4){

	var agregador=0;

	$(parametro1).click(function(e){

		agregador++;

		e.preventDefault();	

		if (parametro3=="input"){

			$(parametro2).append('<div class="d d-flex '+parametro4[3]+agregador+'"><input type="text" class="'+parametro4[0]+parametro4[1]+' clase__suministros'+parametro4[1]+' ancho__total__input mt-2 '+parametro4[3]+agregador+'" attr="'+parametro4[2]+'" value="0"/>&nbsp;<button class="eliminar'+agregador+' '+parametro4[3]+agregador+' btn btn-danger mt-2"  idContador="'+agregador+'" value="0"/><i class="fas fa-trash"></i></button></div>');

			eliminarFilas($(".eliminar"+agregador),$("."+parametro4[3]+agregador));

			funcionSoloNumeros($(".clase__suministros"+parametro4[1]));

			cambiantesNum($(".clase__suministros"+parametro4[1]));

		}
	  

	});

}

var segmentosHonorarios=function(parametro1,parametro2,parametro3){

	var agregador=0;

	$(parametro1).click(function(e){

		agregador++;

		e.preventDefault();	

			$(parametro2).append('<tr class="item__Pre'+agregador+' tr__enlaces'+agregador+'"><td><center><input type="text" class="cedulaP'+agregador+' ancho__total__input obligatorios'+agregador+' cambiador__unanimesReal'+agregador+'" id="cedulaP'+agregador+'" style="width:150px!important;"/></center></td><td><center><input type="text" class="apellidosNom'+agregador+' ancho__total__input obligatorios'+agregador+'" id="apellidosNom'+agregador+'" style="width:150px!important;"/></center></td><td><center><input type="text" class="cargo'+agregador+' ancho__total__input obligatorios'+agregador+'" id="cargo'+agregador+'" style="width:150px!important;"/></center></td><td><center><select class="tipoCargo'+agregador+' ancho__total__input obligatorios'+agregador+'" id="tipoCargo'+agregador+'" style="width:150px!important;"></select></center></td><td><center><input type="text" class="honorarioMensual'+agregador+' ancho__total__input obligatorios'+agregador+' cambiador__unanimes'+agregador+'" value="0.00" id="honorarioMensual'+agregador+'" style="width:150px!important;"/></center></td></tr>');

				/*===========================================
				=            Acciones realizadas            =
				===========================================*/
							
				consultaDinardap($(".cedulaP"+agregador),[$(".apellidosNom"+agregador)]);

				if (parametro3[1]==1) {

					$(".tipoCargo"+agregador).html('<option value="Administrativo">Administrativo</option>');

				}else{

					$(".tipoCargo"+agregador).html('<option value="Técnico">Técnico</option>');

				}



				cambiantesNum($(".cambiador__unanimesReal"+agregador));
				funcionSoloNumeros($(".cambiador__unanimesReal"+agregador));

				solo__numero__montosEscritura($(".cambiador__unanimes"+agregador));
				solo__numero__montos($(".cambiador__unanimes"+agregador));
				cambiantesInputs($(".cambiador__unanimes"+agregador));

				/*=====  End of Acciones realizadas  ======*/



						
			$('.item__Pre'+agregador).append('<td><center><input type="text" class="enero'+agregador+' ancho__total__input meses__atados'+agregador+'  meses__atadosAjax'+agregador+'" value="0.00"/></center></td><td><center><input type="text" class="febrero'+agregador+' ancho__total__input meses__atados'+agregador+'  meses__atadosAjax'+agregador+'" value="0.00"/></center></td><td><center><input type="text" class="marzo'+agregador+' ancho__total__input meses__atados'+agregador+'  meses__atadosAjax'+agregador+'" value="0.00"/></center></td><td><center><input type="text" class="abril'+agregador+' ancho__total__input meses__atados'+agregador+'  meses__atadosAjax'+agregador+'" value="0.00"/></center></td><td><center><input type="text" class="mayo'+agregador+' ancho__total__input meses__atados'+agregador+'  meses__atadosAjax'+agregador+'" value="0.00"/></center></td><td><center><input type="text" class="junio'+agregador+' ancho__total__input meses__atados'+agregador+'  meses__atadosAjax'+agregador+'" value="0.00"/></center></td><td><center><input type="text" class="julio'+agregador+' ancho__total__input meses__atados'+agregador+'  meses__atadosAjax'+agregador+'" value="0.00"/></center></td><td><center><input type="text" class="agosto'+agregador+' ancho__total__input meses__atados'+agregador+'  meses__atadosAjax'+agregador+'" value="0.00"/></center></td><td><center><input type="text" class="septiembre'+agregador+' ancho__total__input meses__atados'+agregador+'  meses__atadosAjax'+agregador+'" value="0.00"/></center></td><td><center><input type="text" class="octubre'+agregador+' ancho__total__input meses__atados'+agregador+'  meses__atadosAjax'+agregador+'" value="0.00"/></center></td><td><center><input type="text" class="noviembre'+agregador+' ancho__total__input meses__atados'+agregador+'  meses__atadosAjax'+agregador+'" value="0.00"/></center></td><td><center><input type="text" class="diciembre'+agregador+' ancho__total__input meses__atados'+agregador+'  meses__atadosAjax'+agregador+'" value="0.00"/></center></td><td><center><input type="text" class="totalSumaItem'+agregador+' ancho__total__input  meses__atadosAjax'+agregador+'  meses__atadosAjax'+agregador+'" value="0.00" /></center></td>');

			solo__numero__montosEscritura($(".meses__atadosAjax"+agregador));
			solo__numero__montos($(".meses__atadosAjax"+agregador));
			cambiantesInputs($(".meses__atadosAjax"+agregador));

			sumarIndicadoresGlobal($(".meses__atados"+agregador),$(".totalSumaItem"+agregador));


			$('.item__Pre'+agregador).append('<td><center style="display:flex;align-items:center;"><button id="guardarMatriz'+agregador+'" tipo="poaAdministrativo" idProgramacionFinanciera="'+agregador+'" class="btn btn-primary mt-2" idOrganismo="'+parametro3[0]+'" idActividad="'+parametro3[1]+'" ><i class="fas fa-save"></i></button><div class="reload__'+agregador+'"></div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button class="eliminarHonorarios'+agregador+' btn btn-danger"><i class="fas fa-trash"></i></button></center></td>');

			guardarElementosGeneral($("#guardarMatriz"+agregador),agregador,"honorarios",$(".reload__"+agregador));


			eliminarFilas($(".eliminarHonorarios"+agregador),$(".item__Pre"+agregador));


	});

}


var segmentosSueldosSalarios=function(parametro1,parametro2,parametro3){

	var agregador=0;

	$(parametro1).click(function(e){

		e.preventDefault();	

		agregador++;

		$(parametro2).append('<tr class="item__Pre'+agregador+' tr__enlaces'+agregador+'"><td><center><input type="text" class="cedulaP'+agregador+' ancho__total__input obligatorios'+agregador+' cambiador__unanimesReal'+agregador+'" id="cedulaP'+agregador+'" style="width:150px!important;"/></center></td><td><center><input type="text" class="apellidosNom'+agregador+' ancho__total__input obligatorios'+agregador+'" id="apellidosNom'+agregador+'" style="width:150px!important;"/></center></td><td><center><input type="text" class="cargo'+agregador+' ancho__total__input obligatorios'+agregador+'" id="cargo'+agregador+'" style="width:150px!important;"/></center></td><td><center><select class="tipoCargo'+agregador+' ancho__total__input obligatorios'+agregador+'" id="tipoCargo'+agregador+'" style="width:150px!important;"></select></center></td><td><center><input type="text" class="tiempoMeses'+agregador+' ancho__total__input obligatorios'+agregador+' cambiador__unanimesReal'+agregador+'" id="tiempoMeses'+agregador+'" style="width:50px!important;" value="0"/></center></td><td><center><input type="text" class="sueldoMensual'+agregador+' ancho__total__input obligatorios'+agregador+' cambiador__unanimes'+agregador+'" value="0.00" id="sueldoMensual'+agregador+'"/></center></td><td><center><input type="text" class="aporteIess'+agregador+' ancho__total__input obligatorios'+agregador+' cambiador__unanimes'+agregador+'" id="aporteIess'+agregador+'" value="0.00"/></center></td><td><center><input type="text" class="decimoTercera'+agregador+' ancho__total__input obligatorios'+agregador+' cambiador__unanimes'+agregador+'" value="0.00" id="decimoTercera'+agregador+'"/></center></td><td><center><select class="mensualizaTercera'+agregador+' ancho__total__input obligatorios'+agregador+'" id="mensualizaTercera'+agregador+'"><option value="">--Seleccione--</option><option value="si">Si</option><option value="no">No</option></select></center></td><td><center><input type="text" class="decimoCuarta'+agregador+' ancho__total__input obligatorios'+agregador+' cambiador__unanimes'+agregador+'" value="0.00" id="decimoCuarta'+agregador+'"/></center></td><td><center><select class="mensualizaCuarta'+agregador+' ancho__total__input obligatorios'+agregador+'" id="mensualizaCuarta'+agregador+'"><option value="">--Seleccione--</option><option value="si">Si</option><option value="no">No</option></select></center></td><td><center><input type="text" class="fondosDeReservas'+agregador+' ancho__total__input obligatorios'+agregador+' cambiador__unanimes'+agregador+'" value="0.00" id="fondosDeReservas'+agregador+'"/></center></td></tr>');

			/*===========================================
			=            Acciones realizadas            =
			===========================================*/
							
			consultaDinardap($(".cedulaP"+agregador),[$(".apellidosNom"+agregador)]);

			if (parametro3[1]==1) {

				$(".tipoCargo"+agregador).html('<option value="">--Seleccione--</option><option value="Administrativo">Administrativo</option><option value="Mantenimiento">Mantenimiento</option><option value="Mantenimiento de Escenarios deportivos">Mantenimiento de Escenarios deportivos</option>');

			}else{

				$(".tipoCargo"+agregador).html('<option value="Técnico">Técnico</option>');

			}



			cambiantesNum($(".cambiador__unanimesReal"+agregador));
			funcionSoloNumeros($(".cambiador__unanimesReal"+agregador));

			solo__numero__montosEscritura($(".cambiador__unanimes"+agregador));
			solo__numero__montos($(".cambiador__unanimes"+agregador));
			cambiantesInputs($(".cambiador__unanimes"+agregador));

			/*=====  End of Acciones realizadas  ======*/

			$('.item__Pre'+agregador).append('<td><center><input type="text" class="enero'+agregador+' ancho__total__input meses__atados'+agregador+'  meses__atadosAjax'+agregador+'" value="0.00"/></center></td><td><center><input type="text" class="febrero'+agregador+' ancho__total__input meses__atados'+agregador+'  meses__atadosAjax'+agregador+'" value="0.00"/></center></td><td><center><input type="text" class="marzo'+agregador+' ancho__total__input meses__atados'+agregador+'  meses__atadosAjax'+agregador+'" value="0.00"/></center></td><td><center><input type="text" class="abril'+agregador+' ancho__total__input meses__atados'+agregador+'  meses__atadosAjax'+agregador+'" value="0.00"/></center></td><td><center><input type="text" class="mayo'+agregador+' ancho__total__input meses__atados'+agregador+'  meses__atadosAjax'+agregador+'" value="0.00"/></center></td><td><center><input type="text" class="junio'+agregador+' ancho__total__input meses__atados'+agregador+'  meses__atadosAjax'+agregador+'" value="0.00"/></center></td><td><center><input type="text" class="julio'+agregador+' ancho__total__input meses__atados'+agregador+'  meses__atadosAjax'+agregador+'" value="0.00"/></center></td><td><center><input type="text" class="agosto'+agregador+' ancho__total__input meses__atados'+agregador+'  meses__atadosAjax'+agregador+'" value="0.00"/></center></td><td><center><input type="text" class="septiembre'+agregador+' ancho__total__input meses__atados'+agregador+'  meses__atadosAjax'+agregador+'" value="0.00"/></center></td><td><center><input type="text" class="octubre'+agregador+' ancho__total__input meses__atados'+agregador+'  meses__atadosAjax'+agregador+'" value="0.00"/></center></td><td><center><input type="text" class="noviembre'+agregador+' ancho__total__input meses__atados'+agregador+'  meses__atadosAjax'+agregador+'" value="0.00"/></center></td><td><center><input type="text" class="diciembre'+agregador+' ancho__total__input meses__atados'+agregador+'  meses__atadosAjax'+agregador+'" value="0.00"/></center></td><td><center><input type="text" class="totalSumaItem'+agregador+' ancho__total__input  meses__atadosAjax'+agregador+'  meses__atadosAjax'+agregador+'" value="0.00" /></center></td>');

			solo__numero__montosEscritura($(".meses__atadosAjax"+agregador));
			solo__numero__montos($(".meses__atadosAjax"+agregador));
			cambiantesInputs($(".meses__atadosAjax"+agregador));


			$('.item__Pre'+agregador).append('<td><center style="display:flex;align-items:center;"><button id="guardarMatriz'+agregador+'" tipo="poaAdministrativo" idProgramacionFinanciera="'+agregador+'" class="btn btn-primary mt-2" idOrganismo="'+parametro3[0]+'" idActividad="'+parametro3[1]+'" ><i class="fas fa-save"></i></button><div class="reload__'+agregador+'"></div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button class="eliminarSueldos'+agregador+' btn btn-danger"><i class="fas fa-trash"></i></button></center></td>');

			/*================================
			=            Acciones            =
			================================*/
							
			calculaFomrulas($(".sueldoMensual"+agregador),$(".tiempoMeses"+agregador),[$(".aporteIess"+agregador),$(".fondosDeReservas"+agregador),$(".decimoTercera"+agregador),$(".decimoCuarta"+agregador)],$(".regimenSuelDos"),$(".mensualizaTercera"+agregador),$(".mensualizaCuarta"+agregador),agregador);
							
			/*=====  End of Acciones  ======*/

			eliminarFilas($(".eliminarSueldos"+agregador),$(".item__Pre"+agregador));

			guardarElementosGeneral($("#guardarMatriz"+agregador),agregador,"sueldosSalarios",$(".reload__"+agregador));



	});

}


var agregador=0;

var segmentosAcDeportivas=function(parametro1,parametro2,parametro3,itemPreesupuestario,nombreItem,parametro5,idProgramacionFinanciera){

	$(parametro1).click(function(e){

		agregador++;

		e.preventDefault();	

		$(parametro2).append('<tr class="item__Pre'+agregador+' tr__enlaces'+parametro5+'"><td><center>'+itemPreesupuestario+'</center></td><td><center>'+nombreItem+'</center></td><td><center><select class="tipoFinanciamiento'+agregador+' ancho__total__input__selects obligatorios'+agregador+'" id="tipoFinanciamiento'+agregador+'"><option value="">--Seleccione--</option><option value="corriente">Corriente</option><option value="autogestion">Autogestión</option></select></center></td><td><center><input type="text" class="nombreEvento'+agregador+' ancho__total__input obligatorios'+agregador+'" id="nombreEvento'+agregador+'"/></center></td><td><center><select class="deporteEvento'+agregador+' ancho__total__input__selects obligatorios'+agregador+'" id="deporteEvento'+agregador+'"></select></center></td><td><center><select class="provinciaE'+agregador+' ancho__total__input__selects obligatorios'+agregador+'" id="provinciaE'+agregador+'"></select></center></td><td><center><select class="ciudadPais'+agregador+' ancho__total__input__selects obligatorios'+agregador+'" id="ciudadPais'+agregador+'"></select></center></td><td><center><select class="alcanceE'+agregador+' ancho__total__input__selects obligatorios'+agregador+'" id="alcanceE'+agregador+'"></select></center></td><td><center><input type="date" class="fechaInicio'+agregador+' ancho__total__input obligatorios'+agregador+'" id="fechaInicio'+agregador+'"/></center></td><td><center><input type="date" class="fechaFin'+agregador+' ancho__total__input obligatorios'+agregador+'" id="fechaFin'+agregador+'"/></center></td><td><center><select class="genero'+agregador+' ancho__total__input__selects obligatorios'+agregador+'" id="genero'+agregador+'"><option value="">--Escoger gégnero--</option><option value="masculino">Masculino</option><option value="femenino">Femenino</option><option value="ambas">Ambas</option></select></center></td><td><center><input type="text" class="categoriaE'+agregador+' ancho__total__input obligatorios'+agregador+'" id="categoriaE'+agregador+'"/></center></td><td><center><input type="text" class="numeroEntrenadoresO'+agregador+' ancho__total__input obligatorios'+agregador+' entre__sumas'+agregador+' inputs__c'+agregador+'" id="numeroEntrenadoresO'+agregador+'" value="0"/></center></td><td><center><input type="text" class="numeroAtletas'+agregador+' ancho__total__input obligatorios'+agregador+' entre__sumas'+agregador+' inputs__c'+agregador+'" id="numeroAtletas'+agregador+'" value="0"/></center></td><td><center><input type="text" class="total'+agregador+' ancho__total__input obligatorios'+agregador+'" id="total'+agregador+'" readonly="" value="0"/></center></td><td><center><input type="text" class="mujeresBeneficiarios'+agregador+' ancho__total__input obligatorios'+agregador+' inputs__c'+agregador+'" value="0" id="mujeresBeneficiarios'+agregador+'"/></center></td><td><center><input type="text" class="hombresBeneficiarios'+agregador+' ancho__total__input obligatorios'+agregador+' inputs__c'+agregador+'" value="0" id="hombresBeneficiarios'+agregador+'"/></center></td><td><center><textarea class="detalle__nuevo'+agregador+' ancho__total__textareas obligatorios'+agregador+'" id="detalle__nuevo'+c.idProgramacionFinanciera+'"></textarea></center></td><td><center><textarea class="justificacionAdquisi'+agregador+' ancho__total__textareas obligatorios'+agregador+'" id="justificacionAdquisi'+agregador+'"></textarea></center></td><td><center><input type="text" class="cantidadBien__servicios'+agregador+' ancho__total__input obligatorios'+agregador+'" id="cantidadBien__servicios'+agregador+'"/></center></td></tr>');

			// if ( $(".enero"+agregador).length > 0 ) {
 				
			// }else{

				$('.item__Pre'+agregador).append('<td><center><input type="text" class="enero'+agregador+' ancho__total__input meses__atados'+agregador+'  meses__atadosAjax'+agregador+'" value="0.00"/></center></td><td><center><input type="text" class="febrero'+agregador+' ancho__total__input meses__atados'+agregador+'  meses__atadosAjax'+agregador+'" value="0.00"/></center></td><td><center><input type="text" class="marzo'+agregador+' ancho__total__input meses__atados'+agregador+'  meses__atadosAjax'+agregador+'" value="0.00"/></center></td><td><center><input type="text" class="abril'+agregador+' ancho__total__input meses__atados'+agregador+'  meses__atadosAjax'+agregador+'" value="0.00"/></center></td><td><center><input type="text" class="mayo'+agregador+' ancho__total__input meses__atados'+agregador+'  meses__atadosAjax'+agregador+'" value="0.00"/></center></td><td><center><input type="text" class="junio'+agregador+' ancho__total__input meses__atados'+agregador+'  meses__atadosAjax'+agregador+'" value="0.00"/></center></td><td><center><input type="text" class="julio'+agregador+' ancho__total__input meses__atados'+agregador+'  meses__atadosAjax'+agregador+'" value="0.00"/></center></td><td><center><input type="text" class="agosto'+agregador+' ancho__total__input meses__atados'+agregador+'  meses__atadosAjax'+agregador+'" value="0.00"/></center></td><td><center><input type="text" class="septiembre'+agregador+' ancho__total__input meses__atados'+agregador+'  meses__atadosAjax'+agregador+'" value="0.00"/></center></td><td><center><input type="text" class="octubre'+agregador+' ancho__total__input meses__atados'+agregador+'  meses__atadosAjax'+agregador+'" value="0.00"/></center></td><td><center><input type="text" class="noviembre'+agregador+' ancho__total__input meses__atados'+agregador+'  meses__atadosAjax'+agregador+'" value="0.00"/></center></td><td><center><input type="text" class="diciembre'+agregador+' ancho__total__input meses__atados'+agregador+'  meses__atadosAjax'+agregador+'" value="0.00"/></center></td><td><center><input type="text" class="totalSumaItem'+agregador+' ancho__total__input  meses__atadosAjax'+agregador+'  meses__atadosAjax'+agregador+'" readonly="readonly" value="0.00"/></center></td>');


					solo__numero__montosEscritura($(".meses__atados"+agregador));
					solo__numero__montos($(".meses__atados"+agregador));

					sumarIndicadoresGlobal($(".meses__atados"+agregador),$(".totalSumaItem"+agregador));

					sumarIndicadoresGlobalNormal($(".entre__sumas"+agregador),$(".total"+agregador));


					tipoDeporte($(".deporteEvento"+agregador));
					provincias($(".provinciaE"+agregador));
					pais($(".ciudadPais"+agregador));
					alcance($(".alcanceE"+agregador));


					cambiantesInputs($(".meses__atados"+agregador));

					$('.item__Pre'+agregador).append('<td><center class="d d-flex justify-content-center align-items-center"><button id="guardarMatriz'+agregador+'" tipo="poaAdministrativo" idProgramacionFinanciera="'+idProgramacionFinanciera+'" class="btn btn-primary mt-2" idOrganismo="'+parametro3[0]+'" idActividad="'+parametro3[1]+'" idItem="'+parametro3[2]+'"><i class="fas fa-save"></i></button><div class="reload__'+agregador+'"></div>&nbsp;&nbsp;<button class="eliminarDeportivas'+agregador+' btn btn-danger"><i class="fas fa-trash"></i></button></center></td>');

					eliminarFilas($(".eliminarDeportivas"+agregador),$(".item__Pre"+agregador));
					guardarElementosGeneral($("#guardarMatriz"+agregador),agregador,"actividadesDeportivades",$(".reload__"+agregador));



			// }


	});

}

var segmentosSuministros=function(parametro1,parametro2,parametro3){

	var agregador=0;

	$(parametro1).click(function(e){

		e.preventDefault();	

		agregador++;

		$(parametro2).append('<tr class="item__PreSumi'+agregador+'"><td><center><select class="tipoHoja'+agregador+' ancho__total__input obligatorios'+agregador+'" id="tipoHoja'+agregador+'"><option value="">--Seleccione--</option><option value="Escenario deportivo/residencia para fomento deportivo">Escenario deportivo/residencia para fomento deportivo</option><option value="Administrativo">Administrativo</option></select></center></td><td><center><textarea class="nombreEscenarioD'+agregador+' ancho__total__textareas obligatorios'+agregador+'" id="nombreEscenarioD'+agregador+'"></textarea></center></td><td><input type="text" class="suministroE'+agregador+'  obligatorios'+agregador+' ancho__total__input clase__suministros'+agregador+'" attr="energia" value="0"/>&nbsp;&nbsp;<button class="agregarE'+agregador+' btn btn-warning mt-2" style="position:relative; left:20%!important;">Agregar</button><div class="agregadosElec'+agregador+'"></div></td><td><input type="text" class="suministroA'+agregador+'  obligatorios'+agregador+' ancho__total__input clase__suministros'+agregador+'" attr="agua" value="0"/>&nbsp;&nbsp;<button class="agregarA'+agregador+' btn btn-primary mt-2" style="position:relative; left:20%!important;">Agregar</button><div class="agregadosAg'+agregador+'"></div></td><td><center style="display:flex;"><button id="guardarMatriz'+agregador+'" tipo="poaAdministrativo" idProgramacionFinanciera="'+agregador+'" class="btn btn-primary mt-2" idOrganismo="'+parametro3[0]+'" idActividad="'+parametro3[1]+'" ><i class="fas fa-save"></i></button><div class="reload__'+agregador+'"></div>&nbsp;&nbsp;<button class="eliminarFilaS'+agregador+' btn btn-danger"><i class="fas fa-trash"></i></button></center></td></tr>');


		funcionSoloNumeros($(".clase__suministros"+agregador));

		cambiantesNum($(".clase__suministros"+agregador));
		

		eliminarFilas($(".eliminarFilaS"+agregador),$(".item__PreSumi"+agregador));

		segmentosAnadidos($(".agregarE"+agregador),$(".agregadosElec"+agregador),"input",["obligatorios",agregador,"energia","atadoEnergia"]);


		segmentosAnadidos($(".agregarA"+agregador),$(".agregadosAg"+agregador),"input",["obligatorios",agregador,"agua","atadoGua"]);

		guardarElementosGeneral($("#guardarMatriz"+agregador),agregador,"suministrosAE",$(".reload__"+agregador));



	});

}

function percentage(parametro1, parametro2) {

   return parametro1 * (parametro2/100);

} 

var mesesCalcuBe=function(parametro1,parametro2,parametro3,parametro4) {


	var valorTotal=parseFloat(parametro3[2]) + parseFloat(parametro3[3]) + parseFloat(parametro2);

	var banderaMarzo=false;
	var banderaAgosto=false;


	if (parametro3[1]=="si") {

		var decimoParteCuarta=parseFloat(parametro3[5])/12;

		valorTotal=valorTotal + decimoParteCuarta;

	}else if($(parametro4).val()=="Costa" && parametro3[1]=="no"){

		var decimoCuarta=parseFloat(parametro3[5]) + valorTotal;
		$(".marzo"+parametro1).val(decimoCuarta.toFixed(2));

		banderaMarzo=true;


	}else if(($(parametro4).val()=="Amazonia" || $(parametro4).val()=="Sierra") && parametro3[1]=="no"){

		var decimoCuarta=parseFloat(parametro3[5]) + valorTotal;

		$(".agosto"+parametro1).val(decimoCuarta.toFixed(2));

		banderaAgosto=true;

	}


	if (parametro3[0]=="si") {

		var decimoParte=parseFloat(parametro3[4])/12;

		valorTotal=valorTotal + decimoParte;

	}

   $(".enero"+parametro1).val(valorTotal.toFixed(2));
   $(".febrero"+parametro1).val(valorTotal.toFixed(2));

   if (banderaMarzo==false && parametro3[1]=="si") {

   		$(".marzo"+parametro1).val(valorTotal.toFixed(2));

   }else if($(parametro4).val()=="Costa"){

   		if (parametro3[0]=="si") {

			var decimoParte=parseFloat(parametro3[4])/12;

			valorTotalCuarto=parseFloat(decimoCuarta) + parseFloat(decimoParte);

			$(".marzo"+parametro1).val(valorTotalCuarto.toFixed(2));

		}else{

			$(".marzo"+parametro1).val(decimoCuarta.toFixed(2));

		}


   }else{

   		$(".marzo"+parametro1).val(valorTotal.toFixed(2));

   }

   $(".abril"+parametro1).val(valorTotal.toFixed(2));

   $(".mayo"+parametro1).val(valorTotal.toFixed(2));

   $(".junio"+parametro1).val(valorTotal.toFixed(2));

   $(".julio"+parametro1).val(valorTotal.toFixed(2));

   if (banderaAgosto==false && parametro3[1]=="si") {

   		$(".agosto"+parametro1).val(valorTotal.toFixed(2));

   }else if($(parametro4).val()=="Amazonia" || $(parametro4).val()=="Sierra"){

		if (parametro3[0]=="si") {

			var decimoParte=parseFloat(parametro3[4])/12;

			valorTotalCuarto=parseFloat(decimoCuarta) + parseFloat(decimoParte);

			$(".agosto"+parametro1).val(valorTotalCuarto.toFixed(2));

		}else{

			$(".agosto"+parametro1).val(decimoCuarta.toFixed(2));

		}


   }else{

   		$(".agosto"+parametro1).val(valorTotal.toFixed(2));

   }

   $(".septiembre"+parametro1).val(valorTotal.toFixed(2));

   $(".octubre"+parametro1).val(valorTotal.toFixed(2));

   $(".noviembre"+parametro1).val(valorTotal.toFixed(2));


	if (parametro3[0]=="si") {

		// var decimoParte=parseFloat(parametro3[4])/12;

		// valorTotal=valorTotal + decimoParte;

	}else{

		valorTotal=valorTotal + parseFloat(parametro3[4]);

	}



   if (parametro3[0]=="si") {

   	$(".diciembre"+parametro1).val(valorTotal.toFixed(2));

   }else{

   	$(".diciembre"+parametro1).val(valorTotal.toFixed(2));

   }


   

   /*===================================
   =            Valor total            =
   ===================================*/

   valorTotalTotales=parseFloat($(".enero"+parametro1).val()) + parseFloat($(".febrero"+parametro1).val()) + parseFloat($(".marzo"+parametro1).val()) + parseFloat($(".abril"+parametro1).val()) + parseFloat($(".mayo"+parametro1).val()) + parseFloat($(".junio"+parametro1).val()) + parseFloat($(".julio"+parametro1).val()) + parseFloat($(".agosto"+parametro1).val()) + parseFloat($(".septiembre"+parametro1).val()) + parseFloat($(".octubre"+parametro1).val()) + parseFloat($(".noviembre"+parametro1).val()) + parseFloat($(".diciembre"+parametro1).val());
   
   $(".totalSumaItem"+parametro1).val(valorTotalTotales.toFixed(2));
   
   /*=====  End of Valor total  ======*/
   

} 



var calculaFomrulas=function(parametro1,parametro2,parametro3,parametro4,parametro5,parametro6,parametro7){

 $(parametro1).on('input', function () {

 	if($(parametro5).val()==""){

 		alertify.set("notifier","position", "top-center");
		alertify.notify("Obligatorio indicar si desea mensualizar el decimo tercero", "error", 5, function(){});
		$(this).val("0.00");

 	}else if($(parametro6).val()==""){

 		alertify.set("notifier","position", "top-center");
		alertify.notify("Obligatorio indicar si desea mensualizar el decimo cuarto", "error", 5, function(){});
		$(this).val("0.00"); 		

 	}else if ($(parametro2).val()=="0") {

 		alertify.set("notifier","position", "top-center");
		alertify.notify("Obligatorio ingresar el periodo de meses", "error", 5, function(){});
		$(this).val("0.00");

 	}else{

 		var aportePatronal=0;
 		var fondosReserva=0;

 		aportePatronal=percentage($(this).val(),12.15);
 		

 		$(parametro3[0]).val(aportePatronal.toFixed(2));

 		if ($(parametro2).val()>12) {

 			fondosReserva=percentage($(this).val(),8.33);

 			$(parametro3[1]).val(fondosReserva.toFixed(2));

 		}else{

 			$(parametro3[1]).val(0.00);

 		}

 		if ($(parametro2).val()>12) {

 			var decimoTercero=(parseFloat($(this).val()) / 12) * 12;

 			$(parametro3[2]).val(decimoTercero.toFixed(2));

 		}else{

  			var decimoTercero=(parseFloat($(this).val()) / 12) * parseFloat($(parametro2).val());

 			$(parametro3[2]).val(decimoTercero.toFixed(2));
			

 		}

 		if ($(parametro2).val()>12) {

 			$(parametro3[3]).val(425.00);

 		}else{

  			var decimoCuartoSueldo=(parseFloat(425.00) / 12) * parseFloat($(parametro2).val());

 			$(parametro3[3]).val(decimoCuartoSueldo.toFixed(2));
			

 		}

 		/*========================================
 		=            Replicar valores            =
 		========================================*/
 		
 		mesesCalcuBe(parametro7,$(this).val(),[$(parametro5).val(),$(parametro6).val(),$(parametro3[0]).val(),$(parametro3[1]).val(),$(parametro3[2]).val(),$(parametro3[3]).val()],parametro4);
 		
 		/*=====  End of Replicar valores  ======*/
 		

 	}

 });

}


var enviarDevuelto__plani=function(parametro1,parametro2,parametro3){

	var asignador=1;

	$(parametro1).click(function(e){

		e.preventDefault();	

		$(parametro1).hide();

		var confirm= alertify.confirm('','¿Está seguro de devolver el trámite a '+parametro3+'?',null,null).set('labels', {ok:'Confirmar', cancel:'Cancelar'});   

		confirm.set({transition:'slide'});    

		confirm.set('onok', function(){ //callbak al pulsar botón positivod

			var paqueteDeDatos = new FormData();

			var nombreDocumento=$(parametro1).attr('nombreDocumento');


			var organismoIdPrin=$("#organismoIdPrin").val();

			paqueteDeDatos.append('tipo','reasinar__planis');

			paqueteDeDatos.append('identificado',parametro3);

			paqueteDeDatos.append('idOrganismoM',parametro2);

			$.ajax({

			    type:"POST",
			    url:"modelosBd/inserta/insertaAccionesDos.md.php",
			    contentType: false,
			    data:paqueteDeDatos,
			    processData: false,
			    cache: false, 
		    	success:function(response){

	            	var elementos=JSON.parse(response);

	            	var mensaje=elementos['mensaje'];

					if(mensaje==1){

			            alertify.set("notifier","position", "top-center");
			            alertify.notify("Acción realizado correctamente", "success", 5, function(){});

			            $(parametro1).hide();


	            	}



				},
				error:function(){

				}
			
			});				


		});

		confirm.set('oncancel', function(){
		 //callbak al pulsar botón negativo
			alertify.set("notifier","position", "top-center");
			alertify.notify("Canceló el envío", "success", 1, function(){}); 

			$(parametro1).show();

		}); 

	});

}



var cargarFileSevidor=function(parametro1,parametro2){

	var asignador=1;

	$(parametro1).change(function(e){

		e.preventDefault();	

		var confirm= alertify.confirm('','¿Está seguro de subir el archivo seleccionado?',null,null).set('labels', {ok:'Confirmar', cancel:'Cancelar'});   

		confirm.set({transition:'slide'});    

		confirm.set('onok', function(){ //callbak al pulsar botón positivod

			var paqueteDeDatos = new FormData();

			var nombreDocumento=$(parametro1).attr('nombreDocumento');


			var organismoIdPrin=$("#organismoIdPrin").val();

			paqueteDeDatos.append('tipo','subirDocumentos');

			paqueteDeDatos.append('documentoReemplazo',$(parametro1)[0].files[0]);

			paqueteDeDatos.append('organismoIdPrin',organismoIdPrin);

			paqueteDeDatos.append('direccionDocumentos',parametro2);

			$.ajax({

			    type:"POST",
			    url:"modelosBd/inserta/inserta.md.php",
			    contentType: false,
			    data:paqueteDeDatos,
			    processData: false,
			    cache: false, 
		    	success:function(response){

	            	var elementos=JSON.parse(response);

	            	var mensaje=elementos['mensaje'];

					if(mensaje==1){

			            alertify.set("notifier","position", "top-center");
			            alertify.notify("Acción realizado correctamente", "success", 5, function(){});

			            $(parametro1).hide();


	            	}

				},
				error:function(){

				}
			
			});				


		});

		confirm.set('oncancel', function(){
		 //callbak al pulsar botón negativo
			alertify.set("notifier","position", "top-center");
			alertify.notify("Canceló el envío", "success", 1, function(){}); 

		}); 

	});

}


var crearFilasFiles=function(parametro1,parametro2){

var asignador=1;

$(parametro1).click(function(event) {

	event.preventDefault();

	asignador++;

	$(parametro2).after('<tr class="file__'+asignador+'"><td colspan="2">Cargar anexo</td><td colspan="3"><input type="file" id="anexo'+asignador+'" name="anexo'+asignador+'" class="anexos__variantes"></td><td><button class="btn btn-danger" id="eliminar'+asignador+'"><i class="fas fa-trash"></i></button></td></tr>');

	cargarFileSevidor($("#anexo"+asignador),'../../documentos/anexosPoa/');


	eliminarFilas($("#eliminar"+asignador),$(".file__"+asignador));
										          
});	

}

// var ocultar__enPreliminar=function(parametro1){

// 	if ($(parametro1).val()=="A") {

// 		$(":text").attr('style','border:none!important;');
// 		$(":text").attr('disabled','disabled');


// 		$("textarea").attr('style','border:none!important;');
// 		$("textarea").attr('disabled','disabled');

// 		$("button").hide();

// 		$(".boton__enlacesOcultos").hide();

// 	}

// }


var verOjoContrasenas2=function(parametro1,parametro2,parametro3,parametro4){

	$(parametro1).click(function(){

		event.preventDefault();

		if ($(parametro2).hasClass("fa-eye")) {


			$(parametro2).addClass('fa-eye-slash');

			$(parametro2).removeClass('fa-eye');

			$(parametro3).show();

			$(parametro4).text("Ocultar POA");


		}else{

			$(parametro2).removeClass('fa-eye-slash');

			$(parametro2).addClass('fa-eye');

			$(parametro3).hide();

			$(parametro4).text("Ver POA");


		}


	});


}


/*==========================================
=           exportador unisono            =
==========================================*/

var execelGenerados=function(parametro1,parametro2,parametro3){

$(parametro1).click(function (e){

  var table = document.getElementById(parametro2); // id of table
  var tableHTML = table.outerHTML;
  var fileName = parametro3;

  var msie = window.navigator.userAgent.indexOf("MSIE ");

  // If Internet Explorer
  if (msie > 0 || !!navigator.userAgent.match(/Trident.*rv\:11\./)) {

    dummyFrame.document.open('txt/html', 'replace');
    dummyFrame.document.write(tableHTML);
    dummyFrame.document.close();
    dummyFrame.focus();
    return dummyFrame.document.execCommand('SaveAs', true, fileName);

  }else {

    var a = document.createElement('a');
    tableHTML = tableHTML.replace(/  /g, '').replace(/ /g, '%20'); // replaces spaces
    a.href = 'data:application/vnd.ms-excel,' + tableHTML;
    a.setAttribute('download', fileName);
    document.body.appendChild(a);
    a.click();
    document.body.removeChild(a);

  }  

});

}

/*=====  End ofexportador unisono  ======*/


var verArmadoMatriz=function(parametro1,parametro2,parametro3){

	$(parametro1).click(function(){

		$(parametro3).html(" ");

		$(".valores__adicionales").remove();

		event.preventDefault();

		var paqueteDeDatos = new FormData();

		var tipo=$(this).attr('matriz');

		paqueteDeDatos.append('tipo',tipo);
		paqueteDeDatos.append('idActividad',parametro2[0]);
		paqueteDeDatos.append('idOrganismo',parametro2[1]);

		$.ajax({

			type:"POST",
			url:"modelosBd/inserta/seleccionaAcciones.md.php",
			contentType: false,
			data:paqueteDeDatos,
			processData: false,
			cache: false, 
			success:function(response){

				var elementos=JSON.parse(response);

				var informacionSeleccionada=elementos['obtenerInformacion'];

				$(parametro3).append('<br><button type="button" class="btn btn-success excelProyectosMatricez col col-1"><i class="fas fa-file-excel"></i>&nbsp;&nbsp;EXCEL</button>');

				if (tipo=="administrativas") {

					$(parametro3).append('<div  class="table-responsive"><table class="valores__adicionales" id="valores__adicionales"><thead><tr><th align="center">Ítem</th><th align="center">Justificación</th><th align="center">Cantidad bien</th><th>Enero</th><th>Febrero</th><th>Marzo</th><th>Abril</th><th>Mayo</th><th>Junio</th><th>Julio</th><th>Agosto</th><th>Septiembre</th><th>Octubre</th><th>Noviembre</th><th>Diciembre</th><th>Total</th></tr></thead></table></div>');

				}else if(tipo=="suminitrosAEe"){

					$(parametro3).append('<div  class="table-responsive"><table class="valores__adicionales" id="valores__adicionales"><thead><tr><th align="center">Tipo</th><th align="center">Nombre del escenario deportivo o Residencia para Fomento Deportivo</th><th align="center">Suministro energía</th><th>Suministro agua</th></tr></thead></table></div>');

				}else if(tipo=="honorarios"){

					$(parametro3).append('<div  class="table-responsive"><table class="valores__adicionales" id="valores__adicionales"><thead><tr><th align="center">Cédula<br>Pasaporte</th><th align="center">Nombre</th><th align="center">Cargo</th><th>Tipo Cargo</th><th>Honorario mensual<br>incluido iva</th><th>Enero</th><th>Febrero</th><th>Marzo</th><th>Abril</th><th>Mayo</th><th>Junio</th><th>Julio</th><th>Agosto</th><th>Septiembre</th><th>Octubre</th><th>Noviembre</th><th>Diciembre</th><th>Total</th></tr></thead></table></div>');


				}else if(tipo=="sueldosSalarios"){

					$(parametro3).append('<div  class="table-responsive"><table class="valores__adicionales" id="valores__adicionales"><thead><tr><th align="center">Cédula<br>Pasaporte</th><th align="center">Nombre</th><th align="center">Cargo</th><th>Tipo Cargo</th><th>Tiempo trabajo<br>meses</th><th>Sueldo salario<br>mensual</th><th>Aporte patronal<br>Iess mensual</th><th>Décimo tercera<br>Remuneración</th><th>Mensualización</th><th>Décimo cuarta<br>Remuneración</th><th>Mensualización</th><th>Fondos de reserva</th><th>Enero</th><th>Febrero</th><th>Marzo</th><th>Abril</th><th>Mayo</th><th>Junio</th><th>Julio</th><th>Agosto</th><th>Septiembre</th><th>Octubre</th><th>Noviembre</th><th>Diciembre</th><th>Total</th></tr></thead></table></div>');


				}else if(tipo=="mantenimiento"){

					$(parametro3).append('<div  class="table-responsive"><table class="valores__adicionales" id="valores__adicionales"><thead><tr><th align="center">ITEM</th><th align="center">Nombre<br>Infraestructura<br>deportiva</th><th align="center">Provincia</th><th>Dirección<br>completa</th><th>Estado</th><th>Tipo de recursos<br>con los que<br>se construyó</th><th>Tipo de Inversión</th><th>Detallar tipo<br>inversión que se planificó realizar</th><th>Tipo<br>de mantenimiento</th><th>Materiales<br>servicios a requerir<br>para el mantenimiento</th><th>Fecha<br>último mantenimiento<br>realizado</th><th>Enero</th><th>Febrero</th><th>Marzo</th><th>Abril</th><th>Mayo</th><th>Junio</th><th>Julio</th><th>Agosto</th><th>Septiembre</th><th>Octubre</th><th>Noviembre</th><th>Diciembre</th><th>Total</th></tr></thead></table></div>');


				}else if(tipo=="actDeportivasIns"){

					$(".excelProyectosMatricez").hide();

					
						$.getScript("layout/scripts/js/ajax/datatablet.js",function(){

							$(parametro3).append('<div  class="table-responsive"><table class="valores__adicionales" id="valores__adicionalesAct"><thead><tr><th align="center">ITEM</th><th align="center">Tipo<br>financiamiento</th><th align="center">Nombre<br>evento</th><th>Deporte</th><th>Provincia</th><th>Sede<br>Ciudad<br>País</th><th>Alcance</th><th>Fecha<br>inicio</th><th>Fecha<br>fin</th><th>Género</th><th>Categoría</th><th>No.<br>Entrenadores<br>oficiales</th><th>No.<br>atletas</th><th>Total</th><th>Mujeres<br>(Beneficiarios)</th><th>Hombres<br>(Beneficiarios)</th><th>Detalle lo que<br>el organismo<br>va a adquirir</th><th>Justificación<br>de la adquisición<br>del bien<br>o servicio</th><th>Cantidad<br>del bien<br>o servicio<br>a adquirir</th><th>Enero</th><th>Febrero</th><th>Marzo</th><th>Abril</th><th>Mayo</th><th>Junio</th><th>Julio</th><th>Agosto</th><th>Septiembre</th><th>Octubre</th><th>Noviembre</th><th>Diciembre</th><th>Total</th></tr></thead></table></div>');

							$("#valores__adicionalesAct").dataTable().fnDestroy();

					   		datatablets($("#valores__adicionalesAct"),"valores__adicionalesAct",[parametro2[1],parametro2[0]],false,-1,false,false,false,false);



						});					


				}

				for (c of informacionSeleccionada) {

					if (tipo=="administrativas") {

						$(".valores__adicionales").append('<tr><td align="center">'+c.itemPreesupuestario+"-"+c.nombreItem+'</td><td align="center">'+c.justificacionActividad+'</td><td align="center">'+c.cantidadBien+'</td><td align="center">'+parseFloat(c.enero).toFixed(2)+'</td><td align="center">'+parseFloat(c.febrero).toFixed(2)+'</td><td align="center">'+parseFloat(c.marzo).toFixed(2)+'</td><td align="center">'+parseFloat(c.abril).toFixed(2)+'</td><td align="center">'+parseFloat(c.mayo).toFixed(2)+'</td><td align="center">'+parseFloat(c.junio).toFixed(2)+'</td><td align="center">'+parseFloat(c.julio).toFixed(2)+'</td><td align="center">'+parseFloat(c.agosto).toFixed(2)+'</td><td align="center">'+parseFloat(c.septiembre).toFixed(2)+'</td><td align="center">'+parseFloat(c.octubre).toFixed(2)+'</td><td align="center">'+parseFloat(c.noviembre).toFixed(2)+'</td><td align="center">'+parseFloat(c.diciembre).toFixed(2)+'</td><td align="center">'+parseFloat(c.totalSumaItem).toFixed(2)+'</td></tr>');

					}else if(tipo=="suminitrosAEe"){


						$(".valores__adicionales").append('<tr class="item__PreEdit'+c.idSumi+'"><td><center>'+c.tipo+'</center></td><td><center>'+c.nombreEscenario+'</center></td><td class="filaLuzE'+c.idSumi+'"></td><td class="filaAguaE'+c.idSumi+'"></div></td></tr>');		
							
						var arrayEnergia = c.energia.split("---");	

						for(var wEner=0; wEner<arrayEnergia.length;wEner++){

							if (arrayEnergia[wEner]!="N/A") {
								$(".filaLuzE"+c.idSumi).append('<div class="center">'+arrayEnergia[wEner]+'</div>');
							}

						}	

						var arrayAgua = c.agua.split("---");

						for(var wAgua=0; wAgua<arrayAgua.length;wAgua++){

							if (arrayAgua[wAgua]!="N/A") {
								$(".filaAguaE"+c.idSumi).append('<div class="center">'+arrayAgua[wAgua]+'</div>');
							}

						}	


					}else if(tipo=="honorarios"){

						$(".valores__adicionales").append('<tr class="item__PreEdit'+c.idHonorarios+'"><td><center>'+c.cedula+'</center></td><td><center>'+c.nombres+'</center></td><td><center>'+c.cargo+'</center></td><td><center>'+c.tipoCargo+'</center></td><td><center>'+c.honorarioMensual+'</center></td><td><center>'+parseFloat(c.enero).toFixed(2)+'</center></td><td><center>'+parseFloat(c.febrero).toFixed(2)+'</center></td><td><center>'+parseFloat(c.marzo).toFixed(2)+'</center></td><td><center>'+parseFloat(c.abril).toFixed(2)+'</center></td><td><center>'+parseFloat(c.mayo).toFixed(2)+'</center></td><td><center>'+parseFloat(c.junio).toFixed(2)+'</center></td><td><center>'+parseFloat(c.julio).toFixed(2)+'</center></td><td><center>'+parseFloat(c.agosto).toFixed(2)+'</center></td><td><center>'+parseFloat(c.septiembre).toFixed(2)+'</center></td><td><center>'+parseFloat(c.octubre).toFixed(2)+'</center></td><td><center>'+parseFloat(c.noviembre).toFixed(2)+'</center></td><td><center>'+parseFloat(c.diciembre).toFixed(2)+'</center></td><td><center>'+parseFloat(c.total).toFixed(2)+'</center></td></tr>');	

					}else if(tipo=="sueldosSalarios"){

						$(".valores__adicionales").append('<tr class="item__PreEdit'+c.idSueldos+'"><td><center>'+c.cedula+'</center></td><td><center>'+c.nombres+'</center></td><td><center>'+c.cargo+'</center></td><td><center>'+c.tipoCargo+'</center></td><td><center>'+c.tiempoTrabajo+'</center></td><td><center>'+c.sueldoSalario+'</center></td><td><center>'+c.aportePatronal+'</center></td><td><center>'+c.decimoTercera+'</center></td><td><center>'+c.mensualizaTercera+'</center></td><td><center>'+c.decimoCuarta+'</center></td><td><center>'+c.menusalizaCuarta+'</center></td><td><center>'+c.fondosReserva+'</center></td><td><center>'+c.enero+'</center></td><td><center>'+c.febrero+'</center></td><td><center>'+c.marzo+'</center></td><td><center>'+c.abril+'</center></td><td><center>'+c.mayo+'</center></td><td><center>'+c.junio+'</center></td><td><center>'+c.julio+'</center></td><td><center>'+c.agosto+'</center></td><td><center>'+c.septiembre+'</center></td><td><center>'+c.octubre+'</center></td><td><center>'+c.noviembre+'</center></td><td><center>'+c.diciembre+'</center></td><td><center>'+c.total+'</center></td></tr>');		

					}else if(tipo=="mantenimiento"){

						$(".valores__adicionales").append('<tr><td><center>'+c.itemPreesupuestario+"-"+c.nombreItem+'</center></td><td><center>'+c.nombreInfras+'</center></td><td><center>'+c.nombreProvincia+'</center></td><td><center>'+c.direccionCompleta+'</center></td><td><center>'+c.estado+'</center></td><td><center>'+c.tipoRecursos+'</center></td><td><center>'+c.tipoIntervencion+'</center></td><td><center>'+c.detallarTipoIn+'</center></td><td><center>'+c.tipoMantenimiento+'</center></td><td><center>'+c.materialesServicios+'</center></td><td><center>'+c.fechaUltimo+'</center></td><td><center>'+parseFloat(c.enero).toFixed(2)+'</center></td><td><center>'+parseFloat(c.febrero).toFixed(2)+'</center></td><td><center>'+parseFloat(c.marzo).toFixed(2)+'</center></td><td><center>'+parseFloat(c.abril).toFixed(2)+'</center></td><td><center>'+parseFloat(c.mayo).toFixed(2)+'</center></td><td><center>'+parseFloat(c.junio).toFixed(2)+'</center></td><td><center>'+parseFloat(c.julio).toFixed(2)+'</center></td><td><center>'+parseFloat(c.agosto).toFixed(2)+'</center></td><td><center>'+parseFloat(c.septiembre).toFixed(2)+'</center></td><td><center>'+parseFloat(c.octubre).toFixed(2)+'</center></td><td><center>'+parseFloat(c.noviembre).toFixed(2)+'</center></td><td><center>'+parseFloat(c.diciembre).toFixed(2)+'</center></td><td><center>'+parseFloat(c.totalTotales).toFixed(2)+'</center></td></tr>');


					}else if(tipo=="actDeportivasIns"){

						// $(".valores__adicionales").append('<tr><td><center>'+c.itemPreesupuestario+"-"+c.nombreItem+'</center></td><td><center>'+c.tipoFinanciamiento+'</center></td><td><center>'+c.nombreEvento+'</center></td><td><center>'+c.Deporte+'</center></td><td><center>'+c.provincia+'</center></td><td><center>'+c.ciudadPais+'</center></td><td><center>'+c.alcance+'</center></td><td><center>'+c.fechaInicio+'</center></td><td><center>'+c.fechaFin+'</center></td><td><center>'+c.genero+'</center></td><td><center>'+c.categoria+'</center></td><td><center>'+c.numeroEntreandores+'</center></td><td><center>'+c.numeroAtletas+'</center></td><td><center>'+c.total+'</center></td><td><center>'+c.mBenefici+'</center></td><td><center>'+c.hBenefici+'</center></td><td><center>'+c.justificacionAd+'</center></td><td><center>'+c.detalleBien+'</center></td><td><center>'+c.canitdarBie+'</center></td><td><center>'+parseFloat(c.enero).toFixed(2)+'</center></td><td><center>'+parseFloat(c.febrero).toFixed(2)+'</center></td><td><center>'+parseFloat(c.marzo).toFixed(2)+'</center></td><td><center>'+parseFloat(c.abril).toFixed(2)+'</center></td><td><center>'+parseFloat(c.mayo).toFixed(2)+'</center></td><td><center>'+parseFloat(c.junio).toFixed(2)+'</center></td><td><center>'+parseFloat(c.julio).toFixed(2)+'</center></td><td><center>'+parseFloat(c.agosto).toFixed(2)+'</center></td><td><center>'+parseFloat(c.septiembre).toFixed(2)+'</center></td><td><center>'+parseFloat(c.octubre).toFixed(2)+'</center></td><td><center>'+parseFloat(c.noviembre).toFixed(2)+'</center></td><td><center>'+parseFloat(c.diciembre).toFixed(2)+'</center></td><td><center>'+parseFloat(c.totalElem).toFixed(2)+'</center></td></tr>');


					}

				}

				

				execelGenerados($(".excelProyectosMatricez"),"valores__adicionales","Mátriz");

			},
			error:function(){

			}
						
		});		


	});

}


var verObservacionesNo=function(parametro1,parametro2){

$(parametro1).change(function (e){

	if ($(this).val()=="si") {

		$(parametro2).hide();

	}else{

		$(parametro2).show();

	}

});

}

var verOjoAjaxMatrices=function(parametro1,parametro2,parametro3,parametro4,parametro5,parametro6,parametro7){

	$(parametro1).click(function(){

		event.preventDefault();

		if ($(parametro2).hasClass("fa-eye")) {

			var paqueteDeDatos = new FormData();

			paqueteDeDatos.append('tipo','matricesSC');

			paqueteDeDatos.append('idActividad',parametro4);

			paqueteDeDatos.append('idOrganismo',parametro5);


			$.ajax({

				type:"POST",
				url:"modelosBd/inserta/seleccionaAcciones.md.php",
				contentType: false,
				data:paqueteDeDatos,
				processData: false,
				cache: false, 
				success:function(response){

					var elementos=JSON.parse(response);

					var obtenerAcCa=elementos['obtenerAcCa'];
					var mensajeActividad=elementos['mensajeActividad'];
					var mensajeActividadH=elementos['mensajeActividadH'];

					var mensajeSuministros=elementos['mensajeSuministros'];
					var mensajeAdministrativas=elementos['mensajeAdministrativas'];

					$(parametro2).addClass('fa-eye-slash');

					$(parametro2).removeClass('fa-eye');

	
					if (mensajeActividad=="actDeportivas") {

						$(parametro3).append('<a style="cursor:pointer!important;" data-bs-toggle="modal" data-bs-target="#modalVisualizaMatrices" class="visualiza__'+parametro4+' col col-6 text-center" attr="'+parametro4+'" matriz="actDeportivasIns">ACTIVIDADES DEL FOMENTO DEPORTIVA, EDUCACIÓN FÍSICA Y RECREACIÓN</a><br><br>');


					}


					if(mensajeActividad=="sueldos__salarios"){

							$(parametro3).append('<a style="cursor:pointer!important;" data-bs-toggle="modal" data-bs-target="#modalVisualizaMatrices" class="visualiza__'+parametro4+' col col-6 text-center" attr="'+parametro4+'" matriz="sueldosSalarios">SUELDOS Y SALARIOS</a><br><br>');

					}



					if(mensajeActividad=="mantenimiento"){

							$(parametro3).append('<a style="cursor:pointer!important;" data-bs-toggle="modal" data-bs-target="#modalVisualizaMatrices" class="visualiza__'+parametro4+' col col-6 text-center" attr="'+parametro4+'" matriz="mantenimiento">MANTENIMIENTO</a><br><br>');

					}


					if (mensajeActividadH=="honorarios") {

						$(parametro3).append('<a style="cursor:pointer!important;" data-bs-toggle="modal" data-bs-target="#modalVisualizaMatrices" class="visualiza__'+parametro4+' col col-6 text-center" attr="'+parametro4+'" matriz="honorarios">HONORARIOS PROFESIONALES</a><br><br>');

					}


					if (mensajeSuministros=="suministros") {

						$(parametro3).append('<a style="cursor:pointer!important;" data-bs-toggle="modal" data-bs-target="#modalVisualizaMatrices" class="visualiza__'+parametro4+' col col-6 text-center" attr="'+parametro5+'" matriz="suminitrosAEe">SUMINISTROS</a><br><br>');

					}


					if (mensajeAdministrativas=="administrativas") {

						$(parametro3).append('<a style="cursor:pointer!important;" data-bs-toggle="modal" data-bs-target="#modalVisualizaMatrices" class="visualiza__'+parametro4+' col col-6 text-center" attr="'+parametro4+'" matriz="administrativas">ACTIVIDADES ADMINISTATIVAS</a><br><br>');

					}

					verArmadoMatriz($(".visualiza__"+parametro4),[parametro4,parametro5],$(".contenedor__bodyCMatrizDefi"));


				},
				error:function(){

				}
						
			});		


		}else{

			$(parametro2).removeClass('fa-eye-slash');

			$(parametro2).addClass('fa-eye');

			$(parametro3).html(" ");

		}


	});


}

var subsecretariasSelector=function(parametro1,parametro2){

	indicador=24;

	$.ajax({

	  data: {indicador:indicador,idUsuario:parametro2},
      dataType: 'html',
      type:'POST',
	  url:'modelosBd/validaciones/selector.modelo.php'

	}).done(function(listar__lugar){

	  $(parametro1).html(listar__lugar);

	}).fail(function(){

	  

	});


}

var subsecretariasSelectorRecomen=function(parametro1,parametro2){

	indicador=33;

	$.ajax({

	  data: {indicador:indicador,idUsuario:parametro2},
      dataType: 'html',
      type:'POST',
	  url:'modelosBd/validaciones/selector.modelo.php'

	}).done(function(listar__lugar){

	  $(parametro1).html(listar__lugar);

	}).fail(function(){

	  

	});

}

var subsecretariasSelectorRecomen_coorI=function(parametro1,parametro2){

	indicador=34;

	$.ajax({

	  data: {indicador:indicador,idUsuario:parametro2},
      dataType: 'html',
      type:'POST',
	  url:'modelosBd/validaciones/selector.modelo.php'

	}).done(function(listar__lugar){

	  $(parametro1).html(listar__lugar);

	}).fail(function(){

	  

	});

}

var subsecretariasSelectorRecomen_coorIn=function(parametro1,parametro2){

	indicador=35;

	$.ajax({

	  data: {indicador:indicador,idUsuario:parametro2},
      dataType: 'html',
      type:'POST',
	  url:'modelosBd/validaciones/selector.modelo.php'

	}).done(function(listar__lugar){

	  $(parametro1).html(listar__lugar);

	}).fail(function(){

	  

	});

}

var subsecretariasSelectorRecomen_coorTalento=function(parametro1,parametro2){

	indicador=36;

	$.ajax({

	  data: {indicador:indicador,idUsuario:parametro2},
      dataType: 'html',
      type:'POST',
	  url:'modelosBd/validaciones/selector.modelo.php'

	}).done(function(listar__lugar){

	  $(parametro1).html(listar__lugar);

	}).fail(function(){

	  

	});

}

var subsecretariasSelectorRecomen_coorAdminis=function(parametro1,parametro2){

	indicador=37;

	$.ajax({

	  data: {indicador:indicador,idUsuario:parametro2},
      dataType: 'html',
      type:'POST',
	  url:'modelosBd/validaciones/selector.modelo.php'

	}).done(function(listar__lugar){

	  $(parametro1).html(listar__lugar);

	}).fail(function(){

	  

	});

}

var subsecretariasSelectorDos=function(parametro1,parametro2){

	indicador=26;

	$.ajax({

	  data: {indicador:indicador,idUsuario:parametro2},
      dataType: 'html',
      type:'POST',
	  url:'modelosBd/validaciones/selector.modelo.php'

	}).done(function(listar__lugar){

	  $(parametro1).html(listar__lugar);

	}).fail(function(){

	  

	});


}

var subsecretariasSelectorCor=function(parametro1,parametro2,parametro3){

	indicador=29;

	$.ajax({

	  data: {indicador:indicador,idUsuario:parametro2,identificador:parametro3},
      dataType: 'html',
      type:'POST',
	  url:'modelosBd/validaciones/selector.modelo.php'

	}).done(function(listar__lugar){

	  $(parametro1).html(listar__lugar);

	}).fail(function(){

	  

	});


}

var subsecretariasSelectorCorFun=function(parametro1,parametro2,parametro3){

	indicador=30;

	$.ajax({

	  data: {indicador:indicador,idUsuario:parametro2,identificador:parametro3},
      dataType: 'html',
      type:'POST',
	  url:'modelosBd/validaciones/selector.modelo.php'

	}).done(function(listar__lugar){

	  $(parametro1).html(listar__lugar);

	}).fail(function(){

	  

	});


}


var subsecretarias__finanA__c=function(parametro1,parametro2,parametro3){

	indicador=40;

	$.ajax({

	  data: {indicador:indicador,idUsuario:parametro2,identificador:parametro3},
      dataType: 'html',
      type:'POST',
	  url:'modelosBd/validaciones/selector.modelo.php'

	}).done(function(listar__lugar){

	  $(parametro1).html(listar__lugar);

	}).fail(function(){

	  

	});


}

var subsecretarias__finanA__c__c=function(parametro1,parametro2,parametro3){

	indicador=41;

	$.ajax({

	  data: {indicador:indicador,idUsuario:parametro2,identificador:parametro3},
      dataType: 'html',
      type:'POST',
	  url:'modelosBd/validaciones/selector.modelo.php'

	}).done(function(listar__lugar){

	  $(parametro1).html(listar__lugar);

	}).fail(function(){

	  

	});


}


var subsecretarias__finanA__c__a=function(parametro1,parametro2,parametro3){

	indicador=42;

	$.ajax({

	  data: {indicador:indicador,idUsuario:parametro2,identificador:parametro3},
      dataType: 'html',
      type:'POST',
	  url:'modelosBd/validaciones/selector.modelo.php'

	}).done(function(listar__lugar){

	  $(parametro1).html(listar__lugar);

	}).fail(function(){

	  

	});


}



var subsecretarias__finanA=function(parametro1,parametro2,parametro3){

	indicador=39;

	$.ajax({

	  data: {indicador:indicador,idUsuario:parametro2,identificador:parametro3},
      dataType: 'html',
      type:'POST',
	  url:'modelosBd/validaciones/selector.modelo.php'

	}).done(function(listar__lugar){

	  $(parametro1).html(listar__lugar);

	}).fail(function(){

	  

	});


}


var subsecretariasSelectorCorFunCorFin=function(parametro1,parametro2,parametro3){

	indicador=31;

	$.ajax({

	  data: {indicador:indicador,idUsuario:parametro2,identificador:parametro3},
      dataType: 'html',
      type:'POST',
	  url:'modelosBd/validaciones/selector.modelo.php'

	}).done(function(listar__lugar){

	  $(parametro1).html(listar__lugar);

	}).fail(function(){

	  

	});


}

var subsecretariasSelectorSucenrFin=function(parametro1,parametro2,parametro3){

	indicador=32;

	$.ajax({

	  data: {indicador:indicador,idUsuario:parametro2,identificador:parametro3},
      dataType: 'html',
      type:'POST',
	  url:'modelosBd/validaciones/selector.modelo.php'

	}).done(function(listar__lugar){

	  $(parametro1).html(listar__lugar);

	}).fail(function(){

	  

	});


}

var subsecretariasSelectorFinancieros=function(parametro1,parametro2){

	indicador=28;

	$.ajax({

	  data: {indicador:indicador,idUsuario:parametro2},
      dataType: 'html',
      type:'POST',
	  url:'modelosBd/validaciones/selector.modelo.php'

	}).done(function(listar__lugar){

	  $(parametro1).html(listar__lugar);

	}).fail(function(){

	  

	});


}


var subsecretariasSelectorIntras=function(parametro1,parametro2){

	indicador=27;

	$.ajax({

	  data: {indicador:indicador,idUsuario:parametro2},
      dataType: 'html',
      type:'POST',
	  url:'modelosBd/validaciones/selector.modelo.php'

	}).done(function(listar__lugar){

	  $(parametro1).html(listar__lugar);

	}).fail(function(){

	  

	});


}

var funcionarios__normales=function(parametro1,parametro2){

	indicador=25;

	$.ajax({

	  data: {indicador:indicador,idUsuario:parametro2},
      dataType: 'html',
      type:'POST',
	  url:'modelosBd/validaciones/selector.modelo.php'

	}).done(function(listar__lugar){

	  $(parametro1).html(listar__lugar);

	}).fail(function(){

	  

	});


}

var funcionarios__normalesPlanifi=function(parametro1,parametro2){

	indicador=38;

	$.ajax({

	  data: {indicador:indicador,idUsuario:parametro2},
      dataType: 'html',
      type:'POST',
	  url:'modelosBd/validaciones/selector.modelo.php'

	}).done(function(listar__lugar){

	  $(parametro1).html(listar__lugar);

	}).fail(function(){

	  

	});


}

/*=========================================
=            Reasignar trámite            =
=========================================*/

var enviarTramitesGeneradosFinans=function(parametro1,parametro2,parametro3,parametro4,parametro5,parametro6,parametro7,parametro8,parametro9){

$(parametro1).click(function (e){


	e.preventDefault();	

	$(parametro1).hide();

	$('.reolad__mMa').html('<img src="images/reloadGit.webp" style="width:50px; height:50px; border-radius:1em;">');

	if (($('#pdfArchivos').val()=="" || $('#pdfArchivos').val()==" " || $('#conlcusion').val()==" " || $('#conlcusion').val()=="")  && parametro5==3 && parametro8!="no__tramite") {


		alertify.set("notifier","position", "top-center");
		alertify.notify("Obligatorio cargar el informe técnico e ingresar la conclusión", "error", 5, function(){});

		$(".boton__enlacesOcultos").show();

		$('.reolad__mMa').html(' ');

	}else if (($(parametro3).val()==" " || $(parametro3).val()=="") && parametro5!=3) {

		alertify.set("notifier","position", "top-center");
		alertify.notify("Obligatorio escoger funcionario a reasignar", "error", 5, function(){});

		$(".boton__enlacesOcultos").show();

		$('.reolad__mMa').html(' ');

	}else if(parametro5==3 && parametro8!="no__tramite"){

		var paqueteDeDatos = new FormData();

		if (parametro7=="recomendadoUni") {

			paqueteDeDatos.append('tipo','recomendadoUni');		

			paqueteDeDatos.append('idUsuarioEn',parametro2[2]);		

			paqueteDeDatos.append('fisicamenteEn',parametro2[1]);

		}else{

			paqueteDeDatos.append('tipo','reasignarEnvioFun');		

		}


		var other_data = $('#'+parametro6).serializeArray();

		$.each(other_data,function(key,input){
			paqueteDeDatos.append(input.name,input.value);
		});

		paqueteDeDatos.append('pdfArchivos', $('#pdfArchivos')[0].files[0]);

		paqueteDeDatos.append('idRolRealizados',$(parametro5).val());

		if (parametro9=="tramiteFinan__coordinas") {
			paqueteDeDatos.append('variableNotificaciones',parametro9);
			paqueteDeDatos.append('fisicamenteEnDoces',parametro2[1]);
		}else{
			paqueteDeDatos.append('variableNotificaciones','N/A');
		}

		$.ajax({

			type:"POST",
			url:"modelosBd/inserta/insertaAccionesDos.md.php",
			contentType: false,
			data:paqueteDeDatos,
			processData: false,
			cache: false, 
			success:function(response){

					var elementos=JSON.parse(response);

					var mensaje=elementos['mensaje'];

					if(mensaje==1){

				    	alertify.set("notifier","position", "top-center");
				    	alertify.notify("Registro realizado correctamente", "success", 5, function(){});

				   	 	window.setTimeout(function(){ 

				        	location.reload();

				    	} ,5000); 

		          	}


			},
			error:function(){

			}
				
		});	


	}else{	

		var confirm= alertify.confirm('¿Está seguro de reasignar el trámite?','¿Está seguro de reasignar el trámite?',null,null).set('labels', {ok:'Confirmar', cancel:'Cancelar'});   

		confirm.set({transition:'slide'});    

		confirm.set('onok', function(){ //callbak al pulsar botón positivo

			var paqueteDeDatos = new FormData();

			if (parametro7=="recomendadoUni") {

				paqueteDeDatos.append('tipo','recomendadoUni');	

				paqueteDeDatos.append('idUsuarioEn',parametro2[2]);		

				paqueteDeDatos.append('fisicamenteEn',parametro2[1]);

			}else{

				paqueteDeDatos.append('tipo','reasignarEnvioFinans');

			}	

			paqueteDeDatos.append('idOrganismo',parametro2[0]);	
			  
			paqueteDeDatos.append('fisicamenteE',parametro2[1]);	

			paqueteDeDatos.append('idUsuario',parametro2[2]);	

			paqueteDeDatos.append('textoObservaciones',$(parametro4).val());	

			paqueteDeDatos.append('idUsuarioEnvio',$(parametro3).val());	

			paqueteDeDatos.append('idRolRealizados',$(parametro5).val());	


			$.ajax({

				type:"POST",
				url:"modelosBd/inserta/insertaAccionesDos.md.php",
				contentType: false,
				data:paqueteDeDatos,
				processData: false,
				cache: false, 
				success:function(response){

					var elementos=JSON.parse(response);

					var mensaje=elementos['mensaje'];


					if(mensaje==2){

				    	alertify.set("notifier","position", "top-center");
				    	alertify.notify("Solo puede enviar a la zonal", "error", 5, function(){});

						$(parametro1).show();

						$('.reolad__mMa').html(' ');


		          	}


					if(mensaje==3){

				    	alertify.set("notifier","position", "top-center");
				    	alertify.notify("Puede escoger máximo dos zonas de envío, recordando que pueda enviar a infraestructura e instalaciones deportivas", "error", 5, function(){});

						$(parametro1).show();

						$('.reolad__mMa').html(' ');

		          	}

					if(mensaje==1){

				    	alertify.set("notifier","position", "top-center");
				    	alertify.notify("Registro realizado correctamente", "success", 5, function(){});

				   	 	window.setTimeout(function(){ 

				        	location.reload();

				    	} ,5000); 

		          	}


				},
				error:function(){

				}
				
			});	



		});

		confirm.set('oncancel', function(){ //callbak al pulsar botón negativo
			alertify.set("notifier","position", "top-center");
			alertify.notify("Acción cancelada", "error", 1, function(){

				$(parametro1).show();
				$('.reolad__mMa').html(' ');

			}); 
		}); 

	}

});

}



var enviarTramitesGeneradosSubsess=function(parametro1,parametro2,parametro3,parametro4,parametro5,parametro6,parametro7,parametro8,parametro9){

$(parametro1).click(function (e){


	e.preventDefault();	

	$(parametro1).hide();

	$('.reolad__mMa').html('<img src="images/reloadGit.webp" style="width:50px; height:50px; border-radius:1em;">');

	if (($('#pdfArchivos').val()=="" || $('#pdfArchivos').val()==" " || $('#conlcusion').val()==" " || $('#conlcusion').val()=="")  && parametro5==3 && parametro8!="no__tramite") {


		alertify.set("notifier","position", "top-center");
		alertify.notify("Obligatorio cargar el informe técnico e ingresar la conclusión", "error", 5, function(){});

		$(".boton__enlacesOcultos").show();

		$('.reolad__mMa').html(' ');

	}else if (($(parametro3).val()==" " || $(parametro3).val()=="") && parametro5!=3) {

		alertify.set("notifier","position", "top-center");
		alertify.notify("Obligatorio escoger funcionario a reasignar", "error", 5, function(){});

		$(".boton__enlacesOcultos").show();

		$('.reolad__mMa').html(' ');

	}else if(parametro5==3 && parametro8!="no__tramite"){

		var paqueteDeDatos = new FormData();

		if (parametro7=="recomendadoUni") {

			paqueteDeDatos.append('tipo','recomendadoUni');		

			paqueteDeDatos.append('idUsuarioEn',parametro2[2]);		

			paqueteDeDatos.append('fisicamenteEn',parametro2[1]);

		}else{

			paqueteDeDatos.append('tipo','reasignarEnvioFun');		

		}


		if (parametro9=="corrdinacionSubsecc") {
			paqueteDeDatos.append('variableNotificaciones',parametro9);
		}else{
			paqueteDeDatos.append('variableNotificaciones','N/A');
		}


		var other_data = $('#'+parametro6).serializeArray();

		$.each(other_data,function(key,input){
			paqueteDeDatos.append(input.name,input.value);
		});

		paqueteDeDatos.append('pdfArchivos', $('#pdfArchivos')[0].files[0]);

		paqueteDeDatos.append('idRolRealizados',$(parametro5).val());

		paqueteDeDatos.append('fisicamenteEnDoces',parametro2[1]);

		$.ajax({

			type:"POST",
			url:"modelosBd/inserta/insertaAccionesDos.md.php",
			contentType: false,
			data:paqueteDeDatos,
			processData: false,
			cache: false, 
			success:function(response){

					var elementos=JSON.parse(response);

					var mensaje=elementos['mensaje'];

					if(mensaje==1){

				    	alertify.set("notifier","position", "top-center");
				    	alertify.notify("Registro realizado correctamente", "success", 5, function(){});

				   	 	window.setTimeout(function(){ 

				        	location.reload();

				    	} ,5000); 

		          	}


			},
			error:function(){

			}
				
		});	


	}else{	

		var confirm= alertify.confirm('¿Está seguro de reasignar el trámite?','¿Está seguro de reasignar el trámite?',null,null).set('labels', {ok:'Confirmar', cancel:'Cancelar'});   

		confirm.set({transition:'slide'});    

		confirm.set('onok', function(){ //callbak al pulsar botón positivo

			var paqueteDeDatos = new FormData();

			if (parametro7=="recomendadoUni") {

				paqueteDeDatos.append('tipo','recomendadoUni');	

				paqueteDeDatos.append('idUsuarioEn',parametro2[2]);		

				paqueteDeDatos.append('fisicamenteEn',parametro2[1]);

			}else{

				paqueteDeDatos.append('tipo','reasignarEnvioCoordin');

			}	

			paqueteDeDatos.append('idOrganismo',parametro2[0]);	
			  
			paqueteDeDatos.append('fisicamenteE',parametro2[1]);	

			paqueteDeDatos.append('idUsuario',parametro2[2]);	

			paqueteDeDatos.append('textoObservaciones',$(parametro4).val());	

			paqueteDeDatos.append('idUsuarioEnvio',$(parametro3).val());	

			paqueteDeDatos.append('idRolRealizados',$(parametro5).val());	


			$.ajax({

				type:"POST",
				url:"modelosBd/inserta/insertaAccionesDos.md.php",
				contentType: false,
				data:paqueteDeDatos,
				processData: false,
				cache: false, 
				success:function(response){

					var elementos=JSON.parse(response);

					var mensaje=elementos['mensaje'];


					if(mensaje==2){

				    	alertify.set("notifier","position", "top-center");
				    	alertify.notify("Solo puede enviar a la zonal", "error", 5, function(){});

						$(parametro1).show();

						$('.reolad__mMa').html(' ');


		          	}


					if(mensaje==3){

				    	alertify.set("notifier","position", "top-center");
				    	alertify.notify("Puede escoger máximo dos zonas de envío, recordando que pueda enviar a infraestructura e instalaciones deportivas", "error", 5, function(){});

						$(parametro1).show();

						$('.reolad__mMa').html(' ');

		          	}

					if(mensaje==1){

				    	alertify.set("notifier","position", "top-center");
				    	alertify.notify("Registro realizado correctamente", "success", 5, function(){});

				   	 	window.setTimeout(function(){ 

				        	location.reload();

				    	} ,5000); 

		          	}


				},
				error:function(){

				}
				
			});	



		});

		confirm.set('oncancel', function(){ //callbak al pulsar botón negativo
			alertify.set("notifier","position", "top-center");
			alertify.notify("Acción cancelada", "error", 1, function(){

				$(parametro1).show();
				$('.reolad__mMa').html(' ');

			}); 
		}); 

	}

});

}

/*==============================================================
=            enviar tramties a coord o funcionarios            =
==============================================================*/

var enviarTramitesGenerados__financieros=function(parametro1,parametro2,parametro3,parametro4){

$(parametro1).click(function (e){

	e.preventDefault();	

	$(parametro1).hide();


	var confirm= alertify.confirm('¿Está seguro de reasignar el trámite?','¿Está seguro de reasignar el trámite?',null,null).set('labels', {ok:'Confirmar', cancel:'Cancelar'});   

	confirm.set({transition:'slide'});    

	confirm.set('onok', function(){ //callbak al pulsar botón positivo
			  
		var paqueteDeDatos = new FormData();	


		var other_data = $('.formAsignarTraS').serializeArray();

		$.each(other_data,function(key,input){
			paqueteDeDatos.append(input.name,input.value);
		});

		if (parametro4=="inserta__funcionario__finan__funcionarios") {

		    var condicion = $("#checksDesicion").is(":checked");

		    if (condicion) {

		      paqueteDeDatos.append("checked","si");


		    }else{

		      paqueteDeDatos.append("checked","no");

		   }			

		}

		paqueteDeDatos.append("tipo",parametro4);

		paqueteDeDatos.append("idOrganismo",parametro2[0]);
		paqueteDeDatos.append("fisicamenteE",parametro2[1]);
		paqueteDeDatos.append("idUsuarioC",parametro2[2]);

		$.ajax({

			type:"POST",
			url:"modelosBd/inserta/insertaAccionesDos.md.php",
			contentType: false,
			data:paqueteDeDatos,
			processData: false,
			cache: false, 
			success:function(response){

	            var elementos=JSON.parse(response);
	            var mensaje=elementos['mensaje'];

          		if (mensaje==1) {

          			alertify.set("notifier","position", "top-center");
        			alertify.notify("Registro realizado correctamente", "success", 8, function(){});

				    window.setTimeout(function(){ 
				    	location.reload();
				    } ,5000); 

				}

			},
			error:function(){

			}
				
		});	

	});

	confirm.set('oncancel', function(){ //callbak al pulsar botón negativo

		alertify.set("notifier","position", "top-center");
		alertify.notify("Acción cancelada", "error", 1, function(){

			$(parametro1).show();
			$('.reload__Enviosrealizados').html(' ');

		}); 

	}); 


});

}


/*=====  End of enviar tramties a coord o funcionarios  ======*/


/*=====================================================
=            Actualiza envio Observaciones            =
=====================================================*/

var envioObservaciones__f=function(parametro1,parametro2,parametro3){

$(parametro1).click(function (e){

	e.preventDefault();	

	$(parametro1).hide();

	var confirm= alertify.confirm('¿Está seguro de enviar las observaciones?','¿Está seguro de enviar las observaciones?',null,null).set('labels', {ok:'Confirmar', cancel:'Cancelar'});   

	confirm.set({transition:'slide'});    

	confirm.set('onok', function(){ //callbak al pulsar botón positivo
			  
		var paqueteDeDatos = new FormData();	

		var other_data = $('#generarDocumento').serializeArray();

		$.each(other_data,function(key,input){
			paqueteDeDatos.append(input.name,input.value);
		});

		var arrayValores = new Array(); 
		var arrayValoresTexto = new Array(); 

		$("select").each(function(index) {

			if ($(this).val()!="") {

				arrayValores.push($(this).val());	

			}
			
		});

		$(".text_verificados").each(function(index) {

			arrayValoresTexto.push($(this).val());	
			
		});		

		paqueteDeDatos.append("valoresAnadidos",JSON.stringify(arrayValores));
		paqueteDeDatos.append("valoresAnadidos2",JSON.stringify(arrayValoresTexto));

		paqueteDeDatos.append("tipo","insertarObservaciones");

		paqueteDeDatos.append("idOrganismo",parametro2);
		paqueteDeDatos.append("idUsuarioC",parametro3);

		$.ajax({

			type:"POST",
			url:"modelosBd/inserta/insertaAccionesDos.md.php",
			contentType: false,
			data:paqueteDeDatos,
			processData: false,
			cache: false, 
			success:function(response){

	            var elementos=JSON.parse(response);
	            var mensaje=elementos['mensaje'];

          		if (mensaje==1) {

          			alertify.set("notifier","position", "top-center");
        			alertify.notify("Registro realizado correctamente", "success", 8, function(){});

				    window.setTimeout(function(){ 
				    	location.reload();
				    } ,5000); 

				}

			},
			error:function(){

			}
				
		});	

	});

	confirm.set('oncancel', function(){ //callbak al pulsar botón negativo

		alertify.set("notifier","position", "top-center");
		alertify.notify("Acción cancelada", "error", 1, function(){

			$(parametro1).show();
			$('.reload__Enviosrealizados').html(' ');

		}); 

	}); 


});

}

/*=====  End of Actualiza envio Observaciones  ======*/



var enviarTramitesGenerados=function(parametro1,parametro2,parametro3,parametro4,parametro5,parametro6,parametro7,parametro8,parametro9){

$(parametro1).click(function (e){

	e.preventDefault();	

	$(parametro1).hide();


	$('.reolad__mMa').html('<img src="images/reloadGit.webp" style="width:50px; height:50px; border-radius:1em;">');

	if (($('#pdfArchivos').val()=="" || $('#pdfArchivos').val()==" " || $('#conlcusion').val()==" " || $('#conlcusion').val()=="")  && parametro5==3 && parametro8!="no__tramite") {


		alertify.set("notifier","position", "top-center");
		alertify.notify("Obligatorio cargar el informe técnico e ingresar la conclusión", "error", 5, function(){});

		$(".boton__enlacesOcultos").show();

		$('.reolad__mMa').html(' ');

	}else if (($(parametro3).val()==" " || $(parametro3).val()=="") && parametro5!=3) {

		alertify.set("notifier","position", "top-center");
		alertify.notify("Obligatorio escoger funcionario a reasignar", "error", 5, function(){});

		$(".boton__enlacesOcultos").show();

		$('.reolad__mMa').html(' ');

	}else if(parametro5==3 && parametro8!="no__tramite"){

		var paqueteDeDatos = new FormData();

		if (parametro7=="recomendadoUni") {

			paqueteDeDatos.append('tipo','recomendadoUni');		

			paqueteDeDatos.append('idUsuarioEn',parametro2[2]);		

			paqueteDeDatos.append('fisicamenteEn',parametro2[1]);

			paqueteDeDatos.append('pdfArchivos', $('#pdfArchivos')[0].files[0]);

		}else{

			paqueteDeDatos.append('tipo','reasignarEnvioFun');		

		}


		var other_data = $('#'+parametro6).serializeArray();

		$.each(other_data,function(key,input){
			paqueteDeDatos.append(input.name,input.value);
		});

		paqueteDeDatos.append('pdfArchivos', $('#pdfArchivos')[0].files[0]);

		paqueteDeDatos.append('idRolRealizados',parametro5);

		paqueteDeDatos.append('fisicamenteEnDoces', parametro2[1]);

		if (parametro9=="administrativo" || parametro9=="instalaciones" || parametro9=="subsesAsigna__cor" || parametro9=="subsesAsigna__corFinans" || parametro9=="subsesAsigna__corInstalac") {
			paqueteDeDatos.append('variableNotificaciones',parametro9);
		}else{
			paqueteDeDatos.append('variableNotificaciones','N/A');
		}

		$.ajax({

			type:"POST",
			url:"modelosBd/inserta/insertaAccionesDos.md.php",
			contentType: false,
			data:paqueteDeDatos,
			processData: false,
			cache: false, 
			success:function(response){

					var elementos=JSON.parse(response);

					var mensaje=elementos['mensaje'];

					if(mensaje==1){

				    	alertify.set("notifier","position", "top-center");
				    	alertify.notify("Registro realizado correctamente", "success", 5, function(){});

				   	 	window.setTimeout(function(){ 

				        	location.reload();

				    	} ,5000); 

		          	}


			},
			error:function(){

			}
				
		});	


	}else{	

		var confirm= alertify.confirm('¿Está seguro de reasignar el trámite?','¿Está seguro de reasignar el trámite?',null,null).set('labels', {ok:'Confirmar', cancel:'Cancelar'});   

		confirm.set({transition:'slide'});    

		confirm.set('onok', function(){ //callbak al pulsar botón positivo

			var paqueteDeDatos = new FormData();

			if(parametro7=="recomendadoUni" && $('#pdfArchivos').val()=="" || $('#pdfArchivos').val()==" "){

				alertify.set("notifier","position", "top-center");
				alertify.notify("Obligatorio cargar el informe técnico y en el caso de ser analista ingresar la conclusión", "error", 5, function(){});

				$(".boton__enlacesOcultos").show();

				$('.reolad__mMa').html(' ');


			}else{


				if (parametro7=="recomendadoUni") {

					paqueteDeDatos.append('tipo','recomendadoUni');	

					paqueteDeDatos.append('idUsuarioEn',parametro2[2]);		

					paqueteDeDatos.append('fisicamenteEn',parametro2[1]);

					paqueteDeDatos.append('pdfArchivos', $('#pdfArchivos')[0].files[0]);

				}else{

					paqueteDeDatos.append('tipo','reasignarEnvioC');

				}	

				if (parametro9=="administrativo" || parametro9=="instalaciones" || parametro9=="subsesAsigna__cor" || parametro9=="subsesAsigna__corFinans" || parametro9=="subsesAsigna__corInstalac" || parametro9=="subsesAsigna__corInstalaciones") {
					paqueteDeDatos.append('variableNotificaciones',parametro9);
				}else{
					paqueteDeDatos.append('variableNotificaciones','N/A');
				}

				if (parametro8=="talentosHumanos") {

					paqueteDeDatos.append('talentos',"si");	

				}else{

					paqueteDeDatos.append('talentos',"no");	

				}

				if (parametro8=="infrasEspecificos") {

					paqueteDeDatos.append('infrasEs',"si");	

				}else{

					paqueteDeDatos.append('infrasEs',"no");	

				}

				paqueteDeDatos.append('idOrganismo',parametro2[0]);	
				  
				paqueteDeDatos.append('fisicamenteE',parametro2[1]);	

				paqueteDeDatos.append('idUsuario',parametro2[2]);	

				paqueteDeDatos.append('textoObservaciones',$(parametro4).val());	

				paqueteDeDatos.append('idUsuarioEnvio',$(parametro3).val());	

				paqueteDeDatos.append('idRolRealizados',parametro5);	


				$.ajax({

					type:"POST",
					url:"modelosBd/inserta/insertaAccionesDos.md.php",
					contentType: false,
					data:paqueteDeDatos,
					processData: false,
					cache: false, 
					success:function(response){

						var elementos=JSON.parse(response);

						var mensaje=elementos['mensaje'];


						if(mensaje==2){

					    	alertify.set("notifier","position", "top-center");
					    	alertify.notify("Solo puede enviar a la zonal", "error", 5, function(){});

							$(parametro1).show();

							$('.reolad__mMa').html(' ');


			          	}


						if(mensaje==3){

					    	alertify.set("notifier","position", "top-center");
					    	alertify.notify("Puede escoger máximo dos zonas de envío, recordando que pueda enviar a infraestructura e instalaciones deportivas", "error", 5, function(){});

							$(parametro1).show();

							$('.reolad__mMa').html(' ');

			          	}

						if(mensaje==1){

					    	alertify.set("notifier","position", "top-center");
					    	alertify.notify("Registro realizado correctamente", "success", 5, function(){});

					   	 	window.setTimeout(function(){ 

					        	location.reload();

					    	} ,5000); 

			          	}


					},
					error:function(){

					}
					
				});	

			}

		});

		confirm.set('oncancel', function(){ //callbak al pulsar botón negativo
			alertify.set("notifier","position", "top-center");
			alertify.notify("Acción cancelada", "error", 1, function(){

				$(parametro1).show();
				$('.reolad__mMa').html(' ');

			}); 
		}); 

	}

});

}



/*=====  End of Reasignar trámite  ======*/

/*===================================
=            Observacion            =
===================================*/

var enviarInforPlani__observaciones=function(parametro1,parametro2,parametro3,parametro4){

$(parametro1).click(function (e){

	e.preventDefault();	

	$(parametro1).hide();

	if (4>5) {

		alertify.set("notifier","position", "top-center");
		alertify.notify("Obligatorio ingresar la persona a asignar", "error", 5, function(){});

		$(parametro1).show();
		$('.reolad__mMa').html(' ');


	}else{


		$('.reolad__mMa').html('<img src="images/reloadGit.webp" style="width:50px; height:50px; border-radius:1em;">');

		var confirm= alertify.confirm('¿Está seguro de reasignar el trámite?','¿Está seguro de reasignar el trámite?',null,null).set('labels', {ok:'Confirmar', cancel:'Cancelar'});   

		confirm.set({transition:'slide'});    

		confirm.set('onok', function(){ //callbak al pulsar botón positivod

		var paqueteDeDatos = new FormData();


		paqueteDeDatos.append('idOrganismo',parametro2);	
					  
		paqueteDeDatos.append('tipo',"observacionPlanificacion");	

		paqueteDeDatos.append('informador',parametro3);

		if (parametro3=="d") {

			var variable=$(".alto__fisiR").val();

			paqueteDeDatos.append('valorObtenido',variable);

		}	

		$.ajax({

			type:"POST",
			url:"modelosBd/inserta/insertaAccionesDos.md.php",
			contentType: false,
			data:paqueteDeDatos,
			processData: false,
			cache: false, 
			success:function(response){

				var elementos=JSON.parse(response);
				var mensaje=elementos['mensaje'];

				if(mensaje==1){

					alertify.set("notifier","position", "top-center");
					alertify.notify("Registro realizado correctamente", "success", 5, function(){});

					window.setTimeout(function(){ 
						location.reload();
					} ,5000); 

				}

			},
			error:function(){}
						
			});	

		});

		confirm.set('oncancel', function(){ //callbak al pulsar botón negativo

			alertify.set("notifier","position", "top-center");
			alertify.notify("Acción cancelada", "error", 1, function(){

				$(parametro1).show();
				$('.reolad__mMa').html(' ');

			}); 

		}); 

	}

});

}


/*=====  End of Observacion  ======*/


/*=============================================
=            Enviar planificación             =
=============================================*/

var enviarInforPlani=function(parametro1,parametro2,parametro3){

$(parametro1).click(function (e){

	e.preventDefault();	

	$(parametro1).hide();

	if (parametro3=="d" && $(".alto__fisiR ").val()=="") {

		alertify.set("notifier","position", "top-center");
		alertify.notify("Obligatorio ingresar la persona a asignar", "error", 5, function(){});

		$(parametro1).show();
		$('.reolad__mMa').html(' ');


	}else{


		$('.reolad__mMa').html('<img src="images/reloadGit.webp" style="width:50px; height:50px; border-radius:1em;">');

		var confirm= alertify.confirm('¿Está seguro de reasignar el trámite?','¿Está seguro de reasignar el trámite?',null,null).set('labels', {ok:'Confirmar', cancel:'Cancelar'});   

		confirm.set({transition:'slide'});    

		confirm.set('onok', function(){ //callbak al pulsar botón positivod

		var paqueteDeDatos = new FormData();


		paqueteDeDatos.append('idOrganismo',parametro2);	
					  
		paqueteDeDatos.append('tipo',"inforPlanificacion");	

		paqueteDeDatos.append('informador',parametro3);

		if (parametro3=="d") {

			var variable=$(".alto__fisiR ").val();

			paqueteDeDatos.append('valorObtenido',variable);

		}	

		$.ajax({

			type:"POST",
			url:"modelosBd/inserta/insertaAccionesDos.md.php",
			contentType: false,
			data:paqueteDeDatos,
			processData: false,
			cache: false, 
			success:function(response){

				var elementos=JSON.parse(response);
				var mensaje=elementos['mensaje'];

				if(mensaje==1){

					alertify.set("notifier","position", "top-center");
					alertify.notify("Registro realizado correctamente", "success", 5, function(){});

					window.setTimeout(function(){ 
						location.reload();
					} ,5000); 

				}

			},
			error:function(){}
						
			});	

		});

		confirm.set('oncancel', function(){ //callbak al pulsar botón negativo

			alertify.set("notifier","position", "top-center");
			alertify.notify("Acción cancelada", "error", 1, function(){

				$(parametro1).show();
				$('.reolad__mMa').html(' ');

			}); 

		}); 

	}

});

}

/*=====  End of Enviar planificación   ======*/


/*===========================================
=            selects concendidos            =
===========================================*/

var segmentosSelectsCOncendidosPrimero=function(parametro1,parametro2,parametro3,parametro4){

	var agregador=0;

	$(parametro1).click(function(e){

		var bandera=true;

		$(parametro2).each(function(index) {

			if($(this).val()=="No cumple"){
		     	bandera=false;
			}

		});


		if (bandera==true) {

			$(".verifica__informacion").remove();

			$("#envioObservaciones").remove();

			$(parametro3).show();


			$(parametro4).show();


		}else{

			$(parametro3).hide();

			if (!$("#observaAdicionales").length > 0 ) {

				var idOrganismo=$("#idOrganismoM").val();
				var idUsuarioC=$("#idUsuarioC").val();

				$(parametro3).after('<br><br><div class="col col-4 verifica__informacion" style="margin-top:2em!important;">OBSERVACIONES ADICIONALES:</div><div class="col col-8 verifica__informacion"><textarea style="margin-top:2em!important;" placeholder="Ingrese observaciones adicionales" name="observaAdicionales" id="observaAdicionales" class="ancho__total__textareas"></textarea></div></div>');

				$(".grupo__especifico_botones").append('<a style="cursor:pointer;" class="btn btn-primary left__margen" id="envioObservaciones" name="envioObservaciones">Enviar</a>');

				envioObservaciones__f($("#envioObservaciones"),idOrganismo,idUsuarioC);

			}

			$(parametro4).hide();


		}

	});

}

/*=====  End of selects concendidos  ======*/

/*=========================================
=            Select realizados            =
=========================================*/

var segmentosSelectsCOncendidos=function(parametro1,parametro2){

	$(parametro1).change(function(e){

		if ($(this).val()=="") {
			$(parametro2).hide();
		}else{
			$(parametro2).show();
		}

	});

}

/*=====  End of Select realizados  ======*/

/*====================================
=            Blur sección            =
====================================*/

var blurFuncion=function(parametro1,parametro2){

	$(parametro1).blur(function(e){


	});

}

/*=====  End of Blur sección  ======*/


/*========================================
=            Ediciones online            =
========================================*/

var edicionesOnlines=function(parametro1,parametro2,parametro3){

	$(parametro1).on('input', function () {

		var paqueteDeDatos = new FormData();

		var campo=$(this).attr('attr');

		var valor=$(this).val();

		var atributoLimitador=$(this).attr('attrF');
				  
		paqueteDeDatos.append('tipo','edicionMatricez');		

		paqueteDeDatos.append("valor",valor);

		paqueteDeDatos.append("campo",campo);

		paqueteDeDatos.append("idOrganismo",atributoLimitador);


		paqueteDeDatos.append("campoComparado",parametro3);

		paqueteDeDatos.append("tabla",parametro2);


		// var confirm= alertify.confirm('¿Está seguro de editar la información de '+campo+'?','¿Está seguro de editar la información de '+campo+'?',null,null).set('labels', {ok:'Confirmar', cancel:'Cancelar'});   

		// confirm.set({transition:'slide'});    

		// confirm.set('onok', function(){ //callbak al pulsar botón positivo


			$.ajax({

				type:"POST",
				url:"modelosBd/inserta/insertaAccionesDos.md.php",
				contentType: false,
				data:paqueteDeDatos,
				processData: false,
				cache: false, 
				success:function(response){

		   //        	var elementos=JSON.parse(response);

		   //        	var mensaje=elementos['mensaje'];

					// if(mensaje==1){

				 //    	alertify.set("notifier","position", "top-center");
				 //    	alertify.notify("Registro realizado satisfactoriamente", "success", 5, function(){});

		   //        	}

				},
				error:function(){

				}
				
			});	

		// });

		// confirm.set('oncancel', function(){ //callbak al pulsar botón negativo
		// 	alertify.set("notifier","position", "top-center");
		// 	alertify.notify("Acción cancelada", "error", 1, function(){


		// 	}); 
		// }); 		

	});

}

/*=====  End of Ediciones online  ======*/



/*===============================
=            checbox            =
===============================*/

var checkboxFunciones=function(parametro1,parametro2,parametro3){

	$(parametro1).click(function(){
	
	    var condicion = $(this).is(":checked");

	    if (condicion) {

	      $(parametro2).show();

	      $(parametro3).hide();


	    }else{

	      $(parametro2).hide();

	      $(parametro3).show();

	   }


	});


}

/*=====  End of checbox  ======*/

var enviarCorreosIniciales=function(parametro1,parametro2,parametro3,parametro4){

$(parametro1).click(function (e){

	e.preventDefault();	

	$(".boton__enlacesOcultos").hide();

	$('.reload__Enviosrealizados').html('<img src="images/reloadGit.webp" style="width:50px; height:50px; border-radius:1em;">');

	var validador= validacionRegistro($(".campos__obligatorios"));
	validacionRegistroMostrarErrores($(".campos__obligatorios"));

	if (validador==false) {

		alertify.set("notifier","position", "top-center");
		alertify.notify("Campos obligatorios", "error", 5, function(){});

		$(".boton__enlacesOcultos").show();

		$('.reload__Enviosrealizados').html(' ');

	}else{	

		var confirm= alertify.confirm('¿Está seguro de '+parametro2+'?','¿Está seguro de '+parametro2+'?',null,null).set('labels', {ok:'Confirmar', cancel:'Cancelar'});   

		confirm.set({transition:'slide'});    

		confirm.set('onok', function(){ //callbak al pulsar botón positivo
			  
			var paqueteDeDatos = new FormData();

			paqueteDeDatos.append('tipo',parametro3);		

			var other_data = $('.'+parametro4).serializeArray();

			var organismoIdPrin=$("#organismoIdPrin").val();

			$.each(other_data,function(key,input){
				paqueteDeDatos.append(input.name,input.value);
			});

			paqueteDeDatos.append("organismoIdPrin",organismoIdPrin);

			$.ajax({

				type:"POST",
				url:"modelosBd/inserta/insertaAccionesDos.md.php",
				contentType: false,
				data:paqueteDeDatos,
				processData: false,
				cache: false, 
				success:function(response){

		          	var elementos=JSON.parse(response);

		          	var mensaje=elementos['mensaje'];

					if(mensaje==1){

				    	alertify.set("notifier","position", "top-center");
				    	alertify.notify("Registro realizado satisfactoriamente", "success", 5, function(){});

				   	 	window.setTimeout(function(){ 

				        	location.reload();

				    	} ,5000); 

		          	}

				},
				error:function(){

				}
				
			});	

		});

		confirm.set('oncancel', function(){ //callbak al pulsar botón negativo
			alertify.set("notifier","position", "top-center");
			alertify.notify("Acción cancelada", "error", 1, function(){

				$(".boton__enlacesOcultos").show();
				$('.reload__Enviosrealizados').html(' ');

			}); 
		}); 

	}

});

}

/*==============================================
=            Culminar trámite total            =
==============================================*/

var terminar__tramites__financieros=function(parametro1,parametro2){


	$(parametro1).click(function(e){

		e.preventDefault();	

		$(this).hide();

		var confirm= alertify.confirm('','¿Está seguro de terminar el trámite?',null,null).set('labels', {ok:'Confirmar', cancel:'Cancelar'});   

		confirm.set({transition:'slide'});    

		confirm.set('onok', function(){ //callbak al pulsar botón positivod

			var paqueteDeDatos = new FormData();

			var organismoIdPrin=$("#organismoIdPrin").val();

			let idOrganismo=$("#idOrganismo").val();

			paqueteDeDatos.append('idOrganismo',idOrganismo);
			paqueteDeDatos.append('tipo','terminar__documento__tramite__quipux');

			$.ajax({

				type:"POST",
				url:"modelosBd/inserta/inserta.md.php",
				contentType: false,
				data:paqueteDeDatos,
				processData: false,
				cache: false, 
			 	success:function(response){

		            var elementos=JSON.parse(response);

		            var mensaje=elementos['mensaje'];

					if(mensaje==1){

				      	alertify.set("notifier","position", "top-center");
				     	alertify.notify("Acción realizado correctamente", "success", 5, function(){});

				      	$(parametro1).hide();

						window.setTimeout(function(){ 

					    	location.reload();

						} ,5000); 


		            }

				},
				error:function(){

				}
				
			});				


		});

		confirm.set('oncancel', function(){
			//callbak al pulsar botón negativo
			alertify.set("notifier","position", "top-center");
			alertify.notify("Canceló el envío", "success", 1, function(){}); 
			$(this).show();

		}); 

	});

}

/*=====  End of Culminar trámite total  ======*/


/*=========================================
=             Regresar trámite            =
=========================================*/


var regresa__tramite__final=function(parametro1,parametro2){


	$(parametro1).click(function(e){

		e.preventDefault();	

		$(this).hide();

		var confirm= alertify.confirm('','¿Está seguro de regresar el trámite?',null,null).set('labels', {ok:'Confirmar', cancel:'Cancelar'});   

		confirm.set({transition:'slide'});    

		confirm.set('onok', function(){ //callbak al pulsar botón positivod

			var paqueteDeDatos = new FormData();

			var organismoIdPrin=$("#organismoIdPrin").val();

			let idOrganismo=$("#idOrganismo").val();

			paqueteDeDatos.append('idOrganismo',idOrganismo);
			paqueteDeDatos.append('tipo','regresar__documento__tramite__quipux');

			$.ajax({

				type:"POST",
				url:"modelosBd/inserta/inserta.md.php",
				contentType: false,
				data:paqueteDeDatos,
				processData: false,
				cache: false, 
			 	success:function(response){

		            var elementos=JSON.parse(response);

		            var mensaje=elementos['mensaje'];

					if(mensaje==1){

				      	alertify.set("notifier","position", "top-center");
				     	alertify.notify("Acción realizado correctamente", "success", 5, function(){});

				      	$(parametro1).hide();

						window.setTimeout(function(){ 

					    	location.reload();

						} ,5000); 


		            }

				},
				error:function(){

				}
				
			});				


		});

		confirm.set('oncancel', function(){
			//callbak al pulsar botón negativo
			alertify.set("notifier","position", "top-center");
			alertify.notify("Canceló el envío", "success", 1, function(){}); 
			$(this).show();

		}); 

	});

}


/*=====  End of  Regresar trámite  ======*/


/*====================================================================
=            Sección de envio de transferencias en quipux            =
====================================================================*/

var cargarFileSevidor__transferencias=function(parametro1,parametro2){


	$(parametro1).click(function(e){

		e.preventDefault();	

		$(this).hide();

		if( document.getElementById("quipux__Suscritos").files.length == 0 ){
    
			alertify.set("notifier","position", "top-center");
			alertify.notify("Obligatorio cargar el archivo", "error", 5, function(){});


		}else{

			var confirm= alertify.confirm('','¿Está seguro de subir el archivo seleccionado?',null,null).set('labels', {ok:'Confirmar', cancel:'Cancelar'});   

			confirm.set({transition:'slide'});    

			confirm.set('onok', function(){ //callbak al pulsar botón positivod

				var paqueteDeDatos = new FormData();

				var organismoIdPrin=$("#organismoIdPrin").val();

				paqueteDeDatos.append('tipo','subirDocumentos__quipux__transferencias');

				paqueteDeDatos.append('documentoReemplazo',$("#quipux__Suscritos")[0].files[0]);

				let idOrganismo=$("#idOrganismo").val();

				paqueteDeDatos.append('idOrganismo',idOrganismo);

				$.ajax({

				    type:"POST",
				    url:"modelosBd/inserta/inserta.md.php",
				    contentType: false,
				    data:paqueteDeDatos,
				    processData: false,
				    cache: false, 
			    	success:function(response){

		            	var elementos=JSON.parse(response);

		            	var mensaje=elementos['mensaje'];

						if(mensaje==1){

				            alertify.set("notifier","position", "top-center");
				            alertify.notify("Acción realizado correctamente", "success", 5, function(){});

				            $(parametro1).hide();

					   	 	window.setTimeout(function(){ 

					        	location.reload();

					    	} ,5000); 


		            	}

					},
					error:function(){

					}
				
				});				


			});

			confirm.set('oncancel', function(){
			 //callbak al pulsar botón negativo
				alertify.set("notifier","position", "top-center");
				alertify.notify("Canceló el envío", "success", 1, function(){}); 
				$(this).show();

			}); 

		}

	});

}

/*=====  End of Sección de envio de transferencias en quipux  ======*/

/*===================================================
=             Inserta proyecto organismo            =
===================================================*/


var inserta__proyecto__organismo=function(parametro1,parametro2,parametro3,parametro6){

	$(parametro1).click(function(e){

		e.preventDefault();	

		// $(this).hide();

		var validador= validacionRegistro($(".obligatorio"));
		validacionRegistroMostrarErrores($(".obligatorio"));

		if (validador==false) {

			alertify.set("notifier","position", "top-center");
			alertify.notify("Campos obligatorios", "error", 5, function(){});

		}else{

			var confirm= alertify.confirm('','¿Está seguro de ingresar el valor asignado?',null,null).set('labels', {ok:'Confirmar', cancel:'Cancelar'});   

			confirm.set({transition:'slide'});    

			confirm.set('onok', function(){ //callbak al pulsar botón positivo

				var paqueteDeDatos = new FormData();

				var other_data = $(parametro2).serializeArray();

				$.each(other_data,function(key,input){

					var stringComparador=input.name;

					if (stringComparador.includes("organismos__id")) {
						paqueteDeDatos.append("organismos__id",input.value);
					}else if(stringComparador.includes("montoOrganismo")){
						paqueteDeDatos.append("montoOrganismo",input.value);
					}
					
				});


				paqueteDeDatos.append('tipo',"paidorganismos");
				paqueteDeDatos.append('documento', $(parametro3)[0].files[0]);
				paqueteDeDatos.append('idProyecto', parametro6);

				$.ajax({

					type:"POST",
					url:"modelosBd/inserta/inserta.md.php",
					contentType: false,
					data:paqueteDeDatos,
					processData: false,
					cache: false, 
				 	success:function(response){

			            var elementos=JSON.parse(response);

			            var mensaje=elementos['mensaje'];

						if(mensaje==1){

					        alertify.set("notifier","position", "top-center");
					        alertify.notify("Acción realizado correctamente", "success", 5, function(){});

					        $(parametro1).hide();

						   	window.setTimeout(function(){ 

						     	// location.reload();
						     	$(parametro2).remove();

						   } ,5000); 


			            }

					},
					error:function(){

					}
					
				});				


			});

			confirm.set('oncancel', function(){
				//callbak al pulsar botón negativo
				alertify.set("notifier","position", "top-center");
				alertify.notify("Canceló el envío", "success", 1, function(){}); 
				$(this).show();

			}); 

		}

	});

}

/*=====  End of  Inserta proyecto organismo  ======*/
