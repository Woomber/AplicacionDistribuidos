<?php

    require_once("./database/DBConexion.php");
    require_once("./database/DBLog.php");

    $modelos = opendir("modelos");
    while ($modelo = readdir($modelos)):
        if(!is_dir($modelo)):
            require_once('./modelos/'.$modelo);
        endif;
    endwhile;

    $controladores = opendir("controladores");
    while ($controlador = readdir($controladores)):
        if(!is_dir($controlador)):
            require_once('./controladores/'.$controlador);
        endif;
    endwhile;

?>