<?php

namespace App\Http\Controllers;

use App\Http\Requests\Transaction\TransferRequest;
use App\Services\Transaction\TransactionServiceInterface;
use Illuminate\Http\JsonResponse;

class TransactionController extends Controller
{
    private TransactionServiceInterface $transactionService;

    public function __construct(TransactionServiceInterface $transactionService)
    {
        $this->transactionService = $transactionService;
    }

    /**
     * Transfer funds between accounts.
     *
     *
     * @throws \HttpException If the transfer fails
     */
    public function transfer(TransferRequest $request): JsonResponse
    {
        $this->transactionService->transfer($request->validated());

        return response()->json(['message' => 'Transaction completed successfully.']);
    }
}
