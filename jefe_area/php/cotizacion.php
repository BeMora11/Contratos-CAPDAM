<?php
  include_once '../../php/conexion.php';
  $conexion = new Conexion();

  $id_contrato = $_POST['id_contrato'];
  $cotizacion = $_FILES['cotizacion']['name'];
  $fecha = date('Y-m-d H:i:s');
  $estado = 0;

  $actualizar = $conexion -> connect() -> prepare("UPDATE contratacion SET estado = 2 WHERE id_contratacion = ?");
  $actualizar -> bindValue(1, $id_contrato);
  $actualizar -> execute();

  $ruta_cotizaciones = '../../cotizaciones/';
  $ruta_cotizacion_contrato = $ruta_cotizaciones.$id_contrato.'/';
  
  if(!file_exists($ruta_cotizacion_contrato)){
    mkdir($ruta_cotizacion_contrato, 0777, true);
  }

  move_uploaded_file($_FILES['cotizacion']['tmp_name'], $ruta_cotizacion_contrato.$cotizacion);

  $query = $conexion -> connect() -> prepare("INSERT INTO cotizaciones(contrato, cotizacion, fecha_cotizado, estatus_cotizacion) VALUES(?, ?, ?, ?)");
  $query -> bindValue(1, $id_contrato);
  $query -> bindValue(2, $cotizacion);
  $query -> bindValue(3, $fecha);
  $query -> bindValue(4, $estado);
  echo $query -> execute();
?>