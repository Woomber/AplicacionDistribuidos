<?php
class Conexion {
    private $host = "localhost";
    private $base = "coco";
    private $user = "root";
    private $pwd = "";
    private $charset = "utf8";
    public $conn;
    public $status;

    protected function start(){
        try{
            $this->conn = new PDO('mysql:host='.$this->host.';dbname='.$this->base.';charset='.$this->charset, $this->user, $this->pwd);
            $this->conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
            $this->status = 202;
            return true;
        }
        catch (PDOException $ex) {
            $this->status = 503;
            return false;
        }
    }

    protected function query($query){
        return $this->conn->query($query);
    }

    protected function stop(){
        $this->conn = null;
    }
}
?>