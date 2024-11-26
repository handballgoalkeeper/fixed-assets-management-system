<?php

namespace Database\Seeders;

use App\Models\PermissionModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionsSeeder extends Seeder
{
    const PERMISSIONS = [
        'superuser' => 'GRANTS AUTHENTICATED USER ALL PERMISSIONS.',
        'manufacturers-create' => 'Allows authenticated user to create new manufacturers.',
        'manufacturers-view' => 'Allows authenticated user to view all manufacturers.',
        'manufacturers-edit' => 'Allows authenticated user to edit manufacturers.',
        'manufacturers-history' => 'Allows authenticated user to view manufacturers history.',
        'suppliers-create' => 'Allows authenticated user to create new suppliers.',
        'suppliers-view' => 'Allows authenticated user to view all suppliers.',
        'suppliers-edit' => 'Allows authenticated user to edit suppliers.',
        'suppliers-history' => 'Allows authenticated user to view suppliers history.',
        'departments-create' => 'Allows authenticated user to create new departments.',
        'departments-view' => 'Allows authenticated user to view all departments.',
        'departments-edit' => 'Allows authenticated user to edit departments.',
        'departments-history' => 'Allows authenticated user to view departments history.',
        'locations-create' => 'Allows authenticated user to create new locations.',
        'locations-view' => 'Allows authenticated user to view all locations.',
        'locations-edit' => 'Allows authenticated user to edit locations.',
        'locations-history' => 'Allows authenticated user to view locations history.',
        'assets-create' => 'Allows authenticated user to create new assets.',
        'assets-view' => 'Allows authenticated user to view all assets.',
        'assets-edit' => 'Allows authenticated user to edit assets.',
        'assets-history' => 'Allows authenticated user to view assets history.',
        'employee-create' => 'Allows authenticated user to create new employee.',
        'employee-view' => 'Allows authenticated user to view all employee.',
        'employee-edit' => 'Allows authenticated user to edit employee.',
        'employee-history' => 'Allows authenticated user to view employee history.',
        'admin-home' => 'Allows authenticated user to view admin home.',
        'admin-groups-create' => 'Allows authenticated user to create new groups.',
        'admin-groups-view' => 'Allows authenticated user to view all groups.',
        'admin-groups-edit' => 'Allows authenticated user to edit groups.',
        'admin-groups-history' => 'Allows authenticated user to view groups history.',
        'admin-groups-permissions-view' => 'Allows authenticated user to see granted permissions in groups.',
        'admin-groups-permissions-grant' => 'Allows authenticated user to grant permissions to groups.',
        'admin-groups-permissions-revoke' => 'Allows authenticated user to revoke permissions from groups.',
        'admin-permissions-view' => 'Allows authenticated user to view all permissions.',
        'admin-users-create' => 'Allows authenticated user to create new users.',
        'admin-users-view' => 'Allows authenticated user to view all users.',
        'admin-users-edit' => 'Allows authenticated user to edit users.',
        'admin-users-history' => 'Allows authenticated user to view users history.',
        'admin-users-groups-view' => 'Allows authenticated user to see granted groups to users.',
        'admin-users-groups-grant' => 'Allows authenticated user to grant groups to users.',
        'admin-users-groups-revoke' => 'Allows authenticated user to revoke groups to users.',
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

        $this->command->getOutput()->newLine();
        $this->command->getOutput()->success('Permissions table seeded successfully.');
    }
}
