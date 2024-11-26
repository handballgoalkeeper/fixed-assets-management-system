<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        if (!$this->command->confirm('Do you want to seed database?', true)) {
            return;
        }

        $this->call([
            PermissionsSeeder::class,
            SuperuserGroupSeeder::class,
            GrantSuperuserPermissionToSuperuserGroupSeeder::class,
            SuperuserAccountSeeder::class,
            GrantSuperuserGroupToSuperuserAccountSeeder::class,
            UnknownSupplierSeeder::class,
        ]);

        $this->command->newLine();
        $this->command->getOutput()->success('Database seeded successfully.');
    }
}
