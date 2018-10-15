<div id='cabecera'>
	<div id='banner'>
		<div id='buscador_div'>
			<form method='post' action='buscador/resultados.php'>
				<input type='text' name='buscador'>
				<input type='submit' value='BUSCAR'>
			</form>
		</div>
	</div>
	<div id='menu_principal'>
	<?php
		if(!isset($_SESSION['login_nivel_usuario'])){
	?>
	<!-- sin loguearse -->
	<ul class='menu'>
		<li><a href="index.php">Inicio</a></li>
		<li><a href="sign_up/sign_up.php">Registrarse</a></li>
		<li><a href="login/login.php">Entrar</a></li>
		<li><a href="buscador.php">Buscador</a></li>
	</ul>
	<?php
	}elseif($_SESSION['login_nivel_usuario'] == 'usuario'){
	$sql_mp="SELECT * FROM mensajes_privados WHERE id_destinatario = '$_SESSION[login_id]' AND estado_leido = 'no'";
	$res_mp=mysqli_query($conexion,$sql_mp);
	$cant_MP=mysqli_num_rows($res_mp);
	?>
	<!-- logueado nivel usuario -->
	<ul class='menu'>
		<li><a href="index.php">Inicio</a></li>
		<li><a href="crear_post.php">Crear Post</a></li>
		<li><a href="perfil.php?id_user=<?php echo $_SESSION['login_id']; ?>"><?php echo $_SESSION['login_usuario']; ?></a></li>
		<li><a href="favoritos.php">Favoritos</a></li>
		<li>
			<a href="MP_entrada.php?user=<?php echo $_SESSION['login_id']; ?>">
				Mensajes
				<?php 
					if($cant_MP > 0){
				?>
				<div id='MPs'>
					<?php echo $cant_MP; ?>
				</div>
				<?php
					}
				?>
			</a>
		</li>
		<li><a href="buscador.php">Buscador</a></li>
		<li><a href="login/logout.php">Salir</a></li>
	</ul>
	<?php
	}elseif($_SESSION['login_nivel_usuario'] == 'administrador'){
	$sql_mp="SELECT * FROM mensajes_privados WHERE id_destinatario = '$_SESSION[login_id]' AND estado_leido = 'no'";
	$res_mp=mysqli_query($conexion,$sql_mp);
	$cant_MP=mysqli_num_rows($res_mp);
	?>
	<!-- logueado nivel administrador -->
	<ul class='menu'>
		<li><a href="index.php">Inicio</a></li>
		<li><a href="crear_post.php">Crear Post</a></li>
		<li><a href="perfil.php?id_user=<?php echo $_SESSION['login_id']; ?>"><?php echo $_SESSION['login_usuario']; ?></a></li>
		<li><a href="favoritos.php">Favoritos</a></li>
		<li>
			<a href="MP_entrada.php?user=<?php echo $_SESSION['login_id']; ?>">
				Mensajes
				<?php 
					if($cant_MP > 0){
				?>
				<div id='MPs'>
					<?php echo $cant_MP; ?>
				</div>
				<?php
					}
				?>
			</a>
		</li>
		<li><a href="buscador.php">Buscador</a></li>
		<li><a href="panel_administracion.php">Administracion</a></li>
		<li><a href="login/logout.php">Salir</a></li>
	</ul>
	<?php
	}
	?>
	</div>
</div>