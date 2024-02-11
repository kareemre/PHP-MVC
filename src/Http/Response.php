<?php

namespace Matariya\Http;

class Response
{
    /**
     * Headers container that will be sent to the browser
     *
     * @var array
     */
    private $headers = [];

    /**
     * The content that will be sent to the browser
     *
     * @var string
     */
    private $content = '';

    /**
     * Set the response output content
     *
     * @param string $content
     * @return void
     */
    public function setOutput($content)
    {
        $this->content = $content;
    }

    /**
     * Set the response Headers
     *
     * @param string $header
     * @param mixed value
     * @return void
     */
    public function setHeader($header, $value)
    {
        $this->headers[$header] = $value;
    }

    /**
     * Send the response headers and content
     *
     * @return void
     */
    public function send()
    {
        $this->sendHeaders();

        $this->sendOutput();
    }

    /**
     * Send the response headers
     *
     * @return void
     */
    private function sendHeaders()
    {
        foreach ($this->headers as $header => $value) {
            header($header . ':' . $value);
        }
    }

    /**
     * Send the response output
     *
     * @return void
     */
    private function sendOutput()
    {
        echo $this->content;
    }
}