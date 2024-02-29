<?php

namespace Tests\Units;

use Ermos\OperationResult\Exceptions\InvalidSuccessDataTypeException;
use PHPUnit\Framework\TestCase;
use Tests\Examples\UserDTOExample;
use Tests\Stubs\UserCreatedResultStub;

class AbstractOperationResultTest extends TestCase
{
    /**
     * @throws InvalidSuccessDataTypeException
     */
    public function testUserCreatedResult(): void
    {
        $result = UserCreatedResultStub::success(new UserDTOExample('John Doe', 'john@doe.com'));

        $data = $result->getSuccessData();
        $toto = $data->name;
    }
}
