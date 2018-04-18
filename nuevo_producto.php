<?php require("php/check_session.php"); ?>
<!DOCTYPE html>
<html>
<head>

	<?php include 'header.php'; ?>

</head>
<body>

	<?php include 'navbar.php'; ?>

	<div class="container">

		<form class="form-horizontal" method="post">

			<div class="panel panel-info">

				<div class="panel-heading">
					<h4><i class='glyphicon glyphicon-tags' style="margin-right: 10px;"></i> Nuevo Producto</h4>
				</div>
				
				<div class="panel-body">
					
				<?php require("php/agregar_producto.php"); ?>
					
				</div>

				<div class="panel-footer">
					<input type="submit" class="btn btn-primary" value="Crear producto">
					<a class="btn btn-default" href="productos.php">Volver</a>
				</div>
				
			</div>

		</form>

	</div>

	<?php include 'footer.php'; ?>

</body>
</html>