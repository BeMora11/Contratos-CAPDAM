<?php
  include_once '../../php/conexion.php';
  $conexion = new Conexion();

  $solicitud = $_POST['id'];

  $query = $conexion -> connect() -> prepare("UPDATE contratacion SET estado = 1 WHERE id_contratacion = ?");
  $query -> bindValue(1, $solicitud);
  echo $query -> execute();
?>