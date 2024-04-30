<?php

namespace App\Repositories\Adapters\Eloquent\Transaction;

use App\Models\User;
use App\Repositories\Transaction\TransactionRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Exception;

/**
 * Inteface TransactionRepositoryAdapter
 *
 * @author Joao Victor S <dev.jvictor@gmail.com>
 */
class TransactionRepositoryAdapter implements TransactionRepositoryInterface
{
    public function __construct(
        User $model
    ) {
        $this->model = $model;
    }

    public function transfer(int $payer, int $payee, int $value)
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

    public function getInfoPayer(int $userId): mixed
    {
        $user = $this->model->newQuery()->select('balance', 'is_seller')->find($userId);
        if ($user) {
            return $user;
        }

        return null;
    }
}
