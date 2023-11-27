<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="estilo.css">
	<title>Usuarios</title>
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

	// Botón para cambiar los permisos
	echo '<form action="cambiarPermisos.php" method="post">';
	echo '<input type="submit" value="Cambiar Permisos">';
	echo '</form>';

	// Mostrar la tabla de usuarios
	pintaTablaUsuarios();

	// Enlace para volver a index.php
	echo '<a href="index.php">Volver a Index</a>';

	?>

</body>

</html>