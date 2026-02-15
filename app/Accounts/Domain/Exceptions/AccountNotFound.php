<?php

namespace App\Accounts\Domain\Exceptions;

use DomainException;
use Throwable;

class AccountNotFound extends DomainException
{
    public function __construct(string $message = "", int $code = 0, ?Throwable $previous = null)
    {
        parent::__construct('Conta não encontrada.', $code, $previous);
    }
}
