<?php
include('../conexion_DB/conexion_DB.php');

$sql= "SELECT * FROM registro_usuarios WHERE id = '$_GET[id_user]'";
$res= mysqli_query($conexion,$sql);

$respuesta= '';

while($fila= mysqli_fetch_assoc($res)){
	if($fila['clave'] != $_GET['clave_actual']){
		$respuesta= 'incorrecto';
		}
}

echo $respuesta;
?>