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
    public $routes = [];

    /**
     * adding routes to routes container
     *
     * @param  string $method
     * @param  string $uri
     * @param  mixed $action
     * @return void
     */
    public function addRoute(string $requestMethod = 'GET', string $uri, callable|string|array $action)
    {
        $uri = trim($uri, '/');

        $this->routes[] = [
            'uri' => $uri,
            'method' => $requestMethod,
            'action' => $action,
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
        return $this;
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
        return $this;
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
     * execute routes actions
     *
     * @return void
     */
    public function handleRoute()
    {
        if (ltrim($this->request->getUrl(), '/') == $this->routes[0]['uri']) {
            $action = $this->routes[0]['action'] ?? false;
            if (is_callable($action)) {
                return call_user_func_array($action, []);
            }
        }
    }

}
