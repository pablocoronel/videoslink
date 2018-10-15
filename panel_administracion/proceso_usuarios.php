<?php
session_start();
include('../conexion_DB/conexion_DB.php');
if($_SESSION['login_nivel_usuario'] != 'administrador'){
	header('location: NO_permiso.php');
}
//Actualizar datos:
if(isset($_POST['guardar_usuarios'])){
	foreach($_POST['id_usuario'] as $valor){
		$sql="UPDATE registro_usuarios SET nivel_usuario = '".$_POST['rango'][$valor]."', 
				estado_cuenta = '".$_POST['estado_cuenta'][$valor]."' WHERE id = ".$valor;
		mysqli_query($conexion,$sql);
	}
header('location: ../panel_administracion.php');
}elseif(isset($_POST['borrar'])){
	$sql="DELETE FROM registro_usuarios WHERE id = '$_POST[borrar]'";
	mysqli_query($conexion,$sql);
	header('location: ../panel_administracion.php');
}else{
	header('location: ../panel_administracion.php');
}
?>