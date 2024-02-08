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

$root = dirname(__DIR__);

// $db->data('email', 'kareem@gmail.com')
//     ->where('id = ? ', 2)
//     ->where('password = ?', 3252)->update('users');


