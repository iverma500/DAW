<?php
    require_once "_Varios.php";

    function entrarSiSesionIniciada()
    {
        if (comprobarRenovarSesion()) redireccionar("PersonaListado.php");
    }

    function salirSiSesionFalla()
    {
        if (!comprobarRenovarSesion()) redireccionar("SesionFormulario.php");
    }

    function comprobarRenovarSesion(): bool
    {
        if (haySesionRam()){
            if (isset($_COOKIE["userId"])){ //basta con mirar si parece que viene cookie porque ya hay sesion ram
                generarRenovarSesionCookie();
            }
            return true;//esto es en todo caso
        } else { //no sesion RAM
            $usuario = obtenerUsuarioPorCookie();
            if ($usuario){ //Equivale a if($usuario != null)

                generarSesionRam($usuario); //canjear sesion cookie por una Ram
                generarRenovarSesionCookie();

                return true;
            } else {//ni ram ni cookie
                return false;
            }
        }
    }

    function haySesionRam(): bool
    {
        return isset($_SESSION["id"]);
    }

    function obtenerUsuarioPorContrasenna(string $identificador,string $contrasenna): ?array
    {
        $conexion = obtenerPdoConexionBD();
        $sql = "SELECT id, identificador, nombre FROM usuario WHERE identificador=? AND BINARY contrasenna=?";
        $select = $conexion->prepare($sql);
        $select->execute([$identificador, $contrasenna]); // Se añade el parámetro a la consulta preparada.
        $obtenidas = $select->rowCount();

        if ($obtenidas == 0) return null;
        else return $select->fetch();
    }

    function obtenerUsuarioPorCookie(): ?array
    {
        if (isset($_COOKIE["userId"])){
            $conexion = obtenerPdoConexionBD();

            $sql = "SELECT * FROM usuario WHERE id=? AND BINARY codigoCookie=? AND caducidadCodigoCookie>=?";
            $select = $conexion->prepare($sql);
            $select->execute([$_COOKIE["userId"],
                              $_COOKIE["codigoCookie"],
                              date("Y-m-d H:i:s",time())]);

            $obtenidas = $select->rowCount();

            if ($obtenidas == 0) return null;
            else return $select->fetch();
        } else {
            return null;
        }
    }

    function generarSesionRam(array $fila){
        $_SESSION["id"] = $fila["id"];
        $_SESSION["identificador"] = $fila["identificador"];
        $_SESSION["nombre"] = $fila["nombre"];
    }

    function generarRenovarSesionCookie()
    {
        $codigoCookie = uniqid(); //generar código aleatorio
        $caducidadCodigoCookie = date("Y-m-d H:i:s",time()+24*60*60);

        $conexion = obtenerPdoConexionBD();
        $query = "UPDATE usuario SET codigoCookie=?,caducidadCodigoCookie=? WHERE id=?";
        $select2 = $conexion->prepare($query);
        $select2->execute([$codigoCookie,$caducidadCodigoCookie,$_SESSION["id"]]); // Se añade el parámetro a la consulta preparada.

        setcookie("userId",strval($_SESSION["id"]),time() + 3600);
        setcookie("codigoCookie",$codigoCookie,time() + 3600);
    }

    function cerrarSesion(){
        //borrar datos de cookies de la BD
        $conexion = obtenerPdoConexionBD();
        $sql = "UPDATE usuario SET codigoCookie=NULL,caducidadCodigoCookie=NULL WHERE id=?";
        $select = $conexion->prepare($sql);
        $select->execute([$_SESSION["id"]]);

        //Borrar cookies
        setcookie("userId","",time() - 3600);
        setcookie("codigoCookie","",time() - 3600);;

        //borrar sesion
        session_destroy();
    }

?>