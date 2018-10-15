<?php
session_start();
include('../conexion_DB/conexion_DB.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
	<head>
		<title>WebVideos</title>
		<meta name='keywords' content='videos,link,tutorial,youtube'/>
		<meta name='description' content='WebVideos, es un sitio web dedicado a compartir videos'/>
		<meta http-equiv='Content-Language' content='es'/>
		<meta name='distribution' content='global'/>
		<meta name='robots' content='all'/>
		
		<link rel='stylesheet' type='text/css' href='../css/reset.css'></link>
		<link rel='stylesheet' type='text/css' href='../css/layout.css'></link>
		<link rel='stylesheet' type='text/css' href='../css/cabecera.css'></link>
		<link rel='stylesheet' type='text/css' href='../css/NO_permiso.css'></link>
		
		<script type='text/javascript' src='../js/nuevo_mensaje.js'></script>
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
						<ul id='lista_respuesta'>
							<li class='campos' id='cam_a'>
								<span class='texto_2'>
									Se ha enviado a tu correo un mail para activar la cuenta
								</span>
							</li>
							<li class='campos' id='cam_b'>
								
							</li>
							<li class='campos' id='cam_a'>
								<span class='texto_2'>
									<button type='button' onClick="location.href='../index.php'">
										Ir a la p&aacute;gina principal
									</button>
								</span>
							</li>
						</ul>
					</div>
				</div>
			</div>
			<div id='footer'>
				<div id='creditos'></div>
			</div>
		</div>
	</body>
</html>