 <?php
require_once "nusoap/lib/nusoap.php";
include "controladores/InterfazControlador.php";
include "controladores/LoggerControlador.php";
include "controladores/ProductoControlador.php";
include "controladores/UsuarioControlador.php";
ob_clean();

$server = new soap_server() ;
$server->configureWSDL("metodos", "urn:metodos");
 

//producto controlador
$server->register("hola",//
    array(),
    array("return" => "xsd:string"),
    "urn:metodos",
    "urn:metodos#hola",
    "rpc",
    "encoded",
    "");

$server->register("ListaProducto",//
    array(),
    array("return" => "xsd:string"),
    "urn:metodos",
    "urn:metodos#ListaProducto",
    "rpc",
    "encoded",
    "");

$server->register("EliminarProducto",
    array("id" => "xsd:int","usuario" => "xsd:int"),
    array("return" => "xsd:int"),
    "urn:metodos",
    "urn:metodos#EliminarProducto",
    "rpc",
    "encoded",
    "");

$server->register("AgregarProducto",
    array("nombre" => "xsd:string","existencia" => "xsd:int","precio" => "xsd:int","usuario" => "xsd:string"),
    array("return" => "xsd:int"),
    "urn:metodos",
    "urn:metodos#AgregarProducto",
    "rpc",
    "encoded",
    "");
$server->register("ModificarProducto",
    array("id" => "xsd:int","nombre" => "xsd:string","existencia" => "xsd:int","precio" => "xsd:int","usuario" => "xsd:string"),
    array("return" => "xsd:int"),
    "urn:metodos",
    "urn:metodos#ModificarProducto",
    "rpc",
    "encoded",
    "");

//usuario controlador
$server->register("ingresarUsuario",
    array("usuario" => "xsd:string","password" => "xsd:string"),
    array("return" => "xsd:int"),
    "urn:metodos",
    "urn:metodos#ingresarUsuario",
    "rpc",
    "encoded",
    "");
$server->register("registrarUsuario",
    array("usuario" => "xsd:string","password" => "xsd:string"),
    array("return" => "xsd:int"),
    "urn:metodos",
    "urn:metodos#registrarUsuario",
    "rpc",
    "encoded",
    "");

$server->register("CheckUsuario",
    array("key" => "xsd:string"),
    array("return" => "xsd:int"),
    "urn:metodos",
    "urn:metodos#CheckUsuario",
    "rpc",
    "encoded",
    "");

$post = file_get_contents("php://input");
$server->service($post);