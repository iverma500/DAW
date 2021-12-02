<?php
	require_once "_Varios.php";

	$conexion = obtenerPdoConexionBD();

	// Los campos que incluyo en el SELECT son los que luego podré leer
    // con $fila["campo"].
	$sql = "SELECT 
	        p.id        AS p_id,
	        p.nombre    AS p_nombre,
	        p.estrella  AS p_estrella,
            c.id        AS c_id,
	        c.nombre    AS c_nombre
	        
	        FROM    
	             Persona AS p INNER JOIN Categoria as c
                 ON p.categoriaID = c.id
            ORDER BY p.nombre";

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
        <th>Personas</th>
        <th></th>
    </tr>

	<?php foreach ($rs as $fila) {?>
        <tr>
            <td><a href=   'CategoriaFicha.php?id=<?=$fila["c_id"]?>'><?=$fila["c_nombre"]?></a></td>
            <td>
                <a href="EstrellaPersona.php?id=<?=$fila["p_id"]?>">
                    <?php
                    if ($fila["p_estrella"] == 0){
                        echo "<img src='0.png' width='20' height='20'>";
                    } else {
                        echo "<img src='1.png' width='20' height='20'>";
                    }
                    ?>
                </a>
            </td>
            <td><a href="PersonaFicha.php?id=<?=$fila["p_id"]?>"><?=$fila["p_nombre"]?></a></td>
            <td><a class='eliminar' href='PersonaEliminar.php?id=<?=$fila["p_id"]?>'>(X)</a></td>
        </tr>
	<?php } ?>

</table>

<br>

<a href='CategoriaFicha.php'>Crear entrada Categoría</a>

<br>
<br>

<a href='PersonaFicha.php'>Crear entrada Persona</a>

<br>
<br>

<a href='ListadoPersonas.php'>Gestionar listado de Personas</a>

<br>
<br>

<a href='ListadoCategoria.php'>Gestionar listado de Categorías</a>

</body>

</html>