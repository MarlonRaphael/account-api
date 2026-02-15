<?php

namespace Tests\Unit\app\Account\Domain\UseCases\Events\Transfer;

use App\Accounts\Domain\UseCases\Events\Transfer\DTO\TransferInput;
use App\Accounts\Domain\UseCases\Events\Transfer\DTO\TransferOutput;
use App\Accounts\Domain\UseCases\Events\Transfer\TransferUseCase;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;

class TransferUseCaseTest extends TestCase
{
    private TransferUseCase $useCase;

    public function setUp(): void
    {
        parent::setUp();
        $this->useCase = $this->createMock(TransferUseCase::class);
    }

    #[DataProvider('dataProvider')]
    public function testTransferDeposit(
        TransferInput $input,
        TransferOutput $expected
    ): void {
        $this->useCase
            ->method('execute')
            ->with($input)
            ->willReturn($expected);

        $this->assertSame($expected, $this->useCase->execute($input));
    }

    public static function dataProvider(): array
    {
        return [
                'testShouldBeErrorWhenOriginAccountDoesNotExists' => [
                    'input' => new TransferInput(origin: 999, amount: 10, destination: 200),
                    'expected' => new TransferOutput(
                        origin: [
                            'id' => 999,
                            'balance' => 0
                        ],
                        destination: [
                            'id' => 200,
                            'balance' => 10
                        ])
                ],
                'textShouldBeSuccessWhenTransferBetweenExistsAccounts' => [
                    'input' => new TransferInput(origin: 100, amount: 20, destination: 200),
                    'expected' => new TransferOutput(
                        origin: [
                            'id' => 100,
                            'balance' => 0
                        ],
                        destination: [
                            'id' => 200,
                            'balance' => 20
                        ])
                ]
        ];
    }
}
