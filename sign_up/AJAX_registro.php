<?php
session_start();
include('../conexion_DB/conexion_DB.php');
$respuesta= '';
//Consulta a la Base de Datos:
//Usuarios
if(isset($_GET['usuario_ingresado'])){
	$sql= "SELECT usuario FROM registro_usuarios";
	$res= mysqli_query($conexion,$sql);
	
	while($fila= mysqli_fetch_assoc($res)){
		if($_GET['usuario_ingresado'] == $fila['usuario']){
			$respuesta= 'ya existe';
		}
	}
//Email
}elseif(isset($_GET['email_ingresado'])){
	$sql= "SELECT email FROM registro_usuarios";
	$res= mysqli_query($conexion,$sql);
	
	while($fila= mysqli_fetch_assoc($res)){
		if($_GET['email_ingresado'] == $fila['email']){
			$respuesta= 'ya existe';
		}
	}
//Captcha
}elseif(isset($_GET['captcha_ingresado'])){
	if(strtoupper($_GET['captcha_ingresado']) != $_SESSION['captcha']){
		$respuesta= 'erroneo';
	}
}
//Respuesta:
echo $respuesta;
?>