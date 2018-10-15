/* FUNCION CONTROL DE CAMPOS OBLIGATORIOS */
function completar(span,titulo,url,categoria,tags){
	formato_tags= /^([\w]+\,{1}){4}([\w]+)$/;
	if(titulo == '' || url == '' || categoria == '' || tags == ''){
		res= false;
		span.style.color= 'red';
		span.innerHTML= 'Completa todos los campos marcados con asterisco (*)';
	}else if(! tags.match(formato_tags)){
		res= false;
		span.style.color= 'red';
		span.innerHTML= 'Ingresa 5 palabras separadas por coma';
	}else{
		res= true;
		span.style.color= '';
		span.innerHTML= '';
	}
}

/* FUNCION PRINCIPAL */
function nuevo_post(){
	res= true;
	completar(document.getElementById('span_control'),document.getElementById('titulo_video').value,
				document.getElementById('url_video').value,document.getElementById('categoria_video').value,
				document.getElementById('tags_video').value)
	
	return res;
}