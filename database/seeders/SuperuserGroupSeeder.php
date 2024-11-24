<?php

namespace Database\Seeders;

use App\Enums\ErrorMessage;
use App\Exceptions\GeneralException;
use App\Exceptions\ValueNotUniqueException;
use App\Models\GroupModel;
use App\Services\GroupService;
use Exception;
use Illuminate\Database\Seeder;

class SuperuserGroupSeeder extends Seeder
{
    public function run(): void
    {
        if (!$this->command->confirm('Do you wish to seed superuser group?', true)) {
            return;
        }

        try {
            app(abstract: GroupService::class)->create(requestData: [
                'name' => 'SUPERUSER',
                'description' => 'Allows authenticated user to perform all operations unlimited.'
            ]);
        }
        catch (GeneralException | ValueNotUniqueException $e) {
            $this->command->error($e->getMessage());
        }
        catch (Exception) {
            $this->command->error(ErrorMessage::UNHANDLED_EXCEPTION->value);
        }

        $this->command->newLine();
        $this->command->getOutput()->success('Superuser group seeded successfully.');
    }
}
