<?php

namespace Database\Seeders;

use App\Enums\ErrorMessage;
use App\Exceptions\GeneralException;
use App\Services\UserService;
use Exception;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class SuperuserAccountSeeder extends Seeder
{
    public function run(): void
    {
        if (!$this->command->confirm('Do you wish to seed superuser account?', true)) {
            return;
        }

        $email = $this->command->ask(question: 'Please enter email for superuser account:');

        $password = $this->command->secret(question: 'Please enter password for superuser account:');

        while(true) {
            $reenterPassword = $this->command->secret(question: 'Please reenter password for superuser account:');

            if ($password === $reenterPassword) {
                break;
            }
        }

        try {
            app(UserService::class)->createNewUser(requestData: [
                'name' => 'Superuser Superuser',
                'email' => $email,
                'password' => $password
            ]);
        }
        catch (GeneralException $e) {
            $this->command->error($e->getMessage());
        }
        catch (Exception) {
            $this->command->error(ErrorMessage::UNHANDLED_EXCEPTION->value);
        }

        $this->command->newLine();
        $this->command->getOutput()->success('Superuser seeded successfully.');
    }
}
