<?php
    session_start();
    require_once("InterfazControlador.php");

    $interfaz = new InterfazControlador();
    $controlador = $interfaz->getControlador();
    $accion = $interfaz->getAccion();

    $master = false;

     if($controlador == "Producto"){
        switch($accion){
            case "Eliminar":
                 $client = new SoapClient("http://localhost/aplicaciondistribuidos/webservice/metodos.php?wsdl", "wsdl");
                $result = $client->call("EliminarProducto",array(
                    "id" => $_GET["id"],
                    "usuario" => $_SESSION["usuario"]
                ));
                header("Location: producto.php?c=Producto&a=Lista&e=$result");
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
    
        require_once("./vistas/Compartido/Navbar.php");
        require_once($interfaz->render());
        require_once("./vistas/Compartido/Footer.php");
       
    ?>
</body>
</html>