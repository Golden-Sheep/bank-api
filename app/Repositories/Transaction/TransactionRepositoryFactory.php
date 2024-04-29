<?php

namespace App\Repositories\Transaction;

use App\Repositories\Transaction\TransactionRepository;

/**
 * Class TransactionRepositoryFactory
 *
 * @author Joao Victor <dev.jvictor@gmail.com>
 */
class TransactionRepositoryFactory
{
    public function __invoke(): TransactionRepository
    {
        return new TransactionRepository();
    }
}
