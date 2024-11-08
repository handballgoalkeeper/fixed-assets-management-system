<?php

namespace Database\Factories;

use App\Models\ManufacturerModel;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

class ManufacturerModelFactory extends Factory
{
    protected $model = ManufacturerModel::class;
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
            'last_modified_by' => DB::table('users')->inRandomOrder()->first()->id,
        ];
    }
}
