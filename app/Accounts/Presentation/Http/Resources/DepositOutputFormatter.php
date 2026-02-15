<?php

namespace App\Accounts\Presentation\Http\Resources;

use App\Accounts\Domain\UseCases\Events\Deposit\DTO\DepositAmountOutput;
use Illuminate\Http\JsonResponse;
use InvalidArgumentException;
use Symfony\Component\HttpFoundation\Response;

class DepositOutputFormatter implements OutputFormatter
{
    public function format(Output $output): JsonResponse
    {
        if (!$output instanceof DepositAmountOutput) {
            throw new InvalidArgumentException('Invalid output type');
        }

        return response()->json($output->toArray(), Response::HTTP_CREATED);
    }
}

