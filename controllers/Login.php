<?php
require("Conexion.php");

class Login extends Conexion {

    private $tabla = "usuarios";
    public $key = '';
    private $fields = array(
        "user" => "username",
        "pwd"  => "password"
    );

    public function checkLogin($username, $password){
        if(!$this->start()) {
            $this->stop();
            return false;
        }

        $username = trim($username);
        $password = hash("sha256", $password);
        
        $result = $this->query("SELECT * FROM ". $this->tabla." ".
        "WHERE ". $this->fields["user"] ." = '$username' " . 
        "AND " . $this->fields["pwd"] . " = '$password'");
        
        if($result->num_rows > 0): 
            $this->status = 200;
            $key = hash("sha256",(string)mt_rand(10, 1000));
            $this->query("UPDATE ". $this->tabla ." ".
            "SET  hash = '$key' WHERE ". $this->fields["user"] ." = '$username'");
            $this->key = $key;
        else:
            $this->status = 404;
        endif;
        
        
        $this->stop();  
        return $result->num_rows;
    }

    public function createLogin($username, $password){
        if(!$this->start()) {
            $this->stop();
            return false;
        }

        if(trim($username) == "" || $password == ""){
            $this->status = 400;
            $this->stop();
            return false;
        }

        $username = trim($username);
        $password = hash("sha256", $password);

        $result = $this->query("INSERT INTO ". $this->tabla . " " . 
            "VALUES ('$username', '$password')");

        if($result) $this->status = 200;
        else $this->status = 503;
        
        $this->stop();
        return $result; 
    }

}
?>