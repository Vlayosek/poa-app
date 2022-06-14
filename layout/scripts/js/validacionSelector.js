$(document).ready(function () {

/*=========================================
=            Valida Selectores            =
=========================================*/


var provincias=function(parametro1){

	indicador=1;

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

provincias($("#provinciaOrganismo"));


var cantones=function(parametro1,parametro2){

	$(parametro2).change(function(){

		$(".ocultos__origenesD").hide();

		indicador=2;

		provincia=$(this).val();

		$.ajax({

		  data: {indicador:indicador,provincia:provincia},
	      dataType: 'html',
	      type:'POST',
		  url:'modelosBd/validaciones/selector.modelo.php'

		}).done(function(listar__lugar){

		  $(parametro1).html(listar__lugar);

		}).fail(function(){

		  

		});


	});

}

cantones($("#cantonOrganismo"),$("#provinciaOrganismo"));


var parroquias=function(parametro1,parametro2){

	$(parametro2).change(function(){

		indicador=3;

		canton=$(this).val();

		$.ajax({

		  data: {indicador:indicador,canton:canton},
	      dataType: 'html',
	      type:'POST',
		  url:'modelosBd/validaciones/selector.modelo.php'

		}).done(function(listar__lugar){

		  $(parametro1).html(listar__lugar);

		}).fail(function(){

		  

		});


	});

}

parroquias($("#parroquiaOrganismo"),$("#cantonOrganismo"));


var provinciasDefault=function(parametro1,parametro2){


	indicador=1;

	$.ajax({

	  data: {indicador:indicador},
      dataType: 'html',
      type:'POST',
	  url:'modelosBd/validaciones/selector.modelo.php'

	}).done(function(listar__lugar){

	  $(parametro1).html(listar__lugar);
	  $(parametro1).val(parametro2);

	}).fail(function(){

	  

	});

}

provinciasDefault($("#provinciaDatos"),$("#idPronvincia").val());


var cantonesDefault=function(parametro1,parametro2){

	indicador=5;

	$.ajax({

	  data: {indicador:indicador},
      dataType: 'html',
      type:'POST',
	  url:'modelosBd/validaciones/selector.modelo.php'

	}).done(function(listar__lugar){

	  $(parametro1).html(listar__lugar);
	  $(parametro1).val(parametro2);

	}).fail(function(){

	  

	});

}

cantonesDefault($("#cantonDatos"),$("#idCanton").val());

var parroquiasDefault=function(parametro1,parametro2){

	indicador=6;

	$.ajax({

	  data: {indicador:indicador},
      dataType: 'html',
      type:'POST',
	  url:'modelosBd/validaciones/selector.modelo.php'

	}).done(function(listar__lugar){

	  $(parametro1).html(listar__lugar);
	  $(parametro1).val(parametro2);

	}).fail(function(){

	  

	});

}

parroquiasDefault($("#parroquiaDatos"),$("#idParroquia").val());


var tipoOrganismos=function(parametro1){

	indicador=11;

	$.ajax({

	  data: {indicador:indicador},
      dataType: 'html',
      type:'POST',
	  url:'modelosBd/validaciones/selector.modelo.php'

	}).done(function(lista_tipo__organismos){

	  $(parametro1).html(lista_tipo__organismos);




	}).fail(function(){

	  

	});

}

tipoOrganismos($("#tiposOrganimosDeportivos"));



var tipoOrganismosDos=function(parametro1,parametro2){

	indicador=11;

	$.ajax({

	  data: {indicador:indicador},
      dataType: 'html',
      type:'POST',
	  url:'modelosBd/validaciones/selector.modelo.php'

	}).done(function(lista_tipo__organismos){

	  $(parametro1).html(lista_tipo__organismos);



	if ($(parametro2).val()!="") {

		$(parametro1).val(parametro2);

	}

	}).fail(function(){

	  

	});

}

tipoOrganismosDos($("#tiposOrganimosDeportivos__Group"),$("#tipoOrganismo").val());


var areaDeAccion=function(parametro1){

	indicador=8;

	$.ajax({

	  data: {indicador:indicador},
      dataType: 'html',
      type:'POST',
	  url:'modelosBd/validaciones/selector.modelo.php'

	}).done(function(lista_tipo__organismos){

	  $(parametro1).html(lista_tipo__organismos);


	}).fail(function(){

	  

	});

}

areaDeAccion($(".select__1"));



var objetivosSelects=function(parametro1){

	indicador=9;

	$.ajax({

	  data: {indicador:indicador},
      dataType: 'html',
      type:'POST',
	  url:'modelosBd/validaciones/selector.modelo.php'

	}).done(function(lista_tipo__organismos){

	  $(parametro1).html(lista_tipo__organismos);


	}).fail(function(){

	  

	});

}

objetivosSelects($(".select__2"));

var areaEncargadas=function(parametro1){

	indicador=10;

	$.ajax({

	  data: {indicador:indicador},
      dataType: 'html',
      type:'POST',
	  url:'modelosBd/validaciones/selector.modelo.php'

	}).done(function(lista_tipo__organismos){

	  $(parametro1).html(lista_tipo__organismos);


	}).fail(function(){

	  

	});

}

areaEncargadas($(".select__3"));


var numerosPeriodos=function(parametro1){

	indicador=12;

	$.ajax({

	  data: {indicador:indicador},
      dataType: 'html',
      type:'POST',
	  url:'modelosBd/validaciones/selector.modelo.php'

	}).done(function(lista_tipo__organismos){

	  $(parametro1).html(lista_tipo__organismos);


	}).fail(function(){

	  

	});

}

numerosPeriodos($(".periodoAsignacion"));

var gruposGastos=function(parametro1){

	indicador=13;

	$.ajax({

	  data: {indicador:indicador},
      dataType: 'html',
      type:'POST',
	  url:'modelosBd/validaciones/selector.modelo.php'

	}).done(function(lista_tipo__organismos){

	  $(parametro1).html(lista_tipo__organismos);


	}).fail(function(){

	  

	});

}

gruposGastos($(".select__grupoG"));

var indicadoresS=function(parametro1){

	indicador=20;

	$.ajax({

	  data: {indicador:indicador},
      dataType: 'html',
      type:'POST',
	  url:'modelosBd/validaciones/selector.modelo.php'

	}).done(function(lista_tipo__organismos){

	  $(parametro1).html(lista_tipo__organismos);


	}).fail(function(){

	  

	});

}

indicadoresS($(".select__indiCadores"));


var selectLineaPolitica=function(parametro1){

	indicador=15;

	$.ajax({

		data: {indicador:indicador},
		dataType: 'html',
		type:'POST',
		url:'modelosBd/validaciones/selector.modelo.php'

	}).done(function(listar__lugar){

		$(parametro1).html(listar__lugar);

	}).fail(function(){});

}

selectLineaPolitica($(".select__2Objetivos"));	

/*=====  End of Valida Selectores  ======*/



var tipoOrgaData=function(parametro1){

	indicador=11;

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

tipoOrgaData($(".select__tipoOrga"));

/*======================================
=            Modificaciones            =
======================================*/

var actividadesModificaciones=function(parametro1,parametro2){


	indicador=43;

	$.ajax({

	  data: {indicador:indicador,idOrganismo:parametro2},
      dataType: 'html',
      type:'POST',
	  url:'modelosBd/validaciones/selector.modelo.php'

	}).done(function(modificas){

	  $(parametro1).html(modificas);

	}).fail(function(){});

}

actividadesModificaciones($("#actividadesMo"),$("#organismoIdPrin").val());

/*=====  End of Modificaciones  ======*/


/*========================================
=            Modificaciones 2            =
========================================*/

var itemsModificaciones=function(parametro1,parametro2,parametro3){

	$(parametro1).change(function(){

		indicador=44;

		idActividades=$(this).val();

		$(parametro2).html("");

		$.ajax({

		  data: {indicador:indicador,idOrganismo:parametro3,idActividades:idActividades},
	      dataType: 'html',
	      type:'POST',
		  url:'modelosBd/validaciones/selector.modelo.php'

		}).done(function(modificas){

		  $(parametro2).html(modificas);

		}).fail(function(){});

	});

}

itemsModificaciones($("#actividadesMo"),$("#itemsMo"),$("#organismoIdPrin").val());

/*=====  End of Modificaciones 2  ======*/


/*==========================================
=            Areas responsables            =
==========================================*/

var areasresponsables__proyectos=function(parametro1,parametro2){


	indicador=45;

	$.ajax({

	  data: {indicador:indicador,idOrganismo:parametro2},
      dataType: 'html',
      type:'POST',
	  url:'modelosBd/validaciones/selector.modelo.php'

	}).done(function(modificas){

	  $(parametro1).html(modificas);

	}).fail(function(){});

}

areasresponsables__proyectos($("#area__responsable"),$("#organismoIdPrin").val());

/*=====  End of Areas responsables  ======*/

/*==================================================
=            Segun el estatus mencinado            =
==================================================*/

var proyectos__funcionarios=function(parametro1,parametro2){

	$(parametro1).change(function(){

		indicador=46;

		idFisicamente=$(this).val();

		$.ajax({

		  data: {indicador:indicador,idFisicamente:idFisicamente},
	      dataType: 'html',
	      type:'POST',
		  url:'modelosBd/validaciones/selector.modelo.php'

		}).done(function(modificas){

		  $(parametro2).html(modificas);

		}).fail(function(){});

	});

}

proyectos__funcionarios($("#area__responsable"),$("#lider__proyecto"));

/*=====  End of Segun el estatus mencinado  ======*/


});