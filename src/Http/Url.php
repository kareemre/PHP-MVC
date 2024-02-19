<?php

namespace Matariya\Http;

class Url
{

    private $request;
    /**
     * Generate full link for the given path
     *
     * @param string $path
     * @return string
     */

    public function __construct(Request $request)
    {
        $this->request = $request;
    }
    public function link($path)
    {
        return $this->request->baseUrl() . trim($path, '/');
    }

    /**
     * Redirect to the given path
     *
     * @param string $path
     * @return void
     */
    public function redirectTo($path)
    {
        header('location:' . $this->link($path));

        exit;
    }
}