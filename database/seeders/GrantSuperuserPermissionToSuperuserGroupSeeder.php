<?php

namespace Database\Seeders;

use App\Enums\ErrorMessage;
use App\Exceptions\GeneralException;
use App\Exceptions\PermissionAlreadyInGroup;
use App\Models\GroupModel;
use App\Models\PermissionModel;
use App\Services\GroupService;
use Exception;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GrantSuperuserPermissionToSuperuserGroupSeeder extends Seeder
{
    public function run(): void
    {
        if (!$this->command->confirm('Do you wish to seed superuser permission to superuser group?', true)) {
            return;
        }

        try {
            $permissionId = DB::table(table: PermissionModel::TABLE)
                ->where(column: "name", operator: "=", value: "superuser")->pluck(column: 'id')->first();

            $group = GroupModel::where(column: "name", operator: "=", value: "superuser")->first();

            app(GroupService::class)->grantPermissionToGroup(group: $group, permissionId: $permissionId);
        }
        catch (PermissionAlreadyInGroup | GeneralException $e) {
            $this->command->error($e->getMessage());
        }
        catch (Exception) {
            $this->command->error(ErrorMessage::UNHANDLED_EXCEPTION->value);
        }

        $this->command->newLine();
        $this->command->getOutput()->success('Superuser permission granted successfully to SUPERUSER group.');
    }
}
