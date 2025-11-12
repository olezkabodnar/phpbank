<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Account;
use Illuminate\Support\Str;

class AccountFactory extends Factory
{
    protected $model = \App\Models\Account::class;

    public function definition()
    {
        return [
            'first_name' => $this->faker->firstName,
            'last_name'  => $this->faker->lastName,
            'dob'        => $this->faker->dateTimeBetween('-65 years', '-18 years'),
            'phone_no'   => $this->faker->unique()->numerify('##########'),
            'email'      => $this->faker->unique()->safeEmail,
            'password'   => bcrypt('password'),
            'two_fa_enabled' => 'N',
            'status'     => 'A',
            'balance'    => $this->faker->randomFloat(2, 100, 10000),
        ];
    }
}
