<?php

namespace Matariya\Bootstrap;

use Matariya\File\File;

class Application
{
    /**
     * instance of filesystem
     *
     * @var mixed
     */
    private $file;

    private $basePath;

    /**
     * Application Object
     *
     * @var \src\bootstrap\Application
     */
    private static $instance;

    public function __construct(File $file, $basePath)
    {
        $this->file = $file;
        $this->basePath = $basePath;
    }


    /**
     * Get All Core Classes with its aliases
     *
     * @return array
     */
    private function coreClasses()
    {
        return [
            'request'       => \Matariya\Http\Request::class,
            'route'         => \Matariya\Router\Route::class,
            'db'            => \Matariya\Database\MySqlQueryBuilder::class,
            'db.connection' => \Matariya\Database\MySqlConnection::class,
            'view'          => 'System\\View\\ViewFactory',
            'url'           => 'System\\Url',
            'validator'     => \Matariya\Validation\Validation::class,
        ];
    }
}