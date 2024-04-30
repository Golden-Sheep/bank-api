<?php

namespace App\Repositories\Adapters\Eloquent\Transaction;

use App\Models\User;

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
        $model = app(User::class);

        return new TransactionRepositoryAdapter($model);
    }
}
