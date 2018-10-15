<?php
session_start();
include('conexion_DB/conexion_DB.php');
/* PAGINADO */
				
				/* Categoria */
				if(isset($_GET['cat'])){
					$categoria= $_GET['cat'];
				}else{
					$categoria= 'Todos';
					}
				
				//Conteo de post y paginas
				$cantidad_post_pagina= 19;
				if($categoria == 'Todos'){
					$todos_post= mysqli_query($conexion,"SELECT * FROM post_video WHERE estado_post = 'visible' ");
					}else{
					$todos_post= mysqli_query($conexion,"SELECT * FROM post_video WHERE categoria = '".$categoria."' AND estado_post = 'visible' ");
					}
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
				
				if(isset($_GET['pag']) && $_GET['pag'] > $pagina_ultima){
					header('location: index.php');
				}

// BLOQUEO DE ERRORES:
if(isset($_GET['cat']) && ($_GET['cat'] != 'Todos' && $_GET['cat'] != 'Deportes' && $_GET['cat'] != 'Juegos'
	&& $_GET['cat'] != 'Musica' && $_GET['cat'] != 'Noticias' && $_GET['cat'] != 'Peliculas'
	&& $_GET['cat'] != 'Varios')){
	header('location: index.php');
}elseif(isset($_GET['pag']) && !is_numeric($_GET['pag'])){
	header('location: index.php');
}
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
		
		<link rel='stylesheet' type='text/css' href='css/reset.css'></link>
		<link rel='stylesheet' type='text/css' href='css/layout.css'></link>
		<link rel='stylesheet' type='text/css' href='css/cabecera.css'></link>
		<link rel='stylesheet' type='text/css' href='css/index.css'></link>
		
		<script type='text/javascript' src='js/nuevo_mensaje_index.js'></script>
		<script language='javascript'>
			function cambiar_categoria(cat_elegida){
				window.location='index.php?cat='+cat_elegida+'&pag=1';
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
		<div id='contenedor_general'>
			<div id='listado_temas'>
				<div class='tema'>
					<form method='get' id='select_categoria'>
					<?php
						//Mensaje del select:
						if(isset($_GET['cat']) && $_GET['cat'] != 'Todos'){
							$opcion_categoria= $_GET['cat'];
						}else{
							$opcion_categoria= "Seleccionar Categor&iacute;a";
						}
					?>
						<select id='cat' name='cat' onChange="cambiar_categoria(this.value);">
							<option value='Todos'>
								<?php echo $opcion_categoria; ?>
							</option>
							<option value='Todos'>Todos</option>
							<option value='Deportes'>Deportes</option>
							<option value='Juegos'>Juegos</option>
							<option value='Musica'>M&uacute;sica</option>
							<option value='Noticias'>Noticias</option>
							<option value='Peliculas'>Peliculas</option>
							<option value='Varios'>Varios</option>
						</select>
					</form>
				</div>
				<div class='tema'>
					<ul id='post'>
							<li id='categoria'><span class='fila_titulo'>Categoria</span></li>
							<li id='juego'><span class='fila_titulo'>&nbsp;</span></li>
							<li id='titulo'><span class='fila_titulo'>T&iacute;tulo</span></li>
							<li id='autor_post'><span class='fila_titulo'>Autor</span></li>
							<li id='fecha_creacion'><span class='fila_titulo'>Fecha</span></li>
					</ul>
				</div>
				<?php
				//Listado de paginas
				if($categoria == 'Todos'){
					$sql="SELECT * FROM post_video WHERE estado_post = 'visible' ORDER BY id DESC LIMIT ".(($pagina_actual - 1) * $cantidad_post_pagina).",".$cantidad_post_pagina;
					$res= mysqli_query($conexion,$sql);
					}else{
					$sql="SELECT * FROM post_video WHERE categoria = '".$categoria."' AND estado_post = 'visible' ORDER BY id DESC LIMIT ".(($pagina_actual - 1) * $cantidad_post_pagina).",".$cantidad_post_pagina;
					$res= mysqli_query($conexion,$sql);
					}

				while($fila= mysqli_fetch_assoc($res)){
				?>
					<div class='tema'>
						<ul id='post'>
							<li id='categoria'><span class='fila_tema'><p id='parr_cat'><?php echo $fila['categoria'];?></p></span></li>
							<li id='juego'><span class='fila_tema'><img name='logo_pes' src="imagenes/categoria/<?php echo $fila['categoria'].'.png';?>"></span></li>
							<li id='titulo'><span class='fila_tema'><a href="ver_post.php?post_id=<?php echo $fila['id']; ?>">
							<?php echo $fila['titulo'];?>
							</a></span></li>
							<li id='autor_post'><span class='fila_tema'><a href="perfil.php?id_user=<?php echo $fila['id_autor']; ?>"><?php echo $fila['autor_post'];?></a></span></li>
							<li id='fecha_creacion'><span class='fila_tema'><?php echo $fila['fecha_creacion'];?></span></li>
						</ul>
					</div>
				<?php
				}
				?>

				<div id='paginado'>
					<a href='index.php?cat=<?php echo $categoria;?>&pag=<?php echo $pagina_anterior;?>'>Anterior</a>
					<a href='index.php?cat=<?php echo $categoria;?>&pag=<?php echo $pagina_siguiente;?>'>Siguiente</a>
				</div>

				</div>
				<div id='rankings'>
					
				</div>
		</div>
	</div>
			<div id='footer'>
				<div id='creditos'></div>
			</div>
		</div>
	</body>
</html>