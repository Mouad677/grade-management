<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AssistantSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Professeur Assistant',
            'email' => 'nom_professeur@supmti.com',
            'password' => Hash::make('nom_professeur'),
            'role' => 'assistant',
            'first_name' => 'Professeur',
            'last_name' => 'Assistant'
        ]);
    }
} 