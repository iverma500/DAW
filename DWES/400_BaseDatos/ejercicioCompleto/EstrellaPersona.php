<?php
require_once "_Varios.php";
$conexion = obtenerPdoConexionBD();

$personaId = (int)$_REQUEST["id"];

$conexion = obtenerPdoConexionBD();
$sql = "SELECT p.estrella as p_star FROM Persona as p WHERE id=?";
$select = $conexion->prepare($sql);
$select->execute([$personaId]); // Se añade el parámetro a la consulta preparada.
$fila = $select->fetchAll();

    foreach ($fila as $resultado){

        if ($resultado["p_star"] == 0){
            $sql = "UPDATE Persona SET estrella=? WHERE id=?";

            $parametros = [1,$personaId];
            $sentencia = $conexion->prepare($sql);

            //Esta llamada devuelve true o false según si la ejecución de la sentencia ha ido bien o mal.
            $sqlConExito = $sentencia->execute($parametros); // Se añaden los parámetros a la consulta preparada.
            header("Location: Listado.php");
        } elseif ($resultado["p_star"] == 1){
            $sql = "UPDATE Persona SET estrella=? WHERE id=?";

            $parametros = [0,$personaId];
            $sentencia = $conexion->prepare($sql);

            //Esta llamada devuelve true o false según si la ejecución de la sentencia ha ido bien o mal.
            $sqlConExito = $sentencia->execute($parametros); // Se añaden los parámetros a la consulta preparada.
            header("Location: Listado.php");
        }
    }
?>