<?php
    require_once "__RequireOncesComunes.php";

    salirSiSesionFalla();

    $id = (int)$_REQUEST["id"];

    $persona = DAO::personaObtenerPorId($id);

    $eliminadoRealmente = $persona->eliminar();
?>

<html>

<head>
    <meta charset='UTF-8'>
</head>


<body>

<?php pintarCabecera(); ?>

<?php if ($eliminadoRealmente) { ?>

    <h2>Eliminación completada</h2>
    <p>Se ha eliminado correctamente la persona <?=$persona->getId()?>.</p>

<?php } else { ?>

    <h2>Error en la eliminación</h2>
    <p>No se ha podido eliminar la persona <?=$persona->getId()?>.</p>

<?php } ?>

<a href='PersonaListado.php'>Volver al listado de personas.</a>

<?php pintarPie(); ?>

</body>

</html>