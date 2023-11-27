<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Formulario de artículos</title>
</head>

<body>

	<?php

	include "funciones.php";
	// Comprobar si el usuario tiene los permisos suficientes
	$tipoUsuario = isset($_COOKIE['tipo_usuario']) ? $_COOKIE['tipo_usuario'] : '';
	if ($tipoUsuario != 'autorizado' && $tipoUsuario != 'superadmin') {
		echo "No tienes permisos para acceder a esta página.";
		exit();
	}
	// Inicializar variables
	$action = isset($_GET['action']) ? $_GET['action'] : '';
	$id = isset($_GET['id']) ? $_GET['id'] : '';

	// Obtener datos del producto para editar o borrar
	$producto = null;
	if (($action === 'editar' || $action === 'borrar') && !empty($id)) {
		$producto = getProducto($id);
	}

	?>

<form action="procesarFormulario.php" method="post">
		<input type="hidden" name="action" value="<?php echo $action; ?>">
		<input type="hidden" name="id" value="<?php echo $id; ?>">

		<label for="nombre">Nombre:</label>
		<input type="text" name="nombre" value="<?php echo ($producto !== null) ? $producto['Name'] : ''; ?>"><br>

		<label for="coste">Coste:</label>
		<input type="text" name="coste" value="<?php echo ($producto !== null) ? $producto['Cost'] : ''; ?>"><br>

		<label for="precio">Precio:</label>
		<input type="text" name="precio" value="<?php echo ($producto !== null) ? $producto['Price'] : ''; ?>"><br>

		<!-- Agregar más campos según sea necesario -->

		<?php
			if ($action === 'añadir') {
				echo '<button type="submit">Añadir</button>';
			} elseif ($action === 'editar') {
				echo '<button type="submit">Editar</button>';
			} elseif ($action === 'borrar') {
				echo '<button type="submit">Borrar</button>';
			}
		?>

	</form>


</body>

</html>