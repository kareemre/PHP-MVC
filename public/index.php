<?php
use Matariya\Bootstrap\Application;
use Matariya\Database\MySqlConnection;
use Matariya\Database\MySqlQueryBuilder;
use Matariya\File\File;
use Matariya\Http\Request;
use Matariya\Http\Response;
use Matariya\Router\Route;
use Matariya\View\ViewFactory;


$basePath = dirname(__DIR__);
require $basePath . '/vendor/autoload.php';

$firstname = "Peter";
$lastname = "Griffin";
$age = "41";

$result = compact("firstname", "lastname", "age");

var_dump($result);
// $app = new Application($basePath);
// $route = new Route(new Request);
// $connect = new MySqlConnection();
// $db = new MySqlQueryBuilder($connect);
// $viewFactory = new ViewFactory($file);
// $request = new Request();

// $route->get('register', function() use ($viewFactory){
//     echo  $viewFactory->render('home');
// })->handleRoute();




// echo $file->path('public/images/image.jpg');

// $db->data('email', 'kareem@gmail.com')
//     ->where('id = ? ', 2)
//     ->where('password = ?', 3252)->update('users');


