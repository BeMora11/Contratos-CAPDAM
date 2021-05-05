<?php
  date_default_timezone_set("America/Mexico_City");


  class Conexion {
    function connect(){
      try{
        $conexion = "mysql:host=localhost; dbname=contratos; charset=utf8mb4";
        return $pdo = new PDO($conexion, "root", "");
      } catch (PDOException $err){
        print_r($err->getMessage());
      }
    }
  }
?>