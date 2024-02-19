<?php

namespace Matariya\File;

class File
{


    /**
     * Directory Separator
     *
     * @const string
     */
    const DS = DIRECTORY_SEPARATOR;

    /**
     * Root Path
     *
     * @var string
     */
    private $root;

    /**
     * Constructor
     *
     * @param string $root
     */
    public function __construct($root = null)
    {
        $this->root = $root;
    }


    /**
     * Check if file exists
     *
     * @param  mixed $file
     * @return bool
     */
    
    public function exists($file)
    {
        return file_exists($this->path($file));
    }


    /**
     * Generate full path to the given path
     *
     * @param string $path
     * @return string
     */
    public function path($path)
    {
        return $this->root . static::DS . str_replace(['/', '\\'], static::DS, $path);
    }
    
    /**
     * require a file
     *
     * @param  string $path
     * @return mixed
     */
    public function requireFile($path)
    {
        return require $this->path($path);
    }
}