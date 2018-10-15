<?php
session_start();
include('../conexion_DB/conexion_DB.php');

if(!empty($_POST['usuario']) && !empty($_POST['clave'])){
	$sql= "SELECT * FROM registro_usuarios WHERE usuario = '$_POST[usuario]' AND clave = '$_POST[clave]'";
	
	$res= mysqli_query($conexion,$sql);
	$fila= mysqli_fetch_assoc($res);
	
		if($fila['estado_registro'] == 'finalizado'){
			if($fila['estado_cuenta'] == 'habilitado'){
				$_SESSION['login_id'] = $fila['id'];
				$_SESSION['login_usuario'] = $fila['usuario'];
				$_SESSION['login_nivel_usuario'] = $fila['nivel_usuario'];
				$sql_online="UPDATE registro_usuarios SET online = 'si' WHERE id = '".$fila['id']."'";
				mysqli_query($conexion,$sql_online);
				header('location: ../index.php');
			}elseif($fila['estado_cuenta'] == 'suspendido'){
				$_SESSION['login_error'] = 'La cuenta se encuentra suspendida';
				header('location: login.php');
			}elseif($fila['estado_cuenta'] == 'deshabilitado'){
				$_SESSION['login_error'] = 'La cuenta se encuentra deshabilitada';
				header('location: login.php');
			}else{
				$_SESSION['login_error'] = 'Error';
				header('location: login.php');
			}
		}elseif($fila['estado_registro'] == 'pendiente'){
			$_SESSION['login_error'] = 'La cuenta se encuentra pendiente de confirmaci&oacute;n';
			header('location: login.php');
		}else{
			$_SESSION['login_error'] = 'Los datos ingresados son incorrectos';
			header('location: login.php');
		}
}else{
	$_SESSION['login_error'] = 'Complete ambos campos';
	header('location: login.php');
}
?>