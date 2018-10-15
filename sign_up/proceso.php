<?php
session_start();
include('../conexion_DB/conexion_DB.php');

$fecha_nacimiento= $_POST['anio'].'-'.$_POST['mes'].'-'.$_POST['dia'];
$fecha_registro= date('Y-m-d');
$avatar= "imagenes/avatar/avatar_default.jpg";

for($i=1; $i <=8; $i++){
	switch(rand(1,2)){
		case 1: $codigo_registro= $codigo_registro.chr(rand(97,122));
			break;
		case 2: $codigo_registro= $codigo_registro.(rand(0,9));
			break;
	}
}
	
$sql="INSERT INTO registro_usuarios (nivel_usuario, usuario, clave, email, nombre, apellido,
		fecha_nacimiento, sexo, pais, fecha_registro, avatar, codigo_registro, estado_registro,
		estado_cuenta, online)
		VALUES ('$_POST[nivel_usuario]', '$_POST[usuario]', '$_POST[clave_1]', '$_POST[email]',
		'$_POST[nombre]', '$_POST[apellido]', '$fecha_nacimiento', '$_POST[sexo]', '$_POST[pais]',
		'$fecha_registro', '$avatar', '$codigo_registro', 'pendiente', 'habilitado', 'no')";

mysqli_query($conexion,$sql);

/* envio mail*/
$para= $_POST['email'];
$asunto= "Completar registro en WebVideos";
$mensaje= "Para completar su registro en WebVideos ingrese al siguiente link:
			http://webvideos.260mb.net/sign_up/pantalla_confir_registro.php?cod=$codigo_registro";
$cabecera= "From: WebVideos";

$seEnvioEmail= false;
$seEnvioEmail= mail($para, $asunto, $mensaje, $cabecera);
if($seEnvioEmail == true){
	header('location: pantalla_fin_registro.php');
}else{
	header('location: ../NO_error.php');
}

?>