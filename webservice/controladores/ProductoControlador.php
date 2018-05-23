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
                return -1;
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
            return $lista;
        }

         public function Eliminar($id, $usuario){
            if(!$this->start()) {
                $this->stop();
                return -1;
            }

            $stmt = $this->pdo->prepare(
                "SELECT * FROM " . $this->tabla . " " .
                "WHERE " . $this->fields["id"] . " = :id"
            );
            $stmt->execute([
                'id' => $id
            ]);

            if($stmt->rowCount() == 0):
                $uusuario = new UsuarioModelo();
                $uusuario->username = $usuario;

                $producto = new ProductoModelo();
                $producto->id = $id;
                $producto->nombre = "NE";
                $producto->existencia = -1;
                $producto->precio = -1;

                $log = new LoggerControlador();
                $log->IEliminar($uusuario, $producto);
                
                return 2;
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
                'id' => $id
            ]);

            $uusuario = new UsuarioModelo();
            $uusuario->username = $usuario;
            $log = new LoggerControlador();
            $log->Eliminar($uusuario, $producto);

            if($stmt) $this->status = 200;
            else $this->status = 503;

            $this->stop();
            
            return 0;

        }

        public function Agregar($nombre, $existencia, $precio, $usuario){

           

            if(!$this->start()) {
                $this->stop();
                return -1;
            }

            $producto = new ProductoModelo();
            $producto->nombre = $nombre;
            $producto->existencia = intval($existencia);
            $producto->precio = floatval($precio);

            if(empty($producto->existencia) && empty($producto->precio) && empty($producto->nombre)):
                return -1;
            endif;

            if(!filter_var($producto->precio, FILTER_VALIDATE_INT) && !filter_var($producto->existencia, FILTER_VALIDATE_INT)):
                return -1;
            endif;

            if((int)$producto->precio < 0 || (int)$producto->existencia < 0):
                return -1;
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
            $uusuario = new UsuarioModelo();
            $uusuario->username = $usuario;

            $log = new LoggerControlador();
            $log->Agregar($uusuario, $producto);
            if($stmt) $this->status = 200;
            else $this->status = 503;

            $this->stop();
            return 0;

        }

        public function Modificar($id, $nombre, $existencia, $precio, $usuario){

            if(isset($nombre)):
            if(!$this->start()):
                $this->stop();
                return -1;
            endif;

            $producto = new ProductoModelo();
            $producto->nombre = $nombre;
            $producto->existencia = intval($existencia);
            $producto->precio = floatval($precio);
            $producto->id = $id;

            if(empty($producto->existencia) && empty($producto->precio) && empty($producto->nombre)):
                return -1;
            endif;

            if(!filter_var($producto->precio, FILTER_VALIDATE_INT) && !filter_var($producto->existencia, FILTER_VALIDATE_INT)):
                return -1;
            endif;

            if((int)$producto->precio < 0 || (int)$producto->existencia < 0):
                return -1;
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

                    if($actual->id == $id && $actual->nombre == $nombre && $actual->existencia == $existencia && $actual->precio == $precio):
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

                        $uusuario = new UsuarioModelo();
                        $uusuario->username = $usuario;

                        $log = new LoggerControlador();
                        $log->Modificar($uusuario, $producto);

                        $this->stop();
                        return 0;
                    else:
                        $uusuario = new UsuarioModelo();
                        $uusuario->username = $usuario;

                        $log = new LoggerControlador();
                        $log->IModificar($uusuario, $producto);
                        return 3;
                    endif;
                else:
                    $uusuario = new UsuarioModelo();
                    $uusuario->username = $usuario;

                    $log = new LoggerControlador();
                    $log->IModificar($uusuario, $producto);
                    return 1;
                endif;

            else:
                if(isset($id)):

                    if(!$this->start()) {
                        $this->stop();
                        return -1;
                    }

                    $stmt = $this->pdo->prepare(
                        "SELECT * FROM " . $this->tabla . " " .
                        "WHERE " . $this->fields["id"] . " = :id"
                    );

                    $stmt->execute([
                        'id' => $id
                    ]);
                    if($stmt->rowCount() == 1):
                        $this->result = $stmt->fetch();
                        return $this->result;
                    else:
                        return 2;    
                    endif;
                else:
                    return 0;
                endif;

            endif;
        }

    }

?>