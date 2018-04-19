<?php
include("controllers/ProductoController.php");
$controller = new ProductoController();
$productos = $controller->getAll();
foreach($productos as $producto){
    echo "<td>$producto->id</td>
    <td>$producto->nombre</td>
    <td>$producto->existencia</td>
    <td>\$$producto->precio</td>";
    ?>
    <td>
        <span class="pull-right">
            <a href="editar_producto.php?id=<?php echo $producto->id ?>"
            class='btn btn-default' title='Editar producto'><i class="glyphicon glyphicon-edit"></i></a> 
            <a href="eliminar_producto.php?id=<?php echo $producto->id ?>&nombre=<?php echo $producto->nombre ?>&exist=<?php echo $producto->existencia;?>&precio=<?php echo $producto->precio;?>" class='btn btn-default' title='Borrar producto'><i class="glyphicon glyphicon-trash"></i></a>
        </span>
    </td>
</tr>
<?php
}
?>