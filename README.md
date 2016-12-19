# Eyrie

HTTP middleware library for PHP. Compatible with PSR-7, PSR-15 and PSR-17.

```php
require __DIR__ . '/../src/bootstrap.php';

/*
 * Create the request using Zend Diactoros
 */
$request = Zend\Diactoros\ServerRequestFactory::fromGlobals(
    $_SERVER,
    $_GET,
    $_POST,
    $_COOKIE,
    $_FILES
);

/**
 * Set up routing
 */
$router = new Eyrie\Http\RouteCollection;

// Get all users
$router->get('/users', 'Acme\Http\Controllers\UserController::index');

// Create user
$router->post('/users', 'Acme\Http\Controllers\UserController::save')
    ->withMiddleware(new Acme\Http\Middleware\Auth);

/**
 * Create server
 */
$server = new Eyrie\Http\Server;

/**
 * Attach global middleware
 */
$server->withMiddleware(new Acme\Http\Middleware\WhoopsErrorHandler(env('APP_DEBUG', false)));
$server->withMiddleware(new Acme\Http\Middleware\ResponseTime);
$server->withMiddleware(new Acme\Http\Middleware\Cors);
$server->withMiddleware(new Acme\Http\Middleware\JsonBody);
$server->withMiddleware(new Acme\Http\Middleware\FastRoute($router));

/**
 * Run the request
 */
$response = $server->run($request);

/**
 * Build the response
 */
$reasonPhrase = $response->getReasonPhrase();

header(sprintf(
    'HTTP/%s %d%s',
    $response->getProtocolVersion(),
    $response->getStatusCode(),
    ($reasonPhrase? ' ' . $reasonPhrase : '')
));

foreach ($response->getHeaders() as $name => $values) {
    header($name . ': ' . implode(', ', $values));
}

// Output
echo $response->getBody();
```
