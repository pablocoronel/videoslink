<?php
session_start();
include('../conexion_DB/conexion_DB.php');

if(isset($_GET['id_fav'])){
	$sql_dupli="SELECT * FROM favoritos WHERE id_post = '$_GET[id_fav]' AND id_usuario_guardar = '$_GET[id_user_gdr]'";
	$res_dupli= mysqli_query($conexion,$sql_dupli);
	$cant_dupli= mysqli_num_rows($res_dupli);
	if($cant_dupli == 0){
		$fecha_guardar= date('y-m-d');

		$sql="INSERT INTO favoritos (id_post, id_usuario_guardar, fecha_guardar) VALUES ('$_GET[id_fav]', '$_GET[id_user_gdr]', '$fecha_guardar')";
		mysqli_query($conexion,$sql);
		header('location: ../ver_post.php?post_id='.$_GET['id_fav']);
	}else{
	header('location: ../ver_post.php?post_id='.$_GET['id_fav']);
	}

}else{
header('location: ../ver_post.php?post_id='.$_GET['id_fav']);
}

?>