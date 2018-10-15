<?php
session_start();
include('../conexion_DB/conexion_DB.php');

if(!isset($_SESSION['login_id']) || ($_GET['id_edit'] != $_SESSION['login_id'])){
	if($_SESSION['login_nivel_usuario'] != 'administrador'){
		header('location: ../NO_permiso.php');
	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
	<head>
		<title>Editar Perfil - WebVideos</title>
		<meta name='keywords' content='videos,link,tutorial,youtube'/>
		<meta name='description' content='WebVideos, es un sitio web dedicado a compartir videos'/>
		<meta http-equiv='Content-Language' content='es'/>
		<meta name='distribution' content='global'/>
		<meta name='robots' content='all'/>
		
		<link rel='stylesheet' type='text/css' href='../css/reset.css'></link>
		<link rel='stylesheet' type='text/css' href='../css/layout.css'></link>
		<link rel='stylesheet' type='text/css' href='../css/cabecera.css'></link>
		<link rel='stylesheet' type='text/css' href='../css/editar_perfil.css'></link>
		
		<script type='text/javascript' src='../js/nuevo_mensaje.js'></script>
		<script type='text/javascript' src='../js/controles_editar_perfil.js'></script>
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
		<div id='general_editar_perfil'>
			<div id='marco_1'>
			<?php
					$sql="SELECT * FROM registro_usuarios WHERE id ='$_GET[id_edit]'";
					$res= mysqli_query($conexion,$sql);
					while($tabla= mysqli_fetch_assoc($res)){
						$fila= $tabla;
					}
					
					$fecha= explode('-', $fila['fecha_nacimiento']);
			?>
			<form method='post' id='editar_perfil' onSubmit='return funcion_controles()' action='proceso.php'>
				<!-- campo ID USUARIO -->
				<input type='hidden' name='id_usuario' value="<?php echo $_GET['id_edit']; ?>">
				<!-- campos normales -->
			<ul>
				<li class='fila' id='cam_0'>
					<span class='items'></span>
					<span class='campos'>Editar Perfil</span>
					<span class='mensajes' id='span_nada'></span>
				</li>
				<li class='fila' id='cam_1'>
					<span class='items'>Nombre</span>
					<span class='campos'>
						<input type='text' name='nombre' id='nombre' value="<?php echo $fila['nombre']; ?>">
					</span>
					<span class='mensajes' id='span_nombre'></span>
				</li>
				<li class='fila' id='cam_2'>
					<span class='items'>Apellido</span>
					<span class='campos'>
						<input type='text' name='apellido' id='apellido' value="<?php echo $fila['apellido']; ?>">
					</span>
					<span class='mensajes' id='span_apellido'></span>
				</li>
				<li class='fila' id='cam_1'>
					<span class='items'>Fecha de Nacimiento</span>
					<span class='campos'>
						<?php include('fecha_nacimiento.php'); ?>
					</span>
					<span class='mensajes' id='span_fecha_nacimiento'></span>
				</li>
				<li class='fila' id='cam_2'>
					<span class='items'>Sexo</span>
					<span class='campos'>
						<?php
							if($fila['sexo'] == 'm'){
						?>
							M <input type='radio' name='sexo' id='sexo' value='m' checked='checked'>
							F <input type='radio' name='sexo' id='sexo' value='f'>
						<?php
							}else{
						?>
							M <input type='radio' name='sexo' id='sexo' value='m'>
							F <input type='radio' name='sexo' id='sexo' value='f' checked='checked'>
						<?php
							}
						?>
					</span>
					<span class='mensajes' id='span_sexo'></span>
				</li>
				<li class='fila' id='cam_1'>
					<span class='items'>Pa&iacute;s</span>
					<span class='campos'>
						<select name='pais' id='pais'>
							<option value="<?php echo $fila['pais']; ?>"><?php echo $fila['pais']; ?></option>
							<?php include('paises.php'); ?>
						</select>
					</span>
					<span class='mensajes' id='span_pais'></span>
				</li>
				<li class='fila' id='cam_2'>
					<span class='items'>E-mail</span>
					<span class='campos'>
						<input type='text' name='email' id='email' value="<?php echo $fila['email']; ?>">
					</span>
					<span class='mensajes' id='span_email'></span>
				</li>
				<li class='fila' id='cam_1'>
					<span class='items'></span>
					<span class='campos'>
						<input type='submit' name='guardar_cambios' value='Guardar cambios'>
					</span>
					<span class='mensajes' id='span_nada'></span>
				</li>
				<li class='fila' id='cam_2'>
					<span class='items'></span>
					<span class='campos'></span>
					<span class='mensajes' id='span_nada'></span>
				</li>
				<li class='fila' id='cam_1'>
					<span class='items'></span>
					<span class='campos'>
						<?php $id_user_pass= $_GET['id_edit']; ?>
						<button type='button' onClick="location.href='cambio_clave.php?id_user=<?php echo $id_user_pass; ?>'">
							CAMBIAR CONTRASE&Ntilde;A
						</button>
					</span>
					<span class='mensajes' id='span_nada'></span>
				</li>
			</ul>
			</form>
			</div>
		</div>
		
		<div id='avatar'>
			<div id='marco_2'>
				<!-- AVATAR -->
			<form method='post' enctype='multipart/form-data' action='cambio_avatar.php'>
				<div id='titulo_avatar'>
					<span id='span_avatar'>Mi Avatar</span>
				</div>
				<div id='cuerpo_avatar'>
					<img name='avatar_img' id='avatar_img' src="../<?php echo $fila['avatar']; ?>">
				
					<input type='file' name='seleccion_img' id='seleccion_img'>
					<input type='hidden' name='id_usuario_avatar' value="<?php echo $_GET['id_edit']; ?>">
					
					<input type='submit' name='seleccion_submit' id='seleccion_submit' value='Subir'>
				</div>
			</form>
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