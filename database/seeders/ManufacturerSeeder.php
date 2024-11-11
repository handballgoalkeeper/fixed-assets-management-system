<?php

namespace Database\Seeders;

use App\Models\ManufacturerModel;
use Illuminate\Database\Seeder;

class ManufacturerSeeder extends Seeder
{
    public function run(): void
    {
        $numberOfManufacturers = (int)$this
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

        for ($i = 0; $i < $numberOfManufacturers; $i++) {
            ManufacturerModel::factory()->create();
            $progressBar->advance();
        }

        $progressBar->finish();
        $this->command->info("Seeding completed!");
    }
}
