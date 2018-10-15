<?php
session_start();
include('../conexion_DB/conexion_DB.php');

if(isset($_GET['fav'])){
	$sql="DELETE FROM favoritos WHERE id = '$_GET[fav]'";
	mysqli_query($conexion,$sql);
}

header('location: ../favoritos.php');
?>