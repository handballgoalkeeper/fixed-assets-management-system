<?php

namespace Database\Factories;

use App\Models\SupplierModel;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

class SupplierModelFactory extends Factory
{
    protected $model = SupplierModel::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->company(),
            'description' => $this->faker->text(),
            'PIB' => (string)$this->faker->numberBetween(10000001, 99999999),
            'contact_person' => $this->faker->name(),
            'is_active' => true,
            'last_modified_by' => DB::table(User::TABLE)->inRandomOrder()->first()->id,
        ];
    }
}
