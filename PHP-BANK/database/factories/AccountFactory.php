<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Domain\Accounts\Account;
use Illuminate\Support\Str;

class AccountFactory extends Factory
{
    protected $model = Account::class;

    public function definition()
    {
        return [
            'first_name' => $this->faker->firstName,
            'last_name'  => $this->faker->lastName,
            'dob'        => $this->faker->date(),
            'phone_no'   => $this->faker->unique()->phoneNumber,
            'email'      => $this->faker->unique()->safeEmail,
            'password'   => bcrypt('password'),
            'two_fa_enabled' => false,
            'status'     => 'A',
            'balance'    => $this->faker->randomFloat(2, 100, 10000),
        ];
    }
}
