<div id='fondo_panel'>
	<ul id='barra_titulo'>
		<li class='u_titulo' id='post_tilde'>

		</li>
		<li class='u_titulo' id='post_id'>
			ID
		</li>
		<li class='u_titulo' id='post_titulo'>
			T&iacute;tulo
		</li>
		<li class='u_titulo' id='post_autor_post'>
			Autor
		</li>
		<li class='u_titulo' id='post_id_autor'>
			ID User
		</li>
		<li class='u_titulo' id='post_categoria'>
			Categor&iacute;a
		</li>
		<li class='u_titulo' id='post_juego'>
			&nbsp;
		</li>
		<li class='u_titulo' id='post_fecha_creacion'>
			Fecha de Creaci&oacute;n
		</li>
		<li class='u_titulo' id='post_restaurar'>
			Restaurar
		</li>
		<li class='u_titulo' id='post_seleccionar'>
			Borrar
		</li>
	</ul>
	
	<form method='post' onSubmit='return guardar_cambios()' action='panel_administracion/proceso_panel_post_eliminados.php'>
						<?php
				/* PAGINADO */
				
				//Conteo de post y paginas
				$cantidad_post_pagina= 11;
				$todos_post= mysqli_query($conexion,"SELECT * FROM post_video WHERE estado_post = 'oculto'");
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
						$sql="SELECT * FROM post_video WHERE estado_post = 'oculto'
							ORDER BY id ASC LIMIT ".(($pagina_actual - 1) * $cantidad_post_pagina).",".$cantidad_post_pagina;
						$res= mysqli_query($conexion,$sql);
						while($fila= mysqli_fetch_assoc($res)){
						?>
						<ul id='barra_usuario'>
							<li class='u_usuario' id='post_tilde'>
								<input type='checkbox' name='tilde_post[<?php echo $fila['id']; ?>]'>
							</li>
							<li class='u_usuario' id='post_id'>
								<?php echo $fila['id']; ?>
								<input type='hidden' name='id_post[<?php echo $fila['id']; ?>]' value="<?php echo $fila['id']; ?>">
							</li>
							<li class='u_usuario' id='post_titulo'>
								<a href="ver_post.php?post_id=<?php echo $fila['id']; ?>">
									<?php echo $fila['titulo']; ?>
								</a>
							</li>
							<li class='u_usuario' id='post_autor_post'>
								<?php echo $fila['autor_post']; ?>
							</li>
							<li class='u_usuario' id='post_id_autor'>
								<?php echo $fila['id_autor']; ?>
							</li>
							<li class='u_usuario' id='post_categoria'>
								<?php echo $fila['categoria']; ?>
							</li>
							<li class='u_usuario' id='post_juego'>
								<img src="imagenes/categoria/<?php echo $fila['categoria'].'.png'; ?>">
							</li>
							<li class='u_usuario' id='post_fecha_creacion'>
								<?php echo $fila['fecha_creacion']; ?>
							</li>
							<li class='u_usuario' id='post_restaurar'>
								<input type='submit' id='boton_restaurar' name="restaurar" value="<?php echo $fila['id']; ?>">
							</li>
							<li class='u_usuario' id='post_seleccionar'>
								<input type='submit' id='boton_borrar' name="borrar" value="<?php echo $fila['id']; ?>">
							</li>
						</ul>
						<?php
						}
						?>
	<div id='div_guardar'>
		
	</div>
	</form>
	<div id='paginado'>
		<a href='panel_administracion.php?seccion=post_elim&pag=<?php echo $pagina_anterior;?>'>Anterior</a>
		<a href='panel_administracion.php?seccion=post_elim&pag=<?php echo $pagina_siguiente;?>'>Siguiente</a>
	</div>
</div>