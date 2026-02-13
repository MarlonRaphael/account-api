<?php

namespace App\Presentation\Account\Http\Resources;

use App\Domain\Accounts\UseCases\Events\Transfer\DTO\TransferOutput;
use Illuminate\Http\JsonResponse;
use InvalidArgumentException;
use Symfony\Component\HttpFoundation\Response;

class TransferOutputFormatter implements OutputFormatter
{
    public function format(Output $output): JsonResponse
    {
        if (!$output instanceof TransferOutput) {
            throw new InvalidArgumentException('Invalid output type');
        }

        return response()->json($output->toArray(), Response::HTTP_CREATED);
    }
}
