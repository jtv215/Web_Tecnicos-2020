<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
require 'vendor/autoload.php';
require_once "enableHeader.php";

//Ayuda cuando ocurre algun error que slim lo muestre por pantalla 
$config = [
    "settings" => ["displayErrorDetails" => true ]];


$app = new \Slim\App($config);

require_once "src/routes/routes.php";
$app->options('/{routes:.+}', function ($request, $response, $args) {
    return $response;
});





$app->run();

