<?php
    require_once "nusoap/lib/nusoap.php";
    $cliente = new soapclient("http://localhost/img/AplicacionDistribuidos/webservice/metodos.php?wsdl",true);
      
    $error = $cliente->getError();
    if ($error) {
        echo "<h2>Constructor error</h2><pre>" . $error . "</pre>";
    }
      
    $result = $cliente->call("hola");
      
    var_dump($result);
?>