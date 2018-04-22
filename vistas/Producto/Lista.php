<div class="container">
    <div class="panel panel-info">
        <div class="panel-heading">
            <div class="btn-group pull-right">
                <a class="btn btn-info" href="producto.php?c=Producto&a=Agregar"><span class="glyphicon glyphicon-plus"></span> Nuevo Producto</a>
            </div>
            <h4><i class='glyphicon glyphicon-tags' style="margin-right: 10px;"></i> Productos</h4>
        </div>
        
        <div class="panel-body">
            <div class="table-responsive">
                <table class="table">
                    <tr  class="info">
                        <th>Clave</th>
                        <th>Nombre</th>
                        <th>Existencia</th>
                        <th>Precio</th>
                        <th class="text-right">Acciones</th>
                    </tr>
                    <?php
                        foreach($master->result as $producto):
                            echo "<td>$producto->id</td>
                            <td>$producto->nombre</td>
                            <td>$producto->existencia</td>
                            <td>\$$producto->precio</td>";
                            ?>
                            <td>
                                <span class="pull-right">
                                    <a href="producto.php?c=Producto&a=Modificar&id=<?php echo $producto->id?>"
                                    class='btn btn-default' title='Editar producto'><i class="glyphicon glyphicon-edit"></i></a> 
                                    <a href="producto.php?c=Producto&a=Eliminar&id=<?php echo $producto->id?>" class='btn btn-default' title='Borrar producto'><i class="glyphicon glyphicon-trash"></i></a>
                                </span>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                </table>
            </div>
        </div>
    </div>
</div>