<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

require_once 'conexion.php';

//* Muestra todos los telefonos *//   ok
$getAllTelefono = "";
$app->get('/telefono', function (Request $request, Response $response) {
    $sql = "SELECT * FROM telefono";
    $stmt = executeQuery($sql);

    $messageError = 'No hay ningun telefono en la base de datos';
    return responseObject($response, $stmt, $messageError);    
  
});

//* Muestra todos los telefonos que tiene la empresa con dicho ID *//  ok
$getTelefonoID = "";
$app->get('/telefono/{idEmpresa}', function (Request $request, Response $response) {
    $idEmpresa = $request->getAttribute('idEmpresa');

    $sql = "SELECT * FROM telefono WHERE idEmpresa = '". $idEmpresa ."' ";
    $stmt = executeQuery($sql);

    $messageError = 'No hay ningun telefono con ese id de empresa';
    return responseObject($response, $stmt, $messageError);
});

//* Añade una localidad y su telefono *//   ok
$app->POST('/telefono', function (Request $request, Response $response, array $args) {
    $data = $request->getParsedBody();

    $idEmpresa = $data['idEmpresa'];
    $localidad = strtoupper($data['localidad']); //convierte a mayúsculas
    $telefono = $data['telefono'];


    $result = compruebaLocalidadTelefono($idEmpresa, $telefono, $localidad);

    if ($result == "NoExisteLocalidad||Telefono") {

        $result2 = addLocalidadTelefono($idEmpresa, $telefono, $localidad);
        if ($result2 == false) {
            $messageError ='La localidad y el telefono no se han añadido';
            return errorResponse($response, $messageError);
       
        } else {
            $messageSuccess = 'Se ha añadido correctamente la localidad o el telefono';
            return response($response, $messageSuccess);
    
        }
    } else {  //Ya existe localidad y telefono   
        $messageError ='Ya existe la localidad y el telefono';
        return errorResponse($response, $messageError);    
      
    }
});

//* Actualizar telefono con un Id del telefono *//   ok
$updateTelefono= "";
$app->put('/telefono/{idTelefono}/{telefono}', function (Request $request, Response $response, array $args) {
    $idTelefono = $request->getAttribute('idTelefono');
    $telefono = $request->getAttribute('telefono');

    $sql = "UPDATE telefono SET telefono = '" . $telefono . "' where idTelefono = '" . $idTelefono . "' ";
    $stmt = executeQuery($sql);

    $messageError = 'No hay ningún telefono con ese id';
    $messageSuccess = 'Se ha actualizado el telefono correctamente';
    return responseMessage($response, $stmt, $messageError, $messageSuccess);
});

//* Borrar telefono con un Id del telefono*//   ok
$app->delete('/telefono/{idTelefono}', function (Request $request, Response $response) {
    $idTelefono = $request->getAttribute('idTelefono');

    $sql = "DELETE FROM telefono WHERE idTelefono = '" . $idTelefono . "' ";
    $stmt = executeQuery($sql);

    $messageError = 'No hay ningún telefono con ese id';
    $messageSuccess = 'Se ha eliminado la localidad y el telefono correctamente';
    return responseMessage($response, $stmt, $messageError, $messageSuccess);
});



//************* Funciones *************************//


//* Obtiene todas las localidadees y telefonos de la empresa con dicho ID *// OK
function getTelefono($idEmpresa)
{
    $db = conexion();
    $sql = "SELECT * FROM telefono WHERE idEmpresa = '". $idEmpresa ."' ";
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $count = $stmt->rowCount();

    if (!$stmt) {
        return 'Error al ejecutar la consulta';
    } else {
        if ($count == 0) {
            return 'NoExisteElID';
        } else {
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $data;
        }
    }
}


//* Comprueba la localidad y el telfono juntos *// OK
function compruebaLocalidadTelefono($idEmpresa, $telefono, $localidad)
{

    $db = conexion();
    $sql = "SELECT idEmpresa FROM telefono 
    WHERE telefono = '" . $telefono . "' AND localidad = '" . $localidad . "' AND idEmpresa = '" . $idEmpresa . "'";
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $count = $stmt->rowCount();

    if (!$stmt) {
        return 'Error al ejecutar la consulta';
    } else {
        if ($count == 0) {
            return 'NoExisteLocalidad||Telefono';
        } else {
            $data = $stmt->fetch(PDO::FETCH_ASSOC);
            return  $data['idEmpresa'];
        }
    }
}


//* Añade localidad y telefono *// ok
function addLocalidadTelefono($idEmpresa, $telefono, $localidad)
{
    $db = conexion();
    $sql = "INSERT INTO telefono (idEmpresa, localidad, telefono) 
    VALUES ('" . $idEmpresa . "', '" . $localidad . "', '" . $telefono . "')";
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $count = $stmt->rowCount();

    if (!$stmt) {
        return 'Error al ejecutar la consulta';
    } else {
        if ($count == 0) {
            return false;
        } else {
            return  true;
        }
    }
}
