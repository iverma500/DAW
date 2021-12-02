<?php
    require_once "_Varios.php";
    require_once "_Sesion.php";

    entrarSiSesionIniciada();

    $usuario = obtenerUsuarioPorContrasenna($_REQUEST["identificador"],$_REQUEST["contrasenna"]);

    if ($usuario){ //if($usuario != null)
        generarSesionRam($usuario);

        if (isset($_REQUEST["recordar"])){
            generarRenovarSesionCookie();
        }

        redireccionar("PersonaListado.php");
    } else {
        redireccionar("SesionFormulario.php?error");
    }
?>