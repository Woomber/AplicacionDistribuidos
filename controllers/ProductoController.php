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

        $result = $this->query("SELECT * FROM " . $this->tabla);

        if($result) $this->status = 200;
        else $this->status = 404;

        $lista = array();

        while($fila = $result->fetch_array()){
            $producto = new Producto();
            $producto->set(
                $fila[$this->fields["id"]],
                $fila[$this->fields["nombre"]],
                $fila[$this->fields["exist"]],
                $fila[$this->fields["precio"]]
            );
            $lista[] = $producto;
        }
        
        $this->stop();
        return $lista; 

    }

    public function getById($id){
        if(!$this->start()) {
            $this->stop();
            return false;
        }

        $result = $this->query("SELECT * FROM " . $this->tabla . " " .
            "WHERE " . $this->fields["id"] . " = $id");

        if($result) $this->status = 200;
        else $this->status = 404;

        $producto = new Producto();

        if($fila = $result->fetch_array()){
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

        $result = $this->query(
            "INSERT INTO " . $this->tabla . " (" .
            $this->fields["nombre"] . ", " .
            $this->fields["exist"] . ", " .
            $this->fields["precio"] . ") VALUES (" .
            "'$producto->nombre', " .
            "$producto->existencia, " .
            "$producto->precio)");

        if($result) $this->status = 200;
        else $this->status = 503;

        $this->stop();
        return $result; 

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

        $result = $this->query(
            "UPDATE " . $this->tabla . " SET " .
            $this->fields["nombre"] . " = '$producto->nombre', " .
            $this->fields["exist"] . " = $producto->existencia, " .
            $this->fields["precio"] . " = $producto->precio " .
            "WHERE " . $this->fields["id"] . " = $producto->id"
        );

        if($result) $this->status = 200;
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

        $result = $this->query(
            "DELETE FROM " . $this->tabla . " " .
            "WHERE " . $this->fields["id"] . " = $producto->id"
        );

        if($result) $this->status = 200;
        else $this->status = 503;

        $this->stop();
        return $producto; 

    }

}

?>