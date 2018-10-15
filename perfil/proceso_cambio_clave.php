<?php
session_start();
include('../conexion_DB/conexion_DB.php');

$sql="UPDATE registro_usuarios SET clave = '$_POST[pass_nueva]' WHERE id = '$_POST[id_usuario]'";
mysqli_query($conexion,$sql);

header('location: pantalla_fin_cambio_clave.php');
?>