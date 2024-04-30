<?php

namespace App\Repositories\Transaction;

/**
 * Inteface TransactionRepositoryInterface
 *
 * @author Joao Victor S <dev.jvictor@gmail.com>
 */
interface TransactionRepositoryInterface
{
    public function transfer(int $payer, int $payee, int $value);

    public function getInfoPayer(int $userId);
}
