<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // 1. Create Default Admin User
        User::firstOrCreate(
            ['email' => 'admin@banglapuzzle.com'],
            [
                'name'     => 'Kazi Omar Faruk',
                'password' => Hash::make('password'),
            ]
        );
    }
}
