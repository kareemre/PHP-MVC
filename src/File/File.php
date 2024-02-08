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
     * Check if file exists
     *
     * @param  mixed $file
     * @return bool
     */
    public function exists($file)
    {
        return file_exists($file);
    }

    
    public function requireFile($file)
    {
        file_exists($file);
    }
}