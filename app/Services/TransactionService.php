<?php

namespace App\Services;

interface TransactionService
{
    public function insertTransaction(array $data);

    public function rollbackTransaction(int $accountNum);
}
