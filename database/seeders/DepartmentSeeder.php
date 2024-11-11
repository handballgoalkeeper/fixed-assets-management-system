<?php

namespace Database\Seeders;

use App\Models\DepartmentModel;
use App\Models\ManufacturerModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    public function run(): void
    {
        $departmentsCount = (int) $this->command->ask('How many departments do you want to create?', 10);

        if (!$this->command->ask('Do you want to create all departments?', true)) {
            return;
        }

        $progressBar = $this->command->getOutput()->createProgressBar($departmentsCount);
        $progressBar->start();

        for ($i = 0; $i < $departmentsCount; $i++) {
            DepartmentModel::factory()->create();
            $progressBar->advance();
        }

        $progressBar->finish();
        $this->command->getOutput()->success('Departments seeded successfully!');
    }
}
