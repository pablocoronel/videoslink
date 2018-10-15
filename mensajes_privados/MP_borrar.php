<?php
session_start();
include('../conexion_DB/conexion_DB.php');
if(!isset($_GET['user']) || $_GET['user'] != $_SESSION['login_id'] || !isset($_SESSION['login_id'])){
	header('location: ../NO_permiso.php');
}

if(isset($_GET['id_leer'])){
	if($_GET['tipo'] == 'destinatario' &&  $_GET['accion'] == 'papelera'){
		$sql="UPDATE mensajes_privados SET borrado_destinatario = 'si' WHERE id = '$_GET[id_leer]'";
		mysqli_query($conexion,$sql);
		header('location: ../MP_entrada.php?user='.$_SESSION['login_id']);
	}elseif($_GET['tipo'] == 'remitente' && $_GET['accion'] == 'papelera'){
		$sql="UPDATE mensajes_privados SET borrado_remitente = 'si' WHERE id = '$_GET[id_leer]'";
		mysqli_query($conexion,$sql);
		header('location: MP_salida.php?user='.$_SESSION['login_id']);
	}elseif($_GET['tipo'] == 'destinatario' && $_GET['accion'] == 'eliminar_def'){
		$sql="UPDATE mensajes_privados SET borrado_destinatario = 'si_def' WHERE id = '$_GET[id_leer]'";
		mysqli_query($conexion,$sql);
		$sql_2="SELECT id FROM mensajes_privados WHERE borrado_destinatario = 'si_def' AND
				borrado_remitente = 'si_def'";
		$res_2= mysqli_query($conexion,$sql_2);
		while($fila_2= mysqli_fetch_assoc($res_2)){
			$sql_3="DELETE FROM mensajes_privados WHERE id = '$fila_2[id]'";
			mysqli_query($conexion,$sql_3);
		}
		header('location: MP_papelera.php?user='.$_SESSION['login_id']);
	}elseif($_GET['tipo'] == 'remitente' && $_GET['accion'] == 'eliminar_def'){
		$sql="UPDATE mensajes_privados SET borrado_remitente = 'si_def' WHERE id = '$_GET[id_leer]'";
		mysqli_query($conexion,$sql);
		$sql_2="SELECT id FROM mensajes_privados WHERE borrado_destinatario = 'si_def' AND
				borrado_remitente = 'si_def'";
		$res_2= mysqli_query($conexion,$sql_2);
		while($fila_2= mysqli_fetch_assoc($res_2)){
			$sql_3="DELETE FROM mensajes_privados WHERE id = '$fila_2[id]'";
			mysqli_query($conexion,$sql_3);
		}
		header('location: MP_papelera.php?user='.$_SESSION['login_id']);
	}elseif($_GET['tipo'] == 'destinatario' &&  $_GET['accion'] == 'restaurar'){
		$sql="UPDATE mensajes_privados SET borrado_destinatario = 'no' WHERE id = '$_GET[id_leer]'";
		mysqli_query($conexion,$sql);
		header('location: MP_papelera.php?user='.$_SESSION['login_id']);
	}elseif($_GET['tipo'] == 'remitente' && $_GET['accion'] == 'restaurar'){
		$sql="UPDATE mensajes_privados SET borrado_remitente = 'no' WHERE id = '$_GET[id_leer]'";
		mysqli_query($conexion,$sql);
		header('location: MP_papelera.php?user='.$_SESSION['login_id']);
	}
	else{
	header('location: ../MP_entrada.php?user='.$_SESSION['login_id']);
	}
}else{
	header('location: ../MP_entrada.php?user='.$_SESSION['login_id']);
}
?>