<?php
session_start();
include('conexion_DB/conexion_DB.php');
if(!isset($_GET['user']) || $_GET['user'] != $_SESSION['login_id'] || !isset($_SESSION['login_id'])){
	header('location: NO_permiso.php');
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
		
		<link rel='stylesheet' type='text/css' href='css/reset.css'></link>
		<link rel='stylesheet' type='text/css' href='css/layout.css'></link>
		<link rel='stylesheet' type='text/css' href='css/cabecera.css'></link>
		<link rel='stylesheet' type='text/css' href='css/mensajes_privados.css'></link>
		
		<script type='text/javascript' src='js/nuevo_mensaje_index.js'></script>
	</head>
	<body onLoad="setInterval('nuevo_mensaje(<?php echo $_SESSION["login_id"]; ?>)', 5000);">
		<div id='body'>
			<div id='header'>
				<?php
					include('cabecera/cabecera_index.php');
				?>
			</div>
		
			<div id='content'>
				<div id='MP_fondo'>
					<div id='MP_bandejas'>
						<ul>
							<li id='nue'><span class='carpetas'>Carpetas</span></li>
							<li class='car'><a href='mensajes_privados/MP_crear.php?user=<?php echo $_SESSION['login_id']; ?>'><span class='carpetas'>Nuevo Mensaje</span></a></li>
							<li class='car'><a href='MP_entrada.php?user=<?php echo $_SESSION['login_id']; ?>'><span class='carpetas'>Recibidos</span></a></li>
							<li class='car'><a href='mensajes_privados/MP_salida.php?user=<?php echo $_SESSION['login_id']; ?>'><span class='carpetas'>Enviados</span></a></li>
							<li class='car'><a href='mensajes_privados/MP_papelera.php?user=<?php echo $_SESSION['login_id']; ?>'><span class='carpetas'>Papelera</span></a></li>
						</ul>
					</div>
					<div id='MP_listado'>
						<ul id='barra_listado'>
							<li id='che_tit'><span class='listado_titulo'></span></li>
							<li id='tit_tit'><span class='listado_titulo'>T&iacute;tulo</span></li>
							<li id='env_tit'><span class='listado_titulo'>Enviado por</span></li>
							<li id='fec_tit'><span class='listado_titulo'>Fecha</span></li>
						</ul>
					<?php
					/* CUENTAS PARA PAGINADO */
					$sql_pag="SELECT mensajes_privados.*, registro_usuarios.usuario FROM mensajes_privados 
								INNER JOIN registro_usuarios ON mensajes_privados.id_remitente = registro_usuarios.id 
								WHERE id_destinatario = '$_GET[user]' AND borrado_destinatario = 'no'";
					$res_pag= mysqli_query($conexion,$sql_pag);
					$total_mp= mysqli_num_rows($res_pag);
					$ver_mp= 10;
					$cant_paginas= ceil($total_mp/$ver_mp);
					if(!isset($_GET['pag'])){
						$pag_actual=1;
					}elseif(!is_numeric($_GET['pag'])){
						$pag_actual=1;
					}elseif($_GET['pag'] > $cant_paginas){
						$pag_actual= $cant_paginas;
					}else{
						$pag_actual= $_GET['pag'];
					}
					/*Paginas anterior y siguiente */
					$pag_anterior= $pag_actual-1;
					if($pag_anterior < 1){
						$pag_anterior=1;
					}
					$pag_siguiente= $pag_actual+1;
					if($pag_siguiente > $cant_paginas){
						$pag_siguiente= $cant_paginas;
					}
					/* LISTADO DE MP */
					if($total_mp > 0){
						$sql="SELECT mensajes_privados.*, registro_usuarios.usuario FROM mensajes_privados INNER JOIN registro_usuarios
								ON mensajes_privados.id_remitente = registro_usuarios.id WHERE id_destinatario = '$_GET[user]' AND borrado_destinatario = 'no'
								ORDER BY id DESC LIMIT ".(($pag_actual-1)*$ver_mp).",".$ver_mp;
						$res= mysqli_query($conexion,$sql);
						while($fila= mysqli_fetch_assoc($res)){
							if($fila['estado_leido'] == 'no'){
								$color= '#EEFFAB';
							}else{
								$color= '#EFEFEF';
							}
					?>
						<ul id='barra_listado'>
							<li id='che' style="background-color:<?php echo $color; ?>"><span class='listado_titulo'><input type='checkbox' name='MP'></span></li>
							<li id='tit' style="background-color:<?php echo $color; ?>"><a href="mensajes_privados/MP_ver_entrada.php?user=<?php echo $_SESSION['login_id']; ?>&id_MP=<?php echo $fila['id']; ?>"><span class='listado_titulo'><?php echo $fila['titulo']; ?></span></a></li>
							<li id='env' style="background-color:<?php echo $color; ?>"><a href="perfil.php?id_user=<?php echo $fila['id_remitente']; ?>"><span class='listado_titulo'><?php echo $fila['usuario']; ?></span></a></li>
							<li id='fec' style="background-color:<?php echo $color; ?>"><span class='listado_titulo'><?php echo $fila['fecha_envio']; ?></span></li>
						</ul>
					<?php
						}
					}else{
					?>
						<ul id='barra_listado'>
							<li id='che'></li>
							<li id='tit'>No tienes mensajes privados</li>
							<li id='env'></li>
							<li id='fec'></li>
						</ul>
					<?php
					}
					?>
					<!-- PAGINADO -->
					<div id='paginado'>
						<a href="MP_entrada.php?user=<?php echo $_SESSION['login_id']; ?>&pag=<?php echo $pag_anterior; ?>">
							Pagina Anterior
						</a>
						<a href="MP_entrada.php?user=<?php echo $_SESSION['login_id']; ?>&pag=<?php echo $pag_siguiente; ?>">
							Pagina Siguiente
						</a>
					</div>
					</div>
					
				</div>
			</div>
			
			<div id='footer'>
				<div id='creditos'></div>
			</div>
		</div>
	</body>
</html>