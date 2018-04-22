<?php

    Class UsuarioControlador extends DBConexion {

        public $result = 1;
        private $tabla = "usuarios";
        public $key = '';
        private $fields = array(
            "user" => "username",
            "pwd"  => "password",
            "hash" => "hash"
        );

        public function __construct(){}

        public function Ingresar(){

            if($_SERVER["REQUEST_METHOD"]=="POST" && isset($_POST["usuario"]) && isset($_POST["password"])):
                
                $this->start();
                
                if(empty($_POST["usuario"]) && empty($_POST["password"])):
                    $this->result = 2;
                    return;
                endif;

                $username = trim($_POST["usuario"]);
                $password = hash("sha256", $_POST["password"]);
                
                $stmt = $this->pdo->prepare(
                    "SELECT * FROM ".$this->tabla." ".
                    "WHERE ".$this->fields["user"]." = :username AND ".$this->fields["pwd"]." = :password"
                );

                $stmt->execute([
                    'username' => $username,
                    'password' => $password 
                ]);
                    
                if($stmt->rowCount() > 0): 
                    $this->status = 200;
                    $key = hash("sha256",(string)mt_rand(10, 1000));
                    $stmt = $this->pdo->prepare("UPDATE ".$this->tabla." SET  hash = :hash WHERE ".$this->fields["user"]." = :username");
                    $stmt->execute([
                        "hash" => $key,
                        "username" => $username
                    ]);
                    $_SESSION["usuario"] = $username;
                    $_SESSION["hash"] = $key;
                    header("Location: producto.php?c=Producto&a=Lista");
                else:
                    $this->result = 3;
                    return false;
                endif;
                
                $this->stop();
            endif;    

        }   

        public function Registrar(){

            if($_SERVER["REQUEST_METHOD"]=="POST" && isset($_POST["usuario"]) && isset($_POST["password"])):

                $this->start();

                if(empty($_POST["usuario"]) && empty($_POST["password"])):
                    $this->result = 2;
                    return;
                endif;

                $username = trim($_POST["usuario"]);
                $password = hash("sha256", $_POST["password"]);
                $key = hash("sha256",(string)mt_rand(10, 1000));


                $stmt = $this->pdo->prepare(
                    "SELECT * FROM " . $this->tabla . " " .
                    "WHERE " . $this->fields["user"] . " = :username"
                );

                $stmt->execute([
                    'username' => $username
                ]);

                if($stmt->rowCount() != 0):
                    $this->result = 3;
                    return;
                endif;

                $stmt = $this->pdo->prepare(
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

                $_SESSION["usuario"] = $username;
                $_SESSION["hash"] = $key;
                
                $this->stop();
                header("Location: producto.php");
            endif;    

        }

        public function Logout(){
            session_destroy();
            header("Location: usuario.php?c=Usuario&a=Ingresar");
        }

        public function Check(){

            if(isset($_SESSION["hash"])):

                $this->start();

                $key = $_SESSION["hash"];
                $stmt = $this->pdo->prepare(
                    "SELECT * FROM " . $this->tabla . " " .
                    "WHERE " . $this->fields["hash"] . " = :key"
                );

                $stmt->execute([
                    'key' => $key
                ]);
                if($stmt->rowCount() == 1):
                    return false;
                else:
                    session_destroy();
                    return true;
                endif;

            else:
                return true;
            endif;

        }

    }

?>