<?php
    include("controllers/ProductoController.php");
    $controller = new ProductoController();
	if(@isset($_GET["id"])){
        $producto = $controller->getById($_GET["id"]);
        $controller->delete($producto);
    } 
     header("Location: productos.php");
?>
