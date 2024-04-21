<?php

namespace Database\Seeders;

use App\Models\Transaction;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Transaction::create([
            'first_name' => 'John',
            'last_name' => 'Doe',
            'balance' => 100
        ]);

        Transaction::create([
            'first_name' => 'James',
            'last_name' => 'Smith',
            'balance' => 0
        ]);

        Transaction::create([
            'first_name' => 'Jane',
            'last_name' => 'Doe',
            'balance' => 2000
        ]);
    }
}
