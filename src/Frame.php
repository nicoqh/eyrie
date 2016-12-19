<?php

namespace Eyrie\Http;

class Frame
{
    protected $index = 0;
    protected $stack;
    protected $default;

    public function __construct($stack, callable $default)
    {
        $this->stack = $stack;
        $this->default = $default;
    }

    public function next($request)
    {
        if (!isset($this->stack[$this->index])) {
            return ($this->default)($request);
        }

        return ($this->stack[$this->index])->process($request, $this->getNextFrame());
    }

    public function getNextFrame()
    {
        $new = clone $this;
        $new->index++;
        return $new;
    }
}
