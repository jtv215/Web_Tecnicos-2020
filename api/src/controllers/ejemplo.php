<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;


$app->get('/prueba', function ($request, $response, $args) {
    header("token:"."123456");
    $prueba = "funciona API";
   
    return  json_encode($prueba);
});

$app->get('/hello/{name}', function ($request, $response, $args) {
    $response->write("Hello, " . $args['name']);
    return $response;
});

