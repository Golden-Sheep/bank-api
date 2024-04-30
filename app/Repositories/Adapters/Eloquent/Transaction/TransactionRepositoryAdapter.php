<?php

namespace App\Repositories\Adapters\Eloquent\Transaction;

use App\Models\User;
use App\Repositories\Transaction\TransactionRepositoryInterface;
use Exception;
use Illuminate\Support\Facades\DB;

/**
 * Inteface TransactionRepositoryAdapter
 *
 * @author Joao Victor S <dev.jvictor@gmail.com>
 */
class TransactionRepositoryAdapter implements TransactionRepositoryInterface
{
    private User $model;

    public function __construct(
        User $model
    ) {
        $this->model = $model;
    }

    /**
     * Transfer funds between accounts.
     *
     * @return array<mixed>
     *
     * @throws Exception
     */
    public function transfer(int $payer, int $payee, int $value): array
    {
        try {
            return DB::transaction(function () use ($payer, $payee, $value) {
                $payerUser = $this->model->newQuery()->lockForUpdate()->find($payer);
                $payeeUser = $this->model->newQuery()->lockForUpdate()->find($payee);

                if (! $payerUser || ! $payeeUser) {
                    throw new Exception('One or both users not found.');
                }

                if ($payerUser->balance < $value) {
                    throw new Exception('Insufficient funds.');
                }

                $payerUser->balance -= $value;
                $payeeUser->balance += $value;

                $payerUser->save();
                $payeeUser->save();

                return ['success' => true];
            });
        } catch (Exception $e) {
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }

    /**
     * Retrieve information about a payer by user ID.
     *
     * @param  int  $userId  User ID to fetch.
     * @return User|null Returns User object if found, or null if not found.
     */
    public function getInfoPayer(int $userId): ?User
    {
        $user = $this->model->newQuery()->select('balance', 'is_seller')->find($userId);
        if ($user) {
            return $user;
        }

        return null;
    }
}
