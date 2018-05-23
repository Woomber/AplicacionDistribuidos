<?php

    function check($param){
        if(isset($_POST[$param])):
            echo $_POST[$param];
        else:
            echo "";
        endif;
    }

?>

<div class="container center">
	<form action="usuario.php?c=Usuario&a=Ingresar" class="form-horizontal center" method="POST">
		<div class="panel panel-info">
            <div class="panel-heading">
                <h4><i class='glyphicon glyphicon-log-in' style="margin-right: 10px;"></i>Ingresar</h4>
            </div>
			<div class="panel-body">
                <?php
					if($master->result != 1): ?>
					<div class="alert alert-danger" role="alert">
						<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                        <?php 
                            switch($master->result):
                                case 2: echo "No pueden existir campos vacíos."; break;
                                case 3: echo "Nombre de usuario o contraseña incorrectas."; break;
                            endswitch;
                            ?>
					</div>
					<?php endif;
				?>
                <div class="form-group">
                    <label for="mod_nombre" class="col-sm-4 control-label">Nombre de Usuario</label>
                    <div class="col-sm-8">
						<input type="text" class="form-control" name="usuario" value="<?php check("usuario");?>">
						</div>
					</div>
				<div class="form-group">
                    <label for="mod_existencia" class="col-sm-4 control-label">Contraseña</label>
                    <div class="col-sm-8">
                        <input type="password" class="form-control" name="password" value="<?php check("password");?>">
                    </div>
                </div>
			</div>
			<div class="panel-footer">
                <input type="submit" class="btn btn-primary" value="Continuar">
                <a class="btn btn-default" href="usuario.php?c=Usuario&a=Registrar">Registro</a>
            </div>
		</div>
	</form>
</div>