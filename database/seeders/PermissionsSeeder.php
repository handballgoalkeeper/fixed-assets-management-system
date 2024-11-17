<?php

namespace Database\Seeders;

use App\Models\PermissionModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionsSeeder extends Seeder
{
    const PERMISSIONS = [
        'manufacturer-crud' => 'Permission for doing CRUD with manufactures.',
        'supplier-crud' => 'Permission for doing CRUD with suppliers.',
        'department-crud' => 'Permission for doing CRUD with departments.',
        'location-crud' => 'Permission for doing CRUD with locations.',
        'manufacturer-history' => 'Permission for viewing manufacture history.',
        'supplier-history' => 'Permission for viewing supplier history.',
        'department-history' => 'Permission for viewing department history.',
        'location-history' => 'Permission for viewing location history.',
        'manufacture-history' => 'Permission for viewing manufacture history.'
    ];
    public function run(): void
    {
        if (!$this->command->confirm('Do you wish to seed permissions table?', true)) {
            return;
        }


        $progressBar = $this->command->getOutput()->createProgressBar(count(self::PERMISSIONS));
        $progressBar->start();

        foreach (self::PERMISSIONS as $name => $description) {
            $count = DB::table(PermissionModel::TABLE)->where('name', $name)->count();

            if ($count > 0) {
                continue;
            }

            $permissionModel = new PermissionModel();
            $permissionModel->fill([
                'name' => $name,
                'description' => $description
            ]);

            $permissionModel->save();
            $progressBar->advance();
        }

        $progressBar->finish();

        $this->command->getOutput()->success('Permissions table seeded successfully.');
    }
}
