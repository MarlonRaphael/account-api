<?php

namespace Tests\Feature\app\Account\Presentation\Http\Controllers;

use PHPUnit\Framework\Attributes\DataProvider;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class GetBalanceControllerTest extends TestCase
{
    #[DataProvider('dataProvider')]
    public function testGetBalance(
        int $accountId,
        int $expectedStatus,
        $expectedResponseBody
    ) {
        $response = $this->withHeaders([
            'Accept' => 'application/json',
        ])->get("/api/balance?account_id={$accountId}");

        $response->assertStatus($expectedStatus);
        $this->assertEquals(json_encode($expectedResponseBody), $response->json());
    }

    public static function dataProvider(): array
    {
        return [
            /**
             *  Testa o cenário onde o account_id é fornecido, mas não corresponde
             *  a uma conta existente, esperando um erro de "not found".
             */
            'testShouldBeErrorWhenCallGetBalanceWithInvalidAccountId' => [
                'accountId' => 1234,
                'expectedStatus' => Response::HTTP_NOT_FOUND,
                'expectedResponseBody' => 0,
            ],

            /**
             *  Testa o cenário onde o account_id é fornecido e é válido, esperando um retorno de saldo.
             */
            'testShouldBeSuccessWhenCallGetBalanceWithValidAccountId' => [
                'accountId' => 100,
                'expectedStatus' => Response::HTTP_OK,
                'expectedResponseBody' => 20,
            ],
        ];
    }
}
