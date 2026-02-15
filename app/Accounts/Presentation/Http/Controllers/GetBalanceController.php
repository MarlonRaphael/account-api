<?php

namespace App\Accounts\Presentation\Http\Controllers;

use App\Accounts\Application\Processors\BalanceProcessor;
use App\Accounts\Domain\Exceptions\AccountNotFound;
use App\Accounts\Presentation\Http\Requests\GetBalanceRequest;
use App\Accounts\Presentation\Http\Resources\FormatterRegistry;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Throwable;
use function Laravel\Prompts\form;

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

