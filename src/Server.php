<?php

namespace Eyrie\Http;

use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use Eyrie\Http\MiddlewareAware;

class Server
{
    use MiddlewareAware;

    public function run(ServerRequestInterface $request)
    {
        // Process the stack and provide a default action

        $response = $this->process($request, function ($request) {
            // TODO:
            $response = new \Zend\Diactoros\Response;
            $response = $response->withStatus(404);
            $response->getBody()->write('Not found');

            return $response;
        });

        return $response;
    }
}
