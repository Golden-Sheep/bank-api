<?php

namespace App\Repositories\Transaction;

use App\Models\User;

/**
 * Inteface TransactionRepositoryInterface
 *
 * @author Joao Victor S <dev.jvictor@gmail.com>
 */
interface TransactionRepositoryInterface
{
    /**
     * @return array<mixed>
     */
    public function transfer(int $payer, int $payee, int $value): array;

    public function getInfoPayer(int $userId): ?User;
}
