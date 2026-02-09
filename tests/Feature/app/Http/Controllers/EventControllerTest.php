<?php

namespace Tests\Feature\app\Http\Controllers;

use App\Domain\Accounts\Enum\EventTypes;
use PHPUnit\Framework\Attributes\DataProvider;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class EventControllerTest extends TestCase
{
    #[DataProvider('additionProvider')]
    public function testShouldBeErrorWhenWithdrawNonExistingAccount(
        string $type,
        int $originAccount,
        int $destinationAccount,
        int $amount,
        array $expectedResponseBody
    ): void {

        $response = $this->postJson('api/event', [
            'type' => $type,
            'origin' => $originAccount,
            'destination' => $destinationAccount,
            'amount' => $amount,
        ]);

        $response->assertStatus(Response::HTTP_NOT_FOUND);
        $response->assertJson($expectedResponseBody);
    }

    public static function additionProvider(): array
    {
        return [
            'testShouldBeErrorWhenWithdrawNonExistingAccount' => [
                EventTypes::WITHDRAW->value,
                200,
                999,
                10,
                'expectedResponseBody' => [0]
            ]
        ];
    }
}
