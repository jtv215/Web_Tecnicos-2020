<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Http\Message;

require_once 'conexion.php';

//* Muestra todos los mensaje *// ok
$getAllMensaje = "";
$app->get('/mensaje', function (Request $request, Response $response) {

    $sql = "SELECT * FROM mensaje";
    $stmt = executeQuery($sql);
    
    $messageError = 'No hay ningun mensaje en la base de datos';
    return responseObject($response, $stmt, $messageError);
  
});

//* Muestra todos los mensaje con el id del una empresa *//  ok
$getMensajeID = "";
$app->get('/mensaje/{idEmpresa}', function (Request $request, Response $response) {
    $idEmpresa = $request->getAttribute('idEmpresa');
    
    $sql = "SELECT * FROM mensaje WHERE idEmpresa = '" . $idEmpresa . "' ";
    $stmt = executeQuery($sql);

    $messageError = 'No hay mensaje con ese id de empresa';
    return responseObject($response, $stmt, $messageError);
});


//* Añadir mensaje  *//   ok
$addMensaje= "";
$app->post('/mensaje', function (Request $request, Response $response, array $args) {

    $data = $request->getParsedBody();
    $idEmpresa = $data['idEmpresa'];
    $fechaHora = $data['fechaHora'];
    $mensaje = $data['mensaje'];
    $encargadoLlamar = $data['encargadoLlamar'];

    $sql = "INSERT INTO mensaje (idEmpresa, fechaHora, mensaje, encargadoLlamar) 
    values ('" . $idEmpresa . "', '" . $fechaHora . "', '" . $mensaje . "', '" . $encargadoLlamar . "')";
    $stmt = executeQuery($sql);

    $messageError = 'No se ha podido añadir el mensaje';
    $messageSuccess = 'Se ha añadido el mensaje correctamente';
    return responseMessage($response, $stmt, $messageError, $messageSuccess);
});


//* Actualizar empresa *//   ok
$updateMensaje= "";
$app->put('/mensaje', function (Request $request, Response $response, array $args) {

    $data = $request->getParsedBody();
    $idMensaje = $data['idMensaje'];
    $fechaHora = $data['fechaHora'];
    $mensaje = $data['mensaje'];
    $encargadoLlamar = $data['encargadoLlamar'];

    $sql = "UPDATE mensaje SET 
    fechaHora = '" . $fechaHora . "',
    mensaje = '" . $mensaje . "', encargadoLlamar = '" . $encargadoLlamar . "'
    where idMensaje = '" . $idMensaje . "' ";
    $stmt = executeQuery($sql);

    $messageError = 'No se ha encontrado el ID del mesnaje o no se ha modificado nada';
    $messageSuccess = 'Se ha actualizado el mensaje correctamente';
    return responseMessage($response, $stmt, $messageError, $messageSuccess);

   
});


//* Borrar un solo mesnaje con el idMensaje *//  ok
$app->delete('/mensaje', function (Request $request, Response $response) {

    $data = $request->getParsedBody();
    $idMensaje = $data['idMensaje'];

    $sql = "DELETE FROM mensaje WHERE idMensaje = '" . $idMensaje . "' ";
    $stmt = executeQuery($sql);

    $messageError = 'No hay ninguna mensaje con ese id';
    $messageSuccess = 'Se ha eliminado el mensaje correctamente';
    return responseMessage($response, $stmt, $messageError, $messageSuccess);
});
