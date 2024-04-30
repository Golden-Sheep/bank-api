<?php

namespace App\Services\Transaction;

use App\Repositories\Transaction\TransactionRepositoryInterface;
use App\Services\API\ManagerTransaction\ManagerTransactionServiceInterface;

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
        $managerTransactionServiceAPI = app(ManagerTransactionServiceInterface::class);

        return new TransactionService($transactionRepository, $managerTransactionServiceAPI);
    }
}
