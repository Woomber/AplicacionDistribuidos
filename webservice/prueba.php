<?php 
require_once "nusoap/lib/nusoap.php";

$client = new SoapClient("http://localhost/AplicacionDistribuidos/webservice/metodos.php?wsdl", "wsdl");

$client->soap_defencoding = 'UTF-8';

$result = $client->call("ModificarProducto", array(
"id" => "31",
"nombre" => "Yael",
"existencia" => "12",
"precio" => "3",
"usuario" => "yael2"
    
    
));
echo $client->getError();
echo $result;

?>