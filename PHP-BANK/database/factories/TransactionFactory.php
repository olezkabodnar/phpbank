<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Domain\Transactions\Transaction;
use App\Domain\Accounts\Account;

class TransactionFactory extends Factory
{
    protected $model = Transaction::class;

    public function definition()
    {
        $type = $this->faker->randomElement(['Deposit', 'Withdrawal', 'Transfer']);
        $amount = $this->faker->randomFloat(2, 10, 1000);
        $balanceAfter = $this->faker->randomFloat(2, 100, 10000);

        return [
            'account_id' => Account::factory(),
            'type' => $type,
            'amount' => $amount,
            'transaction_date' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'description' => $this->faker->optional()->sentence,
            'balance_after' => $balanceAfter,
        ];
    }
}
