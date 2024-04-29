<?php

namespace App\Services\Transaction;

/**
 * Class TransactionServiceFactory
 *
 * @author Joao Victor <dev.jvictor@gmail.com>
 */
class TransactionServiceFactory
{
    public function __invoke(): TransactionService
    {
        return new TransactionService();
    }
}
