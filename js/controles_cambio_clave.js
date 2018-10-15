/* AJAX: CONTRASEÑA */
//Objeto ajax:
function objeto_ajax(){
	var xmlhttp=false;
 	try {
 		xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
 	} catch (e) {
 		try {
 			xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
 		} catch (E) {
 			xmlhttp = false;
 		}
  	}

	if (!xmlhttp && typeof XMLHttpRequest!='undefined') {
 		xmlhttp = new XMLHttpRequest();
	}
	return xmlhttp;
}
// Funcion Contraseña ajax:
function ajax_clave(campo,span,id_usuario){
	ajax=objeto_ajax();
	ajax.open("GET", "ajax_cambio_clave.php?clave_actual="+campo.value+"&id_user="+id_usuario.value,true);
	ajax.onreadystatechange=function(){
		if(ajax.readyState==4){
			if(ajax.responseText == 'incorrecto'){
				val= false;
				span.style.color = 'blue';
				span.innerHTML = 'La contrase&ntilde;a no es correcta';
				}else{ 
				//val= true;
				span.innerHTML = '';
				}
		}
	}
	 ajax.send(null)


}

/* FUNCION CLAVES */
function formato_claves(campo_1,campo_2,span_1,span_2){
	formato_aceptado_claves = /^[\w-_]{5,20}$/;
	
	if(campo_1.value == ''){
		val = false;
		span_1.style.color = 'red';
		span_1.innerHTML = 'campo vacio';
		span_2.style.color = '';
		span_2.innerHTML = '';
		}else if(campo_1.value != '' && ! campo_1.value.match(formato_aceptado_claves)){
			val = false;
			span_1.style.color = 'blue';
			span_1.innerHTML = 'Debe tener entre 5 y 20 caracteres alfanuméricos';
			span_2.style.color = '';
			span_2.innerHTML = '';
			}else if(campo_1.value != '' && campo_1.value != campo_2.value){
				val = false;
				span_1.style.color = '';
				span_1.innerHTML = '';
				span_2.style.color = 'green';
				span_2.innerHTML = 'Deben ser iguales las contrase&ntilde;as';
				}else if (campo_1 != '' && 	campo_1.value == campo_2.value){
					span_1.style.color = '';
					span_1.innerHTML = '';
					span_2.style.color = '';
					span_2.innerHTML = '';
					}
}

/*********************** FUNCION PRINCIPAL ***********************/
function funcion_controles(){
	val= true;
	ajax_clave(document.getElementById('clave_actual'),document.getElementById('span_clave_actual'),
				document.getElementById('id_usuario'))
	formato_claves(document.getElementById('clave_1'),document.getElementById('clave_2'),
		document.getElementById('span_clave_1'),document.getElementById('span_clave_2'))
return val;
}