<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;


function executeQuery($sql)
{
    $db = conexion();
    $stmt = $db->prepare($sql);
    $stmt->execute();
    // Cerrar conexiones
    $db = null;
 
    return  $stmt;
}

//Devuelve un objeto de la base de datos: usado en get
function responseObject($response, $stmt, $messageError)
{   
    $count = $stmt->rowCount();
    if ($count == 0) {
        return errorResponse($response, $messageError);
    } else {              
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return  response($response, $data);    

    }
}

//Devuelve un mensaje de éxito, usado en post, put, delete
function responseMessage($response, $stmt, $messageError,$messageSuccess)
{
    $count = $stmt->rowCount();
    if ($count == 0) {
        return errorResponse($response, $messageError);     
    } else {
        return  response($response, $messageSuccess);    
    }
}

function errorResponse($response, $messageError)
{
    $response = array(
        'status' => 'ERROR',
        'code' => 404,
        'data' => $messageError
    );
    
  
    return json_encode($response);
}


function response($response, $messageSuccess)
{
    $response = array(
        'status' => 'Success',
        'code' => 200,
        'data' => $messageSuccess
    );
    return json_encode($response);
}



function execptionResponse($response, $message, $execption)
{
    $response = array(
        'status' => 'ERROR',
        'code' => 404,
        'data' => $message,
        'exception' => $execption,
    );
    return json_encode($response);
}


