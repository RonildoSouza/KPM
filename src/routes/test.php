<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

$app->get('/test/{name}', function(Request $request, Response $response, $args){
    echo "<hr>";
    \Doctrine\Common\Util\Debug::dump($this->entityManager);
    echo "<hr>";
    \Doctrine\Common\Util\Debug::dump($this->logger);
    echo "<hr>";
    $response->write('Hello ' . $args['name']);
    return $response;
});