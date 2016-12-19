<?php

namespace Eyrie\Http;

use Psr\Http\Message\ServerRequestInterface;

trait MiddlewareAware
{
    protected $middleware = [];

    public function withMiddleware($middleware)
    {
        $this->middleware[] = $middleware;
    }

    public function withoutMiddleware($middleware)
    {
        // TODO: implement
    }

    // Process stack
    public function process(ServerRequestInterface $request, callable $default)
    {
        return (new Frame($this->middleware, $default))->next($request);
    }
}
