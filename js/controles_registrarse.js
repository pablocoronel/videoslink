/* ----------- Objeto Ajax ------------*/
function nuevoAjax(){
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
/* -------------------------------------*/

/* FUNCION NOMBRE Y APELLIDO */
function formato_nombre_apellido(campo,span){
	formato_aceptado= /^[a-zA-ZñÑáéíóú\s]+$/;
	
	if(campo.value == ''){
		val = false;
		span.style.color = 'red';
		span.innerHTML = 'campo vacio';
		}else if(! campo.value.match(formato_aceptado) && campo.value != ''){
			val = false;
			span.style.color ='blue';
			span.innerHTML = 'Solo son validas letras';
			}else{
			span.innerHTML = '';
			}
}
/* FUNCION USUARIO */
function formato_usuario(campo,span){
	formato_caracteres_usuario = /^[\w-_]+$/;
	formato_largo_usuario = /^[\w-_]{5,20}$/;

	if(campo.value == ''){
		val = false;
		span.style.color = 'red';
		span.innerHTML = 'campo vacio';
		}else if(! campo.value.match(formato_caracteres_usuario) && campo.value != ''){
			val = false;
			span.style.color = 'blue';
			span.innerHTML = 'Debe tener letras, números o guiones';
			}else if(! campo.value.match(formato_largo_usuario) && campo.value != ''){
				val = false;
				span.style.color = 'green';
				span.innerHTML = 'Debe tener entre 5 y 20 caracteres';
				}else{
					usuarioDB(document.getElementById('usuario'),document.getElementById('span_usuario'))
					function usuarioDB (usr) {
						ajax_1=nuevoAjax();
						ajax_1.open("GET", "AJAX_registro.php?usuario_ingresado="+usr.value,true);
						ajax_1.onreadystatechange=function() {
							if (ajax_1.readyState==4) {
								if (ajax_1.responseText == 'ya existe') {
									document.getElementById('span_usuario').style.color = 'blue';
									document.getElementById('span_usuario').innerHTML = 'El nombre de usuario ya se encuentra registrado';
									val= false;
								} else { 
								document.getElementById('span_usuario').innerHTML = ajax_1.responseText;
								val= true;
								}
							}
						}
						ajax_1.send(null)
					}
				}
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
/* FUNCION E-MAIL */
function formato_email(campo,span){
	formato_aceptado_email = /^[\w-_\.]+@[\w]+[\.]{1}[\w]{1,5}([\.]{0,1}[\w]{1,5})$/;
	
	if(campo.value == ''){
		val = false;
		span.style.color = 'red';
		span.innerHTML = 'campo vacio';
		}else if(campo.value != '' && ! campo.value.match(formato_aceptado_email)){
			val = false;
			span.style.color = 'blue';
			span.innerHTML = 'Email incorrecto';
			}else{
				emailDB(document.getElementById('email'),document.getElementById('span_email'))
					function emailDB (email) {
						ajax_2=nuevoAjax();
						ajax_2.open("GET", "AJAX_registro.php?email_ingresado="+email.value,true);
						ajax_2.onreadystatechange=function() {
							if (ajax_2.readyState==4) {
								if (ajax_2.responseText == 'ya existe') {
									document.getElementById('span_email').style.color = 'blue';
									document.getElementById('span_email').innerHTML = 'Ya existe una cuenta asociada al e-mail ingresado';
									val= false;
								} else { 
								document.getElementById('span_email').innerHTML = ajax_2.responseText;
								val= true;
								}
							}
						}
						ajax_2.send(null)
					}
			}
}

/* FUNCION FECHA DE NACIMIENTO */
function formato_fecha_nacimiento(campo_dia,campo_mes,campo_anio,span){
	if(campo_dia.value == '' || campo_mes.value == '' || campo_anio.value == ''){
		val = false;
		span.style.color = 'red';
		span.innerHTML = 'campo vacio';
		}else{
		span.innerHTML = '';
		}
}
/* FUNCION SEXO */
function formato_sexo(campo,span){
	if(campo.value == ''){
		val = false;
		span.style.color = 'red';
		span.innerHTML = 'campo vacio';
		}else{
		span.innerHTML = '';
		}
}
/* FUNCION PAIS */
function formato_pais(campo,span){
	if(campo.value == ''){
		val = false;
		span.style.color = 'red';
		span.innerHTML = 'campo vacio';
		}else{
		span.innerHTML = '';
		}
}
/* FUNCION CAPTCHA */
function captcha(campo,span){
	if(campo.value == ''){
		val = false;
		span.style.color = 'red';
		span.innerHTML = 'campo vacio';
		}else{
		captchaDB(document.getElementById('captcha'),document.getElementById('span_captcha'))
		function captchaDB (codigo, span_captcha) {
			ajax_3=nuevoAjax();
			ajax_3.open("GET", "AJAX_registro.php?captcha_ingresado="+codigo.value,true);
			ajax_3.onreadystatechange=function() {
				if (ajax_3.readyState==4) {
					if (ajax_3.responseText == 'erroneo') {
						span_captcha.style.color = 'blue';
						span_captcha.innerHTML = 'El codigo ingresado es incorrecto';
						val= false
					} else { 
						span_captcha.innerHTML = ajax_3.responseText;
						val= true;
					}
				}
			}
			ajax_3.send(null)
		}
		}
}
/*********************** FUNCION PRINCIPAL ***********************/
function funcion_controles(){
	val= true;
	
	formato_nombre_apellido(document.getElementById('nombre'),document.getElementById('span_nombre'))
	formato_nombre_apellido(document.getElementById('apellido'),document.getElementById('span_apellido'))
	formato_usuario(document.getElementById('usuario'),document.getElementById('span_usuario'))
	formato_claves(document.getElementById('clave_1'),document.getElementById('clave_2'),
		document.getElementById('span_clave_1'),document.getElementById('span_clave_2'))
	formato_email(document.getElementById('email'),document.getElementById('span_email'))
	formato_fecha_nacimiento(document.getElementById('dia'),document.getElementById('mes'),
		document.getElementById('anio'),document.getElementById('span_fecha_nacimiento'))
	formato_sexo(document.getElementById('sexo'),document.getElementById('span_sexo'))
	formato_pais(document.getElementById('pais'),document.getElementById('span_pais'))
	captcha(document.getElementById('captcha'),document.getElementById('span_captcha'))
return val;
}