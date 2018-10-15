<?php
session_start();
include('../conexion_DB/conexion_DB.php');

$fecha_nacimiento= $_POST['anio'].'-'.$_POST['mes'].'-'.$_POST['dia'];

for($i=1; $i <=8; $i++){
	switch(rand(1,2)){
			case 1: $codigo_registro= $codigo_registro.chr(rand(97,122));
				break;
			case 2: $codigo_registro= $codigo_registro.(rand(0,9));
				break;
		}
	}

$sql_email="SELECT email FROM registro_usuarios WHERE id = '$_POST[id_usuario]'";
$res_email= mysqli_query($conexion,$sql_email);
while($fila= mysqli_fetch_assoc($res_email)){
	if($fila['email'] == $_POST['email']){
		$sql="UPDATE registro_usuarios SET nombre = '$_POST[nombre]', apellido = '$_POST[apellido]',
		fecha_nacimiento = '$fecha_nacimiento', sexo = '$_POST[sexo]', pais = '$_POST[pais]',
		email = '$_POST[email]' WHERE id = '$_POST[id_usuario]'";
		mysqli_query($conexion,$sql);
		
		header('location: pantalla_fin_editar_registro.php');
	}else{
		$sql="UPDATE registro_usuarios SET nombre = '$_POST[nombre]', apellido = '$_POST[apellido]',
		fecha_nacimiento = '$fecha_nacimiento', sexo = '$_POST[sexo]', pais = '$_POST[pais]',
		email = '$_POST[email]' WHERE id = '$_POST[id_usuario]'";
		mysqli_query($conexion,$sql);
		
		/* envio NUEVO EMAIL*/
		$para= $_POST['email'];
		$asunto= "Cambio de E-mail en WebVideos";
		$mensaje= "Para confirmar tu nuevo e-mail asociado a tu cuenta en WebVideos ingresa al siguiente link:
					http://webvideos.260mb.net/perfil/pantalla_fin_editar_registro_email.php?cod=$codigo_registro";
		$cabecera= "From: WebVideos";
		mail($para, $asunto, $mensaje, $cabecera);

		header('location: pantalla_fin_editar_registro_email.php');
	}
}
?>