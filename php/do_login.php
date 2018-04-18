<?php
	require("controllers/Login.php");
	@session_start();
	$_SESSION = array();
	@session_destroy();
	if(@isset($_POST["usuario"])){
		$log = new Login();
		$usr = $_POST["usuario"];
		$pwd = $_POST["pass"];
		if($log->checkLogin($usr, $pwd)){
			@session_start();
			$_SESSION["usuario"] = $usr;
			$_SESSION["hash"] = $log->key;
			header('Location: productos.php');
		}
    }
?>