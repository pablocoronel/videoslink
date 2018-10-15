<?php
session_start();
include('../conexion_DB/conexion_DB.php');

$recorte_url= explode('=',$_POST['url_video']);
$codigo_video= end($recorte_url);
$url_final="http://www.youtube.com/v/".$codigo_video;

$sql="UPDATE post_video SET titulo = '$_POST[titulo_video]', url_video = '$_POST[url_video]', descripcion = '$_POST[descripcion_video]',
		tags = '$_POST[tags_video]', autor_original = '$_POST[autor_original]', categoria = '$_POST[categoria]' WHERE id = '$_POST[id_post]'";
	
mysqli_query($conexion,$sql);

header('location: ../ver_post.php?post_id='.$_POST['id_post']);
?>