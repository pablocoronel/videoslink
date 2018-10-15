<?php
session_start();
include('../conexion_DB/conexion_DB.php');

if(!isset($_SESSION['login_id']) || ($_GET['id_user'] != $_SESSION['login_id'])){
	if($_SESSION['login_nivel_usuario'] != 'administrador'){
		header('location: ../NO_permiso.php');
	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
	<head>
		<title>Cambiar Contrase&ntilde;a - Videoslink</title>
		<meta name='keywords' content='videos,link,tutorial,youtube'/>
		<meta name='description' content='Videoslink, es un sitio web dedicado a compartir videos'/>
		<meta http-equiv='Content-Language' content='es'/>
		<meta name='distribution' content='global'/>
		<meta name='robots' content='all'/>
		
		<link rel='stylesheet' type='text/css' href='../css/reset.css'></link>
		<link rel='stylesheet' type='text/css' href='../css/layout.css'></link>
		<link rel='stylesheet' type='text/css' href='../css/cabecera.css'></link>
		<link rel='stylesheet' type='text/css' href='../css/cambio_clave.css'></link>
		
		<script type='text/javascript' src='../js/nuevo_mensaje.js'></script>
		<script type='text/javascript' src='../js/controles_cambio_clave.js'></script>
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
			<?php
					$sql="SELECT * FROM registro_usuarios WHERE id ='$_GET[id_user]'";
					$res= mysqli_query($conexion,$sql);
					while($tabla= mysqli_fetch_assoc($res)){
						$fila= $tabla;
					}
			?>
			<form method='post' id='cambio_clave' onSubmit='return funcion_controles()' action='proceso_cambio_clave.php'>
				<!-- campo ID USUARIO -->
						<input type='hidden' name='id_usuario' id='id_usuario' value="<?php echo $_GET['id_user']; ?>">
				<!-- campos normales -->
			<ul>
				<li class='fila' id='cam_0'>
					<span class='items'></span>
					<span class='campos'>Cambiar contrase&ntilde;a</span>
					<span class='mensajes' id='span_nada'></span>
				</li>
				<li class='fila' id='cam_1'>
					<span class='items'>Ingresar contrase&ntilde;a actual</span>
					<span class='campos'>
						<input type='password' name='pass_actual' id='clave_actual'>
					</span>
					<span class='mensajes' id='span_clave_actual'></span>
				</li>
				<li class='fila' id='cam_2'>
					<span class='items'>Ingresar contrase&ntilde;a nueva</span>
					<span class='campos'>
						<input type='password' name='pass_nueva' id='clave_1'>
					</span>
					<span class='mensajes' id='span_clave_1'></span>
				</li>
				<li class='fila' id='cam_1'>
					<span class='items'>Confirmar contrase&ntilde;a nueva</span>
					<span class='campos'>
						<input type='password' name='pass_nueva_2' id='clave_2'>
					</span>
					<span class='mensajes' id='span_clave_2'></span>
				</li>
				<li class='fila' id='cam_2'>
					<span class='items'></span>
					<span class='campos'>
						<input type='submit' name='enviar' value='Aceptar'>
					</span>
					<span class='mensajes' id='span_nada'></span>
				</li>
				<li class='fila' id='cam_1'>
					<span class='items'></span>
					<span class='campos'></span>
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