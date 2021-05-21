<?php
  include_once '../../php/conexion.php';
  $conexion = new Conexion();

  $solicitud = $_POST['id_contrato'];
  $inspeccion = $_FILES['inspeccion']['name'];

  $querys = $conexion -> connect() -> prepare("SELECT * FROM contratacion WHERE id_contratacion = ?");
  $querys -> bindValue(1, $solicitud);
  $querys -> execute();

  $row = $querys -> fetch();
  $correo = $row['correo'];

  $ruta_solicitud = '../../solicitudes/';
  $ruta_solicitud_usuario = $ruta_solicitud . $correo . "/";

  if(!file_exists($ruta_solicitud)){
    mkdir($ruta_solicitud, 0777, true);
  }
  if(!file_exists($ruta_solicitud_usuario)){
    mkdir($ruta_solicitud_usuario, 0777, true);
  }

  move_uploaded_file($_FILES['inspeccion']['tmp_name'], $ruta_solicitud_usuario . $inspeccion);

  $query = $conexion -> connect() -> prepare("UPDATE contratacion SET estado = 1, inspeccion = ? WHERE id_contratacion = ?");
  $query -> bindValue(1, $inspeccion);
  $query -> bindValue(2, $solicitud);
  echo $query -> execute();
?>