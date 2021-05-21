<?php
  include_once '../../php/conexion.php';
  $conexion = new Conexion();

  $id = $_POST['id'];

  $query = $conexion -> connect() -> prepare("SELECT * FROM contratacion WHERE id_contratacion = ?");
  $query -> bindValue(1, $id);
  $query -> execute();
  $row = $query -> fetch();
  echo json_encode($row);
?>