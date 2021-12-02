<?php
	require_once "_Varios.php";

	// Si NO viene id quieren CREAR una nueva entrada ($existe tomará false).
	// Sin embargo, si VIENE id quieren VER la ficha de una categoría existente
	// (y $existe tomará true).
	$existe = isset($_REQUEST["id"]);

	if (!$existe) {// Quieren CREAR una nueva entrada, así que no se cargan datos.

        $conexion = obtenerPdoConexionBD();
		$personaNombre = "";
        $personaApellidos = "";
        $personaTelefono = "";
        $personaEstrella = 0;
        $categoriaId = "";
	} else { // Quieren VER la ficha de una entrada existente, cuyos datos se cargan.
        // Se recoge el parámetro "id" de la request.
        $personaId = (int)$_REQUEST["id"];

    	$conexion = obtenerPdoConexionBD();
		$sql = "SELECT nombre,apellidos,telefono,estrella,categoriaId FROM Persona WHERE id=?";
        $select = $conexion->prepare($sql);
        $select->execute([$personaId]); // Se añade el parámetro a la consulta preparada.
        $fila = $select->fetch();
		
		 // Con esto, accedemos a los datos de la primera (y esperemos que única) fila que haya venido.
		$personaNombre = $fila["nombre"];
        $personaApellidos = $fila["apellidos"];
        $personaTelefono = $fila["telefono"];
        $personaEstrella = $fila["estrella"];
        $categoriaId = $fila["categoriaId"];

    }



	// INTERFAZ:
    // $existe
    // $categoriaId
    // $personaNombre
?>



<html>

<head>
	<meta charset='UTF-8'>
</head>



<body>

<h1><?= (!$existe) ? "Nueva persona" : "Ficha de persona" ?></h1>

<form method='get' action='PersonaGuardar.php'>

    <?php if ($existe) { ?>
        <input type='hidden' name='id' value='<?=$personaId?>' />
    <?php } ?>

    <label for='nombre'>Nombre</label>
    <input type='text' id='nombre' name='nombre' value='<?=$personaNombre?>' />

    <br><br>

    <label for='apellidos'>Apellidos</label>
    <input type='text' id='apellidos' name='apellidos' value='<?=$personaApellidos?>' />

    <br><br>

    <label for='telefono'>Teléfono</label>
    <input type='text' maxlength='15' id='telefono' name='telefono' value='<?=$personaTelefono?>' />

    <br><br>

    <label for='estrella'>Estrella</label>
    <input type='number' maxlength='1' id='estrella' name='estrella' value='<?=$personaEstrella?>' />

    <br><br>

    <label for='categoriaId'>Categoría</label>
    <select name='categoriaId' id="categoriaId">

        <?php
            $query = $conexion->prepare("SELECT id,nombre FROM Categoria");
            $query->execute();
            $data = $query->fetchAll();

            foreach ($data as $valores):
                echo '<option value="' . $valores["id"] . '">' . $valores["nombre"] . '</option>';
            endforeach;
        ?>

    </select>

    <!--<input type='number' maxlength='11' id='categoriaId' name='categoriaId' value='$categoriaId' />-->

    <br><br>
    <?php if (!$existe) { ?>
        <input type='submit' name='crear' value='Crear persona' />
    <?php } else { ?>
        <input type='submit' name='actualizar' value='Actualizar cambios' />
    <?php } ?>

</form>

<?php if ($existe) { ?>
    <br />
    <a href='PersonaEliminar.php?id=<?=$personaId?>'>Eliminar persona</a>
<?php } ?>

<br/>

<a href='Listado.php'>Volver al listado.</a>

</body>

</html>