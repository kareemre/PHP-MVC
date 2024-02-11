<?php

namespace Matariya\View;

use Matariya\File\File;

class ViewFactory
{

    /**
     * file instance
     *
     * @var File
     */
    private $file;

    /**
     * Constructor
     *
     * @param 
     */
    public function __construct(File $file)
    {
        $this->file = $file;
    }

    /**
     * Render the given view path with the passed variables and generate new View Object for it
     *
     * @param string $viewPath
     * @param array $data
     * 
     */
    public function render($viewPath, array $data = [])
    {
        return new View($this->file, $viewPath, $data);
    }
}