<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Articulos</title>
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

	// Obtener el orden de la tabla desde la URL (si está presente)
	$orden = isset($_GET['orden']) ? $_GET['orden'] : 'ProductID';

	// Obtener la lista de productos
	$productos = getProductos($orden);

	?>

	<h1>Lista de artículos</h1>

	<?php 
	pintaProductos($orden);
	// Mostrar enlaces adicionales si el usuario tiene los permisos de la aplicación activados
	if ($tipoUsuario == 'superadmin') {
		echo "<p><a href='formArticulo.php?action=anadir'>Añadir nuevo producto</a></p>";
	}

	// Enlace para volver a index.php
	echo "<p><a href='index.php'>Volver a Inicio</a></p>";
	?>

</body>

</html>