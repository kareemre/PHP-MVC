<?php
use Matariya\Database\MySqlConnection;
use Matariya\Database\MySqlQueryBuilder;
use Matariya\File\File;
use Matariya\Http\Request;
use Matariya\Http\Response;
use Matariya\Router\Route;
use Matariya\View\ViewFactory;


$basePath = dirname(__DIR__);
require $basePath . '/vendor/autoload.php';
$response = new Response();
$route = new Route(new Request);
$connect = new MySqlConnection();
$db = new MySqlQueryBuilder($connect);
$file = new File($basePath);
$viewFactory = new ViewFactory($file);
// $route->get('go/home', function(){
//     echo 'hello';
// })->handleRoute();

// var_dump($route->routes[0]['action']);


// echo $file->path('public/images/image.jpg');

// $db->data('email', 'kareem@gmail.com')
//     ->where('id = ? ', 2)
//     ->where('password = ?', 3252)->update('users');


