<?php

namespace App\Presentation\Account\Http\Resources;

use App\Domain\Accounts\UseCases\Balance\DTO\GetBalanceOutput;
use Illuminate\Http\JsonResponse;
use InvalidArgumentException;
use Symfony\Component\HttpFoundation\Response;

class GetBalanceFormatter implements OutputFormatter
{
    public function format(Output $output): JsonResponse
    {
        if (!$output instanceof GetBalanceOutput) {
            throw new InvalidArgumentException('Invalid output type');
        }

        return response()->json($output->balance, Response::HTTP_OK);
    }
}

