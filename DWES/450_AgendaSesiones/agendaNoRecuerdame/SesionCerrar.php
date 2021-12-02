<?php
    require_once "_Varios.php";

    if (haySesionRam()){
        destruirSesion();
    }

    redireccionar("SesionFormulario.php");
