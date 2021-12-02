<?php
session_start();

$letras = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
$GANAR = false;

// Nombre de las imagenes (partes del cuerpo)
$partesCuerpo = ["nohead","head","body","hand","hands","leg","legs"];

// Palabras a adivinar
$palabras = [
    "AHORCADO", "MARIPOSA" , "MANZANA", "ESTERNOCLEIDOMASTOIDEO", "DUPLICADO",
    "CASUALIDAD", "INFORMATIVO","ORDENADOR","JAULA","TELENOVELA","VIDEOJUEGO"];

//---------------- Imágenes Programa ---------------------
//obtener imagen por nombre
function obtenerImagen($imagen): string
{
    return "./imagenes/ahorcado_". $imagen. ".png";
}

// Obtener partes del cuerpo (imagen)
function obtenerPartesCuerpo(){
    global $partesCuerpo;
    return $_SESSION["partes"] ?? $partesCuerpo;
}

// añadir partes en imagen
function addParteCuerpo(){
    $partes = obtenerPartesCuerpo();
    array_shift($partes);
    $_SESSION["partes"] = $partes;
}

// obtener parte del cuerpo (imagen) actual
function obtenerParteCuerpoActual(){
    $partes = obtenerPartesCuerpo();
    return $partes[0];
}
//-------------------------------------------------------
//---------------------- Acción del usuario y su respuesta----------------
// obtener la respuesta ofrecida del usuario
function getRespuesta(){
    return $_SESSION["respuestas"] ?? [];
}

function addRespuesta($letra){
    $respuesta = getRespuesta();
    array_push($respuesta, $letra);
    $_SESSION["respuestas"] = $respuesta;
}

// comprobar si la letra introducida es correcta
function esLetraCorrecta($letra): bool
{
    $palabra = obtenerPalabra();
    $max = strlen($palabra) - 1;
    for($i=0; $i<= $max; $i++){
        if($letra == $palabra[$i]){
            return true;
        }
    }
    return false;
}

// obtener palabra a adivinar
function obtenerPalabra(){
    global $palabras;
    if(!isset($_SESSION["palabra"]) && empty($_SESSION["palabra"])){
        $key = array_rand($palabras);
        $_SESSION["palabra"] = $palabras[$key];
    }
    return $_SESSION["palabra"];
}

// si la palabra a adivinar es correcta
function esPalabraCorrecta(): bool
{
    $adivinar = obtenerPalabra();
    $respuestas = getRespuesta();
    $max = strlen($adivinar) - 1;
    for($i=0; $i<= $max; $i++){
        if(!in_array($adivinar[$i],  $respuestas)){
            return false;
        }
    }
    return true;
}
//-------------------------------------------------------------------------
//---------------- Comprobar estado de la partida--------------------------
// comprobar si el cuerpo está completo o no
function cuerpoCompleto(): bool
{
    $partes = obtenerPartesCuerpo();

    if(count($partes) <= 1){
        return true;
    }
    return false;
}

// marcar juego como completo
function juegoCompletado(){
    $_SESSION["juegocompletado"] = true;
}

// si se ha completado el juego
function juegoCompleto(){
    return $_SESSION["juegocompletado"] ?? false;
}

// reiniciar juego y limpiar la sesión
function reiniciarJuego(){
    session_destroy();
    session_start();
}

/* Al pulsar el botón reiniciar, reiniciar el juego*/
if(isset($_GET['restart'])){
    reiniciarJuego();
}
//-------------------------------------------------------------------------------
/* Comprobar que letra se ha pulsado */
if(isset($_GET['botonLetra'])){
    $botonPulsado = $_GET['botonLetra'] ?? null;
    // si el botón pulsado es correcto
    if($botonPulsado
        && esLetraCorrecta($botonPulsado)
        && !cuerpoCompleto()
        && !juegoCompleto()){
        //añadir respuesta con valor letra
        addRespuesta($botonPulsado);
        if(esPalabraCorrecta()){
            $GANAR = true; // juego completado
            juegoCompletado();
        }
    }else{
        // empieza el juego
        if(!cuerpoCompleto()){
            //se añade fallo sin entra valor no válido
            addParteCuerpo();
            if(cuerpoCompleto()){
                juegoCompletado(); // termina juego derrota
            }
        }else{
            juegoCompletado(); // termina juego derrota
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>El Ahorcado</title>
</head>
<body style="background: grey">

<!-- Agrupar con un div's -->
<div style="margin: 0 auto; background: white; width:900px; height:900px; padding:5px; border-radius:3px;">

    <!-- Lugar donde se insertan las imagenes -->
    <div style="display:inline-block; width: 500px; background:white;">
        <img style="width:80%; display:inline-block;" src="<?php echo obtenerImagen(obtenerParteCuerpoActual());?>" alt=""/>

        <!-- Lugar donde se indica el estado del juego -->
        <?php if($GANAR  && juegoCompleto()){?>
            <p style="color: green; font-size: 25px;">HAS GANADO</p>
        <?php } elseif(!$GANAR  && juegoCompleto()){?>
            <p style="color: red; font-size: 25px;">HAS PERDIDO</p>
        <?php }?>
    </div>

    <div style="float:right; display:inline; vertical-align:top;">
        <h1>El Ahorcado</h1>
        <div style="display:inline-block;">
            <form method="get">
                <?php
                // crear con un bucle 1 botón de cada letra
                $max = strlen($letras) - 1;
                for($i=0; $i<= $max; $i++){
                    echo "<button type='submit' name='botonLetra' value='". $letras[$i] . "'>".
                        $letras[$i] . "</button>";
                    //salto de línea de botones cada 7
                    if ($i % 7 == 0 && $i>0) {
                        echo '<br>';
                    }
                }
                ?>
                <br><br>
                <!-- Botón Reiniciar juego -->
                <button type="submit" name="restart">Reiniciar</button>
            </form>
        </div>
    </div>

    <div style="margin-top:20px; padding:15px; background: dimgray; color: #fcf8e3">
        <!-- Alojar la palabra seleccionada aleatoriamente -->
        <?php
        $adivinar = obtenerPalabra();
        $letrasPalabraAdivinar = strlen($adivinar) - 1;
        //obtener la letra adivinada o poner -
        for($j=0; $j<= $letrasPalabraAdivinar; $j++){ $l = obtenerPalabra()[$j]; ?>
            <?php if(in_array($l, getRespuesta())){?>
                <span style="font-size: 35px; border-bottom: 3px solid #000; margin-right: 5px;"><?php echo $l;?></span>
            <?php }else{ ?>
                <span style="font-size: 35px; border-bottom: 3px solid #000; margin-right: 5px;">&nbsp;&nbsp;&nbsp;</span>
            <?php }?>
        <?php }?>
    </div>
</div>
</body>
</html>