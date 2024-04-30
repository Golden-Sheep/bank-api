<?php

namespace App\Services\API\ManagerTransaction;

/**
 * Class ManagerTransactionServiceFactory
 *
 * @author Joao Victor <dev.jvictor@gmail.com>
 */
class ManagerTransactionServiceFactory
{
    public function __invoke(): ManagerTransactionService
    {
        return new ManagerTransactionService();
    }
}
