<?php

namespace App\Domain\Accounts\Enum;

Enum EventTypes: string
{
    case DEPOSIT = 'deposit';
    case WITHDRAW = 'withdraw';
    case TRANSFER = 'transfer';
}
