<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

function response($response, $message)
{
    $response = array(
        'status' => 'Success',
        'code' => 200,
        'data' => $message
    );
    return json_encode($response);
}

function errorResponse($response, $message)
{
    $response = array(
        'status' => 'ERROR',
        'code' => 404,
        'data' => $message
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
