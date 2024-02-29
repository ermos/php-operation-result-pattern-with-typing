<?php

namespace Tests\Stubs;

use Ermos\OperationResult\AbstractOperationResult;
use Tests\Examples\UserDTOExample;

/**
 * @method UserDTOExample getSuccessData()
 */
readonly class UserCreatedResultStub extends AbstractOperationResult
{
    protected static function getSuccessDataType(): string
    {
        return UserDTOExample::class;
    }
}
