<?php

namespace App\Repositories\Adapters\Eloquent\Transaction;



/**
 * Class TransactionRepositoryAdapterFactory
 *
 * @author Joao Victor S <dev.jvictor@gmail.com>
 */
class TransactionRepositoryAdapterFactory
{
    /**
     * @return TransactionRepositoryAdapter
     */
    public function __invoke()
    {
        return new TransactionRepositoryAdapter();
    }
}
