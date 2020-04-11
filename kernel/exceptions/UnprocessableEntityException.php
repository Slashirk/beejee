<?php

namespace kernel\exceptions;

class UnprocessableEntityException extends \Exception
{
    /**
     * @var array
     */
    private $errors;

    /**
     * UnprocessableEntityException constructor.
     *
     * @param array           $errors
     * @param string          $message
     * @param \Throwable|null $previous
     */
    public function __construct(array $errors = [], string $message = '', \Throwable $previous = null)
    {
        $this->errors = $errors;
        $this->message = $message;
        $this->code = 422;
        parent::__construct($this->message, $this->code, $previous);
    }

    /**
     * @return array
     */
    public function getErrors(): array
    {
        return $this->errors;
    }
}
