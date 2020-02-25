<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

require_once 'src/functions/functions.php';
require_once 'conexion.php';


//* Mostrar todas las empresas con dicho filtro *//  oK
$getFilterEmpresa = "";
$app->post('/empresa/filtro', function (Request $request, Response $response) {

    $data = $request->getParsedBody();
    $provincia = $data['provincia'];
    $especialidad = $data['especialidad'];
    $contratado = $data['contratado'];

    $sql = "SELECT idEmpresa, provincia, nombreEmpresa, especialidad, contratado FROM empresa
    where provincia = '" . $provincia . "' && especialidad = '" . $especialidad . "' &&
    contratado = '" . $contratado . "' ";
    $stmt = executeQuery($sql);

    $messageError = 'No hay ninguna empresa con ese filtro en la base de datos';
    return responseObject($response, $stmt, $messageError);
});

//* Mostrar todas las provincias *//  oK
$getAllprovincia = "";
$app->get('/empresa/provincia', function (Request $request, Response $response) {

    $sql = "SELECT  distinct provincia from empresa Order by provincia asc";
    $stmt = executeQuery($sql);
    $count = $stmt->rowCount();

    if ($count == 0) {
        $message = "No hay ninguna provincia en la base de datos";
        return errorResponse($response, $message);
    } else {
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $data2 = array();
        foreach ($data as $value) {
            array_push($data2, $value['provincia']);
        }
        return response($response, $data2);
    }
});

//* Mostrar todas las empresas, (localidades y telefonos) *//  oK
$getAllEmpresadatosmin = "";
$app->get('/empresa/datosmin', function (Request $request, Response $response) {

    $sql = "SELECT idEmpresa, provincia, nombreEmpresa, especialidad, contratado FROM empresa";
    $stmt = executeQuery($sql);

    $messageError = 'No hay ninguna empresa en la base de datos';
    return responseObject($response, $stmt, $messageError);

    
});



