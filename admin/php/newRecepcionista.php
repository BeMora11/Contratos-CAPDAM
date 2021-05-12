<?php
 include_once '../../php/conexion.php';
 $conexion = new Conexion();

 $correo = $_POST['correo'];
 $password = sha1($_POST['password']);
 $rol = 2;

 $query = $conexion -> connect() -> prepare("INSERT INTO usuarios(correo, password, rol) VALUES(?, ?, ?)");
 $query -> bindValue(1, $correo);
 $query -> bindValue(2, $password);
 $query -> bindValue(3, $rol);
 echo $query -> execute();
?>