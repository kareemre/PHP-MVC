<?php

namespace Matariya\Validation;

use Matariya\Http\Request;

class Validation
{

    /**
     * errors container
     *
     * @var array
     */
    private $errors = [];

    /**
     * request instance
     *
     * @var string
     */
    private $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * determine if the given input is not empty
     *
     * @param  string $inputName
     * @param  string $customErrorMessage
     * @return void
     */
    public function required($inputName, string $customErrorMessage = null)
    {

    }

    /**
     * determine if the given input is unique in DB
     *
     * @param  string $inputName
     * @param  array $databaseData
     * @param  string $customErrorMessage
     * @return void
     */
    public function unique($inputName, $databaseData, string $customErrorMessage = null)
    {

    }

    /**
     * determine if the given input is not empty
     *
     * @param  string $inputName
     * @param  string $customErrorMessage
     * @return void
     */
    public function min($inputName, string $customErrorMessage = null)
    {

    }

    /**
     * determine if the given input is not empty
     *
     * @param  string $inputName
     * @param  string $customErrorMessage
     * @return void
     */
    public function max($inputName, string $customErrorMessage = null)
    {

    }

    /**
     * determine if the given first input matches the second on
     * (password for example) 
     *
     * @param  string $firstInput
     * @param  string $secondInput
     * @param  string $customErrorMessage
     * @return void
     */
    public function match($firstInput, $secondInput, string $customErrorMessage = null)
    {

    }

    /**
     * Determine if the given input is valid email
     *
     * @param string $inputName
     * @param string $customErrorMessage
     * @return $this
     */
    public function email($inputName, $customErrorMessage = null)
    {
        if ($this->hasErrors($inputName)) {
            return $this;
        }

        $inputValue = $this->value($inputName);

        if (!filter_var($inputValue, FILTER_VALIDATE_EMAIL)) {
            $message = $customErrorMessage ?: sprintf('%s is not valid email', ucfirst($inputName));
            $this->addError($inputName, $message);
        }

        return $this;
    }

    /**
     * Get the value for the submitted input 
     *
     * @param string $input
     * @return string
     */
    private function value($input)
    {
        return $this->request->post($input);
    }

}