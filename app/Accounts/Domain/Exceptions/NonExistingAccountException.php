<?php

namespace App\Accounts\Domain\Exceptions;

use DomainException;
use Throwable;

class NonExistingAccountException extends DomainException
{
    public function __construct(string $message = "", int $code = 0, ?Throwable $previous = null)
    {
        parent::__construct('Non-existing account', $code, $previous);
    }
}
