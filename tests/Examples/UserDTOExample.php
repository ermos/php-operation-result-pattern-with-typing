<?php

namespace Tests\Examples;

readonly class UserDTOExample
{
    public function __construct(
        public string $name,
        public string $email,
    )
    {
    }
}
