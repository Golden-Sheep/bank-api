<?php

namespace App\Services\Transaction;

/**
 * Class TransactionServiceInterface
 *
 * @author Joao Victor <dev.jvictor@gmail.com>
 */
interface TransactionServiceInterface
{
    /**
     * @param  array<mixed>  $data
     */
    public function transfer(array $data): bool;
}
