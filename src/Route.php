<?php

namespace Eyrie\Http;

class Route
{
    use MiddlewareAware;

    protected $methods;
    protected $pattern;
    protected $handler;

    public function __construct($methods, $pattern, $handler)
    {
        $this->methods = $methods;
        $this->pattern = $pattern;
        $this->handler = $handler;
    }

    public function getCallable(): callable
    {
        $callable = $this->handler;

        if (is_string($callable) && strpos($callable, '::') !== false) {
            $callable = explode('::', $callable);
        }

        if (is_array($callable)) {
            $callable = [new $callable[0], $callable[1]];
        }

        return $callable;
    }

    public function getPattern()
    {
        return $this->pattern;
    }

    public function getMethods()
    {
        return $this->methods;
    }
}
