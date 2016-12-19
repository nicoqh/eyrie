<?php

namespace Eyrie\Http;

class RouteCollection
{
    protected $routes = [];

    public function get($pattern, $handler)
    {
        return $this->map('GET', $pattern, $handler);
    }

    public function post($pattern, $handler)
    {
        return $this->map('POST', $pattern, $handler);
    }

    public function put($pattern, $handler)
    {
        return $this->map('PUT', $pattern, $handler);
    }

    public function patch($pattern, $handler)
    {
        return $this->map('PATCH', $pattern, $handler);
    }

    public function delete($pattern, $handler)
    {
        return $this->map('DELETE', $pattern, $handler);
    }

    public function map($methods, $pattern, $handler)
    {
        $route = new Route($methods, $pattern, $handler);

        $this->routes[] = $route;

        return $route;
    }

    public function getRoutes()
    {
        return $this->routes;
    }
}
