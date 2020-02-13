<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;


require_once 'conexion.php';


//* Mostrar todos los usuarios *//  oK
$getUsuario= "aa";
$app->get('/usuario', function (Request $request, Response $response) {

    $db = conexion();
    $sql = "SELECT * FROM usuario";
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $count = $stmt->rowCount(); //Devuelve el nº de filas.

    if (!$stmt) {
        return 'Error al ejecutar la consulta';
    } else {

        if ($count == 0) {
            $response = array(
                'status' => 'ERROR',
                'code' => 404,
                "data" => "No hay ninguna empresa en la base de datos"
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

//* Añadir usuario *//
$añadirUsuario= "aa";
$app->post('/usuario', function (Request $request, Response $response) {
    $data = $request->getParsedBody();

    $nombre = $data['nombre'];
    $email = $data['email'];
    $password = $data['password'];
    $token = $data['token'];


    $db = conexion();
    $sql = "INSERT INTO usuario (nombre, email, password, token) 
    VALUES ('" . $nombre . "', '" . $email . "', '" . $password . "', '" . $token . "')";

    $stmt = $db->prepare($sql);
    try {
        $stmt->execute();
    } catch (Exception  $e) {

        $response = array(
            'status' => 'Error',
            'code' => 404,
            'Exception' => $e,
        );
        return json_encode($response);
    }

    $count = $stmt->rowCount();
    if ($count) {
        $response = array(
            'status' => 'Success',
            'code' => 200,
            'data' => 'Se ha añadido correctamente el usuario'
        );
        return json_encode($response);
    }
});


//* Borrar usuario con un Id de usuario*//   ok
$app->delete('/usuario/{idUsario}', function (Request $request, Response $response) {
    $idUsuario = $request->getAttribute('idUsario');

    $db = conexion();
    $sql = "DELETE FROM usuario WHERE id = '" . $idUsuario . "' ";
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
                'data' => 'No hay ningún usuario con ese id'
            );
            return json_encode($response);
        } else {
            $response = array(
                'status' => 'Success',
                'code' => 200,
                'data' => 'Se ha eliminado el usuario correctamente'
            );
            return json_encode($response);
        }
    }
});

//* Actualizar usario con un Id de usuario *//   ok
$app->put('/usuario/{idUsuario}', function (Request $request, Response $response) {
    $idUsuario = $request->getAttribute('idUsuario');
    print $idUsuario;
    $data = $request->getParsedBody();
    $nombre = $data['nombre'];
    $password = $data['password'];

    $db = conexion();
    $sql = "UPDATE usuario SET nombre = '" . $nombre . "', password = '" . $password . "' where id = '" . $idUsuario . "' ";
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
                'data' => 'No ha habido cambios por parte del usuario'
            );
            return json_encode($response);
        } else {
            $response = array(
                'status' => 'Success',
                'code' => 200,
                'data' => 'Se ha actualizado los datos del usuario correctamente'
            );
            return json_encode($response);
        }
    }
});