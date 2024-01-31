<?php 

namespace Matariya\Bootstrap;

use Matariya\File\File;

class Application
{
    
    /**
     * container for all application instances
     *
     * @var array
     */
    private $container = [];
        
    /**
     * __construct
     *
     * @return void
     */
    public function __construct()
    {
    
    }
    
    /**
     * share the given Key|value Through the application
     *
     * @param  string $key
     * @param  mixed $value
     * 
     */
    public function set($key, $value)
    {
        $this->container[$key] = $value;
    }

    public function get($key)
    {
        return $this->container[$key] ?? null;
    }

    public function __get($key)
    {
        return $this->get($key);
    }

    
}