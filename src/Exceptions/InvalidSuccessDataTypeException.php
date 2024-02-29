<?php

namespace Ermos\OperationResult\Exceptions;

use Exception;
use Throwable;

class InvalidSuccessDataTypeException extends Exception
{
    public function __construct(
        string     $expectedType,
        string     $actualType,
        int        $code = 0,
        ?Throwable $previous = null
    )
    {
        parent::__construct(
            sprintf(
                'Expected success data type %s, but got %s',
                $expectedType,
                $actualType,
            ),
            $code,
            $previous,
        );
    }
}
