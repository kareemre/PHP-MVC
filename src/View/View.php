<?php

namespace Matariya\View;

use Matariya\File\File;

class View 
{

    private $file;
    /**
     * View Path
     *
     * @var string
     */
    private $viewPath;

    /**
     * Passed Data "variables" to the view path
     *
     * @var array
     */
    private $data = [];

    /**
     * The output from the view file
     *
     * @var string
     */
    private $output;

    /**
     * Constructor
     *
     * @param \Matariya\File 
     * @param string $viewPath
     * @param array $data
     */
    public function __construct($file, $viewPath, array $data)
    {
        $this->file = $file;
        $this->preparePath($viewPath);
        $this->data = $data;
    }

    /**
     * Prepare View Path
     *
     * @param string $viewPath
     * @return void
     */
    private function preparePath($viewPath)
    {
        $relativeViewPath = 'Views/' . $viewPath . '.php';

        $this->viewPath = $this->file->path($relativeViewPath);

        if (! $this->viewFileExists($relativeViewPath)) {
            die('<b>' . $viewPath . ' View</b>' . ' does not exists in Views Folder');
        }
    }

    
    /**
    * Determine if the view file exists
    *
    * @param string $viewPath
    * @return bool
    */
    private function viewFileExists($viewPath)
    {
        return $this->file->exists($viewPath);
    }

    
    /**
    * {@inheritDoc}
    */
    public function getOutput()
    {
        if (is_null($this->output)) {
            ob_start();

            extract($this->data);

            require $this->viewPath;

            $this->output = ob_get_clean();
        }

        return $this->output;
    }

    /**
    * {@inheritDoc}
    */
    public function __toString()
    {
        return $this->getOutput();
    }

}