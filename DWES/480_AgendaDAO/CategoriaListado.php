<?php
    require_once "__RequireOncesComunes.php";

    salirSiSesionFalla();

    $categorias = DAO::categoriaObtenerTodas();
?>



<html>

<head>
    <meta charset='UTF-8'>
</head>

<body>

<?php pintarCabecera(); ?>

<h2>Listado de Categorías</h2>

<table border='1'>

    <tr>
        <th>Nombre</th>
        <th></th>
    </tr>

    <?php foreach ($categorias as $categoria) { ?>
        <tr>
            <td><a href='CategoriaFicha.php?id=<?= $categoria->getId() ?>'><?= $categoria->getNombre() ?></a></td>
            <td><a href='CategoriaEliminar.php?id=<?= $categoria->getId() ?>'>(X) </a></td>
        </tr>
    <?php } ?>

</table>

<br>

<a href='CategoriaFicha.php'>Crear entrada</a>

<br>
<br>

<a href='PersonaListado.php'>Gestionar listado de Personas</a>

<?php pintarPie(); ?>

</body>

</html>