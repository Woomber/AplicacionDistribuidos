<?php

    @session_start();

    if(!isset($_SESSION["usuario"])):
        header("Location: login.php");
    endif;

    $conn = new PDO('mysql:host=localhost;dbname=coco;charset=utf8', 'root', '');
    $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
    $key = $_SESSION["hash"];
    $stmt = $conn->prepare("SELECT * FROM usuarios WHERE hash = :keyhash ");
    $stmt->execute([
        'keyhash' => $key
    ]);
    $result = $stmt->rowCount();
    if($result == 0):
        header('Location: error.php');
    endif;

?>