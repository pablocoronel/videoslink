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

function nuevo_mensaje (id) {
						ajax_MP=nuevoAjax();
						ajax_MP.open("GET", "cabecera/AJAX_nuevo_mensaje.php?ID_usuario="+id,true);
						ajax_MP.onreadystatechange=function() {
							if (ajax_MP.readyState==4) {
								if (ajax_MP.responseText > 0) {
									document.getElementById('MPs').style.backgroundColor = '#FF3300';
									document.getElementById('MPs').style.color = 'white';
									document.getElementById('MPs').innerHTML = ajax_MP.responseText;
								} else { 
								document.getElementById('MPs').style.backgroundColor = 'transparent';
								document.getElementById('MPs').style.color = 'transparent';
								document.getElementById('MPs').innerHTML = ajax_MP.responseText;
								}
							}
						}
						ajax_MP.send(null)
					}