<?php
session_start();
include('conexion_DB/conexion_DB.php');

if(isset($_GET['post_id']) && $_GET['post_id'] != '' && is_numeric($_GET['post_id'])){
	$sql="SELECT * FROM post_video WHERE id = '$_GET[post_id]'";
	$res= mysqli_query($conexion,$sql);
	$fila= mysqli_fetch_assoc($res);
	
	if(empty($fila)){
		header('location: crear_post/pantalla_borrado_post.php');
	}
	
	if($fila['estado_post'] == 'oculto' && ($_SESSION['login_nivel_usuario'] != 'administrador')){
		header('location: crear_post/pantalla_borrado_post.php');
	}
}else{
	header('location: NO_error.php');
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
	<head>
		<title><?php echo $fila['titulo']; ?> - WebVideos</title>
		<meta name='keywords' content='videos,link,tutorial,youtube'/>
		<meta name='description' content='WebVideos, es un sitio web dedicado a compartir videos'/>
		<meta http-equiv='Content-Language' content='es'/>
		<meta name='distribution' content='global'/>
		<meta name='robots' content='all'/>
		
		<link rel='stylesheet' type='text/css' href='css/reset.css'></link>
		<link rel='stylesheet' type='text/css' href='css/layout.css'></link>
		<link rel='stylesheet' type='text/css' href='css/cabecera.css'></link>
		<link rel='stylesheet' type='text/css' href='css/ver_post.css'></link>
		
		<script type="text/javascript" src="editor_wysiwyg/tinymce/tinymce.min.js"></script>
		<script type='text/javascript' src='js/nuevo_mensaje_index.js'></script>
		<script type="text/javascript">
			tinymce.init({
				selector: "textarea",language : 'es',
			});
		
			function pregunta(id){
				respuesta_1= confirm('¿Seguro que desea borrar este post?');
				if(respuesta_1 == true){
					respuesta_final= confirm('Te pregunto de nuevo: ¿Seguro que desea borrar este post?');
					if(respuesta_final == true){
						window.location= 'crear_post/borrar_post.php?id='+id;
						alert('El post fue eliminado satisfactoriamente');
					}
				}
			}
			
			function agregar_favoritos(post,user){
			//	alert('El post fue agregado a favoritos');
				window.location= 'favoritos/favoritos_guardar.php?id_fav='+post+'&id_user_gdr='+user;
			}
		</script>
	<body onLoad="setInterval('nuevo_mensaje(<?php echo $_SESSION["login_id"]; ?>)', 5000);">
		<div id='body'>
			<div id='header'>
				<?php
					include('cabecera/cabecera_index.php');
				?>
			</div>
		
		<div id='content'>
			<div id='general'>
				<div id='titulo'>
					<span><?php echo $fila['titulo']; ?></span>					
				</div>
				<div id='post'>
					<div id='video'>
						<object>
							<param name="movie" value="<?php echo $fila['url_video']; ?>">
							</param>
							<embed id='url_video' src="<?php echo $fila['url_video']; ?>" type="application/x-shockwave-flash">
							</embed>
						</object>
					</div>
					
					<div id='datos_usuario'>
						<div class='info_usuario' id='nombre_usuario'>
							<a href="perfil.php?id_user=<?php echo $fila['id_autor']; ?>"><?php echo $fila['autor_post']; ?></a>
						</div>
						<?php
								/* DATOS USUARIO */
								$sql_usr="SELECT * FROM registro_usuarios WHERE id ='$fila[id_autor]'";
								$res_usr= mysqli_query($conexion,$sql_usr);
								$fila_usr= mysqli_fetch_assoc($res_usr);
								/* DATOS POST */
								$sql_post="SELECT * FROM post_video WHERE id = '$_GET[post_id]'";
								$res_post=(mysqli_query($conexion,$sql_post));
								$fila_post=(mysqli_fetch_assoc($res_post));
						?>
						<div id='avatar_usuario'>
							<a href="perfil.php?id_user=<?php echo $fila['id_autor']; ?>">
								<img src="<?php echo $fila_usr['avatar']; ?>" alt='avatar_usuario'>
							</a>
						</div>
						<?php
							if($fila_usr['online'] == 'si'){
								$color_online='#2BCE35';
							}else{
								$color_online= '#ADB0AD';
							}
						?>
						<div id='online' style="background-color:<?php echo $color_online; ?>"></div>
						<div class='info_usuario' id='MP_usuario'>
							<span class='usuario_titulos'>Mensaje Privado:</span>
							<a href="mensajes_privados/MP_crear.php?user=<?php echo $_SESSION['login_id']; ?>&user_dest=<?php echo $fila_usr['usuario']; ?>">
								<?php echo $fila_usr['usuario']; ?>
							</a>
						</div>
						<div class='info_usuario' id='rango_usuario'>
							<span class='usuario_titulos'>Rango:</span>
							<?php echo $fila_usr['nivel_usuario']; ?>
						</div>
						<div class='info_usuario' id='pais_usuario'>
							<img src="imagenes/banderas_32/<?php echo $fila_usr['pais'].'.png'; ?>">
						</div>
						<div class='info_usuario' id='post_usuario'>
							<span class='usuario_titulos'>Temas:</span>
							<?php
								$id_autor=($fila_post['id_autor']);
									
								$sql_id_2="SELECT * FROM post_video WHERE id_autor = '$id_autor'";
								$res_id_2=(mysqli_query($conexion,$sql_id_2));
								if($fila_id_2=(mysqli_num_rows($res_id_2))){
									echo $fila_id_2;
								}
							?>
						</div>
						<div class='info_usuario' id='comentario_usuario'>
							<span class='usuario_titulos'>Comentarios:</span>
							<?php
								$id_autor=($fila_post['id_autor']);
									
								$sql_num_coment="SELECT * FROM comentarios_post WHERE id_autor = '$id_autor'";
								$res_num_coment=(mysqli_query($conexion,$sql_num_coment));
								if($fila_num_coment=(mysqli_num_rows($res_num_coment))){
									echo $fila_num_coment;
								}
							?>
						</div>
						<div class='info_usuario' id='ingreso_usuario'>
							<span class='usuario_titulos'>Ingreso:</span>
							<?php echo $fila_usr['fecha_registro']; ?>
						</div>
					</div>
					
					<div id='descripcion'>
						<div id='descripcion_titulo'>
							Descripcion
						</div>
						<div id='descripcion_contenido'>
							<?php echo $fila['descripcion']; ?>
						</div>	
					</div>
				
					<div id='informacion_tecnica'>
						<div id='informacion_tecnica_titulo'>
							Caracter&iacute;sticas
						</div>
						<div id='informacion_tecnica_contenido'>
							<table>
								<tr>
									<td class='tabla_titulo'>Autor Original</td>
									<td class='tabla_titulo'>Categoria</td>
									<td class='tabla_titulo'>Tags</td>
								</tr>
								<tr>
									<td class='tabla_info'><?php echo $fila['autor_original']; ?></td>
									<td class='tabla_info'><img id='logo_descripcion' src="imagenes/categoria/<?php echo $fila['categoria'].'.png'; ?>"></td>
									<td class='tabla_info'><?php echo $fila['tags']; ?></td>
								</tr>
							</table>
						</div>
					</div>
			
					<div id='opciones'>
						<div id='opciones_titulo'>
							
						</div>
						<div id='opciones_contenido'>
							
							<?php
							if(isset($_SESSION['login_id'])){
								/* FAVORITOS */
								if($_SESSION['login_id'] != $fila['id_autor']){
								
									$sql_fav="SELECT * FROM favoritos WHERE id_post = '$_GET[post_id]'";
									$res_fav= mysqli_query($conexion,$sql_fav);
									$cant_fav= mysqli_num_rows($res_fav);
							?>
								
								<input type='button' name='favoritos' id='favoritos' value='Favoritos (<?php echo $cant_fav; ?>)' onClick='agregar_favoritos(<?php echo $_GET['post_id']; ?>, <?php echo $_SESSION['login_id'] ?>)'>
							
							<?php
							}
							/* EDITAR Y ELIMINAR POST */
							if($_SESSION['login_id'] == $fila['id_autor'] || $_SESSION['login_nivel_usuario'] == 'administrador'){
							?>
							<div id='editar_borrar'>
								<!-- Editar -->
								<a href="crear_post/editar_post.php?id_post=<?php echo $_GET['post_id']; ?>&id_usuario=<?php echo $fila['id_autor']; ?>">
									<input type='button' id='editar_post' name='editar_post' value='Editar'>
								</a>
								<input type='hidden' name='id_post_editar' id='id_post_editar' value="<?php echo $_GET['post_id']; ?>">
								<!-- Borrar -->
								<input type='button' name='borrar_post' id='borrar_post' value='Borrar' onClick='pregunta(<?php echo $_GET['post_id']; ?>)'>
							</div>
						<?php
							}
						}
						?>
						</div>	
					</div>
				</div>	
				<div id='contenedor_comentarios'>
					<div id='titulo_comentarios'>
						&Uacute;ltimos Comentarios
					</div>
						<?php
							$sql_coment="SELECT comentarios_post.*, registro_usuarios.usuario,avatar FROM comentarios_post LEFT JOIN registro_usuarios
								ON comentarios_post.id_autor = registro_usuarios.id WHERE comentarios_post.id_post = '$_GET[post_id]'";
							$res_coment=(mysqli_query($conexion,$sql_coment));
							
						$cant_de_coments= mysqli_num_rows($res_coment);
						if($cant_de_coments > 0){
								
							
							while($fila_coment=(mysqli_fetch_array($res_coment))){
						?>
						<div id='listado_comentarios'>
							<span id='span_avatar_comentario'>
								<a href="perfil.php?id_user=<?php echo $fila_coment['2']; ?>">
								<img id='avatar_comentario' src="<?php echo $fila_coment['6']; ?>">
								</a>
							</span>
							<span id='usuario_comentario'>
								<a href="perfil.php?id_user=<?php echo $fila_coment['2']; ?>"><?php echo $fila_coment['5']; ?></a>
							</span>
							<span id='fecha_comentario'>
								<?php
									echo $fila_coment['4'];
								?>
							</span>
							<span id='contenido_comentario'>
								<?php
									echo $fila_coment['3'];
								?>
							</span>					
						</div>
						<?php
							}
						}else{
						?>
							<div id='sin_comentarios'>
								A&uacute;n no hay comentarios.
							</div>
						<?php
						}
							if(isset($_SESSION['login_id'])){
						?>
						<div id='ventana_comentarios'>
							<form method='post' action='ver_post/guardar_comentario.php'>
								<input type='hidden' name='id_post' value='<?php echo $_GET['post_id']; ?>'>
								<textarea id='textarea' name='text_comentario' rows='7px;' cols='80px;'></textarea><br>
								<div id='agregar_comentario'>
									<input id='enviar_comentario' type='submit' name='enviar_comentario'>
								</div>
							</form>
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