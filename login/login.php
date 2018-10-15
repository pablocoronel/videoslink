<?php
session_start();
include('../conexion_DB/conexion_DB.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
	<head>
		<title>Ingresar - WebVideos</title>
		<meta name='keywords' content='videos,link,tutorial,youtube'/>
		<meta name='description' content='WebVideos, es un sitio web dedicado a compartir videos'/>
		<meta http-equiv='Content-Language' content='es'/>
		<meta name='distribution' content='global'/>
		<meta name='robots' content='all'/>
		
		<link rel='stylesheet' type='text/css' href='../css/reset.css'></link>
		<link rel='stylesheet' type='text/css' href='../css/layout.css'></link>
		<link rel='stylesheet' type='text/css' href='../css/cabecera.css'></link>
		<link rel='stylesheet' type='text/css' href='../css/login.css'></link>
		
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
					<form id='login' method='post' action='proceso.php'>
						<ul>
							<li class='campos' id='cam_0'>
								<span class='texto_1'>Ingresar</span>
							</li>
							<li class='campos' id='cam_1'>
								<span class='texto_2'>Usuario:</span>
							</li>
							<li class='campos' id='cam_2'>
								<input type='text' name='usuario'>
							</li>
							<li class='campos' id='cam_1'>
								<span class='texto_2'>Contrase&ntilde;a:</span>
							</li>
							<li class='campos' id='cam_2'>
								<input type='password' name='clave'>
							</li>
							<li class='campos' id='cam_1'>
								<input type='submit' name='login' value='Entrar'>
							</li>
							<li class='campos' id='cam_2'>
								<span class='texto_2'>
								<?php
									if(isset($_SESSION['login_error'])){
										echo $_SESSION['login_error'];
										$_SESSION['login_error']= '';
									}
								?>
								</span>
							</li>
							<li class='campos' id='cam_1'>
								<span class='texto_2'>
									<a href="recuperar_pass.php">¿Olvidaste tu contrase&ntilde;a?</a>
								</span>
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