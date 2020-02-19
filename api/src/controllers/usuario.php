<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
require_once 'conexion.php';


//* Mostrar todos los usuarios *//  oK
$getAllUsuario = "";
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
            $message = 'No hay ninguna empresa en la base de datos';
            return errorResponse($response, $message);
        } else {
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return response($response, $data);
        }
    }
});

//* Mostrar un solo usuario por ID *//  oK
$getUsuarioID = "";
$app->get('/usuario/{idUsario}', function (Request $request, Response $response) {
    $idUsuario = $request->getAttribute('idUsario');


    $db = conexion();
    $sql = "SELECT * FROM usuario WHERE id = '" . $idUsuario . "' ";
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $count = $stmt->rowCount(); //Devuelve el nº de filas.

    if (!$stmt) {
        return 'Error al ejecutar la consulta';
    } else {

        if ($count == 0) {
            $message = 'No hay ninguna usuario con ese ID en la base de datos';
            return errorResponse($response, $message);
        } else {
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return response($response, $data);
        }
    }
});

//* Añadir usuario *//
$addUsuario = "";
$app->post('/usuario', function (Request $request, Response $response) {
    $data = $request->getParsedBody();

    $nombre = "";
    $email = $data['email'];
    $password = $data['password'];
    $token = "";


    $db = conexion();
    $sql = "INSERT INTO usuario (nombre, email, password, token) 
    VALUES ('" . $nombre . "', '" . $email . "', '" . $password . "', '" . $token . "')";

    $stmt = $db->prepare($sql);
    try {
        $stmt->execute();
    } catch (Exception  $e) {
        $message = 'Correo ya existe o campo vacio';
        return execptionResponse($response, $message, $e);
    }
    $count = $stmt->rowCount();
    if ($count) {
        $message = 'El usuario se ha añadido correctamente';
        return response($response, $message);
    }
});


//* Borrar usuario con un Id de usuario*//   ok
$deleteUsuario = "";
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
            $message = 'No hay ningún usuario con ese id';
            return errorResponse($response, $message);
        } else {
            $message = 'El usuario se ha eliminado correctamente';
            return response($response, $message);
        }
    }
});

//* Actualizar usario con un Id de usuario *//   ok
$updateUsuario = "";
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
            $message = 'No ha habido cambios por parte del usuario';
            return errorResponse($response, $message);
        } else {
            $message = 'Los datos del usuario se han actualizado correctamente';
            return response($response, $message);
        }
    }
});


//* Mostrar un solo usuario por ID *//  oK
$getUsuarioID = "";
$app->get('/usuario/token/{token}', function (Request $request, Response $response) {
    $token = $request->getAttribute('token');


    $db = conexion();
    $sql = "SELECT * FROM usuario WHERE token = '" . $token . "' ";
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $count = $stmt->rowCount(); //Devuelve el nº de filas.

    if (!$stmt) {
        return 'Error al ejecutar la consulta';
    } else {

        if ($count == 0) {
            $message = 'No hay ninguna usuario con ese ID en la base de datos';
            return errorResponse($response, $message);
        } else {
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return response($response, $data);
        }
    }
});