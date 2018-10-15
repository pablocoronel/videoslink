<div id='fondo_panel'>
	<ul id='barra_titulo'>
		<li class='u_titulo' id='usr_tilde'>

		</li>
		<li class='u_titulo' id='usr_id'>
			ID
		</li>
		<li class='u_titulo' id='usr_avatar'>
			Avatar
		</li>
		<li class='u_titulo' id='usr_usuario'>
			Usuario
		</li>
		<li class='u_titulo' id='usr_rango'>
			Rango
		</li>
		<li class='u_titulo' id='usr_perfil'>
			Perfil
		</li>
		<li class='u_titulo' id='usr_mp'>
			MP
		</li>
		<li class='u_titulo' id='usr_est_registro'>
			Estado Registro
		</li>
		<li class='u_titulo' id='usr_est_cuenta'>
			Estado Cuenta
		</li>
		<li class='u_titulo' id='usr_seleccionar'>
			Borrar
		</li>
	</ul>
	<form method='post' onSubmit='return guardar_cambios()' action='panel_administracion/proceso_usuarios.php'>
						<?php
				/* PAGINADO */
				
				//Conteo de post y paginas
				$cantidad_post_pagina= 11;
				$todos_post= mysqli_query($conexion,"SELECT * FROM registro_usuarios");
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

				/* CATEGORIA */
				if(isset($_GET['categoria_post'])){
					$categoria= $_GET['categoria_post'];
				}else{
					$categoria= '';
					}

				//Listado de paginas
						$sql="SELECT * FROM registro_usuarios
							ORDER BY id ASC LIMIT ".(($pagina_actual - 1) * $cantidad_post_pagina).",".$cantidad_post_pagina;
						$res= mysqli_query($conexion,$sql);
						while($fila= mysqli_fetch_assoc($res)){
						?>
						<ul id='barra_usuario'>
							<li class='u_usuario' id='usr_tilde'>
								<input type='checkbox' name='tilde_user[<?php echo $fila['id']; ?>]'>
							</li>
							<li class='u_usuario' id='usr_id'>
								<?php echo $fila['id']; ?>
								<input type='hidden' name='id_usuario[<?php echo $fila['id']; ?>]' value="<?php echo $fila['id']; ?>">
							</li>
							<li class='u_usuario' id='usr_avatar'>
								<img src="<?php echo $fila['avatar']; ?>" width='40' height='40'>
							</li>
							<li class='u_usuario' id='usr_usuario'>
								<?php echo $fila['usuario']; ?>
							</li>
							<li class='u_usuario' id='usr_rango'>
								<select name="rango[<?php echo $fila['id']; ?>]">
									<option value="<?php echo $fila['nivel_usuario']; ?>"><?php echo $fila['nivel_usuario']; ?></option>
									<option value='usuario'>usuario</option>
									<option value='administrador'>administrador</option>
								</select>
							</li>
							<li class='u_usuario' id='usr_perfil'>
								<a href="perfil.php?id_user=<?php echo $fila['id']; ?>">
									Perfil
								</a>
							</li>
							<li class='u_usuario' id='usr_mp'>
								<a href="mensajes_privados/MP_crear.php?user=<?php echo $_SESSION['login_id']; ?>&user_dest=<?php echo $fila['usuario']; ?>">
									MP
								</a>
							</li>
							<li class='u_usuario' id='usr_est_registro'>
								<?php echo $fila['estado_registro']; ?>
							</li>
							<li class='u_usuario' id='usr_est_cuenta'>
								<select name='estado_cuenta[<?php echo $fila['id']; ?>]'>
									<option value="<?php echo $fila['estado_cuenta']; ?>"><?php echo $fila['estado_cuenta']; ?></option>
									<option value='habilitado'>habilitado</option>
									<option value='deshabilitado'>deshabilitado</option>
									<option value='suspendido'>suspendido</option>
								</select>
							</li>
							<li class='u_usuario' id='usr_seleccionar'>
								<input type='submit' id='boton_borrar' name="borrar" value="<?php echo $fila['id']; ?>">
							</li>
						</ul>
						<?php
						}
						?>
	<div id='div_guardar'>
		<input type='submit' id='guardar_usuarios' name='guardar_usuarios' value='Guardar Cambios'>
	</div>
	</form>
	<div id='paginado'>
		<a href='panel_administracion.php?seccion=usuarios&pag=<?php echo $pagina_anterior;?>'>Anterior</a>
		<a href='panel_administracion.php?seccion=usuarios&pag=<?php echo $pagina_siguiente;?>'>Siguiente</a>
	</div>
		
						
	
</div>