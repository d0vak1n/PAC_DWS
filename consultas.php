<?php

include "conexion.php";

function tipoUsuario($nombre, $correo)
{
	$conexion = crearConexion();

	$query = "SELECT * FROM user WHERE FullName='$nombre' AND Email='$correo'";
	$result = $conexion->query($query);

	if ($result->num_rows > 0) {
		$row = $result->fetch_assoc();
		if ($row['Enabled'] == 1) {
			if ($row['UserID'] == getPermisos()) {
				cerrarConexion($conexion);
				return "superadmin";
			} else {
				cerrarConexion($conexion);
				return "autorizado";
			}
		} else {
			cerrarConexion($conexion);
			return "registrado";
		}
	} else {
		cerrarConexion($conexion);
		return "no registrado";
	}
}


function esSuperadmin($nombre, $correo)
{
	$conexion = crearConexion();

	$query = "SELECT * FROM user WHERE FullName='$nombre' AND Email='$correo'";
	$result = $conexion->query($query);

	if ($result->num_rows > 0) {
		$row = $result->fetch_assoc();
		if ($row['UserID'] == getPermisos()) {
			cerrarConexion($conexion);
			return true;
		}
	}

	cerrarConexion($conexion);
	return false;
}


function getPermisos()
{
	$conexion = crearConexion();

	$query = "SELECT Autenticacion FROM setup";
	$result = $conexion->query($query);
	$row = $result->fetch_assoc();

	cerrarConexion($conexion);
	return $row['Autenticacion'];
}


function cambiarPermisos()
{
	$conexion = crearConexion();

	$permisos = getPermisos();
	$nuevosPermisos = ($permisos == 0) ? 1 : 0;

	$query = "UPDATE setup SET Autenticacion=$nuevosPermisos";
	$conexion->query($query);

	cerrarConexion($conexion);
}


function getCategorias()
{
	$conexion = crearConexion();

	$query = "SELECT CategoryID, Name FROM category";
	$result = $conexion->query($query);
	$categorias = [];

	while ($row = $result->fetch_assoc()) {
		$categorias[] = $row;
	}

	cerrarConexion($conexion);
	return $categorias;
}


function getListaUsuarios()
{
	$conexion = crearConexion();

	$query = "SELECT FullName, Email, Enabled FROM user";
	$result = $conexion->query($query);
	$usuarios = [];

	while ($row = $result->fetch_assoc()) {
		$usuarios[] = $row;
	}

	cerrarConexion($conexion);
	return $usuarios;
}


function getProducto($ID)
{
	$conexion = crearConexion();

	$query = "SELECT * FROM product WHERE ProductID=$ID";
	$result = $conexion->query($query);
	$producto = $result->fetch_assoc();

	cerrarConexion($conexion);
	return $producto;
}


function getProductos($orden)
{
	$conexion = crearConexion();

	$query = "SELECT p.ProductID, p.Name, p.Cost, p.Price, c.Name as CategoryName
              FROM product p
              INNER JOIN category c ON p.CategoryID = c.CategoryID
              ORDER BY $orden";
	$result = $conexion->query($query);
	$productos = [];

	while ($row = $result->fetch_assoc()) {
		$productos[] = $row;
	}

	cerrarConexion($conexion);
	return $productos;
}


function anadirProducto($nombre, $coste, $precio, $categoria)
{
	$conexion = crearConexion();

	$query = "INSERT INTO product (Name, Cost, Price, CategoryID) VALUES ('$nombre', $coste, $precio, $categoria)";
	$conexion->query($query);

	cerrarConexion($conexion);
}


function borrarProducto($id)
{
	$conexion = crearConexion();

	$query = "DELETE FROM product WHERE ProductID=$id";
	$conexion->query($query);

	cerrarConexion($conexion);
}


function editarProducto($id, $nombre, $coste, $precio, $categoria)
{
	$conexion = crearConexion();

	$query = "UPDATE product SET Name='$nombre', Cost=$coste, Price=$precio, CategoryID=$categoria WHERE ProductID=$id";
	$conexion->query($query);

	cerrarConexion($conexion);
}
