<?php
  include_once '../../php/conexion.php';
  $conexion = new Conexion();

  $solicitud = $_POST['id'];

  $consulta = $conexion -> connect() -> prepare("SELECT * FROM contratacion WHERE id_contratacion = ?");
  $consulta -> bindValue(1, $solicitud);
  $consulta -> execute();
  $row = $consulta -> fetch();
  $ruta = '../../solicitudes/'.$row['correo'].'/';

  if(file_exists($ruta.$row['derecho_posesion'])){
    unlink($ruta.$row['derecho_posesion']);
  }
  if(file_exists($ruta.$row['predial'])){
    unlink($ruta.$row['predial']);
  }
  if(file_exists($ruta.$row['ine'])){
    unlink($ruta.$row['ine']);
  }
  if(file_exists($ruta.$row['curp'])){
    unlink($ruta.$row['curp']);
  }
  if($row['vocacion_uso'] != null){
    unlink($ruta.$row['vocacion_uso']);
  }
  if(file_exists($ruta.$row['fachada'])){
    unlink($ruta.$row['fachada']);
  }

  rmdir($ruta);

  // $destinatario = 'CAPDAM';
  // $correo = $row['correo'];
  // $nombre = $row['nombre'] . " " . $row['apellidos'];
  // $asunto = 'Solicitud de contratación de agua y drenaje';
  // $mensaje = 'Su solicitud ha sido rechazada debido a que los documentos proporcionados no son correctos.';

  // $header = 'Cabecera';

  // if(mail($destinatario, $asunto, $mensaje, $header)){
  //   echo 1;
  // } else {
  //   echo 0;
  // }


  $query = $conexion -> connect() -> prepare("DELETE FROM contratacion WHERE id_contratacion = ?");
  $query -> bindValue(1, $solicitud);
  echo $query -> execute();
?>