<?php

function crearConexion()
{
	// Cambiar en el caso en que se monte la base de datos en otro lugar
	$host = "sql8.freemysqlhosting.net";
	$user = "sql8665610";
	$pass = "jNXB145Ayc";
	$baseDatos = "sql8665610";

	// Crear una conexión
	$conexion = new mysqli($host, $user, $pass, $baseDatos);

	// Verificar la conexión
	if ($conexion->connect_error) {
		die("Error de conexión: " . $conexion->connect_error);
	}

	// Establecer el juego de caracteres a utf8 (opcional)
	$conexion->set_charset("utf8");

	// Devolver la conexión
	return $conexion;
}


function cerrarConexion($conexion)
{
	$conexion->close();
}
