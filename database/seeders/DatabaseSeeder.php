<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Admin Científico',
            'email' => 'admin@science.lab',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);

        User::factory()->create([
            'name' => 'Investigador Invitado',
            'email' => 'guest@science.lab',
            'password' => bcrypt('password'),
            'role' => 'user',
        ]);
    }
}