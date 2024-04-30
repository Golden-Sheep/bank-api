<?php

namespace Tests\Unit\Services\Transaction;

use App\Services\Transaction\TransactionService;
use App\Services\Transaction\TransactionServiceFactory;
use Tests\TestCase;

/**
 * Class TransactionServiceFactoryTest
 *
 * @author Joao Victor <dev.jvictor@gmail.com>
 */
class TransactionServiceFactoryTest extends TestCase
{
    public function testFactory()
    {
        $factory = new TransactionServiceFactory();
        $this->assertInstanceOf(TransactionServiceFactory::class, $factory);
        $service = $factory();
        $this->assertInstanceOf(TransactionService::class, $service);
    }
}
