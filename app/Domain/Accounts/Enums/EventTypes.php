<?php

namespace App\Domain\Accounts\Enums;

Enum EventTypes: string
{
    case DEPOSIT = 'deposit';
    case WITHDRAW = 'withdraw';
    case TRANSFER = 'transfer';
}
