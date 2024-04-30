<?php

namespace App\Repositories\Transaction;

use App\Models\User;
use App\Repositories\Adapters\Eloquent\Transaction\TransactionRepositoryAdapter;

/**
 * Class TransactionRepository
 *
 * @author Joao Victor S <dev.jvictor@gmail.com>
 */
class TransactionRepository implements TransactionRepositoryInterface
{
    protected TransactionRepositoryAdapter $transactionRepositoryAdapter;

    public function __construct(TransactionRepositoryAdapter $transactionRepositoryAdapter)
    {
        $this->transactionRepositoryAdapter = $transactionRepositoryAdapter;
    }

    /**
     * @return array<mixed>
     */
    public function transfer(int $payer, int $payee, int $value): array
    {
        return $this->transactionRepositoryAdapter->transfer($payer, $payee, $value);
    }

    /**
     * @param  int  $userId  User ID to fetch.
     * @return User|null Returns User object if found, or null if not found.
     */
    public function getInfoPayer(int $userId): ?User
    {
        return $this->transactionRepositoryAdapter->getInfoPayer($userId);
    }
}
