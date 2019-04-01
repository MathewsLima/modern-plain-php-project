<?php
declare(strict_types=1);

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

define('ROOT_DIR', dirname(__DIR__));

require ROOT_DIR . '/vendor/autoload.php';

$handler = require ROOT_DIR . '/src/error_handler.php';
$handler['whoops']();

require ROOT_DIR . '/src/dependencies.php';

$request = Request::createFromGlobals();

$dispatcher = \FastRoute\simpleDispatcher(function (\FastRoute\RouteCollector $router) {
    $routes = require ROOT_DIR . '/src/routes.php';

    foreach ($routes as $route) {
        $router->addRoute(...$route);
    }
});

$routeInfo = $dispatcher->dispatch(
    $request->getMethod(),
    $request->getPathInfo()
);

switch ($routeInfo[0]) {
    case \FastRoute\Dispatcher::NOT_FOUND:
        $response = new Response('Not found', 404);
        break;
    case \FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        $response = new Response('Method not allowed', 405);
        break;
    case \FastRoute\Dispatcher::FOUND:
        [$controllerName, $method] = explode('@', $routeInfo[1]);

        $vars = $routeInfo[2];

        $injector   = require ROOT_DIR . '/src/dependencies.php';
        $controller = $injector->make($controllerName);

        $response = $controller->$method($request, $vars);

        break;
}

if (!$response instanceof Response) {
    throw new \Exception('Controller methods must return a Response object');
}

$response->prepare($request);
$response->send();
