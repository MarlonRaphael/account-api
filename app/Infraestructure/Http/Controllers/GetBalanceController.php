<?php

namespace App\Infraestructure\Http\Controllers;

use App\Domain\Accounts\UseCases\GetAccountBalance\GetAccountBalanceUseCase;
use App\Domain\Exceptions\AccountNotFound;
use App\Infraestructure\Http\Requests\GetBalanceRequest;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class GetBalanceController extends Controller
{
    public function __construct(private GetAccountBalanceUseCase $useCase)
    {
        //
    }

    public function getBalance(GetBalanceRequest $request): JsonResponse
    {
        $validated = $request->validated();

        try {
            $response = $this->useCase->execute($validated['account_id']);

            return response()->json([$response], Response::HTTP_OK);
        } catch (AccountNotFound $exception) {
            return response()->json(0, Response::HTTP_NOT_FOUND);
        } catch (Throwable $exception) {
            return response()->json([
                'error' => 'An unexpected error occurred.'
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
