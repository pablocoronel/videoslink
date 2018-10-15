<?php
session_start();
include('../conexion_DB/conexion_DB.php');

if(file_exists($_FILES['seleccion_img']['tmp_name'])){
/*SUBIENDO IMAGEN*/
	$directorio= "../imagenes/avatar/";
	$nombre_img= $_POST['id_usuario_avatar'];
	$array_img=  explode('.',$_FILES['seleccion_img']['name']);
	$extension_img= end($array_img);
	
	move_uploaded_file($_FILES['seleccion_img']['tmp_name'], $directorio.$nombre_img.".".$extension_img);
/*GUARDANDO RUTA DE IMAGEN EN BD*/
	$sql="UPDATE registro_usuarios SET avatar = 'imagenes/avatar/".$nombre_img.".".$extension_img."'"." WHERE id = '$_POST[id_usuario_avatar]'";
	mysqli_query($conexion,$sql);
}

header('location: editar_perfil.php?id_edit='.$_POST['id_usuario_avatar']);
?>