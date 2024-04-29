<?php

namespace App\Services\Transaction;

use App\Repositories\Transaction\TransactionRepositoryInterface;

/**
 * Class TransactionServiceFactory
 *
 * @author Joao Victor <dev.jvictor@gmail.com>
 */
class TransactionServiceFactory
{
    public function __invoke(): TransactionService
    {
        $transactionRepository = app(TransactionRepositoryInterface::class);
        return new TransactionService($transactionRepository);
    }
}
