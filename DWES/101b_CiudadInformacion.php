<?php
    // Lo que pido aquí se tiene que corresponder con el nombre del parámetro,
    // que a su vez proviene del name del campo en el form original.
    // Lo recogemos y lo guardamos en una variable con el MISMO nombre, para evitar líos.
    $ciudad = $_REQUEST["ciudad"];
?>



<html>

<head>
    <meta charset='UTF-8'>
</head>

<body>

<!-- Utilizamos el valor de la variable, que proviene de lo que
    metieron en el form, para completar un <p>. -->
<p>Tu ciudad favorita es <?=$ciudad?>.</p>

<!-- Utilizamos de nuevo el valor de la variable, esta vez
    para terminar de fabricar un link. -->
<a href='https://www.google.com/search?q=<?=$ciudad?>'>Buscar información sobre <?=$ciudad?></a>

</body>

</html>