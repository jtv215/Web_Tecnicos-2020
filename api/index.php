<?php
require 'vendor/autoload.php';
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;


$app = new Slim\App(['settings' => ['displayErrorDetails' => true]]);

require_once "cors.php";
require_once "src/routes/routes.php";


$app->run();