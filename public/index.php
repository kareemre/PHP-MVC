<?php
use Matariya\Bootstrap\Application;

$basePath = dirname(__DIR__);
require $basePath . '/vendor/autoload.php';
$app = Application::getInstance($basePath);
$app->run();
// var_dump($app->route->routes);
// $route = $app->route->getArgumentsFrom();
        // echo '<pre>';
        // print_r($route);
        // echo '</pre>';

// list($controller, $method) = [Application::class, 'index'];

// echo $controller;


// var_dump($app->file->path('routes/web.php'));
// var_dump($app);

// $firstname = "Peter";
// $lastname = "Griffin";
// $age = "41";

// $result = compact("firstname", "lastname", "age");

// var_dump($result);
// $obj = \Matariya\Database\MySqlConnection::class;
// echo $obj;

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


