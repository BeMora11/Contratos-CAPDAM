<?php
  include_once '../../php/conexion.php';
  $conexion = new Conexion();

  $id_cotizacion = $_POST['id'];

  $query = $conexion -> connect() -> prepare("UPDATE cotizaciones SET estatus_cotizacion = 1 WHERE id_cotizacion = ?");
  $query -> bindValue(1, $id_cotizacion);
  echo $query -> execute();
?>