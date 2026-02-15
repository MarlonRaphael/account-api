<?php

namespace App\Accounts\Domain\Enums;

Enum EventTypes: string
{
    case DEPOSIT = 'deposit';
    case WITHDRAW = 'withdraw';
    case TRANSFER = 'transfer';
}
