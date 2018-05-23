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

        public function ingresarUsuario($usuario, $password){

            if(true):
                
                $this->start();
                
                if(empty($usuario) && empty($password)):
                    return 2;
                endif;

                $username = trim($usuario);
                $password = hash("sha256", $password);
                
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
                    return array("usuario" => $username, "hash" => $key);
                else:
                    return 3;
                endif;
                
                $this->stop();
            endif;    

        }   

        public function registrarUsuario($usuario, $password){

            if(true):

                $this->start();

                if(empty($usuario) && empty($password)):
                    return 2;
                endif;

                $username = trim($usuario);
                $password = hash("sha256", $password);
                $key = hash("sha256",(string)mt_rand(10, 1000));


                $stmt = $this->pdo->prepare(
                    "SELECT * FROM " . $this->tabla . " " .
                    "WHERE " . $this->fields["user"] . " = :username"
                );

                $stmt->execute([
                    'username' => $username
                ]);

                if($stmt->rowCount() != 0):
                    return 3;
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

                
                $this->stop();
                //aquí debe ir a producto.php
                return array("usuario" => $username, "hash" => $key);
            endif;    

        }

        public function Logout(){
            //Destruir sesión y llevar al login (cliente)
            return;
        }

        public function CheckUsuario($key){

            if(isset($key)):

                $this->start();

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
                    //destruir sesión en cliente
                    return true;
                endif;

            else:
                return true;
            endif;

        }

    }

?>