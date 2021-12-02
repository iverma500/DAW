<?php
    require_once "_Varios.php";

    if(haySesionRam())
    {
        redireccionar("PersonaListado.php");
    }

    if(isset($_REQUEST['btningresar']))
    {
        $conexion = obtenerPdoConexionBD();

        $nombre=$_REQUEST["txtusuario"];
        $pass=$_REQUEST["txtpassword"];

        $query="SELECT * FROM usuario WHERE BINARY identificador = ? AND BINARY contrasenna = ?";
        $parametros = [$nombre, $pass];

        $sentencia = $conexion->prepare($query);

        //Esta llamada devuelve true o false según si la ejecución de la sentencia ha ido bien o mal.
        $sqlConExito = $sentencia->execute($parametros); // Se añaden los parámetros a la consulta preparada.

        $rs = $sentencia->fetchAll();
        // Está todo correcto de forma normal si NO ha habido errores y se ha visto afectada UNA fila.
        //$correcto = ($sqlConExito && $sentencia->rowCount() == 1);

        if ($sqlConExito && $sentencia->rowCount() == 1) {
            $_SESSION["id"] = $rs[0]["id"];
            $_SESSION["identificador"] = $rs[0]["identificador"];
            $_SESSION["nombre"] = $rs[0]["nombre"];
            redireccionar("PersonaListado.php");
        } else {
            redireccionar("SesionFormulario.php?code");
        }
    }
?>