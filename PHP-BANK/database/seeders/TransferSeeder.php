<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Domain\Transfers\Transfer;

class TransferSeeder extends Seeder
{
    public function run()
    {
        Transfer::factory()->count(20)->create();
    }
}

$this->call(TransferSeeder::class);
