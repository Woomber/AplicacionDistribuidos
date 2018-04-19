<?php
require("Conexion.php");
require("models/Producto.php");

class ProductoController extends Conexion {
    private $tabla = "productos";
    private $fields = array(
        "id" => "id",
        "nombre"  => "nombre",
        "exist" => "existencia",
        "precio" => "precio"
    );

    public function getAll(){
        if(!$this->start()) {
            $this->stop();
            return false;
        }

        $stmt = $this->conn->prepare("SELECT * FROM ".$this->tabla);
        $stmt->execute();

        if($stmt) $this->status = 200;
        else $this->status = 404;

        $lista = array();

        while($fila = $stmt->fetch(PDO::FETCH_ASSOC)):
            $producto = new Producto();
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

    public function getById($id){
        if(!$this->start()) {
            $this->stop();
            return false;
        }

        $stmt = $this->conn->prepare(
            "SELECT * FROM ".$this->tabla." ".
            "WHERE ".$this->fields["id"]." = :id"
        );

        $stmt->execute([
            'id' => $id
        ]);

        if($stmt){
            if($stmt->rowCount() > 0)$this->status = 200;
            else $this->status=404;
        }else {
            $this->status = 404;
            return;
        }

        $producto = new Producto();

        if($fila = $stmt->fetch(PDO::FETCH_ASSOC)){
            $producto->set(
                $fila[$this->fields["id"]],
                $fila[$this->fields["nombre"]],
                $fila[$this->fields["exist"]],
                $fila[$this->fields["precio"]]
            );
        }
        
        $this->stop();
        return $producto; 

    }

    public function add($producto){
        if(!$this->start()) {
            $this->stop();
            return false;
        }

        if(get_class($producto) != get_class(new Producto)){
            $this->status = 400;
            $this->stop();
            return false;
        }

        if(empty($producto->existencia) && empty($producto->precio) && empty($producto->nombre)):
            return false;
        endif;

        if(!filter_var($producto->precio, FILTER_VALIDATE_INT) && !filter_var($producto->existencia, FILTER_VALIDATE_INT)):
            return false;
        endif;

        if((int)$producto->precio < 0 || (int)$producto->existencia < 0):
            return false;
        endif;
        
        $stmt = $this->conn->prepare(
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
        if($stmt) $this->status = 200;
        else $this->status = 503;

        $this->stop();
        return $stmt; 

    }    

    public function modify($producto){
        if(!$this->start()) {
            $this->stop();
            return false;
        }

        if(get_class($producto) != get_class(new Producto)){
            $this->status = 400;
            $this->stop();
            return false;
        }

        if(empty($producto->existencia) && empty($producto->precio) && empty($producto->nombre)):
            return false;
        endif;

        if(!filter_var($producto->precio, FILTER_VALIDATE_INT) && !filter_var($producto->existencia, FILTER_VALIDATE_INT)):
            return false;
        endif;

         if((int)$producto->precio < 0 || (int)$producto->existencia < 0):
            return false;
        endif;

        $stmt = $this->conn->prepare(
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
        
        if($stmt) $this->status = 200;
        else $this->status = 503;

        $this->stop();
        return $producto; 

    }

    public function delete($producto){
        if(!$this->start()) {
            $this->stop();
            return false;
        }

        if(get_class($producto) != get_class(new Producto)){
            $this->status = 400;
            $this->stop();
            return false;
        }

        $stmt = $this->conn->prepare(
            "DELETE FROM ".$this->tabla." ".
            "WHERE ".$this->fields["id"]." = :id"
        );

        $stmt->execute([
            'id' => $producto->id
        ]);

        if($stmt) $this->status = 200;
        else $this->status = 503;

        $this->stop();
        return $producto; 

    }

}

?>