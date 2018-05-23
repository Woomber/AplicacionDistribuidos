<?php

    Class ProductoControlador extends DBConexion {

        public $result;
        private $tabla = "productos";
        private $fields = array(
            "id" => "id",
            "nombre"  => "nombre",
            "exist" => "existencia",
            "precio" => "precio"
        );

        public function __construct(){}

        public function Lista(){
            if(!$this->start()) {
                $this->stop();
                return false;
            }

            $stmt = $this->pdo->prepare("SELECT * FROM ".$this->tabla);
            $stmt->execute();

            if($stmt) $this->status = 200;
            else $this->status = 404;

            $lista = array();

            while($fila = $stmt->fetch(PDO::FETCH_ASSOC)):
                $producto = new ProductoModelo();
                $producto->set(
                    $fila[$this->fields["id"]],
                    $fila[$this->fields["nombre"]],
                    $fila[$this->fields["exist"]],
                    $fila[$this->fields["precio"]]
                );
                $lista[] = $producto;
            endwhile;
            
            $this->stop();
            $this->result = $lista;
        }

         public function Eliminar(){
            if(!$this->start()) {
                $this->stop();
                return false;
            }

            $stmt = $this->pdo->prepare(
                "SELECT * FROM " . $this->tabla . " " .
                "WHERE " . $this->fields["id"] . " = :id"
            );
            $stmt->execute([
                'id' => $_GET["id"]
            ]);

            if($stmt->rowCount() == 0):
                $usuario = new UsuarioModelo();
                $usuario->username = $_SESSION["usuario"];

                $producto = new ProductoModelo();
                $producto->id = $_GET["id"];
                $producto->nombre = "NE";
                $producto->existencia = -1;
                $producto->precio = -1;

                $log = new LoggerControlador();
                $log->IEliminar($usuario, $producto);
                
                header("Location: producto.php?c=Producto&a=Lista&e=2");
                return;
            endif;

            $this->result = $stmt->fetch();
            $producto = new ProductoModelo();
            $producto->id = $this->result->id;
            $producto->nombre = $this->result->nombre;
            $producto->existencia = $this->result->existencia;
            $producto->precio = $this->result->precio;

            $stmt = $this->pdo->prepare(
                "DELETE FROM ".$this->tabla." ".
                "WHERE ".$this->fields["id"]." = :id"
            );

            $stmt->execute([
                'id' => $_GET["id"]
            ]);

            $usuario = new UsuarioModelo();
            $usuario->username = $_SESSION["usuario"];
            $log = new LoggerControlador();
            $log->Eliminar($usuario, $producto);

            if($stmt) $this->status = 200;
            else $this->status = 503;

            $this->stop();
            
            header("Location: producto.php?c=Producto&a=Lista");

        }

        public function Agregar(){

            if($_SERVER["REQUEST_METHOD"]=="POST" && isset($_POST["mod_nombre"]) && isset($_POST["mod_existencia"]) && isset($_POST["mod_precio"])):

                if(!$this->start()) {
                    $this->stop();
                    return false;
                }

                $producto = new ProductoModelo();
                $producto->nombre = $_POST["mod_nombre"];
                $producto->existencia = intval($_POST["mod_existencia"]);
                $producto->precio = floatval($_POST["mod_precio"]);

                if(empty($producto->existencia) && empty($producto->precio) && empty($producto->nombre)):
                    return false;
                endif;

                if(!filter_var($producto->precio, FILTER_VALIDATE_INT) && !filter_var($producto->existencia, FILTER_VALIDATE_INT)):
                    return false;
                endif;

                if((int)$producto->precio < 0 || (int)$producto->existencia < 0):
                    return false;
                endif;
                
                $stmt = $this->pdo->prepare(
                    "INSERT INTO ".$this->tabla."
                    (
                        ".$this->fields["nombre"].",
                        ".$this->fields["exist"].",
                        ".$this->fields["precio"]."
                    ) VALUES (
                        :nombre,
                        :exist,
                        :precio
                    )
                ");
                
                $stmt->execute([
                    'nombre' => $producto->nombre,
                    'exist' => $producto->existencia,
                    'precio' => $producto->precio
                ]);
                    
                $producto->id = $this->pdo->lastInsertId();
                $usuario = new UsuarioModelo();
                $usuario->username = $_SESSION["usuario"];

                $log = new LoggerControlador();
                $log->Agregar($usuario, $producto);
                if($stmt) $this->status = 200;
                else $this->status = 503;

                $this->stop();
                header("Location: producto.php?c=Producto&a=Lista");

            endif;

        }

        public function Modificar(){

            if($_SERVER["REQUEST_METHOD"]=="POST" && isset($_POST["mod_nombre"]) && isset($_POST["mod_existencia"]) && isset($_POST["mod_precio"])):

                if(!$this->start()):
                    $this->stop();
                    return false;
                endif;

                $producto = new ProductoModelo();
                $producto->nombre = $_POST["mod_nombre"];
                $producto->existencia = intval($_POST["mod_existencia"]);
                $producto->precio = floatval($_POST["mod_precio"]);
                $producto->id = $_GET["id"];

                if(empty($producto->existencia) && empty($producto->precio) && empty($producto->nombre)):
                    return false;
                endif;

                if(!filter_var($producto->precio, FILTER_VALIDATE_INT) && !filter_var($producto->existencia, FILTER_VALIDATE_INT)):
                    return false;
                endif;

                if((int)$producto->precio < 0 || (int)$producto->existencia < 0):
                    return false;
                endif;

                $stmt = $this->pdo->prepare(
                    "SELECT * FROM " . $this->tabla . " " .
                    "WHERE " . $this->fields["id"] . " = :id"
                );

                $stmt->execute([
                    'id' => $producto->id
                ]);

                if($stmt->rowCount() == 1):

                    $res = $stmt->fetch();
                    $actual = new ProductoModelo();
                    $actual->id = $res->id;
                    $actual->nombre = $res->nombre;
                    $actual->existencia = $res->existencia;
                    $actual->precio = $res->precio;

                    if($actual->id == $_SESSION["producto_id"] && $actual->nombre == $_SESSION["producto_nombre"] && $actual->existencia == $_SESSION["producto_existencia"] && $actual->precio == $_SESSION["producto_precio"]):
                        $stmt = $this->pdo->prepare(
                            "UPDATE ".$this->tabla.
                            " SET ".
                            $this->fields["nombre"]." = :nombre, ".
                            $this->fields["exist"]." = :exist, ".
                            $this->fields["precio"]." = :precio ".
                            "WHERE ".$this->fields["id"]." = :id"
                        );

                        $stmt->execute([
                            'nombre' => $producto->nombre,
                            'exist' => $producto->existencia,
                            'precio' => $producto->precio,
                            'id' => $producto->id
                        ]);

                        $usuario = new UsuarioModelo();
                        $usuario->username = $_SESSION["usuario"];

                        $log = new LoggerControlador();
                        $log->Modificar($usuario, $producto);

                        $this->stop();
                        header("Location: producto.php?c=Producto&a=Lista");
                    else:
                        $usuario = new UsuarioModelo();
                        $usuario->username = $_SESSION["usuario"];

                        $log = new LoggerControlador();
                        $log->IModificar($usuario, $producto);
                        header("Location: producto.php?c=Producto&a=Lista&e=3");
                    endif;
                else:
                    $usuario = new UsuarioModelo();
                    $usuario->username = $_SESSION["usuario"];

                    $log = new LoggerControlador();
                    $log->IModificar($usuario, $producto);
                    header("Location: producto.php?c=Producto&a=Lista&e=1");
                endif;

            else:
                if(isset($_GET["id"])):

                    if(!$this->start()) {
                        $this->stop();
                        return false;
                    }

                    $id = $_GET["id"];

                    $stmt = $this->pdo->prepare(
                        "SELECT * FROM " . $this->tabla . " " .
                        "WHERE " . $this->fields["id"] . " = :id"
                    );

                    $stmt->execute([
                        'id' => $id
                    ]);
                    if($stmt->rowCount() == 1):
                        $this->result = $stmt->fetch();
                        $_SESSION["producto_id"] = $this->result->id;
                        $_SESSION["producto_nombre"] = $this->result->nombre;
                        $_SESSION["producto_existencia"] = $this->result->existencia;
                        $_SESSION["producto_precio"] = $this->result->precio;
                    else:
                        header("Location: producto.php?c=Producto&a=Lista&e=2");    
                    endif;
                else:
                    header("Location: producto.php?c=Producto&a=Lista");
                endif;
            endif;

        }

    }

?>