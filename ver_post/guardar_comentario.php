<?php
session_start();
include('../conexion_DB/conexion_DB.php');

date_default_timezone_set('America/Argentina/Buenos_Aires');
$fecha_comentario= date('y-m-d H:i:s');

if(isset($_POST['text_comentario'])){
	$sql="INSERT INTO comentarios_post (id_post, id_autor, comentario, fecha_comentario) VALUES
		('$_POST[id_post]', '$_SESSION[login_id]', '$_POST[text_comentario]', '$fecha_comentario')";

	mysqli_query($conexion,$sql);
	
	header("location: aviso_comentario_guardado.php?ant_post=$_POST[id_post]");
}
?>