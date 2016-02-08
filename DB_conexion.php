<?php

$host="localhost";
$user="root";
$password="";
$base= "";

try {
	$conexionBD = new PDO('mysql:host='.$host.';dbname='.$base.'', $user, $password);
	$conexionBD->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch (Exception $e) {
	die('Se ha producido un error: '.$e->getMessage());
}

define("GOOGLE_API_KEY", "GOOGLE_API_KEY");

?>