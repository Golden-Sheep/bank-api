<?php

namespace Tests\Unit\Services\Transaction;

use App\Models\User;
use Mockery;
use Tests\TestCase;

/**
 * Class TransactionServiceFactoryTest
 *
 * @author Joao Victor <dev.jvictor@gmail.com>
 */
class TransactionServiceTest extends TestCase
{
    private Mockery\MockInterface $transactionServiceMock;

    private $userMock;

    protected function setUp(): void
    {
        parent::setUp();
        $this->transactionServiceMock = Mockery::mock(TransactionServiceInterface::class);
        $this->userMock = Mockery::mock(User::class);
    }

    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }

    public function testVerifyBalanceBeforeTransferSuccess()
    {
        $this->userMock->shouldReceive('getAttribute')
            ->with('is_seller')->andReturn(false);

        $this->userMock->shouldReceive('getAttribute')
            ->with('balance')->andReturn(900);

        $this->transactionServiceMock->shouldReceive('verifyBalanceBeforeTransfer')
            ->once()
            ->with($this->userMock, 1000)
            ->andReturn(true);

        $result = $this->transactionServiceMock->verifyBalanceBeforeTransfer($this->userMock, 1000);
        $this->assertTrue($result);
    }
}
