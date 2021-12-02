<?php
    require_once "__RequireOncesComunes.php";

    salirSiSesionFalla();

    // Si NO viene id quieren CREAR una nueva entrada ($existe tomará false).
    // Sin embargo, si VIENE id quieren VER la ficha de una persona existente
    // (y $existe tomará true).
    $existe = isset($_REQUEST["id"]);

    if (!$existe) {
        $persona = DAO::personaCrear(
            $_REQUEST["nombre"],
            $_REQUEST["apellidos"],
            $_REQUEST["telefono"],
            (bool)$_REQUEST["estrella"],
            (int)$_REQUEST["categoriaId"]
        );
    } else { // Quieren actualizar, así que es un UPDATE.
        $persona = new Persona(
            (int)$_REQUEST["id"],
            $_REQUEST["nombre"],
            $_REQUEST["apellidos"],
            $_REQUEST["telefono"],
            (bool)$_REQUEST["estrella"],
            (int)$_REQUEST["categoriaId"]
        );

        $persona = DAO::personaActualizar($persona);
    }
?>



<html>

<head>
    <meta charset='UTF-8'>
</head>

<body>

<?= pintarCabecera() ?>


    <?php if (!$existe) { ?>
        <h1>Inserción completada</h1>
        <p>Se ha insertado correctamente la nueva entrada de <?=$persona->getNombre()?>.</p>
    <?php } else { ?>
        <h1>Actualización completada</h1>
        <p>Se han guardado correctamente los nuevos datos de <?=$persona->getNombre()?>.</p>
    <?php
}
?>

<a href='PersonaListado.php'>Volver al listado de personas.</a>

<?= pintarPie() ?>

</body>

</html>