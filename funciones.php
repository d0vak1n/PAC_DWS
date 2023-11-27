<?php

include "consultas.php";


function pintaCategorias($defecto)
{
	$categorias = getCategorias();

	echo '<select name="categoria">';
	foreach ($categorias as $categoria) {
		$selected = ($categoria['CategoryID'] == $defecto) ? 'selected' : '';
		echo "<option value='{$categoria['CategoryID']}' $selected>{$categoria['Name']}</option>";
	}
	echo '</select>';
}


function pintaTablaUsuarios()
{
	$usuarios = getListaUsuarios();

	echo '<table>';
	echo '<tr><th>Nombre</th><th>Email</th><th>Autorizado</th></tr>';

	foreach ($usuarios as $usuario) {
		$clase = ($usuario['Enabled'] == 1) ? 'rojo' : '';
		echo "<tr><td>{$usuario['FullName']}</td><td>{$usuario['Email']}</td><td class='$clase'>{$usuario['Enabled']}</td></tr>";
	}

	echo '</table>';
}


function pintaProductos($orden)
{
	$productos = getProductos($orden);

	echo '<table>';
	echo '<tr><th>ID</th><th>Nombre</th><th>Coste</th><th>Precio</th><th>Categoría</th><th>Acciones</th></tr>';

	foreach ($productos as $producto) {
		echo "<tr><td>{$producto['ProductID']}</td><td>{$producto['Name']}</td><td>{$producto['Cost']}</td><td>{$producto['Price']}</td><td>{$producto['CategoryName']}</td><td><a href='formArticulo.php?action=editar&id={$producto['ProductID']}'>Editar</a> | <a href='formArticulo.php?action=borrar&id={$producto['ProductID']}'>Borrar</a></td></tr>";
	}

	echo '</table>';
}
