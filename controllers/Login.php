<?php
require("Conexion.php");

class Login extends Conexion {

    private $tabla = "usuarios";
    public $key = '';
    private $fields = array(
        "user" => "username",
        "pwd"  => "password",
        "hash" => "hash"
    );

    public function checkLogin($username, $password){

        $this->start();

        $username = trim($username);
        $password = hash("sha256", $password);
        
        $stmt = $this->conn->prepare("SELECT * FROM ".$this->tabla." WHERE ".$this->fields["user"]." = :username AND ".$this->fields["pwd"]." = :password");
        $stmt->execute([
            'username' => $username,
            'password' => $password 
        ]);

        $result = $stmt->rowCount();
        $this->key = $this->tabla;
        if($result > 0): 
            $this->status = 200;
            $key = hash("sha256",(string)mt_rand(10, 1000));
            $stmt = $this->conn->prepare("UPDATE ".$this->tabla." SET  hash = :hash WHERE ".$this->fields["user"]." = :username");
            $stmt->execute([
                "hash" => $key,
                "username" => $username
            ]);
            $this->key=$key;
        else:
            $this->status = 404;
        endif;
        
        $this->stop();
        return $result;
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
        $key = hash("sha256",(string)mt_rand(10, 1000));

        $stmt = $this->conn->prepare(
            "INSERT INTO ".$this->tabla."
            (
                ".$this->fields["user"].",
                ".$this->fields["pwd"].",
                ".$this->fields["hash"]."
            ) VALUES (
                :username,
                :password,
                :hash
            )
        ");

        $stmt->execute([
            'username' => $username,
            'password' => $password,
            'hash' => $key
        ]);

        if($stmt) $this->status = 200;
        else $this->status = 503;
        
        $this->stop();
        return $result; 
    }

}
?>