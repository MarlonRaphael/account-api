<?php

namespace App\Presentation\Account\Http\Controllers;

use App\Application\Accounts\Processors\BalanceProcessor;
use App\Domain\Accounts\Exceptions\AccountNotFound;
use App\Presentation\Account\Http\Requests\GetBalanceRequest;
use App\Presentation\Account\Http\Resources\FormatterRegistry;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class GetBalanceController extends Controller
{
    public function __construct(
        private readonly BalanceProcessor $processor,
        private readonly FormatterRegistry $formatterRegistry
    ) {}

    public function getBalance(GetBalanceRequest $request): JsonResponse
    {
        $validated = $request->validated();
        try {
            $output = $this->processor->process($validated['account_id']);
            $formatter = $this->formatterRegistry->getFormatter($output);

            return $formatter->format($output);
        } catch (AccountNotFound $exception) {
            return $this->respondNotFound();
        } catch (Throwable $exception) {
            return response()->json([
                'error' => 'An unexpected error occurred.'
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}

