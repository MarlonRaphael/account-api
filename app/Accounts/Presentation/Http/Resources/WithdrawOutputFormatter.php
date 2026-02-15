<?php

namespace App\Accounts\Presentation\Http\Resources;

use App\Accounts\Domain\UseCases\Events\Withdraw\DTO\WithdrawBalanceOutput;
use Illuminate\Http\JsonResponse;
use InvalidArgumentException;
use Symfony\Component\HttpFoundation\Response;

class WithdrawOutputFormatter implements OutputFormatter
{
    public function format(Output $output): JsonResponse
    {
        if (!$output instanceof WithdrawBalanceOutput) {
            throw new InvalidArgumentException('Invalid output type');
        }

        return response()->json($output->toArray(), Response::HTTP_CREATED);
    }
}

