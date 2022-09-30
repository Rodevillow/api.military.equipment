<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $nickname = env('MAIN_ADMIN_NICKNAME');
        $email = env('MAIN_ADMIN_EMAIL');
        $password = env('MAIN_ADMIN_PASSWORD');

        if (!$nickname && !$email && !$password) {
            $this->command->error('Error: Cannot find the start user credentials...');

            $this->command->alert('Please for create first user, you have to do next actions:');
            $this->command->warn('Set into env file (user nickname) by this key: MAIN_ADMIN_NICKNAME');
            $this->command->warn('Set into env file (user email) by this key: MAIN_ADMIN_EMAIL');
            $this->command->warn('Set into env file (user password) by this key: MAIN_ADMIN_PASSWORD');

            $this->command->warn('...');
            $this->command->warn('   ');

            $this->command->alert('Example ENV:');
            $this->command->warn('MAIN_ADMIN_NICKNAME="Developer"');
            $this->command->warn('MAIN_ADMIN_EMAIL="mail@example.com"');
            $this->command->warn('MAIN_ADMIN_PASSWORD="dj1eR@38f3us4E"');
            return;
        }

        // Creating main user
        $user = new User();
        $user->nickname = $nickname;
        $user->email = $email;
        $user->password = bcrypt($password);
        $user->save();

        $this->command->info('Congratulations! Main user was successfully created!');
    }
}
