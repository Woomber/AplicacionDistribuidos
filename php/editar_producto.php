<?php
include("controllers/ProductoController.php");
$controller = new ProductoController();

if(@isset($_POST["mod_nombre"])){
    $producto = $controller->getById($_SESSION['hId']);
    if($controller->status == 200){
        if ($_SESSION['hNombre']==$producto->nombre && $_SESSION['hExist']==$producto->existencia && $_SESSION['hPrecio']==$producto->precio) {
            $producto->nombre = $_POST["mod_nombre"];
            $producto->existencia = intval($_POST["mod_existencia"]);
            $producto->precio = floatval($_POST["mod_precio"]);
            if($controller->modify($producto)){
                header("Location: productos.php");
            }
        }else header("Location: errorModificado.php");
    }else header("Location: errorEliminado.php");
}

if(@isset($_GET["id"])){
    $producto = $controller->getById($_GET["id"]);
    if($controller->status==404)header("Location: errorEliminado.php");
    else{
        $_SESSION['hId'] = $producto->id;
        $_SESSION['hNombre'] = $producto->nombre;
        $_SESSION['hExist'] = $producto->existencia;
        $_SESSION['hPrecio'] = $producto->precio;
    } 
} else {
    header("Location: nuevo_producto.php");
}

?>

<div class="form-group">
<label for="mod_nombre" class="col-sm-3 control-label">Nombre</label>
<div class="col-sm-8">
<input type="text" value="<?php echo $producto->nombre?>" class="form-control" id="mod_nombre" name="mod_nombre" placeholder="Nombre del producto" required>
</div>
</div>

<div class="form-group">
<label for="mod_existencia" class="col-sm-3 control-label">Existencia</label>
<div class="col-sm-8">
<input type="text" value="<?php echo $producto->existencia?>" class="form-control" id="mod_existencia" name="mod_existencia" placeholder="Existencia del producto" required pattern="[0-9]+">
</div>
</div>

<div class="form-group">
<label for="mod_precio" class="col-sm-3 control-label">Precio</label>
<div class="col-sm-8">
<input type="text" value="<?php echo $producto->precio?>" class="form-control" id="mod_precio" name="mod_precio" placeholder="Precio del producto" required pattern="^[0-9]{1,5}(\.[0-9]{0,2})?$">
</div>
</div>