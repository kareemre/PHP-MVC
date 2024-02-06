<?php

use Matariya\Bootstrap\Application;
use Matariya\Database\MySqlConnection;
use Matariya\Database\MySqlQueryBuilder;
use Matariya\File\File;
use Matariya\Http\Request;
use Matariya\Router\Route;

require __DIR__ . '/../vendor/autoload.php';

$app = new Application();
$route = new Route(new Request);
$connect = new MySqlConnection();
$db = new MySqlQueryBuilder($connect);



