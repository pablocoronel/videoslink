<?php
session_start();
include('../conexion_DB/conexion_DB.php');

date_default_timezone_set('America/Argentina/Buenos_Aires');
$fecha_creacion= date('y-m-d -- H:i:s');




$recorte_url= explode('=',$_POST['url_video']);
$codigo_video= end($recorte_url);
$url_final="http://www.youtube.com/v/".$codigo_video;
/*
$url_final="http://www.youtube.com/v/"."";
*/
$sql="INSERT INTO post_video (titulo, url_video, descripcion, tags, id_autor, autor_post, autor_original,
		categoria, fecha_creacion, estado_post) VALUES 
		('$_POST[titulo_video]', '$url_final', '$_POST[descripcion_video]', '$_POST[tags_video]', '$_SESSION[login_id]',
		'$_SESSION[login_usuario]', '$_POST[autor_original]', '$_POST[categoria]', '$fecha_creacion', 'visible')";
		
mysqli_query($conexion,$sql);

header('location: ../index.php');
?>