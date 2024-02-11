<?php
namespace Matariya\Http;

class Request
{
    /**
     * uri
     *
     * @var string
     */
    private $url;


    /**
     * setting the url 
     *
     * @return void
     */
    public function prepareUrl()
    {
        $requestUri = static::server('REQUEST_URI');

        if (str_contains($requestUri, '?')) {
            list($requestUri, $queryString) = explode('?', $requestUri);
        }

        $this->url = explode('public', $requestUri)[1];
    }

    /**
     * get the value of cleansed url
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * get the value of server global value with given key
     *
     * @param  string $key
     * @return mixed
     */
    public static function server(string $key)
    {
        return $_SERVER[$key];
    }

    /**
     * Get value from get request
     * 
     * @param string $key
     * @return string $value 
     */
    public function get(string $key)
    {
        return $_GET[$key];
    }

    /**
     * Get value from post request
     * 
     * @param string $key
     * @return string $value 
     */
    public function post(string $key)
    {
        return $_POST[$key];
    }

    /**
     * determining the request method
     *
     * @return string
     */
    public static function method()
    {
        return static::server('REQUEST_METHOD');
    }
}