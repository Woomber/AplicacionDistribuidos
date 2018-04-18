<?php

    @session_start();

    if(!isset($_SESSION["usuario"])):
        header("Location: login.php");
    endif;

    $con =  new mysqli("localhost", "root", "", "coco");
    $key = $_SESSION["hash"];
    $result = $con->query("SELECT * FROM usuarios WHERE hash = '$key'");
    $con->close();
    if($result->num_rows == 0):
        header('Location: error.php');
    endif;

?>