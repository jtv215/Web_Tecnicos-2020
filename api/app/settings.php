<?php
declare(strict_types=1);

use DI\ContainerBuilder;
use Monolog\Logger;

return function (ContainerBuilder $containerBuilder) {
    // Global Settings Object
    $containerBuilder->addDefinitions([
        'settings' => [
            'displayErrorDetails' => true, // Should be set to false in production 
           // 'determineRouteBeforeAppMiddleware' => true,
           // 'addContentLengthHeader' => false,       
            'logger' => [
                'name' => 'slim-app',
                'path' => isset($_ENV['docker']) ? 'php://stdout' : __DIR__ . '/../logs/app.log',
                'level' => Logger::DEBUG,
            ],
            
            "jwt" => [
                'secret' => 'supersecretkeyyoushouldnotcommittogithub'
            ],

            // Database settings
            'db' => [
                'host' => 'localhost',
                'dbname' => 'bd_lineaBlanca',
                'user' => 'root',
                'pass' => 'root', 
                'charset' => 'utf8'      
            ],
        ],
    ]);

};
