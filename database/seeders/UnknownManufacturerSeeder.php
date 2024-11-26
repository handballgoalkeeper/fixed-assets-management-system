<?php

namespace Database\Seeders;

use App\Enums\ErrorMessage;
use App\Exceptions\GeneralException;
use App\Exceptions\ValueNotUniqueException;
use App\Services\ManufacturerService;
use Exception;
use Illuminate\Database\Seeder;

class UnknownManufacturerSeeder extends Seeder
{
    public function run(): void
    {
        if (!$this->command->confirm('Do you wish to seed unknown manufacturer?', true)) {
            return;
        }

        try {
            app(abstract: ManufacturerService::class)->create(requestData: [
                'name' => 'UNKNOWN',
                'description' => 'Unknown manufacturer.'
            ]);
        }
        catch (GeneralException | ValueNotUniqueException $e) {
            $this->command->error($e->getMessage());
        }
        catch (Exception) {
            $this->command->error(ErrorMessage::UNHANDLED_EXCEPTION->value);
        }

        $this->command->newLine();
        $this->command->getOutput()->success('Unknown manufacturer seeded successfully.');
    }
}
