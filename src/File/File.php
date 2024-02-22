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
     * base Path
     *
     * @var string
     */
    private $basePath;


    public function setBasePath($basePath)
    {
        $this->basePath = $basePath;
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
        return $this->basePath . static::DS . str_replace(['/', '\\'], static::DS, $path);
    }

    /**
     * require a file
     *
     * @param  string $path
     * @return mixed
     */
    public function requireFile($path)
    {
        return require_once $this->path($path);
    }
}