<?php
session_start();
include('../conexion_DB/conexion_DB.php');
if(!isset($_GET['user']) || $_GET['user'] != $_SESSION['login_id'] || !isset($_SESSION['login_id'])){
	header('location: ../NO_permiso.php');
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
	<head>
		<title>Mensajes - WebVideos</title>
		<meta name='keywords' content='videos,link,tutorial,youtube'/>
		<meta name='description' content='WebVideos, es un sitio web dedicado a compartir videos'/>
		<meta http-equiv='Content-Language' content='es'/>
		<meta name='distribution' content='global'/>
		<meta name='robots' content='all'/>
		
		<link rel='stylesheet' type='text/css' href='../css/reset.css'></link>
		<link rel='stylesheet' type='text/css' href='../css/layout.css'></link>
		<link rel='stylesheet' type='text/css' href='../css/cabecera.css'></link>
		<link rel='stylesheet' type='text/css' href='../css/mensajes_privados.css'></link>
		
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
				<div id='MP_fondo'>
					<div id='MP_bandejas'>
						<ul>
							<li id='nue'><span class='carpetas'>Carpetas</span></li>
							<li class='car'><a href='MP_crear.php?user=<?php echo $_SESSION['login_id']; ?>'><span class='carpetas'>Nuevo Mensaje</span></a></li>
							<li class='car'><a href='../MP_entrada.php?user=<?php echo $_SESSION['login_id']; ?>'><span class='carpetas'>Recibidos</span></a></li>
							<li class='car'><a href='MP_salida.php?user=<?php echo $_SESSION['login_id']; ?>'><span class='carpetas'>Enviados</span></a></li>
							<li class='car'><a href='MP_papelera.php?user=<?php echo $_SESSION['login_id']; ?>'><span class='carpetas'>Papelera</span></a></li>
						</ul>
					</div>
					<?php
						$sql="SELECT mensajes_privados.*, registro_usuarios.usuario FROM mensajes_privados INNER JOIN registro_usuarios
								ON mensajes_privados.id_remitente = registro_usuarios.id WHERE mensajes_privados.id = '$_GET[id_MP]'";
						$res= mysqli_query($conexion,$sql);
						$fila= mysqli_fetch_assoc($res);
					?>
					<div id='MP_listado'>
						<form method='post' action='MP_responder.php?user=<?php echo $_SESSION['login_id']; ?>'>
						<div id='ver_cab'>Mensaje</div>
						<div id='ver_tit'>
							<span class='cabeceras_titulo'>Asunto:</span>
							<span class='cabeceras_dato'><?php echo $fila['titulo']; ?></span>
							<input type='hidden' name='asunto' value="<?php echo $fila['titulo']; ?>">
						</div>
						<div id='ver_remit'>
							<span class='cabeceras_titulo'>De:</span>
							<span class='cabeceras_dato'><?php echo $fila['usuario']; ?></span>
							<input type='hidden' name='user_respuesta' value="<?php echo $fila['usuario']; ?>">
						</div>
						<div id='ver_fec'>
							<span class='cabeceras_titulo'>Enviado el:</span>
							<span class='cabeceras_dato'><?php echo $fila['fecha_envio']; ?></span>
						</div>
						<div id='ver_cont'>
							<span><?php echo $fila['contenido']; ?></span>
							<input type='hidden' name='contenido' value="<?php echo $fila['contenido']; ?>">
						</div>
						<div id='ver_opc'>
							<?php
								if($fila['usuario'] == $_SESSION['login_usuario']){
									$tipo= 'remitente';
								}else{
									$tipo= 'destinatario';
								}
							?>
							<a href="MP_borrar.php?user=<?php echo $_SESSION['login_id']; ?>&id_leer=<?php echo $_GET['id_MP']; ?>&tipo=<?php echo $tipo; ?>&accion=papelera">
								<input type='button' name='borrar' value='Papelera'>
							</a>
						</div>
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