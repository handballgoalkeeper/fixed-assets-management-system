<?php

namespace Database\Factories;

use App\Models\EmployeeModel;
use Illuminate\Database\Eloquent\Factories\Factory;

class EmployeeModelFactory extends Factory
{
    protected $model = EmployeeModel::class;

    public function definition(): array
    {
        return [
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'email' => $this->faker->unique()->safeEmail()
        ];
    }
}
