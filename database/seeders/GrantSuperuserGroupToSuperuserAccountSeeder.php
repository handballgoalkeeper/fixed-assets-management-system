<?php

namespace Database\Seeders;

use App\Enums\ErrorMessage;
use App\Exceptions\GeneralException;
use App\Exceptions\GroupAlreadyGranted;
use App\Exceptions\PermissionAlreadyInGroup;
use App\Models\GroupModel;
use App\Models\PermissionModel;
use App\Models\User;
use App\Services\GroupService;
use App\Services\UserService;
use Exception;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GrantSuperuserGroupToSuperuserAccountSeeder extends Seeder
{
    public function run(): void
    {
        if (!$this->command->confirm('Do you wish to seed superuser group to superuser account?', true)) {
            return;
        }

        try {
            $groupId = DB::table(table: GroupModel::TABLE)
                ->where(column: "name", operator: "=", value: "SUPERUSER")->pluck(column: 'id')->first();

            $user = User::where(column: "name", operator: "=", value: "Superuser Superuser")->first();

            app(UserService::class)->assignGroupToUser(user: $user, requestData: [
                'selectedGroup' => $groupId,
            ]);
        }
        catch (GroupAlreadyGranted | GeneralException $e) {
            $this->command->error($e->getMessage());
        }
        catch (Exception) {
            $this->command->error(ErrorMessage::UNHANDLED_EXCEPTION->value);
        }

        $this->command->newLine();
        $this->command->getOutput()->success('Superuser group granted successfully to superuser account.');
    }
}
