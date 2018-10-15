<?php
session_start();
include('../conexion_DB/conexion_DB.php');

$respuesta='';

$sql_mp="SELECT * FROM mensajes_privados WHERE id_destinatario = '$_GET[ID_usuario]' 
			AND estado_leido = 'no'";
$res_mp=mysqli_query($conexion,$sql_mp);
$cant_MP=mysqli_num_rows($res_mp);

if($cant_MP > 0){
	$respuesta= $cant_MP;
}

echo $respuesta;
?>