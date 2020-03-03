<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

function conexion() {
    $dbhost="localhost";
    $dbname="id12793341_bd_lineablanca";
    $dbuser="id12793341_bd_lineablanca";
    $dbpass="rootroot";
    /*
    $dbuser="root";
    $dbpass="root";
    $dbname="bd_lineablanca"; 
    */
    //$dbname="bd_prueba"; 

    try {
        $conexion = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);      
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return  $conexion;

    }catch(PDOException $e){
      return "La conexión ha fallado: " . $e->getMessage();
    }

}