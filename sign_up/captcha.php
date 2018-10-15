<?php
session_start();
//Abrir fondo
$abrir= ('../imagenes/captcha/fondo.jpg');
//Crear imagen
$imagen= imagecreatefromjpeg($abrir);

//Codigo
$codigo= '';
for($i=1; $i <=rand(4,7); $i++){
	switch(rand (1,2)){
		case 1: $codigo= $codigo.chr(rand(65,90));
			break;
		case 2: $codigo= $codigo.rand(0,9);
			break;
	}
}
$_SESSION['captcha']= $codigo;

//Unir imagen + codigo
$color_codigo= imagecolorallocate($imagen,250,0,0);
imagestring($imagen, 25, 40, 7, $codigo, $color_codigo);

//Convertir PHP a imagen
header('content-type: image/jpeg');
imagejpeg($imagen);
?>