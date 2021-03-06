<?php
session_start();
include('../conexion_DB/conexion_DB.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
	<head>
		<title>Recuperar Contrase&ntilde;a - WebVideos</title>
		<meta name='keywords' content='videos,link,tutorial,youtube'/>
		<meta name='description' content='WebVideos, es un sitio web dedicado a compartir videos'/>
		<meta http-equiv='Content-Language' content='es'/>
		<meta name='distribution' content='global'/>
		<meta name='robots' content='all'/>
		
		<link rel='stylesheet' type='text/css' href='../css/reset.css'></link>
		<link rel='stylesheet' type='text/css' href='../css/layout.css'></link>
		<link rel='stylesheet' type='text/css' href='../css/cabecera.css'></link>
		<link rel='stylesheet' type='text/css' href='../css/recuperar_pass.css'></link>
		
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
				<?php
					if(isset($_POST['dato'])){
						$sql="SELECT * FROM registro_usuarios WHERE usuario = '$_POST[dato]' or email = '$_POST[dato]'";
						$res= mysqli_query($conexion,$sql);
						if($fila= mysqli_fetch_assoc($res)){
							$para= $fila['email'];
							$asunto= "Recuperar datos de WebVideos";
							$mensaje= "Los datos de tu cuenta en WebVideos son los siguientes:
										Usuario: ".$fila['usuario']."
										Contraseņa: ".$fila['clave']."
										
										Por favor conserva este E-mail.";
							$cabecera= "From: WebVideos";
		
							mail($para, $asunto, $mensaje, $cabecera);
							header("location: pantalla_fin_recuperar_pass.php");
						}else{
							$respuesta= "No se encontro una cuenta asociada.";
						}
	
					}else{
						$respuesta= "Error al recuperar la cuenta.";
					}
				?>
				<div id='general'>
					<div id='marco_1'>
						<ul id='lista_respuesta'>
							<li class='campos' id='cam_a'>
								<span class='texto_2'>
									<?php echo $respuesta; ?>
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