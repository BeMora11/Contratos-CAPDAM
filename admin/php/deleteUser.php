<?php
 include_once '../../php/conexion.php';
 $conexion = new Conexion();

 $id = $_POST['id'];

 $query = $conexion -> connect() -> prepare("DELETE FROM usuarios WHERE id_usuario = ?");
 $query -> bindValue(1, $id);
 echo $query -> execute();
?>