<?php
session_start();
include('../conexion_DB/conexion_DB.php');
$sql_online="UPDATE registro_usuarios SET online = 'no' WHERE id = '$_SESSION[login_id]'";

mysqli_query($conexion,$sql_online);

session_destroy();
header("location:".$_SERVER['HTTP_REFERER']);
?>