<?php
    session_start();
    require_once("requires.php");

    $interfaz = new InterfazControlador();
    $controlador = $interfaz->getControlador();
    $accion = $interfaz->getAccion();

    $master = false;

    if($controlador && $accion):
        $class = $controlador."Controlador";
        if(class_exists($class)):
            $master = new $class();
            $master->$accion();
        endif;

    endif;
?>
<!DOCTYPE html>
<html lang="en">
    <?php require_once("vistas/Compartido/Head.php"); ?>
<body>
    <?php 

       require_once($interfaz->render());
       
    ?>
</body>
</html>