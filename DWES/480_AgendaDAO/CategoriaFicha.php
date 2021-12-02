<?php
    require_once "__RequireOncesComunes.php";

    salirSiSesionFalla();

    // Si NO viene id quieren CREAR una nueva entrada ($existe tomará false).
    // Sin embargo, si VIENE id quieren VER la ficha de una categoría existente
    // (y $existe tomará true).
    $existe = isset($_REQUEST["id"]);

    if (!$existe) { // Quieren CREAR una nueva entrada, así que no se cargan datos.
        $categoria = new Categoria(0,"");
    } else { // Quieren VER la ficha de una entrada existente, cuyos datos se cargan.
        // Se recoge el parámetro "id" de la request.
        $categoria = DAO::categoriaObtenerPorId((int)$_REQUEST["id"]);
    }

?>



<html>

<head>
    <meta charset='UTF-8'>
</head>


<body>

<?php pintarCabecera(); ?>

<h2><?= (!$existe) ? "Nueva categoría" : "Ficha de categoría" ?></h2>

<form method='get' action='CategoriaGuardar.php'>

    <?php if ($existe) { ?>
        <input type='hidden' name='id' value='<?=$categoria->getId() ?>' />
    <?php } ?>

    <label for='nombre'>Nombre</label>
    <input type='text' id='nombre' name='nombre' value='<?= $categoria->getNombre()?>'/>

    <br><br>

    <?php
    if (!$existe) echo "<input type='submit' name='crear'      value='Crear categoría'    />";
    else          echo "<input type='submit' name='actualizar' value='Actualizar cambios' />";
    ?>

</form>

<?php if ($existe) { ?>
    <br/>
    <a href='CategoriaEliminar.php?id=<?= $categoria->getId() ?>'>Eliminar categoría</a>
<?php } ?>

<br/>

<a href='CategoriaListado.php'>Volver al listado de categorías.</a>

<?php pintarPie(); ?>
</body>

</html>