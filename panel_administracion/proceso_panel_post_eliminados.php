<?php
session_start();
include('../conexion_DB/conexion_DB.php');
if($_SESSION['login_nivel_usuario'] != 'administrador'){
	header('location: ../NO_permiso.php');
}

if(isset($_POST['borrar'])){
	$sql="DELETE FROM post_video WHERE id = '$_POST[borrar]'";
		mysqli_query($conexion,$sql);
	header('location: ../panel_administracion.php?seccion=post_elim');
}elseif(isset($_POST['restaurar'])){
	$sql="UPDATE post_video SET estado_post = 'visible' WHERE id = '$_POST[restaurar]'";
		mysqli_query($conexion,$sql);
	header('location: ../panel_administracion.php?seccion=post_elim');
}else{
		header('location: ../panel_administracion.php?seccion=post_elim');
}
?>