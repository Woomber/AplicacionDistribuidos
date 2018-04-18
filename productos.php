<?php require("php/check_session.php"); ?>
<!DOCTYPE html>
<html>
<head>

	<?php include 'header.php'; ?>

</head>
<body>

	<?php include 'navbar.php'; ?>

	<div class="container">
		
		<div class="panel panel-info">

			<div class="panel-heading">
				<div class="btn-group pull-right">
					<a class="btn btn-info" href="nuevo_producto.php"><span class="glyphicon glyphicon-plus"></span> Nuevo Producto</a>
				</div>
				<h4><i class='glyphicon glyphicon-tags' style="margin-right: 10px;"></i> Productos</h4>
			</div>
			
			<div class="panel-body">
				
				<!-- Aqui van los productos -->

				<div class="table-responsive">
			  		<table class="table">
						<tr  class="info">
							<th>Clave</th>
							<th>Nombre</th>
							<th>Existencia</th>
							<th>Precio</th>
							<th class="text-right">Acciones</th>
						</tr>
						<?php include("php/imprimir_productos.php") ?>
			  		</table>
				</div>
				
			</div>
			
		</div>

	</div>

	<?php include 'footer.php'; ?>

</body>
</html>