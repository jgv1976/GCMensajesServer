<?php
include('DB_conexion.php');
$method = $_SERVER['REQUEST_METHOD'];
$imei = $_REQUEST['imei'];

//Eliminamos el dispositivo basándonos en el imi
$consultaToken = "SELECT * FROM reg_users WHERE imei = '$imei'";
$consulta = "DELETE FROM reg_users WHERE imei='$imei'";

$estaRegistrado = $conexionBD->query($consultaToken);
if($estaRegistrado->rowCount() < 1) {
	switch ($method) {
		case 'GET':
			echo "<p>El dispositivo con imei: $imei NO esta registrado</p>";
			echo "<a href='listarTodos.php'><button>Volver</button></a>";
			break;
		case 'POST':
			echo "NOREGISTRADO";
			break;
	}
}else {
	switch ($method) {
		case 'GET':
			if($conexionBD->query($consulta)) echo "<p>Se ha eliminado el dispositivo con imei = " . $imei . " de la base de datos";
			else echo "No se ha podido eliminar el dispositivo de la base de datos";
			echo "<br><a href='listarTodos.php'><button>Volver</button></a>";
			break;
		case 'POST':
			if ($conexionBD->query($consulta)) echo "OK";
			else echo "ERROR";
			break;
	}
}

?>