<?php
require 'vendor/autoload.php';

use \Slim\App;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Tuupola\Middleware\CorsMiddleware;

$app = new Slim\App(['settings' => ['displayErrorDetails' => true]]);

require_once "cors.php";
require_once "src/routes/routes.php";

$app->run();
