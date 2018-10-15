<?php
session_start();
include('conexion_DB/conexion_DB.php');

if(!isset($_SESSION['login_id'])){
	header('location: NO_permiso.php');
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
	<head>
		<title>Favoritos - WebVideos</title>
		<meta name='keywords' content='videos,link,tutorial,youtube'/>
		<meta name='description' content='WebVideos, es un sitio web dedicado a compartir videos'/>
		<meta http-equiv='Content-Language' content='es'/>
		<meta name='distribution' content='global'/>
		<meta name='robots' content='all'/>
		
		<link rel='stylesheet' type='text/css' href='css/reset.css'></link>
		<link rel='stylesheet' type='text/css' href='css/layout.css'></link>
		<link rel='stylesheet' type='text/css' href='css/cabecera.css'></link>
		<link rel='stylesheet' type='text/css' href='css/favoritos.css'></link>
		
		<script type='text/javascript' src='js/nuevo_mensaje_index.js'></script>
		<script language='javascript'>
			function borrar_favorito(id){
				window.location='favoritos/favoritos_borrar.php?fav='+id;
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
				<?php
					$sql="SELECT favoritos.*, post_video.titulo, categoria, fecha_creacion FROM favoritos INNER JOIN post_video
						ON favoritos.id_post = post_video.id WHERE favoritos.id_usuario_guardar = '$_SESSION[login_id]' ORDER BY id DESC";
					$res= mysqli_query($conexion,$sql);
					
					$cant_fav= mysqli_num_rows($res);
					if($cant_fav > 0){
				?>
				<div id='cabecera_listado'>
					Mis Favoritos
				</div>
				<div id='titulo_listado'>
					<ul>
						<li id='cat'>
						<span class='fila_fav'>Categoria</span>
						</li>
						<li id='jue'>
						<span class='fila_fav'></span>
						</li>
						<li id='tit'>
						<span class='fila_fav'>T&iacute;tulo</span>
						</li>
						<li id='fcr'>
						<span class='fila_fav'>Creado</span>
						</li>
						<li id='fgr'>
						<span class='fila_fav'>Guardado</span>
						</li>
						<li id='bor'>
						<span class='fila_fav'>Borrar</span>
						</li>
					</ul>
				</div>
				<?php
						/* PAGINADO */

				//Conteo de post y paginas
				$cantidad_post_pagina= 10;
				$todos_post= mysqli_query($conexion,"SELECT favoritos.*, post_video.titulo, categoria, fecha_creacion FROM favoritos INNER JOIN post_video
						ON favoritos.id_post = post_video.id WHERE favoritos.id_usuario_guardar = '$_SESSION[login_id]'");
				$cantidad_total_post= mysqli_num_rows($todos_post);
				$cantidad_paginas= ceil($cantidad_total_post/$cantidad_post_pagina);

				//Pagina actual
				if(isset($_GET['pag']) && is_numeric($_GET['pag'])){
					$pagina_actual= $_GET['pag'];
				}else{
					$pagina_actual= 1;
				}

				//Botones de pagina
				$pagina_primera= 1;
				$pagina_anterior= ($pagina_actual - 1);
				$pagina_siguiente= ($pagina_actual + 1);
				$pagina_ultima= $cantidad_paginas;

				//Bloqueo de paginas inexistentes
				if($pagina_anterior < 1){
					$pagina_anterior= 1;
				}

				if($pagina_siguiente > $pagina_ultima){
					$pagina_siguiente= $pagina_ultima;
				}

				//Listado de paginas
				$sql="SELECT favoritos.*, post_video.titulo, categoria, fecha_creacion FROM favoritos INNER JOIN post_video
						ON favoritos.id_post = post_video.id WHERE favoritos.id_usuario_guardar = '$_SESSION[login_id]' ORDER BY id DESC LIMIT ".(($pagina_actual - 1) * $cantidad_post_pagina).",".$cantidad_post_pagina;
				$res= mysqli_query($conexion,$sql);
				
				while($fila= mysqli_fetch_assoc($res)){
				?>
						<div id='favoritos_listado'>
							<ul>
								<li id='F_cat'>
									<span class='fila_fav'><?php echo $fila['categoria']; ?></span>
								</li>
								<li id='F_jue'>
									<span class='fila_fav'><img src="imagenes/categoria/<?php echo $fila['categoria'].'.png'; ?>"></span>
								</li>
								<li id='F_tit'>
									<span class='fila_fav'><a href="ver_post.php?post_id=<?php echo $fila['id_post']; ?>"><?php echo $fila['titulo']; ?></a></span>
								</li>
								<li id='F_fcr'>
									<span class='fila_fav'><?php echo $fila['fecha_creacion']; ?></span>
								</li>
								<li id='F_fgr'>
									<span class='fila_fav'><?php echo $fila['fecha_guardar']; ?></span>
								</li>
								<li id='F_bor'>
									<span class='fila_fav'>
										<input type='button' name='borrar_fav' id='borrar_fav' value='Borrar' onClick='borrar_favorito(<?php echo $fila['id']; ?>)'>
									</span>
								</li>
							</ul>
						</div>
				<?php
						}
				?>
						<div id='favoritos_paginado'>
							<a href='favoritos.php?pag=<?php echo $pagina_anterior;?>'>Anterior</a>
							<a href='favoritos.php?pag=<?php echo $pagina_siguiente;?>'>Siguiente</a>
						</div>
				<?php
					}else{
				?>
						<div id='favoritos_listado'>
							No tienes post en favoritos.
						</div>
				<?php
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