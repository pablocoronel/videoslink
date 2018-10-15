<?php
session_start();
include('../conexion_DB/conexion_DB.php');
if(!isset($_GET['user']) || $_GET['user'] != $_SESSION['login_id'] || !isset($_SESSION['login_id'])){
	header('location: ../NO_permiso.php');
}
$sql_dest="SELECT id FROM registro_usuarios WHERE usuario = '$_POST[destinatario]'";
$res_dest= mysqli_query($conexion,$sql_dest);
$fila_dest=mysqli_fetch_assoc($res_dest);
$destinatario=$fila_dest['id'];

$fecha=date('y-m-d h:i:s');
if(isset($_POST['enviar'])){
	$sql="INSERT INTO mensajes_privados (titulo, contenido, id_remitente, id_destinatario, fecha_envio,
			estado_leido, borrado_remitente, borrado_destinatario) VALUES ('$_POST[asunto]', '$_POST[contenido_MP]',
			'$_POST[remitente]', '$destinatario', '$fecha', 'no', 'no', 'no')";
	mysqli_query($conexion,$sql);
	header('location: ../MP_entrada.php?user='.$_POST['remitente']);
}else{
	header('location: ../MP_entrada.php?user='.$_POST['remitente']);
}
?>