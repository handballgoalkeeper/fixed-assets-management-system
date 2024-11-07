<?php

namespace Database\Seeders;

use App\Models\ManufacturerModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class ManufacturerSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create();

        $numberOfManufacturers = (int) $this
            ->command
            ->ask(question: 'How many manufacturers do you want?', default: 10);

        if (!$this
            ->command
            ->confirm(question: "Are you sure you want to seed $numberOfManufacturers users?", default: true)) {
            $this->command->info(string: 'Seeding aborted!');
            return;
        }

        $progressBar = $this->command->getOutput()->createProgressBar($numberOfManufacturers);
        $progressBar->start();

        foreach (range(1, $numberOfManufacturers) as $index) {
            ManufacturerModel::factory()->create();
            $progressBar->advance();
        }

        $progressBar->finish();
        $this->command->info("Seeding completed!");
    }
}
