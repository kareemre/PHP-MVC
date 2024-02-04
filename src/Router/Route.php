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
    }

    
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
            'uri'            => $uri,
            'method'         => $requestMethod,
            'action'         => $action,
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
     * execute routes actions
     *
     * @return void
     */
    public function handleRoute()
    {
        $url = $this->request->getUrl();

        foreach ($this->routes as $route) {
            $matched = true;

            $route['uri'] = preg_replace('/\/{(.*?)}/', '/(.*?)', $route['uri']);
            $route['uri'] = '#^' .$route['uri'] .'$#';
            
            if (preg_match($route['uri'], $url, $matches)) {
                array_shift($matches);

                $params = array_values($matches);
                foreach ($params as $param) {
                    if (strpos($param, '/')) {
                        $matched = false;
                    }
                }
                
                if ($route['method'] != Request::method()) {
                    $matched = false;
                }

                if ($matched) {
                    return $this->invoke($route, $params);
                }
            }

        }
    }


    public function invoke($route, array $params = [])
    {
        $action = $route['action'];

        if (is_callable($action)) {
            return call_user_func($action);
        }
    }
}
