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

$this->call(AccountSeeder::class);


/*Run Migration + Seeder just run:

php artisan migrate --seed*/