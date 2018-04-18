<?php
class Conexion {
    private $host = "localhost";
    private $base = "coco";
    private $user = "root";
    private $pwd = "";

    private $conn;

    public $status;

    protected function start(){
        $this->conn = new mysqli($this->host, $this->user,
            $this->pwd, $this->base);
        $this->conn->set_charset("UTF8");
        if($this->conn->connect_errno) {
            $this->status = 503;
            return false;
        }
        $this->status = 202;
        return true;
    }

    protected function query($query){
        return $this->conn->query($query);
    }

    protected function stop(){
        $this->conn->close();
    }
}
?>