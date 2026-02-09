<?php

namespace Tests\Feature\app\Http\Controllers;

use App\Domain\Accounts\Enum\EventTypes;
use PHPUnit\Framework\Attributes\DataProvider;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class EventControllerTest extends TestCase
{
    #[DataProvider('dataProvider')]
    public function testShouldReturnSuccessWhenWithdrawAccountExists(
        array $requestBody,
        int $expectedStatus,
        array $expectedResponseBody
    ): void {
        $response = $this->postJson('api/event', $requestBody);

        $response->assertStatus($expectedStatus);
        $response->assertJson($expectedResponseBody);
    }

    #[DataProvider('dataProvider')]
    public function testShouldBeErrorWhenWithdrawNonExistingAccount(
        array $requestBody,
        int $expectedStatus,
        array $expectedResponseBody
    ): void {
        $response = $this->postJson('api/event', $requestBody);

        $response->assertStatus($expectedStatus);
        $response->assertJson($expectedResponseBody);
    }

    #[DataProvider('dataProvider')]
    public function testShouldBeErrorWhenWithdrawAmountNotInformed(
        array $requestBody,
        int $expectedStatus,
        array $expectedResponseBody
    ): void {
        $response = $this->postJson('api/event', $requestBody);

        $response->assertStatus($expectedStatus);
        $response->assertJson($expectedResponseBody);
    }

    public static function dataProvider(): array
    {
        return [
            'testShouldReturnSuccessWhenAccountExists' => [
                'requestBody' => [
                    'type' => EventTypes::WITHDRAW->value,
                    'origin' => 100,
                    'amount' => 5,
                ],
                'expectedStatus' => Response::HTTP_CREATED,
                'expectedResponseBody' => [
                    'origin' => [
                        'id' => 100,
                        'balance' => 15,
                    ]
                ],
            ],
            'testShouldBeErrorWhenWithdrawNonExistingAccount' => [
                'requestBody' => [
                    'type' => EventTypes::WITHDRAW->value,
                    'origin' => 200,
                    'amount' => 10,
                ],
                'expectedStatus' => Response::HTTP_NOT_FOUND,
                'expectedResponseBody' => [0],
            ],
            'testShouldBeErrorWhenWithdrawAmountNotInformed' => [
                'requestBody' => [
                    'type' => EventTypes::WITHDRAW->value,
                    'origin' => 100,
                ],
                'expectedStatus' => Response::HTTP_UNPROCESSABLE_ENTITY,
                'expectedResponseBody' => [
                    'message' => 'validation.required',
                    'errors' => [
                        'amount' => [
                            'validation.required'
                        ]
                    ]
                ],
            ],
        ];
    }

}
