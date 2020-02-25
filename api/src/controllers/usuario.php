<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

require_once 'conexion.php';

//* Mostrar un solo usuario por token *//  oK
$getUsuarioToken= "";
$app->get('/usuario/token/{token}', function (Request $request, Response $response) {
    $token = $request->getAttribute('token');

    $sql = "SELECT * FROM usuario WHERE token = '" . $token . "' ";
    $stmt = executeQuery($sql);
        
    $messageError = 'No hay ninguna usuario con ese ID en la base de datos';
    return responseObject($response, $stmt, $messageError);
});

//* Mostrar todos los usuarios *//  oK
$getAllUsuario = "";
$app->get('/usuario', function (Request $request, Response $response) {
    $sql = "SELECT * FROM usuario";
    $stmt = executeQuery($sql);

    $messageError = 'No hay ninguna empresa en la base de datos';
    return responseObject($response, $stmt, $messageError);
});

//* Mostrar un solo usuario por ID *//  oK
$getUsuarioID = "";
$app->get('/usuario/{idUsario}', function (Request $request, Response $response) {
    $idUsuario = $request->getAttribute('idUsario');

    $sql = "SELECT * FROM usuario WHERE id = '" . $idUsuario . "' ";
    $stmt = executeQuery($sql);
    
    $messageError = 'No hay ninguna usuario con ese ID en la base de datos';
    return responseObject($response, $stmt, $messageError); 
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


//* Actualizar usario con un Id de usuario *//   ok
$updateUsuario = "";
$app->put('/usuario/{idUsuario}', function (Request $request, Response $response) {
    $idUsuario = $request->getAttribute('idUsuario');
    $data = $request->getParsedBody();
    $nombre = $data['nombre'];
    $password = $data['password'];

    $sql = "UPDATE usuario SET nombre = '" . $nombre . "', password = '" . $password . "' where id = '" . $idUsuario . "' ";
    $stmt = executeQuery($sql);

    $messageError = 'No ha habido cambios por parte del usuario';
    $messageSuccess = 'Los datos del usuario se han actualizado correctamente';
    return responseMessage($response, $stmt, $messageError, $messageSuccess);
});


//* Borrar usuario con un Id de usuario*//   ok
$deleteUsuario = "";
$app->delete('/usuario/{idUsario}', function (Request $request, Response $response) {
    $idUsuario = $request->getAttribute('idUsario');

    $sql = "DELETE FROM usuario WHERE id = '" . $idUsuario . "' ";
    $stmt = executeQuery($sql);

    $messageError = 'No hay ningún usuario con ese id';
    $messageSuccess = 'El usuario se ha eliminado correctamente';
    return responseMessage($response, $stmt, $messageError, $messageSuccess);
});