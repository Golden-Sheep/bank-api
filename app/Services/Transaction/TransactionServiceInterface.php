<?php

namespace App\Services\Transaction;

/**
 * Class TransactionServiceInterface
 *
 * @author Joao Victor <dev.jvictor@gmail.com>
 */
interface TransactionServiceInterface
{
    public function transfer(array $data);
}
