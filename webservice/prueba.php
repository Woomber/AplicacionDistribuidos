<?php 
require_once "nusoap/lib/nusoap.php";

$client = new SoapClient("http://localhost/AplicacionDistribuidos/webservice/metodos.php?wsdl", "wsdl");

$client->soap_defencoding = 'UTF-8';

$result = $client->call("EliminarProducto", array(
"id" => "32",
"usuario" => "yael2"
    
    
));
echo $client->getError();
echo $result;

?>