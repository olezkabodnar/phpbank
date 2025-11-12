<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Account;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        
        Account::factory()->create([
            'first_name' => 'Test',
            'last_name'  => 'User',
            'email'      => 'test@example.com',
            'password'   => bcrypt('password'),
            'two_fa_enabled' => 'N',
            'status'     => 'A',
            'balance'    => 1000.00,
            'dob'        => now()->subYears(25),
            'phone_no'   => '1234567890',
        ]);

        $this->call([
            AccountSeeder::class,
            TransactionSeeder::class,
            TransferSeeder::class,
        ]);
    }
}
