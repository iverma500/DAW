<?php
$ciudades = [
    17 => "Donosti",
    8 => "Getafe",
    4 => "Toledo",
    71 => "Granada",
    52 => "Lugo",
    47 => "Zaragoza"
];
?>

<html>
<head></head>
<body>
    <form>
        <select value='ciudades' id='ciudades'>
            <?php foreach ($ciudades as $key){ ?> <!--recoger lave y valor -->
                <option value=<?php echo $key ?>> <!--recoger clave de array y añardirla en cada option -->
                    <?php echo $key ?> <!--añadir valor de la clave en cada option -->
                </option>
            <?php  } ?>
        </select>
    </form>
</body>
</html>
