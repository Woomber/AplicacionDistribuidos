<?php
require_once "nusoap/lib/nusoap.php";
if(isset($_POST["mod_nombre"]))  {
$client = new SoapClient("http://localhost/aplicaciondistribuidos/webservice/metodos.php?wsdl", "wsdl");
  $result = $client->call("AgregarProducto",array(
      "nombre" => $_POST["mod_nombre"],
      "existencia" => $_POST["mod_existencia"],
      "precio" => $_POST["mod_precio"],
      "usuario" => $_SESSION["usuario"]
      ));
        
        header("Location: producto.php?c=Producto&a=Lista&e=$result");
}  

?>

<div class="container">
		<form class="form-horizontal" method="post">
			<div class="panel panel-info">
				<div class="panel-heading">
					<h4><i class='glyphicon glyphicon-tags' style="margin-right: 10px;"></i> Nuevo Producto</h4>
				</div>
				<div class="panel-body">
                    <div class="form-group">
                        <label for="mod_nombre" class="col-sm-3 control-label">Nombre</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="mod_nombre" name="mod_nombre" placeholder="Nombre del producto" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="mod_existencia" class="col-sm-3 control-label">Existencia</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="mod_existencia" name="mod_existencia" placeholder="Existencia del producto" required pattern="[0-9]+">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="mod_precio" class="col-sm-3 control-label">Precio</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="mod_precio" name="mod_precio" placeholder="Precio del producto" required pattern="^[0-9]{1,5}(\.[0-9]{0,2})?$">
                        </div>
                    </div>
                </div>
				<div class="panel-footer">
					<input type="submit" class="btn btn-primary" value="Crear producto">
					<a class="btn btn-default" href="producto.php">Volver</a>
				</div>
			</div>
		</form>
	</div>