<?php
    require_once "__RequireOncesComunes.php";

    salirSiSesionFalla();

    // Se recoge el parámetro "id" de la request.
    $id = (int)$_REQUEST["id"];

    $persona = DAO::personaObtenerPorId($id);
    $eliminadoRealmente = DAO::personaEliminarPorId($id);

?>



<html>

<head>
    <meta charset='UTF-8'>
</head>


<body>
<?php pintarCabecera(); ?>

<?php if ($eliminadoRealmente) { ?>

    <h2>Eliminación completada</h2>
    <p>Se ha eliminado correctamente la persona <?= $persona->getNombre() ?>.</p>

<?php } else { ?>

    <h2>Error en la eliminación</h2>
    <p>No se ha podido eliminar la persona.</p>

<?php } ?>

<a href='PersonaListado.php'>Volver al listado de personas.</a>

<?php pintarPie(); ?>
</body>

</html>