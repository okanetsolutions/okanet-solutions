<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Creates (or updates) the admin user used to manage the blog.
     *
     * Credentials come from ADMIN_EMAIL / ADMIN_PASSWORD env vars.
     */
    public function run(): void
    {
        $email = env('ADMIN_EMAIL', 'nadinyamaui@outlook.com');
        $password = env('ADMIN_PASSWORD');

        if (! $password) {
            $this->command->error('Define ADMIN_PASSWORD en el .env antes de ejecutar este seeder.');

            return;
        }

        User::updateOrCreate(
            ['email' => $email],
            ['name' => 'Admin', 'password' => Hash::make($password)],
        );

        $this->command->info("Usuario admin listo: {$email}");
    }
}
