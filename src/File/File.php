<?php 

namespace Matariya\File;

class File
{    
    /**
     * root path
     *
     * @var string
     */
    private $root;
    
    /**
     * constructor
     *
     * @param  string $root
     * @return void
     */
    public function __construct($root) 
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
        return file_exists($file);
    }
}