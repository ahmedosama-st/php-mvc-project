<?php

namespace SecTheater;

use SecTheater\Http\Route;
use SecTheater\Database\DB;
use SecTheater\Database\Managers\MySQLManager;
use SecTheater\Database\Managers\SQLiteManager;
use SecTheater\Http\Request;
use SecTheater\Http\Response;

class Application
{
    protected Route $route;
    protected Request $request;
    protected Response $response;
    protected DB $db;

    public function __construct()
    {
        $this->request = new Request;
        $this->response = new Response;
        $this->route = new Route($this->request, $this->response);
        $this->db = new DB($this->getDatabaseDriver());
    }

    protected function getDatabaseDriver()
    {
         return match(env('DB_DRIVER')) {
            'sqlite' => new SQLiteManager,
            'mysql' => new MySQLManager,
            default => new SQLiteManager
        };

    }

    public function run()
    {
        $this->db->init();

        $this->route->resolve();
    }

    public function __get($name)
    {
        if(property_exists($this, $name)) {
            return $this->$name;
        }
    }
}
