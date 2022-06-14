$(document).ready(function () {

	/*============================================
=            Eliminar los errores            =
============================================*/

var celularValidas=function(parametro1){

	$(parametro1).on('input', function (e){

		$(this).removeClass('error');

	});

}
celularValidas($(".campos__obligatorios"));



/*=====  End of Eliminar los errores  ======*/

/*====================================
=            Solo números            =
====================================*/

$(".solo__numero").on('input', function () {

	this.value = this.value.replace(/[^0-9]/g, '');

});


var funcion__solo__numero__montos=function(parametro1){
					
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

$(parametro1).on('input', function () {

	this.value = this.value.replace(/[^0-9,.]/g, '').replace(',','.');

});

}

funcion__solo__numero__montos($(".solo__numero__montos"));



$(".no__especiales").on('input', function () {

	this.value = this.value.replace(/^[^A-Za-z]+$/g, '');

});

/*=====  End of Solo números  ======*/

/*===============================================
=            Validación de célulares            =
===============================================*/

var celularValidas=function(parametro1){

	$(parametro1).click(function(){

		$(this).val('09');

	});


	$(parametro1).keyup(function(e){

	 	if($(this).val().length<=2){

	 		if(e.keyCode == 8){

	 			$(this).val('09');

	 		}

	 	}

	});

}


/*=====  End of Validación de célulares  ======*/


var reloadModalS=function(parametro1){

	$(parametro1).click(function(){

		location.reload();

	});

}

reloadModalS($(".reload__ModalesA"));

/*====================================
=            Convencional            =
====================================*/

var convencionalValidas=function(parametro1){

	$(parametro1).click(function(){

		$(this).val('0');

	});


	$(parametro1).keyup(function(e){

	 	if($(this).val().length<=2){

	 		if(e.keyCode == 8){

	 			$(this).val('02');

	 		}

	 	}

	});

}

convencionalValidas($("#telefonoOficinas"));
convencionalValidas($("#celularCiudadano"));

/*=====  End of Convencional  ======*/

/*==========================================
=            Longitud elementos            =
==========================================*/

var longitudCaracteres=function(parametro1,parametro2,counter){

$(parametro1).keyup(function(e){

   if($(this).val().length > parametro2){

        $(this).val($(this).val().substr(0, parametro2));

        counter.html("Son máximo <strong>"+parametro2+" caracteres</strong>");

        counter.css("color","red");

    }else{

      // counter.html("<strong>"+$(this).val().length +"</strong>");

      counter.css("color","black");

      counter.css("font-size","10px");

    }


 });

}

longitudCaracteres($("#cedulaCiudadano"),10,$(".counter__Cedula"));
longitudCaracteres($("#rucOrganismo"),13,$(".counter__Ruc"));
longitudCaracteres($("#cedulaRepresentante"),10,$(".counter__CedulaRepresentante"));
longitudCaracteres($("#telefonoOficinas"),10,$(".countertelefonoOficinas"));
longitudCaracteres($("#celularCiudadano"),10,$(".counterCelular__ciudadano"));
longitudCaracteres($("#cedulaInterventor"),10,$(".counterCelular__ciudadano"));
longitudCaracteres($("#rucOrganismo"),13,$(".counter__Ruc"));

/*=====  End of Longitud elementos  ======*/

/*==========================================
=            Caracteres minimos            =
==========================================*/

var longitudCaracteresMinimos=function(parametro1,parametro2,counter){

$(parametro1).blur(function(e){

   $(parametro1).removeClass("error2");

   if($(this).val().length < parametro2){

        $(this).val($(this).val().substr(0, parametro2));

        counter.html("Son mínimo <strong>"+parametro2+" caracteres</strong>");

        counter.css("color","blue");

    }else{

    	$(counter).html("");

    }

 });

$(parametro1).keyup(function(e){

   $(counter).html("");

});

}

longitudCaracteresMinimos($("#cedulaCiudadano"),10,$(".counter__CedulaMensajes"));
longitudCaracteresMinimos($("#celularCiudadano"),10,$(".counter__CelularMensajes"));
longitudCaracteresMinimos($("#cedulaRepresentante"),10,$(".counter__CedulaRepresentanteMensajes"));
longitudCaracteresMinimos($("#telefonoOficinas"),10,$(".counter__telefonoOficinasMensajes"));
longitudCaracteresMinimos($("#rucOrganismo"),13,$(".counter__rucOrganismoMensajes"));


/*=====  End of Caracteres minimos  ======*/


/*==========================================
=            Validar caracteres            =
==========================================*/

var validarCaracteres=function(parametro1,parametro2,parametro3,parametro4){

	$(parametro1).keyup(function(e){ 

	 $(parametro3).removeClass('error2');

	 if (parametro2.test($(this).val().trim())){

	    	$(parametro3).html("");


	  }else {

	  		switch (parametro4) {

	  			case 0:
	  				$(parametro3).html("Por favor registre una dirección de correo electrónico válida a través de la cual el Ministerio del Deporte le remitirá información importante del proceso");
	  			break;

	  			case 1:
	  				$(parametro3).html("El usuario debe comenzar con letras y no debe tener caracteres especiales, debe tener un mínimo de 4 caracteres y máximo de 16 caracteres (Solo se acepta @,punto,- y _)");
	  			break;

	  			case 2:
	  				$(parametro3).html("La contraseña debe contener al menos 5 caracteres y un máximo de 15, una letra mayúscula, una letra minucula, un dígito, no caracteres especiales y espacios en blanco");
	  			break;

	  			case 3:
	  				$(parametro3).html("La contraseña debe comenzar con letras y no puede tener caracteres especiales y debe tener un mínimo de 5 caracteres y máximo de 16");
	  			break;

	  		}

	    	

	        $(parametro3).css("color","red");

	        $(parametro3).css("font-size","10px");

	  }


	 });

}

validarCaracteres($("#emailCiudadano"),/[\w-\.]{2,}@([\w-]{2,}\.)*([\w-]{2,}\.)[\w-]{2,4}/,$(".counterCorreo__ciudadano"),0);
validarCaracteres($("#emailOrganismo"),/[\w-\.]{2,}@([\w-]{2,}\.)*([\w-]{2,}\.)[\w-]{2,4}/,$(".counterCorreo__organismo"),0);
validarCaracteres($("#emailRepresentante"),/[\w-\.]{2,}@([\w-]{2,}\.)*([\w-]{2,}\.)[\w-]{2,4}/,$(".counterCorreo__representante"),0);
validarCaracteres($("#passwordOrganismo"),/^[a-zA-Z0-9]{5,16}/,$(".counterPasswordValido__organismo"),3);
validarCaracteres($("#passwordOrganismoReset"),/^[a-zA-Z0-9]{5,16}/,$(".visualizar__error__password"),3);

/*=====  End of Validar caracteres  ======*/

/*================================
=            Checkbox            =
================================*/

var checkboxFunciones=function(parametro1,parametro2){

	$(parametro1).click(function(){
	
	    var condicion = $(this).is(":checked");

	    if (condicion) {

	      $(parametro2).show();


	    }else{

	      $(parametro2).hide();

	   }


	});


}
checkboxFunciones($("#generarFilasAcuerdo"),$(".acuerdo__responsabilidad__oculto"));
checkboxFunciones($("#generarFilasAcuerdoMinis"),$(".acuerdo__ministerial__oculto"));

/*=====  End of Checkbox  ======*/



/*==================================
=            Datepicker            =
==================================*/

var datepicker=function(parametro1){

/*========================================
=            Selección fechas            =
========================================*/
	
$(parametro1).datepicker({

	language: 'es',
	changeMonth: true,
	changeYear: true,
	dateFormat: 'yy/mm/dd', 
	yearRange: '-110:+100',

 });	
	
/*=====  End of Selección fechas  ======*/
		
/*===========================================
=            Regional datapicker            =
===========================================*/

$.datepicker.regional['es'] = {
	closeText: 'Cerrar',
	prevText: '<Ant',
	nextText: 'Sig>',
	currentText: 'Hoy',
	monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
	monthNamesShort: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
	dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
	dayNamesShort: ['Dom', 'Lun', 'Mar', 'Mié', 'Juv', 'Vie', 'Sáb'],
	dayNamesMin: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sá'],
	weekHeader: 'Sm',
	dateFormat: 'dd/mm/yy',
	firstDay: 1,
	isRTL: false,
	showMonthAfterYear: false,
	yearSuffix: ''
};

$.datepicker.setDefaults($.datepicker.regional['es']);

/*=====  End of Regional datapicker  ======*/

}

// datepicker($("#fechaAcuerdoOrganismo"));
// datepicker($("#fechaAacuerdoMinisterial"));
// datepicker($("#fechaNacimientoPresidente"));

/*=====  End of Datepicker  ======*/

/*=============================================
=            Obtener datos del ruc            =
=============================================*/

var cedulaBuscadora=function(parametro1,parametro2,parametro3,parametro4){

$(parametro1).click(function(e){


	var paqueteDeDatos = new FormData();
	paqueteDeDatos.append('tipo',parametro4);

	var rucEnviado=$(parametro3[2]).val();

	paqueteDeDatos.append('rucOrganismo',rucEnviado);

	$(parametro1).hide();
	 	
	$(parametro2).html('<img src="images/reloadGit.webp" style="height:35px; margin-left: .5em; border-radius: .5em; cursor: pointer;">');


	$.ajax({

		type:"POST",
		url:"modelosBd/inserta/seleccionaAcciones.md.php",
		contentType: false,
		data:paqueteDeDatos,
		processData: false,
		cache: false,  
		success:function(response){

			var elementos=JSON.parse(response);
			var informacion__obtenidas=elementos['informacion__obtenidas'];

			if (informacion__obtenidas=="" || informacion__obtenidas==undefined || informacion__obtenidas==null || informacion__obtenidas==" ") {

				alertify.set("notifier","position", "top-center");
				alertify.notify("El ruc ingresado no se encuentra registrado en el aplicativo POA", "error", 10, function(){});

				$(parametro1).show();
				 	
				$(parametro2).html(' ');

	
			}else{


				$(parametro3[0]).show();
				$(parametro3[1]).show();
				$(parametro3[3]).show();
				$(parametro3[4]).show();
				$(parametro3[5]).show();

				for (c of informacion__obtenidas) {

					$(parametro3[0]).val(c.nombreOrganismo);
					$(parametro3[1]).val(c.idOrganismo);
					$(parametro3[3]).val(c.nombreProvincia);
					$(parametro3[4]).val(c.nombreCanton);
					$(parametro3[5]).val(c.nombreParroquia);

				}				

				$(parametro1).show();
				 	
				$(parametro2).html(' ');



			}

	    },
	    error:function(){
	    	
	    } 

	});

});

}

cedulaBuscadora($("#buscarRuc__i"),$(".reload__rucI"),[$("#nombreOrganismo__i"),$("#idOrganismo_i"),$("#rucOrganismo"),$("#provincia__i"),$("#canton__i"),$("#parroquia__i")],"ruc_i");

/*=====  End of Obtener datos del ruc  ======*/



/*======================================
=            Cédula validas            =
======================================*/

var cedulaBuscadora=function(parametro1,parametro2,parametro3,parametro4,parametro5,parametro6,parametro7){

$(parametro1).click(function(e){

	$(parametro1).hide();
	 	
	$(parametro2).html('<img src="images/reloadGit.webp" style="height:35px; margin-left: .5em; border-radius: .5em; cursor: pointer;">');

	$.ajax({

		url:"php/dinardap.php",
		type:"POST",
		dataType:"json",
		data:"cedula="+$(parametro3).val(),
		success:function(datos){

	    	if (datos==null) {
	                 
				alertify.set("notifier","position", "top-center");
				alertify.notify("La cédula ingresada no existe", "error", 5, function(){});

	        	$(parametro2).html('');

	        	$(parametro1).show();

	    	}else{

	            // recuperación de datos de la dinardap
	       		$(parametro4).val(datos.nombre);

	       		$(parametro7).val(datos.nombre)

	       		if (parametro5!=false) {

	                if(datos.sexo=="HOMBRE"){

	                	$(parametro5).val("MASCULINO");

	                }else{

	                	$(parametro5).val("FEMENINO");

	                }

		                  
		            $(parametro6).val(datos.fechaNacimiento);

		            $("#nombreCiudadano").val(datos.nombre);

		            $("#apellidoCiudadano").val(datos.nombre);

					/*=========================================
					=            Calculo de edades            =
					=========================================*/

					function calcularEdad(fecha) {

						var hoy = new Date();
						var cumpleanos = new Date(fecha);
						var edad = hoy.getFullYear() - cumpleanos.getFullYear();
						var m = hoy.getMonth() - cumpleanos.getMonth();

						if (m < 0 || (m === 0 && hoy.getDate() < cumpleanos.getDate())) {
							edad--;
						}

						return edad;

					}

					var edadRealizables=calcularEdad(datos.fechaNacimiento);
						
					/*=====  End of Calculo de edades  ======*/


	            }

	            $(parametro2).html('');

	            $(parametro1).show();

	            $(parametro4).show();


	        }          
	               
	    },
	    error:function(response,status,error){
	    	alert("no encontrado");
	    } 

	});

});

}

cedulaBuscadora($("#buscarCedulaPresidente"),$(".reload__CedulasCiudadanos"),$("#cedulaCiudadano"),$("#nombreCiudadano"),$("#sexoCiudadano"),$("#fechaDeNacimientoCiudadano"),$("#apellidoCiudadano"));

cedulaBuscadora($("#buscar__CedulaPersonaContacto"),$(".reload__personaContacto"),$("#cedulaRepresentante"),$("#nombreRepresentante"),$("#sexoCiudadano"),$("#fechaDeNacimientoCiudadano"),$("#apellidoRepresentante"));

cedulaBuscadora($("#buscarCedulaRepresentanteEdicion"),$(".reload__CedulasCiudadanos"),$("#cedulaRepresentanteOrganismoDeportivo"),$("#representanteOrganismoDeportivo"),$("#sexoCiudadano"),$("#fechaDeNacimientoCiudadano"),$("#apellidoCiudadano"));

cedulaBuscadora($("#buscarCedulaPresidenteEdicion"),$(".reload__CedulasCiudadanos"),$("#cedulaPresidenteOrganismoDeportivo"),$("#presidenteOrganismoDeportivo"),$("#generoPresidente"),$("#fechaNacimientoPresidente"),$("#presidenteOrganismoDeportivoApe"));

cedulaBuscadora($("#buscarCedulaPresidenteEdicion"),$(".reload__CedulasCiudadanos"),$("#cedulaPresidenteOrganismoDeportivo"),$("#presidenteOrganismoDeportivo"),$("#generoPresidente"),$("#fechaNacimientoPresidente"),$("#presidenteOrganismoDeportivoApe"));

cedulaBuscadora($("#buscarCedula__i"),$(".reload__cedulas__i"),$("#cedulaInterventor"),$("#nombreInterventor__i"));

/*=====  End of Cédula validas  ======*/


/*=================================================
=            Generar contraseña vistas            =
=================================================*/

var verOjoContrasenas=function(parametro1,parametro2){

	$(parametro1).click(function(){
	
		var tipo=$(parametro2).attr('type');	

		if (tipo=="text") {


			$(this).addClass('fa-eye');

			$(this).removeClass('fa-eye-slash')

			$(parametro2).attr('type','password');


		}else{

			$(this).removeClass('fa-eye');

			$(this).addClass('fa-eye-slash');

			$(parametro2).attr('type','text');


		}


	});


}
verOjoContrasenas($("#ojo_icono"),$("#passwordOrganismoReset"));

/*=====  End of Generar contraseña vistas  ======*/

/*============================================
=             Crear dinamicamente            =
============================================*/

let contadorCrea=0;

var agregar__dinamicos=function(parametro1,parametro2,parametro3,parametro4){

	$(parametro1).click(function(){

		contadorCrea++;
	
		$(parametro2).append('<div class="col col-10 mt-2 '+parametro3+"__"+contadorCrea+'"><input type="text" class="ancho__total__input '+parametro3+' obligatorios" id="'+parametro3+"__"+contadorCrea+'" name="'+parametro3+"__"+contadorCrea+'" placeholder="'+parametro4+'"/></div><div class="col col-2 mt-2 '+parametro3+"__"+contadorCrea+'"><a id="eliminar__'+parametro3+contadorCrea+'" name="eliminar__'+parametro3+contadorCrea+'" class="btn btn-danger" idContador="'+contadorCrea+'"><i class="fas fa-trash"></i></a></div>');

		$("#eliminar__"+parametro3+contadorCrea).click(function(){

			let idContador=$(this).attr('idContador');

			$("."+parametro3+"__"+idContador).remove();

		});


		if (parametro3=="codigo__proyecto") {

			$("."+parametro3).addClass('solo__numero');

		}


		$(".solo__numero").on('input', function () {

			this.value = this.value.replace(/[^0-9]/g, '');

		});



	});
	

}

agregar__dinamicos($("#agregar__especificos"),$(".contenedor__especificos"),"objetivo__especificos","Ingrese objetivo específico");
agregar__dinamicos($("#agregar__actividades__rubros"),$(".contenedor__actividades__rubros"),"actividades__rubros","Ingrese actividad/rubro");
agregar__dinamicos($("#agregar__matriz__auxiliar"),$(".contenedor__matriz__auxiliar"),"matriz__auxiliar","Ingrese mátriz auxiliar");
agregar__dinamicos($("#agregar__campo__de__columna"),$(".contenedor__campo__de__columna"),"campo__columna","Ingrese campo de columna");
agregar__dinamicos($("#agregar__item"),$(".contenedor__item"),"items__proyecto","Ingrese ítem");
agregar__dinamicos($("#agregar__item__codigo"),$(".contenedor__item__presupuestario"),"codigo__proyecto","Ingrese código ítem presupuestario");
agregar__dinamicos($("#agregar__indicador"),$(".contenedor__indicador"),"indicador__proyecto","Ingrese indicador del proyecto");

/*=====  End of  Crear dinamicamente  ======*/

/*=============================================
=            Crear dinamicamente 2            =
=============================================*/

/*======================================
=            Proyectos paid            =
======================================*/

let contadorCrea2=0;
let banderaCrea=false;

var proyectos__Funcos=function(parametro1){

	indicador=47;

	let valoresAplicados=$("#parametrosTomarCuenta").val();

	$.ajax({

	  data: {indicador:indicador,valoresAplicados:valoresAplicados},
      dataType: 'html',
      type:'POST',
	  url:'modelosBd/validaciones/selector.modelo.php'

	}).done(function(modificas){

	  $(parametro1).html(modificas);

	}).fail(function(){});

}

proyectos__Funcos($("#proyectos__creados"));

var arrayGlobal = new Array(); 

var asignacion__valores=function(parametro1){

	$(parametro1).change(function(){

		arrayGlobal.push($(this).val());

		$("#parametrosTomarCuenta").val(arrayGlobal);

	});

}

asignacion__valores($("#proyectos__creados"));

/*=====  End of Proyectos paid  ======*/

/*============================================
=            Selección organismos            =
============================================*/

var organismos=function(parametro1){

	indicador=48;

	$.ajax({

	  data: {indicador:indicador},
      dataType: 'html',
      type:'POST',
	  url:'modelosBd/validaciones/selector.modelo.php'

	}).done(function(listar__lugar){

	  $(parametro1).html(listar__lugar);

	}).fail(function(){

	  

	});


}

/*=====  End of Selección organismos  ======*/


/*==========================================
=            Agregar organismos            =
==========================================*/


var agregar__dinamicos2__organismos__traidos=function(parametro1,parametro2,parametro3){

	$(parametro1).click(function(){

		$(parametro3).after('<form class="row mt-4" id="federacionFomrulario'+parametro2+'"></div><div class="col col-4 negrilla__titulosEnlazados text-center">Organismo deportivo</div><div class="col col-4 negrilla__titulosEnlazados text-center">Monto</div><div class="col col-3 negrilla__titulosEnlazados text-center">Archivo</div><div class="col col-1 negrilla__titulosEnlazados text-center"></div><div class="row mt-4"><div class="col col-4"><select class="ancho__total__input" id="organismos__id'+parametro2+'" name="organismos__id'+parametro2+'"></select></div><div class="col col-4"><input type="text" class="ancho__total__input solo__numero__montos" id="montoOrganismo'+parametro2+'" name="montoOrganismo'+parametro2+'" placeholder="Ingrese el monto por favor"/></div><div class="col col-3"><input type="file" class="ancho__total__input" id="archivoOrganismo'+parametro2+'"/></div><div class="col col-1"><a id="guardarPaid'+parametro2+'" name="guardarPaid'+parametro2+'" class="btn btn-primary text-center"><i class="fas fa-save"></i></a></div></form>');

			organismos($("#organismos__id"+parametro2));

			inserta__proyecto__organismo($("#guardarPaid"+parametro2),$("#federacionFomrulario"+parametro2),$("#archivoOrganismo"+parametro2),parametro2);


	});

}


var agregar__dinamicos2__organismos=function(parametro1){

	$(parametro1).change(function(){

		let valor=$(this).val();

		$(parametro1).after('<div class="row mt-4" id="federacionFomrulario'+valor+'"><div class="col col-4 negrilla__titulosEnlazados">Agregar organismo deportivo</div><div class="col col-8 text-left"><a id="agregarOrga'+valor+'" name="agregarOrga'+valor+'" class="btn btn-info text-center"><i class="fas fa-plus-circle"></i></a></div></div>');

		$(parametro1).after('<form class="row mt-4" id="federacionFomrulario'+valor+'"></div><div class="col col-4 negrilla__titulosEnlazados text-center">Organismo deportivo</div><div class="col col-4 negrilla__titulosEnlazados text-center">Monto</div><div class="col col-3 negrilla__titulosEnlazados text-center">Archivo</div><div class="col col-1 negrilla__titulosEnlazados text-center"></div><div class="row mt-4"><div class="col col-4"><select class="ancho__total__input obligatorio" id="organismos__id'+valor+'" name="organismos__id'+valor+'"></select></div><div class="col col-4"><input type="text" class="ancho__total__input obligatorio solo__numero__montos" id="montoOrganismo'+valor+'" name="montoOrganismo'+valor+'" placeholder="Ingrese el monto por favor"/></div><div class="col col-3"><input type="file" class="ancho__total__input obligatorio" id="archivoOrganismo'+valor+'"/></div><div class="col col-1"><a id="guardarPaid'+valor+'" name="guardarPaid'+valor+'" class="btn btn-primary text-center"><i class="fas fa-save"></i></a></div></form>');

		agregar__dinamicos2__organismos__traidos($("#agregarOrga"+valor),valor,parametro1);

		organismos($("#organismos__id"+valor));

		inserta__proyecto__organismo($("#guardarPaid"+valor),$("#federacionFomrulario"+valor),$("#archivoOrganismo"+valor),valor);

		funcion__solo__numero__montos($(".solo__numero__montos"));

	});
	
}

agregar__dinamicos2__organismos($("#proyectos__creados"));


/*=====  End of Agregar organismos  ======*/


var agregar__dinamicos2=function(parametro1,parametro2){

	$(parametro1).click(function(){

		$.getScript("layout/scripts/js/validaGlobal.js",function(){

			$(".proyectos__creados").each(function(index) {
				if($(this).val()=="0"){
					banderaCrea=true;
				}else{
					banderaCrea=false;
				}
			});

			if (banderaCrea==false) {

				contadorCrea2++;
				
				$(parametro2).append('<div class="border__contenedor row mt-2 fila__paids'+contadorCrea2+'"><div class="col col-11 mt-2 fila__paids'+contadorCrea2+'"><select id="proyectos__creados'+contadorCrea2+'" name="proyectos__creados'+contadorCrea2+'" class="ancho__total__input proyectos__creados"></select></div><div class="col col-1 mt-2 fila__paids'+contadorCrea2+'"><a id="borrarPaids'+contadorCrea2+'" name="borrarPaids'+contadorCrea2+'" class="btn btn-danger text-center" idContador="'+contadorCrea2+'"><i class="fas fa-trash"></i></a></div></div>');

				proyectos__Funcos($("#proyectos__creados"+contadorCrea2));

				asignacion__valores($("#proyectos__creados"+contadorCrea2));

				agregar__dinamicos2__organismos($("#proyectos__creados"+contadorCrea2));

				$("#borrarPaids"+contadorCrea2).click(function(){

					let idContador=$(this).attr('idContador');

					$(".fila__paids"+idContador).remove();

				});

			}else{

				alertify.set("notifier","position", "top-center");
				alertify.notify("Es obligatorio seleccionar el proyecto antes de crear uno nuevo", "error", 5, function(){});

			}

		});

	});
	
}

agregar__dinamicos2($("#agregar__proyectos__paids"),$(".contenedor__paids"));

/*=====  End of Crear dinamicamente 2  ======*/



});