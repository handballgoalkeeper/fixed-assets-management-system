<?php

namespace Database\Seeders;

use App\Enums\ErrorMessage;
use App\Exceptions\GeneralException;
use App\Exceptions\ValueNotUniqueException;
use App\Services\SupplierService;
use Exception;
use Illuminate\Database\Seeder;

class UnknownSupplierSeeder extends Seeder
{
    public function run(): void
    {
        if (!$this->command->confirm('Do you wish to seed unknown supplier?', true)) {
            return;
        }

        try {
            app(abstract: SupplierService::class)->create(request: [
                'name' => 'UNKNOWN',
                'description' => 'Unknown supplier.',
                'pib' => null,
                'contactPerson' => null,
            ]);
        }
        catch (GeneralException | ValueNotUniqueException $e) {
            $this->command->error($e->getMessage());
        }
        catch (Exception $e) {
            $this->command->error(ErrorMessage::UNHANDLED_EXCEPTION->value);
        }

        $this->command->newLine();
        $this->command->getOutput()->success('Unknown supplier seeded successfully.');
    }
}
