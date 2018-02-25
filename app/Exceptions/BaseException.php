<?php

namespace App\Exceptions;

class BaseException extends \Exception
{
    protected $message;

    protected $code;

    /**
     * BaseException constructor.
     *
     * @param string|null $message
     * @param int|null    $code
     */
    public function __construct($message = null, $code = null)
    {
        $message === null && $message = $this->message;
        $code === null && $code = $this->code;

        parent::__construct($message, $code);
    }
}