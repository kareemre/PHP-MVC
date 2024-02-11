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
     * Check if file exists
     *
     * @param  mixed $file
     * @return bool
     */


    public function __construct($root)
    {
        $this->root = $root;
    }
    
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

    public function requireFile($path)
    {
        return require $this->path($path);
    }
}