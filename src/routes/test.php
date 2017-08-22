<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

$app->get('/test/{name}', function(Request $request, Response $response, $args){
    var_dump($this->entityManager);
    echo "<hr>";
    var_dump($this->logger);

    $response->write('Hello ' . $args['name'] . "<br><br>");
    return $response;
});