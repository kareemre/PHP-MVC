<?php 
use Matariya\Bootstrap\Application;
use Matariya\Session\Session;

$app = Application::getInstance();

$app->route->get('kareem/:text/:id', [Session::class, 'index']);

