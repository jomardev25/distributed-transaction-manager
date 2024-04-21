<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Services\TransactionService;
use App\Models\Transaction;
use Illuminate\Http\Response;

class TransactionControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_insert_transaction_success()
    {
        $mockTransactionService = $this->mock(TransactionService::class);
        $mockTransactionService->shouldReceive('insertTransaction')
            ->andReturn([
                'is_success' => true,
                'message' => 'Transaction inserted successfully'
            ]);

        $data = [
            'first_name' => 'test',
            'last_name' => 'test',
            'balance' => 100
        ];

        $response = $this->postJson('/api/v1/transactions/insert', $data);



        $response->assertStatus(Response::HTTP_CREATED)
            ->assertJson(
                ["message" => "Transaction inserted successfully"]
            );
    }

    public function test_insert_transaction_failure()
    {
        $mockTransactionService = $this->mock(TransactionService::class);
        $mockTransactionService->shouldReceive('insertTransaction')
            ->andReturn(['is_success' => false, 'message' => 'Failed to insert transaction']);

        $data = [
            'first_name' => 'test',
            'last_name' => 'test',
            'balance' => 100
        ];
        $response = $this->postJson('/api/v1/transactions/insert', $data);
        $response->assertStatus(Response::HTTP_INTERNAL_SERVER_ERROR)
            ->assertJson(['message' => 'Failed to insert transaction']);
    }

    public function test_rollback_transaction_success()
    {
        $mockTransactionService = $this->mock(TransactionService::class);
        $mockTransactionService->shouldReceive('rollBackTransaction')
            ->andReturn(['is_success' => true, 'message' => 'Transaction rolled back successfully']);

        $data = [
            'account_num' => 999
        ];
        $response = $this->postJson('/api/v1/transactions/rollback',  $data);
        $response->assertStatus(Response::HTTP_OK)
            ->assertJson(['message' => 'Transaction rolled back successfully']);
    }

    public function test_rollback_transaction_failure()
    {
        $mockTransactionService = $this->mock(TransactionService::class);
        $mockTransactionService->shouldReceive('rollBackTransaction')
            ->andReturn(['is_success' => false, 'message' => 'Failed to rollback transaction']);

        $data = [
            'account_num' => 999
        ];
        $response = $this->postJson('/api/v1/transactions/rollback',  $data);
        $response->assertStatus(Response::HTTP_INTERNAL_SERVER_ERROR)
            ->assertJson(['message' => 'Failed to rollback transaction']);
    }
}
