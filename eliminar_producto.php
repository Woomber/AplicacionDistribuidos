<?php
    include("controllers/ProductoController.php");
    $controller = new ProductoController();
	if(@isset($_GET["id"])){
        $producto = $controller->getById($_GET["id"]);
        if($controller->status==404)header("Location: errorEliminado.php");
        else{
            if($_GET['nombre']==$producto->nombre && $_GET['exist']==$producto->existencia && $_GET['precio']==$producto->precio){
                $controller->delete($producto);
                header("Location: productos.php");
            }
            else header("Location: errorModificado.php");
        }
    } else header("Location: productos.php");
?>
