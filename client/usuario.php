<?php
    session_start();
    require_once("InterfazControlador.php");
    $interfaz = new InterfazControlador();
    $controlador = $interfaz->getControlador();
    $accion = $interfaz->getAccion();

    $master = false;

    if($controlador == "Usuario"){
        switch($accion){
            case "Logout":
            $_SESSION["usuario"] = null;
                 @session_destroy();
                header("Location: usuario.php?c=Usuario&a=Ingresar");
         var_dump($result);
            break;
        }
    }
    
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