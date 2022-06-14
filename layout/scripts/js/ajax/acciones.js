$(document).ready(function () {

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


var fechasActuales=function(parametro1){

	var today = new Date();
	var dd = today.getDate();
	var mm = today.getMonth() + 1; //January is 0!
	var yyyy = today.getFullYear();

	$(parametro1).val(yyyy+'-'+mm+'-'+dd);

}

fechasActuales($("#fechaPrincipalJ"));

var insertaValidaciones=function(parametro1,parametro2,parametro3,parametro4,parametro5,parametro6,parametro7,parametro8,parametro9,parametro10){

$(parametro1).click(function (e){

	e.preventDefault();	

	$(".boton__enlacesOcultos").hide();

	$('.reload__Enviosrealizados').html('<img src="images/reloadGit.webp" style="width:50px; height:50px; border-radius:1em;">');

	if (parametro3=="prompt") {

	    alertify.prompt('¿Está seguro de '+parametro2+'?', '', function(evt, value){ 

	       if (value=="") {

	          evt.cancel = true;

	          alertify.set('notifier','position', 'top-center');
	          alertify.notify('Es necesario ingresar la observación', 'error', 5, function(){});

	       }else{

			    var paqueteDeDatos = new FormData();

			    paqueteDeDatos.append('tipo','enviarDesicion');

			    var other_data = $('#'+parametro10).serializeArray();

			    $.each(other_data,function(key,input){
			        paqueteDeDatos.append(input.name,input.value);
			    });

			    var arrayValores = new Array(); 

			    $("#comentarioNecesario").val(value);

			    for (var i =0; i< parametro9.length ; i++) {
			    	
			    	if (parametro9[i]=="input") {

			    		var variableInput=$("#"+parametro8[i]).val();

			    		arrayValores.push(variableInput);

			    	}else{

			    		arrayValores.push(parametro8[i]);


			    	}

			    }
			 
				paqueteDeDatos.append("tabla",parametro4);
				paqueteDeDatos.append("campos",JSON.stringify(parametro5));
				paqueteDeDatos.append("parametros",JSON.stringify(parametro6));
				paqueteDeDatos.append("valores",JSON.stringify(arrayValores));
				paqueteDeDatos.append("parametrosEnvio",JSON.stringify(parametro7));

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

	    }, function(){ 

	         alertify.set("notifier","position", "top-center");
	         alertify.notify("Acción cancelada", "error", 1, function(){

				$(".boton__enlacesOcultos").show();

				$('.reload__Enviosrealizados').html(' ');

	         });

	    });

	}else{

		var confirm= alertify.confirm('¿Está seguro de '+parametro2+'?','¿Está seguro de '+parametro2+'?',null,null).set('labels', {ok:'Confirmar', cancel:'Cancelar'});   

		confirm.set({transition:'slide'});    

		confirm.set('onok', function(){ //callbak al pulsar botón positivo
			  
			var paqueteDeDatos = new FormData();

			paqueteDeDatos.append('tipo',parametro4);		

			var other_data = $('#'+parametro8).serializeArray();

			$.each(other_data,function(key,input){
				paqueteDeDatos.append(input.name,input.value);
			});

			var emailPrincipal=$("#emailPrincipal").val();
			var nombrePrincipalU=$("#nombrePrincipalU").val();
			var idOrganismoPrincipal=$("#idOrganismoPrincipal").val();

			paqueteDeDatos.append("emailPrincipal",emailPrincipal);
			paqueteDeDatos.append("tabla",parametro5);
			paqueteDeDatos.append("valoresArray",JSON.stringify(parametro6));
			paqueteDeDatos.append("idBuscado",parametro7);
			paqueteDeDatos.append("nombrePrincipalU",nombrePrincipalU);
			paqueteDeDatos.append("idOrganismoPrincipal",idOrganismoPrincipal);

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

				$(".boton__enlacesOcultos").show();
				$('.reload__Enviosrealizados').html(' ');

			}); 
		}); 

	}


});

}
insertaValidaciones($("#generarNegacion"),"negar la solicitud. Escribir la razón de negación","prompt",'poa_observaciones',['`idObservaciones`, `observacion`, `tipoObservacion`, `idOrganismo`, `fecha`, `estado`'],[':observacion, ',':tipoObservacion, ',':idOrganismo, ',':fecha, ',':estado'],[':observacion',':tipoObservacion',':idOrganismo',':fecha',':estado'],['comentarioNecesario','aprobacionUsuario','enviado','fechaPrincipalJ','A'],['input','texto','input','input','texto'],"formularioAprobacion");

insertaValidaciones($("#generarAprobacion"),"aprobar la solicitud.","confirm","aprobarSolicitudUsuario",'poa_organismo',['D'],'idOrganismo',"formularioAprobacion");


insertaValidaciones($("#respuestaAprobacion")," de haber realizado las correcciones sugeridas","confirm","aprobacionUsuarioR",'poa_observaciones',['C'],'idOrganismo',"observacionesForm");



var insertaValidacionesDos=function(parametro1,parametro2,parametro3,parametro4,parametro5){

$(parametro1).click(function (e){

	$(".boton__enlacesOcultos").hide();

	$('.reload__Enviosrealizados').html('<img src="images/reloadGit.webp" style="width:50px; height:50px; border-radius:1em;">');


	var validador= validacionRegistro($(".campos__obligatorios"));
	validacionRegistroMostrarErrores($(".campos__obligatorios"));

	if (validador==false) {

		alertify.set("notifier","position", "top-center");
		alertify.notify("Campos obligatorios", "error", 5, function(){});

		$(".boton__enlacesOcultos").show();

		$('.reload__Enviosrealizados').html(' ');	

		e.preventDefault();		

	}else{	

		alertify.set("notifier","position", "top-center");
		alertify.notify("Asignación realizada correctamente", "success", 5, function(){});

		window.setTimeout(function(){ 

				location.reload();

		} ,5000); 		

	}

});

}

insertaValidacionesDos($("#insertarAsignacion")," de la información ingresada","confirm","asignacionPresupuestos","formAsignar");


/*=========================================
=            Enviar documentos            =
=========================================*/

var documentosFinancieros=function(parametro1,parametro2,parametro3){

$(parametro1).click(function (e){

	var validador= validacionRegistro($(".obligatorios__archivos"));
	validacionRegistroMostrarErrores($(".obligatorios__archivos"));



	$(parametro1).hide();
	$('.reload__Enviosrealizados').html('<img src="images/reloadGit.webp" style="width:50px; height:50px; border-radius:1em;">');

	if (validador==false) {

		alertify.set("notifier","position", "top-center");
		alertify.notify("Todos los documentos con * son obligatorios", "error", 5, function(){});

		$(parametro1).show();
		$('.reload__Enviosrealizados').html(' ');

	}else{

		var confirm= alertify.confirm('¿Está seguro de enviar los documentos para ser válidados?','¿Está seguro de enviar los documentos para ser válidados?',null,null).set('labels', {ok:'Confirmar', cancel:'Cancelar'});   

		confirm.set({transition:'slide'});    

		confirm.set('onok', function(){ //callbak al pulsar botón positivo		


			var paqueteDeDatos = new FormData();

			paqueteDeDatos.append('tipo',parametro3);	

			let idOrganismo=$("#organismoIdPrin").val();
			paqueteDeDatos.append('idOrganismo',idOrganismo);	

			for (var i=0; i<parametro2.length;i++) {

				if ($(parametro2[i]).val()=="texto") {

					paqueteDeDatos.append('archivo'+i, $(parametro2[i]).val());

				}else{

					paqueteDeDatos.append('archivo'+i, $(parametro2[i])[0].files[0]);

				}	

				
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

				$(parametro1).show();
				$('.reload__Enviosrealizados').html(' ');

			}); 
		}); 


	}


});

}

documentosFinancieros($("#enviarTramitesFinancieros"),[$("#polizaVigencia"),$("#caucionOriginal"),$("#copiaBancario"),$("#copiaRegistro__directorio"),$("#copiaFinanciero"),$("#copiaGeneral"),$("#copiaIntervencion"),$("#copiaEstatutos"),$("#copiaRucA")],"asignarDocus__financieros");

/*=====  End of Enviar documentos  ======*/



/*=======================================
=            Enviar correos             =
=======================================*/

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
				    	alertify.notify("Acción realizada satisfactoriamente", "success", 5, function(){});

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

enviarCorreosIniciales($("#enviarMensajeCon")," de enviar el mensaje","mensajeContacto","formInforOrganismos");
enviarCorreosIniciales($("#enviarPreliminar")," de enviar el poa preliminar","preliminarPoa","formulario__preliminarEnvio");
enviarCorreosIniciales($("#guardarInfor__i")," de crear la intervención","intervencion","formulario__intervencion");


/*=====  End of Enviar correos   ======*/

/*==========================================
=            Enviar información            =
==========================================*/

var ediciones__conArchivos=function(parametro1,parametro2,parametro3,parametro4){

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

			paqueteDeDatos.append('documentoFinal', $('#documentos__nue')[0].files[0]);

			if ($('#documentos__nue')[0].files[0]!="" && $('#documentos__nue')[0].files[0]!=undefined) {
				paqueteDeDatos.append('estaDocumento','si');
			}else{
				paqueteDeDatos.append('estaDocumento','no');
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
				    	alertify.notify("Acción realizada satisfactoriamente", "success", 5, function(){});

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

ediciones__conArchivos($("#editarInfor")," de editar la información","editasInfor__final","form__editarInfors");

/*=====  End of Enviar información  ======*/


var eliminar__datosI=function(parametro1,parametro2,parametro3){

$(parametro1).click(function (e){

	e.preventDefault();	

	$(parametro1).hide();

	var paqueteDeDatos = new FormData();

	paqueteDeDatos.append('tipo',parametro3);	

	let organismoId=$("#organismoId").val();

	paqueteDeDatos.append("organismoId",organismoId);

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
				alertify.notify("Eliminación realizada satisfactoriamente", "success", 5, function(){});

				window.setTimeout(function(){ 

					location.reload();

				} ,5000); 

		     }

		},
		error:function(){

		}
				
	});	


});

}

eliminar__datosI($("#eliminarInfor")," de eliminar la intervención","eliminar_intervencion");


var documentos__finan__rectificados=function(parametro1,parametro2){

$(parametro1).click(function (e){


	e.preventDefault();	

	$(parametro1).hide();

	var confirm= alertify.confirm('¿Está seguro de enviar el archivo seleccionado?','¿Está seguro de enviar el archivo seleccionado?',null,null).set('labels', {ok:'Confirmar', cancel:'Cancelar'});   

	confirm.set({transition:'slide'});    

	confirm.set('onok', function(){ //callbak al pulsar botón positivo

		var paqueteDeDatos = new FormData();

		paqueteDeDatos.append('tipo','rectificacion__docus__financieros');	

		let organismoId=$("#organismoIdPrin").val();

		let tipologia=$(parametro1).attr('attr');



		paqueteDeDatos.append("organismoId",organismoId);
		paqueteDeDatos.append("tipologia",tipologia);
		paqueteDeDatos.append("archivo",$('#'+parametro2)[0].files[0]);


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
					alertify.notify("Obligatorio cargar archivo", "error", 5, function(){});

					$(parametro1).show();

			    }

				if(mensaje==1){

					alertify.set("notifier","position", "top-center");
					alertify.notify("Acción realizada satisfactoriamente", "success", 5, function(){});

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

		}); 
	}); 

});

}

documentos__finan__rectificados($("#guardarRechazo__poliza"),"polizaVigencia");
documentos__finan__rectificados($("#guardarRechazoCaucion"),"caucionOriginal");
documentos__finan__rectificados($("#guardarRechazoCertificado__bancario"),"copiaBancario");
documentos__finan__rectificados($("#guardarRechazoCopia__registroD"),"copiaRegistro__directorio");
documentos__finan__rectificados($("#guardarRechazoVisualiza__financiero"),"copiaFinanciero");
documentos__finan__rectificados($("#guardarRechazo__copiaAdmin__general"),"copiaGeneral");
documentos__finan__rectificados($("#guardarRechazo__copia__intervencion"),"copiaIntervencion");
documentos__finan__rectificados($("#guardarRechazo__copia__acuerdo__registro"),"copiaEstatutos");
documentos__finan__rectificados($("#guardarRechazo__copia__acuerdo__registro__ruc"),"copiaRucA");

});