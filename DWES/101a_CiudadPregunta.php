<html>

<head>
    <meta charset='UTF-8'>
</head>

<body>

<p>¿Cuál es tu cuidad favorita?</p>

<!-- El action de un formulario es el PHP al que se le enviará
    la información si el usuario pulsa el Submit de este formulario. -->
<form action='101b_CiudadInformacion.php' method='get'>
    <!-- El name de un campo será el nombre/clave del parámetro
        que se enviará al PHP que trate la información. -->
    <input type='text' name='ciudad' />

    <input type='submit' value="Enviar" />
</form>

</body>

</html>