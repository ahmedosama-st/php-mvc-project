<?php

namespace Acme;

use Acme\Http\Route;
use Acme\Http\Request;

class Application
{
    protected Route $route;
    protected Request $request;

    public function __construct()
    {
        $this->request = new Request;
        $this->route = new Route($this->request);
    }

    public function run()
    {
        $this->route->resolve();
    }
}
