<?php

namespace App\Http\Controllers;

use App\Http\Requests\Transaction\TransferRequest;
use App\Services\Transaction\TransactionServiceInterface;

class TransactionController extends Controller
{
    private TransactionServiceInterface $transactionService;

    public function __construct(TransactionServiceInterface $transactionService)
    {
        $this->transactionService = $transactionService;
    }

    public function transfer(TransferRequest $request)
    {
        return $this->transactionService->transfer($request->validated());
    }
}
