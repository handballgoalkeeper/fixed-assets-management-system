<?php

namespace Database\Factories;

use App\Models\DepartmentModel;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

class DepartmentModelFactory extends Factory
{
    protected $model = DepartmentModel::class;
    private $nameSufix = 'Department';

    public function definition(): array
    {
        return [
            'name' => $this->generateUniqueDepartmentName(),
            'description' => $this->faker->text(maxNbChars: 255),
            'last_modified_by' => DB::table('users')->inRandomOrder()->first()->id,
        ];
    }

    private function generateUniqueDepartmentName(): string
    {
        $faker = $this->faker;
        $departmentName = $faker->word();

        while (DB::table(DepartmentModel::TABLE)->where('name', '=', $departmentName . $this->nameSufix)->exists()) {
            $departmentName = $faker->word();
        }

        return $departmentName . $this->nameSufix;
    }
}
