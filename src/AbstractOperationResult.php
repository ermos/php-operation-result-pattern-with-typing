<?php

namespace Ermos\OperationResult;

use BadMethodCallException;
use Ermos\OperationResult\Exceptions\InvalidSuccessDataTypeException;
use Ermos\OperationResult\Exceptions\NotAllowedMethodAccessException;

readonly abstract class AbstractOperationResult
{
    private function __construct(
        private bool   $success,
        private mixed  $data = null,
        private string $failureReason = '',
    )
    {
    }

    /**
     * @throws NotAllowedMethodAccessException
     */
    public function __call(string $name, array $arguments)
    {
        if ($name === 'getSuccessData') {
            if (!$this->isSuccess()) {
                throw new NotAllowedMethodAccessException(
                    'access to getSuccessData is not allowed for failed operation',
                );
            }

            return $this->data;
        }

        throw new BadMethodCallException(sprintf('method %s does not exist', $name));
    }

    abstract protected static function getSuccessDataType(): string;

    /**
     * @throws InvalidSuccessDataTypeException
     */
    public static function success(mixed $data): self
    {
        $isValid = match(static::getSuccessDataType()) {
            'string' => is_string($data),
            'int' => is_int($data),
            'bool' => is_bool($data),
            'float' => is_float($data),
            'numeric' => is_numeric($data),
            'array' => is_array($data),
            'object' => is_object($data),
            default => class_exists(static::getSuccessDataType())
                && is_a($data, static::getSuccessDataType(), true),
        };

        if (!$isValid) {
            throw new InvalidSuccessDataTypeException(
                static::getSuccessDataType(),
                gettype($data),
            );
        }

        return new static::class(true, $data);
    }

    public static function failed(string $failureReason): self
    {
        return new static::class(false, null, $failureReason);
    }

    public function isSuccess(): bool
    {
        return $this->success;
    }

    public function isFailed(): bool
    {
        return !$this->success;
    }

    /**
     * @throws NotAllowedMethodAccessException
     */
    public function getFailureReason(): string
    {
        if ($this->isSuccess()) {
            throw new NotAllowedMethodAccessException(
                'access to getFailureReason is not allowed for success operation',
            );
        }

        return $this->failureReason;
    }
}
