<?php
session_start();
include('conexion_DB/conexion_DB.php');
if(!isset($_GET['id_user']) || $_GET['id_user'] == '' || !is_numeric($_GET['id_user'])){
	header('location: NO_error.php');
}else{
	$sql="SELECT * FROM registro_usuarios WHERE id= '$_GET[id_user]'";
	$res=mysqli_query($conexion,$sql);
	$fila=mysqli_fetch_assoc($res);
	
	if(empty($fila)){
		header('location: NO_error.php');
	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
	<head>
		<title><?php echo $fila['usuario']; ?> - WebVideos</title>
		<meta name='keywords' content='videos,link,tutorial,youtube'/>
		<meta name='description' content='WebVideos, es un sitio web dedicado a compartir videos'/>
		<meta http-equiv='Content-Language' content='es'/>
		<meta name='distribution' content='global'/>
		<meta name='robots' content='all'/>
		
		<link rel='stylesheet' type='text/css' href='css/reset.css'></link>
		<link rel='stylesheet' type='text/css' href='css/layout.css'></link>
		<link rel='stylesheet' type='text/css' href='css/cabecera.css'></link>
		<link rel='stylesheet' type='text/css' href='css/perfil.css'></link>
		
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
				<div id='general'>
				<div id='usuario'>
					<div id='avatar_marco'>
					<img id='avatar' src="<?php echo $fila['avatar']; ?>" alt='avatar'>
					</div>
					<?php
							if($fila['online'] == 'si'){
								$color_online='#2BCE35';
							}else{
								$color_online= '#ADB0AD';
							}
					?>
				<div id='datos_usuario'>
					<div id='online' style="background-color:<?php echo $color_online; ?>">
						
					</div>
					<div id='user'>@<?php echo $fila['usuario']; ?></div>
					<span id='sexo'>Es <?php if($fila['sexo']=='m'){echo "hombre";}else{echo "mujer";}?></span>
					<span id='edad'>Tiene <?php $fecha= explode('-', $fila['fecha_nacimiento']);
												
												$anio_dif= date('Y') - $fecha[0];
												$mes_dif= date('m') - $fecha[1];
												$dia_dif= date('d') - $fecha[2];
												
												if($mes_dif < 0){
													echo (date('Y') - $fecha[0]) - 1;
												}elseif($mes_dif == 0){
													if($dia_dif < 0){
														echo (date('Y') - $fecha[0]) - 1;
													}else{
														echo (date('Y') - $fecha[0]);
													}
												}else{
													echo (date('Y') - $fecha[0]);
												}
											?> A&ntilde;os</span>
					<span id='pais'>Es de <?php echo $fila['pais']; ?></span>
					<span id='fecha_registro'>Se registro el <?php echo $fila['fecha_registro']; ?></span>
				</div>
				</div>
				<?php
					$sql_2="SELECT * FROM post_video WHERE id_autor = '$_GET[id_user]' AND estado_post = 'visible' ORDER BY id DESC";
					$res_2= mysqli_query($conexion,$sql_2);
					$cant_post= mysqli_num_rows($res_2);
					
					$sql_3="SELECT * FROM comentarios_post WHERE id_autor = '$_GET[id_user]'";
					$res_3= mysqli_query($conexion,$sql_3);
					$cant_coment= mysqli_num_rows($res_3);
				?>
				<div id='actividad'>
					<div id='rango'>Rango<br>
						<span><?php echo $fila['nivel_usuario']; ?></span>
					</div>
					<div id='post'>Post<br>
						<span><?php echo $cant_post; ?></span>
					</div>
					<div id='comentarios'>Comentarios<br>
						<span><?php echo $cant_coment; ?></span>
					</div>
					<div id='pais'>Pais<br>
						<span><img src="imagenes/banderas_32/<?php echo $fila['pais'].'.png'; ?>"></span>
					</div>
						<?php
							if(isset($_SESSION['login_id'])){
						?>
							<div id='mensaje'>
							Mensaje privado<br>
							<span>
							<a href="mensajes_privados/MP_crear.php?user=<?php echo $_SESSION['login_id']; ?>&user_dest=<?php echo $fila['usuario']; ?>">
								<?php echo $fila['usuario']; ?>
							</a>
							</span>
							</div>
						<?php
							}
							if(((isset($_SESSION['login_id'])) && $_GET['id_user'] == $_SESSION['login_id'])
								|| (isset($_SESSION['login_id']) && $_SESSION['login_nivel_usuario'] == 'administrador')){
						?>
							<div id='perfil'>
							Editar Perfil<br>
							<span>
							<a href="perfil/editar_perfil.php?id_edit=<?php echo $_GET['id_user']; ?>">
								<?php echo $fila['usuario']; ?>
							</a>
							</span>
							</div>
						<?php
							}
						?>
				</div>
				<div id='listado_post'>
					<span id='titulo_post'>&Uacute;ltimos post creados</span>
					
					<?php
						if($cant_post > 0){
				/* PAGINADO */

				//Conteo de post y paginas
				$cantidad_post_pagina= 10;
				$todos_post= mysqli_query($conexion,"SELECT * FROM post_video WHERE id_autor = '$_GET[id_user]'
											AND estado_post = 'visible'");
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

				//Listado de paginas (post)
				$sql_pag="SELECT * FROM post_video WHERE id_autor = '$_GET[id_user]'
						AND estado_post = 'visible' ORDER BY id DESC LIMIT ".(($pagina_actual - 1) * $cantidad_post_pagina).",".$cantidad_post_pagina;
				$res_pag= mysqli_query($conexion,$sql_pag);

				while($fila_post= mysqli_fetch_assoc($res_pag)){
					?>
							<div class='post'>
								<div id='cat'>
									<span id='cat_text'><?php echo $fila_post['categoria']; ?></span>
								</div>
								<div id='jue'>
									<span id='jue_text'><img name='logo_pes' src="imagenes/categoria/<?php echo $fila_post['categoria'].'.png';?>"></span>
								</div>
								<div id='tit'>
									<span id='tit_text'><a href="ver_post.php?post_id=<?php echo $fila_post['id']; ?>"><?php echo $fila_post['titulo']; ?></a></span>
								</div>
							</div>
					<?php
							}
					?>
							<div class='post'>
								<a href='perfil.php?id_user=<?php echo $_GET['id_user']; ?>&pag=<?php echo $pagina_anterior;?>'>Anterior</a>
								<a href='perfil.php?id_user=<?php echo $_GET['id_user']; ?>&pag=<?php echo $pagina_siguiente;?>'>Siguiente</a>
							</div>
					<?php
						}else{
					?>
						<div class='post'>
							No tiene post creados.
						</div>
					<?php
						}
					?>
				</div>
			</div>
			</div>
			<div id='footer'>
				<div id='creditos'></div>
			</div>
		</div>
	</body>
</html>