<?php

    Class InterfazControlador {

        private $controlador;
        private $accion;
        private $ruta;

        public function __construct(){
            
            if(isset($_GET["c"])):
                $this->controlador = $_GET["c"];
            else:
                $this->controlador = false;
            endif;
            
            if(isset($_GET["a"])):
                $this->accion = $_GET["a"];
            else:
                $this->accion = false;
            endif;

            if(!isset($_SESSION["usuario"])):
                if($this->controlador && $this->accion):
                    if($this->controlador != "Usuario"):
                        header("Location: usuario.php?c=Usuario&a=Ingresar");
                    endif;
                else:
                    header("Location: usuario.php?c=Usuario&a=Ingresar");
                endif;
            else:
                $usuario = new UsuarioControlador();
                if($usuario->check()):
                    header("Location: usuario.php?c=Usuario&a=Ingresar");
                endif;
                if($this->controlador && $this->accion):
                    if($this->controlador != "Producto"):
                        header("Location: producto.php?c=Producto&a=Lista");
                    endif;
                else:
                    header("Location: producto.php?c=Producto&a=Lista");
                endif;
            endif;

        }

        public function getControlador(){
            return $this->controlador;
        }

        public function getAccion(){
            return $this->accion;
        }

        public function setControlador($controlador){
            $this->controlador = $controlador;
        
        }
        public function setAccion($accion){
            $this->accion = $accion;
        }

        public function render(){
            if($this->controlador && $this->accion):
                $ruta = "./vistas/".$this->controlador."/".$this->accion.".php";
                if(file_exists($ruta)):
                    return $ruta;
                else:
                    return "./vistas/Usuario/Ingresar.php";
                endif;
            endif;
        }

    }

?>