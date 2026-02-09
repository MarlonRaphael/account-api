<?php

namespace App\Infraestructure\Http\Controllers;

use App\Domain\Accounts\Enum\EventTypes;
use App\Domain\Accounts\UseCases\Withdraw\DTO\WithdrawBalanceEventInput;
use App\Domain\Accounts\UseCases\Withdraw\Exceptions\NonExistingAccountException;
use App\Domain\Accounts\UseCases\Withdraw\WithdrawBalanceEventUseCase;
use App\Infraestructure\Http\Requests\HandleEventRequest;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class EventController extends Controller
{
    public function __construct(
        private WithdrawBalanceEventUseCase $withdrawBalanceEventUseCase
    ) {}

    public function handle(HandleEventRequest $request): JsonResponse
    {
        $validated = $request->validated();

        try {
            $eventType = EventTypes::tryFrom($validated['type']);
        } catch (Throwable $exception) {
            return $this->respondNotFound();
        }

        return match ($eventType) {
            EventTypes::WITHDRAW => $this->handleWithdraw($validated),
            default => $this->respondNotFound(),
        };
    }

    private function handleWithdraw(array $withdrawData): JsonResponse
    {
        try {
            $input = new WithdrawBalanceEventInput(
                originAccountId: $withdrawData['origin'],
                amount: $withdrawData['amount']
            );

            $response = $this->withdrawBalanceEventUseCase->execute($input);
        } catch (NonExistingAccountException $exception) {
            return $this->respondNotFound();
        }

        return response()->json($response->toArray(), Response::HTTP_CREATED);
    }

    private function respondNotFound(): JsonResponse
    {
        return response()->json([0], Response::HTTP_NOT_FOUND);
    }
}
