<?php
session_start();
include('../conexion_DB/conexion_DB.php');

$sql="UPDATE post_video SET estado_post = 'oculto' WHERE id = $_GET[id]";
mysqli_query($conexion,$sql);

header('location: ../index.php');
?>