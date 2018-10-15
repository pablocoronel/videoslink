/* FUNCION NOMBRE Y APELLIDO */
function formato_nombre_apellido(campo,span){
	formato_aceptado= /^[a-zA-ZÒ—·ÈÌÛ˙\s]+$/;
	
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
/* FUNCION EMAIL */
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
			span.innerHTML = '';
			}
}
/*********************** FUNCION PRINCIPAL ***********************/
function funcion_controles(){
	val= true;
	
	formato_nombre_apellido(document.getElementById('nombre'),document.getElementById('span_nombre'))
	formato_nombre_apellido(document.getElementById('apellido'),document.getElementById('span_apellido'))
	formato_fecha_nacimiento(document.getElementById('dia'),document.getElementById('mes'),
		document.getElementById('anio'),document.getElementById('span_fecha_nacimiento'))
	formato_sexo(document.getElementById('sexo'),document.getElementById('span_sexo'))
	formato_pais(document.getElementById('pais'),document.getElementById('span_pais'))
	formato_email(document.getElementById('email'),document.getElementById('span_email'))
return val;
}