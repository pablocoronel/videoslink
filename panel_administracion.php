<?php
session_start();
include('conexion_DB/conexion_DB.php');
if($_SESSION['login_nivel_usuario'] != 'administrador'){
	header('location: NO_permiso.php');
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
	<head>
		<title>Panel de Administraci&oacute;n - WebVideos</title>
		<meta name='keywords' content='videos,link,tutorial,youtube'/>
		<meta name='description' content='WebVideos, es un sitio web dedicado a compartir videos'/>
		<meta http-equiv='Content-Language' content='es'/>
		<meta name='distribution' content='global'/>
		<meta name='robots' content='all'/>
		
		<link rel='stylesheet' type='text/css' href='css/reset.css'></link>
		<link rel='stylesheet' type='text/css' href='css/layout.css'></link>
		<link rel='stylesheet' type='text/css' href='css/cabecera.css'></link>
		<link rel='stylesheet' type='text/css' href='css/panel_administracion.css'></link>
		
		<script type='text/javascript' src='js/nuevo_mensaje_index.js'></script>
		<script language='javascript'>
			function guardar_cambios(){
				accion= true;
				respuesta= confirm('¿Desea procesar los cambios realizados?');
				
				if(respuesta == true){
					accion= true;
				}else{
					accion= false;
				}
				return accion;
			}
		</script>
	</head>
	<body onLoad="setInterval('nuevo_mensaje(<?php echo $_SESSION["login_id"]; ?>)', 5000);">
		<div id='body'>
			<div id='header'>
				<?php
					include('cabecera/cabecera_index.php');
				?>
			</div>
		
			<div id='content'>
				<div id='general'>
					<div id='menu_admin'>
						<ul>
							<li class='menu_opciones' id='menu'>Men&uacute;</li>
							<li class='menu_opciones'>
								<a href='panel_administracion.php?seccion=usuarios'>Usuarios</a>
							</li>
							<li class='menu_opciones'>
								<a href='panel_administracion.php?seccion=post_elim'>Post Eliminados</a>
							</li>
						</ul>
					</div>
					<?php
						if(!isset($_GET['seccion']) || $_GET['seccion'] == 'usuarios'){
							include('panel_administracion/panel_usuarios.php');
						}elseif($_GET['seccion'] == 'post_elim'){
							include('panel_administracion/panel_post_eliminados.php');
						}
					?>
				</div>
			</div>
			
			<div id='footer'>
				<div id='creditos'></div>
			</div>
		</div>
	</body>
</html>