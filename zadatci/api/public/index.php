<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;

require 'vendor/autoload.php';
require 'C:\wamp64\www\nwa\zadatci\api\src\config\db.php';

$app = new \Slim\App();

$app->get('/', function ($request, $response, $args) {
    return $response->withStatus(200)->write('Hello World!');
});

require 'C:\wamp64\www\nwa\zadatci\api\src\routes\individual.php';

$app->run();


//php -S localhost:8888 -t public public/index.php