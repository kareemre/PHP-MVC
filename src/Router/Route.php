<?php

namespace Matariya\Router;

use Matariya\Http\Request;

class Route
{
    /**
     * routes container
     *
     * @var array
     */
    private $routes = [];

    private $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->request->prepareUrl();
    }

    /**
     * adding routes to routes container
     *
     * @param  string $method
     * @param  string $url
     * @param  mixed $action
     * @return void
     */
    private function addRoute(string $requestMethod = 'GET', string $url, callable|string|array $action)
    {
        $this->routes[] = [
            'url'     => $url,
            'pattern' => $this->generatePattern($url),
            'method'  => $requestMethod,
            'action'  => $action,
        ]; 
    }


    /**
     * adding route through get method
     *
     * @param  mixed $url
     * @param  mixed $action
     * @return 
     */
    public function get($url, $action)
    {
        $this->addRoute('GET', $url, $action);
    }

    /**
     * adding route through post method
     *
     * @param  mixed $url
     * @param  mixed $action
     * @return 
     */
    public function post($url, $action)
    {
        $this->addRoute('post', $url, $action);
    }

    public function delete()
    {
        //  
    }

    public function put()
    {
        //
    }

    /**
     * Get Proper Route
     *
     * @return array
     */
    public function getProperRoute()
    {
        foreach ($this->routes as $route) {
            if ($this->isMatching($route['pattern'])) {

                $arguments = $this->getArgumentsFrom($route['pattern']);

                // [Controller::class, 'method']
                list($controller, $method) = $route['action'];
            }
        }
        return [$controller, $method, $arguments];
    }


    /**
     * Determine if the given pattern matches the current request url
     *
     * @param string $pattern
     * @return bool
     */
    private function isMatching($pattern)
    {
        return preg_match($pattern, $this->request->getUrl());
    }
    
    /**
     * generate regular expression pattern to extract parameters from requested url
     *
     * @param  mixed $url
     * @return string
     */
    private function generatePattern($url)
    {
        $pattern = '#^';

        $pattern .= str_replace([':text', ':id'], ['([a-zA-Z0-9-]+)', '(\d+)'] , $url);

        $pattern .= '$#';

        return $pattern;
    }


    /**
     * Get Arguments from the current request url
     * based on the given pattern
     *
     * @param string $pattern
     * @return array
     */
    private function getArgumentsFrom($pattern)
    {
        preg_match($pattern, $this->request->getUrl(), $matches);

        array_shift($matches);

        return $matches;
    }

}
