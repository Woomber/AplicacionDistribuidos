<?php require("php/do_registro.php"); ?>

<!DOCTYPE html>
<html>
<head>
	<title>Registro</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="css/style_login.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="resources/GlyphIcons/style.css">
	
</head>

<header>

</header>
<body>
	
	<br><br><br>
	<div class="content">
		<div id="ingresar">
			<div id="tIndex"><P>REGISTRO</P></div>
			<p id='mensaje'></p>
			<form action='registro.php' method='POST'>
				<div class="datos">
					<div class="inLabel">Usuario: </div> <div class="inTxt"><input type='text' name='usuario' class="input1 icon-user" placeholder="&#xe902; Usuario"></div>
				</div>
				<div class="datos">
					<div class="inLabel">Contraseña:</div>
					<div class="inTxt"><input type='password' name='pass' class="input1 icon-key" placeholder="&#xe903; Password"></div>
				</div>
				<input type='submit' value='Aceptar' class="botonLogIn">
			</form>
			
		</div>
	</div>
	<br>
	
	<br><br>
</body>
<footer>

</footer>
</html>