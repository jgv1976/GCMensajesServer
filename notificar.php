<?php

//Conexión a la base de datos
include('DB_conexion.php');

$apiKey = "AIzaSyB_fewtf7jNsLPS4lOc3tItFDiIrvDjjhw";
$source="com.miappgcm.gcmensajes";
$service="gcm";

if ( $_POST['mensaje'] != "") {
  $message =$_POST['mensaje'];
  $orden =$_POST['funcion'];
  $identificador = $_POST['iddevice'];
  if (is_null($identificador)) $identificador = '-- SERVIDOR CENTRAL --';

  $consulta = 'SELECT * FROM reg_users';
  $datos = $conexionBD->query($consulta);

  echo "____________________________________________________________________________________________<br><br>";

  while($fila = $datos -> fetch()) {

     //Recuperamos el token de registro del dispositivo en GCM
     $deviceToken = $fila['reg_token'];

    //IMPORTANTE: Array con la información que enviará la notificación.
     $data = array(
         'registration_id' => $deviceToken,
         'collapse_key' => 'ck_'.'col_key',
         'data.mensaje' => $message,
         'data.funcion' => $orden,
         'data.identDevice' => $identificador,
         'data.titulo' =>'Mensaje de GCM'
     );
     //Fin array mensaje

     //Código para conectar con GCM y enviar notificación. No modificar.
     $headers = array('Authorization:key=' . $apiKey);
     $ch = curl_init();
     curl_setopt($ch, CURLOPT_URL, "https://android.googleapis.com/gcm/send");
     curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
     curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
     curl_setopt($ch, CURLOPT_POST, true);
     curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
     curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
     $resultado = curl_exec($ch);
     curl_close($ch);

     echo "ApiKey: " . $apiKey;
     echo "Mensaje enviado al dispositivo: " . $deviceToken;
     echo "<br>Mensaje: " . $message;
     echo "<br><br><br>____________________________________________________________________________________________<br><br>";

 };

 /*$url="notificar.html";
 echo "<SCRIPT>window.location='$url';</SCRIPT>";*/
}


?>