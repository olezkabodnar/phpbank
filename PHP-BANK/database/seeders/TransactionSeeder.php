<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Domain\Transactions\Transaction;

class TransactionSeeder extends Seeder
{
    public function run()
    {
        Transaction::factory()->count(20)->create();
    }
}


$this->call(TransactionSeeder::class);