<?php
 include_once '../../php/conexion.php';
 $conexion = new Conexion();


  $id = $_POST['id'];
 $correo = $_POST['correo'];
 $password = sha1($_POST['password']);
 if(isset($_POST['delegacion'])){
   $delegacion = $_POST['delegacion'];
 } else {
   $delegacion = null;
 }

 $query = $conexion -> connect() -> prepare("UPDATE usuarios SET correo = ?, password = ?, delegacion = ? WHERE id_usuario = ?");
 $query -> bindValue(1, $correo);
 $query -> bindValue(2, $password);
 $query -> bindValue(3, $delegacion);
 $query -> bindValue(4, $id);
 echo $query -> execute();
?>