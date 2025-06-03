<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Administrateur',
            'email' => 'admin@test.com',
            'password' => Hash::make('123456789@'),
            'role' => 'admin',
            'first_name' => 'Admin',
            'last_name' => 'System'
        ]);
    }
}
