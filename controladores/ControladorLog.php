<?php 
require("ConexionLog.php");
require("ProductoModelo.php");
require("UsuarioModelo.php");
class LogController extends ConexionLog {
	public function borrar($usuario,$producto){
		$this->start();
	 $stmt = $this->pdo->prepare(
                    "INSERT INTO logger(usuario,fecha,accion,id_producto,nombre,existencia,precio)
                     VALUES (
                     	:usuario,
                     	NOW(),
                     	:accion,
                     	:id_producto,
                        :nombre,
                        :existencia,
                        :precio
                    )
                ");
                $stmt->execute([
                	'usuario' => $usuario->username,
                	'accion' => "B",
                	'id_producto' => $producto->id,
                    'nombre' => $producto->nombre,
                    'existencia' => $producto->existencia,
                    'precio' => $producto->precio
                ]);
	}
	public function agregar($usuario,$producto){
		$this->start();
	 $stmt = $this->pdo->prepare(
                    "INSERT INTO logger(usuario,fecha,accion,id_producto,nombre,existencia,precio)
                     VALUES (
                     	:usuario,
                     	NOW(),
                     	:accion,
                     	:id_producto,
                        :nombre,
                        :existencia,
                        :precio
                    )
                ");
                $stmt->execute([
                	'usuario' => $usuario->username,
                	'accion' => "A",
                	'id_producto' => $producto->id,
                    'nombre' => $producto->nombre,
                    'existencia' => $producto->existencia,
                    'precio' => $producto->precio
                ]);

	}
	public function editar($usuario,$producto){
		$this->start();
	 $stmt = $this->pdo->prepare(
                    "INSERT INTO logger(usuario,fecha,accion,id_producto,nombre,existencia,precio)
                     VALUES (
                     	:usuario,
                     	NOW(),
                     	:accion,
                     	:id_producto,
                        :nombre,
                        :existencia,
                        :precio
                    )
                ");
                $stmt->execute([
                	'usuario' => $usuario->username,
                	'accion' => "E",
                	'id_producto' => $producto->id,
                    'nombre' => $producto->nombre,
                    'existencia' => $producto->existencia,
                    'precio' => $producto->precio
                ]);

	}
}
?>