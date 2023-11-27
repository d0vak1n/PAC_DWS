<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Index.php</title>
</head>

<body>

	<?php

	include "consultas.php";
	// Verificar si se ha enviado el formulario
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		// Obtener el nombre de usuario y correo electrónico del formulario
		$nombre = $_POST["nombre"];
		$correo = $_POST["correo"];

		// Realizar la consulta para determinar el tipo de usuario
		$tipoUsuario = tipoUsuario($nombre, $correo);

		// Almacenar el tipo de usuario en una cookie
		setcookie("tipo_usuario", $tipoUsuario, time() + 3600, "/"); // Cookie válida por 1 hora

		// Redirigir a la página correspondiente según el tipo de usuario
		if ($tipoUsuario == "superadmin") {
			header("Location: usuarios.php");
			exit();
		} elseif ($tipoUsuario == "autorizado") {
			header("Location: articulos.php");
			exit();
		} elseif ($tipoUsuario == "registrado") {
			echo "Hola $nombre, no tienes permisos para acceder.";
		} else {
			echo "El usuario no está registrado.";
		}
	}

	?>

	<form method="post" action="">
		<label for="nombre">Nombre de usuario:</label>
		<input type="text" id="nombre" name="nombre" required>
		<br>
		<label for="correo">Correo electrónico:</label>
		<input type="email" id="correo" name="correo" required>
		<br>
		<input type="submit" value="Acceder">
	</form>


</body>

</html>