<?php

namespace App\Services\Transaction;

use App\Models\User;
use App\Repositories\Transaction\TransactionRepositoryInterface;
use App\Services\API\ManagerTransaction\ManagerTransactionServiceInterface;
use Symfony\Component\HttpKernel\Exception\HttpException;

/**
 * Class TransactionService
 *
 * @author Joao Victor <dev.jvictor@gmail.com>
 */
class TransactionService implements TransactionServiceInterface
{
    private TransactionRepositoryInterface $transactionRepository;

    private ManagerTransactionServiceInterface $managerTransactionServiceAPI;

    public function __construct(
        TransactionRepositoryInterface $transactionRepository,
        ManagerTransactionServiceInterface $managerTransactionServiceAPI
    ) {
        $this->transactionRepository = $transactionRepository;
        $this->managerTransactionServiceAPI = $managerTransactionServiceAPI;
    }

    public function transfer(array $data)
    {
        $value = $data['value'] * 100;
        $this->validateTransactionPreconditions($data['payer'], $value);
        $this->getTransactionAuthorization();
        $transfer = $this->transactionRepository->transfer($data['payer'], $data['payee'], $value);
        if (! $transfer['success']) {
            throw new HttpException(500, 'Something went wrong with the transfer.');
        }
        $this->managerTransactionServiceAPI->sendTransactionSuccessNotification();
    }

    private function getTransactionAuthorization()
    {
        $authorization = $this->managerTransactionServiceAPI->getTransactionAuthorization();
        if (! $authorization) {
            throw new HttpException(403, 'You are not authorized to complete this transaction.');
        }

        return true;
    }

    private function validateTransactionPreconditions(int $payer, int $value)
    {
        $payerInfo = $this->transactionRepository->getInfoPayer($payer);
        if (! $payerInfo) {
            throw new HttpException(404, 'Payer not found.');
        }

        return $this->verifyBalanceBeforeTransfer($payerInfo, $value);
    }

    private function verifyBalanceBeforeTransfer(User $payer, int $value)
    {
        if ($payer['is_seller']) {
            throw new HttpException(422, 'Sellers are not allowed to perform this transaction.');
        }
        if ($payer['balance'] < $value) {
            throw new HttpException(422, 'Insufficient balance to complete the transaction.');
        }

        return true;
    }
}
