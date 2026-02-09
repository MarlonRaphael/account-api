<?php

namespace App\Infraestructure\Http\Controllers;

use App\Domain\Accounts\Enum\EventTypes;
use App\Domain\Accounts\UseCases\Withdraw\DTO\WithdrawBalanceEventInput;
use App\Domain\Accounts\UseCases\Withdraw\Exceptions\NonExistingAccountException;
use App\Domain\Accounts\UseCases\Withdraw\WithdrawBalanceEventUseCase;
use App\Infraestructure\Http\Requests\HandleEventRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class EventController extends Controller
{
    public function __construct(
        private WithdrawBalanceEventUseCase $withdrawBalanceEventUseCase
    ) {}

    public function handle(Request $request): JsonResponse
    {
        $requestData = $request->only([
            'type',
            'origin',
            'destination',
            'amount',
        ]);

        try {
            $eventType = EventTypes::tryFrom($requestData['type']);
        } catch (Throwable $exception) {
            return $this->respondNotFound();
        }

        return match ($eventType) {
            EventTypes::WITHDRAW => $this->handleWithdraw($requestData),
            default => $this->respondNotFound(),
        };
    }

    private function handleWithdraw(array $withdrawData): JsonResponse
    {
        try {
            $input = new WithdrawBalanceEventInput(
                originAccountId: $withdrawData['destination'],
                amount: $withdrawData['amount']
            );

            $response = $this->withdrawBalanceEventUseCase->execute($input);
        } catch (NonExistingAccountException $exception) {
            return $this->respondNotFound();
        }

        return response()->json($response, Response::HTTP_NOT_FOUND);
    }

    private function respondNotFound(): JsonResponse
    {
        return response()->json([0], Response::HTTP_NOT_FOUND);
    }
}
