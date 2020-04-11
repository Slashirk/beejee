<?php

namespace kernel\exceptions;

class InvalidRouteException extends \Exception
{
    public function __construct($message = 'Invalid Route', $code = 404, \Exception $previous = null) {
        parent::__construct($message, $code, $previous);
    }
}
