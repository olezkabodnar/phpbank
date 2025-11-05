<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Domain\Accounts\Account;

class AccountSeeder extends Seeder
{
    public function run()
    {
        Account::factory()->count(10)->create();
    }
}
