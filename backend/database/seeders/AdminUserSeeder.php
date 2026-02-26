<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class AdminUserSeeder extends Seeder
{
    /**
     * Create admin user. Set ADMIN_EMAIL, ADMIN_PASSWORD, ADMIN_NAME in .env
     */
    public function run(): void
    {
        $email = env('ADMIN_EMAIL', 'admin@example.com');
        $password = env('ADMIN_PASSWORD', 'changeme');
        $name = env('ADMIN_NAME', 'Admin');

        User::firstOrCreate(
            ['email' => $email],
            [
                'name' => $name,
                'password' => $password,
                'role' => 'admin',
            ]
        );
    }
}
