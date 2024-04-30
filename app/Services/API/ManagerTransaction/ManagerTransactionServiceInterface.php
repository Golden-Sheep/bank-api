<?php

namespace App\Services\API\ManagerTransaction;

interface ManagerTransactionServiceInterface
{
    public function getTransactionAuthorization();

    public function sendTransactionSuccessNotification();
}
