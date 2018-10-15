<?php
session_start();
include('../conexion_DB/conexion_DB.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
	<head>
		<title>Buscador - WebVideos</title>
		<meta name='keywords' content='videos,link,tutorial,youtube'/>
		<meta name='description' content='WebVideos, es un sitio web dedicado a compartir videos'/>
		<meta http-equiv='Content-Language' content='es'/>
		<meta name='distribution' content='global'/>
		<meta name='robots' content='all'/>
		
		<link rel='stylesheet' type='text/css' href='../css/reset.css'></link>
		<link rel='stylesheet' type='text/css' href='../css/layout.css'></link>
		<link rel='stylesheet' type='text/css' href='../css/cabecera.css'></link>
		<link rel='stylesheet' type='text/css' href='../css/buscador.css'></link>
		
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
					<form id='buscar' method='post' action='resultados.php'>
							<span>Ingrese su busqueda:</span><br>
							<input type='text' name='buscador'>
							<input type='submit' value='BUSCAR'>
					</form>
				<?php
				if(isset($_GET['q']) && $_GET['q'] != ''){
					$busqueda= $_GET['q'];
					$_POST['buscador']= $busqueda;
				}
				if(isset($_POST['buscador']) && $_POST['buscador'] != ''){
					$busqueda= $_POST['buscador'];
					$_GET['q']= $busqueda;
					$sql="SELECT * FROM post_video WHERE titulo LIKE '%$busqueda%' OR tags LIKE '%$busqueda%' 
							OR descripcion LIKE '%$busqueda%' 
							OR categoria LIKE '%$busqueda%' OR autor_post = '$busqueda' 
							OR autor_original = '$busqueda'
							OR url_video LIKE '%$busqueda%' ORDER BY tags ASC";
					$res= mysqli_query($conexion,$sql);
					
					$cant_res= mysqli_num_rows($res);
					if($cant_res > 0){
				?>
				<div id='cabecera_listado'>
					Resultados<?php echo " (".$cant_res.")"; ?>
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
						<li id='aut'>
						<span class='fila_fav'>Autor</span>
						</li>
						<li id='fcr'>
						<span class='fila_fav'>Creado</span>
						</li>
					</ul>
				</div>
				<?php
						/* PAGINADO */

				//Conteo de post y paginas
				$cantidad_post_pagina= 10;
				$todos_post= mysqli_query($conexion,"SELECT * FROM post_video WHERE titulo LIKE '%$busqueda%' OR tags LIKE '%$busqueda%' 
							OR descripcion LIKE '%$busqueda%'
							OR categoria LIKE '%$busqueda%' OR autor_post = '$busqueda' 
							OR autor_original = '$busqueda'
							OR url_video LIKE '%$busqueda%'");
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
				$sql_pag="SELECT * FROM post_video WHERE titulo LIKE '%$busqueda%' OR tags LIKE '%$busqueda%' 
							OR descripcion LIKE '%$busqueda%' 
							OR categoria LIKE '%$busqueda%' OR autor_post = '$busqueda' 
							OR autor_original = '$busqueda'
							OR url_video LIKE '%$busqueda%' ORDER BY id DESC LIMIT ".(($pagina_actual - 1) * $cantidad_post_pagina).",".$cantidad_post_pagina;
				$res_pag= mysqli_query($conexion,$sql_pag);
					
				while($fila= mysqli_fetch_assoc($res_pag)){
				?>
						<div id='busqueda_listado'>
							<ul>
								<li id='B_cat'>
									<span class='fila_fav'><?php echo $fila['categoria']; ?></span>
								</li>
								<li id='B_jue'>
									<span class='fila_fav'><img src="../imagenes/categoria/<?php echo $fila['categoria'].'.png'; ?>"></span>
								</li>
								<li id='B_tit'>
									<span class='fila_fav'><a href="../ver_post.php?post_id=<?php echo $fila['id']; ?>"><?php echo $fila['titulo']; ?></a></span>
								</li>
								<li id='B_aut'>
									<span class='fila_fav'><?php echo $fila['autor_post']; ?></span>
								</li>
								<li id='B_fcr'>
									<span class='fila_fav'><?php echo $fila['fecha_creacion']; ?></span>
								</li>
							</ul>
						</div>
				<?php
						}
						if($cantidad_paginas > 1){
				?>
						<div id='busqueda_paginado'>
							<a href='resultados.php?q=<?php echo $busqueda; ?>&pag=<?php echo $pagina_anterior;?>'>Anterior</a>
							<a href='resultados.php?q=<?php echo $busqueda; ?>&pag=<?php echo $pagina_siguiente;?>'>Siguiente</a>
						</div>
				<?php
						}
					}else{
				?>
					<div id='busqueda_listado'>
						No se encontraron resultados para "<?php echo $busqueda; ?>"
					</div>
				<?php
					}
				}else{
				?>
					<div id='busqueda_listado'>
						Ingrese una palabra o frase.
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