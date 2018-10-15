<?php
session_start();
include('../conexion_DB/conexion_DB.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
	<head>
		<title>Registrarse - WebVideos</title>
		<meta name='keywords' content='videos,link,tutorial,youtube'/>
		<meta name='description' content='WebVideos, es un sitio web dedicado a compartir videos'/>
		<meta http-equiv='Content-Language' content='es'/>
		<meta name='distribution' content='global'/>
		<meta name='robots' content='all'/>
		
		<link rel='stylesheet' type='text/css' href='../css/reset.css'></link>
		<link rel='stylesheet' type='text/css' href='../css/layout.css'></link>
		<link rel='stylesheet' type='text/css' href='../css/cabecera.css'></link>
		<link rel='stylesheet' type='text/css' href='../css/registro.css'></link>
		
		<script type='text/javascript' src='../js/nuevo_mensaje.js'></script>
		<script type='text/javascript' src='../js/controles_registrarse.js'></script>
	</head>
	<body onLoad="setInterval('nuevo_mensaje(<?php echo $_SESSION["login_id"]; ?>)', 5000);">
		<div id='body'>
			<div id='header'>
				<?php
					include('../cabecera/cabecera.php');
				?>
			</div>

	<div id='content'>
		<div id='general'>
			<div id='marco_1'>
				<form method='post' id='registro' onSubmit='return funcion_controles()' action='proceso.php'>
				<!-- nivel_usuario -->
					<input type='hidden' name='nivel_usuario' value='usuario'>
			<ul>
				<li class='fila' id='cam_0'>
					<span class='items'></span>
					<span class='campos'>Registrarse</span>
					<span class='mensajes' id='span_nada'></span>
				</li>
				<li class='fila' id='cam_1'>
					<span class='items'>Nombre:</span>
					<span class='campos'><input type='text' name='nombre' id='nombre'></span>
					<span class='mensajes' id='span_nombre'></span>
				</li>
				<li class='fila' id='cam_2'>
					<span class='items'>Apellido:</span>
					<span class='campos'><input type='text' name='apellido' id='apellido'></span>
					<span class='mensajes' id='span_apellido'></span>
				</li>
				<li class='fila' id='cam_1'>
					<span class='items'>Usuario:</span>
					<span class='campos'><input type='text' name='usuario'  id='usuario'></span>
					<span class='mensajes' id='span_usuario'></span>
				</li>
				<li class='fila' id='cam_2'>
					<span class='items'>Contrase&ntilde;a:</span>
					<span class='campos'><input type='password' name='clave_1' id='clave_1'></span>
					<span class='mensajes' id='span_clave_1'></span>
				</li>
				<li class='fila' id='cam_1'>
					<span class='items'>Confirmar Contrase&ntilde;a:</span>
					<span class='campos'><input type='password' name='clave_2' id='clave_2'></span>
					<span class='mensajes' id='span_clave_2'></span>
				</li>
				<li class='fila' id='cam_2'>
					<span class='items'>E-mail:</span>
					<span class='campos'><input type='text' name='email' id='email'></span>
					<span class='mensajes' id='span_email'></span>
				</li>
				<li class='fila' id='cam_1'>
					<span class='items'>Fecha de Nacimiento:</span>
					<span class='campos'><?php include('fecha_nacimiento.php'); ?></span>
					<span class='mensajes' id='span_fecha_nacimiento'></span>
				</li>
				<li class='fila' id='cam_2'>
					<span class='items'>Sexo:</span>
					<span class='campos'>
							M <input type='radio' name='sexo' id='sexo' value='m' checked='checked'>
							F <input type='radio' name='sexo' id='sexo' value='f'>
					</span>
					<span class='mensajes' id='span_sexo'></span>
				</li>
				<li class='fila' id='cam_1'>
					<span class='items'>Pa&iacute;s:</span>
					<span class='campos'>
							<select name='pais' id='pais'>
								<option value=''>Pa&iacute;s</option>
								<?php include('paises.php'); ?>
							</select>
					</span>
					<span class='mensajes' id='span_pais'></span>
				</li>
				<li class='fila' id='cam_2'>
					<span class='items'>Captcha:</span>
					<span class='campos'>
							<input type='button' id='cambiar_codigo' name='cambiar_codigo' value='Cambiar' onClick="document.getElementById('img_captcha'). src='captcha.php?'+Math.random();">
							<img id='img_captcha' src="captcha.php">
					</span>
					<span class='mensajes' id='span_nada'></span>
				</li>
				<li class='fila' id='cam_1'>
					<span class='items'>Ingrese el codigo que vea arriba:</span>
					<span class='campos'>
							<input type='text' name='captcha' id='captcha'>
					</span>
					<span class='mensajes' id='span_captcha'></span>
				</li>
				<li class='fila' id='cam_2'>
					<span class='items'></span>
					<span class='campos'>
							<input type='submit' name='registrarse' value='Registrarme'>
					</span>
					<span class='mensajes' id='span_nada'></span>
				</li>
			</ul>
			</form>
			</div>
		</div>
	</div>
			<div id='footer'>
				<div id='creditos'></div>
			</div>
		</div>
	</body>
</html>