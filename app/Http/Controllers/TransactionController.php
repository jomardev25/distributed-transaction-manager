<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use App\Services\TransactionService;
use App\Http\Requests\CreateTransactionRequest;
use App\Http\Requests\RollbackTransactionRequest;

class TransactionController extends Controller
{
    public function __construct(private TransactionService $transactionService)
    {
    }

    public function insertTransaction(CreateTransactionRequest $createTransactionRequest)
    {
        $data = $createTransactionRequest->validated();
        $result = $this->transactionService->insertTransaction($data);
        $statusCode = $result['is_success'] === true ? Response::HTTP_CREATED : Response::HTTP_INTERNAL_SERVER_ERROR;
        return response()->json($result, $statusCode);
    }

    public function rollBackTransaction(RollbackTransactionRequest $rollBackTransactionRequest)
    {
        $data = $rollBackTransactionRequest->validated();
        $result = $this->transactionService->rollBackTransaction($data['account_num']);
        $statusCode = $result['is_success'] === true ? Response::HTTP_OK : Response::HTTP_INTERNAL_SERVER_ERROR;
        return response()->json($result, $statusCode);
    }
}
