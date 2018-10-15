<script language='javascript'>
/* AJAX: BORRAR POST */
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
// Funcion Borrar post ajax:
function ajax_borrar(){
	ajax=objeto_ajax();
	ajax.open("GET", "borrar_post.php?id_post="+document.getElementById('id_post_editar').value,true);
	ajax.onreadystatechange=function(){
		if(ajax.readyState==4){
			if(ajax.responseText == 'borrado'){
				alert('El post fue eliminado satisfactoriamente');
				window.location='index.php';
				}
		}
	}
	 ajax.send(null)


}
</script>