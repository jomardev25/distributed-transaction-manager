<?php

namespace App\Services\ServicesImpl;

use App\Models\Transaction;
use Illuminate\Support\Facades\DB;
use App\Services\TransactionService;

class TransactionServiceImpl implements TransactionService
{
    public function insertTransaction(array $data)
    {
        $results = DB::transaction(function () use ($data) {
            return DB::table('transactions')->insertGetId($data);
        });

        if (!is_int($results)) {
            return [
                'is_success' => false,
                'message' => 'Failed to isnert transaction successfully'
            ];
        }

        return [
            'is_success' => true,
            'message' => 'Transaction inserted successfully'
        ];
    }

    public function rollbackTransaction(int $accountNum)
    {
        try {
            DB::beginTransaction();
            $transaction = Transaction::findOrFail($accountNum);
            $transaction->delete();
            DB::rollBack();
            return [
                'is_success' => true,
                'message' => 'Transaction rollback successfully'
            ];
        } catch (\Exception $e) {
            return [
                'is_success' => false,
                'message' => 'Failed to rollback transaction: ' .  $e->getMessage()
            ];
        }
    }
}
