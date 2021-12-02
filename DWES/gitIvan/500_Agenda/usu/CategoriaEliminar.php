<?php
    require_once "__RequireOncesComunes.php";

    salirSiSesionFalla();

    $id = (int)$_REQUEST["id"];

    $categoria = DAO::categoriaObtenerPorId($id);

    $eliminadoRealmente = $categoria->eliminar();
?>



<html>

<head>
    <meta charset='UTF-8'>
</head>


<body>

<?php pintarCabecera(); ?>

<?php if ($eliminadoRealmente) { ?>

    <h2>Eliminación completada</h2>
    <p>Se ha eliminado correctamente la categoría <?=$categoria->getNombre() ?>.</p>

<?php } else { ?>

    <h2>Error en la eliminación</h2>
    <p>No se ha podido eliminar la categoría <?=$categoria->getNombre() ?>.</p>

<?php } ?>

<a href='CategoriaListado.php'>Volver al listado de categorías.</a>

<?php pintarPie(); ?>

</body>

</html>