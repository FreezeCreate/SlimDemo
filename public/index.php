<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Slim\Factory\AppFactory;
use Slim\Psr7\Response as PsrResponse;

require __DIR__ . '/../vendor/autoload.php';

// Instantiate App
$app = AppFactory::create();    //$app = new \Slim\App();

// Add error middleware
$app->addErrorMiddleware(true, true, true);

$app->add(function (Request $request, RequestHandler $handler) {    //my middleware
    $response = $handler->handle($request);
    $existingContent = (string) $response->getBody();

    $response = new PsrResponse();
    $response->getBody()->write('BEFORE ' . $existingContent);

    return $response;
});


// Add routes
$app->get('/', function (Request $request, Response $response) {
    $response->getBody()->write('<a href="/hello/world">Try /hello/world</a>');
    return $response;
});

$app->get('/asd', function (Request $request, Response $response, $args) {
//    $response->getBody()->write('asd');
//    return $response;
    $payload = json_encode(['hello' => 'world'], JSON_PRETTY_PRINT);
    $response->getBody()->write($payload);
    return $response->withHeader('Content-Type', 'application/json');
});

$app->get('/hello/{name}', function (Request $request, Response $response, $args) {
    $name = $args['name'];
    $response->getBody()->write("Hello, $name");
    return $response;
});

$app->run();
