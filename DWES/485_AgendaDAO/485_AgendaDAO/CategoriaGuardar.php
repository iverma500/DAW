<?php
    require_once "__RequireOncesComunes.php";

    salirSiSesionFalla();

    // Si NO viene id quieren CREAR una nueva entrada ($existe tomará false).
    // Sin embargo, si VIENE id quieren VER la ficha de una categoría existente
    // (y $existe tomará true).
    $existe = isset($_REQUEST["id"]);

    // Se recogen los datos del formulario de la request, excepto id.
    $nombre = $_REQUEST["nombre"];

    if (!$existe) {

        $categoria = DAO::categoriaCrear($nombre);

    } else { // Quieren actualizar, así que es un UPDATE.
        // Se recoge TAMBIÉN el id.
        $id = (int)$_REQUEST["id"];

        $categoria = new Categoria($id,$nombre);
        $actualizadoRealmente = DAO::categoriaActualizar($categoria);
    }
?>



<html>

<head>
    <meta charset='UTF-8'>
</head>

<body>

<?php pintarCabecera(); ?>

<?php if (!$existe) { ?>
    <h2>Inserción completada</h2>
    <p>Se ha insertado correctamente la nueva entrada de <?= $categoria->getNombre() ?>.</p>
<?php } else { ?>
    <h2>Actualización completada</h2>
    <p>Se han guardado correctamente los nuevos datos de <?= $categoria->getNombre() ?>.</p>
<?php } ?>

<a href='CategoriaListado.php'>Volver al listado de categorías.</a>

<?php pintarPie(); ?>

</body>

</html>