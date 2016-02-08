<?php

include('DB_conexion.php');

echo '<link href="css/estilos.css" rel="stylesheet" type="text/css">';

if ($conexionBD) {

	$consulta = 'SELECT * FROM reg_users';
	$datos = $conexionBD->query($consulta);
	if ($datos->rowCount() < 1) echo "<h1 style='color:white; margin-top: 100px;'>No se han encontrado dispositivos</h1>";
	else {
		echo "<div id='listado'>";
		echo "<br><h2>DISPOSITIVOS REGISTRADOS</h2> ";
		echo "__________________________________________";

		while ($fila = $datos->fetch()) {
			echo "<br><br>";
			echo "Imei: " . $fila['imei'] . "<br>";
			echo "Registration token: " . $fila['reg_token'] . "<br>";
			echo "User ID: " . $fila['user_id'] . "<br>";
			echo "Fecha registro: " . $fila['date_reg'] ;
			echo "<a href='desregistrar.php?imei=" . $fila['imei'] . "'><button id='btnBorrar'>Borrar</button></a><br>";
			echo "__________________________________________";
		}
		echo "</div>";
	}
}

?>