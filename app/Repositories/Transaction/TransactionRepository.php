<?php

namespace App\Repositories\Transaction;

use App\Repositories\Adapters\Eloquent\Transaction\TransactionRepositoryAdapter;

/**
 * Class TransactionRepository
 *
 * @author Joao Victor S <dev.jvictor@gmail.com>
 */
class TransactionRepository implements TransactionRepositoryInterface
{
    protected TransactionRepositoryAdapter $transactionRepositoryAdapter;

    public function __construct(TransactionRepositoryAdapter $transactionRepositoryAdapter){
        $this->transactionRepositoryAdapter = $transactionRepositoryAdapter;
    }

    public function transfer(){
        return $this->transactionRepositoryAdapter->transfer();
    }
}
