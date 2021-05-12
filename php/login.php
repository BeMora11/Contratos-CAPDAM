<?php
  session_start();

  include_once 'conexion.php';
  $conexion = new Conexion();

  $correo = $_POST['correo'];
  $password = sha1($_POST['password']);

  $query = $conexion -> connect() -> prepare("SELECT * FROM usuarios WHERE correo = ?");
  $query -> bindValue(1, $correo);
  if($query -> execute()){
    $row = $query -> fetch();
    $hash = $row['password'];

    if($hash == $password){
      switch($row['rol']){
        case 0: 
          $_SESSION['correo'] = $row['correo'];
          header("Location: ../admin/");
        break;
        case 1: 
            $_SESSION['correo'] = $row['correo'];
            header("Location: ../jefe_area/");
          break;
        case 2: 
            $_SESSION['correo'] = $row['correo'];
            header("Location: ../recepcionista/");
          break;
      }
    } else {
      header("Location: ../index.php");
    }
  }
?>