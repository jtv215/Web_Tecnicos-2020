<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

require_once 'conexion.php';

//* Muestra todos los telefonos *//   ok
$app->get('/telefono', function (Request $request, Response $response) {

    $db = conexion();
    $sql = "SELECT * FROM telefono";
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $count = $stmt->rowCount();

    if (!$stmt) {
        return 'Error al ejecutar la consulta';
    } else {
        if ($count == 0) {
            $response = array(
                'status' => 'ERROR',
                'code' => 404,
                "data" => "No hay ningun telefono en la base de datos"
            );
            return json_encode($response);
        } else {
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $response = array(
                'status' => 'success',
                'code' => 200,
                "data" => $data
            );
            return json_encode($response);
        }
    }
});


//* Muestra todos los telefonos que tiene la empresa con dicho ID *//  ok
$app->get('/telefono/{idEmpresa}', function (Request $request, Response $response) {

    $idEmpresa = $request->getAttribute('idEmpresa');

    $data = getTelefono($idEmpresa);

    if ($data == 'NoExisteElID') {
        $response = array(
            'status' => 'ERROR',
            'code' => 404,
            'data' => 'No hay ningún id con esa esa empresa'
        );
        return json_encode($response);
    } else {
        $response = array(
            'status' => 'Success',
            'code' => 200,
            'data' => $data
        );
        return json_encode($response);
    }
});


//* Actualizar telefono con un Id del telefono *//   ok
$app->post('/telefono/{idTelefono}/{telefono}', function (Request $request, Response $response, array $args) {

    $idTelefono = $request->getAttribute('idTelefono');
    $telefono = $request->getAttribute('telefono');

    $db = conexion();
    $sql = "UPDATE telefono SET telefono = '" . $telefono . "' where idTelefono = '" . $idTelefono . "' ";
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $count = $stmt->rowCount();

    if (!$stmt) {
        return 'Error al ejecutar la consulta';
    } else {
        if ($count == 0) {
            $response = array(
                'status' => 'ERROR',
                'code' => 404,
                'data' => 'No hay ningún telefono con ese id'
            );
            return json_encode($response);
        } else {
            $response = array(
                'status' => 'Success',
                'code' => 200,
                'data' => 'Se ha actualizado el telefono correctamente'
            );
            return json_encode($response);
        }
    }
});

//* Borrar telefono con un Id del telefono*//   ok
$app->delete('/telefono/{idTelefono}', function (Request $request, Response $response) {
    $idTelefono = $request->getAttribute('idTelefono');

    $db = conexion();
    $sql = "DELETE FROM telefono WHERE idTelefono = '" . $idTelefono . "' ";
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $count = $stmt->rowCount();

    if (!$stmt) {
        return 'Error al ejecutar la consulta';
    } else {
        if ($count == 0) {
            $response = array(
                'status' => 'ERROR',
                'code' => 404,
                'data' => 'No hay ningún telefono con ese id'
            );
            return json_encode($response);
        } else {

            $response = array(
                'status' => 'Success',
                'code' => 200,
                'data' => 'Se ha eliminado la localidad y el telefono correctamente'
            );
            return json_encode($response);
        }
    }
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
            $response = array(
                'status' => 'Error',
                'code' => 404,
                'data' => 'La localidad y el telefono no se han añadido'
            );
            return json_encode($response);
        } else {
            $response = array(
                'status' => 'Success',
                'code' => 200,
                'data' => 'Se ha añadido correctamente la localidad o el telefono'
            );
            return json_encode($response);
        }
    } else {  //Ya existe localidad y telefono        
        $response = array(
            'status' => 'Error',
            'code' => 404,
            'data' => 'Ya existe la localidad y el telefono'
        );
        return json_encode($response);
    }
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
