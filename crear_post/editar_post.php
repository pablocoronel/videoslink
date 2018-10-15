<?php
session_start();
include('../conexion_DB/conexion_DB.php');

$sql="SELECT * FROM post_video WHERE id = '$_GET[id_post]'";
$res= mysqli_query($conexion,$sql);
if($tabla= mysqli_fetch_assoc($res)){
	$fila=$tabla;
}

if(!isset($_SESSION['login_id']) || ($_SESSION['login_id'] != $_GET['id_usuario']) || $_GET['id_usuario'] != $fila['id_autor']){
	if($_SESSION['login_nivel_usuario'] != 'administrador'){
		header('location: ../NO_permiso.php');
	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
	<head>
		<title>Editar Post - WebVideos</title>
		<meta name='keywords' content='videos,link,tutorial,youtube'/>
		<meta name='description' content='WebVideos, es un sitio web dedicado a compartir videos'/>
		<meta http-equiv='Content-Language' content='es'/>
		<meta name='distribution' content='global'/>
		<meta name='robots' content='all'/>
		<link rel='stylesheet' type='text/css' href='../css/reset.css'></link>
		<link rel='stylesheet' type='text/css' href='../css/layout.css'></link>
		<link rel='stylesheet' type='text/css' href='../css/cabecera.css'></link>
		<link rel='stylesheet' type='text/css' href='../css/crear_post.css'></link>
		
		<script type='text/javascript' src='../js/nuevo_mensaje.js'></script>
		<script type="text/javascript" src="../js/controles_editar_post.js"></script>
		<script type="text/javascript" src="../editor_wysiwyg/tinymce/tinymce.min.js"></script>
		<script type="text/javascript">
			tinymce.init({
				selector: "textarea",language : 'es',
			});
		</script>
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
				<!--Seccion 1 Detalles del Post -->
				<form method='post' onSubmit='return editar_post()' action='editar_guardar_post.php'>
					<!-- ID AUTOR DEL POST -->
					<input type='hidden' name='id_post' value="<?php echo $_GET['id_post']; ?>">
					<div id='seccion_1'>
						<div class='encabezado' id='encabezado_1'>
							<span>Datos del Post</span>
						</div>
						<div class='linea_campos' id='titulo'>
							<span>(*) T&itilde;tulo:</span>
							<input type='text' name='titulo_video' id='titulo_video' value="<?php echo $fila['titulo']; ?>">
						</div>
						<div class='linea_campos' id='url'>
							<span>(*) URL de Video:</span>
							<input type='text' name='url_video' id='url_video' value="<?php echo $fila['url_video']; ?>">
						</div>
						<div class='linea_campos' id='autor_original'>
							<span>Autor Original:</span>
							<input type='text' name='autor_original' value="<?php echo $fila['autor_original']; ?>">
						</div>
						<div class='linea_campos' id='categoria'>
							<span>(*) Categoria:</span>
							<select name='categoria' id='categoria_video'>
								<option value="<?php echo $fila['categoria']; ?>"><?php echo $fila['categoria']; ?></option>
								<option value='Deportes'>Deportes</option>
								<option value='Juegos'>Juegos</option>
								<option value='Musica'>M&uacute;sica</option>
								<option value='Noticias'>Noticias</option>
								<option value='Peliculas'>Peliculas</option>
								<option value='Varios'>Varios</option>
							</select>
						</div>
						<div class='linea_campos' id='tags'>
							<span>(*) Tags (5 palabras distintas separadas por coma que describan el contenido del post):</span>
							<input type='text' id='tags_video' name='tags_video' value="<?php echo $fila['tags']; ?>">
						</div>
						<div class='linea_campos' id='descripcion'>
							<span><br><br><br>
								<div class='linea_campos' id='obligatorio'>
									<span>Son obligatorios los campos marcados con asterisco (*)</span>
								</div>
							</span>
						</div>
						
					</div>
				
					<!-- Seccion 2 Detalles Video -->
					<div id='seccion_2'>
						<div class='encabezado' id='encabezado_2'>
							<span>Descripci&oacute;n</span>
						</div>
						<div id='editor_texto'>
							<textarea id='input' name='descripcion_video' value="<?php echo $fila['descripcion']; ?>">
								<?php echo $fila['descripcion']; ?>
							</textarea>
						</div>
					</div>
					<!-- Seccion 3 Envio del Post -->
					<div id='seccion_3'>
						<div class='encabezado' id='encabezado_3'>
							<span>Guardar Post</span>
						</div>
						<div class='linea_campos' id='enviar_post'>
							<span>Guardar:</span>
							<input type='submit' name='agregar' name='agregar' value='Guardar'>
						</div>
						<!-- SPAN CONTROL DE CAMPOS OBLIGATORIOS -->
						<div id='control_formulario'>
							<span id='span_control'></span>
						</div>
					</div>
				</form>
				</div>
			</div>
			
			<div id='footer'>
				<div id='creditos'></div>
			</div>
		</div>
	</body>
</html>