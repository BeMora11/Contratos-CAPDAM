<?php
  include_once 'conexion.php';
  $conexion = new Conexion();

  $nombre = $_POST['nombre'];
  $apellidos = $_POST['apellidos'];
  $correo = $_POST['correo'];
  $telefono = $_POST['telefono'];
  $domicilio = $_POST['domicilio'];
  $posesion = $_FILES['posesion']['name'];
  $predial = $_FILES['predial']['name'];
  $ine = $_FILES['ine']['name'];
  $curp = $_FILES['curp']['name'];
  $vocacion = null;
  if(isset($_FILES['vocacion']['name'])){
    $vocacion = $_FILES['vocacion']['name'];
  }
  $fachada = $_FILES['fachada']['name'];
  $tipo_contrato = $_POST['tipo_contrato'];
  $estado = 0; //Estado 0 es cuando apenas envia la solicitud a revisión
  $fecha = date('Y-m-d H:i:s');

  $query = $conexion -> connect() -> prepare("INSERT INTO contratacion(nombre, apellidos, correo, telefono, domicilio, derecho_posesion, predial, ine, curp, vocacion_uso, fachada, tipo_contrato, estado, fecha_solicitud) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
  $query -> bindValue(1, $nombre);
  $query -> bindValue(2, $apellidos);
  $query -> bindValue(3, $correo);
  $query -> bindValue(4, $telefono);
  $query -> bindValue(5, $domicilio);
  $query -> bindValue(6, $posesion);
  $query -> bindValue(7, $predial);
  $query -> bindValue(8, $ine);
  $query -> bindValue(9, $curp);
  $query -> bindValue(10, $vocacion);
  $query -> bindValue(11, $fachada);
  $query -> bindValue(12, $tipo_contrato);
  $query -> bindValue(13, $estado);
  $query -> bindValue(14, $fecha);

  $ruta_solicitud = '../solicitudes/';
  $ruta_solicitud_usuario = $ruta_solicitud . $correo . "/";

  if(!file_exists($ruta_solicitud)){
    mkdir($ruta_solicitud, 0777, true);
  }
  if(!file_exists($ruta_solicitud_usuario)){
    mkdir($ruta_solicitud_usuario, 0777, true);
  }

  move_uploaded_file($_FILES['posesion']['tmp_name'], $ruta_solicitud_usuario . $_FILES['posesion']['name']);
  move_uploaded_file($_FILES['predial']['tmp_name'], $ruta_solicitud_usuario . $_FILES['predial']['name']);
  move_uploaded_file($_FILES['ine']['tmp_name'], $ruta_solicitud_usuario . $_FILES['ine']['name']);
  move_uploaded_file($_FILES['curp']['tmp_name'], $ruta_solicitud_usuario . $_FILES['curp']['name']);
  if($vocacion != null){
    move_uploaded_file($_FILES['vocacion']['tmp_name'], $ruta_solicitud_usuario . $_FILES['vocacion']['name']);
  }
  move_uploaded_file($_FILES['fachada']['tmp_name'], $ruta_solicitud_usuario . $_FILES['fachada']['name']);

  echo $query -> execute();
?>