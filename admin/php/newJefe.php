<?php
 include_once '../../php/conexion.php';
 $conexion = new Conexion();

 $correo = $_POST['correo'];
 $password = sha1($_POST['password']);
 $rol = 1;
 $delegacion = $_POST['delegacion'];

 $query = $conexion -> connect() -> prepare("INSERT INTO usuarios(correo, password, rol, delegacion) VALUES(?, ?, ?, ?)");
 $query -> bindValue(1, $correo);
 $query -> bindValue(2, $password);
 $query -> bindValue(3, $rol);
 $query -> bindValue(4, $delegacion);
 echo $query -> execute();
?>