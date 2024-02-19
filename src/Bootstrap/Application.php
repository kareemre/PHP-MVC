<?php

namespace Matariya\Bootstrap;

use Matariya\File\File;
use ReflectionClass;

class Application
{
    /**
     * The base path for the installation.
     *
     * @var string
     */
    protected $basePath;

    /**
     * bindings
     *
     * @var array
     */
    private $bindings = [];



    /**
     * Application Object
     *
     * @var \Matariya\bootstrap\Application
     */
    private static $instance;

    public function __construct($basePath)
    {
        new File($this->basePath = $basePath);
    }

    /**
     * bind the given key|value Through Application
     *
     * @param string $key
     * @param mixed $value
     * @return mixed
     */
    public function bind($abstract, $concrete)
    {
        $this->bindings[$abstract] = $concrete;
    }

    /**
     * get value from bindings
     *
     * @param  string $key
     * @return mixed
     */
    public function get($abstract)
    {
        if (! $this->isSharing($abstract)) {
            if ($this->isCoreAlias($abstract)) {
                $this->bind($abstract, $this->build($abstract));
            } else {
                die('<b>' . $abstract . '</b> not found in application bindings');
            }
        }
        return $this->bindings[$abstract];
    }


    /**
     * Create new object for the core class and it's dependencies
     *
     * @param string $alias
     * @return object
     */
    private function build($abstract)
    {
        $coreClasses = $this->coreClasses();

        $concrete = $coreClasses[$abstract];

        $reflector = new ReflectionClass($concrete);

        if (! $reflector->isInstantiable()) {
			throw new \Exception("Class {$concrete} is not instantiable");
		}

		if (! $constructor = $reflector->getConstructor()) {
			// get new instance from class
			return $reflector->newInstance();
		}

        //dependencies container
        $dependencies = [];

        foreach ($constructor->getParameters() as $parameter) {
            
            if (! $parameter->getType() || ! class_exists($dependency = $parameter->getType()?->getName())) {
                $message = "No binding was registered on {$concrete} for constructor parameter, \${$parameter->getName()}.";

                throw new \Exception($message);
            }

            $dependencies[] = $this->build($dependency);
        }

        return $reflector->newInstanceArgs($dependencies);
    }
    


    /**
     * Determine if the given key is an alias to core class
     *
     * @param string $alias
     * @return bool
     */
    private function isCoreAlias($abstract)
    {
        $coreClasses = $this->coreClasses();

        return isset($coreClasses[$abstract]);
    }


    /**
     * Determine if the given key is shared through Application
     *
     * @param string $key
     * @return bool
     */
    public function isSharing($abstract)
    {
        return isset($this->bindings[$abstract]);
    }

    /**
     * get the bind value dinamically
     *
     * @param  string $key
     * @return mixed
     */
    public function __get($abstract)
    {
        return $this->get($abstract);
    }

    /**
     * Get All Core Classes with its aliases
     *
     * @return array
     */
    private function coreClasses()
    {
        return [
            'request' => \Matariya\Http\Request::class,
            'response' => \Matariya\Http\Response::class,
            'route' => \Matariya\Router\Route::class,
            'db' => \Matariya\Database\MySqlQueryBuilder::class,
            'db.connection' => \Matariya\Database\MySqlConnection::class,
            'file' => \Matariya\File\File::class,
            'session' => \Matariya\Session\Session::class,
            'url' => \Matariya\Http\Url::class,
            'validator' => \Matariya\Validation\Validation::class,
        ];
    }
}