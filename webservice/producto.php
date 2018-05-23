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
            if(isset($_GET["e"])):
                $opc = $_GET["e"];
                switch((int)$opc):
                    case 1:$interfaz->setAccion("ProductoEliminado");break;
                    case 2:$interfaz->setAccion("ProductoInexistente");break;
                    case 3:$interfaz->setAccion("ProductoModificado");break;
                endswitch;
            endif;
        endif;

    endif;
?>
<!DOCTYPE html>
<html lang="en">
    <?php require_once("vistas/Compartido/Head.php"); ?>
<body>
    <?php 
    
        require_once("./vistas/Compartido/Navbar.php");
        require_once($interfaz->render());
        require_once("./vistas/Compartido/Footer.php");
       
    ?>
</body>
</html>