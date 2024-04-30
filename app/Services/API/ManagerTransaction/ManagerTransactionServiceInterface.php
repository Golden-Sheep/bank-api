<?php

namespace App\Services\API\ManagerTransaction;

interface ManagerTransactionServiceInterface
{
    public function getTransactionAuthorization(): bool;

    public function sendTransactionSuccessNotification(): bool;
}
