<?php 

namespace Matariya\File;

class File
{      
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