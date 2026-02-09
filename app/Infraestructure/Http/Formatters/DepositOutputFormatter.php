<?php

namespace App\Infraestructure\Http\Formatters;

use App\Domain\Accounts\UseCases\Events\Deposit\DTO\DepositAmountOutput;
use App\Infraestructure\DTO\Output;
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
