<?php

namespace Database\Seeders;

use App\Models\SupplierModel;
use Illuminate\Database\Seeder;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $supplierCount = (int) $this
            ->command
            ->ask(question: 'How many suppliers do you want to seed?', default: 10);

        if (!$this
            ->command
            ->confirm(question: "Are you sure you want to seed $supplierCount suppliers?", default: true)
        ) {
            return;
        }

        $this->command->getOutput()->progressStart($supplierCount);

        for ($i = 0; $i < $supplierCount; $i++) {
            SupplierModel::factory()->create();
            $this->command->getOutput()->progressAdvance();
        }

        $this->command->getOutput()->progressFinish();
        $this->command->getOutput()->success('Seeding completed!');
    }
}
