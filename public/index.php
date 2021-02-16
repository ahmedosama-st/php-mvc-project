<?php
session_start();
use Dotenv\Dotenv;

require_once __DIR__ . '/../src/Support/helpers.php';
require_once base_path() . 'vendor/autoload.php';
require_once base_path() . 'routes/web.php';

$dotenv = Dotenv::createImmutable(base_path());
$dotenv->load();

app()->run();
