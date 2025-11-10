<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Transfer;
use App\Models\Account;

class TransferFactory extends Factory
{
    protected $model = Transfer::class;

    public function definition()
    {
        $isInternal = $this->faker->boolean(70); // 70% internal, 30% external

        return [
            'from_account_id' => Account::factory(),
            'to_account_id' => $isInternal ? Account::factory() : null,
            'external_bank' => $isInternal ? null : $this->faker->company,
            'external_account_no' => $isInternal ? null : $this->faker->bankAccountNumber,
            'amount' => $this->faker->randomFloat(2, 10, 5000),
            'transfer_date' => $this->faker->dateTimeBetween('-6 months', 'now'),
            'status' => $this->faker->randomElement(['Pending', 'Completed', 'Failed']),
            'confirm_code' => $this->faker->optional()->uuid,
        ];
    }
}
