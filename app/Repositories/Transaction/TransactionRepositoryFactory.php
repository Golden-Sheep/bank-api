<?php

namespace App\Repositories\Transaction;

use App\Repositories\Adapters\Eloquent\Transaction\TransactionRepositoryAdapter;

/**
 * Class TransactionRepositoryFactory
 *
 * @author Joao Victor <dev.jvictor@gmail.com>
 */
class TransactionRepositoryFactory
{
    public function __invoke(): TransactionRepository
    {
        $adaptador = app(TransactionRepositoryAdapter::class);

        return new TransactionRepository(
            $adaptador
        );
    }
}
