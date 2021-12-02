<?php
    require_once "__RequireOncesComunes.php";

    salirSiSesionFalla();

    // Se recoge el parámetro "id" de la request.
    $id = (int)$_REQUEST["id"];

    $eliminadoRealmente = DAO::categoriaEliminarPorId($id);

?>



<html>

<head>
    <meta charset='UTF-8'>
</head>


<body>

<?php if ($eliminadoRealmente) { ?>

    <h2>Eliminación completada</h2>
    <p>Se ha eliminado correctamente la categoría.</p>

<?php } else { ?>

    <h2>Error en la eliminación</h2>
    <p>No se ha podido eliminar la categoría.</p>

<?php } ?>

<a href='CategoriaListado.php'>Volver al listado de categorías.</a>

</body>

</html>