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
        $this->transactionService->transfer($request->validated());

        return response()->json(['message' => 'Transaction completed successfully.']);
    }
}
