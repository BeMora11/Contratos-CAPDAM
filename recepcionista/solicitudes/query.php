<?php
include_once 'conexion.php';
$conexion = new Conexion();

// $json = '{"variables":{"temp" : 12, "hum" : 5.5}}';
// $fecha = date('m-d-Y H:i:s');

// $query = $conexion -> connect() -> query("INSERT INTO mensajes(fecha, json) VALUES('$fecha', '$json')");
// echo $query -> execute();

$query = $conexion->connect()->query("SELECT JSON_EXTRACT(data, '$.temperatura') AS temp, JSON_EXTRACT(data, '$.humedad') AS hum, fecha FROM variables");
$query->execute();

echo $row = json_encode($query->fetchAll());

?>