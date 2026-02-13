<?php

namespace Tests\Feature\app\Http\Controllers;

use App\Domain\Accounts\Repositories\AccountRepository;
use App\Persistence\Account\Repositories\InMemoryAccountRepository;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class GetBalanceControllerTest extends TestCase
{
    /**
     * Testa o cenário onde o account_id é fornecido, mas não corresponde
     * a uma conta existente, esperando um erro de "not found".
     *
     * @return void
     */
    public function testShouldBeErrorWhenCallGetBalanceWithInvalidAccountId(): void
    {
        $invalidAccountId = 1234;

        $response = $this->withHeaders([
            'Accept' => 'application/json',
        ])->get("/api/balance?account_id={$invalidAccountId}");

        $expectedResponse = [0];

        $response->assertStatus(Response::HTTP_NOT_FOUND);
        $response->assertJsonFragment($expectedResponse);
        $this->assertEquals($expectedResponse, $response->json());
    }

    /**
     * Testa o cenário onde o account_id é fornecido e é válido, esperando um retorno de saldo.
     *
     * @return void
     */
    public function testShouldBeSuccessWhenCallGetBalanceWithValidAccountId(): void
    {
        $validAccountId = 100;

        $availableBalance = 20;

        $repository = $this->app->get(AccountRepository::class);
        $repository->deposit($validAccountId, $availableBalance);

        $response = $this->withHeaders([
            'Accept' => 'application/json',
        ])->get("/api/balance?account_id={$validAccountId}");

        $response->assertStatus(Response::HTTP_OK);
        $response->assertJson([$availableBalance]);
    }

    /**
     * Testa o cenário onde o account_id não é fornecido na requisição.
     *
     * @return void
     */
    public function testShouldBeErrorWhenAccountIdIsNotProvided(): void
    {
        $response = $this->withHeaders([
            'Accept' => 'application/json',
        ])->get('/api/balance?account_id=');

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        $response->assertJsonValidationErrors(['account_id']);

        $response->assertJsonStructure([
            'message',
            'errors' => ['account_id'],
        ]);

        $response->assertJsonFragment([
            'message' => 'validation.required',
            'errors' => [
                'account_id' => ['validation.required'],
            ],
        ]);
    }

    /**
     * Testa o cenário onde o account_id é fornecido, mas não é um número válido.
     *
     * @return void
     */
    public function testShouldBeErrorWhenAccountIdIsNotNumber(): void
    {
        $response = $this->withHeaders([
            'Accept' => 'application/json',
        ])->get('/api/balance?account_id=abc');

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        $response->assertJsonValidationErrors(['account_id']);

        $response->assertJsonStructure([
            'message',
            'errors' => ['account_id'],
        ]);

        $response->assertJsonFragment([
            'message' => 'validation.integer',
            'errors' => [
                'account_id' => ['validation.integer'],
            ],
        ]);
    }
}
