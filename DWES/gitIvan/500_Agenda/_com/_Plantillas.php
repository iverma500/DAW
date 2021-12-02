<?php

function pintarCabecera()
{
    ?>
    <header>

        <h1>Aplicación de Agenda</h1>

        <?php
        return; // TODO Descomentar cuando hagamos la parte de Sesion
        ?>

        <p>Sesión iniciada por <?= $_SESSION["nombre"] ?> [<?= $_SESSION["identificador"] ?>]
            <a href='SesionCerrar.php'>Cerrar sesión</a>
        </p>

    </header>
    <?php
}

function pintarPie()
{
    ?>
    <footer>
        <p>(c) DAW 2 @ LDJ 2021</p>
    </footer>
    <?php
}

?>