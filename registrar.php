<?php

include('DB_conexion.php');
$method = $_SERVER['REQUEST_METHOD'];
$imei = $_REQUEST["imei"];
$token = $_REQUEST["token"];
if (isset($_REQUEST['userid'])) $userid = $_REQUEST['userid'];
else $userid = '----';
//Insertamos id de registro devuelto por el GCM.
$consultaToken = "SELECT * FROM reg_users WHERE imei = '$imei'";
$consulta = "INSERT INTO reg_users VALUES ('$imei', '$token', '$userid', CURRENT_TIMESTAMP)";
$estaRegistrado = $conexionBD->query($consultaToken);
if($estaRegistrado->rowCount() > 0) {
	switch ($method) {
		case 'POST':
			echo "<p>El dispositivo ya esta registrado</p>";
			echo "<a href='registrar.html'><button>Volver</button></a>";
			break;
		case 'GET':
			echo "REGISTRADO";
			break;
	}
}else {
	switch ($method) {
		case 'POST':
			if ($conexionBD->query($consulta)) echo "<p>Se ha realizado el registro</p>";
			else echo "<p>No se ha realizado el registro</p>";
			echo "<a href='registrar.html'><button>Volver</button></a>";
			break;
		case 'GET':
			if ($conexionBD->query($consulta)) echo "OK";
			else echo "ERROR";
			break;
	}
}
// if ($conexionBD->query($consulta)) echo "<p>Se ha realizado el registro</p>";
// else echo "<p>No se ha realizado el registro</p>";
// echo "<a href='registrar.html'><button>Volver</button></a>";

?>