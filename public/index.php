<?php
session_start();
use Dotenv\Dotenv;
use SecTheater\Validation\Validator;

require_once __DIR__ . '/../src/Support/helpers.php';
require_once base_path() . 'vendor/autoload.php';
require_once base_path() . 'routes/web.php';

$dotenv = Dotenv::createImmutable(base_path());
$dotenv->load();

app()->run();

$validator = new Validator;
$validator->setRules([
    'email' => 'required|email|unique:users,email'
]);
$validator->make([
    'email' => 'marvelphp5@gmail.com'
]);

var_dump($validator->passes());
var_dump($validator->errors());
