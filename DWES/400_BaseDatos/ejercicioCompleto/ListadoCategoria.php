<?php
	require_once "_Varios.php";

	$conexion = obtenerPdoConexionBD();

	// Los campos que incluyo en el SELECT son los que luego podré leer
    // con $fila["campo"].
	$sql = "SELECT * FROM Categoria ORDER BY nombre";

    $sentencia = $conexion->prepare($sql);
    $sentencia->execute(); // Array vacío porque la consulta preparada no requiere parámetros.
    $rs = $sentencia->fetchAll();

    // INTERFAZ:
    // $rs
?>



<html>

<head>
	<meta charset='UTF-8'>
    <link href="estilos.css" rel="stylesheet" type="text/css" media="screen" />
</head>



<body>

<h1>Listado de Categorías</h1>

<table border='1'>

	<tr>
        <th>Categorías</th>
        <th></th>
	</tr>

	<?php foreach ($rs as $fila) { ?>
        <tr>
            <td><a href=   'CategoriaFicha.phpFicha.php?id=<?=$fila["id"]?>'><?=$fila["nombre"]?></a></td>
            <td><a class='eliminar' href='CategoriaEliminar.php?id=<?=$fila["id"]?>'>(X)                 </a></td>
        </tr>
	<?php } ?>

</table>

<br>

<a href='CategoriaFicha.php'>Crear entrada Persona</a>

<br>
<br>

<a href='Listado.php'>Volver a listado</a>

</body>

</html>