<?php
/**
 * Created by PhpStorm.
 * User: Ltnap
 * Date: 04/11/2017
 * Time: 13:28
 */

namespace Forms\Validators;


abstract class Validator
{
    protected $errorMessage;

    public function __construct($errorMessage)
    {
        $this->setErrorMessage($errorMessage);
    }

    abstract public function isValid($value);

    public function setErrorMessage($errorMessage)
    {
        if (is_string($errorMessage))
        {
            $this->errorMessage = $errorMessage;
        }
    }

    public function errorMessage()
    {
        return $this->errorMessage;
    }
}