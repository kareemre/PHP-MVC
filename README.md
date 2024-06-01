# PHP MVC Framework

A simple PHP MVC framework for building web applications. This framework follows the Model-View-Controller architectural pattern and provides a structured way to develop your PHP applications.

## Table of Contents

- [Introduction](#introduction)
- [Features](#features)
- [Requirements](#requirements)
- [Usage](#usage)


## Introduction

This PHP MVC framework is designed to provide a simple, lightweight, and easy-to-understand structure for your PHP web applications. It helps in organizing your code and separating the business logic from the presentation layer.

## Features

- Simple and clean MVC structure
- Routing system
- Template engine
- Database abstraction layer with query builder
- Sessions, cookies, and validation handling
- PHP API reflection
- Easy to extend and customize

## Requirements

- PHP 7.2 or higher
- Composer

## Installation

To install the framework, follow these steps:

1. Clone the repository:

    ```sh
    git clone https://github.com/yourusername/your-repo-name.git
    ```


3. Install the dependencies using Composer:

    ```sh
    composer install
    ```


## Usage

### Routing

Define your application routes in the `routes/web.php` file:

```php
$router->get('/', [HomeController::class, 'index']);
$router->post('/submit', 'FormController@submit');
```


### Controller

Define your application Controllers in the `App/Http` Directory:

```php
namespace App\Controllers;

use App\Src\Controller;

class HomeController extends Controller
{
    public function index()
    {
        return $this->view('home');
    }
}

