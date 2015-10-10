<?php

namespace Fastpress;

use Zend\Diactoros\ServerRequestFactory;

class Application
{
    /**
     * @var Router
     */
    private $router;

    public function __construct()
    {
        $this->router = new Router();
    }

    public function get($path, $resource)
    {
        $this->router->get($path, $resource);
    }

    public function run()
    {
        $request = ServerRequestFactory::fromGlobals();
        $result = $this->router->match($request);
    }
}
