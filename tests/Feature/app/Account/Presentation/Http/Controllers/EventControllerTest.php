<?php

namespace Tests\Feature\app\Account\Presentation\Http\Controllers;

use App\Accounts\Domain\Enums\EventTypes;
use PHPUnit\Framework\Attributes\DataProvider;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class EventControllerTest extends TestCase
{
    #[DataProvider('dataProvider')]
    public function testEvent(
        array $requestBody,
        int   $expectedStatus,
              $expectedResponseBody
    ): void
    {
        $response = $this->postJson('api/event', $requestBody);

        $response->assertStatus($expectedStatus);
        $this->assertEquals(json_encode($expectedResponseBody), $response->getContent());
    }

    public static function dataProvider(): array
    {
        return [
            'testShouldReturnSuccessWhenWithdrawAccountExists' => [
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
                'expectedResponseBody' => 0,
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
            'testShouldBeSuccessWhenDepositDestinationAccountExists' => [
                'requestBody' => [
                    'type' => EventTypes::DEPOSIT->value,
                    'destination' => 100,
                    'amount' => 10,
                ],
                'expectedStatus' => Response::HTTP_CREATED,
                'expectedResponseBody' => [
                    'destination' => [
                        'id' => 100,
                        'balance' => 10,
                    ],
                ],
            ],
            'testShouldBeSuccessWhenDepositDestinationAccountDoesNotExist' => [
                'requestBody' => [
                    'type' => EventTypes::DEPOSIT->value,
                    'destination' => 300,
                    'amount' => 10,
                ],
                'expectedStatus' => Response::HTTP_CREATED,
                'expectedResponseBody' => [
                    'destination' => [
                        'id' => 300,
                        'balance' => 10,
                    ],
                ],
            ],
            'testShouldBeSuccessWhenTransferAccountsExist' => [
                'requestBody' => [
                    'type' => EventTypes::TRANSFER->value,
                    'origin' => 100,
                    'destination' => 300,
                    'amount' => 5,
                ],
                'expectedStatus' => Response::HTTP_CREATED,
                'expectedResponseBody' => [
                    'origin' => [
                        'id' => 100,
                        'balance' => 0,
                    ],
                    'destination' => [
                        'id' => 300,
                        'balance' => 15,
                    ],
                ],
            ],
            'testShouldBeErrorWhenTransferOriginAccountDoesNotExist' => [
                'requestBody' => [
                    'type' => EventTypes::TRANSFER->value,
                    'origin' => 400,
                    'destination' => 300,
                    'amount' => 5,
                ],
                'expectedStatus' => Response::HTTP_NOT_FOUND,
                'expectedResponseBody' => 0,
            ],
            'testShouldBeErrorWhenTransferDestinationAccountDoesNotExist' => [
                'requestBody' => [
                    'type' => EventTypes::TRANSFER->value,
                    'origin' => 100,
                    'destination' => 400,
                    'amount' => 5,
                ],
                'expectedStatus' => Response::HTTP_NOT_FOUND,
                'expectedResponseBody' => 0,
            ],
        ];
    }

}
