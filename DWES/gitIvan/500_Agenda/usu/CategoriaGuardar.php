<?php
    require_once "__RequireOncesComunes.php";

    salirSiSesionFalla();

    // Si NO viene id quieren CREAR una nueva entrada ($existe tomará false).
    // Sin embargo, si VIENE id quieren VER la ficha de una categoría existente
    // (y $existe tomará true).
    $existe = isset($_REQUEST["id"]);

    if (!$existe) {
        $categoria = DAO::categoriaCrear($_REQUEST["nombre"]);
    } else {
        $categoria = new Categoria((int)$_REQUEST["id"], $_REQUEST["nombre"]);

        $categoria = DAO::categoriaActualizar($categoria);
    }
?>



<html>

<head>
    <meta charset='UTF-8'>
</head>

<body>

<?php pintarCabecera(); ?>

<?php if (!$existe) { ?>
    <h1>Inserción completada</h1>
    <p>Se ha insertado correctamente la nueva entrada de <?=$categoria->getNombre()?>.</p>
<?php } else { ?>
    <h1>Actualización completada</h1>
    <p>Se han guardado correctamente los nuevos datos de <?=$categoria->getNombre()?>.</p>
<?php } ?>

<a href='CategoriaListado.php'>Volver al listado de categorías.</a>

<?= pintarPie() ?>

</body>

</html>