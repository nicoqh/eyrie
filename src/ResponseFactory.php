<?php

namespace Eyrie\Http;

use Zend\Diactoros\Response;

class ResponseFactory // implements the proposed ResponseFactoryInterface
{
    public function createResponse($code = 200)
    {
        return (new Response())->withStatus($code);
    }
}
